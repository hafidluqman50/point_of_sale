-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 06, 2021 at 05:03 PM
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
  `id_users` varchar(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `tanggal_keluar`, `keterangan`, `id_users`, `created_at`, `updated_at`) VALUES
('67309ca7-7fc0-4006-bc86-7ab7e787512d', '2020-04-09', 'Barang Keluar', 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', '2021-03-26 00:30:33', '2021-03-26 00:30:33'),
('8071933c-50ba-4b72-968b-a662d2fde133', '2021-04-02', 'Oke mantap juga', 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', '2021-04-02 20:25:55', '2021-04-02 20:25:55'),
('af19323c-e2c6-436f-813c-e8732043a92b', '2020-04-21', 'Barang Keluar Lagi', 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', '2021-03-26 00:31:20', '2021-03-26 00:31:20'),
('bf4a43a0-84a5-4b3b-bd83-de2e21cfb900', '2021-02-06', 'Test Barang Keluar', 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', '2021-02-06 14:03:18', '2021-02-06 14:03:18');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar_detail`
--

CREATE TABLE `barang_keluar_detail` (
  `id_barang_keluar_detail` varchar(36) NOT NULL,
  `id_barang_keluar` varchar(36) NOT NULL,
  `id_barang` varchar(36) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang_keluar_detail`
--

INSERT INTO `barang_keluar_detail` (`id_barang_keluar_detail`, `id_barang_keluar`, `id_barang`, `jumlah_barang`, `created_at`, `updated_at`) VALUES
('076efada-8ca9-4c4f-b03e-c6665c1e80ff', '67309ca7-7fc0-4006-bc86-7ab7e787512d', '539184cc-6b5d-4b98-b85b-5f72bba220e2', 12, NULL, NULL),
('2065e036-f249-4a7e-9c5e-c3b5eacbc0a0', 'af19323c-e2c6-436f-813c-e8732043a92b', '91be7ca5-1775-468f-a9b1-c47f17836fef', 12, NULL, NULL),
('84a7ae05-4928-44a2-ae37-e76ee119c955', '8071933c-50ba-4b72-968b-a662d2fde133', '91be7ca5-1775-468f-a9b1-c47f17836fef', 12, NULL, NULL),
('a2664a59-1ba4-49f7-92da-6e49febcffe4', 'bf4a43a0-84a5-4b3b-bd83-de2e21cfb900', '91be7ca5-1775-468f-a9b1-c47f17836fef', 1, NULL, NULL),
('a304e591-c21a-4b89-8065-9996beedd9fc', '67309ca7-7fc0-4006-bc86-7ab7e787512d', '91be7ca5-1775-468f-a9b1-c47f17836fef', 12, NULL, NULL),
('d9ab7525-65b9-4329-915b-b4f48e7dcba2', 'bf4a43a0-84a5-4b3b-bd83-de2e21cfb900', '539184cc-6b5d-4b98-b85b-5f72bba220e2', 1, NULL, NULL),
('db627973-058b-4f08-9871-943119891df1', 'af19323c-e2c6-436f-813c-e8732043a92b', '539184cc-6b5d-4b98-b85b-5f72bba220e2', 12, NULL, NULL);

--
-- Triggers `barang_keluar_detail`
--
DELIMITER $$
CREATE TRIGGER `trigger_barang_keluar` AFTER INSERT ON `barang_keluar_detail` FOR EACH ROW BEGIN 
	UPDATE barang SET stok_barang = stok_barang - NEW.jumlah_barang WHERE id_barang = NEW.id_barang; 
END
$$
DELIMITER ;

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
('29d5390a-4c5a-47dc-a3a2-ed3339ac22ac', '2020-04-13', 'cc4392c5-915c-4ed7-8a57-7caf0696b71c', 'Barang Pokok Masuk', 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', '2021-03-26 00:22:40', '2021-03-26 00:22:40'),
('921596f8-bfbc-4ed9-9920-7a5e384c01ef', '2020-04-02', 'cc4392c5-915c-4ed7-8a57-7caf0696b71c', 'Pemasukan Bahan Sayuran', 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', '2020-04-02 21:56:36', '2020-04-02 21:56:36'),
('d528435e-7e96-419c-80ac-1a3380f6f652', '2021-04-02', 'cc4392c5-915c-4ed7-8a57-7caf0696b71c', 'Oke mantap', 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', '2021-04-02 20:25:12', '2021-04-02 20:25:12');

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
  `harga_total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang_masuk_detail`
--

INSERT INTO `barang_masuk_detail` (`id_barang_masuk_detail`, `id_barang_masuk`, `id_barang`, `jumlah_masuk`, `harga_satuan`, `harga_total`, `created_at`, `updated_at`) VALUES
('398d30b6-62e9-48c6-909e-14270edb5075', 'd528435e-7e96-419c-80ac-1a3380f6f652', '91be7ca5-1775-468f-a9b1-c47f17836fef', 12, 12000, 144000, NULL, NULL),
('4aeec88e-e4c4-469e-9487-7b51f8a31ef6', '921596f8-bfbc-4ed9-9920-7a5e384c01ef', '91be7ca5-1775-468f-a9b1-c47f17836fef', 12, 10000, 120000, NULL, NULL),
('4e7641f4-e893-47da-b250-b9b23f672eb4', '29d5390a-4c5a-47dc-a3a2-ed3339ac22ac', '539184cc-6b5d-4b98-b85b-5f72bba220e2', 12, 20000, 240000, NULL, NULL),
('ceb4d9fa-aafd-4216-ac76-5aacff3879c4', '29d5390a-4c5a-47dc-a3a2-ed3339ac22ac', '91be7ca5-1775-468f-a9b1-c47f17836fef', 12, 20000, 240000, NULL, NULL),
('e6268c7c-a666-40ff-bb5e-47cc1a30e231', '921596f8-bfbc-4ed9-9920-7a5e384c01ef', '539184cc-6b5d-4b98-b85b-5f72bba220e2', 20, 20000, 400000, NULL, NULL);

--
-- Triggers `barang_masuk_detail`
--
DELIMITER $$
CREATE TRIGGER `trigger_barang_masuk` AFTER INSERT ON `barang_masuk_detail` FOR EACH ROW BEGIN
UPDATE barang SET stok_barang = stok_barang + NEW.jumlah_masuk WHERE id_barang = NEW.id_barang;
END
$$
DELIMITER ;

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
-- Table structure for table `info_outlet`
--

CREATE TABLE `info_outlet` (
  `id_info_outlet` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_outlet` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `alamat_outlet` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nomor_telepon` varchar(20) NOT NULL,
  `catatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `info_outlet`
--

INSERT INTO `info_outlet` (`id_info_outlet`, `nama_outlet`, `alamat_outlet`, `nomor_telepon`, `catatan`) VALUES
('42bdfe36-5a28-4378-bae2-fda220480036', 'CV. Jupiter IT Solutions', 'Jln. Jelawat, Sidodamai, Kec. Samarinda Ilir, Kota Samarinda, Kalimantan Timur 75242', '088888888888', 'Password Wifi : 12345');

-- --------------------------------------------------------

--
-- Table structure for table `item_jual`
--

CREATE TABLE `item_jual` (
  `id_item_jual` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_item` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `harga_item` int(11) NOT NULL,
  `foto_item` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_jenis_item` varchar(36) NOT NULL,
  `status_item` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status_delete` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `item_jual`
--

INSERT INTO `item_jual` (`id_item_jual`, `nama_item`, `harga_item`, `foto_item`, `id_jenis_item`, `status_item`, `status_delete`, `created_at`, `updated_at`) VALUES
('107924bd-84af-4f77-9570-965b908938e3', 'Nasi Pecel', 12000, '5e78e83a984b4_foto_menu_nasi-pecel.jpg', '7475eb12-316a-4ab6-a1a9-6b9629e503d0', 'tersedia', 0, NULL, NULL),
('1198e460-d9da-4530-8d81-b395a071fd5c', 'Nasi Ayam Lalapan', 23000, '5f995477d7443_foto_item_3051_350.jpg', '7475eb12-316a-4ab6-a1a9-6b9629e503d0', 'tersedia', 0, NULL, NULL),
('23e520d5-c59a-49c7-a91d-3c9321c8ad6a', 'Ice Tea Banjar', 12000, '605874e798100_foto_item_100277805_24f6a336-b411-46bc-ab51-5a9300193a94_1280_1280.jpeg', '10787168-a6bc-44f8-a5e0-6020ede3c937', 'tersedia', 0, '2021-03-22 18:43:51', '2021-03-22 18:43:51'),
('4268d7ad-9a02-4016-9224-764b98148ac6', 'Pecel Lele', 18000, '5f9957ebd5e91_foto_item_GIMVTR6uVPgQMzdLoS8doH9g1H3TqaHN-31353835313238373935d41d8cd98f00b204e9800998ecf8427e_800x800.jpg', '7475eb12-316a-4ab6-a1a9-6b9629e503d0', 'tersedia', 0, '2020-10-28 19:37:15', '2020-10-28 19:37:15'),
('4b5fbf3c-3e46-4b26-9b55-01282ce02375', 'Nasi Kare', 20000, '5f9ad81951832_foto_item_rekomendasi-resep-nasi-kare-khas-jepang-kudapan-lezat-sepulang-kerja-3BKSAyQi6r.jpg', '7475eb12-316a-4ab6-a1a9-6b9629e503d0', 'tersedia', 0, '2020-10-29 22:56:25', '2021-02-26 11:47:01'),
('7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 'Nasi Goreng', 12000, '5e78e84829584_foto_menu_photo.jpg', '7475eb12-316a-4ab6-a1a9-6b9629e503d0', 'tersedia', 0, NULL, NULL),
('bd2562be-ae7e-45d0-b590-d2bba5806850', 'Ayam Geprek', 12000, '603a47e81e970_foto_item_download.jpeg', '7475eb12-316a-4ab6-a1a9-6b9629e503d0', 'tersedia', 0, '2021-02-27 21:23:52', '2021-02-27 21:23:52'),
('d722d3b2-b4f3-41a0-9f64-5276337c58de', 'Nasi Mawut', 12000, '603a4c22c2fc4_foto_item_download (1).jpeg', '7475eb12-316a-4ab6-a1a9-6b9629e503d0', 'tersedia', 0, '2021-02-27 21:41:54', '2021-02-27 21:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `item_jual_detail`
--

CREATE TABLE `item_jual_detail` (
  `id_item_jual_detail` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_item_jual` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nama_varian` varchar(70) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `harga_varian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `item_jual_detail`
--

INSERT INTO `item_jual_detail` (`id_item_jual_detail`, `id_item_jual`, `nama_varian`, `harga_varian`) VALUES
('0a277376-51ac-4460-b5e1-9b2c8a45effa', '4b5fbf3c-3e46-4b26-9b55-01282ce02375', '+ Katsu', 10000),
('c6c27b8a-2168-4234-9d42-812e9a81014c', '4b5fbf3c-3e46-4b26-9b55-01282ce02375', '+ Telor', 5000);

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
-- Table structure for table `jenis_item`
--

CREATE TABLE `jenis_item` (
  `id_jenis_item` varchar(36) NOT NULL,
  `nama_jenis` varchar(30) NOT NULL,
  `nama_jenis_slug` varchar(30) NOT NULL,
  `status_delete` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jenis_item`
--

INSERT INTO `jenis_item` (`id_jenis_item`, `nama_jenis`, `nama_jenis_slug`, `status_delete`) VALUES
('10787168-a6bc-44f8-a5e0-6020ede3c937', 'Minuman', 'minuman', 0),
('7475eb12-316a-4ab6-a1a9-6b9629e503d0', 'Makanan', 'makanan', 0);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(36) NOT NULL,
  `id_users` varchar(36) NOT NULL,
  `nomor_induk_karyawan` varchar(75) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nomor_telepon` varchar(12) NOT NULL
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
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` varchar(36) NOT NULL,
  `nama_customer` varchar(70) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `total_tagihan` int(11) NOT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status_tagihan` varchar(20) NOT NULL,
  `id_users` varchar(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `nama_customer`, `total_tagihan`, `keterangan`, `status_tagihan`, `id_users`, `created_at`, `updated_at`) VALUES
('5aa8ca16-9d89-4568-a2a3-1c0776d0bb31', 'Ahmad', 12000, NULL, 'belum-lunas', '5fcc4e88-979d-48c6-893c-4226b3432467', '2021-04-03 16:07:42', '2021-04-03 16:07:42'),
('fb95e9a6-3084-4ed6-93f2-36ba6d1fc6f6', 'Test', 12000, NULL, 'belum-lunas', '5fcc4e88-979d-48c6-893c-4226b3432467', '2021-04-03 16:13:19', '2021-04-03 16:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan_detail`
--

CREATE TABLE `tagihan_detail` (
  `id_tagihan_detail` varchar(36) NOT NULL,
  `id_tagihan` varchar(36) NOT NULL,
  `tgl_tagihan` date NOT NULL,
  `id_item_jual` varchar(36) NOT NULL,
  `banyak_pesan` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `varian` text,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status_tagihan_detail` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tagihan_detail`
--

INSERT INTO `tagihan_detail` (`id_tagihan_detail`, `id_tagihan`, `tgl_tagihan`, `id_item_jual`, `banyak_pesan`, `sub_total`, `varian`, `keterangan`, `status_tagihan_detail`, `created_at`, `updated_at`) VALUES
('631674d4-aeeb-424c-8053-95af638cbff5', '5aa8ca16-9d89-4568-a2a3-1c0776d0bb31', '2021-04-03', '107924bd-84af-4f77-9570-965b908938e3', 1, 12000, '', NULL, 'belum-dibayar', '2021-04-03 16:07:42', '2021-04-03 16:07:42'),
('b04dc105-26d7-4634-868d-6d56f4ceda06', 'fb95e9a6-3084-4ed6-93f2-36ba6d1fc6f6', '2021-04-03', '107924bd-84af-4f77-9570-965b908938e3', 1, 12000, '', NULL, 'belum-dibayar', '2021-04-03 16:13:19', '2021-04-03 16:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(36) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `id_users` varchar(36) NOT NULL,
  `status_transaksi` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ket_bayar` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `total_harga`, `total_bayar`, `kembalian`, `id_users`, `status_transaksi`, `ket_bayar`, `keterangan`, `created_at`, `updated_at`) VALUES
('030674ad-7909-4018-a05f-65ff6d9749ed', '2021-02-27', 25000, 48000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2021-02-27 21:47:38', '2021-02-27 21:47:38'),
('030c99b3-1db9-494f-98bd-7db5ad253322', '2020-08-01', 12000, 12000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-08-01 02:03:25', '2020-08-01 02:03:25'),
('04df00cf-4f35-4784-8f72-f387f143fb1b', '2020-08-04', 12000, 12000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-08-04 23:10:24', '2020-08-04 23:10:24'),
('38ae1e90-92ef-11eb-a8b3-0242ac130003', '2022-01-01', 12000, 12000, 0, '5fcc4e88-979d-48c6-893c-4226b3432467', 'sudah-bayar', 'bayar-sekarang', NULL, NULL, NULL),
('46cbed08-4a53-4494-912d-b6cd599453bb', '2021-04-07', 60000, 600000, 540000, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', 'Kelebihan Duit', '2021-04-07 00:57:51', '2021-04-07 00:57:51'),
('52790729-1c53-4fd6-849e-8d29e8229b0a', '2020-07-07', 12000, 0, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'belum-bayar', 'bayar-nanti', 'Meja No. 05', '2020-07-03 01:47:33', '2020-07-03 01:47:33'),
('560ddb5c-a50b-43b5-9712-375a311c6083', '2021-04-07', 18000, 18000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', '-', '2021-04-07 00:21:07', '2021-04-07 00:21:07'),
('57e9111a-a367-4d90-955d-356158b97e67', '2020-11-07', 25000, 25000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-11-07 13:21:03', '2020-11-07 13:21:03'),
('5c0318c2-57db-4601-b815-e48db8d5ddd8', '2020-08-04', 12000, 12000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-08-04 23:11:47', '2020-08-04 23:11:47'),
('5de4ef9e-64a9-4f7f-ab22-d0d34a1e4cd1', '2021-04-06', 30000, 120000, 90000, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', 'Mantap', '2021-04-06 15:29:28', '2021-04-06 15:29:28'),
('664de9e6-dc7b-42fb-b23d-8b6e0d8f95eb', '2020-08-01', 12000, 12000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-08-01 02:04:50', '2020-08-01 02:04:50'),
('6bbb4e7f-53f1-437f-b428-f59e5121b471', '2020-10-20', 24000, 24000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-10-20 13:20:02', '2020-10-20 13:20:02'),
('78a84628-cc58-4787-9247-40352ef61a90', '2020-08-04', 24000, 0, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'belum-bayar', 'bayar-nanti', 'Meja No. 05', '2020-08-04 22:47:22', '2020-08-04 22:47:22'),
('7b62f969-1621-463f-8998-988ce32a9e56', '2020-07-07', 12000, 0, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'belum-bayar', 'bayar-nanti', 'Mamat', '2020-07-03 01:51:01', '2020-07-03 01:51:01'),
('7fdfc829-9785-4a80-9dd4-fd0a873469dd', '2020-10-28', 24000, 24000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-10-28 13:48:49', '2020-10-28 13:48:49'),
('88448d2f-1c06-4bb1-b29c-63c1fd277b3b', '2020-08-04', 12000, 12000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-08-04 22:50:08', '2020-08-04 22:50:08'),
('91a1a927-b2d1-4791-b746-b706efdb6506', '2020-08-04', 12000, 0, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-08-04 22:49:36', '2020-08-04 22:49:36'),
('92c87ead-9a2d-40dd-877a-584c3e4836df', '2020-10-20', 144000, 144000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', 'Oke Mantap', '2020-10-20 13:20:34', '2020-10-20 13:20:34'),
('9323433b-4362-4bc4-b735-51558bd348e2', '2021-02-23', 65000, 65000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', 'Tunai bayar tagihan + pesanan baru', '2021-02-23 21:37:14', '2021-02-23 21:37:14'),
('95252a4f-94cd-4dec-a392-59dff9001c1f', '2021-03-22', 35000, 35000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', '-', '2021-03-22 11:56:53', '2021-03-22 11:56:53'),
('a20fea05-3131-403c-9ce2-6da2e140d7c9', '2020-08-03', 72000, 0, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-08-03 01:46:09', '2020-08-03 01:46:09'),
('b8122506-d451-4ccf-9b31-c43dbb7708c8', '2020-08-01', 144000, 144000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-08-01 02:06:38', '2020-08-01 02:06:38'),
('bdfeaef7-a76c-46d5-ba9e-8ffd830f07b8', '2020-11-03', 37000, 37000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-11-03 16:52:54', '2020-11-03 16:52:54'),
('bfc24deb-599f-454b-984e-c976bbdadf34', '2020-08-04', 12000, 12000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-08-04 23:12:34', '2020-08-04 23:12:34'),
('c6304e92-1a3e-42e2-994c-3495766bd222', '2021-02-25', 53000, 53000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2021-02-25 13:14:13', '2021-02-25 13:14:13'),
('d545abbc-807b-48a5-a818-4ded6d4ed92c', '2020-11-07', 48000, 0, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'belum-bayar', 'bayar-nanti', NULL, '2020-11-07 14:07:54', '2020-11-07 14:07:54'),
('e63e6583-cdb4-405c-b41e-c7a925413b40', '2020-11-03', 37000, 37000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-11-03 16:31:40', '2020-11-03 16:31:40'),
('eae99989-09a5-4f87-ac94-714c5cc1fc47', '2020-08-04', 12000, 12000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2020-08-04 23:10:48', '2020-08-04 23:10:48'),
('eed746e9-cb75-4806-96f4-8c7cbcf2e11a', '2021-02-27', 48000, 48000, 0, 'b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'sudah-bayar', 'bayar-sekarang', NULL, '2021-02-27 21:46:26', '2021-02-27 21:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id_transaksi_detail` varchar(36) NOT NULL,
  `id_transaksi` varchar(36) NOT NULL,
  `id_item_jual` varchar(36) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `banyak_pesan` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `keterangan` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `varian` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`id_transaksi_detail`, `id_transaksi`, `id_item_jual`, `banyak_pesan`, `sub_total`, `keterangan`, `varian`, `created_at`, `updated_at`) VALUES
('046cc797-a18f-439f-9802-24ba92c2047b', '030674ad-7909-4018-a05f-65ff6d9749ed', '4b5fbf3c-3e46-4b26-9b55-01282ce02375', 1, 25000, 'pedas', '+ Telor : 5000', '2021-02-27 21:47:38', '2021-02-27 21:47:38'),
('08347000-623f-45e7-a928-dded270a0267', '9323433b-4362-4bc4-b735-51558bd348e2', '4b5fbf3c-3e46-4b26-9b55-01282ce02375', 1, 30000, NULL, '+ Katsu : 10000', '2021-02-23 21:37:14', '2021-02-23 21:37:14'),
('0e7f02be-8bd3-4b38-a6d1-cb1ccd1751f9', '46cbed08-4a53-4494-912d-b6cd599453bb', '107924bd-84af-4f77-9570-965b908938e3', 1, 12000, NULL, '', '2021-04-07 00:57:51', '2021-04-07 00:57:51'),
('0efdc111-329d-4b75-b307-5c2b0dcc7f1a', '664de9e6-dc7b-42fb-b23d-8b6e0d8f95eb', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, NULL, '2020-08-01 02:04:50', '2020-08-01 02:04:50'),
('103d5ec4-2f80-4d7f-b60e-bdf4067f3126', '6bbb4e7f-53f1-437f-b428-f59e5121b471', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 2, 24000, NULL, NULL, '2020-10-20 13:20:02', '2020-10-20 13:20:02'),
('1534bdcc-ded8-4bad-89e8-bb519b3eb55e', '030c99b3-1db9-494f-98bd-7db5ad253322', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, NULL, '2020-08-01 02:03:26', '2020-08-01 02:03:26'),
('203dcf95-bae8-485f-88ee-b27b16f4766b', '46cbed08-4a53-4494-912d-b6cd599453bb', '4b5fbf3c-3e46-4b26-9b55-01282ce02375', 1, 30000, NULL, '+ Katsu : 10000', '2021-04-07 00:57:51', '2021-04-07 00:57:51'),
('21d4b5f6-3e4c-4f56-9bb0-da6fee6b93c2', '7fdfc829-9785-4a80-9dd4-fd0a873469dd', '107924bd-84af-4f77-9570-965b908938e3', 1, 12000, NULL, NULL, '2020-10-28 13:48:49', '2020-10-28 13:48:49'),
('274211c2-7c2f-401f-9158-3306f7d3100f', 'e63e6583-cdb4-405c-b41e-c7a925413b40', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, '', '2020-11-03 16:31:40', '2020-11-03 16:31:40'),
('2b5bbc2f-59f7-434f-ac9e-b35f994c2ef0', '57e9111a-a367-4d90-955d-356158b97e67', '4b5fbf3c-3e46-4b26-9b55-01282ce02375', 1, 25000, NULL, '+ Telor : 5000', '2020-11-07 13:21:03', '2020-11-07 13:21:03'),
('2ff9785b-95d2-4d3c-be31-bee9c1c5ec57', '560ddb5c-a50b-43b5-9712-375a311c6083', '4268d7ad-9a02-4016-9224-764b98148ac6', 1, 18000, NULL, '', '2021-04-07 00:21:07', '2021-04-07 00:21:07'),
('33b50765-3b74-4e07-a67c-1fe6e68fa376', '78a84628-cc58-4787-9247-40352ef61a90', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, NULL, '2020-08-04 22:47:22', '2020-08-04 22:47:22'),
('45e474a7-78a2-4bc2-9bca-38c10e921078', '95252a4f-94cd-4dec-a392-59dff9001c1f', '1198e460-d9da-4530-8d81-b395a071fd5c', 1, 23000, NULL, '', '2021-03-22 11:56:53', '2021-03-22 11:56:53'),
('46507d24-6b0f-4436-9645-21a9812a5323', '9323433b-4362-4bc4-b735-51558bd348e2', '1198e460-d9da-4530-8d81-b395a071fd5c', 1, 23000, NULL, '', '2021-02-23 21:37:14', '2021-02-23 21:37:14'),
('4ca9e26d-a6f9-4115-a4e4-8eac57000db5', '7fdfc829-9785-4a80-9dd4-fd0a873469dd', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, NULL, '2020-10-28 13:48:49', '2020-10-28 13:48:49'),
('551558d2-0f20-4c6e-b425-4d562b1b0ca4', 'a20fea05-3131-403c-9ce2-6da2e140d7c9', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, NULL, '2020-08-03 01:46:09', '2020-08-03 01:46:09'),
('5efccb89-03f3-4fee-b32a-31ce650e8ad1', '46cbed08-4a53-4494-912d-b6cd599453bb', '4268d7ad-9a02-4016-9224-764b98148ac6', 1, 18000, NULL, '', '2021-04-07 00:57:51', '2021-04-07 00:57:51'),
('63b42115-60ea-4fe9-a302-d6574a7d957c', 'bdfeaef7-a76c-46d5-ba9e-8ffd830f07b8', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, '', '2020-11-03 16:52:54', '2020-11-03 16:52:54'),
('650e4de1-cccb-4d62-b584-31da939001ce', 'e63e6583-cdb4-405c-b41e-c7a925413b40', '4b5fbf3c-3e46-4b26-9b55-01282ce02375', 1, 25000, NULL, '+ Katsu : 5000', '2020-11-03 16:31:40', '2020-11-03 16:31:40'),
('65994c0a-1f59-4f02-9bb9-c82779cc06bd', 'c6304e92-1a3e-42e2-994c-3495766bd222', '4b5fbf3c-3e46-4b26-9b55-01282ce02375', 1, 30000, NULL, '+ Katsu : 10000', '2021-02-25 13:14:13', '2021-02-25 13:14:13'),
('67aba47f-8fd5-4cb7-aeec-38aa5a9bfe6c', 'd545abbc-807b-48a5-a818-4ded6d4ed92c', '1198e460-d9da-4530-8d81-b395a071fd5c', 1, 23000, NULL, '', '2020-11-07 14:07:54', '2020-11-07 14:07:54'),
('75123860-b44c-4ff4-a65f-c1e073614a69', 'bfc24deb-599f-454b-984e-c976bbdadf34', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, NULL, '2020-08-04 23:12:34', '2020-08-04 23:12:34'),
('84f3583e-e3a3-4e1b-bebd-87d8d5af02bd', '5c0318c2-57db-4601-b815-e48db8d5ddd8', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, NULL, '2020-08-04 23:11:47', '2020-08-04 23:11:47'),
('865ed2de-f377-41bb-85c3-1956ae8f2c59', 'eae99989-09a5-4f87-ac94-714c5cc1fc47', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, NULL, '2020-08-04 23:10:48', '2020-08-04 23:10:48'),
('9732a474-1d9e-485e-b5ca-fddc8c4d8f90', '95252a4f-94cd-4dec-a392-59dff9001c1f', 'bd2562be-ae7e-45d0-b590-d2bba5806850', 1, 12000, NULL, '', '2021-03-22 11:56:53', '2021-03-22 11:56:53'),
('ab8578de-08c2-460b-810c-b1db6fac6a72', 'a20fea05-3131-403c-9ce2-6da2e140d7c9', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 3, 36000, NULL, NULL, '2020-08-03 01:46:09', '2020-08-03 01:46:09'),
('b02f0554-aa88-4fae-9a7b-a0048d3f2286', '91a1a927-b2d1-4791-b746-b706efdb6506', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, NULL, '2020-08-04 22:49:36', '2020-08-04 22:49:36'),
('b27558ca-84b1-4d7f-973a-7281de21036e', '78a84628-cc58-4787-9247-40352ef61a90', '107924bd-84af-4f77-9570-965b908938e3', 1, 12000, NULL, NULL, '2020-08-04 22:47:22', '2020-08-04 22:47:22'),
('b34ec5a4-6547-40d9-aa87-838001162e74', 'bdfeaef7-a76c-46d5-ba9e-8ffd830f07b8', '4b5fbf3c-3e46-4b26-9b55-01282ce02375', 1, 25000, NULL, '+ Katsu : 5000', '2020-11-03 16:52:54', '2020-11-03 16:52:54'),
('c03f16a6-6fe1-4d7f-983f-6444a2d4b957', '5de4ef9e-64a9-4f7f-ab22-d0d34a1e4cd1', '4268d7ad-9a02-4016-9224-764b98148ac6', 1, 18000, NULL, '', '2021-04-06 15:29:28', '2021-04-06 15:29:28'),
('c694bd3a-da00-450d-b982-74ad527e6969', '52790729-1c53-4fd6-849e-8d29e8229b0a', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, NULL, '2020-07-03 01:47:33', '2020-07-03 01:47:33'),
('cf749847-65ad-4357-bb70-08f6a4a8123a', 'd545abbc-807b-48a5-a818-4ded6d4ed92c', '4b5fbf3c-3e46-4b26-9b55-01282ce02375', 1, 25000, NULL, '+ Telor : 5000', '2020-11-07 14:07:54', '2020-11-07 14:07:54'),
('d201a8bb-c01e-4999-9c7c-c21879ebc95b', '92c87ead-9a2d-40dd-877a-584c3e4836df', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 12, 144000, NULL, NULL, '2020-10-20 13:20:34', '2020-10-20 13:20:34'),
('d7d4d065-5a5c-4d54-ab48-e23282b14cff', '04df00cf-4f35-4784-8f72-f387f143fb1b', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, NULL, '2020-08-04 23:10:24', '2020-08-04 23:10:24'),
('db1ad865-b5c2-475e-87b0-1e7f3f7169b7', '9323433b-4362-4bc4-b735-51558bd348e2', '107924bd-84af-4f77-9570-965b908938e3', 1, 12000, NULL, '', '2021-02-23 21:37:14', '2021-02-23 21:37:14'),
('e2367610-7404-4879-89ab-7b198e9a393a', 'c6304e92-1a3e-42e2-994c-3495766bd222', '1198e460-d9da-4530-8d81-b395a071fd5c', 1, 23000, NULL, '', '2021-02-25 13:14:13', '2021-02-25 13:14:13'),
('e3bc485d-6a75-4864-be0b-6cfc7619ec73', '5de4ef9e-64a9-4f7f-ab22-d0d34a1e4cd1', '107924bd-84af-4f77-9570-965b908938e3', 1, 12000, NULL, '', '2021-04-06 15:29:28', '2021-04-06 15:29:28'),
('ea991c5d-5605-48ed-929a-a31ba62d6bff', '88448d2f-1c06-4bb1-b29c-63c1fd277b3b', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, NULL, '2020-08-04 22:50:08', '2020-08-04 22:50:08'),
('f63e66d6-8cdc-4b11-b7c0-34acba7eb6b5', '7b62f969-1621-463f-8998-988ce32a9e56', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 1, 12000, NULL, NULL, '2020-07-03 01:51:02', '2020-07-03 01:51:02'),
('f9dfd1aa-31f4-4625-b8e1-f9ad07d240ef', 'a20fea05-3131-403c-9ce2-6da2e140d7c9', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 2, 24000, NULL, NULL, '2020-08-03 01:46:09', '2020-08-03 01:46:09'),
('fbb01413-b184-4e5a-b920-773b7a0171a4', 'b8122506-d451-4ccf-9b31-c43dbb7708c8', '7a31d915-ddd3-4d07-bedf-cadda5dc16c6', 12, 144000, NULL, NULL, '2020-08-01 02:06:38', '2020-08-01 02:06:38');

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
('018b8d48-04ec-4ecd-8fb8-33c55696aa9c', 'Gudang POS', 'gudang_pos', '$2y$10$AARaA0BNJ5q1RRJ3yzXUaeDNexo8n.X.F5fz7awEEB8eP3D.mhVBe', 1, 1, NULL, 0),
('5fcc4e88-979d-48c6-893c-4226b3432467', 'Kasir', 'kasir', '$2y$10$ATocz/kGbvihcRhUmDo1peZ2TjbdJtn.89xItZwxac3/RC4lmI3ES', 0, 1, 'lzPBU41oBzCTmSx4T29nAaZejtiNwRNpV5aVVpLAjEz5GFfSuZ61Ks9o1Hnu', 0),
('b5e10cbb-4c22-4005-9d4f-5e3e00766682', 'Administrator POS', 'admin', '$2y$10$KrVaeXG5f1pNKUN4VarP5u3WcP0h9nOGQqdRsmRpDyBydnagY0RbK', 2, 1, 'Sla1lZN1cEyYWYLad0rCDWTBGmtaXK8Pg0nJE9VdQncE3fByBnBErvmp6CUl', 0);

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
  ADD PRIMARY KEY (`id_barang_keluar_detail`),
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
-- Indexes for table `info_outlet`
--
ALTER TABLE `info_outlet`
  ADD PRIMARY KEY (`id_info_outlet`);

--
-- Indexes for table `item_jual`
--
ALTER TABLE `item_jual`
  ADD PRIMARY KEY (`id_item_jual`),
  ADD KEY `id_jenis_item` (`id_jenis_item`);

--
-- Indexes for table `item_jual_detail`
--
ALTER TABLE `item_jual_detail`
  ADD PRIMARY KEY (`id_item_jual_detail`),
  ADD KEY `menu_makan_detail_ibfk_1` (`id_item_jual`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenis_barang`);

--
-- Indexes for table `jenis_item`
--
ALTER TABLE `jenis_item`
  ADD PRIMARY KEY (`id_jenis_item`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD UNIQUE KEY `nomor_induk_karyawan` (`nomor_induk_karyawan`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `tagihan_detail`
--
ALTER TABLE `tagihan_detail`
  ADD PRIMARY KEY (`id_tagihan_detail`),
  ADD KEY `id_tagihan` (`id_tagihan`),
  ADD KEY `id_item_jual` (`id_item_jual`);

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
  ADD KEY `menu_makan_relation_transaksi_detail` (`id_item_jual`);

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
-- Constraints for table `item_jual`
--
ALTER TABLE `item_jual`
  ADD CONSTRAINT `item_jual_ibfk_1` FOREIGN KEY (`id_jenis_item`) REFERENCES `jenis_item` (`id_jenis_item`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `item_jual_detail`
--
ALTER TABLE `item_jual_detail`
  ADD CONSTRAINT `item_jual_detail_ibfk_1` FOREIGN KEY (`id_item_jual`) REFERENCES `item_jual` (`id_item_jual`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `tagihan_detail`
--
ALTER TABLE `tagihan_detail`
  ADD CONSTRAINT `tagihan_detail_ibfk_1` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan` (`id_tagihan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tagihan_detail_ibfk_2` FOREIGN KEY (`id_item_jual`) REFERENCES `item_jual` (`id_item_jual`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `users_relation_transaksi` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `menu_makan_relation_transaksi_detail` FOREIGN KEY (`id_item_jual`) REFERENCES `item_jual` (`id_item_jual`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_relation_transaksi_detail` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
