-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2026 at 06:27 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `keuangan_rspa`
--

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `urutan` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `icon`, `urutan`, `is_active`, `created_at`) VALUES
(1, 'Dashboard', 'bi bi-speedometer', 1, 1, '2026-05-03 00:59:01'),
(2, 'Manajemen Pengguna', 'bi bi-people', 2, 1, '2026-05-03 00:59:01'),
(3, 'Profil Bidang', 'bi bi-bank', 3, 1, '2026-05-03 00:59:01'),
(4, 'Kwitansi', 'bi bi-card-text', 4, 1, '2026-05-03 00:59:01'),
(5, 'Informasi', 'bi bi-newspaper', 5, 0, '2026-05-03 00:59:01'),
(6, 'Sekretariat', 'bi bi-folder', 6, 0, '2026-05-03 00:59:01'),
(7, 'Administrasi Desa', 'bi bi-file-earmark', 7, 0, '2026-05-03 00:59:01'),
(8, 'Keuangan', 'bi bi-cash-stack', 8, 0, '2026-05-03 00:59:01'),
(9, 'Layanan Surat', 'bi bi-envelope', 9, 0, '2026-05-03 00:59:01'),
(10, 'Layanan Mandiri', 'bi bi-phone', 10, 0, '2026-05-03 00:59:01'),
(11, 'Pemetaan', 'bi bi-map', 11, 0, '2026-05-03 00:59:01'),
(12, 'Pengaturan', 'bi bi-gear', 12, 0, '2026-05-03 00:59:01');

-- --------------------------------------------------------

--
-- Table structure for table `permohonan_penghapusan`
--

CREATE TABLE `permohonan_penghapusan` (
  `id` int(11) NOT NULL,
  `kode_kwitansi` varchar(50) DEFAULT NULL,
  `kode_ttbayar` varchar(100) DEFAULT NULL,
  `no_kwitansi` varchar(50) DEFAULT NULL,
  `tanggal_kwitansi` datetime DEFAULT NULL,
  `total_bayar` decimal(18,2) DEFAULT NULL,
  `id_petugas` varchar(50) DEFAULT NULL,
  `alasan` text DEFAULT NULL,
  `status_pengajuan` varchar(20) DEFAULT 'pengajuan',
  `tanggal_pengajuan` datetime DEFAULT current_timestamp(),
  `created_by` varchar(50) DEFAULT NULL,
  `created_time` datetime DEFAULT current_timestamp(),
  `approved_by` varchar(50) DEFAULT NULL,
  `approved_time` datetime DEFAULT NULL,
  `keterangan_approval` text DEFAULT NULL,
  `KodeKunjungan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permohonan_penghapusan`
--

INSERT INTO `permohonan_penghapusan` (`id`, `kode_kwitansi`, `kode_ttbayar`, `no_kwitansi`, `tanggal_kwitansi`, `total_bayar`, `id_petugas`, `alasan`, `status_pengajuan`, `tanggal_pengajuan`, `created_by`, `created_time`, `approved_by`, `approved_time`, `keterangan_approval`, `KodeKunjungan`) VALUES
(8, 'B2673291626020022602001', 'B2673291626020022602001', 'B26020021', '2026-02-03 21:54:00', 260500.00, 'PTG24110001', 'Kesalah Entri Data', 'selesai', '2026-05-07 05:15:13', NULL, '2026-05-07 10:15:13', NULL, NULL, NULL, '267329162602002'),
(9, 'B2673190626010012601001', 'B2673190626010012601001', 'KWI2601001172', '2026-01-15 21:52:00', 155095.00, 'PTG15100025', 'Salah entri (Bejjo)', 'selesai', '2026-05-07 05:25:43', NULL, '2026-05-07 10:25:43', NULL, NULL, NULL, '267319062601001'),
(10, 'B2470495626010032601001', 'B2470495626010032601001', 'B26010130', '2026-01-14 19:27:00', 1124500.00, 'PTG15100025', 'Salah entri Data ', 'selesai', '2026-05-07 05:49:10', NULL, '2026-05-07 10:49:10', NULL, NULL, NULL, '247049562601003'),
(11, 'B1754989826010012601001', 'B1754989826010012601001', 'KWI2601001173', '2026-01-15 23:54:00', 449848.00, 'PTG15100025', 'tidak jadi periksa \ntabita', 'selesai', '2026-05-07 05:57:31', NULL, '2026-05-07 10:57:31', NULL, NULL, NULL, '175498982601001'),
(12, 'B2673338626020012602001', 'B2673338626020012602001', 'KWI2602000699', '2026-02-10 23:12:00', 158496.00, 'PTG24110001', 'Batal Periksa', 'selesai', '2026-05-07 07:08:32', NULL, '2026-05-07 12:08:32', NULL, NULL, NULL, '267333862602001'),
(13, 'B0724755026020022603001', 'B0724755026020022603001', 'B26030103', '2026-03-03 22:30:00', 536000.00, 'PTG20100002', 'Karena Salah', 'selesai', '2026-05-10 13:40:12', NULL, '2026-05-10 18:40:12', NULL, NULL, NULL, '072475502602002');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nama_role`) VALUES
(1, 'Administrator'),
(2, 'Visitor'),
(3, 'Kasir');

-- --------------------------------------------------------

--
-- Table structure for table `role_access_menu`
--

CREATE TABLE `role_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_access_submenu`
--

CREATE TABLE `role_access_submenu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `submenu_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_menu`
--

CREATE TABLE `role_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_menu`
--

INSERT INTO `role_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10),
(11, 1, 11),
(12, 1, 12),
(13, 2, 4),
(14, 3, 4),
(15, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `role_sub_menu`
--

CREATE TABLE `role_sub_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `sub_menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_sub_menu`
--

INSERT INTO `role_sub_menu` (`id`, `role_id`, `sub_menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 2, 7),
(9, 3, 6),
(10, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `nama_app` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `nama_kepala` varchar(100) DEFAULT NULL,
  `nip_kepala` varchar(50) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `nama_app`, `kecamatan`, `kabupaten`, `provinsi`, `alamat`, `kode_pos`, `telepon`, `email`, `website`, `nama_kepala`, `nip_kepala`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Bidang Keuangan RSPA', '-', 'Kabupaten Boyolali', 'Jawa Tengah', 'Jln. Kantil No.14, Pulisen, Boyolali, Jawa Tengah 57316', NULL, ' (0276) 321065 / 081', 'rsudpandanarang@gmail.com', 'https://rsudpandanarang.id/', 'Benny Danang K', '199407112023211007', NULL, '2026-05-03 01:07:52', '2026-05-10 10:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `submenus`
--

CREATE TABLE `submenus` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(150) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `urutan` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submenus`
--

INSERT INTO `submenus` (`id`, `menu_id`, `title`, `url`, `icon`, `urutan`, `is_active`) VALUES
(1, 1, 'Dashboard', 'dashboard', 'fas fa-home', 1, 1),
(2, 2, 'Data User', 'user', 'fas fa-user', 1, 1),
(3, 2, 'Role & Hak Akses', 'role', 'fas fa-user-shield', 2, 1),
(4, 4, 'Data Penduduk', 'penduduk', 'fas fa-users', 1, 1),
(5, 4, 'Kartu Keluarga', 'kk', 'fas fa-address-card', 2, 1),
(6, 4, 'Statistik', 'statistik', 'fas fa-chart-bar', 3, 1),
(7, 8, 'Penganggaran', 'keuangan/penganggaran', 'fas fa-wallet', 1, 1),
(8, 8, 'Realisasi', 'keuangan/realisasi', 'fas fa-chart-line', 2, 1),
(9, 8, 'SPJ', 'keuangan/spj', 'fas fa-file-invoice', 3, 1),
(10, 8, 'Laporan', 'keuangan/laporan', 'fas fa-file-pdf', 4, 1),
(11, 9, 'Template Surat', 'surat/template', 'fas fa-file', 1, 1),
(12, 9, 'Permintaan Surat', 'surat/permintaan', 'fas fa-envelope-open', 2, 1),
(13, 9, 'Arsip', 'surat/arsip', 'fas fa-archive', 3, 1),
(14, 4, 'Permohonan Kwitansi', 'kwitansi', 'fas fa-file-invoice', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'dashboard', 'fas fa-home', 1),
(2, 2, 'Data User', 'user', 'fas fa-users', 1),
(3, 2, 'Role User', 'role', 'fas fa-user-shield', 1),
(4, 3, 'Profil Bidang', 'profil', 'fas fa-landmark', 1),
(5, 12, 'Setting Website', 'setting', 'fas fa-cogs', 0),
(6, 4, 'Permohonan Kwitansi', 'kwitansi', 'fas fa-cogs', 1),
(7, 4, 'Daftar Permohonan', 'kwitansi/permohonan', 'fas fa-cogs', 1),
(8, 4, 'Batal Bayar BPD', 'kwitansi/batalbpd', 'fas fa-cogs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `syslog_sinkron`
--

CREATE TABLE `syslog_sinkron` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `aplikasi` varchar(100) DEFAULT NULL,
  `kegiatan` text DEFAULT NULL,
  `nomor` varchar(100) DEFAULT NULL,
  `petugas` varchar(50) DEFAULT NULL,
  `transaksi` int(11) DEFAULT 0,
  `id_permohonan_penghapusan` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `syslog_sinkron`
--

INSERT INTO `syslog_sinkron` (`id`, `kode`, `tanggal`, `aplikasi`, `kegiatan`, `nomor`, `petugas`, `transaksi`, `id_permohonan_penghapusan`, `created_at`) VALUES
(7, 'LOG2602020000', '2026-02-10 13:04:00', 'FTTindakan', 'Koreksi Detail Transaksi 267329162602002 kodepanggil ECGN', '26732916260200226020003', 'PTG15100022', 0, 8, '2026-05-07 10:16:02'),
(8, 'LOG2602020001', '2026-02-10 13:04:00', 'FTTindakan', 'Koreksi Detail Transaksi 267329162602002 kodepanggil ACATIN', '26732916260200226020027', 'PTG15100022', 0, 8, '2026-05-07 10:16:02'),
(9, 'LOG2602020002', '2026-02-10 13:05:00', 'FTTindakan', 'Koreksi Detail Transaksi 267329162602002 kodepanggil PJBK', '26732916260200226020028', 'PTG15100022', 0, 8, '2026-05-07 10:16:02'),
(10, 'LOG2602020003', '2026-02-10 13:05:00', 'FTTindakan', 'Koreksi Detail Transaksi 267329162602002 kodepanggil ECGN', '26732916260200226020029', 'PTG15100022', 0, 8, '2026-05-07 10:16:02'),
(11, 'LOG2602022312', '2026-02-11 09:43:00', 'FTBillBayar', 'Pemulangan Kunjungan Pasien No Kunjungan : 267329162602002', '267329162602002', 'PTG15100022', 0, 8, '2026-05-07 10:16:02'),
(12, 'LOG2602023931', '2026-02-11 15:01:00', 'FTAntrian', 'Verifikasi dan Pengisian Jaminan No Kunjungan 267329162602002', '267329162602002', 'PTG16060001', 0, 8, '2026-05-07 10:16:02'),
(13, 'LOG2602024899', '2026-02-12 07:30:00', 'FTStatusRM', 'Validasi Isian Status Medik Pasien Kode Kunjungan : 267329162602002', '267329162602002', 'PTG15080007', 0, 8, '2026-05-07 10:16:02'),
(14, 'LOG2601038561', '2026-01-15 21:52:00', 'FTBillBayar', 'Pemulangan Kunjungan Pasien No Kunjungan : 267319062601001', '267319062601001', 'PTG15100025', 0, 9, '2026-05-07 10:27:42'),
(15, 'LOG2601039235', '2026-01-17 08:09:00', 'FTStatusRM', 'Validasi Isian Status Medik Pasien Kode Kunjungan : 267319062601001', '267319062601001', 'PTG16070007', 0, 9, '2026-05-07 10:27:42'),
(16, 'LOG2601034931', '2026-01-14 14:30:00', 'FTTindakan', 'Koreksi Detail Transaksi 247049562601003 kodepanggil ASGZN', '24704956260100326010030', 'PTG15100022', 0, 10, '2026-05-07 10:49:53'),
(17, 'LOG2601034932', '2026-01-14 14:31:00', 'FTTindakan', 'Hapus Detail Transaksi 247049562601003 kodepanggil 1150800141508000115080001', '24704956260100326010012', 'PTG15100022', 0, 10, '2026-05-07 10:49:53'),
(18, 'LOG2601034933', '2026-01-14 14:31:00', 'FTTindakan', 'Koreksi Detail Transaksi 247049562601003 kodepanggil PSOXN', '24704956260100326010031', 'PTG15100022', 0, 10, '2026-05-07 10:49:53'),
(19, 'LOG2601034934', '2026-01-14 14:32:00', 'FTTindakan', 'Koreksi Detail Transaksi 247049562601003 kodepanggil TAOL6', '24704956260100326010033', 'PTG15100022', 0, 10, '2026-05-07 10:49:53'),
(20, 'LOG2601034935', '2026-01-14 14:32:00', 'FTTindakan', 'Koreksi Detail Transaksi 247049562601003 kodepanggil ATMOL6', '24704956260100326010034', 'PTG15100022', 0, 10, '2026-05-07 10:49:53'),
(21, 'LOG2601034936', '2026-01-14 14:33:00', 'FTTindakan', 'Koreksi Detail Transaksi 247049562601003 kodepanggil TMNOL6', '24704956260100326010035', 'PTG15100022', 0, 10, '2026-05-07 10:49:54'),
(22, 'LOG2601034937', '2026-01-14 14:33:00', 'FTTindakan', 'Koreksi Detail Transaksi 247049562601003 kodepanggil ASKRI N', '24704956260100326010036', 'PTG15100022', 0, 10, '2026-05-07 10:49:54'),
(23, 'LOG2601034939', '2026-01-14 14:33:00', 'FTTindakan', 'Koreksi Detail Transaksi 247049562601003 kodepanggil ASKRI N', '24704956260100326010037', 'PTG15100022', 0, 10, '2026-05-07 10:49:54'),
(24, 'LOG2601034941', '2026-01-14 14:33:00', 'FTTindakan', 'Hapus Detail Transaksi 247049562601003 kodepanggil 13150800011508000115080004', '24704956260100326010010', 'PTG15100022', 0, 10, '2026-05-07 10:49:54'),
(25, 'LOG2601035234', '2026-01-14 15:51:00', 'FTBillBayar', 'Pemulangan Kunjungan Pasien No Kunjungan : 247049562601003', '247049562601003', 'PTG15100022', 0, 10, '2026-05-07 10:49:54'),
(26, 'LOG2601036642', '2026-01-15 08:52:00', 'FTAntrian', 'Verifikasi dan Pengisian Jaminan No Kunjungan 247049562601003', '247049562601003', 'PTG16060001', 0, 10, '2026-05-07 10:49:54'),
(27, 'LOG2601058903', '2026-01-26 08:54:00', 'FTStatusRM', 'Validasi Isian Status Medik Pasien Kode Kunjungan : 247049562601003', '247049562601003', 'PTG23020001', 0, 10, '2026-05-07 10:49:54'),
(28, 'LOG2601038574', '2026-01-15 23:55:00', 'FTBillBayar', 'Pemulangan Kunjungan Pasien No Kunjungan : 175498982601001', '175498982601001', 'PTG15100025', 0, 11, '2026-05-07 10:59:17'),
(29, 'LOG2601039286', '2026-01-17 08:19:00', 'FTStatusRM', 'Validasi Isian Status Medik Pasien Kode Kunjungan : 175498982601001', '175498982601001', 'PTG16070007', 0, 11, '2026-05-07 10:59:17'),
(30, 'LOG2602026140', '2026-02-12 11:55:00', 'FTStatusRM', 'Validasi Isian Status Medik Pasien Kode Kunjungan : 267333862602001', '267333862602001', 'PTG16070007', 0, 12, '2026-05-07 12:10:21'),
(31, 'LOG2602021510', '2026-02-10 23:13:00', 'FTBillBayar', 'Pemulangan Kunjungan Pasien No Kunjungan : 267333862602001', '267333862602001', 'PTG24110001', 0, 12, '2026-05-07 12:10:21'),
(32, 'LOG2603000004', '2026-03-01 00:08:00', 'FTTindakan', 'Hapus Detail Transaksi 072475502602002 kodepanggil 1211000012207003322070001', '07247550260200226030009', 'PTG17080012', 0, 13, '2026-05-10 18:40:33'),
(33, 'LOG2603000005', '2026-03-01 00:08:00', 'FTTindakan', 'Hapus Detail Transaksi 072475502602002 kodepanggil 1211000012207003322070001', '07247550260200226030007', 'PTG17080012', 0, 13, '2026-05-10 18:40:33'),
(34, 'LOG2603004456', '2026-03-03 00:12:00', 'FTTindakan', 'Koreksi Detail Transaksi 072475502602002 kodepanggil VAIN', '07247550260200226030047', 'PTG17080012', 0, 13, '2026-05-10 18:40:33');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `penduduk_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `no_hp`, `foto`, `role_id`, `is_active`, `last_login`, `created_at`, `updated_at`, `penduduk_id`) VALUES
(1, 'Administrator', 'admin', NULL, '$2y$10$iDRPyMj22lsf0YcYrTLhH.CR3gZqvr.PncMbyW6YDXDtu19Mq71pC', NULL, NULL, 1, 1, '2026-05-10 18:17:43', '2026-05-03 01:03:56', '2026-05-10 16:17:43', NULL),
(4, 'visitor', 'visitor', 'visitor@rspa.com', '$2y$10$PYvWBYBrt7OM3q8Z1dGqxOFrhesSxvm3X4UhNJygWByww5lHWjI0a', '08888888888', NULL, 2, 1, '2026-05-07 05:26:43', '2026-05-06 18:16:54', '2026-05-07 03:26:43', NULL),
(5, 'kasir', 'kasir', 'kasir@rspa.com', '$2y$10$5PafMfufi8zqtGJfwsoVoOEgoDtIucbC/26U7kWNXEMYA78hJQJxa', '08888888888', NULL, 3, 1, '2026-05-07 05:24:30', '2026-05-06 18:18:54', '2026-05-07 03:24:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `user_agent` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permohonan_penghapusan`
--
ALTER TABLE `permohonan_penghapusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_access_menu`
--
ALTER TABLE `role_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `role_access_submenu`
--
ALTER TABLE `role_access_submenu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `submenu_id` (`submenu_id`);

--
-- Indexes for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_sub_menu`
--
ALTER TABLE `role_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenus`
--
ALTER TABLE `submenus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `syslog_sinkron`
--
ALTER TABLE `syslog_sinkron`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permohonan_penghapusan`
--
ALTER TABLE `permohonan_penghapusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role_access_menu`
--
ALTER TABLE `role_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_access_submenu`
--
ALTER TABLE `role_access_submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_menu`
--
ALTER TABLE `role_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `role_sub_menu`
--
ALTER TABLE `role_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submenus`
--
ALTER TABLE `submenus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `syslog_sinkron`
--
ALTER TABLE `syslog_sinkron`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_access_menu`
--
ALTER TABLE `role_access_menu`
  ADD CONSTRAINT `role_access_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_access_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`);

--
-- Constraints for table `role_access_submenu`
--
ALTER TABLE `role_access_submenu`
  ADD CONSTRAINT `role_access_submenu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_access_submenu_ibfk_2` FOREIGN KEY (`submenu_id`) REFERENCES `submenus` (`id`);

--
-- Constraints for table `submenus`
--
ALTER TABLE `submenus`
  ADD CONSTRAINT `submenus_ibfk_1` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
