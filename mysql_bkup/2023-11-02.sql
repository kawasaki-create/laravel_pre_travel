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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2023_06_18_115232_create_travel_plans_table',2),(6,'2023_07_02_143139_create_tweets_table',3),(7,'2023_07_02_150012_add_foreign_key_to_travel_plans_table',4),(8,'2023_07_04_075233_add_buget_coiumn_to_tweets_table',5),(9,'2023_07_04_075414_add_buget_coiumn_to_travel_plans_table',6),(10,'2023_07_04_075549_drop_buget_coiumn_to_tweets_table',6),(11,'2023_07_04_233550_drop_date_coiumn_to_travel_plans_table',7),(15,'2023_10_20_232417_create_travel_details_table',8),(16,'2023_10_21_000747_add_foreign_key_to_tweets_table',8),(17,'2023_10_22_223434_add_date_column_to_travel_details_table',9),(18,'2023_10_23_000447_add_time_column_to_travel_details_table',10),(19,'2023_10_24_162447_add_timeft_column_to_travel_details_table',11);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
  `contents` text COLLATE utf8mb4_unicode_ci COMMENT '記録内容',
  `kubun` text COLLATE utf8mb4_unicode_ci COMMENT '1:朝食 2:昼食 3:夕食 4:間食 5:交通費 6:宿泊費 7:お土産代 8:レジャー 9:行きたいところ 10:その他雑費',
  `price` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_from` datetime DEFAULT NULL,
  `time_to` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `travel_details_travel_plan_id_foreign` (`travel_plan_id`),
  CONSTRAINT `travel_details_travel_plan_id_foreign` FOREIGN KEY (`travel_plan_id`) REFERENCES `travel_plans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_details`
--

LOCK TABLES `travel_details` WRITE;
/*!40000 ALTER TABLE `travel_details` DISABLE KEYS */;
INSERT INTO `travel_details` VALUES (1,16,NULL,'1',NULL,'2023-10-24 14:23:26','2023-10-24 14:23:26','2023-10-23',NULL,NULL),(2,16,NULL,'1',NULL,'2023-10-24 14:25:09','2023-10-24 14:25:09','2023-10-23',NULL,NULL),(3,16,'あ','9',NULL,'2023-10-24 22:56:50','2023-10-24 22:56:50','2023-10-23','2023-10-23 12:21:00','2023-10-23 14:22:00'),(4,16,NULL,'9',500,'2023-10-24 23:00:53','2023-10-24 23:00:53','2023-10-23','2023-10-23 00:00:00','2023-10-23 00:00:00'),(5,16,NULL,'9',500,'2023-10-24 23:01:25','2023-10-24 23:01:25','2023-10-23','2023-10-23 00:00:00','2023-10-23 00:00:00'),(6,17,'しごと','9',NULL,'2023-10-25 12:57:26','2023-10-25 12:57:26','2023-10-25','2023-10-25 11:11:00','2023-10-25 12:11:00'),(7,17,'ひるやすみ','9',NULL,'2023-10-25 12:57:26','2023-10-25 12:57:26','2023-10-25','2023-10-25 13:00:00','2023-10-25 14:41:00'),(8,17,'かえり','9',NULL,'2023-10-25 12:57:26','2023-10-25 12:57:26','2023-10-25','2023-10-25 16:22:00','2023-10-25 17:01:00'),(9,17,'フルーツサラダ','1',420,'2023-10-25 13:00:09','2023-10-25 13:00:09','2023-10-25',NULL,NULL),(10,17,'パスタ','4',800,'2023-10-25 13:00:09','2023-10-25 13:00:09','2023-10-25',NULL,NULL),(13,17,'からあげ','4',300,'2023-10-25 13:38:15','2023-10-25 13:38:15','2023-10-25',NULL,NULL),(14,17,'オリジナルメニュー','3',100,'2023-10-26 15:04:08','2023-10-26 15:04:08','2023-10-26',NULL,NULL),(15,17,'ひるごはん','2',411,'2023-10-26 15:06:25','2023-10-26 15:06:25','2023-10-25',NULL,NULL),(16,17,'あのランチ','2',512,'2023-10-26 15:14:07','2023-10-26 15:14:07','2023-10-25',NULL,NULL),(17,17,'ホテル浦島','6',25000,'2023-10-26 15:26:14','2023-10-26 15:26:14','2023-10-25',NULL,NULL),(18,17,'コイニハッテンする','9',NULL,'2023-10-26 15:32:46','2023-10-26 15:32:46','2023-10-25','2023-10-25 23:00:00','2023-10-25 23:59:00'),(19,17,'asa','1',NULL,'2023-10-29 00:43:04','2023-10-29 00:43:04','2023-10-29',NULL,NULL),(20,17,'ko','5',211,'2023-10-29 00:43:04','2023-10-29 00:43:04','2023-10-29',NULL,NULL),(21,17,'ニーン','1',77,'2023-10-29 23:34:39','2023-10-29 23:34:39','2023-10-30',NULL,NULL),(22,17,'朝ごはん2こめ','1',3111,'2023-10-30 00:25:02','2023-10-30 00:25:02','2023-10-25',NULL,NULL),(24,17,'どっか行く','9',NULL,'2023-10-31 15:27:30','2023-10-31 15:27:30','2023-10-30','2023-10-30 10:00:00','2023-10-30 14:00:00'),(25,17,'mannnaka','9',NULL,'2023-10-31 22:35:10','2023-10-31 22:35:10','2023-10-25','2023-10-25 14:00:00','2023-10-25 17:00:00'),(26,17,'削除','9',NULL,'2023-10-31 22:53:07','2023-10-31 22:53:07','2023-10-25','2023-10-25 18:00:00','2023-10-25 19:11:00'),(27,17,'仕事辞める','9',NULL,'2023-11-01 12:43:17','2023-11-01 12:43:17','2023-10-30','2023-10-30 08:12:00','2023-10-30 08:20:00'),(28,17,'浅草','5',510,'2023-11-01 12:44:01','2023-11-01 12:44:01','2023-10-30',NULL,NULL);
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
  `meet_place` text COLLATE utf8mb4_unicode_ci,
  `trip_title` text COLLATE utf8mb4_unicode_ci,
  `trip_start` timestamp NULL DEFAULT NULL,
  `trip_end` timestamp NULL DEFAULT NULL,
  `departure_time` timestamp NULL DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `budget` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `travel_plans_user_id_foreign` (`user_id`),
  CONSTRAINT `travel_plans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `travel_plans`
--

LOCK TABLES `travel_plans` WRITE;
/*!40000 ALTER TABLE `travel_plans` DISABLE KEYS */;
INSERT INTO `travel_plans` VALUES (1,'2023-07-04 22:38:44','2023-07-04 22:38:44','自宅','わくわく旅行','2023-07-07 15:00:00','2023-07-09 15:00:00','2023-07-07 23:42:00',1,NULL),(2,'2023-07-05 22:11:26','2023-07-05 22:11:26','どこかしら','普通の旅行','2023-07-15 15:00:00','2023-07-19 15:00:00','2023-07-16 00:10:00',1,20000),(10,'2023-07-11 13:50:22','2023-07-11 13:50:22',NULL,'あ','2023-07-20 15:00:00','2023-07-21 15:00:00','2023-07-20 15:00:00',1,NULL),(11,'2023-07-11 22:09:33','2023-07-11 22:09:33',NULL,'test','2023-07-11 15:00:00','2023-07-15 15:00:00','2023-07-11 15:00:00',1,NULL),(13,'2023-07-11 22:24:18','2023-07-11 22:24:18',NULL,'まえのやつ','2023-07-02 15:00:00','2023-07-05 15:00:00','2023-07-02 15:00:00',1,NULL),(14,'2023-08-13 13:05:34','2023-08-13 13:05:34','ひみつ','なんと！','2023-08-12 15:00:00','2023-08-15 15:00:00','2023-08-13 13:05:00',1,45000),(15,'2023-10-18 13:17:06','2023-10-18 13:17:06','家','旅行 in 自宅','2023-10-17 15:00:00','2023-10-24 15:00:00','2023-10-18 12:00:00',1,100),(16,'2023-10-22 08:51:30','2023-10-22 08:51:30',NULL,'かぶらせ旅行','2023-10-21 15:00:00','2023-10-22 15:00:00','2023-10-21 15:00:00',1,NULL),(17,'2023-10-25 12:06:30','2023-10-25 12:06:30','いえ','あの旅行','2023-10-24 15:00:00','2023-10-29 15:00:00','2023-10-24 15:00:00',1,1),(18,'2023-10-31 12:26:27','2023-10-31 12:26:27',NULL,'デバッグ旅行','2023-10-30 15:00:00','2023-11-03 15:00:00','2023-10-30 15:00:00',1,NULL);
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
  `tweet` text COLLATE utf8mb4_unicode_ci,
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweets`
--

LOCK TABLES `tweets` WRITE;
/*!40000 ALTER TABLE `tweets` DISABLE KEYS */;
INSERT INTO `tweets` VALUES (1,'あ',1,'2023-07-03 13:25:50','2023-07-03 13:25:50',NULL,NULL),(2,'8月は暑すぎるので旅行は控えます。\r\n\r\nなので、お金を貯めて10月以降に楽しみたいですね',1,'2023-07-03 13:34:47','2023-07-03 13:34:47',NULL,NULL),(3,'タイムゾーン更新した',1,'2023-07-03 22:39:35','2023-07-03 22:39:35',NULL,NULL),(4,'推しの子面白かった！',1,'2023-07-06 14:07:29','2023-07-06 14:07:29',NULL,NULL),(7,'今日はオーケーに買い物に行きました🥰',1,'2023-07-08 10:37:27','2023-07-08 10:37:27',NULL,NULL),(23,'ふへー',1,'2023-07-11 06:45:57','2023-07-09 06:45:57',NULL,NULL),(25,'なーん',1,'2023-07-11 22:27:59','2023-07-11 22:27:59',NULL,NULL),(26,'今日は酒飲んだのでさっさと寝たい',1,'2023-10-18 13:17:30','2023-10-20 13:38:19',1,NULL),(27,'もう23時前じゃん',1,'2023-10-20 13:46:11','2023-10-20 13:46:11',NULL,NULL),(28,'test',1,'2023-10-22 09:30:20','2023-10-22 09:30:20',NULL,15),(31,'ﾂｲｰﾖ',1,'2023-10-25 12:07:47','2023-10-25 12:07:47',NULL,17),(33,'これは普通のつぶやき',1,'2023-11-01 14:24:55','2023-11-01 14:24:55',NULL,18),(34,'編集用',1,'2023-11-01 14:24:59','2023-11-01 14:24:59',NULL,18);
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
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'rin','pointkasegou@gmail.com',NULL,'$2y$10$N.rapjMdUJyQ.fqv0ozOO.s.n4H5yki3Ze.iPvsCtA8ODMPq6yVXG','p6svr9R6uGW5pWgiFNwExCNLX3HDEwycCAfSqJpMBYWxV2Arfk6nf0cQjrUJ','2023-06-18 02:15:50','2023-06-18 02:15:50');
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

-- Dump completed on 2023-11-02 21:45:04
