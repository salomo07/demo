-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2021 at 09:15 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Id` int(11) NOT NULL,
  `Nama` varchar(100) DEFAULT NULL,
  `Kontak` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Alamat` text NOT NULL,
  `Diskon` int(11) NOT NULL,
  `Tipediskon` int(11) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `PIC` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id`, `Nama`, `Kontak`, `Email`, `Alamat`, `Diskon`, `Tipediskon`, `Image`, `PIC`) VALUES
(8, 'PT. Maju Terus', '454545', 'kuputersesat@gmail.com', 'PPP', 10, 1, './upload/cust8.jpg', '[\"1\",\"3\"]'),
(9, 'CV. Surya Harapan', '081288643757', 'kuputersesat@gmail.com', 'AAA', 2, 1, './upload/cust9.jpg', '[\"3\"]');

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaksi`
--

CREATE TABLE `detailtransaksi` (
  `Id` int(11) NOT NULL,
  `IdTransaksi` int(11) NOT NULL,
  `IdItem` int(11) NOT NULL,
  `Qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `Id` int(11) NOT NULL,
  `Nama` varchar(255) DEFAULT NULL,
  `Unit` int(11) NOT NULL,
  `Stok` int(11) NOT NULL,
  `HargaSatuan` int(11) DEFAULT NULL,
  `HargaGrosir` int(11) DEFAULT NULL,
  `Image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`Id`, `Nama`, `Unit`, `Stok`, `HargaSatuan`, `HargaGrosir`, `Image`) VALUES
(1, 'Bando Ya Ampun', 2, 1000, 2500, 2400, ''),
(14, 'Sempak', 1, 2, 1, 1, './upload/14.jpg'),
(15, 'Kolor', 2, 1000, 25000, 20000, './upload/15.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblmstuser`
--

CREATE TABLE `tblmstuser` (
  `Id` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` text NOT NULL,
  `Keterangan` text NOT NULL,
  `Role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblmstuser`
--

INSERT INTO `tblmstuser` (`Id`, `Username`, `Password`, `Keterangan`, `Role`) VALUES
(1, 'Demo', 'QXNveQ==', 'Demo Access', 'PIC'),
(2, 'Salomo07', 'QXNveQ==', 'Sales', 'Sales'),
(3, 'Friska', 'QXNveQ==', 'PIC', 'PIC');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `Code` int(11) NOT NULL,
  `Tanggal` varchar(20) NOT NULL,
  `Customer` int(11) NOT NULL,
  `Tipe` varchar(12) NOT NULL,
  `TotalDiskon` int(11) DEFAULT NULL,
  `TotalBayar` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`Code`, `Tanggal`, `Customer`, `Tipe`, `TotalDiskon`, `TotalBayar`) VALUES
(1, '04/08/2021', 8, 'Cash', NULL, NULL),
(2, '04/08/2021', 8, 'Cash', NULL, NULL),
(3, '04/08/2021', 8, 'Cash', NULL, NULL),
(4, '04/08/2021', 8, 'Cash', NULL, NULL),
(5, '04/08/2021', 9, 'Credit', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblmstuser`
--
ALTER TABLE `tblmstuser`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`Code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tblmstuser`
--
ALTER TABLE `tblmstuser`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `Code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
