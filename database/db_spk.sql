-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Okt 2020 pada 14.46
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `kdKaryawan` int(11) NOT NULL,
  `karyawan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`kdKaryawan`, `karyawan`) VALUES
(9, 'Karyawan A'),
(10, 'karyawan B'),
(12, 'Karyawan C'),
(13, 'Karyawan D');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `kdKriteria` int(11) NOT NULL,
  `kriteria` varchar(100) NOT NULL,
  `sifat` char(1) NOT NULL,
  `bobot` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`kdKriteria`, `kriteria`, `sifat`, `bobot`) VALUES
(13, 'Kuantitas', 'B', 8),
(14, 'Kualitas', 'B', 8),
(15, 'Delivery', 'B', 6),
(16, 'SOP', 'B', 8),
(17, 'Penguasaan', 'B', 7),
(18, 'Kesalahan', 'C', 7),
(19, 'Kerjasama', 'B', 8),
(20, 'Moral', 'B', 7),
(21, 'Keuletan', 'B', 8),
(22, 'Inisiatif', 'B', 6),
(23, 'Absensi', 'B', 5),
(24, 'Waktu', 'C', 4),
(25, 'Peringatan', 'B', 6),
(26, '5SdanK3', 'B', 7),
(27, 'Inovasi', 'B', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `kdKaryawan` int(11) NOT NULL,
  `kdKriteria` int(11) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`kdKaryawan`, `kdKriteria`, `nilai`) VALUES
(9, 13, 5),
(9, 14, 5),
(9, 15, 5),
(9, 16, 5),
(9, 17, 5),
(9, 18, 5),
(9, 19, 5),
(9, 20, 5),
(9, 21, 5),
(9, 22, 5),
(9, 23, 5),
(9, 24, 5),
(9, 25, 5),
(9, 26, 5),
(9, 27, 5),
(10, 13, 5),
(10, 14, 5),
(10, 15, 5),
(10, 16, 5),
(10, 17, 5),
(10, 18, 5),
(10, 19, 5),
(10, 20, 5),
(10, 21, 5),
(10, 22, 5),
(10, 23, 5),
(10, 24, 5),
(10, 25, 5),
(10, 26, 5),
(10, 27, 5),
(12, 13, 1),
(12, 14, 1),
(12, 15, 1),
(12, 16, 1),
(12, 17, 1),
(12, 18, 1),
(12, 19, 1),
(12, 20, 1),
(12, 21, 1),
(12, 22, 1),
(12, 23, 1),
(12, 24, 1),
(12, 25, 1),
(12, 26, 1),
(12, 27, 1),
(13, 13, 3),
(13, 14, 3),
(13, 15, 3),
(13, 16, 3),
(13, 17, 3),
(13, 18, 3),
(13, 19, 3),
(13, 20, 3),
(13, 21, 3),
(13, 22, 3),
(13, 23, 3),
(13, 24, 3),
(13, 25, 3),
(13, 26, 3),
(13, 27, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `level` enum('user','admin') NOT NULL,
  `email` varchar(80) NOT NULL,
  `code` varchar(20) NOT NULL,
  `active` int(1) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `nama_lengkap`, `username`, `password`, `level`, `email`, `code`, `active`, `image`) VALUES
(3, 'hambali', 'ambay', '123456789', 'admin', 'ahmadhambali1997@gmail.com', '+0pu15pJV2G82wNkYY1Y', 1, 'avatar041.png'),
(16, 'fadil zamam', 'fadilzamzam', '123456789', 'user', 'ambayzos@gmail.com', 'zYsrd1WKgM7x', 1, 'default.jpg'),
(17, 'kamal', 'kamal123', '123456', 'user', 'camalpriyadi@gmail.com', 'Kdr4elQzTBER', 1, 'default.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `subkriteria`
--

CREATE TABLE `subkriteria` (
  `kdSubKriteria` int(11) NOT NULL,
  `subKriteria` varchar(50) NOT NULL,
  `value` int(11) NOT NULL,
  `kdKriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `subkriteria`
--

INSERT INTO `subkriteria` (`kdSubKriteria`, `subKriteria`, `value`, `kdKriteria`) VALUES
(51, 'Buruk', 1, 13),
(52, 'Kurang', 2, 13),
(53, 'Cukup', 3, 13),
(54, 'Baik', 4, 13),
(55, 'Sangat Baik', 5, 13),
(56, 'Buruk', 1, 14),
(57, 'Kurang', 2, 14),
(58, 'Cukup', 3, 14),
(59, 'Baik', 4, 14),
(60, 'Sangat Baik', 5, 14),
(61, 'Buruk', 1, 15),
(62, 'Kurang', 2, 15),
(63, 'Cukup', 3, 15),
(64, 'Baik', 4, 15),
(65, 'Sangat Baik', 5, 15),
(66, 'Buruk', 1, 16),
(67, 'Kurang', 2, 16),
(68, 'Cukup', 3, 16),
(69, 'Baik', 4, 16),
(70, 'Sangat baik', 5, 16),
(71, 'Buruk', 1, 17),
(72, 'Kurang', 2, 17),
(73, 'Cukup', 3, 17),
(74, 'Baik', 4, 17),
(75, 'Sangat Baik', 5, 17),
(76, 'buruk', 1, 18),
(77, 'kurang', 2, 18),
(78, 'cukup', 3, 18),
(79, 'baik', 4, 18),
(80, 'sangat baik', 5, 18),
(81, 'buruk', 1, 19),
(82, 'kurang', 2, 19),
(83, 'cukup', 3, 19),
(84, 'Baik', 4, 19),
(85, 'sangat baik', 5, 19),
(86, 'buruk', 1, 20),
(87, 'kurang', 2, 20),
(88, 'cukup', 3, 20),
(89, 'baik', 4, 20),
(90, 'sangat baik', 5, 20),
(91, 'buruk', 1, 21),
(92, 'kurang', 2, 21),
(93, 'cukup', 3, 21),
(94, 'baik', 4, 21),
(95, 'sangat baik', 5, 21),
(96, 'buruk', 1, 22),
(97, 'kurang', 2, 22),
(98, 'cukup', 3, 22),
(99, 'baik', 4, 22),
(100, 'sangat baik', 5, 22),
(101, 'Buruk', 1, 23),
(102, 'kurang', 2, 23),
(103, 'cukup', 3, 23),
(104, 'Baik', 4, 23),
(105, 'Sangat Baik', 5, 23),
(106, 'Buruk', 1, 24),
(107, 'kurang', 2, 24),
(108, 'Cukup', 3, 24),
(109, 'Baik', 4, 24),
(110, 'sangat baik', 5, 24),
(111, 'Buruk', 1, 25),
(112, 'Kurang', 2, 25),
(113, 'Cukup', 3, 25),
(114, 'Baik', 4, 25),
(115, 'Sangat Baik', 5, 25),
(116, 'Buruk', 1, 26),
(117, 'Kurang', 2, 26),
(118, 'Cukup', 3, 26),
(119, 'Baik', 4, 26),
(120, 'Sangat Baik', 5, 26),
(121, 'Buruk', 1, 27),
(122, 'kurang', 2, 27),
(123, 'Cukup', 3, 27),
(124, 'Baik', 4, 27),
(125, 'sangat baik', 5, 27);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`kdKaryawan`) USING BTREE;

--
-- Indeks untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`kdKriteria`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD UNIQUE KEY `indexNilai` (`kdKaryawan`,`kdKriteria`) USING BTREE,
  ADD KEY `kdKriteria` (`kdKriteria`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indeks untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`kdSubKriteria`),
  ADD KEY `kdKriteria` (`kdKriteria`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `kdKaryawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `kdKriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `kdSubKriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`kdKaryawan`) REFERENCES `karyawan` (`kdKaryawan`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`kdKriteria`) REFERENCES `kriteria` (`kdKriteria`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`kdKriteria`) REFERENCES `kriteria` (`kdKriteria`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
