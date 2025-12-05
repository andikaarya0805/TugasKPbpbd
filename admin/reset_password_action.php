<?php
session_start();
header('Content-Type: application/json');
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';

if (empty($username) || empty($password) || empty($password_confirm)) {
    echo json_encode(['success' => false, 'message' => 'Semua field wajib diisi!']);
    exit;
}

if ($password !== $password_confirm) {
    echo json_encode(['success' => false, 'message' => 'Password dan konfirmasi tidak cocok!']);
    exit;
}

$stmt = $koneksi->prepare("SELECT id_admin FROM tb_admin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo json_encode(['success' => false, 'message' => 'Username tidak ditemukan!']);
    exit;
}

$admin = $result->fetch_assoc();
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$update = $koneksi->prepare("UPDATE tb_admin SET password = ? WHERE id_admin = ?");
$update->bind_param("si", $hashed_password, $admin['id_admin']);

if ($update->execute()) {
    echo json_encode(['success' => true, 'message' => 'Password berhasil diupdate! Silakan login.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan saat update password.']);
}

$update->close();
$stmt->close();
$koneksi->close();
?>
