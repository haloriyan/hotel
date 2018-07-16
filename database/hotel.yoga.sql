-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13 Jul 2018 pada 04.01
-- Versi Server: 10.1.30-MariaDB
-- PHP Version: 7.2.1

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
(1, 'adm00n', 'inikatasandi', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `idbooking` int(11) NOT NULL,
  `idevent` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `bukti` varchar(155) NOT NULL,
  `status` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
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
  `logo` varchar(155) NOT NULL,
  `cover` varchar(155) NOT NULL,
  `region` varchar(55) NOT NULL,
  `address` varchar(300) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_akhir` date NOT NULL,
  `tgl_posted` datetime NOT NULL,
  `category` varchar(55) NOT NULL,
  `price` int(20) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`idevent`, `idhotel`, `id_resto`, `title`, `tagline`, `description`, `logo`, `cover`, `region`, `address`, `tgl_mulai`, `tgl_akhir`, `tgl_posted`, `category`, `price`, `added`) VALUES
(314660, 684889, 0, 'Test Parties', 'hello world', 'Halo dunia', 'Screenshot (16).png', 'Screenshot (16).png', 'Surabaya', 'Jl. Bintang Diponggo Kav. 855, Surabaya', '2018-07-13', '0000-00-00', '2018-07-07 14:19:15', 'Parties', 0, 1530947955),
(448995, 368862, 0, 'Ujian Nasional bersama Pakde Karwo', 'SMK Bisa!!', 'Mari kita sukseskan gerakan Ujian Nasional bersama Pakde Karwo yang digagas oleh SMK Negeri 2 Surabaya ini agar kelak seluruh siswa mampu mengikuti UN dengan jujur dan hasil yang memuaskan', 'un-bersama-pakde-karwo.jpg', 'un-bersama-pakde-karwo.jpg', 'Petemon', 'Jalan Tentara Genie Pelajar No. 26', '2018-06-04', '0000-00-00', '0000-00-00 00:00:00', 'Food and Beverage', 0, 1530597145),
(570765, 131722, 0, 'Buka Puasa Mandiri', 'Mandiri kita hebat', 'Undangan terbuka untuk seluruh umat muslim yang berpuasa, kami mengundang kalian untuk berbuka puasa secara mandiri di rumah masing-masing. #mandiriKitaHebat', 'batman.jpg', 'buka puasa.jpeg', 'Rumah', 'Tolong diingat sendiri', '2018-07-04', '0000-00-00', '0000-00-00 00:00:00', 'Food and Beverage', 0, 1530527744),
(825414, 684889, 0, 'Membangun Bersama Negeri Tercinta', 'halo dunia', 'Halo dunia, gimana kabar kalian? Kita harap kalian baik-baik saja disana...\n\nOh iya... Kali ini kita hadir lagi dengan nuansa acara yang berbeda. Jika sebelumnya acara di hotel kita cuma makan-makan sambil dengerin orang gacor ngalor-ngidul, acara kita kali ini bakalan lebih banyak aksi daripada teori.\n\nMengusung tema pembangunan, tentu saja apa yang akan kita lakukan nanti di acara adalah membangun. Di sana kalian akan diberi tugas yang berbeda dengan kolega kalian. Akan ada banyak tugas nantinya, seperti mengaduk semen, memotong lantai, hingga membuat pondasi bersama-sama.\n\nPokoknya acara ini akan benar-benar menjadi acara yang membangun. Diharapkan bagi peserta setelah mengikuti acara ini dapat membangun rumahnya sendiri tanpa perlu memanggil tukang atau orang untuk bantu membangunnya.\n\nCatatan : Peralatan seperti sekop, palu, gergaji, dsb tidak disediakan oleh penyelenggara. Diharapkan kepada seluruh peserta untuk membawa sendiri-sendiri. Agar tidak ada unsur kong-kalikong, nanti semua peralatan akan dikumpulkan menjadi satu dan diacak siapa saja yang berhak memegang para peralatan itu. Oh iya, panitia tidak bertanggung jawab apabila ada yang kehilangan barang.\n\nTrims', 'tambah.jpg', 'pembangunan.png', 'Surabaya', 'Jl Bumiarjo', '2018-07-11', '2018-07-14', '2018-07-11 12:00:31', 'Parties', 0, 1531285231),
(968129, 368862, 0, 'Kegiatan Belajar Mengajar', 'KBM', 'Lorem ipsum dolor sit amet', 'kbm.jpg', 'kbm.jpg', 'Petemon', 'Jalan Tentara Genie Pelajar No. 26', '2018-09-19', '0000-00-00', '0000-00-00 00:00:00', 'Food and Beverage', 0, 1530597598);

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
  `idhotel` int(11) NOT NULL,
  `tipe` varchar(20) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `added` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `galeri`
--

INSERT INTO `galeri` (`idgambar`, `idhotel`, `tipe`, `gambar`, `added`) VALUES
(556900, 684889, 'hotel', 'samisanov ok.jpg', 1531280032),
(469912, 684889, 'hotel', 'koridor-co-working-space-surabaya-koridor-2.jpg', 1531302839),
(332003, 684889, 'hotel', '34696265_585925761794440_605698145170489344_n.jpg', 1531370302),
(180883, 684889, 'hotel', '_SAM1139.JPG', 1531371685);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hotel`
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
-- Dumping data untuk tabel `hotel`
--

INSERT INTO `hotel` (`idhotel`, `nama`, `email`, `password`, `icon`, `cover`, `phone`, `website`, `city`, `address`, `facility`, `status`, `added`) VALUES
(131722, 'Testho Hotel', 'marcom@testhotel.co.id', 'inikatasandi', 'batman.jpg', 'cara-mengatasi-grogi.jpg', '082126164429', 'https://www.facebook.com', 'Surabaya', 'Jalan Kalianak Timur No. 40', '', 1, 1530509890),
(194215, 'Riyans Hotel', 'marcom@riyanshotel.guru', 'inikatasandi', '', '', '', '', '', '', '', 2, 1530461071),
(368862, 'Smekda Hotel', 'smekda.surabaya@gmail.com', 'inikatasandi', 'logo-smekda.jpg', '', '62315343708', 'http://smkn2sby.sch.id', 'Surabaya', 'Jalan Tentara Genie Pelajar No. 26', '', 1, 1530595602),
(684889, 'TokDalang Homestay', 'tokdalang@durianruntuh.my', 'inikatasandi', 'tokdalang.jpg', 'rumahTokDalang.jpg', '93743582375', 'https://durianruntuh.my', 'Kampung Durian Runtuh', 'Kampung Durian Runtuh No. 25', '2,3,4', 1, 1530595632);

-- --------------------------------------------------------

--
-- Struktur dari tabel `restoran`
--

CREATE TABLE `restoran` (
  `idresto` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `nama_resto` varchar(55) NOT NULL,
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
-- Struktur dari tabel `social`
--

CREATE TABLE `social` (
  `idsocial` int(11) NOT NULL,
  `idhotel` int(11) NOT NULL,
  `idresto` int(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `url` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `social`
--

INSERT INTO `social` (`idsocial`, `idhotel`, `idresto`, `type`, `url`) VALUES
(484903, 684889, 0, 'Twitter', 'https://www.twitter.com/telkomsel'),
(508757, 684889, 0, 'Facebook', 'https://www.facebook.com/zuck'),
(712041, 684889, 0, 'Instagram', 'https://www.instagram.com/awkarin');

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
-- Dumping data untuk tabel `user`
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
  MODIFY `idresto` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
