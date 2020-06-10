/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.11-MariaDB : Database - web_gudang
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`web_gudang` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `web_gudang`;

/*Table structure for table `tb_barang_keluar` */

DROP TABLE IF EXISTS `tb_barang_keluar`;

CREATE TABLE `tb_barang_keluar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(50) NOT NULL,
  `tanggal_masuk` varchar(20) NOT NULL,
  `tanggal_keluar` varchar(20) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `tb_barang_keluar` */

insert  into `tb_barang_keluar`(`id`,`id_transaksi`,`tanggal_masuk`,`tanggal_keluar`,`lokasi`,`kode_barang`,`nama_barang`,`satuan`,`jumlah`) values 
(1,'WG-201713067948','8/11/2017','11/11/2017','NTB','8888166995215','Ciki Walens','Dus','50'),
(2,'WG-201713067948','8/11/2017','11/12/2017','NTB','8888166995215','Ciki Walens','Dus','6'),
(3,'WG-201713549728','4/11/2017','11/11/2017','Banten','1923081008002','Buku Hiragana','Pack','3'),
(4,'WG-201774896520','9/11/2017','12/11/2017','Yogyakarta','60201311121008264','Battery ZTE','Dus','3'),
(5,'WG-201727134650','05/12/2017','20/12/2017','Jakarta','29312390203','Susu','Dus','17'),
(6,'WG-201810974628','15/01/2018','16/01/2018','Lampung','1923081008002','Buku Nihongo','Dus','50'),
(7,'WG-201781267543','7/11/2017','17/01/2018','Yogyakarta','97897952889','Buku Framework Codeigniter','Dus','1'),
(8,'WG-201832570869','15/01/2018','17/01/2018','Bali','1923081008002','test','Dus','10'),
(9,'WG-201893850472','15/01/2018','18/01/2018','Bali','1923081008002','lumpur nartugo','Pcs','11'),
(10,'WG-201781267543','7/11/2017','15/01/2018','Yogyakarta','97897952889','Buku Framework Codeigniter','Dus','1'),
(11,'WG-201727134650','05/12/2017','15/01/2018','Jakarta','29312390203','Susu','Dus','3'),
(12,'WG-201774896520','9/11/2017','15/01/2018','Yogyakarta','60201311121008264','Battery ZTE','Dus','3'),
(13,'WG-201727134650','05/12/2017','16/01/2018','Jakarta','29312390203','Susu','Dus','1'),
(14,'WG-201727134650','05/12/2017','17/01/2018','Jakarta','29312390203','Susu','Dus','1'),
(15,'WG-201885472106','18/01/2018','19/01/2018','Riau','8996001600146','Teh Pucuk','Dus','50'),
(16,'WG-201871602934','18/01/2018','16/03/2018','Papua','312212331222','Kopi Hitam','Dus','10');

/*Table structure for table `tb_barang_masuk` */

DROP TABLE IF EXISTS `tb_barang_masuk`;

CREATE TABLE `tb_barang_masuk` (
  `id_transaksi` varchar(50) NOT NULL,
  `tanggal` varchar(20) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `jumlah` varchar(10) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_barang_masuk` */

insert  into `tb_barang_masuk`(`id_transaksi`,`tanggal`,`lokasi`,`kode_barang`,`nama_barang`,`satuan`,`jumlah`) values 
('WG-201871602934','18/01/2018','Papua','312212331222','Kopi Hitam','Dus','90');

/*Table structure for table `tb_satuan` */

DROP TABLE IF EXISTS `tb_satuan`;

CREATE TABLE `tb_satuan` (
  `id_satuan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_satuan` varchar(100) NOT NULL,
  `nama_satuan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tb_satuan` */

insert  into `tb_satuan`(`id_satuan`,`kode_satuan`,`nama_satuan`) values 
(1,'Dus','Dus'),
(2,'Pcs','Pcs'),
(5,'Pack','Pack');

/*Table structure for table `tb_upload_gambar_user` */

DROP TABLE IF EXISTS `tb_upload_gambar_user`;

CREATE TABLE `tb_upload_gambar_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username_user` varchar(100) NOT NULL,
  `nama_file` varchar(220) NOT NULL,
  `ukuran_file` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tb_upload_gambar_user` */

insert  into `tb_upload_gambar_user`(`id`,`username_user`,`nama_file`,`ukuran_file`) values 
(4,'admin','man.png','2.25'),
(5,'widi','nopic2.png','6.33');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 0,
  `last_login` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`email`,`password`,`role`,`last_login`) values 
(20,'admin','admin@gmail.com','$2y$10$3HNkMOtwX8X88Xb3DIveYuhXScTnJ9m16/rPDF1/VTa/VTisxVZ4i',1,'02-06-2020 9:36'),
(24,'widi','widi@gmail.com','$2y$10$TajW04s0N9sDYwf5M9jfaed1IlJIfUCLWlLIG7bxyPbikgKrtR61m',0,'02-06-2020 9:36');

/* Trigger structure for table `tb_barang_keluar` */

DELIMITER $$

/*!50003 DROP TRIGGER*//*!50032 IF EXISTS */ /*!50003 `TG_BARANG_KELUAR` */$$

/*!50003 CREATE */ /*!50017 DEFINER = 'root'@'localhost' */ /*!50003 TRIGGER `TG_BARANG_KELUAR` AFTER INSERT ON `tb_barang_keluar` FOR EACH ROW BEGIN
 UPDATE tb_barang_masuk SET jumlah=jumlah-NEW.jumlah
 WHERE kode_barang=NEW.kode_barang;
 DELETE FROM tb_barang_masuk WHERE jumlah = 0;
END */$$


DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
