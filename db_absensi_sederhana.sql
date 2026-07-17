-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jul 2026 pada 18.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `absensi`
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
-- Dumping data untuk tabel `absensi`
--

INSERT INTO `absensi` (`id_absensi`, `id_peserta`, `tanggal`, `status_kehadiran`, `keterangan`, `created_by`, `created_at`) VALUES
(2, 2, '2026-07-01', 'izin', 'Izin keluarga', 1, '2026-07-01 01:18:58'),
(3, 3, '2026-07-01', 'sakit', 'Sakit ringan', 1, '2026-07-01 01:18:58'),
(4, 4, '2026-07-01', 'hadir', 'Tepat waktu', 1, '2026-07-01 01:18:58'),
(5, 5, '2026-07-01', 'alpa', 'Tanpa keterangan', 1, '2026-07-01 01:18:58'),
(8, 3, '2026-07-16', 'alpa', '', 1, '2026-07-15 17:55:02'),
(9, 4, '2026-07-16', 'alpa', '', 1, '2026-07-15 17:55:02'),
(10, 5, '2026-07-16', 'alpa', '', 1, '2026-07-15 17:55:02'),
(11, 2, '2026-07-16', 'alpa', '', 1, '2026-07-15 17:55:02'),
(14, 3, '2026-07-17', 'hadir', '', 1, '2026-07-17 04:47:36'),
(15, 4, '2026-07-17', 'hadir', '', 1, '2026-07-17 04:47:36'),
(16, 5, '2026-07-17', 'hadir', '', 1, '2026-07-17 04:47:36'),
(17, 2, '2026-07-17', 'alpa', '', 1, '2026-07-17 04:47:36'),
(18, 7, '2026-07-17', 'alpa', '', 1, '2026-07-17 05:26:37'),
(19, 9, '2026-07-17', 'hadir', '', 1, '2026-07-17 05:26:37'),
(21, 8, '2026-07-17', 'hadir', '', 1, '2026-07-17 05:26:37'),
(22, 11, '2026-07-17', 'hadir', '', 1, '2026-07-17 05:27:53'),
(23, 13, '2026-07-17', 'sakit', '', NULL, '2026-07-17 13:34:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peserta`
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
-- Dumping data untuk tabel `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nim`, `nama_peserta`, `jenis_kelamin`, `kelas`, `prodi`, `no_hp`, `alamat`, `status_peserta`, `created_at`) VALUES
(2, '230101002', 'Siti Rahmah', 'P', 'Unit 01', 'Pendidikan Teknologi Informasi', '081234567002', 'Banda Aceh', 'aktif', '2026-07-01 01:18:58'),
(3, '230101003', 'M. Ikhsan', 'L', 'Unit 01', 'Pendidikan Teknologi Informasi', '081234567003', 'Aceh Besar', 'aktif', '2026-07-01 01:18:58'),
(4, '230101004', 'Nur Aisyah', 'P', 'Unit 01', 'Pendidikan Teknologi Informasi', '081234567004', 'Banda Aceh', 'aktif', '2026-07-01 01:18:58'),
(5, '230101005', 'Rizky Maulana', 'L', 'Unit 01', 'Pendidikan Teknologi Informasi', '081234567005', 'Pidie', 'aktif', '2026-07-01 01:18:58'),
(7, '230101006', 'Andi Saputra', 'L', 'Unit 01', 'Pendidikan Teknologi Informasi', '081234567006', 'Banda Aceh', 'aktif', '2026-07-17 05:26:10'),
(8, '230101007', 'Rina Oktavia', 'P', 'Unit 01', 'Pendidikan Teknologi Informasi', '081234567007', 'Aceh Besar', 'aktif', '2026-07-17 05:26:10'),
(9, '230101008', 'Fajar Ramadhan', 'L', 'Unit 01', 'Pendidikan Teknologi Informasi', '081234567008', 'Pidie', 'aktif', '2026-07-17 05:26:10'),
(11, '25032487598754', 'M. poitf', 'P', 'unit 04', 'Pendidikan Teknologi Informasi', '082237973942', 'aceh', 'aktif', '2026-07-17 05:27:16'),
(13, '2567827634', 'ib', 'P', 'Unit 03', 'Pendidikan Teknologi Informasi', '082237973942', 'ejeis', 'aktif', '2026-07-17 13:34:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password_hash`, `role`, `status`, `created_at`) VALUES
(1, 'Administrator', 'admin', 'admin2026', 'admin', 'aktif', '2026-07-01 01:18:58'),
(2, 'Operator Absensi', 'operator', 'operator2026', 'operator', 'aktif', '2026-07-01 01:18:58');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_rekap_absensi`
-- (Lihat di bawah untuk tampilan aktual)
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
-- Struktur untuk view `view_rekap_absensi`
--
DROP TABLE IF EXISTS `view_rekap_absensi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_rekap_absensi`  AS SELECT `p`.`id_peserta` AS `id_peserta`, `p`.`nim` AS `nim`, `p`.`nama_peserta` AS `nama_peserta`, `p`.`jenis_kelamin` AS `jenis_kelamin`, `p`.`kelas` AS `kelas`, count(`a`.`id_absensi`) AS `total_pertemuan`, sum(case when `a`.`status_kehadiran` = 'hadir' then 1 else 0 end) AS `total_hadir`, sum(case when `a`.`status_kehadiran` = 'izin' then 1 else 0 end) AS `total_izin`, sum(case when `a`.`status_kehadiran` = 'sakit' then 1 else 0 end) AS `total_sakit`, sum(case when `a`.`status_kehadiran` = 'alpa' then 1 else 0 end) AS `total_alpa`, round(sum(case when `a`.`status_kehadiran` = 'hadir' then 1 else 0 end) / count(`a`.`id_absensi`) * 100,2) AS `persentase_hadir` FROM (`peserta` `p` left join `absensi` `a` on(`p`.`id_peserta` = `a`.`id_peserta`)) GROUP BY `p`.`id_peserta`, `p`.`nim`, `p`.`nama_peserta`, `p`.`jenis_kelamin`, `p`.`kelas` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD UNIQUE KEY `unique_absensi_peserta_tanggal` (`id_peserta`,`tanggal`),
  ADD KEY `fk_absensi_user` (`created_by`);

--
-- Indeks untuk tabel `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `fk_absensi_peserta` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_absensi_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id_user`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
