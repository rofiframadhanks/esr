-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2024 pada 11.29
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
-- Database: `efrrr`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsip`
--

CREATE TABLE `arsip` (
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `evidence_path` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `arsip_view`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `arsip_view` (
`name` varchar(255)
,`location` varchar(255)
,`description` text
,`phone` varchar(20)
,`evidence_path` varchar(255)
,`tanggal` date
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pending_requests`
--

CREATE TABLE `pending_requests` (
  `id` int(11) NOT NULL,
  `idlaporan` int(11) NOT NULL,
  `idpetugas` varchar(17) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id` varchar(17) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `availibility` varchar(100) DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id`, `username`, `email`, `location`, `availibility`) VALUES
('112', 'Ojan', 'ojan@petugas.efr.com', 'Kemiling', 'Tidak Tersedia'),
('114', 'Jabieb', 'jabieb@petugas.efr.com', 'Kedaton', 'Tersedia'),
('116', 'Bebi', 'bebi@petugas.efr.com', 'Rajabasa', 'Tersedia'),
('123', 'Fritz', 'fritz@petugas.efr.com', 'Teluk Betung', 'Tersedia');

--
-- Trigger `petugas`
--
DELIMITER $$
CREATE TRIGGER `trg_fill_petugas_fields` BEFORE INSERT ON `petugas` FOR EACH ROW BEGIN
    DECLARE v_username VARCHAR(50);
    DECLARE v_email VARCHAR(100);

    SELECT username, email INTO v_username, v_email
    FROM users
    WHERE id = NEW.id;

    SET NEW.username = v_username;
    SET NEW.email = v_email;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `reports`
--

CREATE TABLE `reports` (
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `evidence_path` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Menunggu Diverifikasi',
  `idlaporan` int(11) NOT NULL,
  `idpetugas` varchar(17) DEFAULT NULL,
  `usernamepetugas` varchar(100) DEFAULT NULL,
  `iduser` varchar(17) DEFAULT NULL,
  `date` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `reports`
--

INSERT INTO `reports` (`name`, `location`, `description`, `phone`, `evidence_path`, `status`, `idlaporan`, `idpetugas`, `usernamepetugas`, `iduser`, `date`) VALUES
('LUTHFI ADITYA', 'Jl. Bumi Mani 2 No 2. Kota Bandar Lampung, Provinsi Lampung', 'Kebakaran Theater (Menyala Abangkuh) (Ashel grad bjir? (delshel karam bjir)', '081212411730', '../uploads/GGD6LBZbsAAcO-b.jpg', 'Selesai', 1, '114', 'Jabieb', NULL, '2024-06-10'),
('Adzana Shaliha', 'Bandar Lampung', 'Hatiku Menyala', '082323487928', '../uploads/0b06adac-455a-4803-a95c-e6d503973a2b-1603628517319-e10b2b9a7a52e58f6971e3d2f33ef3c8.webp', 'Selesai', 2, '114', 'Jabieb', NULL, '2024-06-10'),
('Luthfi Aditya', 'Bandar Lampung', 'Bandar Lampung', '082323487928', '../uploads/Wallpaper.bmp', 'Selesai', 3, '114', 'Jabieb', NULL, '2024-06-10'),
('LUTHFI ADITYA', 'Bandar Lampung', 'Kebakaran Hati', '082323487928', '../uploads/Wallpaper.bmp', 'Selesai', 4, '114', 'Jabieb', NULL, '2024-06-10'),
('LUTHFI ADITYA', 'OTAK GW', 'KEBAKARAN OTAK', '09184091842903', '../uploads/mengpisang.jpg', 'Selesai', 5, '114', 'Jabieb', NULL, '2024-06-10'),
('LUTHFI ADITYA', 'Bandar Lampung', 'kebakaran otak', '909348534', 'uploads/download (5).jpeg', 'Selesai', 6, '114', 'Jabieb', NULL, '2024-06-10'),
('adit', 'unila', 'saya yang bakar', '098098908', 'uploads/Premium Photo _ White crumpled paper sheet, background for design.jpeg', 'Selesai', 7, '114', 'Jabieb', NULL, '2024-06-10'),
('LUTHFI ADITYA', 'Bandar Lampung', 'tak tau ', '980983249082', 'uploads/backgrounderaser1714828956727.png', 'Selesai', 8, '114', 'Jabieb', NULL, '2024-06-10'),
('LUTHFI ADITYA', 'Bandar Lampung', 'tak tau ', '980983249082', 'uploads/backgrounderaser1714828956727.png', 'Selesai', 9, '114', 'Jabieb', NULL, '2024-06-10'),
('LUTHFI ADITYA', 'Bandar Lampung', 'tak tau ', '980983249082', 'uploads/backgrounderaser1714828956727.png', 'Selesai', 10, '114', 'Jabieb', NULL, '2024-06-10'),
('LUTHFI ADITYA', 'kosan saya', 'kebakaran otak saya', '088927498484', 'uploads/Premium Photo _ White crumpled paper sheet, background for design.jpeg', 'Selesai', 11, '114', 'Jabieb', '', '2024-06-10'),
('LUTHFI ADITYA', 'kosan saya', 'kebakaran otak saya', '088927498484', 'uploads/Premium Photo _ White crumpled paper sheet, background for design.jpeg', 'Selesai', 12, '114', 'Jabieb', '', '2024-06-10'),
('LUTHFI ADITYA', 'kosan saya', 'kebakaran otak saya', '088927498484', 'uploads/Premium Photo _ White crumpled paper sheet, background for design.jpeg', 'Selesai', 13, '114', 'Jabieb', '0', '2024-06-10'),
('LUTHFI ADITYA', 'kosan saya', 'kebakaran otak saya', '088927498484', 'uploads/Premium Photo _ White crumpled paper sheet, background for design.jpeg', 'Selesai', 14, '114', 'Jabieb', '0', '2024-06-10'),
('LUTHFI ADITYA', 'Bandar Lampung', 'kebakaran otak saya', '088927498484', 'uploads/whatsapp (1).png', 'Selesai', 15, '114', 'Jabieb', '11', '2024-06-10'),
('LUTHFI ADITYA', 'Bandar Lampung', 'kebakaran otak saya', '088927498484', 'uploads/whatsapp (1).png', 'Selesai', 16, '114', 'Jabieb', '11', '2024-06-10'),
('LUTHFI ADITYA', 'Bandar Lampung', 'kebakaran otak saya', '088927498484', '../user/uploads/whatsapp (1).png', 'Diterima', 17, '114', 'Jabieb', '11', '2024-06-10'),
('Luthfi Aditya', 'Bandar Lampung', 'Kebakaran Rumah', '081212411730', '../uploads/GGD6LBZbsAAcO-b.jpg', 'Menunggu Diverifikasi', 18, NULL, NULL, '11', '2024-06-10'),
('Luthif ', 'Balam', 'bakar kang', '083423847294', '../uploads/CSR EFR-Melakukan login [User].png', 'Diterima', 19, '114', 'Jabieb', '11', '2024-06-10');

--
-- Trigger `reports`
--
DELIMITER $$
CREATE TRIGGER `trg_before_insert_reports` BEFORE INSERT ON `reports` FOR EACH ROW BEGIN
    DECLARE v_username VARCHAR(100);

    SELECT username INTO v_username
    FROM petugas
    WHERE id = NEW.idpetugas;

    SET NEW.usernamepetugas = v_username;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_before_update_reports` BEFORE UPDATE ON `reports` FOR EACH ROW BEGIN
    DECLARE v_username VARCHAR(100);

    SELECT username INTO v_username
    FROM petugas
    WHERE id = NEW.idpetugas;

    SET NEW.usernamepetugas = v_username;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` varchar(17) NOT NULL,
  `phone` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `phone`, `username`, `email`, `password`, `role`) VALUES
('1', 12345, 'admin', 'admin@example.com', '$2y$10$9KOsVZBY21/Jz84SLfE1Lunme1XdfkO3G4ElwJ4Yjkva88IpaUNyK', 'admin'),
('10', 12345678, 'Ibnu', 'ibnu@example.com', '$2y$10$p2FU9KiTdrFJBEX195VpZuQNHTbhqr0eWJhrG3gCkh7D7Jc387bV.', 'user'),
('11', 123456789, 'Adit', 'adit@example.com', '$2y$10$Q8iGwHjmB9rWmLU1US3lQO5Unc9vcAguq2Y7X8.GfHbN55dgpvdSW', 'user'),
('112', 2147483647, 'Ojan', 'ojan@petugas.efr.com', '$2y$10$lFo4RSs4czR9NCKl4oXwn.zOUL19Yn3vLsbRzdC6p1wYgzN2mTBZS', 'petugas'),
('114', 2147483647, 'Jabieb', 'jabieb@petugas.efr.com', '$2y$10$wY1dukZFoFmP./9E9R9NQ.mYArob.v0/5b1x6XfAEehu0fdTr7GHO', 'petugas'),
('116', 2147483647, 'Bebi', 'bebi@petugas.efr.com', '$2y$10$tzYzE2S9cxaf13ZOR5RnXOrWqOdQ6PAl0kvusaS3EYOM0GUpp0/Ty', 'petugas'),
('12', 1234567899, 'Jono', 'tono@example.com', '$2y$10$pgbkN0G5hXwzsgFhdCbwgeBWjpou.i8WanCqnrAchwt9VPP6y.uR2', 'user'),
('123', 2147483647, 'Fritz', 'fritz@petugas.efr.com', '$2y$10$Q9y0gxrzUGds7dFNKQ3STuc4Insgevbnt086s7EPLOerrV9abaBLu', 'petugas'),
('13', 1234567800, 'petugas', 'petugas@example.com', '$2y$10$zccQ4AqA3wFXt.PlYoXodeEcI1wOXshOcbyTj2ce/k3.IuwXJ3CKK', 'petugas'),
('3671070112040004', 2147483647, 'Luthfi Aditya', 'luthfi2004aditya@gmail.com', '$2y$10$m8I9O6C/ctYAHVhEphzbVePDexu5I9D.WDK2e89/1Dy9I7YTN3uRK', 'user'),
('367109993722', 812124117, 'akuajadeh', 'luthfia@h.com', '', 'user'),
('3671920801050005', 2147483647, 'Adzana Shaliha', 'asheladz@gmail.com', '', 'user'),
('3671989929390', 2147483647, 'Adheetya', 'adheet@unila.com', '', 'user'),
('3847294773928883', 2147483647, 'Helisma Putri', 'helisma@jeketi.com', '', 'user'),
('6', 123456, 'Rofif', 'rofif@example.com', '$2y$10$q86LSH8n0qHaRkd4/sOZoek/QMpjcgHlayNn1hhKxBsBkOgXFJA/e', 'user'),
('7', 1234567, 'Dela', 'dela@example.com', '$2y$10$pmz08UBih41zR5MMonIjOuu1TCARN9U0IzjE3eLs.bpOBYb4H67.2', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_verif`
--

CREATE TABLE `user_verif` (
  `id` varchar(17) NOT NULL,
  `username` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur untuk view `arsip_view`
--
DROP TABLE IF EXISTS `arsip_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `arsip_view`  AS SELECT `reports`.`name` AS `name`, `reports`.`location` AS `location`, `reports`.`description` AS `description`, `reports`.`phone` AS `phone`, `reports`.`evidence_path` AS `evidence_path`, curdate() AS `tanggal` FROM `reports` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pending_requests`
--
ALTER TABLE `pending_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idlaporan` (`idlaporan`),
  ADD KEY `idpetugas` (`idpetugas`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`idlaporan`),
  ADD KEY `fk_reports_petugas` (`idpetugas`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_verif`
--
ALTER TABLE `user_verif`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pending_requests`
--
ALTER TABLE `pending_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `reports`
--
ALTER TABLE `reports`
  MODIFY `idlaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pending_requests`
--
ALTER TABLE `pending_requests`
  ADD CONSTRAINT `pending_requests_ibfk_1` FOREIGN KEY (`idlaporan`) REFERENCES `reports` (`idlaporan`),
  ADD CONSTRAINT `pending_requests_ibfk_2` FOREIGN KEY (`idpetugas`) REFERENCES `reports` (`idpetugas`);

--
-- Ketidakleluasaan untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `fk_reports_petugas` FOREIGN KEY (`idpetugas`) REFERENCES `petugas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
