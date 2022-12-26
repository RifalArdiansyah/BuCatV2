-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 26, 2022 at 05:10 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uang`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pengeluaran`
--

CREATE TABLE `jenis_pengeluaran` (
  `id_jenis` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_pengeluaran`
--

INSERT INTO `jenis_pengeluaran` (`id_jenis`, `nama`) VALUES
(1, 'Gaji Karyawan'),
(2, 'Sewa Bangunan'),
(3, 'Listrik'),
(4, 'Air'),
(5, 'Wifi');

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pemasukan` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_sumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `id_user`, `tgl_pemasukan`, `jumlah`, `id_sumber`) VALUES
(1, 1, '2022-12-25', 100000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `id_user`, `tgl_pengeluaran`, `jumlah`, `id_jenis`) VALUES
(1, 1, '2022-12-25', 48000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sumber_pemasukan`
--

CREATE TABLE `sumber_pemasukan` (
  `id_sumber` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sumber_pemasukan`
--

INSERT INTO `sumber_pemasukan` (`id_sumber`, `nama`) VALUES
(1, 'Menjual Barang'),
(2, 'Menjual Jasa'),
(3, 'Iklan'),
(4, 'Endorse'),
(5, 'Data Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kode_pos` varchar(50) NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `username`, `email`, `password`, `no_hp`, `alamat`, `kode_pos`, `pekerjaan`, `status`, `saldo`) VALUES
(1, 'Rifal A', 'rifal', 'rifal@mail.com', '$2y$10$5piXcA.Ouzaxy/VWON8FL.AmyVoG5Wlllco/5h2pX25kTouGDihei', '081234567890', 'Jalan Kenangan', '51111', 'Programmer', ' ', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_pengeluaran`
--
ALTER TABLE `jenis_pengeluaran`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_sumber` (`id_sumber`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `sumber_pemasukan`
--
ALTER TABLE `sumber_pemasukan`
  ADD PRIMARY KEY (`id_sumber`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_pengeluaran`
--
ALTER TABLE `jenis_pengeluaran`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sumber_pemasukan`
--
ALTER TABLE `sumber_pemasukan`
  MODIFY `id_sumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `pemasukan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pemasukan_ibfk_2` FOREIGN KEY (`id_sumber`) REFERENCES `sumber_pemasukan` (`id_sumber`);

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `pengeluaran_ibfk_2` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_pengeluaran` (`id_jenis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
