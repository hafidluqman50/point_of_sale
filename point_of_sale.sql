-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jun 18, 2020 at 05:47 PM
-- Server version: 8.0.13
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `point_of_sale`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(36) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_jenis_barang` varchar(36) NOT NULL,
  `stok_barang` int(11) NOT NULL,
  `satuan_stok` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `id_jenis_barang`, `stok_barang`, `satuan_stok`, `status_delete`) VALUES
('539184cc-6b5d-4b98-b85b-5f72bba220e2', 'Kangkung', '57ca891b-94b8-455b-9466-056f22a02aeb', 120, 'Ikat', 0),
('91be7ca5-1775-468f-a9b1-c47f17836fef', 'Bayam', '57ca891b-94b8-455b-9466-056f22a02aeb', 120, 'Ikat', 0);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` varchar(36) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `keterangan` text NOT NULL,
  `id_users` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar_detail`
--

CREATE TABLE `barang_keluar_detail` (
  `id_barang_keluar_detail` varchar(36) NOT NULL,
  `id_barang_keluar` varchar(36) NOT NULL,
  `id_barang` varchar(36) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `satuan_stok` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `id_supplier` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_users` varchar(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `tanggal_masuk`, `id_supplier`, `keterangan`, `id_users`, `created_at`, `updated_at`) VALUES
('921596f8-bfbc-4ed9-9920-7a5e384c01ef', '2020-04-02', 'cc4392c5-915c-4ed7-8a57-7caf0696b71c', 'Pemasukan Bahan Sayuran', 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', '2020-04-02 21:56:36', '2020-04-02 21:56:36');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk_detail`
--

CREATE TABLE `barang_masuk_detail` (
  `id_barang_masuk_detail` varchar(36) NOT NULL,
  `id_barang_masuk` varchar(36) NOT NULL,
  `id_barang` varchar(36) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `harga_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang_masuk_detail`
--

INSERT INTO `barang_masuk_detail` (`id_barang_masuk_detail`, `id_barang_masuk`, `id_barang`, `jumlah_masuk`, `harga_satuan`, `harga_total`) VALUES
('4aeec88e-e4c4-469e-9487-7b51f8a31ef6', '921596f8-bfbc-4ed9-9920-7a5e384c01ef', '91be7ca5-1775-468f-a9b1-c47f17836fef', 12, 10000, 120000),
('e6268c7c-a666-40ff-bb5e-47cc1a30e231', '921596f8-bfbc-4ed9-9920-7a5e384c01ef', '539184cc-6b5d-4b98-b85b-5f72bba220e2', 20, 20000, 400000);

-- --------------------------------------------------------

--
-- Table structure for table `belanja`
--

CREATE TABLE `belanja` (
  `id_belanja` varchar(36) NOT NULL,
  `tanggal_belanja` date NOT NULL,
  `id_supplier` varchar(36) NOT NULL,
  `total_belanja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenis_barang` varchar(36) NOT NULL,
  `nama_jenis` varchar(70) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis_barang`, `nama_jenis`, `status_delete`) VALUES
('55997545-f0c2-4125-973c-ba5be683e02e', 'Buah Buahan', 0),
('57ca891b-94b8-455b-9466-056f22a02aeb', 'Sayuran', 0),
('99a7b837-874b-40a4-8eb2-1db422f32c0e', 'Daging', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_makan`
--

CREATE TABLE `menu_makan` (
  `id_menu_makan` varchar(36) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga_menu` int(11) NOT NULL,
  `foto_menu` text NOT NULL,
  `status_menu` varchar(20) NOT NULL,
  `status_delete` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_makan`
--

INSERT INTO `menu_makan` (`id_menu_makan`, `nama_menu`, `harga_menu`, `foto_menu`, `status_menu`, `status_delete`) VALUES
('107924bd-84af-4f77-9570-965b908938e3', 'Nasi Pecel', 12000, '5e78e83a984b4_foto_menu_nasi-pecel.jpg', 'tersedia', 0),
('7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 'Nasi Goreng', 12000, '5e78e84829584_foto_menu_photo.jpg', 'tersedia', 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_makan_detail`
--

CREATE TABLE `menu_makan_detail` (
  `id_menu_makan_detail` varchar(36) NOT NULL,
  `id_menu_makan` varchar(36) NOT NULL,
  `tambahan` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(36) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat_supplier` text NOT NULL,
  `nomor_telepon_supplier` varchar(12) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `alamat_supplier`, `nomor_telepon_supplier`, `status_delete`) VALUES
('cc4392c5-915c-4ed7-8a57-7caf0696b71c', 'PT Usaha Pangan Sejahtera', 'JL. Piere Tendean 43 Tulungagung 66212, Jawa Timur, Tulungagung, Jawa Timur, Indonesia', '08888888888', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(36) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `id_users` varchar(36) NOT NULL,
  `status_transaksi` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `total_harga`, `total_bayar`, `id_users`, `status_transaksi`, `keterangan`, `created_at`, `updated_at`) VALUES
('13f87a32-5385-4b0f-9684-34cef0a08fc0', '2020-04-18', 48000, 48000, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', '-', '2020-03-28 22:17:00', '2020-03-28 22:17:00'),
('356cc914-165d-4b3d-b08b-049b2ce5b0d5', '2020-06-11', 36000, 36000, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', NULL, NULL, '2020-06-11 13:30:54', '2020-06-11 13:30:54'),
('49b49150-9771-46e1-8d9c-4e0306a868c4', '2020-06-19', 24000, 24000, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', NULL, NULL, '2020-06-19 01:44:35', '2020-06-19 01:44:35'),
('7db0831d-0d01-49ed-a452-43eb5a41db43', '2020-04-18', 24000, 24000, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', '-', '2020-04-03 21:40:55', '2020-04-03 21:40:55'),
('aa29d0f6-f3b0-41a0-ba5b-5bbeffe21123', '2020-05-19', 24000, 24000, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', NULL, NULL, '2020-05-16 22:16:59', '2020-05-16 22:16:59'),
('e5b9dc92-8f98-4598-8250-0398d08067ea', '2020-06-19', 36000, 36000, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', NULL, NULL, '2020-06-15 13:14:28', '2020-06-15 13:14:28');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` varchar(36) NOT NULL,
  `id_transaksi` varchar(36) NOT NULL,
  `id_menu_makan` varchar(36) NOT NULL,
  `banyak_pesan` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_menu_makan`, `banyak_pesan`, `sub_total`, `keterangan`, `created_at`, `updated_at`) VALUES
('1331669a-ccca-4716-978b-7b13d81b73f4', '356cc914-165d-4b3d-b08b-049b2ce5b0d5', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 2, 24000, NULL, '2020-06-11 13:30:54', '2020-06-11 13:30:54'),
('163483cd-af1e-4705-abbb-3d196a52f65c', '7db0831d-0d01-49ed-a452-43eb5a41db43', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, '2020-04-03 21:40:55', '2020-04-03 21:40:55'),
('5f67c29f-30b8-40b4-b806-b6cb9e2abf54', 'aa29d0f6-f3b0-41a0-ba5b-5bbeffe21123', '107924bd-84af-4f77-9570-965b908938e3', 1, 12000, NULL, '2020-05-16 22:16:59', '2020-05-16 22:16:59'),
('6227a193-62d0-4523-a734-c7ed0b95bf1c', 'e5b9dc92-8f98-4598-8250-0398d08067ea', '107924bd-84af-4f77-9570-965b908938e3', 2, 24000, NULL, '2020-06-15 13:14:28', '2020-06-15 13:14:28'),
('6a8bc1be-88b2-4b8a-914c-a055e0d517d2', 'e5b9dc92-8f98-4598-8250-0398d08067ea', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, '2020-06-15 13:14:28', '2020-06-15 13:14:28'),
('92ecc1b4-60d3-4023-ade2-21763a85b854', '7db0831d-0d01-49ed-a452-43eb5a41db43', '107924bd-84af-4f77-9570-965b908938e3', 1, 12000, NULL, '2020-04-03 21:40:55', '2020-04-03 21:40:55'),
('9507ac39-7b2e-4303-a713-4e575e41ed37', 'aa29d0f6-f3b0-41a0-ba5b-5bbeffe21123', '107924bd-84af-4f77-9570-965b908938e3', 1, 12000, NULL, '2020-05-16 22:16:59', '2020-05-16 22:16:59'),
('997c9bf2-470c-4e05-943e-766c37346124', '49b49150-9771-46e1-8d9c-4e0306a868c4', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, '2020-06-19 01:44:35', '2020-06-19 01:44:35'),
('a1b04e8d-3f3e-4610-aa5c-3b3fd178bd6a', '356cc914-165d-4b3d-b08b-049b2ce5b0d5', '107924bd-84af-4f77-9570-965b908938e3', 1, 12000, NULL, '2020-06-11 13:30:54', '2020-06-11 13:30:54'),
('ae24daaa-1e3a-4b39-bbb6-ebe268420c1f', '13f87a32-5385-4b0f-9684-34cef0a08fc0', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 2, 24000, 'Telor Setengah Matang', '2020-03-28 22:17:00', '2020-03-28 22:17:00'),
('af808236-e205-4e8b-92bd-ac2360b17087', '49b49150-9771-46e1-8d9c-4e0306a868c4', '107924bd-84af-4f77-9570-965b908938e3', 1, 12000, NULL, '2020-06-19 01:44:35', '2020-06-19 01:44:35'),
('d2cb5913-85e0-4dc4-8525-6b8932259605', '13f87a32-5385-4b0f-9684-34cef0a08fc0', '107924bd-84af-4f77-9570-965b908938e3', 2, 24000, 'Pedesin', '2020-03-28 22:17:00', '2020-03-28 22:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` varchar(36) NOT NULL,
  `name` varchar(75) NOT NULL,
  `username` varchar(75) NOT NULL,
  `password` varchar(75) NOT NULL,
  `level_user` int(1) NOT NULL,
  `status_akun` int(1) NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `name`, `username`, `password`, `level_user`, `status_akun`, `remember_token`, `status_delete`) VALUES
('5fcc4e88-979d-48c6-893c-4226b3432467', 'Kasir', 'kasir', '$2y$10$ATocz/kGbvihcRhUmDo1peZ2TjbdJtn.89xItZwxac3/RC4lmI3ES', 0, 1, 'YMKX9UMYkvD7Ynqi5w6zrJP69QZq6oOPrBRJQVoXr4eNVejHvBEoTm2Gy50x', 0),
('b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'Administrator', 'admin', '$2y$10$SOKPPqAhaphhLIRxOSJJ4OrdiyVTd.9mPZ9dk6D8fN9b5sEbNEQKe', 2, 1, 'X4zr1LhLcVG6sYY6lOIuzws3qYnrLeGMD8EzgWhqb9bXgKi79CotlWIxbZbG', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_jenis_barang` (`id_jenis_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `barang_keluar_detail`
--
ALTER TABLE `barang_keluar_detail`
  ADD KEY `id_barang_keluar` (`id_barang_keluar`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `barang_masuk_detail`
--
ALTER TABLE `barang_masuk_detail`
  ADD PRIMARY KEY (`id_barang_masuk_detail`),
  ADD KEY `id_barang_masuk` (`id_barang_masuk`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `belanja`
--
ALTER TABLE `belanja`
  ADD PRIMARY KEY (`id_belanja`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenis_barang`);

--
-- Indexes for table `menu_makan`
--
ALTER TABLE `menu_makan`
  ADD PRIMARY KEY (`id_menu_makan`);

--
-- Indexes for table `menu_makan_detail`
--
ALTER TABLE `menu_makan_detail`
  ADD PRIMARY KEY (`id_menu_makan_detail`),
  ADD KEY `menu_makan_detail_ibfk_1` (`id_menu_makan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `users_relation_transaksi` (`id_users`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`),
  ADD KEY `transaksi_relation_transaksi_detail` (`id_transaksi`),
  ADD KEY `menu_makan_relation_transaksi_detail` (`id_menu_makan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_jenis_barang`) REFERENCES `jenis_barang` (`id_jenis_barang`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `barang_keluar_detail`
--
ALTER TABLE `barang_keluar_detail`
  ADD CONSTRAINT `barang_keluar_detail_ibfk_1` FOREIGN KEY (`id_barang_keluar`) REFERENCES `barang_keluar` (`id_barang_keluar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_detail_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_supplier`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `barang_masuk_detail`
--
ALTER TABLE `barang_masuk_detail`
  ADD CONSTRAINT `barang_masuk_detail_ibfk_1` FOREIGN KEY (`id_barang_masuk`) REFERENCES `barang_masuk` (`id_barang_masuk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_detail_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `menu_makan_detail`
--
ALTER TABLE `menu_makan_detail`
  ADD CONSTRAINT `menu_makan_detail_ibfk_1` FOREIGN KEY (`id_menu_makan`) REFERENCES `menu_makan` (`id_menu_makan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `users_relation_transaksi` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `menu_makan_relation_transaksi_detail` FOREIGN KEY (`id_menu_makan`) REFERENCES `menu_makan` (`id_menu_makan`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_relation_transaksi_detail` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
