<?php
session_start();
header('Content-Type: application/json');
include 'config/database.php';

// Fungsi ambil timeline berdasarkan id_laporan
function getTimeline($koneksi, $id_laporan) {
    if (!$id_laporan) return [];
    $stmt = $koneksi->prepare("
        SELECT aksi, keterangan, tanggal
        FROM tb_log_aktivitas
        WHERE id_laporan = ?
        ORDER BY tanggal ASC
    ");
    $stmt->bind_param("i", $id_laporan);
    $stmt->execute();
    $logs = $stmt->get_result()->fetch_all(MYSQLI_ASSOC) ?: [];

    // Mapping agar frontend bisa pakai
    $timeline = array_map(function($log) {
        $status = null;

        if (strpos($log['aksi'], 'Status') !== false) {
            if (preg_match('/diubah menjadi (.+)$/', $log['keterangan'], $m)) {
                $status = $m[1];
            }
        } elseif ($log['aksi'] === 'Input Laporan') {
            $status = 'Laporan Diterima';
        }

        return [
            'waktu' => $log['tanggal'],
            'status' => $status,
            'keterangan' => $log['keterangan'],
            'completed' => in_array($status, ['Menunggu','Diproses','Selesai'])
        ];
    }, $logs);

    return $timeline;
}

// Ambil laporan berdasarkan kode, nama, atau tanggal
$kode = $_GET['kode'] ?? '';
$nama = $_GET['nama'] ?? '';
$tanggal = $_GET['tanggal'] ?? '';

if ($kode) {
    $stmt = $koneksi->prepare("SELECT * FROM tb_laporan WHERE kode_laporan = ? LIMIT 1");
    $stmt->bind_param("s", $kode);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();

    if ($data) {
    $data['alamat'] = isset($data['alamat']) && $data['alamat'] ? $data['alamat'] : '-';
    $data['timeline'] = getTimeline($koneksi, $data['id_laporan']);
    $data['latitude'] = floatval($data['latitude'] ?? 0);
    $data['longitude'] = floatval($data['longitude'] ?? 0);
    }

    echo json_encode($data ?: []);
    exit;
}

if ($nama || $tanggal) {
    $params = [];
    $types = '';
    $query = "SELECT * FROM tb_laporan WHERE 1=1";

    if ($nama) {
        $query .= " AND nama_pelapor LIKE ?";
        $params[] = "%$nama%";
        $types .= 's';
    }
    if ($tanggal) {
        $query .= " AND DATE(tanggal_lapor) = ?";
        $params[] = $tanggal;
        $types .= 's';
    }

    $stmt = $koneksi->prepare($query);
    if ($params) $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    foreach ($rows as &$row) {
        $row['alamat'] = isset($row['alamat']) && $row['alamat'] ? $row['alamat'] : '-';
        $row['timeline'] = getTimeline($koneksi, $row['id_laporan']);
        $row['latitude'] = floatval($row['latitude'] ?? 0);
        $row['longitude'] = floatval($row['longitude'] ?? 0);
    }

    echo json_encode($rows);
    exit;
}

echo json_encode([]);
?>
