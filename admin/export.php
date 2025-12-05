<?php
// export.php
require '../config/database.php'; // koneksi $koneksi
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php'); // autoload Composer

// Ambil parameter
$type   = $_GET['type'] ?? 'laporan';
$format = $_GET['format'] ?? 'csv';
$tgl_mulai = $_GET['tanggal_mulai'] ?? '';
$tgl_akhir = $_GET['tanggal_akhir'] ?? '';
$status    = $_GET['status'] ?? '';
$jenis     = $_GET['jenis'] ?? '';
$sektor    = $_GET['sektor'] ?? '';
$kerusakan = $_GET['kerusakan'] ?? '';

// Build query
if ($type === 'laporan') {
    $query = "SELECT kode_laporan AS kode, nama_pelapor AS pelapor, jenis_bencana AS jenis, alamat, latitude, longitude, jenis_kerusakan AS kerusakan, status, tanggal_lapor AS tanggal
              FROM tb_laporan WHERE 1";
    if ($tgl_mulai) $query .= " AND tanggal_lapor >= '$tgl_mulai'";
    if ($tgl_akhir) $query .= " AND tanggal_lapor <= '$tgl_akhir'";
    if ($status) $query .= " AND status = '$status'";
    if ($jenis) $query .= " AND jenis_bencana = '$jenis'";
} else { // pendataan
    $query = "SELECT kode_pendataan AS kode, nama_responden AS pelapor, sektor, lokasi, latitude, longitude, kerusakan, tanggal
              FROM tb_pendataan WHERE 1";
    if ($tgl_mulai) $query .= " AND tanggal >= '$tgl_mulai'";
    if ($tgl_akhir) $query .= " AND tanggal <= '$tgl_akhir'";
    if ($sektor) $query .= " AND sektor = '$sektor'";
    if ($kerusakan) $query .= " AND kerusakan = '$kerusakan'";
}

$result = mysqli_query($koneksi, $query);
if (!$result) die('Query Error: ' . mysqli_error($koneksi));

// === CSV ===
if ($format === 'csv') {
    $filename = "data-{$type}-" . date('Y-m-d') . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');
    $firstRow = mysqli_fetch_assoc($result);
    if ($firstRow) {
        fputcsv($output, array_keys($firstRow)); // header
        fputcsv($output, $firstRow); // baris pertama
    }
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

// === PDF ===
elseif ($format === 'pdf') {
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('SIPADU BPBD');
    $pdf->SetTitle("Export Data $type");
    $pdf->SetMargins(10, 10, 10);
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->AddPage();
    $pdf->SetFont('dejavusans', '', 10);

    $html = '<table border="1" cellpadding="4"><thead><tr>';

    // Ambil kolom dari row pertama
    $firstRow = mysqli_fetch_assoc($result);
    if ($firstRow) {
        foreach (array_keys($firstRow) as $col) {
            $html .= '<th>' . htmlspecialchars($col) . '</th>';
        }
        $html .= '</tr></thead><tbody>';

        $html .= '<tr>';
        foreach ($firstRow as $cell) {
            $html .= '<td>' . htmlspecialchars($cell) . '</td>';
        }
        $html .= '</tr>';
    }

    // Reset pointer untuk loop seluruh data
    mysqli_data_seek($result, 0);
    while ($row = mysqli_fetch_assoc($result)) {
        $html .= '<tr>';
        foreach ($row as $cell) {
            $html .= '<td>' . htmlspecialchars($cell) . '</td>';
        }
        $html .= '</tr>';
    }

    $html .= '</tbody></table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output("data-{$type}-" . date('Y-m-d') . ".pdf", 'D');
    exit;
}
