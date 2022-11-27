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
  `kategori_moa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tingkat_moa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_kegiatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manfaat_kegiatan` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_awal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `dosen_terlibat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_ia` */

insert  into `tbl_ia`(`id`,`moa_id`,`kategori_moa`,`tingkat_moa`,`judul_kegiatan`,`manfaat_kegiatan`,`tanggal_awal`,`tanggal_akhir`,`dosen_terlibat`,`dokumen1`,`dokumen2`,`dokumen3`) values (1,1,'Pendidikan/Pengajaran','Wilayah','Judul Kegiatan','bnkjhblo','2022-11-19','2022-12-04','41030127104#21011088304',NULL,NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
