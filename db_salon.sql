-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2023 at 11:07 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2023_02_20_045959_create_properties_table', 1),
(3, '2023_02_23_074432_create_transaksi_table', 2),
(4, '2023_02_23_074432_create_keranjang_table', 3),
(6, '2014_10_12_000000_create_users_table', 4),
(7, '2023_03_09_051921_create_info_web_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) NOT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `modal` int(200) DEFAULT NULL,
  `harga` int(200) DEFAULT NULL,
  `jumlah` int(200) DEFAULT NULL,
  `sisa` int(200) DEFAULT NULL,
  `notif` int(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`id`, `nama`, `img`, `jenis`, `supplier`, `modal`, `harga`, `jumlah`, `sisa`, `notif`, `created_at`, `updated_at`) VALUES
(1, 'Shampo', NULL, 'Barang', 'blackmarket', 2500, 3500, 18, 292, 0, '2023-02-19 07:30:01', '2023-03-30 01:55:42'),
(5, 'Shampoo', '1679892353.jpg', 'Barang', 'PT Jaya Utama Santikah', 2000, 3000, 6, 5, 1, '2023-02-20 09:10:06', '2023-03-30 01:55:42'),
(6, 'v v', '1679892345.jpg', 'Barang', 'PT. Haecho Cell Beautque Manis', 231, 14, 312, 31, 0, '2023-02-20 09:42:54', '2023-03-26 21:45:45'),
(13, 'sabun kan', '1679892338.jpg', 'Barang', 'PT Jaya Utama Santikah', 20200, 22000, 329, 391, 0, '2023-02-21 23:49:49', '2023-03-30 01:55:42'),
(14, 'Keramas', '', 'Jasa', NULL, NULL, 10000, 13, NULL, 0, '2023-02-24 02:55:37', '2023-03-30 01:55:42'),
(15, 'Keramas Laki', '', 'Jasa', NULL, NULL, 25000, 57, NULL, 0, '2023-02-25 03:47:35', '2023-03-30 01:55:42'),
(16, '23asd', '1679892329.jpg', 'Barang', 'PT Anugerah Inovasi Sejahtera', 1000, 1500, 20, 180, 0, '2023-03-04 12:01:34', '2023-03-30 01:55:42'),
(17, 'Masker Jeruk', '1679892323.jpg', 'Barang', 'PT Jaya Utama Santikah', 2000, 3000, 9, 10, 1, '2023-03-09 05:02:44', '2023-03-30 01:58:31'),
(18, 'Bando', '', 'Barang', 'PT Jaya Utama Santikah', 5000, 5500, 1, 0, 1, '2023-03-30 01:43:57', '2023-03-30 01:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info_web`
--

CREATE TABLE `tbl_info_web` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_web` varchar(255) DEFAULT NULL,
  `icon_web` varchar(255) DEFAULT NULL,
  `loginscreen_web` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `sosmed` varchar(255) DEFAULT NULL,
  `cabang` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_info_web`
--

INSERT INTO `tbl_info_web` (`id`, `nama_web`, `icon_web`, `loginscreen_web`, `alamat`, `sosmed`, `cabang`, `created_at`, `updated_at`) VALUES
(1, 'Salon X', '1678345803.png', '1678345815.png', 'Jl. Bandung No. 99', 'IG: @salon_x', 'Bandung Gatsu', '2023-03-09 06:02:45', '2023-03-30 01:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_keranjang`
--

INSERT INTO `tbl_keranjang` (`id`, `id_barang`, `id_pegawai`, `jumlah`, `total`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 17, 1, 1, 3000, NULL, '2023-03-29 23:07:08', '2023-03-29 23:07:08'),
(2, 15, 1, 1, 25000, NULL, '2023-03-29 23:24:57', '2023-03-29 23:24:57'),
(3, 5, 1, 1, 3000, NULL, '2023-03-29 23:25:18', '2023-03-29 23:25:18'),
(4, 13, 1, 2, 44000, NULL, '2023-03-29 23:34:30', '2023-03-29 23:34:30'),
(5, 14, 1, 1, 10000, NULL, '2023-03-30 00:03:45', '2023-03-30 00:03:45'),
(6, 16, 1, 1, 1500, NULL, '2023-03-30 00:53:01', '2023-03-30 00:53:01'),
(7, 1, 1, 1, 3500, NULL, '2023-03-30 00:53:13', '2023-03-30 00:53:13'),
(8, 16, 1, 1, 1500, NULL, '2023-03-30 00:53:29', '2023-03-30 00:53:29'),
(9, 18, 1, 1, 5500, NULL, '2023-03-30 01:55:36', '2023-03-30 01:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_barang` bigint(20) NOT NULL,
  `jumlah` int(40) NOT NULL,
  `total_harga` int(40) NOT NULL,
  `laba` int(40) NOT NULL,
  `id_pegawai` int(40) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`id`, `id_barang`, `jumlah`, `total_harga`, `laba`, `id_pegawai`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 13, 2, 44000, 3600, 1, 'bundle', '2023-02-22 17:26:53', '2023-02-22 17:26:53'),
(4, 14, 1, 10000, 10000, 1, 'test keterangan', '2023-02-25 01:18:20', '2023-02-25 01:18:20'),
(5, 15, 2, 50000, 50000, 1, 'test keterangan', '2023-02-25 03:48:41', '2023-02-25 03:48:41'),
(6, 15, 2, 50000, 50000, 1, 'test keterangan', '2023-02-26 21:46:09', '2023-02-26 21:46:09'),
(7, 15, 2, 50000, 50000, 1, 'test keterangan', '2023-02-26 21:48:14', '2023-02-26 21:48:14'),
(8, 6, 1, 14, -217, 1, 'test keterangan', '2023-02-27 00:03:14', '2023-02-27 00:03:14'),
(9, 5, 2, 6000, 2000, 1, 'test keterangan', '2023-02-27 00:03:14', '2023-02-27 00:03:14'),
(10, 15, 1, 25000, 25000, 1, 'test keterangan', '2023-02-27 01:50:20', '2023-02-27 01:50:20'),
(11, 13, 2, 44000, 3600, 1, 'test keterangan', '2023-02-27 01:51:18', '2023-02-27 01:51:18'),
(12, 13, 2, 44000, 3600, 1, 'test keterangan', '2023-02-27 01:53:36', '2023-02-27 01:53:36'),
(13, 13, 2, 44000, 3600, 1, 'test keterangan', '2023-02-27 01:54:50', '2023-02-27 01:54:50'),
(14, 13, 2, 44000, 3600, 1, 'test keterangan', '2023-02-27 21:37:38', '2023-02-27 21:37:38'),
(15, 1, 2, 7000, 2000, 1, 'test keterangan', '2023-02-27 22:07:03', '2023-02-27 22:07:03'),
(16, 1, 2, 7000, 2000, 1, 'test keterangan', '2023-02-28 00:25:53', '2023-02-28 00:25:53'),
(17, 15, 1, 25000, 25000, 1, 'test keterangan', '2023-02-28 00:25:54', '2023-02-28 00:25:54'),
(18, 14, 1, 10000, 10000, 1, 'test keterangan', '2023-03-04 08:55:00', '2023-03-04 08:55:00'),
(19, 14, 1, 10000, 10000, 1, 'test keterangan', '2023-03-04 09:11:58', '2023-03-04 09:11:58'),
(20, 15, 10, 250000, 250000, 1, 'test keterangan', '2023-03-04 09:11:59', '2023-03-04 09:11:59'),
(21, 13, 100, 2200000, 180000, 1, 'test keterangan', '2023-03-04 09:11:59', '2023-03-04 09:11:59'),
(22, 14, 1, 10000, 10000, 1, 'test keterangan', '2023-03-04 09:12:09', '2023-03-04 09:12:09'),
(23, 15, 10, 250000, 250000, 1, 'test keterangan', '2023-03-04 09:12:09', '2023-03-04 09:12:09'),
(24, 13, 100, 2200000, 180000, 1, 'test keterangan', '2023-03-04 09:12:09', '2023-03-04 09:12:09'),
(25, 14, 1, 10000, 10000, 1, 'test keterangan', '2023-03-04 11:49:08', '2023-03-04 11:49:08'),
(26, 15, 10, 250000, 250000, 1, 'test keterangan', '2023-03-04 11:49:09', '2023-03-04 11:49:09'),
(27, 13, 100, 2200000, 180000, 1, 'test keterangan', '2023-03-04 11:49:09', '2023-03-04 11:49:09'),
(28, 14, 2, 20000, 20000, 1, 'adasdasd', '2023-03-04 12:35:14', '2023-03-04 12:35:14'),
(29, 16, 1, 1500, 500, 1, '1', '2023-03-04 14:33:15', '2023-03-04 14:33:15'),
(30, 16, 1, 1500, 500, 1, '1', '2023-03-04 14:35:34', '2023-03-04 14:35:34'),
(31, 16, 1, 1500, 500, 1, NULL, '2023-03-04 14:37:34', '2023-03-04 14:37:34'),
(32, 16, 1, 1500, 500, 1, NULL, '2023-03-04 14:39:00', '2023-03-04 14:39:00'),
(33, 16, 1, 1500, 500, 1, NULL, '2023-03-04 14:40:00', '2023-03-04 14:40:00'),
(34, 16, 1, 1500, 500, 1, NULL, '2023-03-04 15:09:28', '2023-03-04 15:09:28'),
(35, 13, 1, 22000, 1800, 1, NULL, '2023-03-04 15:11:53', '2023-03-04 15:11:53'),
(36, 16, 2, 3000, 1000, 1, NULL, '2023-03-04 23:26:37', '2023-03-04 23:26:37'),
(37, 16, 2, 3000, 1000, 1, NULL, '2023-03-04 23:28:06', '2023-03-04 23:28:06'),
(38, 16, 2, 3000, 1000, 1, NULL, '2023-03-06 03:00:06', '2023-03-06 03:00:06'),
(39, 14, 1, 10000, 10000, 1, NULL, '2023-03-09 01:19:22', '2023-03-09 01:19:22'),
(40, 5, 1, 3000, 1000, 2, NULL, '2023-03-09 01:38:00', '2023-03-09 01:38:00'),
(41, 17, 1, 3000, 1000, 1, NULL, '2023-03-09 05:59:11', '2023-03-09 05:59:11'),
(42, 17, 1, 3000, 1000, 1, NULL, '2023-03-09 09:14:13', '2023-03-09 09:14:13'),
(43, 17, 1, 3000, 1000, 1, NULL, '2023-03-10 01:41:53', '2023-03-10 01:41:53'),
(44, 15, 20, 500000, 500000, 1, 'borongan', '2023-03-19 22:19:08', '2023-03-19 22:19:08'),
(45, 17, 1, 3000, 1000, 1, NULL, '2023-03-20 18:30:51', '2023-03-20 18:30:51'),
(46, 17, 1, 3000, 1000, 1, NULL, '2023-03-29 23:07:13', '2023-03-29 23:07:13'),
(47, 17, 1, 3000, 1000, 1, NULL, '2023-03-30 00:53:39', '2023-03-30 00:53:39'),
(48, 15, 1, 25000, 25000, 1, NULL, '2023-03-30 00:53:39', '2023-03-30 00:53:39'),
(49, 5, 1, 3000, 1000, 1, NULL, '2023-03-30 00:53:39', '2023-03-30 00:53:39'),
(50, 13, 2, 44000, 3600, 1, NULL, '2023-03-30 00:53:39', '2023-03-30 00:53:39'),
(51, 14, 1, 10000, 10000, 1, NULL, '2023-03-30 00:53:39', '2023-03-30 00:53:39'),
(52, 16, 1, 1500, 500, 1, NULL, '2023-03-30 00:53:39', '2023-03-30 00:53:39'),
(53, 1, 1, 3500, 1000, 1, NULL, '2023-03-30 00:53:40', '2023-03-30 00:53:40'),
(54, 16, 1, 1500, 500, 1, NULL, '2023-03-30 00:53:40', '2023-03-30 00:53:40'),
(55, 17, 1, 3000, 1000, 1, NULL, '2023-03-30 01:32:12', '2023-03-30 01:32:12'),
(56, 15, 1, 25000, 25000, 1, NULL, '2023-03-30 01:32:14', '2023-03-30 01:32:14'),
(57, 5, 1, 3000, 1000, 1, NULL, '2023-03-30 01:32:16', '2023-03-30 01:32:16'),
(58, 13, 2, 44000, 3600, 1, NULL, '2023-03-30 01:32:20', '2023-03-30 01:32:20'),
(59, 14, 1, 10000, 10000, 1, NULL, '2023-03-30 01:32:21', '2023-03-30 01:32:21'),
(60, 16, 1, 1500, 500, 1, NULL, '2023-03-30 01:32:21', '2023-03-30 01:32:21'),
(61, 1, 1, 3500, 1000, 1, NULL, '2023-03-30 01:32:22', '2023-03-30 01:32:22'),
(62, 16, 1, 1500, 500, 1, NULL, '2023-03-30 01:32:22', '2023-03-30 01:32:22'),
(63, 17, 1, 3000, 1000, 1, NULL, '2023-03-30 01:32:35', '2023-03-30 01:32:35'),
(64, 15, 1, 25000, 25000, 1, NULL, '2023-03-30 01:32:35', '2023-03-30 01:32:35'),
(65, 5, 1, 3000, 1000, 1, NULL, '2023-03-30 01:32:35', '2023-03-30 01:32:35'),
(66, 13, 2, 44000, 3600, 1, NULL, '2023-03-30 01:32:35', '2023-03-30 01:32:35'),
(67, 14, 1, 10000, 10000, 1, NULL, '2023-03-30 01:32:35', '2023-03-30 01:32:35'),
(68, 16, 1, 1500, 500, 1, NULL, '2023-03-30 01:32:35', '2023-03-30 01:32:35'),
(69, 1, 1, 3500, 1000, 1, NULL, '2023-03-30 01:32:35', '2023-03-30 01:32:35'),
(70, 16, 1, 1500, 500, 1, NULL, '2023-03-30 01:32:36', '2023-03-30 01:32:36'),
(71, 17, 1, 3000, 1000, 1, NULL, '2023-03-30 01:55:42', '2023-03-30 01:55:42'),
(72, 15, 1, 25000, 25000, 1, NULL, '2023-03-30 01:55:42', '2023-03-30 01:55:42'),
(73, 5, 1, 3000, 1000, 1, NULL, '2023-03-30 01:55:42', '2023-03-30 01:55:42'),
(74, 13, 2, 44000, 3600, 1, NULL, '2023-03-30 01:55:42', '2023-03-30 01:55:42'),
(75, 14, 1, 10000, 10000, 1, NULL, '2023-03-30 01:55:42', '2023-03-30 01:55:42'),
(76, 16, 1, 1500, 500, 1, NULL, '2023-03-30 01:55:42', '2023-03-30 01:55:42'),
(77, 1, 1, 3500, 1000, 1, NULL, '2023-03-30 01:55:42', '2023-03-30 01:55:42'),
(78, 16, 1, 1500, 500, 1, NULL, '2023-03-30 01:55:42', '2023-03-30 01:55:42'),
(79, 18, 1, 5500, 500, 1, NULL, '2023-03-30 01:55:43', '2023-03-30 01:55:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_properti`
--

CREATE TABLE `tbl_properti` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_properti`
--

INSERT INTO `tbl_properti` (`id`, `nama`, `type`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Barang', 'Jenis', 'Menghapus data ini akan menyebabkan error.', '2023-02-20 05:22:05', '2023-02-28 23:47:46'),
(2, 'Jasa', 'Jenis', 'Menghapus data ini akan menyebabkan error.', '2023-02-20 05:22:05', '2023-02-28 23:47:51'),
(3, 'PT Jaya Utama Santikah', 'Supplier', 'Shampoo', '2023-02-20 05:28:58', '2023-02-20 05:28:58'),
(4, 'PT Anugerah Inovasi Sejahtera', 'Supplier', 'Shampoo', '2023-02-20 05:28:58', '2023-02-20 05:28:58'),
(5, 'PT. Haecho Cell Beautque Manis', 'Supplier', 'Sabun Mandi', '2023-02-20 05:30:26', '2023-02-20 05:30:26'),
(6, 'PT Anugerah Inovasi Sejahtera', 'Supplier', 'Sabun Mandi', '2023-02-20 05:30:26', '2023-02-20 05:30:26'),
(11, 'vv', 'Supplier', 'ss', '2023-02-22 09:52:35', '2023-02-22 09:52:47'),
(12, 'PT Salsdklaskdlk', 'Supplier', NULL, '2023-02-28 23:47:02', '2023-02-28 23:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `level` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `hp`, `alamat`, `img`, `email`, `username`, `level`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin1', NULL, NULL, '1679892375.jpg', 'admin1@gmail.com', 'admin1', '1', NULL, '$2y$10$0edxjJGvumtZYWzolNPJdOau3.8cdJE5ErCY0.ZQ8jo2K1PnqoaAS', 'IgRM9TsOIYyOji8NgHM8AnsPnEyAwBVPvmMMlpxVpHivPrWmBLJ0sBz78nHl', '2023-03-07 08:01:34', '2023-03-26 21:46:15'),
(2, 'kasir shift 1', '+6285220120321', 'jl bandung', '', 'kasir1@gmail.com', 'kasir1', '2', NULL, '$2y$10$eRZTbTWvtxVPo7ZOiI79/ezwLNXfNfp/13QafQdJLiberHw9GcJXm', NULL, '2023-03-07 10:55:15', '2023-03-29 02:18:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_info_web`
--
ALTER TABLE `tbl_info_web`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_properti`
--
ALTER TABLE `tbl_properti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_info_web`
--
ALTER TABLE `tbl_info_web`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tbl_properti`
--
ALTER TABLE `tbl_properti`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
