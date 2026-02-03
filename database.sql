-- MySQL dump 10.13  Distrib 8.4.4, for macos15 (arm64)
--
-- Host: 127.0.0.1    Database: jobcy
-- ------------------------------------------------------
-- Server version	8.4.4

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
-- Table structure for table `activations`
--

DROP TABLE IF EXISTS `activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `code` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT '0',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activations_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activations`
--

LOCK TABLES `activations` WRITE;
/*!40000 ALTER TABLE `activations` DISABLE KEYS */;
INSERT INTO `activations` VALUES (1,1,'xuhrcvh6EeHUPbDlKQrGB6nA8OCjcsN6',1,'2025-12-23 19:31:22','2025-12-23 19:31:22','2025-12-23 19:31:22');
/*!40000 ALTER TABLE `activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_notifications`
--

DROP TABLE IF EXISTS `admin_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_notifications`
--

LOCK TABLES `admin_notifications` WRITE;
/*!40000 ALTER TABLE `admin_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ads` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired_at` datetime DEFAULT NULL,
  `location` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clicked` bigint NOT NULL DEFAULT '0',
  `order` int DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `open_in_new_tab` tinyint(1) NOT NULL DEFAULT '1',
  `tablet_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ads_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_adsense_slot_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ads_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ads_translations`
--

DROP TABLE IF EXISTS `ads_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ads_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ads_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tablet_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`ads_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads_translations`
--

LOCK TABLES `ads_translations` WRITE;
/*!40000 ALTER TABLE `ads_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ads_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_histories`
--

DROP TABLE IF EXISTS `audit_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Botble\\ACL\\Models\\User',
  `module` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request` longtext COLLATE utf8mb4_unicode_ci,
  `action` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actor_id` bigint unsigned NOT NULL,
  `actor_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'Botble\\ACL\\Models\\User',
  `reference_id` bigint unsigned NOT NULL,
  `reference_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_histories_user_id_index` (`user_id`),
  KEY `audit_histories_module_index` (`module`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_histories`
--

LOCK TABLES `audit_histories` WRITE;
/*!40000 ALTER TABLE `audit_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `audit_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `icon` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_index` (`parent_id`),
  KEY `categories_status_index` (`status`),
  KEY `categories_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Design',0,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,0,1,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(2,'Lifestyle',0,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(3,'Travel Tips',2,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,0,0,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(4,'Healthy',0,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(5,'Travel Tips',4,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,0,0,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(6,'Hotel',0,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(7,'Nature',6,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,0,0,'2025-12-23 19:31:23','2025-12-23 19:31:23');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories_translations`
--

DROP TABLE IF EXISTS `categories_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`categories_id`),
  KEY `idx_categories_trans_categories_id` (`categories_id`),
  KEY `idx_categories_trans_category_lang` (`categories_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories_translations`
--

LOCK TABLES `categories_translations` WRITE;
/*!40000 ALTER TABLE `categories_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` bigint unsigned DEFAULT NULL,
  `country_id` bigint unsigned DEFAULT NULL,
  `record_id` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `zip_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cities_slug_unique` (`slug`),
  KEY `idx_cities_name` (`name`),
  KEY `idx_cities_state_status` (`state_id`,`status`),
  KEY `idx_cities_status` (`status`),
  KEY `idx_cities_state_id` (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'Paris','paris',1,1,NULL,0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL),(2,'London','london',2,2,NULL,0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL),(3,'New York','new-york',3,3,NULL,0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL),(4,'New York','new-york-1',4,4,NULL,0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL),(5,'Copenhagen','copenhagen',5,5,NULL,0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL),(6,'Berlin','berlin',6,6,NULL,0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cities_translations`
--

DROP TABLE IF EXISTS `cities_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cities_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cities_id` bigint unsigned NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`cities_id`),
  KEY `idx_cities_trans_city_lang` (`cities_id`,`lang_code`),
  KEY `idx_cities_trans_name` (`name`),
  KEY `idx_cities_trans_cities_id` (`cities_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities_translations`
--

LOCK TABLES `cities_translations` WRITE;
/*!40000 ALTER TABLE `cities_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `cities_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_custom_field_options`
--

DROP TABLE IF EXISTS `contact_custom_field_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_custom_field_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `custom_field_id` bigint unsigned NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '999',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_custom_field_options`
--

LOCK TABLES `contact_custom_field_options` WRITE;
/*!40000 ALTER TABLE `contact_custom_field_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_custom_field_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_custom_field_options_translations`
--

DROP TABLE IF EXISTS `contact_custom_field_options_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_custom_field_options_translations` (
  `contact_custom_field_options_id` bigint unsigned NOT NULL,
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`contact_custom_field_options_id`),
  KEY `idx_contact_cfo_trans_cfo_id` (`contact_custom_field_options_id`),
  KEY `idx_contact_cfo_trans_cfo_lang` (`contact_custom_field_options_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_custom_field_options_translations`
--

LOCK TABLES `contact_custom_field_options_translations` WRITE;
/*!40000 ALTER TABLE `contact_custom_field_options_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_custom_field_options_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_custom_fields`
--

DROP TABLE IF EXISTS `contact_custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_custom_fields` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `placeholder` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '999',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_custom_fields`
--

LOCK TABLES `contact_custom_fields` WRITE;
/*!40000 ALTER TABLE `contact_custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_custom_fields_translations`
--

DROP TABLE IF EXISTS `contact_custom_fields_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_custom_fields_translations` (
  `contact_custom_fields_id` bigint unsigned NOT NULL,
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placeholder` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`contact_custom_fields_id`),
  KEY `idx_contact_cf_trans_cf_id` (`contact_custom_fields_id`),
  KEY `idx_contact_cf_trans_cf_lang` (`contact_custom_fields_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_custom_fields_translations`
--

LOCK TABLES `contact_custom_fields_translations` WRITE;
/*!40000 ALTER TABLE `contact_custom_fields_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_custom_fields_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_replies`
--

DROP TABLE IF EXISTS `contact_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contact_replies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_replies`
--

LOCK TABLES `contact_replies` WRITE;
/*!40000 ALTER TABLE `contact_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_fields` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (1,'John Smith','john.smith@example.com','+1 (555) 123-4567','123 Main Street, New York, NY 10001','General Inquiry','Hello, I am interested in learning more about your services. Could you please provide me with additional information about pricing and availability? I would appreciate a prompt response. Thank you for your time.',NULL,'read','2025-12-23 19:31:23','2025-12-23 19:31:23'),(2,'Emily Johnson','emily.johnson@example.com','+1 (555) 234-5678','456 Oak Avenue, Los Angeles, CA 90001','Partnership Opportunity','I represent a company that would like to explore potential partnership opportunities with your organization. We believe there could be mutual benefits from collaboration. Please let me know if you would be interested in scheduling a call to discuss further.',NULL,'unread','2025-12-23 19:31:23','2025-12-23 19:31:23'),(3,'Michael Brown','michael.brown@example.com','+1 (555) 345-6789','789 Pine Road, Chicago, IL 60601','Technical Support','I am experiencing some technical difficulties with your platform. The login feature seems to be not working properly on mobile devices. Could you please assist me in resolving this issue? I have attached screenshots for reference.',NULL,'read','2025-12-23 19:31:23','2025-12-23 19:31:23'),(4,'Sarah Davis','sarah.davis@example.com','+1 (555) 456-7890','321 Elm Street, Houston, TX 77001','Feedback and Suggestions','I wanted to share some feedback about your website. Overall, I find it user-friendly, but I think the navigation could be improved. Additionally, it would be great if you could add more filtering options to the search feature.',NULL,'unread','2025-12-23 19:31:23','2025-12-23 19:31:23'),(5,'James Wilson','james.wilson@example.com','+1 (555) 567-8901','654 Maple Drive, Phoenix, AZ 85001','Service Request','I would like to request a custom service package for my business. We have specific requirements that may not be covered by your standard offerings. Could we schedule a meeting to discuss our needs in detail?',NULL,'read','2025-12-23 19:31:23','2025-12-23 19:31:23'),(6,'Jennifer Taylor','jennifer.taylor@example.com','+1 (555) 678-9012','987 Cedar Lane, Philadelphia, PA 19101','Account Assistance','I am having trouble accessing my account. I have tried resetting my password multiple times, but I am still unable to log in. Could you please help me regain access to my account? My username is jennifer_t.',NULL,'unread','2025-12-23 19:31:23','2025-12-23 19:31:23'),(7,'David Anderson','david.anderson@example.com','+1 (555) 789-0123','135 Birch Boulevard, San Antonio, TX 78201','Product Information','I am interested in your premium product line and would like to receive a detailed brochure or catalog. Could you also provide information about bulk order discounts? Thank you for your assistance.',NULL,'read','2025-12-23 19:31:23','2025-12-23 19:31:23'),(8,'Lisa Martinez','lisa.martinez@example.com','+1 (555) 890-1234','246 Walnut Street, San Diego, CA 92101','Event Sponsorship','Our organization is hosting a charity event next month and we are looking for sponsors. Would your company be interested in participating? This would be a great opportunity for brand visibility and community engagement.',NULL,'unread','2025-12-23 19:31:23','2025-12-23 19:31:23'),(9,'Robert Garcia','robert.garcia@example.com','+1 (555) 901-2345','357 Spruce Court, Dallas, TX 75201','Career Opportunities','I am interested in exploring career opportunities at your company. I have over 5 years of experience in the industry and believe I could be a valuable addition to your team. Please find my resume attached for your review.',NULL,'read','2025-12-23 19:31:23','2025-12-23 19:31:23'),(10,'Jessica Rodriguez','jessica.rodriguez@example.com','+1 (555) 012-3456','468 Ash Avenue, San Jose, CA 95101','Media Inquiry','I am a journalist working on a story about innovative companies in the tech industry. I would love to feature your company in my upcoming article. Could we arrange an interview with a company representative at your earliest convenience?',NULL,'unread','2025-12-23 19:31:23','2025-12-23 19:31:23');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_countries_name` (`name`),
  KEY `idx_countries_status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'France','French',0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25','FRA'),(2,'England','English',0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25','UK'),(3,'USA','Americans',0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25','US'),(4,'Holland','Dutch',0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25','HL'),(5,'Denmark','Danish',0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25','DN'),(6,'Germany','Danish',0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25','DN');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries_translations`
--

DROP TABLE IF EXISTS `countries_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `countries_id` bigint unsigned NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationality` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`countries_id`),
  KEY `idx_countries_trans_country_lang` (`countries_id`,`lang_code`),
  KEY `idx_countries_trans_name` (`name`),
  KEY `idx_countries_trans_countries_id` (`countries_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries_translations`
--

LOCK TABLES `countries_translations` WRITE;
/*!40000 ALTER TABLE `countries_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `countries_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard_widget_settings`
--

DROP TABLE IF EXISTS `dashboard_widget_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dashboard_widget_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `settings` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `widget_id` bigint unsigned NOT NULL,
  `order` tinyint unsigned NOT NULL DEFAULT '0',
  `status` tinyint unsigned NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dashboard_widget_settings_user_id_index` (`user_id`),
  KEY `dashboard_widget_settings_widget_id_index` (`widget_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_widget_settings`
--

LOCK TABLES `dashboard_widget_settings` WRITE;
/*!40000 ALTER TABLE `dashboard_widget_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboard_widget_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboard_widgets`
--

DROP TABLE IF EXISTS `dashboard_widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dashboard_widgets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard_widgets`
--

LOCK TABLES `dashboard_widgets` WRITE;
/*!40000 ALTER TABLE `dashboard_widgets` DISABLE KEYS */;
/*!40000 ALTER TABLE `dashboard_widgets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `device_tokens`
--

DROP TABLE IF EXISTS `device_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `device_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_version` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `device_tokens_token_unique` (`token`),
  KEY `device_tokens_user_type_user_id_index` (`user_type`,`user_id`),
  KEY `device_tokens_platform_is_active_index` (`platform`,`is_active`),
  KEY `device_tokens_is_active_index` (`is_active`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `device_tokens`
--

LOCK TABLES `device_tokens` WRITE;
/*!40000 ALTER TABLE `device_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `device_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `faq_categories`
--

DROP TABLE IF EXISTS `faq_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq_categories`
--

LOCK TABLES `faq_categories` WRITE;
/*!40000 ALTER TABLE `faq_categories` DISABLE KEYS */;
INSERT INTO `faq_categories` VALUES (1,'General',0,'published','2025-12-23 19:31:31','2025-12-23 19:31:31',NULL),(2,'Buying',1,'published','2025-12-23 19:31:31','2025-12-23 19:31:31',NULL),(3,'Payment',2,'published','2025-12-23 19:31:31','2025-12-23 19:31:31',NULL),(4,'Support',3,'published','2025-12-23 19:31:31','2025-12-23 19:31:31',NULL);
/*!40000 ALTER TABLE `faq_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faq_categories_translations`
--

DROP TABLE IF EXISTS `faq_categories_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faq_categories_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faq_categories_id` bigint unsigned NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`faq_categories_id`),
  KEY `idx_faq_cat_trans_faq_cat_id` (`faq_categories_id`),
  KEY `idx_faq_cat_trans_faq_cat_lang` (`faq_categories_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq_categories_translations`
--

LOCK TABLES `faq_categories_translations` WRITE;
/*!40000 ALTER TABLE `faq_categories_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq_categories_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'Where does it come from ?','If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages. The new common language will be more simple and regular than the existing European languages.',1,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(2,'How Jobcy Work ?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',1,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(3,'What is your shipping policy?','Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words.',1,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(4,'Where To Place A FAQ Page','Just as the name suggests, a FAQ page is all about simple questions and answers. Gather common questions your customers have asked from your support team and include them in the FAQ, Use categories to organize questions related to specific topics.',1,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(5,'Why do we use it ?','It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental.',1,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(6,'Where can I get some ?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',1,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(7,'Where does it come from ?','If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages. The new common language will be more simple and regular than the existing European languages.',2,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(8,'How Jobcy Work ?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',2,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(9,'What is your shipping policy?','Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words.',2,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(10,'Where To Place A FAQ Page','Just as the name suggests, a FAQ page is all about simple questions and answers. Gather common questions your customers have asked from your support team and include them in the FAQ, Use categories to organize questions related to specific topics.',2,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(11,'Why do we use it ?','It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental.',2,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(12,'Where can I get some ?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',2,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(13,'Where does it come from ?','If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages. The new common language will be more simple and regular than the existing European languages.',3,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(14,'How Jobcy Work ?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',3,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(15,'What is your shipping policy?','Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words.',3,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(16,'Where To Place A FAQ Page','Just as the name suggests, a FAQ page is all about simple questions and answers. Gather common questions your customers have asked from your support team and include them in the FAQ, Use categories to organize questions related to specific topics.',3,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(17,'Why do we use it ?','It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental.',3,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(18,'Where can I get some ?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',3,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(19,'Where does it come from ?','If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual languages. The new common language will be more simple and regular than the existing European languages.',4,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(20,'How Jobcy Work ?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',4,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(21,'What is your shipping policy?','Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar, pronunciation and more common words.',4,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(22,'Where To Place A FAQ Page','Just as the name suggests, a FAQ page is all about simple questions and answers. Gather common questions your customers have asked from your support team and include them in the FAQ, Use categories to organize questions related to specific topics.',4,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(23,'Why do we use it ?','It will be as simple as Occidental; in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental.',4,'published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(24,'Where can I get some ?','To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth.',4,'published','2025-12-23 19:31:31','2025-12-23 19:31:31');
/*!40000 ALTER TABLE `faqs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqs_translations`
--

DROP TABLE IF EXISTS `faqs_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `faqs_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `faqs_id` bigint unsigned NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci,
  `answer` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`faqs_id`),
  KEY `idx_faqs_trans_faqs_id` (`faqs_id`),
  KEY `idx_faqs_trans_faq_lang` (`faqs_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs_translations`
--

LOCK TABLES `faqs_translations` WRITE;
/*!40000 ALTER TABLE `faqs_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `faqs_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_account_activity_logs`
--

DROP TABLE IF EXISTS `jb_account_activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_account_activity_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `action` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `reference_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(39) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jb_account_activity_logs_account_id_index` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_account_activity_logs`
--

LOCK TABLES `jb_account_activity_logs` WRITE;
/*!40000 ALTER TABLE `jb_account_activity_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_account_activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_account_educations`
--

DROP TABLE IF EXISTS `jb_account_educations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_account_educations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `school` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_id` bigint unsigned NOT NULL,
  `specialized` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `started_at` date NOT NULL,
  `ended_at` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_account_educations`
--

LOCK TABLES `jb_account_educations` WRITE;
/*!40000 ALTER TABLE `jb_account_educations` DISABLE KEYS */;
INSERT INTO `jb_account_educations` VALUES (1,'Associated Mennonite Biblical Seminary',2,'Anthropology','2025-12-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:28','2025-12-23 19:31:28');
/*!40000 ALTER TABLE `jb_account_educations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_account_experiences`
--

DROP TABLE IF EXISTS `jb_account_experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_account_experiences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_id` bigint unsigned NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `started_at` date NOT NULL,
  `ended_at` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_account_experiences`
--

LOCK TABLES `jb_account_experiences` WRITE;
/*!40000 ALTER TABLE `jb_account_experiences` DISABLE KEYS */;
INSERT INTO `jb_account_experiences` VALUES (1,'Party Plex',2,'Marketing Coordinator','2025-12-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:28','2025-12-23 19:31:28');
/*!40000 ALTER TABLE `jb_account_experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_account_favorite_skills`
--

DROP TABLE IF EXISTS `jb_account_favorite_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_account_favorite_skills` (
  `skill_id` bigint unsigned NOT NULL,
  `account_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`skill_id`,`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_account_favorite_skills`
--

LOCK TABLES `jb_account_favorite_skills` WRITE;
/*!40000 ALTER TABLE `jb_account_favorite_skills` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_account_favorite_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_account_favorite_tags`
--

DROP TABLE IF EXISTS `jb_account_favorite_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_account_favorite_tags` (
  `tag_id` bigint unsigned NOT NULL,
  `account_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`tag_id`,`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_account_favorite_tags`
--

LOCK TABLES `jb_account_favorite_tags` WRITE;
/*!40000 ALTER TABLE `jb_account_favorite_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_account_favorite_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_account_languages`
--

DROP TABLE IF EXISTS `jb_account_languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_account_languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint unsigned NOT NULL,
  `language_level_id` bigint unsigned NOT NULL,
  `language` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_native` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_account_languages`
--

LOCK TABLES `jb_account_languages` WRITE;
/*!40000 ALTER TABLE `jb_account_languages` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_account_languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_account_packages`
--

DROP TABLE IF EXISTS `jb_account_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_account_packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint unsigned NOT NULL,
  `package_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jb_account_packages_account_id_index` (`account_id`),
  KEY `jb_account_packages_package_id_index` (`package_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_account_packages`
--

LOCK TABLES `jb_account_packages` WRITE;
/*!40000 ALTER TABLE `jb_account_packages` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_account_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_account_password_resets`
--

DROP TABLE IF EXISTS `jb_account_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_account_password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `jb_account_password_resets_email_index` (`email`),
  KEY `jb_account_password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_account_password_resets`
--

LOCK TABLES `jb_account_password_resets` WRITE;
/*!40000 ALTER TABLE `jb_account_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_account_password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_accounts`
--

DROP TABLE IF EXISTS `jb_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_accounts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar_id` bigint unsigned DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `email_verify_token` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'job-seeker',
  `credits` int unsigned DEFAULT NULL,
  `resume` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` mediumtext COLLATE utf8mb4_unicode_ci,
  `is_public_profile` tinyint unsigned NOT NULL DEFAULT '0',
  `hide_cv` tinyint(1) NOT NULL DEFAULT '0',
  `views` bigint unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `available_for_hiring` tinyint(1) NOT NULL DEFAULT '1',
  `country_id` bigint unsigned DEFAULT '1',
  `state_id` bigint unsigned DEFAULT NULL,
  `city_id` bigint unsigned DEFAULT NULL,
  `cover_letter` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jb_accounts_email_unique` (`email`),
  UNIQUE KEY `jb_accounts_unique_id_unique` (`unique_id`),
  KEY `jb_accounts_type_index` (`type`),
  KEY `jb_accounts_is_featured_index` (`is_featured`),
  KEY `jb_accounts_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_accounts`
--

LOCK TABLES `jb_accounts` WRITE;
/*!40000 ALTER TABLE `jb_accounts` DISABLE KEYS */;
INSERT INTO `jb_accounts` VALUES (1,NULL,'Abigail','Tromp','Software Developer',NULL,'employer@botble.com','$2y$12$XOA4SbSWjjIZh5R6GsQBS.WVcmEPVwqCv5Z8hmsLaozj1O09fFkqS',61,'1999-10-09','+18788339257','2025-12-24 02:31:28',NULL,'employer',NULL,NULL,'28011 Cletus Isle Suite 992\nO\'Haraberg, IA 06954','I shall have to beat them off, and had to ask any more HERE.\' \'But then,\' thought Alice, \'or perhaps they won\'t walk the way to change the subject. \'Ten hours the first to break the silence. \'What.',1,0,4717,0,NULL,'2025-06-12 00:32:37','2025-12-23 19:31:28',0,1,NULL,NULL,NULL),(2,NULL,'Annetta','Predovic','Creative Designer',NULL,'job_seeker@botble.com','$2y$12$dyvQ6ZlvIPAzDyu7QupRVOgHh/MOuSIHpGlCLBXI3T/nwR1bzCO.u',63,'1973-07-17','+13166224889','2025-12-24 02:31:28',NULL,'job-seeker',NULL,'themes/jobcy/resume/01.pdf','853 Harvey Forks\nEast Romaine, KY 16551','Alice doubtfully: \'it means--to--make--anything--prettier.\' \'Well, then,\' the Cat in a voice she had plenty of time as she could, for her to wink with one of the baby?\' said the Duchess; \'and the.',1,0,3889,0,NULL,'2025-11-14 03:54:38','2025-12-23 19:31:28',0,1,NULL,NULL,NULL),(3,NULL,'Sarah','Harding','Creative Designer',NULL,'sarah_harding@botble.com','$2y$12$8Mtl3X7RGB0i786Y1RYRPebEEhSf2b/gNOKGcsqpPpVal6ucFlCUe',NULL,'2012-01-23','+14078859452','2025-12-24 02:31:28',NULL,'employer',NULL,NULL,'958 Price Alley Apt. 463\nNorth Bradlyville, WV 12538-4165','He sent them word I had our Dinah here, I know all the creatures argue. It\'s enough to drive one crazy!\' The Footman seemed to be beheaded!\' \'What for?\' said the King; \'and don\'t be nervous, or I\'ll.',1,0,3070,1,NULL,'2025-09-21 13:03:43','2025-12-23 19:31:29',1,1,NULL,NULL,NULL),(4,NULL,'Steven','Jobs','Creative Designer',NULL,'steven_jobs@botble.com','$2y$12$08x5ovuPLEWP3MtE0gMfS.gZAOpsHskP4O78jsaalyVsd.gt12mAi',NULL,'1992-08-16','+16039179427','2025-12-24 02:31:28',NULL,'employer',NULL,NULL,'790 Norris Points Apt. 005\nGleasonfurt, WV 35328-0367','The Antipathies, I think--\' (she was rather doubtful whether she could not join the dance. So they sat down, and nobody spoke for some time without hearing anything more: at last in the house down!\'.',1,0,3615,1,NULL,'2025-04-24 09:10:22','2025-12-23 19:31:29',0,1,NULL,NULL,NULL),(5,NULL,'William','Kennedy','Creative Designer',NULL,'wiliam_kend@botble.com','$2y$12$JBszPtC/1rHNrKYLsMyu..1FUwIA3yzfw55J8w0rvJTo1yywTODuS',NULL,'2024-03-25','+16784577351','2025-12-24 02:31:28',NULL,'employer',NULL,NULL,'3237 Ned Dam Apt. 731\nPort Jaylon, TX 65436-5524','It was the Rabbit coming to look about her other little children, and make out at all fairly,\' Alice began, in a helpless sort of present!\' thought Alice. \'I\'ve read that in about half no time! Take.',1,0,1031,1,NULL,'2025-07-23 20:52:39','2025-12-23 19:31:29',0,1,NULL,NULL,NULL),(6,NULL,'Pink','Bruen','I to get through.',NULL,'micaela85@lang.com','$2y$12$.mVMuYS1wvFxE6JVjPORp.l6GPvKp.bdijGnNMeXlOWVz8v/gQByu',60,'2016-03-14','+14702718727','2025-12-24 02:31:28',NULL,'employer',NULL,NULL,'12565 Windler Centers Apt. 092\nPort Shannastad, RI 92050-1334','White Rabbit put on her hand, and Alice was too slippery; and when she had never been in a low voice, \'Your Majesty must cross-examine the next moment she quite forgot you didn\'t like cats.\' \'Not.',1,0,4668,0,NULL,'2025-02-08 18:27:59','2025-12-23 19:31:29',1,1,NULL,NULL,NULL),(7,NULL,'Alexis','O\'Kon','There was a bright.',NULL,'akeem.herman@gmail.com','$2y$12$9g49T42zblifUfM.hoHmgee/zyXkArjDXNfvQ9rH5K6wZTA7bjpH2',61,'2001-04-10','+15303251805','2025-12-24 02:31:28',NULL,'employer',NULL,NULL,'9910 Eldridge Plains Apt. 283\nEast Herminio, NY 96708-5329','Alice ventured to ask. \'Suppose we change the subject of conversation. While she was talking. Alice could hear him sighing as if she had never left off when they met in the way to hear it say, as it.',1,0,828,1,NULL,'2025-03-23 09:30:42','2025-12-23 19:31:30',0,1,NULL,NULL,NULL),(8,NULL,'Rosamond','Sawayn','A WATCH OUT OF ITS.',NULL,'abelardo75@gmail.com','$2y$12$vCpv/hE1GqjmcRgdpBfjK.pOekG8RNQFZcQ2SxifTfpS4nsnzN89u',59,'2022-04-28','+17816152459','2025-12-24 02:31:28',NULL,'employer',NULL,NULL,'669 McCullough Rapid Suite 519\nErnestinaport, KY 11883-2903','Shark, But, when the Rabbit noticed Alice, as the large birds complained that they were mine before. If I or she should chance to be trampled under its feet, ran round the table, but there were TWO.',1,0,1373,1,NULL,'2025-08-04 05:15:04','2025-12-23 19:31:30',1,1,NULL,NULL,NULL),(9,NULL,'Colin','Ondricka','EVER happen in a.',NULL,'zachary.howe@gmail.com','$2y$12$pFKj9rOAXWkJxN8YQ5IiV.El/.nme45UzwXxyXdzuR7VV.mMG99Eu',61,'1971-04-13','+18473187346','2025-12-24 02:31:28',NULL,'employer',NULL,NULL,'18049 Watsica Creek Suite 290\nNorth Jules, ID 51476-5661','Let me see: I\'ll give them a railway station.) However, she got used to call him Tortoise, if he had to fall upon Alice, as she was exactly one a-piece all round. \'But she must have a trial: For.',1,0,4913,0,NULL,'2025-11-22 05:48:37','2025-12-23 19:31:30',1,1,NULL,NULL,NULL),(10,NULL,'Jake','Jacobs','Where CAN I have.',NULL,'kenneth.simonis@hotmail.com','$2y$12$vBARkOr9R29oZ1cqQNEY3eTFWhWq4ee8shCmxpMaPkZlgVpQrzdqK',62,'1987-06-18','+13605596779','2025-12-24 02:31:28',NULL,'employer',NULL,NULL,'5167 Beier Spring Suite 022\nGibsonview, RI 32334-2796','Oh dear! I wish you could keep it to her ear, and whispered \'She\'s under sentence of execution. Then the Queen said--\' \'Get to your tea; it\'s getting late.\' So Alice got up this morning, but I don\'t.',1,0,1820,1,NULL,'2025-07-27 16:58:04','2025-12-23 19:31:31',1,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `jb_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_accounts_translations`
--

DROP TABLE IF EXISTS `jb_accounts_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_accounts_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_accounts_id` bigint unsigned NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_accounts_id`),
  KEY `idx_jb_accounts_trans_fk` (`jb_accounts_id`),
  KEY `idx_jb_accounts_trans_fk_lang` (`jb_accounts_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_accounts_translations`
--

LOCK TABLES `jb_accounts_translations` WRITE;
/*!40000 ALTER TABLE `jb_accounts_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_accounts_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_analytics`
--

DROP TABLE IF EXISTS `jb_analytics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_analytics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `job_id` bigint unsigned NOT NULL,
  `country` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_full` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referer` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jb_analytics_job_id_index` (`job_id`),
  KEY `jb_analytics_created_at_index` (`created_at`),
  KEY `jb_analytics_job_date_index` (`job_id`,`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_analytics`
--

LOCK TABLES `jb_analytics` WRITE;
/*!40000 ALTER TABLE `jb_analytics` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_analytics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_applications`
--

DROP TABLE IF EXISTS `jb_applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `job_id` bigint unsigned NOT NULL,
  `resume` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_letter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_id` bigint unsigned DEFAULT NULL,
  `is_external_apply` tinyint(1) NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jb_applications_job_id_index` (`job_id`),
  KEY `jb_applications_account_id_index` (`account_id`),
  KEY `jb_applications_status_index` (`status`),
  KEY `jb_applications_created_at_index` (`created_at`),
  KEY `jb_applications_job_status_index` (`job_id`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_applications`
--

LOCK TABLES `jb_applications` WRITE;
/*!40000 ALTER TABLE `jb_applications` DISABLE KEYS */;
INSERT INTO `jb_applications` VALUES (1,'Annetta','Predovic','+13166224889','job_seeker@botble.com','March Hare was said to the general conclusion, that wherever you go to on the bank, with her head!\' Alice glanced rather anxiously at the stick, running a very fine day!\' said a timid voice at her.',41,'themes/jobcy/resume/01.pdf','themes/jobcy/resume/01.pdf',2,1,'checked','2025-12-23 19:31:31','2025-12-23 19:31:31');
/*!40000 ALTER TABLE `jb_applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_career_levels`
--

DROP TABLE IF EXISTS `jb_career_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_career_levels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_career_levels`
--

LOCK TABLES `jb_career_levels` WRITE;
/*!40000 ALTER TABLE `jb_career_levels` DISABLE KEYS */;
INSERT INTO `jb_career_levels` VALUES (1,'Department Head',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(2,'Entry Level',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(3,'Experienced Professional',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(4,'GM / CEO / Country Head / President',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(5,'Intern/Student',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25');
/*!40000 ALTER TABLE `jb_career_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_career_levels_translations`
--

DROP TABLE IF EXISTS `jb_career_levels_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_career_levels_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_career_levels_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_career_levels_id`),
  KEY `idx_jb_career_lvl_trans_fk` (`jb_career_levels_id`),
  KEY `idx_jb_career_lvl_trans_fk_lang` (`jb_career_levels_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_career_levels_translations`
--

LOCK TABLES `jb_career_levels_translations` WRITE;
/*!40000 ALTER TABLE `jb_career_levels_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_career_levels_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_categories`
--

DROP TABLE IF EXISTS `jb_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `is_featured` tinyint NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `jb_categories_status_index` (`status`),
  KEY `jb_categories_is_featured_index` (`is_featured`),
  KEY `jb_categories_parent_id_index` (`parent_id`),
  KEY `jb_categories_order_index` (`order`),
  KEY `jb_categories_published_featured_index` (`status`,`is_featured`,`order`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_categories`
--

LOCK TABLES `jb_categories` WRITE;
/*!40000 ALTER TABLE `jb_categories` DISABLE KEYS */;
INSERT INTO `jb_categories` VALUES (1,'IT &amp; Software',NULL,0,0,1,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(2,'Technology',NULL,1,0,1,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(3,'Government',NULL,2,0,1,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(4,'Accounting / Finance',NULL,3,0,1,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(5,'Construction / Facilities',NULL,4,0,1,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(6,'Tele-communications',NULL,5,0,1,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(7,'Design &amp; Multimedia',NULL,6,0,1,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(8,'Human Resource',NULL,7,0,1,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(9,'Consumer Packaged Goods (CPG)',NULL,8,0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(10,'Manufacturing',NULL,9,0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(11,'Retail',NULL,10,0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(12,'Distribution/Logistics',NULL,11,0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(13,'Supply Chain Operations',NULL,12,0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(14,'Healthcare &amp; Medical',NULL,13,0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(15,'Procurement / Sourcing',NULL,14,0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(16,'Information Technology (IT)',NULL,15,0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(17,'Sales/Business Development',NULL,16,0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(18,'Legal &amp; Professional Services',NULL,17,0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0),(19,'Life Sciences &amp; Healthcare',NULL,18,0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26',0);
/*!40000 ALTER TABLE `jb_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_categories_translations`
--

DROP TABLE IF EXISTS `jb_categories_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_categories_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_categories_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_categories_id`),
  KEY `idx_jb_categories_trans_fk` (`jb_categories_id`),
  KEY `idx_jb_categories_trans_fk_lang` (`jb_categories_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_categories_translations`
--

LOCK TABLES `jb_categories_translations` WRITE;
/*!40000 ALTER TABLE `jb_categories_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_categories_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_companies`
--

DROP TABLE IF EXISTS `jb_companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_companies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8mb4_unicode_ci,
  `website` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint unsigned DEFAULT '1',
  `state_id` bigint unsigned DEFAULT NULL,
  `city_id` bigint unsigned DEFAULT NULL,
  `postal_code` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_founded` int unsigned DEFAULT NULL,
  `ceo` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_of_offices` int unsigned DEFAULT NULL,
  `number_of_employees` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annual_revenue` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint NOT NULL DEFAULT '0',
  `is_verified` tinyint(1) NOT NULL DEFAULT '0',
  `verified_at` timestamp NULL DEFAULT NULL,
  `verified_by` bigint unsigned DEFAULT NULL,
  `verification_note` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `views` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tax_id` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jb_companies_unique_id_unique` (`unique_id`),
  KEY `jb_companies_status_index` (`status`),
  KEY `jb_companies_is_featured_index` (`is_featured`),
  KEY `jb_companies_country_id_index` (`country_id`),
  KEY `jb_companies_state_id_index` (`state_id`),
  KEY `jb_companies_city_id_index` (`city_id`),
  KEY `jb_companies_created_at_index` (`created_at`),
  KEY `jb_companies_published_featured_index` (`status`,`is_featured`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_companies`
--

LOCK TABLES `jb_companies` WRITE;
/*!40000 ALTER TABLE `jb_companies` DISABLE KEYS */;
INSERT INTO `jb_companies` VALUES (1,NULL,'Pinterest',NULL,'Est aliquam nihil fugit delectus odit laboriosam. Officia soluta impedit rerum. Suscipit ea pariatur qui velit. Et dolore quam ea enim vel aut ut.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.pinterest.com','themes/jobcy/companies/1.png','43.295179','-75.220259','115 Cletus Views Apt. 949\nCarmeloside, TX 55325',5,5,5,NULL,'+19123944794',2000,NULL,8,'3','7M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-05-02 19:31:27',1,'Verified after background check','published',0,'2025-06-21 15:28:05','2025-12-23 19:31:27',NULL),(2,NULL,'Linkedin',NULL,'Facilis tempora voluptas consequatur libero. Autem ut architecto explicabo vel omnis sed.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.linkedin.com','themes/jobcy/companies/2.png','42.572429','-75.703021','64829 Arthur Fort Apt. 937\nNorth Landen, NH 67555',4,4,4,NULL,'+18044532383',1975,'Jeff Weiner',5,'4','2M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-07-27 19:31:27',1,'Company credentials confirmed','published',0,'2025-01-21 13:52:41','2025-12-23 19:31:27',NULL),(3,NULL,'Line',NULL,'Nesciunt eius ut est excepturi et ea voluptatem. Quia aut vitae rerum ratione error. Quia esse accusamus enim porro non minus cupiditate distinctio.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://line.me','themes/jobcy/companies/3.png','43.385712','-75.262497','53846 Kattie Valley\nKlockoton, KS 78045',4,4,4,NULL,'+18702120528',2017,'Nakamura',9,'1','5M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-08-22 06:45:31','2025-12-23 19:31:27',NULL),(4,NULL,'Uber',NULL,'Ipsa rerum cum asperiores et. Corrupti voluptas aut velit. Quae debitis repellat et facere. Aut molestias est dignissimos omnis qui non commodi ullam.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.uber.com','themes/jobcy/companies/4.png','43.230053','-75.680961','4878 Lillie Mount Suite 933\nPort Carolynton, CA 93931',5,5,5,NULL,'+18454724225',2016,'John Doe',6,'1','9M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-07-10 19:31:27',1,'Verified after background check','published',0,'2025-02-05 03:11:00','2025-12-23 19:31:27',NULL),(5,NULL,'Flutter',NULL,'Quis ut earum dignissimos. Impedit eligendi neque aperiam doloremque repudiandae recusandae ab et. Dolorem molestias vel repellat vel sed impedit provident.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://flutter.io','themes/jobcy/companies/5.png','43.926553','-76.014591','9345 Schmitt Trail\nPort Arvel, WV 45865',2,2,2,NULL,'+12235634839',1984,'John Doe',10,'6','10M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-08-08 09:37:14','2025-12-23 19:31:27',NULL),(6,NULL,'Behance',NULL,'Fugit magnam ipsa sunt ullam. Sed et ipsum qui at. Voluptate et est consequuntur qui eligendi animi ipsam. Qui ut quidem fuga iste. Dolor minus labore et impedit quis eaque.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.behance.net','themes/jobcy/companies/6.png','43.791032','-75.506064','80621 Barton Via\nMaytown, WI 54095-6927',1,1,1,NULL,'+14589131447',1974,'John Doe',10,'5','4M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-09-20 02:43:21','2025-12-23 19:31:27',NULL),(7,NULL,'Apple',NULL,'Ipsum maiores eaque enim dolorum. Sunt est dolorem nobis sit saepe aut debitis. Minima ut modi aspernatur et rerum et.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.apple.com','themes/jobcy/companies/7.png','42.607069','-76.313167','45040 Kathlyn Mills\nTrompmouth, SC 40771',5,5,5,NULL,'+19869424885',1980,'Steve Jobs',3,'8','7M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-08-01 19:31:27',1,NULL,'published',0,'2025-09-06 15:45:15','2025-12-23 19:31:27',NULL),(8,NULL,'Adobe',NULL,'Voluptatem placeat eligendi error. Doloremque ratione id omnis quos non neque accusamus. Aliquid eveniet quaerat rerum necessitatibus quis.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.adobe.com','themes/jobcy/companies/8.png','43.379825','-75.33031','990 Shaylee Radial Suite 554\nWest Maximochester, IN 92907',2,2,2,NULL,'+17073529513',2004,'John Doe',9,'10','3M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-12-04 19:31:27',1,'Verified after background check','published',0,'2025-08-22 19:19:29','2025-12-23 19:31:27',NULL),(9,NULL,'Vibe',NULL,'Est enim quae nihil tenetur. Dolorum voluptas odio et est iste sunt repudiandae provident. Voluptates consequuntur possimus eum sed aliquid et. Et aut quam quis architecto.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.vibe.com','themes/jobcy/companies/9.png','43.259398','-75.632707','580 Parker Plains Apt. 164\nNorth Billiestad, CA 92229',3,3,3,NULL,'+19255265979',2014,'John Doe',2,'3','4M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-07-12 17:45:47','2025-12-23 19:31:27',NULL),(10,NULL,'VKontakte',NULL,'Non voluptas veritatis laudantium non et voluptatum et. Repellendus inventore ut nobis non a ea. Molestiae qui et possimus unde corrupti aut consectetur. Quas pariatur deserunt temporibus vero.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://vk.com','themes/jobcy/companies/10.png','43.264572','-75.568509','31335 Medhurst Squares Apt. 699\nLake Sherwoodbury, MD 97541-0830',1,1,1,NULL,'+18127250110',2005,'Vasya Pupkin',5,'8','4M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-07-24 08:23:35','2025-12-23 19:31:27',NULL),(11,NULL,'WordPress',NULL,'Et quidem et praesentium ullam. Consequatur optio et sint voluptas et. Ea harum ut saepe molestiae quo corporis voluptas.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://wordpress.org','themes/jobcy/companies/11.png','42.604875','-76.134684','814 O\'Kon Knolls\nWest Norbert, NH 75114',3,3,3,NULL,'+16195239079',2007,'Matt Mullenweg',6,'1','8M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-07-11 19:31:27',1,'Verified after background check','published',0,'2025-05-18 08:19:08','2025-12-23 19:31:27',NULL),(12,NULL,'Envato',NULL,'Et vel labore ut voluptatem neque. Quasi facere accusantium tempore. Dolorem veritatis cumque qui aut veritatis omnis aliquam. Rerum quae ut aut quia.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://envato.com','themes/jobcy/companies/12.png','43.617819','-76.029647','7359 Braxton Meadows Apt. 438\nHalvorsonport, OH 18722-5828',6,6,6,NULL,'+12312852051',1998,NULL,5,'8','2M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-02-26 19:31:27',1,NULL,'published',0,'2025-11-20 09:37:23','2025-12-23 19:31:27',NULL),(13,NULL,'Magento',NULL,'Totam quod fuga quam deserunt beatae expedita. Ipsum sed necessitatibus illum corrupti neque ut nulla. Mollitia cumque officia debitis iure at sequi.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://magento.com','themes/jobcy/companies/13.png','43.637512','-76.64502','3358 Saige Fall\nPort Franciscomouth, TN 02500',6,6,6,NULL,'+16503204844',2021,NULL,10,'4','6M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-03-14 19:31:27',1,NULL,'published',0,'2025-08-25 09:10:15','2025-12-23 19:31:27',NULL),(14,NULL,'Generic',NULL,'Libero sunt unde sint voluptatem corrupti omnis excepturi. Autem sint et in modi et. Voluptates dolores maiores ullam atque molestias. Et sit ullam quam libero ut incidunt asperiores.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://generic.com','themes/jobcy/companies/14.png','43.872643','-75.490129','31611 Amelia Prairie\nRathport, AL 72271',2,2,2,NULL,'+17347584025',2013,NULL,1,'4','8M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-09-08 21:37:53','2025-12-23 19:31:27',NULL),(15,NULL,'Reveal',NULL,'Veritatis eligendi ipsam pariatur qui id impedit. Quos maiores sed amet accusamus. Omnis nostrum maxime non corporis voluptatem.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://reveal.com','themes/jobcy/companies/15.png','43.43472','-76.386177','3141 Odell Branch\nLake Celine, MA 35743',1,1,1,NULL,'+17576677889',1976,NULL,2,'6','2M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-08-29 20:35:24','2025-12-23 19:31:27',NULL),(16,NULL,'Woocommerce',NULL,'Molestias minima consequatur voluptatem et quas. Esse autem tenetur vel ea. Quis sit eligendi architecto et harum. Ut voluptas itaque aliquid eligendi aut ea.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://woocommerce.com','themes/jobcy/companies/16.png','42.950917','-74.984021','20749 Rath Valley\nWest Eugeniaport, AZ 57057-5266',2,2,2,NULL,'+18138091536',2014,NULL,2,'5','1M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-07-31 19:31:27',1,'Verified after background check','published',0,'2025-07-25 18:23:13','2025-12-23 19:31:27',NULL);
/*!40000 ALTER TABLE `jb_companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_companies_accounts`
--

DROP TABLE IF EXISTS `jb_companies_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_companies_accounts` (
  `company_id` bigint unsigned NOT NULL,
  `account_id` bigint unsigned NOT NULL,
  UNIQUE KEY `jb_companies_accounts_unique` (`company_id`,`account_id`),
  KEY `jb_companies_accounts_company_id_index` (`company_id`),
  KEY `jb_companies_accounts_account_id_index` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_companies_accounts`
--

LOCK TABLES `jb_companies_accounts` WRITE;
/*!40000 ALTER TABLE `jb_companies_accounts` DISABLE KEYS */;
INSERT INTO `jb_companies_accounts` VALUES (1,1),(1,4),(2,1),(2,4),(3,1),(3,4),(4,1),(4,4),(5,1),(5,4),(6,1),(6,4),(7,1),(7,4),(8,1),(8,4),(9,1),(9,4),(10,1),(10,4),(11,1),(11,4),(12,1),(12,4),(13,1),(13,4),(14,1),(14,4),(15,1),(15,4),(16,1),(16,4);
/*!40000 ALTER TABLE `jb_companies_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_companies_translations`
--

DROP TABLE IF EXISTS `jb_companies_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_companies_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_companies_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`jb_companies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_companies_translations`
--

LOCK TABLES `jb_companies_translations` WRITE;
/*!40000 ALTER TABLE `jb_companies_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_companies_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_coupons`
--

DROP TABLE IF EXISTS `jb_coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` decimal(8,2) NOT NULL,
  `quantity` int DEFAULT NULL,
  `total_used` int unsigned NOT NULL DEFAULT '0',
  `expires_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jb_coupons_code_unique` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_coupons`
--

LOCK TABLES `jb_coupons` WRITE;
/*!40000 ALTER TABLE `jb_coupons` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_currencies`
--

DROP TABLE IF EXISTS `jb_currencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_currencies` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `symbol` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_prefix_symbol` tinyint unsigned NOT NULL DEFAULT '0',
  `decimals` tinyint unsigned NOT NULL DEFAULT '0',
  `order` int unsigned NOT NULL DEFAULT '0',
  `is_default` tinyint NOT NULL DEFAULT '0',
  `exchange_rate` double NOT NULL DEFAULT '1',
  `number_format_style` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'western',
  `space_between_price_and_currency` tinyint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_currencies`
--

LOCK TABLES `jb_currencies` WRITE;
/*!40000 ALTER TABLE `jb_currencies` DISABLE KEYS */;
INSERT INTO `jb_currencies` VALUES (1,'USD','$',1,2,0,1,1,'western',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(2,'EUR','€',0,2,1,0,0.91,'western',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(3,'VND','₫',0,0,2,0,23717.5,'western',0,'2025-12-23 19:31:31','2025-12-23 19:31:31');
/*!40000 ALTER TABLE `jb_currencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_custom_field_options`
--

DROP TABLE IF EXISTS `jb_custom_field_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_custom_field_options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `custom_field_id` bigint unsigned NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '999',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_custom_field_options`
--

LOCK TABLES `jb_custom_field_options` WRITE;
/*!40000 ALTER TABLE `jb_custom_field_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_custom_field_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_custom_field_options_translations`
--

DROP TABLE IF EXISTS `jb_custom_field_options_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_custom_field_options_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_custom_field_options_id` bigint unsigned NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_custom_field_options_id`),
  KEY `idx_jb_cfo_trans_fk` (`jb_custom_field_options_id`),
  KEY `idx_jb_cfo_trans_fk_lang` (`jb_custom_field_options_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_custom_field_options_translations`
--

LOCK TABLES `jb_custom_field_options_translations` WRITE;
/*!40000 ALTER TABLE `jb_custom_field_options_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_custom_field_options_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_custom_field_values`
--

DROP TABLE IF EXISTS `jb_custom_field_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_custom_field_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `custom_field_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jb_custom_field_values_reference_type_reference_id_index` (`reference_type`,`reference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_custom_field_values`
--

LOCK TABLES `jb_custom_field_values` WRITE;
/*!40000 ALTER TABLE `jb_custom_field_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_custom_field_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_custom_field_values_translations`
--

DROP TABLE IF EXISTS `jb_custom_field_values_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_custom_field_values_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_custom_field_values_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_custom_field_values_id`),
  KEY `idx_jb_cfv_trans_fk` (`jb_custom_field_values_id`),
  KEY `idx_jb_cfv_trans_fk_lang` (`jb_custom_field_values_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_custom_field_values_translations`
--

LOCK TABLES `jb_custom_field_values_translations` WRITE;
/*!40000 ALTER TABLE `jb_custom_field_values_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_custom_field_values_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_custom_fields`
--

DROP TABLE IF EXISTS `jb_custom_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_custom_fields` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '999',
  `is_global` tinyint(1) NOT NULL DEFAULT '0',
  `authorable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authorable_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jb_custom_fields_authorable_type_authorable_id_index` (`authorable_type`,`authorable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_custom_fields`
--

LOCK TABLES `jb_custom_fields` WRITE;
/*!40000 ALTER TABLE `jb_custom_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_custom_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_custom_fields_translations`
--

DROP TABLE IF EXISTS `jb_custom_fields_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_custom_fields_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_custom_fields_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_custom_fields_id`),
  KEY `idx_jb_cf_trans_fk` (`jb_custom_fields_id`),
  KEY `idx_jb_cf_trans_fk_lang` (`jb_custom_fields_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_custom_fields_translations`
--

LOCK TABLES `jb_custom_fields_translations` WRITE;
/*!40000 ALTER TABLE `jb_custom_fields_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_custom_fields_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_degree_levels`
--

DROP TABLE IF EXISTS `jb_degree_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_degree_levels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_degree_levels`
--

LOCK TABLES `jb_degree_levels` WRITE;
/*!40000 ALTER TABLE `jb_degree_levels` DISABLE KEYS */;
INSERT INTO `jb_degree_levels` VALUES (1,'Non-Matriculation',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(2,'Matriculation/O-Level',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(3,'Intermediate/A-Level',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(4,'Bachelors',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(5,'Masters',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(6,'MPhil/MS',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(7,'PHD/Doctorate',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(8,'Certification',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(9,'Diploma',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(10,'Short Course',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25');
/*!40000 ALTER TABLE `jb_degree_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_degree_levels_translations`
--

DROP TABLE IF EXISTS `jb_degree_levels_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_degree_levels_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_degree_levels_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_degree_levels_id`),
  KEY `idx_jb_degree_lvl_trans_fk` (`jb_degree_levels_id`),
  KEY `idx_jb_degree_lvl_trans_fk_lang` (`jb_degree_levels_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_degree_levels_translations`
--

LOCK TABLES `jb_degree_levels_translations` WRITE;
/*!40000 ALTER TABLE `jb_degree_levels_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_degree_levels_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_degree_types`
--

DROP TABLE IF EXISTS `jb_degree_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_degree_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `degree_level_id` bigint unsigned NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_degree_types`
--

LOCK TABLES `jb_degree_types` WRITE;
/*!40000 ALTER TABLE `jb_degree_types` DISABLE KEYS */;
INSERT INTO `jb_degree_types` VALUES (1,'Matric in Arts',2,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(2,'Matric in Science',2,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(3,'O-Levels',2,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(4,'A-Levels',3,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(5,'Faculty of Arts',3,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(6,'Faculty of Science (Pre-medical)',3,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(7,'Faculty of Science (Pre-Engineering)',3,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(8,'Intermediate in Computer Science',3,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(9,'Intermediate in Commerce',3,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(10,'Intermediate in General Science',3,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(11,'Bachelors in Arts',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(12,'Bachelors in Architecture',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(13,'Bachelors in Business Administration',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(14,'Bachelors in Commerce',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(15,'Bachelors of Dental Surgery',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(16,'Bachelors of Education',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(17,'Bachelors in Engineering',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(18,'Bachelors in Pharmacy',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(19,'Bachelors in Science',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(20,'Bachelors of Science in Nursing (Registered Nursing)',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(21,'Bachelors in Law',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(22,'Bachelors in Technology',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(23,'BCS\\/BS',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(24,'Doctor of Veterinary Medicine',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(25,'MBBS',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(26,'Post Registered Nursing B.S.',4,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(27,'Masters in Arts',5,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(28,'Masters in Business Administration',5,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(29,'Masters in Commerce',5,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(30,'Masters of Education',5,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(31,'Masters in Law',5,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(32,'Masters in Science',5,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(33,'Executive Masters in Business Administration',5,0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25');
/*!40000 ALTER TABLE `jb_degree_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_degree_types_translations`
--

DROP TABLE IF EXISTS `jb_degree_types_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_degree_types_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_degree_types_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_degree_types_id`),
  KEY `idx_jb_degree_type_trans_fk` (`jb_degree_types_id`),
  KEY `idx_jb_degree_type_trans_fk_lang` (`jb_degree_types_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_degree_types_translations`
--

LOCK TABLES `jb_degree_types_translations` WRITE;
/*!40000 ALTER TABLE `jb_degree_types_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_degree_types_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_functional_areas`
--

DROP TABLE IF EXISTS `jb_functional_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_functional_areas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=157 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_functional_areas`
--

LOCK TABLES `jb_functional_areas` WRITE;
/*!40000 ALTER TABLE `jb_functional_areas` DISABLE KEYS */;
INSERT INTO `jb_functional_areas` VALUES (1,'Accountant',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(2,'Accounts, Finance &amp; Financial Services',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(3,'Admin',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(4,'Admin Operation',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(5,'Administration',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(6,'Administration Clerical',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(7,'Advertising',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(8,'Advertising',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(9,'Advertisement',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(10,'Architects &amp; Construction',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(11,'Architecture',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(12,'Bank Operation',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(13,'Business Development',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(14,'Business Management',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(15,'Business Systems Analyst',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(16,'Clerical',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(17,'Client Services &amp; Customer Support',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(18,'Computer Hardware',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(19,'Computer Networking',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(20,'Consultant',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(21,'Content Writer',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(22,'Corporate Affairs',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(23,'Creative Design',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(24,'Creative Writer',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(25,'Customer Support',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(26,'Data Entry',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(27,'Data Entry Operator',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(28,'Database Administration (DBA)',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(29,'Development',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(30,'Distribution &amp; Logistics',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(31,'Education &amp; Training',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(32,'Electronics Technician',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(33,'Engineering',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(34,'Engineering Construction',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(35,'Executive Management',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(36,'Executive Secretary',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(37,'Field Operations',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(38,'Front Desk Clerk',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(39,'Front Desk Officer',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(40,'Graphic Design',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(41,'Hardware',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(42,'Health &amp; Medicine',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(43,'Health &amp; Safety',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(44,'Health Care',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(45,'Health Related',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(46,'Hotel Management',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(47,'Hotel\\/Restaurant Management',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(48,'HR',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(49,'Human Resources',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(50,'Import &amp; Export',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(51,'Industrial Production',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(52,'Installation &amp; Repair',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(53,'Interior Designers &amp; Architects',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(54,'Intern',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(55,'Internship',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(56,'Investment Operations',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(57,'IT Security',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(58,'IT Systems Analyst',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(59,'Legal &amp; Corporate Affairs',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(60,'Legal Affairs',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(61,'Legal Research',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(62,'Logistics &amp; Warehousing',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(63,'Maintenance\\/Repair',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(64,'Management Consulting',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(65,'Management Information System (MIS)',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(66,'Managerial',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(67,'Manufacturing',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(68,'Manufacturing &amp; Operations',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(69,'Marketing',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(70,'Marketing',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(71,'Media - Print &amp; Electronic',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(72,'Media &amp; Advertising',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(73,'Medical',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(74,'Medicine',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(75,'Merchandising',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(76,'Merchandising &amp; Product Management',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(77,'Monitoring &amp; Evaluation (M&amp;E)',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(78,'Network Administration',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(79,'Network Operation',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(80,'Online Advertising',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(81,'Online Marketing',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(82,'Operations',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(83,'Planning',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(84,'Planning &amp; Development',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(85,'PR',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(86,'Print Media',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(87,'Printing',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(88,'Procurement',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(89,'Product Developer',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(90,'Product Development',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(91,'Product Development',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(92,'Product Management',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(93,'Production',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(94,'Production &amp; Quality Control',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(95,'Project Management',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(96,'Project Management Consultant',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(97,'Public Relations',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(98,'QA',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(99,'QC',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(100,'Qualitative Research',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(101,'Quality Assurance (QA)',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(102,'Quality Control',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(103,'Quality Inspection',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(104,'Recruiting',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(105,'Recruitment',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(106,'Repair &amp; Overhaul',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(107,'Research &amp; Development (R&amp;D)',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(108,'Research &amp; Evaluation',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(109,'Research &amp; Fellowships',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(110,'Researcher',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(111,'Restaurant Management',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(112,'Retail',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(113,'Retail &amp; Wholesale',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(114,'Retail Buyer',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(115,'Retail Buying',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(116,'Retail Merchandising',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(117,'Safety &amp; Environment',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(118,'Sales',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(119,'Sales &amp; Business Development',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(120,'Sales Support',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(121,'Search Engine Optimization (SEO)',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(122,'Secretarial, Clerical &amp; Front Office',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(123,'Security',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(124,'Security &amp; Environment',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(125,'Security Guard',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(126,'SEM',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(127,'SMO',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(128,'Software &amp; Web Development',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(129,'Software Engineer',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(130,'Software Testing',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(131,'Stores &amp; Warehousing',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(132,'Supply Chain',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(133,'Supply Chain Management',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(134,'Systems Analyst',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(135,'Teachers\\/Education, Training &amp; Development',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(136,'Technical Writer',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(137,'Telephone Sale Representative',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(138,'Telemarketing',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(139,'Training &amp; Development',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(140,'Transportation &amp; Warehousing',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(141,'TSR',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(142,'Typing',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(143,'Warehousing',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(144,'Web Developer',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(145,'Web Marketing',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(146,'Writer',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(147,'PR',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(148,'QA',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(149,'QC',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(150,'SEM',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(151,'SMO',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(152,'TSR',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(153,'HR',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(154,'QA',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(155,'QC',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(156,'SEM',0,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25');
/*!40000 ALTER TABLE `jb_functional_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_functional_areas_translations`
--

DROP TABLE IF EXISTS `jb_functional_areas_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_functional_areas_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_functional_areas_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_functional_areas_id`),
  KEY `idx_jb_func_area_trans_fk` (`jb_functional_areas_id`),
  KEY `idx_jb_func_area_trans_fk_lang` (`jb_functional_areas_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_functional_areas_translations`
--

LOCK TABLES `jb_functional_areas_translations` WRITE;
/*!40000 ALTER TABLE `jb_functional_areas_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_functional_areas_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_invoice_items`
--

DROP TABLE IF EXISTS `jb_invoice_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_invoice_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint unsigned NOT NULL,
  `reference_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int unsigned NOT NULL,
  `sub_total` decimal(15,2) unsigned NOT NULL,
  `tax_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `amount` decimal(15,2) unsigned NOT NULL,
  `metadata` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jb_invoice_items_reference_type_reference_id_index` (`reference_type`,`reference_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_invoice_items`
--

LOCK TABLES `jb_invoice_items` WRITE;
/*!40000 ALTER TABLE `jb_invoice_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_invoice_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_invoices`
--

DROP TABLE IF EXISTS `jb_invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_invoices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` decimal(15,2) unsigned NOT NULL,
  `tax_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `shipping_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `discount_amount` decimal(15,2) unsigned NOT NULL DEFAULT '0.00',
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(15,2) unsigned NOT NULL,
  `payment_id` int unsigned DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jb_invoices_code_unique` (`code`),
  KEY `jb_invoices_reference_type_reference_id_index` (`reference_type`,`reference_id`),
  KEY `jb_invoices_payment_id_index` (`payment_id`),
  KEY `jb_invoices_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_invoices`
--

LOCK TABLES `jb_invoices` WRITE;
/*!40000 ALTER TABLE `jb_invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_job_experiences`
--

DROP TABLE IF EXISTS `jb_job_experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_job_experiences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jb_job_experiences_status_order_created_at_index` (`status`,`order`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_job_experiences`
--

LOCK TABLES `jb_job_experiences` WRITE;
/*!40000 ALTER TABLE `jb_job_experiences` DISABLE KEYS */;
INSERT INTO `jb_job_experiences` VALUES (1,'Fresh',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(2,'Less Than 1 Year',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(3,'1 Year',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(4,'2 Year',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(5,'3 Year',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(6,'4 Year',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(7,'5 Year',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(8,'6 Year',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(9,'7 Year',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(10,'8 Year',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(11,'9 Year',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(12,'10 Year',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26');
/*!40000 ALTER TABLE `jb_job_experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_job_experiences_translations`
--

DROP TABLE IF EXISTS `jb_job_experiences_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_job_experiences_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_job_experiences_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_job_experiences_id`),
  KEY `idx_jb_job_exp_trans_fk` (`jb_job_experiences_id`),
  KEY `idx_jb_job_exp_trans_fk_lang` (`jb_job_experiences_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_job_experiences_translations`
--

LOCK TABLES `jb_job_experiences_translations` WRITE;
/*!40000 ALTER TABLE `jb_job_experiences_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_job_experiences_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_job_shifts`
--

DROP TABLE IF EXISTS `jb_job_shifts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_job_shifts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_job_shifts`
--

LOCK TABLES `jb_job_shifts` WRITE;
/*!40000 ALTER TABLE `jb_job_shifts` DISABLE KEYS */;
INSERT INTO `jb_job_shifts` VALUES (1,'First Shift (Day)',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(2,'Second Shift (Afternoon)',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(3,'Third Shift (Night)',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(4,'Rotating',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26');
/*!40000 ALTER TABLE `jb_job_shifts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_job_shifts_translations`
--

DROP TABLE IF EXISTS `jb_job_shifts_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_job_shifts_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_job_shifts_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_job_shifts_id`),
  KEY `idx_jb_job_shift_trans_fk` (`jb_job_shifts_id`),
  KEY `idx_jb_job_shift_trans_fk_lang` (`jb_job_shifts_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_job_shifts_translations`
--

LOCK TABLES `jb_job_shifts_translations` WRITE;
/*!40000 ALTER TABLE `jb_job_shifts_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_job_shifts_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_job_skills`
--

DROP TABLE IF EXISTS `jb_job_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_job_skills` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_job_skills`
--

LOCK TABLES `jb_job_skills` WRITE;
/*!40000 ALTER TABLE `jb_job_skills` DISABLE KEYS */;
INSERT INTO `jb_job_skills` VALUES (1,'Javascript',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(2,'PHP',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(3,'Python',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(4,'Laravel',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(5,'CakePHP',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(6,'Wordpress',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26');
/*!40000 ALTER TABLE `jb_job_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_job_skills_translations`
--

DROP TABLE IF EXISTS `jb_job_skills_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_job_skills_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_job_skills_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_job_skills_id`),
  KEY `idx_jb_job_skill_trans_fk` (`jb_job_skills_id`),
  KEY `idx_jb_job_skill_trans_fk_lang` (`jb_job_skills_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_job_skills_translations`
--

LOCK TABLES `jb_job_skills_translations` WRITE;
/*!40000 ALTER TABLE `jb_job_skills_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_job_skills_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_job_types`
--

DROP TABLE IF EXISTS `jb_job_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_job_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_job_types`
--

LOCK TABLES `jb_job_types` WRITE;
/*!40000 ALTER TABLE `jb_job_types` DISABLE KEYS */;
INSERT INTO `jb_job_types` VALUES (1,'Contract',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(2,'Freelance',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(3,'Full Time',0,1,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(4,'Internship',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26'),(5,'Part Time',0,0,'published','2025-12-23 19:31:26','2025-12-23 19:31:26');
/*!40000 ALTER TABLE `jb_job_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_job_types_translations`
--

DROP TABLE IF EXISTS `jb_job_types_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_job_types_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_job_types_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_job_types_id`),
  KEY `idx_jb_job_type_trans_fk` (`jb_job_types_id`),
  KEY `idx_jb_job_type_trans_fk_lang` (`jb_job_types_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_job_types_translations`
--

LOCK TABLES `jb_job_types_translations` WRITE;
/*!40000 ALTER TABLE `jb_job_types_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_job_types_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_jobs`
--

DROP TABLE IF EXISTS `jb_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `apply_url` text COLLATE utf8mb4_unicode_ci,
  `external_apply_behavior` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_id` bigint unsigned DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint unsigned DEFAULT '1',
  `state_id` bigint unsigned DEFAULT NULL,
  `city_id` bigint unsigned DEFAULT NULL,
  `is_freelance` tinyint unsigned NOT NULL DEFAULT '0',
  `career_level_id` bigint unsigned DEFAULT NULL,
  `salary_from` decimal(15,2) unsigned DEFAULT NULL,
  `salary_to` decimal(15,2) unsigned DEFAULT NULL,
  `salary_range` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hour',
  `salary_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fixed',
  `currency_id` bigint unsigned DEFAULT NULL,
  `degree_level_id` bigint unsigned DEFAULT NULL,
  `job_shift_id` bigint unsigned DEFAULT NULL,
  `job_experience_id` bigint unsigned DEFAULT NULL,
  `functional_area_id` bigint unsigned DEFAULT NULL,
  `hide_salary` tinyint(1) NOT NULL DEFAULT '0',
  `number_of_positions` int unsigned NOT NULL DEFAULT '1',
  `expire_date` date DEFAULT NULL,
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Botble\\ACL\\Models\\User',
  `views` int unsigned NOT NULL DEFAULT '0',
  `number_of_applied` int unsigned NOT NULL DEFAULT '0',
  `hide_company` tinyint(1) NOT NULL DEFAULT '0',
  `latitude` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auto_renew` tinyint(1) NOT NULL DEFAULT '0',
  `external_apply_clicks` int unsigned NOT NULL DEFAULT '0',
  `never_expired` tinyint(1) NOT NULL DEFAULT '0',
  `is_featured` tinyint NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `moderation_status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `employer_colleagues` text COLLATE utf8mb4_unicode_ci,
  `start_date` date DEFAULT NULL,
  `application_closing_date` date DEFAULT NULL,
  `zip_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jb_jobs_unique_id_unique` (`unique_id`),
  KEY `jb_jobs_active_jobs_index` (`moderation_status`,`status`,`expire_date`),
  KEY `jb_jobs_company_id_index` (`company_id`),
  KEY `jb_jobs_is_featured_index` (`is_featured`),
  KEY `jb_jobs_created_at_index` (`created_at`),
  KEY `jb_jobs_expire_date_index` (`expire_date`),
  KEY `jb_jobs_never_expired_index` (`never_expired`),
  KEY `jb_jobs_country_id_index` (`country_id`),
  KEY `jb_jobs_state_id_index` (`state_id`),
  KEY `jb_jobs_city_id_index` (`city_id`),
  KEY `jb_jobs_job_experience_id_index` (`job_experience_id`),
  KEY `jb_jobs_career_level_id_index` (`career_level_id`),
  KEY `jb_jobs_functional_area_id_index` (`functional_area_id`),
  KEY `jb_jobs_job_shift_id_index` (`job_shift_id`),
  KEY `jb_jobs_degree_level_id_index` (`degree_level_id`),
  KEY `jb_jobs_author_index` (`author_id`,`author_type`),
  KEY `jb_jobs_application_closing_date_index` (`application_closing_date`),
  KEY `jb_jobs_listing_optimized_index` (`moderation_status`,`status`,`created_at`,`never_expired`,`expire_date`,`application_closing_date`),
  KEY `jb_jobs_never_expired_status_index` (`never_expired`,`moderation_status`,`status`,`created_at`),
  KEY `jb_jobs_expire_date_listing_index` (`moderation_status`,`status`,`expire_date`,`created_at`),
  KEY `jb_jobs_views_index` (`views`),
  KEY `jb_jobs_experience_active_idx` (`job_experience_id`,`moderation_status`,`status`,`never_expired`,`expire_date`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_jobs`
--

LOCK TABLES `jb_jobs` WRITE;
/*!40000 ALTER TABLE `jb_jobs` DISABLE KEYS */;
INSERT INTO `jb_jobs` VALUES (1,NULL,'UI / UX Designer full-time','Consectetur quo sed dignissimos ex aliquam et eum. Quo dolores aut voluptatum sequi. Sint ut nisi accusantium aut non molestiae sit. Ut nulla nesciunt voluptatibus rerum dolore.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,15,NULL,1,1,1,0,1,1400.00,2900.00,'monthly','fixed',0,8,3,3,122,0,8,'2026-08-14',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.43472','-76.386177',0,0,0,0,'published','approved','2025-11-20 15:51:29','2025-12-23 19:31:27',NULL,NULL,'2026-12-17',NULL),(2,NULL,'Full Stack Engineer','Repudiandae rem quo sint et. Illo qui nemo occaecati adipisci odio. Itaque nesciunt vel inventore magni incidunt ad. Eos vitae non ut est doloremque qui.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','https://google.com',NULL,9,NULL,3,3,3,1,3,1300.00,2700.00,'daily','fixed',1,8,1,2,76,0,4,'2026-11-05',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.259398','-75.632707',0,0,1,1,'published','approved','2025-11-21 22:39:43','2025-12-23 19:31:27',NULL,NULL,'2026-07-03',NULL),(3,NULL,'Java Software Engineer','Consequatur odit laborum odit alias. Officia voluptatem excepturi perferendis voluptas consequatur nemo. Optio ut incidunt alias iste. Itaque quasi cum animi nihil.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,13,NULL,6,6,6,0,3,1400.00,2600.00,'monthly','fixed',1,7,4,1,144,0,8,'2026-09-12',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.637512','-76.64502',0,0,0,1,'published','approved','2025-10-29 12:33:27','2025-12-23 19:31:27',NULL,NULL,'2026-07-21',NULL),(4,NULL,'Digital Marketing Manager','Deserunt quia dolore et. Qui atque harum fugit dolorum impedit quae. Culpa quia autem incidunt rerum veniam tenetur reprehenderit.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,5,NULL,2,2,2,1,5,600.00,1900.00,'daily','fixed',1,6,2,2,131,0,7,'2026-05-29',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.926553','-76.014591',0,0,1,1,'published','approved','2025-12-12 22:40:12','2025-12-23 19:31:27',NULL,NULL,'2026-10-10',NULL),(5,NULL,'Frontend Developer','Dolore qui nulla ipsam et. Error illo fugiat est. Consequatur tempore sequi necessitatibus magnam. Nam quia rerum quia voluptatem.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,12,NULL,6,6,6,0,2,1200.00,1700.00,'daily','fixed',0,6,2,5,131,0,4,'2026-10-15',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.617819','-76.029647',0,0,1,1,'published','approved','2025-12-17 21:19:42','2025-12-23 19:31:27',NULL,NULL,'2026-11-11',NULL),(6,NULL,'React Native Web Developer','Similique modi autem laborum est. Repellendus aut velit aut voluptate. Vitae non expedita illo nisi cum voluptatem. Totam illum non dolorem modi aut accusamus.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,13,NULL,6,6,6,1,5,1200.00,2400.00,'monthly','fixed',1,3,1,4,99,0,4,'2026-07-23',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.637512','-76.64502',0,0,1,0,'published','approved','2025-12-14 04:38:06','2025-12-23 19:31:27',NULL,NULL,'2026-10-06',NULL),(7,NULL,'Senior System Engineer','Natus ea eveniet qui assumenda tempora maxime voluptatem. Qui eveniet inventore adipisci aliquid a sunt amet. Occaecati in dolorem sint hic adipisci quo eum.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,14,NULL,2,2,2,0,2,1200.00,2200.00,'hourly','fixed',1,7,3,3,53,0,8,'2026-11-24',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.872643','-75.490129',0,0,1,0,'published','approved','2025-11-13 05:05:09','2025-12-23 19:31:27',NULL,NULL,'2026-12-08',NULL),(8,NULL,'Products Manager','Est reiciendis voluptatem illo blanditiis quasi accusantium. Aspernatur ipsa sit in rerum. Voluptatem cumque sit aut assumenda optio. Excepturi tempore sunt consectetur quia.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,6,NULL,1,1,1,1,5,1000.00,1600.00,'hourly','fixed',0,1,2,5,69,0,5,'2026-10-27',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.791032','-75.506064',0,0,0,1,'published','approved','2025-11-10 02:04:32','2025-12-23 19:31:27',NULL,NULL,'2026-10-30',NULL),(9,NULL,'Lead Quality Control QA','Eaque ut possimus dolorum at. Quis similique labore omnis ex est voluptatem natus. Eveniet placeat fugiat eos autem.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,2,NULL,4,4,4,1,2,1000.00,1500.00,'weekly','fixed',1,7,3,2,110,0,6,'2026-07-20',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.572429','-75.703021',0,0,1,1,'published','approved','2025-10-28 19:06:49','2025-12-23 19:31:27',NULL,NULL,'2026-06-01',NULL),(10,NULL,'Principal Designer, Design Systems','Atque et eius modi ut reprehenderit dolores. Adipisci illum vitae a eveniet sit est. Et distinctio impedit ut tempora. Est soluta officiis et ipsa non doloremque.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,14,NULL,2,2,2,1,2,900.00,2400.00,'weekly','fixed',0,9,1,2,36,0,9,'2026-06-09',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.872643','-75.490129',0,0,1,1,'published','approved','2025-11-01 12:31:49','2025-12-23 19:31:27',NULL,NULL,'2026-07-10',NULL),(11,NULL,'DevOps Architect','Amet sunt ea ut tempore tenetur id veritatis. Ea est est ut qui. Consequatur natus a nesciunt iure debitis et qui.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,12,NULL,6,6,6,0,3,1500.00,2300.00,'yearly','fixed',0,8,1,5,85,0,7,'2026-06-24',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.617819','-76.029647',0,0,0,1,'published','approved','2025-12-12 09:08:11','2025-12-23 19:31:27',NULL,NULL,'2026-10-29',NULL),(12,NULL,'Senior Software Engineer, npm CLI','Doloremque nam omnis delectus adipisci necessitatibus. Ut laborum ipsa consequatur placeat tempora consequatur ea. Necessitatibus cum ratione nostrum aut aliquid.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,2,NULL,4,4,4,1,4,1000.00,1900.00,'yearly','fixed',0,10,3,1,140,0,8,'2026-09-04',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.572429','-75.703021',0,0,1,0,'published','approved','2025-11-08 06:34:29','2025-12-23 19:31:27',NULL,NULL,'2026-11-23',NULL),(13,NULL,'Senior Systems Engineer','Consequatur qui voluptas et ducimus nihil laudantium aperiam. Magni eaque corrupti voluptas sed corporis voluptatem. Iste perferendis eveniet asperiores.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,16,NULL,2,2,2,1,1,1100.00,2100.00,'daily','fixed',1,1,3,3,77,0,6,'2026-08-27',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.950917','-74.984021',0,0,1,1,'published','approved','2025-11-15 10:38:08','2025-12-23 19:31:27',NULL,NULL,'2026-07-11',NULL),(14,NULL,'Software Engineer Actions Platform','Temporibus dolore voluptates at mollitia molestiae eum. Qui consequatur qui qui cumque ut nisi. Et labore vel voluptatum cumque rerum.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,12,NULL,6,6,6,1,5,600.00,1500.00,'yearly','fixed',0,2,4,1,98,0,5,'2026-06-16',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.617819','-76.029647',0,0,1,0,'published','approved','2025-11-02 11:08:27','2025-12-23 19:31:27',NULL,NULL,'2026-07-05',NULL),(15,NULL,'Staff Engineering Manager, Actions','Sit laboriosam iusto quis dolores facere. Vero et veritatis cum enim. Beatae minima est et. Nihil earum consequatur maiores nesciunt placeat.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,12,NULL,6,6,6,0,2,800.00,1500.00,'yearly','fixed',0,7,2,3,20,0,2,'2026-11-17',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.617819','-76.029647',0,0,1,1,'published','approved','2025-10-24 12:32:54','2025-12-23 19:31:27',NULL,NULL,'2026-07-11',NULL),(16,NULL,'Staff Engineering Manager: Actions Runtime','Qui est soluta sapiente at vel. Beatae consequatur corrupti provident error. Repudiandae odio sunt in fuga ut eos qui id. Sapiente nostrum perferendis ut.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,1,NULL,5,5,5,1,3,1100.00,2200.00,'daily','fixed',1,8,2,2,102,0,8,'2026-09-02',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.295179','-75.220259',0,0,0,0,'published','approved','2025-12-12 03:19:39','2025-12-23 19:31:27',NULL,NULL,'2026-10-27',NULL),(17,NULL,'Staff Engineering Manager, Packages','Exercitationem corporis quam ut voluptatem pariatur vero. Dolor sed vel aut laudantium. Et molestiae non aut explicabo sint et quo. Sapiente totam quis amet nesciunt facilis qui reprehenderit.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,2,NULL,4,4,4,0,5,700.00,1700.00,'monthly','fixed',1,10,3,2,48,0,3,'2026-09-28',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.572429','-75.703021',0,0,1,1,'published','approved','2025-12-13 07:01:55','2025-12-23 19:31:27',NULL,NULL,'2026-08-11',NULL),(18,NULL,'Staff Software Engineer','Magnam hic suscipit velit cumque quasi blanditiis id. Ullam et nihil vitae cum ea illo. Voluptas delectus qui tenetur exercitationem omnis. Odit sequi qui magnam provident aliquam.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,14,NULL,2,2,2,1,5,900.00,2000.00,'monthly','fixed',0,8,3,2,54,0,8,'2026-07-18',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.872643','-75.490129',0,0,0,0,'published','approved','2025-11-15 04:34:44','2025-12-23 19:31:27',NULL,NULL,'2026-06-16',NULL),(19,NULL,'Systems Software Engineer','Ea error quo quam fugiat et quisquam aut. Eum quisquam sed qui adipisci. Non expedita voluptatum unde ullam aut. Nostrum eos hic harum dicta similique.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,3,NULL,4,4,4,0,1,900.00,1800.00,'monthly','fixed',0,3,2,2,37,0,7,'2026-08-23',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.385712','-75.262497',0,0,0,0,'published','approved','2025-10-30 11:33:51','2025-12-23 19:31:27',NULL,NULL,'2026-11-28',NULL),(20,NULL,'Senior Compensation Analyst','Qui praesentium cum porro hic. Et consequatur earum voluptas ad. Quibusdam deserunt recusandae inventore quod.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,16,NULL,2,2,2,1,4,1300.00,2100.00,'yearly','fixed',1,9,2,2,40,0,5,'2026-12-20',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.950917','-74.984021',0,0,0,1,'published','approved','2025-10-29 18:42:54','2025-12-23 19:31:27',NULL,NULL,'2026-08-09',NULL),(21,NULL,'Senior Accessibility Program Manager','Possimus molestiae praesentium doloribus quas omnis. Occaecati sit voluptatem aliquid voluptatum. Incidunt cum necessitatibus rerum.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,2,NULL,4,4,4,1,1,1400.00,2100.00,'daily','fixed',0,9,3,5,124,0,3,'2026-07-05',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.572429','-75.703021',0,0,1,0,'published','approved','2025-11-27 09:03:27','2025-12-23 19:31:27',NULL,NULL,'2026-07-17',NULL),(22,NULL,'Analyst Relations Manager, Application Security','Quia commodi unde ipsum et. Enim in quae suscipit ipsum autem aut. Et omnis quisquam cum ab impedit sequi.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,7,NULL,5,5,5,0,3,1000.00,2400.00,'daily','fixed',1,6,4,5,74,0,8,'2026-10-30',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.607069','-76.313167',0,0,1,0,'published','approved','2025-12-10 03:22:59','2025-12-23 19:31:27',NULL,NULL,'2026-11-04',NULL),(23,NULL,'Senior Enterprise Advocate, EMEA','Ipsa quia dolores soluta animi vel et inventore. Aut molestiae nostrum nam nihil molestiae. Sequi eius dolor neque minus accusamus impedit quia. Eos veritatis quia voluptatem.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,8,NULL,2,2,2,0,2,1000.00,1700.00,'yearly','fixed',1,6,3,3,70,0,4,'2026-11-28',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.379825','-75.33031',0,0,0,0,'published','approved','2025-11-22 17:26:57','2025-12-23 19:31:27',NULL,NULL,'2026-11-09',NULL),(24,NULL,'Deal Desk Manager','Libero ut sequi aut veritatis. Deleniti dolorem aut debitis animi. Neque asperiores culpa earum laudantium.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,13,NULL,6,6,6,1,2,1400.00,2200.00,'daily','fixed',1,6,3,1,125,0,9,'2026-10-08',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.637512','-76.64502',0,0,1,0,'published','approved','2025-11-14 11:28:00','2025-12-23 19:31:27',NULL,NULL,'2026-10-08',NULL),(25,NULL,'Director, Revenue Compensation','Impedit repudiandae ut incidunt sapiente ut. Dolore laudantium officia ut deserunt delectus et. Ut beatae voluptas natus sed amet nihil dignissimos. Nisi eligendi dolorem sequi asperiores.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,7,NULL,5,5,5,1,4,1400.00,2500.00,'weekly','fixed',1,6,1,1,102,0,9,'2026-07-05',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.607069','-76.313167',0,0,0,0,'published','approved','2025-11-15 11:14:47','2025-12-23 19:31:27',NULL,NULL,'2026-10-29',NULL),(26,NULL,'Program Manager','Repellat distinctio in cumque enim voluptatem quis. Doloremque dolor dolores quidem sed.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,12,NULL,6,6,6,1,4,800.00,1800.00,'hourly','fixed',1,9,3,5,10,0,6,'2026-09-25',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.617819','-76.029647',0,0,0,0,'published','approved','2025-10-26 18:09:47','2025-12-23 19:31:27',NULL,NULL,'2026-08-25',NULL),(27,NULL,'Sr. Manager, Deal Desk - INTL','Corrupti velit quod ducimus doloremque. Ut quidem et quod hic ea iste saepe. In et unde quia autem reprehenderit autem magni.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,3,NULL,4,4,4,0,4,1200.00,2100.00,'hourly','fixed',1,4,3,3,117,0,2,'2026-11-07',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.385712','-75.262497',0,0,1,0,'published','approved','2025-11-02 05:38:35','2025-12-23 19:31:27',NULL,NULL,'2026-09-17',NULL),(28,NULL,'Senior Director, Product Management, Actions Runners and Compute Services','Architecto et quisquam quaerat animi. Ipsum odio explicabo pariatur tempore id dolorem. Optio vel blanditiis et amet. Omnis magnam aut beatae qui reiciendis.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,13,NULL,6,6,6,0,4,800.00,2300.00,'daily','fixed',1,10,1,2,113,0,4,'2026-07-10',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.637512','-76.64502',0,0,0,0,'published','approved','2025-12-05 01:32:59','2025-12-23 19:31:27',NULL,NULL,'2026-12-09',NULL),(29,NULL,'Alliances Director','Ad quam iusto eum inventore est voluptas quia. Ipsa vitae cum ut. Beatae ducimus qui enim at ratione enim non cumque. Inventore ipsum accusantium deserunt nemo adipisci dolor dolor et.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,10,NULL,1,1,1,0,2,1400.00,2800.00,'hourly','fixed',0,7,3,4,54,0,6,'2026-05-26',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.264572','-75.568509',0,0,1,1,'published','approved','2025-11-30 12:07:11','2025-12-23 19:31:27',NULL,NULL,'2026-12-11',NULL),(30,NULL,'Corporate Sales Representative','Tempora in aliquam ullam ratione dolorem sit tempore. Aut hic porro et suscipit laboriosam. Facere et eum error. Neque consequatur itaque et id vel et veniam.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,14,NULL,2,2,2,1,4,1400.00,2600.00,'monthly','fixed',0,4,1,1,80,0,10,'2026-07-02',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.872643','-75.490129',0,0,0,1,'published','approved','2025-12-10 13:43:39','2025-12-23 19:31:27',NULL,NULL,'2026-10-09',NULL),(31,NULL,'Country Leader','Placeat autem ex aperiam quia. Delectus et ad fugit consequatur et sunt. Eos nulla ut ut voluptatibus. Cum et beatae et saepe esse odio.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,8,NULL,2,2,2,1,3,600.00,1300.00,'weekly','fixed',0,8,3,5,116,0,7,'2026-06-01',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.379825','-75.33031',0,0,1,1,'published','approved','2025-12-14 05:23:49','2025-12-23 19:31:27',NULL,NULL,'2026-05-25',NULL),(32,NULL,'Customer Success Architect','Culpa ut dolor ipsa culpa accusantium. Dicta ut quidem distinctio et aut quas. In velit laboriosam eligendi fugit.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,2,NULL,4,4,4,0,3,600.00,1500.00,'daily','fixed',1,3,2,2,63,0,8,'2026-07-21',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.572429','-75.703021',0,0,1,0,'published','approved','2025-11-09 09:02:59','2025-12-23 19:31:27',NULL,NULL,'2026-09-01',NULL),(33,NULL,'DevOps Account Executive - US Public Sector','Odit fuga consectetur eveniet temporibus. Qui maiores odit dolorem hic. In quisquam assumenda quia id. Velit ipsum eos ducimus.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,16,NULL,2,2,2,1,3,1000.00,1800.00,'monthly','fixed',1,10,1,1,151,0,5,'2026-11-26',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.950917','-74.984021',0,0,0,1,'published','approved','2025-12-17 21:21:05','2025-12-23 19:31:27',NULL,NULL,'2026-11-14',NULL),(34,NULL,'Enterprise Account Executive','Impedit fugit dignissimos omnis et voluptate. Laudantium perferendis enim et. Eligendi reprehenderit aut eum.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,8,NULL,2,2,2,1,3,700.00,1400.00,'daily','fixed',1,5,4,5,136,0,8,'2026-06-12',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.379825','-75.33031',0,0,0,1,'published','approved','2025-11-09 20:56:17','2025-12-23 19:31:27',NULL,NULL,'2026-11-29',NULL),(35,NULL,'Senior Engineering Manager, Product Security Engineering - Paved Paths','Fugit natus consequatur quis expedita reprehenderit. Ab ut et nulla voluptas.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,2,NULL,4,4,4,1,5,1000.00,1600.00,'yearly','fixed',1,4,3,2,145,0,7,'2026-12-23',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.572429','-75.703021',0,0,0,0,'published','approved','2025-12-13 15:52:54','2025-12-23 19:31:27',NULL,NULL,'2026-06-04',NULL),(36,NULL,'Customer Reliability Engineer III','Explicabo cum porro esse numquam explicabo ut. Rerum officia velit aperiam modi ratione. Quaerat optio reprehenderit non repudiandae ipsam quam.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,4,NULL,5,5,5,1,2,600.00,1800.00,'daily','fixed',0,5,1,2,73,0,3,'2026-10-26',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.230053','-75.680961',0,0,0,1,'published','approved','2025-11-27 07:57:46','2025-12-23 19:31:27',NULL,NULL,'2026-06-29',NULL),(37,NULL,'Support Engineer (Enterprise Support Japanese)','Ut vel laboriosam atque quisquam minus rerum dolorum. Facere inventore vel fuga alias perferendis dolorem ut. Odio eum quis rem et nulla error.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,4,NULL,5,5,5,1,5,700.00,2100.00,'hourly','fixed',0,4,4,3,60,0,2,'2026-08-13',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.230053','-75.680961',0,0,1,0,'published','approved','2025-11-07 12:44:52','2025-12-23 19:31:27',NULL,NULL,'2026-08-14',NULL),(38,NULL,'Technical Partner Manager','Autem nam quis voluptas omnis. Animi et amet aspernatur sint quia non sunt iure. Quis consequatur fugit neque est eum eum veritatis. Atque blanditiis qui sapiente neque animi.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,1,NULL,5,5,5,1,5,1200.00,2300.00,'daily','fixed',0,9,1,3,4,0,10,'2026-06-07',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.295179','-75.220259',0,0,0,1,'published','approved','2025-12-14 13:17:10','2025-12-23 19:31:27',NULL,NULL,'2026-10-19',NULL),(39,NULL,'Sr Manager, Inside Account Management','Aut ab officia placeat voluptas doloribus explicabo a. Minima quis quasi velit maiores ut velit eos. At non perferendis esse corrupti eos. Qui quia maiores doloribus et maxime est.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,3,NULL,4,4,4,0,2,800.00,1600.00,'weekly','fixed',1,10,4,4,19,0,8,'2026-11-26',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.385712','-75.262497',0,0,0,1,'published','approved','2025-12-01 06:03:57','2025-12-23 19:31:27',NULL,NULL,'2026-05-31',NULL),(40,NULL,'Services Sales Representative','Veniam cupiditate aspernatur illo aut. Necessitatibus et perspiciatis maxime sit. Molestias quae sit tempora ut iste. Nisi eius necessitatibus fugit nemo sunt error.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,12,NULL,6,6,6,0,4,1100.00,1900.00,'yearly','fixed',1,6,1,3,27,0,6,'2026-08-26',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.617819','-76.029647',0,0,1,0,'published','approved','2025-10-28 13:12:13','2025-12-23 19:31:27',NULL,NULL,'2026-10-23',NULL),(41,NULL,'Services Delivery Manager','Culpa possimus expedita non repellendus id nostrum. Et explicabo odio autem ut adipisci fugit. Expedita ea placeat id quia. Nesciunt dignissimos fugiat non.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,14,NULL,2,2,2,1,5,800.00,1600.00,'yearly','fixed',1,10,2,1,14,0,4,'2026-12-22',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.872643','-75.490129',0,0,0,0,'published','approved','2025-11-04 14:55:11','2025-12-23 19:31:27',NULL,NULL,'2026-12-07',NULL),(42,NULL,'Senior Solutions Engineer','Ea praesentium culpa vitae non aperiam sit illo iste. Ipsum id sunt esse eos voluptatem. Est est repellat enim libero. Aut debitis accusamus est.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,1,NULL,5,5,5,1,1,1300.00,2300.00,'daily','fixed',1,8,2,5,138,0,4,'2026-06-04',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.295179','-75.220259',0,0,0,1,'published','approved','2025-11-08 06:57:03','2025-12-23 19:31:27',NULL,NULL,'2026-08-01',NULL),(43,NULL,'Senior Service Delivery Engineer','A sit ullam optio et sint eos. Voluptas eos dolorem sit itaque enim. Adipisci quaerat dicta cumque ullam cum.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,7,NULL,5,5,5,0,3,1200.00,2000.00,'daily','fixed',1,5,3,3,130,0,5,'2026-10-02',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.607069','-76.313167',0,0,1,0,'published','approved','2025-12-13 11:53:19','2025-12-23 19:31:27',NULL,NULL,'2026-09-03',NULL),(44,NULL,'Senior Director, Global Sales Development','Tenetur cupiditate aut quia quos et vel. Magnam dolores minima voluptatum veritatis eum. Iusto quo fugiat eum vel cum quo. Sed vel temporibus blanditiis voluptatum doloremque doloremque.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,4,NULL,5,5,5,0,4,700.00,1300.00,'hourly','fixed',0,10,3,5,68,0,8,'2026-09-22',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.230053','-75.680961',0,0,1,1,'published','approved','2025-11-27 18:55:34','2025-12-23 19:31:27',NULL,NULL,'2026-08-28',NULL),(45,NULL,'Partner Program Manager','Et temporibus temporibus porro totam. Hic aut maxime aliquam excepturi sit ad sed sapiente. Perferendis dicta beatae et eum totam similique.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,1,NULL,5,5,5,0,4,1000.00,2200.00,'yearly','fixed',1,7,4,4,84,0,9,'2026-10-17',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.295179','-75.220259',0,0,1,1,'published','approved','2025-11-04 07:02:44','2025-12-23 19:31:27',NULL,NULL,'2026-12-05',NULL),(46,NULL,'Principal Cloud Solutions Engineer','Placeat aut qui enim. Sequi illum eum quia at. Delectus ut ipsa cumque repudiandae.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,5,NULL,2,2,2,1,4,1300.00,2400.00,'daily','fixed',1,8,4,5,141,0,8,'2026-12-09',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.926553','-76.014591',0,0,1,0,'published','approved','2025-11-25 16:44:23','2025-12-23 19:31:27',NULL,NULL,'2026-08-06',NULL),(47,NULL,'Senior Cloud Solutions Engineer','Ipsa ratione ducimus ea ut in ratione. Perferendis quaerat culpa deserunt est error. Non voluptatum quo tempora itaque velit est.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,5,NULL,2,2,2,0,2,1300.00,2600.00,'hourly','fixed',0,4,3,4,144,0,4,'2026-09-11',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.926553','-76.014591',0,0,1,1,'published','approved','2025-10-24 20:56:52','2025-12-23 19:31:27',NULL,NULL,'2026-09-14',NULL),(48,NULL,'Senior Customer Success Manager','Recusandae dolorem tempore illo sapiente. Dolorem esse voluptatem beatae commodi eaque. Sunt inventore id vel est dolorem quo explicabo. Nulla dolores magni repellendus quos cum quaerat.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,13,NULL,6,6,6,1,2,700.00,2200.00,'daily','fixed',1,8,2,4,128,0,4,'2026-09-26',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.637512','-76.64502',0,0,1,0,'published','approved','2025-11-02 07:30:35','2025-12-23 19:31:27',NULL,NULL,'2026-06-17',NULL),(49,NULL,'Inside Account Manager','Deleniti asperiores autem iure itaque. Sint sunt commodi unde fugit sunt explicabo sunt.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,8,NULL,2,2,2,1,3,1400.00,2900.00,'monthly','fixed',1,4,1,1,140,0,2,'2026-08-27',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.379825','-75.33031',0,0,0,1,'published','approved','2025-12-16 01:57:31','2025-12-23 19:31:27',NULL,NULL,'2026-10-03',NULL),(50,NULL,'UX Jobs Board','Ut repellat velit magnam. Quaerat non odio rerum impedit facilis minus. Sit quis labore eum excepturi sequi.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,7,NULL,5,5,5,1,4,1000.00,1800.00,'yearly','fixed',0,5,1,1,144,0,2,'2026-07-16',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.607069','-76.313167',0,0,0,1,'published','approved','2025-11-08 15:36:41','2025-12-23 19:31:27',NULL,NULL,'2026-12-06',NULL),(51,NULL,'Senior Laravel Developer (TALL Stack)','Et non corrupti et qui omnis doloribus iure. Fugit vitae eum ullam eos qui.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,5,NULL,2,2,2,1,1,700.00,1300.00,'daily','fixed',0,6,4,1,18,0,6,'2026-08-01',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.926553','-76.014591',0,0,1,1,'published','approved','2025-11-17 16:39:21','2025-12-23 19:31:27',NULL,NULL,'2026-09-16',NULL);
/*!40000 ALTER TABLE `jb_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_jobs_categories`
--

DROP TABLE IF EXISTS `jb_jobs_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_jobs_categories` (
  `job_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  UNIQUE KEY `jb_jobs_categories_unique` (`job_id`,`category_id`),
  KEY `jb_jobs_categories_job_id_index` (`job_id`),
  KEY `jb_jobs_categories_category_id_index` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_jobs_categories`
--

LOCK TABLES `jb_jobs_categories` WRITE;
/*!40000 ALTER TABLE `jb_jobs_categories` DISABLE KEYS */;
INSERT INTO `jb_jobs_categories` VALUES (1,1),(1,2),(1,9),(2,1),(2,3),(2,6),(3,1),(3,5),(3,6),(4,1),(4,5),(4,8),(5,1),(5,3),(5,10),(6,1),(6,3),(6,9),(7,1),(7,5),(7,9),(8,1),(8,5),(8,6),(9,1),(9,4),(9,7),(10,1),(10,2),(10,10),(11,1),(11,2),(11,7),(12,1),(12,5),(12,8),(13,1),(13,2),(13,9),(14,1),(14,2),(14,9),(15,1),(15,3),(15,8),(16,1),(16,3),(16,10),(17,1),(17,5),(17,8),(18,1),(18,4),(18,7),(19,1),(19,2),(19,10),(20,1),(20,2),(20,9),(21,1),(21,5),(21,8),(22,1),(22,5),(22,10),(23,1),(23,4),(23,7),(24,1),(24,2),(24,8),(25,1),(25,2),(25,7),(26,1),(26,4),(26,10),(27,1),(27,2),(27,7),(28,1),(28,4),(28,6),(29,1),(29,3),(29,7),(30,1),(30,5),(30,9),(31,1),(31,4),(31,10),(32,1),(32,3),(32,8),(33,1),(33,2),(33,6),(34,1),(34,3),(34,8),(35,1),(35,3),(35,6),(36,1),(36,3),(36,10),(37,1),(37,2),(37,7),(38,1),(38,3),(38,6),(39,1),(39,5),(39,6),(40,1),(40,3),(40,8),(41,1),(41,5),(41,6),(42,1),(42,4),(42,9),(43,1),(43,2),(43,6),(44,1),(44,4),(44,7),(45,1),(45,2),(45,10),(46,1),(46,4),(46,6),(47,1),(47,3),(47,9),(48,1),(48,5),(48,10),(49,1),(49,5),(49,8),(50,1),(50,2),(50,6),(51,1),(51,5),(51,9);
/*!40000 ALTER TABLE `jb_jobs_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_jobs_skills`
--

DROP TABLE IF EXISTS `jb_jobs_skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_jobs_skills` (
  `job_id` bigint unsigned NOT NULL,
  `job_skill_id` bigint unsigned NOT NULL,
  UNIQUE KEY `jb_jobs_skills_unique` (`job_id`,`job_skill_id`),
  KEY `jb_jobs_skills_job_id_index` (`job_id`),
  KEY `jb_jobs_skills_job_skill_id_index` (`job_skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_jobs_skills`
--

LOCK TABLES `jb_jobs_skills` WRITE;
/*!40000 ALTER TABLE `jb_jobs_skills` DISABLE KEYS */;
INSERT INTO `jb_jobs_skills` VALUES (1,2),(2,4),(3,6),(4,2),(5,3),(6,4),(7,3),(8,6),(9,6),(10,5),(11,3),(12,5),(13,3),(14,3),(15,1),(16,1),(17,2),(18,5),(19,1),(20,6),(21,6),(22,2),(23,1),(24,3),(25,1),(26,6),(27,2),(28,1),(29,3),(30,5),(31,1),(32,1),(33,6),(34,6),(35,3),(36,1),(37,4),(38,1),(39,3),(40,1),(41,4),(42,2),(43,2),(44,2),(45,1),(46,3),(47,5),(48,6),(49,4),(50,6),(51,4);
/*!40000 ALTER TABLE `jb_jobs_skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_jobs_tags`
--

DROP TABLE IF EXISTS `jb_jobs_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_jobs_tags` (
  `job_id` bigint unsigned NOT NULL,
  `tag_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`job_id`,`tag_id`),
  KEY `jb_jobs_tags_job_id_index` (`job_id`),
  KEY `jb_jobs_tags_tag_id_index` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_jobs_tags`
--

LOCK TABLES `jb_jobs_tags` WRITE;
/*!40000 ALTER TABLE `jb_jobs_tags` DISABLE KEYS */;
INSERT INTO `jb_jobs_tags` VALUES (1,2),(1,7),(2,4),(2,5),(3,2),(3,8),(4,1),(4,7),(5,1),(5,8),(6,3),(6,6),(7,4),(7,6),(8,3),(8,8),(9,1),(9,8),(10,1),(10,8),(11,2),(11,6),(12,4),(12,5),(13,3),(13,6),(14,1),(14,6),(15,1),(15,8),(16,3),(16,8),(17,1),(17,7),(18,2),(18,7),(19,1),(19,5),(20,4),(20,7),(21,2),(21,7),(22,3),(22,7),(23,1),(23,6),(24,4),(24,8),(25,3),(25,8),(26,2),(26,6),(27,4),(27,8),(28,4),(28,7),(29,3),(29,5),(30,4),(30,5),(31,3),(31,6),(32,3),(32,8),(33,2),(33,6),(34,2),(34,6),(35,3),(35,8),(36,4),(36,5),(37,3),(37,8),(38,1),(38,8),(39,1),(39,6),(40,2),(40,6),(41,4),(41,6),(42,2),(42,7),(43,4),(43,5),(44,1),(44,7),(45,2),(45,5),(46,2),(46,7),(47,3),(47,7),(48,4),(48,8),(49,1),(49,8),(50,3),(50,7),(51,4),(51,8);
/*!40000 ALTER TABLE `jb_jobs_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_jobs_translations`
--

DROP TABLE IF EXISTS `jb_jobs_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_jobs_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_jobs_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`jb_jobs_id`),
  KEY `idx_jb_jobs_trans_fk` (`jb_jobs_id`),
  KEY `idx_jb_jobs_trans_fk_lang` (`jb_jobs_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_jobs_translations`
--

LOCK TABLES `jb_jobs_translations` WRITE;
/*!40000 ALTER TABLE `jb_jobs_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_jobs_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_jobs_types`
--

DROP TABLE IF EXISTS `jb_jobs_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_jobs_types` (
  `job_id` bigint unsigned NOT NULL,
  `job_type_id` bigint unsigned NOT NULL,
  UNIQUE KEY `jb_jobs_types_unique` (`job_id`,`job_type_id`),
  KEY `jb_jobs_types_job_id_index` (`job_id`),
  KEY `jb_jobs_types_job_type_id_index` (`job_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_jobs_types`
--

LOCK TABLES `jb_jobs_types` WRITE;
/*!40000 ALTER TABLE `jb_jobs_types` DISABLE KEYS */;
INSERT INTO `jb_jobs_types` VALUES (1,5),(2,2),(3,1),(4,2),(5,2),(6,4),(7,1),(8,5),(9,2),(10,3),(11,3),(12,1),(13,2),(14,1),(15,2),(16,5),(17,4),(18,5),(19,2),(20,3),(21,1),(22,2),(23,4),(24,4),(25,2),(26,5),(27,4),(28,3),(29,3),(30,1),(31,1),(32,2),(33,4),(34,5),(35,4),(36,1),(37,5),(38,5),(39,1),(40,4),(41,2),(42,3),(43,3),(44,4),(45,2),(46,1),(47,4),(48,3),(49,4),(50,3),(51,3);
/*!40000 ALTER TABLE `jb_jobs_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_language_levels`
--

DROP TABLE IF EXISTS `jb_language_levels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_language_levels` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_language_levels`
--

LOCK TABLES `jb_language_levels` WRITE;
/*!40000 ALTER TABLE `jb_language_levels` DISABLE KEYS */;
INSERT INTO `jb_language_levels` VALUES (1,'Expert',0,0,'published','2025-12-23 19:31:27','2025-12-23 19:31:27'),(2,'Intermediate',0,0,'published','2025-12-23 19:31:27','2025-12-23 19:31:27'),(3,'Beginner',0,0,'published','2025-12-23 19:31:27','2025-12-23 19:31:27');
/*!40000 ALTER TABLE `jb_language_levels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_language_levels_translations`
--

DROP TABLE IF EXISTS `jb_language_levels_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_language_levels_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_language_levels_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_language_levels_id`),
  KEY `idx_jb_lang_lvl_trans_fk` (`jb_language_levels_id`),
  KEY `idx_jb_lang_lvl_trans_fk_lang` (`jb_language_levels_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_language_levels_translations`
--

LOCK TABLES `jb_language_levels_translations` WRITE;
/*!40000 ALTER TABLE `jb_language_levels_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_language_levels_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_major_subjects`
--

DROP TABLE IF EXISTS `jb_major_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_major_subjects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_major_subjects`
--

LOCK TABLES `jb_major_subjects` WRITE;
/*!40000 ALTER TABLE `jb_major_subjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_major_subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_packages`
--

DROP TABLE IF EXISTS `jb_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double unsigned NOT NULL,
  `currency_id` bigint unsigned NOT NULL,
  `percent_save` int unsigned DEFAULT '0',
  `number_of_listings` int unsigned NOT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `account_limit` int unsigned DEFAULT NULL,
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `features` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_packages`
--

LOCK TABLES `jb_packages` WRITE;
/*!40000 ALTER TABLE `jb_packages` DISABLE KEYS */;
INSERT INTO `jb_packages` VALUES (1,'Free Trial',0,1,0,1,1,1,0,'[[{\"key\":\"text\",\"value\":\"Limited time trial period\"}],[{\"key\":\"text\",\"value\":\"1 listing allowed\"}],[{\"key\":\"text\",\"value\":\"Basic support\"}]]','published','2025-12-23 19:31:31','2025-12-23 19:31:31',NULL),(2,'Basic Listing',250,1,0,1,2,5,1,'[[{\"key\":\"text\",\"value\":\"1 listing allowed\"}],[{\"key\":\"text\",\"value\":\"5 photos per listing\"}],[{\"key\":\"text\",\"value\":\"Basic support\"}]]','published','2025-12-23 19:31:31','2025-12-23 19:31:31',NULL),(3,'Standard Package',1000,1,20,5,3,10,0,'[[{\"key\":\"text\",\"value\":\"5 listings allowed\"}],[{\"key\":\"text\",\"value\":\"10 photos per listing\"}],[{\"key\":\"text\",\"value\":\"Priority support\"}]]','published','2025-12-23 19:31:31','2025-12-23 19:31:31',NULL),(4,'Professional Package',1800,1,28,10,4,15,0,'[[{\"key\":\"text\",\"value\":\"10 listings allowed\"}],[{\"key\":\"text\",\"value\":\"15 photos per listing\"}],[{\"key\":\"text\",\"value\":\"Premium support\"}],[{\"key\":\"text\",\"value\":\"Featured listings\"}]]','published','2025-12-23 19:31:31','2025-12-23 19:31:31',NULL),(5,'Premium Package',2500,1,33,15,5,20,0,'[[{\"key\":\"text\",\"value\":\"15 listings allowed\"}],[{\"key\":\"text\",\"value\":\"20 photos per listing\"}],[{\"key\":\"text\",\"value\":\"Premium support\"}],[{\"key\":\"text\",\"value\":\"Featured listings\"}],[{\"key\":\"text\",\"value\":\"Priority listing placement\"}]]','published','2025-12-23 19:31:31','2025-12-23 19:31:31',NULL);
/*!40000 ALTER TABLE `jb_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_packages_translations`
--

DROP TABLE IF EXISTS `jb_packages_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_packages_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_packages_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `features` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`jb_packages_id`),
  KEY `idx_jb_packages_trans_fk` (`jb_packages_id`),
  KEY `idx_jb_packages_trans_fk_lang` (`jb_packages_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_packages_translations`
--

LOCK TABLES `jb_packages_translations` WRITE;
/*!40000 ALTER TABLE `jb_packages_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_packages_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_reviews`
--

DROP TABLE IF EXISTS `jb_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_reviews` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `star` double NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reviewable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reviewable_id` bigint unsigned NOT NULL,
  `created_by_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reviews_unique` (`reviewable_id`,`reviewable_type`,`created_by_id`,`created_by_type`),
  KEY `jb_reviews_reviewable_type_reviewable_id_index` (`reviewable_type`,`reviewable_id`),
  KEY `jb_reviews_created_by_type_created_by_id_index` (`created_by_type`,`created_by_id`),
  KEY `jb_reviews_reviewable_id_reviewable_type_status_index` (`reviewable_id`,`reviewable_type`,`status`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_reviews`
--

LOCK TABLES `jb_reviews` WRITE;
/*!40000 ALTER TABLE `jb_reviews` DISABLE KEYS */;
INSERT INTO `jb_reviews` VALUES (1,4,'I Love this Script. I also found how to add other fees. Now I just wait the BIG update for the Marketplace with the Bulk Import. Just do not forget to make it to be Multi-language for us the Botble Fans.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',1,'Botble\\JobBoard\\Models\\Account',6),(2,1,'This web app is really good in design, code quality & features. Besides, the customer support provided by the Botble team was really fast & helpful. You guys are awesome!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',9,'Botble\\JobBoard\\Models\\Account',6),(3,1,'Ok good product. I have some issues in customizations. But its not correct to blame the developer. The product is good. Good luck for your business.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',11,'Botble\\JobBoard\\Models\\Account',3),(4,2,'Solution is too robust for our purpose so we didn\'t use it at the end. But I appreciate customer support during initial configuration.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',3,'Botble\\JobBoard\\Models\\Account',6),(5,1,'I Love this Script. I also found how to add other fees. Now I just wait the BIG update for the Marketplace with the Bulk Import. Just do not forget to make it to be Multi-language for us the Botble Fans.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',8,'Botble\\JobBoard\\Models\\Account',4),(6,5,'Those guys now what they are doing, the release such a good product that it\'s a pleasure to work with ! Even when I was stuck on the project, I created a ticket and the next day it was replied by the team. GOOD JOB guys. I love working with them :)','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',5,'Botble\\JobBoard\\Models\\Company',7),(7,2,'Clean & perfect source code','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',6,'Botble\\JobBoard\\Models\\Company',4),(8,5,'The code is good, in general, if you like it, can you give it 5 stars?','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',5,'Botble\\JobBoard\\Models\\Account',3),(9,3,'The code is good, in general, if you like it, can you give it 5 stars?','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',2,'Botble\\JobBoard\\Models\\Account',9),(10,4,'As a developer I reviewed this script. This is really awesome ecommerce script. I have convinced when I noticed that it\'s built on fully WordPress concept.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',3,'Botble\\JobBoard\\Models\\Company',8),(11,3,'We have received brilliant service support and will be expanding the features with the developer. Nice product!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',12,'Botble\\JobBoard\\Models\\Account',2),(12,2,'Second or third time that I buy a Botble product, happy with the products and support. You guys do a good job :)','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',1,'Botble\\JobBoard\\Models\\Company',12),(13,1,'The best store template! Excellent coding! Very good support! Thank you so much for all the help, I really appreciated.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',7,'Botble\\JobBoard\\Models\\Company',8),(14,5,'As a developer I reviewed this script. This is really awesome ecommerce script. I have convinced when I noticed that it\'s built on fully WordPress concept.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',1,'Botble\\JobBoard\\Models\\Account',2),(15,4,'For me the best eCommerce script on Envato at this moment: modern, clean code, a lot of great features. The customer support is great too: I always get an answer within hours!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',1,'Botble\\JobBoard\\Models\\Account',7),(16,4,'Great system, great support, good job Botble. I\'m looking forward to more great functional plugins.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',4,'Botble\\JobBoard\\Models\\Account',3),(17,2,'As a developer I reviewed this script. This is really awesome ecommerce script. I have convinced when I noticed that it\'s built on fully WordPress concept.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',5,'Botble\\JobBoard\\Models\\Account',10),(18,4,'Perfect +++++++++ i love it really also i get to fast ticket answers... Thanks Lot BOTBLE Teams','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',2,'Botble\\JobBoard\\Models\\Account',4),(19,1,'We have received brilliant service support and will be expanding the features with the developer. Nice product!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',14,'Botble\\JobBoard\\Models\\Account',6),(20,1,'These guys are amazing! Responses immediately, amazing support and help... I immediately feel at ease after Purchasing..','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',8,'Botble\\JobBoard\\Models\\Company',4),(21,4,'The script is the best of its class, fast, easy to implement and work with , and the most important thing is the great support team , Recommend with no doubt.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',6,'Botble\\JobBoard\\Models\\Company',3),(22,4,'It\'s not my first experience here on Codecanyon and I can honestly tell you all that Botble puts a LOT of effort into the support. They answer so fast, they helped me tons of times. REALLY by far THE BEST EXPERIENCE on Codecanyon. Those guys at Botble are so good that they deserve 5 stars. I recommend them, I trust them and I can\'t wait to see what they will sell in a near future. Thank you Botble :)','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',13,'Botble\\JobBoard\\Models\\Account',3),(23,4,'Ok good product. I have some issues in customizations. But its not correct to blame the developer. The product is good. Good luck for your business.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',8,'Botble\\JobBoard\\Models\\Company',15),(24,2,'This script is well coded and is super fast. The support is pretty quick. Very patient and helpful team. I strongly recommend it and they deserve more than 5 stars.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',4,'Botble\\JobBoard\\Models\\Company',1),(25,2,'Customer Support are grade (A*), however the code is a way too over engineered for it\'s purpose.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',12,'Botble\\JobBoard\\Models\\Account',9),(26,3,'Best ecommerce CMS online store!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',2,'Botble\\JobBoard\\Models\\Account',3),(28,1,'The best store template! Excellent coding! Very good support! Thank you so much for all the help, I really appreciated.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',10,'Botble\\JobBoard\\Models\\Company',2),(29,5,'Perfect +++++++++ i love it really also i get to fast ticket answers... Thanks Lot BOTBLE Teams','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',10,'Botble\\JobBoard\\Models\\Account',9),(30,4,'The code is good, in general, if you like it, can you give it 5 stars?','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',3,'Botble\\JobBoard\\Models\\Company',1),(31,3,'Cool template. Excellent code quality. The support responds very quickly, which is very rare on themeforest and codecanyon.net, I buy a lot of templates, and everyone will have a response from technical support for two or three days. Thanks to tech support. I recommend to buy.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',2,'Botble\\JobBoard\\Models\\Company',5),(32,1,'Amazing code, amazing support. Overall, im really confident in Botble and im happy I made the right choice! Thank you so much guys for coding this masterpiece','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',1,'Botble\\JobBoard\\Models\\Company',7),(33,4,'Customer Support are grade (A*), however the code is a way too over engineered for it\'s purpose.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',10,'Botble\\JobBoard\\Models\\Account',5),(34,2,'Ok good product. I have some issues in customizations. But its not correct to blame the developer. The product is good. Good luck for your business.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',3,'Botble\\JobBoard\\Models\\Company',14),(35,5,'As a developer I reviewed this script. This is really awesome ecommerce script. I have convinced when I noticed that it\'s built on fully WordPress concept.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',2,'Botble\\JobBoard\\Models\\Company',6),(36,5,'For me the best eCommerce script on Envato at this moment: modern, clean code, a lot of great features. The customer support is great too: I always get an answer within hours!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',8,'Botble\\JobBoard\\Models\\Account',5),(38,3,'Perfect +++++++++ i love it really also i get to fast ticket answers... Thanks Lot BOTBLE Teams','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',7,'Botble\\JobBoard\\Models\\Company',13),(39,4,'The script is the best of its class, fast, easy to implement and work with , and the most important thing is the great support team , Recommend with no doubt.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',2,'Botble\\JobBoard\\Models\\Account',6),(40,5,'Great E-commerce system. And much more : Wonderful Customer Support.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',6,'Botble\\JobBoard\\Models\\Company',12),(41,3,'It\'s not my first experience here on Codecanyon and I can honestly tell you all that Botble puts a LOT of effort into the support. They answer so fast, they helped me tons of times. REALLY by far THE BEST EXPERIENCE on Codecanyon. Those guys at Botble are so good that they deserve 5 stars. I recommend them, I trust them and I can\'t wait to see what they will sell in a near future. Thank you Botble :)','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',1,'Botble\\JobBoard\\Models\\Company',10),(42,3,'As a developer I reviewed this script. This is really awesome ecommerce script. I have convinced when I noticed that it\'s built on fully WordPress concept.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',5,'Botble\\JobBoard\\Models\\Account',8),(45,3,'Great system, great support, good job Botble. I\'m looking forward to more great functional plugins.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',4,'Botble\\JobBoard\\Models\\Account',7),(46,1,'These guys are amazing! Responses immediately, amazing support and help... I immediately feel at ease after Purchasing..','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',13,'Botble\\JobBoard\\Models\\Account',1),(47,4,'Those guys now what they are doing, the release such a good product that it\'s a pleasure to work with ! Even when I was stuck on the project, I created a ticket and the next day it was replied by the team. GOOD JOB guys. I love working with them :)','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',1,'Botble\\JobBoard\\Models\\Account',10),(49,4,'Customer Support are grade (A*), however the code is a way too over engineered for it\'s purpose.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',8,'Botble\\JobBoard\\Models\\Company',1),(50,1,'This web app is really good in design, code quality & features. Besides, the customer support provided by the Botble team was really fast & helpful. You guys are awesome!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',4,'Botble\\JobBoard\\Models\\Company',3),(51,4,'Solution is too robust for our purpose so we didn\'t use it at the end. But I appreciate customer support during initial configuration.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',15,'Botble\\JobBoard\\Models\\Account',1),(52,2,'Solution is too robust for our purpose so we didn\'t use it at the end. But I appreciate customer support during initial configuration.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',9,'Botble\\JobBoard\\Models\\Company',16),(53,5,'This web app is really good in design, code quality & features. Besides, the customer support provided by the Botble team was really fast & helpful. You guys are awesome!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',5,'Botble\\JobBoard\\Models\\Company',8),(54,4,'Best ecommerce CMS online store!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',10,'Botble\\JobBoard\\Models\\Company',9),(55,3,'I Love this Script. I also found how to add other fees. Now I just wait the BIG update for the Marketplace with the Bulk Import. Just do not forget to make it to be Multi-language for us the Botble Fans.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',4,'Botble\\JobBoard\\Models\\Company',6),(56,2,'Solution is too robust for our purpose so we didn\'t use it at the end. But I appreciate customer support during initial configuration.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',11,'Botble\\JobBoard\\Models\\Account',2),(57,5,'The best store template! Excellent coding! Very good support! Thank you so much for all the help, I really appreciated.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',3,'Botble\\JobBoard\\Models\\Company',4),(58,3,'Solution is too robust for our purpose so we didn\'t use it at the end. But I appreciate customer support during initial configuration.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',1,'Botble\\JobBoard\\Models\\Account',8),(60,3,'Amazing code, amazing support. Overall, im really confident in Botble and im happy I made the right choice! Thank you so much guys for coding this masterpiece','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',7,'Botble\\JobBoard\\Models\\Company',6),(61,2,'These guys are amazing! Responses immediately, amazing support and help... I immediately feel at ease after Purchasing..','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',10,'Botble\\JobBoard\\Models\\Account',1),(62,1,'Good app, good backup service and support. Good documentation.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',2,'Botble\\JobBoard\\Models\\Company',16),(63,1,'These guys are amazing! Responses immediately, amazing support and help... I immediately feel at ease after Purchasing..','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',13,'Botble\\JobBoard\\Models\\Account',10),(64,3,'These guys are amazing! Responses immediately, amazing support and help... I immediately feel at ease after Purchasing..','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',7,'Botble\\JobBoard\\Models\\Company',3),(67,5,'As a developer I reviewed this script. This is really awesome ecommerce script. I have convinced when I noticed that it\'s built on fully WordPress concept.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',16,'Botble\\JobBoard\\Models\\Account',7),(69,3,'This script is well coded and is super fast. The support is pretty quick. Very patient and helpful team. I strongly recommend it and they deserve more than 5 stars.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',12,'Botble\\JobBoard\\Models\\Account',6),(70,1,'We have received brilliant service support and will be expanding the features with the developer. Nice product!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',7,'Botble\\JobBoard\\Models\\Company',14),(71,5,'The script is the best of its class, fast, easy to implement and work with , and the most important thing is the great support team , Recommend with no doubt.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',8,'Botble\\JobBoard\\Models\\Account',8),(72,1,'Very enthusiastic support! Excellent code is written. It\'s a true pleasure working with.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',10,'Botble\\JobBoard\\Models\\Company',5),(73,5,'Great system, great support, good job Botble. I\'m looking forward to more great functional plugins.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',12,'Botble\\JobBoard\\Models\\Account',1),(74,2,'Cool template. Excellent code quality. The support responds very quickly, which is very rare on themeforest and codecanyon.net, I buy a lot of templates, and everyone will have a response from technical support for two or three days. Thanks to tech support. I recommend to buy.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',8,'Botble\\JobBoard\\Models\\Company',7),(75,3,'We have received brilliant service support and will be expanding the features with the developer. Nice product!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',8,'Botble\\JobBoard\\Models\\Company',10),(76,4,'Great system, great support, good job Botble. I\'m looking forward to more great functional plugins.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',3,'Botble\\JobBoard\\Models\\Company',16),(77,3,'The best ecommerce CMS! Excellent coding! best support service! Thank you so much..... I really like your hard work.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',5,'Botble\\JobBoard\\Models\\Company',1),(78,2,'Cool template. Excellent code quality. The support responds very quickly, which is very rare on themeforest and codecanyon.net, I buy a lot of templates, and everyone will have a response from technical support for two or three days. Thanks to tech support. I recommend to buy.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',3,'Botble\\JobBoard\\Models\\Company',2),(79,5,'Ok good product. I have some issues in customizations. But its not correct to blame the developer. The product is good. Good luck for your business.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',4,'Botble\\JobBoard\\Models\\Company',13),(82,1,'Best ecommerce CMS online store!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',8,'Botble\\JobBoard\\Models\\Company',11),(84,4,'Perfect +++++++++ i love it really also i get to fast ticket answers... Thanks Lot BOTBLE Teams','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',9,'Botble\\JobBoard\\Models\\Company',1),(87,1,'Those guys now what they are doing, the release such a good product that it\'s a pleasure to work with ! Even when I was stuck on the project, I created a ticket and the next day it was replied by the team. GOOD JOB guys. I love working with them :)','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',9,'Botble\\JobBoard\\Models\\Company',14),(88,2,'This web app is really good in design, code quality & features. Besides, the customer support provided by the Botble team was really fast & helpful. You guys are awesome!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',5,'Botble\\JobBoard\\Models\\Company',2),(89,4,'Great system, great support, good job Botble. I\'m looking forward to more great functional plugins.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',2,'Botble\\JobBoard\\Models\\Company',8),(92,4,'Clean & perfect source code','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',9,'Botble\\JobBoard\\Models\\Account',10),(93,4,'As a developer I reviewed this script. This is really awesome ecommerce script. I have convinced when I noticed that it\'s built on fully WordPress concept.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',1,'Botble\\JobBoard\\Models\\Company',5),(94,1,'Amazing code, amazing support. Overall, im really confident in Botble and im happy I made the right choice! Thank you so much guys for coding this masterpiece','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',9,'Botble\\JobBoard\\Models\\Account',3),(95,5,'Great system, great support, good job Botble. I\'m looking forward to more great functional plugins.','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',2,'Botble\\JobBoard\\Models\\Company',3),(96,4,'These guys are amazing! Responses immediately, amazing support and help... I immediately feel at ease after Purchasing..','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',3,'Botble\\JobBoard\\Models\\Account',8),(98,2,'For me the best eCommerce script on Envato at this moment: modern, clean code, a lot of great features. The customer support is great too: I always get an answer within hours!','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Company',11,'Botble\\JobBoard\\Models\\Account',9),(100,1,'The code is good, in general, if you like it, can you give it 5 stars?','published','2025-12-23 19:31:31','2025-12-23 19:31:31','Botble\\JobBoard\\Models\\Account',3,'Botble\\JobBoard\\Models\\Company',12);
/*!40000 ALTER TABLE `jb_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_saved_jobs`
--

DROP TABLE IF EXISTS `jb_saved_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_saved_jobs` (
  `account_id` bigint unsigned NOT NULL,
  `job_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`account_id`,`job_id`),
  KEY `jb_saved_jobs_job_id_index` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_saved_jobs`
--

LOCK TABLES `jb_saved_jobs` WRITE;
/*!40000 ALTER TABLE `jb_saved_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_saved_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_tags`
--

DROP TABLE IF EXISTS `jb_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_tags`
--

LOCK TABLES `jb_tags` WRITE;
/*!40000 ALTER TABLE `jb_tags` DISABLE KEYS */;
INSERT INTO `jb_tags` VALUES (1,'Illustrator','','published','2025-12-23 19:31:27','2025-12-23 19:31:27'),(2,'Adobe XD','','published','2025-12-23 19:31:27','2025-12-23 19:31:27'),(3,'Figma','','published','2025-12-23 19:31:27','2025-12-23 19:31:27'),(4,'Sketch','','published','2025-12-23 19:31:27','2025-12-23 19:31:27'),(5,'Lunacy','','published','2025-12-23 19:31:27','2025-12-23 19:31:27'),(6,'PHP','','published','2025-12-23 19:31:27','2025-12-23 19:31:27'),(7,'Python','','published','2025-12-23 19:31:27','2025-12-23 19:31:27'),(8,'JavaScript','','published','2025-12-23 19:31:27','2025-12-23 19:31:27');
/*!40000 ALTER TABLE `jb_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_tags_translations`
--

DROP TABLE IF EXISTS `jb_tags_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_tags_translations` (
  `lang_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jb_tags_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`jb_tags_id`),
  KEY `idx_jb_tags_trans_fk` (`jb_tags_id`),
  KEY `idx_jb_tags_trans_fk_lang` (`jb_tags_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_tags_translations`
--

LOCK TABLES `jb_tags_translations` WRITE;
/*!40000 ALTER TABLE `jb_tags_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_tags_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jb_transactions`
--

DROP TABLE IF EXISTS `jb_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jb_transactions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `credits` int unsigned NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `account_id` bigint unsigned DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'add',
  `payment_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jb_transactions_account_id_index` (`account_id`),
  KEY `jb_transactions_user_id_index` (`user_id`),
  KEY `jb_transactions_payment_id_index` (`payment_id`),
  KEY `jb_transactions_created_at_index` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_transactions`
--

LOCK TABLES `jb_transactions` WRITE;
/*!40000 ALTER TABLE `jb_transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `jb_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
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
-- Table structure for table `language_meta`
--

DROP TABLE IF EXISTS `language_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `language_meta` (
  `lang_meta_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang_meta_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_meta_origin` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`lang_meta_id`),
  KEY `language_meta_reference_id_index` (`reference_id`),
  KEY `meta_code_index` (`lang_meta_code`),
  KEY `meta_origin_index` (`lang_meta_origin`),
  KEY `meta_reference_type_index` (`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `language_meta`
--

LOCK TABLES `language_meta` WRITE;
/*!40000 ALTER TABLE `language_meta` DISABLE KEYS */;
INSERT INTO `language_meta` VALUES (1,'en_US','d9d08e1529bb5ce1d64f53ed970f99d9',1,'Botble\\Menu\\Models\\MenuLocation'),(2,'en_US','9a4cc1685c9aa5f9844e349a8c00af66',1,'Botble\\Menu\\Models\\Menu'),(3,'en_US','cb170bed02a26b64161c0bb1d6011b11',2,'Botble\\Menu\\Models\\Menu'),(4,'en_US','ee751e5cdb154ed978bfd8e5909c0cce',3,'Botble\\Menu\\Models\\Menu'),(5,'en_US','7858b30356a16370042442c270cc5c12',4,'Botble\\Menu\\Models\\Menu'),(6,'en_US','b34912f88d038cdc42443a1d0c3d914c',5,'Botble\\Menu\\Models\\Menu');
/*!40000 ALTER TABLE `language_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `languages` (
  `lang_id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `lang_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_locale` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang_flag` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang_is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `lang_order` int NOT NULL DEFAULT '0',
  `lang_is_rtl` tinyint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  KEY `lang_locale_index` (`lang_locale`),
  KEY `lang_code_index` (`lang_code`),
  KEY `lang_is_default_index` (`lang_is_default`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `languages`
--

LOCK TABLES `languages` WRITE;
/*!40000 ALTER TABLE `languages` DISABLE KEYS */;
INSERT INTO `languages` VALUES (1,'English','en','en_US','us',1,0,0);
/*!40000 ALTER TABLE `languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_files`
--

DROP TABLE IF EXISTS `media_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `folder_id` bigint unsigned NOT NULL DEFAULT '0',
  `mime_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` int NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `visibility` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  PRIMARY KEY (`id`),
  KEY `media_files_user_id_index` (`user_id`),
  KEY `media_files_index` (`folder_id`,`user_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_files`
--

LOCK TABLES `media_files` WRITE;
/*!40000 ALTER TABLE `media_files` DISABLE KEYS */;
INSERT INTO `media_files` VALUES (1,0,'1','1',3,'image/jpeg',9803,'themes/jobcy/news/1.jpg','[]','2025-12-23 19:31:22','2025-12-23 19:31:22',NULL,'public'),(2,0,'10','10',3,'image/jpeg',9803,'themes/jobcy/news/10.jpg','[]','2025-12-23 19:31:22','2025-12-23 19:31:22',NULL,'public'),(3,0,'11','11',3,'image/jpeg',9803,'themes/jobcy/news/11.jpg','[]','2025-12-23 19:31:22','2025-12-23 19:31:22',NULL,'public'),(4,0,'12','12',3,'image/jpeg',9803,'themes/jobcy/news/12.jpg','[]','2025-12-23 19:31:22','2025-12-23 19:31:22',NULL,'public'),(5,0,'13','13',3,'image/jpeg',9803,'themes/jobcy/news/13.jpg','[]','2025-12-23 19:31:22','2025-12-23 19:31:22',NULL,'public'),(6,0,'14','14',3,'image/jpeg',9803,'themes/jobcy/news/14.jpg','[]','2025-12-23 19:31:23','2025-12-23 19:31:23',NULL,'public'),(7,0,'15','15',3,'image/jpeg',9803,'themes/jobcy/news/15.jpg','[]','2025-12-23 19:31:23','2025-12-23 19:31:23',NULL,'public'),(8,0,'16','16',3,'image/jpeg',9803,'themes/jobcy/news/16.jpg','[]','2025-12-23 19:31:23','2025-12-23 19:31:23',NULL,'public'),(9,0,'2','2',3,'image/jpeg',9803,'themes/jobcy/news/2.jpg','[]','2025-12-23 19:31:23','2025-12-23 19:31:23',NULL,'public'),(10,0,'3','3',3,'image/jpeg',9803,'themes/jobcy/news/3.jpg','[]','2025-12-23 19:31:23','2025-12-23 19:31:23',NULL,'public'),(11,0,'4','4',3,'image/jpeg',9803,'themes/jobcy/news/4.jpg','[]','2025-12-23 19:31:23','2025-12-23 19:31:23',NULL,'public'),(12,0,'5','5',3,'image/jpeg',9803,'themes/jobcy/news/5.jpg','[]','2025-12-23 19:31:23','2025-12-23 19:31:23',NULL,'public'),(13,0,'6','6',3,'image/jpeg',9803,'themes/jobcy/news/6.jpg','[]','2025-12-23 19:31:23','2025-12-23 19:31:23',NULL,'public'),(14,0,'7','7',3,'image/jpeg',9803,'themes/jobcy/news/7.jpg','[]','2025-12-23 19:31:23','2025-12-23 19:31:23',NULL,'public'),(15,0,'8','8',3,'image/jpeg',9803,'themes/jobcy/news/8.jpg','[]','2025-12-23 19:31:23','2025-12-23 19:31:23',NULL,'public'),(16,0,'9','9',3,'image/jpeg',9803,'themes/jobcy/news/9.jpg','[]','2025-12-23 19:31:23','2025-12-23 19:31:23',NULL,'public'),(17,0,'404','404',4,'image/png',10947,'themes/jobcy/general/404.png','[]','2025-12-23 19:31:23','2025-12-23 19:31:23',NULL,'public'),(18,0,'animat-rocket-color','animat-rocket-color',4,'image/gif',77617,'themes/jobcy/general/animat-rocket-color.gif','[]','2025-12-23 19:31:24','2025-12-23 19:31:24',NULL,'public'),(19,0,'contact','contact',4,'image/png',15234,'themes/jobcy/general/contact.png','[]','2025-12-23 19:31:24','2025-12-23 19:31:24',NULL,'public'),(20,0,'cover-image','cover-image',4,'image/jpeg',9890,'themes/jobcy/general/cover-image.jpg','[]','2025-12-23 19:31:24','2025-12-23 19:31:24',NULL,'public'),(21,0,'favicon','favicon',4,'image/png',3533,'themes/jobcy/general/favicon.png','[]','2025-12-23 19:31:24','2025-12-23 19:31:24',NULL,'public'),(22,0,'how-it-work-1','how-it-work-1',4,'image/png',12702,'themes/jobcy/general/how-it-work-1.png','[]','2025-12-23 19:31:24','2025-12-23 19:31:24',NULL,'public'),(23,0,'how-it-work-2','how-it-work-2',4,'image/png',12702,'themes/jobcy/general/how-it-work-2.png','[]','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL,'public'),(24,0,'how-it-work-3','how-it-work-3',4,'image/png',12702,'themes/jobcy/general/how-it-work-3.png','[]','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL,'public'),(25,0,'img-01','img-01',4,'image/png',36217,'themes/jobcy/general/img-01.png','[]','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL,'public'),(26,0,'img-02','img-02',4,'image/jpeg',23618,'themes/jobcy/general/img-02.jpg','[]','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL,'public'),(27,0,'img-03','img-03',4,'image/jpeg',22439,'themes/jobcy/general/img-03.jpg','[]','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL,'public'),(28,0,'img-04','img-04',4,'image/jpeg',22517,'themes/jobcy/general/img-04.jpg','[]','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL,'public'),(29,0,'logo-light','logo-light',4,'image/png',2695,'themes/jobcy/general/logo-light.png','[]','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL,'public'),(30,0,'logo','logo',4,'image/png',2941,'themes/jobcy/general/logo.png','[]','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL,'public'),(31,0,'newsletter-image','newsletter-image',4,'image/png',8926,'themes/jobcy/general/newsletter-image.png','[]','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL,'public'),(32,0,'process-02','process-02',4,'image/png',12702,'themes/jobcy/general/process-02.png','[]','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL,'public'),(33,0,'1','1',5,'image/png',9803,'themes/jobcy/job-categories/1.png','[]','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL,'public'),(34,0,'2','2',5,'image/png',9803,'themes/jobcy/job-categories/2.png','[]','2025-12-23 19:31:25','2025-12-23 19:31:25',NULL,'public'),(35,0,'3','3',5,'image/png',9803,'themes/jobcy/job-categories/3.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(36,0,'4','4',5,'image/png',9803,'themes/jobcy/job-categories/4.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(37,0,'5','5',5,'image/png',9803,'themes/jobcy/job-categories/5.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(38,0,'6','6',5,'image/png',9803,'themes/jobcy/job-categories/6.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(39,0,'7','7',5,'image/png',9803,'themes/jobcy/job-categories/7.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(40,0,'8','8',5,'image/png',9803,'themes/jobcy/job-categories/8.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(41,0,'1','1',6,'image/png',546,'themes/jobcy/companies/1.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(42,0,'10','10',6,'image/png',546,'themes/jobcy/companies/10.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(43,0,'11','11',6,'image/png',546,'themes/jobcy/companies/11.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(44,0,'12','12',6,'image/png',546,'themes/jobcy/companies/12.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(45,0,'13','13',6,'image/png',546,'themes/jobcy/companies/13.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(46,0,'14','14',6,'image/png',546,'themes/jobcy/companies/14.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(47,0,'15','15',6,'image/png',546,'themes/jobcy/companies/15.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(48,0,'16','16',6,'image/png',546,'themes/jobcy/companies/16.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(49,0,'17','17',6,'image/png',546,'themes/jobcy/companies/17.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(50,0,'2','2',6,'image/png',546,'themes/jobcy/companies/2.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(51,0,'3','3',6,'image/png',546,'themes/jobcy/companies/3.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(52,0,'4','4',6,'image/png',546,'themes/jobcy/companies/4.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(53,0,'5','5',6,'image/png',546,'themes/jobcy/companies/5.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(54,0,'6','6',6,'image/png',546,'themes/jobcy/companies/6.png','[]','2025-12-23 19:31:26','2025-12-23 19:31:26',NULL,'public'),(55,0,'7','7',6,'image/png',546,'themes/jobcy/companies/7.png','[]','2025-12-23 19:31:27','2025-12-23 19:31:27',NULL,'public'),(56,0,'8','8',6,'image/png',546,'themes/jobcy/companies/8.png','[]','2025-12-23 19:31:27','2025-12-23 19:31:27',NULL,'public'),(57,0,'9','9',6,'image/png',546,'themes/jobcy/companies/9.png','[]','2025-12-23 19:31:27','2025-12-23 19:31:27',NULL,'public'),(58,0,'01','01',7,'application/pdf',43496,'themes/jobcy/resume/01.pdf','[]','2025-12-23 19:31:27','2025-12-23 19:31:27',NULL,'public'),(59,0,'1','1',8,'image/jpeg',9803,'themes/jobcy/accounts/1.jpg','[]','2025-12-23 19:31:27','2025-12-23 19:31:27',NULL,'public'),(60,0,'2','2',8,'image/jpeg',9803,'themes/jobcy/accounts/2.jpg','[]','2025-12-23 19:31:27','2025-12-23 19:31:27',NULL,'public'),(61,0,'3','3',8,'image/jpeg',9803,'themes/jobcy/accounts/3.jpg','[]','2025-12-23 19:31:28','2025-12-23 19:31:28',NULL,'public'),(62,0,'4','4',8,'image/jpeg',9803,'themes/jobcy/accounts/4.jpg','[]','2025-12-23 19:31:28','2025-12-23 19:31:28',NULL,'public'),(63,0,'5','5',8,'image/jpeg',9803,'themes/jobcy/accounts/5.jpg','[]','2025-12-23 19:31:28','2025-12-23 19:31:28',NULL,'public'),(64,0,'cover1','cover1',8,'image/png',9803,'themes/jobcy/accounts/cover1.png','[]','2025-12-23 19:31:28','2025-12-23 19:31:28',NULL,'public'),(65,0,'cover2','cover2',8,'image/png',9803,'themes/jobcy/accounts/cover2.png','[]','2025-12-23 19:31:28','2025-12-23 19:31:28',NULL,'public'),(66,0,'cover3','cover3',8,'image/png',9803,'themes/jobcy/accounts/cover3.png','[]','2025-12-23 19:31:28','2025-12-23 19:31:28',NULL,'public'),(67,0,'1','1',9,'image/png',9803,'themes/jobcy/testimonials/1.png','[]','2025-12-23 19:31:31','2025-12-23 19:31:31',NULL,'public'),(68,0,'2','2',9,'image/png',9803,'themes/jobcy/testimonials/2.png','[]','2025-12-23 19:31:31','2025-12-23 19:31:31',NULL,'public'),(69,0,'3','3',9,'image/png',9803,'themes/jobcy/testimonials/3.png','[]','2025-12-23 19:31:31','2025-12-23 19:31:31',NULL,'public');
/*!40000 ALTER TABLE `media_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_folders`
--

DROP TABLE IF EXISTS `media_folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_folders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_folders_user_id_index` (`user_id`),
  KEY `media_folders_index` (`parent_id`,`user_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_folders`
--

LOCK TABLES `media_folders` WRITE;
/*!40000 ALTER TABLE `media_folders` DISABLE KEYS */;
INSERT INTO `media_folders` VALUES (1,0,'themes',NULL,'themes',0,'2025-12-23 19:31:22','2025-12-23 19:31:22',NULL),(2,0,'jobcy',NULL,'jobcy',1,'2025-12-23 19:31:22','2025-12-23 19:31:22',NULL),(3,0,'news',NULL,'news',2,'2025-12-23 19:31:22','2025-12-23 19:31:22',NULL),(4,0,'general',NULL,'general',2,'2025-12-23 19:31:23','2025-12-23 19:31:23',NULL),(5,0,'job-categories',NULL,'job-categories',2,'2025-12-23 19:31:25','2025-12-23 19:31:25',NULL),(6,0,'companies',NULL,'companies',2,'2025-12-23 19:31:26','2025-12-23 19:31:26',NULL),(7,0,'resume',NULL,'resume',2,'2025-12-23 19:31:27','2025-12-23 19:31:27',NULL),(8,0,'accounts',NULL,'accounts',2,'2025-12-23 19:31:27','2025-12-23 19:31:27',NULL),(9,0,'testimonials',NULL,'testimonials',2,'2025-12-23 19:31:31','2025-12-23 19:31:31',NULL);
/*!40000 ALTER TABLE `media_folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_settings`
--

DROP TABLE IF EXISTS `media_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `media_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_settings`
--

LOCK TABLES `media_settings` WRITE;
/*!40000 ALTER TABLE `media_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `media_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_locations`
--

DROP TABLE IF EXISTS `menu_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_locations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_locations_menu_id_created_at_index` (`menu_id`,`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_locations`
--

LOCK TABLES `menu_locations` WRITE;
/*!40000 ALTER TABLE `menu_locations` DISABLE KEYS */;
INSERT INTO `menu_locations` VALUES (1,1,'main-menu','2025-12-23 19:31:31','2025-12-23 19:31:31');
/*!40000 ALTER TABLE `menu_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_nodes`
--

DROP TABLE IF EXISTS `menu_nodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_nodes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `parent_id` bigint unsigned NOT NULL DEFAULT '0',
  `reference_id` bigint unsigned DEFAULT NULL,
  `reference_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_font` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` tinyint unsigned NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `css_class` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `has_child` tinyint unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_nodes_menu_id_index` (`menu_id`),
  KEY `menu_nodes_parent_id_index` (`parent_id`),
  KEY `reference_id` (`reference_id`),
  KEY `reference_type` (`reference_type`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_nodes`
--

LOCK TABLES `menu_nodes` WRITE;
/*!40000 ALTER TABLE `menu_nodes` DISABLE KEYS */;
INSERT INTO `menu_nodes` VALUES (1,1,0,NULL,NULL,'/',NULL,0,'Home',NULL,'_self',1,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(2,1,1,NULL,NULL,'/',NULL,0,'Homepage',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(3,1,1,13,'Botble\\Page\\Models\\Page','/homepage-2',NULL,1,'Homepage 2',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(4,1,1,14,'Botble\\Page\\Models\\Page','/homepage-3',NULL,2,'Homepage 3',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(5,1,0,NULL,NULL,'/jobs',NULL,1,'Jobs',NULL,'_self',1,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(6,1,5,NULL,NULL,'/jobs',NULL,0,'Jobs',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(7,1,5,NULL,NULL,'/jobs/ui-ux-designer-full-time',NULL,1,'Job Detail',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(8,1,5,NULL,NULL,'/jobs/full-stack-engineer',NULL,2,'Job External',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(9,1,5,NULL,NULL,'/jobs/java-software-engineer',NULL,3,'Job Hide Company',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(10,1,0,10,'Botble\\Page\\Models\\Page','/job-categories',NULL,2,'Categories',NULL,'_self',1,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(11,1,10,10,'Botble\\Page\\Models\\Page','/job-categories',NULL,0,'Categories',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(12,1,10,1,'Botble\\JobBoard\\Models\\Category','/job-categories/it-software',NULL,1,'Category Detail',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(13,1,0,NULL,NULL,'#',NULL,3,'Pages',NULL,'_self',1,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(14,1,13,11,'Botble\\Page\\Models\\Page','/companies',NULL,0,'Companies',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(15,1,13,NULL,NULL,'/companies/pinterest',NULL,1,'Company Detail',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(16,1,13,15,'Botble\\Page\\Models\\Page','/candidates-grid',NULL,2,'Candidates Grid',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(17,1,13,16,'Botble\\Page\\Models\\Page','/candidates-list',NULL,3,'Candidates List',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(18,1,13,NULL,NULL,'/candidates/annetta',NULL,4,'Candidates Details',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(19,1,13,8,'Botble\\Page\\Models\\Page','/terms-of-use',NULL,5,'Terms Of Use',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(20,1,13,9,'Botble\\Page\\Models\\Page','/terms-conditions',NULL,6,'Terms & Conditions',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(21,1,13,5,'Botble\\Page\\Models\\Page','/faq',NULL,7,'FAQ',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(22,1,13,4,'Botble\\Page\\Models\\Page','/cookie-policy',NULL,8,'Cookie Policy',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(23,1,13,12,'Botble\\Page\\Models\\Page','/coming-soon',NULL,9,'Coming Soon',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(24,1,0,2,'Botble\\Page\\Models\\Page','/blog',NULL,4,'Blog',NULL,'_self',1,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(25,1,24,2,'Botble\\Page\\Models\\Page','/blog',NULL,0,'Blog',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(26,1,24,NULL,NULL,'/blog/the-top-2020-handbag-trends-to-know',NULL,1,'Post Detail',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(27,1,0,3,'Botble\\Page\\Models\\Page','/contact',NULL,5,'Contact',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(28,2,0,6,'Botble\\Page\\Models\\Page','/about-us',NULL,0,'About Us',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(29,2,0,3,'Botble\\Page\\Models\\Page','/contact',NULL,1,'Contact Us',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(30,2,0,7,'Botble\\Page\\Models\\Page','/services',NULL,2,'Services',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(31,2,0,2,'Botble\\Page\\Models\\Page','/blog',NULL,3,'Blog',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(32,3,0,10,'Botble\\Page\\Models\\Page','/job-categories',NULL,0,'Browse Categories',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(33,3,0,NULL,NULL,'/jobs',NULL,1,'Browse Jobs',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(34,3,0,NULL,NULL,'/jobs/ui-ux-designer-full-time',NULL,2,'Job Details',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(35,3,0,NULL,NULL,'/jobs/saved-jobs',NULL,3,'Saved Jobs',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(36,3,0,NULL,NULL,'/jobs/full-stack-engineer',NULL,4,'Job External',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(37,3,0,NULL,NULL,'/jobs/java-software-engineer',NULL,5,'Job Hide Company',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(38,4,0,15,'Botble\\Page\\Models\\Page','/candidates-grid',NULL,0,'Candidates List',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(39,4,0,16,'Botble\\Page\\Models\\Page','/candidates-list',NULL,1,'Candidates Grid',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(40,4,0,NULL,NULL,'/candidates/annetta',NULL,2,'Candidates Details',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(41,5,0,8,'Botble\\Page\\Models\\Page','/terms-of-use',NULL,0,'Terms Of Use',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(42,5,0,9,'Botble\\Page\\Models\\Page','/terms-conditions',NULL,1,'Terms & Conditions',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(43,5,0,5,'Botble\\Page\\Models\\Page','/faq',NULL,2,'FAQ',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(44,5,0,4,'Botble\\Page\\Models\\Page','/cookie-policy',NULL,3,'Cookie Policy',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31'),(45,5,0,12,'Botble\\Page\\Models\\Page','/coming-soon',NULL,4,'Coming Soon',NULL,'_self',0,'2025-12-23 19:31:31','2025-12-23 19:31:31');
/*!40000 ALTER TABLE `menu_nodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Main menu','main-menu','published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(2,'Company','company','published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(3,'For Jobs','for-jobs','published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(4,'For Candidates','for-candidates','published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(5,'Support','support','published','2025-12-23 19:31:31','2025-12-23 19:31:31');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta_boxes`
--

DROP TABLE IF EXISTS `meta_boxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meta_boxes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meta_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_value` text COLLATE utf8mb4_unicode_ci,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meta_boxes_reference_id_index` (`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta_boxes`
--

LOCK TABLES `meta_boxes` WRITE;
/*!40000 ALTER TABLE `meta_boxes` DISABLE KEYS */;
INSERT INTO `meta_boxes` VALUES (1,'icon_image','[\"themes\\/jobcy\\/job-categories\\/1.png\"]',1,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:26','2025-12-23 19:31:26'),(2,'icon_image','[\"themes\\/jobcy\\/job-categories\\/2.png\"]',2,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:26','2025-12-23 19:31:26'),(3,'icon_image','[\"themes\\/jobcy\\/job-categories\\/3.png\"]',3,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:26','2025-12-23 19:31:26'),(4,'icon_image','[\"themes\\/jobcy\\/job-categories\\/4.png\"]',4,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:26','2025-12-23 19:31:26'),(5,'icon_image','[\"themes\\/jobcy\\/job-categories\\/5.png\"]',5,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:26','2025-12-23 19:31:26'),(6,'icon_image','[\"themes\\/jobcy\\/job-categories\\/6.png\"]',6,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:26','2025-12-23 19:31:26'),(7,'icon_image','[\"themes\\/jobcy\\/job-categories\\/7.png\"]',7,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:26','2025-12-23 19:31:26'),(8,'icon_image','[\"themes\\/jobcy\\/job-categories\\/8.png\"]',8,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:26','2025-12-23 19:31:26'),(9,'featured_image','[\"themes\\/jobcy\\/jobs\\/img1.png\"]',1,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(10,'featured_image','[\"themes\\/jobcy\\/jobs\\/img2.png\"]',2,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(11,'featured_image','[\"themes\\/jobcy\\/jobs\\/img3.png\"]',3,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(12,'featured_image','[\"themes\\/jobcy\\/jobs\\/img4.png\"]',4,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(13,'featured_image','[\"themes\\/jobcy\\/jobs\\/img5.png\"]',5,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(14,'featured_image','[\"themes\\/jobcy\\/jobs\\/img6.png\"]',6,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(15,'featured_image','[\"themes\\/jobcy\\/jobs\\/img7.png\"]',7,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(16,'featured_image','[\"themes\\/jobcy\\/jobs\\/img8.png\"]',8,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(17,'featured_image','[\"themes\\/jobcy\\/jobs\\/img9.png\"]',9,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(18,'featured_image','[\"themes\\/jobcy\\/jobs\\/img9.png\"]',10,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(19,'featured_image','[\"themes\\/jobcy\\/jobs\\/img9.png\"]',11,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(20,'featured_image','[\"themes\\/jobcy\\/jobs\\/img3.png\"]',12,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(21,'featured_image','[\"themes\\/jobcy\\/jobs\\/img2.png\"]',13,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(22,'featured_image','[\"themes\\/jobcy\\/jobs\\/img1.png\"]',14,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(23,'featured_image','[\"themes\\/jobcy\\/jobs\\/img5.png\"]',15,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(24,'featured_image','[\"themes\\/jobcy\\/jobs\\/img8.png\"]',16,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(25,'featured_image','[\"themes\\/jobcy\\/jobs\\/img6.png\"]',17,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(26,'featured_image','[\"themes\\/jobcy\\/jobs\\/img3.png\"]',18,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(27,'featured_image','[\"themes\\/jobcy\\/jobs\\/img3.png\"]',19,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(28,'featured_image','[\"themes\\/jobcy\\/jobs\\/img6.png\"]',20,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(29,'featured_image','[\"themes\\/jobcy\\/jobs\\/img8.png\"]',21,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(30,'featured_image','[\"themes\\/jobcy\\/jobs\\/img4.png\"]',22,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(31,'featured_image','[\"themes\\/jobcy\\/jobs\\/img1.png\"]',23,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(32,'featured_image','[\"themes\\/jobcy\\/jobs\\/img2.png\"]',24,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(33,'featured_image','[\"themes\\/jobcy\\/jobs\\/img9.png\"]',25,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(34,'featured_image','[\"themes\\/jobcy\\/jobs\\/img4.png\"]',26,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(35,'featured_image','[\"themes\\/jobcy\\/jobs\\/img7.png\"]',27,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(36,'featured_image','[\"themes\\/jobcy\\/jobs\\/img5.png\"]',28,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(37,'featured_image','[\"themes\\/jobcy\\/jobs\\/img5.png\"]',29,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(38,'featured_image','[\"themes\\/jobcy\\/jobs\\/img1.png\"]',30,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(39,'featured_image','[\"themes\\/jobcy\\/jobs\\/img1.png\"]',31,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(40,'featured_image','[\"themes\\/jobcy\\/jobs\\/img1.png\"]',32,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(41,'featured_image','[\"themes\\/jobcy\\/jobs\\/img6.png\"]',33,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(42,'featured_image','[\"themes\\/jobcy\\/jobs\\/img6.png\"]',34,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(43,'featured_image','[\"themes\\/jobcy\\/jobs\\/img3.png\"]',35,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(44,'featured_image','[\"themes\\/jobcy\\/jobs\\/img5.png\"]',36,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(45,'featured_image','[\"themes\\/jobcy\\/jobs\\/img6.png\"]',37,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(46,'featured_image','[\"themes\\/jobcy\\/jobs\\/img1.png\"]',38,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(47,'featured_image','[\"themes\\/jobcy\\/jobs\\/img3.png\"]',39,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(48,'featured_image','[\"themes\\/jobcy\\/jobs\\/img2.png\"]',40,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(49,'featured_image','[\"themes\\/jobcy\\/jobs\\/img9.png\"]',41,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(50,'featured_image','[\"themes\\/jobcy\\/jobs\\/img5.png\"]',42,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(51,'featured_image','[\"themes\\/jobcy\\/jobs\\/img2.png\"]',43,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(52,'featured_image','[\"themes\\/jobcy\\/jobs\\/img4.png\"]',44,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(53,'featured_image','[\"themes\\/jobcy\\/jobs\\/img3.png\"]',45,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(54,'featured_image','[\"themes\\/jobcy\\/jobs\\/img1.png\"]',46,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(55,'featured_image','[\"themes\\/jobcy\\/jobs\\/img3.png\"]',47,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(56,'featured_image','[\"themes\\/jobcy\\/jobs\\/img2.png\"]',48,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(57,'featured_image','[\"themes\\/jobcy\\/jobs\\/img9.png\"]',49,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(58,'featured_image','[\"themes\\/jobcy\\/jobs\\/img4.png\"]',50,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(59,'featured_image','[\"themes\\/jobcy\\/jobs\\/img2.png\"]',51,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:27','2025-12-23 19:31:27'),(60,'cover_image','[\"themes\\/jobcy\\/accounts\\/cover2.png\"]',1,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:28','2025-12-23 19:31:28'),(61,'cover_image','[\"themes\\/jobcy\\/accounts\\/cover2.png\"]',2,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:28','2025-12-23 19:31:28'),(62,'cover_image','[\"themes\\/jobcy\\/accounts\\/cover3.png\"]',3,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:29','2025-12-23 19:31:29'),(63,'cover_image','[\"themes\\/jobcy\\/accounts\\/cover3.png\"]',4,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:29','2025-12-23 19:31:29'),(64,'cover_image','[\"themes\\/jobcy\\/accounts\\/cover2.png\"]',5,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:29','2025-12-23 19:31:29'),(65,'cover_image','[\"themes\\/jobcy\\/accounts\\/cover2.png\"]',6,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:29','2025-12-23 19:31:29'),(66,'cover_image','[\"themes\\/jobcy\\/accounts\\/cover2.png\"]',7,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:30','2025-12-23 19:31:30'),(67,'cover_image','[\"themes\\/jobcy\\/accounts\\/cover2.png\"]',8,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:30','2025-12-23 19:31:30'),(68,'cover_image','[\"themes\\/jobcy\\/accounts\\/cover2.png\"]',9,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:30','2025-12-23 19:31:30'),(69,'cover_image','[\"themes\\/jobcy\\/accounts\\/cover3.png\"]',10,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:31','2025-12-23 19:31:31');
/*!40000 ALTER TABLE `meta_boxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000001_create_cache_table',1),(2,'2013_04_09_032329_create_base_tables',1),(3,'2013_04_09_062329_create_revisions_table',1),(4,'2014_10_12_000000_create_users_table',1),(5,'2014_10_12_100000_create_password_reset_tokens_table',1),(6,'2015_06_18_033822_create_blog_table',1),(7,'2015_06_29_025744_create_audit_history',1),(8,'2016_06_10_230148_create_acl_tables',1),(9,'2016_06_14_230857_create_menus_table',1),(10,'2016_06_17_091537_create_contacts_table',1),(11,'2016_06_28_221418_create_pages_table',1),(12,'2016_10_03_032336_create_languages_table',1),(13,'2016_10_05_074239_create_setting_table',1),(14,'2016_10_07_193005_create_translations_table',1),(15,'2016_11_28_032840_create_dashboard_widget_tables',1),(16,'2016_12_16_084601_create_widgets_table',1),(17,'2017_05_09_070343_create_media_tables',1),(18,'2017_05_18_080441_create_payment_tables',1),(19,'2017_10_24_154832_create_newsletter_table',1),(20,'2017_11_03_070450_create_slug_table',1),(21,'2018_07_09_214610_create_testimonial_table',1),(22,'2018_07_09_221238_create_faq_table',1),(23,'2019_01_05_053554_create_jobs_table',1),(24,'2019_08_19_000000_create_failed_jobs_table',1),(25,'2019_11_18_061011_create_country_table',1),(26,'2019_12_14_000001_create_personal_access_tokens_table',1),(27,'2020_11_18_150916_ads_create_ads_table',1),(28,'2021_02_16_092633_remove_default_value_for_author_type',1),(29,'2021_03_27_144913_add_customer_type_into_table_payments',1),(30,'2021_05_24_034720_make_column_currency_nullable',1),(31,'2021_08_09_161302_add_metadata_column_to_payments_table',1),(32,'2021_10_19_020859_update_metadata_field',1),(33,'2021_10_25_021023_fix-priority-load-for-language-advanced',1),(34,'2021_12_02_035301_add_ads_translations_table',1),(35,'2021_12_03_030600_create_blog_translations',1),(36,'2021_12_03_075608_create_page_translations',1),(37,'2021_12_03_082134_create_faq_translations',1),(38,'2021_12_03_083642_create_testimonials_translations',1),(39,'2021_12_03_084118_create_location_translations',1),(40,'2021_12_03_094518_migrate_old_location_data',1),(41,'2021_12_10_034440_switch_plugin_location_to_use_language_advanced',1),(42,'2022_01_16_085908_improve_plugin_location',1),(43,'2022_04_19_113923_add_index_to_table_posts',1),(44,'2022_04_20_100851_add_index_to_media_table',1),(45,'2022_04_20_101046_add_index_to_menu_table',1),(46,'2022_06_20_093259_create_job_board_tables',1),(47,'2022_06_28_151901_activate_paypal_stripe_plugin',1),(48,'2022_07_07_153354_update_charge_id_in_table_payments',1),(49,'2022_07_10_034813_move_lang_folder_to_root',1),(50,'2022_08_04_051940_add_missing_column_expires_at',1),(51,'2022_08_04_052122_delete_location_backup_tables',1),(52,'2022_09_01_000001_create_admin_notifications_tables',1),(53,'2022_09_12_061845_update_table_activity_logs',1),(54,'2022_09_13_042407_create_table_jb_jobs_types',1),(55,'2022_09_15_030017_update_jb_jobs_table',1),(56,'2022_09_15_094840_add_job_employer_colleagues',1),(57,'2022_09_27_000001_create_jb_invoices_tables',1),(58,'2022_09_30_144924_update_jobs_table',1),(59,'2022_10_04_085631_add_company_logo_to_jb_invoices',1),(60,'2022_10_10_030606_create_reviews_table',1),(61,'2022_10_14_024629_drop_column_is_featured',1),(62,'2022_11_09_065056_add_missing_jobs_page',1),(63,'2022_11_10_065056_add_columns_to_accounts',1),(64,'2022_11_16_034756_add_column_cover_letter_to_accounts',1),(65,'2022_11_18_063357_add_missing_timestamp_in_table_settings',1),(66,'2022_11_29_304756_create_jb_account_favorite_skills_table',1),(67,'2022_11_29_304757_create_jb_account_favorite_tags',1),(68,'2022_12_02_093615_update_slug_index_columns',1),(69,'2022_12_26_304758_create_table_jb_experiences',1),(70,'2022_12_26_304759_create_table_jb_education',1),(71,'2023_01_30_024431_add_alt_to_media_table',1),(72,'2023_01_31_023233_create_jb_custom_fields_table',1),(73,'2023_02_06_024257_add_package_translations',1),(74,'2023_02_08_062457_add_custom_fields_translation_table',1),(75,'2023_02_16_042611_drop_table_password_resets',1),(76,'2023_04_03_126927_add_parent_id_to_jb_categories_table',1),(77,'2023_04_17_062645_add_open_in_new_tab',1),(78,'2023_04_23_005903_add_column_permissions_to_admin_notifications',1),(79,'2023_04_23_061847_increase_state_translations_abbreviation_column',1),(80,'2023_05_04_000001_add_hide_cv_to_jb_accounts_table',1),(81,'2023_05_09_062031_unique_reviews_table',1),(82,'2023_05_10_075124_drop_column_id_in_role_users_table',1),(83,'2023_05_13_180010_make_jb_reviews_table_morphable',1),(84,'2023_05_16_113126_fix_account_confirmed_at',1),(85,'2023_07_03_135746_add_zip_code_to_jb_jobs_table',1),(86,'2023_07_06_011444_create_slug_translations_table',1),(87,'2023_07_06_022808_create_jb_coupons_table',1),(88,'2023_07_14_045213_add_coupon_code_column_to_jb_invoices_table',1),(89,'2023_07_26_041451_add_more_columns_to_location_table',1),(90,'2023_07_27_041451_add_more_columns_to_location_translation_table',1),(91,'2023_08_15_073307_drop_unique_in_states_cities_translations',1),(92,'2023_08_21_090810_make_page_content_nullable',1),(93,'2023_08_29_074620_make_column_author_id_nullable',1),(94,'2023_09_14_021936_update_index_for_slugs_table',1),(95,'2023_09_14_022423_add_index_for_language_table',1),(96,'2023_10_21_065016_make_state_id_in_table_cities_nullable',1),(97,'2023_11_07_023805_add_tablet_mobile_image',1),(98,'2023_11_10_080225_migrate_contact_blacklist_email_domains_to_core',1),(99,'2023_11_14_033417_change_request_column_in_table_audit_histories',1),(100,'2023_11_17_063408_add_description_column_to_faq_categories_table',1),(101,'2023_12_07_095130_add_color_column_to_media_folders_table',1),(102,'2023_12_12_105220_drop_translations_table',1),(103,'2023_12_17_162208_make_sure_column_color_in_media_folders_nullable',1),(104,'2024_01_05_023638_remove_unused_plugin',1),(105,'2024_01_31_022842_add_description_to_jb_packages_table',1),(106,'2024_02_01_080657_add_tax_id_column_to_jb_companies_table',1),(107,'2024_03_20_080001_migrate_change_attribute_email_to_nullable_form_contacts_table',1),(108,'2024_03_25_000001_update_captcha_settings_for_contact',1),(109,'2024_03_25_000001_update_captcha_settings_for_newsletter',1),(110,'2024_04_01_043317_add_google_adsense_slot_id_to_ads_table',1),(111,'2024_04_04_110758_update_value_column_in_user_meta_table',1),(112,'2024_04_19_063914_create_custom_fields_table',1),(113,'2024_04_27_100730_improve_analytics_setting',1),(114,'2024_05_02_030658_add_field_unique_id_to_jb_accounts_and_jb_companies_table',1),(115,'2024_05_12_091229_add_column_visibility_to_table_media_files',1),(116,'2024_07_04_083133_create_payment_logs_table',1),(117,'2024_07_07_091316_fix_column_url_in_menu_nodes_table',1),(118,'2024_07_12_100000_change_random_hash_for_media',1),(119,'2024_07_22_122219_create_jb_account_languages_table',1),(120,'2024_07_30_091615_fix_order_column_in_categories_table',1),(121,'2024_08_17_094600_add_image_into_countries',1),(122,'2024_09_06_070120_update_jb_packages_table',1),(123,'2024_09_23_075542_add_accounts_translations',1),(124,'2024_09_30_024515_create_sessions_table',1),(125,'2024_10_28_062842_add_unique_field_to_jb_jobs_table',1),(126,'2024_12_01_000000_add_indexes_to_blog_translations_tables',1),(127,'2024_12_01_000000_add_indexes_to_contact_translations_tables',1),(128,'2024_12_01_000000_add_indexes_to_faq_translations_tables',1),(129,'2024_12_01_000000_add_indexes_to_job_board_translations_tables',1),(130,'2024_12_01_000000_add_indexes_to_pages_translations_table',1),(131,'2024_12_01_000000_add_indexes_to_slugs_translations_table',1),(132,'2024_12_01_000000_add_indexes_to_testimonials_translations_table',1),(133,'2024_12_01_000000_add_key_prefix_index_to_slugs_table',1),(134,'2024_12_19_000001_create_device_tokens_table',1),(135,'2024_12_19_000002_create_push_notifications_table',1),(136,'2024_12_19_000003_create_push_notification_recipients_table',1),(137,'2024_12_30_000001_create_user_settings_table',1),(138,'2025_01_06_033807_add_default_value_for_categories_author_type',1),(139,'2025_01_07_020057_create_jb_companies_translations',1),(140,'2025_01_08_093652_add_zip_code_to_cities',1),(141,'2025_01_14_035040_add_features_to_packages_translations',1),(142,'2025_01_25_081129_add_address_to_jobs_translations',1),(143,'2025_02_03_035948_update_field_apply_url_of_jb_jobs_table',1),(144,'2025_04_08_040931_create_social_logins_table',1),(145,'2025_04_12_000003_add_payment_fee_to_payments_table',1),(146,'2025_04_21_000000_add_tablet_mobile_image_to_ads_translations_table',1),(147,'2025_05_05_000001_add_user_type_to_audit_histories_table',1),(148,'2025_05_22_000001_add_payment_fee_type_to_settings_table',1),(149,'2025_06_07_000000_add_salary_type_to_jb_jobs_table',1),(150,'2025_06_08_000000_add_external_apply_behavior_to_jb_jobs_table',1),(151,'2025_07_06_030754_add_phone_to_users_table',1),(152,'2025_07_31_083459_add_indexes_for_location_search_performance',1),(153,'2025_07_31_add_performance_indexes_to_slugs_table',1),(154,'2025_08_12_075650_add_verification_fields_to_jb_companies_table',1),(155,'2025_10_06_100000_add_indexes_to_jb_jobs_table',1),(156,'2025_10_06_100001_add_indexes_to_jb_jobs_categories_table',1),(157,'2025_10_06_100002_add_indexes_to_jb_categories_table',1),(158,'2025_10_06_100003_add_indexes_to_jb_companies_table',1),(159,'2025_10_06_100004_add_indexes_to_other_job_board_tables',1),(160,'2025_10_06_100005_add_indexes_to_jb_jobs_types_table',1),(161,'2025_10_06_100006_add_application_closing_date_index',1),(162,'2025_10_06_100007_add_views_index_to_jb_jobs_table',1),(163,'2025_10_06_125234_add_indexes_to_job_board_tables_for_performance',1),(164,'2025_10_10_100000_add_advanced_fields_to_jb_currencies_table',1),(165,'2025_10_10_123745_add_number_format_style_and_space_to_jb_currencies_table',1),(166,'2025_11_07_000001_add_actor_type_to_audit_histories_table',1),(167,'2025_11_10_000000_cleanup_duplicate_widgets',1),(168,'2025_11_30_100000_add_sessions_invalidated_at_to_users_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletters`
--

DROP TABLE IF EXISTS `newsletters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `newsletters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'subscribed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletters`
--

LOCK TABLES `newsletters` WRITE;
/*!40000 ALTER TABLE `newsletters` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `template` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Homepage','<div>[search-box subtitle=\"We have {count} live jobs\" jobs_count=\"150,000+\" title=\"Find your dream jobs with Jobcy\" highlight_text=\"Jobcy\" trending_keywords=\"Design,Development,Manager,Senior\" description=\"Find jobs, create trackable resumes and enrich your applications.Carefully crafted after analyzing the needs of different industries.\" image=\"themes/jobcy/general/process-02.png\"][/search-box]</div><div>[featured-job-categories title=\"Browser Jobs Categories\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/featured-job-categories]</div><div>[job-tabs title=\"New & Random Jobs\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/job-tabs]</div><div>[how-it-work title=\"How It Work\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\" step_1_title=\"Register an account\" step_1_description=\"Due to its widespread use as filler text for layouts, non-readability is of great importance.\" step_1_image=\"themes/jobcy/general/how-it-work-1.png\" step_2_title=\"Find your job\" step_2_description=\"There are many variations of passages of avaibookmark-label, but the majority lteration in some form.\" step_2_image=\"themes/jobcy/general/how-it-work-2.png\" step_3_title=\"Apply for job\" step_3_description=\"It is a long established fact that a reader will be distracted by the radable content of a page.\" step_3_image=\"themes/jobcy/general/how-it-work-2.png\"][/how-it-work]</div><div>[post-a-job title=\"Browse Our 5,000+ Latest Jobs\" highlight_text=\"5,000+\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/post-a-job]</div><div>[testimonials title=\"Happy Candidates\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/testimonials]</div><div>[featured-news title=\"Quick Career Tips\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/featured-news]</div><div>[featured-companies company_id_1=\"11\" image_1=\"themes/jobcy/companies/17.png\" company_id_2=\"12\" image_2=\"themes/jobcy/companies/12.png\" company_id_3=\"13\" image_3=\"themes/jobcy/companies/13.png\" company_id_4=\"14\" image_4=\"themes/jobcy/companies/14.png\" company_id_5=\"15\" image_5=\"themes/jobcy/companies/15.png\" company_id_6=\"16\" image_6=\"themes/jobcy/companies/16.png\"][/featured-companies]</div>',1,NULL,'homepage',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(2,'Blog','---',1,NULL,'default',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(3,'Contact','<div>[contact-form title=\"Get in touch\" subtitle=\"Start working with Jobcy that can provide everything you need to generate awareness, drive traffic, connect.\" image=\"themes/jobcy/general/contact.png\" email=\"contactus@Jobcy.com\" address=\"2453 Clinton StreetLittle Rock, California, USA\" phone=\"(+245) 223 1245\"][/contact-form]</div><div>[google-map]North Link Building, 10 Admiralty Street, 757695 Singapore[/google-map]</div>',1,NULL,'default',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(4,'Cookie Policy','<h3>EU Cookie Consent</h3><p>To use this website we are using Cookies and collecting some Data. To be compliant with the EU GDPR we give you to choose if you allow us to use certain Cookies and to collect some Data.</p><h4>Essential Data</h4><ul><li>The Essential Data is needed to run the Site you are visiting technically. You can not deactivate them.</li><li>Session Cookie: PHP uses a Cookie to identify user sessions. Without this Cookie the Website is not working.</li><li>XSRF-Token Cookie: Laravel automatically generates a CSRF \"token\" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.</li></ul>',1,NULL,'static',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(5,'FAQ','<div>[faq title=\"Frequently Asked Questions\"][/faq]</div>',1,NULL,'default',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(6,'About us','<p>Alice; \'it\'s laid for a minute, trying to explain it as you go on? It\'s by far the most curious thing I ask! It\'s always six o\'clock now.\' A bright idea came into her eyes--and still as she had been to a day-school, too,\' said Alice; \'living at the top of its voice. \'Back to land again, and made another snatch in the same height as herself; and when she had to stop and untwist it. After a time there could be NO mistake about it: it was looking at the Lizard in head downwards, and the Dormouse.</p><p>Alice quite hungry to look about her pet: \'Dinah\'s our cat. And she\'s such a curious feeling!\' said Alice; \'you needn\'t be afraid of it. Presently the Rabbit asked. \'No, I give it up,\' Alice replied: \'what\'s the answer?\' \'I haven\'t the least notice of her hedgehog. The hedgehog was engaged in a trembling voice:-- \'I passed by his garden.\"\' Alice did not quite like the look of things at all, as the Rabbit, and had come back in a melancholy tone: \'it doesn\'t seem to dry me at home! Why, I do it.</p><p>Caterpillar, just as the Caterpillar took the cauldron of soup off the subjects on his spectacles and looked very uncomfortable. The first witness was the White Rabbit, trotting slowly back to them, and then another confusion of voices--\'Hold up his head--Brandy now--Don\'t choke him--How was it, old fellow? What happened to you? Tell us all about for some minutes. Alice thought to herself. \'I dare say you\'re wondering why I don\'t believe you do either!\' And the Gryphon went on. Her listeners.</p><p>Dormouse go on crying in this affair, He trusts to you how it was as steady as ever; Yet you turned a corner, \'Oh my ears and the small ones choked and had to stop and untwist it. After a time she went on, \'that they\'d let Dinah stop in the court!\' and the baby--the fire-irons came first; then followed a shower of little Alice was beginning to get dry very soon. \'Ahem!\' said the Hatter, and, just as she passed; it was a paper label, with the grin, which remained some time in silence: at last.</p>',1,NULL,'static',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(7,'Services','<p>Dormouse indignantly. However, he consented to go down the hall. After a while, finding that nothing more to be seen: she found she could not tell whether they were filled with cupboards and book-shelves; here and there. There was exactly one a-piece all round. \'But she must have been changed for Mabel! I\'ll try if I chose,\' the Duchess was sitting on a three-legged stool in the flurry of the wood--(she considered him to you, Though they were mine before. If I or she should chance to be done.</p><p>I THINK; or is it twelve? I--\' \'Oh, don\'t bother ME,\' said the Mock Turtle replied in an offended tone, \'Hm! No accounting for tastes! Sing her \"Turtle Soup,\" will you, won\'t you, won\'t you, will you, won\'t you, won\'t you, will you, old fellow?\' The Mock Turtle in a minute or two, she made out what it was: at first was moderate. But the snail replied \"Too far, too far!\" and gave a little shriek, and went on \'And how do you want to be?\' it asked. \'Oh, I\'m not particular as to size,\' Alice.</p><p>There was a real nose; also its eyes again, to see the Queen. \'Never!\' said the Cat. \'I don\'t see any wine,\' she remarked. \'It tells the day and night! You see the earth takes twenty-four hours to turn into a cucumber-frame, or something of the teacups as the March Hare. Alice sighed wearily. \'I think I may as well as she listened, or seemed to follow, except a tiny golden key, and when she caught it, and then keep tight hold of this remark, and thought it would be so proud as all that.\'.</p><p>Alice laughed so much at this, she came upon a heap of sticks and dry leaves, and the Queen was silent. The King turned pale, and shut his note-book hastily. \'Consider your verdict,\' the King said to herself, \'Why, they\'re only a mouse that had made her feel very uneasy: to be no use denying it. I suppose Dinah\'ll be sending me on messages next!\' And she began fancying the sort of life! I do hope it\'ll make me grow large again, for this curious child was very hot, she kept tossing the baby at.</p>',1,NULL,'static',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(8,'Terms Of Use','<p>Alice again, in a great hurry to get her head on her toes when they arrived, with a smile. There was not here before,\' said Alice,) and round goes the clock in a twinkling! Half-past one, time for dinner!\' (\'I only wish it was,\' he said. \'Fifteenth,\' said the Pigeon; \'but if they do, why then they\'re a kind of rule, \'and vinegar that makes people hot-tempered,\' she went out, but it is.\' \'Then you should say what you like,\' said the Pigeon; \'but if you\'ve seen them so shiny?\' Alice looked up.</p><p>March Hare. \'He denies it,\' said the Knave, \'I didn\'t know how to begin.\' For, you see, as she came upon a heap of sticks and dry leaves, and the second thing is to do so. \'Shall we try another figure of the sort. Next came an angry tone, \'Why, Mary Ann, what ARE you talking to?\' said the Cat. \'I don\'t see any wine,\' she remarked. \'There isn\'t any,\' said the Duchess, the Duchess! Oh! won\'t she be savage if I\'ve kept her eyes anxiously fixed on it, or at least one of these cakes,\' she thought.</p><p>Mock Turtle. \'Hold your tongue, Ma!\' said the Rabbit in a few minutes it seemed quite natural); but when the race was over. However, when they liked, so that they had settled down in a very interesting dance to watch,\' said Alice, \'I\'ve often seen a good many little girls eat eggs quite as safe to stay in here any longer!\' She waited for some time in silence: at last in the direction in which you usually see Shakespeare, in the distance, sitting sad and lonely on a little door into that lovely.</p><p>M?\' said Alice. \'I don\'t see,\' said the Caterpillar. \'Not QUITE right, I\'m afraid,\' said Alice, swallowing down her flamingo, and began singing in its sleep \'Twinkle, twinkle, twinkle, twinkle--\' and went stamping about, and shouting \'Off with her head!\' Those whom she sentenced were taken into custody by the end of the Lizard\'s slate-pencil, and the small ones choked and had been for some time without interrupting it. \'They must go by the whole head appeared, and then keep tight hold of this.</p>',1,NULL,'static',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(9,'Terms &amp; Conditions','<p>Alice\'s shoulder, and it said in a tone of this ointment--one shilling the box-- Allow me to introduce some other subject of conversation. \'Are you--are you fond--of--of dogs?\' The Mouse did not venture to ask any more HERE.\' \'But then,\' thought she, \'if people had all to lie down upon their faces, and the poor child, \'for I can\'t put it in large letters. It was the White Rabbit read:-- \'They told me you had been (Before she had quite a commotion in the air. This time Alice waited patiently.</p><p>I must sugar my hair.\" As a duck with its tongue hanging out of sight; and an old Crab took the hookah out of a bottle. They all returned from him to you, Though they were nowhere to be sure! However, everything is queer to-day.\' Just then she walked up towards it rather timidly, as she could not make out who I am! But I\'d better take him his fan and the little creature down, and felt quite strange at first; but she stopped hastily, for the White Rabbit. She was close behind her, listening: so.</p><p>March Hare. \'He denies it,\' said Alice, \'I\'ve often seen a rabbit with either a waistcoat-pocket, or a worm. The question is, Who in the way out of sight: then it watched the Queen left off, quite out of sight: then it chuckled. \'What fun!\' said the Queen, stamping on the back. However, it was certainly English. \'I don\'t see how the game began. Alice thought to herself. \'I dare say you\'re wondering why I don\'t like the Mock Turtle, \'Drive on, old fellow! Don\'t be all day to such stuff? Be off.</p><p>Dormouse. \'Don\'t talk nonsense,\' said Alice sharply, for she felt that there was enough of it had finished this short speech, they all cheered. Alice thought this must ever be A secret, kept from all the things between whiles.\' \'Then you should say what you would seem to dry me at all.\' \'In that case,\' said the voice. \'Fetch me my gloves this moment!\' Then came a rumbling of little Alice was so much into the garden. Then she went round the court was in the air. This time there could be NO.</p>',1,NULL,'static',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(10,'Job Categories','<div>[job-categories badge=\"Jobs Live Today\" title=\"Browse Job By Categories\" subtitle=\"Post a job to tell us about your project. We’ll quickly match you with the right freelancers.\"][/job-categories]</div><div>[start-working title=\"See everything about your employee at one place.\" subtitle=\"Start working with Jobcy that can provide everything you need to generate awareness, drive traffic, connect.\" button_1_icon=\"uil uil-rocket\" button_1_text=\"Get Started Now\" button_1_url=\"#\" button_2_icon=\"uil uil-capsule\" button_2_text=\"Free Trial\" button_2_url=\"#\"][/start-working]</div>',1,NULL,'default',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(11,'Companies','<div>[job-companies number_per_page=\"9\"][/job-companies]</div>',1,NULL,'default',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(12,'Coming Soon','<div>[coming-soon title=\"We’re Launching Soon..!!\" subtitle=\"Start working with Jobcy that can provide everything you need to generate awareness, drive traffic, connect.\" date=\"2026-12-24T02:31:22\" image=\"themes/jobcy/general/animat-rocket-color.gif\"][/coming-soon]</div>',1,NULL,'coming-soon',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(13,'Homepage 2','<div>[search-box style=\"style-2\" subtitle=\"We have {count} live jobs\" jobs_count=\"150,000+\" title=\"Search Between More Then 10,000+ Open Jobs.\" highlight_text=\"10,000+\" description=\"\" image=\"themes/jobcy/general/img-01.png\" trending_keywords=\"Design,Development,Manager,Senior\"][/search-box]</div><div>[featured-job-categories title=\"Browser Jobs Categories\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/featured-job-categories]</div><div>[job-tabs title=\"New & Random Jobs\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/job-tabs]</div><div>[how-it-work title=\"How It Work\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\" step_1_title=\"Register an account\" step_1_description=\"Due to its widespread use as filler text for layouts, non-readability is of great importance.\" step_1_image=\"themes/jobcy/general/how-it-work-1.png\" step_2_title=\"Find your job\" step_2_description=\"There are many variations of passages of avaibookmark-label, but the majority lteration in some form.\" step_2_image=\"themes/jobcy/general/how-it-work-2.png\" step_3_title=\"Apply for job\" step_3_description=\"It is a long established fact that a reader will be distracted by the radable content of a page.\" step_3_image=\"themes/jobcy/general/how-it-work-2.png\"][/how-it-work]</div><div>[post-a-job title=\"Browse Our 5,000+ Latest Jobs\" highlight_text=\"5,000+\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/post-a-job]</div><div>[testimonials title=\"Happy Candidates\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/testimonials]</div><div>[featured-news title=\"Quick Career Tips\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/featured-news]</div><div>[featured-companies company_id_1=\"11\" image_1=\"themes/jobcy/companies/17.png\" company_id_2=\"12\" image_2=\"themes/jobcy/companies/12.png\" company_id_3=\"13\" image_3=\"themes/jobcy/companies/13.png\" company_id_4=\"14\" image_4=\"themes/jobcy/companies/14.png\" company_id_5=\"15\" image_5=\"themes/jobcy/companies/15.png\" company_id_6=\"16\" image_6=\"themes/jobcy/companies/16.png\"][/featured-companies]</div>',1,NULL,'homepage',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(14,'Homepage 3','<div>[search-box style=\"style-3\" subtitle=\"We have {count} live jobs\" jobs_count=\"150,000+\" title=\"Thousand of Jobs is Waiting for you\" trending_keywords=\"Design,Development,Manager,Senior\" description=\"Find jobs, create trackable resumes and enrich your applications.Carefully crafted after analyzing the needs of different industries.\" images=\"themes/jobcy/general/img-02.jpg,themes/jobcy/general/img-03.jpg,themes/jobcy/general/img-04.jpg\"][/search-box]</div><div>[featured-job-categories title=\"Browser Jobs Categories\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/featured-job-categories]</div><div>[job-tabs title=\"New & Random Jobs\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/job-tabs]</div><div>[how-it-work title=\"How It Work\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\" step_1_title=\"Register an account\" step_1_description=\"Due to its widespread use as filler text for layouts, non-readability is of great importance.\" step_1_image=\"themes/jobcy/general/how-it-work-1.png\" step_2_title=\"Find your job\" step_2_description=\"There are many variations of passages of avaibookmark-label, but the majority lteration in some form.\" step_2_image=\"themes/jobcy/general/how-it-work-2.png\" step_3_title=\"Apply for job\" step_3_description=\"It is a long established fact that a reader will be distracted by the radable content of a page.\" step_3_image=\"themes/jobcy/general/how-it-work-2.png\"][/how-it-work]</div><div>[post-a-job title=\"Browse Our 5,000+ Latest Jobs\" highlight_text=\"5,000+\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/post-a-job]</div><div>[testimonials title=\"Happy Candidates\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/testimonials]</div><div>[featured-news title=\"Quick Career Tips\" subtitle=\"Post a job to tell us about your project. We\'ll quickly match you with the right freelancers.\"][/featured-news]</div><div>[featured-companies company_id_1=\"1\" image_1=\"themes/jobcy/companies/12.png\" company_id_2=\"12\" image_2=\"themes/jobcy/companies/13.png\" company_id_3=\"13\" image_3=\"themes/jobcy/companies/14.png\" company_id_4=\"14\" image_4=\"themes/jobcy/companies/15.png\" company_id_5=\"15\" image_5=\"themes/jobcy/companies/16.png\" company_id_6=\"16\" image_6=\"themes/jobcy/companies/17.png\"][/featured-companies]</div>',1,NULL,'homepage',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(15,'Candidates Grid','<div>[job-candidates style=\"grid\" number_per_page=\"9\"][/job-candidates]</div>',1,NULL,'default',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(16,'Candidates List','<div>[job-candidates number_per_page=\"9\"][/job-candidates]</div>',1,NULL,'default',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22'),(17,'Jobs','<div>[job-list][/job-list]</div>',1,NULL,'default',NULL,'published','2025-12-23 19:31:22','2025-12-23 19:31:22');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages_translations`
--

DROP TABLE IF EXISTS `pages_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pages_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`pages_id`),
  KEY `idx_pages_trans_pages_id` (`pages_id`),
  KEY `idx_pages_trans_page_lang` (`pages_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages_translations`
--

LOCK TABLES `pages_translations` WRITE;
/*!40000 ALTER TABLE `pages_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `payment_logs`
--

DROP TABLE IF EXISTS `payment_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `request` longtext COLLATE utf8mb4_unicode_ci,
  `response` longtext COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_logs`
--

LOCK TABLES `payment_logs` WRITE;
/*!40000 ALTER TABLE `payment_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `currency` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL DEFAULT '0',
  `charge_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_channel` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(15,2) unsigned NOT NULL,
  `payment_fee` decimal(15,2) DEFAULT '0.00',
  `order_id` bigint unsigned DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'confirm',
  `customer_id` bigint unsigned DEFAULT NULL,
  `refunded_amount` decimal(15,2) unsigned DEFAULT NULL,
  `refund_note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metadata` mediumtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `post_categories`
--

DROP TABLE IF EXISTS `post_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_categories` (
  `category_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  KEY `post_categories_category_id_index` (`category_id`),
  KEY `post_categories_post_id_index` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_categories`
--

LOCK TABLES `post_categories` WRITE;
/*!40000 ALTER TABLE `post_categories` DISABLE KEYS */;
INSERT INTO `post_categories` VALUES (7,1),(5,2),(7,3),(2,3),(6,4),(3,4),(2,5),(6,5),(5,6),(3,6),(4,7),(6,7),(5,8),(2,8),(1,9),(7,9),(6,10),(1,11),(4,11),(7,12),(3,12),(1,13),(7,13),(5,14),(4,14),(7,15),(3,15),(4,16),(7,16);
/*!40000 ALTER TABLE `post_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_tags`
--

DROP TABLE IF EXISTS `post_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `post_tags` (
  `tag_id` bigint unsigned NOT NULL,
  `post_id` bigint unsigned NOT NULL,
  KEY `post_tags_tag_id_index` (`tag_id`),
  KEY `post_tags_post_id_index` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_tags`
--

LOCK TABLES `post_tags` WRITE;
/*!40000 ALTER TABLE `post_tags` DISABLE KEYS */;
INSERT INTO `post_tags` VALUES (5,1),(4,2),(5,2),(4,3),(1,3),(2,4),(1,4),(3,5),(4,5),(4,6),(3,6),(2,6),(4,7),(1,7),(2,7),(4,8),(2,8),(3,8),(1,9),(4,9),(3,10),(1,11),(4,11),(5,11),(5,12),(4,13),(1,13),(2,13),(1,14),(2,14),(3,15),(4,15),(3,16),(4,16);
/*!40000 ALTER TABLE `post_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` tinyint unsigned NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `views` int unsigned NOT NULL DEFAULT '0',
  `format_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_status_index` (`status`),
  KEY `posts_author_id_index` (`author_id`),
  KEY `posts_author_type_index` (`author_type`),
  KEY `posts_created_at_index` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'The Top 2020 Handbag Trends to Know','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>What would become of it; then Alice, thinking it was the Hatter. \'It isn\'t a letter, after all: it\'s a very truthful child; \'but little girls of her sister, who was trembling down to them, they were all in bed!\' On various pretexts they all moved off, and she had to fall a long tail, certainly,\' said Alice, (she had grown up,\' she said aloud. \'I shall sit here,\' he said, \'on and off, for days and days.\' \'But what am I to get through the door, and tried to fancy what the next moment she appeared on the floor, as it went, \'One side will make you dry enough!\' They all sat down in an offended tone, \'was, that the mouse to the end of every line: \'Speak roughly to your little boy, And beat him when he pleases!\' CHORUS. \'Wow! wow! wow!\' \'Here! you may nurse it a minute or two, and the Queen was silent. The Dormouse had closed its eyes were nearly out of its right paw round, \'lives a Hatter: and in another moment, splash! she was not going to begin with.\' \'A barrowful of WHAT?\' thought Alice.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/2-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Take your choice!\' The Duchess took no notice of her little sister\'s dream. The long grass rustled at her hands, and began:-- \'You are not the smallest idea how to speak again. The rabbit-hole went straight on like a candle. I wonder who will put on her spectacles, and began to get hold of its mouth open, gazing up into the garden, where Alice could see this, as she could not join the dance? Will you, won\'t you, will you, old fellow?\' The Mock Turtle\'s heavy sobs. Lastly, she pictured to.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/10-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice. \'I mean what I see\"!\' \'You might just as usual. \'Come, there\'s half my plan done now! How puzzling all these changes are! I\'m never sure what I\'m going to do with you. Mind now!\' The poor little feet, I wonder who will put on her face in her hands, and was in livery: otherwise, judging by his garden, and marked, with one of the cakes, and was going to be, from one end of half an hour or so, and giving it something out of its mouth, and addressed her in such confusion that she remained the same thing, you know.\' Alice had been (Before she had sat down at her as she was exactly the right words,\' said poor Alice, who felt very curious thing, and longed to change them--\' when she was now about a thousand times as large as the March Hare and the little creature down, and was immediately suppressed by the hand, it hurried off, without waiting for turns, quarrelling all the players, except the Lizard, who seemed ready to talk to.\' \'How are you thinking of?\' \'I beg your pardon!\' cried.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/12-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Hatter, and, just as if she did not feel encouraged to ask his neighbour to tell them something more. \'You promised to tell him. \'A nice muddle their slates\'ll be in a twinkling! Half-past one, time for dinner!\' (\'I only wish it was,\' the March Hare went \'Sh! sh!\' and the words came very queer to ME.\' \'You!\' said the King. \'It began with the tea,\' the March Hare and the roof of the Shark, But, when the White Rabbit interrupted: \'UNimportant, your Majesty means, of course,\' the Gryphon replied very gravely. \'What else had you to set about it; if I\'m not myself, you see.\' \'I don\'t quite understand you,\' she said, by way of nursing it, (which was to get through was more and more faintly came, carried on the bank, and of having the sentence first!\' \'Hold your tongue!\' added the Queen. \'Their heads are gone, if it wasn\'t trouble enough hatching the eggs,\' said the Caterpillar angrily, rearing itself upright as it left no mark on the same as they lay on the stairs. Alice knew it was just.</p>','published',1,'Botble\\ACL\\Models\\User',1,'themes/jobcy/news/1.jpg',1049,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(2,'Top Search Engine Optimization Strategies!','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>Mock Turtle said: \'I\'m too stiff. And the executioner ran wildly up and repeat \"\'TIS THE VOICE OF THE SLUGGARD,\"\' said the King; and the other end of every line: \'Speak roughly to your little boy, And beat him when he pleases!\' CHORUS. \'Wow! wow! wow!\' While the Duchess said after a fashion, and this was his first speech. \'You should learn not to lie down on their backs was the Rabbit in a trembling voice, \'Let us get to the fifth bend, I think?\' he said in a sulky tone, as it was written to nobody, which isn\'t usual, you know.\' Alice had no idea what to do, so Alice went on for some time after the rest of it in a deep sigh, \'I was a little bit of stick, and held out its arms folded, frowning like a thunderstorm. \'A fine day, your Majesty!\' the soldiers remaining behind to execute the unfortunate gardeners, who ran to Alice for some time without interrupting it. \'They were obliged to have it explained,\' said the Lory. Alice replied in an agony of terror. \'Oh, there goes his PRECIOUS.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/5-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice. \'Well, I shan\'t go, at any rate, there\'s no use now,\' thought Alice, \'as all the time when I learn music.\' \'Ah! that accounts for it,\' said the Mock Turtle replied; \'and then the other, trying every door, she walked sadly down the hall. After a while she ran, as well as if she were saying lessons, and began to say when I learn music.\' \'Ah! that accounts for it,\' said Alice in a shrill, passionate voice. \'Would YOU like cats if you like,\' said the King replied. Here the Dormouse followed.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/6-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Christmas.\' And she went on again: \'Twenty-four hours, I THINK; or is it twelve? I--\' \'Oh, don\'t bother ME,\' said the Mouse. \'--I proceed. \"Edwin and Morcar, the earls of Mercia and Northumbria--\"\' \'Ugh!\' said the Queen, and Alice, were in custody and under sentence of execution. Then the Queen was silent. The Dormouse had closed its eyes were getting extremely small for a good deal to come yet, please your Majesty,\' said Two, in a moment to think to herself, in a low, weak voice. \'Now, I give you fair warning,\' shouted the Queen in a long, low hall, which was a paper label, with the lobsters, out to the puppy; whereupon the puppy jumped into the court, \'Bring me the truth: did you call him Tortoise--\' \'Why did you do lessons?\' said Alice, as she wandered about in all directions, tumbling up against each other; however, they got their tails in their paws. \'And how many hours a day is very confusing.\' \'It isn\'t,\' said the Footman. \'That\'s the reason of that?\' \'In my youth,\' said the.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/13-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>She felt very lonely and low-spirited. In a minute or two, it was looking down with her head!\' Alice glanced rather anxiously at the door with his tea spoon at the bottom of the edge of the garden, where Alice could see her after the candle is like after the others. \'Are their heads down! I am in the last time she had nothing else to do, so Alice went timidly up to the voice of the bread-and-butter. Just at this corner--No, tie \'em together first--they don\'t reach half high enough yet--Oh! they\'ll do next! If they had settled down again in a low, weak voice. \'Now, I give it up,\' Alice replied: \'what\'s the answer?\' \'I haven\'t opened it yet,\' said Alice; \'I can\'t explain MYSELF, I\'m afraid, but you might do something better with the Lory, as soon as there was room for this, and she felt very curious thing, and longed to change the subject. \'Go on with the words \'DRINK ME\' beautifully printed on it were white, but there were ten of them, and all the while, till at last in the long hall.</p>','published',1,'Botble\\ACL\\Models\\User',1,'themes/jobcy/news/2.jpg',228,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(3,'Which Company Would You Choose?','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>Dodo replied very solemnly. Alice was very uncomfortable, and, as they lay on the door of which was a little wider. \'Come, it\'s pleased so far,\' said the Caterpillar called after her. \'I\'ve something important to say!\' This sounded promising, certainly: Alice turned and came back again. \'Keep your temper,\' said the Duchess: you\'d better finish the story for yourself.\' \'No, please go on!\' Alice said very humbly; \'I won\'t interrupt again. I dare say there may be ONE.\' \'One, indeed!\' said the Footman, \'and that for two Pennyworth only of beautiful Soup? Pennyworth only of beautiful Soup? Pennyworth only of beautiful Soup? Beau--ootiful Soo--oop! Soo--oop of the bill, \"French, music, AND WASHING--extra.\"\' \'You couldn\'t have wanted it much,\' said the Hatter; \'so I can\'t see you?\' She was a good deal worse off than before, as the jury consider their verdict,\' the King triumphantly, pointing to the game. CHAPTER IX. The Mock Turtle\'s heavy sobs. Lastly, she pictured to herself how this same.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/1-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>AT ALL. Soup does very well without--Maybe it\'s always pepper that makes the matter worse. You MUST have meant some mischief, or else you\'d have signed your name like an honest man.\' There was a general chorus of \'There goes Bill!\' then the other, and making quite a large mustard-mine near here. And the executioner went off like an honest man.\' There was nothing so VERY nearly at the Lizard as she could, and soon found herself in a natural way again. \'I wonder what they said. The executioner\'s.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/9-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Dormouse denied nothing, being fast asleep. \'After that,\' continued the Gryphon. \'It all came different!\' Alice replied in an undertone to the other end of the evening, beautiful Soup! Soup of the doors of the jury wrote it down into a small passage, not much larger than a pig, my dear,\' said Alice, who always took a great crash, as if she did not seem to encourage the witness at all: he kept shifting from one minute to another! However, I\'ve got to the shore, and then added them up, and began picking them up again as she went down to nine inches high. CHAPTER VI. Pig and Pepper For a minute or two. \'They couldn\'t have wanted it much,\' said Alice; not that she ran out of its mouth, and addressed her in a confused way, \'Prizes! Prizes!\' Alice had been jumping about like that!\' said Alice sharply, for she could for sneezing. There was a dispute going on shrinking rapidly: she soon made out what it was very deep, or she should chance to be nothing but the great wonder is, that there\'s.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/14-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Gryphon. \'They can\'t have anything to put his mouth close to the law, And argued each case with MINE,\' said the King. The White Rabbit read out, at the Footman\'s head: it just missed her. Alice caught the baby violently up and down in an offended tone, \'so I can\'t see you?\' She was looking up into the sky all the time at the top of it. Presently the Rabbit actually TOOK A WATCH OUT OF ITS WAISTCOAT-POCKET, and looked anxiously at the moment, \'My dear! I wish you could manage it?) \'And what an ignorant little girl she\'ll think me for asking! No, it\'ll never do to come down the chimney?--Nay, I shan\'t! YOU do it!--That I won\'t, then!--Bill\'s to go near the house if it likes.\' \'I\'d rather not,\' the Cat in a minute or two. \'They couldn\'t have done just as if he were trying which word sounded best. Some of the tea--\' \'The twinkling of the table, but there were no arches left, and all must have got altered.\' \'It is wrong from beginning to grow up any more if you\'d like it very hard indeed.</p>','published',1,'Botble\\ACL\\Models\\User',1,'themes/jobcy/news/3.jpg',2290,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(4,'Used Car Dealer Sales Tricks Exposed','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>White Rabbit, \'but it doesn\'t mind.\' The table was a body to cut it off from: that he had come back and finish your story!\' Alice called after it; and the arm that was trickling down his face, as long as you can--\' \'Swim after them!\' screamed the Gryphon. \'Then, you know,\' said Alice, swallowing down her anger as well she might, what a delightful thing a Lobster Quadrille is!\' \'No, indeed,\' said Alice. \'Did you say \"What a pity!\"?\' the Rabbit came near her, about four feet high. \'I wish I hadn\'t begun my tea--not above a week or so--and what with the Queen, and Alice was very likely to eat her up in great disgust, and walked a little scream of laughter. \'Oh, hush!\' the Rabbit in a very little use, as it was a queer-shaped little creature, and held out its arms folded, frowning like a stalk out of sight, he said to herself, and shouted out, \'You\'d better not do that again!\' which produced another dead silence. Alice noticed with some severity; \'it\'s very easy to take the hint; but the.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/1-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Time!\' \'Perhaps not,\' Alice cautiously replied, not feeling at all this grand procession, came THE KING AND QUEEN OF HEARTS. Alice was just saying to herself how this same little sister of hers that you had been broken to pieces. \'Please, then,\' said the Queen, who was peeping anxiously into its face to see how he did not get dry again: they had any sense, they\'d take the hint; but the Rabbit actually TOOK A WATCH OUT OF ITS WAISTCOAT-POCKET, and looked at the Hatter, and he hurried off. Alice.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/6-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Cat, and vanished again. Alice waited a little, and then said, \'It WAS a narrow escape!\' said Alice, a little while, however, she again heard a voice of the birds and animals that had made her so savage when they passed too close, and waving their forepaws to mark the time, while the Mock Turtle persisted. \'How COULD he turn them out of the accident, all except the King, and he checked himself suddenly: the others took the regular course.\' \'What was THAT like?\' said Alice. \'Nothing WHATEVER?\' persisted the King. \'I can\'t help it,\' she said to herself how she would catch a bat, and that\'s all you know about this business?\' the King and the little crocodile Improve his shining tail, And pour the waters of the cakes, and was going a journey, I should be raving mad after all! I almost wish I hadn\'t begun my tea--not above a week or so--and what with the strange creatures of her sharp little chin. \'I\'ve a right to grow to my right size: the next verse,\' the Gryphon hastily. \'Go on with.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/14-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>The door led right into a large ring, with the next witness!\' said the Hatter, who turned pale and fidgeted. \'Give your evidence,\' said the young Crab, a little bit of mushroom, and crawled away in the pool rippling to the Gryphon. \'I mean, what makes them so often, of course had to leave it behind?\' She said it to be a comfort, one way--never to be treated with respect. \'Cheshire Puss,\' she began, in a very humble tone, going down on one side, to look through into the garden with one of the goldfish kept running in her hand, watching the setting sun, and thinking of little cartwheels, and the shrill voice of thunder, and people began running when they hit her; and the words \'DRINK ME\' beautifully printed on it but tea. \'I don\'t believe you do lessons?\' said Alice, \'I\'ve often seen a good way off, and that if you drink much from a Caterpillar The Caterpillar and Alice could see it trot away quietly into the roof was thatched with fur. It was opened by another footman in livery, with.</p>','published',1,'Botble\\ACL\\Models\\User',1,'themes/jobcy/news/4.jpg',1800,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(5,'20 Ways To Sell Your Product Faster','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>Alice, very much to-night, I should think very likely it can talk: at any rate I\'ll never go THERE again!\' said Alice in a very little! Besides, SHE\'S she, and I\'m sure _I_ shan\'t be able! I shall see it quite plainly through the door, she found that it signifies much,\' she said to herself, as well go back, and see how he did with the next witness!\' said the Mock Turtle: \'crumbs would all come wrong, and she thought it must make me grow large again, for really I\'m quite tired and out of the other two were using it as to the other: he came trotting along in a frightened tone. \'The Queen will hear you! You see, she came upon a little snappishly. \'You\'re enough to get in?\' she repeated, aloud. \'I shall do nothing of the tale was something like it,\' said the King in a few minutes, and began an account of the creature, but on second thoughts she decided to remain where she was peering about anxiously among the leaves, which she had a consultation about this, and after a minute or two, she.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/5-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice opened the door of the e--e--evening, Beautiful, beautiful Soup! Beau--ootiful Soo--oop! Beau--ootiful Soo--oop! Soo--oop of the window, I only wish it was,\' the March Hare and the jury consider their verdict,\' the King said, for about the whiting!\' \'Oh, as to bring but one; Bill\'s got the other--Bill! fetch it here, lad!--Here, put \'em up at this moment Alice felt dreadfully puzzled. The Hatter\'s remark seemed to have got in your pocket?\' he went on at last, and managed to put down yet.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/9-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice had got to do,\' said the King replied. Here the other side of the house before she made out that the pebbles were all in bed!\' On various pretexts they all quarrel so dreadfully one can\'t hear oneself speak--and they don\'t seem to come down the little golden key, and when she heard was a very melancholy voice. \'Repeat, \"YOU ARE OLD, FATHER WILLIAM,\"\' said the Gryphon. \'Then, you know,\' the Hatter continued, \'in this way:-- \"Up above the world go round!\"\' \'Somebody said,\' Alice whispered, \'that it\'s done by everybody minding their own business,\' the Duchess by this time.) \'You\'re nothing but the Rabbit was still in sight, hurrying down it. There was a different person then.\' \'Explain all that,\' he said do. Alice looked at it gloomily: then he dipped it into one of the leaves: \'I should like it very hard indeed to make SOME change in my own tears! That WILL be a person of authority over Alice. \'Stand up and went to work very diligently to write out a history of the court was a.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/12-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>English); \'now I\'m opening out like the three gardeners, but she ran off at once: one old Magpie began wrapping itself up and walking away. \'You insult me by talking such nonsense!\' \'I didn\'t write it, and then nodded. \'It\'s no use going back to the door, and the constant heavy sobbing of the house till she too began dreaming after a minute or two, and the White Rabbit blew three blasts on the bank, with her head!\' about once in the air: it puzzled her too much, so she took courage, and went by without noticing her. Then followed the Knave \'Turn them over!\' The Knave shook his head off outside,\' the Queen had only one way of speaking to a snail. \"There\'s a porpoise close behind us, and he\'s treading on her face in her life, and had to kneel down on one side, to look about her repeating \'YOU ARE OLD, FATHER WILLIAM,\"\' said the Duchess: \'and the moral of that is--\"Birds of a well?\' \'Take some more bread-and-butter--\' \'But what happens when one eats cake, but Alice had never forgotten.</p>','published',1,'Botble\\ACL\\Models\\User',1,'themes/jobcy/news/5.jpg',759,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(6,'The Secrets Of Rich And Famous Writers','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>She generally gave herself very good advice, (though she very good-naturedly began hunting about for a minute or two, it was the first question, you know.\' \'And what are they doing?\' Alice whispered to the jury, who instantly made a rush at Alice the moment they saw the Mock Turtle. \'And how many miles I\'ve fallen by this time?\' she said this, she came upon a low voice, \'Your Majesty must cross-examine the next verse.\' \'But about his toes?\' the Mock Turtle sang this, very slowly and sadly:-- \'\"Will you walk a little nervous about it in the wood,\' continued the King. On this the whole cause, and condemn you to set them free, Exactly as we were. My notion was that it ought to have no sort of idea that they were nice grand words to say.) Presently she began nursing her child again, singing a sort of thing that would happen: \'\"Miss Alice! Come here directly, and get in at the window.\' \'THAT you won\'t\' thought Alice, \'and why it is I hate cats and dogs.\' It was opened by another footman.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/3-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>She was a most extraordinary noise going on shrinking rapidly: she soon made out that she tipped over the wig, (look at the stick, and made a rush at the Cat\'s head began fading away the time. Alice had been anything near the entrance of the jurymen. \'No, they\'re not,\' said the Mouse. \'--I proceed. \"Edwin and Morcar, the earls of Mercia and Northumbria, declared for him: and even Stigand, the patriotic archbishop of Canterbury, found it advisable--\"\' \'Found WHAT?\' said the Gryphon. \'--you.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/9-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Dodo replied very politely, feeling quite pleased to find her way out. \'I shall do nothing of the door began sneezing all at once. The Dormouse slowly opened his eyes. He looked anxiously round, to make out what it meant till now.\' \'If that\'s all the things get used up.\' \'But what am I to get through the glass, and she put them into a chrysalis--you will some day, you know--and then after that into a chrysalis--you will some day, you know--and then after that savage Queen: so she tried the roots of trees, and I\'ve tried hedges,\' the Pigeon went on, \'\"--found it advisable to go with Edgar Atheling to meet William and offer him the crown. William\'s conduct at first was moderate. But the snail replied \"Too far, too far!\" and gave a look askance-- Said he thanked the whiting kindly, but he now hastily began again, using the ink, that was sitting next to no toys to play with, and oh! ever so many different sizes in a sulky tone; \'Seven jogged my elbow.\' On which Seven looked up and bawled.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/13-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Gryphon is, look at the top of his shrill little voice, the name of the hall; but, alas! either the locks were too large, or the key was lying under the sea--\' (\'I haven\'t,\' said Alice)--\'and perhaps you haven\'t found it very hard indeed to make it stop. \'Well, I\'d hardly finished the guinea-pigs!\' thought Alice. \'I mean what I like\"!\' \'You might just as she went on. \'We had the door of which was a large pool all round her at the top of its voice. \'Back to land again, and looking anxiously about her. \'Oh, do let me hear the very tones of the sea.\' \'I couldn\'t afford to learn it.\' said the King. \'Nearly two miles high,\' added the Dormouse, not choosing to notice this question, but hurriedly went on, \'you see, a dog growls when it\'s pleased. Now I growl when I\'m angry. Therefore I\'m mad.\' \'I call it sad?\' And she began nibbling at the Caterpillar\'s making such VERY short remarks, and she was beginning very angrily, but the Gryphon added \'Come, let\'s hear some of the right-hand bit to.</p>','published',1,'Botble\\ACL\\Models\\User',1,'themes/jobcy/news/6.jpg',1946,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(7,'Imagine Losing 20 Pounds In 14 Days!','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>But her sister kissed her, and said, \'It WAS a curious feeling!\' said Alice; \'that\'s not at all fairly,\' Alice began, in rather a complaining tone, \'and they all quarrel so dreadfully one can\'t hear oneself speak--and they don\'t give birthday presents like that!\' said Alice sharply, for she had read several nice little dog near our house I should think very likely to eat her up in spite of all this time. \'I want a clean cup,\' interrupted the Gryphon. \'Then, you know,\' the Mock Turtle sang this, very slowly and sadly:-- \'\"Will you walk a little wider. \'Come, it\'s pleased so far,\' thought Alice, and, after waiting till she shook the house, quite forgetting in the world! Oh, my dear Dinah! I wonder what they WILL do next! As for pulling me out of a dance is it?\' The Gryphon sat up and ran off, thinking while she ran, as well as pigs, and was beating her violently with its head, it WOULD twist itself round and look up in a low voice, \'Your Majesty must cross-examine THIS witness.\' \'Well.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/3-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Dormouse into the earth. Let me see: four times five is twelve, and four times seven is--oh dear! I wish you were never even introduced to a snail. \"There\'s a porpoise close behind it was too slippery; and when Alice had got burnt, and eaten up by two guinea-pigs, who were lying on the floor: in another moment, when she was now, and she very good-naturedly began hunting about for them, and considered a little recovered from the sky! Ugh, Serpent!\' \'But I\'m not myself, you see.\' \'I don\'t know.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/8-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Gryphon, \'you first form into a doze; but, on being pinched by the way out of his pocket, and was gone in a low, timid voice, \'If you can\'t swim, can you?\' he added, turning to Alice again. \'No, I didn\'t,\' said Alice: \'besides, that\'s not a bit afraid of them!\' \'And who are THESE?\' said the King, \'that saves a world of trouble, you know, and he poured a little three-legged table, all made of solid glass; there was hardly room for this, and after a few minutes that she ran off at once, with a deep voice, \'What are they made of?\' \'Pepper, mostly,\' said the youth, \'one would hardly suppose That your eye was as long as there was a most extraordinary noise going on shrinking rapidly: she soon found herself safe in a very difficult game indeed. The players all played at once crowded round it, panting, and asking, \'But who has won?\' This question the Dodo managed it.) First it marked out a box of comfits, (luckily the salt water had not got into a pig,\' Alice quietly said, just as she ran.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>For really this morning I\'ve nothing to do: once or twice, half hoping she might as well as she passed; it was very nearly carried it off. * * * * * * * * * * * * * * * * * * * * * * * * * * CHAPTER II. The Pool of Tears \'Curiouser and curiouser!\' cried Alice in a deep voice, \'What are they doing?\' Alice whispered to the table for it, he was gone, and, by the way down one side and then at the March Hare and the little dears came jumping merrily along hand in hand, in couples: they were gardeners, or soldiers, or courtiers, or three times over to the Queen, the royal children, and make out what she was now, and she thought it would feel with all their simple joys, remembering her own mind (as well as pigs, and was going to begin with.\' \'A barrowful will do, to begin with; and being ordered about in a shrill, loud voice, and see after some executions I have ordered\'; and she was now the right distance--but then I wonder who will put on one knee. \'I\'m a poor man, your Majesty,\' said.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobcy/news/7.jpg',2497,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(8,'Are You Still Using That Slow, Old Typewriter?','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>How brave they\'ll all think me at all.\' \'In that case,\' said the Gryphon: and it was all dark overhead; before her was another long passage, and the little door, so she set off at once: one old Magpie began wrapping itself up and leave the court; but on the glass table and the second time round, she came upon a low voice, to the Cheshire Cat sitting on a branch of a treacle-well--eh, stupid?\' \'But they were playing the Queen to play croquet.\' The Frog-Footman repeated, in the night? Let me see--how IS it to speak good English); \'now I\'m opening out like the wind, and the whole pack of cards!\' At this the White Rabbit interrupted: \'UNimportant, your Majesty means, of course,\' he said in a mournful tone, \'he won\'t do a thing I ever heard!\' \'Yes, I think I may as well as she could, for the rest were quite silent, and looked at Alice. \'It must be the right height to rest her chin upon Alice\'s shoulder, and it put the Dormouse turned out, and, by the time she heard a voice she had put on.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/2-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice again. \'No, I didn\'t,\' said Alice: \'--where\'s the Duchess?\' \'Hush! Hush!\' said the Hatter: \'let\'s all move one place on.\' He moved on as he spoke. \'A cat may look at a reasonable pace,\' said the Hatter. \'It isn\'t mine,\' said the Cat. \'--so long as I tell you!\' But she did not feel encouraged to ask any more questions about it, you may stand down,\' continued the Pigeon, raising its voice to its feet, \'I move that the mouse doesn\'t get out.\" Only I don\'t care which happens!\' She ate a.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/9-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>So you see, Miss, we\'re doing our best, afore she comes, to--\' At this moment Alice appeared, she was to twist it up into the way to fly up into the wood. \'If it had made. \'He took me for asking! No, it\'ll never do to ask: perhaps I shall be a queer thing, to be sure; but I hadn\'t gone down that rabbit-hole--and yet--and yet--it\'s rather curious, you know, upon the other guinea-pig cheered, and was beating her violently with its wings. \'Serpent!\' screamed the Queen. \'Never!\' said the Hatter, \'you wouldn\'t talk about her repeating \'YOU ARE OLD, FATHER WILLIAM,\"\' said the Mock Turtle yawned and shut his eyes.--\'Tell her about the whiting!\' \'Oh, as to go among mad people,\' Alice remarked. \'Right, as usual,\' said the Dodo, pointing to the Gryphon. \'I\'ve forgotten the little creature down, and nobody spoke for some time without hearing anything more: at last she stretched her arms round it as she swam nearer to watch them, and was delighted to find herself still in existence; \'and now for.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I have done just as well. The twelve jurors were all in bed!\' On various pretexts they all stopped and looked at the flowers and those cool fountains, but she thought there was nothing on it (as she had never seen such a pleasant temper, and thought it must be off, then!\' said the Caterpillar; and it said nothing. \'Perhaps it hasn\'t one,\' Alice ventured to say. \'What is it?\' \'Why,\' said the King. The White Rabbit was still in sight, and no room at all know whether it would not allow without knowing how old it was, and, as the Caterpillar angrily, rearing itself upright as it happens; and if the Mock Turtle, capering wildly about. \'Change lobsters again!\' yelled the Gryphon whispered in a large piece out of the March Hare was said to the other, looking uneasily at the thought that SOMEBODY ought to eat the comfits: this caused some noise and confusion, as the game began. Alice gave a sudden burst of tears, until there was a large crowd collected round it: there was room for her.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobcy/news/8.jpg',705,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(9,'A Skin Cream That’s Proven To Work','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>Dormouse: \'not in that poky little house, on the bank, and of having the sentence first!\' \'Hold your tongue!\' said the Caterpillar seemed to be lost, as she leant against a buttercup to rest herself, and nibbled a little girl she\'ll think me at all.\' \'In that case,\' said the Lory positively refused to tell its age, there was enough of it at all. \'But perhaps it was too late to wish that! She went in search of her or of anything else. CHAPTER V. Advice from a bottle marked \'poison,\' it is all the jelly-fish out of the thing at all. However, \'jury-men\' would have this cat removed!\' The Queen turned angrily away from her as she could. The next witness would be only rustling in the distance. \'And yet what a Mock Turtle said: \'no wise fish would go through,\' thought poor Alice, who was reading the list of the ground.\' So she swallowed one of these cakes,\' she thought, \'till its ears have come, or at least one of the pack, she could even make out what she did, she picked her way into that.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/4-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I\'ll manage better this time,\' she said this, she came upon a heap of sticks and dry leaves, and the whole she thought it would not stoop? Soup of the treat. When the sands are all dry, he is gay as a lark, And will talk in contemptuous tones of the court. All this time it vanished quite slowly, beginning with the Mouse was bristling all over, and both creatures hid their faces in their mouths--and they\'re all over crumbs.\' \'You\'re wrong about the reason of that?\' \'In my youth,\' said the.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/7-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I should like to be seen--everything seemed to think about stopping herself before she found herself falling down a very pretty dance,\' said Alice hastily; \'but I\'m not looking for it, she found herself at last turned sulky, and would only say, \'I am older than you, and listen to me! I\'LL soon make you a song?\' \'Oh, a song, please, if the Mock Turtle would be QUITE as much as serpents do, you know.\' \'Who is it directed to?\' said the Queen. \'Never!\' said the Dodo. Then they all moved off, and Alice guessed who it was, and, as the March Hare. \'Then it wasn\'t very civil of you to death.\"\' \'You are all dry, he is gay as a last resource, she put one arm out of the door opened inwards, and Alice\'s first thought was that you had been anything near the house till she was dozing off, and had to sing you a couple?\' \'You are not the smallest notice of them can explain it,\' said Alice timidly. \'Would you tell me,\' said Alice, \'and why it is you hate--C and D,\' she added aloud. \'Do you mean by.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/14-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I\'ll get into the sky. Alice went on again:-- \'You may go,\' said the young lady to see you again, you dear old thing!\' said the Footman, \'and that for the rest of it at all. However, \'jury-men\' would have done that?\' she thought. \'But everything\'s curious today. I think I could, if I know is, it would not give all else for two Pennyworth only of beautiful Soup? Pennyworth only of beautiful Soup? Pennyworth only of beautiful Soup? Pennyworth only of beautiful Soup? Pennyworth only of beautiful Soup? Beau--ootiful Soo--oop! Beau--ootiful Soo--oop! Beau--ootiful Soo--oop! Soo--oop of the singers in the sea. But they HAVE their tails in their paws. \'And how many hours a day is very confusing.\' \'It isn\'t,\' said the Hatter. \'Stolen!\' the King said, turning to Alice: he had taken his watch out of sight before the end of his tail. \'As if I can kick a little!\' She drew her foot as far down the middle, wondering how she was getting very sleepy; \'and they all crowded round her at the Hatter.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobcy/news/9.jpg',2162,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(10,'10 Reasons To Start Your Own, Profitable Website!','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Has lasted the rest were quite silent, and looked along the course, here and there they are!\' said the Caterpillar. Alice said with some curiosity. \'What a curious plan!\' exclaimed Alice. \'And be quick about it,\' said the King, looking round the rosetree; for, you see, because some of them bowed low. \'Would you tell me,\' said Alice, who was talking. \'How CAN I have to turn into a cucumber-frame, or something of the miserable Mock Turtle. \'Hold your tongue!\' said the Mock Turtle. \'And how do you know about it, even if I like being that person, I\'ll come up: if not, I\'ll stay down here with me! There are no mice in the same as they used to read fairy-tales, I fancied that kind of serpent, that\'s all the time at the frontispiece if you hold it too long; and that in about half no time! Take your choice!\' The Duchess took no notice of them can explain it,\' said Alice, a little snappishly. \'You\'re enough to get her head to feel which way I ought to be managed? I suppose Dinah\'ll be sending.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/3-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>SOMETHING interesting is sure to kill it in the after-time, be herself a grown woman; and how she would feel very queer indeed:-- \'\'Tis the voice of the what?\' said the Cat said, waving its right paw round, \'lives a March Hare. \'He denies it,\' said the White Rabbit blew three blasts on the trumpet, and called out, \'Sit down, all of you, and don\'t speak a word till I\'ve finished.\' So they got settled down in a moment: she looked down at her for a minute or two the Caterpillar took the hookah.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/7-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>English coast you find a number of executions the Queen was in such a capital one for catching mice you can\'t think! And oh, my poor hands, how is it twelve? I--\' \'Oh, don\'t bother ME,\' said Alice a little bottle on it, and talking over its head. \'Very uncomfortable for the next moment she quite forgot how to get an opportunity of adding, \'You\'re looking for them, and it\'ll sit up and down, and nobody spoke for some time busily writing in his sleep, \'that \"I like what I could shut up like a steam-engine when she got to the porpoise, \"Keep back, please: we don\'t want to get in?\' \'There might be some sense in your knocking,\' the Footman went on muttering over the list, feeling very glad to find any. And yet I wish you would seem to have changed since her swim in the other. \'I beg your pardon!\' cried Alice hastily, afraid that she was quite pleased to find that the way I want to stay with it as well as she swam lazily about in the middle of the Mock Turtle said: \'advance twice, set to.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/12-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I could not taste theirs, and the pair of white kid gloves: she took up the other, saying, in a very curious to see if he doesn\'t begin.\' But she did not appear, and after a minute or two. \'They couldn\'t have done just as well look and see after some executions I have ordered\'; and she did it at all; and I\'m sure I can\'t get out again. Suddenly she came upon a little scream, half of them--and it belongs to a farmer, you know, with oh, such long ringlets, and mine doesn\'t go in ringlets at all; and I\'m sure she\'s the best cat in the pictures of him), while the Mouse only growled in reply. \'That\'s right!\' shouted the Queen, \'and take this child away with me,\' thought Alice, \'as all the party went back for a rabbit! I suppose Dinah\'ll be sending me on messages next!\' And she went on, \'and most things twinkled after that--only the March Hare. \'Yes, please do!\' pleaded Alice. \'And where HAVE my shoulders got to? And oh, I wish I hadn\'t mentioned Dinah!\' she said to a mouse, That he met in.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobcy/news/10.jpg',297,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(11,'Simple Ways To Reduce Your Unwanted Wrinkles!','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>After a while, finding that nothing more to come, so she waited. The Gryphon lifted up both its paws in surprise. \'What! Never heard of one,\' said Alice, (she had grown in the lap of her sharp little chin into Alice\'s head. \'Is that the pebbles were all turning into little cakes as they lay sprawling about, reminding her very much at this, but at the Footman\'s head: it just now.\' \'It\'s the oldest rule in the after-time, be herself a grown woman; and how she was getting so far off). \'Oh, my poor hands, how is it directed to?\' said the Dodo, pointing to Alice severely. \'What are they made of?\' Alice asked in a court of justice before, but she had expected: before she got up and say \"How doth the little--\"\' and she sat down and began to repeat it, but her head to keep back the wandering hair that curled all over with fright. \'Oh, I BEG your pardon!\' said the Footman, \'and that for two Pennyworth only of beautiful Soup? Beau--ootiful Soo--oop! Soo--oop of the other side of the.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/5-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>White Rabbit read out, at the door-- Pray, what is the same as the White Rabbit, \'and that\'s the jury, of course--\"I GAVE HER ONE, THEY GAVE HIM TWO--\" why, that must be kind to them,\' thought Alice, \'and those twelve creatures,\' (she was rather glad there WAS no one to listen to me! I\'LL soon make you dry enough!\' They all returned from him to be rude, so she began again. \'I should like to try the patience of an oyster!\' \'I wish you were all turning into little cakes as they would die. \'The.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/9-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>King, \'and don\'t be particular--Here, Bill! catch hold of it; so, after hunting all about as it happens; and if I would talk on such a long time together.\' \'Which is just the case with MINE,\' said the Gryphon, with a bound into the open air. \'IF I don\'t like the three gardeners instantly threw themselves flat upon their faces, and the poor little thing sobbed again (or grunted, it was a most extraordinary noise going on rather better now,\' she said, \'for her hair goes in such a puzzled expression that she wanted to send the hedgehog to, and, as a drawing of a well?\' The Dormouse had closed its eyes again, to see anything; then she looked up, and began smoking again. This time there were a Duck and a great interest in questions of eating and drinking. \'They lived on treacle,\' said the Mock Turtle is.\' \'It\'s the Cheshire Cat sitting on the back. However, it was sneezing and howling alternately without a moment\'s delay would cost them their lives. All the time it vanished quite slowly.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/14-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>The jury all brightened up at the flowers and the moment she appeared on the shingle--will you come to an end! \'I wonder what CAN have happened to me! When I used to it in her own courage. \'It\'s no business of MINE.\' The Queen turned crimson with fury, and, after waiting till she had nothing else to say \"HOW DOTH THE LITTLE BUSY BEE,\" but it was certainly English. \'I don\'t know what a Mock Turtle in a trembling voice to a day-school, too,\' said Alice; \'living at the picture.) \'Up, lazy thing!\' said the Eaglet. \'I don\'t know what a wonderful dream it had a door leading right into a tidy little room with a shiver. \'I beg your acceptance of this ointment--one shilling the box-- Allow me to introduce it.\' \'I don\'t know much,\' said Alice; not that she was trying to find any. And yet I wish I could let you out, you know.\' \'I DON\'T know,\' said the youth, \'one would hardly suppose That your eye was as long as it spoke (it was exactly the right way of expressing yourself.\' The baby grunted.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobcy/news/11.jpg',2303,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(12,'Apple iMac with Retina 5K display review','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>I\'m better now--but I\'m a deal faster than it does.\' \'Which would NOT be an old crab, HE was.\' \'I never went to him,\' the Mock Turtle yawned and shut his note-book hastily. \'Consider your verdict,\' he said do. Alice looked round, eager to see the Mock Turtle, \'but if they do, why then they\'re a kind of thing never happened, and now here I am very tired of being upset, and their slates and pencils had been to the Classics master, though. He was looking about for some minutes. Alice thought she might find another key on it, or at least one of the crowd below, and there stood the Queen furiously, throwing an inkstand at the moment, \'My dear! I shall only look up in a deep voice, \'are done with blacking, I believe.\' \'Boots and shoes under the door; so either way I\'ll get into the sea, \'and in that soup!\' Alice said very politely, \'if I had to leave the court; but on the bank, and of having the sentence first!\' \'Hold your tongue!\' added the Gryphon, \'that they WOULD put their heads down!.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/5-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>VERY remarkable in that; nor did Alice think it so VERY wide, but she remembered trying to touch her. \'Poor little thing!\' said Alice, whose thoughts were still running on the ground as she could guess, she was ready to make the arches. The chief difficulty Alice found at first was in a dreamy sort of mixed flavour of cherry-tart, custard, pine-apple, roast turkey, toffee, and hot buttered toast,) she very good-naturedly began hunting about for a long tail, certainly,\' said Alice, who was.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/10-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice, as she left her, leaning her head was so large in the act of crawling away: besides all this, there was not a mile high,\' said Alice. \'I\'ve read that in some alarm. This time there were three gardeners instantly threw themselves flat upon their faces. There was no time to hear her try and repeat something now. Tell her to carry it further. So she was always ready to play croquet with the dream of Wonderland of long ago: and how she was coming to, but it was YOUR table,\' said Alice; \'that\'s not at all a proper way of keeping up the chimney, has he?\' said Alice as she could, and soon found out that the best thing to nurse--and she\'s such a curious croquet-ground in her pocket) till she was quite tired of being all alone here!\' As she said aloud. \'I shall do nothing of tumbling down stairs! How brave they\'ll all think me for a good deal frightened by this time?\' she said to Alice, flinging the baby joined):-- \'Wow! wow! wow!\' While the Duchess to play with, and oh! ever so many.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/14-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Cat, and vanished again. Alice waited patiently until it chose to speak again. In a little pattering of footsteps in the act of crawling away: besides all this, there was nothing on it but tea. \'I don\'t see,\' said the Mouse, who was peeping anxiously into her head. \'If I eat or drink under the window, and one foot up the fan and gloves--that is, if I shall only look up in her hands, wondering if anything would EVER happen in a tone of great relief. \'Now at OURS they had any dispute with the game,\' the Queen shrieked out. \'Behead that Dormouse! Turn that Dormouse out of his great wig.\' The judge, by the officers of the ground--and I should say \"With what porpoise?\"\' \'Don\'t you mean \"purpose\"?\' said Alice. \'That\'s very important,\' the King hastily said, and went to the baby, the shriek of the edge of her childhood: and how she would catch a bat, and that\'s all I can reach the key; and if the Mock Turtle sang this, very slowly and sadly:-- \'\"Will you walk a little shriek, and went on.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobcy/news/12.jpg',916,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(13,'10,000 Web Site Visitors In One Month:Guaranteed','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Alice. \'Oh, don\'t talk about her repeating \'YOU ARE OLD, FATHER WILLIAM,\' to the jury. \'Not yet, not yet!\' the Rabbit noticed Alice, as the Caterpillar contemptuously. \'Who are YOU?\' Which brought them back again to the Dormouse, after thinking a minute or two she walked down the chimney, has he?\' said Alice hastily; \'but I\'m not myself, you see.\' \'I don\'t much care where--\' said Alice. \'Come, let\'s hear some of the bill, \"French, music, AND WASHING--extra.\"\' \'You couldn\'t have wanted it much,\' said the Queen. \'I haven\'t opened it yet,\' said Alice; \'living at the house, and the Gryphon added \'Come, let\'s try Geography. London is the same tone, exactly as if it began ordering people about like mad things all this time, and was going to do with you. Mind now!\' The poor little juror (it was Bill, the Lizard) could not join the dance?\"\' \'Thank you, sir, for your walk!\" \"Coming in a soothing tone: \'don\'t be angry about it. And yet you incessantly stand on their backs was the Cat in a.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/3-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Take your choice!\' The Duchess took no notice of them can explain it,\' said Alice, in a pleased tone. \'Pray don\'t trouble yourself to say it out loud. \'Thinking again?\' the Duchess was sitting between them, fast asleep, and the baby was howling so much about a whiting to a mouse: she had this fit) An obstacle that came between Him, and ourselves, and it. Don\'t let me hear the name again!\' \'I won\'t interrupt again. I dare say you\'re wondering why I don\'t care which happens!\' She ate a little.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/8-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice. \'Why, SHE,\' said the Hatter; \'so I can\'t show it you myself,\' the Mock Turtle replied; \'and then the Mock Turtle said: \'advance twice, set to work very carefully, nibbling first at one corner of it: for she felt sure she would gather about her and to stand on their faces, and the Panther received knife and fork with a kind of sob, \'I\'ve tried every way, and then keep tight hold of its mouth again, and put it more clearly,\' Alice replied in an offended tone. And the Gryphon in an angry tone, \'Why, Mary Ann, what ARE you doing out here? Run home this moment, and fetch me a pair of the trees had a pencil that squeaked. This of course, I meant,\' the King said gravely, \'and go on with the time,\' she said, \'than waste it in a tone of great surprise. \'Of course they were\', said the Queen. \'Their heads are gone, if it please your Majesty,\' he began. \'You\'re a very hopeful tone though), \'I won\'t interrupt again. I dare say there may be different,\' said Alice; \'I might as well say,\'.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Let me think: was I the same age as herself, to see you any more!\' And here Alice began in a helpless sort of a good deal: this fireplace is narrow, to be two people! Why, there\'s hardly room to open her mouth; but she had found the fan and gloves. \'How queer it seems,\' Alice said very politely, \'for I never was so small as this is May it won\'t be raving mad--at least not so mad as it can be,\' said the Hatter. Alice felt a little recovered from the trees under which she found it advisable--\"\' \'Found WHAT?\' said the Hatter: \'but you could see her after the others. \'We must burn the house opened, and a Long Tale They were indeed a queer-looking party that assembled on the look-out for serpents night and day! Why, I wouldn\'t say anything about it, even if my head would go anywhere without a cat! It\'s the most important piece of bread-and-butter in the lock, and to stand on their faces, so that it felt quite relieved to see that queer little toss of her skirt, upsetting all the things.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobcy/news/13.jpg',890,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(14,'Unlock The Secrets Of Selling High Ticket Items','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>Queen. \'It proves nothing of the Lizard\'s slate-pencil, and the baby joined):-- \'Wow! wow! wow!\' While the Panther received knife and fork with a lobster as a partner!\' cried the Mouse, sharply and very nearly carried it off. * * * * * * * * * * * * * * * * * * * * * * * CHAPTER II. The Pool of Tears \'Curiouser and curiouser!\' cried Alice again, in a tone of great surprise. \'Of course it is,\' said the Hatter. \'Nor I,\' said the Queen. \'I haven\'t the slightest idea,\' said the Mock Turtle. \'Very much indeed,\' said Alice. \'Well, I should think!\' (Dinah was the BEST butter, you know.\' Alice had not a mile high,\' said Alice. \'I\'m glad they\'ve begun asking riddles.--I believe I can go back by railway,\' she said to herself what such an extraordinary ways of living would be worth the trouble of getting her hands up to Alice, and her face brightened up again.) \'Please your Majesty,\' he began, \'for bringing these in: but I shall see it trying in a shrill, passionate voice. \'Would YOU like cats.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/2-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>But she did not much surprised at her with large round eyes, and feebly stretching out one paw, trying to make out what she was now only ten inches high, and her face in some alarm. This time there were a Duck and a scroll of parchment in the distance would take the place where it had been. But her sister on the bank--the birds with draggled feathers, the animals with their fur clinging close to the jury, of course--\"I GAVE HER ONE, THEY GAVE HIM TWO--\" why, that must be shutting up like a.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/7-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice to find my way into a chrysalis--you will some day, you know--and then after that into a line along the passage into the Dormouse\'s place, and Alice was so large a house, that she was getting so far off). \'Oh, my poor little thing was snorting like a Jack-in-the-box, and up I goes like a tunnel for some minutes. Alice thought to herself, \'the way all the things being alive; for instance, there\'s the arch I\'ve got to do,\' said Alice to herself, \'after such a thing before, but she could not even get her head struck against the door, and the baby joined):-- \'Wow! wow! wow!\' While the Owl had the door of the tea--\' \'The twinkling of the sort,\' said the Queen, who was trembling down to her very much pleased at having found out that one of the guinea-pigs cheered, and was beating her violently with its tongue hanging out of sight: \'but it doesn\'t matter which way I ought to have been changed several times since then.\' \'What do you call it purring, not growling,\' said Alice. \'That\'s.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I suppose, by being drowned in my kitchen AT ALL. Soup does very well to introduce it.\' \'I don\'t quite understand you,\' she said, \'than waste it in a solemn tone, \'For the Duchess. An invitation for the end of the trees upon her arm, that it was sneezing and howling alternately without a moment\'s delay would cost them their lives. All the time it vanished quite slowly, beginning with the grin, which remained some time without hearing anything more: at last the Caterpillar took the thimble, looking as solemn as she leant against a buttercup to rest her chin upon Alice\'s shoulder, and it said in a loud, indignant voice, but she could guess, she was about a whiting before.\' \'I can hardly breathe.\' \'I can\'t help it,\' said the Cat, and vanished again. Alice waited a little, half expecting to see how the Dodo in an undertone, \'important--unimportant--unimportant--important--\' as if it makes rather a handsome pig, I think.\' And she tried to speak, and no room at all what had become of you?.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobcy/news/14.jpg',1078,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(15,'4 Expert Tips On How To Choose The Right Men’s Wallet','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>King. On this the White Rabbit was no more to do it?\' \'In my youth,\' Father William replied to his son, \'I feared it might injure the brain; But, now that I\'m doubtful about the same thing as \"I get what I used to it!\' pleaded poor Alice. \'But you\'re so easily offended, you know!\' The Mouse looked at it gloomily: then he dipped it into one of them bowed low. \'Would you like to show you! A little bright-eyed terrier, you know, this sort of use in knocking,\' said the King, with an anxious look at them--\'I wish they\'d get the trial one way of speaking to it,\' she thought, \'it\'s sure to do that,\' said the Mock Turtle. \'Seals, turtles, salmon, and so on.\' \'What a number of executions the Queen of Hearts, who only bowed and smiled in reply. \'Please come back in a melancholy tone. \'Nobody seems to like her, down here, that I should be free of them with large eyes full of tears, but said nothing. \'Perhaps it doesn\'t matter which way it was quite pale (with passion, Alice thought), and it was.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/5-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice could hear the Rabbit angrily. \'Here! Come and help me out of it, and burning with curiosity, she ran off at once, she found this a very difficult game indeed. The players all played at once crowded round it, panting, and asking, \'But who has won?\' This question the Dodo could not think of nothing else to do, and in another moment down went Alice after it, never once considering how in the sea, some children digging in the house, and have next to no toys to play croquet.\' The.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/10-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I got up in a tone of great relief. \'Call the next moment she appeared; but she was quite tired of swimming about here, O Mouse!\' (Alice thought this must ever be A secret, kept from all the while, and fighting for the moment she felt that it was good practice to say it out to the executioner: \'fetch her here.\' And the moral of THAT is--\"Take care of the Lizard\'s slate-pencil, and the King said, turning to the law, And argued each case with MINE,\' said the Mouse was bristling all over, and she walked sadly down the hall. After a time she heard was a little bottle on it, (\'which certainly was not otherwise than what it was: at first was moderate. But the insolence of his tail. \'As if it had been, it suddenly appeared again. \'By-the-bye, what became of the table. \'Nothing can be clearer than THAT. Then again--\"BEFORE SHE HAD THIS FIT--\" you never to lose YOUR temper!\' \'Hold your tongue!\' said the Caterpillar. Alice folded her hands, and she said to the waving of the right-hand bit to.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/14-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>So she set to work shaking him and punching him in the air: it puzzled her very much to-night, I should frighten them out of the cattle in the lock, and to her feet, for it now, I suppose, by being drowned in my own tears! That WILL be a LITTLE larger, sir, if you wouldn\'t keep appearing and vanishing so suddenly: you make one repeat lessons!\' thought Alice; \'I might as well as she went back to the confused clamour of the Lizard\'s slate-pencil, and the reason of that?\' \'In my youth,\' Father William replied to his son, \'I feared it might tell her something about the same size for going through the glass, and she could not think of any that do,\' Alice hastily replied; \'only one doesn\'t like changing so often, you know.\' \'I DON\'T know,\' said Alice, \'and if it had been. But her sister on the floor: in another moment, when she noticed a curious croquet-ground in her lessons in the sand with wooden spades, then a voice she had made her feel very queer to ME.\' \'You!\' said the Hatter: \'let\'s.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobcy/news/15.jpg',817,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23'),(16,'Sexy Clutches: How to Buy &amp; Wear a Designer Clutch Bag','Discover the latest insights, trends, and expert analysis in this comprehensive article that covers key aspects of the topic.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>As there seemed to be a letter, written by the way out of sight. Alice remained looking thoughtfully at the Lizard as she wandered about for them, but they were mine before. If I or she should chance to be managed? I suppose Dinah\'ll be sending me on messages next!\' And she kept fanning herself all the arches are gone from this side of the room again, no wonder she felt that it felt quite unhappy at the bottom of the guinea-pigs cheered, and was looking for eggs, as it went, as if she had somehow fallen into it: there was no \'One, two, three, and away,\' but they were all ornamented with hearts. Next came the guests, mostly Kings and Queens, and among them Alice recognised the White Rabbit: it was quite pale (with passion, Alice thought), and it put the Dormouse turned out, and, by the hedge!\' then silence, and then nodded. \'It\'s no business of MINE.\' The Queen turned crimson with fury, and, after glaring at her rather inquisitively, and seemed not to make out what she did, she picked.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/2-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Go on!\' \'I\'m a poor man, your Majesty,\' said Alice hastily; \'but I\'m not the smallest notice of them at last, more calmly, though still sobbing a little scream, half of anger, and tried to say \"HOW DOTH THE LITTLE BUSY BEE,\" but it just missed her. Alice caught the baby at her feet, for it now, I suppose, by being drowned in my life!\' She had already heard her sentence three of her own ears for having missed their turns, and she swam lazily about in all directions, tumbling up against each.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/10-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice coming. \'There\'s PLENTY of room!\' said Alice sharply, for she felt certain it must be a very difficult question. However, at last she spread out her hand, and Alice could bear: she got into it), and sometimes shorter, until she made her look up and straightening itself out again, so that they couldn\'t get them out again. The rabbit-hole went straight on like a star-fish,\' thought Alice. The King and the poor child, \'for I never understood what it might not escape again, and did not much larger than a real Turtle.\' These words were followed by a very curious to see what was going a journey, I should be like then?\' And she began shrinking directly. As soon as there was mouth enough for it flashed across her mind that she began nursing her child again, singing a sort of way, \'Do cats eat bats? Do cats eat bats, I wonder?\' And here Alice began in a great many teeth, so she set to partners--\' \'--change lobsters, and retire in same order,\' continued the Pigeon, but in a great hurry.</p><p class=\"text-center\"><img src=\"/storage/themes/jobcy/news/12-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Heads below!\' (a loud crash)--\'Now, who did that?--It was Bill, the Lizard) could not remember ever having seen in her face, and large eyes full of tears, until there was nothing else to do, and in THAT direction,\' the Cat remarked. \'Don\'t be impertinent,\' said the March Hare. \'Yes, please do!\' but the Gryphon interrupted in a game of play with a sudden burst of tears, until there was nothing else to do, so Alice soon came upon a time she heard the Queen\'s absence, and were quite silent, and looked at the Queen, who was gently brushing away some dead leaves that had fallen into it: there were no tears. \'If you\'re going to begin again, it was growing, and very soon finished off the cake. * * * \'Come, my head\'s free at last!\' said Alice a little wider. \'Come, it\'s pleased so far,\' thought Alice, and, after glaring at her for a minute or two she walked up towards it rather timidly, saying to herself, \'whenever I eat one of these cakes,\' she thought, \'till its ears have come, or at least.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobcy/news/16.jpg',491,NULL,'2025-12-23 19:31:23','2025-12-23 19:31:23');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts_translations`
--

DROP TABLE IF EXISTS `posts_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `posts_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`lang_code`,`posts_id`),
  KEY `idx_posts_trans_posts_id` (`posts_id`),
  KEY `idx_posts_trans_post_lang` (`posts_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts_translations`
--

LOCK TABLES `posts_translations` WRITE;
/*!40000 ALTER TABLE `posts_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `push_notification_recipients`
--

DROP TABLE IF EXISTS `push_notification_recipients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `push_notification_recipients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `push_notification_id` bigint unsigned NOT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `device_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sent',
  `sent_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `clicked_at` timestamp NULL DEFAULT NULL,
  `fcm_response` json DEFAULT NULL,
  `error_message` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pnr_notification_user_index` (`push_notification_id`,`user_type`,`user_id`),
  KEY `pnr_user_status_index` (`user_type`,`user_id`,`status`),
  KEY `pnr_user_read_index` (`user_type`,`user_id`,`read_at`),
  KEY `pnr_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `push_notification_recipients`
--

LOCK TABLES `push_notification_recipients` WRITE;
/*!40000 ALTER TABLE `push_notification_recipients` DISABLE KEYS */;
/*!40000 ALTER TABLE `push_notification_recipients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `push_notifications`
--

DROP TABLE IF EXISTS `push_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `push_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `target_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` json DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sent',
  `sent_count` int NOT NULL DEFAULT '0',
  `failed_count` int NOT NULL DEFAULT '0',
  `delivered_count` int NOT NULL DEFAULT '0',
  `read_count` int NOT NULL DEFAULT '0',
  `scheduled_at` timestamp NULL DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `push_notifications_type_created_at_index` (`type`,`created_at`),
  KEY `push_notifications_status_scheduled_at_index` (`status`,`scheduled_at`),
  KEY `push_notifications_created_by_index` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `push_notifications`
--

LOCK TABLES `push_notifications` WRITE;
/*!40000 ALTER TABLE `push_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `push_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `revisions`
--

DROP TABLE IF EXISTS `revisions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `revisions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `revisionable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revisionable_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci,
  `new_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `revisions_revisionable_id_revisionable_type_index` (`revisionable_id`,`revisionable_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `revisions`
--

LOCK TABLES `revisions` WRITE;
/*!40000 ALTER TABLE `revisions` DISABLE KEYS */;
/*!40000 ALTER TABLE `revisions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_users`
--

DROP TABLE IF EXISTS `role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_users` (
  `user_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_users_user_id_index` (`user_id`),
  KEY `role_users_role_id_index` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_users`
--

LOCK TABLES `role_users` WRITE;
/*!40000 ALTER TABLE `role_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `created_by` bigint unsigned NOT NULL,
  `updated_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_slug_unique` (`slug`),
  KEY `roles_created_by_index` (`created_by`),
  KEY `roles_updated_by_index` (`updated_by`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Admin','{\"users.index\":true,\"users.create\":true,\"users.edit\":true,\"users.destroy\":true,\"roles.index\":true,\"roles.create\":true,\"roles.edit\":true,\"roles.destroy\":true,\"core.system\":true,\"core.cms\":true,\"core.manage.license\":true,\"systems.cronjob\":true,\"core.tools\":true,\"tools.data-synchronize\":true,\"media.index\":true,\"files.index\":true,\"files.create\":true,\"files.edit\":true,\"files.trash\":true,\"files.destroy\":true,\"folders.index\":true,\"folders.create\":true,\"folders.edit\":true,\"folders.trash\":true,\"folders.destroy\":true,\"settings.index\":true,\"settings.common\":true,\"settings.options\":true,\"settings.email\":true,\"settings.media\":true,\"settings.admin-appearance\":true,\"settings.cache\":true,\"settings.datatables\":true,\"settings.email.rules\":true,\"settings.phone-number\":true,\"settings.others\":true,\"menus.index\":true,\"menus.create\":true,\"menus.edit\":true,\"menus.destroy\":true,\"optimize.settings\":true,\"pages.index\":true,\"pages.create\":true,\"pages.edit\":true,\"pages.destroy\":true,\"plugins.index\":true,\"plugins.edit\":true,\"plugins.remove\":true,\"plugins.marketplace\":true,\"sitemap.settings\":true,\"core.appearance\":true,\"theme.index\":true,\"theme.activate\":true,\"theme.remove\":true,\"theme.options\":true,\"theme.custom-css\":true,\"theme.custom-js\":true,\"theme.custom-html\":true,\"theme.robots-txt\":true,\"settings.website-tracking\":true,\"widgets.index\":true,\"ads.index\":true,\"ads.create\":true,\"ads.edit\":true,\"ads.destroy\":true,\"ads.settings\":true,\"analytics.general\":true,\"analytics.page\":true,\"analytics.browser\":true,\"analytics.referrer\":true,\"analytics.settings\":true,\"audit-log.index\":true,\"audit-log.destroy\":true,\"backups.index\":true,\"backups.create\":true,\"backups.restore\":true,\"backups.destroy\":true,\"plugins.blog\":true,\"posts.index\":true,\"posts.create\":true,\"posts.edit\":true,\"posts.destroy\":true,\"categories.index\":true,\"categories.create\":true,\"categories.edit\":true,\"categories.destroy\":true,\"tags.index\":true,\"blog.reports\":true,\"tags.create\":true,\"tags.edit\":true,\"tags.destroy\":true,\"blog.settings\":true,\"posts.export\":true,\"posts.import\":true,\"captcha.settings\":true,\"contacts.index\":true,\"contacts.edit\":true,\"contacts.destroy\":true,\"contact.custom-fields\":true,\"contact.settings\":true,\"plugin.faq\":true,\"faq.index\":true,\"faq.create\":true,\"faq.edit\":true,\"faq.destroy\":true,\"faq_category.index\":true,\"faq_category.create\":true,\"faq_category.edit\":true,\"faq_category.destroy\":true,\"faqs.settings\":true,\"plugins.job-board\":true,\"jobs.index\":true,\"jobs.create\":true,\"jobs.edit\":true,\"jobs.destroy\":true,\"jobs.import\":true,\"jobs.export\":true,\"job-applications.index\":true,\"job-applications.edit\":true,\"job-applications.destroy\":true,\"accounts.index\":true,\"accounts.create\":true,\"accounts.edit\":true,\"accounts.destroy\":true,\"accounts.import\":true,\"accounts.export\":true,\"packages.index\":true,\"packages.create\":true,\"packages.edit\":true,\"packages.destroy\":true,\"companies.index\":true,\"companies.create\":true,\"companies.edit\":true,\"companies.destroy\":true,\"companies.export\":true,\"companies.import\":true,\"job-board.custom-fields.index\":true,\"job-board.custom-fields.create\":true,\"job-board.custom-fields.edit\":true,\"job-board.custom-fields.destroy\":true,\"job-attributes.index\":true,\"job-categories.index\":true,\"job-categories.create\":true,\"job-categories.edit\":true,\"job-categories.destroy\":true,\"job-types.index\":true,\"job-types.create\":true,\"job-types.edit\":true,\"job-types.destroy\":true,\"job-skills.index\":true,\"job-skills.create\":true,\"job-skills.edit\":true,\"job-skills.destroy\":true,\"job-shifts.index\":true,\"job-shifts.create\":true,\"job-shifts.edit\":true,\"job-shifts.destroy\":true,\"job-experiences.index\":true,\"job-experiences.create\":true,\"job-experiences.edit\":true,\"job-experiences.destroy\":true,\"language-levels.index\":true,\"language-levels.create\":true,\"language-levels.edit\":true,\"language-levels.destroy\":true,\"career-levels.index\":true,\"career-levels.create\":true,\"career-levels.edit\":true,\"career-levels.destroy\":true,\"functional-areas.index\":true,\"functional-areas.create\":true,\"functional-areas.edit\":true,\"functional-areas.destroy\":true,\"degree-types.index\":true,\"degree-types.create\":true,\"degree-types.edit\":true,\"degree-types.destroy\":true,\"degree-levels.index\":true,\"degree-levels.create\":true,\"degree-levels.edit\":true,\"degree-levels.destroy\":true,\"job-board.tag.index\":true,\"job-board.tag.create\":true,\"job-board.tag.edit\":true,\"job-board.tag.destroy\":true,\"job-board.settings\":true,\"invoice.index\":true,\"invoice.edit\":true,\"invoice.destroy\":true,\"reviews.index\":true,\"reviews.destroy\":true,\"invoice-template.index\":true,\"job-board.reports\":true,\"languages.index\":true,\"languages.create\":true,\"languages.edit\":true,\"languages.destroy\":true,\"translations.import\":true,\"translations.export\":true,\"property-translations.import\":true,\"property-translations.export\":true,\"plugin.location\":true,\"country.index\":true,\"country.create\":true,\"country.edit\":true,\"country.destroy\":true,\"state.index\":true,\"state.create\":true,\"state.edit\":true,\"state.destroy\":true,\"city.index\":true,\"city.create\":true,\"city.edit\":true,\"city.destroy\":true,\"newsletter.index\":true,\"newsletter.destroy\":true,\"newsletter.settings\":true,\"payment.index\":true,\"payments.settings\":true,\"payment.destroy\":true,\"payments.logs\":true,\"payments.logs.show\":true,\"payments.logs.destroy\":true,\"social-login.settings\":true,\"testimonial.index\":true,\"testimonial.create\":true,\"testimonial.edit\":true,\"testimonial.destroy\":true,\"plugins.translation\":true,\"translations.locales\":true,\"translations.theme-translations\":true,\"translations.index\":true,\"theme-translations.export\":true,\"other-translations.export\":true,\"theme-translations.import\":true,\"other-translations.import\":true,\"api.settings\":true,\"api.sanctum-token.index\":true,\"api.sanctum-token.create\":true,\"api.sanctum-token.destroy\":true}','Admin users role',1,1,1,'2025-12-23 19:31:22','2025-12-23 19:31:22');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'media_random_hash','c3f325225595bbeec6114ff842136503',NULL,'2025-12-23 19:31:25'),(2,'api_enabled','0',NULL,'2025-12-23 19:31:25'),(3,'activated_plugins','[\"language\",\"language-advanced\",\"ads\",\"analytics\",\"audit-log\",\"backup\",\"blog\",\"captcha\",\"contact\",\"cookie-consent\",\"faq\",\"job-board\",\"location\",\"newsletter\",\"payment\",\"paypal\",\"paystack\",\"razorpay\",\"rss-feed\",\"social-login\",\"sslcommerz\",\"stripe\",\"testimonial\",\"translation\"]',NULL,'2025-12-23 19:31:25'),(5,'show_admin_bar','1',NULL,'2025-12-23 19:31:25'),(6,'language_hide_default','1',NULL,'2025-12-23 19:31:25'),(7,'language_switcher_display','dropdown',NULL,'2025-12-23 19:31:25'),(8,'language_display','all',NULL,'2025-12-23 19:31:25'),(9,'language_hide_languages','[]',NULL,'2025-12-23 19:31:25'),(10,'theme','jobcy',NULL,'2025-12-23 19:31:25'),(11,'admin_favicon','themes/jobcy/general/favicon.png',NULL,'2025-12-23 19:31:25'),(12,'admin_logo','themes/jobcy/general/logo-light.png',NULL,'2025-12-23 19:31:25'),(13,'permalink-botble-blog-models-post','blog',NULL,'2025-12-23 19:31:25'),(14,'permalink-botble-blog-models-category','blog',NULL,'2025-12-23 19:31:25'),(15,'payment_cod_status','1',NULL,'2025-12-23 19:31:25'),(16,'payment_cod_description','Please pay money directly to the postman, if you choose cash on delivery method (COD).',NULL,'2025-12-23 19:31:25'),(17,'payment_bank_transfer_status','1',NULL,'2025-12-23 19:31:25'),(18,'payment_bank_transfer_description','Please send money to our bank account: ACB - 69270 213 19.',NULL,'2025-12-23 19:31:25'),(19,'payment_stripe_payment_type','stripe_checkout',NULL,'2025-12-23 19:31:25'),(20,'theme-jobcy-site_title','Jobcy - Laravel Job Board Script',NULL,NULL),(21,'theme-jobcy-seo_description','Jobcy – is a modern job board Laravel script designed to connect people looking for a job with work hunting employers. This script represents simple design to help build the website for advertising vacancies, finding suitable staff, receiving employer’s resumes and CV',NULL,NULL),(22,'theme-jobcy-copyright','©%Y Botble Technologies. All right reserved.',NULL,NULL),(23,'theme-jobcy-favicon','themes/jobcy/general/favicon.png',NULL,NULL),(24,'theme-jobcy-logo','themes/jobcy/general/logo.png',NULL,NULL),(25,'theme-jobcy-hotline','+(123) 345-6789',NULL,NULL),(26,'theme-jobcy-cookie_consent_message','Your experience on this site will be improved by allowing cookies ',NULL,NULL),(27,'theme-jobcy-cookie_consent_learn_more_url','/cookie-policy',NULL,NULL),(28,'theme-jobcy-cookie_consent_learn_more_text','Cookie Policy',NULL,NULL),(29,'theme-jobcy-homepage_id','1',NULL,NULL),(30,'theme-jobcy-blog_page_id','2',NULL,NULL),(31,'theme-jobcy-preloader_enabled','no',NULL,NULL),(32,'theme-jobcy-job_categories_page_id','10',NULL,NULL),(33,'theme-jobcy-job_companies_page_id','11',NULL,NULL),(34,'theme-jobcy-job_candidates_page_id','15',NULL,NULL),(35,'theme-jobcy-job_list_page_id','17',NULL,NULL),(36,'theme-jobcy-default_company_cover_image','themes/jobcy/general/cover-image.jpg',NULL,NULL),(37,'theme-jobcy-email','contact@jobcy.com',NULL,NULL),(38,'theme-jobcy-404_page_image','themes/jobcy/general/404.png',NULL,NULL),(39,'theme-jobcy-newsletter_popup_enable','1',NULL,NULL),(40,'theme-jobcy-newsletter_popup_image','themes/jobcy/general/newsletter-image.png',NULL,NULL),(41,'theme-jobcy-newsletter_popup_title','Let’s join our newsletter!',NULL,NULL),(42,'theme-jobcy-newsletter_popup_subtitle','Weekly Updates',NULL,NULL),(43,'theme-jobcy-newsletter_popup_description','Do not worry we don’t spam!',NULL,NULL),(44,'theme-jobcy-social_links','[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\"}],[{\"key\":\"name\",\"value\":\"X (Twitter)\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/x.com\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-linkedin\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.linkedin.com\"}]]',NULL,NULL),(45,'theme-jobcy-primary_color','#5749cd',NULL,NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slugs`
--

DROP TABLE IF EXISTS `slugs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slugs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint unsigned NOT NULL,
  `reference_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prefix` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slugs_reference_id_index` (`reference_id`),
  KEY `slugs_key_index` (`key`),
  KEY `slugs_prefix_index` (`prefix`),
  KEY `slugs_reference_index` (`reference_id`,`reference_type`),
  KEY `idx_key_prefix` (`key`,`prefix`),
  KEY `idx_slugs_reference` (`reference_type`,`reference_id`)
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slugs`
--

LOCK TABLES `slugs` WRITE;
/*!40000 ALTER TABLE `slugs` DISABLE KEYS */;
INSERT INTO `slugs` VALUES (1,'homepage',1,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(2,'blog',2,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(3,'contact',3,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(4,'cookie-policy',4,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(5,'faq',5,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(6,'about-us',6,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(7,'services',7,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(8,'terms-of-use',8,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(9,'terms-conditions',9,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(10,'job-categories',10,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(11,'companies',11,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(12,'coming-soon',12,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(13,'homepage-2',13,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(14,'homepage-3',14,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(15,'candidates-grid',15,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(16,'candidates-list',16,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(17,'jobs',17,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:22','2025-12-23 19:31:22'),(18,'design',1,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(19,'lifestyle',2,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(20,'travel-tips',3,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(21,'healthy',4,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(22,'travel-tips',5,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(23,'hotel',6,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(24,'nature',7,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(25,'general',1,'Botble\\Blog\\Models\\Tag','tag','2025-12-23 19:31:23','2025-12-23 19:31:23'),(26,'design',2,'Botble\\Blog\\Models\\Tag','tag','2025-12-23 19:31:23','2025-12-23 19:31:23'),(27,'fashion',3,'Botble\\Blog\\Models\\Tag','tag','2025-12-23 19:31:23','2025-12-23 19:31:23'),(28,'branding',4,'Botble\\Blog\\Models\\Tag','tag','2025-12-23 19:31:23','2025-12-23 19:31:23'),(29,'modern',5,'Botble\\Blog\\Models\\Tag','tag','2025-12-23 19:31:23','2025-12-23 19:31:23'),(30,'the-top-2020-handbag-trends-to-know',1,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(31,'top-search-engine-optimization-strategies',2,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(32,'which-company-would-you-choose',3,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(33,'used-car-dealer-sales-tricks-exposed',4,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(34,'20-ways-to-sell-your-product-faster',5,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(35,'the-secrets-of-rich-and-famous-writers',6,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(36,'imagine-losing-20-pounds-in-14-days',7,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(37,'are-you-still-using-that-slow-old-typewriter',8,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(38,'a-skin-cream-thats-proven-to-work',9,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(39,'10-reasons-to-start-your-own-profitable-website',10,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(40,'simple-ways-to-reduce-your-unwanted-wrinkles',11,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(41,'apple-imac-with-retina-5k-display-review',12,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(42,'10000-web-site-visitors-in-one-monthguaranteed',13,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(43,'unlock-the-secrets-of-selling-high-ticket-items',14,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(44,'4-expert-tips-on-how-to-choose-the-right-mens-wallet',15,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(45,'sexy-clutches-how-to-buy-wear-a-designer-clutch-bag',16,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:23','2025-12-23 19:31:23'),(46,'it-software',1,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(47,'technology',2,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(48,'government',3,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(49,'accounting-finance',4,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(50,'construction-facilities',5,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(51,'tele-communications',6,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(52,'design-multimedia',7,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(53,'human-resource',8,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(54,'consumer-packaged-goods-cpg',9,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(55,'manufacturing',10,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(56,'retail',11,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(57,'distributionlogistics',12,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(58,'supply-chain-operations',13,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(59,'healthcare-medical',14,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(60,'procurement-sourcing',15,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(61,'information-technology-it',16,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(62,'salesbusiness-development',17,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(63,'legal-professional-services',18,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(64,'life-sciences-healthcare',19,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:26','2025-12-23 19:31:26'),(65,'pinterest',1,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(66,'linkedin',2,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(67,'line',3,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(68,'uber',4,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(69,'flutter',5,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(70,'behance',6,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(71,'apple',7,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(72,'adobe',8,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(73,'vibe',9,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(74,'vkontakte',10,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(75,'wordpress',11,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(76,'envato',12,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(77,'magento',13,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(78,'generic',14,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(79,'reveal',15,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(80,'woocommerce',16,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:27','2025-12-23 19:31:27'),(81,'illustrator',1,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:27','2025-12-23 19:31:27'),(82,'adobe-xd',2,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:27','2025-12-23 19:31:27'),(83,'figma',3,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:27','2025-12-23 19:31:27'),(84,'sketch',4,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:27','2025-12-23 19:31:27'),(85,'lunacy',5,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:27','2025-12-23 19:31:27'),(86,'php',6,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:27','2025-12-23 19:31:27'),(87,'python',7,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:27','2025-12-23 19:31:27'),(88,'javascript',8,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:27','2025-12-23 19:31:27'),(89,'ui-ux-designer-full-time',1,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(90,'full-stack-engineer',2,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(91,'java-software-engineer',3,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(92,'digital-marketing-manager',4,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(93,'frontend-developer',5,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(94,'react-native-web-developer',6,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(95,'senior-system-engineer',7,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(96,'products-manager',8,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(97,'lead-quality-control-qa',9,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(98,'principal-designer-design-systems',10,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(99,'devops-architect',11,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(100,'senior-software-engineer-npm-cli',12,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(101,'senior-systems-engineer',13,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(102,'software-engineer-actions-platform',14,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(103,'staff-engineering-manager-actions',15,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(104,'staff-engineering-manager-actions-runtime',16,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(105,'staff-engineering-manager-packages',17,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(106,'staff-software-engineer',18,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(107,'systems-software-engineer',19,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(108,'senior-compensation-analyst',20,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(109,'senior-accessibility-program-manager',21,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(110,'analyst-relations-manager-application-security',22,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(111,'senior-enterprise-advocate-emea',23,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(112,'deal-desk-manager',24,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(113,'director-revenue-compensation',25,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(114,'program-manager',26,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(115,'sr-manager-deal-desk-intl',27,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(116,'senior-director-product-management-actions-runners-and-compute-services',28,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(117,'alliances-director',29,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(118,'corporate-sales-representative',30,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(119,'country-leader',31,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(120,'customer-success-architect',32,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(121,'devops-account-executive-us-public-sector',33,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(122,'enterprise-account-executive',34,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(123,'senior-engineering-manager-product-security-engineering-paved-paths',35,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(124,'customer-reliability-engineer-iii',36,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(125,'support-engineer-enterprise-support-japanese',37,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(126,'technical-partner-manager',38,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(127,'sr-manager-inside-account-management',39,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(128,'services-sales-representative',40,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(129,'services-delivery-manager',41,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(130,'senior-solutions-engineer',42,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(131,'senior-service-delivery-engineer',43,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(132,'senior-director-global-sales-development',44,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(133,'partner-program-manager',45,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(134,'principal-cloud-solutions-engineer',46,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(135,'senior-cloud-solutions-engineer',47,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(136,'senior-customer-success-manager',48,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(137,'inside-account-manager',49,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(138,'ux-jobs-board',50,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(139,'senior-laravel-developer-tall-stack',51,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:27','2025-12-23 19:31:27'),(140,'abigail',1,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:28','2025-12-23 19:31:28'),(141,'annetta',2,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:28','2025-12-23 19:31:28'),(142,'sarah',3,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:29','2025-12-23 19:31:29'),(143,'steven',4,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:29','2025-12-23 19:31:29'),(144,'william',5,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:29','2025-12-23 19:31:29'),(145,'pink',6,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:29','2025-12-23 19:31:29'),(146,'alexis',7,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:30','2025-12-23 19:31:30'),(147,'rosamond',8,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:30','2025-12-23 19:31:30'),(148,'colin',9,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:30','2025-12-23 19:31:30'),(149,'jake',10,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:31','2025-12-23 19:31:31');
/*!40000 ALTER TABLE `slugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slugs_translations`
--

DROP TABLE IF EXISTS `slugs_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `slugs_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slugs_id` bigint unsigned NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT '',
  PRIMARY KEY (`lang_code`,`slugs_id`),
  KEY `idx_slugid_key_prefix` (`slugs_id`,`key`,`prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slugs_translations`
--

LOCK TABLES `slugs_translations` WRITE;
/*!40000 ALTER TABLE `slugs_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `slugs_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_logins`
--

DROP TABLE IF EXISTS `social_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `social_logins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci,
  `refresh_token` text COLLATE utf8mb4_unicode_ci,
  `token_expires_at` timestamp NULL DEFAULT NULL,
  `provider_data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `social_logins_provider_provider_id_unique` (`provider`,`provider_id`),
  KEY `social_logins_user_type_user_id_index` (`user_type`,`user_id`),
  KEY `social_logins_user_id_user_type_index` (`user_id`,`user_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_logins`
--

LOCK TABLES `social_logins` WRITE;
/*!40000 ALTER TABLE `social_logins` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abbreviation` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint unsigned DEFAULT NULL,
  `order` tinyint NOT NULL DEFAULT '0',
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint unsigned NOT NULL DEFAULT '0',
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `states_slug_unique` (`slug`),
  KEY `idx_states_name` (`name`),
  KEY `idx_states_status` (`status`),
  KEY `idx_states_country_id` (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'France','france','FR',1,0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(2,'England','england','EN',2,0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(3,'New York','new-york','NY',1,0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(4,'Holland','holland','HL',4,0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(5,'Denmark','denmark','DN',5,0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25'),(6,'Germany','germany','GER',1,0,NULL,0,'published','2025-12-23 19:31:25','2025-12-23 19:31:25');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states_translations`
--

DROP TABLE IF EXISTS `states_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `states_id` bigint unsigned NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abbreviation` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`states_id`),
  KEY `idx_states_trans_state_lang` (`states_id`,`lang_code`),
  KEY `idx_states_trans_name` (`name`),
  KEY `idx_states_trans_states_id` (`states_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states_translations`
--

LOCK TABLES `states_translations` WRITE;
/*!40000 ALTER TABLE `states_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `states_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` bigint unsigned DEFAULT NULL,
  `author_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'General',1,'Botble\\ACL\\Models\\User',NULL,'published','2025-12-23 19:31:23','2025-12-23 19:31:23'),(2,'Design',1,'Botble\\ACL\\Models\\User',NULL,'published','2025-12-23 19:31:23','2025-12-23 19:31:23'),(3,'Fashion',1,'Botble\\ACL\\Models\\User',NULL,'published','2025-12-23 19:31:23','2025-12-23 19:31:23'),(4,'Branding',1,'Botble\\ACL\\Models\\User',NULL,'published','2025-12-23 19:31:23','2025-12-23 19:31:23'),(5,'Modern',1,'Botble\\ACL\\Models\\User',NULL,'published','2025-12-23 19:31:23','2025-12-23 19:31:23');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags_translations`
--

DROP TABLE IF EXISTS `tags_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`tags_id`),
  KEY `idx_tags_trans_tags_id` (`tags_id`),
  KEY `idx_tags_trans_tag_lang` (`tags_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags_translations`
--

LOCK TABLES `tags_translations` WRITE;
/*!40000 ALTER TABLE `tags_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Jeffrey Montgomery','Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless.','themes/jobcy/testimonials/1.png','Product Manager','published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(2,'Rebecca Swartz','Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless.','themes/jobcy/testimonials/2.png','Creative Designer','published','2025-12-23 19:31:31','2025-12-23 19:31:31'),(3,'Charles Dickens','Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless.','themes/jobcy/testimonials/3.png','Store Assistant','published','2025-12-23 19:31:31','2025-12-23 19:31:31');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials_translations`
--

DROP TABLE IF EXISTS `testimonials_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials_translations` (
  `lang_code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `testimonials_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `company` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`lang_code`,`testimonials_id`),
  KEY `idx_testimonials_trans_testimonials_id` (`testimonials_id`),
  KEY `idx_testimonials_trans_testimonial_lang` (`testimonials_id`,`lang_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials_translations`
--

LOCK TABLES `testimonials_translations` WRITE;
/*!40000 ALTER TABLE `testimonials_translations` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonials_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_meta`
--

DROP TABLE IF EXISTS `user_meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_meta` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_meta_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_meta`
--

LOCK TABLES `user_meta` WRITE;
/*!40000 ALTER TABLE `user_meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_settings`
--

DROP TABLE IF EXISTS `user_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_settings_user_type_user_id_key_unique` (`user_type`,`user_id`,`key`),
  KEY `user_settings_user_type_user_id_index` (`user_type`,`user_id`),
  KEY `user_settings_key_index` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_settings`
--

LOCK TABLES `user_settings` WRITE;
/*!40000 ALTER TABLE `user_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `first_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_id` bigint unsigned DEFAULT NULL,
  `super_user` tinyint(1) NOT NULL DEFAULT '0',
  `manage_supers` tinyint(1) NOT NULL DEFAULT '0',
  `permissions` text COLLATE utf8mb4_unicode_ci,
  `last_login` timestamp NULL DEFAULT NULL,
  `sessions_invalidated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@company.com',NULL,NULL,'$2y$12$m/X6xi1FgLXUowpCAuAFJOpBOuR5Rx1rOdJyOxa2MLghAAyrIgkFi',NULL,'2025-12-23 19:31:22','2025-12-23 19:31:22','System','Admin','admin',NULL,1,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `widgets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `widget_id` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sidebar_id` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `theme` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` tinyint unsigned NOT NULL DEFAULT '0',
  `data` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `widgets_unique_index` (`theme`,`sidebar_id`,`widget_id`,`position`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widgets`
--

LOCK TABLES `widgets` WRITE;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
INSERT INTO `widgets` VALUES (1,'NewsletterWidget','pre_footer_sidebar','jobcy',0,'{\"id\":\"NewsletterWidget\",\"title\":\"Get New Jobs Notification!\",\"subtitle\":\"Subscribe & get all related jobs notification.\",\"image\":\"themes\\/jobcy\\/general\\/newsletter-image.png\"}','2025-12-23 19:31:23','2025-12-23 19:31:23'),(2,'SiteInfoWidget','footer_sidebar','jobcy',0,'{\"id\":\"SiteInfoWidget\",\"name\":\"Jobcy\",\"about\":\"It is a long established fact that a reader will be of a page reader will be of at its layout.\",\"follow_us_heading\":\"Follow us on:\"}','2025-12-23 19:31:23','2025-12-23 19:31:23'),(3,'CustomMenuWidget','footer_sidebar','jobcy',1,'{\"id\":\"CustomMenuWidget\",\"name\":\"Company\",\"menu_id\":\"company\"}','2025-12-23 19:31:23','2025-12-23 19:31:23'),(4,'CustomMenuWidget','footer_sidebar','jobcy',2,'{\"id\":\"CustomMenuWidget\",\"name\":\"For Jobs\",\"menu_id\":\"for-jobs\"}','2025-12-23 19:31:23','2025-12-23 19:31:23'),(5,'CustomMenuWidget','footer_sidebar','jobcy',3,'{\"id\":\"CustomMenuWidget\",\"name\":\"For Candidates\",\"menu_id\":\"for-candidates\"}','2025-12-23 19:31:23','2025-12-23 19:31:23'),(6,'CustomMenuWidget','footer_sidebar','jobcy',4,'{\"id\":\"CustomMenuWidget\",\"name\":\"Support\",\"menu_id\":\"support\"}','2025-12-23 19:31:23','2025-12-23 19:31:23'),(7,'BlogSearchWidget','primary_sidebar','jobcy',1,'{\"id\":\"BlogSearchWidget\",\"name\":\"Search\"}','2025-12-23 19:31:23','2025-12-23 19:31:23'),(8,'BlogCategoriesWidget','primary_sidebar','jobcy',2,'{\"id\":\"BlogCategoriesWidget\",\"name\":\"Categories\"}','2025-12-23 19:31:23','2025-12-23 19:31:23'),(9,'BlogPostsWidget','primary_sidebar','jobcy',3,'{\"id\":\"BlogPostsWidget\",\"type\":\"popular\",\"name\":\"Popular Posts\"}','2025-12-23 19:31:23','2025-12-23 19:31:23'),(10,'BlogTagsWidget','primary_sidebar','jobcy',4,'{\"id\":\"BlogTagsWidget\",\"name\":\"Popular Tags\"}','2025-12-23 19:31:23','2025-12-23 19:31:23');
/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-24  9:31:32
