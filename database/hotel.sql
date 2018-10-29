-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 29, 2018 at 01:10 PM
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
  `idadmin` tinyint(11) NOT NULL,
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
  `idalbum` tinyint(11) NOT NULL,
  `idhotel` tinyint(11) NOT NULL,
  `id_resto` tinyint(11) NOT NULL,
  `nama` varchar(65) NOT NULL,
  `created` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `idbooking` tinyint(11) NOT NULL,
  `idevent` tinyint(11) NOT NULL,
  `iduser` tinyint(11) NOT NULL,
  `nama` varchar(155) NOT NULL,
  `qty` tinyint(11) NOT NULL,
  `bukti` varchar(155) NOT NULL,
  `status` tinyint(11) NOT NULL,
  `hadir` tinyint(11) NOT NULL,
  `tgl` date NOT NULL,
  `tgl_book` datetime NOT NULL,
  `added` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cuisine`
--

CREATE TABLE `cuisine` (
  `idcuisine` tinyint(11) NOT NULL,
  `nama` varchar(65) NOT NULL,
  `added` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuisine`
--

INSERT INTO `cuisine` (`idcuisine`, `nama`, `added`) VALUES
(1, 'Indonesian', 127),
(2, 'Chinese', 127),
(3, 'Thailand', 127),
(4, 'Francaise', 127);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `idevent` tinyint(11) NOT NULL,
  `idhotel` tinyint(11) NOT NULL,
  `id_resto` tinyint(11) NOT NULL,
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
  `quota` tinyint(11) NOT NULL,
  `price` tinyint(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `hint` tinyint(11) NOT NULL,
  `added` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `idfacility` tinyint(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `tipe` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`idfacility`, `nama`, `icon`, `tipe`) VALUES
(1, 'Wireless Internet', 'fa fa-wifi', 1),
(2, 'Parking Street', 'fa fa-car', 1),
(3, 'Smoking Allowed', 'fa fa-magic', 1),
(4, 'Accept Credit Cards', 'fa fa-credit-card', 1),
(5, 'Bike Parking', 'fa fa-bicycle', 1),
(6, 'Coupons', 'fa fa-tags', 1),
(7, 'Class', 'fa fa-users', 2),
(8, 'Rounded Table', 'fa fa-cutlery', 2),
(9, 'Theatre', 'fa fa-film', 2);

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `idgambar` tinyint(11) NOT NULL,
  `idalbums` tinyint(11) NOT NULL,
  `idhotel` tinyint(11) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `added` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `idhotel` tinyint(11) NOT NULL,
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
  `status` tinyint(1) NOT NULL,
  `added` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `redeem`
--

CREATE TABLE `redeem` (
  `idredeem` tinyint(11) NOT NULL,
  `idhotel` tinyint(11) NOT NULL,
  `id_resto` tinyint(11) NOT NULL,
  `idevents` tinyint(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `restoran`
--

CREATE TABLE `restoran` (
  `idresto` tinyint(11) NOT NULL,
  `idhotel` tinyint(11) NOT NULL,
  `nama` varchar(65) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(155) NOT NULL,
  `cover` varchar(155) NOT NULL,
  `city` varchar(40) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(155) NOT NULL,
  `website` varchar(155) NOT NULL,
  `price` varchar(45) NOT NULL,
  `facility` varchar(95) NOT NULL,
  `cuisine` varchar(333) NOT NULL,
  `hours` varchar(155) NOT NULL,
  `serve` varchar(333) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `idsocial` tinyint(11) NOT NULL,
  `idhotel` tinyint(11) NOT NULL,
  `idresto` tinyint(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `url` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `idtrack` tinyint(11) NOT NULL,
  `idevent` tinyint(11) NOT NULL,
  `iduser` varchar(25) NOT NULL,
  `tipe` tinyint(11) NOT NULL,
  `hint` tinyint(11) NOT NULL,
  `last_tracked` tinyint(11) NOT NULL,
  `added` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` tinyint(11) NOT NULL,
  `email` varchar(155) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `city` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `registered` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD PRIMARY KEY (`idalbum`),
  ADD KEY `idhotel` (`idhotel`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`idbooking`);

--
-- Indexes for table `cuisine`
--
ALTER TABLE `cuisine`
  ADD PRIMARY KEY (`idcuisine`);

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
  ADD PRIMARY KEY (`idsocial`),
  ADD KEY `idhotel` (`idhotel`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
