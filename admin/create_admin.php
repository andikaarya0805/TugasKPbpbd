<?php
// config
include '../config/database.php';

// user baru
$username = 'admin3';
$password = 'admin123';
$nama_lengkap = 'Administrator BPBD';
$email = 'admin2@bpbd.go.id';
$jabatan = 'Administrator Sistem';

// hash password
$hashPassword = password_hash($password, PASSWORD_BCRYPT);

// hapus user lama kalau ada
$stmtDelete = $koneksi->prepare("DELETE FROM tb_admin WHERE username = ?");
$stmtDelete->bind_param("s", $username);
$stmtDelete->execute();

// insert user baru
$stmtInsert = $koneksi->prepare("INSERT INTO tb_admin (username, password, nama_lengkap, email, jabatan, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())");
$stmtInsert->bind_param("sssss", $username, $hashPassword, $nama_lengkap, $email, $jabatan);

if ($stmtInsert->execute()) {
    echo "Admin baru '$username' berhasil dibuat dengan password '$password'.";
} else {
    echo "Gagal membuat admin baru: " . $stmtInsert->error;
}
?>
