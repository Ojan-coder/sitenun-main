/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.28-MariaDB : Database - sitenun
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sitenun` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `sitenun`;

/*Table structure for table `level_status` */

DROP TABLE IF EXISTS `level_status`;

CREATE TABLE `level_status` (
  `kode_status` int(10) NOT NULL,
  `nama_status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `level_status` */

insert  into `level_status`(`kode_status`,`nama_status`) values 
(1,'Pending'),
(2,'Di-Proses'),
(3,'Lunas'),
(4,'Pelunasan');

/*Table structure for table `level_user` */

DROP TABLE IF EXISTS `level_user`;

CREATE TABLE `level_user` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_level`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `level_user` */

insert  into `level_user`(`id_level`,`nama_level`) values 
(1,'Super Admin'),
(2,'Pimpinan'),
(3,'Produksi'),
(4,'Pelanggan');

/*Table structure for table `tbl_bahan_baku` */

DROP TABLE IF EXISTS `tbl_bahan_baku`;

CREATE TABLE `tbl_bahan_baku` (
  `kode_bahan_baku` varchar(10) NOT NULL,
  `nama_bahan_baku` varchar(50) DEFAULT NULL,
  `satuan_bahan_baku` varchar(20) DEFAULT NULL,
  `jumlah_bahan_baku` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_bahan_baku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_bahan_baku` */

insert  into `tbl_bahan_baku`(`kode_bahan_baku`,`nama_bahan_baku`,`satuan_bahan_baku`,`jumlah_bahan_baku`,`created_at`) values 
('BB-01','Kertas Motif','lbr',20,'2023-07-13 15:42:33'),
('BB-02','Benang Biru Langt','Klos',20,'2023-07-13 15:45:12');

/*Table structure for table `tbl_bahan_baku_masuk` */

DROP TABLE IF EXISTS `tbl_bahan_baku_masuk`;

CREATE TABLE `tbl_bahan_baku_masuk` (
  `kode_bahan_baku_masuk` varchar(10) NOT NULL,
  `tgl_bahan_baku_masuk` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_bahan_baku_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_bahan_baku_masuk` */

/*Table structure for table `tbl_detail_bahan_baku_masuk` */

DROP TABLE IF EXISTS `tbl_detail_bahan_baku_masuk`;

CREATE TABLE `tbl_detail_bahan_baku_masuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_bahan_baku_masuk_detail` varchar(10) DEFAULT NULL,
  `kode_bahan_baku_detail` varchar(10) DEFAULT NULL,
  `qty_bahan_baku_masuk_detail` int(11) DEFAULT NULL,
  `harga_bahan_baku_masuk_detail` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kode_bahan_baku_masuk_detail` (`kode_bahan_baku_masuk_detail`),
  KEY `kode_bahan_baku_detail` (`kode_bahan_baku_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_detail_bahan_baku_masuk` */

/*Table structure for table `tbl_detail_penjualan` */

DROP TABLE IF EXISTS `tbl_detail_penjualan`;

CREATE TABLE `tbl_detail_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_detail_penjualan` varchar(10) DEFAULT NULL,
  `kode_produk_penjualan` varchar(10) DEFAULT NULL,
  `qty_penjualan` int(11) DEFAULT NULL,
  `harga_penjualan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_detail_penjualan` */

/*Table structure for table `tbl_jenis_tenun` */

DROP TABLE IF EXISTS `tbl_jenis_tenun`;

CREATE TABLE `tbl_jenis_tenun` (
  `kode_jenis` varchar(10) NOT NULL,
  `jenis_motif` varchar(50) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar_motif` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_jenis_tenun` */

insert  into `tbl_jenis_tenun`(`kode_jenis`,`jenis_motif`,`deskripsi`,`gambar_motif`,`created_at`) values 
('JT-01','Jacguard','Motif Jacquard dinamakan berdasarkan penemunya, Joseph Marie Jacquard, seorang penenun asal Prancis yang hidup pada abad ke-18. Jacquard mengembangkan mesin tenun Jacquard yang menggabungkan mekanisme kartu punch dan tenun manual. Mesin tersebut memungkinkan pembuatan pola dan motif yang rumit, detail, dan beragam. Penemuan ini membuka pintu bagi kreativitas dalam industri tenun','jaguard.jpg','2023-07-13 15:09:34'),
('JT-02','Pucuak Rabuang','Motif ini memiliki makna bahwa hidup seseorang harus berguna sepanjang waktu. Motif ini bercerita bahwa hidup harus mencontoh falsafah bambu, dimana bambu selalu berguna sejak muda (rebung) untuk dimakan, dan saat tua (bambu) sebagai lantai rumah atau bahan bangunan. Motif rebung ini juga mengibaratkan bahwa tanaman ini berguna sepanjang hidupnya dan semua bagiannya memiliki banyak kegunaan','motif_pucuak_rabuang.jpg','2023-07-13 15:12:31'),
('JT-03','Itiak Pulang Patang','Motif ini memiliki makna bahwa hidup dalam masyarakat haruslah seiya sekata, seiring sejalan dan mematuhi peraturan yang berlaku. Motif ini ingin mengajak masyarakat untuk bisa hidup bersama dan menggambarkan kerukunan masyarakat Minangkabau yang hidup dalam tatanan kegotongroyongan yang solid.','itiak-pulang-sanjo.jpeg','2023-07-13 15:13:44'),
('JT-04','Kaluak Paku','Motif ini memiliki makna bahwa kita sebagai manusia haruslah mawas diri sejak kecil, dan perlu belajar sejak dini mulai dari keluarga. Pendidikan dalam keluarga menjadi bekal utama untuk menjalankan kehidupan di masyarakat. Setelah dewasa kita harus bergaul ke tengah masyarakat, sehingga bekal hidup dari keluarga bisa menjadikan diri lebih kuat dan tidak mudah terpengaruh hal negatif. Uniknya, motif ini juga memiliki makna lainnya, yaitu seorang pemimpin harus mampu menjadi teladan bagi masyarakat yang ada disekitarnya','Antara-Kaluak-Paku.jpg','2023-07-13 15:15:43'),
('JT-05','Saluak Laka','Motif ini memiliki memiliki arti lambang kekerabatan. Hal ini akan memberi makna dalam kehidupan masyarakat, bahwa kekuatan akan terjalin dari kesatuan yang saling terikat sehingga akan terwujud kekuatan bersama dalam menghadapi bermacam masalah','motif_saluak_laka.jpg','2023-07-13 15:19:31');

/*Table structure for table `tbl_pegawai` */

DROP TABLE IF EXISTS `tbl_pegawai`;

CREATE TABLE `tbl_pegawai` (
  `kode_pegawai` varchar(10) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(5) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `nohp` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_pegawai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_pegawai` */

/*Table structure for table `tbl_pelanggan` */

DROP TABLE IF EXISTS `tbl_pelanggan`;

CREATE TABLE `tbl_pelanggan` (
  `kodepelanggan` char(7) NOT NULL,
  `namapelanggan` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `kodejenkel` char(5) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `notelp` char(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kodepelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_pelanggan` */

insert  into `tbl_pelanggan`(`kodepelanggan`,`namapelanggan`,`tgl_lahir`,`kodejenkel`,`alamat`,`notelp`,`created_at`,`updated_at`) values 
('PR-01','Sesmita','2000-04-14','P','Jln.Olo Ladang No.9','0813323423','2023-06-10 22:54:04',NULL);

/*Table structure for table `tbl_pemesanan` */

DROP TABLE IF EXISTS `tbl_pemesanan`;

CREATE TABLE `tbl_pemesanan` (
  `kode_pemesanan` varchar(10) NOT NULL,
  `tgl_pemesanan` date DEFAULT NULL,
  `kode_pelanggan` varchar(10) DEFAULT NULL,
  `qty_pemesanan` int(11) DEFAULT NULL,
  `dp_pemesanan` int(11) DEFAULT NULL,
  `bukti_dp` varchar(100) DEFAULT NULL,
  `status_pemesanan` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode_pemesanan`),
  KEY `kode_pelanggan` (`kode_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_pemesanan` */

/*Table structure for table `tbl_penjualan` */

DROP TABLE IF EXISTS `tbl_penjualan`;

CREATE TABLE `tbl_penjualan` (
  `no_transaksi_penjualan` varchar(10) NOT NULL,
  `no_pemesanan_produk` varchar(10) DEFAULT NULL,
  `tgl_penjualan` date DEFAULT NULL,
  `kode_pelanggan` varchar(10) DEFAULT NULL,
  `total_harga_penjualan` int(11) DEFAULT NULL,
  PRIMARY KEY (`no_transaksi_penjualan`),
  KEY `no_pemesanan_produk` (`no_pemesanan_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_penjualan` */

/*Table structure for table `tbl_penjualan_detail` */

DROP TABLE IF EXISTS `tbl_penjualan_detail`;

CREATE TABLE `tbl_penjualan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi_penjualan_detail` varchar(10) DEFAULT NULL,
  `kode_produk_penjualan_detail` varchar(10) DEFAULT NULL,
  `qty_produk_penjualan_detail` int(11) DEFAULT NULL,
  `harga_produk_penjualan_detail` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `no_transaksi_penjualan_detail` (`no_transaksi_penjualan_detail`),
  KEY `kode_produk_penjualan_detail` (`kode_produk_penjualan_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_penjualan_detail` */

/*Table structure for table `tbl_produk` */

DROP TABLE IF EXISTS `tbl_produk`;

CREATE TABLE `tbl_produk` (
  `kode_produk` char(7) NOT NULL,
  `kode_jenis_motif` varchar(10) DEFAULT NULL,
  `nama_produk` varchar(100) DEFAULT NULL,
  `harga_produk` int(11) DEFAULT NULL,
  `jumlah_produk` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_produk`),
  KEY `kode_jenis_motif` (`kode_jenis_motif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_produk` */

/*Table structure for table `tbl_produksi` */

DROP TABLE IF EXISTS `tbl_produksi`;

CREATE TABLE `tbl_produksi` (
  `kode_produksi` varchar(10) NOT NULL,
  `kode_produk` varchar(10) DEFAULT NULL,
  `jumlah_produksi` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_produksi`),
  KEY `kode_produk` (`kode_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_produksi` */

/*Table structure for table `tbl_produksi_detail` */

DROP TABLE IF EXISTS `tbl_produksi_detail`;

CREATE TABLE `tbl_produksi_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produksi_detail` varchar(10) DEFAULT NULL,
  `kode_bahan_baku_detail` varchar(10) DEFAULT NULL,
  `qty_bahan_baku_produksi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kode_produksi_detail` (`kode_produksi_detail`),
  KEY `kode_bahan_baku_detail` (`kode_bahan_baku_detail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_produksi_detail` */

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
