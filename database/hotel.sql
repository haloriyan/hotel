-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2018 at 09:27 AM
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
(308, 'riyan', 'inikatasandi', 1530460902);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `idevent` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `title` varchar(55) NOT NULL,
  `tagline` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(155) NOT NULL,
  `cover` varchar(155) NOT NULL,
  `region` varchar(55) NOT NULL,
  `address` varchar(300) NOT NULL,
  `tgl` date NOT NULL,
  `tgl_posted` datetime NOT NULL,
  `category` varchar(55) NOT NULL,
  `price` int(20) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`idevent`, `idhotel`, `title`, `tagline`, `description`, `logo`, `cover`, `region`, `address`, `tgl`, `tgl_posted`, `category`, `price`, `added`) VALUES
(239009, 684889, 'Main Sundul-sundulan', 'sundul sampai gundul', 'Cocok buat anda yang kepengen gundul', 'jerry.jpg', 'gym.jpeg', 'Surabaya', 'Jl. Tentara Genie Pelajar No. 26', '2018-07-14', '2018-07-07 09:15:03', 'Sports and Wellness', 0, 1530947703),
(314660, 684889, 'Test Parties', 'hello world', 'Halo dunia', 'Screenshot (16).png', 'Screenshot (16).png', 'Surabaya', 'Jl. Bintang Diponggo Kav. 855, Surabaya', '2018-07-13', '2018-07-07 14:19:15', 'Parties', 0, 1530947955),
(448995, 368862, 'Ujian Nasional bersama Pakde Karwo', 'SMK Bisa!!', 'Mari kita sukseskan gerakan Ujian Nasional bersama Pakde Karwo yang digagas oleh SMK Negeri 2 Surabaya ini agar kelak seluruh siswa mampu mengikuti UN dengan jujur dan hasil yang memuaskan', 'un-bersama-pakde-karwo.jpg', 'un-bersama-pakde-karwo.jpg', 'Petemon', 'Jalan Tentara Genie Pelajar No. 26', '2018-06-04', '0000-00-00 00:00:00', 'Food and Beverage', 0, 1530597145),
(570765, 131722, 'Buka Puasa Mandiri', 'Mandiri kita hebat', 'Undangan terbuka untuk seluruh umat muslim yang berpuasa, kami mengundang kalian untuk berbuka puasa secara mandiri di rumah masing-masing. #mandiriKitaHebat', 'batman.jpg', 'buka puasa.jpeg', 'Rumah', 'Tolong diingat sendiri', '2018-07-04', '0000-00-00 00:00:00', 'Food and Beverage', 0, 1530527744),
(968129, 368862, 'Kegiatan Belajar Mengajar', 'KBM', 'Lorem ipsum dolor sit amet', 'kbm.jpg', 'kbm.jpg', 'Petemon', 'Jalan Tentara Genie Pelajar No. 26', '2018-09-19', '0000-00-00 00:00:00', 'Food and Beverage', 0, 1530597598);

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
  `status` int(1) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`idhotel`, `nama`, `email`, `password`, `icon`, `cover`, `phone`, `website`, `city`, `address`, `status`, `added`) VALUES
(131722, 'Testho Hotel', 'marcom@testhotel.co.id', 'inikatasandi', 'batman.jpg', 'cara-mengatasi-grogi.jpg', '082126164429', 'https://www.facebook.com', 'Surabaya', 'Jalan Kalianak Timur No. 40', 2, 1530509890),
(194215, 'Riyans Hotel', 'marcom@riyanshotel.guru', 'inikatasandi', '', '', '', '', '', '', 2, 1530461071),
(368862, 'Smekda Hotel', 'smekda.surabaya@gmail.com', 'inikatasandi', 'logo-smekda.jpg', '', '62315343708', 'http://smkn2sby.sch.id', 'Surabaya', 'Jalan Tentara Genie Pelajar No. 26', 1, 1530595602),
(684889, 'TokDalang Homestay', 'tokdalang@durianruntuh.my', 'inikatasandi', 'tokdalang.jpg', 'rumahTokDalang.jpg', '93743582375', 'https://durianruntuh.my', 'Kampung Durian Runtuh', 'Kampung Durian Runtuh No. 25', 1, 1530595632);

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `idsocial` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `url` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`idsocial`, `idhotel`, `type`, `url`) VALUES
(484903, 684889, 'Twitter', 'https://www.twitter.com/telkomsel'),
(508757, 684889, 'Facebook', 'https://www.facebook.com/zuck'),
(712041, 684889, 'Instagram', 'https://www.instagram.com/awkarin');

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
(378558272, 'halo@riyansatria.tk', 'sandinepodo', 'Riyan Satria', '', '', 1, 1530359712);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

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
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`idsocial`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
