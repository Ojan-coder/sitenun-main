/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - sitenun
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sitenun` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `sitenun`;

/*Table structure for table `kota` */

DROP TABLE IF EXISTS `kota`;

CREATE TABLE `kota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namakota` varchar(50) DEFAULT NULL,
  `provinsi` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kota` */

insert  into `kota`(`id`,`namakota`,`provinsi`) values 
(1,'Banda Aceh','Aceh'),
(2,'Langsa','Aceh'),
(3,'Lhokseumawe','Aceh'),
(4,'Subulussalam','Aceh'),
(5,'Denpasar','Bali'),
(6,'Pangkal Pinang','Bangka Belitung'),
(7,'Cilegon','Banten'),
(8,'Serang','Banten'),
(9,'Tangerang Selatan','Banten'),
(10,'Tangerang','Banten'),
(11,'Bengkulu','Bengkulu'),
(12,'Yogyakarta','Daerah Istimewa Yogyakarta'),
(13,'Gorontalo','Gorontalo'),
(14,'Jakarta Barata','DKI Jakarta'),
(15,'Jakarta Pusat','DKI Jakarta'),
(16,'Jakarta Selatan','DKI Jakarta'),
(17,'Jakarta Timur','DKI Jakarta'),
(18,'Jakarta Utara','DKI Jakarta'),
(19,'Sungai Penuh','Jambi'),
(20,'Jambi','Jambi'),
(21,'Bandung','Jawa Barat'),
(22,'Bekasi','Jawa Barat'),
(23,'Bogor','Jawa Barat'),
(24,'Cimahi','Jawa Barat'),
(25,'Cirebon','Jawa Barat'),
(26,'Depok','Jawa Barat'),
(27,'Sukabumi','Jawa Barat'),
(28,'Tasikmalaya','Jawa Barat'),
(29,'Banjar','Jawa Barat'),
(30,'Magelang','Jawa Tengah'),
(31,'Pekalongan','Jawa Tengah'),
(32,'Salatiga','Jawa Tengah'),
(33,'Semaran','Jawa Tengah'),
(34,'Surakarta','Jawa Tengah'),
(35,'Tegal','Jawa Tengah'),
(36,'Batu','Jawa Timur'),
(37,'Blitar','Jawa Timur'),
(38,'Kediri','Jawa Timur'),
(39,'Madiun','Jawa Timur'),
(40,'Malang','Jawa Timur'),
(41,'Mojokerto','Jawa Timur'),
(42,'Pasuruan','Jawa Timur'),
(43,'Probolinggo','Jawa Timur'),
(44,'Surabaya','Jawa Timur'),
(45,'Pontianak','Kalimantan Barat'),
(46,'Singkawang','Kalimantan Barat'),
(47,'Banjarbaru','Kalimantan Selatan'),
(48,'Banjarmasin','Kalimantan Selatan'),
(49,'Palangkaraya','Kalimantan Tengah'),
(50,'Balikpapan','Kalimantan Timur'),
(51,'Bontang','Kalimantan Timur'),
(52,'Samarinda','Kalimantan Timur'),
(53,'Tarakan','Kalimantan Utara'),
(54,'Batam','Kepulauan Riau'),
(55,'Tanjungpinang','Kepulauan Riau'),
(56,'Bandar Lampung','Lampung'),
(57,'Metro','Lampung'),
(58,'Ternate','Maluku Utara'),
(59,'Tidoro Kepulauan','Maluku Utara'),
(60,'Ambon','Maluku'),
(61,'Tual','Maluku'),
(62,'Bima','Nusa Tenggara Barat'),
(63,'Mataram','Nusa Tenggara Barat'),
(64,'Kupang','Nusa Tenggara Timur'),
(65,'Sorong','Papua Barat'),
(66,'Jayapura','Papua'),
(67,'Dumai','Riau'),
(68,'Pekanbaru','Riau'),
(69,'Makasar','Sulawesi Selatan'),
(70,'Palopo','Sulawesi Selatan'),
(71,'Parepare','Sulawesi Selatan'),
(72,'Palu','Sulawesi Tengah'),
(73,'Baubau','Sulawesi Tenggara'),
(74,'Kendari','Sulawesi Tenggara'),
(75,'Bitung','Sulawesi Utara'),
(76,'Kotamobagu','Sulawesi Utara'),
(77,'Manado','Sulawesi Utara'),
(78,'Tomohon','Sulawesi Utara'),
(79,'Bukittinggi','Sumatera Barat'),
(80,'Padang','Sumatera Barat'),
(81,'Padang Panjang','Sumatera Barat'),
(82,'Pariaman','Sumatera Barat'),
(83,'Payakumbuh','Sumatera Barat'),
(84,'Sawahlunto','Sumatera Barat'),
(85,'Solok','Sumatera Barat'),
(86,'Lubuklinggau','Sumatera Selatan'),
(87,'Pagar Alam','Sumatera Selatan'),
(88,'Palembang','Sumatera Selatan'),
(89,'Prabumulih','Sumatera Selatan'),
(90,'Sekayu','Sumatera Selatan'),
(91,'Binjai','Sumatera Utara'),
(92,'Gunungsitoli','Sumatera Utara'),
(93,'Medan','Sumatera Utara'),
(94,'Padang Sidempuan','Sumatera Utara'),
(95,'Pematangsiantar','Sumatera Utara'),
(96,'Sibolga','Sumatera Utara'),
(97,'Tanjungbalai','Sumatera Utara'),
(98,'Tebing Tinggi','Sumatera Utara');

/*Table structure for table `level_user` */

DROP TABLE IF EXISTS `level_user`;

CREATE TABLE `level_user` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `level_user` */

insert  into `level_user`(`id_level`,`nama_level`) values 
(1,'Super Admin'),
(2,'Pimpinan'),
(3,'Produksi'),
(4,'Pelanggan');

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `kodepelanggan` char(7) NOT NULL,
  `namapelanggan` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `kodejenkel` char(5) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `notelp` char(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kodepelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`kodepelanggan`,`namapelanggan`,`tgl_lahir`,`kodejenkel`,`alamat`,`notelp`,`created_at`,`updated_at`) values 
('PR-01','Sesmita','2000-04-14','P','Jln.Olo Ladang No.9','0813323423','2023-06-10 22:54:04',NULL);

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `kodeproduk` char(7) NOT NULL,
  `namaproduk` varchar(100) DEFAULT NULL,
  `deskripsiproduk` text DEFAULT NULL,
  `hargaproduk` int(11) DEFAULT NULL,
  `jumlahproduk` int(11) DEFAULT NULL,
  `gambarproduk` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kodeproduk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `produk` */

insert  into `produk`(`kodeproduk`,`namaproduk`,`deskripsiproduk`,`hargaproduk`,`jumlahproduk`,`gambarproduk`,`created_at`,`updated_at`) values 
('PR-01','Tenun Pandai Singkek','Kain tenun terbuat dari',10000,10,'image.png','2023-06-10 21:00:49','2023-06-14 03:32:18');

/*Table structure for table `tbl_jeniskelamin` */

DROP TABLE IF EXISTS `tbl_jeniskelamin`;

CREATE TABLE `tbl_jeniskelamin` (
  `kode_jenkel` char(5) NOT NULL,
  `jenis_kelamin` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`kode_jenkel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_jeniskelamin` */

insert  into `tbl_jeniskelamin`(`kode_jenkel`,`jenis_kelamin`) values 
('L','Laki-Laki'),
('P','Perempuan');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `iduser` int(7) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `level_user` int(11) DEFAULT NULL COMMENT '1 = Super Admin, 2=Pimpinan, 3=Produksi, 4=Pelanggan',
  `status` enum('Y','N') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`iduser`,`username`,`fullname`,`password`,`level_user`,`status`,`created_at`,`updated_at`) values 
(1,'pimpinan','Novi Putri Sesmita','$2y$10$OCz92SujZJy1qnGd5BCc/.UpcR9vcWa81jBltECA7EaSE.n8M8Wc.',2,'Y',NULL,NULL),
(2,'admin','Fauzan Adli','$2y$10$Wc8NNlkidR9VkecZXT7WzuhjudmEnEj.Fd4xpyHqI7pECKOcOX41i',1,'Y',NULL,'2023-06-10 19:57:56'),
(3,'pelanggan','Bobi Situmorang','$2y$10$nP4Ce9d0iT9r3vjmXzx89eeHxAj3w.TTxUIWze2mDBmoCgsBw5NoG',4,'Y',NULL,'2023-06-10 19:57:33'),
(4,'produksi','Ilham','$2y$10$jCqGEycSP.N/CNVfM0axCucPyGkQCvrVOsJwPVva0Zce1pDq.8r6K',3,'Y',NULL,'2023-06-10 19:57:18'),
(7,'Pelanggan1','Zanku','$2y$10$uicAq/czp09bm3eyEZ7XO.gRs5u8iAwwpLy/b6E/RxfclpcRaFGCm',4,'N','2023-06-14 03:36:39','2023-06-14 03:59:52');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
