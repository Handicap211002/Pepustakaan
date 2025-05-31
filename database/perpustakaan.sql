-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2025 at 07:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `NamaPengguna` varchar(255) NOT NULL,
  `KataSandi` varchar(255) NOT NULL,
  `TanggalLahir` date NOT NULL,
  `FotoProfil` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Alamat` varchar(255) NOT NULL,
  `NoTelpon` varchar(20) NOT NULL,
  `id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`NamaPengguna`, `KataSandi`, `TanggalLahir`, `FotoProfil`, `Email`, `Alamat`, `NoTelpon`, `id`) VALUES
('a', '$2y$10$DTzBllnIyomGyx9Qen.HnOn3f996xzbCLD8Wp5vZWL09T21baItI2', '3122-02-12', 'profileakun/profil_683b3e4d9f3ca2.47489276.jpg', '2201020123@student.umrah.ac.id', 'jalan eka bahti 2', '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_peminjaman` int(11) NOT NULL,
  `namabuku` varchar(255) NOT NULL,
  `penciptabuku` varchar(255) NOT NULL,
  `fotobuku` varchar(255) NOT NULL,
  `waktupeminjaman` datetime DEFAULT current_timestamp(),
  `tahunterbit` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `halaman` varchar(255) DEFAULT NULL,
  `NamaPengguna` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_peminjaman`, `namabuku`, `penciptabuku`, `fotobuku`, `waktupeminjaman`, `tahunterbit`, `penerbit`, `halaman`, `NamaPengguna`) VALUES
(79, 'Hidden-City', 'Mark Steven Lawson', '../img/b1.png', '2025-05-31 19:38:17', '2025', 'Clearvadersname Pty Ltd', '95 lembar', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `namabuku` varchar(255) NOT NULL,
  `penciptabuku` varchar(255) NOT NULL,
  `fotobuku` varchar(255) NOT NULL,
  `waktupeminjaman` datetime DEFAULT current_timestamp(),
  `tahunterbit` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `halaman` varchar(255) DEFAULT NULL,
  `NamaPengguna` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `namabuku`, `penciptabuku`, `fotobuku`, `waktupeminjaman`, `tahunterbit`, `penerbit`, `halaman`, `NamaPengguna`) VALUES
(27, 'Hidden-City', 'Mark Steven Lawson', '../img/b1.png', '2025-05-31 19:38:17', '2025', 'Clearvadersname Pty Ltd', '95 lembar', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `ulasan`
--

CREATE TABLE `ulasan` (
  `id` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `ulasan` text NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `id_buku` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulasan`
--

INSERT INTO `ulasan` (`id`, `id_peminjaman`, `username`, `rating`, `ulasan`, `tanggal`, `id_buku`) VALUES
(27, 79, 'a', 5, 'mantap la bos', '2025-06-01 00:38:34', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NamaPengguna` (`NamaPengguna`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_peminjaman` (`id_peminjaman`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ulasan`
--
ALTER TABLE `ulasan`
  ADD CONSTRAINT `ulasan_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `buku` (`id_peminjaman`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasan_ibfk_2` FOREIGN KEY (`username`) REFERENCES `akun` (`NamaPengguna`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
