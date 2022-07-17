-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Apr 2022 pada 15.31
-- Versi server: 10.3.15-MariaDB
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ftuir3`
--

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `SPLIT_STRING` (`str` VARCHAR(255), `delim` VARCHAR(12), `pos` INT) RETURNS VARCHAR(255) CHARSET utf8mb4 RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(str, delim, pos),
       CHAR_LENGTH(SUBSTRING_INDEX(str, delim, pos-1)) + 1),
       delim, '')$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bimbingan`
--

CREATE TABLE `tbl_bimbingan` (
  `id_bimbingan` int(11) NOT NULL,
  `id_syarat_sk` int(3) NOT NULL,
  `bimbingan_ke` int(11) NOT NULL,
  `materi_bimbingan` text NOT NULL,
  `hasil_bimbingan` text NOT NULL,
  `jenis_pertemuan_bimbingan` varchar(30) NOT NULL,
  `file_lampiran` text NOT NULL,
  `waktu_input_bimbingan` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bimbingan_skripsi`
--

CREATE TABLE `tbl_bimbingan_skripsi` (
  `id_bimbingan_skripsi` int(11) NOT NULL,
  `id_skripsi` int(3) NOT NULL,
  `bimbingan_ke` int(11) NOT NULL,
  `materi_bimbingan` text NOT NULL,
  `hasil_bimbingan` text NOT NULL,
  `jenis_pertemuan_bimbingan` varchar(30) NOT NULL,
  `file_lampiran` text NOT NULL,
  `waktu_input_bimbingan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_dospem`
--

CREATE TABLE `tbl_dospem` (
  `id_dospem` int(3) NOT NULL,
  `id_syarat_sk` int(3) NOT NULL,
  `npk` char(30) NOT NULL,
  `tgl_pengajuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `respon` varchar(50) NOT NULL,
  `tgl_respon` datetime NOT NULL,
  `alasan_ditolak` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_dospem_skripsi`
--

CREATE TABLE `tbl_dospem_skripsi` (
  `id_dospem_skripsi` int(3) NOT NULL,
  `id_skripsi` int(3) NOT NULL,
  `npk` char(30) NOT NULL,
  `tgl_respon` timestamp NOT NULL DEFAULT current_timestamp(),
  `respon` varchar(50) NOT NULL,
  `alasan_ditolak` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_file_kp`
--

CREATE TABLE `tbl_file_kp` (
  `id_file_kp` int(3) NOT NULL,
  `id_syarat_sk` int(3) NOT NULL,
  `nama_file` text NOT NULL,
  `waktu_upload` timestamp NOT NULL DEFAULT current_timestamp(),
  `file` text NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_file_skripsi`
--

CREATE TABLE `tbl_file_skripsi` (
  `id_file_skripsi` int(3) NOT NULL,
  `id_skripsi` int(3) NOT NULL,
  `nama_file` text NOT NULL,
  `waktu_upload` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `file` text NOT NULL,
  `status_sempro` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_gkm`
--

CREATE TABLE `tbl_gkm` (
  `username` char(50) NOT NULL,
  `kode_prodi` char(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `npk` char(30) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` char(14) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `hak_akses` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status_akun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_gkm`
--

INSERT INTO `tbl_gkm` (`username`, `kode_prodi`, `nama_lengkap`, `npk`, `jenis_kelamin`, `email`, `no_hp`, `jabatan`, `hak_akses`, `password`, `foto`, `status_akun`) VALUES
('gkm31', '1', 'gkm31', '', 'Perempuan', 'gkm@gmail.com', '0812345678', 'Super Admin', 'Super Admin', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('gkm32', '2', 'gkm32', '', 'Perempuan', 'gkm@gmail.com', '0812345678', 'Super Admin', 'Super Admin', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('gkm33', '3', 'gkm33', '', 'Perempuan', 'gkm@gmail.com', '0812345678', 'Super Admin', 'Super Admin', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('gkm34', '4', 'gkm34', '', 'Perempuan', 'gkm@gmail.com', '0812345678', 'Super Admin', 'Super Admin', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('gkm35', '5', 'gkm35', '', 'Perempuan', 'gkm@gmail.com', '0812345678', 'Super Admin', 'Super Admin', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('gkm36', '6', 'gkm36', '', 'Perempuan', 'gkm@gmail.com', '0812345678', 'Super Admin', 'Super Admin', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jenis_sk`
--

CREATE TABLE `tbl_jenis_sk` (
  `id_jenis_sk` int(3) NOT NULL,
  `nama_jenis_sk` varchar(30) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_jenis_sk`
--

INSERT INTO `tbl_jenis_sk` (`id_jenis_sk`, `nama_jenis_sk`, `status`) VALUES
(1, 'SK Pembimbing KP', 'Tersedia'),
(2, 'SK Pembimbing Skripsi', 'Tersedia'),
(3, 'SK Penguji Skripsi', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_koordinator`
--

CREATE TABLE `tbl_koordinator` (
  `username` char(50) CHARACTER SET utf8mb4 NOT NULL,
  `kode_prodi` char(20) CHARACTER SET utf8mb4 NOT NULL,
  `nama_lengkap` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `npk` char(30) CHARACTER SET utf8mb4 NOT NULL,
  `jenis_kelamin` varchar(10) CHARACTER SET utf8mb4 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `no_hp` char(14) CHARACTER SET utf8mb4 NOT NULL,
  `jabatan` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `hak_akses` varchar(20) CHARACTER SET utf8mb4 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `foto` varchar(100) CHARACTER SET utf8mb4 NOT NULL,
  `status_akun` varchar(10) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_koordinator`
--

INSERT INTO `tbl_koordinator` (`username`, `kode_prodi`, `nama_lengkap`, `npk`, `jenis_kelamin`, `email`, `no_hp`, `jabatan`, `hak_akses`, `password`, `foto`, `status_akun`) VALUES
('koordinator31', '1', 'koordinator31', '', 'Perempuan', 'koordinator31@gmail.com', '0812345678', 'Super Admin', 'Super Admin', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('koordinator32', '2', 'koordinator32', '', 'Perempuan', 'koordinator32@gmail.com', '0812345678', 'Super Admin', 'Super Admin', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('koordinator33', '3', 'koordinator33', '', 'Perempuan', 'koordinator33@gmail.com', '0812345678', 'Super Admin', 'Super Admin', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('koordinator34', '4', 'koordinator34', '', 'Perempuan', 'koordinator34@gmail.com', '0812345678', 'Super Admin', 'Super Admin', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('koordinator35', '5', 'koordinator35', '', 'Perempuan', 'koordinator35@gmail.com', '0812345678', 'Super Admin', 'Super Admin', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('koordinator36', '6', 'koordinator36', '', 'Perempuan', 'koordinator36@gmail.com', '0812345678', 'Super Admin', 'Super Admin', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `npm` char(9) NOT NULL,
  `nama_mahasiswa` varchar(50) NOT NULL,
  `jk` varchar(20) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kode_prodi` char(20) NOT NULL,
  `password` text NOT NULL,
  `email_student` varchar(50) NOT NULL,
  `email_umum` varchar(50) NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  `no_ktp` char(16) NOT NULL,
  `agama` varchar(25) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `foto` text NOT NULL,
  `tanggal_register` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`npm`, `nama_mahasiswa`, `jk`, `tempat_lahir`, `tgl_lahir`, `kode_prodi`, `password`, `email_student`, `email_umum`, `no_hp`, `no_ktp`, `agama`, `alamat`, `foto`, `tanggal_register`, `status`) VALUES
('173110270', 'Iqbal Maulana', 'Laki-laki', 'Kupang', '1999-04-01', '1', '$2y$10$cK3TNQceDLWXSihcaf.eVOYTjYmI8mPJOL5qOgINFTIO41G6dKjte', 'iqbalmaulana@student.uir.ac.id', 'iqbalmaulana@gmail.com', '08111111', '1234567890123456', 'Islam', 'Jl. Timor Raya Km. 18 Desa Tanah Merah ', '', '2022-02-08 16:16:48', 'Aktif'),
('173110593', 'M. Givari 123', 'Laki-laki', 'Banten', '1995-09-09', '1', '$2y$10$zW5lxQnsvoVBEtNVAllrruoG7FSM0KimsNwgGj86jUwepCqRlxDvy', 'givari123@student.uir.ac.id', 'givari123@gmail.com', '08123456700', '1122334455678912', 'Islam', 'Jl. Raya Jakarta No.4, Panancangan, Kec. Cipocok Jaya, Kota Serang, Banten', '', '2022-02-08 16:14:11', 'Aktif'),
('173210327', 'M. Farhan Muzakky ', 'Laki-laki', 'Jakarta Timur', '1997-12-04', '2', '$2y$10$8bBwzW9OFjlfm6slCAoam.u5n4EDE/IqXKOtm5fV7Z4Px8tPwyCPm', 'farhanmuzakky@student.uir.ac.id', 'farhanmuzakky@gmail.com', '081234567', '1122334455678912', 'Islam', 'Jl. Soekarno-Hatta Km26 Karangjati Kab Semarang', '', '2022-02-08 16:03:10', 'Aktif'),
('173210620', 'Farhan Nasantun ', 'Perempuan', 'Jakarta Selatan', '1998-03-03', '2', '$2y$10$B8xW34U7pHhxPIUPaw.4ieitlIK6xWr6zUp0XY69L4HmOXCmwEFwe', 'farhan@student.uir.ac.id', 'farhan@gmail.com', '081234567', '1122334455678912', 'Islam', 'Jl. Pattimura No. 20 Kebayoran Baru, Jakarta Selatan', '', '2022-02-08 15:57:47', 'Aktif'),
('173210797', 'Andiansyah Madani Nasution', 'Laki-laki', 'Pekanbaru', '1999-08-08', '2', '$2y$10$RPgGuRUBM7Zqj42z/V/su.Z.y1aMChSMUPf.L5CBql99jOw4Tkqm2', 'andiansyah@student.uir.ac.id', 'andiansyah@gmail.com', '0812345678', '1122334455678912', 'Islam', 'Jl. Syarifuddin Yoes, Komp.Perumahan Sepinggan Pratama Blok B No. 7 ', '', '2022-02-08 16:00:19', 'Aktif'),
('173310497', 'Afif Mufahdhol', 'Laki-laki', 'Jawa Timur', '1999-02-04', '3', '$2y$10$1wVzQB5aWdgFKtaZv2Fds.r.nJQZm4D1LrBTasC5xdFlyYG2KPh9u', 'afifmufadhol@student.uir.ac.id', 'afifmufadhol@gmail.com', '0812345678', '1122334455678912', 'Islam', 'Jalan Arteri Raya 17, RT 06 RW 07, Kelurahan Macanan, Kecamatan Bumiayu, Kota Surabaya, Jawa Timur', '', '2022-02-08 14:27:32', 'Aktif'),
('173310510', 'Alexander Tanpasya', 'Laki-laki', 'Batam', '1997-08-11', '3', '$2y$10$ZacBRyW/4qwFees0o.lqnuTD8bGsKFpXG.0apG9B1u7S0Fhy6bILG', 'alexander@student.uir.ac.id', 'alexander@gmail.com', '081234578', '1122334455678912', 'Islam', 'Jl. Kompleks Perkantoran Terpadu Kementerian PUPR Jl. Letjen S. Parman Blok. R2 No 1-11 Tg. Piayu Ba', '', '2022-02-08 16:05:38', 'Aktif'),
('173410779', 'Robby Dermawan', 'Laki-laki', 'Pangkalpinang', '1997-12-12', '4', '$2y$10$YwzVn/4yAlO4ZV4avC9pi.Z2P2ttoNspITt83PM/51Qu7yYT4oqXm', 'robby@student.uir.ac.id', 'robby@gmail.com', '081234567', '1122334455678912', 'Islam', 'Jl. Manunggal No. 5A Rt. 11 Desa Beluluk Kec. Pangkalan Baru-Pangkalpinang', '', '2022-02-08 16:11:35', 'Aktif'),
('173510190', 'Afrayanda Yogi', 'Laki-laki', 'Pekanbaru', '1998-10-20', '5', '$2y$10$fD4LVmwqltyy35fK2JA/mOTb6th/D3iBmuF6pJSUivkrBnoCrCzjW', 'yogi123@student.uir.ac.id', 'yogi123@gmail.com', '081234567', '1234567812345678', 'Islam', 'Jl. Ketapang Pekanbaru No. 123', '1402202219104712.jpg', '2021-11-05 07:53:59', 'Aktif'),
('173610241', 'Muhammad Andika Jalil Ishaq', 'Laki-laki', 'Kota Malang', '1999-12-12', '6', '$2y$10$78h/E6kLlmXrR1m7dvBP9O58PB9RhG4LK9Yd.U.kWYDcoqWZBQBCC', 'tu', 'andika@student.uir.ac.id', '081234567', '1122334455678912', 'Islam', 'Perumahan Elite, Jalan Vena Jati 20, RT 08 RW 10, Kelurahan Umbulrejo, Kecamatan Bumilaras, Kota Mal', '', '2022-02-08 15:51:15', 'Aktif'),
('173610788', 'Rinaldi', 'Laki-laki', 'Matraman', '1999-12-12', '6', '$2y$10$Qkz9xIYX9tyTgT3VoAc/0OvthTQUeASq6o3w8z7B0W35Xb73G6T.G', 'rinaldi@student.uir.ac.id', 'rinaldi@yahoo.co.id', '082288501234', '1122334455678912', 'Islam', 'Apartemen Mansion City Lantai 7 No. 32, Jalan Rumput Hijau Kav. 18, Matraman, Jakarta Timur', '', '2022-02-08 15:12:15', 'Aktif'),
('183110123', 'Mahasiswa', 'Perempuan', 'Duri', '2000-02-10', '1', '$2y$10$j8K30Co8AcZUakq0jwjJv.ZkyTL3KIOnE.JQTmqS6A1JNYRZsP0Hi', 'mahasiswa@student.uir.ac.id', 'mahasiswa@gmail.com', '08123456789', '1234567891234567', 'Islam', 'Jl. karya', '190220220700232.jpg', '2022-02-19 05:59:30', 'Aktif'),
('183210732', 'Naufal Yuri Prasetia', 'Laki-laki', 'Jambi', '2000-07-07', '2', '$2y$10$pqam3bHLuuaQHiC1.j7.UuNAHvx8lDmVNCPhfUErsc3OgyracLgq.', 'naufal@student.uir.ac.id', 'naufal19@gmail.com', '0812345678', '1122334455678912', 'Islam', 'Jl. R.B Siagian No. 01  kelurahan pasir putih - Kota Jambi', '', '2022-02-08 16:19:07', 'Aktif'),
('183310834', 'Helmansyah', 'Laki-laki', 'Bengkulu', '1996-05-05', '3', '$2y$10$rJ6nGB8I4nSg8uo4nht5wee/LtgtT3DutABJ8rvt.xf/M2gYZpBHG', 'helmansyah@student.uir.ac.id', 'helmansyah@gmail.com', '081234567', '1122334455678912', 'Islam', 'Jl. Ir. Rutandi Sugianto KM 12 Pulau Baai Bengkulu', '', '2022-02-08 16:08:28', 'Aktif'),
('183510228', 'Furizal', 'Laki-laki', 'Kesra', '1999-10-09', '5', '$2y$10$DKsFuPZ0fdLc8Bv4LeH1Der3xAQ13NE2hsD8K3K0oD4vw6UWQxmZK', 'furizal@student.uir.ac.id', 'furizal@gmail.com', '082386092684', '1406050909990007', 'Islam', 'Kesra RT.001 RW.003', '230220220322092.jpg', '2022-01-20 15:00:55', 'Aktif'),
('183510393', 'Nadia Rozaan', 'Perempuan', 'Duri', '2000-03-17', '5', '$2y$10$xfyieRosjmwa2GW2wKwBmO2mZd.V8.j4CEoiYPkvSsNoyzXJO9jwS', 'nadiarozaan@student.uir.ac.id', 'nadiarozaan18@gmail.com', '082288505299', '1403095703000012', 'Islam', 'Jl. Karya 1 Marpoyan Damai', '18022022201716aae39d1aca073d74cccb267ecede3bc7.jpg', '2021-10-18 17:17:02', 'Aktif'),
('183510400', 'Fitri Safnita', 'Perempuan', 'Pekanbaru', '1999-01-06', '5', '$2y$10$oVwmOhrPJnBYnqFVudvMZeSoWoj4dDQSqEyqrGqMVthkzPdlkj39m', 'fitrisafnita@student.uir.ac.id', 'fitrisafnita@gmail.com', '082297205621', '1471085601990001', 'Islam', 'jl.manunggal', '180220220654462.jpg', '2022-01-20 15:00:04', 'Aktif'),
('183510417', 'Raja Ferdian Apriliano', 'Laki-laki', 'Pekanbaru', '2000-04-06', '5', '$2y$10$WnuNWawB1Jtn3dl1YHuuKOSolIC7WpCop7OsshqMc36dBSqXBBR2S', 'rajaferdian@student.uir.ac.id', '', '082386092684', '222222222', 'Islam', 'Jl. Marpoyan', '', '2021-11-04 16:58:53', 'Aktif'),
('183510720', 'Muhammad Israq', 'Laki-laki', 'Pekanbaru', '1999-11-06', '5', '$2y$10$xfyieRosjmwa2GW2wKwBmO2mZd.V8.j4CEoiYPkvSsNoyzXJO9jwS', 'muhammadisraq@student.uir.ac.id', 'israq@yahoo.co.id', '085272993427', '1405010611990004', 'Islam', 'Perumahan Puri Air Dingin. Bukit Raya', '180220222017552.jpg', '2021-11-07 06:59:22', 'Aktif'),
('193510230', 'Chici Syafliati ', 'Perempuan', 'Perawang', '2001-07-20', '5', '$2y$10$IKzEb4T2vExIh8Un3bdWj.6VlP8KTsujyUq.nMVpdwuKN5kiuKNH.', 'chicisyafliatiputri@student.uir.ac.id', 'chicisyafliatiputri12@gmail.com', '082285209271', '1111111111111111', 'Islam', 'Kampar Kiri Hulu', '150220220436412.jpg', '2021-11-07 06:23:06', 'Aktif'),
('193510261', 'Widy Utami Adha', 'Perempuan', 'Ujung Gading', '2001-03-04', '5', '$2y$10$c6/Y2kDf5IpSTm4n3cTGRO.5eAx2bvUZO1zzQsHcbiI9Z2JmULQtO', 'widyutamiadha@student.uir.ac.id', 'widyutamiadha@yahoo.co.id', '082261681583', '1234567812345678', 'Islam', 'Indragiri Hilir', '', '2021-11-07 08:41:16', 'Aktif'),
('193510282', 'Riza Nurhasyifa', 'Perempuan', 'Pekanbaru', '2001-10-26', '5', '$2y$10$y.OgkO5iR5O2EY0xY.wucOU87fmFSqpVAhAviNvZOq2Aszoq..eb6', 'rizanurhasyifa@student.uir.ac.id', '', '082288280331', '1471106610010001', 'Islam', 'Pekanbaru', '', '2021-11-07 10:14:04', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nilai`
--

CREATE TABLE `tbl_nilai` (
  `id_nilai` int(3) NOT NULL,
  `id_syarat_sk` int(3) NOT NULL,
  `sikap` float NOT NULL,
  `pemahaman` float NOT NULL,
  `kelengkapan` float NOT NULL,
  `status_verifikasi_prodi` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nilai_kompre`
--

CREATE TABLE `tbl_nilai_kompre` (
  `id_nilai_kompre` int(11) NOT NULL,
  `id_syarat_kompre` int(11) NOT NULL,
  `posisi` varchar(40) NOT NULL,
  `npk` char(30) NOT NULL,
  `abstrak` int(11) NOT NULL,
  `saran_abstrak` text NOT NULL,
  `pendahuluan` int(11) NOT NULL,
  `saran_pendahuluan` text NOT NULL,
  `tinjauan` int(11) NOT NULL,
  `saran_tinjauan` text NOT NULL,
  `metodologi` int(11) NOT NULL,
  `saran_metodologi` text NOT NULL,
  `hasil` int(11) NOT NULL,
  `saran_hasil` text NOT NULL,
  `kesimpulan` int(11) NOT NULL,
  `saran_kesimpulan` text NOT NULL,
  `referensi` int(11) NOT NULL,
  `saran_referensi` text NOT NULL,
  `sistematika` int(11) NOT NULL,
  `saran_sistematika` text NOT NULL,
  `presentasi` int(11) NOT NULL,
  `saran_presentasi` text NOT NULL,
  `status_verifikasi_prodi` varchar(30) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nilai_sempro`
--

CREATE TABLE `tbl_nilai_sempro` (
  `id_nilai_sempro` int(11) NOT NULL,
  `id_syarat_sempro` int(11) NOT NULL,
  `posisi` varchar(40) NOT NULL,
  `npk` char(30) NOT NULL,
  `pendahuluan` int(11) NOT NULL,
  `saran_pendahuluan` text NOT NULL,
  `tinjauan` int(11) NOT NULL,
  `saran_tinjauan` text NOT NULL,
  `metodologi` int(11) NOT NULL,
  `saran_metodologi` text NOT NULL,
  `referensi` int(11) NOT NULL,
  `saran_referensi` text NOT NULL,
  `sistematika` int(11) NOT NULL,
  `saran_sistematika` text NOT NULL,
  `presentasi` int(11) NOT NULL,
  `saran_presentasi` text NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nomor_surat`
--

CREATE TABLE `tbl_nomor_surat` (
  `id_nomor_surat` int(13) NOT NULL,
  `fungsi_nomor` text NOT NULL,
  `relasi_tabel` varchar(50) NOT NULL,
  `id_relasi` int(13) NOT NULL,
  `nomor_surat` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_open_file`
--

CREATE TABLE `tbl_open_file` (
  `id_open_file` int(11) NOT NULL,
  `id_syarat_sk` int(3) NOT NULL,
  `waktu_open_file` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelaku` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `file_open` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_open_file_kompre`
--

CREATE TABLE `tbl_open_file_kompre` (
  `id_open_file_kompre` int(11) NOT NULL,
  `id_syarat_kompre` int(11) NOT NULL,
  `waktu_open_file` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelaku` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `file_open` text NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_open_file_sempro`
--

CREATE TABLE `tbl_open_file_sempro` (
  `id_open_file_sempro` int(11) NOT NULL,
  `id_syarat_sempro` int(11) NOT NULL,
  `waktu_open_file` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelaku` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `file_open` text NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_open_file_skripsi`
--

CREATE TABLE `tbl_open_file_skripsi` (
  `id_open_file` int(11) NOT NULL,
  `id_skripsi` int(3) NOT NULL,
  `waktu_open_file` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelaku` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `file_open` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembimbing_lapangan`
--

CREATE TABLE `tbl_pembimbing_lapangan` (
  `id_pembimbing_lapangan` int(3) NOT NULL,
  `id_syarat_sk` int(3) NOT NULL,
  `kepribadian` float NOT NULL,
  `kedisiplinan` float NOT NULL,
  `motivasi` float NOT NULL,
  `tanggung_jawab` float NOT NULL,
  `komitmen` float NOT NULL,
  `kerjasama` float NOT NULL,
  `keselamatan` float NOT NULL,
  `laporan` float NOT NULL,
  `status_verifikasi_prodi` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penguji_skripsi`
--

CREATE TABLE `tbl_penguji_skripsi` (
  `id_penguji_skripsi` int(11) NOT NULL,
  `id_syarat_sempro` int(11) NOT NULL,
  `npk` char(30) NOT NULL,
  `posisi` varchar(40) NOT NULL,
  `waktu_persetujuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `waktu_respon` datetime NOT NULL,
  `status_persetujuan` varchar(50) NOT NULL,
  `alasan_ditolak` text NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_persetujuan_kompre`
--

CREATE TABLE `tbl_persetujuan_kompre` (
  `id_persetujuan_kompre` int(11) NOT NULL,
  `id_syarat_kompre` int(11) NOT NULL,
  `waktu_persetujuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelaku` text NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status_persetujuan` text NOT NULL,
  `tema_persetujuan` text NOT NULL,
  `alasan_ditolak` text NOT NULL,
  `persetujuan_prodi` varchar(30) NOT NULL,
  `status` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_persetujuan_sempro`
--

CREATE TABLE `tbl_persetujuan_sempro` (
  `id_persetujuan_sempro` int(11) NOT NULL,
  `id_syarat_sempro` int(11) NOT NULL,
  `waktu_persetujuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelaku` text NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status_persetujuan` text NOT NULL,
  `tema_persetujuan` text NOT NULL,
  `alasan_ditolak` text NOT NULL,
  `status` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_persetujuan_sk`
--

CREATE TABLE `tbl_persetujuan_sk` (
  `id_persetujuan_sk` int(3) NOT NULL,
  `id_syarat_sk` int(3) NOT NULL,
  `waktu_persetujuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelaku` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status_persetujuan` varchar(50) NOT NULL,
  `tema_persetujuan` text NOT NULL,
  `alasan_ditolak` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_persetujuan_skripsi`
--

CREATE TABLE `tbl_persetujuan_skripsi` (
  `id_persetujuan_skripsi` int(3) NOT NULL,
  `id_skripsi` int(3) NOT NULL,
  `waktu_persetujuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelaku` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status_persetujuan` varchar(50) NOT NULL,
  `tema_persetujuan` text NOT NULL,
  `alasan_ditolak` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_persetujuan_surat_pengantar`
--

CREATE TABLE `tbl_persetujuan_surat_pengantar` (
  `id_persetujuan_surat_pengantar` int(3) NOT NULL,
  `id_surat_pengantar` int(3) NOT NULL,
  `waktu_persetujuan` timestamp NULL DEFAULT current_timestamp(),
  `pelaku` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status_persetujuan` varchar(25) NOT NULL,
  `alasan_ditolak` text NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_persetujuan_surat_pengantar_penelitian`
--

CREATE TABLE `tbl_persetujuan_surat_pengantar_penelitian` (
  `id_persetujuan_surat_pengantar_penelitian` int(3) NOT NULL,
  `id_surat_pengantar_penelitian` int(3) NOT NULL,
  `waktu_persetujuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelaku` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `status_persetujuan` varchar(25) NOT NULL,
  `alasan_ditolak` text NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_persetujuan_usulan_pembimbing`
--

CREATE TABLE `tbl_persetujuan_usulan_pembimbing` (
  `id_persetujuan_usulan_pembimbing` int(11) NOT NULL,
  `npk` char(30) NOT NULL,
  `id_usulan_pembimbing` int(11) NOT NULL,
  `waktu_persetujuan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_persetujuan` varchar(25) NOT NULL,
  `alasan_ditolak` text NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_sanksi`
--

CREATE TABLE `tbl_sanksi` (
  `id_sanksi` int(3) NOT NULL,
  `npm` char(9) NOT NULL,
  `penyebab` text NOT NULL,
  `sanksi` text NOT NULL,
  `waktu_mulai_sanksi` datetime NOT NULL,
  `waktu_selesai_sanksi` datetime NOT NULL,
  `waktu_input_sanksi` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_seminar`
--

CREATE TABLE `tbl_seminar` (
  `id_seminar` int(11) NOT NULL,
  `nama_seminar` varchar(30) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_seminar`
--

INSERT INTO `tbl_seminar` (`id_seminar`, `nama_seminar`, `status`) VALUES
(1, 'Seminar Proposal', 'Tersedia'),
(2, 'Sidang Akhir', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_skripsi`
--

CREATE TABLE `tbl_skripsi` (
  `id_skripsi` int(3) NOT NULL,
  `id_jenis_sk` int(3) NOT NULL,
  `npm` char(9) NOT NULL,
  `judul` text NOT NULL,
  `file_spp` text NOT NULL,
  `file_transkrip` text NOT NULL,
  `file_krs` text NOT NULL,
  `file_laporan` text NOT NULL,
  `tgl_upload` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_pengantar`
--

CREATE TABLE `tbl_surat_pengantar` (
  `id_surat_pengantar` int(3) NOT NULL,
  `npm` char(9) NOT NULL,
  `nama_instansi` text NOT NULL,
  `alamat_instansi` text NOT NULL,
  `lokasi` text NOT NULL,
  `ditujukan` text NOT NULL,
  `waktu_mulai` date NOT NULL,
  `judul_kp` text NOT NULL,
  `waktu_selesai` date NOT NULL,
  `nama_file_surat_pengantar` text NOT NULL,
  `lampiran` text NOT NULL,
  `tgl_upload_surat_pengantar` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surat_pengantar_penelitian`
--

CREATE TABLE `tbl_surat_pengantar_penelitian` (
  `id_surat_pengantar_penelitian` int(3) NOT NULL,
  `npm` char(9) NOT NULL,
  `nama_instansi` text NOT NULL,
  `alamat_instansi` text NOT NULL,
  `ditujukan` text NOT NULL,
  `judul_penelitian` text NOT NULL,
  `matakuliah` varchar(20) NOT NULL,
  `file_spp` text NOT NULL,
  `file_ktm` text NOT NULL,
  `file_sk` text NOT NULL,
  `tgl_upload_surat_pengantar_penelitian` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_syarat_kompre`
--

CREATE TABLE `tbl_syarat_kompre` (
  `id_syarat_kompre` int(11) NOT NULL,
  `id_seminar` int(11) NOT NULL,
  `npm` char(9) NOT NULL,
  `file_spp` text NOT NULL,
  `file_transkrip` text NOT NULL,
  `file_krs` text NOT NULL,
  `sertifikat_alquran` text NOT NULL,
  `sertifikat_inggris` text NOT NULL,
  `file_laporan` text NOT NULL,
  `usulan_tanggal` date NOT NULL,
  `usulan_jam` time NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_syarat_sempro`
--

CREATE TABLE `tbl_syarat_sempro` (
  `id_syarat_sempro` int(11) NOT NULL,
  `id_seminar` int(11) NOT NULL,
  `npm` char(9) NOT NULL,
  `file_krs` text NOT NULL,
  `file_spp` text NOT NULL,
  `file_proposal` text NOT NULL,
  `usulan_tanggal` date NOT NULL,
  `usulan_jam` time NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_syarat_sk`
--

CREATE TABLE `tbl_syarat_sk` (
  `id_syarat_sk` int(3) NOT NULL,
  `id_jenis_sk` int(3) NOT NULL,
  `npm` char(9) NOT NULL,
  `nama_tempat_kp` text NOT NULL,
  `judul_kerja_praktik` text NOT NULL,
  `nama_pembimbing_lapangan` text NOT NULL,
  `no_hp_pembimbing_lapangan` char(13) NOT NULL,
  `email_pembimbing_lapangan` varchar(50) NOT NULL,
  `string_random` text NOT NULL,
  `waktu_mulai_kp` date NOT NULL,
  `waktu_selesai_kp` date NOT NULL,
  `nama_file_syarat_sk` text NOT NULL,
  `file_spp_dasar` text NOT NULL,
  `file_transkrip` text NOT NULL,
  `file_laporan` text NOT NULL,
  `tgl_upload_syarat_sk` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ttd_dospem`
--

CREATE TABLE `tbl_ttd_dospem` (
  `id_ttd_dospem` int(11) NOT NULL,
  `id_relasi` int(11) NOT NULL,
  `topik_relasi` text NOT NULL,
  `id_random` text NOT NULL,
  `waktu_input_ttd` timestamp NOT NULL DEFAULT current_timestamp(),
  `nama_penanda_tangan` varchar(100) NOT NULL,
  `jabatan_penanda_tangan` text NOT NULL,
  `perihal` text NOT NULL,
  `status_validasi` varchar(50) NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_ttd_surat`
--

CREATE TABLE `tbl_ttd_surat` (
  `id_ttd_surat` int(11) NOT NULL,
  `id_relasi` int(11) NOT NULL,
  `topik_relasi` text NOT NULL,
  `id_random` text NOT NULL,
  `waktu_input_ttd` datetime NOT NULL,
  `nama_penanda_tangan` varchar(100) NOT NULL,
  `npk_penanda_tangan` char(20) NOT NULL,
  `jabatan_penanda_tangan` text NOT NULL,
  `nomor_surat` varchar(30) NOT NULL,
  `perihal` text NOT NULL,
  `status_validasi` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_usulan_pembimbing`
--

CREATE TABLE `tbl_usulan_pembimbing` (
  `id_usulan_pembimbing` int(11) NOT NULL,
  `npk` char(30) NOT NULL,
  `id_skripsi` int(11) NOT NULL,
  `waktu_persetujuan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_persetujuan` varchar(25) NOT NULL,
  `alasan_ditolak` text NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_berkas_pertemuan`
--

CREATE TABLE `tb_berkas_pertemuan` (
  `id_berkas_pertemuan` int(11) NOT NULL,
  `id_jadwal_kelas_pertemuan` varchar(50) NOT NULL,
  `nama_berkas` text NOT NULL,
  `nama_file_berkas` text NOT NULL,
  `waktu_upload_berkas_pertemuan` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_berkas_pertemuan`
--

INSERT INTO `tb_berkas_pertemuan` (`id_berkas_pertemuan`, `id_jadwal_kelas_pertemuan`, `nama_berkas`, `nama_file_berkas`, `waktu_upload_berkas_pertemuan`, `status`) VALUES
(6, '8', 'Kontrak Kuliah', '26082021055202Surat Keputusan Musyawarah.pdf', '2021-08-26 10:52:02', 'Tersedia'),
(7, '7', 'Kontrak Kuliah', '26082021055406Surat undangan musyawarah.pdf', '2021-08-26 10:54:06', 'Tersedia'),
(12, '6', 'Kontrak Kuliah', '160920211418465. BeritaAcara20210912102153(3Lembar).pdf', '2021-09-16 19:18:46', 'Tersedia'),
(14, '2', 'Kontrak Kuliah', '17092021044836Furizal_IPA6.pdf', '2021-09-17 09:48:36', 'Tersedia'),
(16, '17', 'Kontrak Kuliah', '21092021192634Furizal_IPA6.pdf', '2021-09-22 00:26:34', 'Tersedia'),
(17, '16', 'RPS', '21092021193002Khutbah Idhul Fitri.pdf', '2021-09-22 00:30:02', 'Tersedia'),
(18, '17', 'RPS', '21092021201020Furizal_AktifKuliah.pdf', '2021-09-22 01:10:20', 'Tersedia'),
(34, '18', 'RPS', '1_18_27092021162913Furizal_IPA6.pdf', '2021-09-27 21:29:13', 'Tersedia'),
(35, '22', 'RPS', '2_22_27092021212913Furizal_IPA6.pdf', '2021-09-27 21:29:13', 'Tersedia'),
(36, '2', 'RPS', '1_2_27092021162943JADWAL_CERAMAH.pdf', '2021-09-27 21:29:43', 'Tersedia'),
(37, '14', 'RPS', '2_14_27092021212943JADWAL_CERAMAH.pdf', '2021-09-27 21:29:43', 'Tersedia'),
(38, '8', 'RPS', '3_8_27092021212943JADWAL_CERAMAH.pdf', '2021-09-27 21:29:43', 'Tersedia'),
(39, '7', 'RPS', '4_7_27092021212943JADWAL_CERAMAH.pdf', '2021-09-27 21:29:43', 'Tersedia'),
(40, '6', 'RPS', '5_6_27092021212943JADWAL_CERAMAH.pdf', '2021-09-27 21:29:43', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_berkas_ujian_kelas`
--

CREATE TABLE `tb_berkas_ujian_kelas` (
  `id_berkas_ujian_kelas` int(11) NOT NULL,
  `id_jadwal_kelas_pertemuan` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `nama_berkas` text NOT NULL,
  `nama_file_berkas` text NOT NULL,
  `waktu_input_berkas` datetime NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_berkas_ujian_kelas`
--

INSERT INTO `tb_berkas_ujian_kelas` (`id_berkas_ujian_kelas`, `id_jadwal_kelas_pertemuan`, `id_ujian`, `nama_berkas`, `nama_file_berkas`, `waktu_input_berkas`, `status`) VALUES
(1, 8, 5, 'Soal Ujian', '01092021191352Jadwal adzan.pdf', '2021-09-02 00:13:52', 'Dihapus'),
(2, 2, 5, 'Soal Ujian', '01092021192539Surat undangan Maulid Nabi.pdf', '2021-09-02 00:25:39', 'Dihapus'),
(3, 8, 5, 'Soal Ujian', '01092021195528Khutbah Idhul Fitri.pdf', '2021-09-02 00:55:28', 'Dihapus'),
(4, 6, 5, 'Soal Ujian', '01092021195705Jadwal Petugas Mengawas Tadarus.pdf', '2021-09-02 00:57:05', 'Tersedia'),
(5, 8, 5, 'Soal Ujian', '10092021170629JADWAL_CERAMAH.pdf', '2021-09-10 22:06:29', 'Tersedia'),
(6, 2, 5, 'Soal Ujian', '10092021170736surat keterangan kepemilikan laptop.pdf', '2021-09-10 22:07:36', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dosen`
--

CREATE TABLE `tb_dosen` (
  `npk` char(30) NOT NULL,
  `status_jabatan` varchar(10) NOT NULL,
  `nama_dosen` varchar(50) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `kode_jurusan` char(20) NOT NULL,
  `jabatan_fungsional` varchar(50) NOT NULL,
  `pendidikan` varchar(50) NOT NULL,
  `status_dosen` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_dosen`
--

INSERT INTO `tb_dosen` (`npk`, `status_jabatan`, `nama_dosen`, `jk`, `email`, `kode_jurusan`, `jabatan_fungsional`, `pendidikan`, `status_dosen`, `password`, `foto`, `status`) VALUES
('10008076401', 'Dosen', 'Prof. Dr. Ir. H. Sugeng Wiyono,  M.M.T.', 'Laki-laki', '', '1', 'Guru Besar', 'S3', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('10016045003', 'Dosen', 'Ir. H. MASRIZAL  M.T.', 'Laki-laki', '', '1', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Dihapus'),
('10314068701', 'Dosen', 'Pandji Rachmat Setiawan, S.Kom., M.M.S.I.', 'Laki-laki', '', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$zOhTYEiPtCNk1jMUQTJRmukfur74RI2HdQ2JFzugdEHRdWOxCqJJm', '', 'Aktif'),
('11002056201', 'Dosen', 'Ir. H. FIRDAUS AGUS  M.P.', 'Laki-laki', 'agusfirdaus025@gmail.com', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '25062021014338POTO FIRDAUS.JPG', 'Aktif'),
('11004118406', 'Dosen', 'Heri Ahmadi,  S.T., M.T.', 'Laki-laki', 'heriahmadi@eng.uir.ac.id', '1', 'Non-Fungsional', 'S2', 'Dosen Tetap Program Studi', '$2y$10$gUVqFtX4yhg3jOtC9lSYvO93tpGCaGBN1OvcYDih677wHdx1s.C0u', '22062021051518Euyv1jjVcAAjG2L.jpg', 'Aktif'),
('11005057003', 'Dosen', 'Dr. Anas Puri, S.T., M.T.', 'Laki-laki', 'anaspuri@eng.uir.ac.id', '1', 'Lektor Kepala', 'S3', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '21062021012917Anas Puri-closed up.JPG', 'Aktif'),
('11006124901', 'Dosen', 'Ir. H. ARHAN WANIM  M.T.', 'Laki-laki', '', '1', 'Asisten Ahli', 'S2', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Dihapus'),
('11008037804', 'Dosen', 'Dr. H. SAPRONI, M.ED', 'Laki-laki', '', '1', 'Lektor', 'S3', 'Dosen Tetap', '$2y$10$Omm8t2Rh9.ZkqhVrX34nT.8bc0uJOdRqQVoPFbnr7ck0rfLvC8h9u', '', 'Aktif'),
('11008069501', 'Dosen', 'HENDRA SAPUTRA, M, SEI.', 'Laki-laki', '', '1', 'Non-Fungsional', 'S2', 'Dosen Tetap', '$2y$10$PSieAJRmZxJZpZPdmWSIvORcshFkTDZcKqtzhhgER/tmX1zN6oL.u', '', 'Aktif'),
('11008097501', 'Dosen', 'IDA WINDI WAHYUNI  S.Ag.  M.Si.', 'Perempuan', '', '1', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('11008118901', 'Dosen', 'ARIEF YANDRA PUTRA, S.SI., M.SI', 'Laki-laki', '', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$gjzXNr8kT4pGmCoQoUQaJukZbui2VtLnLH3DX958ENUV.qxKZzkP6', '', 'Aktif'),
('11008198203', 'Dosen', 'ROZA MILDAWATI  S.T.  M.T.', 'Perempuan', '', '1', 'Lektor', 'S2', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Dihapus'),
('11009098403', 'Dosen', 'SRI RAHAYU, S.PD., M.PD.', 'Perempuan', 'srirahayu@edu.uir.ac.id', '1', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$78NGVbBTETdwqCkUWTSHu.ykc8o1UmPGdVkaoUhdPdU8Z1tDMuXjW', '25022022154318KM2.jpg', 'Aktif'),
('11010078606', 'Dosen', 'HARIF SUPRIADY, M.A.', 'Laki-laki', '', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$DphiZmcVp/TT61tbxebVuOTWQGOjiFYVN.S2h/j8KUarGXUAd/nuG', '', 'Aktif'),
('11010127801', 'Dosen', 'HARMIYATI  S.T.  M.Si.', 'Perempuan', '', '1', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('11011016301', 'Dosen', 'Ir. H. RONY ARDIANSYAH  M.T.', 'Laki-laki', '', '1', 'Lektor Kepala', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '29102021075623RONY.jpg', 'Aktif'),
('11011076202', 'Dosen', 'Ir. H. ABDUL KUDUS ZAINI  M.T  M.S Tr.', 'Laki-laki', 'abdulkuduszaini@eng.uir.ac.id', '1', 'Lektor Kepala', 'S2', 'Dosen Tetap Program Studi', '$2y$10$KTcuNiKmb/q18w.zKUuQneCLViEkb1uxaizf861zWtts8ccw5kf8O', '1606202105073810 R.jpg', 'Aktif'),
('11012128304', 'Dosen', 'SAPITRI  S.T.  M.T.', 'Perempuan', 'spitriap@eng.uir.ac.id', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '21092021090039Photo fitri ok.jpg', 'Aktif'),
('11013066803', 'Dosen', 'Dr. ELIZAR  S.T.  M.T.', 'Perempuan', 'elizar@eng.uir.ac.id', '1', 'Lektor', 'S3', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '16062021033948Elizar Foto 1.jpg', 'Aktif'),
('11014028904', 'Dosen', 'ANGGI HANAFIAH, S.KOM., M.KOM', 'Laki-laki', '', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$IqGf0TwPqXP2Jdzdw24wbe5cdXYY0aM8Z1G3g4GGR46.bKf2lH3Ji', '', 'Aktif'),
('11015029101', 'Dosen', 'LIDIA FEBRIANTI  S.H.  M.H.', 'Perempuan', '', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('11015038302', 'Dosen', 'VELLA ANGGREANA  S.T. M.T.', 'Perempuan', '', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('11015068204', 'Dosen', 'SY. SARAH ALWIYAH  S.T.  M.T.', 'Perempuan', '', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('11016048502', 'Dosen', 'Dr. APRI SISWANTO, M.KOM', 'Laki-laki', '', '1', 'Lektor', 'S3', 'Dosen Tetap', '$2y$10$48MZ6I7j/T22l.HVCbMZm.FIMvDW7N..1kKqMKMpHjIqD2KqWoB.6', '', 'Aktif'),
('11017018001', 'Dosen', 'WILDA SRIHASTUTY HANDAYANI PILIANG, S.PD., M.PD.', 'Perempuan', 'wshandayani@edu.uir.ac.id', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$VNqp0mooP2mfKo1bOjpdk.NESY0a.R0t1iUU6yvmf3fNaqFWghB9e', '09032022025415pasfoto wilda.jpeg', 'Aktif'),
('11018017303', 'Dosen', 'Dr. YOLLY ADRIATI, S.T., M.T.', 'Perempuan', '', '1', 'Lektor', 'S3', 'Dosen Tetap Program Studi', '$2y$10$EZxbNLiu3wGwLlDb/7cuNuzDd5HKSSbE1QJPpoAJU9xHaVXwIoGES', '', 'Aktif'),
('11018129001', 'Dosen', 'ZAENAL MUTTAQIN, ST., M.SC', 'Laki-laki', '', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$TZMgoRTeHoOluhU2p6J37OVmuBGHmJWPWyUq7cRE87JL3km6B01vu', '', 'Aktif'),
('11019057901', 'Dosen', 'SRI HARTATI DEWI  S.T.  M.T.', 'Perempuan', 'srihartatidewi@eng.uir.ac.id', '1', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '10102021020800foto sri hartati.jpg', 'Aktif'),
('11019088201', 'Dosen', 'ROZA MILDAWATI  S.T.  M.T.', 'Perempuan', 'rozamildawati@eng.uir.ac.id', '1', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$Nr9BF4mh9pXJLysEtUEk6.lOEiytSOK3FCFXONeO33/DkCwf8QFOO', '', 'Aktif'),
('11023047701', 'Dosen', 'FAIZAN DALILA  S.T.  M.Si.', 'Laki-laki', '', '1', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Dihapus'),
('11025066901', 'Dosen', 'Dr. ZULKIFLI RUSBI, M.M., ME.SY.', 'Laki-laki', '', '1', 'Lektor Kepala', 'S3', 'Dosen Tetap', '$2y$10$ACQU3h71zTlC04pUdMiDcOt27zx.6ikYdaQjizWX/B/t.r85N7PxG', '', 'Aktif'),
('11026078603', 'Dosen', 'MAHADI KURNIAWAN  S.T.  M.T.', 'Laki-laki', '', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$r2xtVgf2d.9wz/rEMEDwNO0PH5YjQJNSTEOCZbF.4UC4cnY3E4bLy', '16062021025542IMG_20191015_203040_777.jpg', 'Aktif'),
('11029048803', 'Dosen', 'FIRMAN SYARIF  S.T.  M.Eng.', 'Laki-laki', '', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('11030088801', 'Dosen', 'BISMI ANNISA  S.T.  M.T.', 'Perempuan', '', '1', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('1212130602460', 'Pegawai', 'EKA KUSUMA DEWI, S.T.', 'Perempuan', '', '1', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$w8bG8r/qEUsNTp/jxeLqcexvyjbkoH0NsWMmT.6YlyuD.af/3bj9e', '', 'Aktif'),
('121314121994', 'Pegawai', 'Rizky Ahmad Santoso, S.T.', 'Laki-laki', '', '1', 'Non-Fungsional', 'S1', 'Dosen Tidak Tetap', '$2y$10$0PnHxm2lsIEybxExRfrt2eHR2d1n5DtyBXWd6pQ0NiNw50ENjXnH.', '', 'Aktif'),
('1213191002852', 'Pegawai', 'Rachmat Hidayat, S.T.', 'Laki-laki', '', '1', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$dDgHShV5vCj7Kl.4ZyZ8oucAyx.nkLho8aX08FRhthw87w00cmIei', '', 'Aktif'),
('121330051993', 'Pegawai', 'Dara Anggraini, S.T.', 'Perempuan', '', '1', 'Non-Fungsional', 'S1', 'Dosen Tidak Tetap', '$2y$10$0R1TWgFE.BHIpNaykS.QDeHUXOcngZiWFfdU0sM4CQGespYs2u43C', '', 'Aktif'),
('1215190402735', 'Pegawai', 'Miswarti, S.T., M.T.', 'Perempuan', '', '1', 'Staff Pegawai', 'S2', 'Dosen Tidak Tetap', '$2y$10$cuFUBeljSSMx4GGCX/x/MO.IU.EFPX57JrzgeEEVb6n3iQvUOQS.O', '', 'Aktif'),
('122022041983', 'Pegawai', 'Ratna Pratama, S.H.', 'Perempuan', '', '1', 'Non-Fungsional', 'S1', 'Dosen Tidak Tetap', '$2y$10$O9NqDC37WvUcNkOvRuAx/u6BQoV1kiLrrM5nQ0oCd1Ndf7KbBz6Ce', '', 'Aktif'),
('1221961997', 'Pegawai', 'Siti Khozidah, S.T.', 'Perempuan', '', '1', 'Non-Fungsional', 'S1', 'Dosen Tidak Tetap', '$2y$10$3qUh9ROprBdQolkBj5dayOhyLj8JTz8qz0MCiFLx.HjcwAQIzBssq', '', 'Aktif'),
('1335210702885', 'Pegawai', 'HARFI ANANTRI NUGRAHA, S.T.', 'Laki-laki', '', '1', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$t5BQeygQt1napiDwoZgZEuA1S27OmHZYGgKOVf7FTqYbrMV3UVYRW', '', 'Aktif'),
('15555', 'Dosen', 'Zaenal Muttaqin, ST., M.Sc', 'Laki-laki', '', '1', 'Asisten Ahli', 'S2', '', '$2y$10$Nl77L6ZftHVw5f4KPC6eh.xZlU7tE54yDRxhVtXs68o.noYN8H9k6', '', 'Dihapus'),
('20102121975', 'Dosen', 'RAFIQ ADRIANSYAH, S.Kom., M.P.', 'Laki-laki', '', '2', '', '', '', '$2y$10$5GS35UXptXc0U5rDJM8cp.CKkDP2ewGwJABTvnypP0CnipH4YiGFq', '', 'Aktif'),
('20112011986', 'Dosen', 'Dr. FAJRIL AMBIA, S.T., M.T.', 'Laki-laki', '', '2', 'Non-Fungsional', 'S3', 'Dosen Tidak Tetap', '$2y$10$SZcjBUY7cPZJe5t3Vbty6uyur5DGtWzVm8k4Qh.FNTbnt3OqLoq.i', '', 'Aktif'),
('20213121979', 'Dosen', 'Dr. ANDRI LUTHFI LUKMAN HAKIM, M.T.', 'Laki-laki', '', '2', 'Non-Fungsional', 'S3', 'Dosen Tidak Tetap', '$2y$10$9QvobCQEKpZnDxIkXKmNzup8eaWr8dsOu2I/s7e7SUGqQV0XPYr/2', '', 'Aktif'),
('20304091976', 'Dosen', 'Dr. AHMAD FAUZI HADAD', 'Laki-laki', '', '2', 'Non-Fungsional', 'S3', 'Dosen Tidak Tetap', '$2y$10$958nswNUhQ/Fq3Oq5AzDN..4SrbnmmzxHRZWzrS4RgwbQkXYnE5VS', '', 'Aktif'),
('21001118101', 'Dosen', 'Dr. Eng. ADI NOVRIANSYAH  S.T.  M.T.', 'Laki-laki', '', '2', 'Non-Fungsional', 'S3', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21003058103', 'Dosen', 'AZMANSYAH  S.E.  M.Ec.', 'Laki-laki', '', '2', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21004079401', 'Dosen', 'RIZKY WANDRI, S.Kom., M.Kom.', 'Laki-laki', '', '2', 'Asisten Ahli', 'S2', '', '$2y$10$kWOYRsIiRI7B2ji.N6cRB.9EScRz9P5fXOA2H0mtT1kcFsaM2gN3a', '', 'Aktif'),
('21005047603', 'Dosen', 'Dr. DEDIKARNI, S.T., M.Sc.', 'Laki-laki', '', '2', 'Lektor', 'S3', '', '$2y$10$rZ6B7l.hZR5v1HFs86Uk4ehL5QL7QdzOe2zMil/AQOxuymF4ftXke', '', 'Aktif'),
('21005107603', 'Dosen', 'M. ARIYON  S.T.  M.T.', 'Laki-laki', '', '2', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21006118301', 'Dosen', 'NOVIA RITA  S.T.  M.T.', 'Perempuan', '', '2', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$noek9993dudp8sYHhsb.LOLHYlOQDg6dnmHTI6fSfR08UvlA/bYdq', '', 'Aktif'),
('21007108201', 'Dosen', 'ISMAIL AKZAM  S.Pd.  M.A.', 'Laki-laki', '', '2', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21008057102', 'Dosen', 'Dr. KURNIA HASTUTI, S.T. M.T.', 'Perempuan', '', '2', 'Lektor', 'S3', '', '$2y$10$ONtLY1SJOurzg3i2kHQrLuVztpH07OOEJwTq12xe02I/acXQEyFWC', '', 'Aktif'),
('21009097501', 'Dosen', 'FITRIANTI  S.T.  M.T.', 'Perempuan', '', '2', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$afYxyh5zSrcH4cDeY.LoV.MHMiJiVdXUoqe4YO0FpHEgoWxgI9GkC', '', 'Aktif'),
('21009098801', 'Dosen', 'AULIA STEPHANI, S.Pd., M.Pd.', 'Perempuan', '', '2', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$zteORNBAcqTx8taECrPpv.Pnu39IlTnvRqno8lxAW2wE2jK3NLIne', '', 'Aktif'),
('21010048904', 'Dosen', 'TOMI ERFANDO  S.T.  M.T.', 'Laki-laki', '', '2', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$dsQ8qlHzYUu2rUYQlC4aIeFoTorG9eylspZcJ424Mpkw1XWlP6YWy', '', 'Aktif'),
('21011088304', 'Dosen', 'AGUS DAHLIA  S.Si.  M.Si.', 'Perempuan', '', '2', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21011089101', 'Dosen', 'UMI MUSLIKHAH  S.H.  M.H.', 'Perempuan', '', '2', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21012048802', 'Dosen', 'ASNAWI, S.Pd., M.Pd.', 'Laki-laki', '', '2', 'Lektor', 'S2', '', '$2y$10$HTcDpdoGMxspvSwutkGhEOoId.KuIDRsQc.L7DaTU7/HxrQiY8ZNC', '', 'Aktif'),
('21012068702', 'Dosen', 'ENDANG ISTIKOMAH  S.Pd.  M.Ed.', 'Perempuan', '', '2', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21013056902', 'Dosen', 'Dr. MURSYIDAH  M.Sc.', 'Perempuan', '', '2', 'Lektor', 'S3', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21014028904', 'Dosen', 'ANGGI HANAFIAH S.Kom. M.Kom.', 'Laki-laki', '', '2', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$s.52W0sIMa9ekloByQQ.NOEWepSLjWwvspEfYVY2oy5doqIM7VGEG', '', 'Aktif'),
('21015019202', 'Dosen', 'AYYI HUSBANI  S.T.  M.T.', 'Perempuan', '', '2', 'Non-Fungsional', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21015047503', 'Dosen', 'SRI LISTIA ROSA S.T. M.Sc.', 'Perempuan', '', '2', 'Asisten Ahli', 'S2', '', '$2y$10$AKJHO.7BF.8ZlhlGkOYtDeakbX/T4woIPwXLdpMZNAyZSYJM7vqNe', '', 'Aktif'),
('21016047901', 'Dosen', 'Dr. Eng. MUSLIM  M.T.', 'Laki-laki', '', '2', 'Lektor Kepala', 'S3', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '20092021040619Foto Bang Muslim Untuk SiPA.jpg', 'Aktif'),
('21016048502', 'Dosen', 'Dr. APRI SISWANTO S.Kom. M.Kom.', 'Laki-laki', '', '2', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$YmIdtcAhdmPk2USbHfcPn.8o0Kl5ANnuukEVVpOMwxzr3Hjh9OC/S', '', 'Aktif'),
('21018088201', 'Dosen', 'NENENG PURNAMAWATI  S.T.  M.Eng.', 'Perempuan', 'nenengpurnamawati@eng.uir.ac.id', '2', 'Non-Fungsional', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '21092021073547IMG_4857_dit DK.JPG', 'Aktif'),
('21020077102', 'Dosen', 'Dr. SRI YULIANI,  M.Pd.', 'Perempuan', '', '2', 'Lektor', 'S3', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21021058901', 'Dosen', 'LINTANG NUR AGIA, S.E., M.Acc.,Ak. ', 'Perempuan', '', '2', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$IAxUZN0SNw2.NQF5jPob..LofzCLjdlxZ4V0QMRgYmvdypUbj1n.6', '', 'Aktif'),
('21021088201', 'Dosen', 'RICHA MELYSA, S.T., M.T.', 'Perempuan', 'richamelysa@eng.uir.ac.id', '2', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '22092021091928pas fhoto uir.jpeg', 'Aktif'),
('21023027904', 'Dosen', 'SALAWATI  S.Pd.I.  M.A TESOL.', 'Perempuan', '', '2', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21023116201', 'Dosen', 'Ir. EDDON MUFRIZON  M.T.', 'Laki-laki', '', '2', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21024078902', 'Dosen', 'FIKI HIDAYAT  S.T.  M.Eng.', 'Laki-laki', 'fikihidayat@eng.uir.ac.id', '2', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$fAOjQ/uj728m29HQJ4MTd.OqPTwm8c97so8TVhwZx0gNsrZflmJ3m', '20092021075937Prof Pict Fiki_siPA.png', 'Aktif'),
('21025118802', 'Dosen', 'SINDI AMELIA, S.Pd., M.Pd.', 'Perempuan', 'sindiamelia88@edu.uir.ac.id', '2', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$0G7QnP.TnYcwv/M2k19k7.FB.MgQXl0r673As7OCv0VgrVW616pIm', '', 'Aktif'),
('21027069201', 'Dosen', 'MUHAMMAD KHAIRUL AFDHOL  S.T.  M.T.', 'Laki-laki', 'afdhol@eng.uir.ac.id', '2', '', '', '', '$2y$10$LJbeGiDR/MnsUFSw3M7MnePXKyxgNbnaR8wrwHctrm45Pqy5wFz9G', '23062021074654FOTO - Copy.jpg', 'Aktif'),
('21027118403', 'Dosen', 'NOVRIANTI  S.T.  M.T.', 'Perempuan', '', '2', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21029038403', 'Dosen', 'IDHAM KHALID  S.T.  M.T.', 'Laki-laki', '', '2', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('21029118805', 'Dosen', 'RESTU HAYATI, S.E., M.Si.', 'Perempuan', '', '2', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$8db/YmkD1zgje0ojVmDKX.eDRMlp6uPkycH.MEY9JuUuHjF6075TO', '', 'Aktif'),
('21031126801', 'Dosen', 'AKMAR EFENDI S.Kom. M.Kom.', 'Laki-laki', '', '2', 'Lektor', 'S2', '', '$2y$10$t3Yu2PDAP3mAg7HAyHAEGu1OZ7VKXc7m4Zk9t/asmwStkQs2vs.1e', '28092021010407Foto2892021.JPG', 'Aktif'),
('21234567891', 'Dosen', 'testing S.T M.T', 'Perempuan', '', '2', 'Lektor Kepala', 'S2', 'Dosen Tetap Program Studi', '$2y$10$j.lSnI2OeZHvsRtcoZG88exPkHYiMBjPEjAls/T0kguDnjIm2pSUq', '', 'Aktif'),
('2330210702886', 'Pegawai', 'BAYU HARPANI, S.T.', 'Laki-laki', '', '2', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$EtYq8vlXnXVmBt0MlIje8.uVZ1sRWZ3DJgX7OKPgTRT6Lq/p7HRbK', '', 'Aktif'),
('2335191002829', 'Pegawai', 'AL AFIF RAMDHANI, S.T.', 'Laki-laki', '', '2', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$W1g5I6.LafPOYnMpdTFF4OX9Qb3t8Zn.DRFndCkkzSL/xDvZcLMym', '', 'Aktif'),
('2336210702885', 'Pegawai', 'HARFI ANANTRI NUGRAHA, S.T.', 'Laki-laki', 'harfi_nugraha@staff.uir.ac.id', '2', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$J/olNb3ZB1CjqbfYwZS5J.2WcMJrcFMEJxwTiYhonSsV7yPQSd5em', '24032022040259b2c2bcc5-d9a8-461a-8e51-83714d9f1841.jpg', 'Aktif'),
('233709061997', 'Pegawai', 'Siti Khozidah, S.T.', 'Perempuan', '', '2', 'Non-Fungsional', 'S1', 'Dosen Tidak Tetap', '$2y$10$ehmmQJmh11aRhZvJsNjAfuYbWyW8AJcoFAeTe7/eEtgkYfaVMlVxS', '', 'Aktif'),
('2338130602460', 'Pegawai', 'EKA KUSUMA DEWI, S.T.', 'Perempuan', '', '2', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$jYoUFJ9o6vyGa7Euu5NGaO9qmEOWzGKxA12jT9lpld16MldBkD91K', '', 'Aktif'),
('28820423419', 'Dosen', 'DIKE FITRIANSYAH PUTRA  M.Sc.  M.BA.', 'Laki-laki', '', '2', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$dZLbJhExp5U9..Kfq1yfy.fGspYGQYy8fxnwE3XoNGEpmDV8dX7cy', '27092021165448Profile_MB (3).jpg', 'Aktif'),
('28856211019', 'Dosen', 'Ir. H. ALI MUSNAL  M.T.', 'Laki-laki', '', '2', 'Lektor Kepala', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('3 1008058901', 'Dosen', 'FITRI MAIRIZKI, S.Si, M.Si', 'Perempuan', '', '3', 'Lektor', 'S2', '', '$2y$10$L2I7PRvzepyP/1IDSozt1O3Bt84CBEcbwU0OQtgJfFhpJ4e7ewnyW', '', 'Dihapus'),
('3 1014066501', 'Dosen', 'IR. SISWO PRANOTO, MT.', 'Laki-laki', '', '3', 'Lektor', 'S2', '', '$2y$10$XcCsOlsMfWYthBno1LhoSeb/xss.v.NBotcBvsJNTvJ39gznsvjpK', '', 'Dihapus'),
('300200561009', 'Dosen', 'Dr. OKI CANDRA, M.Pd.', 'Laki-laki', 'okicandra@edu.uir.ac.id', '3', 'Lektor', 'S3', 'Dosen Tetap', '$2y$10$8xROz1RSgtF3zgZUstZZvOcfaT8WFrnEMfKAkkg6EdGhKkzf9wmLa', '22092021133810FOTO OC.jpg', 'Aktif'),
('30023045901', 'Dosen', 'Dr. Hj. Syofianis Ismail., M.Ed', 'Perempuan', '', '3', 'Lektor Kepala', 'S3', 'Dosen Tetap', '$2y$10$JcCSHsVCIb24pBS36DP6auyrx03ricSv.LO03hLNWvoYuOk8f355e', '', 'Aktif'),
('30027075901', 'Dosen', 'Ir. IRWAN ANWAR  M.T.', 'Laki-laki', 'irwan.anwar@eng.uir.ac.id', '3', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$U2bp9J.TScMPBrdSrtx/I.FUmBWdwklbZIttXGUOUac9qA3.F7aiS', '24092021094827JAS NON PECI -3x4 edit.jpg', 'Aktif'),
('31002036501', 'Dosen', 'Ir. SYAWALDI  M.Sc.', 'Laki-laki', '', '3', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Dihapus'),
('31002129301', 'Dosen', 'RIEZA ZULRIAN ALDIO  B.Eng. M. Sc.', 'Laki-laki', '', '3', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$oEknyigs14ZdZ91uRjkU1.MnZBWouQFAaYlUEmtM/Sjh0mNjs847y', '', 'Aktif'),
('31005017502', 'Dosen', 'Dr. YUDI KRISMEN  S.H.  M.H.', 'Laki-laki', 'yudikrismen@soc.uir.ac.id', '3', 'Asisten Ahli', 'S3', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '15122021024712foto bapak.jpg', 'Aktif'),
('31005047603', 'Dosen', 'Dr. DEDIKARNI  S.T.  M.Sc.', 'Laki-laki', '', '3', 'Lektor', 'S3', 'Dosen Tetap Program Studi', '$2y$10$gNq3cxJIwMuHW6fvshaOnemRCVrVCWmU1TL7vgevyGutT7ntmU3my', '', 'Aktif'),
('31007118701', 'Dosen', 'MUSADDAD HARAHAP, S,Pd.I., M, Pd.I.', 'Laki-laki', '', '3', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$fDjZejtORn7QdbwN4.915OlUIrgu63r2lW1mc5HLZSYTFP3A1qfM6', '', 'Aktif'),
('31007126801', 'Dosen', 'Dr. ZULHERMAN IDRIS, S.H., M.H.', 'Laki-laki', '', '3', 'Lektor Kepala', 'S3', 'Dosen Tetap', '$2y$10$JZSAlNaQ5NqsAX5Lv2Xmo.ASx007sSkiXh.AFGcpaDvzzfT1iwAAy', '', 'Aktif'),
('31008037804', 'Dosen', 'Dr. H. SAPRONI  M.Ed.', 'Laki-laki', 'safroni.ahmad@edu.uir.ac.id', '3', '', '', '', '$2y$10$grrX1bkkUhBdJtI6oCyUyuIBrmxLjOPzkjkQwhd8SFhksR7MQvg7m', '26062021013734foto saproni.png', 'Aktif'),
('31008057102', 'Dosen', 'Dr. KURNIA HASTUTI  S.T.  M.T.', 'Perempuan', '', '3', 'Lektor', 'S3', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('31008058901', 'Dosen', 'FITRI MAIRIZKI, S.Si, M.Si', 'Perempuan', '', '3', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$H0/Ddgvt6MakNMmRDcdeveYWjYfjJLIH96VnyLTD/0G1wWSH3nc1a', '', 'Aktif'),
('31009038504', 'Dosen', 'JHONNI RAHMAN  B.Eng., M.Eng., Ph.D.', 'Laki-laki', 'jhonni_rahman@eng.uir.ac.id', '3', 'Lektor', 'S3', 'Dosen Tetap Program Studi', '$2y$10$mQGEvcoRI9ToRhYqr3CUouLwB2nc8VgClGryYcyHPkZ16JB0M7942', '22062021073033JR - small size.jpg', 'Aktif'),
('31010105701', 'Dosen', 'Dr. YUSUF AHMAD, M.A', 'Laki-laki', '', '3', 'Lektor', 'S3', 'Dosen Tetap', '$2y$10$8CrDMu5i.p70rLYengczY./.Qr/SzTmbdLk8vVexK81FpHPZTLREq', '', 'Aktif'),
('31010127502', 'Dosen', 'SEHAT ABDI S  S.T.  M.T.', 'Laki-laki', '', '3', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('3101170702678', 'Pegawai', 'ENGKUS KUMIADI, S.T.', 'Laki-laki', '', '3', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$pejmP7zY6aQTNKXdeDGVsuxkIc744bxBpsGhpreh6I8CjaagE3m9C', '', 'Aktif'),
('31014066501', 'Dosen', 'IR. SISWO PRANOTO, MT.', 'Laki-laki', 'siswopranoto@ymail.com', '3', 'Lektor', 'S2', 'Dosen Tidak Tetap', '$2y$10$SQ7qtCXQumWFUA0BBZeD1eQTZq7.RzCUSMadM71fy1bBznx63sDOW', '22092021120825Foto.jpg', 'Aktif'),
('31016048502', 'Dosen', 'Dr. APRI SISWANTO, M.KOM', 'Laki-laki', '', '3', 'Lektor', 'S3', 'Dosen Tetap', '$2y$10$OQrExHQfzXl0aArryQ7fiexezd5SNXwtXcJcpUOqY.Y8pWLUb/NVS', '', 'Aktif'),
('31018117803', 'Dosen', 'Dr. PRIMA WAHYU TITISARI', 'Perempuan', 'pw.titisari@edu.uir.ac.id', '3', 'Asisten Ahli', 'S3', 'Dosen Tetap', '$2y$10$6qziHrXdLREmORHABHFmJuJyqoH5rGgL.uKKgsfVPneyX3cuuOUqa', '', 'Aktif'),
('31020077102', 'Dosen', 'Dr. SRI YULIANI  M.Pd.', 'Perempuan', '', '3', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('31025057501', 'Dosen', 'EDDY ELFIANO  S.T.  M.Eng.', 'Laki-laki', 'eddy_elfiano@eng.uir.ac.id', '3', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('31028108902', 'Dosen', 'RAFIL ARIZONA  S.T.  M.Eng.', 'Laki-laki', '', '3', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$6RGNFGuCKfDn1TTI/DORDuHmmmzB85V8RiN/UkFkDejJtQWZ4EoGS', '16062021034014rafil.jpg', 'Aktif'),
('31029027601', 'Dosen', 'Dr. EVIZAL ABDUL KADIR, S.T., M,Eng.', 'Laki-laki', '', '3', 'Lektor', 'S3', 'Dosen Tetap', '$2y$10$up5m6ItnJqCkUK/wYyoNfOlp0.MXHLZtfJYxRhv2bDhm0FHjWEMbm', '', 'Aktif'),
('31029077302', 'Dosen', 'DODY YULIANTO  S.T.  M.T.', 'Laki-laki', '', '3', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('31030048902', 'Dosen', 'RAHMA QUDSI  S.Pd.  M.Mat.', 'Perempuan', '', '3', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('31030058202', 'Dosen', 'RAIHANA, SH., MA', 'Perempuan', 'raihana@fis.uir.ac.id', '3', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$QhRNsJ5IT1cP4iLS4YitpuVwBbis4Vuk6uTPEwI8tor.1xQcJX0xe', '07102021053558foto rere ok 1.jpg', 'Aktif'),
('3103191002855', 'Pegawai', 'Mas Efendi, S.T.', 'Laki-laki', '', '3', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$MqPNVQnIuhgVdo4DtduOD.1yuLvs8tMUyvEc2UPM18dMCfeLwpYua', '', 'Aktif'),
('3103461998', 'Pegawai', 'Shandy Kurniadi, S.T.', 'Laki-laki', 'shandykurniadi0406@gmail.com', '3', 'Non-Fungsional', 'S1', 'Dosen Tidak Tetap', '$2y$10$zWpc3lOOVV6oZdTcUU4zMOmVq1Q2aTd2A8wkbecrOx6VpGDH4Zknu', '30032022085018Untitled_design__14_-removebg-preview (1).jpg', 'Aktif'),
('3104191002022', 'Pegawai', 'SOLIHIN, S.T.', 'Laki-laki', '', '3', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$5/dgwPkMPxp.SUwVdeWxzOHhXVku9/xTlznT2AdNyp24eyh.zs8Sq', '', 'Aktif'),
('3104191002827', 'Pegawai', 'NOVRY HARRYADI, S.T.', 'Laki-laki', '', '3', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$/rzwfZhqHd80XHjfx1C8GOr0qYJCeYZHu5m/nKTZ4wXIj9N6I97pK', '01042022055757NOVRY HARRYADI ST(1).jpg', 'Aktif'),
('3123456', 'Dosen', 'DR EVIZAL  ABDUL KADIR, ST., M,ENG', 'Laki-laki', '', '3', 'Lektor', 'S3', '', '$2y$10$YcblJP/r9wUFFWI8FAse1.jZeG84q1KPQY7/SRzdXb3Cu/FqBfJDe', '', 'Dihapus'),
('33304091994', 'Dosen', 'Ari Prasetyo, S.T., M.Eng.', 'Laki-laki', 'iniakunari@gmail.com', '3', 'Non-Fungsional', 'S2', 'Dosen Tetap', '$2y$10$DUESqLLeINWfdYAGM4Ia7OX/pj.rVbQL5/uXk1gFICj7lXN5xU4ZC', '22022022102209Ari Prasetyo bg putih.jpg', 'Aktif'),
('34423', 'Dosen', 'DR PRIMA WAHYU TITISARI', 'Laki-laki', '', '3', 'Lektor', 'S3', '', '$2y$10$IusG98SUc2y0D5BRKS6JluBPsEhppTFW9S4XpdY9kRt0ynJ5cBu7S', '', 'Dihapus'),
('39910006706', 'Dosen', 'Ir. SUTAN LAZRISYAH M.T.', 'Laki-laki', 'lazrisyah@eng.uir.ac.id', '3', 'Non-Fungsional', 'S2', 'Dosen Tetap Program Studi', '$2y$10$7duFkvn5xBhmrBPgHEeuV.vngvfP/H4UQQtnRO60YiAN4jXuNNeXa', '', 'Aktif'),
('3ariprasetyo', 'Dosen', 'ARI PRASETYO, S.T., M.Eng', 'Laki-laki', 'iniakunari@gmail.com', '3', 'Non-Fungsional', 'S2', 'Dosen Tetap', '$2y$10$IwYCJF1c7kx57zTufOFO2O32Ci/yopwcwa99A.t8nxTjhS15dqokG', '21022022083559Ari Prasetyo bg putih.jpg', 'Dihapus'),
('3cyintia', 'Dosen', 'CYINTIA, S.PD., M.PD', 'Perempuan', '', '3', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$wG4mqxR8JqK1NU/CONDfKO.4wSBFG4.0IYzVk5rXbsyl5xrFHoQqO', '', 'Aktif'),
('3syofianisismail', 'Dosen', 'Dr. SYOFIANIS ISMAIL, M.ED', 'Perempuan', '', '3', 'Lektor', 'S3', 'Dosen Tetap', '$2y$10$H6zhoD32z8zk2Da1K9ve.eSrslmJS0WuVkhOgCf3HRlCcBSTk2h9S', '', 'Dihapus'),
('40015017101', 'Dosen', 'Dr. SRI REZEKI  S.Pd.  M.Si.', 'Perempuan', '', '4', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('40721117702', 'Dosen', 'Dr. KHULAIFIYAH, S.Pd,. M.Pd.', 'Perempuan', 'khulaifiyah@edu.uir.ac.id', '4', 'Lektor', 'S3', 'Dosen Tidak Tetap', '$2y$10$x9bR.VWqwDkCqAs26nJl6.umibZIBAlMqwggc8SnoxX8H8XTd23U.', '16022022043432khulaifiyah.jpeg', 'Aktif'),
('41002056201', 'Dosen', 'Ir. H. FIRDAUS AGUS  M.P.', 'Laki-laki', 'agusfirdaus025@gmail.com', '4', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '22062021005108POTO FIRDAUS.JPG', 'Aktif'),
('41004079401', 'Dosen', 'RIZKY WANDRI, S.Kom., M.Kom.', 'Laki-laki', '', '4', 'Non-Fungsional', 'S2', '', '$2y$10$LFWY2UjxPvvmrR2VOT7gnu2m0Ya1l2AAWwmykm4hgSY/mjmtAczJS', '', 'Aktif'),
('41005038401', 'Dosen', 'MIRA HAFIZHAH  TANJUNG  S.T.  M.Sc.', 'Perempuan', '', '4', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('41005068201', 'Dosen', 'Dr. MIRANTI EKA PUTRI  S.Pd.  M.Ed.', 'Perempuan', '', '4', 'Lektor', 'S3', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('41008108303', 'Dosen', 'MUHAMMAD SOFWAN  S.T.  M.T.', 'Laki-laki', 'muhammad.sofwan@eng.uir.ac.id', '4', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$ulelZvIXLjIUXTpKvWMHnObj1OAJ5OSjQl3/5PUDPwrIG.GOxmtx2', '16062021070523Foto 3x4 very small size.jpg', 'Aktif'),
('41012049201', 'Dosen', 'DIAN TRI UTAMI, S.Pd., M.Pd.', 'Perempuan', '', '4', 'Asisten Ahli', 'S2', '', '$2y$10$JDxqiPBFwmhp3XgmC8mfqOWLxkfNJ9d1EPuWXaqvwoceqzXKHYFrG', '', 'Aktif'),
('41013078302', 'Dosen', 'H. ALFITRI  Lc.  M.Pd.', 'Laki-laki', 'alfitri2018@fis.uir.ac.id', '4', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$yf1Vv5L7Dz.QomQGE1Dmn.bbT48.RekO68jd0MUbgQZoivgQRAXk6', '', 'Aktif'),
('41018019103', 'Dosen', 'ADE WAHYUDI  S.T.  M.T.', 'Laki-laki', 'adewahyudi@eng.uir.ac.id', '4', 'Non-Fungsional', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '21062021044935Foto 2.jpg', 'Aktif'),
('41018028601', 'Dosen', 'RONA MULIANA  S.T.  M.T.', 'Perempuan', '', '4', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('41018097702', 'Dosen', 'PUJI ASTUTI  S.T.  M.T.', 'Perempuan', 'pujiastutiafrinal@eng.uir.ac.id', '4', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '20062021073524foto Tuti.jpg', 'Aktif'),
('41019057202', 'Dosen', 'Dr. ZAFLIS ZAIM,  S.T.  M. Eng.', 'Laki-laki', 'zaflis@eng.uir.ac.id', '4', 'Lektor', 'S3', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '16062021032148Foto Zaflis 2014.jpg', 'Aktif'),
('41023047701', 'Dosen', 'FAIZAN DALILA  S.T.  M.Si.', 'Laki-laki', '', '4', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$UXyL/sIXY0rhYYjFk1jQd.v0n0c6fNBJA6Te2RpGoOYGyu4O0JyZq', '21062021014848Foto Fai.jpg', 'Aktif'),
('41024078802', 'Dosen', 'IDHAM NUGRAHA  S.Si.  M.Si.', 'Laki-laki', '', '4', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('41028067803', 'Dosen', 'FEBBY ASTERIANI  S.T  M.T.', 'Perempuan', '', '4', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('41028089501', 'Dosen', 'ARIF RAHMAN HAKIM, S.IP., M.Tr.IP.', 'Laki-laki', '', '4', 'Asisten Ahli', 'S2', '', '$2y$10$CFnH/Wtc2HpYdjDeY0LfMepd0izfdb2L7CUqB8pi4ixkkICic2cDm', '', 'Aktif'),
('41029088701', 'Dosen', 'HERMALIZA, S.Pd., M.Pd.', 'Perempuan', '', '4', 'Asisten Ahli', 'S2', '', '$2y$10$cmEvU4/ZnP5m31Y7QJvUY.rmjw/A5GSIHQdUWPcNAoqasYJaqHYtG', '', 'Aktif'),
('41029098302', 'Dosen', 'SEPTA JULIANA, S.Sos., M.Si.', 'Perempuan', '', '4', 'Non-Fungsional', 'S2', 'Dosen Tetap', '$2y$10$8pc14QeG/zdJ9MnwfkdOy.solMVvULIvf0SyDv8ycDI2cpSMFRQsu', '', 'Aktif'),
('41030046903', 'Dosen', 'Dr. APRIYAN DINATA  M.Env.', 'Laki-laki', '', '4', 'Lektor', 'S3', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('41030048902', 'Dosen', 'RAHMA QUDSI  S.Pd.  M.Mat.', 'Perempuan', '', '4', 'Asisten Ahli', 'S2', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('41030127104', 'Dosen', ' Dr. PANCASETYO PRIHATIN, S.Ip., M.Si.', 'Laki-laki', '', '4', 'Lektor', 'S3', '', '$2y$10$flobCq7oLLsAIZ15Vaf/PewS7E8YUxbibsIjDrtgjjdDkVJowH5Ku', '', 'Aktif'),
('41104540101', 'Dosen', 'Drs. SUDARMO HASAN  M.A.', 'Laki-laki', '', '4', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('4312781999', 'Pegawai', 'Erza Guspita Sari, S.T.', 'Perempuan', '', '4', 'Non-Fungsional', 'S1', 'Dosen Tidak Tetap', '$2y$10$sfZSr3aheLOQDRgw/LwSwOuBPPYAc4ZyWd1q.HSy96pIt37eNm3d.', '', 'Aktif'),
('4313891996', 'Pegawai', 'Thalia Amanda Putri, S.T.', 'Perempuan', '', '4', 'Non-Fungsional', 'S1', 'Dosen Tidak Tetap', '$2y$10$9w6Y4w94qMWqKn2O9Cvi5u/IlAg2t08rQH6Mk5K/FJ9FDJsI4KBpS', '', 'Aktif'),
('5000', 'Dosen', 'DR DRS M YUSUF AHMAD, MA', 'Laki-laki', '', '5', 'Lektor', 'S3', '', '$2y$10$XISeyXRQucn5bTBdRFd2dOP1DnpseX1g12EXXS8dF6WATUOLTEiRC', '', 'Dihapus'),
('50007027807', 'Dosen', 'NITA RIMAYANTI  M.Comm. xyz', 'Perempuan', 'nita.rimayanti@gmail.com', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$xCXz2NKCrHVPaa0TsnOyZulD67mOL2c.4NWP/V.ADO/lRkfnbleEm', '', 'Aktif'),
('50009088102', 'Dosen', 'NESI SYAFITRI  S.Kom.  M.Cs.', 'Perempuan', 'nesisyafitri@eng.uir.ac.id', '5', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$L1YzIoJGUp.ImoKvKibSr.3My8MazU55eBk/lfBBAqpx30zUW010e', '', 'Aktif'),
('50015017101', 'Dosen', 'Dr. SRI REZEKI  S.Pd.  M.Si.', 'Perempuan', '', '5', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Dihapus'),
('50130061988', 'Dosen', 'HASNELY S.Kom. M.Eng', 'Perempuan', 'a@a.com', '5', '', '', '', '$2y$10$HJDrK50zl1EDYJyGdQHT2OevnoWGBy0Yetq5RCa6ONPIg8iQqzbs6', '', 'Dihapus'),
('50131101992', 'Dosen', 'OCTADINO HARYADI, S.Kom., M.Kom.', 'Laki-laki', 'octadelano@gmail.com', '5', 'Non-Fungsional', 'S2', 'Dosen Tetap Program Studi', '$2y$10$nTROfnqrRJBJ01RFnQyL0uGsyFxiK6Kb2XO32ahAGQoOw9sjJx1ai', '07122021005024Pas Foto OK.jpg', 'Aktif'),
('50216021993', 'Dosen', 'M RIZKI FADHILAH, S.T., M.Eng', 'Laki-laki', 'mrizkifadhilah@gmail.com', '5', '', '', '', '$2y$10$bEWksWuP/KDAJiwNHrQU4OhnBQvN08JbO9Pz/xdZUvqs2p/QXx/oG', '', 'Dihapus'),
('50225051994', 'Dosen', 'MUTIA FADHILLA, S.S.T., M.Sc.', 'Perempuan', 'mutifadhilla@gmail.com', '5', 'Non-Fungsional', 'S2', 'Dosen Tetap Program Studi', '$2y$10$YpcgTw8.N9iSo21J4b86cuHv8F7BhfNhWmg5Y/aDvjghyS.tyHIPq', '2709202109122308_Pas Poto.jpg', 'Aktif'),
('50314068701', 'Dosen', 'PANJI RACHMAT SETIAWAN  S.Kom.  MMSI.', 'Laki-laki', '', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('50318021995', 'Dosen', 'MIFTAHUR RACHMAN, S.H., M.Kn', 'Laki-laki', '', '5', 'Asisten Ahli', 'S2', '', '$2y$10$b6cQFKohLnQ9JoMvTX5AZuNyCe.QYS16Zj6WgPKSLMvssVf.n09qe', '', 'Dihapus'),
('51002118702', 'Dosen', 'LEO ADHAR EFFENDI, S. Pd., M. Pd', 'Laki-laki', 'leo.ae@edu.uir.ac.id', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$/gsb2dMomOoR2q6cKivRGuRaF35dgncdKUrM1vzcs6OBtBRhpUPcC', '', 'Aktif'),
('51003087703', 'Dosen', 'HENDRA GUNAWAN, S.T., M.Eng.', 'Laki-laki', '', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$AJc3QsEX/0xrsZ6JCQyR/.RDdfll4IUOca2yasO3s3e3bEC6IYXTy', '', 'Aktif'),
('51004067405', 'Dosen', 'Alucyana, M.Psi', 'Perempuan', '', '5', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$13erQGRrOj0LEAiI12GCTuCXmv0YNMsLt7no0PlF/7cRB0AEykUT6', '', 'Aktif'),
('51004079401', 'Dosen', 'RIZKY WANDRI,  S.Kom.,  M.Kom.', 'Laki-laki', 'rizkywandri@eng.uir.ac.id', '5', 'Non-Fungsional', 'S2', 'Dosen Tetap Program Studi', '$2y$10$HczVocoKqGH464rLzSdExeJH/v3T6k9pltRQuHuu.sfrxuHAMjBJu', '', 'Aktif'),
('51007058402', 'Dosen', 'ABDUL SYUKUR  S.Kom.  M.Kom.', 'Laki-laki', '', '5', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('51007126802', 'Dosen', 'ZULHERMAN IDRIS  S.H.  M.H.  Ph.D.', 'Laki-laki', '', '5', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Dihapus'),
('51008037703', 'Dosen', 'HENDRA GUNAWAN  S.T.  M.Eng.', 'Laki-laki', '', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Dihapus'),
('51009098801', 'Dosen', 'AULIA STHEPHANI  M.Pd.', 'Perempuan', '', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$hPIphCrSrn2WhqYy.w7LguCKBy6y2uZVRc72I97VbG.ID39R6MEFS', '', 'Aktif'),
('51010059101', 'Dosen', 'PUTRI NURAINI  SE Sy.  M.E.', 'Perempuan', 'putrinuraini@fis.uir.ac.id', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '11012022035056poto untuk cv.jpeg', 'Aktif'),
('51010068102', 'Dosen', 'Dr. FATMAWATI  S.IP.  M.M.', 'Perempuan', 'fatmawatikaffa@comm.uir.ac.id', '5', 'Lektor', 'S3', 'Dosen Tetap', '$2y$10$znyBnsRdoK1Ojp/VOF32UuB9TnWr9EKp/o6jAFvZXon4QUS7EpP32', '', 'Aktif'),
('51010105701', 'Dosen', 'DR. DRS. M. YUSUF AHMAD, MA.', 'Laki-laki', '', '5', 'Lektor', 'S3', 'Dosen Tetap', '$2y$10$UBDtaWpzWalrA5grtGLHAubqLWpJ2fUmN9S5CXXm4Xp2oM5mBQIl6', '', 'Aktif'),
('51011039001', 'Dosen', 'WIRA ATMA HAJRI, S.H., M.H.', 'Laki-laki', '', '5', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$BRrApsCZxDTKWPajj4V3aeXabMwo0Oei7Ak0/22.RHclEeID0y3Ni', '', 'Aktif'),
('51011088304', 'Dosen', 'AGUS DAHLIA, S.Si., M.Si.', 'Perempuan', '', '5', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$Mxwyuay1DTlqTC6KkoLtA.yT70ex6m6U4cvWHhUe/knoL1l6F1ELG', '', 'Aktif'),
('51013018201', 'Dosen', 'Najmi Hayati. S.Pd.I M.Ed', 'Perempuan', 'annajmi.edu@gmail.com', '5', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$R2W6Um.T08rybK0SfqXPOuE1bxJr9bCrzDYxNg2nQhfWQ0js8Snyy', '16022022051008photo.jpg', 'Aktif'),
('51013068101', 'Dosen', 'WIDE MULYANA  S.Kom.  M.M.S.I.', 'Laki-laki', 'wdmulyana@gmail.com', '5', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '16062021023500Foto_Wide_Mulyana-min.JPG', 'Dihapus'),
('51013078302', 'Dosen', 'H. ALFITRI  Lc.  M.Pd.', 'Laki-laki', '', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('51014028904', 'Dosen', 'ANGGI HANAFIAH  S.Kom.  M.Kom.', 'Laki-laki', 'anggihanafiah@eng.uir.ac.id', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('51015047503', 'Dosen', 'SRI LISTIA ROSA  S.T.  M.Sc.', 'Perempuan', 'srilistiarosa@eng.uir.ac.id', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('51016029301', 'Dosen', 'M RIZKI FADHILAH, S.T., M.Eng.', 'Laki-laki', '', '5', 'Non-Fungsional', 'S2', 'Dosen Tetap', '$2y$10$VG3gksYylR7fcAK1/cABs.yzkIDD7G8jNIhHaIMt/cy0k8kulIshS', '', 'Aktif'),
('51016048502', 'Dosen', 'Dr. APRI SISWANTO  S.Kom.  M.Kom.', 'Laki-laki', 'aprisiswanto@eng.uir.ac.id', '5', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$bR7iibkosz/S.URRYPi7NuLG7dbsFypzvVlv6XVNhXWbrOhH3E.tG', '16062021031802apri oke.jpg', 'Aktif'),
('51017018001', 'Dosen', 'WILDA SRIHASTUTY HANDAYANI PILIANG, S.Pd., M.Pd.', 'Perempuan', 'wshandayani@edu.uir.ac.id', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$2UpjwDWezf5gieRClh/NiOFvITbCLmAGijnG84a4S9IuqEK0s/QHW', '14102021053736pasfoto wilda.jpeg', 'Aktif'),
('51017049002', 'Dosen', 'RIZDQI AKBAR RAMADHAN  S.Kom.  M.Kom.', 'Laki-laki', '', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$N0X199SMqlpfZkTtZnpDl.DYPYDX2klzNit3RSJzLFSdW7tW94aFK', '1701202206494712410589_10205091292753473_7780528969235457718_n.jpg', 'Aktif'),
('51017049102', 'Dosen', 'FEBBY APRI WENANDO  S.Pd.  M.Eng.', 'Laki-laki', '', '5', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Dihapus'),
('51018088102', 'Dosen', 'AUSE LABELLAPANSA  S.T.  M.Cs.  M.Kom.', 'Perempuan', '', '5', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('51020038101', 'Dosen', 'Dr. ARYO AKBAR, S.H., M.H.', 'Laki-laki', '', '5', 'Asisten Ahli', 'S3', 'Dosen Tetap', '$2y$10$xMUyzkKO4UwZ.o/AA78AluQkhHpfC9m3An/uR8TeAF22rzcIFHafy', '22092021070400Resolusi Rendah Cropped.jpg', 'Aktif'),
('51020048803', 'Dosen', 'SITTI HADIJAH  S.Pd.  M.Pd.', 'Perempuan', '', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('51021038901', 'Dosen', 'Dr. LILIS MARINA ANGRAINI, M.Pd.', 'Perempuan', '', '5', 'Lektor', 'S3', 'Dosen Tetap', '$2y$10$aFEwht02t474HOW1F24Rpu3UclwJSHM.nsojKS6QGfLKUasMZFRTK', '', 'Aktif'),
('51023027904', 'Dosen', 'SHALAWATI, S.Pd.I., M.A TESOL', 'Perempuan', 'shalawati@edu.uir.ac.id', '5', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$/zXNXiouklE2OnjTgSqNFuGo6lBs8nc9y1ojlUoYtP2tuXgUr7jVe', '08102021023900shalawati_pct.jpg', 'Aktif'),
('51023048901', 'Dosen', 'Dr. ARBI HAZA NASUTION  B.IT(Hons).  M.IT.', 'Laki-laki', '', '5', 'Lektor', 'S3', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('51024077901', 'Dosen', 'ANA YULIANTI  S.T.  M.Kom.', 'Perempuan', 'ana.yulianti@eng.uir.ac.id', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '09102021130700bu anna bg putih edit.jpg', 'Aktif'),
('51025078002', 'Dosen', 'RAHDIANSYAH, S.H, M.H.', 'Laki-laki', 'rahdiansyah@law.uir.ac.id', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$u.C10.CuyfrT4N4na0teOOHU326/i1jpyPfMBMwHGSuZD5S0FNoI2', '20092021091420Rahdiansyah Pasfoto Latar Biru 1 (1).jpg', 'Aktif'),
('51025118802', 'Dosen', 'SINDI AMELIA  S.Pd.  M.Pd.', 'Perempuan', 'sindiamelia88@edu.uir.ac.id', '5', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$OL1vOJKUh6NTIm5pQ4g6wOucvDvgb1M/cMHqUi2LzFfLFUXQJLlaS', '', 'Aktif'),
('51026068702', 'Dosen', 'YENNI YUNITA  S.Pd.I.  M.Pd.I.', 'Perempuan', '', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('51026126801', 'Dosen', 'Ir. DES SURYANI  M.Sc.', 'Perempuan', '', '5', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('51026128207', 'Dosen', 'Sri Arlina, S.H., M.H', 'Perempuan', 'sriarlina@law.uir.ac.id', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$EGeKM9aXKoRoClLSbAnTS.Z7Qysj7eQKL8bV5ptyd.GBj3UAE5B8y', '23022022110150Sri Arlina_4.jpg', 'Aktif'),
('51029027601', 'Dosen', 'Dr. EVIZAL ABDUL KADIR  S.T.  M.Eng.', 'Laki-laki', 'evizal@eng.uir.ac.id', '5', 'Lektor', 'S3', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('51029078701', 'Dosen', 'YUDHI ARTA  S.T.  M.Kom.', 'Laki-laki', 'yudhiarta@eng.uir.ac.id', '5', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '19102021110120Yudhi Arta Putih2.jpg', 'Aktif'),
('51030048404', 'Dosen', 'Selvi Harvia Santri, S.H., M.H', 'Perempuan', '', '5', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$TbzZKDfnNNxLIxeJ8Op7fuaQD6y893mkbxITghZA9NTJLi1GoEvI2', '', 'Aktif'),
('51030048902', 'Dosen', 'RAHMA QUDSI, S.Pd., M.Mat', 'Perempuan', '', '5', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$I9MtqhfshncrAKEVEgLeTevXojaUjCmPhzp.EPmzyYa7KUmiBd53O', '', 'Aktif'),
('51031126801', 'Dosen', 'AKMAR EFENDI  S.Kom.  M.Kom.', 'Laki-laki', '', '5', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$6nvVnQ9R16cWihgFegRJs.TNqCj5AxaG5o3dTdGNL.prW1oZJOyuq', '20092021012152Foto.JPG', 'Aktif'),
('5123', 'Dosen', 'Rahma Qudsi, S.Pd., M.Mat', 'Perempuan', '', '5', 'Asisten Ahli', 'S2', '', '$2y$10$q7nVFI8K9dHDWSWlNvpn8eaoCZe1ySqGDUanKfnJuaBk6tB9PPzBm', '', 'Dihapus'),
('51234', 'Dosen', 'Agus Dahlia, S.Si., M.Si', 'Laki-laki', '', '5', 'Asisten Ahli', 'S2', '', '$2y$10$fQgCz7i4rt1iZ0xfheLXTuDjxfg9nQcH.2LpjiyT9XS4IorFQR686', '', 'Dihapus'),
('512345', 'Dosen', 'Dr. Lilis Marina Angraini, M. Pd ', 'Perempuan', '', '5', 'Lektor', 'S3', '', '$2y$10$UYpkJaJXTPIqiq7801GRYO/cGbyYzzucF2slYUmdQqp5Nu2ADfakW', '', 'Dihapus'),
('5123456', 'Dosen', 'DR. ARYO AKBAR, SH., MH', 'Laki-laki', '', '5', 'Lektor', 'S3', '', '$2y$10$XDXq.RNvR7oiyiap2XM/3.vyY6l5SA.KyE5RjRnWeA/GRc9xQbpHW', '', 'Dihapus'),
('51243', 'Dosen', 'RAHDIANSYAH, SH.,MH', 'Laki-laki', '', '5', 'Asisten Ahli', 'S2', '', '$2y$10$IRgvwTcyo1NSoXHMR1UCAuIzDEodVQtM./aKah0yrIgutl4kN8r2W', '', 'Dihapus'),
('513191002820', 'Pegawai', 'APRIYAN FITRA, S.T.', 'Laki-laki', '', '5', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$dhOKswSEQGr.1YgPqbagOORVsVJyu8/P.Cz9RjEknX9HE4YsVSxUa', '', 'Aktif'),
('514190102745', 'Pegawai', 'ANDI MOHD YUSUF, S.T.', 'Laki-laki', '', '5', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$O.TmIH56lJ4w1gC/0C4hae0UDSn2VisOsK/Spq4jlGB0EJuz0pUD.', '', 'Aktif'),
('51522PK0101006', 'Pegawai', 'NUR\'AINAANI DARMA, S.T.', 'Perempuan', '', '5', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$8dvIuskaRdKu0TD0RGruL.s9utw5o8E6ekwq31/rrEiF62ozke5hm', '', 'Aktif'),
('516191002829', 'Pegawai', 'AL AFIF RAMDHANI, S.T.', 'Laki-laki', '', '5', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$13dE7K/DepYhakaWiT0t5.oQYXp4ravVwojAVllAnpsht4ehmFuVK', '', 'Aktif'),
('517210702885', 'Pegawai', 'HARFI ANANTRI NUGRAHA, S.T.', 'Laki-laki', '', '5', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$/CpNqKPoMkF8mvOSKeSH8eYp284nqBmdp2Z0cIg/IQFR.ky0HVFq.', '', 'Aktif'),
('521 PK 06 08 004', 'Dosen', 'Leo Adhar Effendi, S. Pd., M. Pd ', 'Laki-laki', '', '5', 'Asisten Ahli', 'S2', '', '$2y$10$9/WBxLGo1g3iORgW06oniepBIH.KPhEtn9ILDMN11VitLgZzSdycS', '', 'Dihapus'),
('52119058701', 'Dosen', 'SARMADHAN LUBIS  M. Pd. I.', 'Laki-laki', '', '5', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Dihapus'),
('54444', 'Dosen', 'WILDA SRIHASTUTY HANDAYANI, S.PD., M.PD', 'Perempuan', '', '5', 'Asisten Ahli', 'S2', '', '$2y$10$ey71rdulxOM.WaPTIwyza.3yyjUWrgFhWTsJj8Rp8K1.2nWUS4xbi', '', 'Dihapus'),
('550131101992', 'Dosen', 'OCTADINO HARYADI, S.Kom., M.Kom.', 'Laki-laki', '', '5', 'Asisten Ahli', 'S2', '', '$2y$10$fYdnFgTCkFFpRovkYEQyL.49e.mNSJj/r/JtLCl5oRNRmJ6IKAfuy', '', 'Dihapus'),
('55555', 'Dosen', 'WIRA ATMA HAJRI, SH., MH', 'Laki-laki', '', '5', 'Asisten Ahli', 'S2', '', '$2y$10$gt1ErU.MYpRL0nlf4AwuuuwoUYtXmVXPVI4ClIx4xQpo9uvoyxOWy', '', 'Dihapus'),
('55555555555', 'Dosen', 'Furizal', 'Laki-laki', '', '5', '', '', '', '$2y$10$soObm/MUaauRZTXSqUZSYOAy1NXQ2X1EfnAjs8h5xl5m0G5oouzlG', '20092021024651200kb.jpg', 'Dihapus'),
('60011048304', 'Dosen', 'EFI SUSANTI, S.E., M.Acc.', 'Perempuan', '', '6', 'Asisten Ahli', 'S2', '', '$2y$10$0EJ.tElMDbinZJqaBbq93.LHscP5PFr3IUaQf0ZHfDvgHW6xE7oYy', '', 'Aktif'),
('60109011990', 'Dosen', 'MUHAMMAD HABIBI, ST., MT', 'Laki-laki', '', '6', 'Non-Fungsional', 'S2', '', '$2y$10$BxcSVg7T.xRgVbzUZ8n.C.LUMEPR1hDkpvmqpGqXZ4xLloD2cseKW', '', 'Aktif'),
('61003068503', 'Dosen', 'YUNIARTI YUSKAR  S.T.  M.T.', 'Perempuan', '', '6', 'Lektor', 'S2', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('61004058603', 'Dosen', 'TIGGI CHOANJI  S.T.  M.T.', 'Laki-laki', '', '6', 'Lektor', 'S2', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('61007108201', 'Dosen', 'ISMAIL AKZAM  S.Pd.  M.A.', 'Laki-laki', '', '6', 'Asisten Ahli', 'S2', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('61008058901', 'Dosen', 'FITRI MAIRIZKI  S.Si.  M.Si.', 'Perempuan', '', '6', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('61008097501', 'Dosen', 'IDA WINDI WAHYUNI  S.Ag.  M.Si.', 'Perempuan', '', '6', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('61009098403', 'Dosen', 'SRI RAHAYU, M.Pd.', 'Perempuan', '', '6', 'Lektor', 'S2', '', '$2y$10$jhs4yVL2j4841UbwGeRVW..Bil/7QS1NZfTC9bmPnrypsJztJtcaW', '21102021065754KM2.jpg', 'Aktif'),
('61010118403', 'Dosen', 'BUDI PRAYITNO  S.T.  M.T.', 'Laki-laki', '', '6', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$jPOxs8ANAIq7X.VSgPmOMec0GI55MbzUCHqp4i5s0J30QCTnu4kpC', '', 'Aktif'),
('61012068702', 'Dosen', 'ENDANG ISTIKOMAH  S.Pd.  M.Ed.', 'Perempuan', '', '6', 'Lektor', 'S2', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '09112021053620Foto Iis Beckgraound Merah.jpg', 'Aktif'),
('61012078704', 'Dosen', 'NUR HADZIQOH, S.Si., M.Si.', 'Perempuan', '', '6', 'Asisten Ahli', 'S2', 'Dosen Tetap Program Studi', '$2y$10$JsrL2PeAFBzr2be9aS9LaeXCpMdQTTeMNRMSxXUwNSwzhQXBMuK1O', '', 'Aktif'),
('61013056902', 'Dosen', 'Dr. MURSYIDAH, M.Sc.', 'Perempuan', '', '6', 'Lektor', 'S3', 'Dosen Tetap', '$2y$10$mkxRV7vpJe7noyhvHcjEFOc5ih7uMool.UYWw0QxUQoxUJrMgRCw2', '', 'Aktif'),
('61014028602', 'Dosen', 'HUSNUL KAUSARIAN  Ph.D.', 'Laki-laki', '', '6', 'Lektor Kepala', 'S3', 'Dosen Tetap Program Studi', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('61020047501', 'Dosen', 'FIRMAN EDIGAN  S.Si.  M.Pd.', 'Laki-laki', '', '6', '', '', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('61020077102', 'Dosen', 'Dr. SRI YULIANI  M.Pd.', 'Perempuan', '', '6', 'Lektor Kepala', 'S3', 'Dosen Tetap', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('61021128902', 'Dosen', 'DEWANDRA BAGUS EKA PUTRA  B.Sc(Hons).  M.Sc.', 'Laki-laki', '', '6', 'Asisten Ahli', 'S2', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('61021128903', 'Dosen', 'CATUR CAHYANINGSIH  B.Sc (Hons).  M.Sc.', 'Perempuan', '', '6', 'Lektor', 'S2', '', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('61022028702', 'Dosen', 'HIDAYATUN NUR, S.Pd., M.Pd.', 'Perempuan', '', '6', '', '', '', '$2y$10$Uq4Z/2QyC9njnBATOXqK7OOMHoyxbbG1RI/Wws/gfFGCmVHwnib6W', '', 'Aktif'),
('61023099301', 'Dosen', 'ADI SURYADI  B.Sc(Hons).  M.Sc.', 'Laki-laki', '', '6', 'Lektor', 'S2', 'Dosen Tetap Program Studi', '$2y$10$wyZviQMY3O7PeT.CEBBT1uvDuItUWYQ4n3wdQq8bTgbbAFFNZ44JK', '', 'Aktif'),
('61026118801', 'Dosen', 'RIKY NOVARIZAL, S.Sos., M.Krim.', 'Laki-laki', 'riky.novarizal@soc.uir.ac.id', '6', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$2T3HWjuL2taOlSCjVlJO2uTF9.ZsFEHtEp79g42o7lG1ZrjSYv4Ne', '24102021082244A-compress1.jpg', 'Aktif'),
('61029048803', 'Dosen', 'FIRMAN SYARIF, S.T., M.Eng.', 'Laki-laki', '', '6', 'Asisten Ahli', 'S2', 'Dosen Tetap', '$2y$10$FD75Oa0V4YO4f1eos2KV7esPxBcGRavEBJQKmG9J/HVpZ5QPEBECS', '', 'Aktif'),
('61031126801', 'Dosen', 'AKMAR EFENDI, S.Kom., M.Kom.', 'Laki-laki', '', '6', 'Lektor', 'S2', '', '$2y$10$cnNfD2Rm1xuPSzVsNPDNK.ggOqvkWd0K7C/qYM.VINO3QgOiI.rtO', '20092021012730Foto.JPG', 'Aktif'),
('624101982361', 'Dosen', 'WILDANTO PUTERA NUSANTARA, S.T., M.Si.', 'Laki-laki', '', '6', 'Non-Fungsional', 'S2', 'Dosen Tidak Tetap', '$2y$10$34NH.jFHvOJhMSABQWAzEejBzFWZXsaji2ADllCrqLCjLtcgP6MXy', '', 'Aktif'),
('628021975361', 'Dosen', 'YORDI NUGRAHADI, S.T., M.T.', 'Laki-laki', '', '6', 'Non-Fungsional', 'S2', 'Dosen Tidak Tetap', '$2y$10$aNKCpEYCCl60VYvP.jdccuxx9c8XhrsSsyDjKT03kai.qDOh6Bry.', '', 'Aktif');
INSERT INTO `tb_dosen` (`npk`, `status_jabatan`, `nama_dosen`, `jk`, `email`, `kode_jurusan`, `jabatan_fungsional`, `pendidikan`, `status_dosen`, `password`, `foto`, `status`) VALUES
('630051985361', 'Dosen', 'SATIA GRAHA, S.T., M.T.', 'Laki-laki', '', '6', 'Non-Fungsional', 'S2', 'Dosen Tidak Tetap', '$2y$10$TFhPGEgMaLC9mi08CAv.8.B9tCM58EKAVYIgcFM2yduW/QDsQWnYi', '', 'Aktif'),
('6327241999', 'Pegawai', 'BELILA MARSELA, S.T.', 'Perempuan', '', '6', 'Non-Fungsional', 'S1', 'Dosen Tidak Tetap', '$2y$10$or0qiIGyudUC52CDGG6mh.mOkk.FM6hALJwFRcZq/4zEoeCvxOria', '', 'Aktif'),
('6328210702886', 'Pegawai', 'BAYU HARPANI, S.T.', 'Laki-laki', '', '6', 'Staff Pegawai', 'S1', 'Dosen Tidak Tetap', '$2y$10$KFeREGriA8JKQciNVpTQ8ev888lKhtjnt0ZiPaV0HAEc5./AIxi2K', '', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_dosen_lanjutan`
--

CREATE TABLE `tb_dosen_lanjutan` (
  `id_dosen_lanjutan` int(11) NOT NULL,
  `npk` char(30) NOT NULL,
  `jabatan_fungsional` varchar(50) NOT NULL,
  `pendidikan` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_dosen_lanjutan`
--

INSERT INTO `tb_dosen_lanjutan` (`id_dosen_lanjutan`, `npk`, `jabatan_fungsional`, `pendidikan`, `status`) VALUES
(1, '10008076401', 'Lektor Kepala', 'S3', 'Tersedia'),
(2, '10016045003', 'Lektor', 'S3', 'Tersedia'),
(3, '11002056201', 'Lektor Kepala', 'S3', 'Tersedia'),
(4, '11004118406', 'Lektor', 'S3', 'Tersedia'),
(5, '11005057003', 'Asisten Ahli', 'S3', 'Tersedia'),
(6, '11006124901', 'Lektor', 'S3', 'Tersedia'),
(7, '11008097501', 'Lektor Kepala', 'S3', 'Tersedia'),
(8, '11008198203', 'Lektor', 'S3', 'Tersedia'),
(9, '11010127801', 'Lektor', 'S3', 'Tersedia'),
(10, '11011016301', 'Lektor Kepala', 'S3', 'Tersedia'),
(11, '11011076202', 'Lektor', 'S3', 'Tersedia'),
(12, '11012128304', 'Lektor', 'S3', 'Tersedia'),
(13, '11013066803', 'Lektor', 'S3', 'Tersedia'),
(14, '11015029101', 'Lektor', 'S3', 'Tersedia'),
(15, '11015038302', 'Lektor', 'S3', 'Tersedia'),
(16, '11015068204', 'Lektor', 'S3', 'Tersedia'),
(17, '11018129001', 'Lektor', 'S3', 'Tersedia'),
(18, '11019057901', 'Lektor', 'S3', 'Tersedia'),
(19, '11023047701', 'Lektor', 'S3', 'Tersedia'),
(20, '11026078603', 'Lektor', 'S3', 'Tersedia'),
(21, '11029048803', 'Lektor', 'S3', 'Tersedia'),
(22, '11030088801', 'Lektor', 'S3', 'Tersedia'),
(23, '20102121975', 'Lektor', 'S3', 'Tersedia'),
(24, '21001118101', 'Lektor', 'S3', 'Tersedia'),
(25, '21003058103', 'Lektor', 'S3', 'Tersedia'),
(26, '21005107603', 'Lektor', 'S3', 'Tersedia'),
(27, '21006118301', 'Lektor', 'S3', 'Tersedia'),
(28, '21007108201', 'Lektor', 'S3', 'Tersedia'),
(29, '21009097501', 'Lektor', 'S3', 'Tersedia'),
(30, '21010048904', 'Lektor', 'S3', 'Tersedia'),
(31, '21011088304', 'Lektor', 'S3', 'Tersedia'),
(32, '21011089101', 'Lektor', 'S3', 'Tersedia'),
(33, '21012068702', 'Lektor', 'S3', 'Tersedia'),
(34, '21013056902', 'Lektor', 'S3', 'Tersedia'),
(35, '21015019202', 'Lektor', 'S3', 'Tersedia'),
(36, '21016047901', 'Lektor', 'S3', 'Tersedia'),
(37, '21018088201', 'Lektor', 'S3', 'Tersedia'),
(38, '21020077102', 'Lektor', 'S3', 'Tersedia'),
(39, '21021088201', 'Lektor', 'S3', 'Tersedia'),
(40, '21023027904', 'Lektor', 'S3', 'Tersedia'),
(41, '21023116201', 'Lektor', 'S3', 'Tersedia'),
(42, '21024078902', 'Lektor', 'S3', 'Tersedia'),
(43, '21027069201', 'Lektor', 'S3', 'Tersedia'),
(44, '21027118403', 'Lektor', 'S3', 'Tersedia'),
(45, '21029038403', 'Lektor', 'S3', 'Tersedia'),
(46, '28820423419', 'Lektor', 'S3', 'Tersedia'),
(47, '28856211019', 'Lektor', 'S3', 'Tersedia'),
(48, '30027075901', 'Lektor', 'S3', 'Tersedia'),
(49, '31002036501', 'Lektor', 'S3', 'Tersedia'),
(50, '31002129301', 'Lektor', 'S3', 'Tersedia'),
(51, '31005017502', 'Lektor', 'S3', 'Tersedia'),
(52, '31005047603', 'Lektor', 'S3', 'Tersedia'),
(53, '31008037804', 'Lektor', 'S3', 'Tersedia'),
(54, '31008057102', 'Lektor', 'S3', 'Tersedia'),
(55, '31009038504', 'Lektor', 'S3', 'Tersedia'),
(56, '31010127502', 'Lektor', 'S3', 'Tersedia'),
(57, '31020077102', 'Lektor', 'S3', 'Tersedia'),
(58, '31025057501', 'Lektor', 'S3', 'Tersedia'),
(59, '31028108902', 'Lektor', 'S3', 'Tersedia'),
(60, '31029077302', 'Lektor', 'S3', 'Tersedia'),
(61, '31030048902', 'Lektor', 'S3', 'Tersedia'),
(62, '39910006706', 'Lektor', 'S3', 'Tersedia'),
(63, '40015017101', 'Lektor', 'S3', 'Tersedia'),
(64, '41002056201', 'Lektor', 'S3', 'Tersedia'),
(65, '41005038401', 'Lektor', 'S3', 'Tersedia'),
(66, '41005068201', 'Lektor', 'S3', 'Tersedia'),
(67, '41008108303', 'Lektor', 'S3', 'Tersedia'),
(68, '41013078302', 'Lektor', 'S3', 'Tersedia'),
(69, '41018019103', 'Lektor', 'S3', 'Tersedia'),
(70, '41018028601', 'Lektor', 'S3', 'Tersedia'),
(71, '41018097702', 'Lektor', 'S3', 'Tersedia'),
(72, '41019057202', 'Lektor', 'S3', 'Tersedia'),
(73, '41023047701', 'Lektor', 'S3', 'Tersedia'),
(74, '41024078802', 'Lektor', 'S3', 'Tersedia'),
(75, '41028067803', 'Lektor', 'S3', 'Tersedia'),
(76, '41030046903', 'Lektor', 'S3', 'Tersedia'),
(77, '41030048902', 'Lektor', 'S3', 'Tersedia'),
(78, '41104540101', 'Lektor', 'S3', 'Tersedia'),
(79, '50007027807', 'Lektor', 'S3', 'Tersedia'),
(80, '50009088102', 'Lektor', 'S3', 'Tersedia'),
(81, '50015017101', 'Lektor', 'S3', 'Tersedia'),
(82, '50130061988', 'Lektor', 'S3', 'Tersedia'),
(83, '50216021993', 'Lektor', 'S3', 'Tersedia'),
(84, '50314068701', 'Lektor', 'S3', 'Tersedia'),
(85, '50318021995', 'Lektor', 'S3', 'Tersedia'),
(86, '51004079401', 'Lektor', 'S3', 'Tersedia'),
(87, '51007058402', 'Lektor', 'S3', 'Tersedia'),
(88, '51007126802', 'Lektor', 'S3', 'Tersedia'),
(89, '51008037703', 'Lektor', 'S3', 'Tersedia'),
(90, '51009098801', 'Lektor', 'S3', 'Tersedia'),
(91, '51010059101', 'Lektor', 'S3', 'Tersedia'),
(92, '51010068102', 'Lektor', 'S3', 'Tersedia'),
(93, '51013068101', 'Lektor', 'S3', 'Tersedia'),
(94, '51013078302', 'Lektor', 'S3', 'Tersedia'),
(95, '51014028904', 'Lektor', 'S3', 'Tersedia'),
(96, '51015047503', 'Lektor', 'S3', 'Tersedia'),
(97, '51016048502', 'Lektor', 'S3', 'Tersedia'),
(98, '51017049002', 'Lektor', 'S3', 'Tersedia'),
(99, '51017049102', 'Lektor', 'S3', 'Tersedia'),
(100, '51018088102', 'Lektor', 'S3', 'Tersedia'),
(101, '51020048803', 'Lektor', 'S3', 'Tersedia'),
(102, '51023027904', 'Lektor', 'S3', 'Tersedia'),
(103, '51023048901', 'Lektor', 'S3', 'Tersedia'),
(104, '51024077901', 'Lektor', 'S3', 'Tersedia'),
(105, '51025118802', 'Lektor', 'S3', 'Tersedia'),
(106, '51026068702', 'Lektor', 'S3', 'Tersedia'),
(107, '51026126801', 'Lektor', 'S3', 'Tersedia'),
(108, '51029027601', 'Lektor', 'S3', 'Tersedia'),
(109, '51029078701', 'Lektor', 'S3', 'Tersedia'),
(110, '51031126801', 'Lektor', 'S3', 'Tersedia'),
(111, '52119058701', 'Lektor', 'S3', 'Tersedia'),
(112, '55555555555', 'Lektor', 'S3', 'Tersedia'),
(113, '60109011990', 'Lektor', 'S3', 'Tersedia'),
(114, '61003068503', 'Lektor', 'S3', 'Tersedia'),
(115, '61004058603', 'Lektor', 'S3', 'Tersedia'),
(116, '61007108201', 'Lektor', 'S3', 'Tersedia'),
(117, '61008058901', 'Lektor', 'S3', 'Tersedia'),
(118, '61008097501', 'Lektor', 'S3', 'Tersedia'),
(119, '61010118403', 'Lektor', 'S3', 'Tersedia'),
(120, '61012068702', 'Lektor', 'S3', 'Tersedia'),
(121, '61014028602', 'Lektor', 'S3', 'Tersedia'),
(122, '61020047501', 'Lektor', 'S3', 'Tersedia'),
(123, '61020077102', 'Lektor', 'S3', 'Tersedia'),
(124, '61021128902', 'Lektor', 'S3', 'Tersedia'),
(125, '61021128903', 'Lektor', 'S3', 'Tersedia'),
(126, '61023099301', 'Lektor', 'S3', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_fakultas`
--

CREATE TABLE `tb_fakultas` (
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `npk` char(30) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `no_hp` char(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `hak_akses` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_fakultas`
--

INSERT INTO `tb_fakultas` (`username`, `nama`, `npk`, `jenis_kelamin`, `no_hp`, `email`, `jabatan`, `hak_akses`, `password`, `foto`, `status`) VALUES
('admin30000000', 'Zulfadli', '0000000', 'Laki-laki', '082399999999', 'zulfadli@gmail.com', 'Asisten', 'Admin', '$2y$10$s4XPtOSlO4KA6QPl0k4R8eQc8.ZLic7.tSEveRGDCBaJnOytRHFRe', '', 'Non-aktif'),
('dekan', 'Dr. Eng. Muslim.MT', '09110237\n', 'Laki-laki', '', '', 'Dekan', 'Super', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('wd1', 'Dr. Mursyidah M.Sc', '8765467890', 'Perempuan', '', 'mursyidah2020@gmail.com', 'Wakil Dekan I', 'Super', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '24062021001804BSC - Twibbon.png', 'Aktif'),
('wd2', 'Anas Puri , ST.MT', '960702203', 'Laki-laki', '', '', 'Wakil Dekan II', 'Super', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif'),
('wd3', 'Akmar Efendi S.Kom.M.Kom', '990502281', 'Laki-laki', '', '', 'Wakil Dekan III', 'Super', '$2y$10$yhyNpecrqOZbiRRa9sGKv.gBJ/StqLqRvpN27h1IBhT55ABWrTKhu', '', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal_kelas_pertemuan`
--

CREATE TABLE `tb_jadwal_kelas_pertemuan` (
  `id_jadwal_kelas_pertemuan` int(11) NOT NULL,
  `id_jadwal_pengampu` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `jumlah_mahasiswa` int(5) NOT NULL,
  `waktu_pertemuan_pertama` datetime NOT NULL,
  `waktu_pertemuan_pertama_selesai` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jadwal_kelas_pertemuan`
--

INSERT INTO `tb_jadwal_kelas_pertemuan` (`id_jadwal_kelas_pertemuan`, `id_jadwal_pengampu`, `nama_kelas`, `jumlah_mahasiswa`, `waktu_pertemuan_pertama`, `waktu_pertemuan_pertama_selesai`, `status`) VALUES
(1, 231, '4A', 11, '2021-08-18 08:57:00', '0000-00-00 00:00:00', 'Dihapus'),
(2, 231, '2B', 33, '2021-09-24 10:29:00', '2021-09-24 11:30:00', 'Tersedia'),
(3, 230, '4C', 30, '2021-08-11 02:01:00', '2021-08-11 12:01:00', 'Tersedia'),
(4, 223, '2A', 20, '2021-08-12 11:45:00', '0000-00-00 00:00:00', 'Tersedia'),
(5, 223, '2C', 50, '2021-08-21 23:01:00', '0000-00-00 00:00:00', 'Tersedia'),
(6, 231, '4D', 30, '2021-08-12 23:58:00', '0000-00-00 00:00:00', 'Tersedia'),
(7, 231, '4C', 43, '2021-08-22 04:23:00', '2021-08-22 09:58:00', 'Tersedia'),
(8, 231, '4A', 20, '2021-07-15 04:55:00', '0000-00-00 00:00:00', 'Tersedia'),
(9, 230, '4H', 40, '2021-09-04 06:02:00', '2021-09-04 08:02:00', 'Dihapus'),
(10, 229, '4F', 20, '2021-09-04 09:01:00', '2021-09-04 12:01:00', 'Tersedia'),
(11, 233, '4E', 40, '2021-09-09 10:58:00', '2021-09-09 10:59:00', 'Dihapus'),
(12, 200, '4D', 40, '2021-09-08 13:56:00', '2021-09-08 16:54:00', 'Tersedia'),
(13, 234, '2B', 20, '2021-08-31 16:19:00', '2021-08-31 20:17:00', 'Tersedia'),
(14, 231, '2D', 30, '2021-09-17 09:27:00', '2021-09-17 11:27:00', 'Tersedia'),
(15, 233, '2C', 30, '2021-09-24 01:23:00', '2021-09-24 02:23:00', 'Dihapus'),
(16, 235, '1D', 10, '2021-09-21 01:05:00', '2021-09-21 04:03:00', 'Tersedia'),
(17, 239, '2D', 20, '2021-09-15 11:29:00', '2021-09-15 13:29:00', 'Dihapus'),
(18, 239, '1F', 20, '2021-09-11 07:07:00', '2021-09-11 09:07:00', 'Tersedia'),
(19, 236, '2C', 30, '2021-09-24 06:49:00', '2021-09-24 07:47:00', 'Tersedia'),
(20, 236, '<?php echo $kelas_combo; ?>', 50, '2021-09-10 08:52:00', '2021-09-10 10:52:00', 'Dihapus'),
(21, 236, '1E', 30, '2021-09-24 08:35:00', '2021-09-24 09:36:00', 'Tersedia'),
(22, 239, '1G', 40, '2021-09-18 10:00:00', '2021-09-18 11:40:00', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal_libur_pertemuan`
--

CREATE TABLE `tb_jadwal_libur_pertemuan` (
  `id_jadwal_libur_pertemuan` int(11) NOT NULL,
  `waktu_input_jadwal_libur` datetime NOT NULL,
  `waktu_jadwal_libur_mulai` datetime NOT NULL,
  `waktu_jadwal_libur_selesai` datetime NOT NULL,
  `agenda_libur` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jadwal_libur_pertemuan`
--

INSERT INTO `tb_jadwal_libur_pertemuan` (`id_jadwal_libur_pertemuan`, `waktu_input_jadwal_libur`, `waktu_jadwal_libur_mulai`, `waktu_jadwal_libur_selesai`, `agenda_libur`, `status`) VALUES
(1, '2021-08-24 00:27:18', '2021-08-24 00:00:00', '2021-08-27 23:59:00', 'Libur bersama', 'Dihapus'),
(2, '2021-08-26 12:00:16', '2021-08-23 00:00:00', '2021-08-26 23:59:00', 'k', 'Tersedia'),
(3, '2021-08-26 12:01:21', '2021-08-27 00:00:00', '2021-08-27 23:59:00', 's', 'Dihapus'),
(4, '2021-08-26 14:19:23', '2021-08-25 00:00:00', '2021-08-28 23:59:00', 'sc', 'Dihapus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal_pengampu`
--

CREATE TABLE `tb_jadwal_pengampu` (
  `id_jadwal_pengampu` int(10) NOT NULL,
  `kode_jurusan` char(20) NOT NULL,
  `id_pertemuan` int(11) NOT NULL,
  `kode_matkul` char(30) NOT NULL,
  `dosen_pengampu` varchar(50) NOT NULL,
  `jumlah_kelas` int(2) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jadwal_pengampu`
--

INSERT INTO `tb_jadwal_pengampu` (`id_jadwal_pengampu`, `kode_jurusan`, `id_pertemuan`, `kode_matkul`, `dosen_pengampu`, `jumlah_kelas`, `status`) VALUES
(4, '2', 9, '2TP23010', '21013056902', 4, 'Tersedia'),
(5, '2', 9, '2TP43021', '21009097501', 4, 'Tersedia'),
(6, '2', 9, '2TP73049', '21016047901', 5, 'Tersedia'),
(7, '2', 9, '2TP83510', '21005107603', 1, 'Tersedia'),
(8, '2', 9, '2TP42505', '21023027904', 1, 'Tersedia'),
(9, '2', 9, '2TP23011', '21005107603', 4, 'Tersedia'),
(10, '2', 9, '2TP43020', '21001118101', 4, 'Tersedia'),
(11, '2', 9, '2TP63032', '28820423419', 5, 'Tersedia'),
(12, '2', 9, '2TP73505', '21015019202', 1, 'Tersedia'),
(20, '2', 9, '22TP52202', '20102121975', 1, 'Tersedia'),
(21, '3', 9, '3TM42251', '31029077302', 2, 'Tersedia'),
(22, '3', 9, '3TM23251', '31009038504', 2, 'Tersedia'),
(23, '3', 9, '3TM82211', '39910006706', 3, 'Tersedia'),
(24, '3', 9, '3TM63272', '39910006706', 1, 'Tersedia'),
(25, '3', 9, '3TM83225', '31008057102', 1, 'Tersedia'),
(26, '3', 9, '3UN12008', '31005017502', 3, 'Tersedia'),
(27, '3', 9, '3TM23241', '31030048902', 2, 'Tersedia'),
(28, '3', 9, '3TM63231', '31010127502', 3, 'Tersedia'),
(29, '3', 9, '3TM42371', '31009038504', 2, 'Tersedia'),
(30, '3', 9, '3TM83233', '31028108902', 1, 'Tersedia'),
(31, '4', 9, '4PW22009', '41013078302', 1, 'Tersedia'),
(32, '4', 9, '4PW43028', '41024078802', 1, 'Tersedia'),
(33, '4', 9, '4PW62044', '41005068201', 2, 'Tersedia'),
(34, '4', 9, '4PW42027', '41018019103', 1, 'Tersedia'),
(35, '4', 9, '4PW62043', '41002056201', 2, 'Tersedia'),
(36, '4', 9, '4PW22010', '41030048902', 1, 'Tersedia'),
(37, '4', 9, '4PW63045', '41019057202', 2, 'Tersedia'),
(38, '4', 9, '4PW22012', '41024078802', 1, 'Tersedia'),
(39, '4', 9, '4PW44033', '41023047701', 1, 'Tersedia'),
(40, '5', 9, '5UN12008', '50318021995', 7, 'Tersedia'),
(41, '5', 9, '5TI43012', '51009098801', 2, 'Tersedia'),
(42, '5', 9, '5TI43012', '50015017101', 2, 'Tersedia'),
(43, '5', 9, '5TI43012', '51025118802', 3, 'Tersedia'),
(44, '5', 9, '5TI63020', '51017049102', 7, 'Tersedia'),
(45, '5', 9, '5TI23029', '51015047503', 7, 'Tersedia'),
(46, '5', 9, '5TI23028', '51026126801', 5, 'Tersedia'),
(47, '5', 9, '5TI23028', '51014028904', 2, 'Tersedia'),
(48, '5', 9, '5TI43033', '51008037703', 3, 'Tersedia'),
(49, '5', 9, '5TI43033', '51004079401', 4, 'Tersedia'),
(50, '5', 9, '5TI62036', '51017049002', 3, 'Tersedia'),
(51, '5', 9, '5TI62036', '51013068101', 4, 'Tersedia'),
(52, '6', 9, '6TG23216', '61023099301', 1, 'Tersedia'),
(53, '6', 9, '6TG62252', '61010118403', 1, 'Tersedia'),
(54, '6', 9, '6TG43225', '61010118403', 1, 'Tersedia'),
(55, '6', 9, '6UN13012', '61023099301', 1, 'Tersedia'),
(56, '6', 9, '6TG22210', '61008097501', 1, 'Tersedia'),
(57, '6', 9, '6TG42229', '61014028602', 1, 'Tersedia'),
(58, '6', 9, '6TG23214', '61010118403', 1, 'Tersedia'),
(59, '6', 9, '6TG62253', '61008058901', 1, 'Tersedia'),
(60, '6', 9, '6TG43228', '61023099301', 1, 'Tersedia'),
(61, '6', 9, '6TG62249', '61008058901', 1, 'Tersedia'),
(62, '6', 9, '6UN12006', '61020077102', 1, 'Tersedia'),
(63, '6', 9, '6TG42230', '60109011990', 1, 'Tersedia'),
(64, '6', 9, '6TG22212', '61008058901', 1, 'Tersedia'),
(65, '6', 9, '6TG66251', '61010118403', 1, 'Tersedia'),
(66, '6', 9, '6TG42232', '61008058901', 1, 'Tersedia'),
(67, '6', 9, '6TG62246', '61014028602', 1, 'Tersedia'),
(68, '6', 9, '6TG23215', '61010118403', 1, 'Tersedia'),
(69, '6', 9, '6UN12003', '61007108201', 1, 'Tersedia'),
(70, '6', 9, '6TG22211', '61020047501', 1, 'Tersedia'),
(71, '6', 9, '6TG42231', '61023099301', 1, 'Tersedia'),
(72, '6', 9, '6TG63250', '61010118403', 1, 'Tersedia'),
(73, '6', 9, '6TG23217', '61014028602', 1, 'Tersedia'),
(74, '6', 9, '6TG42226', '61014028602', 1, 'Tersedia'),
(75, '6', 9, '6TG22213', '61012068702', 1, 'Tersedia'),
(76, '6', 9, '6TG42227', '61023099301', 1, 'Tersedia'),
(77, '6', 9, '6TG62247', '61010118403', 1, 'Tersedia'),
(78, '6', 9, '6TG42233', '61008058901', 1, 'Tersedia'),
(79, '6', 9, '6TG63248', '61023099301', 1, 'Tersedia'),
(80, '4', 9, '4UN12008', '41104540101', 1, 'Tersedia'),
(81, '4', 9, '4PW42031', '41028067803', 1, 'Tersedia'),
(82, '4', 9, '4PW22015', '40015017101', 1, 'Tersedia'),
(83, '4', 9, '4PW62050', '41002056201', 65, 'Dihapus'),
(84, '4', 9, '4PW23014', '41018019103', 1, 'Tersedia'),
(85, '4', 9, '4PW62050', '41002056201', 1, 'Tersedia'),
(86, '4', 9, '4PW43036', '41030046903', 1, 'Tersedia'),
(87, '4', 9, '4PW22011', '41024078802', 1, 'Tersedia'),
(88, '4', 9, '4PW62047', '41005038401', 2, 'Tersedia'),
(89, '4', 9, '4PW43030', '41024078802', 1, 'Tersedia'),
(90, '4', 9, '4PW63046', '41018097702', 2, 'Tersedia'),
(91, '4', 9, '4PW42032', '41023047701', 1, 'Tersedia'),
(92, '4', 9, '4PW62051', '41005038401', 1, 'Tersedia'),
(93, '4', 9, '4PW43029', '41030046903', 1, 'Tersedia'),
(94, '4', 9, '4PW23013', '41018028601', 1, 'Tersedia'),
(95, '4', 9, '4PW23016', '41008108303', 1, 'Tersedia'),
(96, '4', 9, '4PW64048', '41028067803', 1, 'Tersedia'),
(97, '4', 9, '4PW64048', '41018028601', 1, 'Tersedia'),
(98, '4', 9, '4PW64049', '41008108303', 1, 'Tersedia'),
(99, '4', 9, '4PW64049', '41018019103', 1, 'Tersedia'),
(100, '2', 9, '2TP23008', '21011088304', 2, 'Tersedia'),
(101, '2', 9, '2TP23008', '21012068702', 2, 'Tersedia'),
(102, '2', 9, '2TP22016', '21023116201', 4, 'Tersedia'),
(103, '2', 9, '2TP53048', '28856211019', 3, 'Tersedia'),
(104, '2', 9, '2TP53048', '21015019202', 2, 'Tersedia'),
(105, '2', 9, '2TP83503', '21024078902', 1, 'Tersedia'),
(106, '2', 9, '2TP52201', '21027069201', 1, 'Tersedia'),
(107, '2', 9, '2TP22014', '21007108201', 4, 'Tersedia'),
(108, '2', 9, '2TP43024', '21018088201', 3, 'Tersedia'),
(109, '2', 9, '2TP43024', '21011088304', 1, 'Tersedia'),
(110, '2', 9, '2TP43022', '21029038403', 2, 'Dihapus'),
(111, '2', 9, '2TP43022', '21001118101', 3, 'Dihapus'),
(112, '2', 9, '2TP83057', '21027118403', 5, 'Tersedia'),
(113, '2', 9, '2UN12007', '21011089101', 4, 'Tersedia'),
(114, '2', 9, '2TP22015', '21027069201', 4, 'Tersedia'),
(115, '2', 9, '2TP43025', '21027069201', 4, 'Tersedia'),
(116, '2', 9, '2TP53036', '21024078902', 5, 'Tersedia'),
(117, '2', 9, '2TP73504', '28856211019', 1, 'Tersedia'),
(118, '2', 9, '2TP42506', '21005107603', 1, 'Tersedia'),
(119, '2', 9, '2TP23007', '21006118301', 4, 'Tersedia'),
(120, '2', 9, '2TP43022', '21010048904', 4, 'Tersedia'),
(121, '2', 9, '2TP63034', '21021088201', 5, 'Tersedia'),
(122, '2', 9, '2TP73503', '28820423419', 1, 'Tersedia'),
(123, '2', 9, '2TP73502', '21010048904', 1, 'Tersedia'),
(124, '2', 9, '2UN12006', '21020077102', 4, 'Tersedia'),
(125, '2', 9, '2TP73507', '21027118403', 1, 'Tersedia'),
(126, '2', 9, '2TP62033', '21010048904', 3, 'Tersedia'),
(127, '2', 9, '2TP83504', '21001118101', 1, 'Tersedia'),
(128, '1', 9, '1TS82068', '11005057003', 1, 'Tersedia'),
(129, '1', 9, '1TS42023', '11005057003', 5, 'Tersedia'),
(130, '1', 9, '1TS23008', '11026078603', 4, 'Tersedia'),
(131, '1', 9, '1TS42028', '11015038302', 5, 'Tersedia'),
(132, '1', 9, '1TS62044', '11012128304', 4, 'Tersedia'),
(133, '1', 9, '1TS82064', '11023047701', 2, 'Tersedia'),
(134, '1', 9, '1TS42024', '11011076202', 5, 'Tersedia'),
(135, '1', 9, '1TS23009', '11015068204', 4, 'Tersedia'),
(136, '1', 9, '1TS62040', '11026078603', 4, 'Tersedia'),
(137, '1', 9, '1UN12002', '11008097501', 4, 'Tersedia'),
(138, '1', 9, '1TS82070', '11018129001', 1, 'Tersedia'),
(139, '1', 9, '1TS62041', '10008076401', 4, 'Tersedia'),
(140, '1', 9, '1TS23007', '11004118406', 4, 'Tersedia'),
(141, '1', 9, '1TS42029', '11008198203', 5, 'Tersedia'),
(142, '1', 9, '1TS82069', '11004118406', 1, 'Tersedia'),
(143, '1', 9, '1ts82061', '10008076401', 1, 'Tersedia'),
(144, '1', 9, '1TS42022', '11011016301', 5, 'Tersedia'),
(145, '1', 9, '1TS22010', '11012128304', 4, 'Tersedia'),
(146, '1', 9, '1TS62043', '11002056201', 4, 'Tersedia'),
(147, '1', 9, '1TS62071', '11029048803', 4, 'Tersedia'),
(148, '1', 9, '1TS42025', '11011016301', 3, 'Tersedia'),
(149, '1', 9, '1TS42025', '11013066803', 2, 'Tersedia'),
(150, '1', 9, '1TS62047', '11013066803', 4, 'Tersedia'),
(151, '1', 9, '1TS42030', '11030088801', 5, 'Tersedia'),
(152, '1', 9, '1TS82065', '11018129001', 1, 'Tersedia'),
(153, '1', 9, '1TS42027', '11006124901', 5, 'Tersedia'),
(154, '1', 9, '1TS23012', '11010127801', 4, 'Tersedia'),
(155, '1', 9, '1TS63046', '11008198203', 4, 'Tersedia'),
(156, '1', 9, '1TS82063', '11010127801', 2, 'Tersedia'),
(157, '1', 9, '1TS62042', '11019057901', 4, 'Tersedia'),
(158, '1', 9, '1TS22011', '11030088801', 4, 'Tersedia'),
(159, '1', 9, '1TS43026', '10016045003', 5, 'Tersedia'),
(160, '1', 9, '1TS62045', '11010127801', 4, 'Tersedia'),
(161, '1', 9, '1UN13009', '11015029101', 4, 'Tersedia'),
(162, '1', 9, '1TS62048', '11011076202', 2, 'Tersedia'),
(163, '1', 9, '1TS62048', '11018129001', 2, 'Tersedia'),
(164, '1', 9, '1TS82062', '11015068204', 1, 'Tersedia'),
(165, '1', 9, '1TS82067', '11002056201', 1, 'Tersedia'),
(166, '3', 9, '3UN12006', '31020077102', 2, 'Tersedia'),
(167, '3', 9, '3TM23231', '31008057102', 2, 'Tersedia'),
(168, '3', 9, '3TM42241', '31009038504', 2, 'Dihapus'),
(169, '3', 9, '3TM42241', '31009038504', 2, 'Tersedia'),
(170, '3', 9, '3TM83235', '31008057102', 1, 'Tersedia'),
(171, '3', 9, '3TM63274', '31029077302', 1, 'Tersedia'),
(172, '3', 9, '3TM43221', '31028108902', 2, 'Tersedia'),
(173, '3', 9, '3TM23221', '31010127502', 2, 'Tersedia'),
(174, '3', 9, '3TM62251', '31002129301', 3, 'Tersedia'),
(175, '3', 9, '3TM83234', '30027075901', 1, 'Tersedia'),
(176, '3', 9, '3TM62261', '31008057102', 3, 'Tersedia'),
(177, '3', 9, '3TM62221', '31005047603', 3, 'Tersedia'),
(178, '3', 9, '3TM22271', '31005047603', 2, 'Tersedia'),
(179, '3', 9, '3TM43261', '31025057501', 2, 'Tersedia'),
(180, '3', 9, '3TM63275', '31029077302', 1, 'Tersedia'),
(181, '3', 9, '3TM62241', '31005047603', 3, 'Tersedia'),
(182, '3', 9, '3UN12002', '31008037804', 2, 'Tersedia'),
(183, '3', 9, '3TM43231', '31002129301', 2, 'Tersedia'),
(184, '3', 9, '3TM21281', '30027075901', 2, 'Tersedia'),
(185, '3', 9, '3TM63273', '31010127502', 1, 'Tersedia'),
(186, '3', 9, '3TM83222', '31028108902', 1, 'Tersedia'),
(187, '3', 9, '3TM61291', '31010127502', 3, 'Tersedia'),
(188, '3', 9, '3TM23261', '30027075901', 2, 'Tersedia'),
(189, '3', 9, '3TM41281', '31029077302', 3, 'Tersedia'),
(190, '5', 9, '5TI23028', '51026126801', 5, 'Dihapus'),
(191, '5', 9, '5TI23028', '51014028904', 2, 'Dihapus'),
(192, '5', 9, '5UN12002', '51010059101', 4, 'Tersedia'),
(193, '5', 9, '5UN12002', '51013078302', 3, 'Tersedia'),
(194, '5', 9, '5TI43013', '50009088102', 3, 'Tersedia'),
(195, '5', 9, '5TI43013', '51023048901', 4, 'Tersedia'),
(196, '5', 9, '5TI63021', '51029078701', 4, 'Tersedia'),
(197, '5', 9, '5TI63021', '51014028904', 3, 'Tersedia'),
(198, '5', 9, '5TI23006', '51017049002', 7, 'Tersedia'),
(199, '5', 9, '5TI23005', '50216021993', 7, 'Tersedia'),
(200, '5', 9, '5TI43014', '51018088102', 4, 'Tersedia'),
(201, '5', 9, '5TI43014', '50009088102', 3, 'Tersedia'),
(202, '5', 9, '5TI63022', '51024077901', 7, 'Tersedia'),
(203, '5', 9, '5TI22002', '51020048803', 4, 'Tersedia'),
(204, '5', 9, '5TI22002', '51023027904', 3, 'Tersedia'),
(205, '5', 9, '5TI63023', '51023048901', 2, 'Tersedia'),
(206, '5', 9, '5TI63023', '50130061988', 5, 'Tersedia'),
(207, '5', 9, '5TI43032', '51029027601', 5, 'Tersedia'),
(208, '5', 9, '5TI43032', '50314068701', 2, 'Tersedia'),
(209, '5', 9, '5TI62049', '51010068102', 3, 'Tersedia'),
(210, '5', 9, '5TI62049', '50007027807', 4, 'Tersedia'),
(211, '5', 9, '5TI24030', '51031126801', 5, 'Tersedia'),
(212, '5', 9, '5TI24030', '50314068701', 2, 'Tersedia'),
(213, '5', 9, '5TI42048', '51026068702', 3, 'Tersedia'),
(214, '5', 9, '5TI42048', '52119058701', 4, 'Tersedia'),
(215, '5', 9, '5TI63043', '51018088102', 1, 'Tersedia'),
(216, '5', 9, '5TI63046', '51016048502', 2, 'Tersedia'),
(217, '5', 9, '5TI44015', '51016048502', 4, 'Tersedia'),
(218, '5', 9, '5TI44015', '51029078701', 3, 'Tersedia'),
(219, '5', 9, '5TI63040', '50314068701', 4, 'Tersedia'),
(220, '5', 9, '5UN12002', '55555555555', 3, 'Tersedia'),
(221, '2', 9, '2TP53039', '21001118101', 3, 'Tersedia'),
(222, '5', 9, '5TI22002', '55555555555', 2, 'Tersedia'),
(223, '2', 9, '2TP53039', '21029038403', 2, 'Tersedia'),
(224, '5', 9, '5TI12137', '55555555555', 5, 'Tersedia'),
(225, '5', 9, '5TI24030', '51031126801', 3, 'Tersedia'),
(226, '5', 9, '5UN12001', '51013078302', 7, 'Tersedia'),
(227, '5', 9, '5TI22002', '50009088102', 2, 'Tersedia'),
(228, '5', 9, '5TI22002', '50015017101', 2, 'Tersedia'),
(229, '5', 9, '5TI13003', '50009088102', 2, 'Tersedia'),
(230, '5', 9, '5TI53016', '50009088102', 2, 'Tersedia'),
(231, '5', 9, '5TI22002', '55555555555', 5, 'Tersedia'),
(232, '5', 9, '5UN12007', '51007058402', 3, 'Dihapus'),
(233, '5', 9, '5TI14004', '51031126801', 2, 'Tersedia'),
(234, '5', 8, '5TI22002', '51031126801', 3, 'Tersedia'),
(235, '5', 9, '5TI22002', '55555555555, 51008037703', 20, 'Dihapus'),
(236, '5', 9, '5UN12002', '51007058402', 2, 'Tersedia'),
(237, '5', 9, '5TI23006', '', 2, 'Dihapus'),
(238, '5', 9, '5UN12008', '51014028904', 3, 'Dihapus'),
(239, '5', 9, '5TI43033', '51031126801, 51008037703, 55555555555', 2, 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal_ujian`
--

CREATE TABLE `tb_jadwal_ujian` (
  `id_jadwal_ujian` int(11) NOT NULL,
  `id_ujian` int(11) NOT NULL,
  `id_jadwal_pengampu` int(11) NOT NULL,
  `tanggal_ujian` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jadwal_ujian`
--

INSERT INTO `tb_jadwal_ujian` (`id_jadwal_ujian`, `id_ujian`, `id_jadwal_pengampu`, `tanggal_ujian`, `jam_mulai`, `jam_selesai`, `status`) VALUES
(1, 2, 211, '2021-08-31', '14:50:32', '16:50:33', 'Tersedia'),
(2, 1, 212, '2021-08-31', '14:50:32', '16:50:33', 'Tersedia'),
(3, 5, 48, '2021-09-02', '07:00:00', '09:00:00', 'Dihapus'),
(4, 5, 49, '2021-08-30', '16:09:00', '18:07:00', 'Tersedia'),
(5, 6, 231, '2021-09-05', '23:30:00', '23:59:00', 'Dihapus'),
(6, 5, 231, '2021-09-02', '14:19:00', '16:21:00', 'Dihapus'),
(7, 5, 231, '2021-09-03', '00:02:00', '02:00:00', 'Tersedia'),
(8, 6, 48, '2021-09-05', '23:29:00', '23:33:00', 'Dihapus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal_ujian_lanjutan`
--

CREATE TABLE `tb_jadwal_ujian_lanjutan` (
  `id_jadwal_lanjutan` int(10) NOT NULL,
  `id_jadwal_ujian` int(11) NOT NULL,
  `id_jadwal_kelas_pertemuan` int(10) NOT NULL,
  `jumlah_mhs_terjadwal_ujian` int(11) NOT NULL,
  `npk_pengawas1` char(30) NOT NULL,
  `npk_pengawas2` char(30) NOT NULL,
  `kode_ruang` char(30) NOT NULL,
  `tanggal_absen_pengawas1` date NOT NULL,
  `jam_absen_pengawas1` time NOT NULL,
  `tanggal_absen_pengawas2` date NOT NULL,
  `jam_absen_pengawas2` time NOT NULL,
  `tanggal_submit_pengawas1` date NOT NULL,
  `jam_submit_pengawas1` time NOT NULL,
  `tanggal_submit_pengawas2` date NOT NULL,
  `jam_submit_pengawas2` time NOT NULL,
  `foto_bukti_pengawas1` varchar(100) NOT NULL,
  `foto_bukti_pengawas2` varchar(100) NOT NULL,
  `jenis_soal` varchar(50) NOT NULL,
  `media` varchar(100) NOT NULL,
  `jumlah_mahasiswa_hadir` int(3) NOT NULL,
  `ket_pelaksanaan` text NOT NULL,
  `status_verifikasi_pengawas1` varchar(50) NOT NULL,
  `status_verifikasi_pengawas2` varchar(50) NOT NULL,
  `tanggal_pengajuan_terlambat_pengawas1` date NOT NULL,
  `jam_pengajuan_terlambat_pengawas1` time NOT NULL,
  `tanggal_pengajuan_terlambat_pengawas2` date NOT NULL,
  `jam_pengajuan_terlambat_pengawas2` time NOT NULL,
  `file_pengajuan_terlambat_pengawas1` varchar(100) NOT NULL,
  `file_pengajuan_terlambat_pengawas2` varchar(100) NOT NULL,
  `status_pengajuan_terlambat_pengawas1` varchar(50) NOT NULL,
  `status_pengajuan_terlambat_pengawas2` varchar(50) NOT NULL,
  `alasan_penolakan_pengawas1` text NOT NULL,
  `alasan_penolakan_pengawas2` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_jadwal_ujian_lanjutan`
--

INSERT INTO `tb_jadwal_ujian_lanjutan` (`id_jadwal_lanjutan`, `id_jadwal_ujian`, `id_jadwal_kelas_pertemuan`, `jumlah_mhs_terjadwal_ujian`, `npk_pengawas1`, `npk_pengawas2`, `kode_ruang`, `tanggal_absen_pengawas1`, `jam_absen_pengawas1`, `tanggal_absen_pengawas2`, `jam_absen_pengawas2`, `tanggal_submit_pengawas1`, `jam_submit_pengawas1`, `tanggal_submit_pengawas2`, `jam_submit_pengawas2`, `foto_bukti_pengawas1`, `foto_bukti_pengawas2`, `jenis_soal`, `media`, `jumlah_mahasiswa_hadir`, `ket_pelaksanaan`, `status_verifikasi_pengawas1`, `status_verifikasi_pengawas2`, `tanggal_pengajuan_terlambat_pengawas1`, `jam_pengajuan_terlambat_pengawas1`, `tanggal_pengajuan_terlambat_pengawas2`, `jam_pengajuan_terlambat_pengawas2`, `file_pengajuan_terlambat_pengawas1`, `file_pengajuan_terlambat_pengawas2`, `status_pengajuan_terlambat_pengawas1`, `status_pengajuan_terlambat_pengawas2`, `alasan_penolakan_pengawas1`, `alasan_penolakan_pengawas2`, `status`) VALUES
(1, 5, 6, 30, '55555555555', '', '3A.01.11', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', 0, '', '', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', '', '', 'Dihapus'),
(2, 5, 6, 30, '51016048502', '50130061988', '3A.01.09', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', 0, '', '', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', '', '', 'Tersedia'),
(3, 5, 6, 30, '51026126801', '', '3A.01.12', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', 0, '', '', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', '', '', 'Tersedia'),
(4, 5, 6, 30, '55555555555', '50007027807', '3A.01.11', '2021-09-01', '16:12:55', '0000-00-00', '00:00:00', '2021-09-01', '16:12:55', '0000-00-00', '00:00:00', '4-01092021110703background HP .jpg', '', 'Tugas', 'GC', 30, 'Aman dan Lancar', 'Minta Verifikasi', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', '', '', 'Tersedia'),
(5, 5, 6, 30, '55555555555', '', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', 0, '', '', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', '', '', 'Dihapus'),
(6, 5, 2, 30, '50009088102', '', '3A.01.10', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', 0, '', '', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', '', '', 'Tersedia'),
(7, 5, 8, 20, '55555555555', '', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', 0, '', '', '', '2021-09-02', '01:47:28', '0000-00-00', '00:00:00', '01092021204728surat keterangan kepemilikan laptop.pdf', '', 'Disetujui', '', '', '', 'Tersedia'),
(8, 5, 6, 20, '55555555555', '', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '16:25:30', '0000-00-00', '00:00:00', '01092021112529background HP .jpg', '', 'Tugas', 'GCLASS', 19, 'Aman dan Lancar', 'Minta Verifikasi', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', '', '', 'Tersedia'),
(9, 7, 2, 33, '55555555555', '', '', '2021-09-06', '01:20:40', '0000-00-00', '00:00:00', '2021-09-06', '01:20:40', '0000-00-00', '00:00:00', '9-05092021201256background HP .jpg', '', 'Tugas', 'GC', 20, 'Aman dan Lancar', 'Terverifikasi', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', '', '', 'Tersedia'),
(10, 7, 6, 30, '51013068101', '', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', 0, '', '', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', '', '', 'Tersedia'),
(11, 7, 7, 43, '55555555555', '', '', '2021-09-06', '01:23:05', '0000-00-00', '00:00:00', '2021-09-06', '01:23:05', '0000-00-00', '00:00:00', '06092021012305facebook_logos_PNG19748.png', '', 'Tugas', 'GC', 40, 'Aman dan Lancar', 'Terverifikasi', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '', '', '', '', '', '', 'Tersedia'),
(12, 7, 8, 20, '55555555555', '', '', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', '0000-00-00', '01:34:57', '0000-00-00', '00:00:00', '05092021203457background HP .jpg', '', 'Take Home', 'GC', 30, 'Aman dan Lancar', 'Terverifikasi', '', '2021-09-06', '01:19:57', '0000-00-00', '00:00:00', '05092021201957Surat undangan musyawarah.pdf', '', 'Pengajuan ditolak', '', 'jnj', '', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(5) NOT NULL,
  `kode_jurusan` char(20) NOT NULL,
  `semester` char(1) NOT NULL,
  `nama_kelas` char(1) NOT NULL,
  `kelas_pilihan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `kode_jurusan`, `semester`, `nama_kelas`, `kelas_pilihan`) VALUES
(6, '2', '1', 'A', ''),
(7, '2', '1', 'B', ''),
(9, '2', '1', 'C', ''),
(10, '1', '1', 'A', ''),
(11, '1', '1', 'C', ''),
(13, '5', '1', 'B', 'PIL'),
(14, '5', '1', 'C', 'PIL'),
(15, '5', '1', 'D', ''),
(16, '5', '1', 'E', ''),
(17, '5', '1', 'F', ''),
(18, '5', '1', 'G', ''),
(19, '5', '1', 'H', ''),
(21, '5', '2', 'A', 'PIL'),
(22, '5', '2', 'B', ''),
(23, '5', '2', 'C', ''),
(24, '5', '2', 'D', ''),
(25, '5', '2', 'E', ''),
(26, '5', '2', 'F', ''),
(27, '5', '2', 'G', ''),
(28, '5', '2', 'H', ''),
(29, '5', '3', 'A', ''),
(30, '5', '3', 'B', ''),
(31, '5', '3', 'C', ''),
(32, '5', '3', 'D', ''),
(33, '5', '3', 'E', ''),
(34, '5', '3', 'F', ''),
(35, '5', '3', 'G', ''),
(37, '5', '3', 'H', ''),
(38, '5', '4', 'A', ''),
(39, '5', '4', 'B', ''),
(40, '5', '4', 'C', ''),
(41, '5', '4', 'D', ''),
(42, '5', '4', 'E', ''),
(43, '5', '4', 'F', ''),
(44, '5', '4', 'G', ''),
(45, '5', '4', 'H', ''),
(46, '5', '5', 'A', ''),
(47, '5', '5', 'B', ''),
(48, '5', '5', 'C', ''),
(49, '5', '5', 'D', ''),
(50, '5', '5', 'E', ''),
(51, '5', '5', 'F', ''),
(52, '5', '5', 'G', ''),
(53, '5', '5', 'H', ''),
(54, '5', '6', 'A', ''),
(55, '5', '6', 'B', ''),
(56, '5', '6', 'C', ''),
(57, '5', '6', 'D', ''),
(58, '5', '6', 'E', ''),
(59, '5', '6', 'F', ''),
(60, '5', '6', 'G', ''),
(61, '5', '6', 'H', ''),
(62, '5', '7', 'A', ''),
(63, '5', '7', 'B', ''),
(64, '5', '7', 'C', ''),
(65, '5', '7', 'D', ''),
(66, '5', '7', 'E', ''),
(67, '5', '7', 'F', ''),
(68, '5', '7', 'G', ''),
(69, '5', '7', 'H', ''),
(70, '1', '1', 'B', ''),
(71, '1', '1', 'D', ''),
(72, '1', '1', 'E', ''),
(73, '1', '1', 'F', ''),
(75, '1', '1', 'F', ''),
(76, '1', '1', 'H', ''),
(77, '1', '2', 'A', ''),
(78, '1', '2', 'B', ''),
(79, '1', '2', 'C', ''),
(80, '1', '2', 'D', ''),
(81, '1', '2', 'E', ''),
(82, '1', '2', 'F', ''),
(83, '1', '2', 'G', ''),
(84, '1', '2', 'H', ''),
(85, '1', '3', 'A', ''),
(86, '1', '3', 'B', ''),
(87, '1', '3', 'C', ''),
(88, '1', '3', 'D', ''),
(89, '1', '3', 'E', ''),
(90, '1', '3', 'F', ''),
(91, '1', '3', 'G', ''),
(92, '1', '3', 'H', ''),
(93, '1', '4', 'A', ''),
(94, '1', '4', 'B', ''),
(95, '1', '4', 'C', ''),
(96, '1', '4', 'D', ''),
(97, '1', '4', 'E', ''),
(98, '1', '4', 'F', ''),
(99, '1', '4', 'G', ''),
(100, '1', '4', 'H', ''),
(101, '1', '5', 'A', ''),
(102, '1', '5', 'B', ''),
(103, '1', '5', 'C', ''),
(104, '1', '5', 'D', ''),
(105, '1', '5', 'E', ''),
(106, '1', '5', 'F', ''),
(107, '1', '5', 'G', ''),
(108, '1', '5', 'H', ''),
(109, '1', '6', 'A', ''),
(110, '1', '6', 'B', ''),
(111, '1', '6', 'C', ''),
(112, '1', '6', 'D', ''),
(113, '1', '6', 'E', ''),
(114, '1', '6', 'F', ''),
(115, '1', '6', 'G', ''),
(116, '1', '6', 'H', ''),
(117, '1', '7', 'A', ''),
(118, '1', '7', 'B', ''),
(119, '1', '7', 'C', ''),
(120, '1', '7', 'D', ''),
(121, '1', '7', 'E', ''),
(122, '1', '7', 'F', ''),
(123, '1', '7', 'G', ''),
(124, '1', '7', 'H', ''),
(125, '2', '1', 'D', ''),
(126, '2', '1', 'E', ''),
(127, '2', '1', 'F', ''),
(128, '2', '1', 'G', ''),
(129, '2', '1', 'H', ''),
(130, '2', '2', 'A', ''),
(131, '2', '2', 'B', ''),
(132, '2', '2', 'C', ''),
(133, '2', '2', 'D', ''),
(134, '2', '2', 'E', ''),
(135, '2', '2', 'F', ''),
(136, '2', '2', 'G', ''),
(137, '2', '2', 'H', ''),
(138, '2', '3', 'A', ''),
(139, '2', '3', 'B', ''),
(140, '2', '3', 'C', ''),
(141, '2', '3', 'D', ''),
(142, '2', '3', 'E', ''),
(143, '2', '3', 'F', ''),
(144, '2', '3', 'G', ''),
(145, '2', '3', 'H', ''),
(146, '2', '4', 'A', ''),
(147, '2', '4', 'B', ''),
(148, '2', '4', 'C', ''),
(149, '2', '4', 'D', ''),
(150, '2', '4', 'E', ''),
(151, '2', '4', 'F', ''),
(152, '2', '4', 'G', ''),
(153, '2', '4', 'H', ''),
(154, '2', '5', 'A', ''),
(155, '2', '5', 'B', ''),
(156, '2', '5', 'C', ''),
(157, '2', '5', 'D', ''),
(158, '2', '5', 'E', ''),
(159, '2', '5', 'F', ''),
(160, '2', '5', 'G', ''),
(161, '2', '5', 'H', ''),
(162, '2', '6', 'A', ''),
(163, '2', '6', 'B', ''),
(164, '2', '6', 'C', ''),
(165, '2', '6', 'D', ''),
(166, '2', '6', 'E', ''),
(167, '2', '6', 'F', ''),
(168, '2', '6', 'G', ''),
(169, '2', '6', 'H', ''),
(170, '2', '7', 'A', ''),
(171, '2', '7', 'B', ''),
(172, '2', '7', 'C', ''),
(173, '2', '7', 'D', ''),
(174, '2', '7', 'E', ''),
(175, '2', '7', 'F', ''),
(176, '2', '7', 'G', ''),
(177, '2', '7', 'H', ''),
(178, '3', '1', 'A', ''),
(179, '3', '1', 'B', ''),
(180, '3', '1', 'C', ''),
(181, '3', '1', 'D', ''),
(182, '3', '1', 'E', ''),
(183, '3', '1', 'F', ''),
(184, '3', '1', 'G', ''),
(185, '3', '1', 'H', ''),
(186, '3', '2', 'A', ''),
(187, '3', '2', 'B', ''),
(188, '3', '2', 'C', ''),
(189, '3', '2', 'D', ''),
(190, '3', '2', 'E', ''),
(191, '3', '2', 'F', ''),
(193, '3', '2', 'G', ''),
(194, '3', '2', 'H', ''),
(195, '3', '3', 'A', ''),
(196, '3', '3', 'B', ''),
(197, '3', '3', 'C', ''),
(198, '3', '3', 'D', ''),
(199, '3', '3', 'E', ''),
(200, '3', '3', 'F', ''),
(201, '3', '3', 'G', ''),
(202, '3', '3', 'H', ''),
(203, '3', '4', 'A', ''),
(204, '3', '4', 'B', ''),
(205, '3', '4', 'C', ''),
(206, '3', '4', 'D', ''),
(207, '3', '4', 'E', ''),
(208, '3', '4', 'F', ''),
(209, '3', '4', 'G', ''),
(210, '3', '4', 'H', ''),
(211, '3', '5', 'A', ''),
(212, '3', '5', 'B', ''),
(213, '3', '5', 'C', ''),
(214, '3', '5', 'D', ''),
(215, '3', '5', 'E', ''),
(216, '3', '5', 'F', ''),
(217, '3', '5', 'G', ''),
(218, '3', '5', 'H', ''),
(219, '3', '6', 'A', ''),
(220, '3', '6', 'B', ''),
(221, '3', '6', 'C', ''),
(222, '3', '6', 'D', ''),
(223, '3', '6', 'E', ''),
(224, '3', '6', 'F', ''),
(225, '3', '6', 'G', ''),
(226, '3', '6', 'H', ''),
(227, '3', '7', 'A', ''),
(228, '3', '7', 'B', ''),
(229, '3', '7', 'C', ''),
(230, '3', '7', 'D', ''),
(231, '3', '7', 'E', ''),
(232, '3', '7', 'F', ''),
(233, '3', '7', 'G', ''),
(234, '3', '7', 'H', ''),
(235, '4', '1', 'A', ''),
(236, '4', '1', 'B', ''),
(237, '4', '1', 'C', ''),
(238, '4', '1', 'D', ''),
(240, '4', '1', 'E', ''),
(241, '4', '1', 'F', ''),
(242, '4', '1', 'G', ''),
(243, '4', '1', 'H', ''),
(244, '4', '2', 'A', ''),
(245, '4', '2', 'B', ''),
(246, '4', '2', 'C', ''),
(247, '4', '2', 'D', ''),
(248, '4', '2', 'E', ''),
(249, '4', '2', 'F', ''),
(250, '4', '2', 'G', ''),
(251, '4', '2', 'H', ''),
(252, '4', '3', 'A', ''),
(253, '4', '3', 'B', ''),
(254, '4', '3', 'C', ''),
(255, '4', '3', 'D', ''),
(257, '4', '3', 'F', ''),
(258, '4', '3', 'G', ''),
(259, '4', '3', 'H', ''),
(260, '4', '3', 'E', ''),
(261, '4', '4', 'A', ''),
(262, '4', '4', 'B', ''),
(263, '4', '4', 'C', ''),
(264, '4', '4', 'D', ''),
(265, '4', '4', 'E', ''),
(266, '4', '4', 'F', ''),
(267, '4', '4', 'G', ''),
(268, '4', '4', 'H', ''),
(269, '4', '5', 'A', ''),
(270, '4', '5', 'B', ''),
(271, '4', '5', 'C', ''),
(272, '4', '5', 'D', ''),
(273, '4', '5', 'E', ''),
(274, '4', '5', 'F', ''),
(275, '4', '5', 'G', ''),
(276, '4', '5', 'H', ''),
(277, '4', '6', 'A', ''),
(278, '4', '6', 'B', ''),
(279, '4', '6', 'C', ''),
(280, '4', '6', 'D', ''),
(281, '4', '6', 'E', ''),
(282, '4', '6', 'F', ''),
(283, '4', '6', 'G', ''),
(284, '4', '6', 'H', ''),
(285, '4', '7', 'A', ''),
(286, '4', '7', 'B', ''),
(287, '4', '7', 'C', ''),
(288, '4', '7', 'D', ''),
(289, '4', '7', 'E', ''),
(290, '4', '7', 'F', ''),
(291, '4', '7', 'G', ''),
(292, '4', '7', 'H', ''),
(293, '6', '1', 'A', ''),
(294, '6', '1', 'B', ''),
(295, '6', '1', 'C', ''),
(296, '6', '1', 'D', ''),
(297, '6', '1', 'E', ''),
(298, '6', '1', 'F', ''),
(299, '6', '1', 'G', ''),
(300, '6', '1', 'H', ''),
(301, '6', '2', 'A', ''),
(302, '6', '2', 'B', ''),
(303, '6', '2', 'C', ''),
(304, '6', '2', 'D', ''),
(305, '6', '2', 'E', ''),
(306, '6', '2', 'F', ''),
(307, '6', '2', 'G', ''),
(308, '6', '2', 'H', ''),
(309, '6', '3', 'A', ''),
(310, '6', '3', 'B', ''),
(311, '6', '3', 'C', ''),
(312, '6', '3', 'D', ''),
(313, '6', '3', 'E', ''),
(314, '6', '3', 'F', ''),
(315, '6', '3', 'G', ''),
(316, '6', '3', 'H', ''),
(317, '6', '4', 'A', ''),
(318, '6', '4', 'B', ''),
(319, '6', '4', 'C', ''),
(320, '6', '4', 'D', ''),
(321, '6', '4', 'E', ''),
(322, '6', '4', 'F', ''),
(323, '6', '4', 'G', ''),
(324, '6', '4', 'H', ''),
(325, '6', '5', 'A', ''),
(326, '6', '5', 'B', ''),
(327, '6', '5', 'C', ''),
(328, '6', '5', 'D', ''),
(329, '6', '5', 'E', ''),
(330, '6', '5', 'F', ''),
(331, '6', '5', 'G', ''),
(332, '6', '5', 'H', ''),
(333, '6', '6', 'A', ''),
(334, '6', '6', 'B', ''),
(335, '6', '6', 'C', ''),
(336, '6', '6', 'D', ''),
(337, '6', '6', 'E', ''),
(338, '6', '6', 'F', ''),
(339, '6', '6', 'G', ''),
(340, '6', '6', 'H', ''),
(341, '6', '7', 'A', ''),
(342, '6', '7', 'B', ''),
(343, '6', '7', 'C', ''),
(344, '6', '7', 'D', ''),
(345, '6', '7', 'E', ''),
(346, '6', '7', 'F', ''),
(347, '6', '7', 'G', ''),
(348, '6', '7', 'H', ''),
(349, '2', '8', 'A', ''),
(350, '2', '8', 'B', ''),
(351, '2', '8', 'C', ''),
(352, '2', '8', 'D', ''),
(353, '2', '8', 'E', ''),
(354, '2', '8', 'F', ''),
(355, '2', '8', 'G', ''),
(356, '2', '8', 'H', ''),
(357, '3', '8', 'A', ''),
(358, '3', '8', 'B', ''),
(359, '3', '8', 'C', ''),
(360, '3', '8', 'D', ''),
(361, '1', '8', 'A', ''),
(362, '1', '8', 'B', ''),
(363, '1', '8', 'C', ''),
(364, '1', '8', 'D', ''),
(365, '1', '8', 'E', ''),
(366, '1', '8', 'F', ''),
(367, '5', '8', 'A', ''),
(368, '5', '8', 'B', ''),
(369, '5', '8', 'C', ''),
(370, '5', '8', 'D', ''),
(371, '5', '1', 'A', 'PIL'),
(372, '5', '0', 'A', 'PIL'),
(373, '5', '1', 'J', ''),
(374, '5', '1', 'J', 'PIL'),
(375, '5', '0', 'A', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kuisioner`
--

CREATE TABLE `tb_kuisioner` (
  `id_kuisioner` int(11) NOT NULL,
  `status_login_responder` varchar(50) NOT NULL,
  `username_responder` char(50) NOT NULL,
  `statement1` varchar(50) NOT NULL,
  `statement2` varchar(50) NOT NULL,
  `statement3` varchar(50) NOT NULL,
  `statement4` varchar(50) NOT NULL,
  `statement5` varchar(50) NOT NULL,
  `statement6` varchar(50) NOT NULL,
  `statement7` varchar(50) NOT NULL,
  `statement8` varchar(50) NOT NULL,
  `statement9` varchar(50) NOT NULL,
  `statement10` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kuisioner`
--

INSERT INTO `tb_kuisioner` (`id_kuisioner`, `status_login_responder`, `username_responder`, `statement1`, `statement2`, `statement3`, `statement4`, `statement5`, `statement6`, `statement7`, `statement8`, `statement9`, `statement10`, `status`) VALUES
(4, 'Dosen', '55555555555', 'S', 'S', 'SS', 'SS', 'S', 'S', 'SS', 'S', 'S', 'SS', 'Tersedia'),
(5, 'Dosen', '50314068701', 'S', 'TS', 'S', 'TS', 'STS', 'S', 'STS', 'SS', 'SS', 'S', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_log`
--

CREATE TABLE `tb_log` (
  `id_log` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `status_login` varchar(50) NOT NULL,
  `waktu_log` datetime NOT NULL DEFAULT current_timestamp(),
  `aktifitas` text NOT NULL,
  `aktifitas_detail` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_log`
--

INSERT INTO `tb_log` (`id_log`, `username`, `status_login`, `waktu_log`, `aktifitas`, `aktifitas_detail`, `status`) VALUES
(4, '21014028904', 'Dosen', '2021-11-14 11:00:56', 'Login', 'Login berhasil', 'Tersedia'),
(5, 'superadmin34', 'Prodi', '2021-11-14 12:22:55', 'Login', 'Login berhasil', 'Tersedia'),
(6, '41030127104', 'Dosen', '2021-11-14 20:19:31', 'Login', 'Login berhasil', 'Tersedia'),
(7, '21007108201', 'Dosen', '2021-11-14 21:14:44', 'Login', 'Login berhasil', 'Tersedia'),
(8, '41028067803', 'Dosen', '2021-11-14 21:15:25', 'Login', 'Login berhasil', 'Tersedia'),
(9, '41023047701', 'Dosen', '2021-11-14 21:27:09', 'Login', 'Login berhasil', 'Tersedia'),
(10, 'superadmin34', 'Prodi', '2021-11-14 22:21:16', 'Login', 'Login berhasil', 'Tersedia'),
(11, '41018028601', 'Dosen', '2021-11-14 22:23:09', 'Login', 'Login berhasil', 'Tersedia'),
(12, '50225051994', 'Dosen', '2021-11-14 22:38:52', 'Login', 'Login berhasil', 'Tersedia'),
(13, '51023027904', 'Dosen', '2021-11-15 00:00:37', 'Login', 'Login berhasil', 'Tersedia'),
(14, '21006118301', 'Dosen', '2021-11-15 01:07:49', 'Login', 'Login berhasil', 'Tersedia'),
(15, '41023047701', 'Dosen', '2021-11-15 05:36:26', 'Login', 'Login berhasil', 'Tersedia'),
(16, '51015047503', 'Dosen', '2021-11-15 05:43:33', 'Login', 'Login berhasil', 'Tersedia'),
(17, '51016048502', 'Dosen', '2021-11-15 05:44:24', 'Login', 'Login berhasil', 'Tersedia'),
(18, '41030046903', 'Dosen', '2021-11-15 06:40:15', 'Login', 'Login berhasil', 'Tersedia'),
(19, '50225051994', 'Dosen', '2021-11-15 06:47:33', 'Login', 'Login berhasil', 'Tersedia'),
(20, '30027075901', 'Dosen', '2021-11-15 07:07:19', 'Login', 'Login berhasil', 'Tersedia'),
(21, '61008097501', 'Dosen', '2021-11-15 07:26:55', 'Login', 'Login berhasil', 'Tersedia'),
(22, '21006118301', 'Dosen', '2021-11-15 07:30:09', 'Login', 'Login berhasil', 'Tersedia'),
(23, 'superadmin36', 'Prodi', '2021-11-15 07:40:46', 'Login', 'Login berhasil', 'Tersedia'),
(24, '21005047603', 'Dosen', '2021-11-15 07:41:21', 'Login', 'Login berhasil', 'Tersedia'),
(25, '31005047603', 'Dosen', '2021-11-15 07:43:42', 'Login', 'Login berhasil', 'Tersedia'),
(26, '41005038401', 'Dosen', '2021-11-15 07:44:21', 'Login', 'Login berhasil', 'Tersedia'),
(27, '31005017502', 'Dosen', '2021-11-15 07:48:34', 'Login', 'Login berhasil', 'Tersedia'),
(28, 'admin31sipil', 'Prodi', '2021-11-15 08:07:04', 'Login', 'Login berhasil', 'Tersedia'),
(29, 'admin35adminTI', 'Prodi', '2021-11-15 08:07:55', 'Login', 'Login berhasil', 'Tersedia'),
(30, 'admin33PK21060804', 'Prodi', '2021-11-15 08:08:29', 'Login', 'Login berhasil', 'Tersedia'),
(31, 'admin31sipil', 'Prodi', '2021-11-15 08:09:08', 'Login', 'Login berhasil', 'Tersedia'),
(32, 'admintu93', 'Tata Usaha', '2021-11-15 08:13:56', 'Login', 'Login berhasil', 'Tersedia'),
(33, '31018117803', 'Dosen', '2021-11-15 08:14:17', 'Login', 'Login berhasil', 'Tersedia'),
(34, '11015029101', 'Dosen', '2021-11-15 08:14:26', 'Login', 'Login berhasil', 'Tersedia'),
(35, 'admin31sipil', 'Prodi', '2021-11-15 08:15:01', 'Login', 'Login berhasil', 'Tersedia'),
(36, '21021088201', 'Dosen', '2021-11-15 08:38:12', 'Login', 'Login berhasil', 'Tersedia'),
(37, '50009088102', 'Dosen', '2021-11-15 08:40:31', 'Login', 'Login berhasil', 'Tersedia'),
(38, 'tu', 'Tata Usaha', '2021-11-15 08:40:36', 'Login', 'Login berhasil', 'Tersedia'),
(39, '11015029101', 'Dosen', '2021-11-15 08:41:18', 'Login', 'Login berhasil', 'Tersedia'),
(40, '51031126801', 'Dosen', '2021-11-15 08:42:33', 'Login', 'Login berhasil', 'Tersedia'),
(41, 'superadmin36', 'Prodi', '2021-11-15 08:53:07', 'Login', 'Login berhasil', 'Tersedia'),
(42, 'admintu93', 'Tata Usaha', '2021-11-15 08:56:27', 'Login', 'Login berhasil', 'Tersedia'),
(43, '51010105701', 'Dosen', '2021-11-15 08:57:02', 'Login', 'Login berhasil', 'Tersedia'),
(44, 'admin35adminTI', 'Prodi', '2021-11-15 08:58:12', 'Login', 'Login berhasil', 'Tersedia'),
(45, '21027118403', 'Dosen', '2021-11-15 09:12:18', 'Login', 'Login berhasil', 'Tersedia'),
(46, '11026078603', 'Dosen', '2021-11-15 09:13:45', 'Login', 'Login berhasil', 'Tersedia'),
(47, 'superadmin34', 'Prodi', '2021-11-15 09:24:59', 'Login', 'Login berhasil', 'Tersedia'),
(48, '21013056902', 'Dosen', '2021-11-15 09:27:38', 'Login', 'Login berhasil', 'Tersedia'),
(49, '41018028601', 'Dosen', '2021-11-15 09:27:52', 'Login', 'Login berhasil', 'Tersedia'),
(50, '11005057003', 'Dosen', '2021-11-15 09:29:33', 'Login', 'Login berhasil', 'Tersedia'),
(51, 'admin31sipil', 'Prodi', '2021-11-15 09:34:02', 'Login', 'Login berhasil', 'Tersedia'),
(52, '51021038901', 'Dosen', '2021-11-15 09:46:22', 'Login', 'Login berhasil', 'Tersedia'),
(53, 'superadmin32', 'Prodi', '2021-11-15 09:48:55', 'Login', 'Login berhasil', 'Tersedia'),
(54, '51026126801', 'Dosen', '2021-11-15 09:51:08', 'Login', 'Login berhasil', 'Tersedia'),
(55, '41018019103', 'Dosen', '2021-11-15 09:51:13', 'Login', 'Login berhasil', 'Tersedia'),
(56, 'superadmin35', 'Prodi', '2021-11-15 09:54:51', 'Login', 'Login berhasil', 'Tersedia'),
(57, 'superadmin34', 'Prodi', '2021-11-15 09:59:40', 'Login', 'Login berhasil', 'Tersedia'),
(58, '41018028601', 'Dosen', '2021-11-15 10:03:50', 'Login', 'Login berhasil', 'Tersedia'),
(59, '51026126801', 'Dosen', '2021-11-15 10:07:59', 'Login', 'Login berhasil', 'Tersedia'),
(60, '21006118301', 'Dosen', '2021-11-15 10:09:05', 'Login', 'Login berhasil', 'Tersedia'),
(61, 'superadmin35', 'Prodi', '2021-11-15 10:17:18', 'Login', 'Login berhasil', 'Tersedia'),
(62, '21015019202', 'Dosen', '2021-11-15 10:24:37', 'Login', 'Login berhasil', 'Tersedia'),
(63, '51013078302', 'Dosen', '2021-11-15 10:32:08', 'Login', 'Login berhasil', 'Tersedia'),
(64, '21001118101', 'Dosen', '2021-11-15 10:34:34', 'Login', 'Login berhasil', 'Tersedia'),
(65, '41013078302', 'Dosen', '2021-11-15 10:35:59', 'Login', 'Login berhasil', 'Tersedia'),
(66, 'tu', 'Tata Usaha', '2021-11-15 10:36:34', 'Login', 'Login berhasil', 'Tersedia'),
(67, '41018028601', 'Dosen', '2021-11-15 10:39:30', 'Login', 'Login berhasil', 'Tersedia'),
(68, '41018028601', 'Dosen', '2021-11-15 10:44:24', 'Login', 'Login berhasil', 'Tersedia'),
(69, 'superadmin35', 'Prodi', '2021-11-15 10:53:02', 'Login', 'Login berhasil', 'Tersedia'),
(70, '41030048902', 'Dosen', '2021-11-15 11:03:03', 'Login', 'Login berhasil', 'Tersedia'),
(71, '51030048902', 'Dosen', '2021-11-15 11:03:42', 'Login', 'Login berhasil', 'Tersedia'),
(72, '31005017502', 'Dosen', '2021-11-15 11:05:43', 'Login', 'Login berhasil', 'Tersedia'),
(73, '41030048902', 'Dosen', '2021-11-15 11:12:47', 'Login', 'Login berhasil', 'Tersedia'),
(74, '51026126801', 'Dosen', '2021-11-15 11:17:57', 'Login', 'Login berhasil', 'Tersedia'),
(75, '50009088102', 'Dosen', '2021-11-15 11:24:50', 'Login', 'Login berhasil', 'Tersedia'),
(76, '21009097501', 'Dosen', '2021-11-15 11:33:59', 'Login', 'Login berhasil', 'Tersedia'),
(77, '21027118403', 'Dosen', '2021-11-15 12:03:56', 'Login', 'Login berhasil', 'Tersedia'),
(78, 'superadmin34', 'Prodi', '2021-11-15 12:11:54', 'Login', 'Login berhasil', 'Tersedia'),
(79, '41018028601', 'Dosen', '2021-11-15 12:18:09', 'Login', 'Login berhasil', 'Tersedia'),
(80, 'superadmin34', 'Prodi', '2021-11-15 12:19:33', 'Login', 'Login berhasil', 'Tersedia'),
(81, '11013066803', 'Dosen', '2021-11-15 12:31:05', 'Login', 'Login berhasil', 'Tersedia'),
(82, '21025118802', 'Dosen', '2021-11-15 12:38:58', 'Login', 'Login berhasil', 'Tersedia'),
(83, '51025118802', 'Dosen', '2021-11-15 12:45:27', 'Login', 'Login berhasil', 'Tersedia'),
(84, '41018019103', 'Dosen', '2021-11-15 12:57:18', 'Login', 'Login berhasil', 'Tersedia'),
(85, '11008097501', 'Dosen', '2021-11-15 12:59:09', 'Login', 'Login berhasil', 'Tersedia'),
(86, '61008097501', 'Dosen', '2021-11-15 13:01:16', 'Login', 'Login berhasil', 'Tersedia'),
(87, '51020038101', 'Dosen', '2021-11-15 13:03:58', 'Login', 'Login berhasil', 'Tersedia'),
(88, '21007108201', 'Dosen', '2021-11-15 13:07:10', 'Login', 'Login berhasil', 'Tersedia'),
(89, '21006118301', 'Dosen', '2021-11-15 13:26:25', 'Login', 'Login berhasil', 'Tersedia'),
(90, '11015068204', 'Dosen', '2021-11-15 13:26:28', 'Login', 'Login berhasil', 'Tersedia'),
(91, '61014028602', 'Dosen', '2021-11-15 13:48:16', 'Login', 'Login berhasil', 'Tersedia'),
(92, 'superadmin36', 'Prodi', '2021-11-15 13:49:29', 'Login', 'Login berhasil', 'Tersedia'),
(93, 'superadmin32', 'Prodi', '2021-11-15 13:58:32', 'Login', 'Login berhasil', 'Tersedia'),
(94, '11015029101', 'Dosen', '2021-11-15 14:11:50', 'Login', 'Login berhasil', 'Tersedia'),
(95, '30027075901', 'Dosen', '2021-11-15 14:12:26', 'Login', 'Login berhasil', 'Tersedia'),
(96, '21018088201', 'Dosen', '2021-11-15 14:23:52', 'Login', 'Login berhasil', 'Tersedia'),
(97, 'admin31sipil', 'Prodi', '2021-11-15 14:39:05', 'Login', 'Login berhasil', 'Tersedia'),
(98, '21014028904', 'Dosen', '2021-11-15 15:03:56', 'Login', 'Login berhasil', 'Tersedia'),
(99, 'admin32191002819', 'Prodi', '2021-11-15 15:10:46', 'Login', 'Login berhasil', 'Tersedia'),
(100, '50225051994', 'Dosen', '2021-11-15 15:19:41', 'Login', 'Login berhasil', 'Tersedia'),
(101, '51026126801', 'Dosen', '2021-11-15 15:20:03', 'Login', 'Login berhasil', 'Tersedia'),
(102, '51011088304', 'Dosen', '2021-11-15 15:55:08', 'Login', 'Login berhasil', 'Tersedia'),
(103, '21011088304', 'Dosen', '2021-11-15 15:57:42', 'Login', 'Login berhasil', 'Tersedia'),
(104, '61008058901', 'Dosen', '2021-11-15 16:19:47', 'Login', 'Login berhasil', 'Tersedia'),
(105, '31008058901', 'Dosen', '2021-11-15 16:23:18', 'Login', 'Login berhasil', 'Tersedia'),
(106, '51004079401', 'Dosen', '2021-11-15 16:25:43', 'Login', 'Login berhasil', 'Tersedia'),
(107, '21004079401', 'Dosen', '2021-11-15 16:26:08', 'Login', 'Login berhasil', 'Tersedia'),
(108, '41004079401', 'Dosen', '2021-11-15 16:27:39', 'Login', 'Login berhasil', 'Tersedia'),
(109, '51004079401', 'Dosen', '2021-11-15 16:28:27', 'Login', 'Login berhasil', 'Tersedia'),
(110, 'admin35adminTI', 'Prodi', '2021-11-15 16:38:43', 'Login', 'Login berhasil', 'Tersedia'),
(111, '21012048802', 'Dosen', '2021-11-15 16:50:43', 'Login', 'Login berhasil', 'Tersedia'),
(112, '51029078701', 'Dosen', '2021-11-15 17:38:51', 'Login', 'Login berhasil', 'Tersedia'),
(113, '41028067803', 'Dosen', '2021-11-15 18:07:47', 'Login', 'Login berhasil', 'Tersedia'),
(114, '21027118403', 'Dosen', '2021-11-15 18:23:10', 'Login', 'Login berhasil', 'Tersedia'),
(115, '11029048803', 'Dosen', '2021-11-15 19:10:03', 'Login', 'Login berhasil', 'Tersedia'),
(116, '61008097501', 'Dosen', '2021-11-15 19:17:30', 'Login', 'Login berhasil', 'Tersedia'),
(117, '11008118901', 'Dosen', '2021-11-15 19:52:59', 'Login', 'Login berhasil', 'Tersedia'),
(118, '31005017502', 'Dosen', '2021-11-15 20:23:56', 'Login', 'Login berhasil', 'Tersedia'),
(119, '300200561009', 'Dosen', '2021-11-15 20:57:34', 'Login', 'Login berhasil', 'Tersedia'),
(120, '61014028602', 'Dosen', '2021-11-15 21:21:50', 'Login', 'Login berhasil', 'Tersedia'),
(121, '51017018001', 'Dosen', '2021-11-15 21:38:34', 'Login', 'Login berhasil', 'Tersedia'),
(122, '11005057003', 'Dosen', '2021-11-15 21:55:25', 'Login', 'Login berhasil', 'Tersedia'),
(123, '21025118802', 'Dosen', '2021-11-15 22:32:18', 'Login', 'Login berhasil', 'Tersedia'),
(124, '51002118702', 'Dosen', '2021-11-15 22:52:05', 'Login', 'Login berhasil', 'Tersedia'),
(125, '21014028904', 'Dosen', '2021-11-15 23:00:24', 'Login', 'Login berhasil', 'Tersedia'),
(126, '51015047503', 'Dosen', '2021-11-16 00:02:34', 'Login', 'Login berhasil', 'Tersedia'),
(127, '41023047701', 'Dosen', '2021-11-16 05:25:21', 'Login', 'Login berhasil', 'Tersedia'),
(128, '11011076202', 'Dosen', '2021-11-16 05:42:59', 'Login', 'Login berhasil', 'Tersedia'),
(129, '50314068701', 'Dosen', '2021-11-16 06:44:41', 'Login', 'Login berhasil', 'Tersedia'),
(130, '11029048803', 'Dosen', '2021-11-16 07:00:01', 'Login', 'Login berhasil', 'Tersedia'),
(131, '39910006706', 'Dosen', '2021-11-16 07:20:24', 'Login', 'Login berhasil', 'Tersedia'),
(132, '21027118403', 'Dosen', '2021-11-16 07:38:35', 'Login', 'Login berhasil', 'Tersedia'),
(133, '21016048502', 'Dosen', '2021-11-16 07:44:31', 'Login', 'Login berhasil', 'Tersedia'),
(134, '21004079401', 'Dosen', '2021-11-16 07:44:36', 'Login', 'Login berhasil', 'Tersedia'),
(135, '11005057003', 'Dosen', '2021-11-16 08:05:06', 'Login', 'Login berhasil', 'Tersedia'),
(136, '21031126801', 'Dosen', '2021-11-16 08:07:57', 'Login', 'Login berhasil', 'Tersedia'),
(137, 'admin31sipil', 'Prodi', '2021-11-16 08:23:16', 'Login', 'Login berhasil', 'Tersedia'),
(138, 'admin35adminTI', 'Prodi', '2021-11-16 08:25:41', 'Login', 'Login berhasil', 'Tersedia'),
(139, 'admin33PK21060804', 'Prodi', '2021-11-16 08:28:23', 'Login', 'Login berhasil', 'Tersedia'),
(140, 'admintu93', 'Tata Usaha', '2021-11-16 08:32:54', 'Login', 'Login berhasil', 'Tersedia'),
(141, '11011076202', 'Dosen', '2021-11-16 08:33:28', 'Login', 'Login berhasil', 'Tersedia'),
(142, 'admin31sipil', 'Prodi', '2021-11-16 08:36:14', 'Login', 'Login berhasil', 'Tersedia'),
(143, 'tu', 'Tata Usaha', '2021-11-16 08:41:39', 'Login', 'Login berhasil', 'Tersedia'),
(144, '41030127104', 'Dosen', '2021-11-16 08:52:27', 'Login', 'Login berhasil', 'Tersedia'),
(145, '21031126801', 'Dosen', '2021-11-16 08:55:57', 'Login', 'Login berhasil', 'Tersedia'),
(146, '28820423419', 'Dosen', '2021-11-16 08:59:39', 'Login', 'Login berhasil', 'Tersedia'),
(147, '50009088102', 'Dosen', '2021-11-16 09:20:36', 'Login', 'Login berhasil', 'Tersedia'),
(148, '11015038302', 'Dosen', '2021-11-16 09:30:01', 'Login', 'Login berhasil', 'Tersedia'),
(149, '61026118801', 'Dosen', '2021-11-16 09:42:57', 'Login', 'Login berhasil', 'Tersedia'),
(150, 'admintu93', 'Tata Usaha', '2021-11-16 09:45:00', 'Login', 'Login berhasil', 'Tersedia'),
(151, '21004079401', 'Dosen', '2021-11-16 10:08:15', 'Login', 'Login berhasil', 'Tersedia'),
(152, '21027118403', 'Dosen', '2021-11-16 10:29:55', 'Login', 'Login berhasil', 'Tersedia'),
(153, 'admin31sipil', 'Prodi', '2021-11-16 10:35:11', 'Login', 'Login berhasil', 'Tersedia'),
(154, '31010127502', 'Dosen', '2021-11-16 10:35:12', 'Login', 'Login berhasil', 'Tersedia'),
(155, '11015029101', 'Dosen', '2021-11-16 10:56:43', 'Login', 'Login berhasil', 'Tersedia'),
(156, 'superadmin36', 'Prodi', '2021-11-16 10:58:45', 'Login', 'Login berhasil', 'Tersedia'),
(157, '21014028904', 'Dosen', '2021-11-16 11:17:47', 'Login', 'Login berhasil', 'Tersedia'),
(158, 'admin32191002819', 'Prodi', '2021-11-16 11:33:22', 'Login', 'Login berhasil', 'Tersedia'),
(159, 'superadmin36', 'Prodi', '2021-11-16 12:08:50', 'Login', 'Login berhasil', 'Tersedia'),
(160, '31009038504', 'Dosen', '2021-11-16 12:16:02', 'Login', 'Login berhasil', 'Tersedia'),
(161, '31005017502', 'Dosen', '2021-11-16 12:21:07', 'Login', 'Login berhasil', 'Tersedia'),
(162, 'superadmin33', 'Prodi', '2021-11-16 12:21:16', 'Login', 'Login berhasil', 'Tersedia'),
(163, '31009038504', 'Dosen', '2021-11-16 12:22:06', 'Login', 'Login berhasil', 'Tersedia'),
(164, '11015068204', 'Dosen', '2021-11-16 12:34:20', 'Login', 'Login berhasil', 'Tersedia'),
(165, '11026078603', 'Dosen', '2021-11-16 13:01:07', 'Login', 'Login berhasil', 'Tersedia'),
(166, '21012068702', 'Dosen', '2021-11-16 13:03:32', 'Login', 'Login berhasil', 'Tersedia'),
(167, '21007108201', 'Dosen', '2021-11-16 13:12:17', 'Login', 'Login berhasil', 'Tersedia'),
(168, '21027118403', 'Dosen', '2021-11-16 13:17:02', 'Login', 'Login berhasil', 'Tersedia'),
(169, '21018088201', 'Dosen', '2021-11-16 13:35:38', 'Login', 'Login berhasil', 'Tersedia'),
(170, '11015029101', 'Dosen', '2021-11-16 13:40:40', 'Login', 'Login berhasil', 'Tersedia'),
(171, 'admintu93', 'Tata Usaha', '2021-11-16 13:42:07', 'Login', 'Login berhasil', 'Tersedia'),
(172, '11011076202', 'Dosen', '2021-11-16 13:42:43', 'Login', 'Login berhasil', 'Tersedia'),
(173, 'admin31sipil', 'Prodi', '2021-11-16 13:43:37', 'Login', 'Login berhasil', 'Tersedia'),
(174, '51010105701', 'Dosen', '2021-11-16 13:46:33', 'Login', 'Login berhasil', 'Tersedia'),
(175, 'admin35adminTI', 'Prodi', '2021-11-16 14:03:58', 'Login', 'Login berhasil', 'Tersedia'),
(176, '51025118802', 'Dosen', '2021-11-16 14:19:20', 'Login', 'Login berhasil', 'Tersedia'),
(177, '31005047603', 'Dosen', '2021-11-16 14:43:22', 'Login', 'Login berhasil', 'Tersedia'),
(178, '51010059101', 'Dosen', '2021-11-16 15:00:15', 'Login', 'Login berhasil', 'Tersedia'),
(179, '31030048902', 'Dosen', '2021-11-16 15:00:45', 'Login', 'Login berhasil', 'Tersedia'),
(180, 'tu', 'Tata Usaha', '2021-11-16 15:06:21', 'Login', 'Login berhasil', 'Tersedia'),
(181, '41018028601', 'Dosen', '2021-11-16 15:06:50', 'Login', 'Login berhasil', 'Tersedia'),
(182, '51010105701', 'Dosen', '2021-11-16 15:07:16', 'Login', 'Login berhasil', 'Tersedia'),
(183, 'superadmin34', 'Prodi', '2021-11-16 15:13:17', 'Login', 'Login berhasil', 'Tersedia'),
(184, '31008058901', 'Dosen', '2021-11-16 15:17:54', 'Login', 'Login berhasil', 'Tersedia'),
(185, '61012078704', 'Dosen', '2021-11-16 15:31:36', 'Login', 'Login berhasil', 'Tersedia'),
(186, '51010059101', 'Dosen', '2021-11-16 15:47:42', 'Login', 'Login berhasil', 'Tersedia'),
(187, 'wd1', 'Fakultas', '2021-11-16 16:07:15', 'Login', 'Login berhasil', 'Tersedia'),
(188, '11015068204', 'Dosen', '2021-11-16 16:13:14', 'Login', 'Login berhasil', 'Tersedia'),
(189, '11004118406', 'Dosen', '2021-11-16 16:17:31', 'Login', 'Login berhasil', 'Tersedia'),
(190, 'admin31sipil', 'Prodi', '2021-11-16 16:24:12', 'Login', 'Login berhasil', 'Tersedia'),
(191, 'admin33PK21060804', 'Prodi', '2021-11-16 16:26:21', 'Login', 'Login berhasil', 'Tersedia'),
(192, '21027118403', 'Dosen', '2021-11-16 16:44:23', 'Login', 'Login berhasil', 'Tersedia'),
(193, '21012048802', 'Dosen', '2021-11-16 17:03:39', 'Login', 'Login berhasil', 'Tersedia'),
(194, '51026126801', 'Dosen', '2021-11-16 17:34:39', 'Login', 'Login berhasil', 'Tersedia'),
(195, '21015019202', 'Dosen', '2021-11-16 18:47:01', 'Login', 'Login berhasil', 'Tersedia'),
(196, '41029088701', 'Dosen', '2021-11-16 21:05:03', 'Login', 'Login berhasil', 'Tersedia'),
(197, '39910006706', 'Dosen', '2021-11-16 21:21:27', 'Login', 'Login berhasil', 'Tersedia'),
(198, '21014028904', 'Dosen', '2021-11-16 21:32:32', 'Login', 'Login berhasil', 'Tersedia'),
(199, '21010048904', 'Dosen', '2021-11-16 21:45:39', 'Login', 'Login berhasil', 'Tersedia'),
(200, '51017018001', 'Dosen', '2021-11-16 22:14:20', 'Login', 'Login berhasil', 'Tersedia'),
(201, '11015068204', 'Dosen', '2021-11-16 22:21:39', 'Login', 'Login berhasil', 'Tersedia'),
(202, '41005038401', 'Dosen', '2021-11-16 22:31:16', 'Login', 'Login berhasil', 'Tersedia'),
(203, '11013066803', 'Dosen', '2021-11-16 23:11:30', 'Login', 'Login berhasil', 'Tersedia'),
(204, '61010118403', 'Dosen', '2021-11-17 05:52:33', 'Login', 'Login berhasil', 'Tersedia'),
(205, 'superadmin36', 'Prodi', '2021-11-17 06:03:08', 'Login', 'Login berhasil', 'Tersedia'),
(206, 'superadmin36', 'Prodi', '2021-11-17 06:05:33', 'Login', 'Login berhasil', 'Tersedia'),
(207, '61010118403', 'Dosen', '2021-11-17 06:06:07', 'Login', 'Login berhasil', 'Tersedia'),
(208, '51002118702', 'Dosen', '2021-11-17 07:39:11', 'Login', 'Login berhasil', 'Tersedia'),
(209, '31005017502', 'Dosen', '2021-11-17 07:54:29', 'Login', 'Login berhasil', 'Tersedia'),
(210, '21031126801', 'Dosen', '2021-11-17 08:10:07', 'Login', 'Login berhasil', 'Tersedia'),
(211, 'admin31sipil', 'Prodi', '2021-11-17 08:10:17', 'Login', 'Login berhasil', 'Tersedia'),
(212, '51031126801', 'Dosen', '2021-11-17 08:14:43', 'Login', 'Login berhasil', 'Tersedia'),
(213, 'admin33PK21060804', 'Prodi', '2021-11-17 08:20:11', 'Login', 'Login berhasil', 'Tersedia'),
(214, 'admin35adminTI', 'Prodi', '2021-11-17 08:22:33', 'Login', 'Login berhasil', 'Tersedia'),
(215, '21009097501', 'Dosen', '2021-11-17 08:42:29', 'Login', 'Login berhasil', 'Tersedia'),
(216, 'admin32191002819', 'Prodi', '2021-11-17 08:46:34', 'Login', 'Login berhasil', 'Tersedia'),
(217, '51031126801', 'Dosen', '2021-11-17 08:46:58', 'Login', 'Login berhasil', 'Tersedia'),
(218, '21031126801', 'Dosen', '2021-11-17 08:49:25', 'Login', 'Login berhasil', 'Tersedia'),
(219, '11029048803', 'Dosen', '2021-11-17 08:54:16', 'Login', 'Login berhasil', 'Tersedia'),
(220, '11008097501', 'Dosen', '2021-11-17 09:02:59', 'Login', 'Login berhasil', 'Tersedia'),
(221, 'superadmin33', 'Prodi', '2021-11-17 09:05:43', 'Login', 'Login berhasil', 'Tersedia'),
(222, '61008097501', 'Dosen', '2021-11-17 09:09:58', 'Login', 'Login berhasil', 'Tersedia'),
(223, 'admin31sipil', 'Prodi', '2021-11-17 09:10:11', 'Login', 'Login berhasil', 'Tersedia'),
(224, '11008097501', 'Dosen', '2021-11-17 09:10:31', 'Login', 'Login berhasil', 'Tersedia'),
(225, 'admintu93', 'Tata Usaha', '2021-11-17 09:10:34', 'Login', 'Login berhasil', 'Tersedia'),
(226, 'admintu93', 'Tata Usaha', '2021-11-17 09:11:11', 'Login', 'Login berhasil', 'Tersedia'),
(227, '41019057202', 'Dosen', '2021-11-17 09:11:25', 'Login', 'Login berhasil', 'Tersedia'),
(228, '11008097501', 'Dosen', '2021-11-17 09:11:38', 'Login', 'Login berhasil', 'Tersedia'),
(229, 'admin31sipil', 'Prodi', '2021-11-17 09:15:01', 'Login', 'Login berhasil', 'Tersedia'),
(230, '21012068702', 'Dosen', '2021-11-17 09:19:38', 'Login', 'Login berhasil', 'Tersedia'),
(231, '31028108902', 'Dosen', '2021-11-17 09:23:47', 'Login', 'Login berhasil', 'Tersedia'),
(232, '61012068702', 'Dosen', '2021-11-17 09:26:00', 'Login', 'Login berhasil', 'Tersedia'),
(233, '21016048502', 'Dosen', '2021-11-17 09:27:16', 'Login', 'Login berhasil', 'Tersedia'),
(234, '51031126801', 'Dosen', '2021-11-17 09:29:39', 'Login', 'Login berhasil', 'Tersedia'),
(235, '11005057003', 'Dosen', '2021-11-17 09:30:04', 'Login', 'Login berhasil', 'Tersedia'),
(236, 'admintu93', 'Tata Usaha', '2021-11-17 09:32:48', 'Login', 'Login berhasil', 'Tersedia'),
(237, 'superadmin32', 'Prodi', '2021-11-17 09:32:58', 'Login', 'Login berhasil', 'Tersedia'),
(238, '31010127502', 'Dosen', '2021-11-17 09:33:40', 'Login', 'Login berhasil', 'Tersedia'),
(239, 'superadmin33', 'Prodi', '2021-11-17 09:34:09', 'Login', 'Login berhasil', 'Tersedia'),
(240, 'tu', 'Tata Usaha', '2021-11-17 09:37:51', 'Login', 'Login berhasil', 'Tersedia'),
(241, 'superadmin31', 'Prodi', '2021-11-17 09:40:08', 'Login', 'Login berhasil', 'Tersedia'),
(242, '41018028601', 'Dosen', '2021-11-17 09:40:13', 'Login', 'Login berhasil', 'Tersedia'),
(243, '41018028601', 'Dosen', '2021-11-17 09:40:52', 'Login', 'Login berhasil', 'Tersedia'),
(244, 'admin33PK21060804', 'Prodi', '2021-11-17 09:44:37', 'Login', 'Login berhasil', 'Tersedia'),
(245, '41013078302', 'Dosen', '2021-11-17 09:51:46', 'Login', 'Login berhasil', 'Tersedia'),
(246, '51026126801', 'Dosen', '2021-11-17 10:02:09', 'Login', 'Login berhasil', 'Tersedia'),
(247, '31009038504', 'Dosen', '2021-11-17 10:04:05', 'Login', 'Login berhasil', 'Tersedia'),
(248, '21027118403', 'Dosen', '2021-11-17 10:09:52', 'Login', 'Login berhasil', 'Tersedia'),
(249, 'superadmin36', 'Prodi', '2021-11-17 10:29:27', 'Login', 'Login berhasil', 'Tersedia'),
(250, '50009088102', 'Dosen', '2021-11-17 10:41:07', 'Login', 'Login berhasil', 'Tersedia'),
(251, '11013066803', 'Dosen', '2021-11-17 10:44:49', 'Login', 'Login berhasil', 'Tersedia'),
(252, '11005057003', 'Dosen', '2021-11-17 10:52:17', 'Login', 'Login berhasil', 'Tersedia'),
(253, '41030127104', 'Dosen', '2021-11-17 11:14:22', 'Login', 'Login berhasil', 'Tersedia'),
(254, '31030058202', 'Dosen', '2021-11-17 11:27:50', 'Login', 'Login berhasil', 'Tersedia'),
(255, 'admin32191002819', 'Prodi', '2021-11-17 11:38:35', 'Login', 'Login berhasil', 'Tersedia'),
(256, '41013078302', 'Dosen', '2021-11-17 11:39:50', 'Login', 'Login berhasil', 'Tersedia'),
(257, 'admin341910028193', 'Prodi', '2021-11-17 11:45:22', 'Login', 'Login berhasil', 'Tersedia'),
(258, '51010059101', 'Dosen', '2021-11-17 11:47:20', 'Login', 'Login berhasil', 'Tersedia'),
(259, '51024077901', 'Dosen', '2021-11-17 11:51:38', 'Login', 'Login berhasil', 'Tersedia'),
(260, 'superadmin35', 'Prodi', '2021-11-17 11:56:05', 'Login', 'Login berhasil', 'Tersedia'),
(261, 'superadmin33', 'Prodi', '2021-11-17 12:04:57', 'Login', 'Login berhasil', 'Tersedia'),
(262, '51025078002', 'Dosen', '2021-11-17 12:12:43', 'Login', 'Login berhasil', 'Tersedia'),
(263, '51021038901', 'Dosen', '2021-11-17 12:37:38', 'Login', 'Login berhasil', 'Tersedia'),
(264, '21007108201', 'Dosen', '2021-11-17 13:01:29', 'Login', 'Login berhasil', 'Tersedia'),
(265, '51026126801', 'Dosen', '2021-11-17 13:06:04', 'Login', 'Login berhasil', 'Tersedia'),
(266, '21001118101', 'Dosen', '2021-11-17 13:19:30', 'Login', 'Login berhasil', 'Tersedia'),
(267, 'superadmin35', 'Prodi', '2021-11-17 13:25:23', 'Login', 'Login berhasil', 'Tersedia'),
(268, 'admin35adminTI', 'Prodi', '2021-11-17 13:25:28', 'Login', 'Login berhasil', 'Tersedia'),
(269, 'superadmin36', 'Prodi', '2021-11-17 13:26:07', 'Login', 'Login berhasil', 'Tersedia'),
(270, 'admintu93', 'Tata Usaha', '2021-11-17 13:29:32', 'Login', 'Login berhasil', 'Tersedia'),
(271, '51025078002', 'Dosen', '2021-11-17 13:30:04', 'Login', 'Login berhasil', 'Tersedia'),
(272, '51025078002', 'Dosen', '2021-11-17 13:37:58', 'Login', 'Login berhasil', 'Tersedia'),
(273, '21024078902', 'Dosen', '2021-11-17 13:49:09', 'Login', 'Login berhasil', 'Tersedia'),
(274, '51029078701', 'Dosen', '2021-11-17 13:54:45', 'Login', 'Login berhasil', 'Tersedia'),
(275, '21015019202', 'Dosen', '2021-11-17 13:58:44', 'Login', 'Login berhasil', 'Tersedia'),
(276, '31002129301', 'Dosen', '2021-11-17 14:03:28', 'Login', 'Login berhasil', 'Tersedia'),
(277, 'superadmin36', 'Prodi', '2021-11-17 14:24:24', 'Login', 'Login berhasil', 'Tersedia'),
(278, '21014028904', 'Dosen', '2021-11-17 14:32:36', 'Login', 'Login berhasil', 'Tersedia'),
(279, '31005017502', 'Dosen', '2021-11-17 14:34:18', 'Login', 'Login berhasil', 'Tersedia'),
(280, 'admin35adminTI', 'Prodi', '2021-11-17 14:34:31', 'Login', 'Login berhasil', 'Tersedia'),
(281, '51031126801', 'Dosen', '2021-11-17 14:47:57', 'Login', 'Login berhasil', 'Tersedia'),
(282, '21007108201', 'Dosen', '2021-11-17 14:48:42', 'Login', 'Login berhasil', 'Tersedia'),
(283, '11015068204', 'Dosen', '2021-11-17 14:56:40', 'Login', 'Login berhasil', 'Tersedia'),
(284, '11008097501', 'Dosen', '2021-11-17 15:38:22', 'Login', 'Login berhasil', 'Tersedia'),
(285, '21014028904', 'Dosen', '2021-11-17 15:50:21', 'Login', 'Login berhasil', 'Tersedia'),
(286, 'admin31sipil', 'Prodi', '2021-11-17 15:52:02', 'Login', 'Login berhasil', 'Tersedia'),
(287, 'admintu93', 'Tata Usaha', '2021-11-17 15:53:48', 'Login', 'Login berhasil', 'Tersedia'),
(288, '11015068204', 'Dosen', '2021-11-17 15:54:13', 'Login', 'Login berhasil', 'Tersedia'),
(289, '21004079401', 'Dosen', '2021-11-17 15:58:19', 'Login', 'Login berhasil', 'Tersedia'),
(290, '31008058901', 'Dosen', '2021-11-17 16:02:01', 'Login', 'Login berhasil', 'Tersedia'),
(291, 'superadmin36', 'Prodi', '2021-11-17 16:07:44', 'Login', 'Login berhasil', 'Tersedia'),
(292, 'admin32191002819', 'Prodi', '2021-11-17 16:25:50', 'Login', 'Login berhasil', 'Tersedia'),
(293, '21007108201', 'Dosen', '2021-11-17 17:15:35', 'Login', 'Login berhasil', 'Tersedia'),
(294, '61008097501', 'Dosen', '2021-11-17 17:27:18', 'Login', 'Login berhasil', 'Tersedia'),
(295, '21014028904', 'Dosen', '2021-11-17 18:45:54', 'Login', 'Login berhasil', 'Tersedia'),
(296, '51024077901', 'Dosen', '2021-11-17 19:34:04', 'Login', 'Login berhasil', 'Tersedia'),
(297, 'superadmin35', 'Prodi', '2021-11-17 19:47:35', 'Login', 'Login berhasil', 'Tersedia'),
(298, '51024077901', 'Dosen', '2021-11-17 19:49:16', 'Login', 'Login berhasil', 'Tersedia'),
(299, '61014028602', 'Dosen', '2021-11-17 20:00:34', 'Login', 'Login berhasil', 'Tersedia'),
(300, '41030127104', 'Dosen', '2021-11-17 20:37:25', 'Login', 'Login berhasil', 'Tersedia'),
(301, '51017018001', 'Dosen', '2021-11-17 21:19:43', 'Login', 'Login berhasil', 'Tersedia'),
(302, '41029088701', 'Dosen', '2021-11-17 21:32:19', 'Login', 'Login berhasil', 'Tersedia'),
(303, '11029048803', 'Dosen', '2021-11-17 21:55:36', 'Login', 'Login berhasil', 'Tersedia'),
(304, '51020038101', 'Dosen', '2021-11-17 22:01:29', 'Login', 'Login berhasil', 'Tersedia'),
(305, '51002118702', 'Dosen', '2021-11-17 22:09:16', 'Login', 'Login berhasil', 'Tersedia'),
(306, '21004079401', 'Dosen', '2021-11-17 22:32:51', 'Login', 'Login berhasil', 'Tersedia'),
(307, '11008118901', 'Dosen', '2021-11-17 22:37:07', 'Login', 'Login berhasil', 'Tersedia'),
(308, '51004079401', 'Dosen', '2021-11-17 22:39:41', 'Login', 'Login berhasil', 'Tersedia'),
(309, '41004079401', 'Dosen', '2021-11-17 22:40:11', 'Login', 'Login berhasil', 'Tersedia'),
(310, '51031126801', 'Dosen', '2021-11-17 22:47:04', 'Login', 'Login berhasil', 'Tersedia'),
(311, '31005017502', 'Dosen', '2021-11-18 07:42:04', 'Login', 'Login berhasil', 'Tersedia'),
(312, '61010118403', 'Dosen', '2021-11-18 07:45:28', 'Login', 'Login berhasil', 'Tersedia'),
(313, '50131101992', 'Dosen', '2021-11-18 07:59:25', 'Login', 'Login berhasil', 'Tersedia'),
(314, 'admin31sipil', 'Prodi', '2021-11-18 08:01:48', 'Login', 'Login berhasil', 'Tersedia'),
(315, 'admin35adminTI', 'Prodi', '2021-11-18 08:05:02', 'Login', 'Login berhasil', 'Tersedia'),
(316, 'admin33PK21060804', 'Prodi', '2021-11-18 08:06:13', 'Login', 'Login berhasil', 'Tersedia'),
(317, 'superadmin36', 'Prodi', '2021-11-18 08:13:55', 'Login', 'Login berhasil', 'Tersedia'),
(318, '41018028601', 'Dosen', '2021-11-18 08:15:27', 'Login', 'Login berhasil', 'Tersedia'),
(319, '41018097702', 'Dosen', '2021-11-18 08:16:39', 'Login', 'Login berhasil', 'Tersedia'),
(320, '41018028601', 'Dosen', '2021-11-18 08:17:32', 'Login', 'Login berhasil', 'Tersedia'),
(321, 'superadmin34', 'Prodi', '2021-11-18 08:18:28', 'Login', 'Login berhasil', 'Tersedia'),
(322, '61007108201', 'Dosen', '2021-11-18 08:25:12', 'Login', 'Login berhasil', 'Tersedia'),
(323, '51004079401', 'Dosen', '2021-11-18 08:27:28', 'Login', 'Login berhasil', 'Tersedia'),
(324, '21004079401', 'Dosen', '2021-11-18 08:33:43', 'Login', 'Login berhasil', 'Tersedia'),
(325, 'tu', 'Tata Usaha', '2021-11-18 08:36:52', 'Login', 'Login berhasil', 'Tersedia'),
(326, 'admin32191002819', 'Prodi', '2021-11-18 08:37:14', 'Login', 'Login berhasil', 'Tersedia'),
(327, '21018088201', 'Dosen', '2021-11-18 08:48:44', 'Login', 'Login berhasil', 'Tersedia'),
(328, '51009098801', 'Dosen', '2021-11-18 08:51:20', 'Login', 'Login berhasil', 'Tersedia'),
(329, 'superadmin33', 'Prodi', '2021-11-18 08:51:21', 'Login', 'Login berhasil', 'Tersedia'),
(330, '41030127104', 'Dosen', '2021-11-18 08:54:11', 'Login', 'Login berhasil', 'Tersedia'),
(331, '41004079401', 'Dosen', '2021-11-18 09:00:58', 'Login', 'Login berhasil', 'Tersedia'),
(332, '41018019103', 'Dosen', '2021-11-18 09:03:07', 'Login', 'Login berhasil', 'Tersedia'),
(333, 'superadmin31', 'Prodi', '2021-11-18 09:15:31', 'Login', 'Login berhasil', 'Tersedia'),
(334, 'superadmin36', 'Prodi', '2021-11-18 09:19:36', 'Login', 'Login berhasil', 'Tersedia'),
(335, '11008097501', 'Dosen', '2021-11-18 09:21:50', 'Login', 'Login berhasil', 'Tersedia'),
(336, '21031126801', 'Dosen', '2021-11-18 09:27:03', 'Login', 'Login berhasil', 'Tersedia'),
(337, '41024078802', 'Dosen', '2021-11-18 10:26:18', 'Login', 'Login berhasil', 'Tersedia'),
(338, '41013078302', 'Dosen', '2021-11-18 10:29:31', 'Login', 'Login berhasil', 'Tersedia'),
(339, '51021038901', 'Dosen', '2021-11-18 10:41:37', 'Login', 'Login berhasil', 'Tersedia'),
(340, '51013078302', 'Dosen', '2021-11-18 10:44:26', 'Login', 'Login berhasil', 'Tersedia'),
(341, 'admin341910028193', 'Prodi', '2021-11-18 10:50:35', 'Login', 'Login berhasil', 'Tersedia'),
(342, '61026118801', 'Dosen', '2021-11-18 11:04:11', 'Login', 'Login berhasil', 'Tersedia'),
(343, '41013078302', 'Dosen', '2021-11-18 11:05:35', 'Login', 'Login berhasil', 'Tersedia'),
(344, '41030127104', 'Dosen', '2021-11-18 11:07:32', 'Login', 'Login berhasil', 'Tersedia'),
(345, 'admintu93', 'Tata Usaha', '2021-11-18 11:09:30', 'Login', 'Login berhasil', 'Tersedia'),
(346, '51010105701', 'Dosen', '2021-11-18 11:10:22', 'Login', 'Login berhasil', 'Tersedia'),
(347, 'admintu93', 'Tata Usaha', '2021-11-18 11:10:37', 'Login', 'Login berhasil', 'Tersedia'),
(348, '51025078002', 'Dosen', '2021-11-18 11:11:12', 'Login', 'Login berhasil', 'Tersedia'),
(349, 'admin361910028192', 'Prodi', '2021-11-18 11:13:24', 'Login', 'Login berhasil', 'Tersedia'),
(350, 'admin32191002819', 'Prodi', '2021-11-18 11:13:39', 'Login', 'Login berhasil', 'Tersedia'),
(351, 'admin35adminTI', 'Prodi', '2021-11-18 11:15:02', 'Login', 'Login berhasil', 'Tersedia'),
(352, 'tu', 'Tata Usaha', '2021-11-18 11:15:09', 'Login', 'Login berhasil', 'Tersedia'),
(353, '51025078002', 'Dosen', '2021-11-18 11:15:30', 'Login', 'Login berhasil', 'Tersedia'),
(354, '21027118403', 'Dosen', '2021-11-18 11:17:16', 'Login', 'Login berhasil', 'Tersedia'),
(355, 'admin341910028193', 'Prodi', '2021-11-18 11:42:31', 'Login', 'Login berhasil', 'Tersedia'),
(356, '41013078302', 'Dosen', '2021-11-18 11:45:22', 'Login', 'Login berhasil', 'Tersedia'),
(357, '31030058202', 'Dosen', '2021-11-18 12:22:57', 'Login', 'Login berhasil', 'Tersedia'),
(358, '51023027904', 'Dosen', '2021-11-18 12:38:57', 'Login', 'Login berhasil', 'Tersedia'),
(359, 'superadmin36', 'Prodi', '2021-11-18 13:17:14', 'Login', 'Login berhasil', 'Tersedia'),
(360, '21018088201', 'Dosen', '2021-11-18 13:22:50', 'Login', 'Login berhasil', 'Tersedia'),
(361, '51009098801', 'Dosen', '2021-11-18 13:59:24', 'Login', 'Login berhasil', 'Tersedia'),
(362, 'admin31sipil', 'Prodi', '2021-11-18 14:01:56', 'Login', 'Login berhasil', 'Tersedia'),
(363, '31028108902', 'Dosen', '2021-11-18 14:11:29', 'Login', 'Login berhasil', 'Tersedia'),
(364, 'admintu93', 'Tata Usaha', '2021-11-18 14:17:49', 'Login', 'Login berhasil', 'Tersedia'),
(365, '41005038401', 'Dosen', '2021-11-18 14:29:25', 'Login', 'Login berhasil', 'Tersedia'),
(366, 'admin361910028192', 'Prodi', '2021-11-18 14:48:55', 'Login', 'Login berhasil', 'Tersedia'),
(367, 'admin341910028193', 'Prodi', '2021-11-18 14:49:12', 'Login', 'Login berhasil', 'Tersedia'),
(368, 'admin32191002819', 'Prodi', '2021-11-18 14:49:34', 'Login', 'Login berhasil', 'Tersedia'),
(369, 'superadmin33', 'Prodi', '2021-11-18 14:54:48', 'Login', 'Login berhasil', 'Tersedia'),
(370, '31028108902', 'Dosen', '2021-11-18 15:02:52', 'Login', 'Login berhasil', 'Tersedia'),
(371, 'superadmin33', 'Prodi', '2021-11-18 15:22:20', 'Login', 'Login berhasil', 'Tersedia'),
(372, '31028108902', 'Dosen', '2021-11-18 15:23:34', 'Login', 'Login berhasil', 'Tersedia'),
(373, '31030048902', 'Dosen', '2021-11-18 15:27:21', 'Login', 'Login berhasil', 'Tersedia'),
(374, 'superadmin33', 'Prodi', '2021-11-18 15:29:19', 'Login', 'Login berhasil', 'Tersedia'),
(375, '31028108902', 'Dosen', '2021-11-18 15:31:32', 'Login', 'Login berhasil', 'Tersedia'),
(376, 'superadmin33', 'Prodi', '2021-11-18 15:36:55', 'Login', 'Login berhasil', 'Tersedia'),
(377, '21018088201', 'Dosen', '2021-11-18 15:56:40', 'Login', 'Login berhasil', 'Tersedia'),
(378, 'admin31sipil', 'Prodi', '2021-11-18 16:08:48', 'Login', 'Login berhasil', 'Tersedia'),
(379, '31005047603', 'Dosen', '2021-11-18 16:29:03', 'Login', 'Login berhasil', 'Tersedia'),
(380, '51026068702', 'Dosen', '2021-11-18 17:08:57', 'Login', 'Login berhasil', 'Tersedia'),
(381, '51011088304', 'Dosen', '2021-11-18 17:37:06', 'Login', 'Login berhasil', 'Tersedia'),
(382, '11015068204', 'Dosen', '2021-11-18 18:04:44', 'Login', 'Login berhasil', 'Tersedia'),
(383, '51011039001', 'Dosen', '2021-11-18 18:58:14', 'Login', 'Login berhasil', 'Tersedia'),
(384, '11008118901', 'Dosen', '2021-11-18 19:07:39', 'Login', 'Login berhasil', 'Tersedia'),
(385, '51023027904', 'Dosen', '2021-11-18 19:56:19', 'Login', 'Login berhasil', 'Tersedia'),
(386, '31002129301', 'Dosen', '2021-11-18 21:00:15', 'Login', 'Login berhasil', 'Tersedia'),
(387, '21015019202', 'Dosen', '2021-11-18 21:10:15', 'Login', 'Login berhasil', 'Tersedia'),
(388, '51002118702', 'Dosen', '2021-11-18 21:22:40', 'Login', 'Login berhasil', 'Tersedia'),
(389, '11008097501', 'Dosen', '2021-11-18 21:51:09', 'Login', 'Login berhasil', 'Tersedia'),
(390, '61008097501', 'Dosen', '2021-11-18 21:51:49', 'Login', 'Login berhasil', 'Tersedia'),
(391, '31009038504', 'Dosen', '2021-11-18 21:59:36', 'Login', 'Login berhasil', 'Tersedia'),
(392, '11008097501', 'Dosen', '2021-11-18 22:00:42', 'Login', 'Login berhasil', 'Tersedia'),
(393, '41004079401', 'Dosen', '2021-11-18 22:09:33', 'Login', 'Login berhasil', 'Tersedia'),
(394, 'superadmin33', 'Prodi', '2021-11-18 22:09:34', 'Login', 'Login berhasil', 'Tersedia'),
(395, '51004079401', 'Dosen', '2021-11-18 22:09:58', 'Login', 'Login berhasil', 'Tersedia'),
(396, '21004079401', 'Dosen', '2021-11-18 22:12:26', 'Login', 'Login berhasil', 'Tersedia'),
(397, '41004079401', 'Dosen', '2021-11-18 22:49:15', 'Login', 'Login berhasil', 'Tersedia'),
(398, '51004079401', 'Dosen', '2021-11-18 22:50:53', 'Login', 'Login berhasil', 'Tersedia'),
(399, '11013066803', 'Dosen', '2021-11-18 23:13:42', 'Login', 'Login berhasil', 'Tersedia'),
(400, '61010118403', 'Dosen', '2021-11-19 06:46:59', 'Login', 'Login berhasil', 'Tersedia'),
(401, 'superadmin36', 'Prodi', '2021-11-19 06:50:26', 'Login', 'Login berhasil', 'Tersedia'),
(402, '51004079401', 'Dosen', '2021-11-19 09:19:10', 'Login', 'Login berhasil', 'Tersedia'),
(403, '31005047603', 'Dosen', '2021-11-19 09:23:22', 'Login', 'Login berhasil', 'Tersedia'),
(404, 'admin31sipil', 'Prodi', '2021-11-19 09:29:32', 'Login', 'Login berhasil', 'Tersedia'),
(405, '31030048902', 'Dosen', '2021-11-19 09:29:44', 'Login', 'Login berhasil', 'Tersedia'),
(406, 'admin35adminTI', 'Prodi', '2021-11-19 09:31:36', 'Login', 'Login berhasil', 'Tersedia'),
(407, 'superadmin36', 'Prodi', '2021-11-19 09:35:42', 'Login', 'Login berhasil', 'Tersedia'),
(408, '51009098801', 'Dosen', '2021-11-19 09:37:07', 'Login', 'Login berhasil', 'Tersedia'),
(409, '41005038401', 'Dosen', '2021-11-19 10:16:37', 'Login', 'Login berhasil', 'Tersedia'),
(410, '50009088102', 'Dosen', '2021-11-19 10:30:31', 'Login', 'Login berhasil', 'Tersedia'),
(411, '21004079401', 'Dosen', '2021-11-19 11:03:20', 'Login', 'Login berhasil', 'Tersedia'),
(412, 'admintu93', 'Tata Usaha', '2021-11-19 11:08:48', 'Login', 'Login berhasil', 'Tersedia'),
(413, 'tu', 'Tata Usaha', '2021-11-19 11:10:44', 'Login', 'Login berhasil', 'Tersedia'),
(414, 'admin35adminTI', 'Prodi', '2021-11-19 11:16:26', 'Login', 'Login berhasil', 'Tersedia'),
(415, '30027075901', 'Dosen', '2021-11-19 13:26:21', 'Login', 'Login berhasil', 'Tersedia'),
(416, '21014028904', 'Dosen', '2021-11-19 13:37:13', 'Login', 'Login berhasil', 'Tersedia'),
(417, '11030088801', 'Dosen', '2021-11-19 14:00:17', 'Login', 'Login berhasil', 'Tersedia'),
(418, 'admintu93', 'Tata Usaha', '2021-11-19 14:15:36', 'Login', 'Login berhasil', 'Tersedia'),
(419, 'admin31sipil', 'Prodi', '2021-11-19 14:16:13', 'Login', 'Login berhasil', 'Tersedia'),
(420, '61009098403', 'Dosen', '2021-11-19 14:32:57', 'Login', 'Login berhasil', 'Tersedia'),
(421, 'admintu93', 'Tata Usaha', '2021-11-19 14:53:57', 'Login', 'Login berhasil', 'Tersedia'),
(422, 'superadmin36', 'Prodi', '2021-11-19 14:54:01', 'Login', 'Login berhasil', 'Tersedia'),
(423, 'admin35adminTI', 'Prodi', '2021-11-19 14:56:03', 'Login', 'Login berhasil', 'Tersedia'),
(424, '61026118801', 'Dosen', '2021-11-19 14:56:40', 'Login', 'Login berhasil', 'Tersedia'),
(425, '51023027904', 'Dosen', '2021-11-19 15:19:02', 'Login', 'Login berhasil', 'Tersedia'),
(426, 'admin32191002819', 'Prodi', '2021-11-19 15:26:41', 'Login', 'Login berhasil', 'Tersedia'),
(427, 'superadmin31', 'Prodi', '2021-11-19 15:43:56', 'Login', 'Login berhasil', 'Tersedia'),
(428, 'tu', 'Tata Usaha', '2021-11-19 15:45:53', 'Login', 'Login berhasil', 'Tersedia'),
(429, '11015068204', 'Dosen', '2021-11-19 15:54:08', 'Login', 'Login berhasil', 'Tersedia'),
(430, 'admin31sipil', 'Prodi', '2021-11-19 16:04:44', 'Login', 'Login berhasil', 'Tersedia'),
(431, '21007108201', 'Dosen', '2021-11-19 16:10:29', 'Login', 'Login berhasil', 'Tersedia'),
(432, 'admin35adminTI', 'Prodi', '2021-11-19 16:15:56', 'Login', 'Login berhasil', 'Tersedia'),
(433, 'admintu93', 'Tata Usaha', '2021-11-19 16:17:54', 'Login', 'Login berhasil', 'Tersedia'),
(434, '51026068702', 'Dosen', '2021-11-19 16:31:08', 'Login', 'Login berhasil', 'Tersedia'),
(435, '11012128304', 'Dosen', '2021-11-19 16:39:18', 'Login', 'Login berhasil', 'Tersedia'),
(436, 'Admintu93', 'Tata Usaha', '2021-11-19 16:49:48', 'Login', 'Login berhasil', 'Tersedia'),
(437, '41004079401', 'Dosen', '2021-11-19 16:51:41', 'Login', 'Login berhasil', 'Tersedia'),
(438, '50007027807', 'Dosen', '2021-11-19 16:55:16', 'Login', 'Login berhasil', 'Tersedia'),
(439, '11015038302', 'Dosen', '2021-11-19 16:59:27', 'Login', 'Login berhasil', 'Tersedia'),
(440, '21004079401', 'Dosen', '2021-11-19 17:04:50', 'Login', 'Login berhasil', 'Tersedia'),
(441, '41004079401', 'Dosen', '2021-11-19 17:05:18', 'Login', 'Login berhasil', 'Tersedia'),
(442, '21004079401', 'Dosen', '2021-11-19 17:05:24', 'Login', 'Login berhasil', 'Tersedia'),
(443, '51004079401', 'Dosen', '2021-11-19 17:05:42', 'Login', 'Login berhasil', 'Tersedia'),
(444, 'superadmin31', 'Prodi', '2021-11-19 17:10:54', 'Login', 'Login berhasil', 'Tersedia'),
(445, 'superadmin31', 'Prodi', '2021-11-19 17:11:54', 'Login', 'Login berhasil', 'Tersedia'),
(446, '11012128304', 'Dosen', '2021-11-19 17:12:39', 'Login', 'Login berhasil', 'Tersedia'),
(447, 'superadmin31', 'Prodi', '2021-11-19 17:23:58', 'Login', 'Login berhasil', 'Tersedia'),
(448, 'superadmin31', 'Prodi', '2021-11-19 17:26:53', 'Login', 'Login berhasil', 'Tersedia'),
(449, '11012128304', 'Dosen', '2021-11-19 17:28:35', 'Login', 'Login berhasil', 'Tersedia'),
(450, 'superadmin31', 'Prodi', '2021-11-19 18:12:31', 'Login', 'Login berhasil', 'Tersedia'),
(451, '11012128304', 'Dosen', '2021-11-19 18:14:11', 'Login', 'Login berhasil', 'Tersedia'),
(452, '39910006706', 'Dosen', '2021-11-19 18:23:55', 'Login', 'Login berhasil', 'Tersedia'),
(453, '51017018001', 'Dosen', '2021-11-19 18:27:35', 'Login', 'Login berhasil', 'Tersedia'),
(454, '51011039001', 'Dosen', '2021-11-19 19:18:54', 'Login', 'Login berhasil', 'Tersedia'),
(455, '39910006706', 'Dosen', '2021-11-19 19:55:20', 'Login', 'Login berhasil', 'Tersedia'),
(456, '41005038401', 'Dosen', '2021-11-19 20:30:43', 'Login', 'Login berhasil', 'Tersedia'),
(457, '11012128304', 'Dosen', '2021-11-19 21:14:21', 'Login', 'Login berhasil', 'Tersedia'),
(458, '11013066803', 'Dosen', '2021-11-19 23:30:09', 'Login', 'Login berhasil', 'Tersedia'),
(459, '51011039001', 'Dosen', '2021-11-19 23:45:42', 'Login', 'Login berhasil', 'Tersedia'),
(460, '51016029301', 'Dosen', '2021-11-20 01:17:09', 'Login', 'Login berhasil', 'Tersedia'),
(461, 'superadmin36', 'Prodi', '2021-11-20 06:29:16', 'Login', 'Login berhasil', 'Tersedia'),
(462, 'superadmin34', 'Prodi', '2021-11-20 07:11:07', 'Login', 'Login berhasil', 'Tersedia'),
(463, '41018028601', 'Dosen', '2021-11-20 07:13:20', 'Login', 'Login berhasil', 'Tersedia'),
(464, '51023027904', 'Dosen', '2021-11-20 09:19:26', 'Login', 'Login berhasil', 'Tersedia'),
(465, '41024078802', 'Dosen', '2021-11-20 11:06:06', 'Login', 'Login berhasil', 'Tersedia'),
(466, '51011039001', 'Dosen', '2021-11-20 11:19:55', 'Login', 'Login berhasil', 'Tersedia'),
(467, '21007108201', 'Dosen', '2021-11-20 11:20:47', 'Login', 'Login berhasil', 'Tersedia'),
(468, '21007108201', 'Dosen', '2021-11-20 12:14:47', 'Login', 'Login berhasil', 'Tersedia'),
(469, '21007108201', 'Dosen', '2021-11-20 13:16:18', 'Login', 'Login berhasil', 'Tersedia'),
(470, 'superadmin32', 'Prodi', '2021-11-20 16:22:42', 'Login', 'Login berhasil', 'Tersedia'),
(471, '21007108201', 'Dosen', '2021-11-20 19:17:24', 'Login', 'Login berhasil', 'Tersedia'),
(472, '21007108201', 'Dosen', '2021-11-20 20:17:58', 'Login', 'Login berhasil', 'Tersedia'),
(473, '41028067803', 'Dosen', '2021-11-21 08:48:54', 'Login', 'Login berhasil', 'Tersedia'),
(474, '41028067803', 'Dosen', '2021-11-21 09:27:23', 'Login', 'Login berhasil', 'Tersedia'),
(475, '41024078802', 'Dosen', '2021-11-21 10:49:59', 'Login', 'Login berhasil', 'Tersedia'),
(476, '51026126801', 'Dosen', '2021-11-21 13:21:41', 'Login', 'Login berhasil', 'Tersedia'),
(477, '11002056201', 'Dosen', '2021-11-21 16:10:46', 'Login', 'Login berhasil', 'Tersedia'),
(478, '41002056201', 'Dosen', '2021-11-21 16:12:31', 'Login', 'Login berhasil', 'Tersedia'),
(479, '51026126801', 'Dosen', '2021-11-21 16:54:26', 'Login', 'Login berhasil', 'Tersedia'),
(480, '50225051994', 'Dosen', '2021-11-21 17:58:06', 'Login', 'Login berhasil', 'Tersedia'),
(481, '41005038401', 'Dosen', '2021-11-21 20:15:49', 'Login', 'Login berhasil', 'Tersedia'),
(482, '11019057901', 'Dosen', '2021-11-21 20:36:30', 'Login', 'Login berhasil', 'Tersedia'),
(483, '61026118801', 'Dosen', '2021-11-21 22:12:58', 'Login', 'Login berhasil', 'Tersedia'),
(484, '21018088201', 'Dosen', '2021-11-21 22:52:06', 'Login', 'Login berhasil', 'Tersedia'),
(485, '21018088201', 'Dosen', '2021-11-22 05:39:08', 'Login', 'Login berhasil', 'Tersedia'),
(486, '11004118406', 'Dosen', '2021-11-22 06:04:13', 'Login', 'Login berhasil', 'Tersedia'),
(487, '11008118901', 'Dosen', '2021-11-22 06:12:33', 'Login', 'Login berhasil', 'Tersedia'),
(488, 'superadmin36', 'Prodi', '2021-11-22 06:55:45', 'Login', 'Login berhasil', 'Tersedia'),
(489, '21025118802', 'Dosen', '2021-11-22 07:04:16', 'Login', 'Login berhasil', 'Tersedia'),
(490, '21018088201', 'Dosen', '2021-11-22 07:04:18', 'Login', 'Login berhasil', 'Tersedia'),
(491, '51025118802', 'Dosen', '2021-11-22 07:04:59', 'Login', 'Login berhasil', 'Tersedia'),
(492, 'superadmin36', 'Prodi', '2021-11-22 07:11:24', 'Login', 'Login berhasil', 'Tersedia'),
(493, '61010118403', 'Dosen', '2021-11-22 07:19:36', 'Login', 'Login berhasil', 'Tersedia'),
(494, 'superadmin36', 'Prodi', '2021-11-22 07:23:09', 'Login', 'Login berhasil', 'Tersedia'),
(495, '61010118403', 'Dosen', '2021-11-22 07:24:36', 'Login', 'Login berhasil', 'Tersedia'),
(496, 'superadmin36', 'Prodi', '2021-11-22 07:32:56', 'Login', 'Login berhasil', 'Tersedia'),
(497, '61010118403', 'Dosen', '2021-11-22 07:33:54', 'Login', 'Login berhasil', 'Tersedia'),
(498, '21005047603', 'Dosen', '2021-11-22 07:56:05', 'Login', 'Login berhasil', 'Tersedia'),
(499, '39910006706', 'Dosen', '2021-11-22 08:17:05', 'Login', 'Login berhasil', 'Tersedia'),
(500, '51004079401', 'Dosen', '2021-11-22 08:26:47', 'Login', 'Login berhasil', 'Tersedia'),
(501, 'admin31sipil', 'Prodi', '2021-11-22 08:29:28', 'Login', 'Login berhasil', 'Tersedia'),
(502, 'superadmin33', 'Prodi', '2021-11-22 08:31:00', 'Login', 'Login berhasil', 'Tersedia'),
(503, 'admin35adminTI', 'Prodi', '2021-11-22 08:36:14', 'Login', 'Login berhasil', 'Tersedia'),
(504, '51004079401', 'Dosen', '2021-11-22 08:36:35', 'Login', 'Login berhasil', 'Tersedia'),
(505, '51026126801', 'Dosen', '2021-11-22 08:39:52', 'Login', 'Login berhasil', 'Tersedia'),
(506, '21004079401', 'Dosen', '2021-11-22 08:40:13', 'Login', 'Login berhasil', 'Tersedia'),
(507, '41004079401', 'Dosen', '2021-11-22 08:40:50', 'Login', 'Login berhasil', 'Tersedia'),
(508, '21018088201', 'Dosen', '2021-11-22 08:42:47', 'Login', 'Login berhasil', 'Tersedia'),
(509, '31029077302', 'Dosen', '2021-11-22 08:50:44', 'Login', 'Login berhasil', 'Tersedia'),
(510, '50131101992', 'Dosen', '2021-11-22 09:06:04', 'Login', 'Login berhasil', 'Tersedia'),
(511, '21001118101', 'Dosen', '2021-11-22 09:06:43', 'Login', 'Login berhasil', 'Tersedia'),
(512, '41018019103', 'Dosen', '2021-11-22 09:17:54', 'Login', 'Login berhasil', 'Tersedia'),
(513, 'wd3', 'Fakultas', '2021-11-22 09:29:10', 'Login', 'Login berhasil', 'Tersedia'),
(514, '21021088201', 'Dosen', '2021-11-22 09:30:38', 'Login', 'Login berhasil', 'Tersedia'),
(515, '11015038302', 'Dosen', '2021-11-22 09:48:47', 'Login', 'Login berhasil', 'Tersedia'),
(516, 'tu', 'Tata Usaha', '2021-11-22 09:54:45', 'Login', 'Login berhasil', 'Tersedia'),
(517, '50225051994', 'Dosen', '2021-11-22 10:18:22', 'Login', 'Login berhasil', 'Tersedia'),
(518, 'superadmin36', 'Prodi', '2021-11-22 10:18:48', 'Login', 'Login berhasil', 'Tersedia'),
(519, '41005038401', 'Dosen', '2021-11-22 10:55:03', 'Login', 'Login berhasil', 'Tersedia'),
(520, 'superadmin34', 'Prodi', '2021-11-22 10:56:12', 'Login', 'Login berhasil', 'Tersedia'),
(521, '51031126801', 'Dosen', '2021-11-22 10:57:35', 'Login', 'Login berhasil', 'Tersedia'),
(522, 'tu', 'Tata Usaha', '2021-11-22 11:01:20', 'Login', 'Login berhasil', 'Tersedia'),
(523, '11013066803', 'Dosen', '2021-11-22 11:06:28', 'Login', 'Login berhasil', 'Tersedia'),
(524, '21004079401', 'Dosen', '2021-11-22 11:11:11', 'Login', 'Login berhasil', 'Tersedia'),
(525, '11005057003', 'Dosen', '2021-11-22 11:14:28', 'Login', 'Login berhasil', 'Tersedia'),
(526, '21015019202', 'Dosen', '2021-11-22 11:36:43', 'Login', 'Login berhasil', 'Tersedia'),
(527, '61014028602', 'Dosen', '2021-11-22 11:57:14', 'Login', 'Login berhasil', 'Tersedia'),
(528, 'superadmin31', 'Prodi', '2021-11-22 11:59:58', 'Login', 'Login berhasil', 'Tersedia'),
(529, '31018117803', 'Dosen', '2021-11-22 12:07:29', 'Login', 'Login berhasil', 'Tersedia'),
(530, '21018088201', 'Dosen', '2021-11-22 12:31:37', 'Login', 'Login berhasil', 'Tersedia'),
(531, '31009038504', 'Dosen', '2021-11-22 12:50:11', 'Login', 'Login berhasil', 'Tersedia'),
(532, 'superadmin35', 'Prodi', '2021-11-22 13:08:08', 'Login', 'Login berhasil', 'Tersedia'),
(533, 'superadmin33', 'Prodi', '2021-11-22 13:12:18', 'Login', 'Login berhasil', 'Tersedia'),
(534, '21007108201', 'Dosen', '2021-11-22 13:37:06', 'Login', 'Login berhasil', 'Tersedia'),
(535, 'superadmin36', 'Prodi', '2021-11-22 13:42:00', 'Login', 'Login berhasil', 'Tersedia'),
(536, '51010059101', 'Dosen', '2021-11-22 13:43:26', 'Login', 'Login berhasil', 'Tersedia'),
(537, '51031126801', 'Dosen', '2021-11-22 13:52:14', 'Login', 'Login berhasil', 'Tersedia'),
(538, '41005038401', 'Dosen', '2021-11-22 13:53:32', 'Login', 'Login berhasil', 'Tersedia'),
(539, '41013078302', 'Dosen', '2021-11-22 14:52:10', 'Login', 'Login berhasil', 'Tersedia'),
(540, '41019057202', 'Dosen', '2021-11-22 14:58:50', 'Login', 'Login berhasil', 'Tersedia'),
(541, '51020038101', 'Dosen', '2021-11-22 15:10:33', 'Login', 'Login berhasil', 'Tersedia'),
(542, '61008058901', 'Dosen', '2021-11-22 15:10:54', 'Login', 'Login berhasil', 'Tersedia'),
(543, 'superadmin36', 'Prodi', '2021-11-22 15:14:06', 'Login', 'Login berhasil', 'Tersedia'),
(544, 'superadmin36', 'Prodi', '2021-11-22 15:16:34', 'Login', 'Login berhasil', 'Tersedia'),
(545, '21011088304', 'Dosen', '2021-11-22 15:27:05', 'Login', 'Login berhasil', 'Tersedia'),
(546, '51011088304', 'Dosen', '2021-11-22 15:27:43', 'Login', 'Login berhasil', 'Tersedia'),
(547, '21014028904', 'Dosen', '2021-11-22 15:27:43', 'Login', 'Login berhasil', 'Tersedia'),
(548, '21025118802', 'Dosen', '2021-11-22 15:35:03', 'Login', 'Login berhasil', 'Tersedia'),
(549, 'admin32191002819', 'Prodi', '2021-11-22 15:55:48', 'Login', 'Login berhasil', 'Tersedia');
INSERT INTO `tb_log` (`id_log`, `username`, `status_login`, `waktu_log`, `aktifitas`, `aktifitas_detail`, `status`) VALUES
(550, 'dekan', 'Fakultas', '2022-02-18 23:54:12', 'Login', 'Login berhasil', 'Tersedia'),
(551, 'dekan', 'Fakultas', '2022-02-18 23:55:01', 'Login', 'Login berhasil', 'Tersedia'),
(552, 'dekan', 'Fakultas', '2022-02-19 00:55:26', 'Login', 'Login berhasil', 'Tersedia'),
(553, 'tu', 'Tata Usaha', '2022-02-19 00:56:19', 'Login', 'Login berhasil', 'Tersedia'),
(554, 'superadmin35', 'Prodi', '2022-02-19 01:00:18', 'Login', 'Login berhasil', 'Tersedia'),
(555, 'superadmin35', 'Prodi', '2022-02-19 01:39:58', 'Login', 'Login berhasil', 'Tersedia'),
(556, 'dekan', 'Fakultas', '2022-02-19 01:40:31', 'Login', 'Login berhasil', 'Tersedia'),
(557, 'tu', 'Tata Usaha', '2022-02-19 01:41:11', 'Login', 'Login berhasil', 'Tersedia'),
(558, 'superadmin35', 'Prodi', '2022-02-19 01:42:41', 'Login', 'Login berhasil', 'Tersedia'),
(559, '51023048901', 'Dosen', '2022-02-19 01:47:03', 'Login', 'Login berhasil', 'Tersedia'),
(560, '183510720', 'Mahasiswa', '2022-02-19 02:01:06', 'Login', 'Login berhasil', 'Tersedia'),
(561, '183510393', 'Mahasiswa', '2022-02-19 02:16:56', 'Login', 'Login berhasil', 'Tersedia'),
(562, '183510400', 'Mahasiswa', '2022-02-19 02:17:30', 'Login', 'Login berhasil', 'Tersedia'),
(563, '183510720', 'Mahasiswa', '2022-02-19 02:17:47', 'Login', 'Login berhasil', 'Tersedia'),
(564, '183110111', 'Mahasiswa', '2022-02-19 11:58:14', 'Login', 'Login berhasil', 'Tersedia'),
(565, '183510393', 'Mahasiswa', '2022-02-19 12:19:51', 'Login', 'Login berhasil', 'Tersedia'),
(566, '183110123', 'Mahasiswa', '2022-02-19 12:23:08', 'Login', 'Login berhasil', 'Tersedia'),
(567, '183110123', 'Mahasiswa', '2022-02-19 12:51:07', 'Login', 'Login berhasil', 'Tersedia'),
(568, '183110123', 'Mahasiswa', '2022-02-19 12:59:53', 'Login', 'Login berhasil', 'Tersedia'),
(569, 'superadmin35', 'Prodi', '2022-02-19 14:01:48', 'Login', 'Login berhasil', 'Tersedia'),
(570, '183510393', 'Mahasiswa', '2022-02-19 14:03:55', 'Login', 'Login berhasil', 'Tersedia'),
(571, 'dekan', 'Fakultas', '2022-02-19 14:04:16', 'Login', 'Login berhasil', 'Tersedia'),
(572, '51023048901', 'Dosen', '2022-02-19 14:14:48', 'Login', 'Login berhasil', 'Tersedia'),
(573, 'tu', 'Tata Usaha', '2022-02-19 14:39:07', 'Login', 'Login berhasil', 'Tersedia'),
(574, 'superadmin35', 'Prodi', '2022-02-19 14:39:31', 'Login', 'Login berhasil', 'Tersedia'),
(575, '183510393', 'Mahasiswa', '2022-02-19 14:41:37', 'Login', 'Login berhasil', 'Tersedia'),
(576, '183510393', 'Mahasiswa', '2022-02-19 15:15:11', 'Login', 'Login berhasil', 'Tersedia'),
(577, '183510393', 'Mahasiswa', '2022-02-19 18:45:36', 'Login', 'Login berhasil', 'Tersedia'),
(578, 'superadmin35', 'Prodi', '2022-02-19 18:52:02', 'Login', 'Login berhasil', 'Tersedia'),
(579, 'tu', 'Tata Usaha', '2022-02-19 18:52:18', 'Login', 'Login berhasil', 'Tersedia'),
(580, '183510393', 'Mahasiswa', '2022-02-19 21:10:56', 'Login', 'Login berhasil', 'Tersedia'),
(581, 'superadmin35', 'Prodi', '2022-02-19 21:13:37', 'Login', 'Login berhasil', 'Tersedia'),
(582, 'tu', 'Tata Usaha', '2022-02-19 21:13:57', 'Login', 'Login berhasil', 'Tersedia'),
(583, '183510393', 'Mahasiswa', '2022-02-20 00:42:35', 'Login', 'Login berhasil', 'Tersedia'),
(584, '173610241', 'Mahasiswa', '2022-02-20 15:12:05', 'Login', 'Login berhasil', 'Tersedia'),
(585, 'tu', 'Tata Usaha', '2022-02-20 15:13:38', 'Login', 'Login berhasil', 'Tersedia'),
(586, 'dekan', 'Fakultas', '2022-02-20 15:14:25', 'Login', 'Login berhasil', 'Tersedia'),
(587, 'superadmin36', 'Prodi', '2022-02-20 15:19:57', 'Login', 'Login berhasil', 'Tersedia'),
(588, 'dekan', 'Fakultas', '2022-02-20 15:21:19', 'Login', 'Login berhasil', 'Tersedia'),
(589, '61014028602', 'Dosen', '2022-02-20 15:23:27', 'Login', 'Login berhasil', 'Tersedia'),
(590, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-20 16:06:49', 'Login', 'Login berhasil', 'Tersedia'),
(591, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-20 16:27:12', 'Login', 'Login berhasil', 'Tersedia'),
(592, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-20 16:52:53', 'Login', 'Login berhasil', 'Tersedia'),
(593, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-20 16:55:45', 'Login', 'Login berhasil', 'Tersedia'),
(594, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-20 17:10:07', 'Login', 'Login berhasil', 'Tersedia'),
(595, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-20 17:13:09', 'Login', 'Login berhasil', 'Tersedia'),
(596, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-20 17:14:39', 'Login', 'Login berhasil', 'Tersedia'),
(597, '10008076401', 'Dosen', '2022-02-20 20:53:12', 'Login', 'Login berhasil', 'Tersedia'),
(598, 'tu', 'Tata Usaha', '2022-02-20 21:15:25', 'Login', 'Login berhasil', 'Tersedia'),
(599, '183510393', 'Mahasiswa', '2022-02-20 21:42:38', 'Login', 'Login berhasil', 'Tersedia'),
(600, 'tu', 'Tata Usaha', '2022-02-20 21:44:43', 'Login', 'Login berhasil', 'Tersedia'),
(601, 'tu', 'Tata Usaha', '2022-02-20 21:48:56', 'Login', 'Login berhasil', 'Tersedia'),
(602, 'dekan', 'Fakultas', '2022-02-20 21:49:56', 'Login', 'Login berhasil', 'Tersedia'),
(603, 'superadmin35', 'Prodi', '2022-02-20 21:52:49', 'Login', 'Login berhasil', 'Tersedia'),
(604, '51023048901', 'Dosen', '2022-02-20 21:54:01', 'Login', 'Login berhasil', 'Tersedia'),
(605, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-20 21:58:32', 'Login', 'Login berhasil', 'Tersedia'),
(606, '183510400', 'Mahasiswa', '2022-02-21 10:57:25', 'Login', 'Login berhasil', 'Tersedia'),
(607, '183510393', 'Mahasiswa', '2022-02-21 11:20:02', 'Login', 'Login berhasil', 'Tersedia'),
(608, '183510400', 'Mahasiswa', '2022-02-21 11:32:32', 'Login', 'Login berhasil', 'Tersedia'),
(609, '183510393', 'Mahasiswa', '2022-02-21 12:20:22', 'Login', 'Login berhasil', 'Tersedia'),
(610, 'superadmin35', 'Prodi', '2022-02-21 12:38:53', 'Login', 'Login berhasil', 'Tersedia'),
(611, '183510393', 'Mahasiswa', '2022-02-21 12:40:27', 'Login', 'Login berhasil', 'Tersedia'),
(612, 'tu', 'Tata Usaha', '2022-02-21 12:40:59', 'Login', 'Login berhasil', 'Tersedia'),
(613, '183510400', 'Mahasiswa', '2022-02-21 12:41:27', 'Login', 'Login berhasil', 'Tersedia'),
(614, '183110123', 'Mahasiswa', '2022-02-21 16:08:35', 'Login', 'Login berhasil', 'Tersedia'),
(615, '183110123', 'Mahasiswa', '2022-02-21 16:09:26', 'Login', 'Login berhasil', 'Tersedia'),
(616, 'tu', 'Tata Usaha', '2022-02-21 16:09:45', 'Login', 'Login berhasil', 'Tersedia'),
(617, 'dekan', 'Fakultas', '2022-02-21 16:10:05', 'Login', 'Login berhasil', 'Tersedia'),
(618, '183110123', 'Mahasiswa', '2022-02-21 16:15:14', 'Login', 'Login berhasil', 'Tersedia'),
(619, '183110123', 'Mahasiswa', '2022-02-21 19:24:12', 'Login', 'Login berhasil', 'Tersedia'),
(620, 'superadmin31', 'Prodi', '2022-02-21 19:24:40', 'Login', 'Login berhasil', 'Tersedia'),
(621, '11005057003', 'Dosen', '2022-02-21 19:26:44', 'Login', 'Login berhasil', 'Tersedia'),
(622, 'dekan', 'Fakultas', '2022-02-21 19:35:11', 'Login', 'Login berhasil', 'Tersedia'),
(623, 'superadmin35', 'Prodi', '2022-02-21 20:58:43', 'Login', 'Login berhasil', 'Tersedia'),
(624, 'superadmin31', 'Prodi', '2022-02-21 21:45:50', 'Login', 'Login berhasil', 'Tersedia'),
(625, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-21 21:55:03', 'Login', 'Login berhasil', 'Tersedia'),
(626, '183510417', 'Mahasiswa', '2022-02-22 12:08:17', 'Login', 'Login berhasil', 'Tersedia'),
(627, 'dekan', 'Fakultas', '2022-02-22 12:17:24', 'Login', 'Login berhasil', 'Tersedia'),
(628, 'wd1', 'Fakultas', '2022-02-22 12:21:49', 'Login', 'Login berhasil', 'Tersedia'),
(629, '183510393', 'Mahasiswa', '2022-02-22 12:24:42', 'Login', 'Login berhasil', 'Tersedia'),
(630, 'tu', 'Tata Usaha', '2022-02-22 12:29:44', 'Login', 'Login berhasil', 'Tersedia'),
(631, 'superadmin31', 'Prodi', '2022-02-22 12:43:08', 'Login', 'Login berhasil', 'Tersedia'),
(632, '51008037703', 'Dosen', '2022-02-22 12:44:38', 'Login', 'Login berhasil', 'Tersedia'),
(633, '183510417', 'Mahasiswa', '2022-02-22 12:45:50', 'Login', 'Login berhasil', 'Tersedia'),
(634, '51023048901', 'Dosen', '2022-02-22 12:48:48', 'Login', 'Login berhasil', 'Tersedia'),
(635, '183510417', 'Mahasiswa', '2022-02-22 12:49:31', 'Login', 'Login berhasil', 'Tersedia'),
(636, '183510720', 'Mahasiswa', '2022-02-22 13:57:25', 'Login', 'Login berhasil', 'Tersedia'),
(637, 'tu', 'Tata Usaha', '2022-02-22 14:42:40', 'Login', 'Login berhasil', 'Tersedia'),
(638, 'dekan', 'Fakultas', '2022-02-22 14:48:49', 'Login', 'Login berhasil', 'Tersedia'),
(639, '183510393', 'Mahasiswa', '2022-02-22 15:21:47', 'Login', 'Login berhasil', 'Tersedia'),
(640, 'superadmin35', 'Prodi', '2022-02-22 16:36:41', 'Login', 'Login berhasil', 'Tersedia'),
(641, '183510720', 'Mahasiswa', '2022-02-22 17:32:44', 'Login', 'Login berhasil', 'Tersedia'),
(642, 'superadmin35', 'Prodi', '2022-02-22 20:47:36', 'Login', 'Login berhasil', 'Tersedia'),
(643, 'dekan', 'Fakultas', '2022-02-22 20:47:48', 'Login', 'Login berhasil', 'Tersedia'),
(644, 'tu', 'Tata Usaha', '2022-02-22 20:48:23', 'Login', 'Login berhasil', 'Tersedia'),
(645, '183510720', 'Mahasiswa', '2022-02-22 20:48:44', 'Login', 'Login berhasil', 'Tersedia'),
(646, 'superadmin35', 'Prodi', '2022-02-23 09:20:12', 'Login', 'Login berhasil', 'Tersedia'),
(647, 'dekan', 'Fakultas', '2022-02-23 09:20:17', 'Login', 'Login berhasil', 'Tersedia'),
(648, 'tu', 'Tata Usaha', '2022-02-23 09:20:53', 'Login', 'Login berhasil', 'Tersedia'),
(649, '183510228', 'Mahasiswa', '2022-02-23 09:21:52', 'Login', 'Login berhasil', 'Tersedia'),
(650, 'tu', 'Tata Usaha', '2022-02-23 09:36:02', 'Login', 'Login berhasil', 'Tersedia'),
(651, 'superadmin35', 'Prodi', '2022-02-23 12:46:45', 'Login', 'Login berhasil', 'Tersedia'),
(652, 'dekan', 'Fakultas', '2022-02-23 12:46:55', 'Login', 'Login berhasil', 'Tersedia'),
(653, '183510400', 'Mahasiswa', '2022-02-23 12:47:06', 'Login', 'Login berhasil', 'Tersedia'),
(654, 'tu', 'Tata Usaha', '2022-02-23 12:47:18', 'Login', 'Login berhasil', 'Tersedia'),
(655, '51023048901', 'Dosen', '2022-02-23 14:32:30', 'Login', 'Login berhasil', 'Tersedia'),
(656, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-23 14:34:24', 'Login', 'Login berhasil', 'Tersedia'),
(657, 'tu', 'Tata Usaha', '2022-02-23 14:41:38', 'Login', 'Login berhasil', 'Tersedia'),
(658, '183510400', 'Mahasiswa', '2022-02-23 19:24:40', 'Login', 'Login berhasil', 'Tersedia'),
(659, 'tu', 'Tata Usaha', '2022-02-23 19:25:01', 'Login', 'Login berhasil', 'Tersedia'),
(660, 'superadmin35', 'Prodi', '2022-02-23 19:25:20', 'Login', 'Login berhasil', 'Tersedia'),
(661, 'dekan', 'Fakultas', '2022-02-23 19:25:34', 'Login', 'Login berhasil', 'Tersedia'),
(662, 'upm', 'UPM', '2022-02-23 19:28:47', 'Login', 'Login berhasil', 'Tersedia'),
(663, '50009088102', 'Dosen', '2022-02-23 19:41:28', 'Login', 'Login berhasil', 'Tersedia'),
(664, 'tu', 'Tata Usaha', '2022-02-23 21:00:26', 'Login', 'Login berhasil', 'Tersedia'),
(665, '183510400', 'Mahasiswa', '2022-02-23 21:06:17', 'Login', 'Login berhasil', 'Tersedia'),
(666, 'superadmin35', 'Prodi', '2022-02-23 21:11:08', 'Login', 'Login berhasil', 'Tersedia'),
(667, 'dekan', 'Fakultas', '2022-02-23 21:11:57', 'Login', 'Login berhasil', 'Tersedia'),
(668, 'tu', 'Tata Usaha', '2022-02-24 00:54:51', 'Login', 'Login berhasil', 'Tersedia'),
(669, 'superadmin35', 'Prodi', '2022-02-24 00:54:57', 'Login', 'Login berhasil', 'Tersedia'),
(670, '183510400', 'Mahasiswa', '2022-02-24 00:58:25', 'Login', 'Login berhasil', 'Tersedia'),
(671, '183510400', 'Mahasiswa', '2022-02-24 01:32:14', 'Login', 'Login berhasil', 'Tersedia'),
(672, 'tu', 'Tata Usaha', '2022-02-24 01:32:50', 'Login', 'Login berhasil', 'Tersedia'),
(673, 'dekan', 'Fakultas', '2022-02-24 01:34:00', 'Login', 'Login berhasil', 'Tersedia'),
(674, '183510393', 'Mahasiswa', '2022-02-24 01:35:21', 'Login', 'Login berhasil', 'Tersedia'),
(675, '183510417', 'Mahasiswa', '2022-02-24 01:39:47', 'Login', 'Login berhasil', 'Tersedia'),
(676, '183510720', 'Mahasiswa', '2022-02-24 01:40:03', 'Login', 'Login berhasil', 'Tersedia'),
(677, '183510393', 'Mahasiswa', '2022-02-24 01:45:33', 'Login', 'Login berhasil', 'Tersedia'),
(678, '51014028904', 'Dosen', '2022-02-24 01:50:53', 'Login', 'Login berhasil', 'Tersedia'),
(679, 'nadiarozaan@student.uir.ac.id', 'Pembimbing Lapangan KP', '2022-02-24 01:59:46', 'Login', 'Login berhasil', 'Tersedia'),
(680, 'superadmin35', 'Prodi', '2022-02-24 10:14:46', 'Login', 'Login berhasil', 'Tersedia'),
(681, 'dekan', 'Fakultas', '2022-02-24 10:15:22', 'Login', 'Login berhasil', 'Tersedia'),
(682, 'tu', 'Tata Usaha', '2022-02-24 10:15:58', 'Login', 'Login berhasil', 'Tersedia'),
(683, '183510393', 'Mahasiswa', '2022-02-24 10:16:15', 'Login', 'Login berhasil', 'Tersedia'),
(684, '183510720', 'Mahasiswa', '2022-02-24 11:27:32', 'Login', 'Login berhasil', 'Tersedia'),
(685, '183510393', 'Mahasiswa', '2022-02-24 11:41:44', 'Login', 'Login berhasil', 'Tersedia'),
(686, '173210327', 'Mahasiswa', '2022-02-24 11:55:07', 'Login', 'Login berhasil', 'Tersedia'),
(687, 'superadmin32', 'Prodi', '2022-02-24 11:56:00', 'Login', 'Login berhasil', 'Tersedia'),
(688, 'dekan', 'Fakultas', '2022-02-24 11:56:57', 'Login', 'Login berhasil', 'Tersedia'),
(689, '173310497', 'Mahasiswa', '2022-02-24 12:12:36', 'Login', 'Login berhasil', 'Tersedia'),
(690, 'tu', 'Tata Usaha', '2022-02-24 12:44:03', 'Login', 'Login berhasil', 'Tersedia'),
(691, 'tu', 'Tata Usaha', '2022-02-24 13:04:26', 'Login', 'Login berhasil', 'Tersedia'),
(692, 'tu', 'Tata Usaha', '2022-02-24 14:56:38', 'Login', 'Login berhasil', 'Tersedia'),
(693, 'tu', 'Tata Usaha', '2022-02-24 14:56:54', 'Login', 'Login berhasil', 'Tersedia'),
(694, 'superadmin35', 'Prodi', '2022-02-24 15:02:53', 'Login', 'Login berhasil', 'Tersedia'),
(695, '183510393', 'Mahasiswa', '2022-02-24 15:21:12', 'Login', 'Login berhasil', 'Tersedia'),
(696, 'dekan', 'Fakultas', '2022-02-24 16:03:16', 'Login', 'Login berhasil', 'Tersedia'),
(697, '163610123', 'Mahasiswa', '2022-02-24 16:09:58', 'Login', 'Login berhasil', 'Tersedia'),
(698, '183110123', 'Mahasiswa', '2022-02-24 19:02:37', 'Login', 'Login berhasil', 'Tersedia'),
(699, 'dekan', 'Fakultas', '2022-02-24 22:07:30', 'Login', 'Login berhasil', 'Tersedia'),
(700, 'superadmin35', 'Prodi', '2022-02-24 22:07:36', 'Login', 'Login berhasil', 'Tersedia'),
(701, 'tu', 'Tata Usaha', '2022-02-24 22:07:41', 'Login', 'Login berhasil', 'Tersedia'),
(702, '183510417', 'Mahasiswa', '2022-02-24 22:07:53', 'Login', 'Login berhasil', 'Tersedia'),
(703, 'tu', 'Tata Usaha', '2022-02-24 23:49:39', 'Login', 'Login berhasil', 'Tersedia'),
(704, 'tu', 'Tata Usaha', '2022-02-24 23:52:20', 'Login', 'Login berhasil', 'Tersedia'),
(705, '183110789', 'Mahasiswa', '2022-02-25 00:07:56', 'Login', 'Login berhasil', 'Tersedia'),
(706, 'superadmin31', 'Prodi', '2022-02-25 00:12:26', 'Login', 'Login berhasil', 'Tersedia'),
(707, '10008076401', 'Dosen', '2022-02-25 00:17:58', 'Login', 'Login berhasil', 'Tersedia'),
(708, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-25 00:22:47', 'Login', 'Login berhasil', 'Tersedia'),
(709, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-25 00:53:13', 'Login', 'Login berhasil', 'Tersedia'),
(710, 'tu', 'Tata Usaha', '2022-02-25 00:59:04', 'Login', 'Login berhasil', 'Tersedia'),
(711, 'tu', 'Tata Usaha', '2022-02-25 01:04:50', 'Login', 'Login berhasil', 'Tersedia'),
(712, '183510417', 'Mahasiswa', '2022-02-25 01:05:53', 'Login', 'Login berhasil', 'Tersedia'),
(713, 'superadmin31', 'Prodi', '2022-02-25 01:06:26', 'Login', 'Login berhasil', 'Tersedia'),
(714, '183510417', 'Mahasiswa', '2022-02-26 11:11:33', 'Login', 'Login berhasil', 'Tersedia'),
(715, '183510393', 'Mahasiswa', '2022-02-26 11:12:56', 'Login', 'Login berhasil', 'Tersedia'),
(716, 'dekan', 'Fakultas', '2022-02-26 11:17:05', 'Login', 'Login berhasil', 'Tersedia'),
(717, 'tu', 'Tata Usaha', '2022-02-26 11:20:16', 'Login', 'Login berhasil', 'Tersedia'),
(718, '183510393', 'Mahasiswa', '2022-02-26 12:57:31', 'Login', 'Login berhasil', 'Tersedia'),
(719, 'tu', 'Tata Usaha', '2022-02-26 12:57:41', 'Login', 'Login berhasil', 'Tersedia'),
(720, 'superadmin35', 'Prodi', '2022-02-26 12:57:57', 'Login', 'Login berhasil', 'Tersedia'),
(721, 'dekan', 'Fakultas', '2022-02-26 12:58:06', 'Login', 'Login berhasil', 'Tersedia'),
(722, '51023048901', 'Dosen', '2022-02-26 13:23:29', 'Login', 'Login berhasil', 'Tersedia'),
(723, '51014028904', 'Dosen', '2022-02-26 13:36:36', 'Login', 'Login berhasil', 'Tersedia'),
(724, '183510393', 'Mahasiswa', '2022-02-26 15:10:32', 'Login', 'Login berhasil', 'Tersedia'),
(725, 'dekan', 'Fakultas', '2022-02-26 15:11:13', 'Login', 'Login berhasil', 'Tersedia'),
(726, 'tu', 'Tata Usaha', '2022-02-26 16:51:52', 'Login', 'Login berhasil', 'Tersedia'),
(727, 'tu', 'Tata Usaha', '2022-02-26 17:16:32', 'Login', 'Login berhasil', 'Tersedia'),
(728, 'superadmin35', 'Prodi', '2022-02-26 17:30:45', 'Login', 'Login berhasil', 'Tersedia'),
(729, 'dekan', 'Fakultas', '2022-02-26 17:32:05', 'Login', 'Login berhasil', 'Tersedia'),
(730, '51002118702', 'Dosen', '2022-02-26 17:32:53', 'Login', 'Login berhasil', 'Tersedia'),
(731, 'tu', 'Tata Usaha', '2022-02-26 19:35:46', 'Login', 'Login berhasil', 'Tersedia'),
(732, '183510417', 'Mahasiswa', '2022-02-26 19:36:03', 'Login', 'Login berhasil', 'Tersedia'),
(733, '10008076401', 'Dosen', '2022-02-26 19:38:12', 'Login', 'Login berhasil', 'Tersedia'),
(734, '51014028904', 'Dosen', '2022-02-26 19:39:30', 'Login', 'Login berhasil', 'Tersedia'),
(735, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-26 19:42:59', 'Login', 'Login berhasil', 'Tersedia'),
(736, 'superadmin35', 'Prodi', '2022-02-26 19:43:30', 'Login', 'Login berhasil', 'Tersedia'),
(737, 'dekan', 'Fakultas', '2022-02-26 19:44:57', 'Login', 'Login berhasil', 'Tersedia'),
(738, 'dekan', 'Fakultas', '2022-02-26 21:46:40', 'Login', 'Login berhasil', 'Tersedia'),
(739, 'superadmin35', 'Prodi', '2022-02-26 21:47:38', 'Login', 'Login berhasil', 'Tersedia'),
(740, 'tu', 'Tata Usaha', '2022-02-26 21:49:09', 'Login', 'Login berhasil', 'Tersedia'),
(741, '183510417', 'Mahasiswa', '2022-02-26 21:49:51', 'Login', 'Login berhasil', 'Tersedia'),
(742, '51029027601', 'Dosen', '2022-02-26 23:00:51', 'Login', 'Login berhasil', 'Tersedia'),
(743, '183510228', 'Mahasiswa', '2022-02-27 00:27:17', 'Login', 'Login berhasil', 'Tersedia'),
(744, '183510400', 'Mahasiswa', '2022-02-27 00:47:07', 'Login', 'Login berhasil', 'Tersedia'),
(745, '183510400', 'Mahasiswa', '2022-02-27 01:29:58', 'Login', 'Login berhasil', 'Tersedia'),
(746, 'tu', 'Tata Usaha', '2022-02-27 01:30:09', 'Login', 'Login berhasil', 'Tersedia'),
(747, 'superadmin35', 'Prodi', '2022-02-27 01:30:14', 'Login', 'Login berhasil', 'Tersedia'),
(748, 'dekan', 'Fakultas', '2022-02-27 01:30:26', 'Login', 'Login berhasil', 'Tersedia'),
(749, '51029027601', 'Dosen', '2022-02-27 01:37:15', 'Login', 'Login berhasil', 'Tersedia'),
(750, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-27 01:39:57', 'Login', 'Login berhasil', 'Tersedia'),
(751, '183510400', 'Mahasiswa', '2022-02-27 12:05:58', 'Login', 'Login berhasil', 'Tersedia'),
(752, 'tu', 'Tata Usaha', '2022-02-27 12:06:06', 'Login', 'Login berhasil', 'Tersedia'),
(753, 'superadmin35', 'Prodi', '2022-02-27 12:06:17', 'Login', 'Login berhasil', 'Tersedia'),
(754, 'dekan', 'Fakultas', '2022-02-27 12:06:29', 'Login', 'Login berhasil', 'Tersedia'),
(755, '51029027601', 'Dosen', '2022-02-27 12:10:09', 'Login', 'Login berhasil', 'Tersedia'),
(756, '183510400', 'Mahasiswa', '2022-02-27 12:26:58', 'Login', 'Login berhasil', 'Tersedia'),
(757, '51029027601', 'Dosen', '2022-02-27 12:27:41', 'Login', 'Login berhasil', 'Tersedia'),
(758, '183110123', 'Mahasiswa', '2022-02-27 14:12:57', 'Login', 'Login berhasil', 'Tersedia'),
(759, 'dekan', 'Fakultas', '2022-02-27 14:13:28', 'Login', 'Login berhasil', 'Tersedia'),
(760, 'tu', 'Tata Usaha', '2022-02-27 14:13:35', 'Login', 'Login berhasil', 'Tersedia'),
(761, 'superadmin35', 'Prodi', '2022-02-27 14:13:41', 'Login', 'Login berhasil', 'Tersedia'),
(762, 'superadmin31', 'Prodi', '2022-02-27 14:14:08', 'Login', 'Login berhasil', 'Tersedia'),
(763, '183510400', 'Mahasiswa', '2022-02-27 18:38:29', 'Login', 'Login berhasil', 'Tersedia'),
(764, '183110123', 'Mahasiswa', '2022-02-27 18:38:54', 'Login', 'Login berhasil', 'Tersedia'),
(765, 'tu', 'Tata Usaha', '2022-02-27 18:39:12', 'Login', 'Login berhasil', 'Tersedia'),
(766, 'superadmin31', 'Prodi', '2022-02-27 18:39:27', 'Login', 'Login berhasil', 'Tersedia'),
(767, 'dekan', 'Fakultas', '2022-02-27 18:39:53', 'Login', 'Login berhasil', 'Tersedia'),
(768, '10008076401', 'Dosen', '2022-02-27 22:05:36', 'Login', 'Login berhasil', 'Tersedia'),
(769, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-02-27 22:18:25', 'Login', 'Login berhasil', 'Tersedia'),
(770, '183510400', 'Mahasiswa', '2022-02-27 23:08:07', 'Login', 'Login berhasil', 'Tersedia'),
(771, '10008076401', 'Dosen', '2022-02-27 23:09:55', 'Login', 'Login berhasil', 'Tersedia'),
(772, '51029027601', 'Dosen', '2022-02-27 23:11:54', 'Login', 'Login berhasil', 'Tersedia'),
(773, '183510400', 'Mahasiswa', '2022-02-28 10:11:59', 'Login', 'Login berhasil', 'Tersedia'),
(774, 'tu', 'Tata Usaha', '2022-02-28 10:12:13', 'Login', 'Login berhasil', 'Tersedia'),
(775, 'superadmin31', 'Prodi', '2022-02-28 10:12:18', 'Login', 'Login berhasil', 'Tersedia'),
(776, 'dekan', 'Fakultas', '2022-02-28 10:12:25', 'Login', 'Login berhasil', 'Tersedia'),
(777, '10008076401', 'Dosen', '2022-02-28 10:13:54', 'Login', 'Login berhasil', 'Tersedia'),
(778, '51029027601', 'Dosen', '2022-02-28 10:14:39', 'Login', 'Login berhasil', 'Tersedia'),
(779, '183110123', 'Mahasiswa', '2022-02-28 10:18:56', 'Login', 'Login berhasil', 'Tersedia'),
(780, '183510400', 'Mahasiswa', '2022-02-28 10:19:12', 'Login', 'Login berhasil', 'Tersedia'),
(781, 'superadmin35', 'Prodi', '2022-02-28 10:33:16', 'Login', 'Login berhasil', 'Tersedia'),
(782, '50314068701', 'Dosen', '2022-02-28 10:35:17', 'Login', 'Login berhasil', 'Tersedia'),
(783, '183510400', 'Mahasiswa', '2022-02-28 12:15:46', 'Login', 'Login berhasil', 'Tersedia'),
(784, '51029027601', 'Dosen', '2022-02-28 13:09:28', 'Login', 'Login berhasil', 'Tersedia'),
(785, '183510400', 'Mahasiswa', '2022-02-28 22:04:46', 'Login', 'Login berhasil', 'Tersedia'),
(786, 'tu', 'Tata Usaha', '2022-02-28 22:06:07', 'Login', 'Login berhasil', 'Tersedia'),
(787, 'superadmin35', 'Prodi', '2022-02-28 22:06:23', 'Login', 'Login berhasil', 'Tersedia'),
(788, '50314068701', 'Dosen', '2022-02-28 22:07:11', 'Login', 'Login berhasil', 'Tersedia'),
(789, '183510393', 'Mahasiswa', '2022-02-28 22:35:15', 'Login', 'Login berhasil', 'Tersedia'),
(790, '183110123', 'Mahasiswa', '2022-02-28 22:36:00', 'Login', 'Login berhasil', 'Tersedia'),
(791, 'superadmin31', 'Prodi', '2022-02-28 22:53:57', 'Login', 'Login berhasil', 'Tersedia'),
(792, 'dekan', 'Fakultas', '2022-02-28 22:55:08', 'Login', 'Login berhasil', 'Tersedia'),
(793, '11005057003', 'Dosen', '2022-02-28 22:56:37', 'Login', 'Login berhasil', 'Tersedia'),
(794, '183510400', 'Mahasiswa', '2022-02-28 23:14:03', 'Login', 'Login berhasil', 'Tersedia'),
(795, 'tu', 'Tata Usaha', '2022-03-01 01:01:39', 'Login', 'Login berhasil', 'Tersedia'),
(796, '183510400', 'Mahasiswa', '2022-03-01 01:01:48', 'Login', 'Login berhasil', 'Tersedia'),
(797, '183510393', 'Mahasiswa', '2022-03-01 01:02:23', 'Login', 'Login berhasil', 'Tersedia'),
(798, 'dekan', 'Fakultas', '2022-03-01 01:02:57', 'Login', 'Login berhasil', 'Tersedia'),
(799, 'superadmin35', 'Prodi', '2022-03-01 01:03:12', 'Login', 'Login berhasil', 'Tersedia'),
(800, '51023048901', 'Dosen', '2022-03-01 01:07:39', 'Login', 'Login berhasil', 'Tersedia'),
(801, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-01 01:09:42', 'Login', 'Login berhasil', 'Tersedia'),
(802, '183510400', 'Mahasiswa', '2022-03-01 01:11:44', 'Login', 'Login berhasil', 'Tersedia'),
(803, 'dekan', 'Fakultas', '2022-03-01 11:03:16', 'Login', 'Login berhasil', 'Tersedia'),
(804, 'tu', 'Tata Usaha', '2022-03-01 12:51:57', 'Login', 'Login berhasil', 'Tersedia'),
(805, '183510400', 'Mahasiswa', '2022-03-01 22:01:37', 'Login', 'Login berhasil', 'Tersedia'),
(806, 'tu', 'Tata Usaha', '2022-03-01 22:01:42', 'Login', 'Login berhasil', 'Tersedia'),
(807, 'superadmin35', 'Prodi', '2022-03-01 22:01:46', 'Login', 'Login berhasil', 'Tersedia'),
(808, 'dekan', 'Fakultas', '2022-03-01 22:01:51', 'Login', 'Login berhasil', 'Tersedia'),
(809, 'tu', 'Tata Usaha', '2022-03-01 23:29:27', 'Login', 'Login berhasil', 'Tersedia'),
(810, 'tu', 'Tata Usaha', '2022-03-02 09:46:55', 'Login', 'Login berhasil', 'Tersedia'),
(811, '183510393', 'Mahasiswa', '2022-03-02 09:47:40', 'Login', 'Login berhasil', 'Tersedia'),
(812, 'superadmin35', 'Prodi', '2022-03-02 09:48:07', 'Login', 'Login berhasil', 'Tersedia'),
(813, 'dekan', 'Fakultas', '2022-03-02 09:48:22', 'Login', 'Login berhasil', 'Tersedia'),
(814, '51023048901', 'Dosen', '2022-03-02 09:52:53', 'Login', 'Login berhasil', 'Tersedia'),
(815, 'tu', 'Tata Usaha', '2022-03-02 13:10:04', 'Login', 'Login berhasil', 'Tersedia'),
(816, '183510393', 'Mahasiswa', '2022-03-02 13:23:11', 'Login', 'Login berhasil', 'Tersedia'),
(817, 'superadmin35', 'Prodi', '2022-03-02 13:30:37', 'Login', 'Login berhasil', 'Tersedia'),
(818, 'dekan', 'Fakultas', '2022-03-02 13:30:43', 'Login', 'Login berhasil', 'Tersedia'),
(819, 'tu', 'Tata Usaha', '2022-03-02 13:52:19', 'Login', 'Login berhasil', 'Tersedia'),
(820, '50314068701', 'Dosen', '2022-03-02 14:58:40', 'Login', 'Login berhasil', 'Tersedia'),
(821, 'dekan', 'Fakultas', '2022-03-02 16:07:31', 'Login', 'Login berhasil', 'Tersedia'),
(822, 'tu', 'Tata Usaha', '2022-03-02 16:42:57', 'Login', 'Login berhasil', 'Tersedia'),
(823, 'tu', 'Tata Usaha', '2022-03-02 19:12:34', 'Login', 'Login berhasil', 'Tersedia'),
(824, 'tu', 'Tata Usaha', '2022-03-02 19:14:45', 'Login', 'Login berhasil', 'Tersedia'),
(825, '183510393', 'Mahasiswa', '2022-03-02 19:33:17', 'Login', 'Login berhasil', 'Tersedia'),
(826, 'tu', 'Tata Usaha', '2022-03-02 20:38:02', 'Login', 'Login berhasil', 'Tersedia'),
(827, '183510393', 'Mahasiswa', '2022-03-02 21:12:23', 'Login', 'Login berhasil', 'Tersedia'),
(828, 'superadmin35', 'Prodi', '2022-03-02 21:34:04', 'Login', 'Login berhasil', 'Tersedia'),
(829, '183510417', 'Mahasiswa', '2022-03-02 22:57:19', 'Login', 'Login berhasil', 'Tersedia'),
(830, 'tu', 'Tata Usaha', '2022-03-02 22:57:39', 'Login', 'Login berhasil', 'Tersedia'),
(831, 'dekan', 'Fakultas', '2022-03-02 22:58:01', 'Login', 'Login berhasil', 'Tersedia'),
(832, 'tu', 'Tata Usaha', '2022-03-03 07:04:42', 'Login', 'Login berhasil', 'Tersedia'),
(833, 'superadmin35', 'Prodi', '2022-03-03 07:33:40', 'Login', 'Login berhasil', 'Tersedia'),
(834, '183510400', 'Mahasiswa', '2022-03-03 08:03:43', 'Login', 'Login berhasil', 'Tersedia'),
(835, '51023048901', 'Dosen', '2022-03-03 08:30:29', 'Login', 'Login berhasil', 'Tersedia'),
(836, 'tu', 'Tata Usaha', '2022-03-03 13:26:07', 'Login', 'Login berhasil', 'Tersedia'),
(837, '51023048901', 'Dosen', '2022-03-03 13:27:01', 'Login', 'Login berhasil', 'Tersedia'),
(838, 'superadmin35', 'Prodi', '2022-03-03 13:35:35', 'Login', 'Login berhasil', 'Tersedia'),
(839, '183510400', 'Mahasiswa', '2022-03-03 13:42:19', 'Login', 'Login berhasil', 'Tersedia'),
(840, '183510393', 'Mahasiswa', '2022-03-03 14:05:08', 'Login', 'Login berhasil', 'Tersedia'),
(841, 'tu', 'Tata Usaha', '2022-03-03 20:51:24', 'Login', 'Login berhasil', 'Tersedia'),
(842, 'superadmin35', 'Prodi', '2022-03-03 20:51:40', 'Login', 'Login berhasil', 'Tersedia'),
(843, '51023048901', 'Dosen', '2022-03-03 20:52:37', 'Login', 'Login berhasil', 'Tersedia'),
(844, '183510720', 'Mahasiswa', '2022-03-03 21:11:22', 'Login', 'Login berhasil', 'Tersedia'),
(845, 'dekan', 'Fakultas', '2022-03-03 21:11:47', 'Login', 'Login berhasil', 'Tersedia'),
(846, '51029027601', 'Dosen', '2022-03-03 21:34:12', 'Login', 'Login berhasil', 'Tersedia'),
(847, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-03 21:42:01', 'Login', 'Login berhasil', 'Tersedia'),
(848, '183510393', 'Mahasiswa', '2022-03-04 14:27:57', 'Login', 'Login berhasil', 'Tersedia'),
(849, 'tu', 'Tata Usaha', '2022-03-04 14:30:47', 'Login', 'Login berhasil', 'Tersedia'),
(850, 'superadmin35', 'Prodi', '2022-03-04 14:31:00', 'Login', 'Login berhasil', 'Tersedia'),
(851, 'dekan', 'Fakultas', '2022-03-04 14:31:04', 'Login', 'Login berhasil', 'Tersedia'),
(852, '51023048901', 'Dosen', '2022-03-04 14:53:52', 'Login', 'Login berhasil', 'Tersedia'),
(853, '51023048901', 'Dosen', '2022-03-04 15:12:43', 'Login', 'Login berhasil', 'Tersedia'),
(854, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-04 16:10:58', 'Login', 'Login berhasil', 'Tersedia'),
(855, 'upm', 'UPM', '2022-03-04 16:35:19', 'Login', 'Login berhasil', 'Tersedia'),
(856, 'dekan', 'Fakultas', '2022-03-04 16:36:00', 'Login', 'Login berhasil', 'Tersedia'),
(857, '183510393', 'Mahasiswa', '2022-03-04 19:46:14', 'Login', 'Login berhasil', 'Tersedia'),
(858, 'tu', 'Tata Usaha', '2022-03-04 19:46:34', 'Login', 'Login berhasil', 'Tersedia'),
(859, 'tu', 'Tata Usaha', '2022-03-04 21:53:53', 'Login', 'Login berhasil', 'Tersedia'),
(860, '183510393', 'Mahasiswa', '2022-03-04 21:54:23', 'Login', 'Login berhasil', 'Tersedia'),
(861, 'tu', 'Tata Usaha', '2022-03-04 21:54:45', 'Login', 'Login berhasil', 'Tersedia'),
(862, 'superadmin35', 'Prodi', '2022-03-04 21:54:51', 'Login', 'Login berhasil', 'Tersedia'),
(863, 'dekan', 'Fakultas', '2022-03-04 21:55:00', 'Login', 'Login berhasil', 'Tersedia'),
(864, '51023048901', 'Dosen', '2022-03-04 22:43:57', 'Login', 'Login berhasil', 'Tersedia'),
(865, 'wd1', 'Fakultas', '2022-03-05 08:07:31', 'Login', 'Login berhasil', 'Tersedia'),
(866, 'tu', 'Tata Usaha', '2022-03-05 08:12:52', 'Login', 'Login berhasil', 'Tersedia'),
(867, '183510400', 'Mahasiswa', '2022-03-05 08:13:11', 'Login', 'Login berhasil', 'Tersedia'),
(868, 'superadmin35', 'Prodi', '2022-03-05 08:13:47', 'Login', 'Login berhasil', 'Tersedia'),
(869, 'dekan', 'Fakultas', '2022-03-05 08:14:08', 'Login', 'Login berhasil', 'Tersedia'),
(870, 'wd1', 'Fakultas', '2022-03-05 08:29:16', 'Login', 'Login berhasil', 'Tersedia'),
(871, '183510393', 'Mahasiswa', '2022-03-05 08:50:27', 'Login', 'Login berhasil', 'Tersedia'),
(872, 'dekan', 'Fakultas', '2022-03-05 11:51:00', 'Login', 'Login berhasil', 'Tersedia'),
(873, 'wd1', 'Fakultas', '2022-03-05 11:51:30', 'Login', 'Login berhasil', 'Tersedia'),
(874, '183510393', 'Mahasiswa', '2022-03-05 12:08:23', 'Login', 'Login berhasil', 'Tersedia'),
(875, 'tu', 'Tata Usaha', '2022-03-05 12:08:37', 'Login', 'Login berhasil', 'Tersedia'),
(876, 'superadmin35', 'Prodi', '2022-03-05 12:09:03', 'Login', 'Login berhasil', 'Tersedia'),
(877, '183510400', 'Mahasiswa', '2022-03-05 13:06:52', 'Login', 'Login berhasil', 'Tersedia'),
(878, '51023048901', 'Dosen', '2022-03-05 13:13:03', 'Login', 'Login berhasil', 'Tersedia'),
(879, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-05 13:16:37', 'Login', 'Login berhasil', 'Tersedia'),
(880, '183510417', 'Mahasiswa', '2022-03-05 13:38:57', 'Login', 'Login berhasil', 'Tersedia'),
(881, '183510400', 'Mahasiswa', '2022-03-05 13:54:10', 'Login', 'Login berhasil', 'Tersedia'),
(882, 'dekan', 'Fakultas', '2022-03-05 20:24:04', 'Login', 'Login berhasil', 'Tersedia'),
(883, '183510400', 'Mahasiswa', '2022-03-05 20:24:59', 'Login', 'Login berhasil', 'Tersedia'),
(884, 'tu', 'Tata Usaha', '2022-03-05 20:25:38', 'Login', 'Login berhasil', 'Tersedia'),
(885, 'superadmin35', 'Prodi', '2022-03-05 20:25:54', 'Login', 'Login berhasil', 'Tersedia'),
(886, '183510720', 'Mahasiswa', '2022-03-05 20:26:58', 'Login', 'Login berhasil', 'Tersedia'),
(887, 'wd1', 'Fakultas', '2022-03-05 20:28:15', 'Login', 'Login berhasil', 'Tersedia'),
(888, 'superadmin35', 'Prodi', '2022-03-05 23:45:10', 'Login', 'Login berhasil', 'Tersedia'),
(889, '51023048901', 'Dosen', '2022-03-05 23:47:29', 'Login', 'Login berhasil', 'Tersedia'),
(890, 'dekan', 'Fakultas', '2022-03-06 00:20:33', 'Login', 'Login berhasil', 'Tersedia'),
(891, 'wd1', 'Fakultas', '2022-03-06 00:21:01', 'Login', 'Login berhasil', 'Tersedia'),
(892, 'dekan', 'Fakultas', '2022-03-06 13:04:57', 'Login', 'Login berhasil', 'Tersedia'),
(893, 'superadmin35', 'Prodi', '2022-03-06 13:05:01', 'Login', 'Login berhasil', 'Tersedia'),
(894, 'tu', 'Tata Usaha', '2022-03-06 13:05:06', 'Login', 'Login berhasil', 'Tersedia'),
(895, '51023048901', 'Dosen', '2022-03-06 13:08:57', 'Login', 'Login berhasil', 'Tersedia'),
(896, '183510393', 'Mahasiswa', '2022-03-06 13:16:58', 'Login', 'Login berhasil', 'Tersedia'),
(897, '183510417', 'Mahasiswa', '2022-03-06 13:23:15', 'Login', 'Login berhasil', 'Tersedia'),
(898, 'wd1', 'Fakultas', '2022-03-06 13:28:42', 'Login', 'Login berhasil', 'Tersedia'),
(899, '183510720', 'Mahasiswa', '2022-03-06 13:45:26', 'Login', 'Login berhasil', 'Tersedia'),
(900, '183510393', 'Mahasiswa', '2022-03-06 13:47:47', 'Login', 'Login berhasil', 'Tersedia'),
(901, 'tu', 'Tata Usaha', '2022-03-06 14:04:06', 'Login', 'Login berhasil', 'Tersedia'),
(902, '51023048901', 'Dosen', '2022-03-06 20:44:55', 'Login', 'Login berhasil', 'Tersedia'),
(903, 'dekan', 'Fakultas', '2022-03-06 20:46:08', 'Login', 'Login berhasil', 'Tersedia'),
(904, 'wd1', 'Fakultas', '2022-03-06 22:01:45', 'Login', 'Login berhasil', 'Tersedia'),
(905, '183510393', 'Mahasiswa', '2022-03-06 22:52:51', 'Login', 'Login berhasil', 'Tersedia'),
(906, 'tu', 'Tata Usaha', '2022-03-06 22:53:17', 'Login', 'Login berhasil', 'Tersedia'),
(907, '183510720', 'Mahasiswa', '2022-03-07 10:04:22', 'Login', 'Login berhasil', 'Tersedia'),
(908, '183510417', 'Mahasiswa', '2022-03-07 10:05:02', 'Login', 'Login berhasil', 'Tersedia'),
(909, '193510261', 'Mahasiswa', '2022-03-07 10:06:04', 'Login', 'Login berhasil', 'Tersedia'),
(910, 'dekan', 'Fakultas', '2022-03-07 10:06:29', 'Login', 'Login berhasil', 'Tersedia'),
(911, 'superadmin35', 'Prodi', '2022-03-07 10:06:36', 'Login', 'Login berhasil', 'Tersedia'),
(912, 'tu', 'Tata Usaha', '2022-03-07 10:06:41', 'Login', 'Login berhasil', 'Tersedia'),
(913, '183510720', 'Mahasiswa', '2022-03-07 11:40:33', 'Login', 'Login berhasil', 'Tersedia'),
(914, '183510393', 'Mahasiswa', '2022-03-07 11:44:36', 'Login', 'Login berhasil', 'Tersedia'),
(915, '51023048901', 'Dosen', '2022-03-07 11:45:57', 'Login', 'Login berhasil', 'Tersedia'),
(916, 'upm', 'UPM', '2022-03-07 13:11:45', 'Login', 'Login berhasil', 'Tersedia'),
(917, '51023048901', 'Dosen', '2022-03-07 13:13:11', 'Login', 'Login berhasil', 'Tersedia'),
(918, '183510393', 'Mahasiswa', '2022-03-08 09:41:54', 'Login', 'Login berhasil', 'Tersedia'),
(919, 'tu', 'Tata Usaha', '2022-03-08 09:46:27', 'Login', 'Login berhasil', 'Tersedia'),
(920, 'superadmin35', 'Prodi', '2022-03-08 09:46:45', 'Login', 'Login berhasil', 'Tersedia'),
(921, 'dekan', 'Fakultas', '2022-03-08 09:47:45', 'Login', 'Login berhasil', 'Tersedia'),
(922, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-08 10:01:18', 'Login', 'Login berhasil', 'Tersedia'),
(923, '51023048901', 'Dosen', '2022-03-08 10:31:53', 'Login', 'Login berhasil', 'Tersedia'),
(924, 'tu', 'Tata Usaha', '2022-03-08 11:32:05', 'Login', 'Login berhasil', 'Tersedia'),
(925, '51023048901', 'Dosen', '2022-03-08 11:51:29', 'Login', 'Login berhasil', 'Tersedia'),
(926, 'dekan', 'Fakultas', '2022-03-08 11:51:37', 'Login', 'Login berhasil', 'Tersedia'),
(927, 'dekan', 'Fakultas', '2022-03-08 12:21:03', 'Login', 'Login berhasil', 'Tersedia'),
(928, '51029027601', 'Dosen', '2022-03-08 13:01:04', 'Login', 'Login berhasil', 'Tersedia'),
(929, 'dekan', 'Fakultas', '2022-03-08 13:05:47', 'Login', 'Login berhasil', 'Tersedia'),
(930, '183510720', 'Mahasiswa', '2022-03-08 19:04:49', 'Login', 'Login berhasil', 'Tersedia'),
(931, '193510282', 'Mahasiswa', '2022-03-08 19:08:06', 'Login', 'Login berhasil', 'Tersedia'),
(932, '183510393', 'Mahasiswa', '2022-03-08 19:11:10', 'Login', 'Login berhasil', 'Tersedia'),
(933, 'tu', 'Tata Usaha', '2022-03-08 19:19:28', 'Login', 'Login berhasil', 'Tersedia'),
(934, 'superadmin35', 'Prodi', '2022-03-08 19:33:32', 'Login', 'Login berhasil', 'Tersedia'),
(935, 'dekan', 'Fakultas', '2022-03-08 19:37:29', 'Login', 'Login berhasil', 'Tersedia'),
(936, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-08 20:08:33', 'Login', 'Login berhasil', 'Tersedia'),
(937, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-08 22:08:15', 'Login', 'Login berhasil', 'Tersedia'),
(938, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-09 09:57:50', 'Login', 'Login berhasil', 'Tersedia'),
(939, 'tu', 'Tata Usaha', '2022-03-09 09:59:08', 'Login', 'Login berhasil', 'Tersedia'),
(940, '51023048901', 'Dosen', '2022-03-09 11:09:09', 'Login', 'Login berhasil', 'Tersedia'),
(941, '183510393', 'Mahasiswa', '2022-03-09 11:18:16', 'Login', 'Login berhasil', 'Tersedia'),
(942, 'tu', 'Tata Usaha', '2022-03-09 11:22:13', 'Login', 'Login berhasil', 'Tersedia'),
(943, 'superadmin35', 'Prodi', '2022-03-09 11:51:39', 'Login', 'Login berhasil', 'Tersedia'),
(944, 'dekan', 'Fakultas', '2022-03-09 11:51:52', 'Login', 'Login berhasil', 'Tersedia'),
(945, 'tu', 'Tata Usaha', '2022-03-09 15:25:56', 'Login', 'Login berhasil', 'Tersedia'),
(946, 'tu', 'Tata Usaha', '2022-03-09 15:44:49', 'Login', 'Login berhasil', 'Tersedia'),
(947, 'superadmin35', 'Prodi', '2022-03-09 15:49:39', 'Login', 'Login berhasil', 'Tersedia'),
(948, 'dekan', 'Fakultas', '2022-03-09 15:50:07', 'Login', 'Login berhasil', 'Tersedia'),
(949, '51023048901', 'Dosen', '2022-03-09 16:11:23', 'Login', 'Login berhasil', 'Tersedia'),
(950, 'tu', 'Tata Usaha', '2022-03-09 21:32:47', 'Login', 'Login berhasil', 'Tersedia'),
(951, 'tu', 'Tata Usaha', '2022-03-09 21:36:23', 'Login', 'Login berhasil', 'Tersedia'),
(952, '183510393', 'Mahasiswa', '2022-03-09 21:54:39', 'Login', 'Login berhasil', 'Tersedia'),
(953, '183210732', 'Mahasiswa', '2022-03-09 21:55:51', 'Login', 'Login berhasil', 'Tersedia'),
(954, 'tu', 'Tata Usaha', '2022-03-09 21:56:39', 'Login', 'Login berhasil', 'Tersedia'),
(955, '173110270', 'Mahasiswa', '2022-03-09 22:05:17', 'Login', 'Login berhasil', 'Tersedia'),
(956, '183510393', 'Mahasiswa', '2022-03-09 22:12:26', 'Login', 'Login berhasil', 'Tersedia'),
(957, '183310834', 'Mahasiswa', '2022-03-09 22:18:35', 'Login', 'Login berhasil', 'Tersedia'),
(958, '183510393', 'Mahasiswa', '2022-03-09 23:05:06', 'Login', 'Login berhasil', 'Tersedia'),
(959, '173110270', 'Mahasiswa', '2022-03-09 23:05:25', 'Login', 'Login berhasil', 'Tersedia'),
(960, '173110270', 'Mahasiswa', '2022-03-09 23:05:58', 'Login', 'Login berhasil', 'Tersedia'),
(961, '173110270', 'Mahasiswa', '2022-03-09 23:20:47', 'Login', 'Login berhasil', 'Tersedia'),
(962, '183510393', 'Mahasiswa', '2022-03-09 23:21:24', 'Login', 'Login berhasil', 'Tersedia'),
(963, '183510393', 'Mahasiswa', '2022-03-09 23:22:06', 'Login', 'Login berhasil', 'Tersedia'),
(964, '183510393', 'Mahasiswa', '2022-03-09 23:26:42', 'Login', 'Login berhasil', 'Tersedia'),
(965, '183510393', 'Mahasiswa', '2022-03-09 23:37:13', 'Login', 'Login berhasil', 'Tersedia'),
(966, 'tu', 'Tata Usaha', '2022-03-10 09:15:20', 'Login', 'Login berhasil', 'Tersedia'),
(967, '183510393', 'Mahasiswa', '2022-03-10 13:03:13', 'Login', 'Login berhasil', 'Tersedia'),
(968, 'superadmin35', 'Prodi', '2022-03-10 13:03:40', 'Login', 'Login berhasil', 'Tersedia'),
(969, '51023048901', 'Dosen', '2022-03-10 13:04:53', 'Login', 'Login berhasil', 'Tersedia'),
(970, '183510417', 'Mahasiswa', '2022-03-10 14:21:00', 'Login', 'Login berhasil', 'Tersedia'),
(971, 'tu', 'Tata Usaha', '2022-03-10 14:22:55', 'Login', 'Login berhasil', 'Tersedia'),
(972, '51029027601', 'Dosen', '2022-03-10 14:28:15', 'Login', 'Login berhasil', 'Tersedia'),
(973, '50314068701', 'Dosen', '2022-03-10 14:29:11', 'Login', 'Login berhasil', 'Tersedia'),
(974, '193510261', 'Mahasiswa', '2022-03-10 15:01:35', 'Login', 'Login berhasil', 'Tersedia'),
(975, 'tu', 'Tata Usaha', '2022-03-10 15:01:59', 'Login', 'Login berhasil', 'Tersedia'),
(976, 'superadmin35', 'Prodi', '2022-03-10 15:02:30', 'Login', 'Login berhasil', 'Tersedia'),
(977, 'dekan', 'Fakultas', '2022-03-10 15:03:11', 'Login', 'Login berhasil', 'Tersedia'),
(978, '51029027601', 'Dosen', '2022-03-10 15:11:47', 'Login', 'Login berhasil', 'Tersedia'),
(979, '50314068701', 'Dosen', '2022-03-10 15:12:31', 'Login', 'Login berhasil', 'Tersedia'),
(980, '50314068701', 'Dosen', '2022-03-10 15:58:40', 'Login', 'Login berhasil', 'Tersedia'),
(981, '51029027601', 'Dosen', '2022-03-10 15:59:13', 'Login', 'Login berhasil', 'Tersedia'),
(982, '193510261', 'Mahasiswa', '2022-03-10 19:00:28', 'Login', 'Login berhasil', 'Tersedia'),
(983, 'tu', 'Tata Usaha', '2022-03-10 21:40:32', 'Login', 'Login berhasil', 'Tersedia'),
(984, '193510261', 'Mahasiswa', '2022-03-10 21:40:46', 'Login', 'Login berhasil', 'Tersedia'),
(985, '193510261', 'Mahasiswa', '2022-03-10 22:11:56', 'Login', 'Login berhasil', 'Tersedia'),
(986, '183510393', 'Mahasiswa', '2022-03-10 22:48:34', 'Login', 'Login berhasil', 'Tersedia'),
(987, '51029027601', 'Dosen', '2022-03-10 22:49:00', 'Login', 'Login berhasil', 'Tersedia'),
(988, '50314068701', 'Dosen', '2022-03-10 22:49:50', 'Login', 'Login berhasil', 'Tersedia'),
(989, 'superadmin35', 'Prodi', '2022-03-10 23:02:30', 'Login', 'Login berhasil', 'Tersedia'),
(990, 'tu', 'Tata Usaha', '2022-03-10 23:44:44', 'Login', 'Login berhasil', 'Tersedia'),
(991, 'tu', 'Tata Usaha', '2022-03-11 07:55:18', 'Login', 'Login berhasil', 'Tersedia'),
(992, '193510261', 'Mahasiswa', '2022-03-11 07:55:22', 'Login', 'Login berhasil', 'Tersedia'),
(993, '183510393', 'Mahasiswa', '2022-03-11 07:55:45', 'Login', 'Login berhasil', 'Tersedia'),
(994, 'superadmin35', 'Prodi', '2022-03-11 08:00:24', 'Login', 'Login berhasil', 'Tersedia'),
(995, '51029027601', 'Dosen', '2022-03-11 08:03:11', 'Login', 'Login berhasil', 'Tersedia'),
(996, '50314068701', 'Dosen', '2022-03-11 08:03:55', 'Login', 'Login berhasil', 'Tersedia'),
(997, '51031126801', 'Dosen', '2022-03-11 08:05:09', 'Login', 'Login berhasil', 'Tersedia'),
(998, '51014028904', 'Dosen', '2022-03-11 08:05:30', 'Login', 'Login berhasil', 'Tersedia'),
(999, '51023048901', 'Dosen', '2022-03-11 08:10:26', 'Login', 'Login berhasil', 'Tersedia'),
(1000, 'dekan', 'Fakultas', '2022-03-11 08:15:01', 'Login', 'Login berhasil', 'Tersedia'),
(1001, '183510393', 'Mahasiswa', '2022-03-11 12:42:30', 'Login', 'Login berhasil', 'Tersedia'),
(1002, '51023048901', 'Dosen', '2022-03-11 12:43:34', 'Login', 'Login berhasil', 'Tersedia'),
(1003, '51031126801', 'Dosen', '2022-03-11 12:46:11', 'Login', 'Login berhasil', 'Tersedia'),
(1004, '51014028904', 'Dosen', '2022-03-11 12:47:50', 'Login', 'Login berhasil', 'Tersedia'),
(1005, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-11 13:24:01', 'Login', 'Login berhasil', 'Tersedia'),
(1006, 'superadmin35', 'Prodi', '2022-03-11 14:43:18', 'Login', 'Login berhasil', 'Tersedia'),
(1007, '183510393', 'Mahasiswa', '2022-03-11 16:09:57', 'Login', 'Login berhasil', 'Tersedia'),
(1008, '183510393', 'Mahasiswa', '2022-03-12 10:23:15', 'Login', 'Login berhasil', 'Tersedia'),
(1009, '183510393', 'Mahasiswa', '2022-03-12 12:52:31', 'Login', 'Login berhasil', 'Tersedia'),
(1010, 'superadmin35', 'Prodi', '2022-03-12 12:56:21', 'Login', 'Login berhasil', 'Tersedia'),
(1011, '193510261', 'Mahasiswa', '2022-03-12 13:09:50', 'Login', 'Login berhasil', 'Tersedia'),
(1012, '51023048901', 'Dosen', '2022-03-12 13:30:21', 'Login', 'Login berhasil', 'Tersedia'),
(1013, '51031126801', 'Dosen', '2022-03-12 13:31:59', 'Login', 'Login berhasil', 'Tersedia'),
(1014, 'tu', 'Tata Usaha', '2022-03-12 13:36:45', 'Login', 'Login berhasil', 'Tersedia'),
(1015, '183510400', 'Mahasiswa', '2022-03-12 14:51:51', 'Login', 'Login berhasil', 'Tersedia'),
(1016, '51023048901', 'Dosen', '2022-03-12 14:52:42', 'Login', 'Login berhasil', 'Tersedia'),
(1017, 'dekan', 'Fakultas', '2022-03-12 14:56:42', 'Login', 'Login berhasil', 'Tersedia'),
(1018, '183510393', 'Mahasiswa', '2022-03-12 15:55:17', 'Login', 'Login berhasil', 'Tersedia'),
(1019, 'tu', 'Tata Usaha', '2022-03-12 21:53:30', 'Login', 'Login berhasil', 'Tersedia'),
(1020, '193510261', 'Mahasiswa', '2022-03-12 21:54:05', 'Login', 'Login berhasil', 'Tersedia'),
(1021, '183510393', 'Mahasiswa', '2022-03-12 23:15:35', 'Login', 'Login berhasil', 'Tersedia'),
(1022, '51023048901', 'Dosen', '2022-03-12 23:16:16', 'Login', 'Login berhasil', 'Tersedia'),
(1023, 'superadmin35', 'Prodi', '2022-03-12 23:36:44', 'Login', 'Login berhasil', 'Tersedia'),
(1024, 'tu', 'Tata Usaha', '2022-03-13 16:59:32', 'Login', 'Login berhasil', 'Tersedia'),
(1025, '183510393', 'Mahasiswa', '2022-03-13 17:00:05', 'Login', 'Login berhasil', 'Tersedia'),
(1026, '183510393', 'Mahasiswa', '2022-03-13 17:00:41', 'Login', 'Login berhasil', 'Tersedia'),
(1027, 'superadmin35', 'Prodi', '2022-03-13 17:01:23', 'Login', 'Login berhasil', 'Tersedia'),
(1028, 'dekan', 'Fakultas', '2022-03-13 17:02:02', 'Login', 'Login berhasil', 'Tersedia'),
(1029, '51029027601', 'Dosen', '2022-03-13 17:05:46', 'Login', 'Login berhasil', 'Tersedia'),
(1030, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-13 17:08:06', 'Login', 'Login berhasil', 'Tersedia'),
(1031, '173510190', 'Mahasiswa', '2022-03-13 17:12:09', 'Login', 'Login berhasil', 'Tersedia'),
(1032, '183510393', 'Mahasiswa', '2022-03-13 19:49:11', 'Login', 'Login berhasil', 'Tersedia'),
(1033, 'tu', 'Tata Usaha', '2022-03-13 19:49:20', 'Login', 'Login berhasil', 'Tersedia'),
(1034, 'superadmin35', 'Prodi', '2022-03-13 19:49:29', 'Login', 'Login berhasil', 'Tersedia'),
(1035, 'dekan', 'Fakultas', '2022-03-13 19:49:39', 'Login', 'Login berhasil', 'Tersedia'),
(1036, '51029027601', 'Dosen', '2022-03-13 19:53:49', 'Login', 'Login berhasil', 'Tersedia'),
(1037, '50314068701', 'Dosen', '2022-03-13 20:14:16', 'Login', 'Login berhasil', 'Tersedia'),
(1038, '51002118702', 'Dosen', '2022-03-13 20:14:39', 'Login', 'Login berhasil', 'Tersedia'),
(1039, 'dekan', 'Fakultas', '2022-03-13 20:19:41', 'Login', 'Login berhasil', 'Tersedia'),
(1040, 'superadmin35', 'Prodi', '2022-03-13 21:21:41', 'Login', 'Login berhasil', 'Tersedia'),
(1041, '183510393', 'Mahasiswa', '2022-03-14 09:42:53', 'Login', 'Login berhasil', 'Tersedia'),
(1042, 'superadmin35', 'Prodi', '2022-03-14 09:43:42', 'Login', 'Login berhasil', 'Tersedia'),
(1043, 'tu', 'Tata Usaha', '2022-03-14 09:43:47', 'Login', 'Login berhasil', 'Tersedia'),
(1044, '51029027601', 'Dosen', '2022-03-14 10:03:53', 'Login', 'Login berhasil', 'Tersedia'),
(1045, '183510393', 'Mahasiswa', '2022-03-14 13:19:47', 'Login', 'Login berhasil', 'Tersedia'),
(1046, '183510393', 'Mahasiswa', '2022-03-14 13:25:51', 'Login', 'Login berhasil', 'Tersedia'),
(1047, 'tu', 'Tata Usaha', '2022-03-14 13:28:36', 'Login', 'Login berhasil', 'Tersedia'),
(1048, 'superadmin35', 'Prodi', '2022-03-14 13:32:15', 'Login', 'Login berhasil', 'Tersedia'),
(1049, 'tu', 'Tata Usaha', '2022-03-14 14:05:17', 'Login', 'Login berhasil', 'Tersedia'),
(1050, 'tu', 'Tata Usaha', '2022-03-14 15:52:10', 'Login', 'Login berhasil', 'Tersedia'),
(1051, '183510393', 'Mahasiswa', '2022-03-15 09:04:24', 'Login', 'Login berhasil', 'Tersedia'),
(1052, 'tu', 'Tata Usaha', '2022-03-15 09:04:35', 'Login', 'Login berhasil', 'Tersedia'),
(1053, 'tu', 'Tata Usaha', '2022-03-15 12:01:37', 'Login', 'Login berhasil', 'Tersedia'),
(1054, '183510393', 'Mahasiswa', '2022-03-15 14:02:17', 'Login', 'Login berhasil', 'Tersedia'),
(1055, 'tu', 'Tata Usaha', '2022-03-15 14:02:47', 'Login', 'Login berhasil', 'Tersedia'),
(1056, '51029027601', 'Dosen', '2022-03-15 22:21:41', 'Login', 'Login berhasil', 'Tersedia'),
(1057, '183510393', 'Mahasiswa', '2022-03-15 22:23:28', 'Login', 'Login berhasil', 'Tersedia'),
(1058, 'tu', 'Tata Usaha', '2022-03-15 22:26:50', 'Login', 'Login berhasil', 'Tersedia'),
(1059, 'superadmin35', 'Prodi', '2022-03-15 22:27:43', 'Login', 'Login berhasil', 'Tersedia'),
(1060, 'dekan', 'Fakultas', '2022-03-15 22:30:51', 'Login', 'Login berhasil', 'Tersedia'),
(1061, '51023048901', 'Dosen', '2022-03-15 22:51:37', 'Login', 'Login berhasil', 'Tersedia'),
(1062, '50314068701', 'Dosen', '2022-03-15 22:52:09', 'Login', 'Login berhasil', 'Tersedia'),
(1063, 'tu', 'Tata Usaha', '2022-03-16 13:40:01', 'Login', 'Login berhasil', 'Tersedia'),
(1064, 'superadmin35', 'Prodi', '2022-03-16 13:40:23', 'Login', 'Login berhasil', 'Tersedia'),
(1065, '183510393', 'Mahasiswa', '2022-03-16 13:42:52', 'Login', 'Login berhasil', 'Tersedia'),
(1066, '51029027601', 'Dosen', '2022-03-16 13:50:06', 'Login', 'Login berhasil', 'Tersedia'),
(1067, '50314068701', 'Dosen', '2022-03-16 14:09:45', 'Login', 'Login berhasil', 'Tersedia'),
(1068, '51003087703', 'Dosen', '2022-03-16 14:15:57', 'Login', 'Login berhasil', 'Tersedia'),
(1069, '51029027601', 'Dosen', '2022-03-16 14:29:28', 'Login', 'Login berhasil', 'Tersedia'),
(1070, '183510393', 'Mahasiswa', '2022-03-16 15:01:35', 'Login', 'Login berhasil', 'Tersedia'),
(1071, 'tu', 'Tata Usaha', '2022-03-16 15:21:53', 'Login', 'Login berhasil', 'Tersedia'),
(1072, '183510400', 'Mahasiswa', '2022-03-16 20:18:50', 'Login', 'Login berhasil', 'Tersedia'),
(1073, 'tu', 'Tata Usaha', '2022-03-16 20:18:55', 'Login', 'Login berhasil', 'Tersedia'),
(1074, 'dekan', 'Fakultas', '2022-03-16 20:19:11', 'Login', 'Login berhasil', 'Tersedia'),
(1075, 'superadmin35', 'Prodi', '2022-03-16 20:19:19', 'Login', 'Login berhasil', 'Tersedia'),
(1076, '51029027601', 'Dosen', '2022-03-16 20:25:31', 'Login', 'Login berhasil', 'Tersedia'),
(1077, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-16 20:29:13', 'Login', 'Login berhasil', 'Tersedia'),
(1078, 'dekan', 'Fakultas', '2022-03-16 22:18:23', 'Login', 'Login berhasil', 'Tersedia'),
(1079, '183510400', 'Mahasiswa', '2022-03-16 22:52:09', 'Login', 'Login berhasil', 'Tersedia'),
(1080, 'tu', 'Tata Usaha', '2022-03-16 23:03:32', 'Login', 'Login berhasil', 'Tersedia'),
(1081, '51003087703', 'Dosen', '2022-03-16 23:15:51', 'Login', 'Login berhasil', 'Tersedia'),
(1082, '51015047503', 'Dosen', '2022-03-16 23:19:29', 'Login', 'Login berhasil', 'Tersedia'),
(1083, 'tu', 'Tata Usaha', '2022-03-17 09:09:10', 'Login', 'Login berhasil', 'Tersedia'),
(1084, '183510400', 'Mahasiswa', '2022-03-17 09:09:26', 'Login', 'Login berhasil', 'Tersedia'),
(1085, '51003087703', 'Dosen', '2022-03-17 09:27:04', 'Login', 'Login berhasil', 'Tersedia'),
(1086, '51003087703', 'Dosen', '2022-03-17 10:04:17', 'Login', 'Login berhasil', 'Tersedia'),
(1087, 'superadmin35', 'Prodi', '2022-03-17 10:21:41', 'Login', 'Login berhasil', 'Tersedia'),
(1088, 'superadmin35', 'Prodi', '2022-03-17 13:05:34', 'Login', 'Login berhasil', 'Tersedia'),
(1089, '51029027601', 'Dosen', '2022-03-17 13:12:18', 'Login', 'Login berhasil', 'Tersedia'),
(1090, '183510417', 'Mahasiswa', '2022-03-17 13:22:48', 'Login', 'Login berhasil', 'Tersedia');
INSERT INTO `tb_log` (`id_log`, `username`, `status_login`, `waktu_log`, `aktifitas`, `aktifitas_detail`, `status`) VALUES
(1091, 'tu', 'Tata Usaha', '2022-03-17 13:22:57', 'Login', 'Login berhasil', 'Tersedia'),
(1092, 'dekan', 'Fakultas', '2022-03-17 13:23:10', 'Login', 'Login berhasil', 'Tersedia'),
(1093, '51023048901', 'Dosen', '2022-03-17 13:27:06', 'Login', 'Login berhasil', 'Tersedia'),
(1094, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-17 13:30:41', 'Login', 'Login berhasil', 'Tersedia'),
(1095, '183510228', 'Mahasiswa', '2022-03-17 13:36:13', 'Login', 'Login berhasil', 'Tersedia'),
(1096, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-17 13:41:32', 'Login', 'Login berhasil', 'Tersedia'),
(1097, '183510228', 'Mahasiswa', '2022-03-17 20:07:43', 'Login', 'Login berhasil', 'Tersedia'),
(1098, 'tu', 'Tata Usaha', '2022-03-17 20:20:05', 'Login', 'Login berhasil', 'Tersedia'),
(1099, 'superadmin35', 'Prodi', '2022-03-17 20:21:23', 'Login', 'Login berhasil', 'Tersedia'),
(1100, 'dekan', 'Fakultas', '2022-03-17 20:22:11', 'Login', 'Login berhasil', 'Tersedia'),
(1101, '50314068701', 'Dosen', '2022-03-17 21:27:57', 'Login', 'Login berhasil', 'Tersedia'),
(1102, 'superadmin35', 'Prodi', '2022-03-19 10:14:40', 'Login', 'Login berhasil', 'Tersedia'),
(1103, 'tu', 'Tata Usaha', '2022-03-19 10:14:49', 'Login', 'Login berhasil', 'Tersedia'),
(1104, '51015047503', 'Dosen', '2022-03-19 10:20:55', 'Login', 'Login berhasil', 'Tersedia'),
(1105, '50314068701', 'Dosen', '2022-03-19 10:24:00', 'Login', 'Login berhasil', 'Tersedia'),
(1106, '51003087703', 'Dosen', '2022-03-19 10:25:06', 'Login', 'Login berhasil', 'Tersedia'),
(1107, '51029027601', 'Dosen', '2022-03-19 10:28:37', 'Login', 'Login berhasil', 'Tersedia'),
(1108, '183510393', 'Mahasiswa', '2022-03-19 11:09:24', 'Login', 'Login berhasil', 'Tersedia'),
(1109, '183510400', 'Mahasiswa', '2022-03-19 11:10:16', 'Login', 'Login berhasil', 'Tersedia'),
(1110, 'tu', 'Tata Usaha', '2022-03-19 12:20:17', 'Login', 'Login berhasil', 'Tersedia'),
(1111, '183510417', 'Mahasiswa', '2022-03-19 21:06:37', 'Login', 'Login berhasil', 'Tersedia'),
(1112, 'superadmin35', 'Prodi', '2022-03-19 21:07:19', 'Login', 'Login berhasil', 'Tersedia'),
(1113, '50314068701', 'Dosen', '2022-03-19 21:11:55', 'Login', 'Login berhasil', 'Tersedia'),
(1114, 'dekan', 'Fakultas', '2022-03-19 21:12:29', 'Login', 'Login berhasil', 'Tersedia'),
(1115, '51003087703', 'Dosen', '2022-03-19 21:13:28', 'Login', 'Login berhasil', 'Tersedia'),
(1116, '51029027601', 'Dosen', '2022-03-19 21:32:23', 'Login', 'Login berhasil', 'Tersedia'),
(1117, '51029027601', 'Dosen', '2022-03-19 22:50:46', 'Login', 'Login berhasil', 'Tersedia'),
(1118, '50314068701', 'Dosen', '2022-03-20 19:35:58', 'Login', 'Login berhasil', 'Tersedia'),
(1119, 'dekan', 'Fakultas', '2022-03-20 19:37:01', 'Login', 'Login berhasil', 'Tersedia'),
(1120, '51003087703', 'Dosen', '2022-03-20 19:38:32', 'Login', 'Login berhasil', 'Tersedia'),
(1121, '51015047503', 'Dosen', '2022-03-20 20:07:20', 'Login', 'Login berhasil', 'Tersedia'),
(1122, '51029027601', 'Dosen', '2022-03-20 20:14:05', 'Login', 'Login berhasil', 'Tersedia'),
(1123, '51003087703', 'Dosen', '2022-03-20 22:26:30', 'Login', 'Login berhasil', 'Tersedia'),
(1124, 'tu', 'Tata Usaha', '2022-03-21 08:59:52', 'Login', 'Login berhasil', 'Tersedia'),
(1125, '183510417', 'Mahasiswa', '2022-03-21 09:09:20', 'Login', 'Login berhasil', 'Tersedia'),
(1126, 'superadmin35', 'Prodi', '2022-03-21 09:22:47', 'Login', 'Login berhasil', 'Tersedia'),
(1127, '51029027601', 'Dosen', '2022-03-21 09:36:42', 'Login', 'Login berhasil', 'Tersedia'),
(1128, '50314068701', 'Dosen', '2022-03-21 10:22:20', 'Login', 'Login berhasil', 'Tersedia'),
(1129, 'dekan', 'Fakultas', '2022-03-21 10:24:11', 'Login', 'Login berhasil', 'Tersedia'),
(1130, '193510230', 'Mahasiswa', '2022-03-21 12:25:32', 'Login', 'Login berhasil', 'Tersedia'),
(1131, '183510393', 'Mahasiswa', '2022-03-21 13:00:00', 'Login', 'Login berhasil', 'Tersedia'),
(1132, '51023048901', 'Dosen', '2022-03-21 13:01:48', 'Login', 'Login berhasil', 'Tersedia'),
(1133, '51014028904', 'Dosen', '2022-03-21 13:02:19', 'Login', 'Login berhasil', 'Tersedia'),
(1134, 'tu', 'Tata Usaha', '2022-03-21 13:08:12', 'Login', 'Login berhasil', 'Tersedia'),
(1135, '183510228', 'Mahasiswa', '2022-03-21 15:53:54', 'Login', 'Login berhasil', 'Tersedia'),
(1136, '51020038101', 'Dosen', '2022-03-21 16:20:55', 'Login', 'Login berhasil', 'Tersedia'),
(1137, '183510228', 'Mahasiswa', '2022-03-21 16:28:21', 'Login', 'Login berhasil', 'Tersedia'),
(1138, '51020038101', 'Dosen', '2022-03-21 16:42:06', 'Login', 'Login berhasil', 'Tersedia'),
(1139, '183510393', 'Mahasiswa', '2022-03-21 17:16:11', 'Login', 'Login berhasil', 'Tersedia'),
(1140, '51020038101', 'Dosen', '2022-03-21 17:32:54', 'Login', 'Login berhasil', 'Tersedia'),
(1141, '51023048901', 'Dosen', '2022-03-21 17:33:35', 'Login', 'Login berhasil', 'Tersedia'),
(1142, '183510393', 'Mahasiswa', '2022-03-22 08:17:31', 'Login', 'Login berhasil', 'Tersedia'),
(1143, 'tu', 'Tata Usaha', '2022-03-22 08:19:47', 'Login', 'Login berhasil', 'Tersedia'),
(1144, '183510400', 'Mahasiswa', '2022-03-22 08:33:08', 'Login', 'Login berhasil', 'Tersedia'),
(1145, 'superadmin35', 'Prodi', '2022-03-22 08:35:49', 'Login', 'Login berhasil', 'Tersedia'),
(1146, '51023048901', 'Dosen', '2022-03-22 08:37:08', 'Login', 'Login berhasil', 'Tersedia'),
(1147, 'dekan', 'Fakultas', '2022-03-22 08:37:27', 'Login', 'Login berhasil', 'Tersedia'),
(1148, '50314068701', 'Dosen', '2022-03-22 08:45:30', 'Login', 'Login berhasil', 'Tersedia'),
(1149, '51002118702', 'Dosen', '2022-03-22 08:46:12', 'Login', 'Login berhasil', 'Tersedia'),
(1150, 'superadmin35', 'Prodi', '2022-03-22 11:37:31', 'Login', 'Login berhasil', 'Tersedia'),
(1151, 'dekan', 'Fakultas', '2022-03-22 11:38:29', 'Login', 'Login berhasil', 'Tersedia'),
(1152, '183510400', 'Mahasiswa', '2022-03-22 11:39:10', 'Login', 'Login berhasil', 'Tersedia'),
(1153, '183510228', 'Mahasiswa', '2022-03-22 11:39:27', 'Login', 'Login berhasil', 'Tersedia'),
(1154, '183510400', 'Mahasiswa', '2022-03-22 11:39:50', 'Login', 'Login berhasil', 'Tersedia'),
(1155, '51023048901', 'Dosen', '2022-03-22 11:41:31', 'Login', 'Login berhasil', 'Tersedia'),
(1156, '183510400', 'Mahasiswa', '2022-03-22 13:57:28', 'Login', 'Login berhasil', 'Tersedia'),
(1157, '50314068701', 'Dosen', '2022-03-22 13:58:30', 'Login', 'Login berhasil', 'Tersedia'),
(1158, 'tu', 'Tata Usaha', '2022-03-22 14:03:01', 'Login', 'Login berhasil', 'Tersedia'),
(1159, 'superadmin35', 'Prodi', '2022-03-22 14:03:17', 'Login', 'Login berhasil', 'Tersedia'),
(1160, '51002118702', 'Dosen', '2022-03-22 14:08:24', 'Login', 'Login berhasil', 'Tersedia'),
(1161, '50314068701', 'Dosen', '2022-03-22 14:15:44', 'Login', 'Login berhasil', 'Tersedia'),
(1162, 'superadmin35', 'Prodi', '2022-03-22 22:52:14', 'Login', 'Login berhasil', 'Tersedia'),
(1163, '50314068701', 'Dosen', '2022-03-22 22:52:56', 'Login', 'Login berhasil', 'Tersedia'),
(1164, '183510400', 'Mahasiswa', '2022-03-22 22:53:08', 'Login', 'Login berhasil', 'Tersedia'),
(1165, '51002118702', 'Dosen', '2022-03-22 23:44:52', 'Login', 'Login berhasil', 'Tersedia'),
(1166, 'dekan', 'Fakultas', '2022-03-22 23:48:33', 'Login', 'Login berhasil', 'Tersedia'),
(1167, '183510400', 'Mahasiswa', '2022-03-23 12:09:50', 'Login', 'Login berhasil', 'Tersedia'),
(1168, 'tu', 'Tata Usaha', '2022-03-23 12:16:34', 'Login', 'Login berhasil', 'Tersedia'),
(1169, 'superadmin35', 'Prodi', '2022-03-23 12:22:25', 'Login', 'Login berhasil', 'Tersedia'),
(1170, 'dekan', 'Fakultas', '2022-03-23 12:23:10', 'Login', 'Login berhasil', 'Tersedia'),
(1171, '51023048901', 'Dosen', '2022-03-23 12:23:59', 'Login', 'Login berhasil', 'Tersedia'),
(1172, 'dekan', 'Fakultas', '2022-03-23 13:44:49', 'Login', 'Login berhasil', 'Tersedia'),
(1173, 'superadmin35', 'Prodi', '2022-03-23 13:45:37', 'Login', 'Login berhasil', 'Tersedia'),
(1174, '183510400', 'Mahasiswa', '2022-03-23 13:46:07', 'Login', 'Login berhasil', 'Tersedia'),
(1175, '50314068701', 'Dosen', '2022-03-23 13:48:19', 'Login', 'Login berhasil', 'Tersedia'),
(1176, '51002118702', 'Dosen', '2022-03-23 13:49:21', 'Login', 'Login berhasil', 'Tersedia'),
(1177, '51020038101', 'Dosen', '2022-03-23 13:54:39', 'Login', 'Login berhasil', 'Tersedia'),
(1178, '50314068701', 'Dosen', '2022-03-23 13:56:29', 'Login', 'Login berhasil', 'Tersedia'),
(1179, '51023048901', 'Dosen', '2022-03-23 16:16:43', 'Login', 'Login berhasil', 'Tersedia'),
(1180, '183510400', 'Mahasiswa', '2022-03-23 21:50:19', 'Login', 'Login berhasil', 'Tersedia'),
(1181, '183510393', 'Mahasiswa', '2022-03-23 21:51:31', 'Login', 'Login berhasil', 'Tersedia'),
(1182, '183510228', 'Mahasiswa', '2022-03-23 21:52:21', 'Login', 'Login berhasil', 'Tersedia'),
(1183, 'tu', 'Tata Usaha', '2022-03-23 21:52:53', 'Login', 'Login berhasil', 'Tersedia'),
(1184, 'superadmin35', 'Prodi', '2022-03-23 21:53:31', 'Login', 'Login berhasil', 'Tersedia'),
(1185, 'dekan', 'Fakultas', '2022-03-23 21:54:00', 'Login', 'Login berhasil', 'Tersedia'),
(1186, '51023048901', 'Dosen', '2022-03-23 21:55:03', 'Login', 'Login berhasil', 'Tersedia'),
(1187, 'nadiarozaan@student.uir.ac.id', 'Pembimbing Lapangan KP', '2022-03-23 21:56:55', 'Login', 'Login berhasil', 'Tersedia'),
(1188, 'nadiarozaan@student.uir.ac.id', 'Pembimbing Lapangan KP', '2022-03-23 23:06:24', 'Login', 'Login berhasil', 'Tersedia'),
(1189, '51029027601', 'Dosen', '2022-03-23 23:28:32', 'Login', 'Login berhasil', 'Tersedia'),
(1190, '50314068701', 'Dosen', '2022-03-23 23:29:07', 'Login', 'Login berhasil', 'Tersedia'),
(1191, '183510393', 'Mahasiswa', '2022-03-24 09:15:34', 'Login', 'Login berhasil', 'Tersedia'),
(1192, '183510393', 'Mahasiswa', '2022-03-24 15:10:42', 'Login', 'Login berhasil', 'Tersedia'),
(1193, '173110593', 'Mahasiswa', '2022-03-24 16:03:14', 'Login', 'Login berhasil', 'Tersedia'),
(1194, 'tu', 'Tata Usaha', '2022-03-24 16:03:51', 'Login', 'Login berhasil', 'Tersedia'),
(1195, '183510228', 'Mahasiswa', '2022-03-24 16:11:45', 'Login', 'Login berhasil', 'Tersedia'),
(1196, 'superadmin35', 'Prodi', '2022-03-24 16:12:35', 'Login', 'Login berhasil', 'Tersedia'),
(1197, 'dekan', 'Fakultas', '2022-03-24 16:12:55', 'Login', 'Login berhasil', 'Tersedia'),
(1198, '183510228', 'Mahasiswa', '2022-03-24 16:13:33', 'Login', 'Login berhasil', 'Tersedia'),
(1199, '183510393', 'Mahasiswa', '2022-03-24 16:14:07', 'Login', 'Login berhasil', 'Tersedia'),
(1200, '51023048901', 'Dosen', '2022-03-24 16:17:05', 'Login', 'Login berhasil', 'Tersedia'),
(1201, 'nadiarozaan@student.uir.ac.id', 'Pembimbing Lapangan KP', '2022-03-24 16:19:58', 'Login', 'Login berhasil', 'Tersedia'),
(1202, '183510393', 'Mahasiswa', '2022-03-24 21:17:58', 'Login', 'Login berhasil', 'Tersedia'),
(1203, 'superadmin35', 'Prodi', '2022-03-24 21:20:23', 'Login', 'Login berhasil', 'Tersedia'),
(1204, 'tu', 'Tata Usaha', '2022-03-24 21:20:28', 'Login', 'Login berhasil', 'Tersedia'),
(1205, 'dekan', 'Fakultas', '2022-03-24 21:26:30', 'Login', 'Login berhasil', 'Tersedia'),
(1206, '173110270', 'Mahasiswa', '2022-03-24 21:28:52', 'Login', 'Login berhasil', 'Tersedia'),
(1207, 'superadmin31', 'Prodi', '2022-03-24 21:32:08', 'Login', 'Login berhasil', 'Tersedia'),
(1208, '183210732', 'Mahasiswa', '2022-03-24 21:39:34', 'Login', 'Login berhasil', 'Tersedia'),
(1209, 'superadmin32', 'Prodi', '2022-03-24 21:40:25', 'Login', 'Login berhasil', 'Tersedia'),
(1210, '21005047603', 'Dosen', '2022-03-24 21:51:26', 'Login', 'Login berhasil', 'Tersedia'),
(1211, 'tes@gmail.com', 'Pembimbing Lapangan KP', '2022-03-24 22:03:15', 'Login', 'Login berhasil', 'Tersedia'),
(1212, '21008057102', 'Dosen', '2022-03-24 22:14:21', 'Login', 'Login berhasil', 'Tersedia'),
(1213, '173110270', 'Mahasiswa', '2022-03-24 22:41:59', 'Login', 'Login berhasil', 'Tersedia'),
(1214, 'superadmin31', 'Prodi', '2022-03-24 22:42:14', 'Login', 'Login berhasil', 'Tersedia'),
(1215, '10008076401', 'Dosen', '2022-03-24 22:45:18', 'Login', 'Login berhasil', 'Tersedia'),
(1216, 'tes@gmail.com', 'Pembimbing Lapangan KP', '2022-03-24 22:46:48', 'Login', 'Login berhasil', 'Tersedia'),
(1217, 'tes@gmail.com', 'Pembimbing Lapangan KP', '2022-03-24 22:47:47', 'Login', 'Login berhasil', 'Tersedia'),
(1218, 'tu', 'Tata Usaha', '2022-03-25 10:10:26', 'Login', 'Login berhasil', 'Tersedia'),
(1219, 'superadmin31', 'Prodi', '2022-03-25 10:10:34', 'Login', 'Login berhasil', 'Tersedia'),
(1220, 'dekan', 'Fakultas', '2022-03-25 10:10:45', 'Login', 'Login berhasil', 'Tersedia'),
(1221, '183510393', 'Mahasiswa', '2022-03-25 10:11:37', 'Login', 'Login berhasil', 'Tersedia'),
(1222, '173110270', 'Mahasiswa', '2022-03-25 10:18:48', 'Login', 'Login berhasil', 'Tersedia'),
(1223, 'superadmin35', 'Prodi', '2022-03-25 10:28:50', 'Login', 'Login berhasil', 'Tersedia'),
(1224, 'tu', 'Tata Usaha', '2022-03-25 16:53:32', 'Login', 'Login berhasil', 'Tersedia'),
(1225, 'superadmin35', 'Prodi', '2022-03-25 16:56:45', 'Login', 'Login berhasil', 'Tersedia'),
(1226, '173110270', 'Mahasiswa', '2022-03-25 16:58:26', 'Login', 'Login berhasil', 'Tersedia'),
(1227, 'superadmin31', 'Prodi', '2022-03-25 16:59:57', 'Login', 'Login berhasil', 'Tersedia'),
(1228, 'dekan', 'Fakultas', '2022-03-25 17:02:05', 'Login', 'Login berhasil', 'Tersedia'),
(1229, '10008076401', 'Dosen', '2022-03-25 17:04:38', 'Login', 'Login berhasil', 'Tersedia'),
(1230, 'tu', 'Tata Usaha', '2022-03-25 17:17:59', 'Login', 'Login berhasil', 'Tersedia'),
(1231, '11013066803', 'Dosen', '2022-03-25 17:20:23', 'Login', 'Login berhasil', 'Tersedia'),
(1232, '11005057003', 'Dosen', '2022-03-25 17:21:44', 'Login', 'Login berhasil', 'Tersedia'),
(1233, '11002056201', 'Dosen', '2022-03-25 17:23:27', 'Login', 'Login berhasil', 'Tersedia'),
(1234, '21005047603', 'Dosen', '2022-03-25 17:35:13', 'Login', 'Login berhasil', 'Tersedia'),
(1235, '11013066803', 'Dosen', '2022-03-25 17:40:49', 'Login', 'Login berhasil', 'Tersedia'),
(1236, '11013066803', 'Dosen', '2022-03-25 17:42:51', 'Login', 'Login berhasil', 'Tersedia'),
(1237, '11005057003', 'Dosen', '2022-03-25 17:44:09', 'Login', 'Login berhasil', 'Tersedia'),
(1238, 'dekan', 'Fakultas', '2022-03-25 17:45:14', 'Login', 'Login berhasil', 'Tersedia'),
(1239, 'dekan', 'Fakultas', '2022-03-25 18:05:58', 'Login', 'Login berhasil', 'Tersedia'),
(1240, 'tu', 'Tata Usaha', '2022-03-25 18:13:37', 'Login', 'Login berhasil', 'Tersedia'),
(1241, '173110270', 'Mahasiswa', '2022-03-25 21:58:27', 'Login', 'Login berhasil', 'Tersedia'),
(1242, 'tu', 'Tata Usaha', '2022-03-25 22:22:58', 'Login', 'Login berhasil', 'Tersedia'),
(1243, 'superadmin31', 'Prodi', '2022-03-25 22:26:08', 'Login', 'Login berhasil', 'Tersedia'),
(1244, 'dekan', 'Fakultas', '2022-03-25 22:34:18', 'Login', 'Login berhasil', 'Tersedia'),
(1245, '183210732', 'Mahasiswa', '2022-03-25 23:21:35', 'Login', 'Login berhasil', 'Tersedia'),
(1246, '10008076401', 'Dosen', '2022-03-25 23:24:26', 'Login', 'Login berhasil', 'Tersedia'),
(1247, '21005047603', 'Dosen', '2022-03-25 23:26:57', 'Login', 'Login berhasil', 'Tersedia'),
(1248, 'superadmin32', 'Prodi', '2022-03-25 23:29:15', 'Login', 'Login berhasil', 'Tersedia'),
(1249, '21013056902', 'Dosen', '2022-03-25 23:56:53', 'Login', 'Login berhasil', 'Tersedia'),
(1250, '21014028904', 'Dosen', '2022-03-26 00:10:37', 'Login', 'Login berhasil', 'Tersedia'),
(1251, '183510393', 'Mahasiswa', '2022-03-26 15:01:13', 'Login', 'Login berhasil', 'Tersedia'),
(1252, 'tu', 'Tata Usaha', '2022-03-26 15:01:21', 'Login', 'Login berhasil', 'Tersedia'),
(1253, 'superadmin35', 'Prodi', '2022-03-26 15:01:36', 'Login', 'Login berhasil', 'Tersedia'),
(1254, 'dekan', 'Fakultas', '2022-03-26 15:01:52', 'Login', 'Login berhasil', 'Tersedia'),
(1255, '183510393', 'Mahasiswa', '2022-03-26 15:55:50', 'Login', 'Login berhasil', 'Tersedia'),
(1256, '173110270', 'Mahasiswa', '2022-03-26 16:27:44', 'Login', 'Login berhasil', 'Tersedia'),
(1257, 'tu', 'Tata Usaha', '2022-03-27 16:26:23', 'Login', 'Login berhasil', 'Tersedia'),
(1258, 'tu', 'Tata Usaha', '2022-03-27 21:25:20', 'Login', 'Login berhasil', 'Tersedia'),
(1259, '183510393', 'Mahasiswa', '2022-03-27 21:26:10', 'Login', 'Login berhasil', 'Tersedia'),
(1260, '183210732', 'Mahasiswa', '2022-03-27 22:02:57', 'Login', 'Login berhasil', 'Tersedia'),
(1261, 'superadmin35', 'Prodi', '2022-03-27 22:03:31', 'Login', 'Login berhasil', 'Tersedia'),
(1262, 'superadmin32', 'Prodi', '2022-03-27 22:05:41', 'Login', 'Login berhasil', 'Tersedia'),
(1263, '21016047901', 'Dosen', '2022-03-27 22:08:53', 'Login', 'Login berhasil', 'Tersedia'),
(1264, '20213121979', 'Dosen', '2022-03-27 22:22:53', 'Login', 'Login berhasil', 'Tersedia'),
(1265, '21016047901', 'Dosen', '2022-03-27 22:27:45', 'Login', 'Login berhasil', 'Tersedia'),
(1266, 'tu', 'Tata Usaha', '2022-03-27 22:45:36', 'Login', 'Login berhasil', 'Tersedia'),
(1267, '183510393', 'Mahasiswa', '2022-03-28 10:35:00', 'Login', 'Login berhasil', 'Tersedia'),
(1268, 'tu', 'Tata Usaha', '2022-03-28 10:35:38', 'Login', 'Login berhasil', 'Tersedia'),
(1269, 'superadmin35', 'Prodi', '2022-03-28 10:38:19', 'Login', 'Login berhasil', 'Tersedia'),
(1270, 'dekan', 'Fakultas', '2022-03-28 10:39:12', 'Login', 'Login berhasil', 'Tersedia'),
(1271, '51023048901', 'Dosen', '2022-03-28 10:39:43', 'Login', 'Login berhasil', 'Tersedia'),
(1272, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-03-28 10:43:16', 'Login', 'Login berhasil', 'Tersedia'),
(1273, '51023048901', 'Dosen', '2022-03-28 11:01:49', 'Login', 'Login berhasil', 'Tersedia'),
(1274, '20213121979', 'Dosen', '2022-03-28 11:02:35', 'Login', 'Login berhasil', 'Tersedia'),
(1275, '51029027601', 'Dosen', '2022-03-28 11:03:05', 'Login', 'Login berhasil', 'Tersedia'),
(1276, '51023048901', 'Dosen', '2022-03-28 11:08:20', 'Login', 'Login berhasil', 'Tersedia'),
(1277, '51029027601', 'Dosen', '2022-03-28 11:20:22', 'Login', 'Login berhasil', 'Tersedia'),
(1278, '50314068701', 'Dosen', '2022-03-28 11:21:20', 'Login', 'Login berhasil', 'Tersedia'),
(1279, 'superadmin35', 'Prodi', '2022-03-28 22:56:42', 'Login', 'Login berhasil', 'Tersedia'),
(1280, '51023048901', 'Dosen', '2022-03-28 23:01:38', 'Login', 'Login berhasil', 'Tersedia'),
(1281, '51014028904', 'Dosen', '2022-03-28 23:03:12', 'Login', 'Login berhasil', 'Tersedia'),
(1282, 'dekan', 'Fakultas', '2022-03-28 23:03:39', 'Login', 'Login berhasil', 'Tersedia'),
(1283, '51017018001', 'Dosen', '2022-03-28 23:08:05', 'Login', 'Login berhasil', 'Tersedia'),
(1284, '183510393', 'Mahasiswa', '2022-03-28 23:11:29', 'Login', 'Login berhasil', 'Tersedia'),
(1285, '183510393', 'Mahasiswa', '2022-03-29 10:18:04', 'Login', 'Login berhasil', 'Tersedia'),
(1286, 'tu', 'Tata Usaha', '2022-03-29 10:18:58', 'Login', 'Login berhasil', 'Tersedia'),
(1287, 'superadmin35', 'Prodi', '2022-03-29 10:19:01', 'Login', 'Login berhasil', 'Tersedia'),
(1288, 'dekan', 'Fakultas', '2022-03-29 10:19:09', 'Login', 'Login berhasil', 'Tersedia'),
(1289, '51029027601', 'Dosen', '2022-03-29 11:13:39', 'Login', 'Login berhasil', 'Tersedia'),
(1290, '50314068701', 'Dosen', '2022-03-29 11:40:15', 'Login', 'Login berhasil', 'Tersedia'),
(1291, '51014028904', 'Dosen', '2022-03-29 11:51:11', 'Login', 'Login berhasil', 'Tersedia'),
(1292, 'tu', 'Tata Usaha', '2022-03-29 12:09:41', 'Login', 'Login berhasil', 'Tersedia'),
(1293, 'dekan', 'Fakultas', '2022-03-29 12:14:34', 'Login', 'Login berhasil', 'Tersedia'),
(1294, 'tu', 'Tata Usaha', '2022-03-29 12:26:15', 'Login', 'Login berhasil', 'Tersedia'),
(1295, '183510393', 'Mahasiswa', '2022-03-29 21:57:05', 'Login', 'Login berhasil', 'Tersedia'),
(1296, 'tu', 'Tata Usaha', '2022-03-29 21:57:55', 'Login', 'Login berhasil', 'Tersedia'),
(1297, 'superadmin35', 'Prodi', '2022-03-29 21:58:59', 'Login', 'Login berhasil', 'Tersedia'),
(1298, 'dekan', 'Fakultas', '2022-03-29 21:59:14', 'Login', 'Login berhasil', 'Tersedia'),
(1299, '10008076401', 'Dosen', '2022-03-30 00:01:09', 'Login', 'Login berhasil', 'Tersedia'),
(1300, 'tu', 'Tata Usaha', '2022-03-30 10:24:57', 'Login', 'Login berhasil', 'Tersedia'),
(1301, 'superadmin35', 'Prodi', '2022-03-30 10:40:29', 'Login', 'Login berhasil', 'Tersedia'),
(1302, '183510393', 'Mahasiswa', '2022-03-31 21:00:27', 'Login', 'Login berhasil', 'Tersedia'),
(1303, 'tu', 'Tata Usaha', '2022-03-31 21:29:33', 'Login', 'Login berhasil', 'Tersedia'),
(1304, 'superadmin35', 'Prodi', '2022-03-31 22:06:35', 'Login', 'Login berhasil', 'Tersedia'),
(1305, 'dekan', 'Fakultas', '2022-03-31 22:17:31', 'Login', 'Login berhasil', 'Tersedia'),
(1306, '51023048901', 'Dosen', '2022-03-31 23:51:48', 'Login', 'Login berhasil', 'Tersedia'),
(1307, '51023048901', 'Dosen', '2022-04-01 10:25:31', 'Login', 'Login berhasil', 'Tersedia'),
(1308, '183510393', 'Mahasiswa', '2022-04-01 10:30:19', 'Login', 'Login berhasil', 'Tersedia'),
(1309, 'tes@gmail.com', 'Pembimbing Lapangan KP', '2022-04-01 11:21:35', 'Login', 'Login berhasil', 'Tersedia'),
(1310, 'superadmin35', 'Prodi', '2022-04-01 11:25:27', 'Login', 'Login berhasil', 'Tersedia'),
(1311, 'superadmin35', 'Prodi', '2022-04-01 12:38:40', 'Login', 'Login berhasil', 'Tersedia'),
(1312, 'upm', 'UPM', '2022-04-01 12:39:24', 'Login', 'Login berhasil', 'Tersedia'),
(1313, '183510393', 'Mahasiswa', '2022-04-01 12:53:18', 'Login', 'Login berhasil', 'Tersedia'),
(1314, 'tu', 'Tata Usaha', '2022-04-01 13:25:40', 'Login', 'Login berhasil', 'Tersedia'),
(1315, 'superadmin35', 'Prodi', '2022-04-02 11:16:45', 'Login', 'Login berhasil', 'Tersedia'),
(1316, '51023048901', 'Dosen', '2022-04-02 11:41:54', 'Login', 'Login berhasil', 'Tersedia'),
(1317, 'dekan', 'Fakultas', '2022-04-02 11:52:28', 'Login', 'Login berhasil', 'Tersedia'),
(1318, '183510393', 'Mahasiswa', '2022-04-02 22:17:05', 'Login', 'Login berhasil', 'Tersedia'),
(1319, '51023048901', 'Dosen', '2022-04-02 23:10:44', 'Login', 'Login berhasil', 'Tersedia'),
(1320, 'superadmin35', 'Prodi', '2022-04-02 23:16:37', 'Login', 'Login berhasil', 'Tersedia'),
(1321, 'tu', 'Tata Usaha', '2022-04-03 00:43:04', 'Login', 'Login berhasil', 'Tersedia'),
(1322, 'superadmin35', 'Prodi', '2022-04-03 00:51:03', 'Login', 'Login berhasil', 'Tersedia'),
(1323, '183510393', 'Mahasiswa', '2022-04-03 22:20:35', 'Login', 'Login berhasil', 'Tersedia'),
(1324, 'superadmin35', 'Prodi', '2022-04-03 22:20:59', 'Login', 'Login berhasil', 'Tersedia'),
(1325, '51029027601', 'Dosen', '2022-04-03 22:46:19', 'Login', 'Login berhasil', 'Tersedia'),
(1326, '50314068701', 'Dosen', '2022-04-03 22:55:39', 'Login', 'Login berhasil', 'Tersedia'),
(1327, 'dekan', 'Fakultas', '2022-04-03 22:56:07', 'Login', 'Login berhasil', 'Tersedia'),
(1328, '51023048901', 'Dosen', '2022-04-03 23:35:28', 'Login', 'Login berhasil', 'Tersedia'),
(1329, '183510393', 'Mahasiswa', '2022-04-04 11:24:29', 'Login', 'Login berhasil', 'Tersedia'),
(1330, '51023048901', 'Dosen', '2022-04-04 11:59:43', 'Login', 'Login berhasil', 'Tersedia'),
(1331, 'tu', 'Tata Usaha', '2022-04-04 12:16:15', 'Login', 'Login berhasil', 'Tersedia'),
(1332, 'superadmin35', 'Prodi', '2022-04-04 22:49:43', 'Login', 'Login berhasil', 'Tersedia'),
(1333, 'tu', 'Tata Usaha', '2022-04-04 23:21:15', 'Login', 'Login berhasil', 'Tersedia'),
(1334, '183510400', 'Mahasiswa', '2022-04-05 10:24:00', 'Login', 'Login berhasil', 'Tersedia'),
(1335, 'tu', 'Tata Usaha', '2022-04-05 10:24:07', 'Login', 'Login berhasil', 'Tersedia'),
(1336, 'superadmin35', 'Prodi', '2022-04-05 10:24:16', 'Login', 'Login berhasil', 'Tersedia'),
(1337, 'dekan', 'Fakultas', '2022-04-05 10:24:22', 'Login', 'Login berhasil', 'Tersedia'),
(1338, '173110270', 'Mahasiswa', '2022-04-05 10:25:19', 'Login', 'Login berhasil', 'Tersedia'),
(1339, 'superadmin31', 'Prodi', '2022-04-05 10:25:55', 'Login', 'Login berhasil', 'Tersedia'),
(1340, 'tu', 'Tata Usaha', '2022-04-05 12:22:32', 'Login', 'Login berhasil', 'Tersedia'),
(1341, '173110270', 'Mahasiswa', '2022-04-05 12:33:18', 'Login', 'Login berhasil', 'Tersedia'),
(1342, 'tu', 'Tata Usaha', '2022-04-05 14:21:42', 'Login', 'Login berhasil', 'Tersedia'),
(1343, 'superadmin31', 'Prodi', '2022-04-05 14:27:04', 'Login', 'Login berhasil', 'Tersedia'),
(1344, 'dekan', 'Fakultas', '2022-04-05 14:27:37', 'Login', 'Login berhasil', 'Tersedia'),
(1345, '183510393', 'Mahasiswa', '2022-04-05 22:20:03', 'Login', 'Login berhasil', 'Tersedia'),
(1346, 'superadmin35', 'Prodi', '2022-04-05 22:20:28', 'Login', 'Login berhasil', 'Tersedia'),
(1347, '51023048901', 'Dosen', '2022-04-05 22:23:06', 'Login', 'Login berhasil', 'Tersedia'),
(1348, '51029027601', 'Dosen', '2022-04-05 23:41:42', 'Login', 'Login berhasil', 'Tersedia'),
(1349, 'tu', 'Tata Usaha', '2022-04-06 07:37:54', 'Login', 'Login berhasil', 'Tersedia'),
(1350, '51023048901', 'Dosen', '2022-04-06 07:40:32', 'Login', 'Login berhasil', 'Tersedia'),
(1351, 'superadmin35', 'Prodi', '2022-04-06 07:41:37', 'Login', 'Login berhasil', 'Tersedia'),
(1352, 'wd1', 'Fakultas', '2022-04-06 07:42:06', 'Login', 'Login berhasil', 'Tersedia'),
(1353, '51023048901', 'Dosen', '2022-04-06 09:22:15', 'Login', 'Login berhasil', 'Tersedia'),
(1354, 'tu', 'Tata Usaha', '2022-04-06 09:22:21', 'Login', 'Login berhasil', 'Tersedia'),
(1355, 'superadmin35', 'Prodi', '2022-04-06 09:31:49', 'Login', 'Login berhasil', 'Tersedia'),
(1356, '51023048901', 'Dosen', '2022-04-06 14:12:23', 'Login', 'Login berhasil', 'Tersedia'),
(1357, '183510393', 'Mahasiswa', '2022-04-06 14:13:35', 'Login', 'Login berhasil', 'Tersedia'),
(1358, 'tu', 'Tata Usaha', '2022-04-06 14:13:42', 'Login', 'Login berhasil', 'Tersedia'),
(1359, 'superadmin35', 'Prodi', '2022-04-06 14:26:57', 'Login', 'Login berhasil', 'Tersedia'),
(1360, '51029027601', 'Dosen', '2022-04-06 14:46:10', 'Login', 'Login berhasil', 'Tersedia'),
(1361, '50314068701', 'Dosen', '2022-04-06 15:09:07', 'Login', 'Login berhasil', 'Tersedia'),
(1362, '50314068701', 'Dosen', '2022-04-06 20:15:22', 'Login', 'Login berhasil', 'Tersedia'),
(1363, '51023048901', 'Dosen', '2022-04-06 20:15:51', 'Login', 'Login berhasil', 'Tersedia'),
(1364, '50314068701', 'Dosen', '2022-04-06 20:17:27', 'Login', 'Login berhasil', 'Tersedia'),
(1365, '51029027601', 'Dosen', '2022-04-06 20:18:13', 'Login', 'Login berhasil', 'Tersedia'),
(1366, 'superadmin35', 'Prodi', '2022-04-06 20:23:27', 'Login', 'Login berhasil', 'Tersedia'),
(1367, 'superadmin35', 'Prodi', '2022-04-07 11:58:41', 'Login', 'Login berhasil', 'Tersedia'),
(1368, '183510393', 'Mahasiswa', '2022-04-07 12:18:39', 'Login', 'Login berhasil', 'Tersedia'),
(1369, '51029027601', 'Dosen', '2022-04-07 12:20:03', 'Login', 'Login berhasil', 'Tersedia'),
(1370, '51023048901', 'Dosen', '2022-04-07 12:20:09', 'Login', 'Login berhasil', 'Tersedia'),
(1371, '50314068701', 'Dosen', '2022-04-07 12:20:52', 'Login', 'Login berhasil', 'Tersedia'),
(1372, 'dekan', 'Fakultas', '2022-04-10 12:20:04', 'Login', 'Login berhasil', 'Tersedia'),
(1373, 'superadmin35', 'Prodi', '2022-04-10 12:21:23', 'Login', 'Login berhasil', 'Tersedia'),
(1374, '183510393', 'Mahasiswa', '2022-04-10 13:12:48', 'Login', 'Login berhasil', 'Tersedia'),
(1375, '183510417', 'Mahasiswa', '2022-04-10 20:09:29', 'Login', 'Login berhasil', 'Tersedia'),
(1376, 'tu', 'Tata Usaha', '2022-04-10 20:10:10', 'Login', 'Login berhasil', 'Tersedia'),
(1377, 'superadmin35', 'Prodi', '2022-04-10 20:10:28', 'Login', 'Login berhasil', 'Tersedia'),
(1378, 'dekan', 'Fakultas', '2022-04-10 20:10:44', 'Login', 'Login berhasil', 'Tersedia'),
(1379, '50009088102', 'Dosen', '2022-04-10 20:14:13', 'Login', 'Login berhasil', 'Tersedia'),
(1380, 'a@gmail.com', 'Pembimbing Lapangan KP', '2022-04-10 20:16:35', 'Login', 'Login berhasil', 'Tersedia'),
(1381, 'koordinator35', 'Koordinator Prodi', '2022-04-10 20:31:54', 'Login', 'Login berhasil', 'Tersedia'),
(1382, 'koordinator35', 'Koordinator Prodi', '2022-04-10 20:33:08', 'Login', 'Login berhasil', 'Tersedia'),
(1383, '51029027601', 'Dosen', '2022-04-10 20:37:40', 'Login', 'Login berhasil', 'Tersedia'),
(1384, '51023048901', 'Dosen', '2022-04-10 20:44:37', 'Login', 'Login berhasil', 'Tersedia'),
(1385, '50009088102', 'Dosen', '2022-04-10 20:45:58', 'Login', 'Login berhasil', 'Tersedia'),
(1386, 'tu', 'Tata Usaha', '2022-04-11 23:27:18', 'Login', 'Login berhasil', 'Tersedia'),
(1387, '183510393', 'Mahasiswa', '2022-04-11 23:29:18', 'Login', 'Login berhasil', 'Tersedia'),
(1388, 'upm', 'UPM', '2022-04-11 23:40:46', 'Login', 'Login berhasil', 'Tersedia'),
(1389, 'tu', 'Tata Usaha', '2022-04-12 00:52:03', 'Login', 'Login berhasil', 'Tersedia'),
(1390, 'superadmin35', 'Prodi', '2022-04-12 01:30:44', 'Login', 'Login berhasil', 'Tersedia'),
(1391, 'dekan', 'Fakultas', '2022-04-12 02:19:32', 'Login', 'Login berhasil', 'Tersedia'),
(1392, '51023048901', 'Dosen', '2022-04-12 13:09:08', 'Login', 'Login berhasil', 'Tersedia'),
(1393, 'koordinator35', 'Koordinator Prodi', '2022-04-12 14:25:01', 'Login', 'Login berhasil', 'Tersedia'),
(1394, '183510417', 'Mahasiswa', '2022-04-12 15:47:28', 'Login', 'Login berhasil', 'Tersedia'),
(1395, 'tu', 'Tata Usaha', '2022-04-12 15:48:03', 'Login', 'Login berhasil', 'Tersedia'),
(1396, 'superadmin35', 'Prodi', '2022-04-12 15:48:22', 'Login', 'Login berhasil', 'Tersedia'),
(1397, 'dekan', 'Fakultas', '2022-04-12 15:48:38', 'Login', 'Login berhasil', 'Tersedia'),
(1398, 'upm', 'UPM', '2022-04-12 20:43:52', 'Login', 'Login berhasil', 'Tersedia'),
(1399, 'gkm35', 'GKM Prodi', '2022-04-12 20:44:45', 'Login', 'Login berhasil', 'Tersedia'),
(1400, 'superadmin35', 'Prodi', '2022-04-12 21:03:26', 'Login', 'Login berhasil', 'Tersedia'),
(1401, 'gkm35', 'GKM Prodi', '2022-04-12 21:13:24', 'Login', 'Login berhasil', 'Tersedia'),
(1402, 'gkm35', 'GKM Prodi', '2022-04-12 21:14:31', 'Login', 'Login berhasil', 'Tersedia'),
(1403, '183510393', 'Mahasiswa', '2022-04-13 14:12:35', 'Login', 'Login berhasil', 'Tersedia'),
(1404, '173110270', 'Mahasiswa', '2022-04-13 14:13:29', 'Login', 'Login berhasil', 'Tersedia'),
(1405, 'tu', 'Tata Usaha', '2022-04-13 14:14:47', 'Login', 'Login berhasil', 'Tersedia'),
(1406, 'tu', 'Tata Usaha', '2022-04-13 22:32:29', 'Login', 'Login berhasil', 'Tersedia'),
(1407, '173110270', 'Mahasiswa', '2022-04-13 22:33:43', 'Login', 'Login berhasil', 'Tersedia'),
(1408, 'upm', 'UPM', '2022-04-13 22:35:04', 'Login', 'Login berhasil', 'Tersedia'),
(1409, 'gkm35', 'GKM Prodi', '2022-04-13 22:35:30', 'Login', 'Login berhasil', 'Tersedia'),
(1410, 'superadmin35', 'Prodi', '2022-04-13 22:37:58', 'Login', 'Login berhasil', 'Tersedia'),
(1411, 'gkm35', 'GKM Prodi', '2022-04-13 23:00:23', 'Login', 'Login berhasil', 'Tersedia'),
(1412, 'tu', 'Tata Usaha', '2022-04-13 23:42:47', 'Login', 'Login berhasil', 'Tersedia'),
(1413, 'superadmin31', 'Prodi', '2022-04-13 23:56:17', 'Login', 'Login berhasil', 'Tersedia'),
(1414, 'dekan', 'Fakultas', '2022-04-13 23:56:45', 'Login', 'Login berhasil', 'Tersedia'),
(1415, 'upm', 'UPM', '2022-04-13 23:57:09', 'Login', 'Login berhasil', 'Tersedia'),
(1416, '10008076401', 'Dosen', '2022-04-13 23:58:09', 'Login', 'Login berhasil', 'Tersedia'),
(1417, 'abc@gmail.com', 'Pembimbing Lapangan KP', '2022-04-14 00:00:17', 'Login', 'Login berhasil', 'Tersedia'),
(1418, 'koordinator31', 'Koordinator Prodi', '2022-04-14 00:02:28', 'Login', 'Login berhasil', 'Tersedia'),
(1419, '11013066803', 'Dosen', '2022-04-14 00:10:59', 'Login', 'Login berhasil', 'Tersedia'),
(1420, '11005057003', 'Dosen', '2022-04-14 00:12:00', 'Login', 'Login berhasil', 'Tersedia'),
(1421, '11018017303', 'Dosen', '2022-04-14 00:12:33', 'Login', 'Login berhasil', 'Tersedia'),
(1422, 'dekan', 'Fakultas', '2022-04-14 00:15:46', 'Login', 'Login berhasil', 'Tersedia'),
(1423, 'tu', 'Tata Usaha', '2022-04-14 12:57:18', 'Login', 'Login berhasil', 'Tersedia'),
(1424, '173110270', 'Mahasiswa', '2022-04-14 12:58:21', 'Login', 'Login berhasil', 'Tersedia'),
(1425, '183510400', 'Mahasiswa', '2022-04-14 13:18:09', 'Login', 'Login berhasil', 'Tersedia'),
(1426, 'superadmin35', 'Prodi', '2022-04-14 13:19:09', 'Login', 'Login berhasil', 'Tersedia'),
(1427, 'dekan', 'Fakultas', '2022-04-14 13:19:28', 'Login', 'Login berhasil', 'Tersedia'),
(1428, 'dekan', 'Fakultas', '2022-04-14 15:00:20', 'Login', 'Login berhasil', 'Tersedia'),
(1429, '183510720', 'Mahasiswa', '2022-04-14 15:26:43', 'Login', 'Login berhasil', 'Tersedia'),
(1430, 'superadmin35', 'Prodi', '2022-04-15 11:57:03', 'Login', 'Login berhasil', 'Tersedia'),
(1431, '183510400', 'Mahasiswa', '2022-04-15 12:01:08', 'Login', 'Login berhasil', 'Tersedia'),
(1432, '183510393', 'Mahasiswa', '2022-04-15 12:01:25', 'Login', 'Login berhasil', 'Tersedia'),
(1433, '183510393', 'Mahasiswa', '2022-04-15 12:08:17', 'Login', 'Login berhasil', 'Tersedia'),
(1434, 'tu', 'Tata Usaha', '2022-04-15 12:08:24', 'Login', 'Login berhasil', 'Tersedia'),
(1435, 'dekan', 'Fakultas', '2022-04-15 12:08:36', 'Login', 'Login berhasil', 'Tersedia'),
(1436, '51023048901', 'Dosen', '2022-04-15 12:16:06', 'Login', 'Login berhasil', 'Tersedia'),
(1437, 'nadiarozaan18@gmail.com', 'Pembimbing Lapangan KP', '2022-04-15 12:17:53', 'Login', 'Login berhasil', 'Tersedia'),
(1438, 'koordinator35', 'Koordinator Prodi', '2022-04-15 12:21:00', 'Login', 'Login berhasil', 'Tersedia'),
(1439, '51029027601', 'Dosen', '2022-04-15 12:22:21', 'Login', 'Login berhasil', 'Tersedia'),
(1440, 'koordinator35', 'Koordinator Prodi', '2022-04-15 12:23:02', 'Login', 'Login berhasil', 'Tersedia'),
(1441, '51029027601', 'Dosen', '2022-04-15 12:28:18', 'Login', 'Login berhasil', 'Tersedia'),
(1442, '50314068701', 'Dosen', '2022-04-15 12:28:45', 'Login', 'Login berhasil', 'Tersedia'),
(1443, '51023048901', 'Dosen', '2022-04-15 12:43:30', 'Login', 'Login berhasil', 'Tersedia'),
(1444, 'tu', 'Tata Usaha', '2022-04-15 13:29:35', 'Login', 'Login berhasil', 'Tersedia'),
(1445, '51023048901', 'Dosen', '2022-04-16 11:00:56', 'Login', 'Login berhasil', 'Tersedia'),
(1446, '51029027601', 'Dosen', '2022-04-16 11:01:19', 'Login', 'Login berhasil', 'Tersedia'),
(1447, '50314068701', 'Dosen', '2022-04-16 11:01:35', 'Login', 'Login berhasil', 'Tersedia'),
(1448, '183510393', 'Mahasiswa', '2022-04-16 11:03:42', 'Login', 'Login berhasil', 'Tersedia'),
(1449, '51023048901', 'Dosen', '2022-04-16 20:42:55', 'Login', 'Login berhasil', 'Tersedia'),
(1450, '51023048901', 'Dosen', '2022-04-16 20:57:09', 'Login', 'Login berhasil', 'Tersedia'),
(1451, '50314068701', 'Dosen', '2022-04-16 21:02:13', 'Login', 'Login berhasil', 'Tersedia'),
(1452, '51029027601', 'Dosen', '2022-04-16 21:02:25', 'Login', 'Login berhasil', 'Tersedia'),
(1453, '183510393', 'Mahasiswa', '2022-04-16 21:05:24', 'Login', 'Login berhasil', 'Tersedia'),
(1454, 'tu', 'Tata Usaha', '2022-04-16 21:06:39', 'Login', 'Login berhasil', 'Tersedia'),
(1455, 'superadmin35', 'Prodi', '2022-04-16 21:07:20', 'Login', 'Login berhasil', 'Tersedia'),
(1456, 'koordinator35', 'Koordinator Prodi', '2022-04-16 21:48:02', 'Login', 'Login berhasil', 'Tersedia'),
(1457, 'dekan', 'Fakultas', '2022-04-16 21:48:23', 'Login', 'Login berhasil', 'Tersedia'),
(1458, '183510393', 'Mahasiswa', '2022-04-16 21:49:57', 'Login', 'Login berhasil', 'Tersedia'),
(1459, 'dekan', 'Fakultas', '2022-04-16 21:54:12', 'Login', 'Login berhasil', 'Tersedia'),
(1460, '183510393', 'Mahasiswa', '2022-04-16 22:05:40', 'Login', 'Login berhasil', 'Tersedia'),
(1461, 'dekan', 'Fakultas', '2022-04-16 22:16:46', 'Login', 'Login berhasil', 'Tersedia'),
(1462, '173110270', 'Mahasiswa', '2022-04-17 11:59:31', 'Login', 'Login berhasil', 'Tersedia'),
(1463, 'tu', 'Tata Usaha', '2022-04-17 12:00:00', 'Login', 'Login berhasil', 'Tersedia'),
(1464, 'superadmin31', 'Prodi', '2022-04-17 12:00:24', 'Login', 'Login berhasil', 'Tersedia'),
(1465, 'dekan', 'Fakultas', '2022-04-17 12:00:40', 'Login', 'Login berhasil', 'Tersedia'),
(1466, '10008076401', 'Dosen', '2022-04-17 13:46:04', 'Login', 'Login berhasil', 'Tersedia'),
(1467, 'a@gmail.com', 'Pembimbing Lapangan KP', '2022-04-17 13:47:55', 'Login', 'Login berhasil', 'Tersedia'),
(1468, 'koordinator31', 'Koordinator Prodi', '2022-04-17 13:50:47', 'Login', 'Login berhasil', 'Tersedia'),
(1469, '11013066803', 'Dosen', '2022-04-17 13:54:18', 'Login', 'Login berhasil', 'Tersedia'),
(1470, '11018017303', 'Dosen', '2022-04-17 13:54:48', 'Login', 'Login berhasil', 'Tersedia'),
(1471, 'tu', 'Tata Usaha', '2022-04-17 14:00:47', 'Login', 'Login berhasil', 'Tersedia'),
(1472, 'superadmin35', 'Prodi', '2022-04-17 14:03:11', 'Login', 'Login berhasil', 'Tersedia'),
(1473, 'dekan', 'Fakultas', '2022-04-17 14:53:56', 'Login', 'Login berhasil', 'Tersedia'),
(1474, 'superadmin35', 'Prodi', '2022-04-17 19:48:21', 'Login', 'Login berhasil', 'Tersedia'),
(1475, 'superadmin31', 'Prodi', '2022-04-17 19:48:26', 'Login', 'Login berhasil', 'Tersedia'),
(1476, 'superadmin31', 'Prodi', '2022-04-17 21:31:11', 'Login', 'Login berhasil', 'Tersedia'),
(1477, 'superadmin35', 'Prodi', '2022-04-17 21:32:33', 'Login', 'Login berhasil', 'Tersedia'),
(1478, 'dekan', 'Fakultas', '2022-04-17 21:46:51', 'Login', 'Login berhasil', 'Tersedia'),
(1479, '183510400', 'Mahasiswa', '2022-04-18 11:05:09', 'Login', 'Login berhasil', 'Tersedia'),
(1480, 'tu', 'Tata Usaha', '2022-04-18 11:05:47', 'Login', 'Login berhasil', 'Tersedia'),
(1481, 'superadmin35', 'Prodi', '2022-04-18 11:06:10', 'Login', 'Login berhasil', 'Tersedia'),
(1482, 'dekan', 'Fakultas', '2022-04-18 11:06:30', 'Login', 'Login berhasil', 'Tersedia'),
(1483, '51023048901', 'Dosen', '2022-04-18 11:09:06', 'Login', 'Login berhasil', 'Tersedia'),
(1484, 'tes@gmail.com', 'Pembimbing Lapangan KP', '2022-04-18 11:13:56', 'Login', 'Login berhasil', 'Tersedia'),
(1485, 'koordinator35', 'Koordinator Prodi', '2022-04-18 11:23:46', 'Login', 'Login berhasil', 'Tersedia'),
(1486, '51029027601', 'Dosen', '2022-04-18 11:55:25', 'Login', 'Login berhasil', 'Tersedia'),
(1487, '50314068701', 'Dosen', '2022-04-18 11:56:02', 'Login', 'Login berhasil', 'Tersedia'),
(1488, '183510400', 'Mahasiswa', '2022-04-18 18:42:56', 'Login', 'Login berhasil', 'Tersedia'),
(1489, 'superadmin35', 'Prodi', '2022-04-18 18:43:07', 'Login', 'Login berhasil', 'Tersedia'),
(1490, '51023048901', 'Dosen', '2022-04-18 18:44:12', 'Login', 'Login berhasil', 'Tersedia'),
(1491, 'tu', 'Tata Usaha', '2022-04-18 18:48:04', 'Login', 'Login berhasil', 'Tersedia'),
(1492, '51029027601', 'Dosen', '2022-04-18 18:49:35', 'Login', 'Login berhasil', 'Tersedia'),
(1493, '50314068701', 'Dosen', '2022-04-18 18:52:31', 'Login', 'Login berhasil', 'Tersedia'),
(1494, '173510190', 'Mahasiswa', '2022-04-18 19:08:23', 'Login', 'Login berhasil', 'Tersedia'),
(1495, 'tu', 'Tata Usaha', '2022-04-18 19:08:40', 'Login', 'Login berhasil', 'Tersedia'),
(1496, 'dekan', 'Fakultas', '2022-04-18 19:08:58', 'Login', 'Login berhasil', 'Tersedia'),
(1497, 'tes@gmail.com', 'Pembimbing Lapangan KP', '2022-04-18 19:14:53', 'Login', 'Login berhasil', 'Tersedia'),
(1498, 'koordinator35', 'Koordinator Prodi', '2022-04-18 19:17:52', 'Login', 'Login berhasil', 'Tersedia'),
(1499, '51003087703', 'Dosen', '2022-04-18 19:26:49', 'Login', 'Login berhasil', 'Tersedia'),
(1500, '51015047503', 'Dosen', '2022-04-18 19:29:23', 'Login', 'Login berhasil', 'Tersedia'),
(1501, 'tu', 'Tata Usaha', '2022-04-18 19:44:35', 'Login', 'Login berhasil', 'Tersedia'),
(1502, '183210732', 'Mahasiswa', '2022-04-18 19:58:29', 'Login', 'Login berhasil', 'Tersedia'),
(1503, 'dekan', 'Fakultas', '2022-04-18 19:59:07', 'Login', 'Login berhasil', 'Tersedia'),
(1504, 'superadmin32', 'Prodi', '2022-04-18 19:59:15', 'Login', 'Login berhasil', 'Tersedia'),
(1505, 'tu', 'Tata Usaha', '2022-04-18 19:59:19', 'Login', 'Login berhasil', 'Tersedia'),
(1506, '21013056902', 'Dosen', '2022-04-18 20:02:00', 'Login', 'Login berhasil', 'Tersedia'),
(1507, 'tes@gmail.com', 'Pembimbing Lapangan KP', '2022-04-18 20:04:07', 'Login', 'Login berhasil', 'Tersedia'),
(1508, 'koordinator32', 'Koordinator Prodi', '2022-04-18 20:06:37', 'Login', 'Login berhasil', 'Tersedia'),
(1509, '21016047901', 'Dosen', '2022-04-18 20:11:31', 'Login', 'Login berhasil', 'Tersedia'),
(1510, '21005107603', 'Dosen', '2022-04-18 20:12:07', 'Login', 'Login berhasil', 'Tersedia'),
(1511, 'tu', 'Tata Usaha', '2022-04-18 20:24:12', 'Login', 'Login berhasil', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_matkul`
--

CREATE TABLE `tb_matkul` (
  `kode_mk` char(30) NOT NULL,
  `kode_jurusan` char(20) NOT NULL,
  `nama_mk` varchar(50) NOT NULL,
  `sks_teori` int(3) NOT NULL,
  `sks_praktik` int(3) NOT NULL,
  `semester` char(20) NOT NULL,
  `kode_mk_prasyarat` char(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_matkul`
--

INSERT INTO `tb_matkul` (`kode_mk`, `kode_jurusan`, `nama_mk`, `sks_teori`, `sks_praktik`, `semester`, `kode_mk_prasyarat`, `status`) VALUES
('1TS22010', '1', 'STATISTIK DAN PROBABILITAS', 2, 0, '2', '-', 'Tersedia'),
('1TS22011', '1', 'MEKANIKA FLUIDA', 2, 0, '2', '-', 'Tersedia'),
('1TS23007', '1', 'MEKANIKA BAHAN', 3, 0, '2', '-', 'Tersedia'),
('1TS23008', '1', 'ANALISIS STRUKTUR I', 3, 0, '2', '-', 'Tersedia'),
('1TS23009', '1', 'MATEMATIKA TEKNIK II', 3, 0, '2', '-', 'Tersedia'),
('1TS23012', '1', 'GAMBAR STRUKTUR BANGUNAN', 3, 0, '2', '-', 'Tersedia'),
('1TS42022', '1', 'ANALISIS STRUKTUR III', 2, 0, '4', '-', 'Tersedia'),
('1TS42023', '1', 'MEKANIKA TANAH II', 2, 0, '4', '-', 'Tersedia'),
('1TS42024', '1', 'REKAYASA LALU LINTAS', 2, 0, '4', '-', 'Tersedia'),
('1TS42025', '1', 'EKONOMI TEKNIK', 2, 0, '4', '-', 'Tersedia'),
('1TS42027', '1', 'STRUKTUR BAJA I', 2, 0, '4', '-', 'Tersedia'),
('1TS42028', '1', 'MATEMATIKA TEKNIK IV', 2, 0, '4', '-', 'Tersedia'),
('1TS42029', '1', 'DESAIN PONDASI I', 2, 0, '4', '-', 'Tersedia'),
('1TS42030', '1', 'HIDROLOGI TERAPAN', 2, 0, '4', '-', 'Tersedia'),
('1TS43026', '1', 'STRUKTUR BETON BERTULANG II', 3, 0, '4', '-', 'Tersedia'),
('1TS62040', '1', 'STRUKTUR BAJA III', 2, 0, '6', '-', 'Tersedia'),
('1TS62041', '1', 'PERANCANGAN PERKERASAN JALAN', 2, 0, '6', '-', 'Tersedia'),
('1TS62042', '1', 'ANALISIS STRUKTUR V', 2, 0, '6', '-', 'Tersedia'),
('1TS62043', '1', 'PENGANTAR SUMBER DAYA AIR', 2, 0, '6', '-', 'Tersedia'),
('1TS62044', '1', 'ASPEK HUKUM DALAM PEMBANGUNAN', 2, 0, '6', '-', 'Tersedia'),
('1TS62045', '1', 'REKAYASA LINGKUNGAN', 2, 0, '6', '-', 'Tersedia'),
('1TS62047', '1', 'PENGELOLAAN ALAT BERAT', 2, 0, '6', '-', 'Tersedia'),
('1TS62048', '1', 'METODE PENELITIAN DAN TEKNIK PRESENTASE', 2, 0, '6', '-', 'Tersedia'),
('1TS62071', '1', 'PERBAIKAN TANAH', 2, 0, '6', '-', 'Tersedia'),
('1TS63046', '1', 'KEWIRAUSAHAAN TEKNIK SIPIL', 3, 0, '6', '-', 'Tersedia'),
('1ts82061', '1', 'PERKERASAN JALAN LANJUTAN', 0, 2, '8', '-', 'Tersedia'),
('1TS82062', '1', 'REKAYASA SUNGAI', 0, 2, '8', '-', 'Tersedia'),
('1TS82063', '1', 'AMDAL', 0, 2, '8', '-', 'Tersedia'),
('1TS82064', '1', 'PLANOLOGI', 0, 2, '8', '-', 'Tersedia'),
('1TS82065', '1', 'LAPANGAN TERBANG', 0, 2, '8', '-', 'Tersedia'),
('1TS82067', '1', 'DRAINASE', 0, 2, '8', '-', 'Tersedia'),
('1TS82068', '1', 'MEK. TANAH & PONDASI LANJUTAN', 0, 2, '8', '-', 'Tersedia'),
('1TS82069', '1', 'TEKNOLOGI STRUKTUR BANGUNAN', 0, 2, '8', '-', 'Tersedia'),
('1TS82070', '1', 'JALAN REL', 0, 2, '8', '-', 'Tersedia'),
('1UN12002', '1', 'AL-ISLAM', 2, 0, '2', '-', 'Tersedia'),
('1UN13009', '1', 'PENDIDIKAN KEWARGANEGARAAN DAN PANCASILA', 3, 0, '2', '-', 'Tersedia'),
('22TP52202', '2', 'CSR', 2, 0, '4', '-', 'Tersedia'),
('2TP22014', '2', 'AGAMA ISLAM II', 2, 0, '2', '-', 'Tersedia'),
('2TP22015', '2', 'KIMIA DASAR II', 2, 0, '2', '-', 'Tersedia'),
('2TP22016', '2', 'PENGANTAR ELEKTRONIKA', 2, 0, '4', '-', 'Tersedia'),
('2TP23007', '2', 'PENGANTAR INDUSTRI MIGAS', 3, 0, '2', '-', 'Tersedia'),
('2TP23008', '2', 'KALKULUS II', 3, 0, '2', '-', 'Tersedia'),
('2TP23010', '2', 'FISIKA DASAR II', 3, 0, '2', '-', 'Tersedia'),
('2TP23011', '2', 'REGULASI DAN LINGKUNGAN MIGAS', 3, 0, '2', '-', 'Tersedia'),
('2TP42505', '2', 'ENGLISH FOR OFFICE', 2, 0, '4', '-', 'Tersedia'),
('2TP42506', '2', 'PERANCANGAN KONTRAK', 2, 0, '4', '-', 'Tersedia'),
('2TP43020', '2', 'MEKANIKA FLUIDA', 3, 0, '4', '-', 'Tersedia'),
('2TP43021', '2', 'GEOLOGI MINYAK DAN GAS BUMI', 3, 0, '4', '-', 'Tersedia'),
('2TP43022', '2', 'MEKANIKA RESERVOIR', 3, 0, '4', '-', 'Tersedia'),
('2TP43024', '2', 'METODE NUMERIK', 3, 0, '4', '-', 'Tersedia'),
('2TP43025', '2', 'KEWIRAUSAHAAN', 3, 0, '4', '-', 'Tersedia'),
('2TP52201', '2', 'HES (PB)', 2, 0, '4', '-', 'Tersedia'),
('2TP53036', '2', 'TEKNIK RESERVOIR II', 3, 0, '6', '-', 'Tersedia'),
('2TP53039', '2', 'TEKNIK PEMBORAN II', 3, 0, '6', '-', 'Tersedia'),
('2TP53048', '2', 'TEKNIK PRODUKSI II', 3, 0, '6', '-', 'Tersedia'),
('2TP62033', '2', 'KERJA PRAKTEK', 2, 0, '6', '-', 'Tersedia'),
('2TP63032', '2', 'PENGOLAHAN TRANSPORTASI MIGAS', 3, 0, '6', '-', 'Tersedia'),
('2TP63034', '2', 'PENILAIAN FORMASI', 3, 0, '6', '-', 'Tersedia'),
('2TP73049', '2', 'PENGENALAN EOR', 3, 0, '6', '-', 'Tersedia'),
('2TP73502', '2', 'UNCONVENTIONAL HYDROCARBON', 3, 0, '8', '-', 'Tersedia'),
('2TP73503', '2', 'PRENCANAAN PENGEMBANGAN LAPANGAN', 3, 0, '8', '-', 'Tersedia'),
('2TP73504', '2', 'TEKNIK PRODUKSI UNTUK SUMUR TUA', 3, 0, '8', '-', 'Tersedia'),
('2TP73505', '2', 'TEKNIK PEMBORAN HORIZONTAL', 3, 0, '8', '-', 'Tersedia'),
('2TP73507', '2', 'BLOW OUT & WELL CONTROL', 3, 0, '6', '-', 'Tersedia'),
('2TP83057', '2', 'STIMULASI & KERJA ULANG SUMUR', 3, 0, '8', '-', 'Tersedia'),
('2TP83503', '2', 'THERMAL ENHANCED OIL RECOVERY', 3, 0, '8', '-', 'Tersedia'),
('2TP83504', '2', 'PENGEMBANGAN LAPANGAN PANAS BUMI', 3, 0, '8', '-', 'Tersedia'),
('2TP83510', '2', 'SISTEM PENDUKUNG KEPUTUSAN OPERASI MIGAS', 3, 0, '8', '-', 'Tersedia'),
('2TS23010', '2', 'FISIKA DASAR II', 3, 0, '2', '-', 'Dihapus'),
('2UN12006', '2', 'BAHASA INGGRIS', 2, 0, '2', '-', 'Tersedia'),
('2UN12007', '2', 'PANCASILA', 2, 0, '2', '-', 'Tersedia'),
('3TM21281', '3', 'PRAKTIKUM FISIKA DASAR', 1, 0, '2', '-', 'Tersedia'),
('3TM22271', '3', 'MENGGAMBAR MESIN/CAD', 2, 0, '2', '-', 'Tersedia'),
('3TM23221', '3', 'TERMODINAMIKA I', 3, 0, '2', '-', 'Tersedia'),
('3TM23231', '3', 'METALURGI FISIK', 3, 0, '2', '-', 'Tersedia'),
('3TM23241', '3', 'KALKULUS II', 3, 0, '2', '-', 'Tersedia'),
('3TM23251', '3', 'FISIKA II', 3, 0, '2', '-', 'Tersedia'),
('3TM23261', '3', 'STATIKA STRUKTUR', 3, 0, '2', '-', 'Tersedia'),
('3TM41281', '3', 'PRAKTIKUM PROSES PRODUKSI', 1, 0, '4', '-', 'Tersedia'),
('3TM42241', '3', 'DINAMIKA TEKNIK', 2, 0, '4', '-', 'Tersedia'),
('3TM42251', '3', 'PROSES PRODUKSI II', 2, 0, '4', '-', 'Tersedia'),
('3TM42371', '3', 'ELEMEN MESIN II', 3, 0, '4', '-', 'Tersedia'),
('3TM43221', '3', 'MEKANIKA FLUIDA I', 3, 0, '4', '-', 'Tersedia'),
('3TM43231', '3', 'MATEMATIKA TEKNIK II', 3, 0, '4', '-', 'Tersedia'),
('3TM43261', '3', 'PERPINDAHAN PANAS I', 3, 0, '4', '-', 'Tersedia'),
('3TM61291', '3', 'PRAKTIKUM FENOMENA DASAR MESIN', 1, 0, '6', '-', 'Tersedia'),
('3TM62221', '3', 'TEKNOLOGI ENERGI DAN LINGKUNGAN', 2, 0, '6', '-', 'Tersedia'),
('3TM62241', '3', 'GETARAN MEKANIK', 2, 0, '6', '-', 'Tersedia'),
('3TM62251', '3', 'MEKATRONIKA', 2, 0, '6', '-', 'Tersedia'),
('3TM62261', '3', 'METODOLOGI PENELITIAN', 2, 0, '6', '-', 'Tersedia'),
('3TM63231', '3', 'MESIN KONVERSI ENERGI', 3, 0, '6', '-', 'Tersedia'),
('3TM63272', '3', 'INSTALASI KETEL & TURBIN UAP', 3, 0, '6', '-', 'Tersedia'),
('3TM63273', '3', 'MOTOR BAKAR TORAK & TURBIN GAS', 3, 0, '6', '-', 'Tersedia'),
('3TM63274', '3', 'ILMU KOMPOSIT & POLIMER', 3, 0, '6', '-', 'Tersedia'),
('3TM63275', '3', 'TEKNIK PENGELASAN', 3, 0, '6', '-', 'Tersedia'),
('3TM82211', '3', 'PERAWATAN MESIN', 2, 0, '8', '-', 'Tersedia'),
('3TM83222', '3', 'POMPA DAN KOMPRESOR', 3, 0, '8', '-', 'Tersedia'),
('3TM83225', '3', 'KOROSI DAN DEGRADASI MATERIAL', 3, 0, '8', '-', 'Tersedia'),
('3TM83233', '3', 'ENERGI BIOMASSA DAN BIOGAS', 3, 0, '8', '-', 'Tersedia'),
('3TM83234', '3', 'MATERIAL ENERGI', 3, 0, '8', '-', 'Tersedia'),
('3TM83235', '3', 'TEKNIK PEMBENTUKAN LOGAM', 3, 0, '8', '-', 'Tersedia'),
('3UN12002', '3', 'AL-ISLAM', 2, 0, '2', '-', 'Tersedia'),
('3UN12006', '3', 'BAHASA INGGRIS', 2, 0, '4', '-', 'Tersedia'),
('3UN12008', '3', 'PENDIDIKAN KEWARGANEGARAAN', 2, 0, '6', '-', 'Tersedia'),
('4PW22009', '4', 'AL ISLAM II', 2, 0, '2', '-', 'Tersedia'),
('4PW22010', '4', 'KALKULUS II', 2, 0, '2', '-', 'Tersedia'),
('4PW22011', '4', 'KOMPUTER PERENCANAAN', 2, 0, '2', '-', 'Tersedia'),
('4PW22012', '4', 'PRAKTIKUM KOMPUTER PERENCANAAN', 0, 1, '2', '-', 'Tersedia'),
('4PW22015', '4', 'STATISTIK I', 2, 0, '2', '-', 'Tersedia'),
('4PW23013', '4', 'EKONOMI WILAYAH DAN KOTA', 3, 0, '2', '-', 'Tersedia'),
('4PW23014', '4', 'PENGANTAR PROSES PERENCANAAN', 3, 0, '2', '-', 'Tersedia'),
('4PW23016', '4', 'IDENTIFIKASI DAN TEKNIK PRESENTASI', 2, 1, '2', '-', 'Tersedia'),
('4PW42027', '4', 'KEPENDUDUKAN', 2, 0, '4', '-', 'Tersedia'),
('4PW42031', '4', 'TEORI PERENCANAAN II', 2, 0, '4', '-', 'Tersedia'),
('4PW42032', '4', 'PSIKOLOGI LINGKUNGAN', 2, 0, '4', '-', 'Tersedia'),
('4PW43028', '4', 'GEOLOGI LINGKUNGAN', 3, 0, '4', '-', 'Tersedia'),
('4PW43029', '4', 'PERENCANAAN DESA TERPADU', 3, 0, '4', '-', 'Tersedia'),
('4PW43030', '4', 'SISTEM INFORMASI PERENCANAAN', 2, 1, '4', '-', 'Tersedia'),
('4PW43036', '4', 'METODE ANALISIS PERENCANAAN', 3, 0, '4', '-', 'Tersedia'),
('4PW44033', '4', 'STUDIO PERMUKIMAN KOTA', 0, 4, '4', '-', 'Tersedia'),
('4PW62043', '4', 'KEWIRAUSAHAAN', 2, 0, '6', '-', 'Tersedia'),
('4PW62044', '4', 'BAHASA INGGRIS TEKNIK', 2, 0, '6', '-', 'Tersedia'),
('4PW62047', '4', 'MANAJEMEN LAHAN', 2, 0, '6', '-', 'Tersedia'),
('4PW62050', '4', 'MANAJEMEN PEMBANGUNAN', 2, 0, '6', '-', 'Tersedia'),
('4PW62051', '4', 'PERENCANAAN KAWASAN PESISIR', 2, 0, '6', '-', 'Tersedia'),
('4PW63045', '4', 'HUKUM DAN ADMINISTRASI PERENCANAAN', 3, 0, '6', '-', 'Tersedia'),
('4PW63046', '4', 'PERENCANAAN WILAYAH', 3, 0, '6', '-', 'Tersedia'),
('4PW64048', '4', 'STUDIO PERENCANAAN KOTA', 0, 4, '6', '-', 'Tersedia'),
('4PW64049', '4', 'PENGELOLAAN TRANSPORTASI', 0, 4, '6', '-', 'Tersedia'),
('4UN12008', '4', 'PENDIDIKAN KEWARGANEGARAAN', 2, 0, '2', '-', 'Tersedia'),
('5TI12001', '5', 'Bahasa Inggris I ', 2, 0, 'PILIHAN', '-', 'Tersedia'),
('5TI12137', '5', 'Tata Tulis Karya Ilmiah', 2, 0, '1', '-', 'Tersedia'),
('5TI13003', '5', 'Logika Informatika', 3, 0, '1', '-', 'Tersedia'),
('5TI14004', '5', ' Pengantar Teknologi Informasi', 3, 1, '1', '-', 'Tersedia'),
('5TI14027', '5', 'Pemrograman Komputer I', 2, 2, '1', '-', 'Tersedia'),
('5TI22002', '5', 'Bahasa Inggris II', 3, 0, '2', '-', 'Tersedia'),
('5TI23005', '5', 'Matematika Diskrit', 3, 0, '2', '-', 'Tersedia'),
('5TI23006', '5', 'Organisasi dan Arsitektur Komputer', 3, 0, '2', '-', 'Tersedia'),
('5TI23028', '5', 'Pemrograman Komputer II', 2, 1, '2', '-', 'Tersedia'),
('5TI23029', '5', 'Sistem Informasi', 3, 0, '2', '-', 'Tersedia'),
('5TI24030', '5', 'Pemrograman Berorientasi Objek', 2, 2, '2', '-', 'Tersedia'),
('5TI33007', '5', 'Basis Data I', 2, 1, '3', '-', 'Tersedia'),
('5TI33008', '5', ' Rekayasa Perangkat Lunak', 3, 0, '3', '-', 'Tersedia'),
('5TI33010', '5', 'Sistem Operasi', 2, 1, '3', '5TI23006', 'Tersedia'),
('5TI33011', '5', 'Aljabar Linear dan Matriks', 3, 0, '3', '-', 'Tersedia'),
('5TI33031', '5', ' Pemrograman Web I', 2, 1, '3', '5TI14027', 'Tersedia'),
('5TI34009', '5', ' Algoritma dan Struktur Data', 2, 2, '3', '5TI23028', 'Tersedia'),
('5TI42048', '5', 'Studi Kepemimpinan Islam', 2, 0, '4', '-', 'Tersedia'),
('5TI43012', '5', 'Probabilitas dan Statistik', 3, 0, '4', '-', 'Tersedia'),
('5TI43013', '5', 'Kecerdasan Buatan', 2, 1, '4', '5 TI33011', 'Tersedia'),
('5TI43014', '5', 'Basis Data II', 2, 1, '4', '5 TI33007', 'Tersedia'),
('5TI43032', '5', 'Pemrograman Multi Platform (Java)', 2, 1, '4', '5TI24030', 'Tersedia'),
('5TI43033', '5', ' Pemrograman Web II', 2, 1, '4', '5TI33031', 'Tersedia'),
('5TI44015', '5', 'Jaringan Komputer', 2, 2, '4', '5TI14004', 'Tersedia'),
('5TI52035', '5', 'Metodologi Penelitian', 2, 0, '5', '5TI12137', 'Tersedia'),
('5TI52051', '5', 'Kerja Praktek', 2, 0, 'TEAM TEACHING', '-', 'Tersedia'),
('5TI53016', '5', 'Dasar Pemrograman Mobile', 2, 1, '5', '5TI14027', 'Tersedia'),
('5TI53017', '5', ' Grafika Komputer', 2, 1, '5', '5 TI33011', 'Tersedia'),
('5TI53018', '5', 'Keamanan Komputer dan Jaringan', 2, 1, '5', '5TI44015', 'Tersedia'),
('5TI53019', '5', 'Desain dan Analisis Algoritma', 3, 0, '5', '5TI14027', 'Tersedia'),
('5TI53034', '5', 'Pemrograman Visual', 2, 1, '5', '5TI14027', 'Tersedia'),
('5TI53039', '5', ' Web Platforms', 2, 1, '5', '-', 'Tersedia'),
('5TI53042', '5', 'Logika Fuzzy', 2, 1, '5', '-', 'Tersedia'),
('5TI53045', '5', 'Routing and Switching Essentials', 2, 1, '5', '-', 'Tersedia'),
('5TI62036', '5', 'Kewirausahaan Teknologi', 2, 0, '6', '-', 'Tersedia'),
('5TI62037', '5', ' Skripsi I', 2, 0, 'TEAM TEACHING', '-', 'Tersedia'),
('5TI62049', '5', 'Kecakapan Antar Personal', 2, 0, '6', '-', 'Tersedia'),
('5TI63020', '5', 'Teori Bahasa dan Automata', 3, 0, '6', '-', 'Tersedia'),
('5TI63021', '5', 'Sistem Terdistribusi', 2, 1, '6', '5TI43014', 'Tersedia'),
('5TI63022', '5', 'Pengolahan Citra', 2, 1, '6', '5TI33011', 'Tersedia'),
('5TI63023', '5', 'Sistem Pendukung Keputusan', 3, 0, '6', '-', 'Tersedia'),
('5TI63040', '5', 'Mobile Platforms ', 2, 1, '6', '-', 'Tersedia'),
('5TI63043', '5', 'Sistem Pakar', 2, 1, '6', '-', 'Tersedia'),
('5TI63046', '5', 'Scalling Networks', 2, 1, '6', '-', 'Tersedia'),
('5TI72050', '5', 'Keahlian Berkomunikasi', 2, 0, '7', '-', 'Tersedia'),
('5TI72052', '5', 'Etika Profesi', 2, 0, '7', '-', 'Tersedia'),
('5TI72053', '5', ' Cyber Law', 2, 0, '7', '-', 'Tersedia'),
('5TI73024', '5', 'Manajemen Proyek Teknologi Informasi', 3, 0, '7', '5TI23029', 'Tersedia'),
('5TI73025', '5', 'Interaksi Manusia dan Komputer', 3, 0, '7', '-', 'Tersedia'),
('5TI73026', '5', 'Sains Komputasi', 2, 1, '7', '-', 'Tersedia'),
('5TI73041', '5', 'Animation Platforms', 2, 1, '7', '-', 'Tersedia'),
('5TI73044', '5', 'Pembelajaran Mesin', 2, 1, '7', '-', 'Tersedia'),
('5TI73047', '5', 'Connecting Networks ', 2, 1, '7', '-', 'Tersedia'),
('5TI84038', '5', 'Skripsi II', 4, 0, 'TEAM TEACHING', '-', 'Tersedia'),
('5UN12001', '5', 'Pendidikan Agama Islam', 2, 0, '1', '-', 'Tersedia'),
('5UN12002', '5', 'Al-Islam', 2, 0, '2', '-', 'Tersedia'),
('5UN12003', '5', ' Ibadah dan Syariah', 2, 0, '3', '-', 'Tersedia'),
('5UN12007', '5', ' Pendidikan Pancasila', 2, 0, '1', '-', 'Tersedia'),
('5UN12008', '5', 'Pendidikan Kewarganegaraan', 2, 0, '2', '-', 'Tersedia'),
('6TG22210', '6', 'AGAMA ISLAM II', 2, 0, '2', '-', 'Tersedia'),
('6TG22211', '6', 'FISIKA DASAR II', 2, 0, '2', '-', 'Tersedia'),
('6TG22212', '6', 'KIMIA DASAR II', 2, 0, '2', '-', 'Tersedia'),
('6TG22213', '6', 'KALKULUS II', 2, 0, '2', '-', 'Tersedia'),
('6TG23214', '6', 'SEDIMENTOLOGI', 3, 0, '2', '-', 'Tersedia'),
('6TG23215', '6', 'PALEONTOLOGI', 3, 0, '2', '-', 'Tersedia'),
('6TG23216', '6', 'PETROLOGI', 3, 0, '2', '-', 'Tersedia'),
('6TG23217', '6', 'GEOLOGI CITRA DAN PENGINDERAAN JAUH', 2, 1, '2', '-', 'Tersedia'),
('6TG42226', '6', 'PENGANTAR GEOLOGI EKSPLORASI', 2, 0, '4', '-', 'Tersedia'),
('6TG42227', '6', 'GEOFISIKA', 2, 0, '4', '-', 'Tersedia'),
('6TG42229', '6', 'VULKANOLOGI', 2, 0, '4', '-', 'Tersedia'),
('6TG42230', '6', 'TEKTONIKA', 2, 0, '4', '-', 'Tersedia'),
('6TG42231', '6', 'GEOLOGI STRUKTUR INDONESIA', 2, 0, '4', '-', 'Tersedia'),
('6TG42232', '6', 'GEOLOGI LINGKUNGAN', 2, 0, '4', '-', 'Tersedia'),
('6TG42233', '6', 'METODOLOGI PENELITIAN', 2, 0, '4', '-', 'Tersedia'),
('6TG43225', '6', 'ILMU UKUR TANAH DAN KARTOGRAFI', 3, 0, '4', '-', 'Tersedia'),
('6TG43228', '6', 'KOMPUTASI GEOLOGI DAN GAMBAR TEKNIK', 2, 1, '4', '-', 'Tersedia'),
('6TG62246', '6', 'GEOLOGI KELAUTAN', 2, 0, '6', '-', 'Tersedia'),
('6TG62247', '6', 'MANAJEMEN EKSPLORASI', 2, 0, '6', '-', 'Tersedia'),
('6TG62249', '6', 'TEKNIK KOMUNIKASI GEOLOGI', 2, 0, '6', '-', 'Tersedia'),
('6TG62252', '6', 'EKSPLORASI BATUBARA', 2, 0, '6', '-', 'Tersedia'),
('6TG62253', '6', 'GEOKIMIA', 2, 0, '6', '-', 'Tersedia'),
('6TG63248', '6', 'GEOFISIKA TERAPAN', 3, 0, '6', '-', 'Tersedia'),
('6TG63250', '6', 'GEOSTATISTIK', 2, 1, '6', '-', 'Tersedia'),
('6TG66251', '6', 'SEKUEN STRATIGRAFI', 2, 0, '6', '-', 'Tersedia'),
('6UN12003', '6', 'IBADAH DAN SYARIAH', 2, 0, '4', '-', 'Tersedia'),
('6UN12006', '6', 'BAHASA INGGRIS', 2, 0, '2', '-', 'Tersedia'),
('6UN13012', '6', 'KEWIRAUSAHAAN', 2, 1, '6', '-', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pertemuan`
--

CREATE TABLE `tb_pertemuan` (
  `id_pertemuan` int(11) NOT NULL,
  `id_semester` int(11) NOT NULL,
  `jenis_pertemuan` varchar(20) NOT NULL,
  `pertemuan_mulai` datetime NOT NULL,
  `pertemuan_selesai` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pertemuan`
--

INSERT INTO `tb_pertemuan` (`id_pertemuan`, `id_semester`, `jenis_pertemuan`, `pertemuan_mulai`, `pertemuan_selesai`, `status`) VALUES
(1, 1, 'Online', '2021-08-09 02:06:01', '2021-08-25 02:06:01', 'Dihapus'),
(3, 3, 'Offline', '2021-08-04 11:18:00', '2021-08-26 23:19:00', 'Dihapus'),
(5, 3, 'Offline', '2021-08-17 11:45:00', '2021-08-25 11:45:00', 'Dihapus'),
(6, 5, 'Online', '2021-08-17 02:45:00', '2021-09-10 11:47:00', 'Dihapus'),
(7, 5, 'Online', '2021-08-17 11:48:00', '2021-09-10 23:48:00', 'Dihapus'),
(8, 1, 'Online', '2021-01-05 23:03:38', '2021-06-30 15:58:00', 'Tersedia'),
(9, 5, 'Online', '2021-07-01 23:03:42', '2022-01-30 16:46:00', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_presensi_pertemuan`
--

CREATE TABLE `tb_presensi_pertemuan` (
  `id_presensi_pertemuan` int(11) NOT NULL,
  `id_jadwal_kelas_pertemuan` int(11) NOT NULL,
  `dosen_penginput_presensi` char(50) NOT NULL,
  `waktu_pertemuan` datetime NOT NULL,
  `waktu_pertemuan_selesai` datetime NOT NULL,
  `waktu_input` datetime NOT NULL,
  `pertemuan_ke` int(2) NOT NULL,
  `kode_ruang` varchar(50) NOT NULL,
  `media_pertemuan` text NOT NULL,
  `materi_pertemuan` text NOT NULL,
  `metode_pertemuan` text NOT NULL,
  `mhs_hadir` int(3) NOT NULL,
  `foto_pertemuan` text NOT NULL,
  `status_verifikasi` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_presensi_pertemuan`
--

INSERT INTO `tb_presensi_pertemuan` (`id_presensi_pertemuan`, `id_jadwal_kelas_pertemuan`, `dosen_penginput_presensi`, `waktu_pertemuan`, `waktu_pertemuan_selesai`, `waktu_input`, `pertemuan_ke`, `kode_ruang`, `media_pertemuan`, `materi_pertemuan`, `metode_pertemuan`, `mhs_hadir`, `foto_pertemuan`, `status_verifikasi`, `status`) VALUES
(1, 591, '', '2021-08-13 11:35:00', '0000-00-00 00:00:00', '2021-08-14 10:19:32', 1, '3A.01.08', '0', ' Loop', '', 30, '', 'Minta Verifikasi', 'Tersedia'),
(2, 591, '', '2021-08-13 11:35:59', '0000-00-00 00:00:00', '2021-08-13 11:35:59', 2, '', '0', 'Loop', '', 30, '', 'Terverifikasi', 'Tersedia'),
(6, 608, '', '2021-08-02 01:58:00', '0000-00-00 00:00:00', '2021-08-14 01:58:33', 7, '', '0', 'GHah', '', 20, '', 'Minta Verifikasi', 'Tersedia'),
(7, 579, '', '2021-08-12 14:00:00', '0000-00-00 00:00:00', '2021-08-14 02:01:08', 12, '', '0', 'Per', '', 20, '', 'Terverifikasi', 'Tersedia'),
(8, 591, '', '2021-08-06 09:00:00', '0000-00-00 00:00:00', '2021-08-14 10:00:06', 7, '3A.01.10', '0', 'Meteor', '', 34, '', 'Minta Verifikasi', 'Tersedia'),
(9, 8, '55555555555', '2021-08-08 15:11:00', '0000-00-00 00:00:00', '2021-08-22 03:13:04', 1, '3A.01.09', '0', 'GG', '', 30, '', 'Terverifikasi', 'Tersedia'),
(10, 2, '55555555555', '2021-08-23 00:00:00', '0000-00-00 00:00:00', '2021-08-23 00:29:28', 1, '3A.01.09', '', 'HH', '', 35, '5555555555524082021052013BSC - Twibbon.png', 'Terverifikasi', 'Tersedia'),
(11, 7, '55555555555', '2021-08-23 00:00:00', '0000-00-00 00:00:00', '2021-08-23 00:55:36', 1, '', '', 'GGjnsx', 'gre', 39, '5555555555524082021052307background HP .jpg', 'Terverifikasi', 'Tersedia'),
(12, 8, '55555555555', '2021-08-26 00:00:00', '0000-00-00 00:00:00', '2021-08-26 00:58:12', 2, '', 'Google Classroom, Google Meeting, Zoom', 'Array', 'Melakukan m jn ', 30, '5555555555525082021200738bukti1.jpg', 'Terverifikasi', 'Tersedia'),
(13, 7, '55555555555', '2021-08-26 00:00:00', '0000-00-00 00:00:00', '2021-08-26 01:01:07', 2, '', 'Google Classroom, Google Meeting, Zoom', 'Loop', 'Pembagian Materi', 20, '5555555555525082021200107Capture sistem upm.JPG', 'Terverifikasi', 'Tersedia'),
(14, 8, '55555555555', '2021-07-29 00:00:00', '0000-00-00 00:00:00', '2021-08-30 19:18:46', 3, '', 'Google Classroom', 'iygy', 'iug', 70, '5555555555530082021141846background HP .jpg', 'Terverifikasi', 'Tersedia'),
(15, 2, '55555555555', '2021-09-03 00:00:00', '0000-00-00 00:00:00', '2021-09-03 08:40:29', 2, '', 'Google Meeting, Zoom, Cerdas UIR', 'hhi', 'hi', 40, '55555555555030920210340293-0.jpg', 'Terverifikasi', 'Tersedia'),
(16, 7, '55555555555', '2021-09-05 04:23:00', '2021-09-05 09:58:00', '2021-09-05 14:02:24', 3, '', 'Google Classroom, Google Meeting', 'Array', 'Presentasi', 50, '5555555555505092021090223background HP .jpg', 'Minta Verifikasi', 'Tersedia'),
(17, 8, '55555555555', '2021-09-05 08:15:00', '2021-09-05 11:13:00', '2021-09-05 14:04:05', 4, '', 'Zoom', 'ihu', 'Presentasi', 40, '5555555555505092021090404background HP .jpg', 'Minta Verifikasi', 'Tersedia'),
(27, 2, '55555555555', '2021-09-10 10:29:00', '2021-09-10 11:30:00', '2021-09-10 11:35:35', 3, '', '', 'ioji', 'jo', 88, '5555555555510092021063535background HP .jpg', 'Terverifikasi', 'Tersedia'),
(29, 2, '55555555555', '2021-09-10 10:29:00', '2021-09-10 11:30:00', '2021-09-10 17:16:47', 4, '', 'Zoom', 'sa', 'r32', 5, '5555555555510092021121647background HP .jpg', 'Terverifikasi', 'Tersedia'),
(30, 2, '55555555555', '2021-09-14 10:29:00', '2021-09-14 11:30:00', '2021-09-14 10:48:38', 5, '', 'Google Meeting, Zoom', 'vgjh', 'hvbhj', 40, '5555555555514092021054838Capture3.PNG', 'Terverifikasi', 'Tersedia'),
(31, 2, '55555555555', '2021-09-15 10:29:00', '2021-09-15 11:30:00', '2021-09-15 21:28:38', 6, '', 'Google Meet, Zoom', 'kjbjk', 'hgvv', 40, '55555555555150920211628383-0.jpg', 'Minta Verifikasi', 'Tersedia'),
(32, 6, '55555555555', '2021-09-16 10:00:00', '2021-09-16 12:00:00', '2021-09-16 19:48:46', 1, '', 'Zoom, Cerdas UIR', 'Pengenalan Matakuliah', 'Presentasi', 30, '5555555555516092021144846Capture-cth Presensi GCR.JPG', 'Terverifikasi', 'Tersedia'),
(33, 14, '55555555555', '2021-09-17 09:27:00', '2021-09-17 11:27:00', '2021-09-17 10:02:06', 1, '', 'Google Classroom, Google Meet', 'Pengenalan Matakuliah', 'Problem Based Learning', 42, '5555555555517092021050206Capture-cth Presensi GCR.JPG', 'Minta Verifikasi', 'Tersedia'),
(34, 6, '55555555555', '2021-09-18 10:00:00', '2021-09-18 11:40:00', '2021-09-18 04:29:56', 2, '', 'Zoom, Spada Dikti', 'jbj', 'gu', 40, '5555555555517092021232956background HP .jpg', 'Minta Verifikasi', 'Tersedia'),
(35, 17, '55555555555', '2021-09-22 11:29:00', '2021-09-22 13:29:00', '2021-09-22 00:41:38', 1, '', 'Zoom, Cerdas UIR, Spada Dikti', 'Perkenalan', 'Syncronize', 30, '5555555555521092021194138background HP .jpg', 'Minta Verifikasi', 'Tersedia'),
(36, 17, '51031126801', '2021-09-22 11:29:00', '2021-09-22 13:29:00', '2021-09-22 00:47:13', 2, '', 'Google Classroom, Google Meet', 'kjbujk', 'khbh', 30, '5103112680121092021194713BSC - Twibbon.png', 'Minta Verifikasi', 'Tersedia'),
(37, 18, '51031126801', '2021-09-25 07:07:00', '2021-09-25 09:07:00', '2021-09-25 10:29:19', 1, '', 'Google Classroom, Google Meet', 'ini materinya', 'PBS', 40, '5103112680125092021052919BSC - Twibbon copy.jpg', 'Minta Verifikasi', 'Tersedia'),
(38, 22, '51031126801', '2021-09-25 10:00:00', '2021-09-25 11:40:00', '2021-09-25 10:35:02', 1, '', 'Google Classroom, Zoom', 'kjbkj', 'hbh', 30, '5103112680125092021053502BSC - Twibbon copy.jpg', 'Minta Verifikasi', 'Tersedia'),
(40, 18, '55555555555', '2021-09-25 07:07:00', '2021-09-25 09:07:00', '2021-09-25 10:36:15', 2, '', 'Google Classroom, Google Meet', ',b', 'ku', 43, '5555555555525092021053615BSC - Twibbon copy.jpg', 'Minta Verifikasi', 'Tersedia'),
(41, 18, '55555555555', '2021-09-25 07:07:00', '2021-09-25 09:07:00', '2021-09-25 10:47:54', 3, '', 'Google Classroom, Zoom', ',njk', 'khb', 34, '5555555555525092021054754BSC - Twibbon copy.jpg', 'Minta Verifikasi', 'Tersedia'),
(42, 22, '55555555555', '2021-09-25 10:00:00', '2021-09-25 11:40:00', '2021-09-25 10:48:30', 2, '', 'Google Classroom, Google Meet', 'kjn', 'kjbu jnbu', 50, '5555555555525092021054830BSC - Twibbon copy.jpg', 'Minta Verifikasi', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_prodi`
--

CREATE TABLE `tb_prodi` (
  `kode_prodi` char(20) NOT NULL,
  `nama_prodi` varchar(50) NOT NULL,
  `jenjang` varchar(15) NOT NULL,
  `akreditasi` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_prodi`
--

INSERT INTO `tb_prodi` (`kode_prodi`, `nama_prodi`, `jenjang`, `akreditasi`, `status`) VALUES
('1', 'Teknik Sipil', 'S1', 'B', 'Tersedia'),
('2', 'Teknik Perminyakan', 'S1', 'B', 'Tersedia'),
('3', 'Teknik Mesin', 'S1', 'B', 'Tersedia'),
('4', 'Teknik Planologi', 'S1', 'B', 'Tersedia'),
('5', 'Teknik Informatika', 'S1', 'B', 'Tersedia'),
('6', 'Teknik Geologi', 'S1', 'B', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_prodi_attribut`
--

CREATE TABLE `tb_prodi_attribut` (
  `username` char(50) NOT NULL,
  `kode_prodi` char(20) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `npk` char(30) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_hp` char(14) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `hak_akses` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status_akun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_prodi_attribut`
--

INSERT INTO `tb_prodi_attribut` (`username`, `kode_prodi`, `nama_lengkap`, `npk`, `jenis_kelamin`, `email`, `no_hp`, `jabatan`, `hak_akses`, `password`, `foto`, `status_akun`) VALUES
('admin310', '1', 'Furizal', '0', 'Laki-laki', 'furizal@gmail.com', '098998', 'Asisten', 'Admin', '$2y$10$n1ZIbHQ/CiQ5X8cr/pP7PezZk2GiaiI/Dx/PUZsOTSq7FFATf.ekC', '', 'Aktif'),
('admin311012128304', '1', 'Sapitri', '1012128304', 'Perempuan', 'spitriap@eng.uir.ac.id', '085353399057', 'Asisten', 'Admin', '$2y$10$c4nNftSMHL8SlJn3xI5KheVmPPj7j6vPU9zNW0JTH2TtKwLUfK4E2', '', 'Aktif'),
('admin3200', '2', 'Furizal', '00', 'Laki-laki', 'furizal@gmail.com', '08', 'Asisten', 'Admin', '$2y$10$aDUvB..qfPOhdCGwScQbbeQFiKky3sawVSqcJWcG8/dpe3FlROIlq', '', 'Aktif'),
('admin341008108303', '4', 'Muhammad Sofwan', '1008108303', 'Laki-laki', 'muhammad.sofwan@eng.uir.ac.id', '081220070060', 'Asisten', 'Admin', '$2y$10$.wD2f6XWRZ321zdcNlTY6OPQj5Xw2op9BkH3Kqr7I2X4RXYE3H.9u', '', 'Aktif'),
('admin35000', '5', 'Furizal', '000', 'Laki-laki', 'tes@gmail.com', '082386092684', 'Asisten', 'Admin', '$2y$10$hrswuySPvUW2zqpQavO4mOGHrutHyf5JFbZeJVRLcN2cbvyaYEXrO', '', 'Aktif'),
('admin358989798', '5', 'Fadli', '8989798', 'Laki-laki', 'aa@gmail.com', '0823', 'Asisten', 'Admin', '$2y$10$FUcMr5870hWmvFoeqWoJn.BBNfJKl2M75a3sNtkMSSdJAFbXd01mK', '', 'Aktif'),
('superadmin31', '1', 'Muhammad', '', 'Laki-laki', 'tekniksipil@uir.ac.id', '', 'Ketua Program Studi', 'Super', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('superadmin32', '2', 'Perminyakan', '', 'Perempuan', 'teknikperminyakan@uir.ac.id', '', 'Ketua Program Studi', 'Super', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('superadmin33', '3', 'Mesin', '', 'Laki-laki', 'teknikmesin@uir.ac.id', '', 'Ketua Program Studi', 'Super', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('superadmin34', '4', 'Perencanaan Wilayah dan Kota', 'superadmin34', 'Perempuan', 'teknikplanologi@uir.ac.id', '', 'Ketua Program Studi', 'Super', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '20062021081625Brosur depan.jpg', 'Aktif'),
('superadmin35', '5', 'Dr. Apri Siswanto S.Kom M.Kom', 'superadmin35', 'Laki-laki', 'teknikinformatika@uir.ac.id', '124568', 'Ketua Program Studi', 'Super', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif'),
('superadmin36', '6', 'Geologi', '', 'Laki-laki', 'teknikgeologi@uir.ac.id', '', 'Ketua Program Studi', 'Super', '$2y$10$Ji7HbSE8Oj2LCXETY3h6w.IGkDu.Npcf4vZ0P9/8FTZ3OOdciicRG', '', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_request_pertemuan`
--

CREATE TABLE `tb_request_pertemuan` (
  `id_request_pertemuan` int(11) NOT NULL,
  `id_jadwal_kelas_pertemuan` int(11) NOT NULL,
  `dosen_penginput_request` char(50) NOT NULL,
  `pertemuan_ke` int(3) NOT NULL,
  `alasan_request_pertemuan` text NOT NULL,
  `waktu_request_pertemuan` datetime NOT NULL,
  `waktu_request_pertemuan_selesai` datetime NOT NULL,
  `waktu_input_request_pertemuan` datetime NOT NULL,
  `status_request_pertemuan` varchar(50) NOT NULL,
  `alasan_penolakan_request` text NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_request_pertemuan`
--

INSERT INTO `tb_request_pertemuan` (`id_request_pertemuan`, `id_jadwal_kelas_pertemuan`, `dosen_penginput_request`, `pertemuan_ke`, `alasan_request_pertemuan`, `waktu_request_pertemuan`, `waktu_request_pertemuan_selesai`, `waktu_input_request_pertemuan`, `status_request_pertemuan`, `alasan_penolakan_request`, `status`) VALUES
(32, 6, '', 1, 'Sakit', '2021-09-17 10:00:00', '2021-09-17 12:00:00', '2021-09-16 19:37:38', 'Disetujui', 'Alasannyanya kurang jelas', 'Tersedia'),
(33, 6, '', 1, 'Sakit di RS', '2021-09-16 10:00:00', '2021-09-16 12:00:00', '2021-09-16 19:41:12', 'Ditolak', 'Dajabj', 'Tersedia'),
(34, 6, '', 2, 'Seminar dilur kota', '2021-09-18 10:00:00', '2021-09-18 11:40:00', '2021-09-17 10:33:41', 'Disetujui', '', 'Tersedia'),
(35, 16, '55555555555', 1, 'Siangnya saya keluar kota', '2021-09-23 07:00:00', '2021-09-23 08:40:00', '2021-09-22 00:57:45', 'Disetujui', '', 'Tersedia'),
(36, 14, '55555555555', 2, 'ini alasan', '2021-10-01 15:57:00', '2021-10-01 16:57:00', '2021-09-30 14:57:17', 'Disetujui', 'yyy', 'Tersedia'),
(37, 18, '55555555555', 4, 'jbj', '2021-10-08 00:23:00', '2021-10-08 01:23:00', '2021-10-08 11:23:42', 'Disetujui', '', 'Tersedia'),
(38, 14, '55555555555', 2, 'fef', '2021-10-08 23:40:00', '2021-10-08 23:44:00', '2021-10-08 23:38:25', 'Minta Persetujuan', '', 'Dihapus'),
(39, 14, '55555555555', 2, 'ss', '2021-10-08 23:41:00', '2021-10-08 23:43:00', '2021-10-08 23:39:00', 'Disetujui', '', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ruang`
--

CREATE TABLE `tb_ruang` (
  `kode_ruang` char(30) NOT NULL,
  `kapasitas` int(5) NOT NULL,
  `kode_jurusan` char(20) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_ruang`
--

INSERT INTO `tb_ruang` (`kode_ruang`, `kapasitas`, `kode_jurusan`, `ket`) VALUES
('3A.01.08', 40, '5', '-'),
('3A.01.09', 45, '5', '-'),
('3A.01.10', 40, '5', ''),
('3A.01.11', 40, '5', '-'),
('3A.01.12', 40, '5', ''),
('3A.01.20', 30, '5', '20'),
('3C.02.02', 40, '2', ''),
('3C.02.05', 40, '5', '-'),
('3C.02.06', 35, '5', '-'),
('3C.02.07', 30, '5', ''),
('3E.01.01', 20, '5', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_semester`
--

CREATE TABLE `tb_semester` (
  `id_semester` int(11) NOT NULL,
  `id_tahun_ajaran` int(11) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_semester`
--

INSERT INTO `tb_semester` (`id_semester`, `id_tahun_ajaran`, `semester`, `status`) VALUES
(1, 1, 'Ganjil', 'Tersedia'),
(2, 2, 'Ganjil', 'Dihapus'),
(3, 1, 'Genap', 'Tersedia'),
(4, 2, 'Genap', 'Dihapus'),
(5, 2, 'Genap', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_surat_keputusan`
--

CREATE TABLE `tb_surat_keputusan` (
  `id_surat` int(5) NOT NULL,
  `nomor_surat` char(50) NOT NULL,
  `nama_surat` varchar(100) NOT NULL,
  `nama_dekan` varchar(50) NOT NULL,
  `npk` char(30) NOT NULL,
  `tanggal` date NOT NULL,
  `ket_ujian` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_surat_keputusan`
--

INSERT INTO `tb_surat_keputusan` (`id_surat`, `nomor_surat`, `nama_surat`, `nama_dekan`, `npk`, `tanggal`, `ket_ujian`, `status`) VALUES
(1, '1637/KPTS/FT-UIR/2020', 'Surat Keputusan Dekan Fakultas Teknik Universitas Islam Riau', 'Dr. Eng. Muslim, MT', '091102374', '2020-12-30', 'Daring', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tahun_ajaran`
--

CREATE TABLE `tb_tahun_ajaran` (
  `id_tahun_ajaran` int(11) NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tahun_ajaran`
--

INSERT INTO `tb_tahun_ajaran` (`id_tahun_ajaran`, `tahun_ajaran`, `status`) VALUES
(1, '2020/2021', 'Tersedia'),
(2, '2021/2022', 'Tersedia'),
(3, '2022/2023', 'Dihapus');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ttd_digital`
--

CREATE TABLE `tb_ttd_digital` (
  `id_ttd_digital` int(11) NOT NULL,
  `id_relasi` int(11) NOT NULL,
  `topik_relasi` text NOT NULL,
  `id_random` text NOT NULL,
  `waktu_input_ttd` datetime NOT NULL,
  `nama_penanda_tangan` varchar(100) NOT NULL,
  `jabatan_penanda_tangan` text NOT NULL,
  `perihal` text NOT NULL,
  `status_validasi` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_ttd_digital`
--

INSERT INTO `tb_ttd_digital` (`id_ttd_digital`, `id_relasi`, `topik_relasi`, `id_random`, `waktu_input_ttd`, `nama_penanda_tangan`, `jabatan_penanda_tangan`, `perihal`, `status_validasi`, `status`) VALUES
(1, 27, 'Presensi Pertemuan', 'iHbAIN70XhF8w6E1HITrK34659wQ5cL6JDW1mzuO5Yh25VP9QvCaMxr7kGGBCndjYRluoFc0sAlabMZ249EB7y3ZXODp01t4S337', '2021-09-10 11:35:35', 'Furizal', 'Dosen Pengampu Matakuliah', 'Pengisian Presensi Tatap Muka Dosen Pengampu Matakuliah', 'Tervalidasi', 'Tersedia'),
(3, 29, 'Presensi Pertemuan', 'u0LxGDnxAr3fNokF4M2W7XH8C7nRQ9mJ07U82b95jJ3Psl0Pe90gEoYXSRGamiLyO21h6IC7pu6B496vrkil5KTwp5cFM1KzT1N8', '2021-09-10 17:16:47', 'Furizal', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah  Pengantar Teknologi Informasi (Pertemuan Ke-4) Pada Semester Ganjil Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(4, 30, 'Presensi Pertemuan', 'KZkSPBDfsKLh7pwERPDNF6Zls70w83pm51T3dy80nb97nc35SVmOGFY9eC2tzoukiG9ar47vjAIl4og4za68Ui1YQuMbO2rB5g6A', '2021-09-14 10:48:38', 'Furizal', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah Bahasa Inggris II (Pertemuan Ke-5) Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(5, 31, 'Presensi Pertemuan', 'd8glfT19o0VO7nGZlpNmE85ec3tyLjMan6yr7Cb2JtWIPjMiqAwU9XBOY4HeKvZsU60ruk08DSNdhRECKzLq5RQmvg87k4x79103', '2021-09-15 21:28:38', 'Furizal', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah Bahasa Inggris II (Pertemuan Ke-6) Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(8, 10, 'Kelas Pertamuan (Persetujuan Laporan Presensi Oleh Ketua Program Studi)', 'QNOPdW4yceJE5NHqDPmubg0e9YVpLf8kk3gIpZ1MMclrRCA8OUU7drTnfCWoauvtDqLtVBBl7FhsAX025zEZK1a7j3hs6Y5vSw39', '2021-09-16 00:03:57', 'Dr. Arbi Haza Nasution, M.IT', 'Ketua Program Studi Teknik Informatika', 'Pengesahan Laporan Presensi Tatap Muka Matakuliah Logika Informatika yang diampu oleh NESI SYAFITRI  S.Kom.  M.Cs. Pada Semester Ganjil Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(9, 2, 'Kelas Pertamuan (Persetujuan Laporan Presensi Oleh Ketua Program Studi)', 'lYyCXnN8fTW9Z0j934OAGOmv5Gch12d7eBa0nEdubav4LmX657KQE1AQ2745UYfw8o3UzIc13y7sHxPNuKrj6g0kBbD8Li6IRMgt', '2021-09-16 00:28:43', 'Dr. Arbi Haza Nasution, M.IT', 'Ketua Program Studi Teknik Informatika', 'Pengesahan Laporan Presensi Tatap Muka Matakuliah Bahasa Inggris II yang diampu oleh Furizal Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(15, 2, 'Kelas Pertamuan (Persetujuan Laporan Presensi Oleh Wakil Dekan I)', 'J9XC963DEklqbQdJeA3A6rpHh5aHI413anzT2nyL0gZxhUuKEWjw2tB0j71U7MLOSB23rO824ksZF86eb8g7T5idXDMF4o9VfvuN', '2021-09-16 01:16:24', 'Dr. Mursyidah M.Sc', 'Wakil Dekan I Fakultas Teknik', 'Pengesahan Laporan Presensi Tatap Muka Matakuliah Bahasa Inggris II yang diampu oleh Furizal Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(16, 10, 'Kelas Pertamuan (Persetujuan Laporan Presensi Oleh Wakil Dekan I)', 'u9y4wCf9FG5HpK9LXJnWaE0r1lGVckIB2jhk14yo3bsCMw4AmhYqE3HaJDU1765ZecLTfSM83vR1eoQVW225P05l3O7IN6QixSsd', '2021-09-16 01:26:21', 'Dr. Mursyidah M.Sc', 'Wakil Dekan I Fakultas Teknik', 'Pengesahan Laporan Presensi Tatap Muka Matakuliah Logika Informatika yang diampu oleh NESI SYAFITRI  S.Kom.  M.Cs. Pada Semester Ganjil Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(17, 32, 'Presensi Pertemuan', 'WPR0PinB803Le179jfEOS73dAa05NU2a8Y4KdGY264g9XrkS9MoCf67eNq1VlZ1zycsWXlz4t6HuGOH86v5QqwE2DDIwRkbJC35F', '2021-09-16 19:48:46', 'Furizal', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah Bahasa Inggris II (Pertemuan Ke-1) Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(18, 8, 'Kelas Pertamuan (Persetujuan Laporan Presensi Oleh Ketua Program Studi)', 'AC4V7Nl3XkRJx7gHrpMI85Jvuy0cafH2mE9PnadTclWS41056epPZ7YK9hO6U3D6LyQCm6XVo2qsKW51uA4tfOs2r03thwzgYFiB', '2021-09-16 19:59:24', 'Dr. Arbi Haza Nasution, M.IT', 'Ketua Program Studi Teknik Informatika', 'Pengesahan Laporan Presensi Tatap Muka Matakuliah Bahasa Inggris II yang diampu oleh Furizal Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(19, 8, 'Kelas Pertamuan (Persetujuan Laporan Presensi Oleh Wakil Dekan I)', '6a3H5NOX2s9wp94VXN5T2e6fC3uKVYuUbb1my43O7B1AGiKkrQo0D8q4TLjR4BFlIdW71hw529nS9gz8c2LdkGxMhS5aPtJvpjqn', '2021-09-16 20:01:51', 'Dr. Mursyidah M.Sc', 'Wakil Dekan I Fakultas Teknik', 'Pengesahan Laporan Presensi Tatap Muka Matakuliah Bahasa Inggris II yang diampu oleh Furizal Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(20, 33, 'Presensi Pertemuan', 'SJ0xX5tLL30qlEE947I9J0zmbR5QhjAuPpoQMphbU26uZVoKF661HeVgWrnKctOTFdjZ2WR943CBNq80wrscyany9Xi6Ywk45CPe', '2021-09-17 10:02:06', 'Furizal', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah Bahasa Inggris II (Pertemuan Ke-1) Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(21, 34, 'Presensi Pertemuan', 'C91FrER6eMXzBc8b2owU2OA6dH0Fl4E9c8JmiDG5sC7qK6u6SVVLpxT7hIQg5I74UW0A7gnxjLW4n9Ryw1G8P0aZsY13t4hlT3z5', '2021-09-18 04:29:56', 'Furizal, M.Eng', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah Bahasa Inggris II (Pertemuan Ke-2) Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(22, 35, 'Presensi Pertemuan', 'pr8QBW12sX1d0H758qQjkK925bNgHYFk4yfoJZ4zSuISRCTD18P2mpoZU7Tr77l3sDbfu6MIGtecwLA6VxUJit89Ev3nx5CAGW9a', '2021-09-22 00:41:38', 'Furizal, M.Eng', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah  Pemrograman Web II (Pertemuan Ke-1) Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(23, 36, 'Presensi Pertemuan', 'TQ7YzCWwNAr9IxCa3P15W4Na8h5i9iRZDge6UXnLBmqg0o2Ld25y3O324HykYVnJQkISAhpHc31EPv6lpsremfO9wGd8v71T86D0', '2021-09-22 00:47:13', 'AKMAR EFENDI  S.Kom.  M.Kom.', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah  Pemrograman Web II (Pertemuan Ke-2) Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(24, 37, 'Presensi Pertemuan', 'y7nSO96O0GUTz54Ksq2WJrXYGkuX5a51mpopD0SBHhVZsit9boH48xv4I742eCt3RI3c8NL1zEvjnmFMfF0Ty2JQY50K3c92rg8b', '2021-09-25 10:29:19', 'AKMAR EFENDI  S.Kom.  M.Kom.', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah  Pemrograman Web II (Pertemuan Ke-1) Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(25, 38, 'Presensi Pertemuan', 'w935Y3c8ReA64z4hJU8r214DnGRiQyt709d0axIbT57ZPN26BpZsuXmQS7bY9eaWhv8Of6HqPHujz2BFCk8I24A5i9KVUyGW0Lt1', '2021-09-25 10:35:02', 'AKMAR EFENDI  S.Kom.  M.Kom.', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah  Pemrograman Web II (Pertemuan Ke-1) Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(26, 39, 'Presensi Pertemuan', 'r51QMkHkDBpTKucdiGxhg6XxuSgPcS8dVw2R6aLjL94lMU4yW2qIn2A1ltN5o03q0XiE0zIm935e7bYR81GO7EAOKUv6obFN7te3', '2021-09-25 10:35:02', 'AKMAR EFENDI  S.Kom.  M.Kom.', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah  Pemrograman Web II (Pertemuan Ke-1) Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(27, 40, 'Presensi Pertemuan', 'xRx9aJKQZQTgnz5d0mtV7462rLr9pGcMlUfW50FJ871yfhpZ2w5FwST3G4udS0NeDAj6cbi2VLHD8qYo8Y3elPRKqB0M7Obk6Pv7', '2021-09-25 10:36:15', 'Furizal, M.Eng', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah  Pemrograman Web II (Pertemuan Ke-2) Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(28, 41, 'Presensi Pertemuan', 'W5cG9QceOA75KJ9y98pss1bQfxV3bv0E5F20EDU4N68awjRim50j4qxh6i1SC16dMd7ZegHz10LDPJ9oFB2prkzTM8S83tUVYRtl', '2021-09-25 10:47:54', 'Furizal, M.Eng', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah  Pemrograman Web II (Pertemuan Ke-3) Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(29, 42, 'Presensi Pertemuan', '4I0W04P9KcTAJCPr08RL1koM92zXu5jVsJnbhCAad2pw72Qk69a62m38NDSyxvQVt3RcTfpBi7UZFe950Wg747D8U13bifHoGOue', '2021-09-25 10:48:30', 'Furizal, M.Eng', 'Dosen Pengampu Matakuliah', 'Presensi Tatap Muka Dosen Pengampu Matakuliah  Pemrograman Web II (Pertemuan Ke-2) Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(30, 7, 'Kelas Pertamuan (Persetujuan Laporan Presensi Oleh Ketua Program Studi)', 'xw61kXzKTtFA1Kpicq6C8of4Dv00IPE9nbM5J7rS9jv4ml9yytD31f25BZulhjG58ONcxQwgAnd1HWVbsp4qSeWXUJ76kiLo0Nha', '2021-09-25 16:26:07', 'Dr. Arbi Haza Nasution, M.IT', 'Ketua Program Studi Teknik Informatika', 'Pengesahan Laporan Presensi Tatap Muka Matakuliah Bahasa Inggris II yang diampu oleh Furizal, M.Eng Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(31, 6, 'Kelas Pertamuan (Persetujuan Laporan Presensi Oleh Ketua Program Studi)', '63SZ71ulCvgp4993W2wPNVYeASs9ANi4HhgRJEE5n80ZQfpD1m5TMrI0a4zYcx7kUk61OUJq5HaBtfoed68KGs3VyMnFt6d7ub5l', '2021-09-25 17:04:45', 'Dr. Arbi Haza Nasution, M.IT', 'Ketua Program Studi Teknik Informatika', 'Pengesahan Laporan Presensi Tatap Muka Matakuliah Bahasa Inggris II yang diampu oleh Furizal, M.Eng Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(32, 7, 'Kelas Pertamuan (Persetujuan Laporan Presensi Oleh Wakil Dekan I)', 'B4l4Odo30HsEqWZ6eHby0Mvkz57892pQIs9nlkG6112cDm77BUSUP1TaRMqyx37rfeKoi0GLtD4Xu6wA5LSN5znf32hhTc3Vb0V8', '2021-09-25 21:15:42', 'Dr. Mursyidah M.Sc', 'Wakil Dekan I Fakultas Teknik', 'Pengesahan Laporan Presensi Tatap Muka Matakuliah Bahasa Inggris II yang diampu oleh Furizal, M.Eng Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia'),
(33, 22, 'Kelas Pertamuan (Persetujuan Laporan Presensi Oleh Ketua Program Studi)', '96kLX152y040gDaBvj652E04e05uO87jyPYGVR9q73N13Cm6hxc9rzlU1Htm95ISkf7MPsBiCo7hHF6U4V8zrsbpiJ3NuOTnMEqn', '2022-01-20 23:10:08', 'Dr. Arbi Haza Nasution, M.IT', 'Ketua Program Studi Teknik Informatika', 'Pengesahan Laporan Presensi Tatap Muka Matakuliah  Pemrograman Web II yang diampu oleh Furizal, M.Eng Pada Semester Genap Tahun Ajaran 2021/2022', 'Tervalidasi', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tu`
--

CREATE TABLE `tb_tu` (
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `npk` char(30) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `no_hp` char(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hak_akses` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tu`
--

INSERT INTO `tb_tu` (`username`, `nama`, `npk`, `jenis_kelamin`, `no_hp`, `email`, `hak_akses`, `password`, `foto`, `status`) VALUES
('tu', 'Tata Usaha FT', '8', 'Laki-laki', '', 'tu@gmail.com', 'Super', '$2y$10$soObm/MUaauRZTXSqUZSYOAy1NXQ2X1EfnAjs8h5xl5m0G5oouzlG', '140220221539572.jpg', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tugas_pengampu`
--

CREATE TABLE `tb_tugas_pengampu` (
  `id_tugas_pengampu` int(11) NOT NULL,
  `id_jadwal_kelas_pertemuan` int(11) NOT NULL,
  `npk_tugas` char(50) NOT NULL,
  `kategori_tugas` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_tugas_pengampu`
--

INSERT INTO `tb_tugas_pengampu` (`id_tugas_pengampu`, `id_jadwal_kelas_pertemuan`, `npk_tugas`, `kategori_tugas`, `status`) VALUES
(1, 1, '', 'Tugas luar Biasa', 'Dihapus'),
(2, 2, '', 'Tugas Pokok', 'Dihapus'),
(3, 3, '', 'Tugas Pokok', 'Dihapus'),
(4, 4, '', 'Tugas Pokok', 'Tersedia'),
(5, 5, '', 'Tugas luar Biasa', 'Tersedia'),
(6, 6, '', 'Tugas Pokok', 'Dihapus'),
(7, 7, '', 'Tugas Pokok', 'Dihapus'),
(8, 8, '', 'Tugas luar Biasa', 'Dihapus'),
(9, 9, '', 'Tugas luar Biasa', 'Tersedia'),
(10, 10, '', 'Tugas Pokok', 'Dihapus'),
(11, 11, '', 'Tugas Pokok', 'Dihapus'),
(12, 12, '', 'Tugas Pokok', 'Dihapus'),
(13, 13, '', 'Tugas luar Biasa', 'Tersedia'),
(14, 14, '', 'Tugas Pokok', 'Dihapus'),
(15, 11, '', 'Tugas Pokok', 'Tersedia'),
(16, 2, '', 'Tugas Luar Biasa', 'Dihapus'),
(17, 17, '51008037703', 'Tugas Pokok', 'Tersedia'),
(18, 18, '55555555555', 'Tugas Pokok', 'Dihapus'),
(19, 17, '55555555555', 'Tugas Luar Biasa', 'Tersedia'),
(20, 2, '55555555555', 'Tugas Pokok', 'Tersedia'),
(21, 17, '51031126801', 'Tugas Pokok', 'Tersedia'),
(22, 3, '50009088102', 'Tugas Luar Biasa', 'Tersedia'),
(23, 18, '51008037703', 'Tugas Pokok', 'Tersedia'),
(24, 7, '55555555555', 'Tugas Pokok', 'Tersedia'),
(25, 18, '51031126801', 'Tugas Pokok', 'Tersedia'),
(26, 21, '', 'Tugas Pokok', 'Dihapus'),
(27, 19, '51007058402', 'Tugas Pokok', 'Tersedia'),
(28, 6, '55555555555', 'Tugas Luar Biasa', 'Tersedia'),
(29, 10, '50009088102', 'Tugas Pokok', 'Tersedia'),
(30, 8, '55555555555', 'Tugas Pokok', 'Tersedia'),
(31, 14, '55555555555', 'Tugas Luar Biasa', 'Tersedia'),
(32, 12, '51018088102', 'Tugas Luar Biasa', 'Tersedia'),
(33, 18, '55555555555', 'Tugas Pokok', 'Tersedia'),
(34, 22, '51031126801', 'Tugas Pokok', 'Dihapus'),
(35, 22, '51008037703', 'Tugas Pokok', 'Tersedia'),
(36, 22, '55555555555', 'Tugas Pokok', 'Tersedia'),
(37, 21, '51007058402', 'Tugas Pokok', 'Tersedia'),
(38, 22, '51031126801', 'Tugas Pokok', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ujian`
--

CREATE TABLE `tb_ujian` (
  `id_ujian` int(11) NOT NULL,
  `id_surat_keputusan` int(11) NOT NULL,
  `id_pertemuan` int(11) NOT NULL,
  `nama_ujian` varchar(50) NOT NULL,
  `range_mulai_ujian` datetime NOT NULL,
  `range_selesai_ujian` datetime NOT NULL,
  `file_tata_tertib` text NOT NULL,
  `file_sk_pengawas` text NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_ujian`
--

INSERT INTO `tb_ujian` (`id_ujian`, `id_surat_keputusan`, `id_pertemuan`, `nama_ujian`, `range_mulai_ujian`, `range_selesai_ujian`, `file_tata_tertib`, `file_sk_pengawas`, `status`) VALUES
(1, 1, 8, 'Ujian Tengah Semester', '2021-12-01 00:00:00', '2021-12-10 23:59:00', '17082021101836Surat undangan Maulid Nabi.pdf', '16082021211246Surat undangan musyawarah.pdf', 'Dihapus'),
(2, 1, 8, 'Ujian Akhir Semester', '2021-09-21 00:00:00', '2021-10-01 23:59:00', '', '', 'Dihapus'),
(3, 1, 9, 'Ujian Tengah Semester', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Dihapus'),
(4, 1, 9, 'Ujian Akhir Semester', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Dihapus'),
(5, 1, 9, 'Ujian Akhir Semester', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '17082021101817Surat undangan musyawarah.pdf', '', 'Dihapus'),
(6, 1, 9, 'Ujian Tengah Semester', '2021-11-01 00:00:00', '2021-11-20 23:59:00', '', '', 'Dihapus'),
(7, 1, 9, 'Ujian Akhir Semester', '2021-09-28 00:00:00', '2021-09-29 23:59:00', '', '', 'Dihapus'),
(8, 1, 9, 'Ujian Tengah Semester', '2021-11-28 00:00:00', '2021-12-01 23:59:00', '', '', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_upm`
--

CREATE TABLE `tb_upm` (
  `username` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `npk` char(30) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `no_hp` char(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hak_akses` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_upm`
--

INSERT INTO `tb_upm` (`username`, `nama`, `npk`, `jenis_kelamin`, `no_hp`, `email`, `hak_akses`, `password`, `foto`, `status`) VALUES
('upm', 'upm', '000', 'Laki-laki', '', 'ssss', 'Super', '$2y$10$1aWHudhDnyioRUX9CAPn5eZZFc6U/vKUmTPjR4BUlMT7iK543K8GW', '17062021091529pngtree-greeting-of-hari-raya-idul-fitri-1442-h-png-image_3112903.jpg', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_bimbingan`
--
ALTER TABLE `tbl_bimbingan`
  ADD PRIMARY KEY (`id_bimbingan`);

--
-- Indeks untuk tabel `tbl_bimbingan_skripsi`
--
ALTER TABLE `tbl_bimbingan_skripsi`
  ADD PRIMARY KEY (`id_bimbingan_skripsi`);

--
-- Indeks untuk tabel `tbl_dospem`
--
ALTER TABLE `tbl_dospem`
  ADD PRIMARY KEY (`id_dospem`);

--
-- Indeks untuk tabel `tbl_dospem_skripsi`
--
ALTER TABLE `tbl_dospem_skripsi`
  ADD PRIMARY KEY (`id_dospem_skripsi`);

--
-- Indeks untuk tabel `tbl_file_kp`
--
ALTER TABLE `tbl_file_kp`
  ADD PRIMARY KEY (`id_file_kp`);

--
-- Indeks untuk tabel `tbl_file_skripsi`
--
ALTER TABLE `tbl_file_skripsi`
  ADD PRIMARY KEY (`id_file_skripsi`);

--
-- Indeks untuk tabel `tbl_gkm`
--
ALTER TABLE `tbl_gkm`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `tbl_jenis_sk`
--
ALTER TABLE `tbl_jenis_sk`
  ADD PRIMARY KEY (`id_jenis_sk`);

--
-- Indeks untuk tabel `tbl_koordinator`
--
ALTER TABLE `tbl_koordinator`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`npm`);

--
-- Indeks untuk tabel `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `tbl_nilai_kompre`
--
ALTER TABLE `tbl_nilai_kompre`
  ADD PRIMARY KEY (`id_nilai_kompre`);

--
-- Indeks untuk tabel `tbl_nilai_sempro`
--
ALTER TABLE `tbl_nilai_sempro`
  ADD PRIMARY KEY (`id_nilai_sempro`);

--
-- Indeks untuk tabel `tbl_nomor_surat`
--
ALTER TABLE `tbl_nomor_surat`
  ADD PRIMARY KEY (`id_nomor_surat`);

--
-- Indeks untuk tabel `tbl_open_file`
--
ALTER TABLE `tbl_open_file`
  ADD PRIMARY KEY (`id_open_file`);

--
-- Indeks untuk tabel `tbl_open_file_kompre`
--
ALTER TABLE `tbl_open_file_kompre`
  ADD PRIMARY KEY (`id_open_file_kompre`);

--
-- Indeks untuk tabel `tbl_open_file_sempro`
--
ALTER TABLE `tbl_open_file_sempro`
  ADD PRIMARY KEY (`id_open_file_sempro`);

--
-- Indeks untuk tabel `tbl_open_file_skripsi`
--
ALTER TABLE `tbl_open_file_skripsi`
  ADD PRIMARY KEY (`id_open_file`);

--
-- Indeks untuk tabel `tbl_pembimbing_lapangan`
--
ALTER TABLE `tbl_pembimbing_lapangan`
  ADD PRIMARY KEY (`id_pembimbing_lapangan`);

--
-- Indeks untuk tabel `tbl_penguji_skripsi`
--
ALTER TABLE `tbl_penguji_skripsi`
  ADD PRIMARY KEY (`id_penguji_skripsi`);

--
-- Indeks untuk tabel `tbl_persetujuan_kompre`
--
ALTER TABLE `tbl_persetujuan_kompre`
  ADD PRIMARY KEY (`id_persetujuan_kompre`);

--
-- Indeks untuk tabel `tbl_persetujuan_sempro`
--
ALTER TABLE `tbl_persetujuan_sempro`
  ADD PRIMARY KEY (`id_persetujuan_sempro`);

--
-- Indeks untuk tabel `tbl_persetujuan_sk`
--
ALTER TABLE `tbl_persetujuan_sk`
  ADD PRIMARY KEY (`id_persetujuan_sk`);

--
-- Indeks untuk tabel `tbl_persetujuan_skripsi`
--
ALTER TABLE `tbl_persetujuan_skripsi`
  ADD PRIMARY KEY (`id_persetujuan_skripsi`);

--
-- Indeks untuk tabel `tbl_persetujuan_surat_pengantar`
--
ALTER TABLE `tbl_persetujuan_surat_pengantar`
  ADD PRIMARY KEY (`id_persetujuan_surat_pengantar`);

--
-- Indeks untuk tabel `tbl_persetujuan_surat_pengantar_penelitian`
--
ALTER TABLE `tbl_persetujuan_surat_pengantar_penelitian`
  ADD PRIMARY KEY (`id_persetujuan_surat_pengantar_penelitian`);

--
-- Indeks untuk tabel `tbl_persetujuan_usulan_pembimbing`
--
ALTER TABLE `tbl_persetujuan_usulan_pembimbing`
  ADD PRIMARY KEY (`id_persetujuan_usulan_pembimbing`);

--
-- Indeks untuk tabel `tbl_sanksi`
--
ALTER TABLE `tbl_sanksi`
  ADD PRIMARY KEY (`id_sanksi`);

--
-- Indeks untuk tabel `tbl_seminar`
--
ALTER TABLE `tbl_seminar`
  ADD PRIMARY KEY (`id_seminar`);

--
-- Indeks untuk tabel `tbl_skripsi`
--
ALTER TABLE `tbl_skripsi`
  ADD PRIMARY KEY (`id_skripsi`);

--
-- Indeks untuk tabel `tbl_surat_pengantar`
--
ALTER TABLE `tbl_surat_pengantar`
  ADD PRIMARY KEY (`id_surat_pengantar`);

--
-- Indeks untuk tabel `tbl_surat_pengantar_penelitian`
--
ALTER TABLE `tbl_surat_pengantar_penelitian`
  ADD PRIMARY KEY (`id_surat_pengantar_penelitian`);

--
-- Indeks untuk tabel `tbl_syarat_kompre`
--
ALTER TABLE `tbl_syarat_kompre`
  ADD PRIMARY KEY (`id_syarat_kompre`);

--
-- Indeks untuk tabel `tbl_syarat_sempro`
--
ALTER TABLE `tbl_syarat_sempro`
  ADD PRIMARY KEY (`id_syarat_sempro`);

--
-- Indeks untuk tabel `tbl_syarat_sk`
--
ALTER TABLE `tbl_syarat_sk`
  ADD PRIMARY KEY (`id_syarat_sk`);

--
-- Indeks untuk tabel `tbl_ttd_dospem`
--
ALTER TABLE `tbl_ttd_dospem`
  ADD PRIMARY KEY (`id_ttd_dospem`);

--
-- Indeks untuk tabel `tbl_ttd_surat`
--
ALTER TABLE `tbl_ttd_surat`
  ADD PRIMARY KEY (`id_ttd_surat`);

--
-- Indeks untuk tabel `tbl_usulan_pembimbing`
--
ALTER TABLE `tbl_usulan_pembimbing`
  ADD PRIMARY KEY (`id_usulan_pembimbing`);

--
-- Indeks untuk tabel `tb_berkas_pertemuan`
--
ALTER TABLE `tb_berkas_pertemuan`
  ADD PRIMARY KEY (`id_berkas_pertemuan`);

--
-- Indeks untuk tabel `tb_berkas_ujian_kelas`
--
ALTER TABLE `tb_berkas_ujian_kelas`
  ADD PRIMARY KEY (`id_berkas_ujian_kelas`);

--
-- Indeks untuk tabel `tb_dosen`
--
ALTER TABLE `tb_dosen`
  ADD PRIMARY KEY (`npk`);

--
-- Indeks untuk tabel `tb_dosen_lanjutan`
--
ALTER TABLE `tb_dosen_lanjutan`
  ADD PRIMARY KEY (`id_dosen_lanjutan`);

--
-- Indeks untuk tabel `tb_fakultas`
--
ALTER TABLE `tb_fakultas`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `tb_jadwal_kelas_pertemuan`
--
ALTER TABLE `tb_jadwal_kelas_pertemuan`
  ADD PRIMARY KEY (`id_jadwal_kelas_pertemuan`);

--
-- Indeks untuk tabel `tb_jadwal_libur_pertemuan`
--
ALTER TABLE `tb_jadwal_libur_pertemuan`
  ADD PRIMARY KEY (`id_jadwal_libur_pertemuan`);

--
-- Indeks untuk tabel `tb_jadwal_pengampu`
--
ALTER TABLE `tb_jadwal_pengampu`
  ADD PRIMARY KEY (`id_jadwal_pengampu`);

--
-- Indeks untuk tabel `tb_jadwal_ujian`
--
ALTER TABLE `tb_jadwal_ujian`
  ADD PRIMARY KEY (`id_jadwal_ujian`);

--
-- Indeks untuk tabel `tb_jadwal_ujian_lanjutan`
--
ALTER TABLE `tb_jadwal_ujian_lanjutan`
  ADD PRIMARY KEY (`id_jadwal_lanjutan`);

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_kuisioner`
--
ALTER TABLE `tb_kuisioner`
  ADD PRIMARY KEY (`id_kuisioner`);

--
-- Indeks untuk tabel `tb_log`
--
ALTER TABLE `tb_log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indeks untuk tabel `tb_matkul`
--
ALTER TABLE `tb_matkul`
  ADD PRIMARY KEY (`kode_mk`);

--
-- Indeks untuk tabel `tb_pertemuan`
--
ALTER TABLE `tb_pertemuan`
  ADD PRIMARY KEY (`id_pertemuan`);

--
-- Indeks untuk tabel `tb_presensi_pertemuan`
--
ALTER TABLE `tb_presensi_pertemuan`
  ADD PRIMARY KEY (`id_presensi_pertemuan`);

--
-- Indeks untuk tabel `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`kode_prodi`);

--
-- Indeks untuk tabel `tb_prodi_attribut`
--
ALTER TABLE `tb_prodi_attribut`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `tb_request_pertemuan`
--
ALTER TABLE `tb_request_pertemuan`
  ADD PRIMARY KEY (`id_request_pertemuan`);

--
-- Indeks untuk tabel `tb_ruang`
--
ALTER TABLE `tb_ruang`
  ADD PRIMARY KEY (`kode_ruang`);

--
-- Indeks untuk tabel `tb_semester`
--
ALTER TABLE `tb_semester`
  ADD PRIMARY KEY (`id_semester`);

--
-- Indeks untuk tabel `tb_surat_keputusan`
--
ALTER TABLE `tb_surat_keputusan`
  ADD PRIMARY KEY (`id_surat`);

--
-- Indeks untuk tabel `tb_tahun_ajaran`
--
ALTER TABLE `tb_tahun_ajaran`
  ADD PRIMARY KEY (`id_tahun_ajaran`);

--
-- Indeks untuk tabel `tb_ttd_digital`
--
ALTER TABLE `tb_ttd_digital`
  ADD PRIMARY KEY (`id_ttd_digital`);

--
-- Indeks untuk tabel `tb_tu`
--
ALTER TABLE `tb_tu`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `tb_tugas_pengampu`
--
ALTER TABLE `tb_tugas_pengampu`
  ADD PRIMARY KEY (`id_tugas_pengampu`);

--
-- Indeks untuk tabel `tb_ujian`
--
ALTER TABLE `tb_ujian`
  ADD PRIMARY KEY (`id_ujian`);

--
-- Indeks untuk tabel `tb_upm`
--
ALTER TABLE `tb_upm`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_bimbingan`
--
ALTER TABLE `tbl_bimbingan`
  MODIFY `id_bimbingan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT untuk tabel `tbl_bimbingan_skripsi`
--
ALTER TABLE `tbl_bimbingan_skripsi`
  MODIFY `id_bimbingan_skripsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT untuk tabel `tbl_dospem`
--
ALTER TABLE `tbl_dospem`
  MODIFY `id_dospem` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT untuk tabel `tbl_dospem_skripsi`
--
ALTER TABLE `tbl_dospem_skripsi`
  MODIFY `id_dospem_skripsi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `tbl_file_kp`
--
ALTER TABLE `tbl_file_kp`
  MODIFY `id_file_kp` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT untuk tabel `tbl_file_skripsi`
--
ALTER TABLE `tbl_file_skripsi`
  MODIFY `id_file_skripsi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT untuk tabel `tbl_jenis_sk`
--
ALTER TABLE `tbl_jenis_sk`
  MODIFY `id_jenis_sk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_nilai`
--
ALTER TABLE `tbl_nilai`
  MODIFY `id_nilai` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT untuk tabel `tbl_nilai_kompre`
--
ALTER TABLE `tbl_nilai_kompre`
  MODIFY `id_nilai_kompre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT untuk tabel `tbl_nilai_sempro`
--
ALTER TABLE `tbl_nilai_sempro`
  MODIFY `id_nilai_sempro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT untuk tabel `tbl_nomor_surat`
--
ALTER TABLE `tbl_nomor_surat`
  MODIFY `id_nomor_surat` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=465;

--
-- AUTO_INCREMENT untuk tabel `tbl_open_file`
--
ALTER TABLE `tbl_open_file`
  MODIFY `id_open_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;

--
-- AUTO_INCREMENT untuk tabel `tbl_open_file_kompre`
--
ALTER TABLE `tbl_open_file_kompre`
  MODIFY `id_open_file_kompre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT untuk tabel `tbl_open_file_sempro`
--
ALTER TABLE `tbl_open_file_sempro`
  MODIFY `id_open_file_sempro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT untuk tabel `tbl_open_file_skripsi`
--
ALTER TABLE `tbl_open_file_skripsi`
  MODIFY `id_open_file` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembimbing_lapangan`
--
ALTER TABLE `tbl_pembimbing_lapangan`
  MODIFY `id_pembimbing_lapangan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT untuk tabel `tbl_penguji_skripsi`
--
ALTER TABLE `tbl_penguji_skripsi`
  MODIFY `id_penguji_skripsi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT untuk tabel `tbl_persetujuan_kompre`
--
ALTER TABLE `tbl_persetujuan_kompre`
  MODIFY `id_persetujuan_kompre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT untuk tabel `tbl_persetujuan_sempro`
--
ALTER TABLE `tbl_persetujuan_sempro`
  MODIFY `id_persetujuan_sempro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT untuk tabel `tbl_persetujuan_sk`
--
ALTER TABLE `tbl_persetujuan_sk`
  MODIFY `id_persetujuan_sk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=789;

--
-- AUTO_INCREMENT untuk tabel `tbl_persetujuan_skripsi`
--
ALTER TABLE `tbl_persetujuan_skripsi`
  MODIFY `id_persetujuan_skripsi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT untuk tabel `tbl_persetujuan_surat_pengantar`
--
ALTER TABLE `tbl_persetujuan_surat_pengantar`
  MODIFY `id_persetujuan_surat_pengantar` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=291;

--
-- AUTO_INCREMENT untuk tabel `tbl_persetujuan_surat_pengantar_penelitian`
--
ALTER TABLE `tbl_persetujuan_surat_pengantar_penelitian`
  MODIFY `id_persetujuan_surat_pengantar_penelitian` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `tbl_persetujuan_usulan_pembimbing`
--
ALTER TABLE `tbl_persetujuan_usulan_pembimbing`
  MODIFY `id_persetujuan_usulan_pembimbing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT untuk tabel `tbl_sanksi`
--
ALTER TABLE `tbl_sanksi`
  MODIFY `id_sanksi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_seminar`
--
ALTER TABLE `tbl_seminar`
  MODIFY `id_seminar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_skripsi`
--
ALTER TABLE `tbl_skripsi`
  MODIFY `id_skripsi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_pengantar`
--
ALTER TABLE `tbl_surat_pengantar`
  MODIFY `id_surat_pengantar` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT untuk tabel `tbl_surat_pengantar_penelitian`
--
ALTER TABLE `tbl_surat_pengantar_penelitian`
  MODIFY `id_surat_pengantar_penelitian` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `tbl_syarat_kompre`
--
ALTER TABLE `tbl_syarat_kompre`
  MODIFY `id_syarat_kompre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tbl_syarat_sempro`
--
ALTER TABLE `tbl_syarat_sempro`
  MODIFY `id_syarat_sempro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tbl_syarat_sk`
--
ALTER TABLE `tbl_syarat_sk`
  MODIFY `id_syarat_sk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT untuk tabel `tbl_ttd_dospem`
--
ALTER TABLE `tbl_ttd_dospem`
  MODIFY `id_ttd_dospem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=466;

--
-- AUTO_INCREMENT untuk tabel `tbl_ttd_surat`
--
ALTER TABLE `tbl_ttd_surat`
  MODIFY `id_ttd_surat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=458;

--
-- AUTO_INCREMENT untuk tabel `tbl_usulan_pembimbing`
--
ALTER TABLE `tbl_usulan_pembimbing`
  MODIFY `id_usulan_pembimbing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=173;

--
-- AUTO_INCREMENT untuk tabel `tb_berkas_pertemuan`
--
ALTER TABLE `tb_berkas_pertemuan`
  MODIFY `id_berkas_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tb_berkas_ujian_kelas`
--
ALTER TABLE `tb_berkas_ujian_kelas`
  MODIFY `id_berkas_ujian_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_dosen_lanjutan`
--
ALTER TABLE `tb_dosen_lanjutan`
  MODIFY `id_dosen_lanjutan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT untuk tabel `tb_jadwal_kelas_pertemuan`
--
ALTER TABLE `tb_jadwal_kelas_pertemuan`
  MODIFY `id_jadwal_kelas_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tb_jadwal_libur_pertemuan`
--
ALTER TABLE `tb_jadwal_libur_pertemuan`
  MODIFY `id_jadwal_libur_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_jadwal_pengampu`
--
ALTER TABLE `tb_jadwal_pengampu`
  MODIFY `id_jadwal_pengampu` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT untuk tabel `tb_jadwal_ujian`
--
ALTER TABLE `tb_jadwal_ujian`
  MODIFY `id_jadwal_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_jadwal_ujian_lanjutan`
--
ALTER TABLE `tb_jadwal_ujian_lanjutan`
  MODIFY `id_jadwal_lanjutan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;

--
-- AUTO_INCREMENT untuk tabel `tb_kuisioner`
--
ALTER TABLE `tb_kuisioner`
  MODIFY `id_kuisioner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_log`
--
ALTER TABLE `tb_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1512;

--
-- AUTO_INCREMENT untuk tabel `tb_pertemuan`
--
ALTER TABLE `tb_pertemuan`
  MODIFY `id_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tb_presensi_pertemuan`
--
ALTER TABLE `tb_presensi_pertemuan`
  MODIFY `id_presensi_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `tb_request_pertemuan`
--
ALTER TABLE `tb_request_pertemuan`
  MODIFY `id_request_pertemuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `tb_semester`
--
ALTER TABLE `tb_semester`
  MODIFY `id_semester` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_surat_keputusan`
--
ALTER TABLE `tb_surat_keputusan`
  MODIFY `id_surat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_tahun_ajaran`
--
ALTER TABLE `tb_tahun_ajaran`
  MODIFY `id_tahun_ajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_ttd_digital`
--
ALTER TABLE `tb_ttd_digital`
  MODIFY `id_ttd_digital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tb_tugas_pengampu`
--
ALTER TABLE `tb_tugas_pengampu`
  MODIFY `id_tugas_pengampu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `tb_ujian`
--
ALTER TABLE `tb_ujian`
  MODIFY `id_ujian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
