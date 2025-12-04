<?php
session_start();
include '../config/database.php';

// Pastikan request POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: laporan.php?msg=invalid_request");
    exit;
}

// Validasi data wajib
if (!isset($_POST['id'], $_POST['status'])) {
    header("Location: laporan.php?msg=missing_params");
    exit;
}

$id_laporan = $_POST['id'];
$status = $_POST['status'];

// 1️⃣ Update status laporan
$stmt = $koneksi->prepare("UPDATE tb_laporan SET status = ? WHERE id_laporan = ?");
$stmt->bind_param("si", $status, $id_laporan);

if ($stmt->execute()) {
    // 2️⃣ Simpan log aktivitas
    $id_admin = $_SESSION['id_admin'] ?? null; // bisa null jika bukan login admin
    $aksi = "Update Status";
    $keterangan = "Status laporan diubah menjadi $status";
    $ip_address = $_SERVER['REMOTE_ADDR'] ?? '';
    $tanggal = date('Y-m-d H:i:s');

    $stmt2 = $koneksi->prepare(
    "INSERT INTO tb_log_aktivitas (id_admin, id_laporan, aksi, keterangan, ip_address, tanggal) 
     VALUES (?, ?, ?, ?, ?, ?)"
);
$stmt2->bind_param("iissss", $id_admin, $id_laporan, $aksi, $keterangan, $ip_address, $tanggal);
    $stmt2->execute();
    $stmt2->close();

    header("Location: laporan.php?msg=updated");
} else {
    header("Location: laporan.php?msg=error");
}

$stmt->close();
$koneksi->close();
exit;
?>
