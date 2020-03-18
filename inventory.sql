-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 18, 2020 at 12:01 PM
-- Server version: 5.7.29-0ubuntu0.18.04.1
-- PHP Version: 7.2.28-3+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `id` varchar(2) NOT NULL COMMENT 'A=notrans, B=stock_opname, C=master_stok_kasir, D=retur_kasir',
  `counter` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id`, `counter`) VALUES
('A', 0),
('B', 12),
('C', 5),
('D', 0);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(10) NOT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `kode_m_kasir` varchar(10) DEFAULT NULL,
  `kode_barang` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `tipe` varchar(1) NOT NULL COMMENT 'A=pabrik-gudang, B=gudang-kasir, C=penjualan, D=retur_kasir, E=gudang-agen',
  `datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `ket`, `kode_m_kasir`, `kode_barang`, `qty`, `tipe`, `datetime`) VALUES
(34, '8C2020030005', NULL, 2, 5, 'B', '2020-03-18 11:11:36'),
(33, '8C2020030005', NULL, 1, 5, 'B', '2020-03-18 11:11:36'),
(32, '2B2020030012', NULL, 1, 100, 'A', '2020-03-17 18:20:18'),
(31, '2B2020030012', NULL, 3, 100, 'A', '2020-03-17 18:20:18'),
(30, '2B2020030012', NULL, 2, 100, 'A', '2020-03-17 18:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `master_group`
--

CREATE TABLE `master_group` (
  `kode_group` int(5) NOT NULL,
  `nama_group` varchar(30) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `master_group`
--

INSERT INTO `master_group` (`kode_group`, `nama_group`, `gambar`, `keterangan`, `datetime`) VALUES
(1, 'group1', 'g_1584414392.jpg', 'ket1', '2020-03-17 10:06:32'),
(2, 'group2', 'g_1584414403.jpg', 'ket2', '2020-03-17 10:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `master_kasir`
--

CREATE TABLE `master_kasir` (
  `kode_m_kasir` int(5) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL,
  `PIC` varchar(30) DEFAULT NULL,
  `url` varchar(225) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `id_users` int(5) NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `master_kasir`
--

INSERT INTO `master_kasir` (`kode_m_kasir`, `nama`, `alamat`, `kota`, `telp`, `PIC`, `url`, `keterangan`, `id_users`, `datetime`) VALUES
(1, 'Nama', 'Alaamat', 'Kota', '0', 'PIC', '', '-', 104, '2020-03-17 09:54:44');

-- --------------------------------------------------------

--
-- Table structure for table `master_stok_kasir`
--

CREATE TABLE `master_stok_kasir` (
  `id_s_kasir` int(5) NOT NULL,
  `nostokkasir` varchar(12) NOT NULL,
  `ket` varchar(20) DEFAULT NULL,
  `id_user` int(2) NOT NULL,
  `retur` int(1) NOT NULL DEFAULT '0',
  `qrcode` varchar(100) NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `master_stok_kasir`
--

INSERT INTO `master_stok_kasir` (`id_s_kasir`, `nostokkasir`, `ket`, `id_user`, `retur`, `qrcode`, `datetime`) VALUES
(6, '8C2020030005', 'asdas', 8, 0, '8C20200300051584504696.png', '2020-03-18 11:11:36');

-- --------------------------------------------------------

--
-- Table structure for table `master_stok_kasir_detail`
--

CREATE TABLE `master_stok_kasir_detail` (
  `id_s_kasir` int(5) NOT NULL,
  `nostokkasir` varchar(12) NOT NULL,
  `kode_barang` int(5) DEFAULT NULL,
  `stok` int(10) DEFAULT NULL,
  `qrcode` varchar(100) NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `master_stok_kasir_detail`
--

INSERT INTO `master_stok_kasir_detail` (`id_s_kasir`, `nostokkasir`, `kode_barang`, `stok`, `qrcode`, `datetime`) VALUES
(7, '8C2020030005', 1, 5, '8C20200300051584504688.png', '2020-03-18 11:11:28'),
(6, '8C2020030005', 2, 5, '8C20200300051584504693.png', '2020-03-18 11:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `stock_opname`
--

CREATE TABLE `stock_opname` (
  `id_stock_opname` int(5) NOT NULL,
  `nostockopname` varchar(12) NOT NULL,
  `ket` varchar(50) NOT NULL,
  `id_user` int(2) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `qrcode` varchar(100) NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `stock_opname`
--

INSERT INTO `stock_opname` (`id_stock_opname`, `nostockopname`, `ket`, `id_user`, `jumlah`, `qrcode`, `datetime`) VALUES
(12, '2B2020030012', 'nama tok0', 2, 300000, '2B20200300121584444018.png', '2020-03-17 18:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `stock_opname_detail`
--

CREATE TABLE `stock_opname_detail` (
  `id_stock_opname` int(5) NOT NULL,
  `nostockopname` varchar(12) NOT NULL,
  `kode_barang` int(5) DEFAULT NULL,
  `stok` int(10) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `qrcode` varchar(100) NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `stock_opname_detail`
--

INSERT INTO `stock_opname_detail` (`id_stock_opname`, `nostockopname`, `kode_barang`, `stok`, `harga`, `jumlah`, `qrcode`, `datetime`) VALUES
(26, '2B2020030012', 2, 100, 1000, 100000, '2B20200300121584443995.png', '2020-03-17 18:19:55'),
(25, '2B2020030012', 3, 100, 1000, 100000, '2B20200300121584444008.png', '2020-03-17 18:20:08'),
(27, '2B2020030012', 1, 100, 1000, 100000, '2B20200300121584443985.png', '2020-03-17 18:19:45');

-- --------------------------------------------------------

--
-- Table structure for table `tab_barang`
--

CREATE TABLE `tab_barang` (
  `kode_barang` int(5) NOT NULL,
  `kode_group` int(5) DEFAULT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `gambar` varchar(225) DEFAULT NULL,
  `stok` int(20) DEFAULT '0',
  `keterangan` varchar(100) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tab_barang`
--

INSERT INTO `tab_barang` (`kode_barang`, `kode_group`, `nama`, `gambar`, `stok`, `keterangan`, `datetime`) VALUES
(1, 1, 'barang1', 'b_1584416062.jpg', 95, 'asd', '2020-03-18 11:11:36'),
(2, 1, 'barang2', 'b_1584416074.jpg', 95, 'asd', '2020-03-18 11:11:36'),
(3, 2, 'barang3', 'b_1584416110.jpg', 100, 'asd', '2020-03-17 18:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hak_akses`
--

CREATE TABLE `tbl_hak_akses` (
  `id` int(11) NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
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
  `id_menu` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(30) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `is_main_menu` int(11) NOT NULL,
  `urutan` int(2) NOT NULL DEFAULT '0',
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
(11, 'Barang Keluar', 'master_stok_kasir', 'fa fa-minus', 21, 0, 'y'),
(12, 'Barang Keluar', 'laporan_barang_keluar', 'fa fa-newspaper-o', 15, 3, 'y'),
(15, 'Laporan', '#', 'fa fa-area-chart', 0, 3, 'y'),
(16, 'Barang Masuk', 'laporan_barang_masuk', 'fa fa-paperclip', 15, 1, 'y'),
(0, 'Welcome', 'welcome', '', 0, 0, 'y'),
(20, 'Master Data', '#', 'fa fa-database', 0, 1, 'y'),
(21, 'Transaksi', '#', 'fa fa-opencart', 0, 2, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `id_setting` int(11) NOT NULL,
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
  `id_users` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `images` text NOT NULL,
  `id_user_level` int(11) NOT NULL,
  `is_aktif` enum('y','n') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_users`, `full_name`, `email`, `password`, `images`, `id_user_level`, `is_aktif`) VALUES
(1, 'super', 'super@super.com', '$2y$10$pY0QMNqgoJA3KIJbXg.aGOCCE.escHQzGMvMB6E9pJnYOMlsSaxJW', 'atomix_user31.png', 1, 'y'),
(106, 'kepsek', 'kepsek', '$2y$04$ScVg6soxrF/Lx6cJDovw/u1GG1rZLP4tkuL7XVUn8gftVWBIUfpeC', 'atomix_user31.png', 6, 'y'),
(8, 'admin', 'admin@admin.com', '$2y$10$UKfQs1iG.OqH1xJCXYWVj.Eck7lrYB9vCAwq7An5Z74qfrsMjL6K.', 'atomix_user31.png', 2, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_level`
--

CREATE TABLE `tbl_user_level` (
  `id_user_level` int(11) NOT NULL,
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
  `id_s_kasir` int(5) NOT NULL,
  `nostokkasir` varchar(12) NOT NULL,
  `kode_barang` int(5) DEFAULT NULL,
  `stok` int(10) DEFAULT NULL,
  `qrcode` varchar(100) NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `temp_stock_opname`
--

CREATE TABLE `temp_stock_opname` (
  `id_stock_opname` int(5) NOT NULL,
  `nostockopname` varchar(12) NOT NULL,
  `kode_barang` int(5) DEFAULT NULL,
  `stok` int(10) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `qrcode` varchar(100) NOT NULL,
  `datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

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
  ADD PRIMARY KEY (`id_s_kasir`) USING BTREE;

--
-- Indexes for table `stock_opname`
--
ALTER TABLE `stock_opname`
  ADD PRIMARY KEY (`id_stock_opname`) USING BTREE;

--
-- Indexes for table `stock_opname_detail`
--
ALTER TABLE `stock_opname_detail`
  ADD PRIMARY KEY (`id_stock_opname`) USING BTREE;

--
-- Indexes for table `tab_barang`
--
ALTER TABLE `tab_barang`
  ADD PRIMARY KEY (`kode_barang`) USING BTREE;

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
  MODIFY `id_log` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `master_group`
--
ALTER TABLE `master_group`
  MODIFY `kode_group` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `master_kasir`
--
ALTER TABLE `master_kasir`
  MODIFY `kode_m_kasir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `master_stok_kasir`
--
ALTER TABLE `master_stok_kasir`
  MODIFY `id_s_kasir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `master_stok_kasir_detail`
--
ALTER TABLE `master_stok_kasir_detail`
  MODIFY `id_s_kasir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `stock_opname`
--
ALTER TABLE `stock_opname`
  MODIFY `id_stock_opname` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `stock_opname_detail`
--
ALTER TABLE `stock_opname_detail`
  MODIFY `id_stock_opname` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tab_barang`
--
ALTER TABLE `tab_barang`
  MODIFY `kode_barang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_hak_akses`
--
ALTER TABLE `tbl_hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `tbl_user_level`
--
ALTER TABLE `tbl_user_level`
  MODIFY `id_user_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `temp_master_stok_kasir`
--
ALTER TABLE `temp_master_stok_kasir`
  MODIFY `id_s_kasir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=677;
--
-- AUTO_INCREMENT for table `temp_stock_opname`
--
ALTER TABLE `temp_stock_opname`
  MODIFY `id_stock_opname` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=529;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
