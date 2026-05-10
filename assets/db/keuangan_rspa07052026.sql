-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2026 at 10:39 PM
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
(2, 'Kepala Desa'),
(3, 'Sekretariat'),
(4, 'RT'),
(5, 'RW'),
(6, 'Penduduk');

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
(12, 1, 12);

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
  `nama_kepala_desa` varchar(100) DEFAULT NULL,
  `nip_kepala_desa` varchar(50) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `nama_app`, `kecamatan`, `kabupaten`, `provinsi`, `alamat`, `kode_pos`, `telepon`, `email`, `website`, `nama_kepala_desa`, `nip_kepala_desa`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Bidang Keuangan RSPA', '-', 'Kabupaten Boyolali', 'Jawa Tengah', 'Jl. Raya Desa No. 1', NULL, NULL, NULL, NULL, 'Nama Kepala Desa', NULL, NULL, '2026-05-03 01:07:52', '2026-05-06 07:38:16');

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
(6, 4, 'Permohonan Kwitansi', 'kwitansi', 'fas fa-users', 1),
(7, 4, 'Daftar Permohonan', 'kwitansi/permohonan', 'fas fa-user-shield', 1);

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
(1, 'Administrator', 'admin', NULL, '$2y$10$iDRPyMj22lsf0YcYrTLhH.CR3gZqvr.PncMbyW6YDXDtu19Mq71pC', NULL, NULL, 1, 1, '2026-05-06 20:15:43', '2026-05-03 01:03:56', '2026-05-06 18:15:43', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submenus`
--
ALTER TABLE `submenus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `syslog_sinkron`
--
ALTER TABLE `syslog_sinkron`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
