-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: carparking_db
-- ------------------------------------------------------
-- Server version	8.0.32-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `received_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `chats_customer_id_foreign` (`customer_id`),
  CONSTRAINT `chats_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chats`
--

LOCK TABLES `chats` WRITE;
/*!40000 ALTER TABLE `chats` DISABLE KEYS */;
INSERT INTO `chats` VALUES (1,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:15:08','2023-02-06 07:15:08'),(2,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:15:41','2023-02-06 07:15:41'),(3,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:26:26','2023-02-06 07:26:26'),(4,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:29:58','2023-02-06 07:29:58'),(5,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:31:53','2023-02-06 07:31:53'),(6,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:32:01','2023-02-06 07:32:01'),(7,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:32:37','2023-02-06 07:32:37'),(8,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:33:05','2023-02-06 07:33:05'),(9,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:33:56','2023-02-06 07:33:56'),(10,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:35:02','2023-02-06 07:35:02'),(11,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:35:53','2023-02-06 07:35:53'),(12,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:36:42','2023-02-06 07:36:42'),(13,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:36:50','2023-02-06 07:36:50'),(14,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:37:25','2023-02-06 07:37:25'),(15,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:38:01','2023-02-06 07:38:01'),(16,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:38:20','2023-02-06 07:38:20'),(17,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:41:03','2023-02-06 07:41:03'),(18,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:41:09','2023-02-06 07:41:09'),(19,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:41:23','2023-02-06 07:41:23'),(20,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:42:57','2023-02-06 07:42:57'),(21,1,'1','4545545',NULL,NULL,NULL,'2023-02-06 07:43:29','2023-02-06 07:43:29'),(22,1,'1','2323',NULL,NULL,NULL,'2023-02-06 07:47:21','2023-02-06 07:47:21'),(23,1,'1','2323',NULL,NULL,NULL,'2023-02-06 07:47:38','2023-02-06 07:47:38'),(24,1,'1','2323',NULL,NULL,NULL,'2023-02-06 07:52:30','2023-02-06 07:52:30'),(25,1,'1','2323',NULL,NULL,NULL,'2023-02-06 07:53:16','2023-02-06 07:53:16'),(27,1,'0',NULL,'فحص الرسالة من api',NULL,NULL,'2023-02-06 08:29:38','2023-02-06 08:29:38'),(28,7,'1','يسعد صباحك ابوعمر','hello',NULL,NULL,'2023-02-18 10:33:55','2023-02-19 09:16:51'),(29,7,'1','اكدلي على ابومحمد بخصوص يفحص','أهلا و سهلا أبو رفيق',NULL,NULL,'2023-02-19 10:16:20','2023-02-20 14:28:15'),(30,8,'1','test',NULL,NULL,NULL,'2023-03-15 13:00:13','2023-03-15 13:00:13'),(31,8,'1','33','good',NULL,NULL,'2023-03-15 13:00:34','2023-03-15 13:01:03');
/*!40000 ALTER TABLE `chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint unsigned NOT NULL DEFAULT '0',
  `near` tinyint unsigned NOT NULL DEFAULT '0',
  `bio` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`),
  UNIQUE KEY `customers_mobile_unique` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Charles Clayton','ahmedsalha130@gmail.com','2023-02-06 06:40:39','54545',1,0,NULL,'$2y$10$a6l3Px2BGxuxBU7oKcTxs.q/5EyyjXkIEMg54K2wU8jKBN0FxjsrG',NULL,NULL,'PEVMUabHuZY7FQ7VhxVmscfb9dcUFZefT1ZOKLpeXAH4S1FGzX8Z4zcWWyDp','2023-02-06 06:40:39','2023-02-24 12:45:50'),(2,'Vera Nolan','asas@s.com','2023-02-06 07:01:06','454545',1,1,NULL,'$2y$10$YUg8F/TSCZ32rTZzRsqGm.3G9wDYKhit4O2w5rxwh/Ejytge0OR.u','vera-nolan.jpg','2023-02-06 07:02:08',NULL,'2023-02-06 07:01:06','2023-02-06 07:02:08'),(4,'334dgfd','ahmed38144733@gmail.com','2023-02-06 07:57:16','23233',1,0,'232323','$2y$10$WxxyS5ckzOuQ/zLuCEadTOoNoFLTFf8VRdu9RrzjTr3n6p1qcoHtu',NULL,NULL,NULL,'2023-02-06 07:57:16','2023-02-16 15:46:19'),(5,'api','test@test.com','2023-02-16 15:47:34','0597630446',1,0,NULL,'$2y$10$/dd9/TzMN0zxBW9Uuzic4u.RcVSGQQZkicXKE74Jf9Ha5mJu6kIYy',NULL,NULL,NULL,'2023-02-16 15:47:34','2023-02-16 15:47:34'),(6,'api','tes2t@test.com','2023-02-16 15:48:44','05976304462',1,0,NULL,'$2y$10$NnUxsUS/18JQX92Isnjxo.fOwyhHRKVzF5LsOqPgQk7jmPF/wq0aC',NULL,NULL,NULL,'2023-02-16 15:48:44','2023-02-16 15:48:44'),(7,'Ahmed Abufayed','ahmedmahtech@gmail.com','2023-02-18 10:10:59','0595305026',1,0,'good descrption','$2y$10$XZw9Qm6JXPZ6ye1PGKdedOH0QtoR8Hxf4FROrqK1QtWSDhi1uwvYS',NULL,NULL,NULL,'2023-02-18 10:10:59','2023-02-24 12:47:03'),(8,'Hassan','hassan@gmail.com','2023-02-21 14:02:48','551515815',1,0,'good descrption','$2y$10$VWmdNPWIpzzC27rGZERzoO3ZQrI/FKGJH0tGWeco/KE5RPM6BMmpK','hassan.jpg',NULL,NULL,'2023-02-21 14:02:48','2023-03-09 11:40:30');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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
-- Table structure for table `intervals`
--

DROP TABLE IF EXISTS `intervals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `intervals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `start` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint unsigned NOT NULL DEFAULT '0',
  `count` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intervals`
--

LOCK TABLES `intervals` WRITE;
/*!40000 ALTER TABLE `intervals` DISABLE KEYS */;
INSERT INTO `intervals` VALUES (1,'8','9',1,2,NULL,'2023-03-07 06:26:19'),(2,'9','10',1,2,NULL,'2023-03-09 07:48:03'),(3,'10','11',1,2,NULL,'2023-03-09 08:54:43'),(4,'11','12',1,2,NULL,'2023-03-09 10:01:44'),(5,'12','13',1,2,NULL,'2023-03-09 10:56:15'),(6,'13','14',1,2,NULL,'2023-03-15 13:00:24'),(7,'14','15',1,2,NULL,'2023-03-09 11:05:10'),(8,'15','16',1,2,NULL,NULL),(9,'16','17',1,3,NULL,'2023-03-28 14:15:05'),(10,'17','18',1,2,NULL,NULL),(11,'18','19',1,2,NULL,'2023-03-07 16:11:57'),(12,'19','20',1,2,NULL,NULL),(13,'20','21',1,1,NULL,'2023-03-08 18:31:39'),(14,'21','22',1,2,NULL,'2023-02-22 20:10:34'),(15,'22','23',1,2,NULL,'2023-02-24 20:57:45'),(16,'23','24',1,2,NULL,'2023-02-24 21:55:08');
/*!40000 ALTER TABLE `intervals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `number` int NOT NULL,
  `invoice_date` date DEFAULT NULL,
  `status` tinyint unsigned NOT NULL DEFAULT '0',
  `reservation_value` decimal(8,2) DEFAULT NULL,
  `amount_commission` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `due_date` date DEFAULT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `reservation_id` bigint unsigned NOT NULL,
  `payment_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_number_unique` (`number`),
  KEY `invoices_customer_id_foreign` (`customer_id`),
  KEY `invoices_reservation_id_foreign` (`reservation_id`),
  KEY `invoices_payment_id_foreign` (`payment_id`),
  CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoices_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payment_wallets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoices_reservation_id_foreign` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (19,1677242950,'2023-02-24',0,0.00,0.51,-2.51,3.00,NULL,NULL,8,25,NULL,NULL,'2023-02-24 12:49:10','2023-02-24 12:49:10'),(20,1677269505,'2023-02-24',0,2.17,0.51,-0.34,3.00,NULL,NULL,8,26,NULL,NULL,'2023-02-24 22:11:45','2023-02-24 20:17:05'),(22,1677269986,'2023-02-24',0,4.01,0.51,1.50,3.00,NULL,NULL,8,28,NULL,NULL,'2023-02-24 20:19:46','2023-02-24 20:31:12'),(23,1677270944,'2023-02-24',0,3.01,0.51,0.50,3.00,NULL,NULL,8,29,NULL,NULL,'2023-02-24 20:35:44','2023-02-24 20:38:32'),(24,1677272066,'2023-02-24',0,3.34,0.51,0.83,3.00,NULL,NULL,8,30,NULL,NULL,'2023-02-24 20:54:26','2023-02-24 20:57:45'),(25,1677272494,'2023-02-24',0,4.01,0.51,1.50,3.00,NULL,NULL,8,31,NULL,NULL,'2023-02-24 21:01:34','2023-02-24 21:08:25'),(26,1677275482,'2023-02-24',0,4.34,0.51,1.83,3.00,NULL,NULL,8,32,NULL,NULL,'2023-02-24 21:51:22','2023-02-24 21:55:08'),(27,1678101601,'2023-03-06',0,0.17,0.51,-2.34,3.00,NULL,NULL,8,33,NULL,NULL,'2023-03-06 11:20:01','2023-03-07 01:16:39'),(29,1678168828,'2023-03-07',0,0.17,0.51,-2.34,3.00,NULL,NULL,8,35,NULL,NULL,'2023-03-07 06:00:28','2023-03-07 06:23:33'),(30,1678170310,'2023-03-07',0,0.33,0.51,-2.18,3.00,NULL,NULL,8,36,NULL,NULL,'2023-03-07 06:25:10','2023-03-07 06:26:19'),(39,1678187217,'2023-03-07',0,0.00,0.51,-2.51,3.00,NULL,NULL,8,45,NULL,NULL,'2023-03-07 11:06:57','2023-03-07 11:06:57'),(41,1678205421,'2023-03-07',0,1.50,0.51,-1.01,3.00,NULL,NULL,8,47,NULL,NULL,'2023-03-07 16:10:21','2023-03-07 16:11:57'),(42,1678262612,'2023-03-08',0,2.51,0.51,0.00,3.00,NULL,NULL,8,48,NULL,NULL,'2023-03-08 08:03:32','2023-03-08 08:22:00'),(43,1678264195,'2023-03-08',0,1.34,0.51,-1.17,3.00,NULL,NULL,8,49,NULL,NULL,'2023-03-08 08:29:55','2023-03-08 08:31:38'),(44,1678299856,'2023-03-08',0,1.34,0.51,-1.17,3.00,NULL,NULL,8,50,NULL,NULL,'2023-03-08 18:24:16','2023-03-08 18:31:39'),(46,1678346837,'2023-03-09',0,8.85,0.51,6.34,3.00,NULL,NULL,8,52,NULL,NULL,'2023-03-09 07:27:17','2023-03-09 07:36:47'),(47,1678347529,'2023-03-09',0,2.34,0.51,-0.17,3.00,NULL,NULL,8,53,NULL,NULL,'2023-03-09 07:38:49','2023-03-09 07:40:35'),(48,1678347999,'2023-03-09',0,1.34,0.51,-1.17,3.00,NULL,NULL,8,54,NULL,NULL,'2023-03-09 07:46:39','2023-03-09 07:48:03'),(49,1678348394,'2023-03-09',0,6.85,0.51,4.34,3.00,NULL,NULL,8,55,NULL,NULL,'2023-03-09 07:53:14','2023-03-09 08:04:31'),(50,1678349270,'2023-03-09',0,2.84,0.51,0.33,3.00,NULL,NULL,8,56,NULL,NULL,'2023-03-09 08:07:50','2023-03-09 08:10:13'),(51,1678349529,'2023-03-09',0,6.18,0.51,3.67,3.00,NULL,NULL,8,57,NULL,NULL,'2023-03-09 08:12:09','2023-03-09 08:16:39'),(52,1678349953,'2023-03-09',0,0.67,0.51,-1.84,3.00,NULL,NULL,8,58,NULL,NULL,'2023-03-09 08:19:13','2023-03-09 08:20:10'),(53,1678350114,'2023-03-09',0,0.00,0.51,-2.51,3.00,NULL,NULL,8,59,NULL,NULL,'2023-03-09 08:21:54','2023-03-09 08:21:54'),(54,1678350342,'2023-03-09',0,0.84,0.51,-1.68,3.00,NULL,NULL,8,60,NULL,NULL,'2023-03-09 08:25:42','2023-03-09 08:26:48'),(56,1678350844,'2023-03-09',0,7.01,0.51,4.50,3.00,NULL,NULL,8,62,NULL,NULL,'2023-03-09 08:34:04','2023-03-09 08:38:45'),(57,1678351402,'2023-03-09',0,0.00,0.51,-2.51,3.00,NULL,NULL,8,63,NULL,NULL,'2023-03-09 08:43:22','2023-03-09 08:43:22'),(58,1678351538,'2023-03-09',0,0.67,0.51,-1.84,3.00,NULL,NULL,8,64,NULL,NULL,'2023-03-09 08:45:38','2023-03-09 08:46:35'),(59,1678351811,'2023-03-09',0,6.51,0.51,4.00,3.00,NULL,NULL,8,65,NULL,NULL,'2023-03-09 08:50:11','2023-03-09 08:54:43'),(60,1678352224,'2023-03-09',0,0.00,0.51,-2.51,3.00,NULL,NULL,8,66,NULL,NULL,'2023-03-09 08:57:04','2023-03-09 08:57:04'),(61,1678352454,'2023-03-09',0,1.00,0.51,-1.51,3.00,NULL,NULL,8,67,NULL,NULL,'2023-03-09 09:00:54','2023-03-09 09:02:11'),(62,1678352840,'2023-03-09',0,0.50,0.51,-2.01,3.00,NULL,NULL,8,68,NULL,NULL,'2023-03-09 09:07:20','2023-03-09 09:08:25'),(63,1678354148,'2023-03-09',0,0.84,0.51,-1.68,3.00,NULL,NULL,8,69,NULL,NULL,'2023-03-09 09:29:08','2023-03-09 09:30:18'),(64,1678354421,'2023-03-09',0,0.17,0.51,-2.34,3.00,NULL,NULL,8,70,NULL,NULL,'2023-03-09 09:33:41','2023-03-09 09:34:41'),(65,1678354513,'2023-03-09',0,2.51,0.51,0.00,3.00,NULL,NULL,8,71,NULL,NULL,'2023-03-09 09:35:13','2023-03-09 09:52:22'),(66,1678355685,'2023-03-09',0,0.50,0.51,-2.01,3.00,NULL,NULL,8,72,NULL,NULL,'2023-03-09 09:54:45','2023-03-09 10:01:44'),(67,1678356210,'2023-03-09',0,0.50,0.51,-2.01,3.00,NULL,NULL,8,73,NULL,NULL,'2023-03-09 10:03:30','2023-03-09 10:04:31'),(68,1678356672,'2023-03-09',0,1.34,0.51,-1.17,3.00,NULL,NULL,8,74,NULL,NULL,'2023-03-09 10:11:12','2023-03-09 10:13:00'),(70,1678356982,'2023-03-09',0,2.34,0.51,-0.17,3.00,NULL,NULL,8,76,NULL,NULL,'2023-03-09 10:16:22','2023-03-09 10:18:16'),(71,1678357270,'2023-03-09',0,0.50,0.51,-2.01,3.00,NULL,NULL,8,77,NULL,NULL,'2023-03-09 10:21:10','2023-03-09 10:22:02'),(72,1678357418,'2023-03-09',0,5.68,0.51,3.17,3.00,NULL,NULL,8,78,NULL,NULL,'2023-03-09 10:23:38','2023-03-09 10:27:39'),(73,1678357816,'2023-03-09',0,0.67,0.51,-1.84,3.00,NULL,NULL,8,79,NULL,NULL,'2023-03-09 10:30:16','2023-03-09 10:31:16'),(74,1678358138,'2023-03-09',0,0.67,0.51,-1.84,3.00,NULL,NULL,8,80,NULL,NULL,'2023-03-09 10:35:38','2023-03-09 10:36:28'),(75,1678358253,'2023-03-09',0,0.84,0.51,-1.68,3.00,NULL,NULL,8,81,NULL,NULL,'2023-03-09 10:37:33','2023-03-09 10:38:32'),(76,1678359287,'2023-03-09',0,1.00,0.51,-1.51,3.00,NULL,NULL,8,82,NULL,NULL,'2023-03-09 10:54:47','2023-03-09 10:56:15'),(77,1678359857,'2023-03-09',0,0.00,0.51,-2.51,3.00,NULL,NULL,8,83,NULL,NULL,'2023-03-09 11:04:17','2023-03-09 11:04:17'),(78,1678359915,'2023-03-09',0,3.51,0.51,1.00,3.00,NULL,NULL,8,84,NULL,NULL,'2023-03-09 11:05:15','2023-03-09 11:07:39'),(79,1678360640,'2023-03-09',0,1.00,0.51,-1.51,3.00,NULL,NULL,8,85,NULL,NULL,'2023-03-09 11:17:20','2023-03-09 11:18:40'),(80,1678360827,'2023-03-09',0,4.51,0.51,2.00,3.00,NULL,NULL,8,86,NULL,NULL,'2023-03-09 11:20:27','2023-03-09 11:23:54'),(81,1678361382,'2023-03-09',0,1.67,0.51,-0.84,3.00,NULL,NULL,8,87,NULL,NULL,'2023-03-09 11:29:42','2023-03-09 11:31:16'),(82,1678362009,'2023-03-09',0,0.00,0.51,-2.51,3.00,NULL,NULL,8,88,NULL,NULL,'2023-03-09 11:40:09','2023-03-09 11:40:09');
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2022_04_04_184517_create_customers_table',1),(5,'2022_04_14_133736_create_intervals_table',1),(6,'2022_04_14_151955_create_parks_table',1),(7,'2022_05_03_213236_create_reservations_table',1),(8,'2022_06_21_172949_create_payment_wallets_table',1),(9,'2022_06_28_180110_create_invoices_table',1),(10,'2022_07_01_203830_create_chats_table',1),(11,'2022_07_02_141931_create_payment',1),(12,'2022_07_04_215554_create_notifications_table',1),(13,'2022_07_10_215635_create_permission_tables',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',1),(4,'App\\Models\\User',2),(3,'App\\Models\\User',3);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notifications` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint unsigned NOT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES ('1e5439a0-c744-42d3-b068-b144cc0a57a0','App\\Notifications\\ReplayMessage','App\\Models\\User',2,'{\"id\":30,\"title\":\"A message has been sent by\",\"user\":\"Hassan\"}',NULL,'2023-03-15 13:00:34','2023-03-15 13:00:34'),('2b9bd5aa-7546-422a-9f56-d990786618d7','App\\Notifications\\ReplayMessage','App\\Models\\User',2,'{\"id\":28,\"title\":\"A message has been sent by\",\"user\":\"Ahmed Abufayed\"}',NULL,'2023-02-18 10:33:55','2023-02-18 10:33:55'),('3dc7e7e1-d67f-43b1-8f17-0cc977802852','App\\Notifications\\ReplayMessage','App\\Models\\User',1,'{\"id\":28,\"title\":\"A message has been sent by\",\"user\":\"Ahmed Abufayed\"}',NULL,'2023-02-18 10:33:55','2023-02-18 10:33:55'),('49130965-dab5-432b-a8f1-3a63df4d4605','App\\Notifications\\ReplayMessage','App\\Models\\User',3,'{\"id\":28,\"title\":\"A message has been sent by\",\"user\":\"Ahmed Abufayed\"}',NULL,'2023-02-18 10:33:55','2023-02-18 10:33:55'),('5c77c16c-3987-484b-b4ed-77ad9eb48f0c','App\\Notifications\\ReplayMessage','App\\Models\\User',3,'{\"id\":30,\"title\":\"A message has been sent by\",\"user\":\"Hassan\"}',NULL,'2023-03-15 13:00:34','2023-03-15 13:00:34'),('85d3abb2-fdf6-4886-9496-46599d41ed72','App\\Notifications\\ReplayMessage','App\\Models\\User',1,'{\"id\":30,\"title\":\"A message has been sent by\",\"user\":\"Hassan\"}',NULL,'2023-03-15 13:00:34','2023-03-15 13:00:34'),('a0f3833e-c7b5-43ff-a590-7d64e1923d81','App\\Notifications\\ReplayMessage','App\\Models\\User',1,'{\"id\":28,\"title\":\"A message has been sent by\",\"user\":\"Ahmed Abufayed\"}',NULL,'2023-02-19 10:16:20','2023-02-19 10:16:20'),('a49cb469-e274-45a0-985d-de6b508e0bc8','App\\Notifications\\ReplayMessage','App\\Models\\User',3,'{\"id\":28,\"title\":\"A message has been sent by\",\"user\":\"Ahmed Abufayed\"}',NULL,'2023-02-19 10:16:20','2023-02-19 10:16:20'),('eb7a8ff2-f2e7-43b1-93f4-bc14551bda3c','App\\Notifications\\ReplayMessage','App\\Models\\User',1,'{\"id\":1,\"title\":\"A message has been sent by\",\"user\":\"Charles Clayton\"}',NULL,'2023-02-06 08:29:38','2023-02-06 08:29:38'),('f94f76ed-29f8-4274-a18b-f8176bcb09b1','App\\Notifications\\ReplayMessage','App\\Models\\User',2,'{\"id\":28,\"title\":\"A message has been sent by\",\"user\":\"Ahmed Abufayed\"}',NULL,'2023-02-19 10:16:20','2023-02-19 10:16:20');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parks`
--

DROP TABLE IF EXISTS `parks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` int NOT NULL,
  `status` tinyint unsigned NOT NULL DEFAULT '0',
  `start_time_sensor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time_sensor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `parks_name_unique` (`name`),
  UNIQUE KEY `parks_number_unique` (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parks`
--

LOCK TABLES `parks` WRITE;
/*!40000 ALTER TABLE `parks` DISABLE KEYS */;
INSERT INTO `parks` VALUES (1,'api22q',5,1,'13:30:16','13:31:16','1.0',NULL,'2023-02-06 07:02:34','2023-03-09 11:31:16'),(2,'PR-api',6,1,'0','0',NULL,NULL,'2023-02-06 08:14:52','2023-02-22 21:24:52');
/*!40000 ALTER TABLE `parks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `time_price` decimal(8,2) NOT NULL,
  `amount_commission` decimal(8,2) NOT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `total_profit` decimal(8,2) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,1.67,0.51,3.00,0.49,NULL,NULL,'2023-02-06 07:14:48');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_wallets`
--

DROP TABLE IF EXISTS `payment_wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_wallets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `number` int NOT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `status` tinyint unsigned NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payment_wallets_number_unique` (`number`),
  KEY `payment_wallets_customer_id_foreign` (`customer_id`),
  CONSTRAINT `payment_wallets_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_wallets`
--

LOCK TABLES `payment_wallets` WRITE;
/*!40000 ALTER TABLE `payment_wallets` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_wallets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'role-list','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(2,'role-create','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(3,'role-edit','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(4,'role-delete','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(5,'user-list','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(6,'user-create','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(7,'user-edit','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(8,'user-delete','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(9,'user-show','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(10,'customer-list','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(11,'customer-create','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(12,'customer-edit','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(13,'customer-delete','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(14,'customer-show','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(15,'customer-export','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(16,'customer-active-dis','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(17,'customer-archive','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(18,'customer-archive-update','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(19,'park-list','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(20,'park-create','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(21,'park-edit','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(22,'park-delete','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(23,'park-active-dis','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(24,'park-status','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(25,'interval-list','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(26,'interval-create','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(27,'interval-edit','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(28,'interval-delete','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(29,'interval-show','web','2023-02-06 06:06:49','2023-02-06 06:06:49'),(30,'interval-active-dis','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(31,'reservation-list','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(32,'reservation-export','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(33,'reservation-create','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(34,'reservation-delete','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(35,'reservation-show','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(36,'reservation-status','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(37,'reservation-busy','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(38,'reservation-archive-list','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(39,'reservation-archive-create','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(40,'reservation-archive-edit','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(41,'reservation-archive-delete','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(42,'reservation-archive-show','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(43,'reservation-cancel','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(44,'reservation-finish','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(45,'payment-list','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(46,'payment-create','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(47,'payment-edit','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(48,'payment-delete','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(49,'invoice-list','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(50,'invoice-export','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(51,'invoice-create','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(52,'invoice-edit','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(53,'invoice-delete','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(54,'invoice-show','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(55,'invoice-status','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(56,'invoice-paid','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(57,'invoice-unpaid','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(58,'invoice-downloadPDF','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(59,'invoice-archive-list','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(60,'invoice-archive-edit','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(61,'invoice-archive-delete','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(62,'chat-list','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(63,'chat-answered','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(64,'chat-noresponse','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(65,'chat-create','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(66,'chat-edit','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(67,'chat-delete','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(68,'chat-show','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(69,'chat-archive-list','web','2023-02-06 06:06:50','2023-02-06 06:06:50'),(70,'chat-archive-delete','web','2023-02-06 06:06:50','2023-02-06 06:06:50');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `number` int NOT NULL,
  `status` tinyint unsigned NOT NULL DEFAULT '0',
  `start_time_sensor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time_sensor` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint unsigned NOT NULL,
  `park_id` bigint unsigned NOT NULL,
  `interval_id` bigint unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reservations_number_unique` (`number`),
  KEY `reservations_customer_id_foreign` (`customer_id`),
  KEY `reservations_park_id_foreign` (`park_id`),
  KEY `reservations_interval_id_foreign` (`interval_id`),
  CONSTRAINT `reservations_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reservations_interval_id_foreign` FOREIGN KEY (`interval_id`) REFERENCES `intervals` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reservations_park_id_foreign` FOREIGN KEY (`park_id`) REFERENCES `parks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (25,1677242949,3,NULL,NULL,NULL,8,1,7,'2023-02-24 20:09:25','2023-02-24 12:49:09','2023-02-24 20:09:25'),(26,1677269505,3,'23:15:46','23:17:5','1.3',8,1,15,'2023-02-24 20:17:05','2023-02-24 22:11:45','2023-02-24 20:17:05'),(28,1677269986,3,'23:28:49','23:31:12','2.4',8,1,15,'2023-02-24 20:31:12','2023-02-24 20:19:46','2023-02-24 20:31:12'),(29,1677270944,3,'23:36:44','23:38:32','1.8',8,1,15,'2023-02-24 20:38:32','2023-02-24 20:35:44','2023-02-24 20:38:32'),(30,1677272066,3,'23:55:41','23:57:44','2.0',8,1,15,'2023-02-24 20:57:45','2023-02-24 20:54:26','2023-02-24 20:57:45'),(31,1677272494,3,'0:5:55','0:8:20','2.4',8,1,16,'2023-02-24 21:08:25','2023-02-24 21:01:34','2023-02-24 21:08:25'),(32,1677275482,3,'0:52:33','0:55:7','2.6',8,1,16,'2023-02-24 21:55:08','2023-02-24 21:51:22','2023-02-24 21:55:08'),(33,1678101601,3,'4:16:30','4:16:39','0.1',8,1,6,'2023-03-07 01:16:39','2023-03-06 11:20:01','2023-03-07 01:16:39'),(35,1678168828,3,'9:23:23','9:23:33','0.1',8,1,1,'2023-03-07 06:23:33','2023-03-07 06:00:28','2023-03-07 06:23:33'),(36,1678170310,3,'9:26:8','9:26:19','0.2',8,1,1,'2023-03-07 06:26:19','2023-03-07 06:25:10','2023-03-07 06:26:19'),(45,1678187217,3,NULL,NULL,NULL,8,1,6,'2023-03-07 14:33:47','2023-03-07 11:06:57','2023-03-07 14:33:47'),(47,1678205421,3,'19:11:4','19:11:56','0.9',8,1,11,'2023-03-07 16:11:57','2023-03-07 16:10:21','2023-03-07 16:11:57'),(48,1678262612,3,'11:20:27','11:22:0','1.5',8,1,3,'2023-03-08 08:22:01','2023-03-08 08:03:32','2023-03-08 08:22:01'),(49,1678264195,3,'11:30:50','11:31:38','0.8',8,1,3,'2023-03-08 08:31:38','2023-03-08 08:29:55','2023-03-08 08:31:38'),(50,1678299856,3,'20:30:52','20:31:38','0.8',8,1,13,'2023-03-08 18:31:39','2023-03-08 18:24:16','2023-03-08 18:31:39'),(52,1678346837,3,'9:31:28','9:36:47','5.3',8,1,2,'2023-03-09 07:36:47','2023-03-09 07:27:17','2023-03-09 07:36:47'),(53,1678347529,3,'9:39:11','9:40:34','1.4',8,1,2,'2023-03-09 07:40:35','2023-03-09 07:38:49','2023-03-09 07:40:35'),(54,1678347999,3,'9:47:11','9:48:3','0.8',8,1,2,'2023-03-09 07:48:03','2023-03-09 07:46:39','2023-03-09 07:48:03'),(55,1678348394,3,'10:0:24','10:4:30','4.1',8,1,3,'2023-03-09 08:04:31','2023-03-09 07:53:14','2023-03-09 08:04:31'),(56,1678349270,3,'10:8:32','10:10:13','1.7',8,1,3,'2023-03-09 08:10:13','2023-03-09 08:07:50','2023-03-09 08:10:13'),(57,1678349529,3,'10:12:58','10:16:39','3.7',8,1,3,'2023-03-09 08:16:39','2023-03-09 08:12:09','2023-03-09 08:16:39'),(58,1678349953,3,'10:19:44','10:20:9','0.4',8,1,3,'2023-03-09 08:20:10','2023-03-09 08:19:13','2023-03-09 08:20:10'),(59,1678350114,0,NULL,NULL,NULL,8,1,4,'2023-03-09 08:22:52','2023-03-09 08:21:54','2023-03-09 08:22:52'),(60,1678350342,3,'10:26:17','10:26:48','0.5',8,1,3,'2023-03-09 08:26:49','2023-03-09 08:25:42','2023-03-09 08:26:49'),(62,1678350844,3,'10:34:30','10:38:44','4.2',8,1,3,'2023-03-09 08:38:45','2023-03-09 08:34:04','2023-03-09 08:38:45'),(63,1678351402,0,NULL,NULL,NULL,8,1,4,'2023-03-09 08:44:18','2023-03-09 08:43:22','2023-03-09 08:44:18'),(64,1678351538,3,'10:46:9','10:46:35','0.4',8,1,3,'2023-03-09 08:46:35','2023-03-09 08:45:38','2023-03-09 08:46:35'),(65,1678351811,3,'10:50:49','10:54:43','3.9',8,1,3,'2023-03-09 08:54:43','2023-03-09 08:50:11','2023-03-09 08:54:43'),(66,1678352224,0,NULL,NULL,NULL,8,1,4,'2023-03-09 09:00:35','2023-03-09 08:57:04','2023-03-09 09:00:35'),(67,1678352454,3,'11:1:37','11:2:11','0.6',8,1,4,'2023-03-09 09:02:11','2023-03-09 09:00:54','2023-03-09 09:02:11'),(68,1678352840,3,'11:8:6','11:8:25','0.3',8,1,4,'2023-03-09 09:08:25','2023-03-09 09:07:20','2023-03-09 09:08:25'),(69,1678354148,3,'11:29:48','11:30:17','0.5',8,1,4,'2023-03-09 09:30:18','2023-03-09 09:29:08','2023-03-09 09:30:18'),(70,1678354421,3,'11:34:34','11:34:40','0.1',8,1,4,'2023-03-09 09:34:41','2023-03-09 09:33:41','2023-03-09 09:34:41'),(71,1678354513,3,'11:50:50','11:52:22','1.5',8,1,4,'2023-03-09 09:52:22','2023-03-09 09:35:13','2023-03-09 09:52:22'),(72,1678355685,3,'12:1:23','12:1:43','0.3',8,1,4,'2023-03-09 10:01:44','2023-03-09 09:54:45','2023-03-09 10:01:44'),(73,1678356210,3,'12:4:10','12:4:30','0.3',8,1,5,'2023-03-09 10:04:31','2023-03-09 10:03:30','2023-03-09 10:04:31'),(74,1678356672,3,'12:12:11','12:12:59','0.8',8,1,5,'2023-03-09 10:13:00','2023-03-09 10:11:12','2023-03-09 10:13:00'),(76,1678356982,3,'12:16:51','12:18:15','1.4',8,1,5,'2023-03-09 10:18:16','2023-03-09 10:16:22','2023-03-09 10:18:16'),(77,1678357270,3,'12:21:41','12:22:2','0.3',8,1,5,'2023-03-09 10:22:02','2023-03-09 10:21:10','2023-03-09 10:22:02'),(78,1678357418,3,'12:24:15','12:27:38','3.4',8,1,5,'2023-03-09 10:27:39','2023-03-09 10:23:38','2023-03-09 10:27:39'),(79,1678357816,3,'12:30:50','12:31:16','0.4',8,1,5,'2023-03-09 10:31:16','2023-03-09 10:30:16','2023-03-09 10:31:16'),(80,1678358138,3,'12:36:6','12:36:28','0.4',8,1,5,'2023-03-09 10:36:28','2023-03-09 10:35:38','2023-03-09 10:36:28'),(81,1678358253,3,'12:38:1','12:38:32','0.5',8,1,5,'2023-03-09 10:38:33','2023-03-09 10:37:33','2023-03-09 10:38:33'),(82,1678359287,3,'12:55:38','12:56:14','0.6',8,1,5,'2023-03-09 10:56:15','2023-03-09 10:54:47','2023-03-09 10:56:15'),(83,1678359857,0,NULL,NULL,NULL,8,1,7,'2023-03-09 11:05:10','2023-03-09 11:04:17','2023-03-09 11:05:10'),(84,1678359915,3,'13:5:34','13:7:39','2.1',8,1,6,'2023-03-09 11:07:39','2023-03-09 11:05:15','2023-03-09 11:07:39'),(85,1678360640,3,'13:18:3','13:18:39','0.6',8,1,6,'2023-03-09 11:18:40','2023-03-09 11:17:20','2023-03-09 11:18:40'),(86,1678360827,3,'13:21:13','13:23:53','2.7',8,1,6,'2023-03-09 11:23:54','2023-03-09 11:20:27','2023-03-09 11:23:54'),(87,1678361382,3,'13:30:16','13:31:16','1.0',8,1,6,'2023-03-09 11:31:16','2023-03-09 11:29:42','2023-03-09 11:31:16'),(88,1678362009,3,NULL,NULL,NULL,8,1,6,'2023-03-15 13:00:24','2023-03-09 11:40:09','2023-03-15 13:00:24');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(39,1),(40,1),(41,1),(42,1),(43,1),(44,1),(45,1),(46,1),(47,1),(48,1),(49,1),(50,1),(51,1),(52,1),(53,1),(54,1),(55,1),(56,1),(57,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1),(67,1),(68,1),(69,1),(70,1),(1,2),(2,2),(3,2),(4,2),(5,2),(6,2),(7,2),(8,2),(9,2),(10,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(35,2),(36,2),(37,2),(38,2),(39,2),(40,2),(41,2),(42,2),(43,2),(44,2),(45,2),(46,2),(47,2),(48,2),(49,2),(50,2),(51,2),(52,2),(53,2),(54,2),(55,2),(56,2),(57,2),(58,2),(59,2),(60,2),(61,2),(62,2),(63,2),(64,2),(65,2),(66,2),(67,2),(68,2),(69,2),(70,2),(10,3),(11,3),(12,3),(14,3),(19,3),(20,3),(21,3),(22,3),(23,3),(24,3),(31,3),(33,3),(34,3),(35,3),(36,3),(37,3),(10,4),(11,4),(12,4),(14,4),(25,4),(26,4),(27,4),(28,4),(31,4),(33,4),(35,4),(36,4),(37,4),(43,4),(44,4),(45,4),(49,4),(62,4),(63,4),(64,4),(68,4);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','web','2023-02-06 06:08:05','2023-02-06 06:08:05'),(2,'owner','web','2023-02-06 06:08:05','2023-02-06 06:08:05'),(3,'park','web','2023-02-06 09:02:19','2023-02-06 09:02:19'),(4,'mobile','web','2023-02-06 09:03:31','2023-02-06 09:03:31');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint unsigned NOT NULL DEFAULT '0',
  `roles_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `receive_email` tinyint unsigned NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_mobile_unique` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ahmed Salha','admin@ahmed.com','2323223233',NULL,'$2y$10$XgZKvFuHRp9fdcL5XE13FuOLd/UdAZPUGvyow/r0gnnymxdyqixnu',NULL,1,'[\"owner\"]',1,NULL,'2023-02-06 06:08:05','2023-02-06 07:54:53'),(2,'AhmedAboFayed','ahmedabofayed@carparking.com','24232323232','2023-02-06 09:04:29','$2y$10$etyas4EdVbXOtSXd0aYFZuAT7vDfYPxFKC4PNhQIx63FWbET8Hpn2',NULL,1,'[\"mobile\"]',0,'rvRg8F8Hz35K7YyVFhVH0Xg2q15D5Zwr9wsuyDdObHBvefKeo8R91QtRkyXX','2023-02-06 09:04:29','2023-02-06 09:04:29'),(3,'Hassan','hassan@carparking.com','3243243434','2023-02-06 09:04:59','$2y$10$8K3VgMnpq6dOAiU.eGLl7.vfP.TV0fFMOEBVPyDESSDO.2aE9zUg2',NULL,1,'[\"park\"]',0,NULL,'2023-02-06 09:05:00','2023-02-06 09:05:00');
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

-- Dump completed on 2023-04-03 13:14:39
