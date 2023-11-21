-- MySQL dump 10.13  Distrib 8.1.0, for macos13.3 (x86_64)
--
-- Host: localhost    Database: fld
-- ------------------------------------------------------
-- Server version	8.1.0

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
-- Table structure for table `access_control_permission`
--

DROP TABLE IF EXISTS `access_control_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `access_control_permission` (
  `access_control_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  KEY `access_control_permission_access_control_id_foreign` (`access_control_id`),
  KEY `access_control_permission_permission_id_foreign` (`permission_id`),
  CONSTRAINT `access_control_permission_access_control_id_foreign` FOREIGN KEY (`access_control_id`) REFERENCES `access_controls` (`id`) ON DELETE CASCADE,
  CONSTRAINT `access_control_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_control_permission`
--

LOCK TABLES `access_control_permission` WRITE;
/*!40000 ALTER TABLE `access_control_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `access_control_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `access_controls`
--

DROP TABLE IF EXISTS `access_controls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `access_controls` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `group_id` bigint unsigned NOT NULL,
  `module_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `access_controls_group_id_foreign` (`group_id`),
  KEY `access_controls_module_id_foreign` (`module_id`),
  CONSTRAINT `access_controls_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `access_controls_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `access_controls`
--

LOCK TABLES `access_controls` WRITE;
/*!40000 ALTER TABLE `access_controls` DISABLE KEYS */;
/*!40000 ALTER TABLE `access_controls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `notActive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `applications_code_unique` (`code`),
  UNIQUE KEY `applications_path_unique` (`path`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,'Administration','ADMN','/administration','engineering','Administrator Modules',0,'2023-09-12 10:33:09','2023-10-18 08:16:20'),(2,'Logistics','LGS','/logistics','share','Logistics Section',0,'2023-09-12 10:40:04','2023-09-12 10:40:04'),(3,'Requests','OPS','/requests','home','Operations Application',0,'2023-09-12 10:40:04','2023-10-01 06:15:41'),(4,'Fleet Management','FMG','/fleets','train','Fleet Management App',0,'2023-09-12 10:40:04','2023-09-12 10:40:04'),(5,'Helpdesk','HDK','/helpdesk','headphones','Helpdesk Application',0,'2023-09-12 10:40:04','2023-09-12 10:40:04'),(6,'Inventory','INV','/inventory','store','Inventory Application',0,'2023-09-12 10:40:04','2023-09-12 10:40:04'),(7,'Operations','OPE','/operations','api','Some description here',0,'2023-10-17 04:38:43','2023-10-17 04:38:43'),(9,'Tasks','TSKS','/tasks','task_alt','Tasks Application section',0,'2023-10-24 06:44:13','2023-10-24 06:44:13');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `approvals`
--

DROP TABLE IF EXISTS `approvals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `approvals` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `group_id` bigint unsigned NOT NULL,
  `module_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `approvals_group_id_foreign` (`group_id`),
  KEY `approvals_module_id_foreign` (`module_id`),
  KEY `approvals_department_id_foreign` (`department_id`),
  CONSTRAINT `approvals_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `approvals_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `approvals_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `approvals`
--

LOCK TABLES `approvals` WRITE;
/*!40000 ALTER TABLE `approvals` DISABLE KEYS */;
/*!40000 ALTER TABLE `approvals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `availabilities`
--

DROP TABLE IF EXISTS `availabilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `availabilities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `availabilities_label_unique` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `availabilities`
--

LOCK TABLES `availabilities` WRITE;
/*!40000 ALTER TABLE `availabilities` DISABLE KEYS */;
INSERT INTO `availabilities` VALUES (1,'Available','available','2023-09-12 10:33:09','2023-09-12 10:33:09');
/*!40000 ALTER TABLE `availabilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `booking_details`
--

DROP TABLE IF EXISTS `booking_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `booking_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `room_id` bigint unsigned NOT NULL,
  `seating_id` bigint unsigned NOT NULL,
  `start` datetime DEFAULT NULL,
  `finish` datetime DEFAULT NULL,
  `duration` bigint NOT NULL DEFAULT '0',
  `pa_system` tinyint(1) NOT NULL DEFAULT '0',
  `audio_visual_system` tinyint(1) NOT NULL DEFAULT '0',
  `internet` tinyint(1) NOT NULL DEFAULT '0',
  `tea_snacks` tinyint(1) NOT NULL DEFAULT '0',
  `breakfast` tinyint(1) NOT NULL DEFAULT '0',
  `lunch` tinyint(1) NOT NULL DEFAULT '0',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','inprogress','concluded','noshow') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `booking_details_booking_id_foreign` (`booking_id`),
  KEY `booking_details_user_id_foreign` (`user_id`),
  KEY `booking_details_room_id_foreign` (`room_id`),
  KEY `booking_details_seating_id_foreign` (`seating_id`),
  CONSTRAINT `booking_details_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booking_details_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booking_details_seating_id_foreign` FOREIGN KEY (`seating_id`) REFERENCES `seatings` (`id`) ON DELETE CASCADE,
  CONSTRAINT `booking_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `booking_details`
--

LOCK TABLES `booking_details` WRITE;
/*!40000 ALTER TABLE `booking_details` DISABLE KEYS */;
INSERT INTO `booking_details` VALUES (3,3,1,1,3,'2023-10-20 09:00:00','2023-10-20 12:00:00',0,1,1,1,1,1,1,'Some descriptions here','pending','2023-10-17 04:01:14','2023-10-17 04:01:14'),(4,4,1,3,3,'2023-10-21 09:00:00','2023-10-21 11:00:00',0,1,1,1,1,1,0,'Another description','pending','2023-10-17 08:47:28','2023-10-17 08:47:28'),(5,4,1,1,3,'2023-10-20 09:00:00','2023-10-20 11:00:00',0,1,1,1,1,1,0,'Description Here','pending','2023-10-17 08:47:28','2023-10-17 08:47:28');
/*!40000 ALTER TABLE `booking_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `budget_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `finish` datetime DEFAULT NULL,
  `duration` bigint NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','registered','approved','denied') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bookings_code_unique` (`code`),
  KEY `bookings_user_id_foreign` (`user_id`),
  CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (3,1,'RMK25517','Training for Staff','R300100','2023-10-20 09:00:00','2023-10-20 12:00:00',0,'Description here',NULL,'approved',0,'2023-10-17 04:01:14','2023-10-17 05:33:43'),(4,1,'RMK56176','Meeting with External Auditors','R300100','2023-10-20 09:00:00','2023-10-21 11:00:00',0,'Final Description here',NULL,'approved',0,'2023-10-17 08:47:28','2023-10-17 08:51:57');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Toyota','2023-09-13 05:58:31','2023-09-13 05:58:31'),(2,'HP','2023-09-29 07:48:07','2023-09-29 07:48:07'),(3,'Tests','2023-10-29 08:01:48','2023-10-29 08:05:16'),(4,'Testers Rest','2023-10-29 08:13:52','2023-10-29 08:14:50'),(5,'Another One','2023-10-29 08:14:23','2023-10-29 08:14:31');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acronym` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rc_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('owner','support','vendor','jv','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'vendor',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companies_acronym_unique` (`acronym`),
  UNIQUE KEY `companies_rc_no_unique` (`rc_no`),
  UNIQUE KEY `companies_tin_no_unique` (`tin_no`),
  UNIQUE KEY `companies_email_unique` (`email`),
  UNIQUE KEY `companies_mobile_unique` (`mobile`),
  UNIQUE KEY `companies_payment_code_unique` (`payment_code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'Nigerian Content Development and Monitoring Board','NCDMB',NULL,NULL,NULL,NULL,NULL,'owner','2023-09-12 10:33:09','2023-09-12 10:33:09'),(2,'Mega Star','MEGA','RC546333','12333-0001','iambobbymax@gmail.com','0909379079','88000','vendor','2023-09-13 06:38:52','2023-09-13 06:38:52');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_task`
--

DROP TABLE IF EXISTS `company_task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `company_task` (
  `task_id` bigint unsigned NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  KEY `company_task_task_id_foreign` (`task_id`),
  KEY `company_task_company_id_foreign` (`company_id`),
  CONSTRAINT `company_task_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `company_task_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_task`
--

LOCK TABLES `company_task` WRITE;
/*!40000 ALTER TABLE `company_task` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `complaints` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `item_id` bigint unsigned NOT NULL,
  `type` enum('service','repair','incident') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'repair',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `total_cost` decimal(30,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','registered','assessment','review','inprogress','completed','approved','denied') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `condition` enum('pending','good','bad') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `complaints_user_id_foreign` (`user_id`),
  KEY `complaints_item_id_foreign` (`item_id`),
  CONSTRAINT `complaints_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `complaints_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complaints`
--

LOCK TABLES `complaints` WRITE;
/*!40000 ALTER TABLE `complaints` DISABLE KEYS */;
/*!40000 ALTER TABLE `complaints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consonances`
--

DROP TABLE IF EXISTS `consonances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `consonances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consonanceable_id` bigint unsigned NOT NULL,
  `consonanceable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','accepted','declined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `consonances_user_id_foreign` (`user_id`),
  CONSTRAINT `consonances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consonances`
--

LOCK TABLES `consonances` WRITE;
/*!40000 ALTER TABLE `consonances` DISABLE KEYS */;
INSERT INTO `consonances` VALUES (1,1,'Another thing here',NULL,'C:\\fakepath\\Laptop Specs.docx',8,'App\\Models\\Reservation','accepted','2023-10-11 10:12:05','2023-10-12 00:21:38'),(2,1,'Please tell me something new',NULL,'C:\\fakepath\\Screenshot 2023-10-09 at 11.11.18.png',8,'App\\Models\\Reservation','declined','2023-10-11 10:12:05','2023-10-12 00:21:38'),(3,1,'Another is here',NULL,'C:\\fakepath\\Laptop Specs.docx',7,'App\\Models\\Reservation','declined','2023-10-11 10:14:23','2023-10-12 01:29:24'),(4,1,'Something is here',NULL,'C:\\fakepath\\prices.xlsx',7,'App\\Models\\Reservation','accepted','2023-10-11 10:14:23','2023-10-12 01:29:24'),(5,1,'File is here again',NULL,'C:\\fakepath\\prices.xlsx',9,'App\\Models\\Reservation','accepted','2023-10-11 11:20:04','2023-10-12 01:31:30'),(6,1,'Another one should be here sha',NULL,'C:\\fakepath\\Screenshot 2023-10-09 at 11.11.18.png',6,'App\\Models\\Reservation','declined','2023-10-12 01:21:14','2023-10-12 01:30:32'),(7,1,'Something should be here',NULL,'C:\\fakepath\\proposal.pdf',6,'App\\Models\\Reservation','accepted','2023-10-12 01:21:14','2023-10-12 01:30:32'),(8,1,'Anither one',NULL,'C:\\fakepath\\proposal.docx',10,'App\\Models\\Reservation','declined','2023-10-12 01:36:37','2023-10-12 01:37:38'),(9,1,'here here',NULL,'C:\\fakepath\\AONOMY.pdf',10,'App\\Models\\Reservation','accepted','2023-10-12 01:36:37','2023-10-12 01:37:38'),(10,1,'Make it',NULL,'C:\\fakepath\\proposal.pdf',11,'App\\Models\\Reservation','accepted','2023-10-12 01:37:05','2023-10-12 01:37:57'),(11,1,'Break it',NULL,'C:\\fakepath\\Screenshot 2023-10-09 at 11.11.18.png',11,'App\\Models\\Reservation','declined','2023-10-12 01:37:05','2023-10-12 01:37:57'),(12,3,'add another one',NULL,'C:\\fakepath\\NCDF BUDGET 2023.xlsx',13,'App\\Models\\Reservation','pending','2023-10-31 12:55:31','2023-10-31 12:55:31'),(13,3,'give some description',NULL,'C:\\fakepath\\monthly-report-today.pdf',13,'App\\Models\\Reservation','pending','2023-10-31 12:55:31','2023-10-31 12:55:31'),(14,3,'this booking',NULL,'C:\\fakepath\\NCDF BUDGET 2023.xlsx',12,'App\\Models\\Reservation','pending','2023-10-31 12:55:58','2023-10-31 12:55:58'),(15,4,'ffffff',NULL,'C:\\fakepath\\217fc5cf-914e-4262-b197-9a772069a34b.JPG',15,'App\\Models\\Reservation','accepted','2023-11-01 13:02:51','2023-11-01 13:04:24'),(16,4,'DFFFFFfff',NULL,'C:\\fakepath\\SP78639.pdf',15,'App\\Models\\Reservation','declined','2023-11-01 13:02:51','2023-11-01 13:04:24'),(17,4,'hhhhhhh',NULL,'C:\\fakepath\\9c8601a2-4abc-4c64-b90f-41e19755448f.JPG',14,'App\\Models\\Reservation','accepted','2023-11-01 13:03:08','2023-11-01 13:04:35');
/*!40000 ALTER TABLE `consonances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department_inventory_category`
--

DROP TABLE IF EXISTS `department_inventory_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department_inventory_category` (
  `department_id` bigint unsigned NOT NULL,
  `inventory_category_id` bigint unsigned NOT NULL,
  KEY `department_inventory_category_department_id_foreign` (`department_id`),
  KEY `department_inventory_category_inventory_category_id_foreign` (`inventory_category_id`),
  CONSTRAINT `department_inventory_category_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `department_inventory_category_inventory_category_id_foreign` FOREIGN KEY (`inventory_category_id`) REFERENCES `inventory_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_inventory_category`
--

LOCK TABLES `department_inventory_category` WRITE;
/*!40000 ALTER TABLE `department_inventory_category` DISABLE KEYS */;
INSERT INTO `department_inventory_category` VALUES (1,1),(4,1),(1,2),(4,2),(4,3),(1,3),(3,3),(1,4),(3,4),(4,4),(1,5),(5,5),(4,6),(1,6),(2,6);
/*!40000 ALTER TABLE `department_inventory_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department_types`
--

DROP TABLE IF EXISTS `department_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `department_types_label_unique` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_types`
--

LOCK TABLES `department_types` WRITE;
/*!40000 ALTER TABLE `department_types` DISABLE KEYS */;
INSERT INTO `department_types` VALUES (1,'Directorate','directorate','2023-09-12 10:33:09','2023-09-12 10:33:09'),(2,'Division','division','2023-09-13 05:54:11','2023-09-13 05:54:11'),(3,'Department','department','2023-09-13 05:54:19','2023-09-13 05:54:19'),(4,'Unit','unit','2023-09-13 05:54:25','2023-09-13 05:54:25');
/*!40000 ALTER TABLE `department_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departmentables`
--

DROP TABLE IF EXISTS `departmentables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departmentables` (
  `department_id` bigint unsigned NOT NULL,
  `departmentable_id` bigint unsigned NOT NULL,
  `departmentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departmentables`
--

LOCK TABLES `departmentables` WRITE;
/*!40000 ALTER TABLE `departmentables` DISABLE KEYS */;
INSERT INTO `departmentables` VALUES (4,7,'App\\Models\\Application'),(3,7,'App\\Models\\Application'),(1,7,'App\\Models\\Application'),(3,1,'App\\Models\\Application'),(4,6,'App\\Models\\Application'),(3,6,'App\\Models\\Application'),(1,6,'App\\Models\\Application'),(4,2,'App\\Models\\Application'),(1,2,'App\\Models\\Application'),(4,3,'App\\Models\\Application'),(3,3,'App\\Models\\Application'),(1,3,'App\\Models\\Application'),(3,5,'App\\Models\\Application'),(4,5,'App\\Models\\Application'),(1,5,'App\\Models\\Application'),(4,4,'App\\Models\\Application'),(1,4,'App\\Models\\Application'),(4,40,'App\\Models\\Module'),(1,40,'App\\Models\\Module'),(4,39,'App\\Models\\Module'),(1,39,'App\\Models\\Module'),(4,38,'App\\Models\\Module'),(1,38,'App\\Models\\Module'),(4,8,'App\\Models\\Application'),(1,8,'App\\Models\\Application'),(4,43,'App\\Models\\Module'),(1,43,'App\\Models\\Module'),(4,44,'App\\Models\\Module'),(1,44,'App\\Models\\Module'),(4,45,'App\\Models\\Module'),(1,45,'App\\Models\\Module'),(4,46,'App\\Models\\Module'),(1,1,'App\\Models\\Application'),(4,9,'App\\Models\\Application'),(3,9,'App\\Models\\Application'),(1,9,'App\\Models\\Application'),(1,34,'App\\Models\\Module'),(4,34,'App\\Models\\Module'),(3,34,'App\\Models\\Module'),(4,10,'App\\Models\\Module'),(3,10,'App\\Models\\Module'),(1,10,'App\\Models\\Module'),(3,27,'App\\Models\\Module'),(4,27,'App\\Models\\Module'),(5,27,'App\\Models\\Module'),(1,27,'App\\Models\\Module'),(2,27,'App\\Models\\Module'),(1,35,'App\\Models\\Module'),(5,35,'App\\Models\\Module'),(4,35,'App\\Models\\Module'),(3,35,'App\\Models\\Module'),(2,35,'App\\Models\\Module'),(1,36,'App\\Models\\Module'),(4,36,'App\\Models\\Module'),(3,36,'App\\Models\\Module'),(2,36,'App\\Models\\Module'),(5,36,'App\\Models\\Module'),(3,44,'App\\Models\\Module'),(1,47,'App\\Models\\Module'),(4,47,'App\\Models\\Module'),(3,47,'App\\Models\\Module'),(4,48,'App\\Models\\Module'),(1,48,'App\\Models\\Module'),(4,9,'App\\Models\\Module'),(1,9,'App\\Models\\Module'),(7,3,'App\\Models\\Application'),(6,3,'App\\Models\\Application'),(7,2,'App\\Models\\Application'),(6,2,'App\\Models\\Application'),(5,9,'App\\Models\\Application'),(3,2,'App\\Models\\Application'),(3,49,'App\\Models\\Module'),(4,49,'App\\Models\\Module'),(8,5,'App\\Models\\Application'),(8,9,'App\\Models\\Application'),(8,3,'App\\Models\\Application'),(5,5,'App\\Models\\Application');
/*!40000 ALTER TABLE `departmentables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_type_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentId` bigint NOT NULL DEFAULT '0',
  `controller` bigint NOT NULL DEFAULT '0',
  `hod` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_code_unique` (`code`),
  KEY `departments_department_type_id_foreign` (`department_type_id`),
  CONSTRAINT `departments_department_type_id_foreign` FOREIGN KEY (`department_type_id`) REFERENCES `department_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,1,'Administration','SAD',0,0,0,'2023-09-12 10:33:09','2023-09-12 10:33:09'),(2,1,'Corporate Services','DCS',0,0,0,'2023-09-13 02:53:05','2023-09-13 02:53:05'),(3,2,'Information Communication Technology','ICT',2,0,0,'2023-09-13 05:55:03','2023-09-13 05:55:03'),(4,2,'Facility and Logistics','FLD',2,0,0,'2023-09-13 05:56:14','2023-09-13 05:56:14'),(5,2,'Health Security Safety & Environment','HSSE',2,0,0,'2023-10-19 14:10:49','2023-10-19 14:10:49'),(6,1,'Finance and Personnel Management','FPM',0,0,0,'2023-10-31 12:31:18','2023-10-31 12:31:18'),(7,2,'Human Resources','HRD',6,0,0,'2023-10-31 12:31:37','2023-10-31 12:31:37'),(8,3,'Assets and Facility Management','AFM',4,0,0,'2023-11-16 10:57:13','2023-11-16 10:57:13');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `process_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `ref_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` text COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `documents_ref_no_unique` (`ref_no`),
  KEY `documents_process_id_foreign` (`process_id`),
  KEY `documents_user_id_foreign` (`user_id`),
  KEY `documents_department_id_foreign` (`department_id`),
  CONSTRAINT `documents_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `documents_process_id_foreign` FOREIGN KEY (`process_id`) REFERENCES `processes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drafts`
--

DROP TABLE IF EXISTS `drafts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drafts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `document_id` bigint unsigned NOT NULL,
  `signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','review','approved','declined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `drafts_user_id_foreign` (`user_id`),
  KEY `drafts_department_id_foreign` (`department_id`),
  KEY `drafts_document_id_foreign` (`document_id`),
  CONSTRAINT `drafts_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `drafts_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `drafts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drafts`
--

LOCK TABLES `drafts` WRITE;
/*!40000 ALTER TABLE `drafts` DISABLE KEYS */;
/*!40000 ALTER TABLE `drafts` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `floorables`
--

DROP TABLE IF EXISTS `floorables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `floorables` (
  `floor_id` bigint unsigned NOT NULL,
  `floorable_id` bigint unsigned NOT NULL,
  `floorable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `floorables`
--

LOCK TABLES `floorables` WRITE;
/*!40000 ALTER TABLE `floorables` DISABLE KEYS */;
/*!40000 ALTER TABLE `floorables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `floors`
--

DROP TABLE IF EXISTS `floors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `floors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `floors`
--

LOCK TABLES `floors` WRITE;
/*!40000 ALTER TABLE `floors` DISABLE KEYS */;
INSERT INTO `floors` VALUES (1,'Ground Floor',0,'2023-09-12 10:43:09','2023-09-12 10:43:09'),(2,'First Floor',1,'2023-09-12 10:43:17','2023-09-12 10:43:17'),(3,'Second Floor',2,'2023-09-12 10:43:26','2023-09-12 10:43:26'),(4,'Third Floor',3,'2023-09-12 10:43:38','2023-09-12 10:43:38'),(5,'Forth Floor',4,'2023-09-12 10:43:48','2023-09-12 10:43:48');
/*!40000 ALTER TABLE `floors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `furniture_request_items`
--

DROP TABLE IF EXISTS `furniture_request_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `furniture_request_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `furniture_request_id` bigint unsigned NOT NULL,
  `item_id` bigint unsigned NOT NULL,
  `quantity` bigint NOT NULL DEFAULT '0',
  `status` enum('pending','resolved','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `furniture_request_items_furniture_request_id_foreign` (`furniture_request_id`),
  KEY `furniture_request_items_item_id_foreign` (`item_id`),
  CONSTRAINT `furniture_request_items_furniture_request_id_foreign` FOREIGN KEY (`furniture_request_id`) REFERENCES `furniture_requests` (`id`) ON DELETE CASCADE,
  CONSTRAINT `furniture_request_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `furniture_request_items`
--

LOCK TABLES `furniture_request_items` WRITE;
/*!40000 ALTER TABLE `furniture_request_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `furniture_request_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `furniture_requests`
--

DROP TABLE IF EXISTS `furniture_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `furniture_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `location_id` bigint unsigned NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `type` enum('new','repair','replacement','move') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `status` enum('pending','registered','inprogress','approved','denied','resolved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `furniture_requests_user_id_foreign` (`user_id`),
  KEY `furniture_requests_location_id_foreign` (`location_id`),
  CONSTRAINT `furniture_requests_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `furniture_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `furniture_requests`
--

LOCK TABLES `furniture_requests` WRITE;
/*!40000 ALTER TABLE `furniture_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `furniture_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grade_levels`
--

DROP TABLE IF EXISTS `grade_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grade_levels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `grade_levels_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grade_levels`
--

LOCK TABLES `grade_levels` WRITE;
/*!40000 ALTER TABLE `grade_levels` DISABLE KEYS */;
INSERT INTO `grade_levels` VALUES (1,'Technical Administrator','TAR','2023-09-12 10:33:09','2023-09-12 10:33:09'),(2,'Officer III','SS7','2023-09-13 06:16:19','2023-09-13 06:16:19'),(3,'Officer II','SS6','2023-09-13 06:16:33','2023-09-13 06:16:33'),(4,'Officer I','SS5','2023-09-13 06:17:02','2023-09-13 06:17:02'),(5,'Senior Officer','SS4','2023-09-13 06:17:22','2023-09-13 06:17:22'),(6,'Supervisor','SS3','2023-09-13 06:17:39','2023-09-13 06:17:39'),(7,'Senior Supervisor','SS2','2023-09-13 06:17:52','2023-09-13 06:17:52'),(8,'Chief Supervisor','SS1','2023-09-13 06:18:03','2023-09-13 06:18:03'),(9,'Assistant Deputy Manager','M6','2023-09-13 06:18:30','2023-09-13 06:18:30');
/*!40000 ALTER TABLE `grade_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groupables`
--

DROP TABLE IF EXISTS `groupables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groupables` (
  `group_id` bigint unsigned NOT NULL,
  `groupable_id` bigint unsigned NOT NULL,
  `groupable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groupables`
--

LOCK TABLES `groupables` WRITE;
/*!40000 ALTER TABLE `groupables` DISABLE KEYS */;
INSERT INTO `groupables` VALUES (1,1,'App\\Models\\Module'),(1,2,'App\\Models\\Module'),(1,1,'App\\Models\\Application'),(1,1,'App\\Models\\User'),(1,2,'App\\Models\\Application'),(1,3,'App\\Models\\Application'),(1,4,'App\\Models\\Application'),(1,5,'App\\Models\\Application'),(1,6,'App\\Models\\Application'),(1,3,'App\\Models\\Module'),(1,4,'App\\Models\\Module'),(1,5,'App\\Models\\Module'),(1,6,'App\\Models\\Module'),(1,7,'App\\Models\\Module'),(1,8,'App\\Models\\Module'),(1,9,'App\\Models\\Module'),(1,10,'App\\Models\\Module'),(1,11,'App\\Models\\Module'),(1,12,'App\\Models\\Module'),(1,13,'App\\Models\\Module'),(1,14,'App\\Models\\Module'),(1,15,'App\\Models\\Module'),(1,16,'App\\Models\\Module'),(1,17,'App\\Models\\Module'),(1,18,'App\\Models\\Module'),(1,19,'App\\Models\\Module'),(1,20,'App\\Models\\Module'),(1,21,'App\\Models\\Module'),(1,22,'App\\Models\\Module'),(1,23,'App\\Models\\Module'),(1,24,'App\\Models\\Module'),(1,25,'App\\Models\\Module'),(1,26,'App\\Models\\Module'),(1,27,'App\\Models\\Module'),(1,28,'App\\Models\\Module'),(1,29,'App\\Models\\Module'),(1,30,'App\\Models\\Module'),(1,31,'App\\Models\\Module'),(1,32,'App\\Models\\Module'),(1,33,'App\\Models\\Module'),(1,7,'App\\Models\\Application'),(1,40,'App\\Models\\Module'),(1,39,'App\\Models\\Module'),(1,38,'App\\Models\\Module'),(1,8,'App\\Models\\Application'),(1,43,'App\\Models\\Module'),(1,44,'App\\Models\\Module'),(1,45,'App\\Models\\Module'),(1,46,'App\\Models\\Module'),(5,2,'App\\Models\\User'),(6,2,'App\\Models\\User'),(3,3,'App\\Models\\User'),(6,3,'App\\Models\\User'),(6,4,'App\\Models\\User'),(1,4,'App\\Models\\User'),(6,5,'App\\Models\\User'),(9,6,'App\\Models\\User'),(6,6,'App\\Models\\User'),(5,6,'App\\Models\\User'),(3,8,'App\\Models\\Application'),(8,8,'App\\Models\\Application'),(3,7,'App\\Models\\Application'),(8,7,'App\\Models\\Application'),(3,2,'App\\Models\\Application'),(8,2,'App\\Models\\Application'),(6,3,'App\\Models\\Application'),(3,4,'App\\Models\\Application'),(8,4,'App\\Models\\Application'),(5,5,'App\\Models\\Application'),(8,5,'App\\Models\\Application'),(3,6,'App\\Models\\Application'),(8,6,'App\\Models\\Application'),(6,9,'App\\Models\\Application'),(2,9,'App\\Models\\Application'),(5,9,'App\\Models\\Application'),(3,9,'App\\Models\\Application'),(8,9,'App\\Models\\Application'),(1,9,'App\\Models\\Application'),(4,9,'App\\Models\\Application'),(1,34,'App\\Models\\Module'),(5,34,'App\\Models\\Module'),(4,34,'App\\Models\\Module'),(3,34,'App\\Models\\Module'),(6,10,'App\\Models\\Module'),(3,10,'App\\Models\\Module'),(4,10,'App\\Models\\Module'),(5,10,'App\\Models\\Module'),(2,10,'App\\Models\\Module'),(6,27,'App\\Models\\Module'),(6,35,'App\\Models\\Module'),(1,35,'App\\Models\\Module'),(6,36,'App\\Models\\Module'),(1,36,'App\\Models\\Module'),(3,47,'App\\Models\\Module'),(1,47,'App\\Models\\Module'),(5,47,'App\\Models\\Module'),(1,48,'App\\Models\\Module'),(3,48,'App\\Models\\Module'),(6,7,'App\\Models\\User'),(3,9,'App\\Models\\Module'),(6,8,'App\\Models\\User'),(6,2,'App\\Models\\Application'),(6,9,'App\\Models\\User'),(4,9,'App\\Models\\User'),(1,49,'App\\Models\\Module'),(6,10,'App\\Models\\User'),(8,10,'App\\Models\\User'),(3,10,'App\\Models\\User'),(3,5,'App\\Models\\Application'),(6,11,'App\\Models\\User'),(8,11,'App\\Models\\User'),(4,11,'App\\Models\\User'),(6,5,'App\\Models\\Application'),(4,5,'App\\Models\\Application');
/*!40000 ALTER TABLE `groupables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_label_unique` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Administrators','administrators',1,'2023-09-12 10:33:09','2023-09-12 10:33:09'),(2,'Drivers','drivers',0,'2023-10-19 15:07:22','2023-10-19 15:07:22'),(3,'FLD Admin','fld-admin',0,'2023-10-19 15:07:30','2023-10-19 15:07:30'),(4,'HSSE Admin','hsse-admin',0,'2023-10-19 15:07:38','2023-10-19 15:07:38'),(5,'ICT Admin','ict-admin',0,'2023-10-19 15:07:45','2023-10-19 15:07:45'),(6,'Staff','staff',0,'2023-10-19 15:07:57','2023-10-19 15:07:57'),(7,'Directors','directors',0,'2023-10-19 15:08:04','2023-10-19 15:08:04'),(8,'Supervisors','supervisors',0,'2023-10-19 15:08:12','2023-10-19 15:08:12'),(9,'Managers','managers',0,'2023-10-19 15:08:19','2023-10-19 15:08:19'),(10,'General Managers','general-managers',0,'2023-10-19 15:08:26','2023-10-19 15:08:26'),(11,'Executive Secretary','executive-secretary',0,'2023-10-19 15:08:51','2023-10-19 15:08:51');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hall_categories`
--

DROP TABLE IF EXISTS `hall_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hall_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hall_categories`
--

LOCK TABLES `hall_categories` WRITE;
/*!40000 ALTER TABLE `hall_categories` DISABLE KEYS */;
INSERT INTO `hall_categories` VALUES (1,'Conference','2023-09-12 10:42:10','2023-09-12 10:42:10'),(2,'Meetings','2023-09-12 10:42:17','2023-09-12 10:42:17');
/*!40000 ALTER TABLE `hall_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `helpdesk_types`
--

DROP TABLE IF EXISTS `helpdesk_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `helpdesk_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `isDeactivated` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `helpdesk_types_label_unique` (`label`),
  KEY `helpdesk_types_department_id_foreign` (`department_id`),
  CONSTRAINT `helpdesk_types_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `helpdesk_types`
--

LOCK TABLES `helpdesk_types` WRITE;
/*!40000 ALTER TABLE `helpdesk_types` DISABLE KEYS */;
INSERT INTO `helpdesk_types` VALUES (1,8,'Facility','facility','Incidents that relate to Facility',0,'2023-11-16 10:58:27','2023-11-16 10:58:27'),(2,5,'Security/Safety','securitysafety','related to safety',0,'2023-11-16 11:01:41','2023-11-16 11:01:41'),(3,3,'IT Support','it-support','related to IT',0,'2023-11-16 11:02:33','2023-11-16 11:02:33'),(4,1,'Test','test','Seom test',0,'2023-11-19 11:04:22','2023-11-19 11:04:22');
/*!40000 ALTER TABLE `helpdesk_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incident_categories`
--

DROP TABLE IF EXISTS `incident_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incident_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `incident_categories_label_unique` (`label`),
  KEY `incident_categories_department_id_foreign` (`department_id`),
  CONSTRAINT `incident_categories_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incident_categories`
--

LOCK TABLES `incident_categories` WRITE;
/*!40000 ALTER TABLE `incident_categories` DISABLE KEYS */;
INSERT INTO `incident_categories` VALUES (1,4,'Testing','testing',NULL,'2023-10-19 11:34:14','2023-10-19 11:34:14'),(2,8,'Facility','facility',NULL,'2023-10-19 14:07:33','2023-11-19 13:53:39'),(3,3,'IT Support','it-support',NULL,'2023-10-31 13:04:58','2023-11-19 13:53:19'),(4,5,'Security/Safety','securitysafety',NULL,'2023-11-01 13:10:01','2023-11-19 13:52:51');
/*!40000 ALTER TABLE `incident_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_categories`
--

DROP TABLE IF EXISTS `inventory_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventory_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_categories`
--

LOCK TABLES `inventory_categories` WRITE;
/*!40000 ALTER TABLE `inventory_categories` DISABLE KEYS */;
INSERT INTO `inventory_categories` VALUES (1,'Confectionary',NULL,'2023-09-13 05:56:48','2023-09-13 05:56:48'),(2,'Fleet',NULL,'2023-09-13 05:57:16','2023-09-13 05:57:16'),(3,'Electronics',NULL,'2023-09-29 07:50:12','2023-09-29 07:50:12'),(4,'Equipments',NULL,'2023-10-17 10:55:32','2023-10-17 10:55:32'),(5,'Testing',NULL,'2023-10-29 08:54:04','2023-10-29 08:54:04'),(6,'Another Yet',NULL,'2023-10-29 08:55:18','2023-10-29 08:55:26');
/*!40000 ALTER TABLE `inventory_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoice_items`
--

DROP TABLE IF EXISTS `invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `invoice_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_invoice_id` bigint unsigned NOT NULL,
  `item_id` bigint unsigned NOT NULL,
  `quantity` bigint NOT NULL,
  `amount` decimal(30,2) NOT NULL DEFAULT '0.00',
  `expiry_date` datetime DEFAULT NULL,
  `status` enum('serviceable','returned','allocated','end-of-life','available','boarded','faulty','expired') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_items_purchase_invoice_id_foreign` (`purchase_invoice_id`),
  KEY `invoice_items_item_id_foreign` (`item_id`),
  CONSTRAINT `invoice_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `invoice_items_purchase_invoice_id_foreign` FOREIGN KEY (`purchase_invoice_id`) REFERENCES `purchase_invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoice_items`
--

LOCK TABLES `invoice_items` WRITE;
/*!40000 ALTER TABLE `invoice_items` DISABLE KEYS */;
INSERT INTO `invoice_items` VALUES (1,3,2,300,100000.00,'2023-10-25 00:00:00','available','2023-10-31 01:34:51','2023-10-31 01:34:51');
/*!40000 ALTER TABLE `invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `issues` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `incident_category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parentId` bigint NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `issues_label_unique` (`label`),
  KEY `issues_incident_category_id_foreign` (`incident_category_id`),
  CONSTRAINT `issues_incident_category_id_foreign` FOREIGN KEY (`incident_category_id`) REFERENCES `incident_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `issues`
--

LOCK TABLES `issues` WRITE;
/*!40000 ALTER TABLE `issues` DISABLE KEYS */;
INSERT INTO `issues` VALUES (1,1,'Building Issues','building-issues',0,NULL,'2023-10-19 11:38:17','2023-10-19 11:38:17'),(2,2,'Conference Hall Parking','conference-hall-parking',0,NULL,'2023-10-19 14:08:31','2023-10-19 14:08:31'),(3,3,'Security Check','security-check',0,NULL,'2023-10-31 13:05:41','2023-10-31 13:05:41'),(4,4,'Fainting','fainting',0,NULL,'2023-11-01 13:14:25','2023-11-01 13:14:25'),(5,4,'Protest','protest',0,NULL,'2023-11-21 07:41:59','2023-11-21 07:41:59');
/*!40000 ALTER TABLE `issues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_features`
--

DROP TABLE IF EXISTS `item_features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `item_features` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `item_id` bigint unsigned NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tank_capacity` bigint NOT NULL DEFAULT '0',
  `insurance_due_date` datetime DEFAULT NULL,
  `due_for_servicing` tinyint(1) NOT NULL DEFAULT '0',
  `insurance_due` tinyint(1) NOT NULL DEFAULT '0',
  `insurance_status` enum('comprehensive','third-party-plus','third-party') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'third-party',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_features_item_id_foreign` (`item_id`),
  CONSTRAINT `item_features_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_features`
--

LOCK TABLES `item_features` WRITE;
/*!40000 ALTER TABLE `item_features` DISABLE KEYS */;
INSERT INTO `item_features` VALUES (1,1,'Blue',1500,'2023-10-27 00:00:00',0,0,'comprehensive','2023-09-13 07:23:31','2023-09-13 07:23:31'),(2,2,'Grey',1500,'2023-09-30 00:00:00',0,0,'third-party-plus','2023-09-29 03:01:05','2023-09-29 03:01:05');
/*!40000 ALTER TABLE `item_features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stock_id` bigint unsigned NOT NULL,
  `location_id` bigint unsigned NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` bigint NOT NULL DEFAULT '0',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `inStock` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('serviceable','returned','allocated','end-of-life','available','boarded','faulty') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `items_barcode_unique` (`barcode`),
  KEY `items_stock_id_foreign` (`stock_id`),
  KEY `items_location_id_foreign` (`location_id`),
  CONSTRAINT `items_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `items_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,1,1,'657748839','Toyota Camry 2019',0,'Toyota',0,'available','2023-09-13 07:23:31','2023-09-13 07:39:29'),(2,1,1,'RF563782','Toyota Camry 2023',303,'Some description here',1,'available','2023-09-29 03:01:05','2023-10-31 01:34:51'),(3,2,1,'RD5353','PRD5462711-001',0,'DESCRIPTION',0,'available','2023-09-29 08:10:31','2023-09-29 09:00:01');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itineraries`
--

DROP TABLE IF EXISTS `itineraries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `itineraries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `vehicle_request_id` bigint unsigned NOT NULL,
  `item_id` bigint unsigned NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `remark` longtext COLLATE utf8mb4_unicode_ci,
  `chosen` tinyint(1) NOT NULL DEFAULT '0',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `status` enum('pending','accepted','declined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `itineraries_user_id_foreign` (`user_id`),
  KEY `itineraries_vehicle_request_id_foreign` (`vehicle_request_id`),
  KEY `itineraries_item_id_foreign` (`item_id`),
  CONSTRAINT `itineraries_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `itineraries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `itineraries_vehicle_request_id_foreign` FOREIGN KEY (`vehicle_request_id`) REFERENCES `vehicle_requests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itineraries`
--

LOCK TABLES `itineraries` WRITE;
/*!40000 ALTER TABLE `itineraries` DISABLE KEYS */;
/*!40000 ALTER TABLE `itineraries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasFloors` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `locations_label_unique` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locations`
--

LOCK TABLES `locations` WRITE;
/*!40000 ALTER TABLE `locations` DISABLE KEYS */;
INSERT INTO `locations` VALUES (1,'Yenagoa, Bayelsa','yenagoa-bayelsa',1,'2023-09-12 10:33:09','2023-09-12 10:33:09');
/*!40000 ALTER TABLE `locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logistics_requests`
--

DROP TABLE IF EXISTS `logistics_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logistics_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` decimal(30,2) NOT NULL DEFAULT '0.00',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','registered','approved','denied','processing','confirmed','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `logistics_requests_code_unique` (`code`),
  KEY `logistics_requests_user_id_foreign` (`user_id`),
  CONSTRAINT `logistics_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logistics_requests`
--

LOCK TABLES `logistics_requests` WRITE;
/*!40000 ALTER TABLE `logistics_requests` DISABLE KEYS */;
INSERT INTO `logistics_requests` VALUES (10,1,'REV61059','R30001263',0.00,'Python Training in Dubai','confirmed',0,'2023-10-02 23:49:16','2023-10-12 01:32:06'),(12,1,'REV15267','R4003001',0.00,'TRAINING IN DUBAI FOR C#','confirmed',0,'2023-10-03 11:33:36','2023-10-12 01:16:15'),(13,1,'REV94391','ye647473',0.00,'Trip to Huuwai','confirmed',0,'2023-10-12 01:34:23','2023-10-12 01:38:51'),(14,8,'REV21653','R40321345',0.00,'Training Flight to London','processing',0,'2023-10-31 12:46:52','2023-10-31 12:56:01'),(15,8,'REV53689','R1003014D',0.00,'FLD Retreat in the United Kingdom','confirmed',0,'2023-11-01 12:47:57','2023-11-01 13:05:29');
/*!40000 ALTER TABLE `logistics_requests` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (79,'2014_10_12_000000_create_users_table',1),(80,'2014_10_12_100000_create_password_reset_tokens_table',1),(81,'2014_10_12_100000_create_password_resets_table',1),(82,'2019_08_19_000000_create_failed_jobs_table',1),(83,'2019_12_14_000001_create_personal_access_tokens_table',1),(84,'2023_06_09_145749_create_department_types_table',1),(85,'2023_06_09_145906_create_departments_table',1),(86,'2023_06_09_150423_create_staff_types_table',1),(87,'2023_06_09_150516_create_availabilities_table',1),(88,'2023_06_09_150547_create_locations_table',1),(89,'2023_06_09_150635_create_companies_table',1),(90,'2023_06_09_151040_create_grade_levels_table',1),(91,'2023_06_09_151144_add_columns_to_users_table',1),(92,'2023_06_10_120107_create_groups_table',1),(93,'2023_06_10_120730_create_applications_table',1),(94,'2023_06_10_140826_create_modules_table',1),(95,'2023_06_10_141147_create_gorupables_table',1),(96,'2023_06_10_142632_create_access_controls_table',1),(97,'2023_06_10_143233_create_permissions_table',1),(98,'2023_06_10_143932_create_access_control_permission_table',1),(99,'2023_06_10_150050_create_floors_table',1),(100,'2023_06_10_150439_create_floorables_table',1),(101,'2023_06_10_171653_create_incident_categories_table',1),(102,'2023_06_10_172547_create_issues_table',1),(103,'2023_06_10_172916_create_tickets_table',1),(104,'2023_06_11_033200_create_tasks_table',1),(105,'2023_06_11_033922_create_task_user_table',1),(106,'2023_06_11_034438_create_company_task_table',1),(107,'2023_06_11_040316_create_hall_categories_table',1),(108,'2023_06_11_040411_create_wings_table',1),(109,'2023_06_11_040541_create_rooms_table',1),(110,'2023_06_11_041758_create_seatings_table',1),(111,'2023_06_11_041934_create_bookings_table',1),(112,'2023_06_11_042604_create_booking_details_table',1),(113,'2023_06_11_051659_create_logistics_requests_table',1),(114,'2023_06_11_052214_create_reservations_table',1),(115,'2023_06_11_053139_create_consonances_table',1),(116,'2023_06_11_054549_create_uploads_table',1),(117,'2023_06_11_060818_create_brands_table',1),(118,'2023_06_11_082508_create_inventory_categories_table',1),(119,'2023_06_11_082716_create_stock_categories_table',1),(120,'2023_06_11_082946_create_stock_types_table',1),(121,'2023_06_11_083214_create_department_inventory_category_table',1),(122,'2023_06_11_083516_create_stocks_table',1),(123,'2023_06_11_085904_create_items_table',1),(124,'2023_06_11_091008_create_item_features_table',1),(125,'2023_06_11_091514_create_tags_table',1),(126,'2023_06_11_091558_create_tagables_table',1),(127,'2023_06_11_162934_create_vehicle_requests_table',1),(128,'2023_06_11_163756_create_itineraries_table',1),(129,'2023_06_12_234918_create_repair_categories_table',1),(130,'2023_06_12_235017_create_repairs_table',1),(131,'2023_06_12_235600_create_complaints_table',1),(132,'2023_06_13_000130_create_vehicle_repairs_table',1),(133,'2023_06_13_004126_create_furniture_requests_table',1),(134,'2023_06_13_004442_create_furniture_request_items_table',1),(135,'2023_06_15_075203_create_quotas_table',1),(136,'2023_06_15_075442_create_quota_items_table',1),(137,'2023_06_15_080927_create_requisitions_table',1),(138,'2023_06_15_083938_create_requisition_items_table',1),(139,'2023_06_15_084611_create_quota_distributions_table',1),(140,'2023_06_15_160538_create_processes_table',1),(141,'2023_06_15_160642_create_documents_table',1),(142,'2023_06_15_161020_create_drafts_table',1),(143,'2023_06_15_161329_create_trackings_table',1),(144,'2023_06_15_161724_create_approvals_table',1),(145,'2023_06_19_091058_create_settings_table',1),(146,'2023_06_26_141029_add_request_code_column_to_tickets_table',1),(147,'2023_06_28_063047_create_todos_table',1),(148,'2023_07_02_213643_create_restocks_table',1),(149,'2023_08_14_150627_add_description_column_to_items_table',1),(150,'2023_08_18_101357_add_columns_to_requisition_items_table',1),(151,'2023_08_20_151812_add_department_id_to_requisitions_table',1),(152,'2023_08_21_093031_add_column_to_tasks_table',1),(153,'2023_08_28_094714_create_remarks_table',1),(154,'2023_09_03_192847_add_description_column_to_requisition_items_table',1),(155,'2023_09_04_084041_add_description_column_to_requisitions_table',1),(156,'2023_09_13_005835_add_other_columns_to_reservations_table',2),(157,'2023_09_13_030232_add_title_column_to_bookings_table',3),(158,'2023_10_03_003844_add_instructions_column_to_reservations_table',4),(159,'2023_10_10_034528_add_path_column_to_consonance_table',5),(160,'2023_10_11_105145_add_stage_column_to_reservations_table',6),(161,'2023_10_17_061415_add_remark_column_to_booking_table',7),(162,'2023_10_18_082457_create_departmentables_tables',8),(163,'2023_10_19_043054_add_category_column_to_tickets_table',9),(170,'2023_10_29_193044_create_purchase_invoices_table',10),(171,'2023_10_29_193931_create_invoice_items_table',10),(172,'2023_11_16_083108_create_helpdesk_types_table',11),(173,'2023_11_19_114721_add_owner_id_to_tickets_table',12),(177,'2023_11_19_143524_add_priority_column_to_tickets_table',13);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isMenu` tinyint(1) NOT NULL DEFAULT '0',
  `notActive` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `modules_code_unique` (`code`),
  UNIQUE KEY `modules_path_unique` (`path`),
  KEY `modules_application_id_foreign` (`application_id`),
  CONSTRAINT `modules_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modules`
--

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` VALUES (1,1,'Modules','MODS','/administration/modules','widgets','Administrator Modules Children',0,0,'2023-09-12 10:33:09','2023-09-12 10:33:09'),(2,1,'Imports','IMPT','/administration/imports','publish','Administrator Import Children',0,0,'2023-09-12 10:33:09','2023-09-12 10:33:09'),(3,6,'Wings','WNGS','/inventory/wings','air','Wings',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(4,6,'Hall Categories','HACT','/inventory/hall/categories','kitchen','Hall Categories',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(5,6,'Rooms','RMSS','/inventory/rooms','living','Rooms',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(6,6,'Seating Arrangements','SEAT','/inventory/seatings','chair','Seatings',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(8,6,'Requisitions','RQSM','/inventory/treat/requisitions','timelapse','Handle Requisitions',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(9,6,'Approve Requisitions','APRQ','/requests/approve/requisitions','fact_check','Approve Requisitions',0,0,'2023-09-12 10:40:23','2023-10-31 12:28:05'),(10,9,'My Tasks','MTSK','/tasks/my/tasks','task_alt','Tasks Module',0,0,'2023-09-12 10:40:23','2023-10-24 06:47:05'),(11,3,'My Requisitions','MKRE','/requests/requisitions','shopping_cart','Requisition Centre',0,0,'2023-09-12 10:40:23','2023-10-01 06:11:16'),(12,6,'Stock Items','STIT','/inventory/stock/items','shopping_bag','Stock items section',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(13,6,'Stock','STCK','/inventory/stock','storefront','Stock section',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(19,1,'Vendors','VEND','/administration/vendors','apartment','Vendors Management section',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(20,1,'Settings','STTS','/administration/settings','settings','Settings Section',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(21,1,'Grade Levels','GRDL','/administration/grade-levels','school','Grade Levels Section',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(22,1,'Availabilities','AVI','/administration/availabilities','badge','Available Section',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(23,1,'Departments','DPMT','/administration/departments','computer','Departments description',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(24,1,'Department Types','DTY','/administration/department-types','chat','DEPTTTT',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(25,1,'Staff Types','STY','/administration/staff-types','badge','Staff Types desc',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(26,1,'Floors','FLR','/administration/floors','apartment','Floors Section',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(27,3,'Support Tickets','TCKS','/requests/tickets','support','Tickets section here',0,0,'2023-09-12 10:40:23','2023-10-24 06:54:40'),(28,6,'Requisitions Requests','RQS','/inventory/requisitions','view_kanban','Requisitions side',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(29,1,'Staff','STF','/administration/staff','people','STaff Section here',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(30,1,'Locations','LOCS','/administration/locations','location_on','Locations description here',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(31,1,'Groups','GRPS','/administration/groups','groups','Groups description here',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(32,1,'Applications','APPS','/administration/applications','apps','Applications description here',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(33,1,'Configuration','CONF','/administration/configuration','engineering','inventory management system',0,0,'2023-09-12 10:40:23','2023-09-12 10:40:23'),(34,9,'Assign Tasks','ASTK','/tasks/assign/task','badge','Assign Tasks',0,0,'2023-09-23 05:49:25','2023-10-24 06:45:28'),(35,2,'Flights','FLGT','/logistics/flight/reservations','flight','Some flights',0,0,'2023-09-29 05:53:04','2023-10-24 06:59:50'),(36,2,'Hotels','HTLS','/logistics/hotel/bookings','luggage','Some hotels',0,0,'2023-09-29 05:54:06','2023-10-24 07:01:05'),(37,3,'Booking Requests','MKAB','/requests/make/booking','memory','Bookings Module',0,0,'2023-10-01 06:50:09','2023-10-12 01:29:09'),(38,2,'Reservation Requests','RSVN','/logistics/reservations','bookmark','Reservations Section',0,0,'2023-10-03 00:04:43','2023-10-11 11:51:38'),(39,3,'Meeting Rooms','MERM','/requests/meeting/rooms','meeting_room','Enter description',0,0,'2023-10-12 01:41:46','2023-10-12 01:41:46'),(40,3,'Furniture','FURT','/requests/furnitures','chair','Sentt',0,0,'2023-10-12 01:42:39','2023-11-19 14:13:16'),(41,3,'Vehicles','VEHI','/requests/vehicles','airport_shuttle','Enter here',0,0,'2023-10-12 01:43:22','2023-10-12 01:43:22'),(42,7,'Schedule Meeting','SME','/operations/schedule/meeting','event','Some description here',0,0,'2023-10-17 04:39:30','2023-10-17 04:39:30'),(43,3,'Report Incident','INSC','/requests/incidents','flag','Incidents',0,0,'2023-10-19 03:23:45','2023-11-08 11:34:30'),(44,5,'Complaints','CMPS','/helpdesk/complaints','help','Complaints Section',0,0,'2023-10-19 07:45:16','2023-10-24 08:56:32'),(45,5,'Incident Categories','INCG','/helpdesk/incident-categories','layers','Description Here',0,0,'2023-10-19 08:42:40','2023-10-24 08:55:19'),(46,5,'Incident Issues','INIS','/helpdesk/issues','bug_report','Description here',0,0,'2023-10-19 11:37:48','2023-10-24 08:55:44'),(47,6,'Supplies','SUPP','/inventory/supplies','local_shipping','New Supplies',0,0,'2023-10-29 01:52:51','2023-10-29 21:41:12'),(48,6,'Stock Dependencies','STDE','/inventory/stock/dependencies','inventory_2','stock dependencies',0,0,'2023-10-29 07:51:53','2023-10-29 07:52:10'),(49,5,'Support Types','STYP','/helpdesk/support/types','help_center','Support Types Here',0,0,'2023-11-16 07:21:09','2023-11-16 07:21:27');
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_label_unique` (`label`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (102,'App\\Models\\User',9,'Auth token for 22375','53db7df6a9f1c349353976b095da96e91787a1ec1906236b5e49ae465c69703d','[\"*\"]','2023-11-21 08:14:38',NULL,'2023-11-21 07:56:58','2023-11-21 08:14:38');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `processes`
--

DROP TABLE IF EXISTS `processes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `processes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `processes`
--

LOCK TABLES `processes` WRITE;
/*!40000 ALTER TABLE `processes` DISABLE KEYS */;
/*!40000 ALTER TABLE `processes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchase_invoices`
--

DROP TABLE IF EXISTS `purchase_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchase_invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(30,2) NOT NULL DEFAULT '0.00',
  `delivery_date` datetime DEFAULT NULL,
  `status` enum('pending','partial','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `isPrinted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `purchase_invoices_code_unique` (`code`),
  KEY `purchase_invoices_user_id_foreign` (`user_id`),
  KEY `purchase_invoices_company_id_foreign` (`company_id`),
  CONSTRAINT `purchase_invoices_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `purchase_invoices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchase_invoices`
--

LOCK TABLES `purchase_invoices` WRITE;
/*!40000 ALTER TABLE `purchase_invoices` DISABLE KEYS */;
INSERT INTO `purchase_invoices` VALUES (3,1,2,'MRV60522',1280000.00,'2023-11-01 00:00:00','pending',0,'2023-10-31 01:34:51','2023-10-31 01:34:51');
/*!40000 ALTER TABLE `purchase_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quota_distributions`
--

DROP TABLE IF EXISTS `quota_distributions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quota_distributions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `quota_id` bigint unsigned NOT NULL,
  `requisition_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quota_distributions_user_id_foreign` (`user_id`),
  KEY `quota_distributions_quota_id_foreign` (`quota_id`),
  KEY `quota_distributions_requisition_id_foreign` (`requisition_id`),
  CONSTRAINT `quota_distributions_quota_id_foreign` FOREIGN KEY (`quota_id`) REFERENCES `quotas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quota_distributions_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quota_distributions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quota_distributions`
--

LOCK TABLES `quota_distributions` WRITE;
/*!40000 ALTER TABLE `quota_distributions` DISABLE KEYS */;
/*!40000 ALTER TABLE `quota_distributions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quota_items`
--

DROP TABLE IF EXISTS `quota_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quota_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `quota_id` bigint unsigned NOT NULL,
  `item_id` bigint unsigned NOT NULL,
  `quantity` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quota_items_quota_id_foreign` (`quota_id`),
  KEY `quota_items_item_id_foreign` (`item_id`),
  CONSTRAINT `quota_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quota_items_quota_id_foreign` FOREIGN KEY (`quota_id`) REFERENCES `quotas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quota_items`
--

LOCK TABLES `quota_items` WRITE;
/*!40000 ALTER TABLE `quota_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `quota_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotas`
--

DROP TABLE IF EXISTS `quotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quotas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `group_id` bigint unsigned NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` bigint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `quotas_group_id_foreign` (`group_id`),
  CONSTRAINT `quotas_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotas`
--

LOCK TABLES `quotas` WRITE;
/*!40000 ALTER TABLE `quotas` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `remarks`
--

DROP TABLE IF EXISTS `remarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `remarks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `remarkable_id` bigint unsigned NOT NULL,
  `remarkable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `remarks_user_id_foreign` (`user_id`),
  CONSTRAINT `remarks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `remarks`
--

LOCK TABLES `remarks` WRITE;
/*!40000 ALTER TABLE `remarks` DISABLE KEYS */;
/*!40000 ALTER TABLE `remarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_categories`
--

DROP TABLE IF EXISTS `repair_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `repair_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_categories`
--

LOCK TABLES `repair_categories` WRITE;
/*!40000 ALTER TABLE `repair_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `repair_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repairs`
--

DROP TABLE IF EXISTS `repairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `repairs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `repair_category_id` bigint unsigned NOT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `repairs_repair_category_id_foreign` (`repair_category_id`),
  CONSTRAINT `repairs_repair_category_id_foreign` FOREIGN KEY (`repair_category_id`) REFERENCES `repair_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repairs`
--

LOCK TABLES `repairs` WRITE;
/*!40000 ALTER TABLE `repairs` DISABLE KEYS */;
/*!40000 ALTER TABLE `repairs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requisition_items`
--

DROP TABLE IF EXISTS `requisition_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requisition_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `requisition_id` bigint unsigned NOT NULL,
  `item_id` bigint unsigned NOT NULL,
  `quantity_expected` bigint NOT NULL DEFAULT '0',
  `quantity_received` bigint NOT NULL DEFAULT '0',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `priority` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'low',
  `status` enum('pending','issued','unavailable') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `requisition_items_requisition_id_foreign` (`requisition_id`),
  KEY `requisition_items_item_id_foreign` (`item_id`),
  CONSTRAINT `requisition_items_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  CONSTRAINT `requisition_items_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `requisitions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisition_items`
--

LOCK TABLES `requisition_items` WRITE;
/*!40000 ALTER TABLE `requisition_items` DISABLE KEYS */;
INSERT INTO `requisition_items` VALUES (1,1,1,3,1,'Only one is left','high','issued','2023-09-13 07:27:10','2023-09-13 07:39:29'),(4,4,1,10,0,NULL,'medium','pending','2023-09-29 02:57:07','2023-09-29 02:57:07'),(5,5,2,2,2,'Completed','medium','issued','2023-09-29 03:01:58','2023-09-29 03:04:05'),(6,6,3,10,1,'Test','high','issued','2023-09-29 08:46:41','2023-09-29 09:00:01');
/*!40000 ALTER TABLE `requisition_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requisitions`
--

DROP TABLE IF EXISTS `requisitions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requisitions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `department_id` bigint NOT NULL DEFAULT '0',
  `location_id` bigint unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('quota','request') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'request',
  `request_type` enum('self','third-party') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'self',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','registered','in-review','in-progress','authorized','cancelled','approved','denied') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `requisitions_code_unique` (`code`),
  KEY `requisitions_user_id_foreign` (`user_id`),
  KEY `requisitions_location_id_foreign` (`location_id`),
  CONSTRAINT `requisitions_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `requisitions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisitions`
--

LOCK TABLES `requisitions` WRITE;
/*!40000 ALTER TABLE `requisitions` DISABLE KEYS */;
INSERT INTO `requisitions` VALUES (1,1,1,1,'RQ1694593486928','request','self',NULL,'approved',0,'2023-09-13 07:27:10','2023-09-13 07:39:41'),(4,1,1,1,'RQ1695959810184','request','self',NULL,'denied',0,'2023-09-29 02:57:07','2023-09-29 03:01:18'),(5,1,1,1,'RQ1695960096710','request','self',NULL,'approved',0,'2023-09-29 03:01:58','2023-09-29 03:04:14'),(6,1,1,1,'RQ1695980707944','request','self',NULL,'approved',0,'2023-09-29 08:46:41','2023-09-29 09:00:17');
/*!40000 ALTER TABLE `requisitions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `logistics_request_id` bigint unsigned NOT NULL,
  `user_id` bigint NOT NULL DEFAULT '0',
  `request_type` enum('staff','third-party') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff',
  `type` enum('hotel','flight') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'flight',
  `flight_type` enum('local','international') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'local',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `take_off` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `begin` datetime DEFAULT NULL,
  `elapse` datetime DEFAULT NULL,
  `duration` bigint NOT NULL DEFAULT '0',
  `instructions` longtext COLLATE utf8mb4_unicode_ci,
  `approval_memo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `visa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','confirmed','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `stage` enum('registered','review','selected','booked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'registered',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservations_logistics_request_id_foreign` (`logistics_request_id`),
  CONSTRAINT `reservations_logistics_request_id_foreign` FOREIGN KEY (`logistics_request_id`) REFERENCES `logistics_requests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (6,10,1,'staff','flight','international','Super Administrator',NULL,'Lagos','Dubai','2023-10-15 00:00:00','2023-10-29 00:00:00',0,'A description here',NULL,NULL,NULL,'pending','selected','2023-10-02 23:49:16','2023-10-12 01:30:32'),(7,12,1,'staff','hotel','international','Super Administrator',NULL,NULL,'Radisson Blu','2023-10-15 00:00:00','2023-10-16 00:00:00',0,'A room with top view',NULL,NULL,NULL,'pending','selected','2023-10-03 11:33:36','2023-10-12 01:29:24'),(8,12,1,'staff','flight','international','Super Administrator',NULL,'Abuja','United Kingdom','2023-10-22 00:00:00','2023-10-29 00:00:00',0,'Trip Itinerary',NULL,NULL,NULL,'pending','selected','2023-10-03 11:33:36','2023-10-12 00:21:38'),(9,12,1,'staff','flight','international','Super Administrator',NULL,'Lagos','Dubai','2023-10-15 00:00:00','2023-10-29 00:00:00',0,'Description here sha',NULL,NULL,NULL,'pending','selected','2023-10-03 11:33:36','2023-10-12 01:31:30'),(10,13,1,'staff','hotel','international','Super Administrator',NULL,NULL,'A hotel in Huwai','2023-10-30 00:00:00','2023-11-05 00:00:00',0,'Something here again',NULL,NULL,NULL,'pending','selected','2023-10-12 01:34:23','2023-10-12 01:37:38'),(11,13,1,'staff','flight','international','Super Administrator',NULL,'Lagos','United States','2023-10-30 00:00:00','2023-11-05 00:00:00',0,'Soemthing here',NULL,NULL,NULL,'pending','selected','2023-10-12 01:34:23','2023-10-12 01:37:57'),(12,14,8,'staff','hotel','international','Komi Oshin',NULL,NULL,'Lagos','2023-11-02 00:00:00','2023-11-03 00:00:00',0,'add details',NULL,NULL,NULL,'pending','review','2023-10-31 12:46:52','2023-10-31 12:55:58'),(13,14,8,'staff','flight','international','Komi Oshin',NULL,'Lagos Airport','London Heathrow','2023-11-03 00:00:00','2023-11-11 00:00:00',0,'give some extra instructions here','C:\\fakepath\\MRV.pdf','C:\\fakepath\\2023 BUDGET EXPENSES.xlsx','C:\\fakepath\\MRV.pdf','pending','review','2023-10-31 12:46:52','2023-10-31 12:55:31'),(14,15,8,'staff','hotel','international','Komi Oshin',NULL,NULL,'Hotel Names','2023-11-03 00:00:00','2023-11-04 00:00:00',0,'descriptions here',NULL,NULL,NULL,'pending','selected','2023-11-01 12:47:57','2023-11-01 13:04:35'),(15,15,8,'staff','flight','international','Komi Oshin',NULL,'Lagos','London','2023-11-04 00:00:00','2023-11-18 00:00:00',0,'The instructions can come here in the description','C:\\fakepath\\SP78639.pdf','C:\\fakepath\\Directorate Retreat Questionnaire.docx','C:\\fakepath\\217fc5cf-914e-4262-b197-9a772069a34b.JPG','pending','selected','2023-11-01 12:47:57','2023-11-01 13:04:24');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restocks`
--

DROP TABLE IF EXISTS `restocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `restocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `stock_id` bigint unsigned NOT NULL,
  `quantity` bigint NOT NULL DEFAULT '0',
  `amount` decimal(30,2) NOT NULL DEFAULT '0.00',
  `exhausted` tinyint(1) NOT NULL DEFAULT '0',
  `date_of_purchase` datetime DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `restocks_user_id_foreign` (`user_id`),
  KEY `restocks_company_id_foreign` (`company_id`),
  KEY `restocks_stock_id_foreign` (`stock_id`),
  CONSTRAINT `restocks_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `restocks_stock_id_foreign` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `restocks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restocks`
--

LOCK TABLES `restocks` WRITE;
/*!40000 ALTER TABLE `restocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `restocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `hall_category_id` bigint unsigned NOT NULL,
  `wing_id` bigint unsigned NOT NULL,
  `floor_id` bigint NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_sitting_capacity` bigint NOT NULL,
  `status` enum('available','occupied','under-maintenance','not-inuse') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rooms_hall_category_id_foreign` (`hall_category_id`),
  KEY `rooms_wing_id_foreign` (`wing_id`),
  CONSTRAINT `rooms_hall_category_id_foreign` FOREIGN KEY (`hall_category_id`) REFERENCES `hall_categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `rooms_wing_id_foreign` FOREIGN KEY (`wing_id`) REFERENCES `wings` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES (1,1,3,1,'Jasmine Hall (Main)',1000,'available','2023-09-12 10:44:17','2023-09-12 10:44:17'),(2,2,3,2,'Rose Room (Left)',100,'available','2023-09-12 10:45:32','2023-09-12 10:45:32'),(3,2,3,2,'Rose Room (Right)',100,'available','2023-09-12 10:45:53','2023-09-12 10:45:53');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seatings`
--

DROP TABLE IF EXISTS `seatings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `seatings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seatings`
--

LOCK TABLES `seatings` WRITE;
/*!40000 ALTER TABLE `seatings` DISABLE KEYS */;
INSERT INTO `seatings` VALUES (1,'Cinema','2023-09-12 10:40:55','2023-09-12 10:40:55'),(2,'Banquet','2023-09-12 10:41:02','2023-09-12 10:41:02'),(3,'Meeting','2023-09-12 10:41:09','2023-09-12 10:41:09');
/*!40000 ALTER TABLE `seatings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `details` longtext COLLATE utf8mb4_unicode_ci,
  `input` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'text',
  `group` enum('public','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `order` bigint NOT NULL DEFAULT '0',
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_types`
--

DROP TABLE IF EXISTS `staff_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staff_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staff_types_label_unique` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_types`
--

LOCK TABLES `staff_types` WRITE;
/*!40000 ALTER TABLE `staff_types` DISABLE KEYS */;
INSERT INTO `staff_types` VALUES (1,'Permanent','permanent','2023-09-12 10:33:09','2023-09-12 10:33:09'),(2,'Contract','contract','2023-10-19 15:04:35','2023-10-19 15:04:35'),(3,'Secondment','secondment','2023-10-19 15:04:43','2023-10-19 15:04:43'),(4,'Ad Hoc','ad-hoc','2023-10-19 15:04:59','2023-10-19 15:04:59'),(5,'Support','support','2023-10-19 15:05:05','2023-10-19 15:05:05'),(6,'Third Party','third-party','2023-10-19 15:05:16','2023-10-19 15:05:16');
/*!40000 ALTER TABLE `staff_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_categories`
--

DROP TABLE IF EXISTS `stock_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `inventory_category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_categories_inventory_category_id_foreign` (`inventory_category_id`),
  CONSTRAINT `stock_categories_inventory_category_id_foreign` FOREIGN KEY (`inventory_category_id`) REFERENCES `inventory_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_categories`
--

LOCK TABLES `stock_categories` WRITE;
/*!40000 ALTER TABLE `stock_categories` DISABLE KEYS */;
INSERT INTO `stock_categories` VALUES (1,2,'Vehicles',NULL,'2023-09-13 05:58:01','2023-09-13 05:58:01'),(2,3,'Hardwares',NULL,'2023-09-29 07:50:38','2023-09-29 07:50:38'),(3,4,'Furnitures',NULL,'2023-10-17 10:55:46','2023-10-17 10:55:46'),(4,3,'Testing Again',NULL,'2023-10-29 13:44:40','2023-10-29 13:45:15');
/*!40000 ALTER TABLE `stock_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_types`
--

DROP TABLE IF EXISTS `stock_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stock_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `stock_category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_types_stock_category_id_foreign` (`stock_category_id`),
  CONSTRAINT `stock_types_stock_category_id_foreign` FOREIGN KEY (`stock_category_id`) REFERENCES `stock_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_types`
--

LOCK TABLES `stock_types` WRITE;
/*!40000 ALTER TABLE `stock_types` DISABLE KEYS */;
INSERT INTO `stock_types` VALUES (1,1,'Bus',NULL,'2023-09-13 05:58:18','2023-09-13 05:58:18'),(2,1,'Cars',NULL,'2023-09-13 06:03:07','2023-09-13 06:03:07'),(3,2,'Laptops',NULL,'2023-09-29 07:50:55','2023-09-29 07:50:55'),(4,3,'Tables',NULL,'2023-10-17 10:56:02','2023-10-17 10:56:02'),(5,3,'Chars',NULL,'2023-10-17 10:56:12','2023-10-17 10:56:12'),(6,3,'Tester',NULL,'2023-10-29 14:02:39','2023-10-29 14:03:00');
/*!40000 ALTER TABLE `stock_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stocks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` bigint NOT NULL DEFAULT '0',
  `stock_type_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` bigint NOT NULL DEFAULT '0',
  `measure` enum('single','packs','boxes','cartons') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'single',
  `inStock` tinyint(1) NOT NULL DEFAULT '0',
  `restockable` tinyint(1) NOT NULL DEFAULT '0',
  `request_on_delivery` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stocks_label_unique` (`label`),
  UNIQUE KEY `stocks_code_unique` (`code`),
  KEY `stocks_stock_type_id_foreign` (`stock_type_id`),
  KEY `stocks_department_id_foreign` (`department_id`),
  CONSTRAINT `stocks_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stocks_stock_type_id_foreign` FOREIGN KEY (`stock_type_id`) REFERENCES `stock_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocks`
--

LOCK TABLES `stocks` WRITE;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` VALUES (1,1,2,4,'ED344522','Toyota Camry','toyota-camry',10,'single',1,1,1,'2023-09-13 06:43:09','2023-09-13 06:43:09'),(2,2,3,3,'FDG6477','HP Specter','hp-specter',55,'single',1,1,1,'2023-09-29 08:04:36','2023-09-29 08:04:36');
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tagables`
--

DROP TABLE IF EXISTS `tagables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tagables` (
  `tag_id` bigint unsigned NOT NULL,
  `tagable_id` bigint unsigned NOT NULL,
  `tagable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tagables`
--

LOCK TABLES `tagables` WRITE;
/*!40000 ALTER TABLE `tagables` DISABLE KEYS */;
INSERT INTO `tagables` VALUES (1,1,'App\\Models\\Stock'),(2,2,'App\\Models\\Stock');
/*!40000 ALTER TABLE `tagables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'Automobile','2023-09-13 06:04:20','2023-09-13 06:04:20'),(2,'Worktools','2023-09-29 07:55:39','2023-09-29 07:55:39'),(3,'Trials Again','2023-10-29 14:13:42','2023-10-29 14:14:17');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_user`
--

DROP TABLE IF EXISTS `task_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `task_user` (
  `task_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  KEY `task_user_task_id_foreign` (`task_id`),
  KEY `task_user_user_id_foreign` (`user_id`),
  CONSTRAINT `task_user_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `task_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_user`
--

LOCK TABLES `task_user` WRITE;
/*!40000 ALTER TABLE `task_user` DISABLE KEYS */;
INSERT INTO `task_user` VALUES (1,1),(5,1),(6,1),(7,1),(8,1),(10,1),(11,1),(12,1),(13,1),(15,3),(16,7),(17,4),(18,3),(20,4),(20,5),(21,10),(22,9);
/*!40000 ALTER TABLE `task_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned NOT NULL,
  `activity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `taskable_id` bigint unsigned NOT NULL,
  `taskable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('staff','third-party') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'staff',
  `status` enum('pending','ongoing','escalated','completed','overdue','uncompleted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tasks_department_id_foreign` (`department_id`),
  CONSTRAINT `tasks_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (1,1,'requisition','Please treat this',1,'App\\Models\\Requisition','staff','completed','2023-09-13 07:33:40','2023-09-13 07:39:45'),(5,4,'requisition','Please handle this',4,'App\\Models\\Requisition','staff','completed','2023-09-29 02:57:27','2023-09-29 03:01:18'),(6,4,'requisition','This is very crucial, handle asap',5,'App\\Models\\Requisition','staff','completed','2023-09-29 03:02:09','2023-09-29 03:04:26'),(7,4,'requisition','Instructions on how to achieve this',6,'App\\Models\\Requisition','staff','completed','2023-09-29 08:47:38','2023-09-29 09:00:22'),(8,4,'logistics','Attend to this request',10,'App\\Models\\LogisticsRequest','staff','completed','2023-10-02 23:49:16','2023-10-12 01:32:06'),(10,4,'logistics','Please handle as urgent',12,'App\\Models\\LogisticsRequest','staff','ongoing','2023-10-03 11:33:36','2023-10-03 11:35:10'),(11,4,'logistics','Please handle this',13,'App\\Models\\LogisticsRequest','staff','completed','2023-10-12 01:34:23','2023-10-12 01:38:51'),(12,4,'meetings','Some description here',3,'App\\Models\\Booking','staff','completed','2023-10-17 04:01:14','2023-10-17 05:33:43'),(13,4,'meetings','Handle this request',4,'App\\Models\\Booking','staff','completed','2023-10-17 08:47:28','2023-10-17 08:51:57'),(14,4,'incident','Handle request with code INC41581',2,'App\\Models\\Ticket','staff','pending','2023-10-24 06:32:28','2023-10-24 06:32:28'),(15,4,'logistics','Please handle This request',14,'App\\Models\\LogisticsRequest','staff','ongoing','2023-10-31 12:46:52','2023-10-31 12:53:59'),(16,4,'incident','This is a security report, please make sure you handle this',3,'App\\Models\\Ticket','staff','ongoing','2023-10-31 13:07:18','2023-10-31 13:16:48'),(17,4,'logistics','Please handle this request with immediate effect',15,'App\\Models\\LogisticsRequest','staff','completed','2023-11-01 12:47:57','2023-11-01 13:05:29'),(18,4,'incident','please handle this',4,'App\\Models\\Ticket','staff','ongoing','2023-11-01 13:18:39','2023-11-01 13:25:59'),(19,3,'incident','Handle request with code INC48377',5,'App\\Models\\Ticket','staff','pending','2023-11-19 14:00:11','2023-11-19 14:00:11'),(20,3,'support','Please handle this request asap',7,'App\\Models\\Ticket','staff','ongoing','2023-11-19 14:42:11','2023-11-19 20:31:37'),(21,8,'incident','Handle this request as soon as possible',8,'App\\Models\\Ticket','staff','completed','2023-11-20 22:00:07','2023-11-20 23:36:59'),(22,5,'incident','Please send a mail to all staff informing them of the current situation at the office.',9,'App\\Models\\Ticket','staff','completed','2023-11-21 07:43:11','2023-11-21 08:01:07');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `owner_id` bigint NOT NULL DEFAULT '0',
  `support_id` bigint NOT NULL DEFAULT '0',
  `issue_id` bigint unsigned NOT NULL,
  `location_id` bigint unsigned NOT NULL,
  `floor_id` bigint NOT NULL DEFAULT '0',
  `related_issue_id` bigint NOT NULL DEFAULT '0',
  `office_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `category` enum('incident','support','other') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'support',
  `additional_info` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','assigned','ongoing','resolved','unresolved','escalated') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `escalated` int NOT NULL DEFAULT '0',
  `priority` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'low',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tickets_code_unique` (`code`),
  KEY `tickets_user_id_foreign` (`user_id`),
  KEY `tickets_department_id_foreign` (`department_id`),
  KEY `tickets_issue_id_foreign` (`issue_id`),
  KEY `tickets_location_id_foreign` (`location_id`),
  CONSTRAINT `tickets_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tickets_issue_id_foreign` FOREIGN KEY (`issue_id`) REFERENCES `issues` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tickets_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (2,'INC41581',1,1,3,0,1,1,3,0,NULL,NULL,'Broken Glass at second floor room 1202','incident',NULL,'pending',0,'low',0,'2023-10-24 06:32:28','2023-10-24 06:32:28'),(3,'INC96445',6,3,3,0,3,1,1,0,NULL,NULL,'Someone passed in front of me and the security beeped, but the man did not call hm back to search him','incident',NULL,'pending',0,'low',0,'2023-10-31 13:07:18','2023-10-31 13:07:18'),(4,'INC18295',8,7,3,0,4,1,2,0,NULL,NULL,'Kumi just slumped at the first floor by the toilet','incident',NULL,'pending',0,'low',0,'2023-11-01 13:18:39','2023-11-01 13:18:39'),(5,'INC48377',1,1,3,0,3,1,1,0,NULL,NULL,'Some description here','incident',NULL,'pending',0,'low',0,'2023-11-19 14:00:11','2023-11-19 14:00:11'),(7,'TKT87770',1,1,3,0,3,1,3,0,NULL,NULL,'Some description here again','support',NULL,'escalated',1,'low',0,'2023-11-19 14:42:11','2023-11-20 21:11:20'),(8,'INC64624',5,3,8,10,2,1,2,0,'Close to the Car Park',NULL,'Wrongful Parking','incident',NULL,'resolved',0,'medium',0,'2023-11-20 22:00:07','2023-11-20 23:36:59'),(9,'INC94017',4,3,5,9,5,1,1,0,'NCDMB Tower',NULL,'They are currently protesting at the tower this morning','incident',NULL,'resolved',0,'high',0,'2023-11-21 07:43:11','2023-11-21 08:01:07');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `todos`
--

DROP TABLE IF EXISTS `todos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `todos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `task_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','completed','uncompleted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `todos_user_id_foreign` (`user_id`),
  KEY `todos_task_id_foreign` (`task_id`),
  CONSTRAINT `todos_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `todos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `todos`
--

LOCK TABLES `todos` WRITE;
/*!40000 ALTER TABLE `todos` DISABLE KEYS */;
INSERT INTO `todos` VALUES (1,4,20,'Security Check (Escalated!!)','I have tried everything i can but this is not working, please handle','completed','2023-11-20 21:11:20','2023-11-20 21:11:20'),(2,10,21,'Conference Hall Parking','I called the staff back to re-pack his car','completed','2023-11-20 22:46:33','2023-11-20 23:13:33'),(3,10,21,'Conference Hall Parking','He has already come to park his car now','completed','2023-11-20 22:56:28','2023-11-20 23:13:47'),(4,10,21,'Conference Hall Parking','Another try to check this stuff','completed','2023-11-20 23:23:03','2023-11-20 23:23:32'),(5,9,22,'Protest','Send mail to all staff on this issue','completed','2023-11-21 08:00:16','2023-11-21 08:01:00');
/*!40000 ALTER TABLE `todos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trackings`
--

DROP TABLE IF EXISTS `trackings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trackings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `trackable_id` bigint unsigned NOT NULL,
  `trackable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('pending','inflow','outflow') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `status` enum('pending','received','dispatched') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trackings_user_id_foreign` (`user_id`),
  KEY `trackings_department_id_foreign` (`department_id`),
  CONSTRAINT `trackings_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `trackings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trackings`
--

LOCK TABLES `trackings` WRITE;
/*!40000 ALTER TABLE `trackings` DISABLE KEYS */;
/*!40000 ALTER TABLE `trackings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uploads`
--

DROP TABLE IF EXISTS `uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uploads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('image','file','audio','video') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'image',
  `size` bigint NOT NULL DEFAULT '0',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ext` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploadable_id` bigint unsigned NOT NULL,
  `uploadable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uploads_path_unique` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uploads`
--

LOCK TABLES `uploads` WRITE;
/*!40000 ALTER TABLE `uploads` DISABLE KEYS */;
/*!40000 ALTER TABLE `uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `grade_level_id` bigint unsigned NOT NULL,
  `department_id` bigint unsigned NOT NULL,
  `staff_type_id` bigint unsigned NOT NULL,
  `availability_id` bigint unsigned NOT NULL,
  `location_id` bigint unsigned NOT NULL,
  `company_id` bigint unsigned NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_staff_no_unique` (`staff_no`),
  KEY `users_grade_level_id_foreign` (`grade_level_id`),
  KEY `users_department_id_foreign` (`department_id`),
  KEY `users_staff_type_id_foreign` (`staff_type_id`),
  KEY `users_availability_id_foreign` (`availability_id`),
  KEY `users_location_id_foreign` (`location_id`),
  KEY `users_company_id_foreign` (`company_id`),
  CONSTRAINT `users_availability_id_foreign` FOREIGN KEY (`availability_id`) REFERENCES `availabilities` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_grade_level_id_foreign` FOREIGN KEY (`grade_level_id`) REFERENCES `grade_levels` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_staff_type_id_foreign` FOREIGN KEY (`staff_type_id`) REFERENCES `staff_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,1,1,1,1,1,'Super',NULL,'Administrator','AD001','admin@admin.com',NULL,'$2y$10$khYoeoWrHYUMtgl8OsffGuhHtdm4q14htzP4HUHjFwmR5Zcz7m.mG',NULL,'2023-09-12 10:33:09','2023-09-12 10:33:09'),(2,2,3,1,1,1,1,'Olisaemeka','Fredrick','Isife','22414','olisaemeka.isife@ncdmb.gov.ng',NULL,'$2y$10$6Q6uKL7qN5RWgCZmxIIaau6e5J07JCIRjYz4zWO77HcDnQxyYItQm',NULL,'2023-10-19 15:22:03','2023-10-19 15:22:03'),(3,2,4,1,1,1,1,'Muhammad',NULL,'Sirajo','22390','muhammad.sirajo@ncdmb.gov.ng',NULL,'$2y$10$sl3D5YeHswXzld16Z1pbHeLhdoNGL6dOgKdVoyMxevaKcVNta3aue',NULL,'2023-10-19 15:23:57','2023-10-19 15:23:57'),(4,6,3,1,1,1,1,'Bobby','Tamunotonye','Ekaro','18290','bobby.ekaro@ncdmb.gov.ng',NULL,'$2y$10$hCoo.GE7IT7AaynwBM5tluBFR0g2UgkoXHLSimxFsCQga3CuUSVOm',NULL,'2023-10-19 15:24:59','2023-10-19 15:24:59'),(5,8,3,1,1,1,1,'Jerry','A','Atabong','10041','jerry.atabong@ncdmb.gov.ng',NULL,'$2y$10$aXe9Ku4gK2efqNQIS61AcufSkK2/650RbLyeVY6wy1XJDikuMi./K',NULL,'2023-10-19 15:37:44','2023-10-19 15:37:44'),(6,9,3,1,1,1,1,'Chris','Obinna','Osuji','10051','chris.osuji@ncdmb.gov.ng',NULL,'$2y$10$r6DGD.BpIrGZwP3gG9D4l.FzRauqQ18QXr48M0CQ.FwvIwsEDJlU2',NULL,'2023-10-19 15:38:31','2023-10-19 15:38:31'),(7,7,3,1,1,1,1,'Oluwafemi',NULL,'Ajayi','11175','oluwafemi.ajayi@ncdmb.gov.ng',NULL,'$2y$10$h0SdM/0ETg8aYfbl4.HhquOLzLaUnOOZam2D56n.wM8jaDDZ12vXa',NULL,'2023-10-31 12:04:02','2023-10-31 12:04:02'),(8,5,7,1,1,1,1,'Komi',NULL,'Oshin','13960','komi.oshin@ncdmb.gov.ng',NULL,'$2y$10$0hVCm1gleBmGm8HFrON0wevy9sCfc1nkyX7QbsQa3MVY2YfH731Lu',NULL,'2023-10-31 12:32:49','2023-10-31 12:32:49'),(9,6,5,1,1,1,1,'Olawale',NULL,'Osikoya','22375','olawale@ncdmb.gov.ng',NULL,'$2y$10$7/90cardynPCjQc7UGaQIuEU7Qh8ETzOM/sht3ICmXC7UHAusU.76',NULL,'2023-10-31 13:10:52','2023-10-31 13:10:52'),(10,6,8,1,1,1,1,'Oladele','O','Buki','11123','oladele.buki@ncdmb.gov.ng',NULL,'$2y$10$70voC73CGuq4elCnRFdb0eoI4t8aVSEsCuCqabXjBrDV4yqGRe.3u',NULL,'2023-11-20 22:04:03','2023-11-20 22:04:03'),(11,2,5,1,1,1,1,'Umar','Kagu','Abubakar','22374','umar.kagu@ncdmb.gov.ng',NULL,'$2y$10$gym.LNREVEGCB3nGet9auO71jVFC4alLMUxei5T5PtIrxEl0PHw1q',NULL,'2023-11-21 07:49:35','2023-11-21 07:49:35');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_repairs`
--

DROP TABLE IF EXISTS `vehicle_repairs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_repairs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `complaint_id` bigint unsigned NOT NULL,
  `repair_id` bigint unsigned NOT NULL,
  `cost` decimal(30,2) NOT NULL DEFAULT '0.00',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','sighted','not-sighted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `attested` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_repairs_complaint_id_foreign` (`complaint_id`),
  KEY `vehicle_repairs_repair_id_foreign` (`repair_id`),
  CONSTRAINT `vehicle_repairs_complaint_id_foreign` FOREIGN KEY (`complaint_id`) REFERENCES `complaints` (`id`) ON DELETE CASCADE,
  CONSTRAINT `vehicle_repairs_repair_id_foreign` FOREIGN KEY (`repair_id`) REFERENCES `repairs` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_repairs`
--

LOCK TABLES `vehicle_repairs` WRITE;
/*!40000 ALTER TABLE `vehicle_repairs` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle_repairs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_requests`
--

DROP TABLE IF EXISTS `vehicle_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `stock_type_id` bigint unsigned NOT NULL,
  `location_id` bigint unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required_date` datetime DEFAULT NULL,
  `return_date` datetime DEFAULT NULL,
  `duration` bigint NOT NULL DEFAULT '0',
  `destination` text COLLATE utf8mb4_unicode_ci,
  `budget_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` decimal(30,2) NOT NULL DEFAULT '0.00',
  `nature_of_trip` enum('personal','official') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'personal',
  `status` enum('pending','registered','approved','denied','processing','confirmed','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vehicle_requests_code_unique` (`code`),
  KEY `vehicle_requests_user_id_foreign` (`user_id`),
  KEY `vehicle_requests_stock_type_id_foreign` (`stock_type_id`),
  KEY `vehicle_requests_location_id_foreign` (`location_id`),
  CONSTRAINT `vehicle_requests_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `vehicle_requests_stock_type_id_foreign` FOREIGN KEY (`stock_type_id`) REFERENCES `stock_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `vehicle_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_requests`
--

LOCK TABLES `vehicle_requests` WRITE;
/*!40000 ALTER TABLE `vehicle_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicle_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wings`
--

DROP TABLE IF EXISTS `wings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wings`
--

LOCK TABLES `wings` WRITE;
/*!40000 ALTER TABLE `wings` DISABLE KEYS */;
INSERT INTO `wings` VALUES (1,'Wing A','2023-09-12 10:42:40','2023-09-12 10:42:40'),(2,'Wing B','2023-09-12 10:42:46','2023-09-12 10:42:46'),(3,'Space','2023-09-12 10:42:52','2023-09-12 10:42:52');
/*!40000 ALTER TABLE `wings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-21 10:17:10
