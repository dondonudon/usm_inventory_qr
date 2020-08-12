-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 12, 2020 at 04:02 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usm_inventory_qr`
--

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `id` varchar(2) NOT NULL COMMENT 'A=notrans, B=stock_opname, C=master_stok_kasir, D=retur_kasir',
  `counter` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id`, `counter`) VALUES
('A', 0),
('B', 75),
('C', 17),
('D', 0);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int NOT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `kode_m_kasir` varchar(10) DEFAULT NULL,
  `kode_barang` int NOT NULL,
  `qty` int NOT NULL,
  `tipe` varchar(1) NOT NULL COMMENT 'A=pabrik-gudang, B=gudang-kasir, C=penjualan, D=retur_kasir, E=gudang-agen',
  `datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `ket`, `kode_m_kasir`, `kode_barang`, `qty`, `tipe`, `datetime`) VALUES
(52, '8B2020040027', NULL, 8, 1, 'A', '2020-04-16 15:00:07'),
(53, '8B2020040028', NULL, 9, 2, 'A', '2020-04-19 09:57:00'),
(54, '8C2020060009', NULL, 8, 1, 'B', '2020-06-16 12:38:39'),
(55, '8B2020080029', NULL, 11, 1, 'A', '2020-08-02 22:11:58'),
(56, '8B2020080030', NULL, 12, 1, 'A', '2020-08-02 22:12:47'),
(57, '8B2020080031', NULL, 14, 4, 'A', '2020-08-02 22:23:46'),
(58, '8B2020080032', NULL, 17, 10, 'A', '2020-08-02 22:27:54'),
(59, '8B2020080033', NULL, 15, 2, 'A', '2020-08-02 22:29:17'),
(60, '8B2020080034', NULL, 18, 3, 'A', '2020-08-02 22:40:48'),
(61, '8B2020080035', NULL, 16, 2, 'A', '2020-08-02 22:42:44'),
(62, '8B2020080036', NULL, 19, 2, 'A', '2020-08-02 22:47:28'),
(63, '8C2020080015', NULL, 17, 1, 'B', '2020-08-03 07:36:44'),
(64, '8B2020080037', NULL, 20, 2, 'A', '2020-08-03 10:17:28'),
(65, '8B2020080038', NULL, 21, 1, 'A', '2020-08-03 10:29:46'),
(66, '8B2020080039', NULL, 23, 1, 'A', '2020-08-03 10:31:44'),
(67, '8B2020080040', NULL, 24, 3, 'A', '2020-08-03 10:32:39'),
(68, '8B2020080041', NULL, 25, 2, 'A', '2020-08-03 10:33:19'),
(69, '8B2020080042', NULL, 26, 1, 'A', '2020-08-03 10:33:57'),
(70, '8B2020080043', NULL, 27, 1, 'A', '2020-08-03 10:39:46'),
(71, '8B2020080044', NULL, 28, 3, 'A', '2020-08-03 10:41:45'),
(72, '8B2020080045', NULL, 29, 1, 'A', '2020-08-03 10:42:57'),
(73, '8B2020080046', NULL, 30, 4, 'A', '2020-08-03 10:43:37'),
(74, '8B2020080047', NULL, 31, 2, 'A', '2020-08-03 10:44:46'),
(75, '8B2020080048', NULL, 32, 1, 'A', '2020-08-03 10:45:27'),
(76, '8B2020080049', NULL, 33, 1, 'A', '2020-08-03 10:56:34'),
(77, '8B2020080050', NULL, 34, 1, 'A', '2020-08-03 11:05:35'),
(78, '8B2020080051', NULL, 35, 1, 'A', '2020-08-03 11:06:14'),
(79, '8B2020080052', NULL, 36, 1, 'A', '2020-08-03 11:11:12'),
(80, '8B2020080053', NULL, 37, 1, 'A', '2020-08-03 11:13:09'),
(81, '8B2020080054', NULL, 38, 1, 'A', '2020-08-03 11:15:15'),
(82, '8B2020080055', NULL, 39, 4, 'A', '2020-08-03 11:17:01'),
(83, '8B2020080056', NULL, 40, 1, 'A', '2020-08-03 11:17:53'),
(84, '8B2020080057', NULL, 14, 4, 'A', '2020-08-03 11:22:00'),
(85, '8B2020080058', NULL, 41, 1, 'A', '2020-08-09 10:49:15'),
(86, '8C2020080016', NULL, 17, 1, 'B', '2020-08-09 10:50:01'),
(87, '8B2020080059', NULL, 44, 1, 'A', '2020-08-09 11:27:37'),
(88, '8B2020080060', NULL, 45, 1, 'A', '2020-08-09 20:41:17'),
(89, '8B2020080061', NULL, 45, 1, 'A', '2020-08-09 20:43:37'),
(90, '8B2020080062', NULL, 46, 1, 'A', '2020-08-09 20:53:19'),
(91, '8B2020080063', NULL, 46, 2, 'A', '2020-08-09 20:54:17'),
(92, '8B2020080064', NULL, 47, 1, 'A', '2020-08-09 20:58:02'),
(93, '8B2020080065', NULL, 47, 2, 'A', '2020-08-09 21:01:09'),
(94, '8B2020080066', NULL, 47, 1, 'A', '2020-08-09 21:39:34'),
(95, '8B2020080067', NULL, 48, 7, 'A', '2020-08-09 21:45:05'),
(96, '8B2020080068', NULL, 48, 3, 'A', '2020-08-09 21:46:02'),
(97, '8B2020080069', NULL, 49, 8, 'A', '2020-08-10 00:05:38'),
(98, '8B2020080070', NULL, 49, 5, 'A', '2020-08-10 00:06:42'),
(99, '8B2020080071', NULL, 50, 1, 'A', '2020-08-10 00:14:20'),
(100, '8B2020080072', NULL, 51, 2, 'A', '2020-08-10 00:22:26'),
(101, '8B2020080073', NULL, 52, 1, 'A', '2020-08-10 00:27:06'),
(102, '8B2020080074', NULL, 51, 2, 'A', '2020-08-10 00:28:52'),
(103, '8B2020080075', NULL, 47, 2, 'A', '2020-08-12 14:58:31'),
(104, '8C2020080017', NULL, 47, 1, 'B', '2020-08-12 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_group`
--

CREATE TABLE `master_group` (
  `kode_group` int NOT NULL,
  `nama_group` varchar(30) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `master_group`
--

INSERT INTO `master_group` (`kode_group`, `nama_group`, `gambar`, `keterangan`, `datetime`) VALUES
(4, 'APE', 'g_1587023779.jpg', 'Indoor dan Outdoor', '2020-04-16 14:56:19'),
(5, 'Peralatan Dapur', 'g_1587264154.jpg', '-', '2020-04-19 09:42:34'),
(6, 'Peralatan Kelas', 'g_1596362395.jpg', '-', '2020-08-02 16:59:55'),
(8, 'Peralatan Kebersihan', 'g_1596944792.jpg', '-', '2020-08-09 10:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `master_kasir`
--

CREATE TABLE `master_kasir` (
  `kode_m_kasir` int NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL,
  `PIC` varchar(30) DEFAULT NULL,
  `url` varchar(225) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `id_users` int NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `master_stok_kasir`
--

CREATE TABLE `master_stok_kasir` (
  `id_s_kasir` int NOT NULL,
  `nostokkasir` varchar(12) NOT NULL,
  `nota` varchar(15) DEFAULT NULL,
  `ket` varchar(20) DEFAULT NULL,
  `id_user` int NOT NULL,
  `retur` int NOT NULL DEFAULT '0',
  `qrcode` varchar(100) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `master_stok_kasir`
--

INSERT INTO `master_stok_kasir` (`id_s_kasir`, `nostokkasir`, `nota`, `ket`, `id_user`, `retur`, `qrcode`, `tanggal`, `datetime`) VALUES
(19, '8C2020080015', NULL, 'Gramedia Semarang', 8, 0, '8C20200800151596415004.png', '2020-08-03', '2020-08-03 07:36:44'),
(20, '8C2020080016', NULL, 'Gramedia Semarang', 8, 0, '8C20200800161596945001.png', '2020-08-09', '2020-08-09 10:50:01'),
(21, '8C2020080017', NULL, 'asd', 8, 0, '8C20200800171597219200.png', '2020-08-12', '2020-08-12 15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_stok_kasir_detail`
--

CREATE TABLE `master_stok_kasir_detail` (
  `nostokkasir` varchar(12) NOT NULL,
  `id_s_kasir` int NOT NULL,
  `kode_barang` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `alasan` varchar(15) NOT NULL,
  `qrcode` varchar(100) NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `master_stok_kasir_detail`
--

INSERT INTO `master_stok_kasir_detail` (`nostokkasir`, `id_s_kasir`, `kode_barang`, `stok`, `alasan`, `qrcode`, `datetime`) VALUES
('8C2020060009', 0, 8, 1, 'Rusak', '8C20200600091592285901.png', '2020-06-16 12:38:21'),
('8C2020080010', 0, 9, 2, 'Rusak', '8C20200800101596382416.png', '2020-08-02 22:33:36'),
('8C2020080015', 0, 17, 1, 'Rusak', '8C20200800151596415002.png', '2020-08-03 07:36:42'),
('8C2020080016', 0, 17, 1, 'Rusak', '8C20200800161596944974.png', '2020-08-09 10:49:34'),
('8C2020080017', 0, 47, 1, 'Rusak', '8C20200800171597219198.png', '2020-08-12 14:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `stock_opname`
--

CREATE TABLE `stock_opname` (
  `id_stock_opname` int NOT NULL,
  `nostockopname` varchar(12) NOT NULL,
  `nota` varchar(15) DEFAULT NULL,
  `ket` varchar(50) NOT NULL,
  `id_user` int NOT NULL,
  `jumlah` int NOT NULL,
  `qrcode` varchar(100) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `sumber` varchar(50) NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `stock_opname`
--

INSERT INTO `stock_opname` (`id_stock_opname`, `nostockopname`, `nota`, `ket`, `id_user`, `jumlah`, `qrcode`, `tanggal`, `sumber`, `datetime`) VALUES
(39, '8B2020080039', NULL, 'ToysKingdom', 8, 899000, '8B20200800391596425504.png', '2019-09-10', 'Bantuan Dana APE 2019', '2020-08-03 10:31:44'),
(38, '8B2020080038', NULL, 'ILC Semarang', 8, 179000, '8B20200800381596425386.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 10:29:46'),
(29, '8B2020080029', NULL, 'Children Toys', 8, 465000, '8B20200800291596381118.png', '2019-12-09', 'Bantuan Dana APE 2019', '2020-08-02 22:11:58'),
(30, '8B2020080030', NULL, 'Children Toys', 8, 435000, '8B20200800301596381167.png', '2019-09-13', 'Bantuan Dana APE 2019', '2020-08-02 22:12:47'),
(32, '8B2020080032', NULL, 'Gramedia Semarang', 8, 590000, '8B20200800321596382074.png', '2019-09-10', 'Bantuan Dana APE 2019', '2020-08-02 22:27:54'),
(33, '8B2020080033', NULL, 'Gramedia Semarang', 8, 900000, '8B20200800331596382157.png', '2019-09-10', 'Bantuan Dana APE 2019', '2020-08-02 22:29:17'),
(34, '8B2020080034', NULL, 'ILC Semarang', 8, 297000, '8B20200800341596382848.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-02 22:40:48'),
(35, '8B2020080035', NULL, 'ILC Semarang', 8, 658000, '8B20200800351596382964.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-02 22:42:44'),
(36, '8B2020080036', NULL, 'ILC Semarang', 8, 658000, '8B20200800361596383248.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-02 22:47:28'),
(37, '8B2020080037', NULL, 'ILC Semarang', 8, 1158000, '8B20200800371596424648.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 10:17:28'),
(40, '8B2020080040', NULL, 'ILC Semarang', 8, 1047000, '8B20200800401596425559.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 10:32:39'),
(41, '8B2020080041', NULL, 'ILC Semarang', 8, 1198000, '8B20200800411596425599.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 10:33:19'),
(42, '8B2020080042', NULL, 'ILC Semarang', 8, 329000, '8B20200800421596425637.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 10:33:57'),
(43, '8B2020080043', NULL, 'ILC Semarang', 8, 349000, '8B20200800431596425986.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 10:39:46'),
(44, '8B2020080044', NULL, 'ILC Semarang', 8, 1587000, '8B20200800441596426105.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 10:41:45'),
(45, '8B2020080045', NULL, 'ILC Semarang', 8, 449000, '8B20200800451596426177.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 10:42:57'),
(46, '8B2020080046', NULL, 'ILC Semarang', 8, 316000, '8B20200800461596426217.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 10:43:37'),
(47, '8B2020080047', NULL, 'ILC Semarang', 8, 199900, '8B20200800471596426286.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 10:44:46'),
(48, '8B2020080048', NULL, 'ILC Semarang', 8, 99950, '8B20200800481596426327.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 10:45:27'),
(49, '8B2020080049', NULL, 'ILC Semarang', 8, 99950, '8B20200800491596426993.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 10:56:33'),
(50, '8B2020080050', NULL, 'ILC Semarang', 8, 49950, '8B20200800501596427535.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 11:05:35'),
(51, '8B2020080051', NULL, 'ILC Semarang', 8, 49950, '8B20200800511596427574.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 11:06:14'),
(52, '8B2020080052', NULL, 'ILC Semarang', 8, 2299900, '8B20200800521596427872.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 11:11:12'),
(53, '8B2020080053', NULL, 'ToysKingdom', 8, 899900, '8B20200800531596427989.png', '2019-09-10', 'Bantuan Dana APE 2019', '2020-08-03 11:13:09'),
(54, '8B2020080054', NULL, 'ILC Semarang', 8, 123900, '8B20200800541596428114.png', '2019-09-10', 'Bantuan Dana APE 2019', '2020-08-03 11:15:14'),
(55, '8B2020080055', NULL, 'ILC Semarang', 8, 799600, '8B20200800551596428221.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-03 11:17:01'),
(56, '8B2020080056', NULL, 'ToysKingdom', 8, 599000, '8B20200800561596428272.png', '2019-09-10', 'Bantuan Dana APE 2019', '2020-08-03 11:17:52'),
(59, '8B2020080059', NULL, 'ToysKingdom', 8, 1133900, '8B20200800591596947257.png', '2019-09-22', 'Bantuan Dana APE 2019', '2020-08-09 11:27:37'),
(68, '8B2020080068', NULL, 'Informa', 8, 389700, '8B20200800681596984362.png', '2019-06-12', 'Dana Sekolah', '2020-08-09 21:46:02'),
(67, '8B2020080067', NULL, 'Informa', 8, 909300, '8B20200800671596984304.png', '2019-06-11', 'Dana Sekolah', '2020-08-09 21:45:04'),
(64, '8B2020080064', NULL, 'Informa', 8, 129900, '8B20200800641596981482.png', '2019-06-10', 'Dana Sekolah', '2020-08-09 20:58:02'),
(65, '8B2020080065', NULL, 'Informa', 8, 259800, '8B20200800651596981669.png', '2019-06-10', 'Dana Sekolah', '2020-08-09 21:01:09'),
(66, '8B2020080066', NULL, 'Informa', 8, 129900, '8B20200800661596983974.png', '2019-06-12', 'Dana Sekolah', '2020-08-09 21:39:34'),
(69, '8B2020080069', NULL, 'Informa', 8, 1039200, '8B20200800691596992738.png', '2019-06-12', 'Dana Sekolah', '2020-08-10 00:05:38'),
(70, '8B2020080070', NULL, 'Informa', 8, 649500, '8B20200800701596992802.png', '2019-06-13', 'Dana Sekolah', '2020-08-10 00:06:42'),
(71, '8B2020080071', NULL, 'Blimbing Sari', 8, 450000, '8B20200800711596993260.png', '2018-06-14', 'Dana Sekolah', '2020-08-10 00:14:20'),
(72, '8B2020080072', NULL, 'Blimbing Sari', 8, 40000, '8B20200800721596993746.png', '2017-06-09', 'Dana Sekolah', '2020-08-10 00:22:26'),
(73, '8B2020080073', NULL, 'ToysKingdom', 8, 1500000, '8B20200800731596994026.png', '2018-06-14', 'Dana Sekolah', '2020-08-10 00:27:06'),
(74, '8B2020080074', NULL, 'Blimbing Sari', 8, 40000, '8B20200800741596994132.png', '2019-06-10', 'Dana Sekolah', '2020-08-10 00:28:52'),
(75, '8B2020080075', NULL, 'asd', 8, 4000, '8B20200800751597219111.png', '2020-08-12', 'dsa', '2020-08-12 14:58:31');

-- --------------------------------------------------------

--
-- Table structure for table `stock_opname_detail`
--

CREATE TABLE `stock_opname_detail` (
  `nostockopname` varchar(12) NOT NULL,
  `id_stock_opname` int NOT NULL,
  `kode_barang` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `lokasi` varchar(20) NOT NULL,
  `qrcode` varchar(100) NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `stock_opname_detail`
--

INSERT INTO `stock_opname_detail` (`nostockopname`, `id_stock_opname`, `kode_barang`, `stok`, `harga`, `jumlah`, `lokasi`, `qrcode`, `datetime`) VALUES
('8B2020040027', 0, 8, 1, 465000, 465000, 'Playgroup B', '8B20200400271587023999.png', '2020-04-16 14:59:59'),
('8B2020040028', 0, 9, 2, 249000, 498000, 'Kindergarten A', '8B20200400281587265016.png', '2020-04-19 09:56:56'),
('8B2020080029', 0, 11, 1, 465000, 465000, 'Kindergarten A', '8B20200800291596381113.png', '2020-08-02 22:11:53'),
('8B2020080030', 0, 12, 1, 435000, 435000, 'Kindergarten A', '8B20200800301596381164.png', '2020-08-02 22:12:44'),
('8B2020080032', 0, 17, 10, 59000, 590000, 'Playgroup A', '8B20200800321596382071.png', '2020-08-02 22:27:51'),
('8B2020080033', 0, 15, 2, 450000, 900000, 'Kindergarten B', '8B20200800331596382155.png', '2020-08-02 22:29:15'),
('8B2020080034', 0, 18, 3, 99000, 297000, 'Playgroup B', '8B20200800341596382845.png', '2020-08-02 22:40:45'),
('8B2020080035', 0, 16, 2, 329000, 658000, 'Kindergarten A', '8B20200800351596382962.png', '2020-08-02 22:42:42'),
('8B2020080036', 0, 19, 2, 329000, 658000, 'Kindergarten A', '8B20200800361596383245.png', '2020-08-02 22:47:25'),
('8B2020080037', 0, 20, 2, 579000, 1158000, 'Kindergarten A', '8B20200800371596424642.png', '2020-08-03 10:17:22'),
('8B2020080038', 0, 21, 1, 179000, 179000, 'Kindergarten A', '8B20200800381596425382.png', '2020-08-03 10:29:42'),
('8B2020080039', 0, 23, 1, 899000, 899000, 'Kindergarten B', '8B20200800391596425500.png', '2020-08-03 10:31:40'),
('8B2020080040', 0, 24, 3, 349000, 1047000, 'Kindergarten B', '8B20200800401596425556.png', '2020-08-03 10:32:36'),
('8B2020080041', 0, 25, 2, 599000, 1198000, 'Kindergarten B', '8B20200800411596425597.png', '2020-08-03 10:33:17'),
('8B2020080042', 0, 26, 1, 329000, 329000, 'Kindergarten A', '8B20200800421596425635.png', '2020-08-03 10:33:55'),
('8B2020080043', 0, 27, 1, 349000, 349000, 'Kindergarten B', '8B20200800431596425983.png', '2020-08-03 10:39:43'),
('8B2020080044', 0, 28, 3, 529000, 1587000, 'Kindergarten B', '8B20200800441596426103.png', '2020-08-03 10:41:43'),
('8B2020080045', 0, 29, 1, 449000, 449000, 'Kindergarten B', '8B20200800451596426175.png', '2020-08-03 10:42:55'),
('8B2020080046', 0, 30, 4, 79000, 316000, 'Kindergarten A', '8B20200800461596426209.png', '2020-08-03 10:43:29'),
('8B2020080047', 0, 31, 2, 99950, 199900, 'Kindergarten B', '8B20200800471596426279.png', '2020-08-03 10:44:39'),
('8B2020080048', 0, 32, 1, 99950, 99950, 'Kindergarten B', '8B20200800481596426325.png', '2020-08-03 10:45:25'),
('8B2020080049', 0, 33, 1, 99950, 99950, 'Kindergarten B', '8B20200800491596426989.png', '2020-08-03 10:56:29'),
('8B2020080050', 0, 34, 1, 49950, 49950, 'Kindergarten A', '8B20200800501596427526.png', '2020-08-03 11:05:26'),
('8B2020080051', 0, 35, 1, 49950, 49950, 'Kindergarten A', '8B20200800511596427568.png', '2020-08-03 11:06:08'),
('8B2020080052', 0, 36, 1, 2299900, 2299900, 'Kindergarten B', '8B20200800521596427868.png', '2020-08-03 11:11:08'),
('8B2020080053', 0, 37, 1, 899900, 899900, 'Kindergarten B', '8B20200800531596427985.png', '2020-08-03 11:13:05'),
('8B2020080054', 0, 38, 1, 123900, 123900, 'Playgroup A', '8B20200800541596428112.png', '2020-08-03 11:15:12'),
('8B2020080055', 0, 39, 4, 199900, 799600, 'Playgroup B', '8B20200800551596428219.png', '2020-08-03 11:16:59'),
('8B2020080056', 0, 40, 1, 599000, 599000, 'Playgroup B', '8B20200800561596428268.png', '2020-08-03 11:17:48'),
('8B2020080059', 0, 44, 1, 1133900, 1133900, 'Playgroup B', '8B20200800591596947250.png', '2020-08-09 11:27:30'),
('8B2020080068', 0, 48, 3, 129900, 389700, 'Playgroup B', '8B20200800681596984356.png', '2020-08-09 21:45:56'),
('8B2020080067', 0, 48, 7, 129900, 909300, 'Playgroup A', '8B20200800671596984300.png', '2020-08-09 21:45:00'),
('8B2020080064', 0, 47, 1, 129900, 129900, 'Playgroup B', '8B20200800641596981479.png', '2020-08-09 20:57:59'),
('8B2020080065', 0, 47, 2, 129900, 259800, 'Playgroup B', '8B20200800651596981665.png', '2020-08-09 21:01:05'),
('8B2020080066', 0, 47, 1, 129900, 129900, 'Playgroup B', '8B20200800661596983970.png', '2020-08-09 21:39:30'),
('8B2020080069', 0, 49, 8, 129900, 1039200, 'Playgroup B', '8B20200800691596992724.png', '2020-08-10 00:05:24'),
('8B2020080070', 0, 49, 5, 129900, 649500, 'Playgroup A', '8B20200800701596992796.png', '2020-08-10 00:06:36'),
('8B2020080071', 0, 50, 1, 450000, 450000, 'Dapur', '8B20200800711596993251.png', '2020-08-10 00:14:11'),
('8B2020080072', 0, 51, 2, 20000, 40000, 'Ruang Kebersihan', '8B20200800721596993738.png', '2020-08-10 00:22:18'),
('8B2020080073', 0, 52, 1, 1500000, 1500000, 'Kindergarten B', '8B20200800731596994018.png', '2020-08-10 00:26:58'),
('8B2020080074', 0, 51, 2, 20000, 40000, 'Ruang Kebersihan', '8B20200800741596994126.png', '2020-08-10 00:28:46'),
('8B2020080075', 0, 47, 2, 2000, 4000, 'asd', '8B20200800751597219108.png', '2020-08-12 14:58:28');

-- --------------------------------------------------------

--
-- Table structure for table `tab_barang`
--

CREATE TABLE `tab_barang` (
  `kode_barang` int NOT NULL,
  `kode_manual` varchar(15) DEFAULT NULL,
  `kode_group` int DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `gambar` varchar(225) DEFAULT NULL,
  `spesifikasi` varchar(20) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `stok` int DEFAULT '0',
  `keterangan` varchar(50) DEFAULT NULL,
  `del` int NOT NULL DEFAULT '0',
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tab_barang`
--

INSERT INTO `tab_barang` (`kode_barang`, `kode_manual`, `kode_group`, `nama`, `gambar`, `spesifikasi`, `merk`, `stok`, `keterangan`, `del`, `datetime`) VALUES
(11, NULL, 4, 'Balok Umum', 'b_1596362668.jpg', 'Kayu', 'Children Toys', 1, 'indoor', 0, '2020-08-02 22:11:58'),
(12, NULL, 4, 'Balok Masjid', 'b_1596362831.jpg', 'Kayu', 'Children Toys', 1, 'indoor', 0, '2020-08-02 22:12:47'),
(15, NULL, 4, 'Pianika', 'b_1596363482.jpg', 'Plastik', 'Yamaha', 2, 'indoor', 0, '2020-08-02 22:29:17'),
(16, NULL, 4, 'Wooden Shape Sorter', 'b_1596364014.jpg', 'Kayu', 'ILC', 2, 'indoor', 0, '2020-08-02 22:42:44'),
(17, NULL, 4, 'Buku Cerita Anak', 'b_1596365254.jpg', 'Kertas', 'Pelangi Mizan', 8, 'indoor', 0, '2020-08-09 10:50:01'),
(18, NULL, 4, 'Star Links', 'b_1596365482.jpg', 'Plastik', 'ILC', 3, 'indoor', 0, '2020-08-02 22:40:48'),
(19, NULL, 4, 'Wooden Hammer Bench', 'b_1596365535.jpg', 'Kayu', 'ILC', 2, 'indoor', 0, '2020-08-02 22:47:28'),
(20, NULL, 4, 'Cup Ckae Twin Dolls', 'b_1596366426.jpg', 'Plastik', 'ILC', 2, 'indoor', 0, '2020-08-03 10:17:28'),
(21, NULL, 4, 'Wooden Stacking Rings', 'b_1596366512.jpg', 'Kayu', 'ILC', 1, 'indoor', 0, '2020-08-03 10:29:46'),
(22, NULL, 4, 'Wooden Stacking Rings', 'b_1596366512.jpg', 'Kayu', 'ILC', 0, 'indoor', 1, '2020-08-02 22:46:08'),
(23, NULL, 4, 'Sand and Water Table Generic', 'b_1596366618.jpg', 'Plastik', 'ToysKingdom', 1, 'outdoor', 0, '2020-08-03 10:31:44'),
(24, NULL, 4, 'My Magnetic Pattern Board', 'b_1596366768.jpg', 'Kayu', 'ILC', 3, 'indoor', 0, '2020-08-03 10:32:39'),
(25, NULL, 4, 'Magnetic Playcentre Red', 'b_1596366869.jpg', 'Plastik', 'ILC', 2, 'indoor', 0, '2020-08-03 10:33:19'),
(26, NULL, 4, 'Wooden Bricks', 'b_1596366959.jpg', 'Kayu', 'ILC', 1, 'indoor', 0, '2020-08-03 10:33:57'),
(27, NULL, 4, 'Wooden Dairy Set', 'b_1596371543.jpg', 'Kayu', 'ILC', 1, 'indoor', 0, '2020-08-03 10:39:46'),
(28, NULL, 4, 'Cash Register', 'b_1596371611.jpg', 'Plastik', 'ILC', 3, 'indoor', 0, '2020-08-03 10:41:45'),
(29, NULL, 4, 'Table Top Art Centre', 'b_1596371729.jpg', 'Plastik', 'ILC', 1, 'indoor', 0, '2020-08-03 10:42:57'),
(30, NULL, 4, 'Magnifying Glass', 'b_1596372121.jpg', 'Plastik', 'ILC', 4, 'indoor', 0, '2020-08-03 10:43:37'),
(31, NULL, 4, 'Brainbox-Flash cards ABC', 'b_1596372199.jpg', 'Kertas', 'ILC', 2, 'indoor', 0, '2020-08-03 10:44:46'),
(32, NULL, 4, 'Brainbox-Flash Cards Picture', 'b_1596372278.jpg', 'Kertas', 'ILC', 1, 'indoor', 0, '2020-08-03 10:45:27'),
(33, NULL, 4, 'Brainbox-Flash Cards People', 'b_1596372336.jpg', 'Kertas', 'ILC', 1, 'indoor', 0, '2020-08-03 10:56:34'),
(34, NULL, 4, 'Kid Puzzle  Associativity', 'b_1596372510.jpg', 'Kayu', 'ILC', 1, 'indoor', 0, '2020-08-03 11:05:35'),
(35, NULL, 4, 'Kid Puzzle  Numbers', 'b_1596372554.jpg', 'Kayu', 'ILC', 1, 'indoor', 0, '2020-08-03 11:06:14'),
(36, NULL, 4, 'Step 2-Studio Art Desk', 'b_1596372731.jpg', 'Plastik', 'ILC', 1, 'indoor', 0, '2020-08-03 11:11:12'),
(37, NULL, 4, 'Kitchen With Light & Sound', 'b_1596372883.jpg', 'Plastik', 'ToysKingdom', 1, 'indoor', 0, '2020-08-03 11:13:09'),
(38, NULL, 4, 'Little Giggles Baby Training', 'b_1596372947.jpg', 'Plastik', 'ILC', 1, 'indoor', 0, '2020-08-03 11:15:15'),
(39, NULL, 4, 'Toys Doctor Playset', 'b_1596373011.jpg', 'Plastik', 'ToysKingdom', 4, 'indoor', 0, '2020-08-03 11:17:01'),
(40, NULL, 4, 'Labeille-Rocking Horse', 'b_1596373261.jpg', 'Plastik', 'ToysKingdom', 1, 'indoor', 0, '2020-08-03 11:17:53'),
(47, NULL, 6, 'Kursi Yaris Hijau', 'b_1596981377.jpg', 'Plastik', 'Yaris', 5, 'indoor', 0, '2020-08-12 15:00:00'),
(44, NULL, 4, 'Smoby-Slide', 'b_1596947180.jpg', 'Plastik', 'ToysKingdom', 1, 'indoor', 0, '2020-08-09 11:27:37'),
(48, NULL, 6, 'Kursi Yaris Kuning', 'b_1596984231.jpg', 'Plastik', 'Yaris', 10, 'indoor', 0, '2020-08-09 21:46:02'),
(49, NULL, 6, 'Kursi Yaris Merah', 'b_1596992636.jpg', 'Plastik', 'Yaris', 13, 'indoor', 0, '2020-08-10 00:06:42'),
(50, NULL, 5, 'Rak Piring', 'b_1596993164.jpg', 'Plastik', 'Rovega', 1, 'indoor', 0, '2020-08-10 00:14:20'),
(51, '1597247993.png', 8, 'Sapu', 'b_1596993669.jpg', 'Kayu', 'Cap Macan', 4, 'indoor', 0, '2020-08-12 22:59:53'),
(52, '1597247981.png', 4, 'Piano', 'b_1596993911.jpg', 'Kayu', 'ToysKingdom', 1, 'indoor', 0, '2020-08-12 22:59:41'),
(55, '1597218073.png', 5, 'asd', 'b_1597218073.jpg', 'dsa', 'asd', 0, 'dsa', 0, '2020-08-12 14:41:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int NOT NULL,
  `id_user_level` int NOT NULL,
  `id_menu` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_hak_akses`
--

INSERT INTO `tbl_hak_akses` (`id`, `id_user_level`, `id_menu`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 4),
(5, 2, 6),
(6, 2, 9),
(7, 2, 11),
(8, 2, 12),
(9, 2, 15),
(10, 2, 16),
(19, 6, 12),
(12, 2, 20),
(13, 2, 21),
(14, 2, 24),
(15, 2, 25),
(16, 2, 31),
(18, 6, 15),
(20, 6, 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `id_menu` int NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int NOT NULL,
  `urutan` int NOT NULL DEFAULT '0',
  `is_aktif` enum('y','n') NOT NULL COMMENT 'y=yes,n=no'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`id_menu`, `title`, `url`, `icon`, `is_main_menu`, `urutan`, `is_aktif`) VALUES
(1, 'KELOLA MENU', 'kelolamenu', 'fa fa-server', 0, 0, 'y'),
(2, 'KELOLA PENGGUNA', 'user', 'fa fa-user-o', 0, 0, 'y'),
(3, 'level PENGGUNA', 'userlevel', 'fa fa-users', 0, 0, 'y'),
(4, 'Master Group', 'master_group', 'fa fa-book', 20, 0, 'y'),
(6, 'Master Barang', 'tab_barang', 'fa fa-pencil', 20, 0, 'y'),
(9, 'Barang Masuk', 'stock_opname', 'fa fa-plus', 21, 0, 'y'),
(11, 'Barang Hilang/Rusak', 'master_stok_kasir', 'fa fa-minus', 21, 0, 'y'),
(12, 'Barang Hilang/Rusak', 'laporan_barang_keluar', 'fa fa-newspaper-o', 15, 3, 'y'),
(15, 'Laporan', '#', 'fa fa-area-chart', 0, 3, 'y'),
(16, 'Barang Masuk', 'laporan_barang_masuk', 'fa fa-paperclip', 15, 1, 'y'),
(0, 'Welcome', 'welcome', '', 0, 0, 'y'),
(20, 'Master Data', '#', 'fa fa-database', 0, 1, 'y'),
(21, 'Barang Aset', '#', 'fa fa-opencart', 0, 2, 'y'),
(5, 'profile', 'profile', '', 0, 0, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`id_setting`, `nama_setting`, `value`) VALUES
(1, 'Tampil Menu', 'ya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_users` int NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int NOT NULL,
  `is_aktif` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `is_aktif`) VALUES
(1, 'super', 'super@super.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 1, 1),
(106, 'kepsek', 'kepsek', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 6, 1),
(8, 'admin', 'admin@admin.com', '$2y$04$Wbyfv4xwihb..POfhxY5Y.jHOJqEFIG3dLfBYwAmnOACpH0EWCCdq', 'atomix_user31.png', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int NOT NULL,
  `nama_level` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_user_level`
--

INSERT INTO `tbl_user_level` (`id_user_level`, `nama_level`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(6, 'View');

-- --------------------------------------------------------

--
-- Table structure for table `temp_master_stok_kasir`
--

CREATE TABLE `temp_master_stok_kasir` (
  `id_s_kasir` int NOT NULL,
  `nostokkasir` varchar(12) NOT NULL,
  `kode_barang` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `alasan` varchar(15) NOT NULL,
  `qrcode` varchar(100) NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `temp_stock_opname`
--

CREATE TABLE `temp_stock_opname` (
  `id_stock_opname` int NOT NULL,
  `nostockopname` varchar(12) NOT NULL,
  `kode_barang` int DEFAULT NULL,
  `stok` int DEFAULT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `lokasi` varchar(20) NOT NULL,
  `qrcode` varchar(100) NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `master_group`
--
ALTER TABLE `master_group`
  ADD PRIMARY KEY (`kode_group`) USING BTREE;

--
-- Indexes for table `master_kasir`
--
ALTER TABLE `master_kasir`
  ADD PRIMARY KEY (`kode_m_kasir`) USING BTREE;

--
-- Indexes for table `master_stok_kasir`
--
ALTER TABLE `master_stok_kasir`
  ADD PRIMARY KEY (`id_s_kasir`) USING BTREE;

--
-- Indexes for table `master_stok_kasir_detail`
--
ALTER TABLE `master_stok_kasir_detail`
  ADD PRIMARY KEY (`nostokkasir`);

--
-- Indexes for table `stock_opname`
--
ALTER TABLE `stock_opname`
  ADD PRIMARY KEY (`id_stock_opname`) USING BTREE;

--
-- Indexes for table `stock_opname_detail`
--
ALTER TABLE `stock_opname_detail`
  ADD PRIMARY KEY (`nostockopname`);

--
-- Indexes for table `tab_barang`
--
ALTER TABLE `tab_barang`
  ADD PRIMARY KEY (`kode_barang`) USING BTREE,
  ADD UNIQUE KEY `kode_manual` (`kode_manual`);

--
-- Indexes for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`id_menu`) USING BTREE;

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`id_setting`) USING BTREE;

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_users`) USING BTREE;

--
-- Indexes for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  ADD PRIMARY KEY (`id_user_level`) USING BTREE;

--
-- Indexes for table `temp_master_stok_kasir`
--
ALTER TABLE `temp_master_stok_kasir`
  ADD PRIMARY KEY (`id_s_kasir`) USING BTREE;

--
-- Indexes for table `temp_stock_opname`
--
ALTER TABLE `temp_stock_opname`
  ADD PRIMARY KEY (`id_stock_opname`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `master_group`
--
ALTER TABLE `master_group`
  MODIFY `kode_group` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `master_kasir`
--
ALTER TABLE `master_kasir`
  MODIFY `kode_m_kasir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `master_stok_kasir`
--
ALTER TABLE `master_stok_kasir`
  MODIFY `id_s_kasir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `stock_opname`
--
ALTER TABLE `stock_opname`
  MODIFY `id_stock_opname` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tab_barang`
--
ALTER TABLE `tab_barang`
  MODIFY `kode_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `temp_master_stok_kasir`
--
ALTER TABLE `temp_master_stok_kasir`
  MODIFY `id_s_kasir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=696;

--
-- AUTO_INCREMENT for table `temp_stock_opname`
--
ALTER TABLE `temp_stock_opname`
  MODIFY `id_stock_opname` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=593;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
