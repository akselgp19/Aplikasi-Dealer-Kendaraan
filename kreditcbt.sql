-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2023 at 06:49 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kreditcbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `angsuran`
--

CREATE TABLE `angsuran` (
  `id` int(20) NOT NULL,
  `nama` text NOT NULL,
  `nik` int(20) NOT NULL,
  `plat` varchar(20) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `tenor` int(20) NOT NULL,
  `angsuran` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angsuran`
--

INSERT INTO `angsuran` (`id`, `nama`, `nik`, `plat`, `merk`, `tipe`, `tenor`, `angsuran`) VALUES
(5, 'aksel', 123, 'B 4321 FO', 'suzuki', 'katana', 6, 7120000),
(6, 'alisha', 321, 'F 1080 Ti', 'toyota', 'avanza', 3, 5290000);

-- --------------------------------------------------------

--
-- Table structure for table `bayar`
--

CREATE TABLE `bayar` (
  `id` int(10) NOT NULL,
  `plat` varchar(10) NOT NULL,
  `merk` text NOT NULL,
  `tipe` text NOT NULL,
  `harga` int(15) NOT NULL,
  `tenor` int(50) NOT NULL,
  `bunga` int(50) NOT NULL,
  `hargakredit` int(50) NOT NULL,
  `dp` int(50) NOT NULL,
  `angsuran` int(50) NOT NULL,
  `sisa` int(50) NOT NULL,
  `nama` text NOT NULL,
  `nik` int(20) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bayar`
--

INSERT INTO `bayar` (`id`, `plat`, `merk`, `tipe`, `harga`, `tenor`, `bunga`, `hargakredit`, `dp`, `angsuran`, `sisa`, `nama`, `nik`, `alamat`) VALUES
(43, 'B 4321 FO', 'suzuki', 'katana', 43000000, 6, 4, 44720000, 2000000, 7120000, 42720000, 'aksel', 123, 'Bogor'),
(46, 'F 1080 Ti', 'toyota', 'avanza', 18500000, 3, 2, 18870000, 3000000, 5290000, 15870000, 'alisha', 321, 'bogor');

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE `beli` (
  `nik` int(11) NOT NULL,
  `nama` text NOT NULL,
  `umur` int(3) NOT NULL,
  `pekerjaan` text NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beli`
--

INSERT INTO `beli` (`nik`, `nama`, `umur`, `pekerjaan`, `alamat`) VALUES
(123, 'aksel', 19, 'Mahasiswa', 'Bogor'),
(321, 'alisha', 20, 'mahasiswa', 'bogor');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

CREATE TABLE `motor` (
  `plat` varchar(10) NOT NULL,
  `merk` text NOT NULL,
  `tipe` varchar(10) NOT NULL,
  `harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `motor`
--

INSERT INTO `motor` (`plat`, `merk`, `tipe`, `harga`) VALUES
('B 4321 FO', 'suzuki', 'katana', 43000000),
('D 1234 BO', 'daihatsu', 'taft', 8000000),
('F 1080 Ti', 'toyota', 'avanza', 18500000),
('F 1111 BGR', 'KAWASAKI', 'KLX', 25000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angsuran`
--
ALTER TABLE `angsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bayar`
--
ALTER TABLE `bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beli`
--
ALTER TABLE `beli`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`plat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angsuran`
--
ALTER TABLE `angsuran`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bayar`
--
ALTER TABLE `bayar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
