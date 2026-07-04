-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2026 at 05:24 AM
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
-- Database: `db_absensi_sederhana`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status_kehadiran` enum('hadir','izin','sakit','alpa') NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_peserta`, `tanggal`, `status_kehadiran`, `keterangan`, `created_by`, `created_at`) VALUES
(1, 1, '2026-07-01', 'hadir', 'Tepat waktu', 1, '2026-07-01 01:18:58'),
(2, 2, '2026-07-01', 'izin', 'Izin keluarga', 1, '2026-07-01 01:18:58'),
(3, 3, '2026-07-01', 'sakit', 'Sakit ringan', 1, '2026-07-01 01:18:58'),
(4, 4, '2026-07-01', 'hadir', 'Tepat waktu', 1, '2026-07-01 01:18:58'),
(5, 5, '2026-07-01', 'alpa', 'Tanpa keterangan', 1, '2026-07-01 01:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `nim` varchar(30) NOT NULL,
  `nama_peserta` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `status_peserta` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nim`, `nama_peserta`, `jenis_kelamin`, `kelas`, `prodi`, `no_hp`, `alamat`, `status_peserta`, `created_at`) VALUES
(1, '230101001', 'Ahmad Fauzi', 'L', 'Unit 01', 'Pendidikan Teknologi Informasi', '081234567001', 'Banda Aceh', 'aktif', '2026-07-01 01:18:58'),
(2, '230101002', 'Siti Rahmah', 'P', 'Unit 01', 'Pendidikan Teknologi Informasi', '081234567002', 'Banda Aceh', 'aktif', '2026-07-01 01:18:58'),
(3, '230101003', 'M. Ikhsan', 'L', 'Unit 01', 'Pendidikan Teknologi Informasi', '081234567003', 'Aceh Besar', 'aktif', '2026-07-01 01:18:58'),
(4, '230101004', 'Nur Aisyah', 'P', 'Unit 01', 'Pendidikan Teknologi Informasi', '081234567004', 'Banda Aceh', 'aktif', '2026-07-01 01:18:58'),
(5, '230101005', 'Rizky Maulana', 'L', 'Unit 01', 'Pendidikan Teknologi Informasi', '081234567005', 'Pidie', 'aktif', '2026-07-01 01:18:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','operator') DEFAULT 'operator',
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password_hash`, `role`, `status`, `created_at`) VALUES
(1, 'Administrator', 'admin', 'password_hash_diisi_backend', 'admin', 'aktif', '2026-07-01 01:18:58'),
(2, 'Operator Absensi', 'operator', 'password_hash_diisi_backend', 'operator', 'aktif', '2026-07-01 01:18:58');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_rekap_absensi`
-- (See below for the actual view)
--
CREATE TABLE `view_rekap_absensi` (
`id_peserta` int(11)
,`nim` varchar(30)
,`nama_peserta` varchar(100)
,`jenis_kelamin` enum('L','P')
,`kelas` varchar(50)
,`total_pertemuan` bigint(21)
,`total_hadir` decimal(22,0)
,`total_izin` decimal(22,0)
,`total_sakit` decimal(22,0)
,`total_alpa` decimal(22,0)
,`persentase_hadir` decimal(28,2)
);

-- --------------------------------------------------------

--
-- Structure for view `view_rekap_absensi`
--
DROP TABLE IF EXISTS `view_rekap_absensi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_rekap_absensi`  AS SELECT `p`.`id_peserta` AS `id_peserta`, `p`.`nim` AS `nim`, `p`.`nama_peserta` AS `nama_peserta`, `p`.`jenis_kelamin` AS `jenis_kelamin`, `p`.`kelas` AS `kelas`, count(`a`.`id_absensi`) AS `total_pertemuan`, sum(case when `a`.`status_kehadiran` = 'hadir' then 1 else 0 end) AS `total_hadir`, sum(case when `a`.`status_kehadiran` = 'izin' then 1 else 0 end) AS `total_izin`, sum(case when `a`.`status_kehadiran` = 'sakit' then 1 else 0 end) AS `total_sakit`, sum(case when `a`.`status_kehadiran` = 'alpa' then 1 else 0 end) AS `total_alpa`, round(sum(case when `a`.`status_kehadiran` = 'hadir' then 1 else 0 end) / count(`a`.`id_absensi`) * 100,2) AS `persentase_hadir` FROM (`peserta` `p` left join `absensi` `a` on(`p`.`id_peserta` = `a`.`id_peserta`)) GROUP BY `p`.`id_peserta`, `p`.`nim`, `p`.`nama_peserta`, `p`.`jenis_kelamin`, `p`.`kelas` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD UNIQUE KEY `unique_absensi_peserta_tanggal` (`id_peserta`,`tanggal`),
  ADD KEY `fk_absensi_user` (`created_by`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `fk_absensi_peserta` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_absensi_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
