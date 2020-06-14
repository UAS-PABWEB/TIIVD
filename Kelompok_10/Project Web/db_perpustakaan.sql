-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `nis` int(10) NOT NULL,
  `nama` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `tempat_lahir` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jk` enum('l','p') COLLATE latin1_general_ci NOT NULL,
  `kelas` enum('I','II','III','IV','V','VI') COLLATE latin1_general_ci NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`nis`, `nama`, `tempat_lahir`, `tgl_lahir`, `jk`, `kelas`, `tgl_input`) VALUES
(2016210004, 'Narti', 'Makassar', '2019-07-16', 'p', 'V', '2019-07-28 14:30:30'),
(2016210002, 'Putri Mawar', 'Makassar', '2019-07-03', 'p', 'VI', '2019-07-31 19:33:02'),
(2016210003, 'Dony Pratama', 'Makassar', '2019-07-12', 'p', 'V', '2019-07-28 21:42:43'),
(2016210001, 'Nawirah', 'Makassar', '2019-07-02', 'l', 'VI', '2019-07-28 21:43:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `pengarang` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `penerbit` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tahun_terbit` varchar(4) COLLATE latin1_general_ci NOT NULL,
  `isbn` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `jumlah_buku` int(11) NOT NULL,
  `lokasi` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `isbn`, `jumlah_buku`, `lokasi`, `tgl_input`) VALUES
(27, 'Bahasa Indonesia', 'Nurul Akhma', 'Erlangga', '2008', '1234556', 1, 'Rak 2', '2019-08-06 11:51:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_lokasi`
--

CREATE TABLE `tb_lokasi` (
  `id_lokasi` int(11) NOT NULL,
  `lokasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_lokasi`
--

INSERT INTO `tb_lokasi` (`id_lokasi`, `lokasi`) VALUES
(1, 'Rak 1'),
(4, 'Rak 2'),
(5, 'Rak 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `judul` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `nis` int(11) NOT NULL,
  `nama` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `tgl_pinjam` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `tgl_kembali` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `status` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `id_buku`, `judul`, `nis`, `nama`, `tgl_pinjam`, `tgl_kembali`, `status`, `tgl_input`) VALUES
(379, 27, 'Bahasa Indonesia', 2016210004, 'Narti', '02-08-2019', '01-08-2020', 'Pinjam', '2019-08-02 12:10:18'),
(377, 27, 'Bahasa Indonesia', 2016210002, 'Putri Mawar', '02-08-2019', '01-08-2020', 'Pinjam', '2019-08-02 12:07:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `nama` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `level` enum('admin','user') COLLATE latin1_general_ci NOT NULL,
  `foto` varchar(200) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `nama`, `level`, `foto`) VALUES
(1, 'admin', 'admin', 'admin', 'admin', 'My-Account-Icon.jpg'),
(2, 'user', 'user', 'user', 'user', 'login.png'),
(11, 'narti', 'narti', 'Narti', 'user', 'My-Account-Icon.jpg'),
(10, 'nurul', 'nurul', 'Nurul Husnul', 'admin', 'My-Account-Icon.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`nis`);

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  ADD PRIMARY KEY (`id_lokasi`);

--
-- Indexes for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tb_lokasi`
--
ALTER TABLE `tb_lokasi`
  MODIFY `id_lokasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=380;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
