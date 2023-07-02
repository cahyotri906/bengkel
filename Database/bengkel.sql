-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 06:56 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkel`
--

-- --------------------------------------------------------

--
-- Table structure for table `213_konsumen`
--

CREATE TABLE `213_konsumen` (
  `id_konsumen` int(4) NOT NULL,
  `nama_konsumen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `213_konsumen`
--

INSERT INTO `213_konsumen` (`id_konsumen`, `nama_konsumen`) VALUES
(1, 'Ujang'),
(1, 'Ujang'),
(1, 'Ujang');

-- --------------------------------------------------------

--
-- Table structure for table `213_mekanik`
--

CREATE TABLE `213_mekanik` (
  `id_mekanik` int(5) UNSIGNED NOT NULL,
  `nama_mekanik` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `213_mekanik`
--

INSERT INTO `213_mekanik` (`id_mekanik`, `nama_mekanik`) VALUES
(1, 'Dadan Sarkopet'),
(2, 'Jajang'),
(3, 'Sudrajat'),
(9, 'Agung');

-- --------------------------------------------------------

--
-- Table structure for table `213_pembelian`
--

CREATE TABLE `213_pembelian` (
  `id_pembelian` int(5) NOT NULL,
  `id_mekanik` int(5) DEFAULT NULL,
  `id_sparepart` int(5) DEFAULT NULL,
  `qty` int(5) DEFAULT NULL,
  `harga_jasa` varchar(10) DEFAULT NULL,
  `tgl_beli` date DEFAULT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `213_pembelian`
--

INSERT INTO `213_pembelian` (`id_pembelian`, `id_mekanik`, `id_sparepart`, `qty`, `harga_jasa`, `tgl_beli`, `status`) VALUES
(1, 1, 1, 1, '10000', '2020-01-10', 'Selsai'),
(2, 2, 4, 1, '10000', '2020-01-10', 'Selsai'),
(3, 3, 10, 1, '20000', '2020-01-10', 'Selsai'),
(4, 1, 1, 2, '5000', '2020-01-10', 'Selsai'),
(5, 9, 19, 1, '5000', '2020-01-10', 'Selsai');

--
-- Triggers `213_pembelian`
--
DELIMITER $$
CREATE TRIGGER `jual` AFTER INSERT ON `213_pembelian` FOR EACH ROW BEGIN
UPDATE 213_sparepart SET stock=stock-NEW.qty
WHERE id_sparepart=NEW.id_sparepart;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `213_pengguna`
--

CREATE TABLE `213_pengguna` (
  `id_pengguna` int(5) NOT NULL,
  `nama_pengguna` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `213_pengguna`
--

INSERT INTO `213_pengguna` (`id_pengguna`, `nama_pengguna`, `username`, `password`) VALUES
(1, 'cahyo', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `213_sparepart`
--

CREATE TABLE `213_sparepart` (
  `id_sparepart` int(5) NOT NULL,
  `sparepart` varchar(50) DEFAULT NULL,
  `stock` varchar(5) DEFAULT NULL,
  `harga` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `213_sparepart`
--

INSERT INTO `213_sparepart` (`id_sparepart`, `sparepart`, `stock`, `harga`) VALUES
(1, 'Filter Udara', '2', '32000'),
(2, 'Kampas Rem Depan', '1', '37000'),
(3, 'Kampas Rem Belakang', '11', '26000'),
(4, 'Rantai', '11', '65000'),
(5, 'Gir Depan', '8', '35000'),
(6, 'Gir belakang', '6', '63000'),
(7, 'Bohlam Depan', '15', '25000'),
(8, 'Bohlam Belakang', '16', '7500'),
(9, 'Kabel Gas', '20', '20000'),
(10, 'Kampas Kopling', '1', '148000'),
(11, 'Piston', '1', '38000'),
(12, 'Ring Piston', '5', '60000'),
(13, 'V-belt', '4', '43000'),
(14, 'CDI', '4', '340000'),
(15, 'Relay Starter', '6', '40000'),
(16, 'Sokbreker Belakang', '6', '180000'),
(17, 'Kem', '3', '115000'),
(18, 'Oli Yamalube', '0', '35000'),
(19, 'Oli Top One', '2', '40000'),
(20, 'Oli Castroll', '5', '65000'),
(21, 'Oli Mesran', '5', '35000'),
(27, 'Spion', '5', '25000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `213_mekanik`
--
ALTER TABLE `213_mekanik`
  ADD PRIMARY KEY (`id_mekanik`);

--
-- Indexes for table `213_pembelian`
--
ALTER TABLE `213_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `213_mekanik`
--
ALTER TABLE `213_mekanik`
  MODIFY `id_mekanik` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `213_pembelian`
--
ALTER TABLE `213_pembelian`
  MODIFY `id_pembelian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
