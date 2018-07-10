-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2017 at 07:07 
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marshal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `lapang`
--

CREATE TABLE `lapang` (
  `lapang_id` int(11) NOT NULL,
  `lapang_nama` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lapang`
--

INSERT INTO `lapang` (`lapang_id`, `lapang_nama`) VALUES
(1, 'Lapang 1');

-- --------------------------------------------------------

--
-- Table structure for table `lawan`
--

CREATE TABLE `lawan` (
  `lawan_id` int(11) NOT NULL,
  `pelanggan1_id` varchar(10) NOT NULL,
  `pelanggan2_id` varchar(10) DEFAULT NULL,
  `lapang_id` int(11) NOT NULL,
  `jam_mulai` int(2) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(6) NOT NULL,
  `harga` int(3) NOT NULL,
  `lawan_timestamp` int(11) NOT NULL,
  `broadcast` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` varchar(10) NOT NULL,
  `chat_id` varchar(10) DEFAULT NULL,
  `pelanggan_nama` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `jumlah_batal` int(1) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `pesanan_id` int(11) NOT NULL,
  `pelanggan_id` varchar(10) NOT NULL,
  `lapang_id` int(11) NOT NULL,
  `jam_mulai` int(2) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(6) NOT NULL,
  `harga` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `profile_nama` varchar(10) NOT NULL,
  `jam_buka` int(2) NOT NULL,
  `jam_tutup` int(2) NOT NULL,
  `harga` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`profile_id`, `profile_nama`, `jam_buka`, `jam_tutup`, `harga`) VALUES
(2, 'Marshal', 8, 23, 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `lapang`
--
ALTER TABLE `lapang`
  ADD PRIMARY KEY (`lapang_id`);

--
-- Indexes for table `lawan`
--
ALTER TABLE `lawan`
  ADD PRIMARY KEY (`lawan_id`),
  ADD KEY `id_pemesan` (`pelanggan1_id`),
  ADD KEY `id_lawan` (`pelanggan2_id`),
  ADD KEY `lapang` (`lapang_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`pesanan_id`),
  ADD KEY `pelanggan` (`pelanggan_id`),
  ADD KEY `lapang` (`lapang_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lapang`
--
ALTER TABLE `lapang`
  MODIFY `lapang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `lawan`
--
ALTER TABLE `lawan`
  MODIFY `lawan_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `pesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `lawan`
--
ALTER TABLE `lawan`
  ADD CONSTRAINT `lawan_ibfk_1` FOREIGN KEY (`lapang_id`) REFERENCES `lapang` (`lapang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lawan_ibfk_2` FOREIGN KEY (`pelanggan1_id`) REFERENCES `pelanggan` (`pelanggan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lawan_ibfk_3` FOREIGN KEY (`pelanggan2_id`) REFERENCES `pelanggan` (`pelanggan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`lapang_id`) REFERENCES `lapang` (`lapang_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`pelanggan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
