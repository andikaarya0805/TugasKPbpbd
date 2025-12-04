<?php
session_start();
include '../config/database.php';

// Cek login
if (!isset($_SESSION['id_admin'])) {
    echo json_encode(['success' => false, 'message' => 'Anda harus login']);
    exit;
}

$id_laporan = $_GET['id_laporan'] ?? 0;
$id_laporan = intval($id_laporan);

if ($id_laporan > 0) {
    // Hapus log aktivitas
    $stmt = $koneksi->prepare("DELETE FROM tb_log_aktivitas WHERE id_laporan = ?");
    $stmt->bind_param("i", $id_laporan);
    $stmt->execute();

    // Hapus laporan
    $stmt = $koneksi->prepare("DELETE FROM tb_laporan WHERE id_laporan = ?");
    $stmt->bind_param("i", $id_laporan);
    $stmt->execute();

    echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus']);
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'ID laporan tidak valid']);
    exit;
}
?>
