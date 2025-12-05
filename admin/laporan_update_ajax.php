<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['id_admin'])) {
    echo json_encode(['success' => false, 'message' => 'Anda belum login']);
    exit;
}

$id = intval($_POST['id'] ?? 0);
$status = $_POST['status'] ?? '';

if(!$id || !$status){
    echo json_encode(['success' => false, 'message' => 'Data tidak valid']);
    exit;
}

mysqli_query($koneksi, "UPDATE tb_laporan SET status = '".mysqli_real_escape_string($koneksi,$status)."' WHERE id_laporan = $id");

mysqli_query($koneksi, "INSERT INTO tb_log_aktivitas (id_laporan, aksi, tanggal) VALUES ($id, '".mysqli_real_escape_string($koneksi,$status)."', NOW())");

$riq = mysqli_query($koneksi, "SELECT aksi, keterangan, tanggal FROM tb_log_aktivitas WHERE id_laporan = $id ORDER BY tanggal ASC");
$riwayat_html = '<ul class="timeline-laporan">';
while($r = mysqli_fetch_assoc($riq)){
    $active = ($r['aksi'] == $status) ? 'active' : '';
    $riwayat_html .= '<li class="timeline-laporan-item '.$active.'">
        <span class="timeline-laporan-content">'.htmlspecialchars($r['aksi']).(!empty($r['keterangan']) ? ' - '.htmlspecialchars($r['keterangan']) : '').'</span>
        <span class="timeline-laporan-date">('.(!empty($r['tanggal']) ? date('d M Y', strtotime($r['tanggal'])) : '—').')</span>
    </li>';
}
$riwayat_html .= '</ul>';

echo json_encode([
    'success' => true,
    'new_status' => $status,
    'riwayat_html' => $riwayat_html
]);
