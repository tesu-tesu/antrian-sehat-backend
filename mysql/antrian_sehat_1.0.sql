-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: antrian_sehat
-- ------------------------------------------------------
-- Server version	8.0.21

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
-- Table structure for table `health_agencies`
--

DROP TABLE IF EXISTS `health_agencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `health_agencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `call_center` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `health_agencies_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `health_agencies`
--

LOCK TABLES `health_agencies` WRITE;
/*!40000 ALTER TABLE `health_agencies` DISABLE KEYS */;
INSERT INTO `health_agencies` VALUES (6,'Puskesmas A','Amsterdam','public/img/health_agencies/90c8OoFBVysyaMAbMeLrHLaJiYizrdI7NKfx1jXE.jpeg','+62 8282','puskesmasA@gmail.com','2020-10-14 08:06:16','2020-10-14 08:06:16'),(8,'Puskesmas B','Bangladesh',NULL,'+62 8282sssss','puskesssmasB@gmail.com','2020-10-18 05:47:41','2020-10-18 05:47:41'),(9,'Puskesmas G','Ciremai','public/img/health_agencies/bvlg7Hnozq3uuqVwv2YKu3Yt8aXU4THfVFG9snoU.jpeg','0812312322','ss@ss.com','2020-10-18 05:48:05','2020-11-25 12:48:41');
/*!40000 ALTER TABLE `health_agencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2020_10_10_201211_create_poly_master',1),(2,'2020_10_10_202230_create_health_agencies',1),(3,'2020_10_10_203154_create_polyclinics',1),(4,'2020_10_10_204123_create_schedules',1),(5,'2020_10_10_205020_create_users_table',1),(6,'2020_10_10_205300_create_password_resets_table',1),(7,'2020_10_10_206506_create_waiting_lists',1),(8,'2020_10_15_190951_update_nullable_at_waiting_lists_table',2),(19,'2020_10_22_234217_create_waiting_list_view',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poly_masters`
--

DROP TABLE IF EXISTS `poly_masters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `poly_masters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poly_masters`
--

LOCK TABLES `poly_masters` WRITE;
/*!40000 ALTER TABLE `poly_masters` DISABLE KEYS */;
INSERT INTO `poly_masters` VALUES (3,'Poli Umum','2020-10-23 04:36:30','2020-10-23 04:36:30'),(4,'Poli Ibu dan Anak','2020-10-23 04:36:30','2020-10-23 04:36:30'),(5,'Poli Gigi','2020-10-23 04:36:30','2020-10-23 04:36:30'),(6,'Poli Balita','2020-10-23 04:36:30','2020-10-23 04:36:30'),(7,'Poli Gizi','2020-10-23 04:36:30','2020-10-23 04:36:30'),(8,'Poli TBC','2020-10-23 04:36:30','2020-10-23 04:36:30'),(9,'Poli Lansia','2020-10-23 04:36:30','2020-10-23 04:36:30'),(10,'Poli Optik','2020-10-23 04:36:30','2020-10-23 04:36:30'),(11,'Laboratorium','2020-10-23 04:36:30','2020-10-23 04:36:30');
/*!40000 ALTER TABLE `poly_masters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `polyclinics`
--

DROP TABLE IF EXISTS `polyclinics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `polyclinics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `poly_master_id` bigint unsigned NOT NULL,
  `health_agency_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `polyclinics_poly_master_id_foreign` (`poly_master_id`),
  KEY `polyclinics_health_agency_id_foreign` (`health_agency_id`),
  CONSTRAINT `polyclinics_health_agency_id_foreign` FOREIGN KEY (`health_agency_id`) REFERENCES `health_agencies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `polyclinics_poly_master_id_foreign` FOREIGN KEY (`poly_master_id`) REFERENCES `poly_masters` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `polyclinics`
--

LOCK TABLES `polyclinics` WRITE;
/*!40000 ALTER TABLE `polyclinics` DISABLE KEYS */;
INSERT INTO `polyclinics` VALUES (4,3,6,NULL,NULL),(5,3,8,NULL,NULL),(6,3,9,NULL,NULL),(7,4,6,NULL,NULL),(8,5,6,NULL,NULL);
/*!40000 ALTER TABLE `polyclinics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `polyclinic_id` bigint unsigned NOT NULL,
  `day` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu') COLLATE utf8_unicode_ci NOT NULL,
  `time_open` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_close` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `schedules_polyclinic_id_foreign` (`polyclinic_id`),
  CONSTRAINT `schedules_polyclinic_id_foreign` FOREIGN KEY (`polyclinic_id`) REFERENCES `polyclinics` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedules`
--

LOCK TABLES `schedules` WRITE;
/*!40000 ALTER TABLE `schedules` DISABLE KEYS */;
INSERT INTO `schedules` VALUES (5,4,'Senin','08:00','20:00','2020-10-31 06:15:57','2020-10-31 06:15:57'),(6,4,'Selasa','08:00','22:00','2020-10-31 06:16:08','2020-10-31 06:16:08'),(8,7,'Rabu','08:00','20:00','2020-10-31 06:16:26','2020-10-31 06:16:26'),(9,8,'Rabu','08:00','20:00','2020-10-31 06:16:30','2020-10-31 06:16:30'),(11,4,'Kamis','07:00','19:00',NULL,NULL),(12,4,'Sabtu','08:00','09:00',NULL,NULL),(13,4,'Minggu','09:00','10:00',NULL,NULL);
/*!40000 ALTER TABLE `schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `residence_number` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `health_agency_id` bigint unsigned DEFAULT NULL,
  `role` enum('Admin','Super Admin','Pasien') COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_residence_number_unique` (`residence_number`),
  KEY `users_health_agency_id_foreign` (`health_agency_id`),
  CONSTRAINT `users_health_agency_id_foreign` FOREIGN KEY (`health_agency_id`) REFERENCES `health_agencies` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Yanu Adi Nugraha','sa@sa.com','$2y$10$iEkjHU6M9rqv9UiSXvzGPeRKFGKKq0I2rYEig3Pr60twZnW0kqaPO','081239084308',NULL,NULL,6,'Super Admin',NULL,'2020-10-14 05:07:45','2020-10-14 05:07:45'),(4,'Dummy','a@a.com','$2y$10$8NlWgEk6EfmTRrOCfilNfeqKN7i7NjEWps.1J7zFsS0ShflDWjKVu','12345678910','22222222',NULL,6,'Admin',NULL,'2020-10-14 05:55:32','2020-10-14 05:55:32'),(5,'Pasien1','pasien1@gmail.com','$2y$10$4AOTVKkhWBnURt25pIIe0e2sStq4kIhiGWWpyUcWBLbTqimzbH9.G','08222222222','1001345678901010',NULL,NULL,'Pasien',NULL,'2020-10-18 11:30:45','2020-10-23 05:27:54'),(6,'Pasien2','pasien2@gmail.com','$2y$10$gf8Szuvt.4YaRF.uixg35uwXpsk2xj7LIcPntCn3xJnghqx.wvuCa','088881118811',NULL,NULL,NULL,'Pasien',NULL,'2020-10-23 05:14:03','2020-10-23 05:14:03'),(8,'pasien3','pasien3@gmail.com','$2y$10$yoyEoWs4E.5T9biLRUkEN.cCTVxiFEgJV0zHr/nM5TpnMnyqzrvxe','333333333333',NULL,NULL,NULL,'Pasien',NULL,'2020-11-18 07:26:00','2020-11-18 07:26:00'),(9,'yanu','sispesa1283@gmail.com','$2y$10$vPMYfmyhWYK5AonLjJ//geVd4ckYw4zansibcpB/a6M9gLfl1TohW','222222222222',NULL,NULL,NULL,'Pasien',NULL,'2020-11-18 10:35:02','2020-11-18 10:35:02'),(10,'yanu2','sispesfa1283@gmail.com','$2y$10$s0H0doh8czlcpCIucNwxyeJxePnwIqOOEPrprW1BDbK66q6Y6qbq6','222222222222',NULL,NULL,NULL,'Pasien',NULL,'2020-11-18 10:37:55','2020-11-18 10:37:55'),(11,'yanu23','sisepesfa1283@gmail.com','$2y$10$xHcfmVsn1Cz6Bv3euA0kBeNIUrEoMQWcymcj9jXtotO1g49pFPyO.','222222222222',NULL,NULL,NULL,'Pasien',NULL,'2020-11-18 10:39:14','2020-11-18 10:39:14'),(12,'yanu23','sisezxdpesfa1283@gmail.com','$2y$10$uChc4LHPqKTJcOfjLrtKfe/V3UZ0gpNv6MFlyNDu9gH33TrHp8BVy','222222222222',NULL,NULL,NULL,'Pasien',NULL,'2020-11-18 10:40:55','2020-11-18 10:40:55'),(13,'suushss','dforiapens@gmail.com','$2y$10$4ENm3.ARWWxWBa0EfKInsuNC1zGOeGFdHH73nd.1yWe0G4YEwb5zO','222222222222',NULL,NULL,NULL,'Pasien',NULL,'2020-11-18 10:42:19','2020-11-18 10:42:19'),(14,'suushss','dforiapecccns@gmail.com','$2y$10$UkHnVBsXnMkBtEnHhTdZreoXzO251wHe6M/9xxXTlT3YtRKArp9xK','222222222222',NULL,NULL,NULL,'Pasien',NULL,'2020-11-18 10:43:54','2020-11-18 10:43:54'),(15,'suushss','dforiapeccc5ns@gmail.com','$2y$10$FpAatTO5ACe.w7RQ5cq5geum7psQnk1RakSAQ6hYHdXxVD94U0lcO','222222222222',NULL,NULL,NULL,'Pasien',NULL,'2020-11-18 10:44:24','2020-11-18 10:44:24'),(16,'ehehhs','shdhdhd@bdbdb.cm','$2y$10$w6axWVUvLmZ5zH1hGUoDBOqAaIwn6Cqp8/aWmtpuWuFLrLgYgNByu','123456789123',NULL,NULL,NULL,'Pasien',NULL,'2020-11-18 10:55:10','2020-11-18 10:55:10'),(17,'hsjsjsj','duhdhdd@bcb.com','$2y$10$ab/DEX2PZKkGOwGrXJsspe/SosQgoXoegidKj8D1JsK0XBx07IG5m','666666666666',NULL,NULL,NULL,'Pasien',NULL,'2020-11-18 10:59:02','2020-11-18 10:59:02'),(18,'hdhdhd','sispes6363ha1283@gmail.com','$2y$10$U7hA.CJ0uKlDvyMECopqwuGTUHIxSrr3222M9i9jf3vx0IvKTRONm','333333333333',NULL,NULL,NULL,'Pasien',NULL,'2020-11-18 11:00:31','2020-11-18 11:00:31'),(19,'yyayaya','kdkdjd@gmak.com','$2y$10$KymOWU0YxzrrB6uKo8zio.5MQLqhzOZCvebPatZmwnCUi.eOQlEXu','646464646464',NULL,NULL,NULL,'Pasien',NULL,'2020-11-19 03:25:59','2020-11-19 03:25:59'),(27,'asdasd','asd@gma.com','$2y$10$36dBmNtvoUBO0hFw8z55nu4FoEeNYdCzMTIVf02hxQM2j/.fkzdQy','12345678910','7777777777777777',NULL,6,'Admin',NULL,'2020-12-02 09:22:41','2020-12-02 09:22:41'),(28,'asdasd','asasd@gma.com','$2y$10$1UhDfSL3iyQhgc.r9KcHY.EPpHkDIq.bqWVhIJ7Iw36BCG8oFQY.u','12345678910','7777777777777772',NULL,8,'Admin',NULL,'2020-12-02 09:24:21','2020-12-02 09:24:21'),(29,'sagsf','ss@sd.com','$2y$10$v3bwPPqnPQ5Cg/yaMGLQBOJ1ZOG75oyolwWIYcXuz0fDo0ryPCHSu','12345678910','7777777777777773',NULL,8,'Admin',NULL,'2020-12-02 09:36:37','2020-12-02 09:36:37');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `waiting_list_view`
--

DROP TABLE IF EXISTS `waiting_list_view`;
/*!50001 DROP VIEW IF EXISTS `waiting_list_view`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `waiting_list_view` AS SELECT 
 1 AS `id`,
 1 AS `user_id`,
 1 AS `residence_number`,
 1 AS `registered_date`,
 1 AS `order_number`,
 1 AS `barcode`,
 1 AS `status`,
 1 AS `schedule_id`,
 1 AS `day`,
 1 AS `polyclinic_id`,
 1 AS `polyclinic`,
 1 AS `health_agency_id`,
 1 AS `health_agency`,
 1 AS `distance_number`,
 1 AS `current_number`,
 1 AS `latest_number`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `waiting_lists`
--

DROP TABLE IF EXISTS `waiting_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `waiting_lists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `schedule_id` bigint unsigned NOT NULL,
  `barcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `registered_date` date NOT NULL,
  `order_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `residence_number` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Belum Diperiksa','Sedang Diperiksa','Sudah Diperiksa','Dibatalkan') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `waiting_lists_barcode_unique` (`barcode`),
  KEY `waiting_lists_user_id_foreign` (`user_id`),
  KEY `waiting_lists_schedule_id_foreign` (`schedule_id`),
  CONSTRAINT `waiting_lists_schedule_id_foreign` FOREIGN KEY (`schedule_id`) REFERENCES `schedules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `waiting_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `waiting_lists`
--

LOCK TABLES `waiting_lists` WRITE;
/*!40000 ALTER TABLE `waiting_lists` DISABLE KEYS */;
INSERT INTO `waiting_lists` VALUES (23,6,6,'23_1234567890123444','2020-11-17','1','1234567890123444','Belum Diperiksa','2020-11-13 09:13:19','2020-11-13 09:13:19');
/*!40000 ALTER TABLE `waiting_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `waiting_list_view`
--

/*!50001 DROP VIEW IF EXISTS `waiting_list_view`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `waiting_list_view` AS select `wl`.`id` AS `id`,`wl`.`user_id` AS `user_id`,`wl`.`residence_number` AS `residence_number`,`wl`.`registered_date` AS `registered_date`,`wl`.`order_number` AS `order_number`,`wl`.`barcode` AS `barcode`,`wl`.`status` AS `status`,`wl`.`schedule_id` AS `schedule_id`,`s`.`day` AS `day`,`p`.`id` AS `polyclinic_id`,`pm`.`name` AS `polyclinic`,`h`.`id` AS `health_agency_id`,`h`.`name` AS `health_agency`,(`wl`.`order_number` - `w`.`order_number`) AS `distance_number`,`w`.`order_number` AS `current_number`,(select max(`wx`.`order_number`) from `waiting_lists` `wx` where ((`wx`.`schedule_id` = `w`.`schedule_id`) and (`wx`.`registered_date` = `w`.`registered_date`)) group by ((0 <> `wx`.`schedule_id`) and (0 <> `wx`.`registered_date`))) AS `latest_number` from (((((`waiting_lists` `wl` join `waiting_lists` `w` on(((`wl`.`registered_date` = `w`.`registered_date`) and (`wl`.`schedule_id` = `w`.`schedule_id`)))) join `schedules` `s` on((`w`.`schedule_id` = `s`.`id`))) join `polyclinics` `p` on((`s`.`polyclinic_id` = `p`.`id`))) join `poly_masters` `pm` on((`p`.`poly_master_id` = `pm`.`id`))) join `health_agencies` `h` on((`p`.`health_agency_id` = `h`.`id`))) where ((`w`.`status` = 'Sedang Diperiksa') or (`w`.`order_number` = (select min(`wx`.`order_number`) from `waiting_lists` `wx` where ((`wx`.`schedule_id` = `w`.`schedule_id`) and (`wx`.`registered_date` = `w`.`registered_date`)) group by ((0 <> `wx`.`schedule_id`) and (0 <> `wx`.`registered_date`))))) order by `wl`.`registered_date`,(`wl`.`order_number` - `w`.`order_number`) */;
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

-- Dump completed on 2020-12-16 18:14:13
