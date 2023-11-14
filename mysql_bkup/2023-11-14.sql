-- MySQL dump 10.13  Distrib 8.0.33, for Linux (aarch64)
--
-- Host: localhost    Database: pt
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Current Database: `pt`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `pt` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `pt`;

--
-- Table structure for table `belongings`
--

DROP TABLE IF EXISTS `belongings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `belongings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `travel_plan_id` bigint unsigned NOT NULL COMMENT '旅行プランID',
  `contents` text COLLATE utf8mb4_unicode_ci COMMENT 'もっていくもの',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `belongings_travel_plan_id_foreign` (`travel_plan_id`),
  CONSTRAINT `belongings_travel_plan_id_foreign` FOREIGN KEY (`travel_plan_id`) REFERENCES `travel_plans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `belongings`
--

LOCK TABLES `belongings` WRITE;
/*!40000 ALTER TABLE `belongings` DISABLE KEYS */;
INSERT INTO `belongings` VALUES (1,23,'MacBook Pro','2023-11-12 02:22:33','2023-11-12 02:22:33'),(2,23,'お財布','2023-11-12 02:22:33','2023-11-12 02:22:33'),(3,23,'服上下2枚','2023-11-12 02:22:33','2023-11-12 02:22:33'),(4,16,'被らせる荷物','2023-11-12 02:24:42','2023-11-12 02:24:42'),(7,23,'スマホ','2023-11-12 12:30:50','2023-11-12 12:30:50'),(8,18,'デバッグのあれ','2023-11-12 13:29:50','2023-11-12 13:29:50'),(9,23,'テレビ','2023-11-12 23:25:05','2023-11-12 23:25:05'),(10,23,'大根','2023-11-12 23:25:05','2023-11-12 23:25:05');
/*!40000 ALTER TABLE `belongings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_06_18_115232_create_travel_plans_table',2),(6,'2023_07_02_143139_create_tweets_table',3),(7,'2023_07_02_150012_add_foreign_key_to_travel_plans_table',4),(8,'2023_07_04_075233_add_buget_coiumn_to_tweets_table',5),(9,'2023_07_04_075414_add_buget_coiumn_to_travel_plans_table',6),(10,'2023_07_04_075549_drop_buget_coiumn_to_tweets_table',6),(11,'2023_07_04_233550_drop_date_coiumn_to_travel_plans_table',7),(15,'2023_10_20_232417_create_travel_details_table',8),(16,'2023_10_21_000747_add_foreign_key_to_tweets_table',8),(17,'2023_10_22_223434_add_date_column_to_travel_details_table',9),(18,'2023_10_23_000447_add_time_column_to_travel_details_table',10),(19,'2023_10_24_162447_add_timeft_column_to_travel_details_table',11),(20,'2023_11_10_094012_create_belongings_table',12);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
INSERT INTO `password_resets` VALUES ('r.kawasaki.biz@gmail.com','$2y$10$GCPkpQ19UqqaiLqn6PZYPe.Q0w3c5wRHqqr8V/L5PNu8KK8O60.V2','2023-11-04 11:54:15');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_details`
--

DROP TABLE IF EXISTS `travel_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `travel_plan_id` bigint unsigned NOT NULL COMMENT '旅行プランID',
  `contents` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '記録内容',
  `kubun` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci COMMENT '1:朝食 2:昼食 3:夕食 4:間食 5:交通費 6:宿泊費 7:お土産代 8:レジャー 9:行きたいところ 10:その他雑費',
  `price` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_from` datetime DEFAULT NULL,
  `time_to` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `travel_details_travel_plan_id_foreign` (`travel_plan_id`),
  CONSTRAINT `travel_details_travel_plan_id_foreign` FOREIGN KEY (`travel_plan_id`) REFERENCES `travel_plans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_details`
--

LOCK TABLES `travel_details` WRITE;
/*!40000 ALTER TABLE `travel_details` DISABLE KEYS */;
INSERT INTO `travel_details` VALUES (1,16,NULL,'1',NULL,'2023-10-24 14:23:26','2023-10-24 14:23:26','2023-10-23',NULL,NULL),(2,16,NULL,'1',NULL,'2023-10-24 14:25:09','2023-10-24 14:25:09','2023-10-23',NULL,NULL),(3,16,'あ','9',NULL,'2023-10-24 22:56:50','2023-10-24 22:56:50','2023-10-23','2023-10-23 12:21:00','2023-10-23 14:22:00'),(4,16,NULL,'9',500,'2023-10-24 23:00:53','2023-10-24 23:00:53','2023-10-23','2023-10-23 00:00:00','2023-10-23 00:00:00'),(5,16,NULL,'9',500,'2023-10-24 23:01:25','2023-10-24 23:01:25','2023-10-23','2023-10-23 00:00:00','2023-10-23 00:00:00'),(6,17,'しごと','9',NULL,'2023-10-25 12:57:26','2023-10-25 12:57:26','2023-10-25','2023-10-25 11:11:00','2023-10-25 12:11:00'),(7,17,'ひるやすみ','9',NULL,'2023-10-25 12:57:26','2023-10-25 12:57:26','2023-10-25','2023-10-25 13:00:00','2023-10-25 14:41:00'),(8,17,'かえり','9',NULL,'2023-10-25 12:57:26','2023-10-25 12:57:26','2023-10-25','2023-10-25 16:22:00','2023-10-25 17:01:00'),(9,17,'フルーツサラダ','1',420,'2023-10-25 13:00:09','2023-10-25 13:00:09','2023-10-25',NULL,NULL),(10,17,'パスタ','4',800,'2023-10-25 13:00:09','2023-10-25 13:00:09','2023-10-25',NULL,NULL),(13,17,'からあげ','4',300,'2023-10-25 13:38:15','2023-10-25 13:38:15','2023-10-25',NULL,NULL),(14,17,'オリジナルメニュー','3',100,'2023-10-26 15:04:08','2023-10-26 15:04:08','2023-10-26',NULL,NULL),(15,17,'ひるごはん','2',411,'2023-10-26 15:06:25','2023-10-26 15:06:25','2023-10-25',NULL,NULL),(16,17,'あのランチ','2',512,'2023-10-26 15:14:07','2023-10-26 15:14:07','2023-10-25',NULL,NULL),(17,17,'ホテル浦島','6',25000,'2023-10-26 15:26:14','2023-10-26 15:26:14','2023-10-25',NULL,NULL),(18,17,'コイニハッテンする','9',NULL,'2023-10-26 15:32:46','2023-10-26 15:32:46','2023-10-25','2023-10-25 23:00:00','2023-10-25 23:59:00'),(19,17,'asa','1',NULL,'2023-10-29 00:43:04','2023-10-29 00:43:04','2023-10-29',NULL,NULL),(20,17,'ko','5',211,'2023-10-29 00:43:04','2023-10-29 00:43:04','2023-10-29',NULL,NULL),(21,17,'ニーン','1',77,'2023-10-29 23:34:39','2023-10-29 23:34:39','2023-10-30',NULL,NULL),(22,17,'朝ごはん2こめ','1',3111,'2023-10-30 00:25:02','2023-10-30 00:25:02','2023-10-25',NULL,NULL),(24,17,'どっか行く','9',NULL,'2023-10-31 15:27:30','2023-10-31 15:27:30','2023-10-30','2023-10-30 10:00:00','2023-10-30 14:00:00'),(25,17,'mannnaka','9',NULL,'2023-10-31 22:35:10','2023-10-31 22:35:10','2023-10-25','2023-10-25 14:00:00','2023-10-25 17:00:00'),(26,17,'削除','9',NULL,'2023-10-31 22:53:07','2023-10-31 22:53:07','2023-10-25','2023-10-25 18:00:00','2023-10-25 19:11:00'),(27,17,'仕事辞める','9',NULL,'2023-11-01 12:43:17','2023-11-01 12:43:17','2023-10-30','2023-10-30 08:12:00','2023-10-30 08:20:00'),(28,17,'浅草','5',510,'2023-11-01 12:44:01','2023-11-01 12:44:01','2023-10-30',NULL,NULL),(29,17,'どこか','9',NULL,'2023-11-03 11:46:36','2023-11-03 11:46:36','2023-10-30','2023-10-30 01:11:00','2023-10-30 00:10:00'),(30,17,'これが夕食です','3',NULL,'2023-11-03 13:42:32','2023-11-03 13:42:32','2023-10-30',NULL,NULL),(34,18,'アレ','9',NULL,'2023-11-03 14:21:01','2023-11-03 14:21:01','2023-11-03','2023-11-03 23:00:00','2023-11-03 23:11:00'),(35,20,'mi','1',55,'2023-11-05 11:21:07','2023-11-05 11:21:07','2023-11-05',NULL,NULL),(36,20,'oooo','5',41,'2023-11-05 11:21:07','2023-11-05 11:21:07','2023-11-05',NULL,NULL),(37,23,'通勤','9',NULL,'2023-11-07 22:57:09','2023-11-07 22:57:09','2023-11-08','2023-11-08 08:20:00','2023-11-08 09:20:00'),(38,23,'オートミール','1',300,'2023-11-07 22:59:26','2023-11-07 22:59:26','2023-11-08',NULL,NULL),(39,23,'NATO','2',41,'2023-11-07 23:04:16','2023-11-07 23:04:16','2023-11-08',NULL,NULL),(40,23,'ひるごはん','2',20,'2023-11-08 11:53:21','2023-11-08 11:53:21','2023-11-07',NULL,NULL);
/*!40000 ALTER TABLE `travel_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `travel_plans`
--

DROP TABLE IF EXISTS `travel_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `travel_plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `meet_place` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `trip_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `trip_start` timestamp NULL DEFAULT NULL,
  `trip_end` timestamp NULL DEFAULT NULL,
  `departure_time` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `budget` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `travel_plans_user_id_foreign` (`user_id`),
  CONSTRAINT `travel_plans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_plans`
--

LOCK TABLES `travel_plans` WRITE;
/*!40000 ALTER TABLE `travel_plans` DISABLE KEYS */;
INSERT INTO `travel_plans` VALUES (1,'2023-07-04 22:38:44','2023-07-04 22:38:44','自宅','わくわく旅行','2023-07-07 15:00:00','2023-07-09 15:00:00','2023-07-07 23:42:00',1,NULL),(2,'2023-07-05 22:11:26','2023-07-05 22:11:26','どこかしら','普通の旅行','2023-07-15 15:00:00','2023-07-19 15:00:00','2023-07-16 00:10:00',1,20000),(10,'2023-07-11 13:50:22','2023-07-11 13:50:22',NULL,'あ','2023-07-20 15:00:00','2023-07-21 15:00:00','2023-07-20 15:00:00',1,NULL),(11,'2023-07-11 22:09:33','2023-07-11 22:09:33',NULL,'test','2023-07-11 15:00:00','2023-07-15 15:00:00','2023-07-11 15:00:00',1,NULL),(14,'2023-08-13 13:05:34','2023-08-13 13:05:34','ひみつ','なんと！','2023-08-12 15:00:00','2023-08-15 15:00:00','2023-08-13 13:05:00',1,45000),(15,'2023-10-18 13:17:06','2023-10-18 13:17:06','家','旅行 in 自宅','2023-10-17 15:00:00','2023-10-24 15:00:00','2023-10-18 12:00:00',1,100),(16,'2023-10-22 08:51:30','2023-11-03 06:13:42','ie ~ yeah ~','かぶらせ旅行','2023-11-02 15:00:00','2023-11-04 15:00:00','2023-11-03 04:08:00',1,60000),(17,'2023-10-25 12:06:30','2023-10-25 12:06:30','いえ','あの旅行','2023-10-24 15:00:00','2023-10-29 15:00:00','2023-10-24 15:00:00',1,1),(18,'2023-10-31 12:26:27','2023-11-12 13:28:05',NULL,'デバッグ旅行','2023-11-11 15:00:00','2023-11-13 15:00:00','2023-11-11 15:00:00',1,NULL),(20,'2023-11-05 11:20:50','2023-11-05 11:20:50',NULL,'mo','2023-11-04 15:00:00','2023-11-05 15:00:00','2023-11-04 15:00:00',3,NULL),(23,'2023-11-07 14:33:29','2023-11-12 12:29:43','秘密','修正旅行','2023-11-05 15:00:00','2023-11-14 15:00:00','2023-11-06 03:30:00',1,341);
/*!40000 ALTER TABLE `travel_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tweets`
--

DROP TABLE IF EXISTS `tweets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tweets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tweet` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `editFlg` bigint unsigned DEFAULT NULL,
  `travel_plan_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tweets_user_id_foreign` (`user_id`),
  KEY `tweets_travel_plan_id_foreign` (`travel_plan_id`),
  CONSTRAINT `tweets_travel_plan_id_foreign` FOREIGN KEY (`travel_plan_id`) REFERENCES `travel_plans` (`id`),
  CONSTRAINT `tweets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweets`
--

LOCK TABLES `tweets` WRITE;
/*!40000 ALTER TABLE `tweets` DISABLE KEYS */;
INSERT INTO `tweets` VALUES (1,'あ',1,'2023-07-03 13:25:50','2023-07-03 13:25:50',NULL,NULL),(2,'8月は暑すぎるので旅行は控えます。\r\n\r\nなので、お金を貯めて10月以降に楽しみたいですね',1,'2023-07-03 13:34:47','2023-07-03 13:34:47',NULL,NULL),(3,'タイムゾーン更新した',1,'2023-07-03 22:39:35','2023-07-03 22:39:35',NULL,NULL),(4,'推しの子面白かった！',1,'2023-07-06 14:07:29','2023-07-06 14:07:29',NULL,NULL),(7,'今日はオーケーに買い物に行きました🥰',1,'2023-07-08 10:37:27','2023-07-08 10:37:27',NULL,NULL),(23,'ふへー',1,'2023-07-11 06:45:57','2023-07-09 06:45:57',NULL,NULL),(25,'なーん',1,'2023-07-11 22:27:59','2023-07-11 22:27:59',NULL,NULL),(26,'今日は酒飲んだのでさっさと寝たい',1,'2023-10-18 13:17:30','2023-10-20 13:38:19',1,NULL),(27,'もう23時前じゃん',1,'2023-10-20 13:46:11','2023-10-20 13:46:11',NULL,NULL),(28,'test',1,'2023-10-22 09:30:20','2023-10-22 09:30:20',NULL,15),(31,'ﾂｲｰﾖ',1,'2023-10-25 12:07:47','2023-10-25 12:07:47',NULL,17),(33,'これは普通のつぶやき',1,'2023-11-01 14:24:55','2023-11-01 14:24:55',NULL,18),(34,'編集したわね',1,'2023-11-01 14:24:59','2023-11-03 05:55:13',1,18),(35,'被らせツイート',1,'2023-11-03 07:13:22','2023-11-03 07:13:22',NULL,16),(36,'OOOHKAIE',3,'2023-11-05 11:21:30','2023-11-05 11:21:30',NULL,20),(37,'KARITOOTOTO',3,'2023-11-05 11:21:35','2023-11-05 11:21:35',NULL,20),(38,'HENKOU',3,'2023-11-05 11:21:39','2023-11-05 11:21:47',1,20),(39,'ツイーヨ',1,'2023-11-08 12:01:57','2023-11-08 12:01:57',NULL,23),(40,'ダブルツイーヨ',1,'2023-11-08 12:02:10','2023-11-08 12:02:10',NULL,23);
/*!40000 ALTER TABLE `tweets` ENABLE KEYS */;
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
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'りんぽす','pointkasegou@gmail.com','2023-11-06 12:41:01','$2y$10$N.rapjMdUJyQ.fqv0ozOO.s.n4H5yki3Ze.iPvsCtA8ODMPq6yVXG','WXA5fcWhW5SSYHjc6bxhTsAKzy0YQhYXEFJB63rIYDzlyZjQymU1eSzyfJOo','2023-06-18 02:15:50','2023-11-06 22:45:56'),(2,'kawasaki','r.kawasaki.biz@gmail.com',NULL,'$2y$10$JnGoqShGx3GGG/FxByXM0.knTUNRjaIAgFzwkc.ruv9Jqb3Q27L76',NULL,'2023-11-03 14:58:15','2023-11-03 14:58:15'),(3,'川﨑','thryokhoh@yahoo.co.jp','2023-11-05 12:25:30','$2y$10$ZQTskpjuoBk2tRCuRRe9pu95/2KKMj8XHYo2npzVkxGcQnlZdf9gG',NULL,'2023-11-05 11:19:21','2023-11-05 12:25:30'),(4,'bijinesurin','tmkhornymrokyu@gmail.com','2023-11-05 14:32:15','$2y$10$qAjyEU5t/63soEXNGDbwe.OhWwzd24MaCWfryTQDh//5TxeHHaSJS',NULL,'2023-11-05 14:29:16','2023-11-05 14:32:15');
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

-- Dump completed on 2023-11-14 21:11:52
