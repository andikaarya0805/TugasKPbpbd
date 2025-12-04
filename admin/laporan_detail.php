<?php
session_start();
include '../config/database.php';

// Cek admin login (opsional, tapi disarankan)
if (!isset($_SESSION['id_admin'])) {
    header("Location: login.php");
    exit;
}

// Ambil ID dari query param, pastikan integer
$id_laporan = intval($_GET['id'] ?? 0);

// Cek ID valid
if ($id_laporan <= 0) {
    echo "ID laporan tidak valid!";
    exit;
}

// Ambil data laporan dari DB
$q = mysqli_query($koneksi, "SELECT * FROM tb_laporan WHERE id_laporan = $id_laporan");
$data = mysqli_fetch_assoc($q);

// Jika data tidak ditemukan
if (!$data) {
    echo "Data laporan tidak ditemukan!";
    exit;
}
?>

<h2>Detail Laporan</h2>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<div class="card">
    <div class="card-body">
        <p><strong>Kode:</strong> <?= htmlspecialchars($data['kode_laporan']) ?></p>
        <p><strong>Pelapor:</strong> <?= htmlspecialchars($data['nama_pelapor']) ?></p>
        <p><strong>Jenis Bencana:</strong> <?= htmlspecialchars($data['jenis_bencana']) ?></p>
        <p><strong>Lokasi:</strong> <?= htmlspecialchars($data['alamat'] ?? $data['lokasi']) ?></p>
        <p><strong>Koordinat:</strong> <?= htmlspecialchars($data['latitude']) ?>, <?= htmlspecialchars($data['longitude']) ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($data['status']) ?></p>

        <form action="laporan_update.php" method="POST">
            <input type="hidden" name="id" value="<?= $data['id_laporan'] ?>">

            <label>Status Baru</label>
            <select name="status" class="form-control" required>
                <?php
                $all_status = ['Menunggu', 'Diproses', 'Selesai'];
                foreach ($all_status as $status_option) {
                    $selected = ($data['status'] == $status_option) ? 'selected' : '';
                    echo '<option value="'.htmlspecialchars($status_option).'" '.$selected.'>'.htmlspecialchars($status_option).'</option>';
                }
                ?>
            </select>

            <button class="btn btn-success" style="margin-top:10px;">Update Status</button>
        </form>
    </div>
</div>
