-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 14, 2018 at 08:31 AM
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
  `nama` varchar(155) NOT NULL,
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

INSERT INTO `booking` (`idbooking`, `idevent`, `iduser`, `nama`, `qty`, `bukti`, `status`, `hadir`, `tgl`, `tgl_book`, `added`) VALUES
(29013, 961541, 378558272, 'Riyan Satria', 5, 'Nomor 1.png', 1, 0, '2018-08-07', '2018-08-07 05:46:40', 1533613600),
(168275, 295607, 378558272, 'Riyan Satria', 1, 'Screenshot (3).png', 1, 1, '2018-08-09', '2018-08-07 05:17:20', 1533611840),
(586720, 295607, 96468212, 'Yoga Agung', 4, 'Screenshot from 2018-05-13 02-59-22.png', 1, 1, '2018-08-09', '2018-08-08 11:49:28', 1533721768);

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
(295607, 684889, 0, 'Seminar Keagamaan', 'halo dunia', 'Lorem ipsum dolor sit amet', 'perjalananKehidupan.jpg', 'perjalananKehidupan.jpg', 'Surabaya', 'Jl. Tentara Genie Pelajar No. 26', '2018-08-08', '2018-08-10', '2018-08-07 10:01:51', 'Parties', 134, 150, 2000, 24, 1533610911),
(705496, 684889, 671577, 'Event Resto', 'ini tagline', 'Lorem ipsum dolor sit amet', 'sam-dan-agenda-kota.jpg', 'Samsul.png', 'Surabaya', 'Jln. Tentara Genie Pelajar No. 26', '2018-08-15', '2018-08-18', '2018-08-14 12:49:30', 'Food and Beverage', 0, 0, 250000, 0, 1534225770),
(961541, 684889, 0, 'Training Pake Firebase', '#gerakansejutafirebase', 'Hello firebase', 'firebase.png', 'firebase.png', 'Surabaya', 'Jl. Tentara Genie Pelajar, No. 26', '2018-08-04', '2018-08-07', '2018-08-02 17:30:48', 'Food and Beverage', 24, 50, 20000, 15, 1533205848);

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
(684889, 'TokDalang Homestay', 'tokdalang@durianruntuh.my', 'inikatasandi', 'tokdalang.jpg', 'rumahTokDalang.jpg', '93743582375', 'https://durianruntuh.my', 'Kampung Durian Runtuh', 'Kampung Durian Runtuh No. 25', '2,3,6,5,1', 1, 1530595632);

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `idredeem` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `id_resto` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `redeem`
--

INSERT INTO `redeem` (`idredeem`, `idhotel`, `id_resto`, `saldo`, `tgl`, `status`, `added`) VALUES
(884678, 684889, 0, 25000, '2018-08-08 04:02:19', 0, 1533693739);

-- --------------------------------------------------------

--
-- Table structure for table `restoran`
--

CREATE TABLE `restoran` (
  `idresto` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
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

INSERT INTO `restoran` (`idresto`, `idhotel`, `nama`, `icon`, `cover`, `phone`, `website`, `city`, `address`, `facility`, `added`) VALUES
(671577, 684889, 'Resto Baru', '', '', '6282126164429', ' No. 26', 'https://durianruntuh.my', 'Jl. Tentara Genie Pelajar', '1,3,4,2,5,6', 1534160575),
(726644, 684889, 'Hisana Pret Ciken', 'download (1).jpg', 'download.jpg', '082126164429', 'https://hisana.id', 'Surabaya', 'Jl. Genteng Kali No. 55', '5,6,3,4,2,1', 1531783891);

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
(78886, 684889, 0, 'Instagram', 'https://www.instagram.com/awkarin'),
(237927, 684889, 0, 'Twitter', 'https://twitter.com/telkomsel'),
(701779, 726644, 0, 'Facebook', 'https://www.facebook.com/zuck'),
(797624, 726644, 0, 'Instagram', 'https://www.instagram.com/hisana'),
(842860, 684889, 0, 'Facebook', 'https://www.facebook.com/zuck');

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
(584936578, 961541, '', 1, 1, 1533381724, 1533381724),
(666252629, 684889, '127.0.0.1', 3, 2, 1533900975, 1533900960),
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
(96468212, 'yoga@dailyhotels.id', 'inikatasandi', 'Yoga Agung', '', '', 1, 1533721697),
(378558272, 'halo@riyansatria.tk', 'inikatasandi', 'Riyan Satria', '082126164429', 'di rumah', 1, 1530359712),
(677895980, 'yprasetiyo335@gmail.com', 'inikatasandi', 'Yoga Agung', '', '', 1, 1533381520);

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
-- Indexes for table `redeem`
--
ALTER TABLE `redeem`
  ADD PRIMARY KEY (`idredeem`);

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
