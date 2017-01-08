-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08 Jan 2017 pada 08.08
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sekolah`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE IF NOT EXISTS `guru` (
`guru_id` int(11) NOT NULL,
  `guru_nik` int(11) DEFAULT NULL,
  `guru_name` varchar(45) DEFAULT NULL,
  `guru_birth_date` date DEFAULT NULL,
  `guru_gender` varchar(45) DEFAULT NULL,
  `guru_religion` varchar(45) DEFAULT NULL,
  `guru_addres` varchar(45) DEFAULT NULL,
  `guru_email` varchar(45) DEFAULT NULL,
  `guru_image` varchar(45) DEFAULT NULL,
  `guru_hp` int(20) DEFAULT NULL,
  `guru_status` varchar(45) DEFAULT NULL,
  `guru_input_date` timestamp NULL DEFAULT NULL,
  `guru_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
`jurusan_id` int(11) NOT NULL,
  `jurusan_name` varchar(45) DEFAULT NULL,
  `prodi_prodi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
`kelas_id` int(11) NOT NULL,
  `kelas_name` varchar(45) DEFAULT NULL,
  `kelas_wali` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `krs`
--

CREATE TABLE IF NOT EXISTS `krs` (
`krs_id` int(11) NOT NULL,
  `krs_smester` varchar(45) DEFAULT NULL,
  `krs_date` date DEFAULT NULL,
  `krs_jumlah_sks` int(11) DEFAULT NULL,
  `krs_jumlah_matkul` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `matakuliah`
--

CREATE TABLE IF NOT EXISTS `matakuliah` (
`matkul_id` int(11) NOT NULL,
  `matakul_name` varchar(45) DEFAULT NULL,
  `matkul_guru` varchar(45) DEFAULT NULL,
  `matakul_input_date` timestamp NULL DEFAULT NULL,
  `matkul_last_update` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE IF NOT EXISTS `prodi` (
`prodi_id` int(11) NOT NULL,
  `prodi_name` varchar(45) DEFAULT NULL,
  `prodi_leader` varchar(45) DEFAULT NULL,
  `prodi_secre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
`siswa_id` int(11) NOT NULL,
  `siswa_nik` int(11) DEFAULT NULL,
  `siswa_name` varchar(45) DEFAULT NULL,
  `siswa_birth_date` date DEFAULT NULL,
  `siswa_gender` varchar(45) DEFAULT NULL,
  `siswa_religion` varchar(45) DEFAULT NULL,
  `siswa_addres` varchar(45) DEFAULT NULL,
  `siswa_email` varchar(45) DEFAULT NULL,
  `siswa_image` varchar(45) DEFAULT NULL,
  `siswa_hp` int(20) DEFAULT NULL,
  `siswa_satatus` varchar(45) DEFAULT NULL,
  `siswa_input_date` timestamp NULL DEFAULT NULL,
  `siswa_last_update` timestamp NULL DEFAULT NULL,
  `jurusan_jurusan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `user_password` varchar(45) DEFAULT NULL,
  `user_image` varchar(45) DEFAULT NULL,
  `user_full_name` varchar(45) DEFAULT NULL,
  `user_email` varchar(45) DEFAULT NULL,
  `user_description` text,
  `user_input_date` timestamp NULL DEFAULT NULL,
  `user_last_update` timestamp NULL DEFAULT NULL,
  `user_role_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
`role_id` int(11) NOT NULL,
  `role_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
 ADD PRIMARY KEY (`guru_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
 ADD PRIMARY KEY (`jurusan_id`), ADD KEY `fk_jurusan_prodi1_idx` (`prodi_prodi_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
 ADD PRIMARY KEY (`kelas_id`);

--
-- Indexes for table `krs`
--
ALTER TABLE `krs`
 ADD PRIMARY KEY (`krs_id`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
 ADD PRIMARY KEY (`matkul_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
 ADD PRIMARY KEY (`prodi_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
 ADD PRIMARY KEY (`siswa_id`), ADD KEY `fk_siswa_jurusan1_idx` (`jurusan_jurusan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`), ADD KEY `fk_user_user_role_idx` (`user_role_role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
 ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
MODIFY `guru_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
MODIFY `jurusan_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `krs`
--
ALTER TABLE `krs`
MODIFY `krs_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
MODIFY `matkul_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
MODIFY `prodi_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
MODIFY `siswa_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
ADD CONSTRAINT `fk_jurusan_prodi1` FOREIGN KEY (`prodi_prodi_id`) REFERENCES `prodi` (`prodi_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
ADD CONSTRAINT `fk_siswa_jurusan1` FOREIGN KEY (`jurusan_jurusan_id`) REFERENCES `jurusan` (`jurusan_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `fk_user_user_role` FOREIGN KEY (`user_role_role_id`) REFERENCES `user_role` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
