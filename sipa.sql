/*
SQLyog Ultimate
MySQL - 10.4.12-MariaDB-log : Database - sisfo-bkn
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tbl_ia` */

DROP TABLE IF EXISTS `tbl_ia`;

CREATE TABLE `tbl_ia` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `moa_id` bigint(20) DEFAULT NULL,
  `kategori_ia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tingkat_ia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_kegiatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manfaat_kegiatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_awal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `dosen_terlibat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tbl_moa` */

DROP TABLE IF EXISTS `tbl_moa`;

CREATE TABLE `tbl_moa` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mou_id` bigint(20) DEFAULT NULL,
  `kategori_moa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tingkat_moa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_moa` date DEFAULT NULL,
  `nama_lembaga_mitra_moa` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `negara_id` int(11) DEFAULT NULL,
  `provinsi_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_kabupaten_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_moa` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_akhir_moa` date DEFAULT NULL,
  `dokumen1_moa` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen2_moa` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen3_moa` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_dokumen1_moa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_dokumen2_moa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_dokumen3_moa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_prodi` text CHARACTER SET utf8mb4 DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `mou_id` (`mou_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tbl_mou` */

DROP TABLE IF EXISTS `tbl_mou`;

CREATE TABLE `tbl_mou` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `periode` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `nama_lembaga_mitra` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `negara_id` int(11) DEFAULT NULL,
  `provinsi_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_kabupaten_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `dokumen` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
