-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2023 at 12:28 PM
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
(5, 'Shampoo', '1679892353.jpg', 'Barang', 'PT Jaya Utama Santikah', 2000, 3000, 10, 1, 1, '2023-02-20 09:10:06', '2023-04-27 02:20:14'),
(6, 'v v', '1679892345.jpg', 'Barang', 'PT. Haecho Cell Beautque Manis', 231, 14, 312, 31, 0, '2023-02-20 09:42:54', '2023-03-26 21:45:45'),
(13, 'sabun kan', '1679892338.jpg', 'Barang', 'PT Jaya Utama Santikah', 20200, 22000, 333, 387, 0, '2023-02-21 23:49:49', '2023-04-27 02:12:59'),
(14, 'Keramas', '', 'Jasa', NULL, NULL, 10000, 16, NULL, 0, '2023-02-24 02:55:37', '2023-04-27 02:12:59'),
(15, 'Keramas Laki', '', 'Jasa', NULL, NULL, 25000, 63, NULL, 0, '2023-02-25 03:47:35', '2023-04-27 02:05:57'),
(16, '23asd', '1679892329.jpg', 'Barang', 'PT Anugerah Inovasi Sejahtera', 1000, 1500, 20, 180, 0, '2023-03-04 12:01:34', '2023-03-30 01:55:42'),
(17, 'Masker Jeruk', '1679892323.jpg', 'Barang', 'PT Jaya Utama Santikah', 2000, 3000, 18, 1, 1, '2023-03-09 05:02:44', '2023-04-27 02:05:57'),
(18, 'Bando', '', 'Barang', 'PT Jaya Utama Santikah', 5000, 5500, 1, 0, 0, '2023-03-30 01:43:57', '2023-03-30 02:24:49');

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
  `nama_pegawai` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_keranjang`
--

INSERT INTO `tbl_keranjang` (`id`, `id_barang`, `nama_pegawai`, `jumlah`, `total`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 5, 'admin1', 1, 3000, NULL, '2023-04-27 02:58:55', '2023-04-27 02:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penjualan`
--

CREATE TABLE `tbl_penjualan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `jenis` varchar(255) NOT NULL,
  `supplier` varchar(255) DEFAULT NULL,
  `modal` int(200) DEFAULT NULL,
  `harga_satuan` int(200) NOT NULL,
  `jumlah` int(40) NOT NULL,
  `total_harga` int(40) NOT NULL,
  `laba` int(40) NOT NULL,
  `nama_pegawai` varchar(200) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_penjualan`
--

INSERT INTO `tbl_penjualan` (`id`, `nama_barang`, `img`, `jenis`, `supplier`, `modal`, `harga_satuan`, `jumlah`, `total_harga`, `laba`, `nama_pegawai`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'Masker Jeruk', '1679892323.jpg', 'Barang', 'PT Jaya Utama Santikah', 2000, 3000, 1, 3000, 1000, 'admin1', NULL, '2023-04-27 01:52:04', '2023-04-27 01:52:04'),
(2, 'Masker Jeruk', '1679892323.jpg', 'Barang', 'PT Jaya Utama Santikah', 2000, 3000, 1, 3000, 1000, 'admin1', NULL, '2023-04-27 01:52:13', '2023-04-27 01:52:13'),
(3, 'Masker Jeruk', '1679892323.jpg', 'Barang', 'PT Jaya Utama Santikah', 2000, 3000, 1, 3000, 1000, 'admin1', NULL, '2023-04-27 02:02:31', '2023-04-27 02:02:31'),
(4, 'Masker Jeruk', '1679892323.jpg', 'Barang', 'PT Jaya Utama Santikah', 2000, 3000, 1, 3000, 1000, 'admin1', NULL, '2023-04-27 02:03:29', '2023-04-27 02:03:29'),
(5, 'Masker Jeruk', '1679892323.jpg', 'Barang', 'PT Jaya Utama Santikah', 2000, 3000, 1, 3000, 1000, 'admin1', NULL, '2023-04-27 02:03:37', '2023-04-27 02:03:37'),
(6, 'Masker Jeruk', '1679892323.jpg', 'Barang', 'PT Jaya Utama Santikah', 2000, 3000, 1, 3000, 1000, 'admin1', NULL, '2023-04-27 02:05:57', '2023-04-27 02:05:57'),
(7, 'Keramas Laki', '', 'Jasa', NULL, NULL, 25000, 1, 25000, 25000, 'admin1', NULL, '2023-04-27 02:05:57', '2023-04-27 02:05:57'),
(8, 'sabun kan', '1679892338.jpg', 'Barang', 'PT Jaya Utama Santikah', 20200, 22000, 2, 44000, 3600, 'admin1', NULL, '2023-04-27 02:12:27', '2023-04-27 02:12:27'),
(9, 'sabun kan', '1679892338.jpg', 'Barang', 'PT Jaya Utama Santikah', 20200, 22000, 2, 44000, 3600, 'admin1', NULL, '2023-04-27 02:12:59', '2023-04-27 02:12:59'),
(10, 'Keramas', '', 'Jasa', NULL, NULL, 10000, 3, 30000, 30000, 'admin1', NULL, '2023-04-27 02:12:59', '2023-04-27 02:12:59'),
(11, 'Shampoo', '1679892353.jpg', 'Barang', 'PT Jaya Utama Santikah', 2000, 3000, 2, 6000, 2000, 'admin1', NULL, '2023-04-27 02:12:59', '2023-04-27 02:12:59'),
(12, 'Shampoo', '1679892353.jpg', 'Barang', 'PT Jaya Utama Santikah', 2000, 3000, 2, 6000, 2000, 'admin1', 'aaa', '2023-04-27 02:20:14', '2023-04-27 02:20:14'),
(13, 'sampo kan', '1682588766.jpg', 'Barang', 'PT Jaya Utama Santikah', 3000, 4000, 4, 16000, 4000, 'admin1', 'satu renteng', '2023-04-27 02:47:21', '2023-04-27 02:47:21');

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
(1, 'admin1', NULL, NULL, '1679892375.jpg', 'admin1@gmail.com', 'admin1', '1', NULL, '$2y$10$0edxjJGvumtZYWzolNPJdOau3.8cdJE5ErCY0.ZQ8jo2K1PnqoaAS', 'KfovMVQmqMjg6tYPELu3EBC1piondeoFRFMJ0rmablmVFB4Lm5IbbbYbzegP', '2023-03-07 08:01:34', '2023-03-26 21:46:15'),
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_info_web`
--
ALTER TABLE `tbl_info_web`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_penjualan`
--
ALTER TABLE `tbl_penjualan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
