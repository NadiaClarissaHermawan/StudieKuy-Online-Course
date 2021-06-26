-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2021 at 11:42 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `id_pengguna`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `id_bidang` int(11) NOT NULL,
  `nama_bidang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidang`
--

INSERT INTO `bidang` (`id_bidang`, `nama_bidang`) VALUES
(1, 'Computer'),
(2, 'Art'),
(3, 'Law'),
(4, 'Science'),
(5, 'Language'),
(6, 'Economy');

-- --------------------------------------------------------

--
-- Table structure for table `bidang_course`
--

CREATE TABLE `bidang_course` (
  `id_bidang` int(11) NOT NULL,
  `id_courses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidang_course`
--

INSERT INTO `bidang_course` (`id_bidang`, `id_courses`) VALUES
(1, 1),
(2, 2),
(3, 3),
(2, 16),
(2, 17),
(2, 17);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id_courses` int(11) NOT NULL,
  `nama_course` varchar(255) NOT NULL,
  `tarif` double(9,3) NOT NULL,
  `batas_nilai_minimum` int(11) NOT NULL,
  `keterangan_course` varchar(500) NOT NULL,
  `id_pengajar` int(11) NOT NULL,
  `gambar_courses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id_courses`, `nama_course`, `tarif`, `batas_nilai_minimum`, `keterangan_course`, `id_pengajar`, `gambar_courses`) VALUES
(1, 'Java Basic Programming', 50.000, 70, 'Course ini akan membahas tentang prinsip dasar dan perangkat lunak apa saja yang akan diperlukan dalam melakukan programming dengan bahasa Java.', 1, '1.jpg'),
(2, 'Design Interior', 20.000, 65, 'Course ini akan menyajikan beberapa strategi dan contoh design interior yang sedang populer di zaman ini.', 3, 'empty.jpg'),
(3, 'Pengantar Ilmu Hukum', 50.000, 60, 'Course ini akan membahas beberapa dasar informasi terkait sistematika dan prosedur hukum di Indonesia.', 2, 'empty.jpg'),
(14, 'course X', 80.000, 45, 'ini adalah course', 2, 'empty.jpg'),
(15, 'course X', 80.000, 45, 'ini adalah course', 2, 'empty.jpg'),
(16, 'course y', 40.000, 90, 'course ini mengandung ilmu gabut', 2, '16.jpg'),
(17, 'sad', 0.010, 9, 'ini adalah course', 2, '17.jpg'),
(18, 'sad', 0.010, 9, 'ini adalah course', 2, 'empty.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`) VALUES
(1, 'Bandung'),
(2, 'Jakarta'),
(3, 'Lampung'),
(4, 'Tasikmalaya'),
(5, 'Bogor'),
(6, 'Medan'),
(7, 'Bekasi'),
(8, 'Cimahi'),
(9, 'Cianjur'),
(10, 'Denpasar');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `saldo` decimal(9,3) NOT NULL,
  `kontak` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `saldo`, `kontak`, `alamat`, `id_kota`, `id_pengguna`) VALUES
(1, '0.000', '081111111111', 'Jalan Ciumbuleuit 94', 1, 6),
(2, '10.000', '081222222222', 'Jalan Durian Rontok', 2, 7),
(3, '50.000', '081333333333', 'Jalan Cabe Rawit No.10', 7, 8),
(4, '20.000', '081324365232', 'Jalan Kelaparan 3 No 1', 1, 9),
(5, '0.000', '08132323289', 'jalan buaya sakti', 1, 10),
(7, '0.000', '1232131322', 'Jalan Kelaparan 2', 1, 11),
(8, '0.000', '081324324234', 'Jalan ketiduran', 1, 12),
(10, '0.000', '7123123123', 'jalan tidur sebentar', 2, 14),
(11, '0.000', '72183213213', 'Jalan Swallow', 2, 15),
(12, '0.000', '0812312312312', 'jalan kentut', 1, 16),
(13, '0.000', '081321321312', 'Buana Indah 1 nomor 33', 1, 17),
(14, '0.000', '08132432222', 'Jalan Swallow', 1, 18),
(15, '0.000', '123123313123', 'Buana Indah 1 nomor 33', 2, 19),
(16, '0.000', '08123213233', 'Buana Indah 1 nomor 33', 1, 20),
(17, '0.000', '72183213213', 'jalan batu kerikil 1 no 31', 9, 21),
(18, '0.000', '72183213213', 'asdada', 9, 22),
(19, '0.000', '08132432222', 'Jalan Swallow', 9, 23),
(20, '0.000', '08132432222', 'Buana Indah 1 nomor 33', 10, 24),
(21, '0.000', '6181901013', 'Jalan Bagong Kecepirit', 10, 25),
(22, '0.000', '08132432222', 'Jalanan Luas', 1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `member_course`
--

CREATE TABLE `member_course` (
  `id_memCourse` int(11) NOT NULL,
  `nilai_akhir` int(11) DEFAULT NULL,
  `status_ketuntasan` int(11) NOT NULL,
  `tanggal_tuntas` date DEFAULT NULL,
  `status_verifikasi` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_courses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member_course`
--

INSERT INTO `member_course` (`id_memCourse`, `nilai_akhir`, `status_ketuntasan`, `tanggal_tuntas`, `status_verifikasi`, `id_member`, `id_courses`) VALUES
(1, 50, 2, '2021-06-25', 1, 16, 1),
(3, 100, 1, '2021-06-24', 2, 5, 2),
(4, NULL, 0, NULL, 0, 4, 3),
(5, 23, 1, '2021-06-14', 0, 4, 1),
(6, 123, 1, '2021-06-08', 1, 4, 2),
(7, 23, 1, '2021-06-14', 0, 12, 3),
(8, 123, 1, '2021-06-08', 1, 4, 1),
(9, 23, 1, '2021-06-14', 0, 14, 2),
(10, 123, 1, '2021-06-08', 1, 4, 3),
(11, 23, 1, '2021-06-14', 0, 14, 1),
(12, 123, 1, '2021-06-08', 1, 4, 2),
(13, 23, 1, '2021-06-14', 0, 14, 3),
(14, 123, 1, '2021-06-08', 1, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE `modul` (
  `id_modul` int(11) NOT NULL,
  `isi_modul` varchar(255) NOT NULL,
  `nama_modul` varchar(255) NOT NULL,
  `id_courses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id_modul`, `isi_modul`, `nama_modul`, `id_courses`) VALUES
(1, '1.ogv', 'IDE dan kebutuhan dasar sebelum memulai coding Java', 1),
(2, 'modul/computer/JavaBasicProgramming/part2', 'Mengenal fungsi-fungsi dasar pada Java', 1),
(3, 'modul/art/DesignInterior/part1', 'Mengenal komposisi dan ruang', 2),
(4, 'modul/art/DesignInterior/part2', 'Membuat design yang cantik', 2),
(5, 'modul/law/PengantarIlmuHukum/part1', 'Mengenali jenis-jenis hukum di Indonesia', 3),
(6, 'modul/law/PengantarIlmuHukum/part2', 'Proses Terbentuknya Hukum', 3),
(7, 'modul/law/PengantarIlmuHukum/part3', 'Alasan mengikuti hukum', 3),
(8, '8.mp4', 'aaa', 17),
(9, '9.mp4', 'aaa', 17),
(10, '10.mp4', 'aaa', 17),
(11, '11.mp4', 'aaa', 17),
(12, '12.mp4', 'aaa', 17),
(13, '13.mp4', '', 17),
(15, '15.mp4', 'modulsss', 17);

-- --------------------------------------------------------

--
-- Table structure for table `pengajar`
--

CREATE TABLE `pengajar` (
  `id_pengajar` int(11) NOT NULL,
  `pendidikan_terakhir` varchar(255) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `bukti_pengajar` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `kontak` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengajar`
--

INSERT INTO `pengajar` (`id_pengajar`, `pendidikan_terakhir`, `id_pengguna`, `bukti_pengajar`, `alamat`, `kontak`) VALUES
(1, 'Sarjana Komputer Universitas X', 3, '', 'jalan x', '0283921'),
(2, 'Sarjana Hukum Universitas Y', 4, '', 'jalan y', '12938340'),
(3, 'Sarjana Design & Architecture Universitas Z', 5, '', 'jalan z', '304742052');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `tipe` int(11) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `tipe`, `nama_user`, `real_name`, `email`, `pass`, `profile_picture`, `status`) VALUES
(1, 1, 'nadia clarissa', 'nadia clarissa', 'nadia@gmail.com', 'nadia123', 'view/images/profilepicture/1', 0),
(2, 1, 'clarissa nadia', 'clarissa', 'clarissa@gmail.com', 'clarissa123', 'view/images/profilepicture/2', 1),
(3, 2, 'natasha benedicta', 'natasha Benedicta', 'natasha@gmail.com', 'natasha123', 'view/images/profilepicture/3', 1),
(4, 2, 'tasha boen', 'Tasha Bundahku', 'tasha@gmail.com', 'tasha123', '4.jpg', 1),
(5, 2, 'benedicta', 'Benedicta Natasha', 'benedicta@gmail.com', 'benedicta123', 'view/images/profilepicture/5', 1),
(6, 3, 'stanislaus', 'Stanislaus Dendrio', 'stanislaus@gmail.com', 'stanis123', 'view/images/profilepicture/6', 1),
(7, 3, 'rio ajah', 'Rio Evan', 'rio@gmail.com', 'rio123', 'view/images/profilepicture/7', 1),
(8, 3, 'dendrio evan', 'Dendrio Evan', 'evan@gmail.com', 'evan123', 'view/images/profilepicture/8', 1),
(9, 3, 'nadianadia', 'Nadia Clarissa H', 'nadia8901@gmail.com', 'nadia123', '9.jpg', 1),
(10, 3, 'Jamet Evan', 'Evan de Jamet Boi', 'jamet@gmail.com', 'jamet123', 'view/images/profilepicture/10', 1),
(11, 3, 'aku_lapar', 'Nadia Clarissa', 'banana@gmail.com', 'lapardotcom', 'view/images/profilepicture/11', 1),
(12, 3, 'akupusingdanlelah', 'kelelahan', 'pusing@gmail.com', 'lelah123', 'view/images/profilepicture/baseProfilePic', 1),
(14, 3, 'ngantuk dot com', 'mengantuk sangat', 'tidur@gmail.com', 'ngantuk123', 'view/images/profilepicture/baseProfilePic', 1),
(15, 3, 'hahahaha', 'nadiaclarissa', 'ahlucukamu@gmail.com', 'hahahaha', 'view/images/profilepicture/baseProfilePic', 1),
(16, 3, 'vincentaneh', 'vincent kurniawan', 'ebi@gmail.com', 'abang123', 'view/images/profilepicture/baseProfilePic.jpg', 1),
(17, 3, 'nadiaaaaaa', 'nadia clarissa', 'nadia8@gmail.com', 'nadia892001', 'view/images/profilepicture/baseProfilePic.jpg', 1),
(18, 3, 'mocha chino', 'hermawan', 'banana2@gmail.com', 'naida892001', 'baseProfilePic.jpg', 1),
(19, 3, 'banana12', 'banana lengkap', 'banana3@gmail.com', 'nadia892001', '19.jpg', 1),
(20, 3, 'clarissa_nadiaaa', 'Nadia Clarissa Hermawan', 'nadiaaaaaa@gmail.com', 'nadia892001', '20.jpg', 1),
(21, 3, 'akubisa1', 'nadia clarissa', 'akubisayes@gmail.com', 'akubisayes', 'baseProfilePic.jpg', 1),
(22, 3, 'corona123', 'Nadia Clarissa', 'nadiasdasdasd@gmail.com', 'corona123', 'baseProfilePic.jpg', 1),
(23, 3, 'asdasdasdasdasdasdsadas', 'banana lengkap', 'nadiaclarissa8@gmail.com', '21442323t', 'baseProfilePic.jpg', 1),
(24, 3, 'nadianadia8', 'Nadia Clarissa H', 'nanadiadia@gmail.com', 'nadia892001', 'baseProfilePic.jpg', 1),
(25, 3, 'vincentK', 'Vincent Kurniawan', 'vincent@gmail.com', 'vincent123', 'baseProfilePic.jpg', 1),
(26, 3, 'kucingOren', 'Miauw Miauw', 'bananaasdafwt@gmail.com', 'kucing123', 'baseProfilePic.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id_sertifikat` int(11) NOT NULL,
  `nama_sertif` varchar(255) NOT NULL,
  `id_courses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sertifikat`
--

INSERT INTO `sertifikat` (`id_sertifikat`, `nama_sertif`, `id_courses`) VALUES
(1, 'Java Basic Programming Completion', 1),
(2, 'Design Interior Completion', 2),
(3, 'Pengantar Ilmu Hukum', 3);

-- --------------------------------------------------------

--
-- Table structure for table `soal_ujian`
--

CREATE TABLE `soal_ujian` (
  `id_soal_ujian` int(11) NOT NULL,
  `nomor_soal` int(11) NOT NULL,
  `soal` varchar(255) NOT NULL,
  `opsi1` varchar(255) NOT NULL,
  `opsi2` varchar(255) NOT NULL,
  `opsi3` varchar(255) NOT NULL,
  `kunci_jawaban` int(255) NOT NULL,
  `id_courses` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soal_ujian`
--

INSERT INTO `soal_ujian` (`id_soal_ujian`, `nomor_soal`, `soal`, `opsi1`, `opsi2`, `opsi3`, `kunci_jawaban`, `id_courses`) VALUES
(1, 1, 'Bahasa Java itu apa?', 'bahasa sehari-hari', 'bahasa programming', 'bahasa gahol', 2, 1),
(2, 2, 'Apa fungsi perintah for pada java', 'Memberikan hadiah', 'Memberi tahu', 'Melakukan perulangan', 3, 1),
(3, 1, 'Apa arti hukum?', 'hukum aja', 'sanksi', 'gatau', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_course`
--

CREATE TABLE `transaksi_course` (
  `id_transaksi_course` int(11) NOT NULL,
  `saldo_awal` double(9,3) NOT NULL,
  `saldo_akhir` double(9,3) NOT NULL,
  `tanggal_transaksi_course` date NOT NULL,
  `id_courses` int(11) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_course`
--

INSERT INTO `transaksi_course` (`id_transaksi_course`, `saldo_awal`, `saldo_akhir`, `tanggal_transaksi_course`, `id_courses`, `id_member`) VALUES
(1, 110.000, 60.000, '2021-06-13', 1, 2),
(2, 60.000, 10.000, '2021-06-13', 3, 2),
(3, 0.440, 0.390, '2021-06-25', 1, 4),
(4, 100.000, 50.000, '2021-06-25', 1, 4),
(5, 50.000, 0.000, '2021-06-25', 1, 4),
(6, 100.000, 50.000, '2021-06-25', 1, 4),
(7, 50.000, 0.000, '2021-06-25', 1, 4),
(8, 100.000, 50.000, '2021-06-25', 1, 4),
(9, 50.000, 0.000, '2021-06-25', 1, 4),
(10, 70.000, 20.000, '2021-06-25', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_saldo`
--

CREATE TABLE `transaksi_saldo` (
  `id_transaksi_saldo` int(11) NOT NULL,
  `saldo_awal` double(9,3) NOT NULL,
  `saldo_akhir` double(9,3) NOT NULL,
  `status_verifikasi` int(11) NOT NULL,
  `tanggal_transaksi_saldo` date NOT NULL,
  `nominal_pengisian` double(9,3) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `bukti_trf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_saldo`
--

INSERT INTO `transaksi_saldo` (`id_transaksi_saldo`, `saldo_awal`, `saldo_akhir`, `status_verifikasi`, `tanggal_transaksi_saldo`, `nominal_pengisian`, `id_member`, `id_admin`, `bukti_trf`) VALUES
(76, 290.000, 340.000, 1, '2021-06-23', 50.000, 4, 1, '9.jpg'),
(77, 340.000, 325.000, 2, '2021-06-23', 35.000, 4, 1, '9.jpg'),
(78, 340.000, 440.000, 1, '2021-06-23', 100.000, 4, 1, '9.jpg'),
(79, 440.000, 490.000, 2, '2021-06-24', 50.000, 4, 1, '79.jpg'),
(80, 440.000, 460.000, 2, '2021-06-24', 20.000, 4, 1, '80.jpg'),
(81, 50.000, 460.000, 1, '2021-06-24', 20.000, 4, 1, '9.jpg'),
(82, 50.000, 490.000, 2, '2021-06-24', 50.000, 4, 1, '9.jpg'),
(83, 440.000, 490.000, 1, '2021-06-24', 50.000, 4, 1, '9.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `fk_adminPengguna` (`id_pengguna`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`id_bidang`);

--
-- Indexes for table `bidang_course`
--
ALTER TABLE `bidang_course`
  ADD KEY `fk_bidangC` (`id_bidang`),
  ADD KEY `fk_courseB` (`id_courses`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_courses`),
  ADD KEY `fk_pengajarCourse` (`id_pengajar`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`),
  ADD KEY `fk_kota` (`id_kota`),
  ADD KEY `fk_memberPengguna` (`id_pengguna`);

--
-- Indexes for table `member_course`
--
ALTER TABLE `member_course`
  ADD PRIMARY KEY (`id_memCourse`),
  ADD KEY `fk_memberMCourses` (`id_member`),
  ADD KEY `fk_courseMCourses` (`id_courses`);

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
  ADD PRIMARY KEY (`id_modul`),
  ADD KEY `fk_modulCourse` (`id_courses`);

--
-- Indexes for table `pengajar`
--
ALTER TABLE `pengajar`
  ADD PRIMARY KEY (`id_pengajar`),
  ADD KEY `fk_pengajarPengguna` (`id_pengguna`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`),
  ADD KEY `fk_sertifCourses` (`id_courses`);

--
-- Indexes for table `soal_ujian`
--
ALTER TABLE `soal_ujian`
  ADD PRIMARY KEY (`id_soal_ujian`),
  ADD KEY `fk_soal_courses` (`id_courses`);

--
-- Indexes for table `transaksi_course`
--
ALTER TABLE `transaksi_course`
  ADD PRIMARY KEY (`id_transaksi_course`),
  ADD KEY `fk_transCourse` (`id_courses`),
  ADD KEY `fk_transMember` (`id_member`);

--
-- Indexes for table `transaksi_saldo`
--
ALTER TABLE `transaksi_saldo`
  ADD PRIMARY KEY (`id_transaksi_saldo`),
  ADD KEY `fk_transsaldoMember` (`id_member`),
  ADD KEY `fk_transsaldoAdmin` (`id_admin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id_courses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `member_course`
--
ALTER TABLE `member_course`
  MODIFY `id_memCourse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
  MODIFY `id_modul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pengajar`
--
ALTER TABLE `pengajar`
  MODIFY `id_pengajar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `soal_ujian`
--
ALTER TABLE `soal_ujian`
  MODIFY `id_soal_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi_course`
--
ALTER TABLE `transaksi_course`
  MODIFY `id_transaksi_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaksi_saldo`
--
ALTER TABLE `transaksi_saldo`
  MODIFY `id_transaksi_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_adminPengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Constraints for table `bidang_course`
--
ALTER TABLE `bidang_course`
  ADD CONSTRAINT `fk_bidangC` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id_bidang`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_courseB` FOREIGN KEY (`id_courses`) REFERENCES `courses` (`id_courses`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_pengajarCourse` FOREIGN KEY (`id_pengajar`) REFERENCES `pengajar` (`id_pengajar`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `fk_kota` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`),
  ADD CONSTRAINT `fk_memberPengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Constraints for table `member_course`
--
ALTER TABLE `member_course`
  ADD CONSTRAINT `fk_courseMCourses` FOREIGN KEY (`id_courses`) REFERENCES `courses` (`id_courses`),
  ADD CONSTRAINT `fk_memberMCourses` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`);

--
-- Constraints for table `modul`
--
ALTER TABLE `modul`
  ADD CONSTRAINT `fk_modulCourse` FOREIGN KEY (`id_courses`) REFERENCES `courses` (`id_courses`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajar`
--
ALTER TABLE `pengajar`
  ADD CONSTRAINT `fk_pengajarPengguna` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Constraints for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD CONSTRAINT `fk_sertifCourses` FOREIGN KEY (`id_courses`) REFERENCES `courses` (`id_courses`);

--
-- Constraints for table `soal_ujian`
--
ALTER TABLE `soal_ujian`
  ADD CONSTRAINT `fk_soal_courses` FOREIGN KEY (`id_courses`) REFERENCES `courses` (`id_courses`);

--
-- Constraints for table `transaksi_course`
--
ALTER TABLE `transaksi_course`
  ADD CONSTRAINT `fk_transCourse` FOREIGN KEY (`id_courses`) REFERENCES `courses` (`id_courses`),
  ADD CONSTRAINT `fk_transMember` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`);

--
-- Constraints for table `transaksi_saldo`
--
ALTER TABLE `transaksi_saldo`
  ADD CONSTRAINT `fk_transsaldoAdmin` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`),
  ADD CONSTRAINT `fk_transsaldoMember` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
