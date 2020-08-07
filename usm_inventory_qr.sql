-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 07, 2020 at 08:45 AM
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
('B', 36),
('C', 14),
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
(62, '8B2020080036', NULL, 19, 2, 'A', '2020-08-02 22:47:28');

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
(6, 'Peralatan Kelas', 'g_1596362395.jpg', '-', '2020-08-02 16:59:55');

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
(10, '8C2020060009', NULL, 'Children Toys', 8, 0, '8C20200600091592285919.png', '2020-06-16', '2020-06-16 12:38:39'),
(11, '8C2020080010', NULL, 'Children Toys', 8, 0, '8C20200800101596382420.png', '2020-08-02', '2020-08-02 22:33:40'),
(18, '8C2020080014', NULL, 'asd', 8, 0, '8C20200800141596389087.png', '2020-08-03', '2020-08-03 00:24:47');

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
('8C2020080010', 0, 9, 2, 'Rusak', '8C20200800101596382416.png', '2020-08-02 22:33:36');

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
(27, '8B2020040027', NULL, 'Children Toys', 8, 465000, '8B20200400271587024007.png', '2019-09-22', 'Bantuan Dana APE 2019', '2020-04-16 15:00:07'),
(28, '8B2020040028', NULL, 'ILC Paragon Semarang', 8, 498000, '8B20200400281587265019.png', '2019-09-06', 'Dana Bantuan APE 2019', '2020-04-19 09:56:59'),
(29, '8B2020080029', NULL, 'Children Toys', 8, 465000, '8B20200800291596381118.png', '2019-12-09', 'Bantuan Dana APE 2019', '2020-08-02 22:11:58'),
(30, '8B2020080030', NULL, 'Children Toys', 8, 435000, '8B20200800301596381167.png', '2019-09-13', 'Bantuan Dana APE 2019', '2020-08-02 22:12:47'),
(31, '8B2020080031', NULL, 'Children Toys', 8, 658000, '8B20200800311596381826.png', '2009-09-13', 'Bantuan Dana APE 2019', '2020-08-02 22:23:46'),
(32, '8B2020080032', NULL, 'Gramedia Semarang', 8, 590000, '8B20200800321596382074.png', '2019-09-10', 'Bantuan Dana APE 2019', '2020-08-02 22:27:54'),
(33, '8B2020080033', NULL, 'Gramedia Semarang', 8, 900000, '8B20200800331596382157.png', '2019-09-10', 'Bantuan Dana APE 2019', '2020-08-02 22:29:17'),
(34, '8B2020080034', NULL, 'ILC Semarang', 8, 297000, '8B20200800341596382848.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-02 22:40:48'),
(35, '8B2020080035', NULL, 'ILC Semarang', 8, 658000, '8B20200800351596382964.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-02 22:42:44'),
(36, '8B2020080036', NULL, 'ILC Semarang', 8, 658000, '8B20200800361596383248.png', '2019-09-06', 'Bantuan Dana APE 2019', '2020-08-02 22:47:28');

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
('8B2020080031', 0, 14, 4, 164500, 658000, 'Kindergarten A', '8B20200800311596381823.png', '2020-08-02 22:23:43'),
('8B2020080032', 0, 17, 10, 59000, 590000, 'Playgroup A', '8B20200800321596382071.png', '2020-08-02 22:27:51'),
('8B2020080033', 0, 15, 2, 450000, 900000, 'Kindergarten B', '8B20200800331596382155.png', '2020-08-02 22:29:15'),
('8B2020080034', 0, 18, 3, 99000, 297000, 'Playgroup B', '8B20200800341596382845.png', '2020-08-02 22:40:45'),
('8B2020080035', 0, 16, 2, 329000, 658000, 'Kindergarten A', '8B20200800351596382962.png', '2020-08-02 22:42:42'),
('8B2020080036', 0, 19, 2, 329000, 658000, 'Kindergarten A', '8B20200800361596383245.png', '2020-08-02 22:47:25');

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
(8, NULL, 4, 'Wooden Teaching Clock', 'b_1587264249.jpg', 'Kayu', 'ILC', 0, '-', 1, '2020-06-30 20:48:46'),
(9, NULL, 4, 'Wooden Teaching Clock', 'b_1587264249.jpg', 'Kayu', 'ILC', 2, 'indoor', 0, '2020-08-02 17:19:09'),
(11, NULL, 4, 'Balok Umum', 'b_1596362668.jpg', 'Kayu', 'Children Toys', 1, 'indoor', 0, '2020-08-02 22:11:58'),
(12, NULL, 4, 'Balok Masjid', 'b_1596362831.jpg', 'Kayu', 'Children Toys', 1, 'indoor', 0, '2020-08-02 22:12:47'),
(13, NULL, 4, 'Balok Kandang Warna', 'b_1596362921.jpg', 'Kayu', 'Children Toys', 0, 'indoor', 0, '2020-08-02 17:53:43'),
(14, NULL, 4, 'Asesoris Balok Kandang Warna', 'b_1596363375.jpg', 'Kayu', 'Children Toys', 4, 'indoor', 0, '2020-08-02 22:23:46'),
(15, NULL, 4, 'Pianika', 'b_1596363482.jpg', 'Plastik', 'Yamaha', 2, 'indoor', 0, '2020-08-02 22:29:17'),
(16, NULL, 4, 'Wooden Shape Sorter', 'b_1596364014.jpg', 'Kayu', 'ILC', 2, 'indoor', 0, '2020-08-02 22:42:44'),
(17, NULL, 4, 'Buku Cerita Anak', 'b_1596365254.jpg', 'Kertas', 'Pelangi Mizan', 10, 'indoor', 0, '2020-08-02 22:27:54'),
(18, NULL, 4, 'Star Links', 'b_1596365482.jpg', 'Plastik', 'ILC', 3, 'indoor', 0, '2020-08-02 22:40:48'),
(19, NULL, 4, 'Wooden Hammer Bench', 'b_1596365535.jpg', 'Kayu', 'ILC', 2, 'indoor', 0, '2020-08-02 22:47:28'),
(20, NULL, 4, 'Cup Ckae Twin Dolls', 'b_1596366426.jpg', 'Plastik', 'ILC', 0, 'indoor', 0, '2020-08-02 18:07:06'),
(21, NULL, 4, 'Wooden Stacking Rings', 'b_1596366512.jpg', 'Kayu', 'ILC', 0, 'indoor', 0, '2020-08-02 18:08:32'),
(22, NULL, 4, 'Wooden Stacking Rings', 'b_1596366512.jpg', 'Kayu', 'ILC', 0, 'indoor', 1, '2020-08-02 22:46:08'),
(23, NULL, 4, 'Sand and Water Table Generic', 'b_1596366618.jpg', 'Plastik', 'ToysKingdom', 0, 'outdoor', 0, '2020-08-02 18:10:18'),
(24, NULL, 4, 'My Magnetic Pattern Board', 'b_1596366768.jpg', 'Kayu', 'ILC', 0, 'indoor', 0, '2020-08-02 18:12:48'),
(25, NULL, 4, 'Magnetic Playcentre Red', 'b_1596366869.jpg', 'Plastik', 'ILC', 0, 'indoor', 0, '2020-08-02 18:14:29'),
(26, NULL, 4, 'Wooden Bricks', 'b_1596366959.jpg', 'Kayu', 'ILC', 0, 'indoor', 0, '2020-08-02 18:15:59'),
(27, NULL, 4, 'Wooden Dairy Set', 'b_1596371543.jpg', 'Kayu', 'ILC', 0, 'indoor', 0, '2020-08-02 19:32:23'),
(28, NULL, 4, 'Cash Register', 'b_1596371611.jpg', 'Plastik', 'ILC', 0, 'indoor', 0, '2020-08-02 19:33:31'),
(29, NULL, 4, 'Table Top Art Centre', 'b_1596371729.jpg', 'Plastik', 'ILC', 0, 'indoor', 0, '2020-08-02 19:35:29'),
(30, NULL, 4, 'Magnifying Glass', 'b_1596372121.jpg', 'Plastik', 'ILC', 0, 'indoor', 0, '2020-08-02 19:42:01'),
(31, NULL, 4, 'Brainbox-Flash cards ABC', 'b_1596372199.jpg', 'Kertas', 'ILC', 0, 'indoor', 0, '2020-08-02 19:43:19'),
(32, NULL, 4, 'Brainbox-Flash Cards Picture', 'b_1596372278.jpg', 'Kertas', 'ILC', 0, 'indoor', 0, '2020-08-02 19:44:38'),
(33, NULL, 4, 'Brainbox-Flash Cards People at', 'b_1596372336.jpg', 'Kertas', 'ILC', 0, 'indoor', 0, '2020-08-02 19:45:36'),
(34, NULL, 4, 'Kid-Early Learning Puzzle  Ass', 'b_1596372510.jpg', 'Kayu', 'ILC', 0, 'indoor', 0, '2020-08-02 19:48:30'),
(35, NULL, 4, 'Kid-Early Learning Puzzle  Num', 'b_1596372554.jpg', 'Kayu', 'ILC', 0, 'indoor', 0, '2020-08-02 19:49:14'),
(36, NULL, 4, 'Steo 2-Studio Art Desk', 'b_1596372731.jpg', 'Plastik', 'ILC', 0, 'indoor', 0, '2020-08-02 19:52:11'),
(37, NULL, 4, 'Toys Kiitchen With Light & Sou', 'b_1596372883.jpg', 'Plastik', 'ToysKingdom', 0, 'indoor', 0, '2020-08-02 19:54:43'),
(38, NULL, 4, 'Little Giggles-Basic Baby Trai', 'b_1596372947.jpg', 'Plastik', 'ILC', 0, 'indoor', 0, '2020-08-02 19:55:47'),
(39, NULL, 4, 'Toys Doctor Playset', 'b_1596373011.jpg', 'Plastik', 'ToysKingdom', 0, 'indoor', 0, '2020-08-02 19:56:51'),
(40, NULL, 4, 'Labeille-Rocking Horse', 'b_1596373261.jpg', 'Plastik', 'ToysKingdom', 0, 'indoor', 0, '2020-08-02 20:01:01'),
(41, NULL, 4, 'Smoby-Slide', 'b_1596373354.jpg', 'Plastik', 'ToysKingdom', 0, 'indoor', 0, '2020-08-02 20:02:34');

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

--
-- Dumping data for table `temp_master_stok_kasir`
--

INSERT INTO `temp_master_stok_kasir` (`id_s_kasir`, `nostokkasir`, `kode_barang`, `stok`, `alasan`, `qrcode`, `datetime`) VALUES
(692, '8C2020080010', 11, 1, 'Rusak', '8C20200800101596388645.png', '2020-08-03 00:17:25');

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
  MODIFY `id_log` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `master_group`
--
ALTER TABLE `master_group`
  MODIFY `kode_group` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `master_kasir`
--
ALTER TABLE `master_kasir`
  MODIFY `kode_m_kasir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `master_stok_kasir`
--
ALTER TABLE `master_stok_kasir`
  MODIFY `id_s_kasir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `stock_opname`
--
ALTER TABLE `stock_opname`
  MODIFY `id_stock_opname` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tab_barang`
--
ALTER TABLE `tab_barang`
  MODIFY `kode_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
  MODIFY `id_s_kasir` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=693;

--
-- AUTO_INCREMENT for table `temp_stock_opname`
--
ALTER TABLE `temp_stock_opname`
  MODIFY `id_stock_opname` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=554;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
