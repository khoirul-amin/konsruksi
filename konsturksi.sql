-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2021 at 10:52 PM
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
-- Table structure for table `detail_konstruksi`
--

CREATE TABLE `detail_konstruksi` (
  `id` int(11) NOT NULL,
  `id_pemesanan` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `harga_satuan` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_konstruksi`
--

INSERT INTO `detail_konstruksi` (`id`, `id_pemesanan`, `id_kategori`, `keterangan`, `satuan`, `harga_satuan`, `total`, `volume`) VALUES
(1, 1, 2, 'Pengukuran dan Bouplank', 'Sak', 70000, 700000, 10),
(2, 1, 2, 'Laporan & Photo Proyek,K3/Safety', 'Sak', 10000, 30000, 3),
(3, 2, 5, 'Atap Galvalum + RangkabBaja Ringan t. 0,75 mm', 'Sak', 100000, 1000000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `timestamp`) VALUES
(2, 'PEKERJAAN PERSIAPAN', '2021-04-02 16:45:35'),
(3, 'PEKERJAAN PONDASI DAN TANAH', '2021-04-02 16:46:00'),
(4, 'PEKERJAAN BETON DAN STRUKTUR', '2021-04-02 16:46:22'),
(5, 'PEKERJAAN LAIN-LAIN', '2021-04-02 16:46:39');

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

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `rekening` varchar(20) NOT NULL,
  `akun` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `isi` varchar(1000) DEFAULT NULL,
  `tanggal` timestamp NULL DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `jenis` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `judul`, `image`, `isi`, `tanggal`, `slug`, `author`, `jenis`) VALUES
(1, 'Rumah Ibu Kemuning', 'Image-2021-04-03_12:04:23.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2021-04-04 11:17:46', 'rumah-ibu-kemuning', 'Khoirul Amin', 1),
(2, 'Rumah Pribadi', 'Image-2021-04-03_00:50:59.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2021-04-04 11:17:30', 'rumah-pribadi', 'Khoirul Amin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `NIK` varchar(20) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telp` varchar(16) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `role` int(11) NOT NULL COMMENT '1. Admin\r\n2. Karyawan\r\n3. Pelanggan',
  `timestamps` timestamp NULL DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `NIK`, `tgl_lahir`, `nama`, `no_telp`, `alamat`, `role`, `timestamps`, `avatar`) VALUES
(1, 'admin', '$2y$12$I0srEG/ORI6EV6j475e5mugn7KKrTc6.RVnCIu2s/aXjXDHCxLjW.', 'admin@gmail.com', '3524150311900014', '1998-01-03', 'Super USer', '085967276070', 'Jl. Sidorame, Ds. Tebluru, Kec. Solokuro, Kab. Lamongan.', 1, '2021-04-07 15:08:02', NULL),
(4, 'users', '$2y$12$25ljTg8UPp4EJgSHY43Ln.2QQjNKoyjDupWHypbYuw/i.CA/yY02a', 'users@gmail.com', '3524150311900015', '1998-01-03', 'User Login', '085967276072', 'Jl. Sidorame, Ds. Tebluru, Kec. Solokuro, Kab. Lamongan.', 3, '2021-04-07 15:20:45', 'Image-2021-04-03_12:15:51.jpeg'),
(6, 'user1', '$2y$12$25ljTg8UPp4EJgSHY43Ln.2QQjNKoyjDupWHypbYuw/i.CA/yY02a', 'oke@gmail.com', '3524150311900016', '2021-04-07', 'Ahmad Khoirul Amin', '085967276071', 'Jl. Sidorame, Ds. Tebluru, Kec. Solokuro, Kab. Lamongan.', 2, '2021-04-01 18:01:45', NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pemesanan`
-- (See below for the actual view)
--
CREATE TABLE `v_pemesanan` (
`id` int(11)
,`user_id` int(11)
,`admin_id` int(11)
,`invoice` varchar(20)
,`ukuran` varchar(50)
,`lantai` varchar(50)
,`luas_bangunan` varchar(20)
,`id_model` int(11)
,`kamar` varchar(50)
,`kamar_mandi` varchar(50)
,`garasi` varchar(50)
,`referensi` varchar(100)
,`pesan` varchar(100)
,`tanggal` timestamp
,`status` int(11)
,`bukti_pembayaran` varchar(100)
,`ket_ditolak` varchar(100)
,`desain_rumah` varchar(100)
,`nik` varchar(20)
,`nama` varchar(100)
,`admin` varchar(100)
,`alamat` varchar(100)
,`email` varchar(30)
,`no_telp` varchar(16)
,`model` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pesan_menunggu`
-- (See below for the actual view)
--
CREATE TABLE `v_pesan_menunggu` (
`id` int(11)
,`user_id` int(11)
,`admin_id` int(11)
,`invoice` varchar(20)
,`ukuran` varchar(50)
,`lantai` varchar(50)
,`luas_bangunan` varchar(20)
,`id_model` int(11)
,`kamar` varchar(50)
,`kamar_mandi` varchar(50)
,`garasi` varchar(50)
,`referensi` varchar(100)
,`pesan` varchar(100)
,`tanggal` timestamp
,`status` int(11)
,`bukti_pembayaran` varchar(100)
,`ket_ditolak` varchar(100)
,`nik` varchar(20)
,`nama` varchar(100)
,`alamat` varchar(100)
,`admin` varchar(100)
,`email` varchar(30)
,`no_telp` varchar(16)
,`model` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pesan_proses`
-- (See below for the actual view)
--
CREATE TABLE `v_pesan_proses` (
`id` int(11)
,`user_id` int(11)
,`admin_id` int(11)
,`invoice` varchar(20)
,`ukuran` varchar(50)
,`lantai` varchar(50)
,`luas_bangunan` varchar(20)
,`id_model` int(11)
,`kamar` varchar(50)
,`kamar_mandi` varchar(50)
,`garasi` varchar(50)
,`referensi` varchar(100)
,`pesan` varchar(100)
,`tanggal` timestamp
,`status` int(11)
,`bukti_pembayaran` varchar(100)
,`ket_ditolak` varchar(100)
,`nama` varchar(100)
,`nik` varchar(20)
,`alamat` varchar(100)
,`email` varchar(30)
,`no_telp` varchar(16)
,`admin` varchar(100)
,`model` varchar(100)
);

-- --------------------------------------------------------

--
-- Structure for view `v_pemesanan`
--
DROP TABLE IF EXISTS `v_pemesanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`local`@`localhost` SQL SECURITY DEFINER VIEW `v_pemesanan`  AS SELECT `pemesanan`.`id` AS `id`, `pemesanan`.`user_id` AS `user_id`, `pemesanan`.`admin_id` AS `admin_id`, `pemesanan`.`invoice` AS `invoice`, `pemesanan`.`ukuran` AS `ukuran`, `pemesanan`.`lantai` AS `lantai`, `pemesanan`.`luas_bangunan` AS `luas_bangunan`, `pemesanan`.`id_model` AS `id_model`, `pemesanan`.`kamar` AS `kamar`, `pemesanan`.`kamar_mandi` AS `kamar_mandi`, `pemesanan`.`garasi` AS `garasi`, `pemesanan`.`referensi` AS `referensi`, `pemesanan`.`pesan` AS `pesan`, `pemesanan`.`tanggal` AS `tanggal`, `pemesanan`.`status` AS `status`, `pemesanan`.`bukti_pembayaran` AS `bukti_pembayaran`, `pemesanan`.`ket_ditolak` AS `ket_ditolak`, `pemesanan`.`desain_rumah` AS `desain_rumah`, `users`.`NIK` AS `nik`, `users`.`nama` AS `nama`, (select `users`.`nama` from `users` where (`users`.`id` = `pemesanan`.`admin_id`)) AS `admin`, `users`.`alamat` AS `alamat`, `users`.`email` AS `email`, `users`.`no_telp` AS `no_telp`, `posts`.`judul` AS `model` FROM ((`users` join `posts`) join `pemesanan`) WHERE ((`pemesanan`.`user_id` = `users`.`id`) AND (`pemesanan`.`id_model` = `posts`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_pesan_menunggu`
--
DROP TABLE IF EXISTS `v_pesan_menunggu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`local`@`localhost` SQL SECURITY DEFINER VIEW `v_pesan_menunggu`  AS SELECT `pemesanan`.`id` AS `id`, `pemesanan`.`user_id` AS `user_id`, `pemesanan`.`admin_id` AS `admin_id`, `pemesanan`.`invoice` AS `invoice`, `pemesanan`.`ukuran` AS `ukuran`, `pemesanan`.`lantai` AS `lantai`, `pemesanan`.`luas_bangunan` AS `luas_bangunan`, `pemesanan`.`id_model` AS `id_model`, `pemesanan`.`kamar` AS `kamar`, `pemesanan`.`kamar_mandi` AS `kamar_mandi`, `pemesanan`.`garasi` AS `garasi`, `pemesanan`.`referensi` AS `referensi`, `pemesanan`.`pesan` AS `pesan`, `pemesanan`.`tanggal` AS `tanggal`, `pemesanan`.`status` AS `status`, `pemesanan`.`bukti_pembayaran` AS `bukti_pembayaran`, `pemesanan`.`ket_ditolak` AS `ket_ditolak`, `users`.`NIK` AS `nik`, `users`.`nama` AS `nama`, `users`.`alamat` AS `alamat`, (select `users`.`nama` from `users` where (`users`.`id` = `pemesanan`.`admin_id`)) AS `admin`, `users`.`email` AS `email`, `users`.`no_telp` AS `no_telp`, `posts`.`judul` AS `model` FROM ((`users` join `posts`) join `pemesanan`) WHERE ((`pemesanan`.`user_id` = `users`.`id`) AND (`pemesanan`.`id_model` = `posts`.`id`) AND (`pemesanan`.`status` = 1)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_pesan_proses`
--
DROP TABLE IF EXISTS `v_pesan_proses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`local`@`localhost` SQL SECURITY DEFINER VIEW `v_pesan_proses`  AS SELECT `pemesanan`.`id` AS `id`, `pemesanan`.`user_id` AS `user_id`, `pemesanan`.`admin_id` AS `admin_id`, `pemesanan`.`invoice` AS `invoice`, `pemesanan`.`ukuran` AS `ukuran`, `pemesanan`.`lantai` AS `lantai`, `pemesanan`.`luas_bangunan` AS `luas_bangunan`, `pemesanan`.`id_model` AS `id_model`, `pemesanan`.`kamar` AS `kamar`, `pemesanan`.`kamar_mandi` AS `kamar_mandi`, `pemesanan`.`garasi` AS `garasi`, `pemesanan`.`referensi` AS `referensi`, `pemesanan`.`pesan` AS `pesan`, `pemesanan`.`tanggal` AS `tanggal`, `pemesanan`.`status` AS `status`, `pemesanan`.`bukti_pembayaran` AS `bukti_pembayaran`, `pemesanan`.`ket_ditolak` AS `ket_ditolak`, `users`.`nama` AS `nama`, `users`.`NIK` AS `nik`, `users`.`alamat` AS `alamat`, `users`.`email` AS `email`, `users`.`no_telp` AS `no_telp`, `users`.`nama` AS `admin`, `posts`.`judul` AS `model` FROM ((`users` join `posts`) join `pemesanan`) WHERE ((`pemesanan`.`user_id` = `users`.`id`) AND (`pemesanan`.`admin_id` = `users`.`id`) AND (`pemesanan`.`id_model` = `posts`.`id`) AND (`pemesanan`.`status` <> 1)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_konstruksi`
--
ALTER TABLE `detail_konstruksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nik` (`NIK`),
  ADD UNIQUE KEY `no_telp` (`no_telp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_konstruksi`
--
ALTER TABLE `detail_konstruksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
