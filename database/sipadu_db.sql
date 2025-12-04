-- =====================================================
-- SIPADU - Sistem Pendataan Bencana Terpadu
-- Database Schema untuk MySQL
-- =====================================================

CREATE DATABASE IF NOT EXISTS sipadu_db;
USE sipadu_db;

-- Tabel Admin
CREATE TABLE tb_admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    no_hp VARCHAR(20),
    jabatan VARCHAR(100),
    foto VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Laporan Bencana
CREATE TABLE tb_laporan (
    id_laporan INT AUTO_INCREMENT PRIMARY KEY,
    kode_laporan VARCHAR(20) NOT NULL UNIQUE,
    nama_pelapor VARCHAR(100) NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    alamat TEXT NOT NULL,
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    jenis_bencana ENUM('Banjir', 'Gempa Bumi', 'Tanah Longsor', 'Kebakaran', 'Angin Puting Beliung', 'Tsunami', 'Gunung Meletus', 'Kekeringan', 'Lainnya') NOT NULL,
    jenis_kerusakan ENUM('Ringan', 'Sedang', 'Berat', 'Sangat Berat') NOT NULL,
    deskripsi TEXT,
    foto VARCHAR(255),
    status ENUM('Baru', 'Diproses', 'Selesai') DEFAULT 'Baru',
    catatan_admin TEXT,
    tanggal_lapor TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tanggal_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabel Data Bencana (Pendataan Lapangan)
CREATE TABLE tb_data_bencana (
    id_data INT AUTO_INCREMENT PRIMARY KEY,
    id_laporan INT,
    nama_aset VARCHAR(200) NOT NULL,
    sektor ENUM('Perumahan', 'Infrastruktur', 'Sosial', 'Ekonomi', 'Lintas Sektor') NOT NULL,
    provinsi VARCHAR(100) NOT NULL,
    kabupaten VARCHAR(100) NOT NULL,
    kecamatan VARCHAR(100) NOT NULL,
    kelurahan VARCHAR(100),
    alamat_detail TEXT,
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    tingkat_kerusakan ENUM('Ringan', 'Sedang', 'Berat', 'Hancur') NOT NULL,
    jumlah_rusak INT DEFAULT 0,
    satuan VARCHAR(50),
    estimasi_kerugian DECIMAL(15, 2) DEFAULT 0,
    jumlah_korban_meninggal INT DEFAULT 0,
    jumlah_korban_luka INT DEFAULT 0,
    jumlah_pengungsi INT DEFAULT 0,
    foto_dokumentasi VARCHAR(255),
    keterangan TEXT,
    petugas_input VARCHAR(100),
    tanggal_input TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tanggal_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_laporan) REFERENCES tb_laporan(id_laporan) ON DELETE SET NULL
);

-- Tabel Log Aktivitas
CREATE TABLE tb_log_aktivitas (
    id_log INT AUTO_INCREMENT PRIMARY KEY,
    id_admin INT,
    aksi VARCHAR(100) NOT NULL,
    keterangan TEXT,
    ip_address VARCHAR(50),
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_admin) REFERENCES tb_admin(id_admin) ON DELETE SET NULL
);

-- Insert Data Admin Default
INSERT INTO tb_admin (username, password, nama_lengkap, email, jabatan) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator BPBD', 'admin@bpbd.go.id', 'Administrator Sistem'),
('petugas1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Budi Santoso', 'budi@bpbd.go.id', 'Petugas Lapangan');
-- Password default: password

-- Insert Data Dummy Laporan
INSERT INTO tb_laporan (kode_laporan, nama_pelapor, no_hp, alamat, latitude, longitude, jenis_bencana, jenis_kerusakan, deskripsi, status) VALUES
('LAP-2024-0001', 'Ahmad Wijaya', '081234567890', 'Jl. Merdeka No. 45, Kel. Sukamaju, Kec. Cilandak, Jakarta Selatan', -6.2615, 106.8106, 'Banjir', 'Sedang', 'Banjir setinggi 1 meter merendam permukiman warga sejak dini hari. Sekitar 50 rumah terdampak.', 'Diproses'),
('LAP-2024-0002', 'Siti Rahayu', '082345678901', 'Jl. Pahlawan No. 12, Kel. Cibadak, Kec. Astanaanyar, Bandung', -6.9271, 107.6131, 'Tanah Longsor', 'Berat', 'Longsor terjadi akibat hujan deras semalam. 3 rumah tertimbun material longsor.', 'Baru'),
('LAP-2024-0003', 'Rizki Pratama', '083456789012', 'Jl. Diponegoro No. 78, Kel. Tegalsari, Kec. Tegalsari, Surabaya', -7.2575, 112.7521, 'Kebakaran', 'Berat', 'Kebakaran melanda 5 kios di pasar tradisional. Diduga akibat korsleting listrik.', 'Selesai'),
('LAP-2024-0004', 'Dewi Lestari', '084567890123', 'Jl. Sudirman No. 100, Kel. Menteng, Kec. Menteng, Jakarta Pusat', -6.1944, 106.8229, 'Angin Puting Beliung', 'Ringan', 'Angin kencang merusak atap beberapa rumah warga. Tidak ada korban jiwa.', 'Diproses'),
('LAP-2024-0005', 'Hendra Gunawan', '085678901234', 'Jl. Asia Afrika No. 25, Kel. Braga, Kec. Sumur Bandung, Bandung', -6.9175, 107.6191, 'Gempa Bumi', 'Sedang', 'Gempa 5.2 SR menyebabkan retakan pada beberapa bangunan. Warga mengungsi ke lapangan.', 'Baru');

-- Insert Data Dummy Pendataan
INSERT INTO tb_data_bencana (id_laporan, nama_aset, sektor, provinsi, kabupaten, kecamatan, kelurahan, latitude, longitude, tingkat_kerusakan, jumlah_rusak, satuan, estimasi_kerugian, jumlah_korban_luka, jumlah_pengungsi, keterangan, petugas_input) VALUES
(1, 'Rumah Warga RT 05', 'Perumahan', 'DKI Jakarta', 'Jakarta Selatan', 'Cilandak', 'Sukamaju', -6.2615, 106.8106, 'Sedang', 25, 'Unit', 500000000, 2, 75, 'Rumah terendam banjir, perlu pembersihan dan perbaikan', 'Budi Santoso'),
(3, 'Kios Pasar Tegalsari', 'Ekonomi', 'Jawa Timur', 'Surabaya', 'Tegalsari', 'Tegalsari', -7.2575, 112.7521, 'Hancur', 5, 'Unit', 750000000, 0, 0, 'Kios hangus terbakar, perlu dibangun ulang', 'Budi Santoso'),
(1, 'Jalan Lingkungan RT 05', 'Infrastruktur', 'DKI Jakarta', 'Jakarta Selatan', 'Cilandak', 'Sukamaju', -6.2620, 106.8110, 'Ringan', 200, 'Meter', 100000000, 0, 0, 'Jalan rusak akibat genangan air', 'Administrator BPBD');

-- Index untuk optimasi query
CREATE INDEX idx_laporan_status ON tb_laporan(status);
CREATE INDEX idx_laporan_tanggal ON tb_laporan(tanggal_lapor);
CREATE INDEX idx_laporan_jenis ON tb_laporan(jenis_bencana);
CREATE INDEX idx_data_tanggal ON tb_data_bencana(tanggal_input);
CREATE INDEX idx_data_sektor ON tb_data_bencana(sektor);
