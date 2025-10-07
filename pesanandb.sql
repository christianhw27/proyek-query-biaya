-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Okt 2025 pada 00.47
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pesanandb`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `a_total_biaya_per_pesanan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `a_total_biaya_per_pesanan` (
`NomorPesanan` int(11)
,`JenisProduk` varchar(50)
,`JmlPesanan` int(11)
,`Kelompok` varchar(50)
,`JumlahBiaya` decimal(41,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `b_biaya_per_bulan`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `b_biaya_per_bulan` (
`Tahun` int(4)
,`Bulan` int(2)
,`Kelompok` varchar(50)
,`JumlahBiaya` decimal(41,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `c_biaya_per_produk`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `c_biaya_per_produk` (
`JenisProduk` varchar(50)
,`Kelompok` varchar(50)
,`JumlahBiaya` decimal(41,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `d_perhitungan_biaya`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `d_perhitungan_biaya` (
`NomorPesanan` int(11)
,`JenisProduk` varchar(50)
,`JmlPesanan` int(11)
,`BiayaLangsung` decimal(41,0)
,`BiayaOverHead` decimal(47,4)
,`TotalBiaya` decimal(48,4)
,`BiayaPerUnit` decimal(52,8)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `e_statistik_subkelompok`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `e_statistik_subkelompok` (
`SubKelompok` varchar(50)
,`JumlahBiaya` decimal(41,0)
,`JmlPesanan` bigint(21)
,`Rata_Rata` decimal(23,4)
,`MaxBiaya` bigint(20)
,`MinBiaya` bigint(20)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `f_biaya_sepatu`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `f_biaya_sepatu` (
`NomorPesanan` int(11)
,`JenisProduk` varchar(50)
,`JmlPesanan` int(11)
,`Kelompok` varchar(50)
,`JumlahBiaya` decimal(41,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `g_biaya_diatas_20jt`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `g_biaya_diatas_20jt` (
`NomorPesanan` int(11)
,`JenisProduk` varchar(50)
,`JmlPesanan` int(11)
,`Kelompok` varchar(50)
,`JumlahBiaya` decimal(41,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `h_top3_biaya`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `h_top3_biaya` (
`Kelompok_Biaya` varchar(50)
,`JenisProduk` varchar(50)
,`NomorPesanan` int(11)
,`JumlahBiaya` decimal(41,0)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kartupesanan`
--

CREATE TABLE `kartupesanan` (
  `NomorPesanan` int(11) NOT NULL,
  `JenisProduk` varchar(50) DEFAULT NULL,
  `JmlPesanan` int(11) DEFAULT NULL,
  `TglPesanan` date DEFAULT NULL,
  `TglSelesai` date DEFAULT NULL,
  `DipesanOleh` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kartupesanan`
--

INSERT INTO `kartupesanan` (`NomorPesanan`, `JenisProduk`, `JmlPesanan`, `TglPesanan`, `TglSelesai`, `DipesanOleh`) VALUES
(1, 'Sepatu', 4000, '2004-01-01', '2004-01-30', 'PT Karya'),
(2, 'Sandal', 3000, '2004-02-02', '2004-02-28', 'PT Abdi'),
(3, 'Tas', 500, '2004-03-03', '2004-03-30', 'PT Maju');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rincianbiaya`
--

CREATE TABLE `rincianbiaya` (
  `ID` int(11) NOT NULL,
  `NomorPesanan` int(11) DEFAULT NULL,
  `Tanggal` date DEFAULT NULL,
  `Kelompok` varchar(50) DEFAULT NULL,
  `SubKelompok` varchar(50) DEFAULT NULL,
  `Jumlah` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rincianbiaya`
--

INSERT INTO `rincianbiaya` (`ID`, `NomorPesanan`, `Tanggal`, `Kelompok`, `SubKelompok`, `Jumlah`) VALUES
(1, 1, '2004-01-15', 'Material', 'Kulit', 10000000),
(2, 1, '2004-01-15', 'Material', 'Kain', 5000000),
(3, 1, '2004-01-15', 'Tenaga Kerja', 'Upah Buruh', 30000000),
(4, 2, '2004-02-15', 'Material', 'Kulit', 20000000),
(5, 2, '2004-02-15', 'Material', 'Kain', 10000000),
(6, 2, '2004-02-15', 'Tenaga Kerja', 'Upah Buruh', 60000000),
(7, 2, '2004-02-15', 'Tenaga Kerja', 'Upah Tenaga Ahli', 130000000),
(8, 3, '2004-03-15', 'Material', 'Kulit', 15000000),
(9, 3, '2004-03-15', 'Material', 'Kain', 14000000),
(10, 3, '2004-03-15', 'Tenaga Kerja', 'Upah Buruh', 8000000);

-- --------------------------------------------------------

--
-- Struktur untuk view `a_total_biaya_per_pesanan`
--
DROP TABLE IF EXISTS `a_total_biaya_per_pesanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `a_total_biaya_per_pesanan`  AS SELECT `a`.`NomorPesanan` AS `NomorPesanan`, `a`.`JenisProduk` AS `JenisProduk`, `a`.`JmlPesanan` AS `JmlPesanan`, `b`.`Kelompok` AS `Kelompok`, sum(`b`.`Jumlah`) AS `JumlahBiaya` FROM (`kartupesanan` `a` join `rincianbiaya` `b` on(`a`.`NomorPesanan` = `b`.`NomorPesanan`)) GROUP BY `a`.`NomorPesanan`, `a`.`JenisProduk`, `a`.`JmlPesanan`, `b`.`Kelompok` ORDER BY `a`.`NomorPesanan` ASC, `a`.`JenisProduk` ASC, `a`.`JmlPesanan` ASC, `b`.`Kelompok` ASC ;

-- --------------------------------------------------------

--
-- Struktur untuk view `b_biaya_per_bulan`
--
DROP TABLE IF EXISTS `b_biaya_per_bulan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `b_biaya_per_bulan`  AS SELECT year(`b`.`Tanggal`) AS `Tahun`, month(`b`.`Tanggal`) AS `Bulan`, `b`.`Kelompok` AS `Kelompok`, sum(`b`.`Jumlah`) AS `JumlahBiaya` FROM (`kartupesanan` `a` join `rincianbiaya` `b` on(`a`.`NomorPesanan` = `b`.`NomorPesanan`)) GROUP BY year(`b`.`Tanggal`), month(`b`.`Tanggal`), `b`.`Kelompok` ORDER BY 1 ASC, 2 ASC, 3 ASC ;

-- --------------------------------------------------------

--
-- Struktur untuk view `c_biaya_per_produk`
--
DROP TABLE IF EXISTS `c_biaya_per_produk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `c_biaya_per_produk`  AS SELECT `a`.`JenisProduk` AS `JenisProduk`, `b`.`Kelompok` AS `Kelompok`, sum(`b`.`Jumlah`) AS `JumlahBiaya` FROM (`kartupesanan` `a` join `rincianbiaya` `b` on(`a`.`NomorPesanan` = `b`.`NomorPesanan`)) GROUP BY `a`.`JenisProduk`, `b`.`Kelompok` ORDER BY 1 ASC, 2 ASC ;

-- --------------------------------------------------------

--
-- Struktur untuk view `d_perhitungan_biaya`
--
DROP TABLE IF EXISTS `d_perhitungan_biaya`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `d_perhitungan_biaya`  AS SELECT `a`.`NomorPesanan` AS `NomorPesanan`, `a`.`JenisProduk` AS `JenisProduk`, `a`.`JmlPesanan` AS `JmlPesanan`, sum(`b`.`Jumlah`) AS `BiayaLangsung`, sum(`b`.`Jumlah`) * 30 / 100 AS `BiayaOverHead`, sum(`b`.`Jumlah`) * 130 / 100 AS `TotalBiaya`, sum(`b`.`Jumlah`) * 130 / 100 / `a`.`JmlPesanan` AS `BiayaPerUnit` FROM (`kartupesanan` `a` join `rincianbiaya` `b` on(`a`.`NomorPesanan` = `b`.`NomorPesanan`)) GROUP BY `a`.`NomorPesanan`, `a`.`JenisProduk`, `a`.`JmlPesanan` ORDER BY `a`.`NomorPesanan` ASC, `a`.`JenisProduk` ASC, `a`.`JmlPesanan` ASC ;

-- --------------------------------------------------------

--
-- Struktur untuk view `e_statistik_subkelompok`
--
DROP TABLE IF EXISTS `e_statistik_subkelompok`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `e_statistik_subkelompok`  AS SELECT `b`.`SubKelompok` AS `SubKelompok`, sum(`b`.`Jumlah`) AS `JumlahBiaya`, count(`b`.`Jumlah`) AS `JmlPesanan`, avg(`b`.`Jumlah`) AS `Rata_Rata`, max(`b`.`Jumlah`) AS `MaxBiaya`, min(`b`.`Jumlah`) AS `MinBiaya` FROM (`kartupesanan` `a` join `rincianbiaya` `b` on(`a`.`NomorPesanan` = `b`.`NomorPesanan`)) GROUP BY `b`.`SubKelompok` ORDER BY `b`.`SubKelompok` ASC ;

-- --------------------------------------------------------

--
-- Struktur untuk view `f_biaya_sepatu`
--
DROP TABLE IF EXISTS `f_biaya_sepatu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `f_biaya_sepatu`  AS SELECT `a`.`NomorPesanan` AS `NomorPesanan`, `a`.`JenisProduk` AS `JenisProduk`, `a`.`JmlPesanan` AS `JmlPesanan`, `b`.`Kelompok` AS `Kelompok`, sum(`b`.`Jumlah`) AS `JumlahBiaya` FROM (`kartupesanan` `a` join `rincianbiaya` `b` on(`a`.`NomorPesanan` = `b`.`NomorPesanan`)) WHERE `a`.`JenisProduk` = 'Sepatu' GROUP BY `a`.`NomorPesanan`, `a`.`JenisProduk`, `a`.`JmlPesanan`, `b`.`Kelompok` ORDER BY `a`.`NomorPesanan` ASC, `a`.`JenisProduk` ASC, `a`.`JmlPesanan` ASC, `b`.`Kelompok` ASC ;

-- --------------------------------------------------------

--
-- Struktur untuk view `g_biaya_diatas_20jt`
--
DROP TABLE IF EXISTS `g_biaya_diatas_20jt`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `g_biaya_diatas_20jt`  AS SELECT `a`.`NomorPesanan` AS `NomorPesanan`, `a`.`JenisProduk` AS `JenisProduk`, `a`.`JmlPesanan` AS `JmlPesanan`, `b`.`Kelompok` AS `Kelompok`, sum(`b`.`Jumlah`) AS `JumlahBiaya` FROM (`kartupesanan` `a` join `rincianbiaya` `b` on(`a`.`NomorPesanan` = `b`.`NomorPesanan`)) GROUP BY `a`.`NomorPesanan`, `a`.`JenisProduk`, `a`.`JmlPesanan`, `b`.`Kelompok` HAVING sum(`b`.`Jumlah`) > 20000000 ORDER BY `a`.`NomorPesanan` ASC, `a`.`JenisProduk` ASC, `a`.`JmlPesanan` ASC, `b`.`Kelompok` ASC ;

-- --------------------------------------------------------

--
-- Struktur untuk view `h_top3_biaya`
--
DROP TABLE IF EXISTS `h_top3_biaya`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `h_top3_biaya`  AS SELECT `b`.`Kelompok` AS `Kelompok_Biaya`, `a`.`JenisProduk` AS `JenisProduk`, `a`.`NomorPesanan` AS `NomorPesanan`, sum(`b`.`Jumlah`) AS `JumlahBiaya` FROM (`kartupesanan` `a` join `rincianbiaya` `b` on(`a`.`NomorPesanan` = `b`.`NomorPesanan`)) GROUP BY `a`.`NomorPesanan`, `a`.`JenisProduk`, `b`.`Kelompok` ORDER BY sum(`b`.`Jumlah`) DESC LIMIT 0, 3 ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kartupesanan`
--
ALTER TABLE `kartupesanan`
  ADD PRIMARY KEY (`NomorPesanan`);

--
-- Indeks untuk tabel `rincianbiaya`
--
ALTER TABLE `rincianbiaya`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NomorPesanan` (`NomorPesanan`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `rincianbiaya`
--
ALTER TABLE `rincianbiaya`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `rincianbiaya`
--
ALTER TABLE `rincianbiaya`
  ADD CONSTRAINT `rincianbiaya_ibfk_1` FOREIGN KEY (`NomorPesanan`) REFERENCES `kartupesanan` (`NomorPesanan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
