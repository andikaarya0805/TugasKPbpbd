<?php
require __DIR__ . '/../config/database.php';
header('Content-Type: application/json');

// Total laporan
$q1 = $koneksi->query("SELECT COUNT(*) AS total FROM tb_laporan");
$total_laporan = $q1->fetch_assoc()['total'];

// Laporan baru
$q2 = $koneksi->query("SELECT COUNT(*) AS total FROM tb_laporan WHERE status = 'Baru'");
$laporan_baru = $q2->fetch_assoc()['total'];

// Sedang diproses
$q3 = $koneksi->query("SELECT COUNT(*) AS total FROM tb_laporan WHERE status = 'Diproses'");
$diproses = $q3->fetch_assoc()['total'];

// Selesai
$q4 = $koneksi->query("SELECT COUNT(*) AS total FROM tb_laporan WHERE status = 'Selesai'");
$selesai = $q4->fetch_assoc()['total'];

// Jika kamu mau laporan masuk hari ini
$q5 = $koneksi->query("
    SELECT COUNT(*) AS total 
    FROM tb_laporan 
    WHERE DATE(tanggal_lapor) = CURDATE()
");
$laporan_hari_ini = $q5->fetch_assoc()['total'];

echo json_encode([
    "total_laporan"     => $total_laporan,
    "laporan_hari_ini"  => $laporan_hari_ini,
    "laporan_baru"      => $laporan_baru,
    "diproses"          => $diproses,
    "selesai"           => $selesai
]);
