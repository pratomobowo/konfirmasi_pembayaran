-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: konfirmasi_usbypkp
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.24.04.1

-- MySQL dump modified for older MySQL versions
-- Using utf8mb4_unicode_ci instead of utf8mb4_0900_ai_ci
-- Tables and data only (no database creation)

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
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity_logs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_role` varchar(255) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `reference_id` varchar(255) DEFAULT NULL,
  `description` text,
  `old_values` text,
  `new_values` text,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_user_id_foreign` (`user_id`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,1,'Admin','super_admin','login','auth',NULL,'User Admin berhasil login',NULL,NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-18 00:01:56','2025-05-18 00:01:56'),(2,1,'Admin','super_admin','login','auth',NULL,'User Admin berhasil login',NULL,NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-18 00:01:56','2025-05-18 00:01:56'),(3,1,'Admin','super_admin','create','payment','4','Pembayaran baru dibuat untuk Cici (NIM: 6311054)',NULL,'{\"student_name\":\"Cici\",\"nim\":\"6311054\",\"email\":\"bowo@usbypkp.ac.id\",\"phone_number\":\"080808080\",\"payment_type\":\"Praktikum\",\"amount\":\"150000.00\",\"payment_proof\":\"payment_proofs\\/Up1SRWHbFEAlwFITdEQ7aFPDxLfPeSyXVEcLhgS7.jpg\",\"status\":\"pending\",\"updated_at\":\"2025-05-18T01:03:31.000000Z\",\"created_at\":\"2025-05-18T01:03:31.000000Z\",\"id\":4}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-18 01:03:32','2025-05-18 01:03:32'),(4,1,'Admin','super_admin','create','payment','5','Pembayaran baru dibuat untuk Cici (NIM: 6311054)',NULL,'{\"student_name\":\"Cici\",\"nim\":\"6311054\",\"email\":\"bowo@usbypkp.ac.id\",\"phone_number\":\"080808080\",\"payment_type\":\"Praktikum\",\"amount\":\"150000.00\",\"payment_proof\":\"payment_proofs\\/w1eKjcb3Q479imiBUbOU80yDOgQClBii7RkfSSZX.jpg\",\"status\":\"pending\",\"updated_at\":\"2025-05-18T01:08:45.000000Z\",\"created_at\":\"2025-05-18T01:08:45.000000Z\",\"id\":5}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-18 01:08:45','2025-05-18 01:08:45'),(5,1,'Admin','super_admin','update','payment','4','Pembayaran untuk Cici (NIM: 6311054) telah diverifikasi','{\"id\":4,\"student_name\":\"Cici\",\"nim\":\"6311054\",\"email\":\"bowo@usbypkp.ac.id\",\"phone_number\":\"080808080\",\"payment_type\":\"Praktikum\",\"amount\":\"150000.00\",\"payment_proof\":\"payment_proofs\\/Up1SRWHbFEAlwFITdEQ7aFPDxLfPeSyXVEcLhgS7.jpg\",\"status\":\"pending\",\"notes\":null,\"verified_at\":null,\"created_at\":\"2025-05-18T01:03:31.000000Z\",\"updated_at\":\"2025-05-18T01:03:31.000000Z\"}','{\"id\":4,\"student_name\":\"Cici\",\"nim\":\"6311054\",\"email\":\"bowo@usbypkp.ac.id\",\"phone_number\":\"080808080\",\"payment_type\":\"Praktikum\",\"amount\":\"150000.00\",\"payment_proof\":\"payment_proofs\\/Up1SRWHbFEAlwFITdEQ7aFPDxLfPeSyXVEcLhgS7.jpg\",\"status\":\"verified\",\"notes\":null,\"verified_at\":\"2025-05-18T01:10:04.000000Z\",\"created_at\":\"2025-05-18T01:03:31.000000Z\",\"updated_at\":\"2025-05-18T01:10:04.000000Z\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-18 01:10:04','2025-05-18 01:10:04'),(6,1,'Admin','super_admin','login','auth',NULL,'User Admin berhasil login',NULL,NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-18 11:41:55','2025-05-18 11:41:55'),(7,1,'Admin','super_admin','login','auth',NULL,'User Admin berhasil login',NULL,NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-18 11:41:55','2025-05-18 11:41:55'),(8,1,'Admin','super_admin','update','payment','5','Pembayaran untuk Cici (NIM: 6311054) telah ditolak dengan catatan: kacau sih','{\"id\":5,\"student_name\":\"Cici\",\"nim\":\"6311054\",\"email\":\"bowo@usbypkp.ac.id\",\"phone_number\":\"080808080\",\"payment_type\":\"Praktikum\",\"amount\":\"150000.00\",\"payment_proof\":\"payment_proofs\\/w1eKjcb3Q479imiBUbOU80yDOgQClBii7RkfSSZX.jpg\",\"status\":\"pending\",\"notes\":null,\"verified_at\":null,\"created_at\":\"2025-05-18T01:08:45.000000Z\",\"updated_at\":\"2025-05-18T01:08:45.000000Z\"}','{\"id\":5,\"student_name\":\"Cici\",\"nim\":\"6311054\",\"email\":\"bowo@usbypkp.ac.id\",\"phone_number\":\"080808080\",\"payment_type\":\"Praktikum\",\"amount\":\"150000.00\",\"payment_proof\":\"payment_proofs\\/w1eKjcb3Q479imiBUbOU80yDOgQClBii7RkfSSZX.jpg\",\"status\":\"rejected\",\"notes\":\"kacau sih\",\"verified_at\":null,\"created_at\":\"2025-05-18T01:08:45.000000Z\",\"updated_at\":\"2025-05-18T11:53:08.000000Z\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-18 11:53:08','2025-05-18 11:53:08'),(9,1,'Admin','super_admin','create','payment','6','Pembayaran baru dibuat untuk bbh (NIM: 12345)',NULL,'{\"student_name\":\"bbh\",\"nim\":\"12345\",\"email\":\"bowo@usbypkp.ac.id\",\"phone_number\":\"1234\",\"payment_type\":\"SPP\",\"amount\":\"20000.00\",\"payment_proof\":\"payment_proofs\\/aMpt1jTlt8yzxOYoQVc7V5TLvjfXQV9yH118Y9Mb.png\",\"status\":\"pending\",\"updated_at\":\"2025-05-18T12:00:13.000000Z\",\"created_at\":\"2025-05-18T12:00:13.000000Z\",\"id\":6}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-18 12:00:13','2025-05-18 12:00:13'),(10,1,'Admin','super_admin','update','payment','6','Pembayaran untuk bbh (NIM: 12345) telah ditolak dengan catatan: karena','{\"id\":6,\"student_name\":\"bbh\",\"nim\":\"12345\",\"email\":\"bowo@usbypkp.ac.id\",\"phone_number\":\"1234\",\"payment_type\":\"SPP\",\"amount\":\"20000.00\",\"payment_proof\":\"payment_proofs\\/aMpt1jTlt8yzxOYoQVc7V5TLvjfXQV9yH118Y9Mb.png\",\"status\":\"pending\",\"notes\":null,\"verified_at\":null,\"created_at\":\"2025-05-18T12:00:13.000000Z\",\"updated_at\":\"2025-05-18T12:00:13.000000Z\"}','{\"id\":6,\"student_name\":\"bbh\",\"nim\":\"12345\",\"email\":\"bowo@usbypkp.ac.id\",\"phone_number\":\"1234\",\"payment_type\":\"SPP\",\"amount\":\"20000.00\",\"payment_proof\":\"payment_proofs\\/aMpt1jTlt8yzxOYoQVc7V5TLvjfXQV9yH118Y9Mb.png\",\"status\":\"rejected\",\"notes\":\"karena\",\"verified_at\":null,\"created_at\":\"2025-05-18T12:00:13.000000Z\",\"updated_at\":\"2025-05-18T12:00:54.000000Z\"}','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-18 12:00:54','2025-05-18 12:00:54'),(11,1,'Admin','super_admin','login','auth',NULL,'User Admin berhasil login',NULL,NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-19 07:27:48','2025-05-19 07:27:48'),(12,1,'Admin','super_admin','login','auth',NULL,'User Admin berhasil login',NULL,NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-19 07:27:48','2025-05-19 07:27:48'),(13,1,'Admin','super_admin','create','payment','7','Pembayaran baru dibuat untuk bowo (NIM: 6311055)',NULL,'{\"student_name\":\"bowo\",\"nim\":\"6311055\",\"email\":\"bowo@usbypkp.ac.id\",\"phone_number\":\"020202020\",\"payment_type\":\"Praktikum\",\"amount\":\"522222.00\",\"payment_proof\":\"payment_proofs\\/MqCjqDt4bibsjQrHfTCaUafcgQcqZEuwPnzttBZv.png\",\"status\":\"pending\",\"updated_at\":\"2025-05-19T07:46:07.000000Z\",\"created_at\":\"2025-05-19T07:46:07.000000Z\",\"id\":7}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-19 07:46:07','2025-05-19 07:46:07'),(14,1,'Admin','super_admin','update','payment','7','Pembayaran untuk bowo (NIM: 6311055) telah ditolak dengan catatan: salah gambar','{\"id\":7,\"student_name\":\"bowo\",\"nim\":\"6311055\",\"email\":\"bowo@usbypkp.ac.id\",\"phone_number\":\"020202020\",\"payment_type\":\"Praktikum\",\"amount\":\"522222.00\",\"payment_proof\":\"payment_proofs\\/MqCjqDt4bibsjQrHfTCaUafcgQcqZEuwPnzttBZv.png\",\"status\":\"pending\",\"notes\":null,\"verified_at\":null,\"created_at\":\"2025-05-19T07:46:07.000000Z\",\"updated_at\":\"2025-05-19T07:46:07.000000Z\"}','{\"id\":7,\"student_name\":\"bowo\",\"nim\":\"6311055\",\"email\":\"bowo@usbypkp.ac.id\",\"phone_number\":\"020202020\",\"payment_type\":\"Praktikum\",\"amount\":\"522222.00\",\"payment_proof\":\"payment_proofs\\/MqCjqDt4bibsjQrHfTCaUafcgQcqZEuwPnzttBZv.png\",\"status\":\"rejected\",\"notes\":\"salah gambar\",\"verified_at\":null,\"created_at\":\"2025-05-19T07:46:07.000000Z\",\"updated_at\":\"2025-05-19T07:46:45.000000Z\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-19 07:46:45','2025-05-19 07:46:45'),(15,1,'Admin','super_admin','login','auth',NULL,'User Admin berhasil login',NULL,NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-20 03:34:59','2025-05-20 03:34:59'),(16,1,'Admin','super_admin','login','auth',NULL,'User Admin berhasil login',NULL,NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-20 03:34:59','2025-05-20 03:34:59'),(17,1,'Admin','super_admin','create','payment_type','6','Jenis pembayaran baru \'test\' telah dibuat',NULL,'{\"name\":\"test\",\"description\":\"test\",\"is_active\":false,\"updated_at\":\"2025-05-20T04:38:54.000000Z\",\"created_at\":\"2025-05-20T04:38:54.000000Z\",\"id\":6}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-20 04:38:54','2025-05-20 04:38:54'),(18,1,'Admin','super_admin','update','payment_type','6','Jenis pembayaran \'test\' telah diperbarui','{\"id\":6,\"name\":\"test\",\"description\":\"test\",\"is_active\":false,\"created_at\":\"2025-05-20T04:38:54.000000Z\",\"updated_at\":\"2025-05-20T04:38:54.000000Z\"}','{\"id\":6,\"name\":\"test\",\"description\":\"test\",\"is_active\":true,\"created_at\":\"2025-05-20T04:38:54.000000Z\",\"updated_at\":\"2025-05-20T04:40:38.000000Z\"}','127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-20 04:40:38','2025-05-20 04:40:38'),(19,1,'Admin','super_admin','login','auth',NULL,'User Admin berhasil login',NULL,NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-20 06:43:14','2025-05-20 06:43:14'),(20,1,'Admin','super_admin','login','auth',NULL,'User Admin berhasil login',NULL,NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','2025-05-20 06:43:14','2025-05-20 06:43:14');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email_templates` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `trigger_type` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_templates_trigger_type_unique` (`trigger_type`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_templates`
--

LOCK TABLES `email_templates` WRITE;
/*!40000 ALTER TABLE `email_templates` DISABLE KEYS */;
INSERT INTO `email_templates` VALUES (1,'Pembayaran Ditolak','Pembayaran anda ditolak!','Halo {nama}, pembayaran anda di tolak','payment_rejected',1,'2025-05-18 11:52:41','2025-05-18 11:52:41');
/*!40000 ALTER TABLE `email_templates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` text NOT NULL,
  `exception` text NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` text NOT NULL,
  `options` text,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` text NOT NULL,
  `attempts` int NOT NULL,
  `reserved_at` int DEFAULT NULL,
  `available_at` int NOT NULL,
  `created_at` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2025_05_20_060828_create_activity_logs_table',1),(2,'2025_05_20_060828_create_cache_locks_table',1),(3,'2025_05_20_060828_create_cache_table',1),(4,'2025_05_20_060828_create_email_templates_table',1),(5,'2025_05_20_060828_create_failed_jobs_table',1),(6,'2025_05_20_060828_create_job_batches_table',1),(7,'2025_05_20_060828_create_jobs_table',1),(8,'2025_05_20_060828_create_password_reset_tokens_table',1),(9,'2025_05_20_060828_create_payment_types_table',1),(10,'2025_05_20_060828_create_payments_table',1),(11,'2025_05_20_060828_create_sessions_table',1),(12,'2025_05_20_060828_create_settings_table',1),(13,'2025_05_20_060828_create_users_table',1),(14,'2025_05_20_060831_add_foreign_keys_to_activity_logs_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_types`
--

DROP TABLE IF EXISTS `payment_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_types` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payment_types_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_types`
--

LOCK TABLES `payment_types` WRITE;
/*!40000 ALTER TABLE `payment_types` DISABLE KEYS */;
INSERT INTO `payment_types` VALUES (1,'SPP','Biaya Sumbangan Pembinaan Pendidikan',1,'2025-05-17 06:21:12','2025-05-17 06:21:12'),(2,'Praktikum','Biaya kegiatan praktikum',1,'2025-05-17 06:21:12','2025-05-17 06:21:12'),(3,'Ujian','Biaya ujian semester',1,'2025-05-17 06:21:12','2025-05-17 06:21:12'),(4,'Wisuda','Biaya wisuda dan kelengkapannya',1,'2025-05-17 06:21:12','2025-05-17 06:21:12'),(5,'Lainnya','Jenis pembayaran lainnya',1,'2025-05-17 06:21:12','2025-05-17 06:21:12'),(6,'test','test',1,'2025-05-20 04:38:54','2025-05-20 04:40:38');
/*!40000 ALTER TABLE `payment_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `student_name` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `payment_type` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_proof` varchar(255) NOT NULL,
  `status` enum('pending','verified','rejected') NOT NULL DEFAULT 'pending',
  `notes` text,
  `verified_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,'Pratomo bowo','6311055','pratomobowo@gmail.com','082215711850','Praktikum',200000.00,'payment_proofs/z1qhnAasYVFC9V4bWGkCiNwPWdtRzX8TRgsZgBRB.jpg','verified',NULL,'2025-05-16 17:48:45','2025-05-16 15:36:21','2025-05-16 17:48:45'),(2,'Asiyah','6311050','asiyah@gmail.com','0822222222','SPP',1800000.00,'payment_proofs/JPxz4GwQsFJSEJxTsPZrDW3oWMU8m7aVcRzIUSZc.png','rejected','Bukti Transfer tidak valid',NULL,'2025-05-17 07:18:04','2025-05-17 07:18:51'),(3,'Fatimah Zahira','123456','zahira@gmail.com','082213311331','Praktikum',2000000.00,'payment_proofs/v9ao82Nhkm4TKm4T3hyH9g37FrA3Qjjd0sxuuzJZ.png','pending',NULL,NULL,'2025-05-17 15:54:44','2025-05-17 15:54:44'),(4,'Cici','6311054','bowo@usbypkp.ac.id','080808080','Praktikum',150000.00,'payment_proofs/Up1SRWHbFEAlwFITdEQ7aFPDxLfPeSyXVEcLhgS7.jpg','verified',NULL,'2025-05-18 01:10:04','2025-05-18 01:03:31','2025-05-18 01:10:04'),(5,'Cici','6311054','bowo@usbypkp.ac.id','080808080','Praktikum',150000.00,'payment_proofs/w1eKjcb3Q479imiBUbOU80yDOgQClBii7RkfSSZX.jpg','rejected','kacau sih',NULL,'2025-05-18 01:08:45','2025-05-18 11:53:08'),(6,'bbh','12345','bowo@usbypkp.ac.id','1234','SPP',20000.00,'payment_proofs/aMpt1jTlt8yzxOYoQVc7V5TLvjfXQV9yH118Y9Mb.png','rejected','karena',NULL,'2025-05-18 12:00:13','2025-05-18 12:00:54'),(7,'bowo','6311055','bowo@usbypkp.ac.id','020202020','Praktikum',522222.00,'payment_proofs/MqCjqDt4bibsjQrHfTCaUafcgQcqZEuwPnzttBZv.png','rejected','salah gambar',NULL,'2025-05-19 07:46:07','2025-05-19 07:46:45');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` int DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` text,
  `payload` text NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text,
  `group` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'mail_mailer','smtp','smtp',NULL,'2025-05-18 11:51:06','2025-05-18 11:51:06'),(2,'mail_host','smtp.gmail.com','smtp',NULL,'2025-05-18 11:51:06','2025-05-18 11:51:06'),(3,'mail_port','587','smtp',NULL,'2025-05-18 11:51:06','2025-05-18 11:51:06'),(4,'mail_username','noreply@usbypkp.ac.id','smtp',NULL,'2025-05-18 11:51:06','2025-05-18 11:51:06'),(5,'mail_password','dsxnkmgjcvduoxnq','smtp',NULL,'2025-05-18 11:51:06','2025-05-18 11:51:06'),(6,'mail_encryption','tls','smtp',NULL,'2025-05-18 11:51:06','2025-05-18 11:51:06'),(7,'mail_from_address','noreply@usbypkp.ac.id','smtp',NULL,'2025-05-18 11:51:06','2025-05-18 11:51:06'),(8,'mail_from_name','USBYPKP','smtp',NULL,'2025-05-18 11:51:06','2025-05-18 11:51:06');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@example.com',NULL,'$2y$12$oh0iHqxdHifg4Tr/3zskROlzckNdDvXwzMDhl1dou6OUsCfhl5IoG',NULL,'2025-05-16 06:53:01','2025-05-16 17:05:30','super_admin'),(2,'Super Admin','superadmin@example.com',NULL,'$2y$12$cfQmzb.vROiPTqh5RFx4R.EI6gRQst5rgivYKfJVGQVoqalv52WVy',NULL,'2025-05-17 05:15:51','2025-05-17 05:15:51','super_admin'),(3,'Admin Keuangan','finance@example.com',NULL,'$2y$12$5perCVANVGKCCkmMIPkcfeCZUUhD7uYOONUjirPfA5oYLxLltWSQO',NULL,'2025-05-17 05:15:52','2025-05-18 11:49:31','admin_keuangan');
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

-- Dump completed on 2025-05-20 13:44:03
