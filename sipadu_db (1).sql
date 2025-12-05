-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 05, 2025 at 04:39 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipadu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `jabatan` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `username`, `password`, `nama_lengkap`, `email`, `no_hp`, `jabatan`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$iDSwU/90HFtBa.M.HWVg..BLgQo643W/FSPdTwOCeIupuDLcmO2ja', 'Administrator BPBD', 'admin@bpbd.go.id', NULL, 'Administrator Sistem', NULL, '2025-12-02 20:47:23', '2025-12-05 02:53:13'),
(2, 'petugas1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Budi Santoso', 'budi@bpbd.go.id', NULL, 'Petugas Lapangan', NULL, '2025-12-02 20:47:23', '2025-12-02 20:47:23'),
(3, 'admin1', '751cb3f4aa17c36186f4856c8982bf27', 'Administrator BPBD', 'admin@bpbd.go.id', NULL, 'Administrator Sistem', NULL, '2025-12-02 20:52:17', '2025-12-02 20:52:17'),
(7, 'admin2', '$2y$10$Tbw4vlmGdQ6x8/Ryx1N73uKSDGpodcwVMByPCJ23ONpMImwzLfvce', 'Administrator BPBD', 'admin2@bpbd.go.id', NULL, 'Administrator Sistem', NULL, '2025-12-04 19:43:54', '2025-12-04 21:32:05'),
(10, 'admin3', '$2y$10$..twjEtm8.Eet01Lozz4teh./ITorzrR8tnYCHeNP4DjH4BpUU8Oe', 'Administrator BPBD', 'admin2@bpbd.go.id', NULL, 'Administrator Sistem', NULL, '2025-12-04 19:46:31', '2025-12-04 21:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_data_bencana`
--

CREATE TABLE `tb_data_bencana` (
  `id_data` int NOT NULL,
  `id_laporan` int DEFAULT NULL,
  `nama_aset` varchar(200) NOT NULL,
  `sektor` enum('Perumahan','Infrastruktur','Sosial','Ekonomi','Lintas Sektor') NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `alamat_detail` text,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `tingkat_kerusakan` enum('Ringan','Sedang','Berat','Hancur') NOT NULL,
  `jumlah_rusak` int DEFAULT '0',
  `satuan` varchar(50) DEFAULT NULL,
  `estimasi_kerugian` decimal(15,2) DEFAULT '0.00',
  `jumlah_korban_meninggal` int DEFAULT '0',
  `jumlah_korban_luka` int DEFAULT '0',
  `jumlah_pengungsi` int DEFAULT '0',
  `foto_dokumentasi` varchar(255) DEFAULT NULL,
  `keterangan` text,
  `petugas_input` varchar(100) DEFAULT NULL,
  `tanggal_input` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_data_bencana`
--

INSERT INTO `tb_data_bencana` (`id_data`, `id_laporan`, `nama_aset`, `sektor`, `provinsi`, `kabupaten`, `kecamatan`, `kelurahan`, `alamat_detail`, `latitude`, `longitude`, `tingkat_kerusakan`, `jumlah_rusak`, `satuan`, `estimasi_kerugian`, `jumlah_korban_meninggal`, `jumlah_korban_luka`, `jumlah_pengungsi`, `foto_dokumentasi`, `keterangan`, `petugas_input`, `tanggal_input`, `tanggal_update`) VALUES
(1, 1, 'Rumah Warga RT 05', 'Perumahan', 'DKI Jakarta', 'Jakarta Selatan', 'Cilandak', 'Sukamaju', NULL, -6.26150000, 106.81060000, 'Sedang', 25, 'Unit', 500000000.00, 0, 2, 75, NULL, 'Rumah terendam banjir, perlu pembersihan dan perbaikan', 'Budi Santoso', '2025-12-04 06:57:09', '2025-12-04 06:57:09'),
(2, 3, 'Kios Pasar Tegalsari', 'Ekonomi', 'Jawa Timur', 'Surabaya', 'Tegalsari', 'Tegalsari', NULL, -7.25750000, 112.75210000, 'Hancur', 5, 'Unit', 750000000.00, 0, 0, 0, NULL, 'Kios hangus terbakar, perlu dibangun ulang', 'Budi Santoso', '2025-12-04 06:57:09', '2025-12-04 06:57:09'),
(3, 1, 'Jalan Lingkungan RT 05', 'Infrastruktur', 'DKI Jakarta', 'Jakarta Selatan', 'Cilandak', 'Sukamaju', NULL, -6.26200000, 106.81100000, 'Ringan', 200, 'Meter', 100000000.00, 0, 0, 0, NULL, 'Jalan rusak akibat genangan air', 'Administrator BPBD', '2025-12-04 06:57:09', '2025-12-04 06:57:09');

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id_laporan` int NOT NULL,
  `kode_laporan` varchar(20) NOT NULL,
  `nama_pelapor` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `latitude` decimal(10,6) DEFAULT NULL,
  `longitude` decimal(10,6) DEFAULT NULL,
  `jenis_bencana` enum('Banjir','Gempa Bumi','Tanah Longsor','Kebakaran','Angin Puting Beliung','Tsunami','Gunung Meletus','Kekeringan','Lainnya') NOT NULL,
  `jenis_kerusakan` enum('Ringan','Sedang','Berat','Sangat Berat') NOT NULL,
  `deskripsi` text,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('Menunggu','Diproses','Selesai') NOT NULL DEFAULT 'Menunggu',
  `id_petugas` int DEFAULT NULL,
  `catatan_admin` text,
  `tanggal_lapor` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `tanggal_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_laporan`
--

INSERT INTO `tb_laporan` (`id_laporan`, `kode_laporan`, `nama_pelapor`, `no_hp`, `alamat`, `latitude`, `longitude`, `jenis_bencana`, `jenis_kerusakan`, `deskripsi`, `foto`, `status`, `id_petugas`, `catatan_admin`, `tanggal_lapor`, `tanggal_update`, `created_at`) VALUES
(1, 'LAP-2024-0001', 'Ahmad Wijaya', '081234567890', 'Jl. Merdeka No. 45, Kel. Sukamaju, Kec. Cilandak, Jakarta Selatan', -6.261500, 106.810600, 'Banjir', 'Sedang', 'Banjir setinggi 1 meter merendam permukiman warga sejak dini hari. Sekitar 50 rumah terdampak.', NULL, 'Menunggu', NULL, NULL, '2025-12-04 06:56:54', '2025-12-04 11:09:26', '2025-12-04 16:44:19'),
(2, 'LAP-2024-0002', 'Siti Rahayu', '082345678901', 'Jl. Pahlawan No. 12, Kel. Cibadak, Kec. Astanaanyar, Bandung', -6.927100, 107.613100, 'Tanah Longsor', 'Berat', 'Longsor terjadi akibat hujan deras semalam. 3 rumah tertimbun material longsor.', NULL, 'Menunggu', NULL, NULL, '2025-12-04 06:56:54', '2025-12-04 09:11:44', '2025-12-04 16:44:19'),
(3, 'LAP-2024-0003', 'Rizki Pratama', '083456789012', 'Jl. Diponegoro No. 78, Kel. Tegalsari, Kec. Tegalsari, Surabaya', -7.257500, 112.752100, 'Kebakaran', 'Berat', 'Kebakaran melanda 5 kios di pasar tradisional. Diduga akibat korsleting listrik.', NULL, 'Menunggu', NULL, NULL, '2025-12-04 06:56:54', '2025-12-04 11:09:34', '2025-12-04 16:44:19'),
(4, 'LAP-2024-0004', 'Dewi Lestari', '084567890123', 'Jl. Sudirman No. 100, Kel. Menteng, Kec. Menteng, Jakarta Pusat', -6.194400, 106.822900, 'Angin Puting Beliung', 'Ringan', 'Angin kencang merusak atap beberapa rumah warga. Tidak ada korban jiwa.', NULL, 'Diproses', NULL, NULL, '2025-12-04 06:56:54', '2025-12-04 06:56:54', '2025-12-04 16:44:19'),
(5, 'LAP-2024-0005', 'Hendra Gunawan', '085678901234', 'Jl. Asia Afrika No. 25, Kel. Braga, Kec. Sumur Bandung, Bandung', -6.917500, 107.619100, 'Gempa Bumi', 'Sedang', 'Gempa 5.2 SR menyebabkan retakan pada beberapa bangunan. Warga mengungsi ke lapangan.', NULL, 'Selesai', NULL, NULL, '2025-12-04 06:56:54', '2025-12-04 10:59:37', '2025-12-04 16:44:19'),
(6, 'LAP-2025-4176', 'bedul', '081216926985', 'kjbjsabdhjab', NULL, NULL, 'Angin Puting Beliung', 'Berat', 'pentil muter', NULL, 'Menunggu', NULL, NULL, '2025-12-04 09:12:20', '2025-12-04 09:12:20', '2025-12-04 16:44:19'),
(7, 'LAP-2025-1398', 'agus', '081216926985', 'hjbbjhasjhsa', NULL, NULL, 'Angin Puting Beliung', 'Ringan', 'pentil muter mendadak', NULL, 'Menunggu', NULL, NULL, '2025-12-04 09:14:42', '2025-12-04 09:14:42', '2025-12-04 16:44:19'),
(8, 'LAP-2025-3378', 'yonay', '081216926985', 'serpong', NULL, NULL, 'Tsunami', 'Ringan', 'tiba tiba tsunami', NULL, 'Diproses', NULL, NULL, '2025-12-04 09:17:35', '2025-12-04 17:17:46', '2025-12-04 16:44:19'),
(9, 'LAP-2025-1687', 'cuplis', '081216926985', 'kjsnfsufh', NULL, NULL, 'Lainnya', 'Sangat Berat', 'tiba tiba cewenya kabur', NULL, 'Diproses', NULL, NULL, '2025-12-04 09:21:24', '2025-12-04 11:09:07', '2025-12-04 16:44:19'),
(10, 'LAP-2025-4230', 'mamat', '081216926985', 'cipadu', -6.247087, 106.745210, 'Gunung Meletus', 'Sangat Berat', 'tiba tiba krakatau meledak', 'foto_1764841161.jpg', 'Diproses', 1, NULL, '2025-12-04 09:39:21', '2025-12-05 04:19:46', '2025-12-04 16:44:19'),
(11, 'LAP-2025-7408', 'dadang', '081216926985', 'sdfsfb', NULL, NULL, 'Banjir', 'Sedang', 'tibatiba banjir', NULL, 'Selesai', NULL, NULL, '2025-12-04 10:12:10', '2025-12-04 11:19:14', '2025-12-04 17:12:10'),
(13, 'LAP-2025-3697', 'memet', '081216926985', 'kfjsjdfbjs', -6.199706, 106.751590, 'Kebakaran', 'Berat', 'longsor ler', NULL, 'Diproses', NULL, NULL, '2025-12-04 11:28:29', '2025-12-04 20:11:34', '2025-12-04 18:28:29'),
(22, 'LAP-2025-3408', 'ageng', '081216926985', '0', -6.216090, 106.826957, 'Kebakaran', 'Berat', 'MENYALAAA', NULL, 'Diproses', NULL, NULL, '2025-12-04 14:23:36', '2025-12-04 14:23:53', '2025-12-04 21:23:36'),
(23, 'LAP-2025-8810', 'bambang', '081216926985', '0', -6.216090, 106.826957, 'Gunung Meletus', 'Sangat Berat', 'duar', NULL, 'Diproses', NULL, NULL, '2025-12-04 14:28:14', '2025-12-04 14:29:02', '2025-12-04 21:28:14'),
(24, 'LAP-2025-3626', 'kimak', '081216926985', '0', -6.216090, 106.826957, 'Gempa Bumi', 'Sedang', 'sjbsdfjk', NULL, 'Menunggu', NULL, NULL, '2025-12-04 14:32:16', '2025-12-04 14:32:16', '2025-12-04 21:32:16'),
(25, 'LAP-2025-6102', 'nasdang', '081216926985', '0', NULL, NULL, 'Gempa Bumi', 'Berat', 'jaf', NULL, 'Diproses', NULL, NULL, '2025-12-04 15:24:12', '2025-12-04 15:42:58', '2025-12-04 22:24:12'),
(33, 'LAP-2025-0876', 'aan', '081216926985', 'Jl. Merdeka No. 45, Kel. Sukamaju, Kec. Cilandak, Jakarta Selatan', -6.219366, 106.823680, 'Gempa Bumi', 'Sedang', 'sdsadjsakjdsadnalkdo', NULL, 'Selesai', NULL, NULL, '2025-12-04 16:34:49', '2025-12-05 03:19:06', '2025-12-04 23:34:49');

-- --------------------------------------------------------

--
-- Table structure for table `tb_log_aktivitas`
--

CREATE TABLE `tb_log_aktivitas` (
  `id_log` int NOT NULL,
  `id_admin` int DEFAULT NULL,
  `id_laporan` int DEFAULT NULL,
  `aksi` varchar(100) NOT NULL,
  `keterangan` text,
  `ip_address` varchar(50) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_log_aktivitas`
--

INSERT INTO `tb_log_aktivitas` (`id_log`, `id_admin`, `id_laporan`, `aksi`, `keterangan`, `ip_address`, `tanggal`) VALUES
(3, NULL, 11, 'Update Status', 'Status laporan #11 diubah menjadi Diproses', '::1', '2025-12-04 04:17:26'),
(4, NULL, 11, 'Update Status', 'Status laporan #11 diubah menjadi Selesai', '::1', '2025-12-04 04:19:14'),
(16, NULL, NULL, 'Input Laporan', 'Data laporan berhasil diinput', '::1', '2025-12-04 04:32:45'),
(17, NULL, NULL, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 04:37:33'),
(18, NULL, NULL, 'Update Status', 'Status laporan diubah menjadi Menunggu', '::1', '2025-12-04 04:40:33'),
(19, NULL, NULL, 'Update Status', 'Status laporan diubah menjadi Selesai', '::1', '2025-12-04 04:40:54'),
(20, NULL, NULL, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 04:56:08'),
(21, NULL, NULL, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 05:00:19'),
(22, NULL, NULL, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 05:55:47'),
(23, NULL, NULL, 'Update Status', 'Status laporan diubah menjadi Selesai', '::1', '2025-12-04 05:55:54'),
(24, NULL, NULL, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 06:44:54'),
(25, NULL, NULL, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 06:48:19'),
(26, NULL, NULL, 'Update Status', 'Status laporan diubah menjadi Menunggu', '::1', '2025-12-04 06:49:52'),
(27, NULL, NULL, 'Update Status', 'Status laporan diubah menjadi Selesai', '::1', '2025-12-04 06:54:30'),
(28, NULL, 5, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 06:59:04'),
(29, NULL, 5, 'Update Status', 'Status laporan diubah menjadi Menunggu', '::1', '2025-12-04 07:02:30'),
(31, NULL, 5, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 07:20:00'),
(32, NULL, 5, 'Update Status', 'Status laporan diubah menjadi Selesai', '::1', '2025-12-04 07:21:45'),
(33, NULL, 22, 'Input Laporan', 'Data laporan berhasil diinput', '::1', '2025-12-04 14:23:36'),
(34, NULL, 5, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 07:23:53'),
(35, NULL, 23, 'Input Laporan', 'Data laporan berhasil diinput', '::1', '2025-12-04 14:28:14'),
(36, NULL, 5, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 07:29:02'),
(37, NULL, 24, 'Input Laporan', 'Data laporan berhasil diinput', '::1', '2025-12-04 07:32:16'),
(38, NULL, 25, 'Input Laporan', 'Data laporan berhasil diinput', '::1', '2025-12-04 08:24:12'),
(40, NULL, NULL, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 08:30:35'),
(44, NULL, 25, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 08:42:58'),
(52, NULL, 33, 'Input Laporan', 'Data laporan berhasil diinput', '::1', '2025-12-04 09:34:49'),
(53, NULL, 33, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 09:35:37'),
(54, NULL, 33, 'Update Status', 'Status laporan diubah menjadi Selesai', '::1', '2025-12-04 12:50:09'),
(55, NULL, 33, 'Update Status', 'Status laporan diubah menjadi Menunggu', '::1', '2025-12-04 12:51:00'),
(56, NULL, 33, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 12:54:29'),
(57, NULL, 33, 'Update Status', 'Status laporan diubah menjadi Menunggu', '::1', '2025-12-04 12:55:01'),
(58, NULL, 33, 'Update Status', 'Status laporan diubah menjadi Selesai', '::1', '2025-12-04 12:56:50'),
(59, NULL, 33, 'Update Status', 'Status laporan diubah menjadi Menunggu', '::1', '2025-12-04 12:58:53'),
(60, NULL, 33, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 13:02:26'),
(61, NULL, 33, 'Update Status', 'Status laporan diubah menjadi Selesai', '::1', '2025-12-04 13:04:23'),
(62, NULL, 33, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 13:05:58'),
(63, NULL, 33, 'Update Status', 'Status laporan diubah menjadi Selesai', '::1', '2025-12-04 13:07:22'),
(64, NULL, 33, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 13:09:49'),
(65, NULL, 10, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 13:10:19'),
(66, NULL, 10, 'Update Status', 'Status laporan diubah menjadi Menunggu', '::1', '2025-12-04 13:10:45'),
(67, NULL, 13, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 13:11:34'),
(68, 10, 33, 'Update Status', 'Status laporan diubah menjadi Selesai', '::1', '2025-12-04 14:52:21'),
(69, 1, 33, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 20:18:12'),
(70, 1, 33, 'Update Status', 'Status laporan diubah menjadi Selesai', '::1', '2025-12-04 20:19:06'),
(71, 1, 33, 'Update Status', 'Status laporan diubah menjadi Selesai', '::1', '2025-12-04 20:28:08'),
(72, 1, 10, 'Update Status', 'Status laporan diubah menjadi Diproses', '::1', '2025-12-04 20:59:49'),
(73, NULL, 10, 'Menunggu', NULL, NULL, '2025-12-05 04:04:36'),
(74, NULL, 10, 'Selesai', NULL, NULL, '2025-12-05 04:04:42'),
(75, NULL, 10, 'Catatan', 'test', NULL, '2025-12-05 04:04:45'),
(76, NULL, 10, 'Menunggu', NULL, NULL, '2025-12-05 04:05:19'),
(77, NULL, 10, 'Catatan', 'testing', NULL, '2025-12-05 04:05:24'),
(78, NULL, 10, 'Ditugaskan ke Petugas: Budi Prasetyo', NULL, NULL, '2025-12-05 04:18:00'),
(79, NULL, 10, 'Menunggu', NULL, NULL, '2025-12-05 04:19:35'),
(80, NULL, 10, 'Catatan', 'otw', NULL, '2025-12-05 04:19:41'),
(81, NULL, 10, 'Ditugaskan ke Petugas: Andi Santoso', NULL, NULL, '2025-12-05 04:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `no_hp`, `created_at`) VALUES
(1, 'Andi Santoso', 'andi', 'ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f', '081234567890', '2025-12-05 04:09:50'),
(2, 'Budi Prasetyo', 'budi', 'ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f', '081234567891', '2025-12-05 04:09:50'),
(3, 'Citra Lestari', 'citra', 'ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f', '081234567892', '2025-12-05 04:09:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tb_data_bencana`
--
ALTER TABLE `tb_data_bencana`
  ADD PRIMARY KEY (`id_data`),
  ADD KEY `id_laporan` (`id_laporan`),
  ADD KEY `idx_data_tanggal` (`tanggal_input`),
  ADD KEY `idx_data_sektor` (`sektor`);

--
-- Indexes for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD UNIQUE KEY `kode_laporan` (`kode_laporan`),
  ADD KEY `idx_laporan_status` (`status`),
  ADD KEY `idx_laporan_tanggal` (`tanggal_lapor`),
  ADD KEY `idx_laporan_jenis` (`jenis_bencana`);

--
-- Indexes for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_data_bencana`
--
ALTER TABLE `tb_data_bencana`
  MODIFY `id_data` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id_laporan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_data_bencana`
--
ALTER TABLE `tb_data_bencana`
  ADD CONSTRAINT `tb_data_bencana_ibfk_1` FOREIGN KEY (`id_laporan`) REFERENCES `tb_laporan` (`id_laporan`) ON DELETE SET NULL;

--
-- Constraints for table `tb_log_aktivitas`
--
ALTER TABLE `tb_log_aktivitas`
  ADD CONSTRAINT `tb_log_aktivitas_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `tb_admin` (`id_admin`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
