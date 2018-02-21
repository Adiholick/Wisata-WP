-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2017 at 01:57 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE IF NOT EXISTS `bobot` (
  `id` bigint(50) NOT NULL,
  `bobot` int(50) NOT NULL,
  `biaya` int(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id`, `bobot`, `biaya`) VALUES
(1, 20, -1),
(2, 15, -1),
(3, 20, 1),
(4, 15, 1),
(5, 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE IF NOT EXISTS `foto` (
  `id` bigint(50) NOT NULL,
  `id_tempat` varchar(50) NOT NULL,
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `id_tempat`, `file`) VALUES
(5, '<br />\r\n<b>Notice</b>:  Undefined variable: id in ', '<br />\r\n<b>Notice</b>:  Undefined variable: id in <b>C:\\xampp\\htdocs\\wisata\\tambah-tempat.php</b> on line <b>182</b><br />\r\n_360923.png'),
(7, '', '_38242.png'),
(8, '', '_948795.jpg'),
(9, '', '_970100.png'),
(10, '', '_754405.jpg'),
(11, '33', '33_903067.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id` bigint(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `link`, `status`) VALUES
(1, 'Rekomendasi Tempat Wisata', 'index.php', '0'),
(2, 'Daftar Tempat', 'daftar-tempat.php', '0'),
(3, 'Tambah Tempat', 'tambah-tempat.php', '0'),
(9, 'Logout', 'action.php?action=logout', '0'),
(31, 'Rekomendasi Tempat Wisata', 'index.php', '1'),
(39, 'Logout', 'action.php?action=logout', '1');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `provinsi` varchar(30) DEFAULT NULL,
  `provinsi_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`provinsi`, `provinsi_id`) VALUES
('Bali', 1),
('Bangka Belitung', 2),
('Banten', 3),
('Bengkulu', 4),
('DI Yogyakarta', 5),
('DKI Jakarta', 6),
('Gorontalo', 7),
('Jambi', 8),
('Jawa Barat', 9),
('Jawa Tengah', 10),
('Jawa Timur', 11),
('Kalimantan Barat', 12),
('Kalimantan Selatan', 13),
('Kalimantan Tengah', 14),
('Kalimantan Timur', 15),
('Kalimantan Utara', 16),
('Kepulauan Riau', 17),
('Lampung', 18),
('Maluku', 19),
('Maluku Utara', 20),
('Nanggroe Aceh Darussalam (NAD)', 21),
('Nusa Tenggara Barat (NTB)', 22),
('Nusa Tenggara Timur (NTT)', 23),
('Papua', 24),
('Papua Barat', 25),
('Riau', 26),
('Sulawesi Barat', 27),
('Sulawesi Selatan', 28),
('Sulawesi Tengah', 29),
('Sulawesi Tenggara', 30),
('Sulawesi Utara', 31),
('Sumatera Barat', 32),
('Sumatera Selatan', 33),
('Sumatera Utara', 34);

-- --------------------------------------------------------

--
-- Table structure for table `tempat`
--

CREATE TABLE IF NOT EXISTS `tempat` (
  `id` bigint(50) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `provinsi_id` int(50) NOT NULL,
  `transportasi` int(50) DEFAULT NULL,
  `tiket` int(50) DEFAULT NULL,
  `fasilitas` int(50) DEFAULT NULL,
  `kebersihan` int(50) DEFAULT NULL,
  `keindahan` int(50) DEFAULT NULL,
  `deskripsi` text
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tempat`
--

INSERT INTO `tempat` (`id`, `nama`, `provinsi_id`, `transportasi`, `tiket`, `fasilitas`, `kebersihan`, `keindahan`, `deskripsi`) VALUES
(8, 'Umbulu', 0, 80000, 80000, 8, 8, 8, 'Umbulu'),
(13, 'tterr', 0, 80000, 80000, 8, 8, 8, 'Dree'),
(27, 'Tringigling', 0, 90000, 8000, 9, 5, 5, 'Tringgiling'),
(28, 'Anyer', 0, 99999, 9999, 9, 9, 9, 'aNYER'),
(30, 'Carita', 3, 100000, 50000, 5, 6, 6, 'Pantai yang indah'),
(31, 'Pantai Indah Pasir Putih', 3, 20000, 1000, 5, 7, 7, 'Indah'),
(32, 'Red Lake', 5, 80000, 2000, 6, 6, 7, 'Indah'),
(33, 'Krakatau', 3, 100000, 2000, 5, 5, 5, 'Gunung krakatau');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_lengkap` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `status` int(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `nama_lengkap`, `email`, `password`, `status`) VALUES
(3, 'adiholick', 'Adi Nugroho', 'adinugroho.it@gmail.com', 'ab2581c2db33a94962c512619dd9e668', 0),
(4, 'admin', 'admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 0),
(5, 'user', 'user', 'user@user.com', 'ee11cbb19052e40b07aac0ca060c23ee', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`provinsi_id`);

--
-- Indexes for table `tempat`
--
ALTER TABLE `tempat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`username`), ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tempat`
--
ALTER TABLE `tempat`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
