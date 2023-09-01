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
(4,'Pelunasan'),
(5,'Produk Bisa Di Ambil');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pelanggan` */

insert  into `pelanggan`(`kodepelanggan`,`namapelanggan`,`tgl_lahir`,`kodejenkel`,`alamat`,`notelp`,`created_at`,`updated_at`) values 
('PL-01','Sesmita','2000-04-14','P','Jln.Olo Ladang No.9','0813323423','2023-06-10 22:54:04','2023-07-17 12:45:30'),
('PL-02','Bayu','2023-07-17','L','Jln.Purus 1','0812660432','2023-07-15 10:28:30','2023-07-17 12:45:55'),
('PL-03','Putri',NULL,'P','Jl.Olo Ladang','0831810058','2023-07-15 21:27:13',NULL),
('PL-04','ade','2023-07-17','L','padang','098764','2023-07-17 18:19:14',NULL),
('PL-05','adee','2023-07-17','L','padang','0831810059','2023-07-17 19:57:52',NULL);

/*Table structure for table `tbl_bahan_baku` */

DROP TABLE IF EXISTS `tbl_bahan_baku`;

CREATE TABLE `tbl_bahan_baku` (
  `kode_bahan_baku` varchar(10) NOT NULL,
  `nama_bahan_baku` varchar(50) DEFAULT NULL,
  `satuan_bahan_baku` varchar(20) DEFAULT NULL,
  `jumlah_bahan_baku` int(11) DEFAULT NULL,
  `harga_bahan_baku` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_bahan_baku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_bahan_baku` */

insert  into `tbl_bahan_baku`(`kode_bahan_baku`,`nama_bahan_baku`,`satuan_bahan_baku`,`jumlah_bahan_baku`,`harga_bahan_baku`,`created_at`,`updated_at`) values 
('BB-01','Kertas Motif','lbr',28,6000,'2023-07-13 15:42:33',NULL),
('BB-02','Benang Biru Langt','Klos',28,30000,'2023-07-13 15:45:12',NULL),
('BB-03','Benang Pakan Viscos rayon','Klos',6,25000,'2023-07-15 02:00:29',NULL),
('BB-04','Benang Lusi Biru Tua','Klos',14,20000,'2023-07-15 02:01:25',NULL),
('BB-05','Tali Pengikat Kartu','m',50,10000,'2023-07-15 02:01:44',NULL);

/*Table structure for table `tbl_bahan_baku_masuk` */

DROP TABLE IF EXISTS `tbl_bahan_baku_masuk`;

CREATE TABLE `tbl_bahan_baku_masuk` (
  `kode_bahan_baku_masuk` varchar(10) NOT NULL,
  `tgl_bahan_baku_masuk` date DEFAULT NULL,
  `total_harga_bahan_baku_masuk` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_bahan_baku_masuk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_bahan_baku_masuk` */

insert  into `tbl_bahan_baku_masuk`(`kode_bahan_baku_masuk`,`tgl_bahan_baku_masuk`,`total_harga_bahan_baku_masuk`,`created_at`) values 
('FK-BM-001','2023-07-15',365000,'2023-07-15 03:37:14'),
('FK-BM-002','2023-07-15',225000,'2023-07-15 21:40:25'),
('FK-BM-003','2023-07-16',70000,'2023-07-16 18:03:41'),
('FK-BM-004','2023-07-17',10000,'2023-07-17 13:01:56'),
('FK-BM-005','2023-07-17',60000,'2023-07-17 20:11:59'),
('FK-BM-006','2023-07-21',60000,'2023-07-21 11:21:12');

/*Table structure for table `tbl_detail_bahan_baku_masuk` */

DROP TABLE IF EXISTS `tbl_detail_bahan_baku_masuk`;

CREATE TABLE `tbl_detail_bahan_baku_masuk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_bahan_baku_masuk_detail` varchar(10) DEFAULT NULL,
  `kode_bahan_baku_detail` varchar(10) DEFAULT NULL,
  `qty_bahan_baku_masuk_detail` int(11) DEFAULT NULL,
  `harga_bahan_baku_masuk_detail` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kode_bahan_baku_masuk_detail` (`kode_bahan_baku_masuk_detail`),
  KEY `kode_bahan_baku_detail` (`kode_bahan_baku_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_detail_bahan_baku_masuk` */

insert  into `tbl_detail_bahan_baku_masuk`(`id`,`kode_bahan_baku_masuk_detail`,`kode_bahan_baku_detail`,`qty_bahan_baku_masuk_detail`,`harga_bahan_baku_masuk_detail`,`created_at`) values 
(4,'FK-BM-001','BB-02',8,30000,'2023-07-15 03:24:50'),
(5,'FK-BM-001','BB-03',5,25000,'2023-07-15 03:25:14'),
(6,'FK-BM-002','BB-01',5,5000,'2023-07-15 21:40:08'),
(7,'FK-BM-002','BB-04',10,20000,'2023-07-15 21:40:19'),
(8,'FK-BM-003','BB-02',2,30000,'2023-07-16 18:03:22'),
(9,'FK-BM-003','BB-05',1,10000,'2023-07-16 18:03:38'),
(10,'FK-BM-004','BB-01',2,5000,'2023-07-17 13:01:49'),
(12,'FK-BM-005','BB-02',2,30000,'2023-07-17 20:11:20'),
(15,'FK-BM-006','BB-01',10,6000,'2023-07-21 11:15:30');

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

/*Table structure for table `tbl_karyawan` */

DROP TABLE IF EXISTS `tbl_karyawan`;

CREATE TABLE `tbl_karyawan` (
  `kodekaryawan` varchar(10) NOT NULL,
  `namalengkap` varchar(100) DEFAULT NULL,
  `tgl_lahir_karyawan` date DEFAULT NULL,
  `kodejenkel_karyawan` varchar(5) DEFAULT NULL,
  `alamat_karyawan` varchar(100) DEFAULT NULL,
  `nohp_karyawan` varchar(15) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kodekaryawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_karyawan` */

insert  into `tbl_karyawan`(`kodekaryawan`,`namalengkap`,`tgl_lahir_karyawan`,`kodejenkel_karyawan`,`alamat_karyawan`,`nohp_karyawan`,`created_at`,`updated_at`) values 
('USR-001','Fauzan Adli','1999-01-01','L','padang','098123123',NULL,'2023-09-01 10:23:25'),
('USR-002','Novi Putri Sesmita','2000-04-14','P','Sinjunjung',NULL,NULL,NULL),
('USR-003','Novi','2000-04-14','P','Padang','123456789012',NULL,'2023-09-01 11:12:03'),
('USR-004','alif','2000-01-01','L','Padang','8102381029','2023-07-21 10:31:22',NULL);

/*Table structure for table `tbl_pemesanan` */

DROP TABLE IF EXISTS `tbl_pemesanan`;

CREATE TABLE `tbl_pemesanan` (
  `kode_pemesanan` varchar(10) NOT NULL,
  `tgl_pemesanan` date DEFAULT NULL,
  `kode_pelanggan` varchar(10) DEFAULT NULL,
  `dp_pemesanan` int(11) DEFAULT NULL,
  `bukti_dp` varchar(100) DEFAULT NULL,
  `bayar_sisa` int(11) DEFAULT NULL,
  `bukti_sisa` varchar(100) DEFAULT NULL,
  `status_pemesanan` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`kode_pemesanan`),
  KEY `kode_pelanggan` (`kode_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_pemesanan` */

insert  into `tbl_pemesanan`(`kode_pemesanan`,`tgl_pemesanan`,`kode_pelanggan`,`dp_pemesanan`,`bukti_dp`,`bayar_sisa`,`bukti_sisa`,`status_pemesanan`,`created_at`,`updated_at`) values 
('FK-PO-001','2023-07-15','PL-02',500000,'matakuliah.png',1500000,'WhatsApp Image 2023-07-08 at 22.02.06.jpeg','5','2023-07-15 14:05:55','2023-07-15 23:04:17'),
('FK-PO-002','2023-07-15','PL-03',100000,'home.png',200000,'WhatsApp Image 2023-07-06 at 00.22.54.jpg','5','2023-07-15 21:28:25','2023-07-15 22:58:09'),
('FK-PO-003','2023-07-16','PL-03',100000,'home.png',200000,'matakuliah.png','5','2023-07-16 18:09:30','2023-07-17 13:22:21'),
('FK-PO-004','2023-07-16','PL-02',300000,'WhatsApp Image 2023-07-06 at 00.22.54.jpg',NULL,NULL,'2','2023-07-16 22:51:45',NULL),
('FK-PO-005','2023-07-17','PL-02',200000,'matakuliah.png',NULL,NULL,'2','2023-07-17 12:54:24',NULL),
('FK-PO-006','2023-07-17','PL-04',100000,'home.png',800000,'WhatsApp Image 2023-07-17 at 08.17.59.jpeg','5','2023-07-17 18:25:43','2023-07-17 19:24:41'),
('FK-PO-007','2023-07-17','PL-05',200000,'mahasiswa.png',400000,'home.png','3','2023-07-17 19:58:52','2023-07-17 20:05:15'),
('FK-PO-008','2023-07-17','PL-05',200000,'mahasiswa.png',NULL,NULL,'1','2023-07-17 19:59:05',NULL),
('FK-PO-009','2023-07-19','PL-03',400000,'WhatsApp Image 2023-07-17 at 08.17.59.jpeg',NULL,NULL,'2','2023-07-19 12:48:00','2023-07-19 16:24:10'),
('FK-PO-010','2023-07-19','PL-02',400000,'WhatsApp Image 2023-07-17 at 08.17.59.jpeg',400000,'WhatsApp Image 2023-07-17 at 08.17.59.jpeg','3','2023-07-19 16:28:46','2023-07-19 21:24:03'),
('FK-PO-011','2023-07-19','PL-04',300000,'WhatsApp Image 2023-07-08 at 22.02.06.jpeg',500000,'matakuliah.png','3','2023-07-19 21:35:05','2023-07-19 21:38:32'),
('FK-PO-012','2023-07-20','PL-05',800000,'matakuliah.png',NULL,NULL,'2','2023-07-20 18:31:00','2023-07-20 18:31:57');

/*Table structure for table `tbl_penjualan` */

DROP TABLE IF EXISTS `tbl_penjualan`;

CREATE TABLE `tbl_penjualan` (
  `no_transaksi_penjualan` varchar(10) NOT NULL,
  `tgl_penjualan` date DEFAULT NULL,
  `kode_pelanggan` varchar(10) DEFAULT NULL,
  `total_harga_penjualan` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`no_transaksi_penjualan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_penjualan` */

insert  into `tbl_penjualan`(`no_transaksi_penjualan`,`tgl_penjualan`,`kode_pelanggan`,`total_harga_penjualan`,`created_at`) values 
('FK-PJ-001','2023-07-15','PR-01',400000,'2023-07-15 17:37:05'),
('FK-PJ-002','2023-07-15','PL-01',800000,'2023-07-15 21:38:07'),
('FK-PJ-003','2023-07-16','PL-03',800000,'2023-07-16 17:58:51'),
('FK-PJ-004','2023-07-17','PL-05',1500000,'2023-07-17 20:07:53'),
('FK-PJ-005','2023-07-17','',0,'2023-07-17 21:01:30'),
('FK-PJ-006','2023-07-19','PL-04',800000,'2023-07-19 21:53:20'),
('FK-PJ-007','2023-07-20','',2250000,'2023-07-20 18:23:26');

/*Table structure for table `tbl_penjualan_detail` */

DROP TABLE IF EXISTS `tbl_penjualan_detail`;

CREATE TABLE `tbl_penjualan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_transaksi_penjualan_detail` varchar(10) DEFAULT NULL,
  `no_pemesanan_detail` varchar(10) DEFAULT NULL,
  `kode_produk_penjualan_detail` varchar(10) DEFAULT NULL,
  `qty_produk_penjualan_detail` int(11) DEFAULT NULL,
  `harga_produk_penjualan_detail` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `no_transaksi_penjualan_detail` (`no_transaksi_penjualan_detail`),
  KEY `kode_produk_penjualan_detail` (`kode_produk_penjualan_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_penjualan_detail` */

insert  into `tbl_penjualan_detail`(`id`,`no_transaksi_penjualan_detail`,`no_pemesanan_detail`,`kode_produk_penjualan_detail`,`qty_produk_penjualan_detail`,`harga_produk_penjualan_detail`,`created_at`) values 
(7,NULL,'FK-PO-001','PR-04',5,400000,'2023-07-15 14:01:37'),
(14,'FK-PJ-001',NULL,'PR-04',1,400000,'2023-07-15 17:36:47'),
(15,NULL,'FK-PO-002','PR-01',1,300000,'2023-07-15 21:28:04'),
(17,'FK-PJ-002',NULL,'PR-04',2,400000,'2023-07-15 21:35:12'),
(18,'FK-PJ-003',NULL,'PR-03',2,400000,'2023-07-16 17:58:14'),
(20,NULL,'FK-PO-003','PR-01',1,300000,'2023-07-16 18:09:04'),
(21,NULL,'FK-PO-004','PR-01',2,300000,'2023-07-16 22:45:06'),
(22,NULL,'FK-PO-005','PR-04',1,400000,'2023-07-17 12:53:56'),
(23,NULL,'FK-PO-006','PR-02',2,450000,'2023-07-17 18:23:01'),
(24,NULL,'FK-PO-007','PR-01',2,300000,'2023-07-17 19:58:28'),
(25,'FK-PJ-004',NULL,'PR-01',5,300000,'2023-07-17 20:07:19'),
(27,NULL,'FK-PO-009','PR-03',2,400000,'2023-07-19 11:31:36'),
(28,NULL,'FK-PO-010','PR-04',2,400000,'2023-07-19 16:28:43'),
(31,NULL,'FK-PO-011','PR-04',2,400000,'2023-07-19 21:35:00'),
(32,'FK-PJ-006',NULL,'PR-03',2,400000,'2023-07-19 21:51:47'),
(33,'FK-PJ-007',NULL,'PR-02',5,450000,'2023-07-20 18:22:50'),
(34,NULL,'FK-PO-012','PR-04',2,400000,'2023-07-20 18:30:36');

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

insert  into `tbl_produk`(`kode_produk`,`kode_jenis_motif`,`nama_produk`,`harga_produk`,`jumlah_produk`,`created_at`,`updated_at`) values 
('PR-01','JT-01','Jacguard Benang Biru Langit',300000,10,'2023-07-15 01:04:44','2023-07-20 18:40:06'),
('PR-02','JT-03','Itiak Pulang Patang Benang Biru',450000,10,'2023-07-15 01:14:48','2023-07-21 10:48:30'),
('PR-03','JT-04','Kaluak Paku Benang Hijau daun',400000,0,'2023-07-15 01:27:11','2023-07-17 12:57:37'),
('PR-04','JT-02','Pucuak Rabuang Benang Merah',400000,7,'2023-07-15 01:56:03','2023-07-16 18:02:14'),
('PR-05','JT-05','Saluak Laka Biru',330000,10,'2023-07-21 08:16:16',NULL);

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

insert  into `tbl_produksi`(`kode_produksi`,`kode_produk`,`jumlah_produksi`,`created_at`,`updated_at`) values 
('PS-01','PR-02',2,'2023-07-15 01:52:32',NULL),
('PS-02','PR-04',5,'2023-07-15 02:05:27',NULL),
('PS-03','PR-01',5,'2023-07-15 21:39:30',NULL),
('PS-04','PR-04',2,'2023-07-16 18:02:14',NULL),
('PS-05','PR-03',5,'2023-07-17 12:57:37',NULL),
('PS-06','PR-02',2,'2023-07-17 20:15:24',NULL),
('PS-07','PR-01',11,'2023-07-20 18:40:06',NULL),
('PS-08','PR-02',10,'2023-07-21 10:48:30',NULL);

/*Table structure for table `tbl_produksi_detail` */

DROP TABLE IF EXISTS `tbl_produksi_detail`;

CREATE TABLE `tbl_produksi_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_produksi_detail` varchar(10) DEFAULT NULL,
  `kode_bahan_baku_detail` varchar(10) DEFAULT NULL,
  `qty_bahan_baku_produksi` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kode_produksi_detail` (`kode_produksi_detail`),
  KEY `kode_bahan_baku_detail` (`kode_bahan_baku_detail`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `tbl_produksi_detail` */

insert  into `tbl_produksi_detail`(`id`,`kode_produksi_detail`,`kode_bahan_baku_detail`,`qty_bahan_baku_produksi`,`created_at`) values 
(2,'PS-01','BB-01',2,'2023-07-15 01:50:00'),
(3,'PS-01','BB-02',3,'2023-07-15 01:50:17'),
(4,'PS-02','BB-01',2,'2023-07-15 02:04:18'),
(6,'PS-03','BB-01',5,'2023-07-15 21:39:06'),
(7,'PS-03','BB-02',3,'2023-07-15 21:39:18'),
(8,'PS-04','BB-01',1,'2023-07-16 18:01:20'),
(9,'PS-04','BB-03',2,'2023-07-16 18:01:46'),
(10,'PS-05','BB-05',1,'2023-07-17 12:56:35'),
(11,'PS-05','BB-02',1,'2023-07-17 12:56:46'),
(12,'PS-06','BB-01',1,'2023-07-17 20:13:11'),
(14,'PS-06','BB-04',1,'2023-07-17 20:15:10'),
(62,'PS-07','BB-02',2,'2023-07-20 18:39:51'),
(63,'PS-08','BB-01',2,'2023-07-21 10:43:28'),
(64,'PS-08','BB-02',4,'2023-07-21 10:43:41');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `iduser` int(7) NOT NULL AUTO_INCREMENT,
  `kode_user` varchar(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `level_user` int(11) DEFAULT NULL COMMENT '1 = Super Admin, 2=Pimpinan, 3=Produksi, 4=Pelanggan',
  `status` enum('Y','N') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`iduser`,`kode_user`,`username`,`fullname`,`password`,`level_user`,`status`,`created_at`,`updated_at`) values 
(1,'USR-002','pimpinan','Novi Putri Sesmita','$2y$10$Wc8NNlkidR9VkecZXT7WzuhjudmEnEj.Fd4xpyHqI7pECKOcOX41i',2,'Y',NULL,NULL),
(2,'USR-001','admin','Fauzan Adli','$2y$10$Wc8NNlkidR9VkecZXT7WzuhjudmEnEj.Fd4xpyHqI7pECKOcOX41i',1,'Y',NULL,'2023-06-10 19:57:56'),
(4,'USR-003','produksi','Novi','$2y$10$jCqGEycSP.N/CNVfM0axCucPyGkQCvrVOsJwPVva0Zce1pDq.8r6K',3,'Y',NULL,'2023-09-01 10:37:06'),
(8,'PL-02','bayu','Bayu','$2y$10$RiN.4BKTwfb7kcnj/7K/h.4m2X1NV60vPOlVg0QqKtCCTNspNSDGi',4,'Y','2023-07-15 10:28:30',NULL),
(9,'PL-01','sesmita','Sesmita','$2y$10$Wc8NNlkidR9VkecZXT7WzuhjudmEnEj.Fd4xpyHqI7pECKOcOX41i',4,'Y','2023-07-15 21:25:57',NULL),
(10,'PL-03','putri','Putri','$2y$10$NYKdMw1Y5oyGMhf5yeDXmOPMnu9IeSzg3xLrNagqbAlKV0gepZqo.',4,'Y','2023-07-15 21:27:13',NULL),
(11,'PL-04','ade','ade','$2y$10$QNc.BpLt2cFIX8nDE4V1oeKd0YrNN3ZsjPTfMlUFT5BACgfDu7m36',4,'Y','2023-07-17 18:19:14',NULL),
(12,'PL-05','adee','adee','$2y$10$p/IF/fxH8H7dDqhPTq/S3OCI0oTOUAqqg9.I/ECQMjH1IQHaDWZXi',4,'Y','2023-07-17 19:57:52',NULL),
(14,'USR-004','alif','alif','$2y$10$0fUAlPaT09pAL9fQkl5zG.eYuAz4yPNbYv5uPeMrf.Hs0.CB9QwMC',3,'Y','2023-07-21 10:31:22','2023-09-01 11:10:14');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
