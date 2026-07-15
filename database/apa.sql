-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: apa
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `distribusi`
--

DROP TABLE IF EXISTS `distribusi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `distribusi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `dokumen_id` int unsigned NOT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('Dipinjam','Dikembalikan') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Dipinjam',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `distribusi_dokumen_id_foreign` (`dokumen_id`),
  CONSTRAINT `distribusi_dokumen_id_foreign` FOREIGN KEY (`dokumen_id`) REFERENCES `dokumen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distribusi`
--

LOCK TABLES `distribusi` WRITE;
/*!40000 ALTER TABLE `distribusi` DISABLE KEYS */;
INSERT INTO `distribusi` VALUES (6,11,8,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 11:09:02','2026-06-28 11:11:43'),(7,11,8,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 11:14:38','2026-06-28 11:16:36'),(8,8,8,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 11:23:30','2026-06-28 11:24:28'),(9,28,8,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 11:38:04','2026-06-28 11:38:46'),(10,8,8,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 11:40:23','2026-06-28 11:41:20'),(11,11,8,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 11:43:03','2026-06-28 11:43:50'),(12,8,8,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 11:45:39','2026-06-28 11:46:42'),(13,8,8,'2026-06-04','2026-06-26','Dikembalikan','2026-06-28 11:50:40','2026-06-28 13:34:40'),(14,8,8,'2026-06-13','2026-06-25','Dikembalikan','2026-06-28 12:00:43','2026-06-28 13:49:04'),(15,28,8,'2026-06-03','2026-06-20','Dikembalikan','2026-06-28 12:02:27','2026-06-28 12:04:42'),(16,28,8,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 12:03:56','2026-06-28 12:31:01'),(17,11,6,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 12:11:50','2026-06-28 12:18:25'),(18,11,8,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 12:11:58','2026-06-28 12:12:30'),(19,28,6,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 12:25:35','2026-06-28 12:30:49'),(21,11,6,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 12:35:25','2026-06-28 12:35:42'),(22,11,8,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 12:37:03','2026-06-28 12:38:43'),(23,11,6,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 12:37:09','2026-06-28 12:39:20'),(24,11,6,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 12:47:10','2026-06-28 12:49:15'),(25,11,8,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 12:47:17','2026-06-28 12:48:27'),(27,20,6,'2026-06-28','2026-06-30','Dikembalikan','2026-06-28 13:20:34','2026-06-28 13:37:29'),(28,20,8,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 13:24:53','2026-06-28 13:34:49'),(31,18,8,'2026-06-28',NULL,'Dikembalikan','2026-06-28 13:42:59','2026-06-28 13:46:05'),(32,18,6,'2026-06-28',NULL,'Dikembalikan','2026-06-28 13:43:10','2026-06-28 13:46:53'),(33,11,6,'2026-06-28','2026-07-02','Dikembalikan','2026-06-28 13:44:56','2026-06-28 13:50:04'),(34,8,8,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 13:49:04','2026-06-28 13:51:19'),(35,8,6,'2026-06-28','2026-07-05','Dikembalikan','2026-06-28 13:49:17','2026-06-28 13:50:35'),(36,11,6,'2026-06-29','2026-07-06','Dikembalikan','2026-06-29 14:20:47','2026-06-29 14:21:07'),(37,11,6,'2026-06-29','2026-07-06','Dikembalikan','2026-06-29 14:21:56','2026-06-29 14:23:58'),(38,34,9,'2026-07-02','2026-07-09','Dikembalikan','2026-07-02 03:12:10','2026-07-02 03:13:27'),(39,30,6,'2026-07-09','2026-07-09','Dipinjam','2026-07-09 01:00:36','2026-07-09 01:00:36'),(40,8,6,'2026-07-09','2026-07-16','Dipinjam','2026-07-09 01:15:15','2026-07-09 01:15:15'),(41,11,6,'2026-07-07','2026-07-08','Dikembalikan','2026-07-09 01:19:17','2026-07-09 01:32:53'),(42,28,6,'2026-07-09','2026-07-16','Dikembalikan','2026-07-09 01:20:43','2026-07-09 01:26:53'),(43,11,8,'2026-07-09','2026-07-16','Dipinjam','2026-07-09 01:28:42','2026-07-09 01:28:42'),(44,15,6,'2026-07-09','2026-07-16','Dipinjam','2026-07-09 01:32:30','2026-07-09 01:32:30'),(45,11,6,'2026-07-05','2026-07-06','Dipinjam','2026-07-09 01:32:53','2026-07-09 01:32:53'),(46,11,10,'2026-07-09','2026-07-16','Dikembalikan','2026-07-09 05:01:28','2026-07-09 05:02:42');
/*!40000 ALTER TABLE `distribusi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dokumen`
--

DROP TABLE IF EXISTS `dokumen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dokumen` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `tanggal` date NOT NULL,
  `file_dokumen` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori_id` int unsigned DEFAULT NULL,
  `unit_id` int unsigned DEFAULT NULL,
  `ukuran_file` int DEFAULT NULL,
  `ekstensi_file` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dokumen_kategori_id_foreign` (`kategori_id`),
  KEY `dokumen_unit_id_foreign` (`unit_id`),
  CONSTRAINT `dokumen_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `dokumen_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dokumen`
--

LOCK TABLES `dokumen` WRITE;
/*!40000 ALTER TABLE `dokumen` DISABLE KEYS */;
INSERT INTO `dokumen` VALUES (1,'Laporan Pencapaian Target Q1 2026','Panduan lengkap mengenai tata cara dan prosedur standar operasi yang harus dipatuhi oleh seluruh karyawan divisi terkait.','2026-04-27','1777299014_88913c5d120f294fefc8.pdf',5,2,152045,'pdf','2026-04-27 14:10:14','2026-04-27 14:10:14'),(2,'Surat Keputusan Pengangkatan Karyawan Tetap','Arsip penting yang merangkum segala aktivitas operasional maupun finansial bulan lalu untuk evaluasi kinerja.','2026-05-19','1779157176_0ecc88f77402323c2ed8.pdf',1,5,3858490,'pdf','2026-05-19 02:19:35','2026-05-19 02:19:35'),(3,'SOP Penggunaan Inventaris Kantor','Dokumen ini berisi detail mengenai pencapaian dan rekapitulasi data selama periode yang ditentukan. Harap dibaca dengan teliti.','2026-05-19','1779157519_176f0e16df4ee387eee3.pdf',2,2,3858490,'pdf','2026-05-19 02:25:19','2026-05-19 02:25:19'),(4,'Proposal Kegiatan Ulang Tahun Perusahaan','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru.','2026-05-19','1779192059_a0b55e9af8bc47ce0fca.pdf',6,1,3673115,'pdf','2026-05-19 12:00:59','2026-05-19 12:00:59'),(5,'Laporan Keuangan Bulanan Mei','Arsip penting yang merangkum segala aktivitas operasional maupun finansial bulan lalu untuk evaluasi kinerja.','2026-05-26','1779757612_fb2e5591359a1c7a83cd.pdf',5,3,251518,'pdf','2026-05-26 01:06:52','2026-05-26 01:06:52'),(6,'Surat Edaran Libur Nasional','Rencana anggaran dan kegiatan yang akan dilaksanakan dalam waktu dekat. Membutuhkan persetujuan dari dewan direksi.','2026-05-26','1779759037_aa04976f0640c225ecab.csv',5,2,22484,'csv','2026-05-26 01:30:37','2026-05-26 01:30:37'),(7,'Formulir Pengajuan Cuti Tahunan','Panduan lengkap mengenai tata cara dan prosedur standar operasi yang harus dipatuhi oleh seluruh karyawan divisi terkait.','2026-05-26','1779760501_015f24b2358b2f8d4e70.pdf',7,2,2045038,'pdf','2026-05-26 01:55:01','2026-05-26 01:55:01'),(8,'Dokumentasi Sistem Keamanan Jaringan fja;slkjfa;ldsk','Dokumen ini berisi detail mengenai pencapaian dan rekapitulasi data selama periode yang ditentukan. Harap dibaca dengan teliti. hhha;lsjdfa;sldk','2026-05-26','1782654635_312b6c7969dc6ac632b8.pdf',7,6,251518,'pdf','2026-05-26 01:55:21','2026-06-28 13:52:11'),(9,'Laporan Audit Internal Tahunan','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru.','2026-05-26','1779760631_a68702340d6c54ca3d0f.docx',5,3,10815,'docx','2026-05-26 01:57:11','2026-05-26 01:57:11'),(10,'Proposal Anggaran Kuartal ke-3','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru.','2026-06-08','1780944999_a1050a29b0d78b2bdfc7.pdf',6,3,7460015,'pdf','2026-06-08 18:56:39','2026-06-08 18:56:39'),(11,'Analisis Kinerja Operasional Perusahaan petugas','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru. petugas','2026-06-08','1783573362_1b4dfbc617e2950b54cf.docx',7,2,2203215,'pdf','2026-06-08 18:57:04','2026-07-09 05:03:15'),(12,'Rencana Aksi Strategis IT 2026','Arsip penting yang merangkum segala aktivitas operasional maupun finansial bulan lalu untuk evaluasi kinerja.','2026-06-08','1780945389_5655c7678a9eaa2da302.pdf',2,6,2203215,'pdf','2026-06-08 19:03:09','2026-06-08 19:03:09'),(13,'Kebijakan Keamanan Data Pengguna','Arsip penting yang merangkum segala aktivitas operasional maupun finansial bulan lalu untuk evaluasi kinerja.','2026-06-08','1780945491_ee017cb5f2a232db7eb3.pdf',7,1,368420,'pdf','2026-06-08 19:04:50','2026-06-08 19:04:50'),(14,'Panduan Kerja Work from Home','Arsip penting yang merangkum segala aktivitas operasional maupun finansial bulan lalu untuk evaluasi kinerja.','2026-06-22','1782142620_fcb245392baea36ff45b.pdf',2,3,4194477,'pdf','2026-06-22 15:37:00','2026-06-22 15:37:00'),(15,'Formulir Klaim Karyawan','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru.','2026-06-22','1782151390_986b257887c50a3a1d1d.pdf',7,5,2203215,'pdf','2026-06-22 18:03:10','2026-06-22 18:03:10'),(16,'Laporan Penjualan Kuartalan','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru.','2026-06-22','1782154557_1f1d720737adb684e9c5.pdf',5,4,2203215,'pdf','2026-06-22 18:55:57','2026-06-22 18:55:57'),(17,'Memorandum Kesepahaman Kerja Sama','Arsip penting yang merangkum segala aktivitas operasional maupun finansial bulan lalu untuk evaluasi kinerja.','2026-06-22','1782154740_680343f00fb97ae92eed.pdf',3,4,3858490,'pdf','2026-06-22 18:58:59','2026-06-22 18:58:59'),(18,'Surat Panggilan Wawancara Kerja farel 333','Rencana anggaran dan kegiatan yang akan dilaksanakan dalam waktu dekat. Membutuhkan persetujuan dari dewan direksi. farell 333','2026-06-22','1782654365_a02f1ad211dad6efe0be.docx',7,6,3237251,'pdf','2026-06-22 19:31:04','2026-06-28 13:47:49'),(19,'SOP Mitigasi Bencana Kantor','Dokumen ini berisi detail mengenai pencapaian dan rekapitulasi data selama periode yang ditentukan. Harap dibaca dengan teliti.','2026-06-22','1782157102_515904b852621c4963d4.pdf',2,4,3237251,'pdf','2026-06-22 19:38:22','2026-06-22 19:38:22'),(20,'Laporan Tahunan CSR Perusahaan','Dokumen ini berisi detail mengenai pencapaian dan rekapitulasi data selama periode yang ditentukan. Harap dibaca dengan teliti.','2026-06-22','1782158581_4b3cb02a9e2d5dbf5d08.pdf',5,3,7460015,'pdf','2026-06-22 20:03:00','2026-06-22 20:03:00'),(21,'Laporan Pencapaian Target Q1 2026','Panduan lengkap mengenai tata cara dan prosedur standar operasi yang harus dipatuhi oleh seluruh karyawan divisi terkait.','2026-06-25','1782356579_2e01b98d296097aa9da8.docx',5,4,4417082,'docx','2026-06-25 03:02:59','2026-06-25 03:02:59'),(22,'Surat Keputusan Pengangkatan Karyawan Tetap','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru.','2026-06-25','1782359977_0bf60e396b328bca7332.pdf',1,3,17235441,'pdf','2026-06-25 03:59:37','2026-06-25 03:59:37'),(23,'SOP Penggunaan Inventaris Kantor','Arsip penting yang merangkum segala aktivitas operasional maupun finansial bulan lalu untuk evaluasi kinerja.','2026-06-25','1782361451_d4b165e689521273d5bf.pdf',2,3,32287,'pdf','2026-06-25 04:24:11','2026-06-25 04:24:11'),(24,'Proposal Kegiatan Ulang Tahun Perusahaan','Dokumen ini berisi detail mengenai pencapaian dan rekapitulasi data selama periode yang ditentukan. Harap dibaca dengan teliti.','2026-06-25','1782361563_11ed363496f8f8b45ae7.docx',6,2,21932,'docx','2026-06-25 04:26:03','2026-06-25 04:26:03'),(25,'Laporan Keuangan Bulanan Mei','Dokumen ini berisi detail mengenai pencapaian dan rekapitulasi data selama periode yang ditentukan. Harap dibaca dengan teliti.','2026-06-25','1782362054_ad37f3baee16be5c25e9.pdf',5,6,393693,'pdf','2026-06-25 04:34:14','2026-06-25 04:34:14'),(26,'Surat Edaran Libur Nasional','Rencana anggaran dan kegiatan yang akan dilaksanakan dalam waktu dekat. Membutuhkan persetujuan dari dewan direksi.','2026-06-25','1782363433_8019abe485998710d6ff.docx',1,3,10082063,'docx','2026-06-25 04:57:13','2026-06-25 04:57:13'),(27,'Formulir Pengajuan Cuti Tahunan','Arsip penting yang merangkum segala aktivitas operasional maupun finansial bulan lalu untuk evaluasi kinerja.','2026-06-26','1782464347_c0f117b1af74153ac50d.pdf',7,4,17235441,'pdf','2026-06-26 08:59:07','2026-06-26 08:59:07'),(28,'Dokumentasi Sistem Keamanan Jaringan','Arsip penting yang merangkum segala aktivitas operasional maupun finansial bulan lalu untuk evaluasi kinerja.','2026-06-28','1782646726_7c6f54e003a8acec4027.pdf',3,4,10082063,'docx','2026-06-28 05:17:19','2026-06-28 11:39:02'),(29,'Sk Pegawai 2026','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru.','2026-04-27','sk_pegawai_2026.pdf',1,2,152045,'pdf','2026-04-27 14:10:14','2026-04-27 14:10:14'),(30,'jkjhkj','kjkh.kj','2026-06-28','1782657396_488ee6b169515b87f693.pdf',5,4,NULL,NULL,'2026-06-28 14:36:36','2026-06-28 14:36:36'),(31,'lgjh','ukygkyu','2026-06-28','1782657444_e28b84b1df82eb2bdfba.docx',4,3,NULL,NULL,'2026-06-28 14:37:24','2026-06-28 14:37:24'),(32,'rtytytyrtryt','jhgjh','2026-06-28','1782657486_dd7cc078a5122a7b80f7.csv',7,5,NULL,NULL,'2026-06-28 14:38:06','2026-06-28 14:38:06'),(33,'tes','sdafsd','2026-07-02','1782960167_29ca5c9cb2228c636927.docx',4,4,NULL,NULL,'2026-07-02 02:42:47','2026-07-02 02:42:47'),(34,'revisi','revisi','2026-07-02','1782962007_ec85ab839711580f59a1.docx',3,3,NULL,NULL,'2026-07-02 03:09:44','2026-07-02 03:14:24'),(35,'apakek','lorem aldkjf;lkadsjf','2026-07-09','1783573106_71d6eee810dd06ea02c9.docx',1,1,NULL,NULL,'2026-07-09 04:58:26','2026-07-09 04:58:26'),(36,'dj;flakdsf','asdfasdf','2026-07-09','1783574538_235778fb156c0a70b2cd.csv',4,5,NULL,NULL,'2026-07-09 05:22:18','2026-07-09 05:22:56');
/*!40000 ALTER TABLE `dokumen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `izin`
--

DROP TABLE IF EXISTS `izin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `izin` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `dokumen_id` int unsigned NOT NULL,
  `pesan` text COLLATE utf8mb4_general_ci,
  `pesan_admin` text COLLATE utf8mb4_general_ci,
  `status_izin` enum('Pending','Disetujui','Ditolak','Selesai') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  `tgl_pengajuan` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `izin_user_id_foreign` (`user_id`),
  KEY `izin_dokumen_id_foreign` (`dokumen_id`),
  CONSTRAINT `izin_dokumen_id_foreign` FOREIGN KEY (`dokumen_id`) REFERENCES `dokumen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `izin_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `izin`
--

LOCK TABLES `izin` WRITE;
/*!40000 ALTER TABLE `izin` DISABLE KEYS */;
INSERT INTO `izin` VALUES (12,8,11,'saya farel ',NULL,'Disetujui','2026-07-09 01:28:20','2026-06-28 11:04:35','2026-07-09 01:28:42'),(13,8,8,'ini lagi',NULL,'Selesai','2026-06-28 13:48:30','2026-06-28 11:23:03','2026-06-28 13:51:19'),(14,8,28,'yaelah bang plis lahh',NULL,'Selesai','2026-06-28 12:03:46','2026-06-28 11:37:44','2026-06-28 12:04:42'),(15,6,11,'saaya izin lagi bang',NULL,'Disetujui','2026-07-09 01:29:26','2026-06-28 12:10:21','2026-07-09 01:32:53'),(16,6,28,'fasdfsa',NULL,'Selesai','2026-06-29 14:48:51','2026-06-28 12:25:20','2026-07-09 01:26:53'),(17,6,20,'Langsung diizinkan admin','Langsung diizinkan admin','Selesai','2026-06-28 13:20:34','2026-06-28 13:20:34','2026-06-28 13:37:29'),(18,8,20,'bang saya juga',NULL,'Selesai','2026-06-28 13:24:38','2026-06-28 13:24:38','2026-06-28 13:34:49'),(19,6,8,'bang',NULL,'Disetujui','2026-07-09 01:13:54','2026-06-28 13:38:32','2026-07-09 01:15:15'),(20,8,18,'Langsung diizinkan admin','Langsung diizinkan admin','Selesai','2026-06-28 13:42:59','2026-06-28 13:42:59','2026-06-28 13:46:05'),(21,6,18,'Langsung diizinkan admin','Langsung diizinkan admin','Selesai','2026-06-28 13:43:10','2026-06-28 13:43:10','2026-06-28 13:46:53'),(22,9,34,'bang minjem dong ',NULL,'Selesai','2026-07-02 03:11:17','2026-07-02 03:11:17','2026-07-02 03:13:27'),(23,6,30,'bang minjem bang\r\n',NULL,'Disetujui','2026-07-09 00:59:37','2026-07-09 00:59:37','2026-07-09 01:00:36'),(24,6,15,'ini petugas arsip lagi 2308',NULL,'Disetujui','2026-07-09 01:20:16','2026-07-09 01:20:16','2026-07-09 01:32:30'),(25,10,11,'bang saya minta akses ',NULL,'Selesai','2026-07-09 05:00:46','2026-07-09 05:00:46','2026-07-09 05:02:42');
/*!40000 ALTER TABLE `izin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kategori`
--

DROP TABLE IF EXISTS `kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kategori` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kategori`
--

LOCK TABLES `kategori` WRITE;
/*!40000 ALTER TABLE `kategori` DISABLE KEYS */;
INSERT INTO `kategori` VALUES (1,'Surat Keputusan (SK)','2026-06-13 05:30:07','2026-06-13 05:30:07'),(2,'SOP (Standard Operating Procedure)','2026-06-16 05:30:07','2026-06-16 05:30:07'),(3,'Surat Masuk','2026-06-19 05:30:07','2026-06-19 05:30:07'),(4,'Surat Keluar','2026-06-22 05:30:07','2026-06-22 05:30:07'),(5,'Laporan','2026-06-24 05:30:07','2026-06-24 05:30:07'),(6,'Proposal','2026-06-26 05:30:07','2026-06-26 05:30:07'),(7,'Formulir','2026-06-28 05:30:07','2026-06-28 05:30:07');
/*!40000 ALTER TABLE `kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (7,'2026-04-21-003001','App\\Database\\Migrations\\CreateUsersTable','default','App',1777298290,1),(8,'2026-04-21-003002','App\\Database\\Migrations\\CreateKategoriTable','default','App',1777298290,1),(9,'2026-04-21-003003','App\\Database\\Migrations\\CreateUnitTable','default','App',1777298290,1),(10,'2026-04-21-003004','App\\Database\\Migrations\\CreateDokumenTable','default','App',1777298290,1),(11,'2026-04-21-003005','App\\Database\\Migrations\\CreateDistribusiTable','default','App',1777298290,1),(12,'2026-04-21-003006','App\\Database\\Migrations\\CreateRiwayatTable','default','App',1777298290,1),(13,'2026-04-27-003001','App\\Database\\Migrations\\CreateIzinTable','default','App',1777298290,1),(14,'2026-04-27-003002','App\\Database\\Migrations\\CreateRevisiTable','default','App',1777300376,2),(15,'2026-06-22-184635','App\\Database\\Migrations\\AlterDistribusiPeminjamToUserId','default','App',1782154055,3),(16,'2026-06-22-192844','App\\Database\\Migrations\\AlterRiwayatDokumenIdNullable','default','App',1782156546,4),(17,'2026-06-28-062303','App\\Database\\Migrations\\AddPesanAdminToIzin','default','App',1782627800,5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revisi`
--

DROP TABLE IF EXISTS `revisi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `revisi` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `dokumen_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `pesan_revisi` text COLLATE utf8mb4_general_ci,
  `tanggal` date DEFAULT NULL,
  `kategori_id` int unsigned NOT NULL,
  `unit_id` int unsigned NOT NULL,
  `file_dokumen` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_revisi` enum('Pending','Disetujui','Ditolak') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending',
  `pesan_admin` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `revisi_dokumen_id_foreign` (`dokumen_id`),
  KEY `revisi_user_id_foreign` (`user_id`),
  CONSTRAINT `revisi_dokumen_id_foreign` FOREIGN KEY (`dokumen_id`) REFERENCES `dokumen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `revisi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revisi`
--

LOCK TABLES `revisi` WRITE;
/*!40000 ALTER TABLE `revisi` DISABLE KEYS */;
INSERT INTO `revisi` VALUES (3,11,8,'Analisis Kinerja Operasional Perusahaan bla bla bla','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru bla bla bla',NULL,'2026-06-08',7,2,'1782645396_ba87bc12afc5e4b98476.pdf','Ditolak',NULL,'2026-06-28 11:16:36','2026-06-28 11:20:30'),(4,8,8,'Dokumentasi Sistem Keamanan Jaringan','Dokumen ini berisi detail mengenai pencapaian dan rekapitulasi data selama periode yang ditentukan. Harap dibaca dengan teliti.','ini saya ganti bagian apa gitu di file nya terus apa gitu apa dan apa ','2026-05-26',7,6,'1782645868_814f34aa8ec3f836f2f5.docx','Disetujui',NULL,'2026-06-28 11:24:28','2026-06-28 11:36:58'),(5,28,8,'Dokumentasi Sistem Keamanan Jaringan','Arsip penting yang merangkum segala aktivitas operasional maupun finansial bulan lalu untuk evaluasi kinerja.','revisi dah','2026-06-28',3,4,'1782646726_7c6f54e003a8acec4027.pdf','Disetujui',NULL,'2026-06-28 11:38:46','2026-06-28 11:39:02'),(6,8,8,'Dokumentasi Sistem Keamanan Jaringanlaksdjfa;lsd','Dokumen ini berisi detail mengenai pencapaian dan rekapitulasi data selama periode yang ditentukan. Harap dibaca dengan teliti.al;ksdjf;aslkd','tolak ajah','2026-05-26',7,6,'1782646880_f2cdcada9fb1c2ac5ed5.pdf','Ditolak',NULL,'2026-06-28 11:41:20','2026-06-28 11:41:49'),(8,8,8,'Dokumentasi Sistem Keamanan Jaringan hhhh','Dokumen ini berisi detail mengenai pencapaian dan rekapitulasi data selama periode yang ditentukan. Harap dibaca dengan teliti. hhh','Dokumentasi Sistem Keamanan Jaringan \'dklfa;ldskf','2026-05-26',7,6,'1782647202_a9e3f1b4355512af7759.pdf','Disetujui',NULL,'2026-06-28 11:46:42','2026-06-28 11:47:03'),(10,11,6,'Analisis Kinerja Operasional Perusahaan','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru.','ads;lfkjads;lkfjasd','2026-06-08',7,2,'1782635210_69e14318fbe8d0b80168.docx','Ditolak',NULL,'2026-06-28 12:18:25','2026-06-28 12:18:57'),(11,11,6,'Analisis Kinerja Operasional Perusahaan','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru.','ganti','2026-06-08',7,2,'1782635210_69e14318fbe8d0b80168.docx','Ditolak',NULL,'2026-06-28 12:26:33','2026-06-28 12:26:53'),(13,11,8,'Analisis Kinerja Operasional Perusahaan farel','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru. farel','ini farel','2026-06-08',7,2,'1782650323_d39ee7fd9aad3f820729.pdf','Ditolak','Revisi ditolak otomatis karena pengajuan revisi lain untuk dokumen ini telah disetujui.','2026-06-28 12:38:43','2026-06-28 12:40:48'),(14,11,6,'Analisis Kinerja Operasional Perusahaan petugas','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru. petugas','petugas','2026-06-08',7,2,'1782650360_6dd23c52742f6ea61a7a.pdf','Disetujui',NULL,'2026-06-28 12:39:20','2026-06-28 12:40:48'),(15,11,8,'Analisis Kinerja Operasional Perusahaan petugas','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru. petugas','ini farel 2','2026-06-08',7,2,'1782650759_fda68f01f0801d690dff.pdf','Disetujui',NULL,'2026-06-28 12:45:59','2026-06-28 13:42:20'),(16,11,8,'Analisis Kinerja Operasional Perusahaan farel 2','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru. farel 2','farel 2','2026-06-08',7,2,'1782650907_68cf5587cfd67e26f66f.pdf','Disetujui',NULL,'2026-06-28 12:48:27','2026-06-28 12:50:24'),(17,11,6,'Analisis Kinerja Operasional Perusahaan petugas2','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru. petugas2','petugas2','2026-06-08',7,2,'1782650955_fb15d9e7210310a5ca5a.pdf','Disetujui',NULL,'2026-06-28 12:49:15','2026-06-28 12:50:08'),(18,18,8,'Surat Panggilan Wawancara Kerja farel 333','Rencana anggaran dan kegiatan yang akan dilaksanakan dalam waktu dekat. Membutuhkan persetujuan dari dewan direksi. farell 333','ini farel 333','2026-06-22',7,6,'1782654365_a02f1ad211dad6efe0be.docx','Disetujui',NULL,'2026-06-28 13:46:05','2026-06-28 13:47:49'),(19,18,6,'Surat Panggilan Wawancara Kerja ini petugas 33','Rencana anggaran dan kegiatan yang akan dilaksanakan dalam waktu dekat. Membutuhkan persetujuan dari dewan direksi. etugas 333','petugas333','2026-06-22',7,6,'1782654413_1223496d0db9ca86ab46.pdf','Disetujui',NULL,'2026-06-28 13:46:53','2026-06-28 13:47:13'),(20,8,6,'Dokumentasi Sistem Keamanan Jaringan fja;slkjfa;ldsk','Dokumen ini berisi detail mengenai pencapaian dan rekapitulasi data selama periode yang ditentukan. Harap dibaca dengan teliti. hhha;lsjdfa;sldk','laskdf;alskdf','2026-05-26',7,6,'1782654635_312b6c7969dc6ac632b8.pdf','Disetujui',NULL,'2026-06-28 13:50:35','2026-06-28 13:52:11'),(21,8,8,'Dokumentasi Sistem Keamanan Jaringan hhhh aku rapi','Dokumen ini berisi detail mengenai pencapaian dan rekapitulasi data selama periode yang ditentukan. Harap dibaca dengan teliti. hhh aku rapi','aku rapi','2026-05-26',7,6,'1782654679_507fc8cdfdf24a5d18f0.docx','Disetujui',NULL,'2026-06-28 13:51:19','2026-06-28 13:51:55'),(22,11,6,'Analisis Kinerja Operasional Perusahaan petugas','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru. petugas','tes','2026-06-08',7,2,'1782742867_fd2690735a52216b3af4.pdf','Disetujui',NULL,'2026-06-29 14:21:07','2026-07-09 01:14:58'),(23,11,6,'Analisis Kinerja Operasional Perusahaan petugas','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru. petugas','saya ganti bagian halaman file 12 di bagian kesimpulan','2026-06-08',7,2,'1782743038_3fe1b8a5d8a8d8194989.pdf','Disetujui',NULL,'2026-06-29 14:23:58','2026-06-29 14:24:49'),(24,34,9,'revisi','revisi','ngubah judul deskripsi sama isi file ','2026-07-02',3,3,'1782962007_ec85ab839711580f59a1.docx','Disetujui',NULL,'2026-07-02 03:13:27','2026-07-02 03:14:24'),(25,11,10,'Analisis Kinerja Operasional Perusahaan petugas','Merupakan dokumen resmi yang disahkan oleh pimpinan perusahaan mengenai kebijakan dan regulasi terbaru. petugas','bang saay ubah dokumen ','2026-06-08',7,2,'1783573362_1b4dfbc617e2950b54cf.docx','Disetujui',NULL,'2026-07-09 05:02:42','2026-07-09 05:03:15');
/*!40000 ALTER TABLE `revisi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `riwayat`
--

DROP TABLE IF EXISTS `riwayat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `riwayat` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `dokumen_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned DEFAULT NULL,
  `aksi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `riwayat_user_id_foreign` (`user_id`),
  KEY `riwayat_dokumen_id_foreign` (`dokumen_id`),
  CONSTRAINT `riwayat_dokumen_id_foreign` FOREIGN KEY (`dokumen_id`) REFERENCES `dokumen` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `riwayat_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `riwayat`
--

LOCK TABLES `riwayat` WRITE;
/*!40000 ALTER TABLE `riwayat` DISABLE KEYS */;
INSERT INTO `riwayat` VALUES (21,11,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan\" oleh farel','2026-06-24 13:00:34'),(22,11,5,'Tolak Izin','Menolak izin akses dokumen \"Analisis Kinerja Operasional Perusahaan\" untuk karyawan farel dengan alasan: \"kamu gajelas coba kamu jelaskan administrasi apa yang kamu maksud dan kamu kerja bagian apa \" oleh admin','2026-06-28 13:00:34'),(23,11,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan\" oleh farel','2026-06-23 13:00:34'),(24,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan\" untuk karyawan farel oleh admin','2026-06-27 13:00:34'),(25,11,8,'Kembalikan Dokumen','Karyawan farel mengembalikan dokumen tanpa usulan revisi','2026-06-28 13:00:34'),(26,11,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan\" oleh farel','2026-06-27 13:00:34'),(27,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan\" untuk karyawan farel oleh admin','2026-06-26 13:00:34'),(28,11,8,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-26 13:00:34'),(29,11,5,'Penolakan Perubahan','Perubahan dokumen ditolak oleh Admin. Pesan: ','2026-06-25 13:00:34'),(30,8,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan\" oleh farel','2026-06-25 13:00:34'),(31,8,5,'Setujui Izin','Menyetujui izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan\" untuk karyawan farel oleh admin','2026-06-24 13:00:34'),(32,8,8,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-24 13:00:34'),(33,8,5,'Persetujuan Perubahan','Perubahan dari karyawan 8 telah disetujui dan diterapkan.','2026-06-23 13:00:34'),(34,28,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan\" oleh farel','2026-06-23 13:00:34'),(35,28,5,'Setujui Izin','Menyetujui izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan\" untuk karyawan farel oleh admin','2026-06-28 13:00:34'),(36,28,8,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-28 13:00:34'),(37,28,5,'Persetujuan Perubahan','Perubahan dari karyawan 8 telah disetujui dan diterapkan.','2026-06-27 13:00:34'),(38,8,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan\" oleh farel','2026-06-27 13:00:34'),(39,8,5,'Setujui Izin','Menyetujui izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan\" untuk karyawan farel oleh admin','2026-06-26 13:00:34'),(40,8,8,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-26 13:00:34'),(41,8,5,'Penolakan Perubahan','Perubahan dokumen ditolak oleh Admin. Pesan: ','2026-06-25 13:00:34'),(42,11,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan\" oleh farel','2026-06-25 13:00:34'),(43,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan\" untuk karyawan farel oleh admin','2026-06-24 13:00:34'),(44,11,8,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-24 13:00:34'),(45,11,5,'Penolakan Perubahan','Perubahan dokumen ditolak oleh Admin. Pesan: ','2026-06-23 13:00:34'),(46,8,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan\" oleh farel','2026-06-23 13:00:34'),(47,8,5,'Setujui Izin','Menyetujui izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan\" untuk karyawan farel oleh admin','2026-06-28 13:00:34'),(48,8,8,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-28 13:00:34'),(49,8,5,'Persetujuan Perubahan','Perubahan dari karyawan 8 telah disetujui dan diterapkan.','2026-06-27 13:00:34'),(50,8,5,'Distribusi Dokumen','Dokumen dipinjamkan/didistribusikan ke user ID: 8','2026-06-26 13:00:34'),(51,8,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" oleh farel','2026-06-27 13:00:34'),(52,8,5,'Tolak Izin','Menolak izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" untuk karyawan farel dengan alasan: \"ga ah\" oleh admin','2026-06-25 13:00:34'),(53,8,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" oleh farel','2026-06-26 13:00:34'),(54,8,5,'Tolak Izin','Menolak izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" untuk karyawan farel dengan alasan: \"gaboleh\" oleh admin','2026-06-24 13:00:34'),(55,8,5,'Distribusi Dokumen','Dokumen dipinjamkan/didistribusikan ke user ID: 8','2026-06-23 13:00:34'),(56,28,5,'Distribusi Dokumen','Dokumen dipinjamkan/didistribusikan ke user ID: 8','2026-06-28 13:00:34'),(57,28,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan\" oleh farel','2026-06-25 13:00:34'),(58,28,5,'Tolak Izin','Menolak izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan\" untuk karyawan farel dengan alasan: \"ga mau aku badmood\r\n\" oleh admin','2026-06-27 13:00:34'),(59,28,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan\" oleh farel','2026-06-24 13:00:34'),(60,28,5,'Setujui Izin','Menyetujui izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan\" untuk karyawan farel oleh admin','2026-06-26 13:00:34'),(61,28,8,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-23 13:00:34'),(62,28,5,'Penolakan Perubahan','Perubahan dokumen ditolak oleh Admin. Pesan: ','2026-06-25 13:00:34'),(63,11,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan\" oleh petugas','2026-06-26 13:00:34'),(64,11,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan\" oleh farel','2026-06-28 13:00:34'),(65,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan\" untuk karyawan petugas oleh admin','2026-06-24 13:00:34'),(66,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan\" untuk karyawan farel oleh admin','2026-06-23 13:00:34'),(67,11,8,'Kembalikan Dokumen','Karyawan farel mengembalikan dokumen tanpa usulan revisi','2026-06-27 13:00:34'),(68,11,6,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-25 13:00:34'),(69,11,5,'Penolakan Perubahan','Perubahan dokumen ditolak oleh Admin. Pesan: ','2026-06-28 13:00:34'),(70,28,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan\" oleh petugas','2026-06-24 13:00:34'),(71,28,5,'Setujui Izin','Menyetujui izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan\" untuk karyawan petugas oleh admin','2026-06-27 13:00:34'),(72,11,8,'Kembalikan Dokumen','Karyawan farel mengembalikan dokumen tanpa usulan revisi','2026-06-26 13:00:34'),(73,11,6,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-23 13:00:34'),(74,11,5,'Penolakan Perubahan','Perubahan dokumen ditolak oleh Admin. Pesan: ','2026-06-26 13:00:34'),(75,11,6,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-28 13:00:34'),(76,11,5,'Penolakan Perubahan','Perubahan dokumen ditolak oleh Admin. Pesan: gajelas lu','2026-06-25 13:00:34'),(77,11,6,'Kembalikan Dokumen','Karyawan petugas mengembalikan dokumen tanpa usulan revisi','2026-06-27 13:00:34'),(78,28,6,'Kembalikan Dokumen','Karyawan petugas mengembalikan dokumen tanpa usulan revisi','2026-06-26 13:00:34'),(79,11,8,'Kembalikan Dokumen','Karyawan farel mengembalikan dokumen tanpa usulan revisi','2026-06-25 13:00:34'),(80,28,8,'Kembalikan Dokumen','Karyawan farel mengembalikan dokumen tanpa usulan revisi','2026-06-24 13:00:34'),(81,8,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" oleh farel','2026-06-23 13:00:34'),(82,8,5,'Setujui Izin','Menyetujui izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" untuk karyawan farel oleh admin','2026-06-24 13:00:34'),(83,28,6,'Kembalikan Dokumen','Karyawan petugas mengembalikan dokumen tanpa usulan revisi','2026-06-25 13:00:34'),(84,11,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan\" oleh petugas','2026-06-24 13:00:34'),(85,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan\" untuk karyawan petugas oleh admin','2026-06-23 13:00:34'),(86,11,6,'Kembalikan Dokumen','Karyawan petugas mengembalikan dokumen tanpa usulan revisi','2026-06-23 13:00:34'),(87,11,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan\" oleh petugas','2026-06-28 13:00:34'),(88,11,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan\" oleh farel','2026-06-28 13:00:34'),(89,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan\" untuk karyawan farel oleh admin','2026-06-28 13:00:34'),(90,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan\" untuk karyawan petugas oleh admin','2026-06-27 13:00:34'),(91,11,8,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-27 13:00:34'),(92,11,6,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-27 13:00:34'),(93,11,5,'Persetujuan Perubahan','Perubahan dari karyawan 6 telah disetujui dan diterapkan.','2026-06-26 13:00:34'),(94,11,5,'Penolakan Perubahan','Sistem menolak otomatis perubahan dari karyawan 8. Pesan: Revisi ditolak otomatis karena pengajuan revisi lain untuk dokumen ini telah disetujui.','2026-06-25 13:00:34'),(95,11,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" oleh petugas','2026-06-26 13:00:34'),(96,11,8,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-26 13:00:34'),(97,11,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" oleh farel','2026-06-25 13:00:34'),(98,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" untuk karyawan petugas oleh admin','2026-06-24 13:00:34'),(99,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" untuk karyawan farel oleh admin','2026-06-23 13:00:34'),(100,11,8,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-24 13:00:34'),(101,11,6,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-25 13:00:34'),(102,11,5,'Persetujuan Perubahan','Perubahan dari karyawan 6 telah disetujui dan diterapkan.','2026-06-28 13:00:34'),(103,11,5,'Persetujuan Perubahan','Perubahan dari karyawan 8 telah disetujui dan diterapkan.','2026-06-27 13:00:34'),(104,20,5,'Distribusi Dokumen','Dokumen dipinjamkan/didistribusikan ke user ID: 6','2026-06-28 13:12:55'),(105,20,5,'Distribusi Dokumen','Dokumen dipinjamkan/didistribusikan ke user ID: 6','2026-06-28 13:20:34'),(106,20,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Laporan Tahunan CSR Perusahaan\" oleh farel','2026-06-28 13:24:38'),(107,20,5,'Setujui Izin','Menyetujui izin akses dokumen \"Laporan Tahunan CSR Perusahaan\" untuk karyawan farel oleh admin','2026-06-28 13:24:53'),(108,8,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" oleh farel','2026-06-28 13:26:55'),(109,8,5,'Setujui Izin','Menyetujui izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" untuk karyawan farel oleh admin','2026-06-28 13:27:38'),(110,8,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" oleh farel','2026-06-28 13:28:08'),(111,8,5,'Setujui Izin','Menyetujui izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" untuk karyawan farel oleh admin','2026-06-28 13:28:20'),(112,8,8,'Kembalikan Dokumen','Karyawan farel mengembalikan dokumen tanpa usulan revisi','2026-06-28 13:34:40'),(113,20,8,'Kembalikan Dokumen','Karyawan farel mengembalikan dokumen tanpa usulan revisi','2026-06-28 13:34:49'),(114,20,8,'Kembalikan Dokumen','Karyawan farel mengembalikan dokumen tanpa usulan revisi','2026-06-28 13:36:18'),(115,20,6,'Kembalikan Dokumen','Karyawan petugas mengembalikan dokumen tanpa usulan revisi','2026-06-28 13:37:29'),(116,8,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" oleh petugas','2026-06-28 13:38:32'),(117,11,5,'Persetujuan Perubahan','Perubahan dari karyawan 8 telah disetujui dan diterapkan.','2026-06-28 13:42:20'),(118,18,5,'Distribusi Dokumen','Dokumen dipinjamkan/didistribusikan ke user ID: 8','2026-06-28 13:42:59'),(119,18,5,'Distribusi Dokumen','Dokumen dipinjamkan/didistribusikan ke user ID: 6','2026-06-28 13:43:10'),(120,11,5,'Distribusi Dokumen','Dokumen dipinjamkan/didistribusikan ke user ID: 6','2026-06-28 13:44:56'),(121,18,8,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-28 13:46:05'),(122,18,6,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-28 13:46:53'),(123,18,5,'Persetujuan Perubahan','Perubahan dari karyawan 6 telah disetujui dan diterapkan.','2026-06-28 13:47:13'),(124,18,5,'Persetujuan Perubahan','Perubahan dari karyawan 8 telah disetujui dan diterapkan.','2026-06-28 13:47:49'),(125,8,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" oleh farel','2026-06-28 13:48:30'),(126,8,5,'Setujui Izin','Menyetujui izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" untuk karyawan farel oleh admin','2026-06-28 13:49:04'),(127,8,5,'Setujui Izin','Menyetujui izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan hhhh\" untuk karyawan petugas oleh admin','2026-06-28 13:49:17'),(128,11,6,'Kembalikan Dokumen','Karyawan petugas mengembalikan dokumen tanpa usulan revisi','2026-06-28 13:50:04'),(129,8,6,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-28 13:50:35'),(130,8,8,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-28 13:51:19'),(131,8,5,'Persetujuan Perubahan','Perubahan dari karyawan 8 telah disetujui dan diterapkan.','2026-06-28 13:51:55'),(132,8,5,'Persetujuan Perubahan','Perubahan dari karyawan 6 telah disetujui dan diterapkan.','2026-06-28 13:52:11'),(133,30,5,'Upload Dokumen','Dokumen baru diunggah oleh admin','2026-06-28 14:36:36'),(134,31,5,'Upload Dokumen','Dokumen baru diunggah oleh admin','2026-06-28 14:37:24'),(135,32,5,'Upload Dokumen','Dokumen baru diunggah oleh admin','2026-06-28 14:38:06'),(136,11,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" oleh petugas','2026-06-29 14:20:34'),(137,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" untuk karyawan petugas oleh admin','2026-06-29 14:20:47'),(138,11,6,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-29 14:21:07'),(139,11,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" oleh petugas','2026-06-29 14:21:28'),(140,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" untuk karyawan petugas oleh admin','2026-06-29 14:21:56'),(141,11,6,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-06-29 14:23:58'),(142,11,5,'Persetujuan Perubahan','Perubahan dari karyawan 6 telah disetujui dan diterapkan.','2026-06-29 14:24:49'),(143,11,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" oleh petugas','2026-06-29 14:45:33'),(144,28,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan\" oleh petugas','2026-06-29 14:48:51'),(145,33,5,'Upload Dokumen','Dokumen baru diunggah oleh admin','2026-07-02 02:42:47'),(146,34,5,'Upload Dokumen','Dokumen baru diunggah oleh admin','2026-07-02 03:09:44'),(147,NULL,5,'Tambah User','User baru ditambahkan: iam (karyawan) oleh admin','2026-07-02 03:10:30'),(148,34,9,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"aaa;ldskjf;alsdkjfads\" oleh iam','2026-07-02 03:11:17'),(149,34,5,'Setujui Izin','Menyetujui izin akses dokumen \"aaa;ldskjf;alsdkjfads\" untuk karyawan iam oleh admin','2026-07-02 03:12:10'),(150,34,9,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-07-02 03:13:27'),(151,34,5,'Persetujuan Perubahan','Perubahan dari karyawan 9 telah disetujui dan diterapkan.','2026-07-02 03:14:24'),(152,30,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"jkjhkj\" oleh petugas','2026-07-09 00:59:37'),(153,30,5,'Setujui Izin','Menyetujui izin akses dokumen \"jkjhkj\" untuk karyawan petugas oleh admin','2026-07-09 01:00:36'),(154,8,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Dokumentasi Sistem Keamanan Jaringan fja;slkjfa;ldsk\" oleh petugas','2026-07-09 01:13:54'),(155,11,5,'Persetujuan Perubahan','Perubahan dari karyawan 6 telah disetujui dan diterapkan.','2026-07-09 01:14:58'),(156,8,5,'Setujui Izin','Menyetujui izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan fja;slkjfa;ldsk\" untuk karyawan petugas oleh admin','2026-07-09 01:15:15'),(157,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" untuk karyawan petugas oleh admin','2026-07-09 01:19:17'),(158,15,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Formulir Klaim Karyawan\" oleh petugas','2026-07-09 01:20:16'),(159,28,5,'Setujui Izin','Menyetujui izin akses dokumen \"Dokumentasi Sistem Keamanan Jaringan\" untuk karyawan petugas oleh admin','2026-07-09 01:20:43'),(160,28,6,'Kembalikan Dokumen','Karyawan petugas mengembalikan dokumen tanpa usulan revisi','2026-07-09 01:26:53'),(161,11,8,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" oleh farel','2026-07-09 01:28:20'),(162,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" untuk karyawan farel oleh admin','2026-07-09 01:28:42'),(163,11,6,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" oleh petugas','2026-07-09 01:29:26'),(164,15,5,'Setujui Izin','Menyetujui izin akses dokumen \"Formulir Klaim Karyawan\" untuk karyawan petugas oleh admin','2026-07-09 01:32:30'),(165,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" untuk karyawan petugas oleh admin','2026-07-09 01:32:53'),(166,35,5,'Upload Dokumen','Dokumen baru diunggah oleh admin','2026-07-09 04:58:26'),(167,NULL,5,'Tambah User','User baru ditambahkan: akbar (karyawan) oleh admin','2026-07-09 04:59:41'),(168,11,10,'Ajukan Izin','Mengajukan permohonan izin akses untuk dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" oleh akbar','2026-07-09 05:00:46'),(169,11,5,'Setujui Izin','Menyetujui izin akses dokumen \"Analisis Kinerja Operasional Perusahaan petugas\" untuk karyawan akbar oleh admin','2026-07-09 05:01:28'),(170,11,10,'Ajukan Revisi','Mengajukan draft perubahan dokumen','2026-07-09 05:02:42'),(171,11,5,'Persetujuan Perubahan','Perubahan dari karyawan 10 telah disetujui dan diterapkan.','2026-07-09 05:03:15'),(172,36,5,'Upload Dokumen','Dokumen baru diunggah oleh admin','2026-07-09 05:22:18'),(173,36,5,'Edit Dokumen','Dokumen diperbarui oleh admin','2026-07-09 05:22:56');
/*!40000 ALTER TABLE `riwayat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unit` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (1,'HRD / Personalia','2026-06-18 05:30:07','2026-06-18 05:30:07'),(2,'Finance / Keuangan','2026-06-20 05:30:07','2026-06-20 05:30:07'),(3,'IT / Teknologi','2026-06-22 05:30:07','2026-06-22 05:30:07'),(4,'Marketing / Pemasaran','2026-06-24 05:30:07','2026-06-24 05:30:07'),(5,'Operations / Operasional','2026-06-26 05:30:07','2026-06-26 05:30:07'),(6,'Legal / Hukum','2026-06-28 05:30:07','2026-06-28 05:30:07');
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'admin',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'NamekianP','Namekian','Namekiany@gmail.com','$2y$10$91VY32aAxNvTmB1XTVtBi.4dC2Mn1BwnqlPqHTQoS0ZTJkEZgK5f2','admin','2026-05-20 11:48:59','2026-06-22 19:13:11'),(5,'admin','Administrator Utama','admin@example.com','$2y$10$7tz.HL68fr0Njgv4DlErjO8aNalUN2FuqRPOCgbf0ficy4s3vYVwq','admin','2026-05-26 01:52:59','2026-05-26 01:52:59'),(6,'petugas','Petugas Arsip','petugas@example.com','$2y$10$cqnnQ99WMafTDSYV7R45V.1NtV4nSYDept4Bgqt6ML0TNOPqzomV6','karyawan','2026-05-26 01:52:59','2026-05-26 01:52:59'),(8,'farel','farel','farel@gmail.com','$2y$10$wprOqCFYvo4oVLZDUBEO8e/USmYVSS6TaBTvMMPPURCZS80x0egce','karyawan','2026-06-22 19:13:59','2026-06-25 03:08:42'),(9,'iam','iam','iam@gmail.com','$2y$10$CpPVVhs6mS/ozLv4AXiJfusbHsF94tAflliroxXYPm9hWSEG25i9S','karyawan','2026-07-02 03:10:30','2026-07-02 03:10:30'),(10,'akbar','akbar','akbar@gmail.com','$2y$10$gbQrdI7vmlKoNXEhCNl57OWZSzd/WhfG8/pnEhIn5ImItp4rX9o2S','karyawan','2026-07-09 04:59:41','2026-07-09 04:59:41');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-15 23:00:54
