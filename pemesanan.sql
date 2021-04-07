-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2021 at 10:24 PM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konsturksi`
--

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `invoice` varchar(20) DEFAULT NULL,
  `ukuran` varchar(50) DEFAULT NULL,
  `lantai` varchar(50) DEFAULT NULL,
  `luas_bangunan` varchar(20) DEFAULT NULL,
  `id_model` int(11) DEFAULT NULL,
  `kamar` varchar(50) DEFAULT NULL,
  `kamar_mandi` varchar(50) DEFAULT NULL,
  `garasi` varchar(50) DEFAULT NULL,
  `referensi` varchar(100) DEFAULT NULL,
  `pesan` varchar(100) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `bukti_pembayaran` varchar(100) DEFAULT NULL,
  `desain_rumah` varchar(100) DEFAULT NULL,
  `ket_ditolak` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `user_id`, `admin_id`, `invoice`, `ukuran`, `lantai`, `luas_bangunan`, `id_model`, `kamar`, `kamar_mandi`, `garasi`, `referensi`, `pesan`, `tanggal`, `status`, `bukti_pembayaran`, `desain_rumah`, `ket_ditolak`) VALUES
(1, 4, 4, 'BB001', '10x5', '1', '100', 2, '2', '2', '1', 'https://www.emporioarchitect.com/desain-rumah/desain-rumah-modern-1-lantai-bapak-annas-di-jepara-jaw', NULL, '2021-04-04 11:38:30', 3, NULL, 'pdf-2021-04-05_14:45:02.pdf', 'Gagal'),
(2, 4, 4, 'BB002', '10x5', '1', '100', 2, '2', '2', '1', 'https://www.emporioarchitect.com/desain-rumah/desain-rumah-modern-1-lantai-bapak-annas-di-jepara-jaw', NULL, '2021-04-04 11:41:45', 2, 'Image-2021-04-05_15:18:18.png', NULL, 'Sedang di proses'),
(3, 4, NULL, 'BB003', '10x5', '1', '100', 2, '3', '2', '1', 'https://www.emporioarchitect.com/desain-rumah/desain-rumah-modern-1-lantai-bapak-annas-di-jepara-jaw', NULL, '2021-04-04 11:50:52', 1, NULL, NULL, NULL),
(4, 4, NULL, 'B004', '10x5', '', '100', 2, '3', '2', '1', 'https://www.emporioarchitect.com/desain-rumah/desain-rumah-modern-1-lantai-bapak-annas-di-jepara-jaw', NULL, '2021-04-07 15:00:56', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
