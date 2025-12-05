<?php
session_start();
header('Content-Type: application/json');
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

include 'config/database.php';

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

    $timeline = [];
    $last_status = null;

    foreach ($logs as $log) {
        $status = null;
        $keterangan = $log['keterangan'];

        if (strpos($log['aksi'], 'Status') !== false) {
            if (preg_match('/diubah menjadi (.+)$/', $keterangan, $m)) {
                $status = $m[1];
                $last_status = $status;
            }
        } 
        elseif (strpos($log['aksi'], 'Ditugaskan') !== false) {
            $status = $last_status ?: '-';
        } 
        elseif (strpos($log['aksi'], 'Catatan') !== false) {
            $status = $last_status ?: '-';
        } 
        elseif ($log['aksi'] === 'Input Laporan') {
            $status = 'Laporan Diterima';
            $last_status = $status;
        } else {
            $status = $last_status ?: '-';
        }

        if (strpos($log['aksi'], 'Ditugaskan') !== false) {
            $keterangan = $log['aksi']; // tampilkan "Ditugaskan ke Petugas: Nama"
        }

        $timeline[] = [
            'waktu' => $log['tanggal'],
            'status' => $status,
            'keterangan' => $keterangan,
            'completed' => in_array($status, ['Menunggu','Diproses','Selesai'])
        ];
    }

    return $timeline;
}


$kode = $_GET['kode'] ?? '';
$nama = $_GET['nama'] ?? '';
$tanggal = $_GET['tanggal'] ?? '';

try {
    if ($kode) {
        $stmt = $koneksi->prepare("SELECT * FROM tb_laporan WHERE kode_laporan = ? LIMIT 1");
        if (!$stmt) throw new Exception("Query gagal");
        $stmt->bind_param("s", $kode);
        $stmt->execute();
        $data = $stmt->get_result()->fetch_assoc();

        if ($data) {
            $data['alamat'] = $data['alamat'] ?: '-';
            $data['timeline'] = getTimeline($koneksi, $data['id_laporan']);
            $data['latitude'] = floatval($data['latitude'] ?? 0);
            $data['longitude'] = floatval($data['longitude'] ?? 0);
        }

        echo json_encode($data ?: new stdClass());
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
        if (!$stmt) throw new Exception("Query gagal");
        if ($params) $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $rows = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        foreach ($rows as &$row) {
            $row['alamat'] = $row['alamat'] ?: '-';
            $row['timeline'] = getTimeline($koneksi, $row['id_laporan']);
            $row['latitude'] = floatval($row['latitude'] ?? 0);
            $row['longitude'] = floatval($row['longitude'] ?? 0);
        }

        echo json_encode($rows ?: []);
        exit;
    }

    echo json_encode([]);
    exit;

} catch (Exception $e) {
    echo json_encode([]);
    exit;
}
?>
