<?php
$host     = "localhost";
$user     = "root";
$password = "";
$database = "sipadu_db"; // ganti sesuai nama database

$koneksi = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

mysqli_set_charset($koneksi, "utf8mb4");
?>
