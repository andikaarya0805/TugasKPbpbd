<?php
require __DIR__ . '/../config/database.php';
header('Content-Type: application/json');

// Ambil total berdasarkan jenis bencana
$q = $koneksi->query("
    SELECT jenis_bencana, COUNT(*) AS total 
    FROM tb_laporan 
    GROUP BY jenis_bencana
");

$data = [
    "Banjir" => 0,
    "Tanah Longsor" => 0,
    "Kebakaran" => 0,
    "Gempa Bumi" => 0,
    "Lainnya" => 0
];

while ($row = $q->fetch_assoc()) {
    $jenis = $row['jenis_bencana'];

    if (isset($data[$jenis])) {
        $data[$jenis] = (int)$row['total'];
    } else {
        // Kalau masuk kategori selain 4 utama → hitung sebagai "Lainnya"
        $data["Lainnya"] += (int)$row['total'];
    }
}

echo json_encode($data);
