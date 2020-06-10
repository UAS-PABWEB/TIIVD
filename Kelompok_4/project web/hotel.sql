-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Jun 2020 pada 13.28
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `apartemen`
--

CREATE TABLE `apartemen` (
  `id_apartemen` int(11) NOT NULL,
  `nama_apartemen` varchar(200) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `harga` double NOT NULL,
  `harga_bulan` double NOT NULL,
  `harga_tahun` double NOT NULL,
  `foto` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `apartemen`
--

INSERT INTO `apartemen` (`id_apartemen`, `nama_apartemen`, `id_kota`, `harga`, `harga_bulan`, `harga_tahun`, `foto`) VALUES
(1, 'Apartemen Jatinangor', 1, 300000, 3000000, 30000000, '05bf8ffc651166bcccb3e4953f8319ef.jpg'),
(3, 'melati BO', 1, 200000, 60000000, 10000000000000, 'WIN_20200206_10_09_37_Pro.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`) VALUES
(1, 'Bandung'),
(2, 'Jakarta'),
(3, 'Jogjakarta'),
(4, 'Semarang'),
(5, 'Aceh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `kode_booking` varchar(20) NOT NULL,
  `nomor_kamar` varchar(20) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `id_apartemen` int(11) NOT NULL,
  `hari` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `paket` varchar(200) NOT NULL,
  `jumlah_paket` int(11) NOT NULL,
  `total_bayar` double NOT NULL,
  `bukti_transfer` text DEFAULT NULL,
  `jenis_pembayaran` varchar(100) NOT NULL,
  `status_pembayaran` enum('sudah_dibayar','belum_dibayar','proses_verifikasi','ditolak') NOT NULL DEFAULT 'belum_dibayar',
  `tgl_pesan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `kode_booking`, `nomor_kamar`, `id_user`, `id_apartemen`, `hari`, `checkin`, `paket`, `jumlah_paket`, `total_bayar`, `bukti_transfer`, `jenis_pembayaran`, `status_pembayaran`, `tgl_pesan`) VALUES
(1, 'BK-0001', '305', 2, 1, 1, '2019-11-20', 'harian', 1, 300000, NULL, 'cash', 'sudah_dibayar', '2019-11-20'),
(2, 'BK-0002', '001', 2, 1, 1, '2019-11-20', 'harian', 1, 300000, '23.jpeg', 'transfer', 'sudah_dibayar', '2019-11-20'),
(3, 'BK-0003', NULL, 2, 1, 1, '2019-12-12', 'harian', 1, 300000, 'header2.jpg', 'transfer', 'sudah_dibayar', '2019-11-21'),
(4, 'BK-0004', NULL, 2, 1, 2, '2019-12-12', 'harian', 2, 600000, NULL, 'cash', 'ditolak', '2019-11-21'),
(5, 'BK-0005', '002', 2, 1, 12, '2019-12-12', 'harian', 12, 3600000, 'anime-boy-sad.jpg', 'transfer', 'sudah_dibayar', '2019-11-21'),
(6, 'BK-0006', '337', 3, 1, 3, '2019-11-21', 'harian', 3, 900000, '54350293_2593634993983993_2715256269874135040_n.jpg', 'transfer', 'sudah_dibayar', '2019-11-21'),
(7, 'BK-0007', 'j17', 4, 3, 3, '2020-06-24', 'harian', 3, 600000, NULL, 'cash', 'sudah_dibayar', '2020-06-10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` int(11) NOT NULL COMMENT '1 = admin, 2 = tamu'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `alamat`, `no_hp`, `username`, `password`, `level`) VALUES
(1, 'Ramdan YRKS', 'Sumedang', '082216549887', 'admin', '202cb962ac59075b964b07152d234b70', 1),
(4, 'ramdaniel', 'cimalaka sumedang', '08221576153244', 'daniel', '827ccb0eea8a706c4c34a16891f84e7b', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `apartemen`
--
ALTER TABLE `apartemen`
  ADD PRIMARY KEY (`id_apartemen`);

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `apartemen`
--
ALTER TABLE `apartemen`
  MODIFY `id_apartemen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
