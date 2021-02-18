-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2020 at 04:19 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+07:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tracer_study`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_diri`
--

CREATE TABLE `data_diri` (
  `id_data_diri` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `prodi` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `tempat_lahir` varchar(20) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nik` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `nama_ayah` varchar(50) NOT NULL,
  `pekerjaan_ayah` varchar(20) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `pekerjaan_ibu` varchar(20) NOT NULL,
  `tahun_masuk` year(4) NOT NULL,
  `tahun_lulus` year(4) NOT NULL,
  `no_ijazah` varchar(50) NOT NULL,
  `no_skhun` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `deskripsi_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id_event` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `event_title` varchar(100) NOT NULL,
  `event_slug` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_event` date NOT NULL,
  `tanggal_posting` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gambar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id_kontak` int(11) NOT NULL DEFAULT 1,
  `alamat` varchar(200) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `no_fax` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `maps_iframe` text NOT NULL,
  `livechat_api` text NOT NULL,
  `whatsapp_number` varchar(30) NOT NULL,
  `facebook_url` varchar(200) NOT NULL,
  `instagram_url` varchar(200) NOT NULL,
  `twitter_url` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id_kontak`, `alamat`, `no_telp`, `no_fax`, `email`, `maps_iframe`, `livechat_api`, `whatsapp_number`, `facebook_url`, `instagram_url`, `twitter_url`) VALUES
(1, 'jalan suka suka', '321123', '111111', 'email@email.com', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kritik`
--

CREATE TABLE `kritik` (
  `id_kritik` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `kritik` text NOT NULL,
  `tanggal_posting` timestamp NULL DEFAULT NULL,
  `tanggal_respon` timestamp NULL DEFAULT NULL,
  `respon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lowongan`
--

CREATE TABLE `lowongan` (
  `id_lowongan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `bidang_usaha` varchar(50) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `job_slug` varchar(60) NOT NULL,
  `deskripsi` text NOT NULL,
  `akhir_waktu` date NOT NULL,
  `tanggal_posting` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `gambar` varchar(100) DEFAULT NULL,
  `is_tampil` varchar(5) NOT NULL DEFAULT 'TIDAK'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(20) NOT NULL,
  `deskripsi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role`, `deskripsi`) VALUES
(1, 'administrator', 'role untuk administrator'),
(2, 'alumni', 'role untuk alumni');

-- --------------------------------------------------------

--
-- Table structure for table `saran`
--

CREATE TABLE `saran` (
  `id_saran` int(10) NOT NULL,
  `id_user` int(11) NOT NULL,
  `saran` text NOT NULL,
  `tanggal_posting` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tanggal_respon` timestamp NULL DEFAULT NULL,
  `respon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `situs`
--

CREATE TABLE `situs` (
  `id_situs` int(11) NOT NULL DEFAULT 1,
  `app_name` varchar(100) NOT NULL,
  `app_slogan` varchar(100) NOT NULL,
  `meta_deskripsi` varchar(250) NOT NULL,
  `meta_keyword` varchar(250) NOT NULL,
  `logo_website` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `situs`
--

INSERT INTO `situs` (`id_situs`, `app_name`, `app_slogan`, `meta_deskripsi`, `meta_keyword`, `logo_website`) VALUES
(1, 'TRACER - STUDY', 'Sekolah Ramah Anak', 'tracer study sekolah bahagia', 'tracer study', 'Capture_toga.PNG');

-- --------------------------------------------------------

--
-- Table structure for table `testimoni`
--

CREATE TABLE `testimoni` (
  `id_testimoni` int(10) UNSIGNED NOT NULL,
  `id_user` int(11) UNSIGNED NOT NULL,
  `testimoni` text NOT NULL,
  `is_tampil` varchar(5) NOT NULL DEFAULT 'TIDAK'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `kode_aktivasi` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_allow` varchar(10) NOT NULL,
  `role_active` int(11) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `foto` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `kode_aktivasi`, `username`, `email`, `password`, `role_allow`, `role_active`, `is_active`, `is_admin`, `foto`) VALUES
(1, NULL, 'Andhika Putra Pratama', 'andhika6@gmail.com', '$2y$12$LVYKPWsNK2NFje2zI35LeujPKYGTNTTn3OOX27MrFS0rbpMkF9QSu', '1', 1, 1, 1, ''),
(2, NULL, 'user 1', 'user1@mail.com', '$2y$12$eQd/c9DdI7R4Vxqet0ILWeaQHDiKJ5pr/E52UtreumSapS0Ya7jcC', '2', 2, 1, 0, ''),
(3, NULL, 'user 2', 'user2@mail.com', '$2y$12$y.tVcp7oKs3K.U7JPWYPtO18cIhaZ/vb0DabDSkEdr23Z.WyGlmEO', '2', 2, 1, 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_diri`
--
ALTER TABLE `data_diri`
  ADD PRIMARY KEY (`id_data_diri`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id_kontak`);

--
-- Indexes for table `kritik`
--
ALTER TABLE `kritik`
  ADD PRIMARY KEY (`id_kritik`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id_lowongan`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `saran`
--
ALTER TABLE `saran`
  ADD PRIMARY KEY (`id_saran`);

--
-- Indexes for table `situs`
--
ALTER TABLE `situs`
  ADD PRIMARY KEY (`id_situs`);

--
-- Indexes for table `testimoni`
--
ALTER TABLE `testimoni`
  ADD PRIMARY KEY (`id_testimoni`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_diri`
--
ALTER TABLE `data_diri`
  MODIFY `id_data_diri` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kritik`
--
ALTER TABLE `kritik`
  MODIFY `id_kritik` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id_lowongan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `saran`
--
ALTER TABLE `saran`
  MODIFY `id_saran` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimoni`
--
ALTER TABLE `testimoni`
  MODIFY `id_testimoni` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
