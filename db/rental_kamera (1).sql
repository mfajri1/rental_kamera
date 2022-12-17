-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Des 2022 pada 10.03
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_kamera`
--
CREATE DATABASE IF NOT EXISTS `rental_kamera` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rental_kamera`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_barang`
--

DROP TABLE IF EXISTS `ms_barang`;
CREATE TABLE IF NOT EXISTS `ms_barang` (
  `barang_id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_kode` varchar(255) NOT NULL,
  `barang_nama` varchar(200) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `barang_stok` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `barang_ket` text,
  `barang_harga` double NOT NULL,
  `barang_harga_rental` double NOT NULL,
  `barang_foto` varchar(255) DEFAULT NULL,
  `barang_qr` varchar(255) DEFAULT NULL,
  `barang_barcode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`barang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_barang`
--

INSERT INTO `ms_barang` (`barang_id`, `barang_kode`, `barang_nama`, `kategori_id`, `barang_stok`, `satuan_id`, `barang_ket`, `barang_harga`, `barang_harga_rental`, `barang_foto`, `barang_qr`, `barang_barcode`) VALUES
(12, 'B002', 'tes', 3, 1, 3, 'sdf', 150000, 300000, NULL, 'B002.png', 'B002.png'),
(13, 'B001', 'sdfsd', 2, 1, 2, 'sd', 100000, 200000, 'user-picture.png', 'B001.png', 'B001.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_member`
--

DROP TABLE IF EXISTS `ms_member`;
CREATE TABLE IF NOT EXISTS `ms_member` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_kode` varchar(255) NOT NULL,
  `member_nama` varchar(255) NOT NULL,
  `member_jk` enum('P','W') NOT NULL COMMENT 'Pria, Wanita',
  `member_umur` int(11) NOT NULL,
  `member_alamat` text NOT NULL,
  `member_foto` varchar(255) NOT NULL,
  `member_status` enum('A','N') NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ms_member`
--

INSERT INTO `ms_member` (`member_id`, `member_kode`, `member_nama`, `member_jk`, `member_umur`, `member_alamat`, `member_foto`, `member_status`) VALUES
(1, 'M001', 'Fajar', 'P', 22, 'sekian', 'dsad.png', 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reff_kategori`
--

DROP TABLE IF EXISTS `reff_kategori`;
CREATE TABLE IF NOT EXISTS `reff_kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_kode` varchar(255) NOT NULL,
  `kategori_nama` varchar(200) NOT NULL,
  `kategori_ket` text NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reff_kategori`
--

INSERT INTO `reff_kategori` (`kategori_id`, `kategori_kode`, `kategori_nama`, `kategori_ket`) VALUES
(1, 'K001', 'Accessories', 'Accesories'),
(2, 'K002', 'Kamera', 'Kamera'),
(3, 'K002', 'Background', 'Background'),
(4, 'K004', 'Lampu', 'Lampu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reff_satuan`
--

DROP TABLE IF EXISTS `reff_satuan`;
CREATE TABLE IF NOT EXISTS `reff_satuan` (
  `satuan_id` int(11) NOT NULL AUTO_INCREMENT,
  `satuan_nama` varchar(150) NOT NULL,
  PRIMARY KEY (`satuan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reff_satuan`
--

INSERT INTO `reff_satuan` (`satuan_id`, `satuan_nama`) VALUES
(1, 'Pcs'),
(2, 'Pack'),
(3, 'Kardus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta_mode`
--

DROP TABLE IF EXISTS `ta_mode`;
CREATE TABLE IF NOT EXISTS `ta_mode` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(20) DEFAULT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ta_mode`
--

INSERT INTO `ta_mode` (`id_status`, `status`, `jenis`) VALUES
(1, 'Transaksi', 'Scan RFID');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta_transaksi`
--

DROP TABLE IF EXISTS `ta_transaksi`;
CREATE TABLE IF NOT EXISTS `ta_transaksi` (
  `transaksi_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `member_kode` varchar(200) NOT NULL,
  `transaksi_kode` varchar(255) NOT NULL,
  `transaksi_tanggal` date NOT NULL,
  `transaksi_lama` int(11) NOT NULL,
  `transaksi_total` double NOT NULL,
  `transaksi_tanggal_kembali` date DEFAULT NULL,
  `transaksi_status` enum('A','N','P') NOT NULL COMMENT 'Aktif, Nonaktif, Proses',
  PRIMARY KEY (`transaksi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ta_transaksi`
--

INSERT INTO `ta_transaksi` (`transaksi_id`, `admin_id`, `member_kode`, `transaksi_kode`, `transaksi_tanggal`, `transaksi_lama`, `transaksi_total`, `transaksi_tanggal_kembali`, `transaksi_status`) VALUES
(12, 1, 'M001', 'T001', '2022-12-06', 2, 0, NULL, 'A'),
(13, 1, 'M001', 'T001', '2022-12-16', 2, 0, NULL, 'A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ta_transaksi_detail`
--

DROP TABLE IF EXISTS `ta_transaksi_detail`;
CREATE TABLE IF NOT EXISTS `ta_transaksi_detail` (
  `td_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) NOT NULL,
  `barang_kode` varchar(255) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `transaksi_jumlah` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `transaksi_total` double NOT NULL,
  PRIMARY KEY (`td_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ta_transaksi_detail`
--

INSERT INTO `ta_transaksi_detail` (`td_id`, `transaksi_id`, `barang_kode`, `kategori_id`, `transaksi_jumlah`, `satuan_id`, `transaksi_total`) VALUES
(14, 13, 'B001', 2, 2, 2, 400000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_qr_transaksi`
--

DROP TABLE IF EXISTS `tmp_qr_transaksi`;
CREATE TABLE IF NOT EXISTS `tmp_qr_transaksi` (
  `tmp_qr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_rfid_daftar`
--

DROP TABLE IF EXISTS `tmp_rfid_daftar`;
CREATE TABLE IF NOT EXISTS `tmp_rfid_daftar` (
  `tmp_rfid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tmp_rfid_daftar`
--

INSERT INTO `tmp_rfid_daftar` (`tmp_rfid`) VALUES
('1293012');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmp_rfid_transaksi`
--

DROP TABLE IF EXISTS `tmp_rfid_transaksi`;
CREATE TABLE IF NOT EXISTS `tmp_rfid_transaksi` (
  `tmp_rfid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `xi_sa_admin`
--

DROP TABLE IF EXISTS `xi_sa_admin`;
CREATE TABLE IF NOT EXISTS `xi_sa_admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_nama` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_foto` varchar(255) NOT NULL,
  `admin_role` enum('super_admin','admin','user') NOT NULL,
  `admin_status` enum('A','N') NOT NULL COMMENT 'Aktif, nonaktif',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `xi_sa_admin`
--

INSERT INTO `xi_sa_admin` (`admin_id`, `admin_nama`, `admin_username`, `admin_password`, `admin_foto`, `admin_role`, `admin_status`) VALUES
(1, 'Muhamad Fajri', 'fajri10', 'abcd1234', 'default.png', 'admin', 'A'),
(2, 'Sisi Herlina', 'sisi10', 'abcd1234', 'default.png', 'admin', 'A');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
