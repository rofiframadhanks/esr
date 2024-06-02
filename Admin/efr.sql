-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jun 2024 pada 10.08
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `efr`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE `laporan` (
  `idlaporan` int(11) NOT NULL,
  `iduser` varchar(17) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `kejadian` varchar(100) DEFAULT NULL,
  `nohp` varchar(100) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT 'Menunggu Diverifikasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`idlaporan`, `iduser`, `nama`, `lokasi`, `kejadian`, `nohp`, `image`, `status`) VALUES
(1, '3671070506000004', 'Helisma Putri', 'Jl. Bumi Manti 2 no. 18 Kampung Baru, Kedaton, Bandar Lampung', 'Kebakaran Rumah', '08121244839', '/ADSI/images/Screenshot (1661).png', 'Diterima'),
(2, '3671070801050004', 'Adzana Ashel', 'Jl. Enggal Raya', 'Kebakaran Mall', '089329847283', '/ADSI/images/Screenshot (1661).png', 'Diterima');

--
-- Trigger `laporan`
--
DELIMITER $$
CREATE TRIGGER `before_insert_laporan` BEFORE INSERT ON `laporan` FOR EACH ROW BEGIN
    DECLARE v_nama VARCHAR(50);
    DECLARE v_nohp VARCHAR(50);

    -- Ambil nama dan nohp dari tabel users
    SELECT nama, nohp INTO v_nama, v_nohp FROM users WHERE id = NEW.iduser;

    -- Set nilai nama dan nohp di laporan
    SET NEW.nama = v_nama;
    SET NEW.nohp = v_nohp;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` varchar(17) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nohp` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `nohp`, `email`) VALUES
('3671070506000004', 'Helisma Putri', '08121244839', 'helismajkt@jeketi.com'),
('3671070801050004', 'Adzana Ashel', '089329847283', 'adzanaashel@jeketi.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_verif`
--

CREATE TABLE `user_verif` (
  `id` varchar(17) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nohp` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`idlaporan`),
  ADD KEY `iduser` (`iduser`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD UNIQUE KEY `nohp` (`nohp`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `user_verif`
--
ALTER TABLE `user_verif`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `idlaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
