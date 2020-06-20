CREATE DATABASE  IF NOT EXISTS `klinik` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `klinik`;
-- MySQL dump 10.13  Distrib 8.0.13, for Win64 (x86_64)
--
-- Host: localhost    Database: klinik
-- ------------------------------------------------------
-- Server version	8.0.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `m_akses`
--

DROP TABLE IF EXISTS `m_akses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `m_akses` (
  `idPengguna` varchar(25) NOT NULL,
  `kdMenu` varchar(50) NOT NULL,
  PRIMARY KEY (`idPengguna`,`kdMenu`) USING BTREE,
  KEY `akses_menu_idx` (`kdMenu`) USING BTREE,
  CONSTRAINT `akses_menu` FOREIGN KEY (`kdMenu`) REFERENCES `m_menu` (`kdmenu`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `akses_pengguna` FOREIGN KEY (`idPengguna`) REFERENCES `m_pengguna` (`idpengguna`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_akses`
--

LOCK TABLES `m_akses` WRITE;
/*!40000 ALTER TABLE `m_akses` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_akses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_alat_bahan`
--

DROP TABLE IF EXISTS `m_alat_bahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `m_alat_bahan` (
  `idAlatBahan` varchar(4) NOT NULL,
  `namaAlatBahan` varchar(400) DEFAULT NULL,
  `satuanAlatBahan` varchar(45) DEFAULT NULL,
  `hargaAlatBahan` decimal(15,2) DEFAULT NULL,
  `operator` varchar(45) NOT NULL,
  `tglInput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idAlatBahan`),
  KEY `idAlatBahan` (`idAlatBahan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_alat_bahan`
--

LOCK TABLES `m_alat_bahan` WRITE;
/*!40000 ALTER TABLE `m_alat_bahan` DISABLE KEYS */;
INSERT INTO `m_alat_bahan` VALUES ('0001','tesss','lr',50000.00,'Administrator','2018-11-24 12:51:27'),('0002','Alata','packs',322222.00,'Administrator','2018-11-24 12:52:07');
/*!40000 ALTER TABLE `m_alat_bahan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_dokter`
--

DROP TABLE IF EXISTS `m_dokter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `m_dokter` (
  `idDokter` varchar(4) NOT NULL,
  `namaDokter` varchar(400) NOT NULL,
  `alamatDokter` text,
  `telpDokter` varchar(45) DEFAULT NULL,
  `operator` varchar(45) NOT NULL,
  `tglInput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`namaDokter`),
  UNIQUE KEY `idDokter_UNIQUE` (`idDokter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_dokter`
--

LOCK TABLES `m_dokter` WRITE;
/*!40000 ALTER TABLE `m_dokter` DISABLE KEYS */;
INSERT INTO `m_dokter` VALUES ('0002','asd','fasdfdd','3423534','Administrator','2018-12-07 01:36:40'),('0001','dr. Apa Aja Boleh','Mataram','081803747336','Administrator','2018-11-24 12:38:22');
/*!40000 ALTER TABLE `m_dokter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_menu`
--

DROP TABLE IF EXISTS `m_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `m_menu` (
  `kdMenu` varchar(50) NOT NULL,
  `nmMenu` varchar(255) DEFAULT NULL,
  `statMenu` tinyint(1) DEFAULT NULL,
  `parentMenu` varchar(50) DEFAULT NULL,
  `sortMenu` tinyint(2) DEFAULT NULL,
  `iconMenu` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`kdMenu`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_menu`
--

LOCK TABLES `m_menu` WRITE;
/*!40000 ALTER TABLE `m_menu` DISABLE KEYS */;
INSERT INTO `m_menu` VALUES ('administrator','Administrator',1,NULL,NULL,'fa-legal'),('apotek','Apotek',1,NULL,NULL,'fa-medkit'),('dataalatbahan','Data Alat & Bahan',0,'datamaster',NULL,NULL),('datadokter','Data Dokter',0,'datamaster',NULL,NULL),('datamaster','Data Master',1,NULL,NULL,'fa-database'),('dataobat','Data Obat',0,'datamaster',NULL,NULL),('datapasien','Data Pasien',0,'datamaster',NULL,NULL),('datapetugas','Data Petugas',0,'datamaster',NULL,NULL),('datasupplier','Data Supplier',0,'datamaster',NULL,NULL),('datatindakan','Data Tindakan',0,'datamaster',NULL,NULL),('hakakses','Hak Akses',0,'setup',0,NULL),('konsultasi','Konsultasi',0,'pelayanan',1,NULL),('laporan','Laporan',1,NULL,NULL,'fa-file-text-o'),('laporankonsinyasi','Konsinyasi',0,'laporan',NULL,NULL),('laporankunjungan','Kunjungan Pasien',0,'laporan',NULL,NULL),('laporanobatkeluar','Obat Keluar',0,'laporan',NULL,NULL),('laporanobatmasuk','Obat Masuk',0,'laporan',NULL,NULL),('laporanpenerimaan','Penerimaan',0,'laporan',NULL,NULL),('laporanstokobat','Stok Obat',0,'laporan',NULL,NULL),('obatmasuk','Obat Masuk',0,'apotek',NULL,NULL),('pelayanan','Pelayanan',1,NULL,NULL,'fa-check-square-o'),('pembayaran','Pembayaran',0,'pelayanan',3,NULL),('pendaftaran','Pendaftaran',0,'pelayanan',0,NULL),('penjualanobat','Penjualan Obat',0,'apotek',NULL,NULL),('postingstok','Posting Stok Obat',0,'administrator',NULL,NULL),('setup','Setup',1,NULL,8,'fa-cog'),('tindakan','Tindakan',0,'pelayanan',2,NULL);
/*!40000 ALTER TABLE `m_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_obat`
--

DROP TABLE IF EXISTS `m_obat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `m_obat` (
  `idObat` varchar(4) NOT NULL,
  `namaObat` varchar(400) DEFAULT NULL,
  `satuanObat` varchar(45) DEFAULT NULL,
  `hargaJualObat` decimal(15,2) DEFAULT NULL,
  `operator` varchar(45) NOT NULL,
  `tglInput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tglUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idObat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_obat`
--

LOCK TABLES `m_obat` WRITE;
/*!40000 ALTER TABLE `m_obat` DISABLE KEYS */;
INSERT INTO `m_obat` VALUES ('0001','test','liter',5000.00,'Administrator','2018-11-25 13:22:26','2018-12-11 02:32:13'),('0002','astasg','strip',500000.00,'Administrator','2018-12-12 03:29:56','2018-12-12 03:29:56'),('0003','s','sdf',22222.00,'Administrator','2018-12-21 07:27:38','2018-12-21 07:27:42');
/*!40000 ALTER TABLE `m_obat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_pasien`
--

DROP TABLE IF EXISTS `m_pasien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `m_pasien` (
  `rmPasien` varchar(10) NOT NULL,
  `namaPasien` varchar(400) DEFAULT NULL,
  `ktpPasien` varchar(24) DEFAULT NULL,
  `alamatPasien` text,
  `tempatLahirPasien` varchar(45) DEFAULT NULL,
  `tglLahirPasien` date DEFAULT NULL,
  `kelaminPasien` enum('L','P') DEFAULT NULL,
  `telpPasien` varchar(45) DEFAULT NULL,
  `pekerjaanPasien` varchar(100) DEFAULT NULL,
  `operator` varchar(45) DEFAULT NULL,
  `tglRegistrasi` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`rmPasien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_pasien`
--

LOCK TABLES `m_pasien` WRITE;
/*!40000 ALTER TABLE `m_pasien` DISABLE KEYS */;
INSERT INTO `m_pasien` VALUES ('18.11.0001','Andi Fajar Nugraha&#039;asdf','asdf','Jl Kalining BTN Gubuk Batu No. 8b Mataram','mataram','2000-02-23','L','081803747336','BUMD','Administrator',NULL),('18.12.0001','Nama','No. KTP','Alamat','Tempat Lahir','2018-12-01','L','No. Telp.','Pekerjaan','Administrator',NULL),('18.12.0002','3134','sdfsdf','Alamat','Tempat ','2018-12-01','L','af','sdf','Administrator',NULL),('18.12.0003','asdf','asdf','dfasdf','asasdf','2018-12-07','L','asdf','asdf','Administrator','2018-12-06 16:00:00'),('18.12.0004','asdf234234','3as24','asdf','234','2018-12-17','L','asdfa234','234234','Administrator','2018-12-16 16:00:00'),('18.12.0005','asd523','23','234','23','2018-12-21','L','saf','235235345','Administrator','2018-12-20 16:00:00');
/*!40000 ALTER TABLE `m_pasien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_pengguna`
--

DROP TABLE IF EXISTS `m_pengguna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `m_pengguna` (
  `idPengguna` varchar(25) NOT NULL,
  `nmPengguna` varchar(255) DEFAULT NULL,
  `tlpPengguna` varchar(15) DEFAULT NULL,
  `sandiPengguna` varchar(100) DEFAULT NULL,
  `lvlPengguna` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idPengguna`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_pengguna`
--

LOCK TABLES `m_pengguna` WRITE;
/*!40000 ALTER TABLE `m_pengguna` DISABLE KEYS */;
INSERT INTO `m_pengguna` VALUES ('admin','Administrator','081803747336','YWRtaW4=',0);
/*!40000 ALTER TABLE `m_pengguna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_petugas`
--

DROP TABLE IF EXISTS `m_petugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `m_petugas` (
  `namaPetugas` varchar(255) DEFAULT NULL,
  `idPetugas` int(10) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `idPetugas_idx` (`idPetugas`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_petugas`
--

LOCK TABLES `m_petugas` WRITE;
/*!40000 ALTER TABLE `m_petugas` DISABLE KEYS */;
INSERT INTO `m_petugas` VALUES ('-',1),('asdfa',2),('asdf',4);
/*!40000 ALTER TABLE `m_petugas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_stok_awal_obat`
--

DROP TABLE IF EXISTS `m_stok_awal_obat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `m_stok_awal_obat` (
  `tglStokAwalObat` date NOT NULL,
  `idObat` varchar(4) NOT NULL,
  `jmlStokAwalObat` double DEFAULT NULL,
  `tglInput` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tglStokAwalObat`,`idObat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_stok_awal_obat`
--

LOCK TABLES `m_stok_awal_obat` WRITE;
/*!40000 ALTER TABLE `m_stok_awal_obat` DISABLE KEYS */;
INSERT INTO `m_stok_awal_obat` VALUES ('2018-12-01','0001',0,'2018-12-21 07:28:25'),('2018-12-01','0002',0,'2018-12-21 07:28:25'),('2018-12-01','0003',0,'2018-12-21 07:28:25'),('2019-01-01','0001',2,'2018-12-21 07:28:33'),('2019-01-01','0002',35,'2018-12-21 07:28:33'),('2019-01-01','0003',0,'2018-12-21 07:28:33');
/*!40000 ALTER TABLE `m_stok_awal_obat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_supplier`
--

DROP TABLE IF EXISTS `m_supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `m_supplier` (
  `namaSupplier` varchar(200) NOT NULL,
  `alamatSupplier` text,
  `telpSupplier` varchar(45) DEFAULT NULL,
  `konsinyasiSupplier` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`namaSupplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_supplier`
--

LOCK TABLES `m_supplier` WRITE;
/*!40000 ALTER TABLE `m_supplier` DISABLE KEYS */;
INSERT INTO `m_supplier` VALUES ('2323','234234','asdfasdf',0),('Supp','Almt supp22222','080123',1);
/*!40000 ALTER TABLE `m_supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_tindakan`
--

DROP TABLE IF EXISTS `m_tindakan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `m_tindakan` (
  `idTindakan` varchar(4) NOT NULL,
  `namaTindakan` varchar(200) DEFAULT NULL,
  `biayaTindakan` decimal(15,2) DEFAULT NULL,
  `bagianKlinik` double DEFAULT NULL,
  `bagianPetugas` double DEFAULT NULL,
  `operator` varchar(45) NOT NULL,
  `tglInput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tglUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idTindakan`),
  KEY `idTindakan` (`idTindakan`),
  KEY `idTindakan_2` (`idTindakan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_tindakan`
--

LOCK TABLES `m_tindakan` WRITE;
/*!40000 ALTER TABLE `m_tindakan` DISABLE KEYS */;
INSERT INTO `m_tindakan` VALUES ('0001','tindakan',100000.00,50,50,'Administrator','2018-11-25 13:09:34','2018-12-21 00:54:37'),('0002','taabasd',506606.00,30,70,'Administrator','2018-12-12 03:30:12','2018-12-21 00:54:31');
/*!40000 ALTER TABLE `m_tindakan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_konsultasi`
--

DROP TABLE IF EXISTS `t_konsultasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_konsultasi` (
  `idPendaftaran` int(10) NOT NULL,
  `keluhanKonsultasi` text,
  `hasilKonsultasi` text,
  `namaDokter` varchar(45) DEFAULT NULL,
  `operator` varchar(45) DEFAULT NULL,
  `tglInput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tglUpdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPendaftaran`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_konsultasi`
--

LOCK TABLES `t_konsultasi` WRITE;
/*!40000 ALTER TABLE `t_konsultasi` DISABLE KEYS */;
INSERT INTO `t_konsultasi` VALUES (1812010001,'Keluhan','Hasil Konsultasi','dr. Apa Aja Boleh','Administrator','2018-12-07 05:36:52','2018-12-07 05:36:52'),(1812170002,'ts','asdf','asd','Administrator','2018-12-17 01:47:35','2018-12-17 01:47:35'),(1812170003,'asdf','asdw545','asd','Administrator','2018-12-21 05:55:19','2018-12-21 05:55:19');
/*!40000 ALTER TABLE `t_konsultasi` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_konsultasi_AFTER_INSERT` AFTER INSERT ON `t_konsultasi` FOR EACH ROW BEGIN
	update t_pendaftaran set statKonsultasi =1 where idPendaftaran=new.idPendaftaran;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_konsultasi_AFTER_UPDATE` AFTER UPDATE ON `t_konsultasi` FOR EACH ROW BEGIN
	update t_pendaftaran set statKonsultasi =1 where idPendaftaran=new.idPendaftaran;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_konsultasi_AFTER_DELETE` AFTER DELETE ON `t_konsultasi` FOR EACH ROW BEGIN
	update t_pendaftaran set statKonsultasi =0 where idPendaftaran=old.idPendaftaran;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `t_obat_masuk`
--

DROP TABLE IF EXISTS `t_obat_masuk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_obat_masuk` (
  `idObatMasuk` int(10) NOT NULL,
  `tglObatMasuk` date DEFAULT NULL,
  `ketObatMasuk` text,
  `operator` varchar(45) DEFAULT NULL,
  `tglInput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idObatMasuk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_obat_masuk`
--

LOCK TABLES `t_obat_masuk` WRITE;
/*!40000 ALTER TABLE `t_obat_masuk` DISABLE KEYS */;
INSERT INTO `t_obat_masuk` VALUES (2018120001,'2018-12-19','asdfasdf','Administrator','2018-12-19 00:07:07'),(2018120002,'2018-12-19','asdf','Administrator','2018-12-19 05:55:28'),(2018120003,'2018-12-19','asdfasdf','Administrator','2018-12-19 05:55:37'),(2018120004,'2018-12-19','asdfasdf','Administrator','2018-12-19 05:55:47'),(2018120005,'2018-12-21','asdf','Administrator','2018-12-21 06:13:41'),(2018120006,'2018-12-21','asdf','Administrator','2018-12-21 06:14:44');
/*!40000 ALTER TABLE `t_obat_masuk` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_obat_masuk_BEFORE_DELETE` BEFORE DELETE ON `t_obat_masuk` FOR EACH ROW BEGIN
	select sum(jmlObatMasuk) into @jml from t_obat_masuk_det where idObatMasuk=old.idObatMasuk;
	select count(idObat) into @stok from t_stok_obat where idObatMasuk=old.idObatMasuk;
    
    if(@jml != @stok) then
		CALL cannot_delete_error;
	END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_obat_masuk_AFTER_DELETE` AFTER DELETE ON `t_obat_masuk` FOR EACH ROW BEGIN
	delete from t_stok_obat where idObatMasuk=old.idObatMasuk;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `t_obat_masuk_det`
--

DROP TABLE IF EXISTS `t_obat_masuk_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_obat_masuk_det` (
  `idObatMasuk` int(10) NOT NULL,
  `idObat` varchar(4) NOT NULL,
  `tglKadaluarsaObatMasuk` date NOT NULL,
  `jmlObatMasuk` double DEFAULT NULL,
  `hargaBeliObatMasuk` decimal(15,0) DEFAULT NULL,
  `namaSupplier` varchar(200) DEFAULT NULL,
  `tglObatMasuk` date DEFAULT NULL,
  `konsinyasiSupplier` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idObatMasuk`,`idObat`,`tglKadaluarsaObatMasuk`),
  CONSTRAINT `obat_masuk_detail` FOREIGN KEY (`idObatMasuk`) REFERENCES `t_obat_masuk` (`idobatmasuk`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_obat_masuk_det`
--

LOCK TABLES `t_obat_masuk_det` WRITE;
/*!40000 ALTER TABLE `t_obat_masuk_det` DISABLE KEYS */;
INSERT INTO `t_obat_masuk_det` VALUES (2018120001,'0001','2019-01-31',5,60000,'Supp','2018-12-19',1),(2018120001,'0002','2018-12-31',10,600500,'Supp','2018-12-19',1),(2018120002,'0001','2018-12-31',5,50000,'Supp','2018-12-19',1),(2018120003,'0001','2019-01-04',3,56647,'Supp','2018-12-19',1),(2018120004,'0002','2019-01-05',20,60055,'Supp','2018-12-19',1),(2018120005,'0001','2019-01-02',3,50000,'2323','2018-12-21',0),(2018120006,'0002','2019-01-05',5,60000,'2323','2018-12-21',0);
/*!40000 ALTER TABLE `t_obat_masuk_det` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_obat_masuk_det_BEFORE_INSERT` BEFORE INSERT ON `t_obat_masuk_det` FOR EACH ROW BEGIN
	select tglObatMasuk into @tgl from t_obat_masuk where idObatMasuk=new.idObatMasuk;
    set new.tglObatMasuk = @tgl;
    select konsinyasiSupplier into @konsi from m_supplier where namaSupplier=new.namaSupplier;
    set new.konsinyasiSupplier = @konsi;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_obat_masuk_det_AFTER_INSERT` AFTER INSERT ON `t_obat_masuk_det` FOR EACH ROW BEGIN
	declare i int unsigned default 0;
	while i < new.jmlObatMasuk do
		insert into t_stok_obat(idStokObat, idObat, tglKadaluarsaStokObat, idObatMasuk, hargaBeliStokObat, namaSupplier, konsinyasiSupplier) 
        values (
        concat(date_format(new.tglObatMasuk, '%Y%d%m'), concat(date_format(sysdate(6), '%h%i%s%f'))), 
        new.idObat, 
        new.tglKadaluarsaObatMasuk,
        new.idObatMasuk, 
        new.hargaBeliObatMasuk, 
        new.namaSupplier, 
		new.konsinyasiSupplier);
		set i=i+1;
	end while;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `t_pembayaran`
--

DROP TABLE IF EXISTS `t_pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_pembayaran` (
  `noPembayaran` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idPendaftaran` int(10) DEFAULT NULL,
  `jmlTagihan` decimal(15,2) DEFAULT NULL,
  `jmlPembayaran` decimal(15,2) DEFAULT NULL,
  `tglPembayaran` date NOT NULL,
  `operator` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tglInput` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`noPembayaran`) USING BTREE,
  KEY `idPembayaran` (`noPembayaran`),
  KEY `pembayaran_pendaftaran_idx` (`idPendaftaran`),
  CONSTRAINT `pembayaran_pendaftaran` FOREIGN KEY (`idPendaftaran`) REFERENCES `t_pendaftaran` (`idpendaftaran`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_pembayaran`
--

LOCK TABLES `t_pembayaran` WRITE;
/*!40000 ALTER TABLE `t_pembayaran` DISABLE KEYS */;
INSERT INTO `t_pembayaran` VALUES ('KW-2018/12/0001',1812010001,8524948.00,8600000.00,'2018-12-20','Administrator','2018-12-20 01:34:54'),('KW-2018/12/0002',1812170002,300000.00,300000.00,'2018-12-21','Administrator','2018-12-21 06:00:12'),('KW-2018/12/0003',1812170003,4393272.00,4400000.00,'2018-12-21','Administrator','2018-12-21 06:02:50');
/*!40000 ALTER TABLE `t_pembayaran` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_pembayaran_AFTER_INSERT` AFTER INSERT ON `t_pembayaran` FOR EACH ROW BEGIN
	update t_pendaftaran set statPembayaran =1 where idPendaftaran=new.idPendaftaran;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_pembayaran_AFTER_DELETE` AFTER DELETE ON `t_pembayaran` FOR EACH ROW BEGIN
	update t_pendaftaran set statPembayaran =0 where idPendaftaran=old.idPendaftaran;
    delete from t_stok_keluar where noPembayaran=old.noPembayaran;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `t_pembayaran_alat_bahan`
--

DROP TABLE IF EXISTS `t_pembayaran_alat_bahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_pembayaran_alat_bahan` (
  `noPembayaran` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idAlatBahan` varchar(4) NOT NULL,
  `namaAlatBahan` varchar(400) DEFAULT NULL,
  `satuanAlatBahan` varchar(45) DEFAULT NULL,
  `qtyAlatBahan` double DEFAULT NULL,
  `hargaAlatBahan` decimal(15,2) DEFAULT NULL,
  `tglPembayaran` date DEFAULT NULL,
  PRIMARY KEY (`noPembayaran`,`idAlatBahan`) USING BTREE,
  CONSTRAINT `pembayaran_alat_bahan` FOREIGN KEY (`noPembayaran`) REFERENCES `t_pembayaran` (`nopembayaran`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_pembayaran_alat_bahan`
--

LOCK TABLES `t_pembayaran_alat_bahan` WRITE;
/*!40000 ALTER TABLE `t_pembayaran_alat_bahan` DISABLE KEYS */;
INSERT INTO `t_pembayaran_alat_bahan` VALUES ('KW-2018/12/0001','0001','tesss','',3,50000.00,'2018-12-20'),('KW-2018/12/0001','0002','Alata','',4,322222.00,'2018-12-20'),('KW-2018/12/0003','0001','tesss','',2,50000.00,'2018-12-21'),('KW-2018/12/0003','0002','Alata','',3,322222.00,'2018-12-21');
/*!40000 ALTER TABLE `t_pembayaran_alat_bahan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_pembayaran_obat`
--

DROP TABLE IF EXISTS `t_pembayaran_obat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_pembayaran_obat` (
  `noPembayaran` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idObat` varchar(4) NOT NULL,
  `namaObat` varchar(400) DEFAULT NULL,
  `satuanObat` varchar(45) DEFAULT NULL,
  `qtyObat` double DEFAULT NULL,
  `hargaJualObat` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tglPembayaran` date DEFAULT NULL,
  PRIMARY KEY (`noPembayaran`,`idObat`) USING BTREE,
  CONSTRAINT `pembayaran_obat` FOREIGN KEY (`noPembayaran`) REFERENCES `t_pembayaran` (`nopembayaran`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_pembayaran_obat`
--

LOCK TABLES `t_pembayaran_obat` WRITE;
/*!40000 ALTER TABLE `t_pembayaran_obat` DISABLE KEYS */;
INSERT INTO `t_pembayaran_obat` VALUES ('KW-2018/12/0001','0001','test','liter',4,'5000.00','2018-12-20'),('KW-2018/12/0001','0002','astasg','strip',3,'500000.00','2018-12-20'),('KW-2018/12/0003','0001','test','liter',4,'5000.00','2018-12-21'),('KW-2018/12/0003','0002','astasg','strip',5,'500000.00','2018-12-21');
/*!40000 ALTER TABLE `t_pembayaran_obat` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_pembayaran_obat_AFTER_INSERT` AFTER INSERT ON `t_pembayaran_obat` FOR EACH ROW BEGIN
	DECLARE i int unsigned default 0;
    
    while i < new.qtyObat do   
		select idStokObat into @idStokObat from t_stok_obat where idObat = new.idObat 
        order by tglKadaluarsaStokObat, tglInput limit 1;
        
        if char_length(@idStokObat) > 0 then
			select tglKadaluarsaStokObat into @tglKadaluarsaStokObat from t_stok_obat where idStokObat = @idStokObat;
			select idObatMasuk into @idObatMasuk from t_stok_obat where idStokObat = @idStokObat;
			select hargaBeliStokObat into @hargaBeliStokObat from t_stok_obat where idStokObat = @idStokObat;
			select namaSupplier into @namaSupplier from t_stok_obat where idStokObat = @idStokObat;
			select konsinyasiSupplier into @konsinyasiSupplier from t_stok_obat where idStokObat = @idStokObat;
			select tglInput into @tglInput from t_stok_obat where idStokObat = @idStokObat;
            
			insert into t_stok_keluar(idStokObat, idObat, tglKadaluarsaStokObat, idObatMasuk, hargaBeliStokObat, namaSupplier, konsinyasiSupplier, noPembayaran, tglPembayaran, tglInput)    
            values (@idStokObat, new.idObat, @tglKadaluarsaStokObat, @idObatMasuk, @hargaBeliStokObat, @namaSupplier, @konsinyasiSupplier, new.noPembayaran, new.tglPembayaran, @tglInput); 
		end if;            
        set i=i+1;  
	end while;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `t_pembayaran_tindakan`
--

DROP TABLE IF EXISTS `t_pembayaran_tindakan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_pembayaran_tindakan` (
  `noPembayaran` varchar(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `idTindakan` varchar(4) NOT NULL,
  `namaTindakan` varchar(200) DEFAULT NULL,
  `qtyTindakan` double DEFAULT NULL,
  `biayaTindakan` decimal(15,2) DEFAULT NULL,
  `bagianKlinik` double(255,0) DEFAULT NULL,
  `bagianPetugas` double(255,0) DEFAULT NULL,
  `namaPetugas` varchar(255) DEFAULT NULL,
  `tglPembayaran` date DEFAULT NULL,
  PRIMARY KEY (`noPembayaran`,`idTindakan`) USING BTREE,
  CONSTRAINT `pembayaran_tindakan` FOREIGN KEY (`noPembayaran`) REFERENCES `t_pembayaran` (`nopembayaran`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_pembayaran_tindakan`
--

LOCK TABLES `t_pembayaran_tindakan` WRITE;
/*!40000 ALTER TABLE `t_pembayaran_tindakan` DISABLE KEYS */;
INSERT INTO `t_pembayaran_tindakan` VALUES ('KW-2018/12/0001','0001','tindakan',5,100000.00,50,30,'asdfa','2018-12-20'),('KW-2018/12/0001','0002','taabasd',10,506606.00,30,50,'dr. Apa Aja Boleh','2018-12-20'),('KW-2018/12/0002','0001','tindakan',3,100000.00,50,50,'asd','2018-12-21'),('KW-2018/12/0003','0001','tindakan',3,100000.00,50,50,'asd','2018-12-21'),('KW-2018/12/0003','0002','taabasd',1,506606.00,30,70,'asdfa','2018-12-21');
/*!40000 ALTER TABLE `t_pembayaran_tindakan` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_pembayaran_tindakan_BEFORE_INSERT` BEFORE INSERT ON `t_pembayaran_tindakan` FOR EACH ROW BEGIN
	if new.namaPetugas = '-' then
		select namaDokter into @dokter from t_konsultasi a right join t_pembayaran b on a.idPendaftaran=b.idPendaftaran 
        where noPembayaran = new.noPembayaran;
		set new.namaPetugas = @dokter;
	end if;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `t_pendaftaran`
--

DROP TABLE IF EXISTS `t_pendaftaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_pendaftaran` (
  `idPendaftaran` int(10) NOT NULL,
  `noPendaftaran` int(4) NOT NULL,
  `tglPendaftaran` date NOT NULL,
  `rmPasien` varchar(10) DEFAULT NULL,
  `operator` varchar(45) DEFAULT NULL,
  `tglInput` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `namaDokter` varchar(45) DEFAULT NULL,
  `baruOrLama` enum('b','l') DEFAULT NULL,
  `keteranganPendaftaran` text,
  `statKonsultasi` tinyint(1) NOT NULL DEFAULT '0',
  `statTindakan` tinyint(1) NOT NULL DEFAULT '0',
  `statPembayaran` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`noPendaftaran`,`tglPendaftaran`),
  UNIQUE KEY `idPendaftaran_UNIQUE` (`idPendaftaran`),
  KEY `pendaftaran_pasien_idx` (`rmPasien`),
  KEY `idPendaftaran` (`idPendaftaran`),
  KEY `idPendaftaran_2` (`idPendaftaran`),
  CONSTRAINT `pendaftaran_pasien` FOREIGN KEY (`rmPasien`) REFERENCES `m_pasien` (`rmpasien`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_pendaftaran`
--

LOCK TABLES `t_pendaftaran` WRITE;
/*!40000 ALTER TABLE `t_pendaftaran` DISABLE KEYS */;
INSERT INTO `t_pendaftaran` VALUES (1812010001,1,'2018-12-01','18.12.0001','Administrator','2018-12-01 02:58:31',NULL,'b',NULL,1,1,1),(1812170002,1,'2018-12-17','18.11.0001','Administrator','2018-12-17 01:47:20','asd','l','',1,1,1),(1812210004,1,'2018-12-21','18.12.0005','Administrator','2018-12-21 05:55:07','asd','b','asdfasdf25',0,0,0),(1812170003,2,'2018-12-17','18.12.0004','Administrator','2018-12-17 02:09:02','asd','b','asdfasdf',1,1,1);
/*!40000 ALTER TABLE `t_pendaftaran` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_pendaftaran_BEFORE_INSERT` BEFORE INSERT ON `t_pendaftaran` FOR EACH ROW BEGIN
	SELECT idPendaftaran INTO @nomor FROM t_pendaftaran WHERE 
    YEAR(tglPendaftaran) = DATE_FORMAT(new.tglPendaftaran, '%Y') and
    MONTH(tglPendaftaran) = DATE_FORMAT(new.tglPendaftaran, '%m') 
    ORDER BY right(idPendaftaran, 4) DESC LIMIT 1;

	if char_length(@nomor) > 0 then
		SET @last = concat('0000', CONVERT(right(@nomor, 4),UNSIGNED INTEGER) + 1);
		SET new.idPendaftaran = concat(DATE_FORMAT(now(),'%y%m%d'), right(@last, 4));
	else
		SET new.idPendaftaran = concat(DATE_FORMAT(now(),'%y%m%d'), '0001');
	end if;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `t_penjualan_obat`
--

DROP TABLE IF EXISTS `t_penjualan_obat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_penjualan_obat` (
  `idPenjualanObat` varchar(45) NOT NULL,
  `tglPenjualanObat` date DEFAULT NULL,
  `ketPenjualanObat` text,
  `jmlTagihan` decimal(15,2) DEFAULT NULL,
  `jmlPembayaran` decimal(15,2) DEFAULT NULL,
  `pelangganPenjualanObat` varchar(250) DEFAULT NULL,
  `operator` varchar(45) DEFAULT NULL,
  `tglInput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPenjualanObat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_penjualan_obat`
--

LOCK TABLES `t_penjualan_obat` WRITE;
/*!40000 ALTER TABLE `t_penjualan_obat` DISABLE KEYS */;
INSERT INTO `t_penjualan_obat` VALUES ('KW-OBT-2018/12/0001','2018-12-20','asdfasdf',25000.00,25000.00,'asdfa','Administrator','2018-12-20 00:45:03'),('KW-OBT-2018/12/0002','2018-12-21','34234',5000.00,5000.00,'asdf','Administrator','2018-12-21 06:15:04');
/*!40000 ALTER TABLE `t_penjualan_obat` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_pembelian_obat_AFTER_DELETE` AFTER DELETE ON `t_penjualan_obat` FOR EACH ROW BEGIN
	delete from t_stok_keluar where noPembayaran=old.idPenjualanObat;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `t_penjualan_obat_det`
--

DROP TABLE IF EXISTS `t_penjualan_obat_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_penjualan_obat_det` (
  `idPenjualanObat` varchar(45) NOT NULL,
  `idObat` varchar(4) NOT NULL,
  `namaObat` varchar(400) DEFAULT NULL,
  `satuanObat` varchar(45) DEFAULT NULL,
  `qtyObat` double DEFAULT NULL,
  `hargaJualObat` decimal(15,2) DEFAULT NULL,
  `tglPenjualanObat` date DEFAULT NULL,
  PRIMARY KEY (`idPenjualanObat`,`idObat`),
  KEY `pembelian_obat_obat_idx` (`idObat`),
  CONSTRAINT `penjualan_obat_detail` FOREIGN KEY (`idPenjualanObat`) REFERENCES `t_penjualan_obat` (`idpenjualanobat`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penjualan_obat_obat` FOREIGN KEY (`idObat`) REFERENCES `m_obat` (`idobat`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_penjualan_obat_det`
--

LOCK TABLES `t_penjualan_obat_det` WRITE;
/*!40000 ALTER TABLE `t_penjualan_obat_det` DISABLE KEYS */;
INSERT INTO `t_penjualan_obat_det` VALUES ('KW-OBT-2018/12/0001','0001','test','liter',5,5000.00,'2018-12-20'),('KW-OBT-2018/12/0002','0001','test','liter',1,5000.00,'2018-12-21');
/*!40000 ALTER TABLE `t_penjualan_obat_det` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_penjualan_obat_det_BEFORE_INSERT` BEFORE INSERT ON `t_penjualan_obat_det` FOR EACH ROW BEGIN
	select namaObat into @nama from m_obat where idObat=new.idObat;
	select satuanObat into @sat from m_obat where idObat=new.idObat;
    set new.namaObat = @nama;
    set new.satuanObat = @sat;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_penjualan_obat_det_AFTER_INSERT` AFTER INSERT ON `t_penjualan_obat_det` FOR EACH ROW BEGIN
	DECLARE i int unsigned default 0;
    
    while i < new.qtyObat do   
		select idStokObat into @idStokObat from t_stok_obat where idObat = new.idObat 
        order by tglKadaluarsaStokObat, tglInput limit 1;
         
        if char_length(@idStokObat) > 0 then
			select tglKadaluarsaStokObat into @tglKadaluarsaStokObat from t_stok_obat where idStokObat = @idStokObat;
			select idObatMasuk into @idObatMasuk from t_stok_obat where idStokObat = @idStokObat;
			select hargaBeliStokObat into @hargaBeliStokObat from t_stok_obat where idStokObat = @idStokObat;
			select namaSupplier into @namaSupplier from t_stok_obat where idStokObat = @idStokObat;
			select konsinyasiSupplier into @konsinyasiSupplier from t_stok_obat where idStokObat = @idStokObat;
			select tglInput into @tglInput from t_stok_obat where idStokObat = @idStokObat;
            			
			insert into t_stok_keluar(idStokObat, idObat, tglKadaluarsaStokObat, idObatMasuk, hargaBeliStokObat, namaSupplier, konsinyasiSupplier, noPembayaran, tglPembayaran, tglInput)    
            values (@idStokObat, new.idObat, @tglKadaluarsaStokObat, @idObatMasuk, @hargaBeliStokObat, @namaSupplier, @konsinyasiSupplier, new.idPenjualanObat, new.tglPenjualanObat, @tglInput); 
		end if;           
        set i=i+1;  
	end while;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `t_stok_keluar`
--

DROP TABLE IF EXISTS `t_stok_keluar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_stok_keluar` (
  `idStokObat` varchar(45) NOT NULL,
  `idObat` varchar(4) DEFAULT NULL,
  `tglKadaluarsaStokObat` date DEFAULT NULL,
  `idObatMasuk` int(10) DEFAULT NULL,
  `hargaBeliStokObat` decimal(15,2) DEFAULT NULL,
  `namaSupplier` varchar(200) DEFAULT NULL,
  `konsinyasiSupplier` tinyint(1) DEFAULT NULL,
  `tglInput` timestamp NULL DEFAULT NULL,
  `noPembayaran` varchar(25) DEFAULT NULL,
  `tglPembayaran` date DEFAULT NULL,
  PRIMARY KEY (`idStokObat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_stok_keluar`
--

LOCK TABLES `t_stok_keluar` WRITE;
/*!40000 ALTER TABLE `t_stok_keluar` DISABLE KEYS */;
INSERT INTO `t_stok_keluar` VALUES ('20181912015528258048','0001','2018-12-31',2018120002,50000.00,'Supp',1,'2018-12-19 05:55:28','KW-OBT-2018/12/0001','2018-12-20'),('20181912015528258237','0001','2018-12-31',2018120002,50000.00,'Supp',1,'2018-12-19 05:55:28','KW-OBT-2018/12/0001','2018-12-20'),('20181912015528258284','0001','2018-12-31',2018120002,50000.00,'Supp',1,'2018-12-19 05:55:28','KW-OBT-2018/12/0001','2018-12-20'),('20181912015528258333','0001','2018-12-31',2018120002,50000.00,'Supp',1,'2018-12-19 05:55:28','KW-OBT-2018/12/0001','2018-12-20'),('20181912015528258385','0001','2018-12-31',2018120002,50000.00,'Supp',1,'2018-12-19 05:55:28','KW-OBT-2018/12/0001','2018-12-20'),('20181912015537109718','0001','2019-01-04',2018120003,56647.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0001','2018-12-20'),('20181912015537109932','0001','2019-01-04',2018120003,56647.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0001','2018-12-20'),('20181912015537109991','0001','2019-01-04',2018120003,56647.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0001','2018-12-20'),('20181912080707389689','0001','2019-01-31',2018120001,60000.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0001','2018-12-20'),('20181912080707389781','0001','2019-01-31',2018120001,60000.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0003','2018-12-21'),('20181912080707389824','0001','2019-01-31',2018120001,60000.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0003','2018-12-21'),('20181912080707389856','0001','2019-01-31',2018120001,60000.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0003','2018-12-21'),('20181912080707389887','0001','2019-01-31',2018120001,60000.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0003','2018-12-21'),('20181912080707390983','0002','2018-12-31',2018120001,600500.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0003','2018-12-21'),('20181912080707391006','0002','2018-12-31',2018120001,600500.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0003','2018-12-21'),('20181912080707391032','0002','2018-12-31',2018120001,600500.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0003','2018-12-21'),('20181912080707391053','0002','2018-12-31',2018120001,600500.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0003','2018-12-21'),('20181912080707391072','0002','2018-12-31',2018120001,600500.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0003','2018-12-21'),('20181912080707391095','0002','2018-12-31',2018120001,600500.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0001','2018-12-20'),('20181912080707391118','0002','2018-12-31',2018120001,600500.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0001','2018-12-20'),('20181912080707391143','0002','2018-12-31',2018120001,600500.00,'Supp',1,'0000-00-00 00:00:00','KW-2018/12/0001','2018-12-20'),('20182112021341022307','0001','2019-01-02',2018120005,50000.00,'2323',0,'2018-12-21 06:13:41','KW-OBT-2018/12/0002','2018-12-21');
/*!40000 ALTER TABLE `t_stok_keluar` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_stok_keluar_AFTER_INSERT` AFTER INSERT ON `t_stok_keluar` FOR EACH ROW BEGIN
	delete from t_stok_obat where idStokObat=new.idStokObat;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_stok_keluar_AFTER_DELETE` AFTER DELETE ON `t_stok_keluar` FOR EACH ROW BEGIN
	insert into t_stok_obat(idStokObat, idObat, tglKadaluarsaStokObat, idObatMasuk, hargaBeliStokObat, namaSupplier, konsinyasiSupplier, tglInput)
    values (old.idStokObat, old.idObat, old.tglKadaluarsaStokObat, old.idObatMasuk, old.hargaBeliStokObat, old.namaSupplier, old.konsinyasiSupplier, tglInput);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `t_stok_obat`
--

DROP TABLE IF EXISTS `t_stok_obat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_stok_obat` (
  `idStokObat` varchar(45) NOT NULL,
  `idObat` varchar(4) DEFAULT NULL,
  `tglKadaluarsaStokObat` date DEFAULT NULL,
  `idObatMasuk` int(10) DEFAULT NULL,
  `hargaBeliStokObat` decimal(15,2) DEFAULT NULL,
  `namaSupplier` varchar(200) DEFAULT NULL,
  `konsinyasiSupplier` tinyint(1) DEFAULT NULL,
  `tglInput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idStokObat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_stok_obat`
--

LOCK TABLES `t_stok_obat` WRITE;
/*!40000 ALTER TABLE `t_stok_obat` DISABLE KEYS */;
INSERT INTO `t_stok_obat` VALUES ('20181912015547736047','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736162','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736192','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736216','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736242','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736265','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736286','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736307','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736332','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736352','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736373','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736394','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736414','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736439','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736459','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736480','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736500','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736524','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736544','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912015547736565','0002','2019-01-05',2018120004,60055.00,'Supp',1,'0000-00-00 00:00:00'),('20181912080707390920','0002','2018-12-31',2018120001,600500.00,'Supp',1,'0000-00-00 00:00:00'),('20181912080707390960','0002','2018-12-31',2018120001,600500.00,'Supp',1,'0000-00-00 00:00:00'),('20182112021341022483','0001','2019-01-02',2018120005,50000.00,'2323',0,'2018-12-21 06:13:41'),('20182112021341022543','0001','2019-01-02',2018120005,50000.00,'2323',0,'2018-12-21 06:13:41'),('20182112021444457185','0002','2019-01-05',2018120006,60000.00,'2323',0,'2018-12-21 06:14:44'),('20182112021444457238','0002','2019-01-05',2018120006,60000.00,'2323',0,'2018-12-21 06:14:44'),('20182112021444457264','0002','2019-01-05',2018120006,60000.00,'2323',0,'2018-12-21 06:14:44'),('20182112021444457302','0002','2019-01-05',2018120006,60000.00,'2323',0,'2018-12-21 06:14:44'),('20182112021444457338','0002','2019-01-05',2018120006,60000.00,'2323',0,'2018-12-21 06:14:44');
/*!40000 ALTER TABLE `t_stok_obat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_tindakan`
--

DROP TABLE IF EXISTS `t_tindakan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_tindakan` (
  `idPendaftaran` int(10) NOT NULL,
  `operator` varchar(45) DEFAULT NULL,
  `tglInput` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idPendaftaran`),
  KEY `idPendaftaran` (`idPendaftaran`),
  KEY `idPendaftaran_2` (`idPendaftaran`),
  CONSTRAINT `pemeriksaan_pendaftaran` FOREIGN KEY (`idPendaftaran`) REFERENCES `t_pendaftaran` (`idpendaftaran`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_tindakan`
--

LOCK TABLES `t_tindakan` WRITE;
/*!40000 ALTER TABLE `t_tindakan` DISABLE KEYS */;
INSERT INTO `t_tindakan` VALUES (1812010001,'Administrator','2018-12-12 03:31:28'),(1812170002,'Administrator','2018-12-17 01:50:28'),(1812170003,'Administrator','2018-12-21 05:55:53');
/*!40000 ALTER TABLE `t_tindakan` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_pemeriksaan_AFTER_INSERT` AFTER INSERT ON `t_tindakan` FOR EACH ROW BEGIN
	update t_pendaftaran set statTindakan =1 where idPendaftaran=new.idPendaftaran;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `t_pemeriksaan_AFTER_DELETE` AFTER DELETE ON `t_tindakan` FOR EACH ROW BEGIN
	update t_pendaftaran set statTindakan =0 where idPendaftaran=old.idPendaftaran;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `t_tindakan_alat_bahan`
--

DROP TABLE IF EXISTS `t_tindakan_alat_bahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_tindakan_alat_bahan` (
  `idPendaftaran` int(10) NOT NULL,
  `idAlatBahan` varchar(4) NOT NULL,
  `qtyAlatBahan` double NOT NULL,
  KEY `pemeriksaan_alat_bahan__idx` (`idAlatBahan`),
  KEY `pemeriksaan_alat_bahan_idx` (`idPendaftaran`),
  CONSTRAINT `tindakan_alat_bahan` FOREIGN KEY (`idPendaftaran`) REFERENCES `t_tindakan` (`idpendaftaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tindakan_alat_bahan_maseter` FOREIGN KEY (`idAlatBahan`) REFERENCES `m_alat_bahan` (`idalatbahan`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_tindakan_alat_bahan`
--

LOCK TABLES `t_tindakan_alat_bahan` WRITE;
/*!40000 ALTER TABLE `t_tindakan_alat_bahan` DISABLE KEYS */;
INSERT INTO `t_tindakan_alat_bahan` VALUES (1812010001,'0001',3),(1812010001,'0002',4),(1812170003,'0001',2),(1812170003,'0002',3);
/*!40000 ALTER TABLE `t_tindakan_alat_bahan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_tindakan_det`
--

DROP TABLE IF EXISTS `t_tindakan_det`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_tindakan_det` (
  `idPendaftaran` int(10) NOT NULL,
  `idTindakan` varchar(4) NOT NULL,
  `qtyTindakan` double NOT NULL,
  `namaPetugas` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  KEY `pemeriksaan_tindakan_idx` (`idPendaftaran`),
  KEY `pemeriksaan_tindakan__idx` (`idTindakan`),
  CONSTRAINT `tindakan_detail` FOREIGN KEY (`idPendaftaran`) REFERENCES `t_tindakan` (`idpendaftaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tindakan_master` FOREIGN KEY (`idTindakan`) REFERENCES `m_tindakan` (`idtindakan`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_tindakan_det`
--

LOCK TABLES `t_tindakan_det` WRITE;
/*!40000 ALTER TABLE `t_tindakan_det` DISABLE KEYS */;
INSERT INTO `t_tindakan_det` VALUES (1812010001,'0001',5,'asdfa'),(1812010001,'0002',10,'-'),(1812170002,'0001',3,'-'),(1812170003,'0001',3,'-'),(1812170003,'0002',1,'asdfa');
/*!40000 ALTER TABLE `t_tindakan_det` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_tindakan_obat`
--

DROP TABLE IF EXISTS `t_tindakan_obat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `t_tindakan_obat` (
  `idPendaftaran` int(10) NOT NULL,
  `idObat` varchar(4) NOT NULL,
  `qtyObat` double NOT NULL,
  KEY `pemeriksaan_obat_idx` (`idPendaftaran`),
  KEY `pemeriksaan_obat__idx` (`idObat`),
  CONSTRAINT `tindakan_obat` FOREIGN KEY (`idPendaftaran`) REFERENCES `t_tindakan` (`idpendaftaran`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tindakan_obat_master` FOREIGN KEY (`idObat`) REFERENCES `m_obat` (`idobat`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_tindakan_obat`
--

LOCK TABLES `t_tindakan_obat` WRITE;
/*!40000 ALTER TABLE `t_tindakan_obat` DISABLE KEYS */;
INSERT INTO `t_tindakan_obat` VALUES (1812010001,'0001',4),(1812010001,'0002',30),(1812170003,'0001',4),(1812170003,'0002',5);
/*!40000 ALTER TABLE `t_tindakan_obat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_penerimaan`
--

DROP TABLE IF EXISTS `vw_penerimaan`;
/*!50001 DROP VIEW IF EXISTS `vw_penerimaan`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8mb4;
/*!50001 CREATE VIEW `vw_penerimaan` AS SELECT 
 1 AS `noPenerimaan`,
 1 AS `pelanggan`,
 1 AS `operator`,
 1 AS `tglPenerimaan`,
 1 AS `jmlPenerimaan`,
 1 AS `jmlObat`,
 1 AS `bagianPetugas`,
 1 AS `bagianKlinik`,
 1 AS `jmlTindakan`,
 1 AS `jmlAlatBahan`,
 1 AS `tglInput`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'klinik'
--

--
-- Dumping routines for database 'klinik'
--
/*!50003 DROP FUNCTION IF EXISTS `getTglKadaluarsa` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `getTglKadaluarsa`(
	obat varchar(4)
) RETURNS int(11)
    READS SQL DATA
    DETERMINISTIC
BEGIN
	DECLARE jml integer;
	SELECT COUNT(*) into jml FROM (select count(1) from t_stok_obat where idObat=obat group by tglKadaluarsaStokObat) tb;
RETURN jml;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `vw_penerimaan`
--

/*!50001 DROP VIEW IF EXISTS `vw_penerimaan`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_penerimaan` AS select `a`.`noPembayaran` AS `noPenerimaan`,`c`.`namaPasien` AS `pelanggan`,`a`.`operator` AS `operator`,`a`.`tglPembayaran` AS `tglPenerimaan`,`a`.`jmlTagihan` AS `jmlPenerimaan`,(select sum((`obt`.`hargaJualObat` * `obt`.`qtyObat`)) from `t_pembayaran_obat` `obt` where (`obt`.`noPembayaran` = `a`.`noPembayaran`)) AS `jmlObat`,(select ((sum((`tdk`.`biayaTindakan` * `tdk`.`qtyTindakan`)) * `tdk`.`bagianPetugas`) / 100) from `t_pembayaran_tindakan` `tdk` where (`tdk`.`noPembayaran` = `a`.`noPembayaran`)) AS `bagianPetugas`,(select ((sum((`tdk`.`biayaTindakan` * `tdk`.`qtyTindakan`)) * `tdk`.`bagianKlinik`) / 100) from `t_pembayaran_tindakan` `tdk` where (`tdk`.`noPembayaran` = `a`.`noPembayaran`)) AS `bagianKlinik`,(select sum((`tdk`.`biayaTindakan` * `tdk`.`qtyTindakan`)) from `t_pembayaran_tindakan` `tdk` where (`tdk`.`noPembayaran` = `a`.`noPembayaran`)) AS `jmlTindakan`,(select sum((`abh`.`hargaAlatBahan` * `abh`.`qtyAlatBahan`)) from `t_pembayaran_alat_bahan` `abh` where (`abh`.`noPembayaran` = `a`.`noPembayaran`)) AS `jmlAlatBahan`,`a`.`tglInput` AS `tglInput` from (`t_pembayaran` `a` left join (`t_pendaftaran` `b` left join `m_pasien` `c` on((`b`.`rmPasien` = `c`.`rmPasien`))) on((`a`.`idPendaftaran` = `b`.`idPendaftaran`))) union all select `t_penjualan_obat`.`idPenjualanObat` AS `noPenerimaan`,`t_penjualan_obat`.`pelangganPenjualanObat` AS `pelanggan`,`t_penjualan_obat`.`operator` AS `operator`,`t_penjualan_obat`.`tglPenjualanObat` AS `tglPenerimaan`,`t_penjualan_obat`.`jmlTagihan` AS `jmlPenerimaan`,0 AS `bagianPetugas`,0 AS `bagianKlinik`,0 AS `jmlTindakan`,`t_penjualan_obat`.`jmlTagihan` AS `jmlObat`,0 AS `jmlAlatBahan`,`t_penjualan_obat`.`tglInput` AS `tglInput` from `t_penjualan_obat` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-21 15:35:59
