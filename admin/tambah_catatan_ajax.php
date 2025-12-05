<?php
session_start();
include '../config/database.php';

if(!isset($_SESSION['id_admin'])){
    echo json_encode(['success'=>false,'message'=>'Belum login']);
    exit;
}

$id = intval($_POST['id'] ?? 0);
$catatan = trim($_POST['catatan'] ?? '');

if(!$id || !$catatan){
    echo json_encode(['success'=>false,'message'=>'Data tidak valid']);
    exit;
}

mysqli_query($koneksi,"INSERT INTO tb_log_aktivitas (id_laporan, aksi, keterangan, tanggal) VALUES ($id,'Catatan','$catatan',NOW())");

$riq = mysqli_query($koneksi,"SELECT aksi,keterangan,tanggal FROM tb_log_aktivitas WHERE id_laporan=$id ORDER BY tanggal ASC");
$riwayat_html = '<ul class="timeline-laporan">';
while($r=mysqli_fetch_assoc($riq)){
    $active = ($r['aksi'] != 'Catatan' && $r['aksi'] == mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT status FROM tb_laporan WHERE id_laporan=$id"))['status']) ? 'active' : '';
    $riwayat_html .= '<li class="timeline-laporan-item '.$active.'">
        <span class="timeline-laporan-content">'.htmlspecialchars($r['aksi']).(!empty($r['keterangan']) ? ' - '.htmlspecialchars($r['keterangan']) : '').'</span>
        <span class="timeline-laporan-date">('.(!empty($r['tanggal']) ? date('d M Y', strtotime($r['tanggal'])) : '—').')</span>
    </li>';
}
$riwayat_html .= '</ul>';

echo json_encode(['success'=>true,'riwayat_html'=>$riwayat_html]);
