-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 27, 2024 at 07:31 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bankmini`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_nasabah`
--

CREATE TABLE `admin_nasabah` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','supervisor') DEFAULT 'admin',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_nasabah`
--

INSERT INTO `admin_nasabah` (`id`, `nama`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Rahin', 'rahin@gmail.com', 'rahin123', 'admin', '2024-07-29 15:01:51', '2024-07-29 15:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int NOT NULL,
  `nama_jurusan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama_jurusan`) VALUES
(3, 'RPL'),
(5, 'TKJ'),
(6, 'OTKP'),
(8, 'PPLG'),
(9, 'TPM');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int NOT NULL,
  `nama_kelas` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama_kelas`) VALUES
(11, 'XI'),
(12, 'XII'),
(13, 'X');

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `id` bigint NOT NULL,
  `Nama` varchar(250) NOT NULL,
  `nis` int NOT NULL,
  `no_rekening` bigint NOT NULL,
  `Jenis_Kelamin` varchar(30) NOT NULL,
  `Tanggal_Pembuatan` varchar(250) NOT NULL,
  `Saldo` int NOT NULL,
  `Status` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kelas_id` int DEFAULT NULL,
  `jurusan_id` int DEFAULT NULL,
  `password` varchar(255) DEFAULT '123456',
  `password_default` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id`, `Nama`, `nis`, `no_rekening`, `Jenis_Kelamin`, `Tanggal_Pembuatan`, `Saldo`, `Status`, `kelas_id`, `jurusan_id`, `password`, `password_default`) VALUES
(16, 'rahin', 10101010, 3003080701, 'Pria', '2024-07-25', 70000, 'Aktif', 12, 3, '123456', 1),
(21, 'raka', 121212, 17231869966495, 'Pria', '2024-08-23', 40000, 'Aktif', 12, 3, '123456', 1),
(22, 'andini', 1111, 17231870247307, 'Pria', '2024-08-11', 0, 'Aktif', 12, 6, '123456', 1);

-- --------------------------------------------------------

--
-- Table structure for table `riwayat`
--

CREATE TABLE `riwayat` (
  `id` int NOT NULL,
  `no_rekening` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_transaksi` varchar(255) NOT NULL,
  `jumlah` int NOT NULL,
  `saldo` decimal(10,0) NOT NULL,
  `tanggal_pembuatan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `riwayat`
--

INSERT INTO `riwayat` (`id`, `no_rekening`, `nama`, `jenis_transaksi`, `jumlah`, `saldo`, `tanggal_pembuatan`) VALUES
(3, 79208546, 'rahin', 'Setor_tunai', 20000, 10000, '2024-08-26 09:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `no_rekening` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nominal` decimal(15,2) NOT NULL,
  `jenis_transaksi` enum('Setor_tunai','tarik_tunai') NOT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `no_rekening`, `nama`, `nominal`, `jenis_transaksi`, `tanggal`) VALUES
(1, '3003080701', 'rahin', 20000.00, 'Setor_tunai', '2024-08-26 03:05:21'),
(2, '3003080701', 'rahin', 20000.00, 'tarik_tunai', '2024-08-26 03:21:41'),
(3, '3003080701', 'rahin', 20000.00, 'Setor_tunai', '2024-08-26 03:23:00'),
(4, '3003080701', 'rahin', 20000.00, 'Setor_tunai', '2024-08-26 03:24:58'),
(5, '3003080701', 'rahin', 40000.00, 'tarik_tunai', '2024-08-26 03:25:16'),
(6, '3003080701', 'rahin', 20000.00, 'Setor_tunai', '2024-08-26 03:51:47'),
(7, '3003080701', 'rahin', 20000.00, 'Setor_tunai', '2024-08-26 03:58:17'),
(8, '17231869966495', 'raka', 20000.00, 'Setor_tunai', '2024-08-26 04:33:45'),
(9, '17231869966495', 'raka', 20000.00, 'Setor_tunai', '2024-08-26 04:37:52'),
(10, '3003080701', 'rahin', 20000.00, 'Setor_tunai', '2024-08-26 06:10:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_nasabah`
--
ALTER TABLE `admin_nasabah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas` (`kelas_id`),
  ADD KEY `jurusan` (`jurusan_id`);

--
-- Indexes for table `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_nasabah`
--
ALTER TABLE `admin_nasabah`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD CONSTRAINT `jurusan` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`),
  ADD CONSTRAINT `kelas` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
