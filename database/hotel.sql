-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 26, 2018 at 11:24 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(50) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `username`, `password`, `added`) VALUES
(1, 'adm00n', 'inikatasandi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `idbooking` int(11) NOT NULL,
  `idevent` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `bukti` varchar(155) NOT NULL,
  `status` int(11) NOT NULL,
  `hadir` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `tgl_book` datetime NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`idbooking`, `idevent`, `iduser`, `qty`, `bukti`, `status`, `hadir`, `tgl`, `tgl_book`, `added`) VALUES
(2177, 401921, 378558272, 5, '', 0, 0, '2018-07-20', '2018-07-24 06:28:31', 1532406511),
(715980, 251246, 378558272, 7, '', 0, 0, '2018-07-28', '2018-07-25 12:38:07', 1532515087),
(791115, 1488, 378558272, 1, '', 0, 0, '2018-07-17', '2018-07-16 00:00:00', 1531714337),
(924303, 301178, 378558272, 5, '', 0, 0, '2018-07-18', '2018-07-17 00:00:00', 1531786324);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `idevent` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `id_resto` int(11) NOT NULL,
  `title` varchar(55) NOT NULL,
  `tagline` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `logos` varchar(155) NOT NULL,
  `covers` varchar(155) NOT NULL,
  `region` varchar(55) NOT NULL,
  `address` varchar(300) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `tgl_posted` datetime NOT NULL,
  `category` varchar(55) NOT NULL,
  `availableseat` int(11) NOT NULL,
  `quota` int(11) NOT NULL,
  `price` int(20) NOT NULL,
  `hint` int(11) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`idevent`, `idhotel`, `id_resto`, `title`, `tagline`, `description`, `logos`, `covers`, `region`, `address`, `tgl_mulai`, `tgl_akhir`, `tgl_posted`, `category`, `availableseat`, `quota`, `price`, `hint`, `added`) VALUES
(1488, 684889, 0, 'Akan Datang', 'initagline', 'lorem ipsum', 'zuck.png', 'startup-593327_1920.jpg', 'Kalianak', 'Jl. Kalianak Timur', '2018-07-17', '2018-07-26', '2018-07-16 08:04:57', 'Food and Beverage', 0, 0, 0, 0, 1531703097),
(193424, 684889, 0, 'Pelatihan Ngeblog SEO Friendly', 'seo', 'Ikuti pelatihan Internet Marketing & SEO! Optimasi website agar masuk halaman 1 Google untuk Melipatgandakan Penjualan.', 'zuck.png', 'workshopKapitalis.jpg', 'Surabaya', 'Jl. Pandegiling No. 45, Surabaya', '2018-07-18', '2018-07-22', '2018-07-16 14:48:35', 'Parties', 0, 0, 2500000, 0, 1531727315),
(218974, 368862, 0, 'Lomba Fotografi', 'Lomba foto', 'Tema : Warisan dari Pahlawan\n\nPersyaratan : \n- FC KTP dan KK\n- Membayar Biaya Pendaftaran Rp 100.000\n\n1st Prize : Rp 120.000\n2nd Prize : Rp 110.000\n3rd Prize : Rp 105.000', 'f9b9c35ceb57fb9f18400bff7dafb3e9.png', 'lomba fotografi.jpg', 'Petemon', 'Jl. Tentara Genie Pelajar No. 26, Surabaya', '2018-07-18', '2018-07-21', '2018-07-18 01:31:13', 'Parties', 0, 0, 100000, 0, 1531852273),
(251246, 684889, 0, 'Smekda Party', 'smekda liar', 'Halo dunia\n\nini deskripsi', 'logo-smkn-2-sby.jpg', '36960883_347363322465081_444489030206226432_n.jpg', 'Surabaya', 'Jl. Tentara Genie Pelajar, No. 26', '2018-07-26', '2018-08-04', '2018-07-25 17:33:53', 'Parties', 1, 8, 5000, 0, 1532514833),
(390630, 684889, 0, 'Event Expired', 'initagline', 'halo dunia', 'database.png', 'f9b9c35ceb57fb9f18400bff7dafb3e9.png', 'Petemon', 'Jl. Petemon Barat', '2018-06-27', '2018-07-01', '2018-07-16 07:39:13', 'Food and Beverage', 0, 0, 0, 0, 1531701553),
(401921, 684889, 0, 'cvnm,.', 'cvnm,.', 'zxcvnm,.', 'a1817939184_10.jpg', 'pasangan_20151008_125035.jpg', 'omah e inul', 'cvnm,./', '2018-07-20', '2018-07-22', '2018-07-20 10:01:41', 'Shopping', 95, 0, 150000000, 0, 1532055701);

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `idfacility` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `icon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility`
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
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `idgambar` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`idgambar`, `idhotel`, `tipe`, `gambar`, `added`) VALUES
(556900, 684889, 'hotel', 'samisanov ok.jpg', 1531280032),
(469912, 684889, 'hotel', 'koridor-co-working-space-surabaya-koridor-2.jpg', 1531302839),
(180883, 684889, 'hotel', '_SAM1139.JPG', 1531371685),
(604308, 684889, 'resto', 'nguntal.jpg', 1531741349),
(189640, 684889, 'resto', 'hisana.jpg', 1531741462),
(200358, 684889, 'hotel', 'hisana.jpg', 1531786597);

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `idhotel` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
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

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`idhotel`, `nama`, `email`, `password`, `icon`, `cover`, `phone`, `website`, `city`, `address`, `facility`, `status`, `added`) VALUES
(131722, 'Testho Hotel', 'marcom@testhotel.co.id', 'inikatasandi', 'batman.jpg', 'cara-mengatasi-grogi.jpg', '082126164429', 'https://www.facebook.com', 'Surabaya', 'Jalan Kalianak Timur No. 40', '', 1, 1530509890),
(194215, 'Riyans Hotel', 'marcom@riyanshotel.guru', 'inikatasandi', '', '', '', '', '', '', '', 2, 1530461071),
(368862, 'Smekda Hotel', 'smekda.surabaya@gmail.com', 'inikatasandi', 'logo-smekda.jpg', '', '62315343708', 'http://smkn2sby.sch.id', 'Surabaya', 'Jalan Tentara Genie Pelajar No. 26', '', 1, 1530595602),
(684889, 'TokDalang Homestay', 'tokdalang@durianruntuh.my', 'inikatasandi', 'tokdalang.jpg', 'rumahTokDalang.jpg', '93743582375', 'https://durianruntuh.my', 'Kampung Durian Runtuh', 'Kampung Durian Runtuh No. 25', '1,2,3,4,6', 1, 1530595632);

-- --------------------------------------------------------

--
-- Table structure for table `restoran`
--

CREATE TABLE `restoran` (
  `idresto` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `email` varchar(155) NOT NULL,
  `password` varchar(50) NOT NULL,
  `icon` varchar(155) NOT NULL,
  `cover` varchar(155) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `website` varchar(75) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `facility` varchar(95) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restoran`
--

INSERT INTO `restoran` (`idresto`, `idhotel`, `nama`, `email`, `password`, `icon`, `cover`, `phone`, `website`, `city`, `address`, `facility`, `added`) VALUES
(726644, 684889, 'Hisana Pret Ciken', 'hisana@tokdalanghomesate.my', 'inikatasandi', 'download (1).jpg', 'download.jpg', '082126164429', 'https://hisana.id', 'Surabaya', 'Jl. Genteng Kali No. 55', '5,6,3,4,2,1', 1531783891);

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `idsocial` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `idresto` int(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `url` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`idsocial`, `idhotel`, `idresto`, `type`, `url`) VALUES
(237927, 684889, 0, 'Twitter', 'https://twitter.com/telkomsel'),
(701779, 726644, 0, 'Facebook', 'https://www.facebook.com/zuck'),
(797624, 726644, 0, 'Instagram', 'https://www.instagram.com/hisana'),
(842860, 684889, 0, 'Facebook', 'https://www.facebook.com/zuck'),
(997566, 684889, 0, 'Instagram', 'https://www.instagram.com/mesxx_');

-- --------------------------------------------------------

--
-- Table structure for table `track`
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

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`idtrack`, `idevent`, `iduser`, `tipe`, `hint`, `last_tracked`, `added`) VALUES
(272363224, 1488, '::1', 1, 3, 1532051445, 1531944328),
(738528415, 1488, '::1', 2, 2, 1532051471, 1532051452),
(879020637, 0, '::1', 0, 1, 1531944339, 1531944339);

-- --------------------------------------------------------

--
-- Table structure for table `user`
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
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `email`, `password`, `nama`, `telepon`, `alamat`, `status`, `registered`) VALUES
(1, '', '', '', '', '', 1, 0),
(49280222, 'riyan2@riyan.com', 'inikatasandi', 'Riyan Satria', '', '', 0, 1531786268),
(378558272, 'halo@riyansatria.tk', 'sandinepodo', 'Riyan Satria', '082126164429', 'di rumah', 1, 1530359712);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`idbooking`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`idevent`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`idfacility`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`idhotel`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `restoran`
--
ALTER TABLE `restoran`
  ADD PRIMARY KEY (`idresto`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`idsocial`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`idtrack`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `restoran`
--
ALTER TABLE `restoran`
  MODIFY `idresto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=726645;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
