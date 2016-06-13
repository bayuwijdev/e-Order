-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2016 at 04:52 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbeorder10113218`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--
CREATE Database dbeorder10113218;
use dbeorder10113218;

CREATE TABLE `admin` (
  `username` varchar(15) NOT NULL,
  `password` varchar(41) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` enum('ADMIN','SUPERADMIN') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama`, `level`) VALUES
('anggi', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Anggita Larasati', 'ADMIN'),
('ani_yani', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Ani Indriyani', 'ADMIN'),
('bayu_wpp', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Bayu Wijaya Permana Putra', 'SUPERADMIN'),
('mira', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Mira Susanti', 'ADMIN'),
('susan', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'Susana Suasanti', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `dihapus` char(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`, `dihapus`) VALUES
(1, 'Laptop', 'T'),
(2, 'Smartphone', 'T'),
(3, 'Tablet', 'Y'),
(4, 'Pakaian', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` varchar(50) NOT NULL COMMENT 'Untuk id_member akan menggunakan email',
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `katasandi` varchar(50) NOT NULL,
  `loginterakhir` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama`, `alamat`, `katasandi`, `loginterakhir`) VALUES
('ariya@yahoo.com', 'ariya', 'Jl. Dago No. 21', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '0000-00-00 00:00:00'),
('bayu_wpp@programmer.net', 'Bayu Wijaya', 'Jl. Bukit Raya Atas No. 271', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', '0000-00-00 00:00:00'),
('mayanurbayanti@gmail.com', 'Rosmaya Nurbayanti', 'Jl. Sekeloa No. 22', '*3D4D6B39E97282691B6A80EDCA5593F465F653B5', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `id_merk` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `dihapus` char(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`id_merk`, `nama`, `dihapus`) VALUES
(1, 'Samsung', 'T'),
(2, 'Asus', 'T'),
(4, 'HP', 'T'),
(5, 'Acer', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_member` varchar(50) NOT NULL,
  `waktu` datetime NOT NULL,
  `dicheckout` char(1) NOT NULL DEFAULT 'T',
  `diarsipkan` char(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_member`, `waktu`, `dicheckout`, `diarsipkan`) VALUES
(1, 'mayanurbayanti@gmail.com', '2016-06-12 22:31:51', 'Y', 'Y'),
(2, 'mayanurbayanti@gmail.com', '2016-06-12 22:48:45', 'Y', 'T'),
(3, 'mayanurbayanti@gmail.com', '2016-06-13 09:43:51', 'T', 'T'),
(4, 'ariya@yahoo.com', '2016-06-13 09:45:32', 'Y', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_items`
--

CREATE TABLE `pesanan_items` (
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `harga` decimal(10,0) NOT NULL DEFAULT '0',
  `diskon` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_items`
--

INSERT INTO `pesanan_items` (`id_pesanan`, `id_produk`, `qty`, `harga`, `diskon`) VALUES
(1, 2, 2, '2400000', 0),
(2, 1, 1, '5700000', 0),
(3, 1, 1, '5700000', 0),
(4, 3, 2, '4750000', 125000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_merk` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `berat` float NOT NULL DEFAULT '0' COMMENT 'Dalam KG',
  `diskon` float NOT NULL,
  `stok` int(11) NOT NULL DEFAULT '0',
  `dijual` char(1) NOT NULL DEFAULT 'Y',
  `deskripsi` text,
  `filegambar` varchar(100) DEFAULT NULL,
  `dihapus` char(1) NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `id_merk`, `nama`, `harga`, `berat`, `diskon`, `stok`, `dijual`, `deskripsi`, `filegambar`, `dihapus`) VALUES
(1, 1, 2, 'ASUS A43SV', '5700000', 0.43, 0, 5, 'Y', 'ASUS A43SV', 'Asus-A43SV-VX072D-e1423309753635.jpg', 'T'),
(2, 2, 5, 'Acer Liquid M220', '1200000', 0.12, 0, 10, 'Y', 'Acer Liquid M220 Black', 'Acer-smartphone-Liquid-M220-Black-photogallery-01.png', 'T'),
(3, 2, 2, 'Asus Zenfone 5', '2500000', 0.321, 5, 20, 'Y', 'Asus-Zenfone-5-Black-Front\r\nProcessor Intel Core 2 Duo 2.0 GHz\r\nCamera 12MP, RAM 2 GB\r\nGaransi Resmi Asus 1 Tahun', 'Asus-Zenfone-5-Black-Front.jpg', 'T');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`id_merk`),
  ADD UNIQUE KEY `nama` (`nama`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_member` (`id_member`);

--
-- Indexes for table `pesanan_items`
--
ALTER TABLE `pesanan_items`
  ADD PRIMARY KEY (`id_pesanan`,`id_produk`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_merk` (`id_merk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `merk`
--
ALTER TABLE `merk`
  MODIFY `id_merk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`);

--
-- Constraints for table `pesanan_items`
--
ALTER TABLE `pesanan_items`
  ADD CONSTRAINT `pesanan_items_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`),
  ADD CONSTRAINT `pesanan_items_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_merk`) REFERENCES `merk` (`id_merk`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
