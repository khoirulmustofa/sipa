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
  `moa_lembaga_mitra_id` int(11) DEFAULT NULL,
  `kategori_ia` varchar(255) DEFAULT NULL,
  `tingkat_ia` varchar(255) DEFAULT NULL,
  `judul_kegiatan_ia` text DEFAULT NULL,
  `manfaat_kegiatan_ia` text DEFAULT NULL,
  `tanggal_awal_ia` date DEFAULT NULL,
  `tanggal_akhir_ia` date DEFAULT NULL,
  `waktu_buat` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `tbl_ia_dokumen` */

DROP TABLE IF EXISTS `tbl_ia_dokumen`;

CREATE TABLE `tbl_ia_dokumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ia_id` bigint(20) DEFAULT NULL,
  `jenis_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_dokumen` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tbl_ia_dosen` */

DROP TABLE IF EXISTS `tbl_ia_dosen`;

CREATE TABLE `tbl_ia_dosen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ia_id` bigint(20) DEFAULT NULL,
  `npk` char(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `tbl_ia_dosen_luar_biasa` */

DROP TABLE IF EXISTS `tbl_ia_dosen_luar_biasa`;

CREATE TABLE `tbl_ia_dosen_luar_biasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ia_id` bigint(20) DEFAULT NULL,
  `nama_dosen_luar_biasa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tbl_ia_mahasiswa` */

DROP TABLE IF EXISTS `tbl_ia_mahasiswa`;

CREATE TABLE `tbl_ia_mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ia_id` bigint(20) DEFAULT NULL,
  `nama_mahasiswa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tbl_moa` */

DROP TABLE IF EXISTS `tbl_moa`;

CREATE TABLE `tbl_moa` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mou_id` bigint(20) DEFAULT NULL,
  `tingkat_moa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_moa` date DEFAULT NULL,
  `periode` int(11) DEFAULT NULL,
  `negara_id` int(11) DEFAULT NULL,
  `provinsi_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_kabupaten_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_moa` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_akhir_moa` date DEFAULT NULL,
  `waktu_buat` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mou_id` (`mou_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tbl_moa_dokumen` */

DROP TABLE IF EXISTS `tbl_moa_dokumen`;

CREATE TABLE `tbl_moa_dokumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moa_id` bigint(20) DEFAULT NULL,
  `jenis_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_dokumen` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tbl_moa_kategori` */

DROP TABLE IF EXISTS `tbl_moa_kategori`;

CREATE TABLE `tbl_moa_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moa_id` bigint(20) DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tbl_moa_lembaga` */

DROP TABLE IF EXISTS `tbl_moa_lembaga`;

CREATE TABLE `tbl_moa_lembaga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moa_id` bigint(20) DEFAULT NULL,
  `nama_lembaga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `tbl_moa_lembaga_mitra` */

DROP TABLE IF EXISTS `tbl_moa_lembaga_mitra`;

CREATE TABLE `tbl_moa_lembaga_mitra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moa_id` bigint(20) DEFAULT NULL,
  `nama_lembaga_mitra` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

/*Table structure for table `tbl_moa_prodi` */

DROP TABLE IF EXISTS `tbl_moa_prodi`;

CREATE TABLE `tbl_moa_prodi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moa_id` bigint(20) DEFAULT NULL,
  `kode_prodi` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
