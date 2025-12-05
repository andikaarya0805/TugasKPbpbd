<?php
session_start();
include '../config/database.php';
header('Content-Type: application/json');

if(!isset($_SESSION['id_admin'])){
    echo json_encode(['success'=>false,'message'=>'Session habis, silakan login ulang']);
    exit;
}

$id_laporan = intval($_POST['id'] ?? 0);
$id_petugas = intval($_POST['id_petugas'] ?? 0);

if($id_laporan <= 0 || $id_petugas <= 0){
    echo json_encode(['success'=>false,'message'=>'Data tidak valid']);
    exit;
}

$cek_petugas_q = mysqli_query($koneksi, "SELECT * FROM tb_petugas WHERE id_petugas = $id_petugas LIMIT 1");
if(!$cek_petugas_q || mysqli_num_rows($cek_petugas_q) == 0){
    echo json_encode(['success'=>false,'message'=>'Petugas tidak ditemukan']);
    exit;
}
$cek_petugas = mysqli_fetch_assoc($cek_petugas_q);

$update = mysqli_query($koneksi, "UPDATE tb_laporan SET id_petugas = $id_petugas, status='Diproses' WHERE id_laporan = $id_laporan");
if(!$update){
    echo json_encode(['success'=>false,'message'=>'Gagal menugaskan petugas: '.mysqli_error($koneksi)]);
    exit;
}

$aksi = mysqli_real_escape_string($koneksi, "Ditugaskan ke Petugas: ".$cek_petugas['nama_petugas']);
mysqli_query($koneksi, "INSERT INTO tb_log_aktivitas (id_laporan, aksi, tanggal) VALUES ($id_laporan,'$aksi', NOW())");

$riwayat = [];
$riq = mysqli_query($koneksi,"SELECT aksi,keterangan,tanggal FROM tb_log_aktivitas WHERE id_laporan=$id_laporan ORDER BY tanggal ASC");
while($r = mysqli_fetch_assoc($riq)){
    $riwayat[] = $r;
}

$riwayat_html = '<ul class="timeline-laporan">';
foreach($riwayat as $r){
    $active_class = ($r['aksi']=='Diproses') ? 'active' : '';
    $riwayat_html .= '<li class="timeline-laporan-item '.$active_class.'">';
    $riwayat_html .= '<span class="timeline-laporan-content">'.htmlspecialchars($r['aksi']);
    if(!empty($r['keterangan'])) $riwayat_html .= ' - '.htmlspecialchars($r['keterangan']);
    $riwayat_html .= '</span> <span class="timeline-laporan-date">('.date('d M Y', strtotime($r['tanggal'])).')</span>';
    $riwayat_html .= '</li>';
}
$riwayat_html .= '</ul>';

echo json_encode([
    'success'=>true,
    'riwayat_html'=>$riwayat_html,
    'new_status'=>'Diproses'
]);
