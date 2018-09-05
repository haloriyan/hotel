-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Sep 2018 pada 05.32
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
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(50) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`idadmin`, `username`, `password`, `added`) VALUES
(1, 'adm00n', 'inikatasandi', 0),
(103, 'admin', 'admin', 1535215200);

-- --------------------------------------------------------

--
-- Struktur dari tabel `album`
--

CREATE TABLE `album` (
  `idalbum` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `id_resto` int(11) NOT NULL,
  `nama` varchar(65) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `idbooking` int(11) NOT NULL,
  `idevent` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `nama` varchar(155) NOT NULL,
  `qty` int(11) NOT NULL,
  `bukti` varchar(155) NOT NULL,
  `status` int(11) NOT NULL,
  `hadir` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `tgl_book` datetime NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `idevent` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `id_resto` int(11) NOT NULL,
  `title` varchar(55) NOT NULL,
  `tagline` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `covers` varchar(155) NOT NULL,
  `region` varchar(55) NOT NULL,
  `address` varchar(300) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `tgl_posted` datetime NOT NULL,
  `category` varchar(55) NOT NULL,
  `quota` int(11) NOT NULL,
  `price` int(20) NOT NULL,
  `status` int(1) NOT NULL,
  `hint` int(11) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `facility`
--

CREATE TABLE `facility` (
  `idfacility` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `icon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `facility`
--

INSERT INTO `facility` (`idfacility`, `nama`, `icon`) VALUES
(1, 'Wireless Internet', 'fa fa-wifi'),
(2, 'Parking Street', 'fa fa-car'),
(3, 'Smoking Allowed', 'fa fa-magic'),
(4, 'Accept Credit Cards', 'fa fa-credit-card'),
(5, 'Bike Parking', 'fa fa-bicycle'),
(6, 'Coupons', 'fa fa-tags');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `idgambar` int(11) NOT NULL,
  `idalbums` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `hotel`
--

CREATE TABLE `hotel` (
  `idhotel` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `description` text NOT NULL,
  `email` varchar(155) NOT NULL,
  `password` varchar(50) NOT NULL,
  `icon` varchar(155) NOT NULL,
  `cover` varchar(155) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `website` varchar(75) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `facility` varchar(95) NOT NULL,
  `status` int(1) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `redeem`
--

CREATE TABLE `redeem` (
  `idredeem` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `id_resto` int(11) NOT NULL,
  `idevents` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `restoran`
--

CREATE TABLE `restoran` (
  `idresto` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(155) NOT NULL,
  `cover` varchar(155) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `website` varchar(75) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `facility` varchar(95) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `social`
--

CREATE TABLE `social` (
  `idsocial` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `idresto` int(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `url` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `track`
--

CREATE TABLE `track` (
  `idtrack` int(11) NOT NULL,
  `idevent` int(11) NOT NULL,
  `iduser` varchar(25) NOT NULL,
  `tipe` int(11) NOT NULL,
  `hint` int(11) NOT NULL,
  `last_tracked` int(11) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `email` varchar(155) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `status` int(1) NOT NULL,
  `registered` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indeks untuk tabel `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`idalbum`);

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`idbooking`);

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idevent`);

--
-- Indeks untuk tabel `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`idfacility`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`idgambar`);

--
-- Indeks untuk tabel `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`idhotel`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`idredeem`),
  ADD UNIQUE KEY `idevent` (`idevents`);

--
-- Indeks untuk tabel `restoran`
--
ALTER TABLE `restoran`
  ADD PRIMARY KEY (`idresto`);

--
-- Indeks untuk tabel `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`idsocial`);

--
-- Indeks untuk tabel `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`idtrack`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `restoran`
--
ALTER TABLE `restoran`
  MODIFY `idresto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=824063;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
