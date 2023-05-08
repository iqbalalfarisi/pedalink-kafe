-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Jul 2021 pada 14.54
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kafe_pedalink`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bayar`
--

CREATE TABLE IF NOT EXISTS `bayar` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesanan` int(11) NOT NULL,
  `id_pengguna` int(3) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `diskon` decimal(10,0) NOT NULL,
  `uang_muka` decimal(10,0) NOT NULL,
  `bayar` decimal(10,0) NOT NULL,
  `kembali` decimal(10,0) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`kode`),
  KEY `id_pengguna` (`id_pengguna`),
  KEY `id_pesanan` (`id_pesanan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data untuk tabel `bayar`
--

INSERT INTO `bayar` (`kode`, `id_pesanan`, `id_pengguna`, `total`, `diskon`, `uang_muka`, `bayar`, `kembali`, `tanggal`) VALUES
(1, 4, 1, '75000', '0', '0', '100000', '25000', '0000-00-00'),
(2, 5, 1, '26000', '0', '0', '26000', '0', '0000-00-00'),
(4, 6, 1, '32000', '0', '0', '32000', '0', '0000-00-00'),
(5, 7, 1, '14000', '0', '0', '15000', '1000', '0000-00-00'),
(6, 8, 1, '29000', '0', '0', '29000', '0', '0000-00-00'),
(11, 14, 1, '18000', '0', '0', '18000', '0', '0000-00-00'),
(12, 15, 1, '10000', '0', '0', '10000', '0', '0000-00-00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE IF NOT EXISTS `detail_pesanan` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `id_pesanan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(4) NOT NULL DEFAULT '0',
  `harga` decimal(10,0) NOT NULL DEFAULT '0',
  `subtotal` decimal(10,0) NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Proses',
  PRIMARY KEY (`kode`),
  KEY `id_pesanan` (`id_pesanan`),
  KEY `id_menu` (`id_menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`kode`, `id_pesanan`, `id_menu`, `jumlah`, `harga`, `subtotal`, `keterangan`, `status`) VALUES
(16, 4, 11, 1, '25000', '0', '', 'Dihidangkan'),
(17, 4, 20, 1, '18000', '0', '', 'Dihidangkan'),
(18, 4, 25, 1, '12000', '0', '', 'Dihidangkan'),
(19, 4, 23, 1, '20000', '0', '', 'Dihidangkan'),
(20, 5, 21, 1, '14000', '0', '', 'Dihidangkan'),
(21, 5, 25, 1, '12000', '0', '', 'Dihidangkan'),
(22, 6, 25, 1, '12000', '0', '', 'Dihidangkan'),
(23, 6, 23, 1, '20000', '0', '', 'Dihidangkan'),
(24, 7, 21, 1, '14000', '0', '', 'Dihidangkan'),
(25, 8, 22, 1, '17000', '0', '', 'Dihidangkan'),
(26, 8, 25, 1, '12000', '0', '', 'Dihidangkan'),
(27, 14, 20, 1, '18000', '0', '', 'Dihidangkan'),
(28, 15, 24, 1, '10000', '0', '', 'Dihidangkan'),
(29, 16, 25, 1, '12000', '0', '', 'Dihidangkan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `header_pesanan`
--

CREATE TABLE IF NOT EXISTS `header_pesanan` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `id_pengguna` int(3) NOT NULL,
  `kode_meja` varchar(200) NOT NULL DEFAULT 'Reservasi',
  `tanggal` date NOT NULL,
  `status` varchar(30) DEFAULT 'Proses',
  `total` decimal(10,0) NOT NULL DEFAULT '0',
  `kode_reservasi` int(11) DEFAULT '0',
  `uang_muka` decimal(10,0) DEFAULT '0',
  PRIMARY KEY (`kode`),
  KEY `id_pengguna` (`id_pengguna`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `header_pesanan`
--

INSERT INTO `header_pesanan` (`kode`, `id_pengguna`, `kode_meja`, `tanggal`, `status`, `total`, `kode_reservasi`, `uang_muka`) VALUES
(4, 10, 'M02', '2021-06-10', 'Selesai', '75000', 0, '0'),
(5, 10, 'M10', '2021-06-09', 'Selesai', '26000', 0, '0'),
(6, 10, 'M09', '2021-07-22', 'Selesai', '32000', 0, '0'),
(7, 10, 'M05', '2021-07-24', 'Selesai', '14000', 0, '0'),
(8, 10, 'M04', '2021-07-27', 'Selesai', '29000', 0, '0'),
(14, 10, 'M10', '2021-07-27', 'Selesai', '18000', 0, '0'),
(15, 10, 'M10', '2021-07-27', 'Selesai', '10000', 0, '0'),
(16, 10, 'M10', '2021-07-27', 'Selesai', '12000', 0, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `kode` int(3) NOT NULL AUTO_INCREMENT,
  `uraian` varchar(20) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`kode`, `uraian`) VALUES
(10, 'MINUMAN'),
(11, 'CEMILAN'),
(12, 'PAKET HEMAT'),
(16, 'MAKANAN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `meja`
--

CREATE TABLE IF NOT EXISTS `meja` (
  `kode` int(3) NOT NULL AUTO_INCREMENT,
  `no_meja` varchar(3) NOT NULL,
  `kapasitas` int(3) NOT NULL,
  `status` enum('tersedia','berisi','Reservasi') NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `meja`
--

INSERT INTO `meja` (`kode`, `no_meja`, `kapasitas`, `status`) VALUES
(1, 'M04', 4, 'berisi'),
(2, 'M03', 3, 'berisi'),
(3, 'M02', 5, 'berisi'),
(4, 'M01', 5, 'berisi'),
(6, 'M05', 4, 'berisi'),
(7, 'M06', 2, 'berisi'),
(8, 'M07', 2, 'berisi'),
(9, 'M08', 4, 'berisi'),
(10, 'M09', 4, 'berisi'),
(11, 'M10', 4, 'berisi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `kode` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kategori` int(3) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `harga` int(11) DEFAULT '0',
  `deskripsi` text,
  `gambar` text,
  `tanggal` datetime DEFAULT NULL,
  `jumlah_pesan` int(11) DEFAULT '1',
  `status` varchar(20) DEFAULT 'Aktif',
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`kode`, `kode_kategori`, `nama`, `harga`, `deskripsi`, `gambar`, `tanggal`, `jumlah_pesan`, `status`) VALUES
(11, 16, 'MIE GORENG + TELUR', 11000, 'NASI GORENG TELUR', 'indomiegoreng.jpg', '2019-08-13 16:02:54', 1, 'Aktif'),
(16, 16, 'MIE GORENG', 6000, 'INDOMIE GORENG', 'indomiegoreng.jpg', '2021-06-10 00:17:00', 1, 'Aktif'),
(17, 16, 'MIE REBUS', 6000, 'MIE REBUS', 'mierebus.jpeg', '2021-06-10 00:22:36', 1, 'Aktif'),
(18, 16, 'MIE REBUS + TELUR', 11000, 'MIE REBUS + TELUR', 'mierebus.jpeg', '2021-06-10 00:27:56', 1, 'Aktif'),
(19, 16, 'NASI GORENG BIASA', 14000, 'NASI GORENG BIASA', 'nasi goreng.jpg', '2021-06-10 00:35:13', 1, 'Aktif'),
(20, 16, 'NASI GORENG SPESIAL', 18000, 'NASI GORENG SPESIAL', 'nasigorengspesial.jpg', '2021-06-10 00:39:21', 1, 'Aktif'),
(21, 12, 'MIE GRG/RBS TELUR + ES TEH MANIS', 14000, 'MIE GORENG/REBUS TELUR + ES TEH MANIS', 'mie+esteh.jpg', '2021-06-10 00:43:16', 1, 'Aktif'),
(22, 12, 'NASI GORENG BIASA + ES TEH MANIS', 17000, 'NASI GORENG BIASA + ES TEH MANIS', 'nasigorengesteh.jpg', '2021-06-10 00:54:23', 1, 'Aktif'),
(23, 12, 'NASI GORENG SPESIAL + ES TEH MANIS', 20000, 'NASI GORENG SPESIAL + ES TEH MANIS', 'nasigorengesteh.jpg', '2021-06-10 01:02:03', 1, 'Aktif'),
(24, 11, 'ROTI PANGGANG COKLAT', 10000, 'ROTI PANGGANG COKLAT', 'roti panggang.jpg', '2021-06-10 01:03:53', 1, 'Aktif'),
(25, 11, 'ROTI PANGGANG KEJU', 12000, 'ROTI PANGGANG KEJU', 'rotipanggangkeju.jpg', '2021-06-10 01:05:29', 1, 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `kode` int(3) NOT NULL AUTO_INCREMENT,
  `nama_pengguna` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(30) NOT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`kode`, `nama_pengguna`, `username`, `password`, `level`) VALUES
(1, 'pemilik', 'pemilik', '58399557dae3c60e23c78606771dfa3d', 'Pemilik'),
(8, 'dapur', 'dapur', 'de20b1d289dd6005ba8116085122f144', 'Dapur'),
(9, 'Kasir ', 'kasir', 'c7911af3adbd12a035b289556d96470a', 'Kasir'),
(10, 'Pelayan', 'pelayan', '511cc40443f2a1ab03ab373b77d28091', 'Pelayan');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jumlah_pesanan`
--
CREATE TABLE IF NOT EXISTS `v_jumlah_pesanan` (
`total` decimal(32,0)
,`id_menu` int(11)
,`jumlah` int(4)
,`nama` varchar(200)
,`status` varchar(20)
,`tanggal` date
,`status_master` varchar(30)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pesanan_dapur`
--
CREATE TABLE IF NOT EXISTS `v_pesanan_dapur` (
`kode` int(11)
,`id_pesanan` int(11)
,`id_menu` int(11)
,`jumlah` int(4)
,`harga` decimal(10,0)
,`subtotal` decimal(10,0)
,`keterangan` text
,`status` varchar(20)
,`nama` varchar(200)
,`kategori` varchar(20)
,`kode_meja` varchar(200)
,`tanggal` date
,`status_master` varchar(30)
);
-- --------------------------------------------------------

--
-- Struktur untuk view `v_jumlah_pesanan`
--
DROP TABLE IF EXISTS `v_jumlah_pesanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jumlah_pesanan` AS select distinct sum(`detail_pesanan`.`jumlah`) AS `total`,`detail_pesanan`.`id_menu` AS `id_menu`,`detail_pesanan`.`jumlah` AS `jumlah`,`menu`.`nama` AS `nama`,`detail_pesanan`.`status` AS `status`,`header_pesanan`.`tanggal` AS `tanggal`,`header_pesanan`.`status` AS `status_master` from ((`detail_pesanan` join `menu` on((`menu`.`kode` = `detail_pesanan`.`id_menu`))) join `header_pesanan` on((`header_pesanan`.`kode` = `detail_pesanan`.`id_pesanan`))) where (((`detail_pesanan`.`status` = 'Proses') or (`detail_pesanan`.`status` = '1')) and (`header_pesanan`.`status` <> 'Batal Reservasi')) group by `detail_pesanan`.`id_menu`;

-- --------------------------------------------------------

--
-- Struktur untuk view `v_pesanan_dapur`
--
DROP TABLE IF EXISTS `v_pesanan_dapur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pesanan_dapur` AS select `detail_pesanan`.`kode` AS `kode`,`detail_pesanan`.`id_pesanan` AS `id_pesanan`,`detail_pesanan`.`id_menu` AS `id_menu`,`detail_pesanan`.`jumlah` AS `jumlah`,`detail_pesanan`.`harga` AS `harga`,`detail_pesanan`.`subtotal` AS `subtotal`,`detail_pesanan`.`keterangan` AS `keterangan`,`detail_pesanan`.`status` AS `status`,`menu`.`nama` AS `nama`,`kategori`.`uraian` AS `kategori`,`header_pesanan`.`kode_meja` AS `kode_meja`,`header_pesanan`.`tanggal` AS `tanggal`,`header_pesanan`.`status` AS `status_master` from (((`detail_pesanan` join `header_pesanan` on((`header_pesanan`.`kode` = `detail_pesanan`.`id_pesanan`))) join `menu` on((`menu`.`kode` = `detail_pesanan`.`id_menu`))) join `kategori` on((`kategori`.`kode` = `menu`.`kode_kategori`))) where (((`detail_pesanan`.`status` = 'Proses') or (`detail_pesanan`.`status` = '1')) and (`header_pesanan`.`status` <> 'Batal Reservasi')) order by `detail_pesanan`.`kode` desc;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bayar`
--
ALTER TABLE `bayar`
  ADD CONSTRAINT `bayar_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`kode`),
  ADD CONSTRAINT `bayar_ibfk_2` FOREIGN KEY (`id_pesanan`) REFERENCES `header_pesanan` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `header_pesanan` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pesanan_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`kode`);

--
-- Ketidakleluasaan untuk tabel `header_pesanan`
--
ALTER TABLE `header_pesanan`
  ADD CONSTRAINT `header_pesanan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
