<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

// Ambil data dari form
$nama = trim($_POST['nama_pelapor'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$latitude  = isset($_POST['latitude']) && $_POST['latitude'] !== '' ? trim($_POST['latitude']) : null;
$longitude = isset($_POST['longitude']) && $_POST['longitude'] !== '' ? trim($_POST['longitude']) : null;
$jenis_bencana = trim($_POST['jenis_bencana'] ?? '');
$jenis_kerusakan = trim($_POST['jenis_kerusakan'] ?? '-');
$deskripsi = trim($_POST['deskripsi'] ?? '');

// Handle upload foto
$fotoName = null;
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
    if (!is_dir("uploads")) mkdir("uploads", 0777, true);
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $fotoName = "foto_" . time() . "." . $ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], "uploads/" . $fotoName);
}

// Generate kode laporan
$kode_laporan = "LAP-" . date("Y") . "-" . str_pad(rand(0, 9999), 4, "0", STR_PAD_LEFT);

// ==============================
// INSERT DATA KE tb_laporan
// ==============================
$stmt = $koneksi->prepare("
    INSERT INTO tb_laporan 
    (kode_laporan, nama_pelapor, no_hp, alamat, latitude, longitude,
     jenis_bencana, jenis_kerusakan, deskripsi, foto, status)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Menunggu')
");

// Bind semua sebagai string, latitude/longitude pakai NULL jika kosong
$stmt->bind_param(
    "ssssssssss",
    $kode_laporan,
    $nama,
    $no_hp,
    $alamat,
    $latitude,
    $longitude,
    $jenis_bencana,
    $jenis_kerusakan,
    $deskripsi,
    $fotoName
);

if (!$stmt->execute()) {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
    exit;
}

$id_laporan = $koneksi->insert_id;

// ==============================
// INSERT LOG AKTIVITAS
// ==============================
$aksi = "Input Laporan";
$keterangan = "Data laporan berhasil diinput";
$id_admin = null; // user biasa
$ip_address = $_SERVER['REMOTE_ADDR'] ?? '';
$tanggal = date('Y-m-d H:i:s');

$stmt2 = $koneksi->prepare("
    INSERT INTO tb_log_aktivitas (id_admin, id_laporan, aksi, keterangan, ip_address, tanggal) 
    VALUES (?, ?, ?, ?, ?, ?)
");

// Bind id_admin sebagai NULL jika kosong
$id_admin_param = $id_admin;
$stmt2->bind_param("iissss", $id_admin_param, $id_laporan, $aksi, $keterangan, $ip_address, $tanggal);

if (!$stmt2->execute()) {
    echo json_encode(['success' => false, 'message' => $stmt2->error]);
    exit;
}

$stmt2->close();
$stmt->close();
$koneksi->close();

echo json_encode(['success' => true, 'kode' => $kode_laporan]);
?>
