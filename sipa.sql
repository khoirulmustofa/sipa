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
  `tingkat_ia` varchar(255) DEFAULT NULL,
  `judul_kegiatan_ia` text DEFAULT NULL,
  `manfaat_kegiatan_ia` text DEFAULT NULL,
  `tanggal_awal_ia` date DEFAULT NULL,
  `tanggal_akhir_ia` date DEFAULT NULL,
  `waktu_buat` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_ia` */

insert  into `tbl_ia`(`id`,`moa_lembaga_mitra_id`,`tingkat_ia`,`judul_kegiatan_ia`,`manfaat_kegiatan_ia`,`tanggal_awal_ia`,`tanggal_akhir_ia`,`waktu_buat`) values (2,26,'Wilayah','Judul Kegiatan','Judul Kegiatan','2022-12-01','2022-12-19','2022-12-19 20:43:12'),(3,23,'Internasional','Macan Asia','Haha','2022-12-20','2022-12-31','2022-12-20 19:13:52');

/*Table structure for table `tbl_ia_dokumen` */

DROP TABLE IF EXISTS `tbl_ia_dokumen`;

CREATE TABLE `tbl_ia_dokumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ia_id` bigint(20) DEFAULT NULL,
  `jenis_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_dokumen` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_ia_dokumen` */

insert  into `tbl_ia_dokumen`(`id`,`ia_id`,`jenis_dokumen`,`file_dokumen`,`nama_file`) values (1,1,'Absensi','doc_ia_20221215055135.png',''),(2,1,'Materi','doc_ia_202212150551351.png',''),(3,2,'Absensi','doc_ia_20221219084312.png',''),(4,3,'Surat','doc_ia_20221220071352.pdf','12345'),(5,3,'Foto','doc_ia_20221220071352.jpg','');

/*Table structure for table `tbl_ia_dosen` */

DROP TABLE IF EXISTS `tbl_ia_dosen`;

CREATE TABLE `tbl_ia_dosen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ia_id` bigint(20) DEFAULT NULL,
  `npk` char(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_ia_dosen` */

insert  into `tbl_ia_dosen`(`id`,`ia_id`,`npk`) values (1,1,'61023099301'),(2,1,'51024077901'),(11,2,'51031126801'),(12,2,'28820423419'),(13,2,'11013066803'),(14,2,'51018088102'),(15,3,'51024077901'),(16,3,'51018088102');

/*Table structure for table `tbl_ia_dosen_luar_biasa` */

DROP TABLE IF EXISTS `tbl_ia_dosen_luar_biasa`;

CREATE TABLE `tbl_ia_dosen_luar_biasa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ia_id` bigint(20) DEFAULT NULL,
  `nama_dosen_luar_biasa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_ia_dosen_luar_biasa` */

insert  into `tbl_ia_dosen_luar_biasa`(`id`,`ia_id`,`nama_dosen_luar_biasa`) values (1,1,'Dosen Luar Biasa 1'),(2,1,'Dosen Luar Biasa 2'),(11,2,'Dosen Luar Biasa 1'),(12,2,'Dosen Luar Biasa 1'),(13,2,'Dosen Luar Biasa 1'),(14,2,'Dosen Luar Biasa 1'),(15,3,'jdjsjd');

/*Table structure for table `tbl_ia_kategori` */

DROP TABLE IF EXISTS `tbl_ia_kategori`;

CREATE TABLE `tbl_ia_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ia_id` bigint(20) DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_ia_kategori` */

insert  into `tbl_ia_kategori`(`id`,`ia_id`,`kategori`) values (10,2,'Pendidikan/Pengajaran'),(11,2,'Penelitian'),(12,2,'Pengabdian Masyarakat'),(13,3,'Pendidikan/Pengajaran'),(14,3,'Penelitian');

/*Table structure for table `tbl_ia_mahasiswa` */

DROP TABLE IF EXISTS `tbl_ia_mahasiswa`;

CREATE TABLE `tbl_ia_mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ia_id` bigint(20) DEFAULT NULL,
  `nama_mahasiswa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_ia_mahasiswa` */

insert  into `tbl_ia_mahasiswa`(`id`,`ia_id`,`nama_mahasiswa`) values (1,1,'Mahasiswa 1'),(2,1,'Mahasiswa 2'),(11,2,'Mahasiswa 1'),(12,2,'Mahasiswa 1'),(13,2,'Mahasiswa 1'),(14,2,'Mahasiswa 1'),(15,3,'xjajdj');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_moa` */

insert  into `tbl_moa`(`id`,`mou_id`,`tingkat_moa`,`tanggal_moa`,`periode`,`negara_id`,`provinsi_id`,`kota_kabupaten_id`,`kecamatan_id`,`kelurahan_id`,`alamat_moa`,`tanggal_akhir_moa`,`waktu_buat`) values (1,11,'Nasional','2022-12-01',1,2,'','','','','Alamat','2023-01-08',NULL),(2,15,'Internasional','2022-12-13',1,4,'','','','','xx','2022-12-31','2022-12-13 21:53:43'),(3,14,'Internasional','2022-12-16',1,9,'','','','','Jl. Pisang','2022-12-31','2022-12-16 13:49:20'),(4,11,'Internasional','2022-12-20',1,4,'','','','','cc','2022-12-31','2022-12-20 05:46:28');

/*Table structure for table `tbl_moa_dokumen` */

DROP TABLE IF EXISTS `tbl_moa_dokumen`;

CREATE TABLE `tbl_moa_dokumen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moa_id` bigint(20) DEFAULT NULL,
  `jenis_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_dokumen` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_moa_dokumen` */

insert  into `tbl_moa_dokumen`(`id`,`moa_id`,`jenis_dokumen`,`file_dokumen`,`nama_file`) values (7,1,'Absensi','doc1_20221213094224.png',''),(8,1,'Absensi','doc1_202212130942241.png',''),(9,2,'Jurnal','doc1_20221213095343.pdf',''),(10,3,'Absensi','doc1_20221216014920.pdf','11111'),(11,4,'Surat','doc1_20221220054628.pdf','PM-12318'),(12,4,'Jurnal','doc1_202212200546281.pdf','');

/*Table structure for table `tbl_moa_kategori` */

DROP TABLE IF EXISTS `tbl_moa_kategori`;

CREATE TABLE `tbl_moa_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moa_id` bigint(20) DEFAULT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_moa_kategori` */

insert  into `tbl_moa_kategori`(`id`,`moa_id`,`kategori`) values (24,1,'Penelitian'),(25,1,'Pengabdian Masyarakat'),(26,2,'Penelitian'),(27,3,'Pendidikan/Pengajaran'),(28,4,'Pendidikan/Pengajaran'),(29,4,'Pengabdian Masyarakat');

/*Table structure for table `tbl_moa_lembaga` */

DROP TABLE IF EXISTS `tbl_moa_lembaga`;

CREATE TABLE `tbl_moa_lembaga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moa_id` bigint(20) DEFAULT NULL,
  `nama_lembaga` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_moa_lembaga` */

/*Table structure for table `tbl_moa_lembaga_mitra` */

DROP TABLE IF EXISTS `tbl_moa_lembaga_mitra`;

CREATE TABLE `tbl_moa_lembaga_mitra` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moa_id` bigint(20) DEFAULT NULL,
  `nama_lembaga_mitra` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_moa_lembaga_mitra` */

insert  into `tbl_moa_lembaga_mitra`(`id`,`moa_id`,`nama_lembaga_mitra`) values (23,1,'Nama Lembaga Mitra 1'),(24,1,'Nama Lembaga Mitra 4'),(25,2,'dd'),(26,3,'CV. Hartono'),(27,4,'cx');

/*Table structure for table `tbl_moa_prodi` */

DROP TABLE IF EXISTS `tbl_moa_prodi`;

CREATE TABLE `tbl_moa_prodi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moa_id` bigint(20) DEFAULT NULL,
  `kode_prodi` char(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_moa_prodi` */

insert  into `tbl_moa_prodi`(`id`,`moa_id`,`kode_prodi`) values (34,1,'5'),(35,1,'3'),(36,1,'2'),(37,2,'6'),(38,2,'5'),(39,3,'6'),(40,3,'5'),(41,3,'3'),(42,4,'6'),(43,4,'5');

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

/*Data for the table `tbl_mou` */

insert  into `tbl_mou`(`id`,`periode`,`tanggal`,`nama_lembaga_mitra`,`negara_id`,`provinsi_id`,`kota_kabupaten_id`,`kecamatan_id`,`kelurahan_id`,`alamat`,`durasi`,`tanggal_akhir`,`dokumen`,`status`,`created_at`,`updated_at`) values (11,1,'2022-12-04','PT PERTAMINA',102,'31','31.71','31.71.03','31.71.03.1003','Jl. Nirwana No 25',1,'2023-12-04','doc__mou_20221204101003.pdf',1,'2022-12-04 10:10:03','2022-12-04 10:10:03'),(12,1,'2013-12-07','PT PERTAMINA',102,'14','14.05','14.05.07','14.05.07.2003','sfsfsff',1,'2014-12-07','doc__mou_20221207070003.png',1,'2022-12-07 07:00:03','2022-12-07 07:00:03'),(13,1,'2022-01-07','PT. Angkasa Jaya',102,'34','34.02','34.02.04','34.02.04.2002','Jl . Malakan No 2',1,'2023-01-07','doc__mou_20221207121618.pdf',1,'2022-12-07 12:16:18','2022-12-07 12:16:18'),(14,1,'2022-12-07','CV. Angkasa Jaya',102,'14','14.05','14.05.01','14.05.01.2005','Jl. Patriot',3,'2025-12-07','doc__mou_20221207063022.pdf',1,'2022-12-07 18:30:22','2022-12-07 18:30:22'),(15,1,'2021-01-20','PT. Abdi Perkasa',102,'34','34.01','34.01.07','34.01.07.2004','Jl. Waluyo',2,'2023-01-20','doc__mou_20221207063136.pdf',1,'2022-12-07 18:31:36','2022-12-07 18:31:36'),(16,1,'2020-07-07','Universitas Padjajaran',102,'32','32.01','32.01.08','32.01.08.2004','Jl. Ceunah',1,'2021-07-07','doc__mou_20221207063253.pdf',1,'2022-12-07 18:32:53','2022-12-07 18:32:53');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
