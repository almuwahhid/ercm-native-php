-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2019 at 10:09 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ercm`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan`
--

CREATE TABLE `bahan` (
  `bahan_id` int(11) NOT NULL,
  `nama_bahan` varchar(30) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan`
--

INSERT INTO `bahan` (`bahan_id`, `nama_bahan`, `satuan`, `harga`, `supplier_id`) VALUES
(5, 'keong', 'gramsajasdasdasd', 2147483647, 4),
(11, 'kain katun', 'gulung', 10000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customers_id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customers_id`, `nama`, `email`, `password`, `alamat`, `telp`) VALUES
(2, 'asasassssssssssssssss', 'jawa', '4', 'jawa', '111222'),
(6, 'paijo', 'Seventee17@ymail.com', '171717', 'solo', '098');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `nama_kategori`) VALUES
(2, 'minuman1makanan'),
(3, 'food');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(1) NOT NULL,
  `nama_level` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'Manager'),
(2, 'Marketting'),
(3, 'Bagian Produksi'),
(4, 'Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `orderan`
--

CREATE TABLE `orderan` (
  `no_order` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal` date NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `orderan`
--

INSERT INTO `orderan` (`no_order`, `customers_id`, `deskripsi`, `tanggal`, `total`) VALUES
(2, 2, 'asasa', '2019-07-11', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `no_det` int(11) NOT NULL,
  `no_order` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `hrg_jual` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`no_det`, `no_order`, `produk_id`, `hrg_jual`, `jumlah`, `subtotal`) VALUES
(1, 2, 1, 1000, 1100, 1010101),
(2, 2, 1, 1000, 100, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `laba` int(11) NOT NULL,
  `gambar` varchar(256) NOT NULL,
  `kategori_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `nama_produk`, `deskripsi`, `harga`, `stok`, `laba`, `gambar`, `kategori_id`) VALUES
(1, 'kertas', 'tebal', 1000, 1000, 1000, 'Desert.jpg', 2),
(17, 'koala', 'makan nan', 1000, 100, 1000, 'Penguins.jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `produksi`
--

CREATE TABLE `produksi` (
  `no_produksi` int(11) NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jml_produksi` int(11) NOT NULL,
  `biaya_bahan` int(11) NOT NULL,
  `biaya_tkl` int(11) NOT NULL,
  `biaya_produksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produksi`
--

INSERT INTO `produksi` (`no_produksi`, `tanggal_selesai`, `produk_id`, `jml_produksi`, `biaya_bahan`, `biaya_tkl`, `biaya_produksi`) VALUES
(1, '2019-11-12', 1, 1, 1, 1, 1),
(10, '2019-07-31', 17, 10, 10, 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `produksi_jadwal`
--

CREATE TABLE `produksi_jadwal` (
  `jadwal_id` int(11) NOT NULL,
  `no_produksi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `kapasitas_produksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produksi_jadwal`
--

INSERT INTO `produksi_jadwal` (`jadwal_id`, `no_produksi`, `tanggal`, `kapasitas_produksi`) VALUES
(3, 10, '2019-07-12', 100),
(4, 1, '2019-07-20', 100);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_bahan`
--

CREATE TABLE `purchase_bahan` (
  `id` int(11) NOT NULL,
  `no_produksi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jml_kbp` float NOT NULL,
  `biaya_bahan` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_bahan`
--

INSERT INTO `purchase_bahan` (`id`, `no_produksi`, `tanggal`, `jml_kbp`, `biaya_bahan`, `supplier_id`) VALUES
(1, 10, '2019-07-08', 100000000, 10, 4),
(3, 1, '2019-07-18', 131, 123, 3),
(6, 1, '2019-07-17', 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `super_user`
--

CREATE TABLE `super_user` (
  `no_id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(256) NOT NULL,
  `id_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `super_user`
--

INSERT INTO `super_user` (`no_id`, `nama`, `username`, `password`, `id_level`) VALUES
(1, 'Manager Besar', 'manager', '1d0258c2440a8d19e716292b231e3190', 1),
(2, 'Marketting Saya', 'marketting', '004405c03e2ab8c4c4526f10d697b681', 2),
(3, 'Bagian Produksi', 'bagprod', '202cb962ac59075b964b07152d234b70', 3);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(15) NOT NULL,
  `id_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `nama`, `username`, `email`, `password`, `alamat`, `telp`, `id_level`) VALUES
(3, 'supply', 'supply', 'Aku@gmail.com', 'aaf9a7ade8ad853549f9ce5d53e8d645', 'wqasasas', '-1', 4),
(4, 'akusaha', 'akusaha', 'akusaja@gmail.com', 'e3dd72a70d1d2f5fb3f69365539f60f5', 'solo', '1111', 4),
(5, 'saya', 'saya', 'saya@gmail.com', '20c1a26a55039b30866c9d0aa51953ca', 'sayasaja', '111212', 4),
(6, 'gue', 'gue', 'gue@gmail.com', '944c4afe62b91d13e9b211f0d9105d4b', 'guesaha', '77676', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan`
--
ALTER TABLE `bahan`
  ADD PRIMARY KEY (`bahan_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customers_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `orderan`
--
ALTER TABLE `orderan`
  ADD PRIMARY KEY (`no_order`),
  ADD KEY `customer_id` (`customers_id`),
  ADD KEY `customers_id` (`customers_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`no_det`),
  ADD KEY `no_order` (`no_order`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`no_produksi`),
  ADD KEY `produk_id` (`produk_id`);

--
-- Indexes for table `produksi_jadwal`
--
ALTER TABLE `produksi_jadwal`
  ADD PRIMARY KEY (`jadwal_id`),
  ADD KEY `no_produksi` (`no_produksi`);

--
-- Indexes for table `purchase_bahan`
--
ALTER TABLE `purchase_bahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `no_produksi` (`no_produksi`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `super_user`
--
ALTER TABLE `super_user`
  ADD PRIMARY KEY (`no_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan`
--
ALTER TABLE `bahan`
  MODIFY `bahan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orderan`
--
ALTER TABLE `orderan`
  MODIFY `no_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `no_det` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `produksi`
--
ALTER TABLE `produksi`
  MODIFY `no_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `produksi_jadwal`
--
ALTER TABLE `produksi_jadwal`
  MODIFY `jadwal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `purchase_bahan`
--
ALTER TABLE `purchase_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `super_user`
--
ALTER TABLE `super_user`
  MODIFY `no_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan`
--
ALTER TABLE `bahan`
  ADD CONSTRAINT `bahan_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);

--
-- Constraints for table `orderan`
--
ALTER TABLE `orderan`
  ADD CONSTRAINT `orderan_ibfk_1` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`customers_id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`produk_id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`no_order`) REFERENCES `orderan` (`no_order`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`);

--
-- Constraints for table `produksi`
--
ALTER TABLE `produksi`
  ADD CONSTRAINT `produksi_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`produk_id`);

--
-- Constraints for table `produksi_jadwal`
--
ALTER TABLE `produksi_jadwal`
  ADD CONSTRAINT `produksi_jadwal_ibfk_1` FOREIGN KEY (`no_produksi`) REFERENCES `produksi` (`no_produksi`);

--
-- Constraints for table `purchase_bahan`
--
ALTER TABLE `purchase_bahan`
  ADD CONSTRAINT `purchase_bahan_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`),
  ADD CONSTRAINT `purchase_bahan_ibfk_2` FOREIGN KEY (`no_produksi`) REFERENCES `produksi` (`no_produksi`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
