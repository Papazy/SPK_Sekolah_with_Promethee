-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Apr 2025 pada 02.17
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
-- Database: `spk_paud`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(11) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` enum('Benefit','Cost') NOT NULL,
  `skala` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id`, `kode`, `nama`, `jenis`, `skala`) VALUES
(1, 'C1', 'Metode Pengajaran', 'Benefit', 'Skala 1-5'),
(2, 'C2', 'Kualitas Kurikulum', 'Benefit', 'Skala 1-5'),
(3, 'C3', 'Kualifikasi Guru', 'Benefit', 'Skala 1-5'),
(4, 'C4', 'Fasilitas Sekolah', 'Benefit', 'Skala 1-5'),
(5, 'C5', 'Reputasi Sekolah', 'Benefit', 'Skala 1-5'),
(6, 'C6', 'Jarak Sekolah dari Rumah', 'Cost', 'Kilometer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria_paud`
--

CREATE TABLE `kriteria_paud` (
  `id` int(11) NOT NULL,
  `paud_id` int(11) NOT NULL,
  `kriteria_id` int(11) NOT NULL,
  `nilai` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kriteria_paud`
--

INSERT INTO `kriteria_paud` (`id`, `paud_id`, `kriteria_id`, `nilai`) VALUES
(31, 24, 1, 2.00),
(32, 24, 2, 4.00),
(33, 24, 3, 2.00),
(34, 24, 4, 2.00),
(35, 24, 5, 4.00),
(36, 24, 6, NULL),
(37, 23, 1, 2.00),
(38, 23, 2, 5.00),
(39, 23, 3, 4.00),
(40, 23, 4, 3.00),
(41, 23, 5, 3.00),
(42, 23, 6, NULL),
(43, 22, 1, 1.00),
(44, 22, 2, 2.00),
(45, 22, 3, 3.00),
(46, 22, 4, 4.00),
(47, 22, 5, 4.00),
(48, 22, 6, NULL),
(49, 21, 1, 4.00),
(50, 21, 2, 3.00),
(51, 21, 3, 3.00),
(52, 21, 4, 3.00),
(53, 21, 5, 4.00),
(54, 21, 6, NULL),
(55, 20, 1, 4.00),
(56, 20, 2, 1.00),
(57, 20, 3, 2.00),
(58, 20, 4, 5.00),
(59, 20, 5, 5.00),
(60, 20, 6, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-04-21-110554', 'App\\Database\\Migrations\\CreatePaud', 'default', 'App', 1745571094, 1),
(2, '2025-04-21-124556', 'App\\Database\\Migrations\\CreateUsers', 'default', 'App', 1745571094, 1),
(5, '2025-04-21-132223', 'App\\Database\\Migrations\\CreateKriteria', 'default', 'App', 1745751968, 2),
(8, '2025-04-27-110823', 'App\\Database\\Migrations\\CreateKriteriaPaud', 'default', 'App', 1745847319, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `paud`
--

CREATE TABLE `paud` (
  `id` int(11) NOT NULL,
  `npsn` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `akreditasi` varchar(100) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `kepala_sekolah` varchar(100) NOT NULL,
  `biaya_spp` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `paud`
--

INSERT INTO `paud` (`id`, `npsn`, `nama`, `alamat`, `kecamatan`, `status`, `akreditasi`, `latitude`, `longitude`, `kepala_sekolah`, `biaya_spp`) VALUES
(20, '12345678', 'PAUD Harapan Bangsa', 'Jl. Merdeka No.1', 'Kota Juang', 'negeri', 'Unggul', 5.20123000, 96.70123000, 'Bu Ani', 50000.00),
(21, '87654321', 'PAUD Ceria', 'Jl. Ahmad Yani No.5', 'Samalanga', 'swasta', 'B', 5.21234000, 96.71234000, 'Pak Budi', 75000.00),
(22, '56781234', 'PAUD Pelangi', 'Jl. Cut Nyak Dhien No.8', 'Juli', 'negeri', 'A', 5.22345000, 96.72345000, 'Bu Fitri', 0.00),
(23, '43218765', 'PAUD Matahari', 'Jl. Sudirman No.12', 'Jeumpa', 'swasta', 'B', 5.23456000, 96.73456000, 'Pak Joko', 100000.00),
(24, '34567812', 'PAUD Bintang Kecil', 'Jl. Diponegoro No.15', 'Pandrah', 'negeri', 'A', 5.24567000, 96.74567000, 'Bu Sari', 25000.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$wiezsxUwuJej/eDTUNb8G.YSwIBxpiRwAa.QtkyU6oZtOeP29VeL6', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kriteria_paud`
--
ALTER TABLE `kriteria_paud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kriteria_paud_paud_id_foreign` (`paud_id`),
  ADD KEY `kriteria_paud_kriteria_id_foreign` (`kriteria_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `paud`
--
ALTER TABLE `paud`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `kriteria_paud`
--
ALTER TABLE `kriteria_paud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `paud`
--
ALTER TABLE `paud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kriteria_paud`
--
ALTER TABLE `kriteria_paud`
  ADD CONSTRAINT `kriteria_paud_kriteria_id_foreign` FOREIGN KEY (`kriteria_id`) REFERENCES `kriteria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kriteria_paud_paud_id_foreign` FOREIGN KEY (`paud_id`) REFERENCES `paud` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
