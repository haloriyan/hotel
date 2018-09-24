-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 24, 2018 at 11:57 AM
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
(1, 'adm00n', 'inikatasandi', 0),
(103, 'admin', 'admin', 1535215200);

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `idalbum` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `id_resto` int(11) NOT NULL,
  `nama` varchar(65) NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`idalbum`, `idhotel`, `id_resto`, `nama`, `created`) VALUES
(27316, 179604, 356641, 'Room', 1535282423),
(58659, 179604, 0, 'foodies', 1537242301);

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
(37758, 426710, 958384955, 'Melle Stomp', 10, 'bukti.png', 1, 0, '2018-08-29', '2018-08-25 16:06:31', 1535205991),
(110801, 66016, 505390092, 'Brian Imanuel', 3, 'bukti.png', 1, 0, '2018-08-27', '2018-08-25 06:55:40', 1535172940),
(168275, 295607, 378558272, 'Riyan Satria', 1, 'Screenshot (3).png', 1, 1, '2018-08-09', '2018-08-07 05:17:20', 1533611840),
(316761, 66016, 958384955, 'Melle Stomp', 1, 'bukti.jpeg', 1, 0, '2018-08-27', '2018-08-25 06:54:30', 1535172870),
(586720, 295607, 96468212, 'Yoga Agung', 4, 'Screenshot from 2018-05-13 02-59-22.png', 1, 1, '2018-08-09', '2018-08-08 11:49:28', 1533721768),
(800449, 426710, 465006985, 'Yellow Claw', 5, 'bukti.png', 1, 0, '2018-08-27', '2018-08-25 16:06:09', 1535205969),
(917862, 426710, 505390092, 'Brian Imanuel', 8, 'bukti.png', 1, 0, '2018-08-28', '2018-08-25 16:05:42', 1535205942);

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
  `covers` varchar(155) NOT NULL,
  `region` varchar(55) NOT NULL,
  `alamat` varchar(300) NOT NULL,
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

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`idevent`, `idhotel`, `id_resto`, `title`, `tagline`, `description`, `covers`, `region`, `alamat`, `tgl_mulai`, `tgl_akhir`, `tgl_posted`, `category`, `quota`, `price`, `status`, `hint`, `added`) VALUES
(65326, 179604, 356641, 'Event on Resto', 'ha', 'euvh', 'barelo.jpeg', 'Surabaya', 'a', '2018-09-25', '2018-09-28', '2018-09-24 16:40:49', 'Parties', 45, 200000, 0, 1, 1537782049),
(66016, 179604, 0, 'Event Expired', 'sudah expired', 'sudah expired gan', 'barelo (1).jpeg', 'Surabaya', 'Jl. Tunjungan No. 101', '2018-06-25', '2018-07-28', '2018-08-25 14:15:20', 'Food and Beverage', 200, 250000, 9, 2, 1535181320),
(295607, 684889, 0, 'Seminar Keagamaan', 'halo dunia', 'Lorem ipsum dolor sit amet', 'perjalananKehidupan.jpg', 'Surabaya', 'Jl. Tentara Genie Pelajar No. 26', '2018-08-08', '2018-08-10', '2018-08-07 10:01:51', 'Parties', 150, 2000, 0, 24, 1533610911),
(426710, 179604, 0, 'Second Event Expired', 'Sudah expired bro', 'Halo dunia', 'barelo (1).jpeg', 'Bali', 'Jl. Bali No. 26', '2018-08-26', '2018-07-29', '2018-08-25 21:01:15', 'Food and Beverage', 500, 300000, 1, 8, 1535205675),
(666256, 179604, 0, 'Event Bulan Depan', 'buat bulan depan', 'halo dunia', 'barelo (1).jpeg', 'Surabaya', 'Jl. Tunjungan No. 101', '2018-11-01', '2018-11-30', '2018-09-18 17:13:49', 'Others', 100, 25000, 0, 10, 1537265629),
(705496, 684889, 671577, 'Event Resto', 'ini tagline', 'Lorem ipsum dolor sit amet', 'Samsul.png', 'Surabaya', 'Jln. Tentara Genie Pelajar No. 26', '2018-08-15', '2018-08-18', '2018-08-14 12:49:30', 'Food and Beverage', 0, 250000, 0, 6, 1534225770),
(782013, 179604, 356641, 'Event on Resto', 'halo dunia', 'iuhewvui', '1158350_16111108190048630267.jpg', 'Bali', 'di rumah', '2018-09-27', '2018-09-30', '2018-09-24 16:46:43', 'Parties', 250, 200000, 1, 0, 1537782403),
(961541, 684889, 0, 'Training Pake Firebase', '#gerakansejutafirebase', 'Hello firebase', 'firebase.png', 'Surabaya', 'Jl. Tentara Genie Pelajar, No. 26', '2018-08-04', '2018-08-07', '2018-08-02 17:30:48', 'Food and Beverage', 50, 20000, 0, 16, 1533205848);

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
  `idalbums` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`idgambar`, `idalbums`, `idhotel`, `tipe`, `gambar`, `added`) VALUES
(168739, 27316, 356641, 'hotel', 'barelo (2).jpeg', 1535282440),
(481805, 58659, 179604, 'hotel', 'Y927222035.jpg', 1537684934),
(633253, 27316, 356641, 'hotel', 'foody-mobile-546016_1409020853002-475-636204258458075548.jpg', 1535282432),
(693145, 58659, 179604, 'hotel', 'iefbpits-26-aug.jpeg', 1537242309),
(946042, 27316, 356641, 'hotel', 'Y927222035.jpg', 1535282435);

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
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
  `coords` varchar(100) NOT NULL,
  `facility` varchar(95) NOT NULL,
  `status` int(1) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`idhotel`, `nama`, `description`, `email`, `password`, `icon`, `cover`, `phone`, `website`, `city`, `address`, `coords`, `facility`, `status`, `added`) VALUES
(131722, 'Testho Hotel', '', 'marcom@testhotel.co.id', 'inikatasandi', 'batman.jpg', 'cara-mengatasi-grogi.jpg', '082126164429', 'https://www.facebook.com', 'Surabaya', 'Jalan Kalianak Timur No. 40', '', '', 1, 1530509890),
(179604, 'Swiss Belinn', 'No description', 'swissbelinn@hotel.id', 'inikatasandi', '', '', '6282126164429', 'https://dailyhotels.id', 'Surabaya', '', '-7.256317699999999|112.73762540000007', '2,1,3,4,5,6', 1, 1534983086),
(194215, 'Riyans Hotel', '', 'marcom@riyanshotel.guru', 'inikatasandi', '', '', '', '', '', '', '', '', 2, 1530461071),
(368862, 'Smekda Hotel', '', 'smekda.surabaya@gmail.com', 'inikatasandi', 'logo-smekda.jpg', '', '62315343708', 'http://smkn2sby.sch.id', 'Surabaya', 'Jalan Tentara Genie Pelajar No. 26', '', '', 1, 1530595602),
(562925, 'Sheraton Surabaya', '', 'surabaya@sheraton.marriott.com', 'inikatasandi', '', '', '', '', '', '', '', '', 0, 1537163485),
(684889, 'TokDalang Homestay', '', 'tokdalang@durianruntuh.my', 'inikatasandi', 'tokdalang.jpg', 'rumahTokDalang.jpg', '93743582375', 'https://durianruntuh.my', 'Kampung Durian Runtuh', 'Kampung Durian Runtuh No. 25', '', '2,3,6,5,1', 1, 1530595632);

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
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
-- Table structure for table `restoran`
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
  `coords` varchar(100) NOT NULL,
  `facility` varchar(95) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restoran`
--

INSERT INTO `restoran` (`idresto`, `idhotel`, `nama`, `description`, `icon`, `cover`, `phone`, `website`, `city`, `address`, `coords`, `facility`, `added`) VALUES
(356641, 179604, 'Belinn Resto', 'Restaurant of Swiss Belinn Hotel', 'swiss-belinn-karawang.jpeg', 'swiss-belhotel.jpg', '6282126164429', 'https://restaurant.swissbelinn.co.id', 'Surabaya', '', '-7.289778999999999|112.71530680000001', '1,2,3,4,5,6', 1535260858),
(671577, 684889, 'Resto Baru', '', '', '', '6282126164429', ' No. 26', 'https://durianruntuh.my', 'Jl. Tentara Genie Pelajar', '', '1,3,4,2,5,6', 1534160575),
(726644, 684889, 'Hisana Pret Ciken', '', 'download (1).jpg', 'download.jpg', '082126164429', 'https://hisana.id', 'Surabaya', 'Jl. Genteng Kali No. 55', '', '5,6,3,4,2,1', 1531783891),
(824062, 179604, 'Resto Baru', '', '', '', '', '', '', '', '', '', 1535260930);

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
(50415, 179604, 0, 'Facebook', 'https://www.facebook.com/zuck'),
(78886, 684889, 0, 'Instagram', 'https://www.instagram.com/awkarin'),
(237927, 684889, 0, 'Twitter', 'https://twitter.com/telkomsel'),
(279802, 179604, 0, 'Twitter', 'https://twitter.com/belajarngewebid'),
(493719, 179604, 0, 'Instagram', 'https://www.instagram.com/awkarin'),
(532286, 179604, 0, 'Google', 'https://plus.google.com/profile/93482935'),
(701779, 726644, 0, 'Facebook', 'https://www.facebook.com/zuck'),
(750413, 179604, 0, 'LinkedIn', 'https://www.linkedin.com/in/haloriyan'),
(797624, 726644, 0, 'Instagram', 'https://www.instagram.com/hisana'),
(842860, 684889, 0, 'Facebook', 'https://www.facebook.com/zuck'),
(851132, 179604, 356641, 'LinkedIn', 'https://www.linkedin.com/in/belinnresto'),
(959218, 179604, 824062, 'Facebook', 'https://www.facebook.com/zuck');

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
(49280222, 'riyan2@riyan.com', 'inikatasandi', 'Riyan Satria', '', '', 1, 1531786268),
(96468212, 'yoga@dailyhotels.id', 'inikatasandi', 'Yoga Agung', '', '', 1, 1533721697),
(378558272, 'halo@riyansatria.tk', 'inikatasandi', 'Riyan Satria', '082126164429', 'di rumah', 1, 1530359712),
(435859107, 'chester@linkinpark.com', 'inikatasandi', 'Chester Bennington', '', '', 1, 1535172051),
(465006985, 'yellowclaw@spinnin.tv', 'inikatasandi', 'Yellow Claw', '', '', 1, 1535171968),
(505390092, 'brian@88rising.com', 'inikatasandi', 'Brian Imanuel', '', '', 1, 1535171930),
(622618919, 'baru@riyansatria.tk', 'inikatasandi', 'Riyan Baru', '', '', 0, 1537163458),
(677895980, 'yprasetiyo335@gmail.com', 'inikatasandi', 'Yoga Agung', '', '', 1, 1533381520),
(908040908, 'martin@spinnin.tv', 'inikatasandi', 'Martin Garrix', '', '', 1, 1535171987),
(958384955, 'mesto@spinnin.tv', 'inikatasandi', 'Melle Stomp', '', '', 1, 1535172005),
(959145339, 'mwilliam@spinnin.tv', 'inikatasandi', 'Mike William', '', '', 1, 1535172143);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`idalbum`);

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
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`idgambar`);

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
  ADD PRIMARY KEY (`idredeem`),
  ADD UNIQUE KEY `idevent` (`idevents`);

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
  MODIFY `idresto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=824063;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
