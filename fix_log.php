<?php
include 'config/database.php';

// Ambil semua log yang id_laporan NULL
$result = $koneksi->query("SELECT * FROM tb_log_aktivitas WHERE id_laporan IS NULL ORDER BY tanggal ASC");

while ($row = $result->fetch_assoc()) {
    $id_log = $row['id_log'];
    $keterangan = $row['keterangan'];
    $tanggal_log = $row['tanggal'];
    $id_laporan = null;

    // Jika keterangan berisi 'Data laporan berhasil diinput', cari laporan terbaru sebelum log ini dibuat
    if (strpos($keterangan, 'Data laporan berhasil diinput') !== false) {
        $stmt = $koneksi->prepare("SELECT id_laporan FROM tb_laporan WHERE tanggal_lapor <= ? ORDER BY tanggal_lapor DESC LIMIT 1");
        $stmt->bind_param("s", $tanggal_log);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        if ($res) $id_laporan = $res['id_laporan'];
    }
    // Jika keterangan berisi 'Status laporan diubah menjadi ...'
    elseif (preg_match('/Status laporan diubah menjadi (\w+)/', $keterangan, $matches)) {
        $status_baru = $matches[1];
        $stmt = $koneksi->prepare("
            SELECT id_laporan FROM tb_laporan 
            WHERE tanggal_lapor <= ? 
            ORDER BY tanggal_lapor DESC LIMIT 1
        ");
        $stmt->bind_param("s", $tanggal_log);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();
        if ($res) $id_laporan = $res['id_laporan'];
    }

    if ($id_laporan) {
        $stmt = $koneksi->prepare("UPDATE tb_log_aktivitas SET id_laporan = ? WHERE id_log = ?");
        $stmt->bind_param("ii", $id_laporan, $id_log);
        $stmt->execute();
        echo "Log $id_log diperbaiki dengan id_laporan = $id_laporan\n";
    } else {
        echo "Log $id_log tidak bisa diidentifikasi: $keterangan\n";
    }
}

$koneksi->close();
?>
