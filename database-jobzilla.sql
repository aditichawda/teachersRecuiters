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
INSERT INTO `activations` VALUES (1,1,'R4xFtceGpGhIoKbAsWZAroyytk28JQea',1,'2025-12-23 19:31:36','2025-12-23 19:31:36','2025-12-23 19:31:36');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Artificial Intelligence',0,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,0,0,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(2,'Cybersecurity',0,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(3,'Blockchain Technology',0,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(4,'5G and Connectivity',0,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(5,'Augmented Reality (AR)',0,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(6,'Green Technology',0,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(7,'Quantum Computing',0,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(8,'Edge Computing',0,'Explore our collection of articles and insights in this category.','published',1,'Botble\\ACL\\Models\\User',NULL,0,1,0,'2025-12-23 19:31:38','2025-12-23 19:31:38');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
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
INSERT INTO `contacts` VALUES (1,'Freda Howell','kailey32@example.com','+17379794959','8834 Jacobson Neck\nKovacekstad, AZ 85522','Sed assumenda laborum suscipit quo praesentium.','Sequi odio ipsa facere optio commodi nihil ex. Ut est animi sit expedita nostrum non. Libero eum amet accusamus et ut provident omnis ipsum. Vel pariatur ut aut eum porro voluptatem. Nisi est aut nobis odio officia consequatur. Minus suscipit sapiente quam quaerat. Omnis sed ea quis tempora. Ut consectetur et dolor voluptatem explicabo ipsam nostrum. Veniam et quia ut sit sequi praesentium. Voluptatem dolores eos quidem sed consequatur ab earum. Dolores est est pariatur odio sed accusantium.',NULL,'unread','2025-12-23 19:31:38','2025-12-23 19:31:38'),(2,'Prof. Estel Murazik','kiley.turcotte@example.org','+12838516611','282 Swift Route Apt. 999\nRobelchester, AR 95439-6131','Aliquam culpa magnam excepturi.','Voluptas facere cupiditate ab. Sit dolore unde blanditiis sint. Consequatur ad non rerum quis aut ut harum. Molestiae amet animi quaerat. Dolor et provident et esse autem qui ducimus rerum. Sed explicabo tempore quas eos. Voluptatem temporibus voluptate blanditiis doloremque provident consectetur. Magnam voluptatum aspernatur aut ut necessitatibus labore sequi quos.',NULL,'unread','2025-12-23 19:31:38','2025-12-23 19:31:38'),(3,'Keira Thiel','thartmann@example.org','+18303950227','171 Rozella Highway\nSouth Bonitamouth, ID 86719-1049','Et laborum consequatur esse beatae sit alias.','Numquam iste animi dolores recusandae. Nihil ea iste itaque enim eveniet sint consequuntur. Illum ad quasi consectetur optio dolorum officia libero. Odio quibusdam quisquam culpa quas. Rem ut deleniti deleniti autem nam repellat quae. Rerum illo atque velit repudiandae ullam rerum voluptas. Dolores velit aliquid eaque delectus velit corporis est. Excepturi fugiat eum a consequatur dolor autem ut unde.',NULL,'unread','2025-12-23 19:31:38','2025-12-23 19:31:38'),(4,'Ashlee Murphy','reichert.kelvin@example.net','+14095876877','73709 Christiansen Flats\nChamplinberg, RI 88815-8692','Consequatur consequatur occaecati eveniet.','Corporis maxime totam et quo. Commodi atque porro ea voluptatem ut exercitationem et. Culpa excepturi in fugit explicabo quos officia. Veritatis sunt accusantium ratione. Et numquam a maiores in quo laboriosam. Consequatur qui distinctio fugit omnis facilis sit. Quas vitae assumenda eum ducimus quos. Voluptas veritatis est est odio deleniti perferendis modi. Accusamus assumenda enim non perferendis voluptas nemo. Consequuntur dolorum quae in asperiores est similique.',NULL,'read','2025-12-23 19:31:38','2025-12-23 19:31:38'),(5,'Adah Carroll','ylakin@example.org','+15612249810','180 Kshlerin Track\nBatzville, IL 68113','Corrupti suscipit dignissimos incidunt.','Sed et deleniti ut voluptas. Ea et alias eligendi nisi. Quo quis odit vel soluta. Magni excepturi eos dicta ea quidem enim. Est tempore quam et quaerat. Necessitatibus nostrum natus rerum mollitia voluptatibus rem. Aspernatur ut consequatur rerum. Reprehenderit nulla ut quia dolores. Adipisci magni labore et neque impedit provident nesciunt repellendus. Id esse sapiente placeat aut vel aut.',NULL,'unread','2025-12-23 19:31:38','2025-12-23 19:31:38'),(6,'Eugenia Turner','denesik.lavada@example.org','+15109814161','7223 Dibbert Track Suite 958\nSouth Lestermouth, TN 74590-2250','Praesentium explicabo in illum mollitia.','Dolores nesciunt sed est harum dolorem. Consequatur quibusdam voluptatem eum. Consequuntur tempore aliquam doloribus. Tempore quia aut deserunt temporibus error voluptatem possimus. Rem nihil adipisci ducimus iste unde quia. Perferendis iste dicta nihil facere ut. In omnis reiciendis voluptatem. Reprehenderit eveniet omnis enim consequatur sed. Molestias et ipsam praesentium necessitatibus officiis. Omnis nisi fugit possimus consectetur.',NULL,'unread','2025-12-23 19:31:38','2025-12-23 19:31:38'),(7,'Tre Conroy','jana78@example.net','+14783532522','6690 Joesph Divide Apt. 116\nSouth Paris, FL 58887-8265','Quidem quo autem omnis enim adipisci repellendus.','Non ut soluta ipsam. Voluptas ea pariatur rem rerum et est. Quia quo id qui aut molestiae laudantium explicabo possimus. Ex minima quo odit sapiente. Odit quos velit aut tenetur placeat. Eaque error necessitatibus mollitia et repudiandae dolore officiis. Est magnam ut molestiae facere quia voluptatum aut. Voluptatem recusandae eos nihil. Quo earum ullam expedita quas architecto ut optio.',NULL,'read','2025-12-23 19:31:38','2025-12-23 19:31:38'),(8,'Kale Botsford','powlowski.gonzalo@example.org','+19286130858','81946 Anissa Fall Suite 458\nWest Abby, MN 03425','Dignissimos tenetur animi esse.','Repudiandae quidem et accusamus rerum culpa. Molestiae molestiae reiciendis ratione magni. Tenetur labore in sed velit. Ut soluta rerum sequi amet qui dignissimos provident. Optio magnam dolor nam natus incidunt atque quibusdam. Harum est molestias nobis voluptas officiis unde sunt. Aut voluptas neque dignissimos labore natus eaque aut. Repellendus et omnis fugit laborum. Porro praesentium sit illum nemo optio.',NULL,'unread','2025-12-23 19:31:38','2025-12-23 19:31:38'),(9,'Kacie Heaney','rath.gaylord@example.org','+14238944293','3195 Rempel Lake Suite 429\nYeseniaborough, KS 69188','Vero et corrupti illum fugit.','Et reprehenderit voluptatem voluptate unde. Omnis dolor est sunt veniam soluta aut velit. In aliquam aut atque est eos ipsum voluptatem provident. Doloribus sunt dolores omnis et fugiat. Aut illo est vel aut occaecati. Laboriosam quo et expedita quia et consequatur natus quisquam. Sed fugit aut qui placeat cum enim. Sunt ut consequatur in et.',NULL,'read','2025-12-23 19:31:38','2025-12-23 19:31:38'),(10,'Ryann Zemlak','koby.kulas@example.net','+16269486600','586 McGlynn Roads\nLeifport, OH 48831','Qui qui reiciendis consequuntur est perferendis.','Aperiam cumque quod possimus recusandae iste ut ullam. Accusamus a ut ab aut quae veritatis amet. Id natus sint laborum similique consequuntur ut est consequatur. Numquam rerum esse et eius aliquid. Necessitatibus ea et nisi aperiam. Dolor qui omnis ad vero aut ut laboriosam architecto. Maxime rerum nihil voluptates vitae voluptatem quis suscipit. Accusantium perferendis et est inventore placeat voluptatem eligendi.',NULL,'unread','2025-12-23 19:31:38','2025-12-23 19:31:38');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
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
INSERT INTO `faq_categories` VALUES (1,'General',0,'published','2025-12-23 19:32:10','2025-12-23 19:32:10',NULL),(2,'Jobs',1,'published','2025-12-23 19:32:10','2025-12-23 19:32:10',NULL),(3,'Payment',2,'published','2025-12-23 19:32:10','2025-12-23 19:32:10',NULL),(4,'Return',3,'published','2025-12-23 19:32:10','2025-12-23 19:32:10',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqs`
--

LOCK TABLES `faqs` WRITE;
/*!40000 ALTER TABLE `faqs` DISABLE KEYS */;
INSERT INTO `faqs` VALUES (1,'Where is my job posting advertised?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',1,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(2,'What Makes Your Business Plans So Special?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',1,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(3,'Reset Password With Phone Number?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',1,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(4,'How do I redeem a coupon?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',1,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(5,'How long will it take to post my job?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',1,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(6,'What is your cancellation policy?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',1,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(7,'Where Can I Find Market Research Reports?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',1,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(8,'Do I need to know PHP to use TheJobs?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',1,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(9,'How soon will I start receiving resumes?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',1,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(10,'How do I redeem a coupon?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',2,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(11,'How long will it take to post my job?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',2,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(12,'What is your cancellation policy?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',2,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(13,'Where Can I Find Market Research Reports?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',2,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(14,'Do I need to know PHP to use TheJobs?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',2,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(15,'How soon will I start receiving resumes?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',2,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(16,'What Makes Your Business Plans So Special?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',3,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(17,'Reset Password With Phone Number?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',3,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(18,'How do I redeem a coupon?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',3,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(19,'How long will it take to post my job?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',3,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(20,'What is your cancellation policy?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',3,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(21,'Where Can I Find Market Research Reports?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',3,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(22,'Do I need to know PHP to use TheJobs?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',3,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(23,'How soon will I start receiving resumes?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',3,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(24,'What is your shipping policy?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',4,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(25,'How long will it take to post my job?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',4,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(26,'What is your cancellation policy?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',4,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(27,'Where Can I Find Market Research Reports?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',4,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(28,'Do I need to know PHP to use TheJobs?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',4,'published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(29,'How soon will I start receiving resumes?','A digital interface the person causing the movement of goods uploads the relevant information prior to the commencement of movement of goods and generates e-way bill on the GST portal. Best service are provide us. simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry’s standard dummy.',4,'published','2025-12-23 19:32:10','2025-12-23 19:32:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_account_educations`
--

LOCK TABLES `jb_account_educations` WRITE;
/*!40000 ALTER TABLE `jb_account_educations` DISABLE KEYS */;
INSERT INTO `jb_account_educations` VALUES (1,'Antioch University McGregor',2,'Economics','2025-09-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:46','2025-12-23 19:31:46'),(2,'The University of the State of Alabama',6,'Art History','2025-04-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:47','2025-12-23 19:31:47'),(3,'American Institute of Health Technology',10,'Culture and Technology Studies','2023-06-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:48','2025-12-23 19:31:48'),(4,'Associated Mennonite Biblical Seminary',13,'Anthropology','2023-11-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:49','2025-12-23 19:31:49'),(5,'Antioch University McGregor',16,'Classical Studies','2024-08-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:50','2025-12-23 19:31:50'),(6,'Adams State College',18,'Economics','2024-04-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:50','2025-12-23 19:31:50'),(7,'Gateway Technical College',20,'Anthropology','2024-01-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:51','2025-12-23 19:31:51'),(8,'Adams State College',25,'Anthropology','2025-01-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:52','2025-12-23 19:31:52'),(9,'Associated Mennonite Biblical Seminary',26,'Art History','2023-07-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:52','2025-12-23 19:31:52'),(10,'Gateway Technical College',27,'Art History','2024-04-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:52','2025-12-23 19:31:52'),(11,'The University of the State of Alabama',28,'Culture and Technology Studies','2024-06-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:52','2025-12-23 19:31:52'),(12,'American Institute of Health Technology',30,'Anthropology','2024-04-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:53','2025-12-23 19:31:53'),(13,'Associated Mennonite Biblical Seminary',31,'Economics','2025-02-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:53','2025-12-23 19:31:53'),(14,'Gateway Technical College',32,'Art History','2024-10-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:53','2025-12-23 19:31:53'),(15,'Gateway Technical College',33,'Culture and Technology Studies','2025-01-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:54','2025-12-23 19:31:54'),(16,'Associated Mennonite Biblical Seminary',37,'Anthropology','2024-07-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:55','2025-12-23 19:31:55'),(17,'Associated Mennonite Biblical Seminary',39,'Classical Studies','2024-02-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:55','2025-12-23 19:31:55'),(18,'The University of the State of Alabama',40,'Art History','2025-06-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:55','2025-12-23 19:31:55'),(19,'The University of the State of Alabama',41,'Anthropology','2025-05-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:56','2025-12-23 19:31:56'),(20,'Gateway Technical College',42,'Culture and Technology Studies','2024-08-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:56','2025-12-23 19:31:56'),(21,'Associated Mennonite Biblical Seminary',44,'Economics','2024-12-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:56','2025-12-23 19:31:56'),(22,'Adams State College',46,'Classical Studies','2025-08-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:57','2025-12-23 19:31:57'),(23,'Associated Mennonite Biblical Seminary',48,'Anthropology','2024-01-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:57','2025-12-23 19:31:57'),(24,'American Institute of Health Technology',49,'Classical Studies','2024-08-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:58','2025-12-23 19:31:58'),(25,'Associated Mennonite Biblical Seminary',50,'Anthropology','2025-04-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:58','2025-12-23 19:31:58'),(26,'American Institute of Health Technology',52,'Anthropology','2024-02-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:58','2025-12-23 19:31:58'),(27,'American Institute of Health Technology',53,'Classical Studies','2022-12-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:59','2025-12-23 19:31:59'),(28,'Associated Mennonite Biblical Seminary',56,'Anthropology','2024-11-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:59','2025-12-23 19:31:59'),(29,'American Institute of Health Technology',57,'Art History','2025-02-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:00','2025-12-23 19:32:00'),(30,'The University of the State of Alabama',60,'Art History','2023-10-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:00','2025-12-23 19:32:00'),(31,'Associated Mennonite Biblical Seminary',62,'Art History','2023-06-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:01','2025-12-23 19:32:01'),(32,'Antioch University McGregor',63,'Economics','2023-10-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:01','2025-12-23 19:32:01'),(33,'Gateway Technical College',65,'Art History','2023-02-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:01','2025-12-23 19:32:01'),(34,'American Institute of Health Technology',67,'Anthropology','2023-11-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:02','2025-12-23 19:32:02'),(35,'Adams State College',68,'Art History','2024-08-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:02','2025-12-23 19:32:02'),(36,'Gateway Technical College',72,'Anthropology','2023-02-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:03','2025-12-23 19:32:03'),(37,'American Institute of Health Technology',73,'Economics','2023-03-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:03','2025-12-23 19:32:03'),(38,'Antioch University McGregor',74,'Art History','2024-05-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:04','2025-12-23 19:32:04'),(39,'The University of the State of Alabama',75,'Economics','2022-12-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:04','2025-12-23 19:32:04'),(40,'Adams State College',77,'Economics','2025-01-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:04','2025-12-23 19:32:04'),(41,'The University of the State of Alabama',78,'Culture and Technology Studies','2024-11-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:05','2025-12-23 19:32:05'),(42,'The University of the State of Alabama',79,'Classical Studies','2025-10-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:05','2025-12-23 19:32:05'),(43,'Adams State College',81,'Economics','2025-09-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:05','2025-12-23 19:32:05'),(44,'Gateway Technical College',82,'Economics','2023-04-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:06','2025-12-23 19:32:06'),(45,'Adams State College',83,'Economics','2023-01-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:06','2025-12-23 19:32:06'),(46,'The University of the State of Alabama',86,'Anthropology','2024-10-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:07','2025-12-23 19:32:07'),(47,'American Institute of Health Technology',89,'Anthropology','2025-08-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:07','2025-12-23 19:32:07'),(48,'Gateway Technical College',90,'Art History','2024-04-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:08','2025-12-23 19:32:08'),(49,'Antioch University McGregor',93,'Classical Studies','2024-03-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:08','2025-12-23 19:32:08'),(50,'Associated Mennonite Biblical Seminary',95,'Economics','2024-04-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:09','2025-12-23 19:32:09'),(51,'American Institute of Health Technology',96,'Anthropology','2025-06-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:09','2025-12-23 19:32:09');
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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_account_experiences`
--

LOCK TABLES `jb_account_experiences` WRITE;
/*!40000 ALTER TABLE `jb_account_experiences` DISABLE KEYS */;
INSERT INTO `jb_account_experiences` VALUES (1,'GameDay Cateringn',2,'Marketing Coordinator','2024-11-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:46','2025-12-23 19:31:46'),(2,'Darwin Travel',6,'Project Manager','2024-01-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:47','2025-12-23 19:31:47'),(3,'Exploration Kids',10,'President of Sales','2022-12-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:48','2025-12-23 19:31:48'),(4,'Darwin Travel',13,'President of Sales','2024-02-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:49','2025-12-23 19:31:49'),(5,'Darwin Travel',16,'Marketing Coordinator','2025-10-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:50','2025-12-23 19:31:50'),(6,'Spa Paragon',18,'Dog Trainer','2023-07-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:50','2025-12-23 19:31:50'),(7,'Darwin Travel',20,'Dog Trainer','2025-11-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:51','2025-12-23 19:31:51'),(8,'Exploration Kids',25,'Marketing Coordinator','2024-12-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:52','2025-12-23 19:31:52'),(9,'Darwin Travel',26,'Web Designer','2024-01-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:52','2025-12-23 19:31:52'),(10,'Darwin Travel',27,'Marketing Coordinator','2023-11-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:52','2025-12-23 19:31:52'),(11,'Party Plex',28,'Dog Trainer','2024-07-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:52','2025-12-23 19:31:52'),(12,'Exploration Kids',30,'Web Designer','2023-04-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:53','2025-12-23 19:31:53'),(13,'Exploration Kids',31,'Marketing Coordinator','2023-08-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:53','2025-12-23 19:31:53'),(14,'Exploration Kids',32,'President of Sales','2024-09-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:53','2025-12-23 19:31:53'),(15,'Party Plex',33,'Web Designer','2024-07-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:54','2025-12-23 19:31:54'),(16,'Exploration Kids',37,'Web Designer','2024-09-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:55','2025-12-23 19:31:55'),(17,'Exploration Kids',39,'President of Sales','2025-09-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:55','2025-12-23 19:31:55'),(18,'GameDay Cateringn',40,'Project Manager','2025-08-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:55','2025-12-23 19:31:55'),(19,'Spa Paragon',41,'Web Designer','2024-06-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:56','2025-12-23 19:31:56'),(20,'Spa Paragon',42,'Marketing Coordinator','2025-08-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:56','2025-12-23 19:31:56'),(21,'Spa Paragon',44,'Dog Trainer','2024-09-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:56','2025-12-23 19:31:56'),(22,'GameDay Cateringn',46,'Web Designer','2025-11-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:57','2025-12-23 19:31:57'),(23,'Darwin Travel',48,'Dog Trainer','2023-11-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:57','2025-12-23 19:31:57'),(24,'GameDay Cateringn',49,'Marketing Coordinator','2022-12-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:58','2025-12-23 19:31:58'),(25,'Darwin Travel',50,'Project Manager','2025-04-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:58','2025-12-23 19:31:58'),(26,'Exploration Kids',52,'Web Designer','2024-05-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:58','2025-12-23 19:31:58'),(27,'Exploration Kids',53,'Dog Trainer','2024-08-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:59','2025-12-23 19:31:59'),(28,'Darwin Travel',56,'President of Sales','2024-10-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:31:59','2025-12-23 19:31:59'),(29,'Spa Paragon',57,'President of Sales','2025-07-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:00','2025-12-23 19:32:00'),(30,'Exploration Kids',60,'Dog Trainer','2024-04-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:00','2025-12-23 19:32:00'),(31,'Exploration Kids',62,'Web Designer','2024-11-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:01','2025-12-23 19:32:01'),(32,'Spa Paragon',63,'Marketing Coordinator','2024-08-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:01','2025-12-23 19:32:01'),(33,'Spa Paragon',65,'Web Designer','2023-10-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:01','2025-12-23 19:32:01'),(34,'Spa Paragon',67,'Marketing Coordinator','2025-02-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:02','2025-12-23 19:32:02'),(35,'Exploration Kids',68,'Web Designer','2024-10-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:02','2025-12-23 19:32:02'),(36,'GameDay Cateringn',72,'Project Manager','2025-10-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:03','2025-12-23 19:32:03'),(37,'Party Plex',73,'Marketing Coordinator','2024-05-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:03','2025-12-23 19:32:03'),(38,'Exploration Kids',74,'Project Manager','2023-03-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:04','2025-12-23 19:32:04'),(39,'Spa Paragon',75,'Marketing Coordinator','2024-05-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:04','2025-12-23 19:32:04'),(40,'Darwin Travel',77,'Dog Trainer','2024-09-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:04','2025-12-23 19:32:04'),(41,'Exploration Kids',78,'Web Designer','2023-11-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:05','2025-12-23 19:32:05'),(42,'Spa Paragon',79,'President of Sales','2024-11-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:05','2025-12-23 19:32:05'),(43,'Darwin Travel',81,'President of Sales','2024-11-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:05','2025-12-23 19:32:05'),(44,'GameDay Cateringn',82,'Marketing Coordinator','2025-10-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:06','2025-12-23 19:32:06'),(45,'Exploration Kids',83,'Web Designer','2022-12-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:06','2025-12-23 19:32:06'),(46,'GameDay Cateringn',86,'Marketing Coordinator','2023-09-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:07','2025-12-23 19:32:07'),(47,'Darwin Travel',89,'Marketing Coordinator','2024-06-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:07','2025-12-23 19:32:07'),(48,'Spa Paragon',90,'Marketing Coordinator','2024-02-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:08','2025-12-23 19:32:08'),(49,'Darwin Travel',93,'President of Sales','2024-02-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:08','2025-12-23 19:32:08'),(50,'Party Plex',95,'Dog Trainer','2024-10-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:09','2025-12-23 19:32:09'),(51,'Darwin Travel',96,'President of Sales','2023-09-24','2025-12-24','There are many variations of passages of available, but the majority alteration in some form.\n                As a highly skilled and successful product development and design specialist with more than 4 Years of\n                My experience','2025-12-23 19:32:09','2025-12-23 19:32:09');
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
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_accounts`
--

LOCK TABLES `jb_accounts` WRITE;
/*!40000 ALTER TABLE `jb_accounts` DISABLE KEYS */;
INSERT INTO `jb_accounts` VALUES (1,NULL,'Mervin','Brekke','Software Developer',NULL,'employer@botble.com','$2y$12$GGeak90vHmrh1N8h7atO2ucmjsRVZTE75xwbtGnMc3G6R2JB1J4Qi',129,'2016-05-21','+17154565658','2025-12-24 02:31:46',NULL,'employer',NULL,NULL,'695 Norris Camp Suite 532\nArnefort, TX 52573','Alice. \'Now we shall get on better.\' \'I\'d rather finish my tea,\' said the Mock Turtle a little snappishly. \'You\'re enough to get through was more hopeless than ever: she sat down at her own ears for.',1,0,3480,1,NULL,'2025-01-29 22:17:03','2025-12-23 19:31:46',1,0,1,1,NULL),(2,NULL,'Earnestine','Schulist','Creative Designer',NULL,'job_seeker@botble.com','$2y$12$oX7xpwiBt3deO5DxoAhSceRe.U2fWiCKdB3Dhr/GzCsQlQgDjO8Vm',132,'1973-04-06','+13367562093','2025-12-24 02:31:46',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','14874 Berneice Crossing Suite 882\nSteuberport, NJ 21456-3159','Hatter: \'but you could manage it?) \'And what are YOUR shoes done with?\' said the Mock Turtle, \'but if you\'ve seen them so often, of course had to ask the question?\' said the Hatter. \'Nor I,\' said.',1,0,1913,0,NULL,'2025-07-20 19:26:41','2025-12-23 19:31:46',1,1,0,0,NULL),(3,NULL,'Sarah','Harding','Creative Designer',NULL,'sarah_harding@botble.com','$2y$12$Mxwqohbj0JmmNmoli56YuOldcdXJkyYp2rXndV/L8A/09hCApqGp6',NULL,'2017-06-19','+15206863449','2025-12-24 02:31:47',NULL,'employer',NULL,NULL,'125 Marcelo Hollow Apt. 314\nNorth Terranceborough, OR 83071','Gryphon, sighing in his throat,\' said the Queen. \'You make me smaller, I can kick a little!\' She drew her foot as far down the little magic bottle had now had its full effect, and she heard was a.',1,0,4403,1,NULL,'2025-10-17 12:35:56','2025-12-23 19:31:47',1,0,0,0,NULL),(4,NULL,'Steven','Jobs','Creative Designer',NULL,'steven_jobs@botble.com','$2y$12$DlL7K8C0nZsXJXyamHT4puoq8B2QszKQ2C.352lFM/596hvJZf4ki',NULL,'1993-07-24','+16894817018','2025-12-24 02:31:47',NULL,'employer',NULL,NULL,'2255 Felipa Dam\nMadalynmouth, ND 47462-5303','Miss, this here ought to be trampled under its feet, ran round the thistle again; then the different branches of Arithmetic--Ambition, Distraction, Uglification, and Derision.\' \'I never could abide.',1,0,195,1,NULL,'2025-02-26 22:53:23','2025-12-23 19:31:47',1,1,0,0,NULL),(5,NULL,'Wiliam','Kend','Creative Designer',NULL,'wiliam_kend@botble.com','$2y$12$zJheZ7BZbuQBz7NIyYrC8.mhSOcjjK.aSHIlGDAORtw152lqm/O1.',NULL,'1989-06-22','+13259068959','2025-12-24 02:31:47',NULL,'employer',NULL,NULL,'1479 Little Island Suite 264\nGoldnerstad, AZ 13930','Queen in a very hopeful tone though), \'I won\'t have any pepper in my time, but never ONE with such sudden violence that Alice quite jumped; but she did it so yet,\' said the Footman. \'That\'s the.',1,0,2915,0,NULL,'2025-06-30 00:40:53','2025-12-23 19:31:47',1,1,1,1,NULL),(6,NULL,'Samir','Jaskolski','Alice as she could.',NULL,'farrell.holly@keebler.org','$2y$12$sYu2d7Bcf8s/v.Tlph7HTe3GHY7cg/xYMAvaxMRPSQLkQuOjpwPqS',130,'2006-02-12','+12818725199','2025-12-24 02:31:47',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','8792 Kuhn Ridges\nKeeblerstad, RI 07818','Turtle--we used to know. Let me see: four times seven is--oh dear! I wish you would have made a memorandum of the Shark, But, when the tide rises and sharks are around, His voice has a timid and.',1,0,4849,0,NULL,'2025-09-16 15:18:19','2025-12-23 19:31:47',0,1,1,1,NULL),(7,NULL,'Savannah','Balistreri','I do so like that.',NULL,'eula.daugherty@ryan.com','$2y$12$sdsVcF7VfRqA2R.4BrJV/uSaaXmwx4Q2ip/YDmp5bYsDTTPrHaaTS',130,'2021-07-13','+13374852829','2025-12-24 02:31:47',NULL,'employer',NULL,NULL,'375 Earnestine Heights\nWest Marcelino, WA 42616','Dormouse. \'Don\'t talk nonsense,\' said Alice very politely; but she added, \'and the moral of that is--\"Be what you were all talking at once, in a melancholy tone. \'Nobody seems to be in a tone of.',1,0,2965,1,NULL,'2025-08-22 03:47:59','2025-12-23 19:31:47',0,0,1,1,NULL),(8,NULL,'Fiona','Kshlerin','Gryphon answered.',NULL,'xklein@mante.org','$2y$12$6lmyqew9nM9qGfMX8p3YtOb1N8sRCs45U7JJUHVc0sU.24G6tCAzW',132,'1984-10-17','+17065682176','2025-12-24 02:31:48',NULL,'employer',NULL,NULL,'73571 Georgette Circles Apt. 418\nRueckerland, KY 62042-5541','The Hatter was the BEST butter,\' the March Hare. Alice was more than that, if you wouldn\'t keep appearing and vanishing so suddenly: you make one repeat lessons!\' thought Alice; \'only, as it\'s.',1,0,510,0,NULL,'2025-10-09 13:50:08','2025-12-23 19:31:48',0,0,1,1,NULL),(9,NULL,'Mariana','Goodwin','Do cats eat bats?.',NULL,'djacobson@considine.com','$2y$12$DtsBF4j5o.e/N6ime.vSu.ICu4BSYX9sJMxy/jd5LQwyO75C2Z/Ye',131,'1992-04-16','+12405338992','2025-12-24 02:31:48',NULL,'employer',NULL,NULL,'9261 Pfeffer Roads Apt. 886\nEast Joaquin, NC 48227','Hatter. \'I deny it!\' said the Mouse. \'Of course,\' the Dodo solemnly, rising to its feet, ran round the court was in the pool was getting very sleepy; \'and they all quarrel so dreadfully one can\'t.',1,0,913,1,NULL,'2025-07-06 02:52:50','2025-12-23 19:31:48',0,0,0,1,NULL),(10,NULL,'Jerad','Bogan','There was nothing.',NULL,'bogisich.mandy@rutherford.com','$2y$12$OFzG03Iw2wKM/F98Zejhm.lPENebAQg.2WKJrfg2GyNJqseWmN5V2',129,'2018-07-04','+13104950849','2025-12-24 02:31:48',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','981 Greta Dale\nPort Salvador, MO 91302-8771','I will just explain to you to offer it,\' said Alice, feeling very glad to do with this creature when I got up and down looking for it, while the rest waited in silence. At last the Caterpillar.',1,0,2855,0,NULL,'2025-09-27 18:51:18','2025-12-23 19:31:48',1,0,1,0,NULL),(11,NULL,'Hillary','Heathcote','I only knew how to.',NULL,'melissa.lowe@graham.com','$2y$12$3VNBQha4UN8hZ0extVr3/.zn1HAJ7uclQvbbLL/quunLhihSVC3u6',129,'2025-01-23','+17168720423','2025-12-24 02:31:48',NULL,'employer',NULL,NULL,'717 Sauer Cliffs Suite 727\nKirkhaven, MI 34617','March Hare said to Alice, flinging the baby at her hands, and began:-- \'You are not the right size, that it had lost something; and she felt very lonely and low-spirited. In a minute or two to think.',1,0,2702,1,NULL,'2025-11-30 05:26:13','2025-12-23 19:31:48',0,1,0,0,NULL),(12,NULL,'Kris','Torphy','March Hare moved.',NULL,'isobel36@stroman.org','$2y$12$JzywIR1DEX6dUKzCOgo81OBXv/CMWwDDyJiCJQg2Xe0WDE26CwIaG',130,'2004-02-27','+17253054837','2025-12-24 02:31:49',NULL,'employer',NULL,NULL,'24108 Roob Flat\nEast Bernardoton, MI 81776-2056','What made you so awfully clever?\' \'I have answered three questions, and that is rather a handsome pig, I think.\' And she kept tossing the baby was howling so much frightened that she knew that it.',1,0,4284,0,NULL,'2024-12-28 04:05:58','2025-12-23 19:31:49',0,1,1,1,NULL),(13,NULL,'Harry','Abshire','So Bill\'s got to.',NULL,'mikayla.mohr@hotmail.com','$2y$12$pK8qMtVX5k7TT3Xn8MCjxuXSqBvASbqnzDrSN3hwBmAE8ismJeYmW',132,'2007-06-27','+19522336446','2025-12-24 02:31:49',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','587 Idella Course Suite 700\nWest Fernando, UT 82213','Said he thanked the whiting kindly, but he now hastily began again, using the ink, that was sitting between them, fast asleep, and the game was in March.\' As she said to herself, \'to be going.',1,0,1560,1,NULL,'2025-07-04 08:15:15','2025-12-23 19:31:49',1,0,1,0,NULL),(14,NULL,'Nedra','Hessel','Dinah my dear! Let.',NULL,'jay.purdy@gmail.com','$2y$12$8cn7XY7E/m6fMfcofOZI.e2H2t3lggzyKOVn66mGjZTKMzyuauCOa',129,'2025-09-08','+18313170011','2025-12-24 02:31:49',NULL,'employer',NULL,NULL,'9783 Mitchell Lake\nSouth Camden, MT 89673-8432','Mouse was bristling all over, and she ran off at once and put it in less than no time she\'d have everybody executed, all round. (It was this last remark, \'it\'s a vegetable. It doesn\'t look like it?\'.',1,0,3768,1,NULL,'2025-09-27 13:44:45','2025-12-23 19:31:49',1,1,0,1,NULL),(15,NULL,'Ola','Orn','King: \'however, it.',NULL,'harris.abigayle@gmail.com','$2y$12$h.ps9DaDsqWzD6nPYtdLvebHizTI.0TvdkrX.Er6NFROUpEFSZORu',131,'2013-01-29','+17862676908','2025-12-24 02:31:49',NULL,'employer',NULL,NULL,'627 Mitchell Vista Suite 012\nWest Jacynthe, MO 84842','Bill\'s got to the confused clamour of the e--e--evening, Beautiful, beautiful Soup!\' CHAPTER XI. Who Stole the Tarts? The King laid his hand upon her face. \'Wake up, Dormouse!\' And they pinched it.',1,0,2396,1,NULL,'2025-06-17 06:28:42','2025-12-23 19:31:49',1,1,1,1,NULL),(16,NULL,'King','Stark','Cat, \'if you only.',NULL,'vandervort.sebastian@yahoo.com','$2y$12$S/D2.7hlVagHYv/oWPRPhuSM9NmlTqGohpyQNw6ONRpFKuHZNyFXa',132,'2008-09-25','+13603690306','2025-12-24 02:31:50',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','8733 Grady Course\nNorth Elyssa, MD 80113','I shall only look up and said, very gravely, \'I think, you ought to speak, and no one listening, this time, and was gone in a great deal of thought, and looked at Alice, and her eyes anxiously fixed.',1,0,1117,1,NULL,'2025-11-29 11:07:29','2025-12-23 19:31:50',0,1,1,0,NULL),(17,NULL,'Dillon','Waters','Mock Turtle is.\'.',NULL,'quigley.eunice@hotmail.com','$2y$12$6XWZjPdosGEQxnN033Rfl.UTPXhqsv.qA7qdw6iEaxvkicBl4h0sO',132,'2019-10-29','+15515477942','2025-12-24 02:31:50',NULL,'employer',NULL,NULL,'84850 Wilderman Circle\nSouth Efrainfurt, MO 37239-1556','After these came the royal children; there were three gardeners instantly jumped up, and reduced the answer to shillings and pence. \'Take off your hat,\' the King in a melancholy tone: \'it doesn\'t.',1,0,3440,1,NULL,'2025-09-26 06:31:47','2025-12-23 19:31:50',0,0,0,0,NULL),(18,NULL,'Kenyatta','Upton','Hatter. \'It isn\'t.',NULL,'nicolas.roderick@moore.com','$2y$12$2JXb4yOWWorQF7QH42ueX.B9XKDrVrXK4E436Dwr2G0sgrFM//IGu',129,'1993-01-19','+12183431764','2025-12-24 02:31:50',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','734 Shawna Branch Suite 817\nNorth Jewell, IL 67099','I\'ve nothing to do: once or twice she had read several nice little dog near our house I should like to be no chance of her voice, and see how he did not answer, so Alice went on, looking anxiously.',1,0,875,1,NULL,'2025-08-04 11:43:10','2025-12-23 19:31:50',1,1,1,0,NULL),(19,NULL,'Osbaldo','Stehr','RABBIT\' engraved.',NULL,'sam76@goyette.com','$2y$12$2UFH8x1c7lYZd.HluXQrfuzM6ds03iKDqDZz9raN7EVtn69YUC5wy',130,'2017-08-25','+13313175999','2025-12-24 02:31:50',NULL,'employer',NULL,NULL,'5885 Marcelo Run\nMcDermottborough, MO 66470-3116','So she began: \'O Mouse, do you know that you\'re mad?\' \'To begin with,\' the Mock Turtle went on without attending to her, though, as they were gardeners, or soldiers, or courtiers, or three pairs of.',1,0,1600,0,NULL,'2025-10-17 09:15:00','2025-12-23 19:31:50',1,0,0,1,NULL),(20,NULL,'Heaven','Gutkowski','Alice thought this.',NULL,'nedra.howell@yahoo.com','$2y$12$yRBJiriK9y5q6/1EDdaNMOR7AfU.d.vK0dCgGvgV3wLtCSP97dXim',132,'2023-05-18','+19152223631','2025-12-24 02:31:51',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','42300 Aryanna Garden\nWest Maryseview, HI 40487','Alice thought this must be really offended. \'We won\'t talk about trouble!\' said the Cat. \'I said pig,\' replied Alice; \'and I do so like that curious song about the same height as herself; and when.',1,0,237,1,NULL,'2025-04-11 13:46:11','2025-12-23 19:31:51',1,1,0,1,NULL),(21,NULL,'Lew','Zulauf','Lory, as soon as.',NULL,'marilie.lakin@west.com','$2y$12$wNXpFcaEkkVq3dbjVJmcoe/IlGvAzHzgsNcSHkFRC9aQpZnwRtE7e',129,'1980-09-09','+18785040119','2025-12-24 02:31:51',NULL,'employer',NULL,NULL,'35610 Macejkovic Views\nWest Xavier, IN 06283','For instance, suppose it doesn\'t matter much,\' thought Alice, \'as all the rest, Between yourself and me.\' \'That\'s the most important piece of evidence we\'ve heard yet,\' said Alice; \'but a grin.',1,0,1286,1,NULL,'2025-03-28 07:54:45','2025-12-23 19:31:51',0,0,0,1,NULL),(22,NULL,'Brielle','Harvey','He looked at the.',NULL,'thora.langworth@yahoo.com','$2y$12$b94ZSDL8rV8hhtudb0WGp.MZgaFUTrXQNOSwB2g1pM88LJhg9xjUK',129,'1991-09-01','+17267969234','2025-12-24 02:31:51',NULL,'employer',NULL,NULL,'27773 Conn Landing\nKeshaunport, VA 30938','After a time she had found her way through the air! Do you think, at your age, it is all the way of nursing it, (which was to get out at the Mouse\'s tail; \'but why do you know what \"it\" means.\' \'I.',1,0,2185,0,NULL,'2025-03-01 08:09:25','2025-12-23 19:31:51',0,0,1,0,NULL),(23,NULL,'Valerie','Marks','Footman went on in.',NULL,'freida.kautzer@lakin.info','$2y$12$4kSVwoNJ1k1KSA3/Iy5dxeb3O/.uk/yj68wD1fWGV2gdDfQFrzhp6',132,'1982-07-27','+15029024928','2025-12-24 02:31:51',NULL,'employer',NULL,NULL,'235 Lubowitz Mews\nEast Sarahside, NE 98794','Alice. \'Come on, then,\' said Alice, \'a great girl like you,\' (she might well say this), \'to go on for some way of settling all difficulties, great or small. \'Off with her head!\' Those whom she.',1,0,3382,0,NULL,'2025-03-05 22:59:58','2025-12-23 19:31:51',0,0,1,0,NULL),(24,NULL,'Efrain','Towne','I hadn\'t mentioned.',NULL,'rick73@gmail.com','$2y$12$NxkUyWyOhaqhspi6FnnFeuWZlmMYQpa6ApesuPu4eYyYecfP81kqq',132,'1982-09-28','+14699887149','2025-12-24 02:31:51',NULL,'employer',NULL,NULL,'922 Auer Tunnel Apt. 423\nSouth Kacie, VT 67928','Still she went on, \'I must be a lesson to you how the Dodo said, \'EVERYBODY has won, and all dripping wet, cross, and uncomfortable. The moment Alice appeared, she was to eat the comfits: this.',1,0,3462,1,NULL,'2025-11-28 22:53:14','2025-12-23 19:31:51',1,0,1,0,NULL),(25,NULL,'Christine','Bernier','Caterpillar. This.',NULL,'penelope.bergnaum@green.com','$2y$12$OYF9hMSD2DxFrgQujtAxU.Y09ioYj0CyYdobAxeLy/XhbLcP3MXT2',132,'1983-08-24','+12698095618','2025-12-24 02:31:52',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','30301 McCullough Pine Suite 419\nEast Carlie, ND 81347-6644','King said to herself that perhaps it was quite out of sight; and an old conger-eel, that used to it as you liked.\' \'Is that the best way you can;--but I must have been a holiday?\' \'Of course they.',1,0,3126,1,NULL,'2025-04-25 20:01:55','2025-12-23 19:31:52',1,1,0,0,NULL),(26,NULL,'Rosemary','Ryan','EVER happen in a.',NULL,'ykeebler@gmail.com','$2y$12$xZkSVQfayOWcNwB8dN4uVexhs9okTuExf2tgxxDHgjiHsKZ2.QQ.W',132,'1973-03-20','+19312105924','2025-12-24 02:31:52',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','5285 Meda Port Apt. 714\nAuerville, HI 76342','ARE a simpleton.\' Alice did not much surprised at her feet in a low, hurried tone. He looked anxiously at the Hatter, it woke up again as she was in the way of escape, and wondering what to do, and.',1,0,1365,1,NULL,'2025-10-06 10:35:08','2025-12-23 19:31:52',1,1,1,1,NULL),(27,NULL,'Vernie','Hickle','Hatter. \'You MUST.',NULL,'golden40@halvorson.com','$2y$12$klgKg.2nlrH18qhGWv4UO.eW.y1xDy.Wup5eDgvWazIkohTTB1iUq',128,'1985-12-24','+16318878785','2025-12-24 02:31:52',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','7532 Boehm Tunnel\nNorth Millieland, AL 51702','Alice, \'as all the rats and--oh dear!\' cried Alice, quite forgetting that she was beginning to think about it, you know.\' Alice had been of late much accustomed to usurpation and conquest. Edwin and.',1,0,4630,1,NULL,'2025-08-22 11:28:09','2025-12-23 19:31:52',1,0,0,1,NULL),(28,NULL,'Garrett','Heidenreich','Alice\'s elbow was.',NULL,'conor.emard@denesik.com','$2y$12$puf5t/cCNpNiMBKWhtVUF.SayF6A/BfrOMJ1oCRwE/A.J/jkcM5ba',132,'1980-01-27','+19034955780','2025-12-24 02:31:52',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','481 Macey Prairie\nVonmouth, CA 43324-9807','Gryphon. \'Turn a somersault in the book,\' said the King; and as he shook his head contemptuously. \'I dare say you\'re wondering why I don\'t understand. Where did they draw the treacle from?\' \'You can.',1,0,4027,1,NULL,'2025-07-07 06:32:54','2025-12-23 19:31:52',0,1,1,1,NULL),(29,NULL,'Alia','Becker','Alice, thinking it.',NULL,'xreichel@yahoo.com','$2y$12$wQRNH7osWbgw4D4glH5kiucMU.lmpfZCPneo9660ia8lHbbqOu/Oq',128,'2002-10-09','+12517905967','2025-12-24 02:31:53',NULL,'employer',NULL,NULL,'410 O\'Conner Camp\nEast Maryview, TN 58226-2845','Pigeon. \'I can hardly breathe.\' \'I can\'t help it,\' said Alice hastily; \'but I\'m not myself, you see.\' \'I don\'t know of any use, now,\' thought Alice, and she thought it would be offended again. \'Mine.',1,0,4299,0,NULL,'2025-12-09 01:13:29','2025-12-23 19:31:53',0,1,1,1,NULL),(30,NULL,'Tony','Quigley','King said, turning.',NULL,'zboncak.greta@gmail.com','$2y$12$u9UCMj5EpPcbx0qEw0B5Tuq0miZLwolphwFCkkq4lMJxognldhQ8W',128,'2000-01-31','+16616014690','2025-12-24 02:31:53',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','695 Watson Common Suite 579\nCorwinbury, VT 60498-1554','THAT direction,\' waving the other side, the puppy made another rush at the Cat\'s head with great emphasis, looking hard at Alice the moment they saw the Mock Turtle in a sorrowful tone; \'at least.',1,0,1426,1,NULL,'2025-12-05 22:50:02','2025-12-23 19:31:53',0,0,1,1,NULL),(31,NULL,'Nadia','Feest','Alice cautiously.',NULL,'cratke@gmail.com','$2y$12$5INbNCKOH8xEQEzjJUNzG.vpmDHTxgnR0gDWv4I59iE4VpTCts9Yu',128,'2000-08-21','+12838241078','2025-12-24 02:31:53',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','220 Dianna Underpass Suite 621\nEast Carrie, ND 03581-9927','Majesty!\' the soldiers did. After these came the royal children, and everybody laughed, \'Let the jury asked. \'That I can\'t show it you myself,\' the Mock Turtle would be QUITE as much as she had felt.',1,0,3548,0,NULL,'2025-11-15 21:33:04','2025-12-23 19:31:53',0,1,0,1,NULL),(32,NULL,'Arely','Goyette','Oh, my dear Dinah!.',NULL,'kautzer.maribel@wintheiser.com','$2y$12$zTwYb2sa6hJwvEhFdOGqHOyNRRh/4manvlD1TSSTFjl57K1w7tk4O',128,'1996-12-11','+14233516549','2025-12-24 02:31:53',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','687 Emerson Terrace Apt. 933\nBergstromchester, NE 65655-5042','King said to the three gardeners instantly threw themselves flat upon their faces, and the soldiers shouted in reply. \'Idiot!\' said the Hatter, and he went on, half to itself, \'Oh dear! Oh dear! I\'d.',1,0,1610,1,NULL,'2025-02-20 04:28:48','2025-12-23 19:31:53',1,0,0,1,NULL),(33,NULL,'Merle','Bayer','She ate a little.',NULL,'jude95@yahoo.com','$2y$12$9Ohyq1wDZ0XlXtYOTdrmde4/35goK.wlT1qMjBrT18DAc1DBLW5bi',130,'1998-06-10','+13363377050','2025-12-24 02:31:54',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','474 Scottie Lock Suite 909\nSouth Aliya, AR 70255','Dinah my dear! I wish you were or might have been ill.\' \'So they were,\' said the Mock Turtle. Alice was beginning to end,\' said the Caterpillar took the regular course.\' \'What was that?\' inquired.',1,0,3048,0,NULL,'2025-11-20 01:00:49','2025-12-23 19:31:54',1,1,0,0,NULL),(34,NULL,'Keegan','Haag','The judge, by the.',NULL,'gwalter@yahoo.com','$2y$12$1Ayb.D3xENtZk5AiTdiD8.bxAgej10RsR/pcag.g1QFBLANlvKvoq',128,'1971-05-02','+19195625974','2025-12-24 02:31:54',NULL,'employer',NULL,NULL,'6007 Obie Alley\nPort Margretstad, MN 42930-4749','CAN all that stuff,\' the Mock Turtle had just begun to repeat it, but her voice sounded hoarse and strange, and the little door, had vanished completely. Very soon the Rabbit in a thick wood. \'The.',1,0,3850,0,NULL,'2025-10-27 17:59:42','2025-12-23 19:31:54',1,0,0,1,NULL),(35,NULL,'Celia','Wiza','Alice sadly. \'Hand.',NULL,'kelvin62@muller.org','$2y$12$5TAkw7vIBLnlWzfJYKQfduHaxjeGe20ck.NSvgcjBdmq1BG31.LJW',128,'2014-10-05','+18303996247','2025-12-24 02:31:54',NULL,'employer',NULL,NULL,'5079 Yasmin Station Suite 963\nAnnalisehaven, AR 26190-5079','MORE than nothing.\' \'Nobody asked YOUR opinion,\' said Alice. \'What IS the fun?\' said Alice. \'Why?\' \'IT DOES THE BOOTS AND SHOES.\' the Gryphon said to herself, \'the way all the while, and fighting.',1,0,1972,1,NULL,'2025-07-02 04:19:52','2025-12-23 19:31:54',0,0,1,1,NULL),(36,NULL,'Kailey','Nitzsche','Alice as he spoke.',NULL,'cecil.russel@deckow.com','$2y$12$wQAxytbjpEo56L2TJcWWIuTi1jv27OnQL/QZ372rM3592ZbITPdHC',132,'1984-03-26','+19406220245','2025-12-24 02:31:54',NULL,'employer',NULL,NULL,'948 Dewitt Springs Suite 084\nMetzside, NH 91170-7406','Gryphon, and all the while, and fighting for the pool of tears which she had not noticed before, and behind them a railway station.) However, she did not seem to encourage the witness at all: he.',1,0,1127,1,NULL,'2025-03-25 04:42:09','2025-12-23 19:31:54',1,0,1,0,NULL),(37,NULL,'Marion','Brakus','March Hare meekly.',NULL,'verlie.kautzer@harris.org','$2y$12$KgTbvuM9UT/hNbXu5KAIW.1yC9R2LfV2NTFbJCW/eEOyDqkG3EkD2',131,'2010-08-01','+17864333936','2025-12-24 02:31:55',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','6461 Prohaska Courts\nSouth Mikelside, WI 87324','AND WASHING--extra.\"\' \'You couldn\'t have done that, you know,\' Alice gently remarked; \'they\'d have been ill.\' \'So they were,\' said the Mock Turtle. So she tucked her arm affectionately into Alice\'s.',1,0,618,0,NULL,'2025-10-07 11:24:59','2025-12-23 19:31:55',0,1,0,0,NULL),(38,NULL,'Marco','Parker','King sharply. \'Do.',NULL,'rdibbert@kris.com','$2y$12$6BWWNrdCxFMoELxIyGpAWuyhg3jFfdjXtWef4gCdDIuc82EGIPOYa',131,'1997-12-21','+17062898832','2025-12-24 02:31:55',NULL,'employer',NULL,NULL,'607 Dickens Dale Apt. 154\nSunnyfurt, NM 45165-8910','Turn that Dormouse out of the jurymen. \'No, they\'re not,\' said the Queen, \'and he shall tell you his history,\' As they walked off together, Alice heard the Queen to play croquet with the name of the.',1,0,1336,0,NULL,'2025-04-19 20:45:21','2025-12-23 19:31:55',1,0,1,0,NULL),(39,NULL,'Estel','Raynor','The great question.',NULL,'paucek.dexter@treutel.biz','$2y$12$pKhbjIq/QHNbBpdHgQ32DOLOIr2svqZ/4FKgAM5bzo86FNFfLdIH.',130,'1982-10-20','+15599389199','2025-12-24 02:31:55',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','23244 Kshlerin Station\nMohrport, NY 08622-4474','Duck: \'it\'s generally a ridge or furrow in the world! Oh, my dear paws! Oh my dear paws! Oh my dear paws! Oh my dear Dinah! I wonder what was going to turn into a small passage, not much like.',1,0,3729,0,NULL,'2025-08-25 16:04:17','2025-12-23 19:31:55',1,1,0,0,NULL),(40,NULL,'Wellington','Krajcik','Majesty,\' said the.',NULL,'jamar.renner@hotmail.com','$2y$12$FsmoMjV4f5upG.tfSudXPO.LJ1VKOWpJ4Ozf0pHS9OfZ4N00oAOgu',129,'1982-09-24','+17016265485','2025-12-24 02:31:55',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','99055 Raegan Hills Apt. 431\nNorth Madysonshire, PA 87373-4915','She was looking up into a butterfly, I should understand that better,\' Alice said very politely, \'if I had it written down: but I THINK I can guess that,\' she added in a Little Bill It was as steady.',1,0,135,0,NULL,'2025-10-15 12:35:35','2025-12-23 19:31:55',1,0,0,0,NULL),(41,NULL,'Enrique','Dietrich','I should think it.',NULL,'drath@hotmail.com','$2y$12$nelthvTdLSvGY/YT7Bo7CusKYkm3qa1oB1525fXO9n.1r.2Puq.1G',130,'1998-08-14','+19526911434','2025-12-24 02:31:56',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','91942 Garrison Manor Apt. 107\nRunolfssonshire, AL 01213-2343','I ever was at the stick, running a very grave voice, \'until all the rats and--oh dear!\' cried Alice in a few yards off. The Cat only grinned a little now and then nodded. \'It\'s no business there, at.',1,0,459,0,NULL,'2025-04-21 22:57:48','2025-12-23 19:31:56',1,0,1,0,NULL),(42,NULL,'Dorothy','Franecki','Mouse to tell its.',NULL,'wilhelm29@kulas.net','$2y$12$7NxByu9ahge1QqvQQ0Bv5ulLfpbS0SnQqkSP8cfg7nmKRVEQbsRhO',128,'2013-12-18','+15205473491','2025-12-24 02:31:56',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','954 Hammes Vista Suite 158\nNorth Shaun, TX 71412','She said the Gryphon. \'The reason is,\' said the Cat, and vanished again. Alice waited a little, half expecting to see how he can thoroughly enjoy The pepper when he finds out who I WAS when I get.',1,0,3322,1,NULL,'2025-03-15 10:48:28','2025-12-23 19:31:56',0,1,1,1,NULL),(43,NULL,'Andy','Leuschke','What made you so.',NULL,'laura40@gmail.com','$2y$12$DBnf4GbpyJ.A6fGZDSlLHuIZhVHOPVZ8sS3ONi6JLda16ZuoYBqo2',129,'1970-12-16','+17863361655','2025-12-24 02:31:56',NULL,'employer',NULL,NULL,'90226 Georgette Hollow\nWest Eugenia, WY 24945','She said the others. \'We must burn the house down!\' said the Footman, and began picking them up again with a sudden burst of tears, \'I do wish they WOULD put their heads down and began bowing to the.',1,0,4498,1,NULL,'2025-01-30 22:51:25','2025-12-23 19:31:56',1,0,1,1,NULL),(44,NULL,'Gladyce','Will','Which shall sing?\'.',NULL,'moses18@gmail.com','$2y$12$Z5EaARkUQVYXzEyldzJjCejrzj7KlRqbRSdhivLbYwV/xwmcuQAFa',129,'1987-11-26','+13173530718','2025-12-24 02:31:56',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','5079 Francesca Loop\nHellershire, AR 23740-3669','So she sat still just as if he would not stoop? Soup of the officers: but the Rabbit in a solemn tone, only changing the order of the house, \"Let us both go to on the floor, as it could go, and.',1,0,2955,0,NULL,'2025-08-25 00:33:50','2025-12-23 19:31:56',1,0,0,1,NULL),(45,NULL,'Kamryn','Halvorson','This did not dare.',NULL,'teagan.sipes@hotmail.com','$2y$12$xifwSrb7JcSDZ.4dc3LnHe1Y1bXeQ9lC44Fv3qmv6wpGyEzSX953i',131,'2006-08-18','+12706736216','2025-12-24 02:31:57',NULL,'employer',NULL,NULL,'215 Ortiz Passage Suite 962\nWest Leliahaven, TX 52166-9951','King was the fan and gloves. \'How queer it seems,\' Alice said to herself; \'his eyes are so VERY much out of the sea.\' \'I couldn\'t help it,\' said Alice, and sighing. \'It IS the same thing as \"I get.',1,0,3541,1,NULL,'2025-04-16 02:42:22','2025-12-23 19:31:57',1,0,0,1,NULL),(46,NULL,'Maurice','Sipes','Alice; and Alice.',NULL,'janessa03@hotmail.com','$2y$12$Qt.6nm7tI4by28anKJHlM.nFuMTwM68Xjk4HxDtGhUjb6WVvd6PCG',131,'2000-06-19','+12816478568','2025-12-24 02:31:57',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','7761 Lakin Brook\nMitchellton, NV 11329-0675','The Frog-Footman repeated, in the same tone, exactly as if nothing had happened. \'How am I to do THAT in a low curtain she had to stoop to save her neck kept getting entangled among the party. Some.',1,0,4189,0,NULL,'2025-06-30 16:30:33','2025-12-23 19:31:57',1,0,1,0,NULL),(47,NULL,'Zane','Braun','He trusts to you.',NULL,'lucinda53@ratke.biz','$2y$12$x4f0oG4le7Zz16zqugmVsu2GRXt6ozog1bevT0mUcYcn0PxH8gp/u',131,'2011-10-26','+13474381064','2025-12-24 02:31:57',NULL,'employer',NULL,NULL,'710 Dina Ports\nSouth Lavadatown, IA 36651-4543','She said this last remark that had slipped in like herself. \'Would it be of very little way out of a procession,\' thought she, \'what would become of me?\' Luckily for Alice, the little golden key.',1,0,2400,1,NULL,'2025-11-28 18:15:30','2025-12-23 19:31:57',1,1,0,1,NULL),(48,NULL,'Levi','Witting','Alice watched the.',NULL,'crawford04@yahoo.com','$2y$12$rWulTIFQBjw4k3rwhvkCxuxC2hlfv4zGJVB.MrdIelnC/f4G1gYZ6',131,'1980-08-31','+12183489984','2025-12-24 02:31:57',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','481 Herminia Plains Apt. 392\nNew Vincenza, NV 02075','King. The next witness was the first question, you know.\' \'Not the same solemn tone, \'For the Duchess. \'Everything\'s got a moral, if only you can find it.\' And she squeezed herself up and down, and.',1,0,663,0,NULL,'2025-09-25 23:12:13','2025-12-23 19:31:57',1,1,0,1,NULL),(49,NULL,'Ned','Wolf','Alice had not gone.',NULL,'kassulke.aurelia@ankunding.com','$2y$12$Jxs2HBV2TWb37d4oknQAJur9ps1xrpiPY3UkXhcE662zir58PaZtu',128,'2020-08-17','+13097443607','2025-12-24 02:31:58',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','75552 Antonia Crest Suite 052\nClintberg, WA 07505-5269','I got up in her life before, and behind it was perfectly round, she found herself safe in a trembling voice to a farmer, you know, and he checked himself suddenly: the others looked round also, and.',1,0,2804,1,NULL,'2025-02-01 07:06:46','2025-12-23 19:31:58',0,0,1,1,NULL),(50,NULL,'Penelope','Corwin','Time as well wait.',NULL,'wisoky.ezekiel@graham.info','$2y$12$fPXhr7FpB3VMPyO20HDMo.WBb2eN7BgaN52Ja6K0BHmGvOcR/w4SW',129,'2016-08-23','+17855039944','2025-12-24 02:31:58',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','89858 Diamond Station\nHumbertotown, MT 30977','I am, sir,\' said Alice; \'I might as well say,\' added the Dormouse. \'Fourteenth of March, I think you\'d take a fancy to cats if you drink much from a bottle marked \'poison,\' so Alice went on, half to.',1,0,1329,0,NULL,'2025-02-22 06:09:59','2025-12-23 19:31:58',1,1,0,1,NULL),(51,NULL,'Elisa','Flatley','Mock Turtle Soup.',NULL,'dallin.shanahan@gmail.com','$2y$12$ZcHM7DFnAcutsHXPMUwg1eYIFUn/TiAI15wGJ9xdZ/eF4yKjS.GFe',132,'2002-07-28','+19845186229','2025-12-24 02:31:58',NULL,'employer',NULL,NULL,'5767 Brycen Extension\nEast Elena, TX 19662','Like a tea-tray in the distance, sitting sad and lonely on a branch of a muchness\"--did you ever see such a fall as this, I shall have to fly; and the choking of the lefthand bit. * * * * * * * * *.',1,0,2840,0,NULL,'2025-05-16 10:30:35','2025-12-23 19:31:58',0,0,0,1,NULL),(52,NULL,'Celestino','Mertz','It\'s high time you.',NULL,'boyle.whitney@yahoo.com','$2y$12$pFj3NXCsux/gn.UpFD0n4eZrogLxXmiya0Z2gdLwAqOFhatPcEqka',131,'1982-03-13','+18205472904','2025-12-24 02:31:58',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','699 Hintz Hollow\nWuckertfurt, VT 58235','Alice noticed with some surprise that the poor little feet, I wonder if I\'ve been changed for any lesson-books!\' And so she sat down again in a deep voice, \'What are they doing?\' Alice whispered to.',1,0,933,1,NULL,'2025-10-13 18:38:13','2025-12-23 19:31:58',1,1,0,0,NULL),(53,NULL,'Raquel','Sanford','Hatter. \'Stolen!\'.',NULL,'porter62@gmail.com','$2y$12$z69UH6Qe9ni51AsO9yaOAeymHPueKyRo2HeFaPinaI6/dsqE7C5O6',132,'1988-07-28','+16627209567','2025-12-24 02:31:59',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','68340 Adam Turnpike\nDickensville, MA 91277','Alice put down the chimney close above her: then, saying to her ear. \'You\'re thinking about something, my dear, and that makes them bitter--and--and barley-sugar and such things that make children.',1,0,2066,1,NULL,'2025-08-10 09:35:31','2025-12-23 19:31:59',1,1,1,0,NULL),(54,NULL,'Pearl','Ryan','Alice opened the.',NULL,'fay.roger@hotmail.com','$2y$12$7fvFOKfMVOfduOJ8FVBOXehhqIWxtZZDH3iAH.T6kM9Mdl3L6U/mq',132,'1987-06-12','+18029043841','2025-12-24 02:31:59',NULL,'employer',NULL,NULL,'1062 Heaney Landing\nSelinaland, OR 98499','She felt that she had this fit) An obstacle that came between Him, and ourselves, and it. Don\'t let him know she liked them best, For this must ever be A secret, kept from all the time she heard her.',1,0,3588,0,NULL,'2025-04-06 18:14:25','2025-12-23 19:31:59',0,0,0,1,NULL),(55,NULL,'Yolanda','Gleason','Heads below!\' (a.',NULL,'amertz@hotmail.com','$2y$12$NQOCpd0YgKvSVEMRRqJN8e0htkuFOmkQZ.nfuLYP2peCAWmvnyeje',128,'2013-04-05','+16624031842','2025-12-24 02:31:59',NULL,'employer',NULL,NULL,'54084 D\'Amore Way Apt. 096\nKeeblertown, CT 68831-9121','Hatter. \'Nor I,\' said the Dodo in an offended tone, \'Hm! No accounting for tastes! Sing her \"Turtle Soup,\" will you, won\'t you join the dance?\"\' \'Thank you, sir, for your walk!\" \"Coming in a deep.',1,0,4169,1,NULL,'2025-05-22 03:44:37','2025-12-23 19:31:59',0,1,1,0,NULL),(56,NULL,'Ryder','Hyatt','This of course, I.',NULL,'kjohns@hotmail.com','$2y$12$pe/H3gBPqfCpv1K/d3igg.ic1XHIvUsfGOmOFWXLDLti.CrX50QCm',129,'1996-05-17','+18305445770','2025-12-24 02:31:59',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','198 Bechtelar Valleys Suite 102\nEast Leonefort, PA 78565','Soup of the house!\' (Which was very fond of pretending to be trampled under its feet, ran round the court and got behind Alice as she tucked her arm affectionately into Alice\'s, and they walked off.',1,0,3864,1,NULL,'2025-05-11 17:10:54','2025-12-23 19:31:59',1,0,0,0,NULL),(57,NULL,'Arianna','O\'Conner','Alice had begun to.',NULL,'crooks.ally@gmail.com','$2y$12$NiUm.f9sATSWlJYVe/3ZceNHltCEX/1rO8RGlOExohNBhnzUWDIJ.',130,'1978-06-07','+17194223594','2025-12-24 02:32:00',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','668 Dahlia Court\nWest Vella, NJ 38227-4621','Hatter grumbled: \'you shouldn\'t have put it to half-past one as long as it was indeed: she was appealed to by all three to settle the question, and they repeated their arguments to her, one on each.',1,0,4788,1,NULL,'2025-09-17 21:06:24','2025-12-23 19:32:00',0,0,0,0,NULL),(58,NULL,'Sienna','Nader','Rabbit just under.',NULL,'pat.prosacco@hotmail.com','$2y$12$kigcL7oIzuvKH/ibmiVGAe7rMZEDQ09i44puOQDniOjva8XmyUHk2',131,'2021-12-28','+13525667575','2025-12-24 02:32:00',NULL,'employer',NULL,NULL,'330 Cloyd Walk\nNew Jacques, OK 38623-7023','Queen had ordered. They very soon finished off the mushroom, and raised herself to about two feet high: even then she looked at the Gryphon hastily. \'Go on with the next witness would be four.',1,0,689,0,NULL,'2025-04-17 04:43:45','2025-12-23 19:32:00',1,0,0,1,NULL),(59,NULL,'Rossie','McKenzie','White Rabbit read.',NULL,'quigley.dakota@hotmail.com','$2y$12$iYAmAnzA4X4hoApv2N4EDenFShY.gXjF2kBp6elXBgSy/yGuuaRGu',132,'1974-01-22','+14255437276','2025-12-24 02:32:00',NULL,'employer',NULL,NULL,'24822 Skiles Mount Suite 498\nBoganland, FL 87839','WOULD always get into that lovely garden. First, however, she waited for a few minutes, and she at once to eat the comfits: this caused some noise and confusion, as the March Hare interrupted.',1,0,2674,1,NULL,'2025-12-10 03:03:23','2025-12-23 19:32:00',1,1,1,0,NULL),(60,NULL,'Julia','Baumbach','COULD! I\'m sure I.',NULL,'meggie84@auer.com','$2y$12$Z8JkVYbqCvrsogAzuvnXrO4.gL1sIeofid2SpZhAd5KJM/Yjn34Hm',129,'2012-02-20','+19387005343','2025-12-24 02:32:00',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','53900 Dare Trace Apt. 295\nWest Perrybury, NE 53218','Mock Turtle with a soldier on each side to guard him; and near the King added in a very melancholy voice. \'Repeat, \"YOU ARE OLD, FATHER WILLIAM,\"\' said the Dormouse: \'not in that soup!\' Alice said.',1,0,2174,1,NULL,'2025-07-15 15:36:23','2025-12-23 19:32:00',0,1,1,1,NULL),(61,NULL,'Maybell','Daugherty','I do,\' said Alice.',NULL,'doyle.adolphus@von.biz','$2y$12$JU1hy87nyobW.yemA8dpx.PUrQ/5KzZVb48hb4D8BF/pSYU.WV0dO',131,'2005-01-15','+16313583333','2025-12-24 02:32:01',NULL,'employer',NULL,NULL,'52366 Howard Corner\nFeilfurt, WY 72846','Crab took the least notice of her childhood: and how she would get up and down, and was going to say,\' said the Mock Turtle to the three gardeners, oblong and flat, with their fur clinging close to.',1,0,2417,0,NULL,'2025-09-17 08:02:19','2025-12-23 19:32:01',0,0,1,0,NULL),(62,NULL,'Luciano','Gorczany','Then she went in.',NULL,'rstrosin@hotmail.com','$2y$12$nvaJPw0JvJ3jsjtGWGzZ.ecImmTLxZEvvPLKuum4BkUTiaEqwB2KS',132,'2009-02-02','+16234274451','2025-12-24 02:32:01',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','64611 Powlowski Throughway\nAlvertaview, NM 29597-2459','Just then she remembered how small she was up to the Knave of Hearts, carrying the King\'s crown on a three-legged stool in the house, and found that, as nearly as large as himself, and this was not.',1,0,2363,0,NULL,'2025-10-09 17:43:54','2025-12-23 19:32:01',0,0,1,1,NULL),(63,NULL,'Kaia','Raynor','Alice. \'I\'ve tried.',NULL,'aryanna.swaniawski@yahoo.com','$2y$12$nRKIUByghNfJmwzX7dQIo.WHWAQ8QwCN7KYKLtAxonRKzq8FwM32S',131,'2022-01-29','+18576497517','2025-12-24 02:32:01',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','664 Dooley Glens Suite 648\nNew Martineside, AK 27368-9854','Queen, but she remembered how small she was as much as she ran. \'How surprised he\'ll be when he finds out who I WAS when I grow at a reasonable pace,\' said the Cat, \'if you only walk long enough.\'.',1,0,4751,0,NULL,'2025-01-02 01:32:10','2025-12-23 19:32:01',0,1,0,0,NULL),(64,NULL,'Electa','Rau','Caterpillar took.',NULL,'travon17@hotmail.com','$2y$12$.fo5hAQfsrq5/xjHX6BUaO8BtqftSjKqI/owkqf8ywublfLl9gwaW',132,'1979-11-17','+16237635495','2025-12-24 02:32:01',NULL,'employer',NULL,NULL,'4617 Brigitte Rue\nO\'Connellfurt, FL 26944-8280','March Hare. \'Sixteenth,\' added the Gryphon; and then the Mock Turtle went on saying to herself in a VERY turn-up nose, much more like a serpent. She had just succeeded in curving it down into a.',1,0,1595,1,NULL,'2025-09-09 22:33:07','2025-12-23 19:32:01',0,0,0,1,NULL),(65,NULL,'Rafaela','Kemmer','The judge, by the.',NULL,'stanton.amos@yahoo.com','$2y$12$2TQNcJpB/3x2jW/bp6d71uQ541M6Tf.wV2T3exLTiOk0nRqLPqIZC',129,'1977-11-22','+15414659391','2025-12-24 02:32:01',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','164 Hilario Stream\nPort Rowanmouth, SD 70527-9979','Hatter, \'when the Queen had only one way up as the Rabbit, and had to leave off being arches to do such a puzzled expression that she did so, very carefully, nibbling first at one corner of it: for.',1,0,4422,1,NULL,'2025-06-09 22:13:35','2025-12-23 19:32:01',0,0,1,1,NULL),(66,NULL,'Della','Prohaska','Soup! \'Beautiful.',NULL,'hoeger.cristal@gmail.com','$2y$12$M4NAGMgdN2bWulL6jVqALumVsnKhQFrF9ZoQYCpL25.hCJz8SP.Nm',130,'1991-09-06','+18383042827','2025-12-24 02:32:02',NULL,'employer',NULL,NULL,'303 Gerlach Walks\nShawnside, RI 18062','I breathe\"!\' \'It IS a Caucus-race?\' said Alice; \'but a grin without a porpoise.\' \'Wouldn\'t it really?\' said Alice angrily. \'It wasn\'t very civil of you to get out at all what had become of me?\'.',1,0,1532,1,NULL,'2025-10-25 12:54:06','2025-12-23 19:32:02',0,0,0,0,NULL),(67,NULL,'Grayce','O\'Reilly','Puss,\' she began.',NULL,'whaag@mclaughlin.com','$2y$12$tt2.m39sk1g/n48AjUday.9ETgAZG/VXbwkYXl0qKPifwWQEQErTa',131,'2005-06-06','+14435470776','2025-12-24 02:32:02',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','89267 Tremblay Crest\nNorth Dorthy, UT 67002-4403','Mouse in the wind, and the turtles all advance! They are waiting on the back. However, it was sneezing and howling alternately without a great hurry; \'and their names were Elsie, Lacie, and Tillie.',1,0,4383,0,NULL,'2025-09-30 00:44:02','2025-12-23 19:32:02',0,0,1,0,NULL),(68,NULL,'Pearline','Cormier','I eat\" is the same.',NULL,'cummings.ryan@mohr.com','$2y$12$SAZWW4hFZq/4wr0zrXGih.YKxmPvqGLWxTbfhivCqkf/PU5qfFu7S',132,'2000-05-14','+15209838225','2025-12-24 02:32:02',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','42296 Dooley Mission Apt. 835\nKristatown, LA 61101-2872','I\'ll get into that lovely garden. I think that proved it at all,\' said the White Rabbit, who said in a deep voice, \'are done with blacking, I believe.\' \'Boots and shoes under the window, and on it.',1,0,3931,1,NULL,'2025-02-12 15:37:27','2025-12-23 19:32:02',0,1,1,1,NULL),(69,NULL,'Skylar','Willms','VERY deeply with a.',NULL,'fparker@gmail.com','$2y$12$Qc5LA5eD6PkgsC4ilOM62..6AtPXKE4IAwFrposMcdhd7YsvnADfK',128,'1982-02-22','+19547708291','2025-12-24 02:32:02',NULL,'employer',NULL,NULL,'63803 Terry Prairie\nWest Estefania, VT 87798','YOUR table,\' said Alice; \'all I know I do!\' said Alice to herself, \'in my going out altogether, like a star-fish,\' thought Alice. One of the hall; but, alas! either the locks were too large, or the.',1,0,3550,1,NULL,'2025-11-02 11:00:11','2025-12-23 19:32:02',1,1,0,0,NULL),(70,NULL,'Horace','Cummings','As soon as look at.',NULL,'ccollier@hotmail.com','$2y$12$ilxJUywpc/5QJ7w36wxBKOx2JMf9UcwEGdLO1l6dNCx5x0YkyFZ6e',129,'1985-04-03','+15755071019','2025-12-24 02:32:03',NULL,'employer',NULL,NULL,'4733 Amalia Mission\nMillerland, PA 58362-7289','Alice\'s, and they all moved off, and had just begun to think about stopping herself before she got into the sky all the unjust things--\' when his eye chanced to fall upon Alice, as she could. \'The.',1,0,1848,0,NULL,'2025-09-28 16:22:23','2025-12-23 19:32:03',0,0,1,1,NULL),(71,NULL,'Maryam','Fisher','But at any rate,\'.',NULL,'haag.rosalind@yahoo.com','$2y$12$KQERIsKX6QKAJYzKiS90xO45nTBeMdFpQkVLTlfHTCVcEBEZcwi02',130,'2009-03-03','+16172937702','2025-12-24 02:32:03',NULL,'employer',NULL,NULL,'58318 Boehm Loop Suite 559\nLindgrenside, WV 56268','France-- Then turn not pale, beloved snail, but come and join the dance. Would not, could not, would not, could not, would not, could not, would not, could not, could not, would not, could not think.',1,0,157,0,NULL,'2025-02-08 11:13:34','2025-12-23 19:32:03',1,0,1,1,NULL),(72,NULL,'Howard','Windler','I don\'t remember.',NULL,'karlee39@gmail.com','$2y$12$A/ThtWUPfpLAGuhtm1QUEe9if4RfrM65nRuq9envjtakpVaFBmzuK',129,'1990-02-19','+15615284852','2025-12-24 02:32:03',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','79041 Gottlieb Hill\nAnnalisetown, NM 91696','March Hare,) \'--it was at in all directions, \'just like a star-fish,\' thought Alice. One of the house, \"Let us both go to on the second thing is to do so. \'Shall we try another figure of the water.',1,0,1707,0,NULL,'2025-05-22 01:51:40','2025-12-23 19:32:03',0,1,0,1,NULL),(73,NULL,'Marion','Hermann','I was thinking I.',NULL,'kgraham@dubuque.org','$2y$12$sN9saYB59l/VKoc32hlkVeCHqJJ1t6ljwvXrOrS0qnXEcezDZYJJu',132,'1999-05-06','+18656281940','2025-12-24 02:32:03',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','336 Ross Lock Suite 885\nPaucekview, NM 30094-8453','Alice. \'I\'m a--I\'m a--\' \'Well! WHAT are you?\' said the Mock Turtle sighed deeply, and began, in a day did you ever eat a little worried. \'Just about as it went. So she set to work shaking him and.',1,0,4204,0,NULL,'2025-12-07 02:08:44','2025-12-23 19:32:03',0,0,1,1,NULL),(74,NULL,'Delbert','Marvin','Alice herself, and.',NULL,'eparisian@runolfsdottir.org','$2y$12$U0iRw/w4aOIUSTVrNfmKbeLkvvwKyBYKJuXZEpbujeHymgJXO8RXW',130,'1973-08-10','+18786087415','2025-12-24 02:32:04',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','329 Wendell Junctions\nEloyborough, TX 21334','Poor Alice! It was so large in the kitchen that did not see anything that had made the whole party swam to the three gardeners, oblong and flat, with their hands and feet, to make out exactly what.',1,0,1414,1,NULL,'2025-12-01 17:08:16','2025-12-23 19:32:04',1,1,1,1,NULL),(75,NULL,'Norbert','Hartmann','I tell you!\' said.',NULL,'marquardt.gudrun@gmail.com','$2y$12$ofNap4.fQAnETqiZet0pDe7wFOpKD7jCq5WaKxV6/ckJuQqOszOnG',128,'1991-06-30','+19809808238','2025-12-24 02:32:04',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','6968 Caterina Grove Suite 131\nAdalbertomouth, ID 84704','Duck and a large mustard-mine near here. And the Eaglet bent down its head to feel which way she put them into a large piece out of the edge of her childhood: and how she would gather about her.',1,0,1795,0,NULL,'2024-12-24 11:37:25','2025-12-23 19:32:04',0,1,1,1,NULL),(76,NULL,'Brandyn','Kassulke','Alice looked very.',NULL,'karianne.braun@davis.org','$2y$12$kjVntdFPNbeL19JVyl9Y/.lIae8HT07RQasGK7.mEM58Oe3CDx13G',129,'1987-01-31','+15599670540','2025-12-24 02:32:04',NULL,'employer',NULL,NULL,'568 Santos Land Apt. 271\nMcClureborough, OH 15491-1594','Caterpillar took the opportunity of saying to her that she was considering in her brother\'s Latin Grammar, \'A mouse--of a mouse--to a mouse--a mouse--O mouse!\') The Mouse did not venture to go on in.',1,0,404,1,NULL,'2025-01-28 14:04:14','2025-12-23 19:32:04',1,0,0,0,NULL),(77,NULL,'Damaris','Stehr','Mock Turtle. \'And.',NULL,'casimir.beahan@windler.com','$2y$12$SDgBXWhZbMAIiAvR.9TuWOFn3k0B.LCLpEzP91o5SW9Xb7Zi1Uhxu',129,'2001-10-30','+17404319677','2025-12-24 02:32:04',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','818 Marcus Trail\nFabianshire, MN 17235-6371','And the executioner myself,\' said the Mock Turtle, and said \'That\'s very important,\' the King exclaimed, turning to the Cheshire Cat: now I shall only look up in a confused way, \'Prizes! Prizes!\'.',1,0,2366,0,NULL,'2025-04-20 05:46:12','2025-12-23 19:32:04',1,0,0,1,NULL),(78,NULL,'Antonette','Veum','Alice guessed in a.',NULL,'mraz.zachery@gmail.com','$2y$12$0HT6R8GTwur.1CK1uwO4a.Ixzacx/heYzreIKPKbuXnvVq4QG6Dpe',128,'1989-08-27','+13233515891','2025-12-24 02:32:05',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','1760 Marcel Roads\nNew Lorenza, OH 21036-8395','ONE with such a dreadful time.\' So Alice began to tremble. Alice looked down at her feet, they seemed to listen, the whole pack of cards, after all. I needn\'t be afraid of them!\' \'And who are.',1,0,377,1,NULL,'2025-03-11 23:08:38','2025-12-23 19:32:05',0,0,0,1,NULL),(79,NULL,'Shaniya','Cartwright','There was nothing.',NULL,'lyda.schneider@schneider.net','$2y$12$MPJEXiiRzdOQlC.f9zINJOuUkEW25E9xcrnu3Zo6XkKMRpQlj2rUa',128,'1975-03-30','+15419286599','2025-12-24 02:32:05',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','5897 Murphy Cove\nAnastasialand, UT 24440','The first question of course had to be talking in his turn; and both the hedgehogs were out of the Lobster Quadrille?\' the Gryphon added \'Come, let\'s hear some of them didn\'t know it was a bright.',1,0,2650,0,NULL,'2025-05-18 11:27:19','2025-12-23 19:32:05',1,1,0,0,NULL),(80,NULL,'Amari','Nolan','Stop this moment.',NULL,'boris.schinner@russel.com','$2y$12$uYeZ4yGzAuUHRfb9Ckdm2e2695ZpTe7vbYHH2w9rFaxOwKKd0hnSi',132,'2020-09-30','+16512456782','2025-12-24 02:32:05',NULL,'employer',NULL,NULL,'91339 Dicki Cape\nLutherberg, WA 16700-5004','Footman remarked, \'till tomorrow--\' At this moment Alice felt dreadfully puzzled. The Hatter\'s remark seemed to be in before the trial\'s over!\' thought Alice. One of the singers in the middle.',1,0,4437,1,NULL,'2025-02-01 22:50:50','2025-12-23 19:32:05',1,0,0,1,NULL),(81,NULL,'Elza','Schinner','Oh dear! I shall.',NULL,'gmcdermott@cummings.biz','$2y$12$5IJWLc3pJ.b21kDNbgJrFeig41NXeT2QPTIEh25vVkxVzwlZ4dC0q',129,'1985-03-13','+17738626479','2025-12-24 02:32:05',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','91317 Keira Freeway\nHaleymouth, IL 58613','Mock Turtle a little irritated at the mouth with strings: into this they slipped the guinea-pig, head first, and then, and holding it to his son, \'I feared it might be some sense in your knocking,\'.',1,0,1147,1,NULL,'2025-09-01 08:30:44','2025-12-23 19:32:05',1,0,1,1,NULL),(82,NULL,'Florence','Cruickshank','I\'m sure she\'s the.',NULL,'hkuhlman@hilpert.biz','$2y$12$sy0TwUhNd/cOPb4o.L/i7uULa5fa1ub3FTGUPQoo3rzVhEBujZnt6',131,'1972-06-30','+19738020806','2025-12-24 02:32:06',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','646 Giles Club\nPort Giovani, OR 55551','Dodo could not taste theirs, and the pool of tears which she had accidentally upset the milk-jug into his plate. Alice did not sneeze, were the cook, and a fan! Quick, now!\' And Alice was beginning.',1,0,435,0,NULL,'2025-05-22 02:50:30','2025-12-23 19:32:06',1,0,1,0,NULL),(83,NULL,'Susanna','Hirthe','I\'ve offended it.',NULL,'horacio22@king.org','$2y$12$vN9VamPQQ0k1z4MR8PRdGuEIyA4SHSB4kxLpbsrBmL8JMfHtIC6Oe',128,'2002-09-06','+19106526354','2025-12-24 02:32:06',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','2236 Quigley Mews\nMillerberg, LA 48191','You see, she came upon a low voice. \'Not at first, the two creatures, who had spoken first. \'That\'s none of them with one finger pressed upon its forehead (the position in which the wretched Hatter.',1,0,4998,0,NULL,'2025-08-23 14:06:55','2025-12-23 19:32:06',0,1,0,1,NULL),(84,NULL,'Colin','Prohaska','White Rabbit with.',NULL,'ankunding.bethany@runolfsson.org','$2y$12$Q2TkTRGCJJXx3ad5ViEavO1wh7QUqBAofdPd2wBf6DmAkevRFmgvG',130,'1992-11-13','+16102218986','2025-12-24 02:32:06',NULL,'employer',NULL,NULL,'118 Maye Road Apt. 228\nJustynburgh, LA 61938-4225','Alice: \'I don\'t know the way to fly up into hers--she could hear him sighing as if his heart would break. She pitied him deeply. \'What is it?\' he said. (Which he certainly did NOT, being made.',1,0,1173,1,NULL,'2025-11-14 04:26:21','2025-12-23 19:32:06',1,1,1,1,NULL),(85,NULL,'Gavin','Moen','Duchess, \'chop off.',NULL,'aisha69@hotmail.com','$2y$12$rxAyxwVut0e8PtBA6xtbJ.KSOyp6ua60TBX0/u0htr2GNOvNRQUWC',130,'2021-10-29','+12816866836','2025-12-24 02:32:06',NULL,'employer',NULL,NULL,'49844 Roob Loop Apt. 694\nNew Candice, WV 17624-3547','King had said that day. \'That PROVES his guilt,\' said the others. \'We must burn the house of the sort. Next came an angry tone, \'Why, Mary Ann, and be turned out of the tea--\' \'The twinkling of the.',1,0,4864,0,NULL,'2025-08-29 01:40:15','2025-12-23 19:32:06',0,0,1,1,NULL),(86,NULL,'Euna','Reilly','Queen added to one.',NULL,'curtis.fisher@pollich.com','$2y$12$FxA5C7H9sMwdrsu8j8Q57O889n4w3/vpnWchRWSnc/6hj9FYriXdG',132,'2011-12-06','+19207438388','2025-12-24 02:32:07',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','8132 Kurt Estate\nLake Janaefort, MT 13086','How queer everything is to-day! And yesterday things went on growing, and very neatly and simply arranged; the only difficulty was, that you had been anxiously looking across the field after it, and.',1,0,1265,0,NULL,'2025-04-25 03:25:25','2025-12-23 19:32:07',1,1,0,0,NULL),(87,NULL,'Ramiro','Kunde','YOU are, first.\'.',NULL,'raphaelle.renner@yahoo.com','$2y$12$2LwNVtPdxh5u7mZ8yQXIkeV7bZNaKmy3GKVfOLsmLkfu3jB5W1ur6',131,'2001-12-10','+17044271922','2025-12-24 02:32:07',NULL,'employer',NULL,NULL,'497 D\'angelo Landing Suite 206\nSouth Freddieberg, PA 99200','King. The next thing was snorting like a steam-engine when she had brought herself down to nine inches high. CHAPTER VI. Pig and Pepper For a minute or two, she made her draw back in a furious.',1,0,4785,1,NULL,'2024-12-29 00:48:16','2025-12-23 19:32:07',0,0,1,0,NULL),(88,NULL,'Ray','Trantow','I can\'t remember,\'.',NULL,'tmuller@hotmail.com','$2y$12$/zCuqMbgfT30ibliLDaXYOzTkqENcRH5RBDvdcMxqHDOoXCZIYWUi',131,'1995-07-11','+19312809286','2025-12-24 02:32:07',NULL,'employer',NULL,NULL,'978 Konopelski Rapid\nDickinsonbury, ID 64098','Alice ventured to say. \'What is it?\' he said. (Which he certainly did NOT, being made entirely of cardboard.) \'All right, so far,\' said the Hatter: \'it\'s very rude.\' The Hatter was the cat.) \'I hope.',1,0,2429,1,NULL,'2025-03-28 07:35:36','2025-12-23 19:32:07',0,0,1,1,NULL),(89,NULL,'Jarrod','Pfannerstill','BEST butter, you.',NULL,'qcrist@gmail.com','$2y$12$mYMkFqVyHWNGCHqeWLkDMu9ruipi60PAJ5chR8SWF5mx4CuG.Q4jG',129,'1995-09-28','+17475234408','2025-12-24 02:32:07',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','1345 Deborah Spurs Apt. 142\nAdelineton, HI 17193','March Hare was said to the Mock Turtle sighed deeply, and drew the back of one flapper across his eyes. He looked at the stick, and made believe to worry it; then Alice, thinking it was certainly.',1,0,2973,1,NULL,'2025-10-15 00:55:19','2025-12-23 19:32:07',0,0,1,1,NULL),(90,NULL,'Citlalli','Zboncak','King; \'and don\'t.',NULL,'esperanza.gislason@wolff.biz','$2y$12$d6VSHC0kjP1l/LpRP.4Y2eZOu4VG9aeX6tjZ4.t8zloShXV6MvHH2',130,'1997-06-28','+17064307295','2025-12-24 02:32:08',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','598 Pollich Ferry Apt. 388\nMarksville, MD 78704','For a minute or two, they began solemnly dancing round and get in at the end of the legs of the garden, and marked, with one elbow against the door, staring stupidly up into a graceful zigzag, and.',1,0,4238,0,NULL,'2025-05-09 16:02:14','2025-12-23 19:32:08',0,1,1,0,NULL),(91,NULL,'Albin','Marquardt','Sing her \"Turtle.',NULL,'pauline.lebsack@kerluke.com','$2y$12$HEuK7J2jznyeOQ.0YB56nOsOP8WdOWvwRS7/HedjdkJ1IAnC8a8y.',131,'1983-05-09','+18047478734','2025-12-24 02:32:08',NULL,'employer',NULL,NULL,'45947 Rodolfo Mountain\nEast Florida, MO 52059','Bill,\' she gave a little anxiously. \'Yes,\' said Alice in a very decided tone: \'tell her something about the right size, that it seemed quite natural to Alice to herself, \'in my going out altogether.',1,0,301,1,NULL,'2025-11-05 20:15:30','2025-12-23 19:32:08',1,0,1,0,NULL),(92,NULL,'Glen','Barton','However, she got.',NULL,'ykub@hotmail.com','$2y$12$KepaOcN5IW2ZVP5h0Ogx2.UFqgXG/atWhrr2JGypZrjnfaqhl/OuC',132,'2015-10-09','+19549625101','2025-12-24 02:32:08',NULL,'employer',NULL,NULL,'3526 Elenora Dale Suite 334\nHeidenreichside, WA 40349-8145','Latin Grammar, \'A mouse--of a mouse--to a mouse--a mouse--O mouse!\') The Mouse gave a little of her sharp little chin into Alice\'s head. \'Is that all?\' said Alice, rather doubtfully, as she stood.',1,0,2738,1,NULL,'2025-09-06 03:21:36','2025-12-23 19:32:08',1,1,1,1,NULL),(93,NULL,'Jerrell','Doyle','My notion was that.',NULL,'pollich.clarabelle@hotmail.com','$2y$12$.Ha//tR2oqOfE6uumabQt.ZFzxP1UBdb3T56yBXLV/HR/SFu9A1nO',130,'1983-03-05','+13239692225','2025-12-24 02:32:08',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','336 Kertzmann Track\nOrinshire, NV 75755-4309','White Rabbit, who was reading the list of the hall: in fact she was nine feet high, and was surprised to see that she had forgotten the words.\' So they had a door leading right into a line along the.',1,0,1679,0,NULL,'2025-10-31 01:29:44','2025-12-23 19:32:08',1,0,1,0,NULL),(94,NULL,'Flavio','Berge','THIS size: why, I.',NULL,'kaitlin11@dach.org','$2y$12$wE6AZxrfeT2DZB7b2Ive0eLFXQg7Am53N2NNy6sLGADG9/YMjtTwO',128,'1973-01-31','+18169209303','2025-12-24 02:32:09',NULL,'employer',NULL,NULL,'946 Krystina Shores Apt. 952\nWeberbury, MN 34395','Alice. \'Reeling and Writhing, of course, I meant,\' the King said to one of the house, and the two sides of the well, and noticed that one of them say, \'Look out now, Five! Don\'t go splashing paint.',1,0,321,0,NULL,'2025-08-09 05:41:08','2025-12-23 19:32:09',0,1,1,0,NULL),(95,NULL,'Juvenal','Terry','HE was.\' \'I never.',NULL,'kevon.ruecker@hotmail.com','$2y$12$G9w4jFzQGXTgIohYib7/ZOz0RW992DCEFil3MTXC83neRdZHtnODa',131,'2011-09-17','+12197791428','2025-12-24 02:32:09',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','65923 Verna Inlet\nLake Jamarcusberg, VT 59495-1233','Majesty!\' the Duchess was sitting on a summer day: The Knave of Hearts, and I don\'t care which happens!\' She ate a little scream of laughter. \'Oh, hush!\' the Rabbit noticed Alice, as she could.',1,0,2855,1,NULL,'2025-10-20 13:53:20','2025-12-23 19:32:09',1,1,0,1,NULL),(96,NULL,'Nya','Hauck','I hadn\'t mentioned.',NULL,'dee.beer@hotmail.com','$2y$12$EvoRu.CjEp7o/7Spuyw6C.opYS3wOeD7vp6pLpWVEa1xuXitkwzyy',129,'1974-01-13','+17818418013','2025-12-24 02:32:09',NULL,'job-seeker',NULL,'themes/jobzilla/resume/01.pdf','5505 Beier Mountains Suite 984\nLake Estefaniamouth, CT 09080-8636','King; and as the soldiers had to fall upon Alice, as she spoke--fancy CURTSEYING as you\'re falling through the air! Do you think you might knock, and I don\'t remember where.\' \'Well, it must be the.',1,0,2346,0,NULL,'2025-06-27 01:53:41','2025-12-23 19:32:09',0,1,0,0,NULL),(97,NULL,'Eulah','Dooley','The Queen turned.',NULL,'fwyman@rogahn.com','$2y$12$xi0fnbKGUeAJ.K2KQ9yArOJ/QPluEcoAONTt9Z3FEtsKrnYdIYUWG',130,'1980-04-16','+15853636943','2025-12-24 02:32:09',NULL,'employer',NULL,NULL,'283 Bart Rue\nLehnerbury, KY 94239-8335','March Hare went \'Sh! sh!\' and the others looked round also, and all the jelly-fish out of the evening, beautiful Soup! Soup of the cakes, and was suppressed. \'Come, that finished the guinea-pigs!\'.',1,0,1585,1,NULL,'2025-05-02 14:59:04','2025-12-23 19:32:09',1,0,0,0,NULL),(98,NULL,'Avis','Armstrong','Footman remarked.',NULL,'mconnelly@yahoo.com','$2y$12$GhTJEEh1v3zB7Io3DJ2B6Ob61mHP6wAko6.kTBV5eDJk6mDa07y1W',132,'1979-05-27','+14425080385','2025-12-24 02:32:09',NULL,'employer',NULL,NULL,'7872 Dooley Springs Suite 884\nWest Sheldonmouth, MD 93489-9674','When the pie was all finished, the Owl, as a lark, And will talk in contemptuous tones of the shelves as she stood looking at it uneasily, shaking it every now and then; such as, that a red-hot.',1,0,1002,0,NULL,'2025-07-21 09:00:19','2025-12-23 19:32:09',1,1,0,1,NULL),(99,NULL,'Skylar','Kunze','Gryphon. \'Do you.',NULL,'hahn.dalton@olson.info','$2y$12$l0roaCs5zYo0TqGoJsNubuOs46h0FexiErpJr8eZUa.9IY5YhzkXq',132,'2023-11-12','+18185284810','2025-12-24 02:32:10',NULL,'employer',NULL,NULL,'340 Heather Ridge Suite 311\nBashirianmouth, OR 44382-2378','WAS no one could possibly hear you.\' And certainly there was no \'One, two, three, and away,\' but they began moving about again, and put back into the teapot. \'At any rate it would be so easily.',1,0,3205,1,NULL,'2025-04-20 04:06:13','2025-12-23 19:32:10',1,1,0,0,NULL),(100,NULL,'Tabitha','Simonis','I don\'t take this.',NULL,'dubuque.jerrold@gmail.com','$2y$12$Z4cQ2MiJAy3bhZSM.8qdn.m9RSxyDBzyPT0pb/1KJ6ObolqG0gcmu',128,'1987-03-18','+15748723459','2025-12-24 02:32:10',NULL,'employer',NULL,NULL,'3028 Harber Light\nWest Elissa, FL 33080','Alice said with some severity; \'it\'s very interesting. I never heard of one,\' said Alice, \'but I must be collected at once in a tone of great curiosity. \'It\'s a pun!\' the King said to itself \'Then.',1,0,3737,1,NULL,'2025-10-31 21:08:36','2025-12-23 19:32:10',0,1,0,0,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_applications`
--

LOCK TABLES `jb_applications` WRITE;
/*!40000 ALTER TABLE `jb_applications` DISABLE KEYS */;
INSERT INTO `jb_applications` VALUES (1,'Merle','Bayer','+13363377050','jude95@yahoo.com','CHAPTER X. The Lobster Quadrille is!\' \'No, indeed,\' said Alice. The poor little thing sobbed again (or grunted, it was only too glad to get into the court, she said to herself; \'the March Hare was.',14,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',33,0,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(2,'Enrique','Dietrich','+19526911434','drath@hotmail.com','Alice thought the whole thing, and she tried her best to climb up one of the party went back for a rabbit! I suppose I ought to be treated with respect. \'Cheshire Puss,\' she began, in a low curtain.',32,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',41,0,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(3,'Juvenal','Terry','+12197791428','kevon.ruecker@hotmail.com','I never knew so much surprised, that for two reasons. First, because I\'m on the stairs. Alice knew it was indeed: she was talking. \'How CAN I have none, Why, I wouldn\'t say anything about it, you.',18,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',95,1,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(4,'Jerrell','Doyle','+13239692225','pollich.clarabelle@hotmail.com','Majesty must cross-examine the next witness. It quite makes my forehead ache!\' Alice watched the Queen to play croquet.\' Then they both sat silent and looked at Alice, and sighing. \'It IS the fun?\'.',20,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',93,1,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(5,'Nya','Hauck','+17818418013','dee.beer@hotmail.com','THAT\'S a good deal until she had sat down with one eye; \'I seem to dry me at all.\' \'In that case,\' said the Hatter. \'You might just as she leant against a buttercup to rest herself, and once she.',43,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',96,0,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(6,'Euna','Reilly','+19207438388','curtis.fisher@pollich.com','When she got back to my right size: the next witness.\' And he added looking angrily at the window.\' \'THAT you won\'t\' thought Alice, \'they\'re sure to kill it in time,\' said the Queen, \'and take this.',40,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',86,0,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(7,'Damaris','Stehr','+17404319677','casimir.beahan@windler.com','It was high time you were INSIDE, you might do something better with the distant green leaves. As there seemed to Alice as he spoke. \'UNimportant, of course, I meant,\' the King eagerly, and he.',30,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',77,0,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(8,'Jerad','Bogan','+13104950849','bogisich.mandy@rutherford.com','And he got up this morning? I almost wish I hadn\'t gone down that rabbit-hole--and yet--and yet--it\'s rather curious, you know, and he says it\'s so useful, it\'s worth a hundred pounds! He says it.',13,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',10,1,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(9,'Nadia','Feest','+12838241078','cratke@gmail.com','Cat, \'if you only kept on good terms with him, he\'d do almost anything you liked with the edge with each hand. \'And now which is which?\' she said to herself. \'I dare say you\'re wondering why I don\'t.',9,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',31,1,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(10,'Ned','Wolf','+13097443607','kassulke.aurelia@ankunding.com','Mock Turtle, and said anxiously to herself, being rather proud of it: \'No room! No room!\' they cried out when they hit her; and the Dormouse denied nothing, being fast asleep. \'After that,\'.',35,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',49,0,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(11,'Gladyce','Will','+13173530718','moses18@gmail.com','Table doesn\'t signify: let\'s try Geography. London is the driest thing I know. Silence all round, if you hold it too long; and that you never tasted an egg!\' \'I HAVE tasted eggs, certainly,\' said.',6,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',44,1,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(12,'Maurice','Sipes','+12816478568','janessa03@hotmail.com','At this moment the King, and the March Hare said--\' \'I didn\'t!\' the March Hare had just begun \'Well, of all this time. \'I want a clean cup,\' interrupted the Gryphon. \'I\'ve forgotten the little dears.',25,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',46,0,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(13,'Elza','Schinner','+17738626479','gmcdermott@cummings.biz','Alice in a court of justice before, but she got to the door, and tried to get her head through the doorway; \'and even if I would talk on such a capital one for catching mice--oh, I beg your.',50,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',81,1,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(14,'Howard','Windler','+15615284852','karlee39@gmail.com','I\'ve kept her waiting!\' Alice felt that she might as well as she ran; but the three gardeners who were giving it something out of the month, and doesn\'t tell what o\'clock it is!\' As she said this.',29,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',72,1,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(15,'Marion','Brakus','+17864333936','verlie.kautzer@harris.org','ME,\' said Alice as she could. \'The game\'s going on between the executioner, the King, and the Hatter continued, \'in this way:-- \"Up above the world you fly, Like a tea-tray in the schoolroom, and.',1,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',37,0,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(16,'Arianna','O\'Conner','+17194223594','crooks.ally@gmail.com','Dormouse: \'not in that poky little house, and the whole pack of cards, after all. I needn\'t be afraid of interrupting him,) \'I\'ll give him sixpence. _I_ don\'t believe it,\' said Alice, in a minute or.',44,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',57,1,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(17,'Kenyatta','Upton','+12183431764','nicolas.roderick@moore.com','For he can EVEN finish, if he wasn\'t going to do it?\' \'In my youth,\' Father William replied to his son, \'I feared it might injure the brain; But, now that I\'m doubtful about the games now.\' CHAPTER.',23,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',18,0,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(18,'Penelope','Corwin','+17855039944','wisoky.ezekiel@graham.info','I wonder what I should frighten them out with his nose Trims his belt and his buttons, and turns out his toes.\' [later editions continued as follows The Panther took pie-crust, and gravy, and meat.',22,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',50,0,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(19,'Citlalli','Zboncak','+17064307295','esperanza.gislason@wolff.biz','Mock Turtle at last, more calmly, though still sobbing a little bottle that stood near the looking-glass. There was no label this time with one finger, as he spoke, \'we were trying--\' \'I see!\' said.',11,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',90,1,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11'),(20,'Earnestine','Schulist','+13367562093','job_seeker@botble.com','But the insolence of his head. But at any rate he might answer questions.--How am I to get to,\' said the Caterpillar. \'Not QUITE right, I\'m afraid,\' said Alice, who had not gone much farther before.',5,'themes/jobzilla/resume/01.pdf','themes/jobzilla/resume/01.pdf',2,0,'checked','2025-12-23 19:32:11','2025-12-23 19:32:11');
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
INSERT INTO `jb_career_levels` VALUES (1,'Department Head',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(2,'Entry Level',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(3,'Experienced Professional',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(4,'GM / CEO / Country Head / President',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(5,'Intern/Student',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jb_categories`
--

LOCK TABLES `jb_categories` WRITE;
/*!40000 ALTER TABLE `jb_categories` DISABLE KEYS */;
INSERT INTO `jb_categories` VALUES (1,'Business Development',NULL,1,0,1,'published','2025-12-23 19:31:42','2025-12-23 19:31:42',0),(2,'Project Management',NULL,2,0,1,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(3,'Content Writer',NULL,3,0,1,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(4,'Customer Services',NULL,4,0,1,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(5,'Accounting / Finance',NULL,5,0,1,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(6,'Marketing',NULL,6,0,1,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(7,'Design &amp; Art',NULL,7,0,1,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(8,'Web Development',NULL,8,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(9,'Human Resource',NULL,9,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(10,'Health and Care',NULL,10,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(11,'Automotive Jobs',NULL,11,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(12,'Teaching / Education',NULL,12,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(13,'Banking',NULL,13,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(14,'Sales Marketing',NULL,14,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(15,'Restaurant / Food',NULL,15,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(16,'Telecommunications',NULL,16,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(17,'Fitness Trainer',NULL,17,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(18,'Photography',NULL,18,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(19,'Audio + Music',NULL,19,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(20,'Real estate',NULL,20,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0),(21,'Construction',NULL,21,0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43',0);
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
INSERT INTO `jb_companies` VALUES (1,NULL,'Pinterest',NULL,'Dolores eaque modi libero maiores hic et. Repudiandae quia maxime sunt ex dolorum ut qui est. Earum repudiandae perferendis ipsum dolor explicabo accusantium.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.pinterest.com','themes/jobzilla/companies/1.png','42.960482','-75.417825','279 Pierce Point Apt. 455\nEast Domenica, IL 57299',NULL,NULL,NULL,NULL,'+17043557649',1974,NULL,4,'3','3M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-09-17 19:31:44',1,'Premium partner - verified','published',0,'2025-05-18 19:46:34','2025-12-23 19:31:44',NULL),(2,NULL,'Linkedin',NULL,'Voluptatem architecto voluptates modi doloribus doloremque earum ipsa officia. Rerum aut nostrum sint omnis eaque est. Esse voluptatibus nulla iusto dolores eum pariatur voluptate.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.linkedin.com','themes/jobzilla/companies/2.png','43.288797','-75.567494','30951 Daphne Course\nDaughertyburgh, NH 87300',NULL,NULL,NULL,NULL,'+17402162728',1991,'Jeff Weiner',9,'6','1M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-04-01 19:31:44',1,'Documents verified successfully','published',0,'2025-03-10 18:29:55','2025-12-23 19:31:44',NULL),(3,NULL,'Line',NULL,'Deleniti veritatis ab fugiat esse rerum et rerum. Nihil eligendi deserunt ab omnis asperiores repudiandae commodi dolore. Rerum nisi esse asperiores a minima.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://line.me','themes/jobzilla/companies/3.png','42.92764','-76.507979','7202 Goodwin Flat\nGibsonhaven, WY 38862-5753',NULL,NULL,NULL,NULL,'+16789161874',1997,'Nakamura',4,'3','6M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-04-03 04:48:53','2025-12-23 19:31:44',NULL),(4,NULL,'Uber',NULL,'Eligendi aperiam ab soluta odio iusto. Vel enim assumenda quo eum. Excepturi eos est error ut corrupti commodi laudantium.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.uber.com','themes/jobzilla/companies/4.png','43.325323','-76.382381','428 Ferry Harbors\nSouth Kiarra, ME 33744',NULL,NULL,NULL,NULL,'+12232691188',2004,'John Doe',10,'1','5M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-08-30 19:31:44',1,'Verified after background check','published',0,'2025-07-26 09:12:01','2025-12-23 19:31:44',NULL),(5,NULL,'Flutter',NULL,'Dolores cum placeat non aut qui. Laudantium voluptas ipsam odio quibusdam quaerat delectus sit. Corporis culpa voluptates ut officiis explicabo rerum non.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://flutter.io','themes/jobzilla/companies/5.png','42.537274','-75.992198','4894 Okuneva Dale\nDoylebury, OH 93000-7256',NULL,NULL,NULL,NULL,'+13307958104',1979,'John Doe',6,'7','1M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-01-18 08:00:00','2025-12-23 19:31:44',NULL),(6,NULL,'Behance',NULL,'Maxime ab quis sunt ut labore ratione. Rem aut molestiae et doloribus omnis ratione. Nulla tempore aut voluptatum tenetur magni aut voluptas aut.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.behance.net','themes/jobzilla/companies/6.png','43.369437','-74.92662','3666 Carmine Square Apt. 415\nClintonfort, SC 88856',NULL,NULL,NULL,NULL,'+19514954307',1980,'John Doe',3,'2','8M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-06-13 01:23:57','2025-12-23 19:31:44',NULL),(7,NULL,'Apple',NULL,'Ut quae voluptatem ut voluptatem ipsam fugiat tenetur. Aliquam ratione adipisci excepturi quaerat sint.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.apple.com','themes/jobzilla/companies/7.png','42.522659','-75.217589','26409 Watson Streets Apt. 411\nHammesport, MS 62978-1745',NULL,NULL,NULL,NULL,'+15735790438',2018,'Steve Jobs',7,'4','8M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-05-20 19:31:44',1,NULL,'published',0,'2025-02-24 16:31:20','2025-12-23 19:31:44',NULL),(8,NULL,'Adobe',NULL,'Harum ipsum eius eius aut. Nobis aut necessitatibus corporis ad deserunt voluptatem. Illum pariatur qui iure sed nihil.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.adobe.com','themes/jobzilla/companies/8.png','42.633571','-75.396165','907 Zemlak Centers Apt. 375\nSouth Loyalmouth, MA 68211-2120',NULL,NULL,NULL,NULL,'+18014394682',1989,'John Doe',8,'3','1M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-02-01 19:31:44',1,NULL,'published',0,'2025-03-08 14:09:53','2025-12-23 19:31:44',NULL),(9,NULL,'Vibe',NULL,'Minus tempore laborum incidunt sed ducimus aperiam ad. Eveniet facilis asperiores officiis quia. Aut quos ut voluptates commodi hic. Sed at non quam hic enim.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://www.vibe.com','themes/jobzilla/companies/9.png','42.734877','-75.158087','262 Shirley Bridge\nEast Nikkishire, KY 03597-3663',NULL,NULL,NULL,NULL,'+15868180236',2001,'John Doe',7,'5','5M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-08-11 18:30:17','2025-12-23 19:31:44',NULL),(10,NULL,'VKontakte',NULL,'Vel laboriosam autem itaque et vel. Ad id molestias dolores laudantium. Ea vitae molestias rerum sit optio at.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://vk.com','themes/jobzilla/companies/10.png','43.697171','-75.54763','2365 Ankunding Ports\nBartolettiport, ID 25133-3620',NULL,NULL,NULL,NULL,'+18788781096',1984,'Vasya Pupkin',1,'10','10M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-06-04 10:30:25','2025-12-23 19:31:44',NULL),(11,NULL,'WordPress',NULL,'Est libero quia labore et voluptatem vel voluptatem nam. Quia consequuntur cupiditate soluta voluptatum. Beatae molestiae ut voluptatum.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://wordpress.org','themes/jobzilla/companies/11.png','42.905949','-76.149723','4603 Greenholt Plain Suite 607\nGarfieldstad, MN 12901',NULL,NULL,NULL,NULL,'+17264890276',1985,'Matt Mullenweg',7,'5','2M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-07-24 19:31:44',1,'Documents verified successfully','published',0,'2025-10-27 06:16:28','2025-12-23 19:31:44',NULL),(12,NULL,'Envato',NULL,'Eos necessitatibus aut porro odio eum quia omnis. Velit optio esse eum amet voluptas et voluptatem. Vero sunt et id tenetur dolorem.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://envato.com','themes/jobzilla/companies/12.png','43.103704','-75.862893','9088 Brayan Divide Apt. 267\nMichaelberg, DC 27861-5136',NULL,NULL,NULL,NULL,'+19565024488',1971,NULL,1,'8','8M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-06-25 19:31:44',1,'Company credentials confirmed','published',0,'2025-08-12 22:37:21','2025-12-23 19:31:44',NULL),(13,NULL,'Magento',NULL,'Excepturi est explicabo sed accusantium provident. Esse est in porro tempora maiores.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://magento.com','themes/jobzilla/companies/13.png','43.526494','-76.675032','96314 Schroeder Isle Suite 695\nNew Jeffereychester, ME 50170-8324',NULL,NULL,NULL,NULL,'+17698792686',1979,NULL,8,'1','5M',NULL,NULL,NULL,NULL,NULL,1,1,'2024-12-27 19:31:44',1,'Verified after background check','published',0,'2025-04-30 03:44:05','2025-12-23 19:31:44',NULL),(14,NULL,'Generic',NULL,'Excepturi accusantium iste eaque fuga beatae sed tempora. Non est reiciendis rerum consequatur et. Inventore molestias dolor aut eum rerum vel.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://generic.com','themes/jobzilla/companies/14.png','43.294371','-76.171818','364 Jeff Throughway\nWest Candice, MN 75470',NULL,NULL,NULL,NULL,'+12295769924',1984,NULL,10,'7','9M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-05-02 06:10:23','2025-12-23 19:31:44',NULL),(15,NULL,'Reveal',NULL,'Atque ut occaecati consequatur incidunt non at iure. Veritatis veniam et sint voluptatibus pariatur dolorem. Itaque qui ex ullam omnis aliquid et dolor.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://reveal.com','themes/jobzilla/companies/15.png','43.538479','-75.11848','779 Heaney Ferry\nSouth Maramouth, NY 95929',NULL,NULL,NULL,NULL,'+17542745626',1987,NULL,7,'8','1M',NULL,NULL,NULL,NULL,NULL,1,0,NULL,NULL,NULL,'published',0,'2025-06-07 06:17:29','2025-12-23 19:31:44',NULL),(16,NULL,'Woocommerce',NULL,'Voluptate necessitatibus illum aut ut. Id aut earum consequuntur qui. Inventore excepturi esse voluptas fuga qui non. Et quae numquam ipsa est.','<p class=\"text-muted\"> Objectively pursue diverse catalysts for change for interoperable meta-services. Distinctively re-engineer\n                revolutionary meta-services and premium architectures. Intrinsically incubate intuitive opportunities and\n                real-time potentialities. Appropriately communicate one-to-one technology.</p>\n\n            <p class=\"text-muted\">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate\n                one-to-one technology.</p>\n\n            <p class=\"text-muted\"> Exercitation photo booth stumptown tote bag Banksy, elit small batch freegan sed. Craft beer elit\n                seitan exercitation, photo booth et 8-bit kale chips proident chillwave deep v laborum. Aliquip veniam delectus, Marfa\n                eiusmod Pinterest in do umami readymade swag.</p>','https://woocommerce.com','themes/jobzilla/companies/16.png','43.279851','-76.447782','90174 Schaden Islands Apt. 825\nFarrellhaven, MA 77833-5438',NULL,NULL,NULL,NULL,'+14846577411',1982,NULL,2,'6','2M',NULL,NULL,NULL,NULL,NULL,1,1,'2025-04-29 19:31:44',1,'Verified after background check','published',0,'2025-05-21 19:44:23','2025-12-23 19:31:44',NULL);
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
INSERT INTO `jb_currencies` VALUES (1,'USD','$',1,0,0,1,1,'western',0,'2025-12-23 19:31:45','2025-12-23 19:31:45'),(2,'EUR','€',0,0,1,0,0.84,'western',0,'2025-12-23 19:31:45','2025-12-23 19:31:45'),(3,'VND','₫',0,0,1,0,23203,'western',0,'2025-12-23 19:31:45','2025-12-23 19:31:45');
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
INSERT INTO `jb_degree_levels` VALUES (1,'Non-Matriculation',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(2,'Matriculation/O-Level',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(3,'Intermediate/A-Level',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(4,'Bachelors',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(5,'Masters',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(6,'MPhil/MS',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(7,'PHD/Doctorate',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(8,'Certification',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(9,'Diploma',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(10,'Short Course',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42');
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
INSERT INTO `jb_degree_types` VALUES (1,'Matric in Arts',2,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(2,'Matric in Science',2,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(3,'O-Levels',2,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(4,'A-Levels',3,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(5,'Faculty of Arts',3,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(6,'Faculty of Science (Pre-medical)',3,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(7,'Faculty of Science (Pre-Engineering)',3,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(8,'Intermediate in Computer Science',3,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(9,'Intermediate in Commerce',3,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(10,'Intermediate in General Science',3,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(11,'Bachelors in Arts',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(12,'Bachelors in Architecture',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(13,'Bachelors in Business Administration',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(14,'Bachelors in Commerce',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(15,'Bachelors of Dental Surgery',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(16,'Bachelors of Education',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(17,'Bachelors in Engineering',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(18,'Bachelors in Pharmacy',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(19,'Bachelors in Science',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(20,'Bachelors of Science in Nursing (Registered Nursing)',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(21,'Bachelors in Law',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(22,'Bachelors in Technology',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(23,'BCS\\/BS',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(24,'Doctor of Veterinary Medicine',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(25,'MBBS',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(26,'Post Registered Nursing B.S.',4,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(27,'Masters in Arts',5,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(28,'Masters in Business Administration',5,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(29,'Masters in Commerce',5,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(30,'Masters of Education',5,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(31,'Masters in Law',5,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(32,'Masters in Science',5,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(33,'Executive Masters in Business Administration',5,0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42');
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
INSERT INTO `jb_functional_areas` VALUES (1,'Accountant',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(2,'Accounts, Finance &amp; Financial Services',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(3,'Admin',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(4,'Admin Operation',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(5,'Administration',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(6,'Administration Clerical',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(7,'Advertising',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(8,'Advertising',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(9,'Advertisement',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(10,'Architects &amp; Construction',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(11,'Architecture',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(12,'Bank Operation',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(13,'Business Development',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(14,'Business Management',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(15,'Business Systems Analyst',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(16,'Clerical',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(17,'Client Services &amp; Customer Support',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(18,'Computer Hardware',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(19,'Computer Networking',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(20,'Consultant',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(21,'Content Writer',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(22,'Corporate Affairs',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(23,'Creative Design',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(24,'Creative Writer',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(25,'Customer Support',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(26,'Data Entry',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(27,'Data Entry Operator',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(28,'Database Administration (DBA)',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(29,'Development',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(30,'Distribution &amp; Logistics',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(31,'Education &amp; Training',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(32,'Electronics Technician',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(33,'Engineering',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(34,'Engineering Construction',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(35,'Executive Management',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(36,'Executive Secretary',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(37,'Field Operations',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(38,'Front Desk Clerk',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(39,'Front Desk Officer',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(40,'Graphic Design',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(41,'Hardware',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(42,'Health &amp; Medicine',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(43,'Health &amp; Safety',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(44,'Health Care',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(45,'Health Related',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(46,'Hotel Management',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(47,'Hotel\\/Restaurant Management',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(48,'HR',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(49,'Human Resources',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(50,'Import &amp; Export',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(51,'Industrial Production',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(52,'Installation &amp; Repair',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(53,'Interior Designers &amp; Architects',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(54,'Intern',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(55,'Internship',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(56,'Investment Operations',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(57,'IT Security',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(58,'IT Systems Analyst',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(59,'Legal &amp; Corporate Affairs',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(60,'Legal Affairs',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(61,'Legal Research',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(62,'Logistics &amp; Warehousing',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(63,'Maintenance\\/Repair',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(64,'Management Consulting',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(65,'Management Information System (MIS)',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(66,'Managerial',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(67,'Manufacturing',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(68,'Manufacturing &amp; Operations',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(69,'Marketing',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(70,'Marketing',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(71,'Media - Print &amp; Electronic',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(72,'Media &amp; Advertising',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(73,'Medical',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(74,'Medicine',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(75,'Merchandising',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(76,'Merchandising &amp; Product Management',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(77,'Monitoring &amp; Evaluation (M&amp;E)',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(78,'Network Administration',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(79,'Network Operation',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(80,'Online Advertising',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(81,'Online Marketing',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(82,'Operations',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(83,'Planning',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(84,'Planning &amp; Development',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(85,'PR',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(86,'Print Media',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(87,'Printing',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(88,'Procurement',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(89,'Product Developer',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(90,'Product Development',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(91,'Product Development',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(92,'Product Management',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(93,'Production',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(94,'Production &amp; Quality Control',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(95,'Project Management',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(96,'Project Management Consultant',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(97,'Public Relations',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(98,'QA',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(99,'QC',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(100,'Qualitative Research',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(101,'Quality Assurance (QA)',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(102,'Quality Control',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(103,'Quality Inspection',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(104,'Recruiting',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(105,'Recruitment',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(106,'Repair &amp; Overhaul',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(107,'Research &amp; Development (R&amp;D)',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(108,'Research &amp; Evaluation',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(109,'Research &amp; Fellowships',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(110,'Researcher',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(111,'Restaurant Management',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(112,'Retail',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(113,'Retail &amp; Wholesale',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(114,'Retail Buyer',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(115,'Retail Buying',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(116,'Retail Merchandising',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(117,'Safety &amp; Environment',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(118,'Sales',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(119,'Sales &amp; Business Development',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(120,'Sales Support',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(121,'Search Engine Optimization (SEO)',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(122,'Secretarial, Clerical &amp; Front Office',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(123,'Security',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(124,'Security &amp; Environment',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(125,'Security Guard',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(126,'SEM',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(127,'SMO',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(128,'Software &amp; Web Development',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(129,'Software Engineer',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(130,'Software Testing',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(131,'Stores &amp; Warehousing',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(132,'Supply Chain',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(133,'Supply Chain Management',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(134,'Systems Analyst',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(135,'Teachers\\/Education, Training &amp; Development',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(136,'Technical Writer',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(137,'Tele Sale Representative',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(138,'Telemarketing',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(139,'Training &amp; Development',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(140,'Transportation &amp; Warehousing',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(141,'TSR',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(142,'Typing',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(143,'Warehousing',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(144,'Web Developer',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(145,'Web Marketing',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(146,'Writer',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(147,'PR',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(148,'QA',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(149,'QC',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(150,'SEM',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(151,'SMO',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(152,'TSR',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(153,'HR',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(154,'QA',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(155,'QC',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42'),(156,'SEM',0,0,'published','2025-12-23 19:31:42','2025-12-23 19:31:42');
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
INSERT INTO `jb_job_experiences` VALUES (1,'Fresh',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(2,'Less Than 1 Year',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(3,'1 Year',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(4,'2 Year',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(5,'3 Year',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(6,'4 Year',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(7,'5 Year',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(8,'6 Year',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(9,'7 Year',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(10,'8 Year',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(11,'9 Year',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(12,'10 Year',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43');
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
INSERT INTO `jb_job_shifts` VALUES (1,'First Shift (Day)',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(2,'Second Shift (Afternoon)',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(3,'Third Shift (Night)',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(4,'Rotating',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43');
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
INSERT INTO `jb_job_skills` VALUES (1,'Javascript',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(2,'PHP',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(3,'Python',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(4,'Laravel',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(5,'CakePHP',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(6,'Wordpress',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43');
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
INSERT INTO `jb_job_types` VALUES (1,'Contract',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(2,'Freelance',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(3,'Full Time',0,1,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(4,'Internship',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43'),(5,'Part Time',0,0,'published','2025-12-23 19:31:43','2025-12-23 19:31:43');
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
INSERT INTO `jb_jobs` VALUES (1,NULL,'UI / UX Designer full-time','Omnis provident sint vel consequatur. Sunt qui saepe omnis rerum est doloribus.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,5,NULL,NULL,NULL,NULL,1,2,1100.00,2200.00,'hourly','fixed',0,8,1,4,5,0,8,'2026-11-18',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.537274','-75.992198',0,0,0,0,'published','approved','2025-12-05 18:10:17','2025-12-23 19:31:45',NULL,NULL,'2026-12-19',NULL),(2,NULL,'Full Stack Engineer','Voluptatum placeat voluptatem provident sint consequatur. Sed excepturi omnis quos voluptatum.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','https://google.com',NULL,6,NULL,NULL,NULL,NULL,1,5,600.00,1200.00,'yearly','fixed',1,3,4,1,147,0,3,'2026-11-14',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.369437','-74.92662',0,0,1,1,'published','approved','2025-11-29 02:47:44','2025-12-23 19:31:45',NULL,NULL,'2026-11-07',NULL),(3,NULL,'Java Software Engineer','Nobis delectus aut et ipsum praesentium voluptas. Et odit sed nihil ipsam. Dolor enim adipisci provident.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,12,NULL,NULL,NULL,NULL,0,1,600.00,1500.00,'yearly','fixed',1,5,4,2,146,0,2,'2026-08-22',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.103704','-75.862893',0,0,0,1,'published','approved','2025-11-22 20:32:28','2025-12-23 19:31:45',NULL,NULL,'2026-06-15',NULL),(4,NULL,'Digital Marketing Manager','Minima reprehenderit eum voluptatem corrupti atque. Omnis aperiam dolor suscipit repellat. Dicta velit dignissimos quia aut ex voluptatum. Similique et delectus et.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,16,NULL,NULL,NULL,NULL,1,1,1000.00,1700.00,'hourly','fixed',1,1,3,2,110,0,4,'2026-12-05',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.279851','-76.447782',0,0,0,1,'published','approved','2025-11-02 14:37:38','2025-12-23 19:31:45',NULL,NULL,'2026-09-30',NULL),(5,NULL,'Frontend Developer','Harum quia a fuga et qui. Quia corporis magni quo deleniti. Fugit itaque velit quam tempora. Totam nisi sed repellat repellendus voluptatibus qui.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,1,NULL,NULL,NULL,NULL,0,4,1300.00,2200.00,'hourly','fixed',1,3,4,5,74,0,8,'2026-12-11',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.960482','-75.417825',0,0,0,0,'published','approved','2025-11-03 17:33:02','2025-12-23 19:31:45',NULL,NULL,'2026-07-31',NULL),(6,NULL,'React Native Web Developer','Eius cumque aperiam a molestiae delectus nam. Quas omnis dolores quia eum vitae doloribus nihil.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,15,NULL,NULL,NULL,NULL,0,1,1200.00,2100.00,'weekly','fixed',1,2,1,2,4,0,9,'2026-10-04',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.538479','-75.11848',0,0,1,1,'published','approved','2025-11-14 22:21:47','2025-12-23 19:31:45',NULL,NULL,'2026-08-12',NULL),(7,NULL,'Senior System Engineer','Ipsa reprehenderit rerum voluptate quis. Autem rerum dolorum aliquid quos dolores culpa exercitationem minima. Velit provident dolor sequi laudantium tempora perspiciatis.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,10,NULL,NULL,NULL,NULL,1,4,1000.00,1700.00,'monthly','fixed',0,1,1,2,84,0,3,'2026-10-24',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.697171','-75.54763',0,0,1,1,'published','approved','2025-10-31 00:23:36','2025-12-23 19:31:45',NULL,NULL,'2026-12-16',NULL),(8,NULL,'Products Manager','Ipsam iusto qui consequatur. Iusto qui reprehenderit rerum ipsum ut at. Quae ut aperiam ut veniam pariatur ut. Vel quos repellat esse dolorem ipsa in placeat omnis.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,4,NULL,NULL,NULL,NULL,0,3,1200.00,1700.00,'daily','fixed',1,5,4,3,16,0,7,'2026-10-27',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.325323','-76.382381',0,0,0,0,'published','approved','2025-10-30 12:09:28','2025-12-23 19:31:45',NULL,NULL,'2026-05-26',NULL),(9,NULL,'Lead Quality Control QA','Mollitia amet in expedita qui labore veniam dicta. In ipsa quia aut quia quidem rerum assumenda. Nam et debitis est laboriosam sit harum nemo et.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,10,NULL,NULL,NULL,NULL,1,3,900.00,1500.00,'yearly','fixed',1,2,2,5,137,0,3,'2026-09-17',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.697171','-75.54763',0,0,0,1,'published','approved','2025-12-06 03:51:02','2025-12-23 19:31:45',NULL,NULL,'2026-06-19',NULL),(10,NULL,'Principal Designer, Design Systems','Temporibus quidem dolores nihil numquam doloremque reprehenderit. Iusto aperiam beatae molestiae autem voluptate id. Occaecati blanditiis explicabo enim nostrum.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,11,NULL,NULL,NULL,NULL,0,3,900.00,1800.00,'hourly','fixed',0,2,1,3,134,0,8,'2026-09-26',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.905949','-76.149723',0,0,0,1,'published','approved','2025-11-10 10:12:07','2025-12-23 19:31:45',NULL,NULL,'2026-11-02',NULL),(11,NULL,'DevOps Architect','Quia odio assumenda qui ab quas similique. Assumenda sequi ratione unde laborum consequatur facilis non. Cupiditate quod facere doloribus omnis. Soluta perferendis ut nemo mollitia.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,11,NULL,NULL,NULL,NULL,0,5,1100.00,1800.00,'monthly','fixed',0,6,3,4,118,0,8,'2026-08-11',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.905949','-76.149723',0,0,0,0,'published','approved','2025-11-14 04:41:11','2025-12-23 19:31:45',NULL,NULL,'2026-06-02',NULL),(12,NULL,'Senior Software Engineer, npm CLI','Laborum harum est molestiae dolorum non sint laborum. Ipsa iure ipsum aliquam non esse. Repudiandae dolor molestiae minima.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,15,NULL,NULL,NULL,NULL,0,1,1000.00,2200.00,'monthly','fixed',0,9,1,1,89,0,4,'2026-09-27',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.538479','-75.11848',0,0,0,1,'published','approved','2025-12-21 07:19:12','2025-12-23 19:31:45',NULL,NULL,'2026-08-03',NULL),(13,NULL,'Senior Systems Engineer','Quia quia dignissimos mollitia qui animi. Molestiae aut aut in dolore magni suscipit facere. Ipsam qui tempore dolores quia nulla sunt a.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,6,NULL,NULL,NULL,NULL,0,4,1100.00,2400.00,'weekly','fixed',0,6,4,5,35,0,2,'2026-10-19',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.369437','-74.92662',0,0,0,0,'published','approved','2025-11-14 11:18:37','2025-12-23 19:31:45',NULL,NULL,'2026-05-27',NULL),(14,NULL,'Software Engineer Actions Platform','Sit et beatae eveniet aut autem quae. Vel sed a excepturi omnis voluptatem eius aut. Et ipsa ab impedit soluta velit doloribus eum.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,15,NULL,NULL,NULL,NULL,0,4,1100.00,2400.00,'weekly','fixed',0,2,3,3,12,0,9,'2026-10-09',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.538479','-75.11848',0,0,0,1,'published','approved','2025-11-11 10:40:48','2025-12-23 19:31:45',NULL,NULL,'2026-07-11',NULL),(15,NULL,'Staff Engineering Manager, Actions','Impedit qui ullam dolorem quos. Voluptas quia qui quidem in qui. Praesentium quidem numquam voluptas. Consectetur corrupti voluptatem et.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,14,NULL,NULL,NULL,NULL,1,3,1300.00,1900.00,'daily','fixed',1,9,3,1,8,0,9,'2026-10-08',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.294371','-76.171818',0,0,1,1,'published','approved','2025-11-19 12:02:19','2025-12-23 19:31:45',NULL,NULL,'2026-10-18',NULL),(16,NULL,'Staff Engineering Manager: Actions Runtime','Facere molestiae quas maxime. Cum voluptatum impedit soluta ut eveniet et quas. Animi ipsa provident consequatur ratione.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,1,NULL,NULL,NULL,NULL,0,2,500.00,1200.00,'weekly','fixed',1,7,4,5,52,0,9,'2026-12-13',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.960482','-75.417825',0,0,0,1,'published','approved','2025-11-11 16:15:21','2025-12-23 19:31:45',NULL,NULL,'2026-07-05',NULL),(17,NULL,'Staff Engineering Manager, Packages','Earum beatae adipisci qui hic. Possimus dolorem hic similique sit. Quia ab dolorem accusamus perferendis aliquid ut.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,6,NULL,NULL,NULL,NULL,1,1,700.00,1700.00,'yearly','fixed',1,7,1,4,9,0,7,'2026-10-22',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.369437','-74.92662',0,0,0,0,'published','approved','2025-11-15 06:52:04','2025-12-23 19:31:45',NULL,NULL,'2026-06-30',NULL),(18,NULL,'Staff Software Engineer','Ipsa corrupti saepe molestiae veritatis cumque aut. Natus mollitia nisi ducimus. Delectus est earum velit. A magni rerum et aut nisi dolorem porro.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,5,NULL,NULL,NULL,NULL,1,5,1200.00,2500.00,'daily','fixed',0,3,4,4,119,0,2,'2026-12-20',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.537274','-75.992198',0,0,0,0,'published','approved','2025-11-07 21:26:31','2025-12-23 19:31:45',NULL,NULL,'2026-08-22',NULL),(19,NULL,'Systems Software Engineer','Excepturi et impedit qui. Eligendi iusto numquam in ipsa dolorem odit. Earum delectus debitis accusamus sed eos et. Autem quas rerum et quaerat natus ut.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,3,NULL,NULL,NULL,NULL,0,1,1100.00,2100.00,'hourly','fixed',1,4,1,4,91,0,6,'2026-06-07',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.92764','-76.507979',0,0,1,0,'published','approved','2025-10-27 13:12:46','2025-12-23 19:31:45',NULL,NULL,'2026-11-05',NULL),(20,NULL,'Senior Compensation Analyst','Esse rerum optio nesciunt rerum qui. Ut perspiciatis quas aut nihil ipsam consequatur. Aut consectetur a tempora aliquam.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,9,NULL,NULL,NULL,NULL,0,1,800.00,2200.00,'yearly','fixed',1,4,2,2,57,0,6,'2026-05-25',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.734877','-75.158087',0,0,1,0,'published','approved','2025-12-14 21:36:08','2025-12-23 19:31:45',NULL,NULL,'2026-06-28',NULL),(21,NULL,'Senior Accessibility Program Manager','Voluptatem magnam occaecati qui cum. Vero architecto porro atque est placeat. Exercitationem officia repellat voluptatibus dolorem et quia.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,3,NULL,NULL,NULL,NULL,1,4,1300.00,2500.00,'yearly','fixed',0,5,1,3,21,0,9,'2026-08-14',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.92764','-76.507979',0,0,0,0,'published','approved','2025-11-18 02:36:37','2025-12-23 19:31:45',NULL,NULL,'2026-11-20',NULL),(22,NULL,'Analyst Relations Manager, Application Security','Eum rerum suscipit itaque aut voluptatum sed. Sed vel dolore nisi autem et est aliquid. Qui earum est et cupiditate.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,1,NULL,NULL,NULL,NULL,0,5,1200.00,1900.00,'daily','fixed',0,3,4,4,53,0,8,'2026-08-01',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.960482','-75.417825',0,0,0,0,'published','approved','2025-12-20 10:48:09','2025-12-23 19:31:45',NULL,NULL,'2026-10-24',NULL),(23,NULL,'Senior Enterprise Advocate, EMEA','Est voluptate magni inventore et. Doloribus nihil molestiae numquam aut sit. Omnis numquam ipsam sit voluptatum modi nihil vitae. Iste delectus dolor sed praesentium fugit incidunt.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,6,NULL,NULL,NULL,NULL,1,4,1100.00,1800.00,'yearly','fixed',0,9,2,1,74,0,6,'2026-09-26',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.369437','-74.92662',0,0,1,1,'published','approved','2025-12-22 08:39:01','2025-12-23 19:31:45',NULL,NULL,'2026-11-06',NULL),(24,NULL,'Deal Desk Manager','Non qui dolorum rerum mollitia. Doloremque aliquam officiis itaque molestias rerum et. Autem nesciunt dignissimos et repudiandae consequuntur perferendis.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,5,NULL,NULL,NULL,NULL,0,1,700.00,1300.00,'yearly','fixed',1,8,2,1,124,0,8,'2026-11-10',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.537274','-75.992198',0,0,1,1,'published','approved','2025-11-18 21:40:02','2025-12-23 19:31:45',NULL,NULL,'2026-06-19',NULL),(25,NULL,'Director, Revenue Compensation','Similique harum velit quidem necessitatibus id. Ab sit at asperiores quae. Id quibusdam aspernatur alias rerum. Neque sit ut facere recusandae ipsum. Quo dolor non veritatis quisquam similique.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,7,NULL,NULL,NULL,NULL,0,2,1100.00,2300.00,'weekly','fixed',1,2,2,3,40,0,8,'2026-09-09',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.522659','-75.217589',0,0,1,0,'published','approved','2025-11-02 05:23:54','2025-12-23 19:31:45',NULL,NULL,'2026-07-18',NULL),(26,NULL,'Program Manager','Iure molestiae iusto et esse aperiam optio. Autem sed totam perferendis molestiae non quidem pariatur iste. Laboriosam est qui molestiae doloribus.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,11,NULL,NULL,NULL,NULL,1,2,1200.00,2600.00,'weekly','fixed',1,6,4,1,20,0,2,'2026-08-07',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.905949','-76.149723',0,0,1,1,'published','approved','2025-11-26 14:24:59','2025-12-23 19:31:45',NULL,NULL,'2026-06-23',NULL),(27,NULL,'Sr. Manager, Deal Desk - INTL','Placeat aut dolores sed. Doloribus repellendus alias ad enim ducimus quas earum. Sit doloremque delectus voluptatem. Qui nobis sit quos possimus.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,10,NULL,NULL,NULL,NULL,1,4,1300.00,2800.00,'weekly','fixed',0,8,1,4,69,0,8,'2026-10-02',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.697171','-75.54763',0,0,0,1,'published','approved','2025-11-27 22:21:32','2025-12-23 19:31:45',NULL,NULL,'2026-10-10',NULL),(28,NULL,'Senior Director, Product Management, Actions Runners and Compute Services','Accusamus nihil eum incidunt explicabo dolor dolorem. Dolores voluptatem accusantium velit. Dolorem consectetur eaque suscipit dolorum quisquam.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,2,NULL,NULL,NULL,NULL,0,3,600.00,1700.00,'yearly','fixed',0,10,4,2,95,0,9,'2026-07-02',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.288797','-75.567494',0,0,1,1,'published','approved','2025-11-23 01:01:38','2025-12-23 19:31:45',NULL,NULL,'2026-08-22',NULL),(29,NULL,'Alliances Director','Eum repellat est ea facere. Explicabo provident tempora sed laudantium. Minima voluptatem voluptatem voluptatem quia ex nostrum ex repudiandae. Deserunt labore porro laborum tempora a nemo.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,5,NULL,NULL,NULL,NULL,1,2,600.00,1600.00,'hourly','fixed',1,4,2,5,111,0,8,'2026-12-21',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.537274','-75.992198',0,0,0,0,'published','approved','2025-12-05 19:33:05','2025-12-23 19:31:45',NULL,NULL,'2026-09-09',NULL),(30,NULL,'Corporate Sales Representative','Aut quis sint rem asperiores. Sint sunt at recusandae voluptate quis dicta. Laudantium minima minima excepturi fugit tenetur.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,13,NULL,NULL,NULL,NULL,1,4,900.00,2300.00,'hourly','fixed',0,6,1,1,115,0,6,'2026-11-01',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.526494','-76.675032',0,0,1,1,'published','approved','2025-11-14 05:02:01','2025-12-23 19:31:45',NULL,NULL,'2026-12-24',NULL),(31,NULL,'Country Leader','Sit explicabo magnam iure amet officia. Consectetur ut beatae at modi. Ut est voluptatem et ut. Omnis quaerat quaerat autem ut.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,1,NULL,NULL,NULL,NULL,1,1,1400.00,1900.00,'hourly','fixed',1,3,4,1,107,0,4,'2026-10-26',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.960482','-75.417825',0,0,1,0,'published','approved','2025-11-11 18:29:17','2025-12-23 19:31:45',NULL,NULL,'2026-12-11',NULL),(32,NULL,'Customer Success Architect','Et praesentium fuga ratione. Tenetur rerum quam voluptates rerum dolores quaerat. Dolor pariatur eveniet voluptatem est et. Asperiores deleniti enim dolor.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,11,NULL,NULL,NULL,NULL,0,5,900.00,2200.00,'yearly','fixed',0,2,1,3,126,0,2,'2026-05-31',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.905949','-76.149723',0,0,0,0,'published','approved','2025-11-07 09:29:07','2025-12-23 19:31:45',NULL,NULL,'2026-06-14',NULL),(33,NULL,'DevOps Account Executive - US Public Sector','Necessitatibus eligendi numquam aut rerum nobis. Vel voluptatem repellat pariatur qui laboriosam voluptatem veniam. Voluptatem et ad nam praesentium minima.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,10,NULL,NULL,NULL,NULL,0,5,800.00,1600.00,'monthly','fixed',0,5,4,3,1,0,10,'2026-07-23',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.697171','-75.54763',0,0,1,1,'published','approved','2025-11-30 20:22:36','2025-12-23 19:31:45',NULL,NULL,'2026-12-20',NULL),(34,NULL,'Enterprise Account Executive','Et et ut eligendi nostrum. Enim dolores qui ipsa ut omnis. Quis impedit voluptatem saepe officiis ut rerum est sunt. Sint ut rerum quo non ab nihil assumenda. Sed est recusandae maxime facere ad.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,8,NULL,NULL,NULL,NULL,0,5,1100.00,1800.00,'weekly','fixed',0,4,4,3,23,0,5,'2026-07-25',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.633571','-75.396165',0,0,1,0,'published','approved','2025-11-22 10:56:04','2025-12-23 19:31:45',NULL,NULL,'2026-09-18',NULL),(35,NULL,'Senior Engineering Manager, Product Security Engineering - Paved Paths','Et in tempora velit ratione sint. Accusamus nemo et veritatis velit. Sit aut error omnis et eaque. Quibusdam cumque vel maiores qui.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,5,NULL,NULL,NULL,NULL,1,5,900.00,1600.00,'monthly','fixed',0,1,1,1,129,0,4,'2026-08-23',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.537274','-75.992198',0,0,1,0,'published','approved','2025-11-29 17:47:28','2025-12-23 19:31:45',NULL,NULL,'2026-08-20',NULL),(36,NULL,'Customer Reliability Engineer III','Et aperiam aut dignissimos placeat minima illo. Explicabo eligendi est voluptas doloremque quidem cum. Qui error quasi dicta ea. Ullam quia ad cupiditate velit officia.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,13,NULL,NULL,NULL,NULL,0,2,1200.00,1900.00,'weekly','fixed',0,6,3,3,31,0,10,'2026-12-16',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.526494','-76.675032',0,0,1,0,'published','approved','2025-11-24 15:47:30','2025-12-23 19:31:45',NULL,NULL,'2026-10-26',NULL),(37,NULL,'Support Engineer (Enterprise Support Japanese)','Expedita ea consectetur aperiam qui deserunt. Cumque ut qui odio est. Exercitationem sequi fuga qui similique quis. Aliquam id dolores quaerat harum qui dicta.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,16,NULL,NULL,NULL,NULL,0,5,1200.00,1800.00,'hourly','fixed',1,5,3,4,74,0,10,'2026-09-22',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.279851','-76.447782',0,0,1,1,'published','approved','2025-11-28 21:40:36','2025-12-23 19:31:45',NULL,NULL,'2026-09-23',NULL),(38,NULL,'Technical Partner Manager','Dolorum nesciunt sit quasi qui magni. Consectetur qui nihil fugit numquam quidem vel. Qui voluptatem non voluptatum perferendis rerum quo voluptatem.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,12,NULL,NULL,NULL,NULL,1,2,1300.00,2300.00,'weekly','fixed',0,10,2,4,155,0,7,'2026-09-07',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.103704','-75.862893',0,0,1,1,'published','approved','2025-11-17 10:53:26','2025-12-23 19:31:45',NULL,NULL,'2026-08-26',NULL),(39,NULL,'Sr Manager, Inside Account Management','Modi tenetur tempora qui. Repudiandae voluptates blanditiis quasi earum omnis optio nesciunt. Est accusantium sit ut ut minima. Nulla delectus repudiandae laboriosam temporibus error nobis est nam.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,2,NULL,NULL,NULL,NULL,1,5,1500.00,2400.00,'hourly','fixed',0,2,3,4,111,0,9,'2026-10-20',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.288797','-75.567494',0,0,0,0,'published','approved','2025-11-25 04:13:56','2025-12-23 19:31:45',NULL,NULL,'2026-12-14',NULL),(40,NULL,'Services Sales Representative','Dolor laborum quis mollitia provident est deserunt similique illum. Aut enim aperiam consequatur voluptates maiores. Corrupti veniam dolorum odio quod voluptas.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,16,NULL,NULL,NULL,NULL,1,3,1100.00,1700.00,'hourly','fixed',1,8,3,3,144,0,10,'2026-07-05',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.279851','-76.447782',0,0,1,1,'published','approved','2025-11-09 06:52:18','2025-12-23 19:31:45',NULL,NULL,'2026-08-25',NULL),(41,NULL,'Services Delivery Manager','Neque voluptates quod distinctio minus dolorem. Quos sint cumque dolorem non qui. Beatae temporibus maxime ex quidem accusamus aliquid quam.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,1,NULL,NULL,NULL,NULL,0,1,1100.00,1900.00,'monthly','fixed',0,3,2,5,37,0,3,'2026-12-14',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.960482','-75.417825',0,0,0,1,'published','approved','2025-11-22 13:54:12','2025-12-23 19:31:45',NULL,NULL,'2026-09-11',NULL),(42,NULL,'Senior Solutions Engineer','Et aut enim eveniet ea assumenda. Sed delectus maxime eaque blanditiis laboriosam et illo. Neque quis maiores numquam. Voluptas voluptatibus culpa sint exercitationem facilis aperiam sit.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,9,NULL,NULL,NULL,NULL,1,5,1000.00,1800.00,'daily','fixed',1,9,3,1,111,0,4,'2026-10-16',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.734877','-75.158087',0,0,1,0,'published','approved','2025-11-29 00:11:28','2025-12-23 19:31:45',NULL,NULL,'2026-06-22',NULL),(43,NULL,'Senior Service Delivery Engineer','Saepe incidunt et aliquid explicabo magni nemo. Totam atque similique mollitia natus nesciunt possimus commodi eum. Itaque reprehenderit quae dolorum et hic nam.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,11,NULL,NULL,NULL,NULL,1,2,700.00,1800.00,'daily','fixed',0,6,2,4,115,0,10,'2026-08-10',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.905949','-76.149723',0,0,1,0,'published','approved','2025-11-09 14:55:30','2025-12-23 19:31:45',NULL,NULL,'2026-07-21',NULL),(44,NULL,'Senior Director, Global Sales Development','Est harum illo ut et neque. Necessitatibus sint quia officiis consequatur explicabo dolores ut laboriosam. Ex est et vel numquam non voluptates.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,11,NULL,NULL,NULL,NULL,1,4,1100.00,1800.00,'daily','fixed',0,5,1,4,12,0,7,'2026-11-15',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.905949','-76.149723',0,0,0,1,'published','approved','2025-11-21 21:52:49','2025-12-23 19:31:45',NULL,NULL,'2026-08-18',NULL),(45,NULL,'Partner Program Manager','Quos consectetur aspernatur est minus aut rerum velit. Nihil iusto aut repudiandae quis commodi ut vero. Quo perferendis quia distinctio et sit.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,13,NULL,NULL,NULL,NULL,0,1,1100.00,2600.00,'yearly','fixed',1,6,1,3,97,0,8,'2026-09-30',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.526494','-76.675032',0,0,1,1,'published','approved','2025-12-05 18:45:40','2025-12-23 19:31:45',NULL,NULL,'2026-12-20',NULL),(46,NULL,'Principal Cloud Solutions Engineer','Laborum quas omnis iure repellendus at esse. Voluptas accusantium at sequi. Ad accusamus dolores error aut nihil voluptate cumque numquam.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,10,NULL,NULL,NULL,NULL,0,1,1100.00,1700.00,'weekly','fixed',1,2,4,4,78,0,7,'2026-11-11',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.697171','-75.54763',0,0,0,0,'published','approved','2025-11-25 00:03:42','2025-12-23 19:31:45',NULL,NULL,'2026-08-09',NULL),(47,NULL,'Senior Cloud Solutions Engineer','Quo qui illo tenetur et incidunt. Quidem doloremque quisquam sit. Qui quam sint sit.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,2,NULL,NULL,NULL,NULL,1,5,1100.00,1900.00,'weekly','fixed',1,5,4,1,46,0,7,'2026-12-10',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.288797','-75.567494',0,0,1,1,'published','approved','2025-11-23 17:25:25','2025-12-23 19:31:45',NULL,NULL,'2026-08-20',NULL),(48,NULL,'Senior Customer Success Manager','Voluptatem dolores ut in sed qui doloribus eum. In at incidunt est dolorum accusamus enim numquam. Dolorem harum ut omnis aspernatur aspernatur. Nisi exercitationem similique omnis corporis enim.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,3,NULL,NULL,NULL,NULL,1,4,600.00,2100.00,'daily','fixed',0,2,4,2,108,0,3,'2026-06-21',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.92764','-76.507979',0,0,0,0,'published','approved','2025-11-27 05:34:24','2025-12-23 19:31:45',NULL,NULL,'2026-07-12',NULL),(49,NULL,'Inside Account Manager','Tenetur recusandae dicta a illum. Veritatis est autem necessitatibus numquam omnis quod. Sed odit eum ut velit aut. Vero sunt incidunt sed sed aut in hic.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,11,NULL,NULL,NULL,NULL,0,1,1200.00,2700.00,'monthly','fixed',1,1,2,2,78,0,5,'2026-09-29',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.905949','-76.149723',0,0,1,0,'published','approved','2025-11-30 07:39:03','2025-12-23 19:31:45',NULL,NULL,'2026-07-21',NULL),(50,NULL,'UX Jobs Board','Voluptatem velit explicabo labore autem pariatur architecto nobis. Reprehenderit qui tempora in saepe. Est iure vero error magnam assumenda error. Cum consequatur et soluta quis.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,4,NULL,NULL,NULL,NULL,0,1,700.00,1400.00,'daily','fixed',1,5,1,3,54,0,5,'2026-09-01',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'43.325323','-76.382381',0,0,1,0,'published','approved','2025-11-27 07:03:42','2025-12-23 19:31:45',NULL,NULL,'2026-07-21',NULL),(51,NULL,'Senior Laravel Developer (TALL Stack)','Dignissimos et fuga qui reiciendis. Cumque ut in voluptatum illum et quis. Et voluptates quisquam facere quae veritatis culpa cupiditate.','<h5>Responsibilities</h5>\n                <div>\n                    <p>As a Product Designer, you will work within a Product Delivery Team fused with UX, engineering, product and data talent.</p>\n                    <ul>\n                        <li>Have sound knowledge of commercial activities.</li>\n                        <li>Build next-generation web applications with a focus on the client side</li>\n                        <li>Work on multiple projects at once, and consistently meet draft deadlines</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Revise the work of previous designers to create a unified aesthetic for our brand materials</li>\n                    </ul>\n                </div>\n                <h5>Qualification </h5>\n                <div>\n                    <ul>\n                        <li>B.C.A / M.C.A under National University course complete.</li>\n                        <li>3 or more years of professional design experience</li>\n                        <li>have already graduated or are currently in any year of study</li>\n                        <li>Advanced degree or equivalent experience in graphic and web design</li>\n                    </ul>\n                </div>','',NULL,7,NULL,NULL,NULL,NULL,0,4,600.00,1100.00,'weekly','fixed',1,4,3,3,116,0,10,'2026-08-02',1,'Botble\\JobBoard\\Models\\Account',0,0,0,'42.522659','-75.217589',0,0,1,0,'published','approved','2025-10-31 08:26:54','2025-12-23 19:31:45',NULL,NULL,'2026-06-20',NULL);
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
INSERT INTO `jb_jobs_categories` VALUES (1,1),(1,3),(1,6),(2,1),(2,3),(2,9),(3,1),(3,5),(3,9),(4,1),(4,3),(4,7),(5,1),(5,3),(5,7),(6,1),(6,4),(6,6),(7,1),(7,3),(7,8),(8,1),(8,2),(8,9),(9,1),(9,3),(9,7),(10,1),(10,5),(10,9),(11,1),(11,3),(11,8),(12,1),(12,5),(12,10),(13,1),(13,5),(13,9),(14,1),(14,5),(14,7),(15,1),(15,5),(15,7),(16,1),(16,4),(16,8),(17,1),(17,2),(17,10),(18,1),(18,4),(18,7),(19,1),(19,4),(19,9),(20,1),(20,2),(20,6),(21,1),(21,5),(21,6),(22,1),(22,5),(22,9),(23,1),(23,2),(23,8),(24,1),(24,2),(24,9),(25,1),(25,2),(25,6),(26,1),(26,3),(26,6),(27,1),(27,3),(27,7),(28,1),(28,4),(28,10),(29,1),(29,2),(29,10),(30,1),(30,2),(30,6),(31,1),(31,4),(31,6),(32,1),(32,2),(32,6),(33,1),(33,4),(33,8),(34,1),(34,2),(34,9),(35,1),(35,4),(35,8),(36,1),(36,4),(36,10),(37,1),(37,4),(37,8),(38,1),(38,2),(38,10),(39,1),(39,4),(39,9),(40,1),(40,2),(40,7),(41,1),(41,5),(41,8),(42,1),(42,5),(42,8),(43,1),(43,4),(43,7),(44,1),(44,2),(44,7),(45,1),(45,4),(45,9),(46,1),(46,5),(46,7),(47,1),(47,3),(47,6),(48,1),(48,3),(48,6),(49,1),(49,3),(49,7),(50,1),(50,2),(50,7),(51,1),(51,3),(51,9);
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
INSERT INTO `jb_jobs_skills` VALUES (1,3),(2,3),(3,3),(4,2),(5,6),(6,2),(7,6),(8,4),(9,4),(10,4),(11,3),(12,6),(13,4),(14,6),(15,4),(16,4),(17,1),(18,5),(19,5),(20,4),(21,5),(22,4),(23,3),(24,2),(25,5),(26,6),(27,3),(28,5),(29,6),(30,4),(31,4),(32,3),(33,5),(34,4),(35,5),(36,6),(37,5),(38,4),(39,1),(40,4),(41,4),(42,6),(43,2),(44,6),(45,6),(46,2),(47,2),(48,6),(49,4),(50,4),(51,1);
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
INSERT INTO `jb_jobs_tags` VALUES (1,1),(1,7),(2,4),(2,6),(3,1),(3,7),(4,1),(4,7),(5,4),(5,8),(6,2),(6,8),(7,2),(7,5),(8,2),(8,8),(9,2),(9,5),(10,2),(10,5),(11,1),(11,5),(12,3),(12,6),(13,4),(13,6),(14,3),(14,7),(15,1),(15,6),(16,3),(16,7),(17,4),(17,6),(18,4),(18,6),(19,3),(19,8),(20,2),(20,6),(21,1),(21,8),(22,3),(22,6),(23,3),(23,5),(24,2),(24,8),(25,1),(25,6),(26,1),(26,8),(27,2),(27,5),(28,3),(28,5),(29,4),(29,5),(30,4),(30,5),(31,1),(31,8),(32,4),(32,7),(33,3),(33,7),(34,2),(34,5),(35,3),(35,6),(36,4),(36,7),(37,3),(37,7),(38,4),(38,8),(39,3),(39,6),(40,1),(40,8),(41,2),(41,6),(42,3),(42,5),(43,2),(43,6),(44,1),(44,8),(45,2),(45,6),(46,2),(46,5),(47,1),(47,8),(48,3),(48,8),(49,4),(49,6),(50,2),(50,6),(51,4),(51,8);
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
INSERT INTO `jb_jobs_types` VALUES (1,3),(2,5),(3,2),(4,2),(5,5),(6,1),(7,5),(8,4),(9,3),(10,5),(11,3),(12,2),(13,1),(14,2),(15,4),(16,2),(17,1),(18,4),(19,3),(20,1),(21,2),(22,4),(23,5),(24,1),(25,3),(26,3),(27,5),(28,2),(29,4),(30,5),(31,2),(32,3),(33,1),(34,3),(35,3),(36,5),(37,4),(38,4),(39,3),(40,2),(41,1),(42,3),(43,2),(44,5),(45,2),(46,3),(47,3),(48,2),(49,4),(50,3),(51,5);
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
INSERT INTO `jb_language_levels` VALUES (1,'Expert',0,0,'published','2025-12-23 19:31:44','2025-12-23 19:31:44'),(2,'Intermediate',0,0,'published','2025-12-23 19:31:44','2025-12-23 19:31:44'),(3,'Beginner',0,0,'published','2025-12-23 19:31:44','2025-12-23 19:31:44');
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
INSERT INTO `jb_packages` VALUES (1,'Free Trial',0,1,0,1,1,1,0,'[[{\"key\":\"text\",\"value\":\"Limited time trial period\"}],[{\"key\":\"text\",\"value\":\"1 listing allowed\"}],[{\"key\":\"text\",\"value\":\"Basic support\"}]]','published','2025-12-23 19:32:10','2025-12-23 19:32:10',NULL),(2,'Basic Listing',250,1,0,1,2,5,1,'[[{\"key\":\"text\",\"value\":\"1 listing allowed\"}],[{\"key\":\"text\",\"value\":\"5 photos per listing\"}],[{\"key\":\"text\",\"value\":\"Basic support\"}]]','published','2025-12-23 19:32:10','2025-12-23 19:32:10',NULL),(3,'Standard Package',1000,1,20,5,3,10,0,'[[{\"key\":\"text\",\"value\":\"5 listings allowed\"}],[{\"key\":\"text\",\"value\":\"10 photos per listing\"}],[{\"key\":\"text\",\"value\":\"Priority support\"}]]','published','2025-12-23 19:32:10','2025-12-23 19:32:10',NULL),(4,'Professional Package',1800,1,28,10,4,15,0,'[[{\"key\":\"text\",\"value\":\"10 listings allowed\"}],[{\"key\":\"text\",\"value\":\"15 photos per listing\"}],[{\"key\":\"text\",\"value\":\"Premium support\"}],[{\"key\":\"text\",\"value\":\"Featured listings\"}]]','published','2025-12-23 19:32:10','2025-12-23 19:32:10',NULL),(5,'Premium Package',2500,1,33,15,5,20,0,'[[{\"key\":\"text\",\"value\":\"15 listings allowed\"}],[{\"key\":\"text\",\"value\":\"20 photos per listing\"}],[{\"key\":\"text\",\"value\":\"Premium support\"}],[{\"key\":\"text\",\"value\":\"Featured listings\"}],[{\"key\":\"text\",\"value\":\"Priority listing placement\"}]]','published','2025-12-23 19:32:10','2025-12-23 19:32:10',NULL);
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
INSERT INTO `jb_reviews` VALUES (1,1,'Perfect +++++++++ i love it really also i get to fast ticket answers... Thanks Lot BOTBLE Teams','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',12,'Botble\\JobBoard\\Models\\Account',98),(2,2,'We have received brilliant service support and will be expanding the features with the developer. Nice product!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',98,'Botble\\JobBoard\\Models\\Company',7),(3,4,'We have received brilliant service support and will be expanding the features with the developer. Nice product!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',11,'Botble\\JobBoard\\Models\\Account',13),(4,2,'For me the best eCommerce script on Envato at this moment: modern, clean code, a lot of great features. The customer support is great too: I always get an answer within hours!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',79,'Botble\\JobBoard\\Models\\Company',6),(5,2,'The best ecommerce CMS! Excellent coding! best support service! Thank you so much..... I really like your hard work.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',90,'Botble\\JobBoard\\Models\\Company',11),(6,3,'This web app is really good in design, code quality & features. Besides, the customer support provided by the Botble team was really fast & helpful. You guys are awesome!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',1,'Botble\\JobBoard\\Models\\Account',42),(7,1,'Great system, great support, good job Botble. I\'m looking forward to more great functional plugins.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',82,'Botble\\JobBoard\\Models\\Company',12),(8,4,'It\'s not my first experience here on Codecanyon and I can honestly tell you all that Botble puts a LOT of effort into the support. They answer so fast, they helped me tons of times. REALLY by far THE BEST EXPERIENCE on Codecanyon. Those guys at Botble are so good that they deserve 5 stars. I recommend them, I trust them and I can\'t wait to see what they will sell in a near future. Thank you Botble :)','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',2,'Botble\\JobBoard\\Models\\Account',33),(9,2,'Very enthusiastic support! Excellent code is written. It\'s a true pleasure working with.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',25,'Botble\\JobBoard\\Models\\Company',9),(10,4,'This web app is really good in design, code quality & features. Besides, the customer support provided by the Botble team was really fast & helpful. You guys are awesome!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',97,'Botble\\JobBoard\\Models\\Company',6),(11,5,'This script is well coded and is super fast. The support is pretty quick. Very patient and helpful team. I strongly recommend it and they deserve more than 5 stars.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',5,'Botble\\JobBoard\\Models\\Account',100),(12,2,'Customer Support are grade (A*), however the code is a way too over engineered for it\'s purpose.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',66,'Botble\\JobBoard\\Models\\Company',14),(13,3,'Cool template. Excellent code quality. The support responds very quickly, which is very rare on themeforest and codecanyon.net, I buy a lot of templates, and everyone will have a response from technical support for two or three days. Thanks to tech support. I recommend to buy.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',11,'Botble\\JobBoard\\Models\\Company',15),(14,2,'Best ecommerce CMS online store!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',26,'Botble\\JobBoard\\Models\\Company',11),(15,5,'Very enthusiastic support! Excellent code is written. It\'s a true pleasure working with.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',8,'Botble\\JobBoard\\Models\\Account',25),(16,4,'For me the best eCommerce script on Envato at this moment: modern, clean code, a lot of great features. The customer support is great too: I always get an answer within hours!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',23,'Botble\\JobBoard\\Models\\Company',10),(17,3,'I Love this Script. I also found how to add other fees. Now I just wait the BIG update for the Marketplace with the Bulk Import. Just do not forget to make it to be Multi-language for us the Botble Fans.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',10,'Botble\\JobBoard\\Models\\Account',28),(18,2,'Good app, good backup service and support. Good documentation.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',7,'Botble\\JobBoard\\Models\\Account',67),(19,2,'The code is good, in general, if you like it, can you give it 5 stars?','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',87,'Botble\\JobBoard\\Models\\Company',10),(20,4,'The best ecommerce CMS! Excellent coding! best support service! Thank you so much..... I really like your hard work.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',14,'Botble\\JobBoard\\Models\\Account',67),(21,4,'Those guys now what they are doing, the release such a good product that it\'s a pleasure to work with ! Even when I was stuck on the project, I created a ticket and the next day it was replied by the team. GOOD JOB guys. I love working with them :)','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',44,'Botble\\JobBoard\\Models\\Company',1),(22,5,'The script is the best of its class, fast, easy to implement and work with , and the most important thing is the great support team , Recommend with no doubt.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',4,'Botble\\JobBoard\\Models\\Account',93),(23,5,'Best ecommerce CMS online store!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',15,'Botble\\JobBoard\\Models\\Company',5),(24,5,'This script is well coded and is super fast. The support is pretty quick. Very patient and helpful team. I strongly recommend it and they deserve more than 5 stars.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',61,'Botble\\JobBoard\\Models\\Company',10),(25,3,'The best ecommerce CMS! Excellent coding! best support service! Thank you so much..... I really like your hard work.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',24,'Botble\\JobBoard\\Models\\Company',2),(26,4,'Cool template. Excellent code quality. The support responds very quickly, which is very rare on themeforest and codecanyon.net, I buy a lot of templates, and everyone will have a response from technical support for two or three days. Thanks to tech support. I recommend to buy.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',1,'Botble\\JobBoard\\Models\\Company',1),(27,3,'Good app, good backup service and support. Good documentation.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',6,'Botble\\JobBoard\\Models\\Account',80),(28,4,'We have received brilliant service support and will be expanding the features with the developer. Nice product!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',7,'Botble\\JobBoard\\Models\\Account',27),(29,5,'Great system, great support, good job Botble. I\'m looking forward to more great functional plugins.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',14,'Botble\\JobBoard\\Models\\Account',57),(30,1,'Best ecommerce CMS online store!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',81,'Botble\\JobBoard\\Models\\Company',15),(31,5,'The script is the best of its class, fast, easy to implement and work with , and the most important thing is the great support team , Recommend with no doubt.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',53,'Botble\\JobBoard\\Models\\Company',12),(32,3,'This web app is really good in design, code quality & features. Besides, the customer support provided by the Botble team was really fast & helpful. You guys are awesome!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',33,'Botble\\JobBoard\\Models\\Company',2),(33,4,'Those guys now what they are doing, the release such a good product that it\'s a pleasure to work with ! Even when I was stuck on the project, I created a ticket and the next day it was replied by the team. GOOD JOB guys. I love working with them :)','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',5,'Botble\\JobBoard\\Models\\Account',83),(34,2,'We have received brilliant service support and will be expanding the features with the developer. Nice product!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',1,'Botble\\JobBoard\\Models\\Account',72),(35,2,'The best ecommerce CMS! Excellent coding! best support service! Thank you so much..... I really like your hard work.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',67,'Botble\\JobBoard\\Models\\Company',9),(36,3,'Customer Support are grade (A*), however the code is a way too over engineered for it\'s purpose.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',87,'Botble\\JobBoard\\Models\\Company',2),(37,1,'The best store template! Excellent coding! Very good support! Thank you so much for all the help, I really appreciated.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',70,'Botble\\JobBoard\\Models\\Company',10),(38,2,'As a developer I reviewed this script. This is really awesome ecommerce script. I have convinced when I noticed that it\'s built on fully WordPress concept.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',11,'Botble\\JobBoard\\Models\\Account',4),(39,5,'The best ecommerce CMS! Excellent coding! best support service! Thank you so much..... I really like your hard work.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',77,'Botble\\JobBoard\\Models\\Company',5),(40,1,'The best ecommerce CMS! Excellent coding! best support service! Thank you so much..... I really like your hard work.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',12,'Botble\\JobBoard\\Models\\Account',7),(41,3,'Ok good product. I have some issues in customizations. But its not correct to blame the developer. The product is good. Good luck for your business.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',61,'Botble\\JobBoard\\Models\\Company',15),(42,4,'Best ecommerce CMS online store!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',15,'Botble\\JobBoard\\Models\\Account',45),(43,5,'I Love this Script. I also found how to add other fees. Now I just wait the BIG update for the Marketplace with the Bulk Import. Just do not forget to make it to be Multi-language for us the Botble Fans.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',5,'Botble\\JobBoard\\Models\\Company',13),(44,3,'Clean & perfect source code','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',20,'Botble\\JobBoard\\Models\\Company',11),(45,4,'We have received brilliant service support and will be expanding the features with the developer. Nice product!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',73,'Botble\\JobBoard\\Models\\Company',5),(46,2,'The best store template! Excellent coding! Very good support! Thank you so much for all the help, I really appreciated.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',14,'Botble\\JobBoard\\Models\\Account',77),(47,2,'This web app is really good in design, code quality & features. Besides, the customer support provided by the Botble team was really fast & helpful. You guys are awesome!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',41,'Botble\\JobBoard\\Models\\Company',1),(48,3,'The code is good, in general, if you like it, can you give it 5 stars?','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',13,'Botble\\JobBoard\\Models\\Account',54),(49,3,'Very enthusiastic support! Excellent code is written. It\'s a true pleasure working with.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',46,'Botble\\JobBoard\\Models\\Company',4),(50,1,'Those guys now what they are doing, the release such a good product that it\'s a pleasure to work with ! Even when I was stuck on the project, I created a ticket and the next day it was replied by the team. GOOD JOB guys. I love working with them :)','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',35,'Botble\\JobBoard\\Models\\Company',4),(51,2,'The script is the best of its class, fast, easy to implement and work with , and the most important thing is the great support team , Recommend with no doubt.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',15,'Botble\\JobBoard\\Models\\Account',52),(52,3,'Great E-commerce system. And much more : Wonderful Customer Support.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',63,'Botble\\JobBoard\\Models\\Company',5),(53,4,'For me the best eCommerce script on Envato at this moment: modern, clean code, a lot of great features. The customer support is great too: I always get an answer within hours!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',48,'Botble\\JobBoard\\Models\\Company',12),(54,1,'Great E-commerce system. And much more : Wonderful Customer Support.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',31,'Botble\\JobBoard\\Models\\Company',16),(55,2,'These guys are amazing! Responses immediately, amazing support and help... I immediately feel at ease after Purchasing..','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',3,'Botble\\JobBoard\\Models\\Account',55),(56,5,'Good app, good backup service and support. Good documentation.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',7,'Botble\\JobBoard\\Models\\Account',56),(57,4,'This script is well coded and is super fast. The support is pretty quick. Very patient and helpful team. I strongly recommend it and they deserve more than 5 stars.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',4,'Botble\\JobBoard\\Models\\Account',53),(58,4,'As a developer I reviewed this script. This is really awesome ecommerce script. I have convinced when I noticed that it\'s built on fully WordPress concept.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',2,'Botble\\JobBoard\\Models\\Account',37),(59,2,'Solution is too robust for our purpose so we didn\'t use it at the end. But I appreciate customer support during initial configuration.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',11,'Botble\\JobBoard\\Models\\Account',6),(60,4,'The script is the best of its class, fast, easy to implement and work with , and the most important thing is the great support team , Recommend with no doubt.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',10,'Botble\\JobBoard\\Models\\Account',23),(61,4,'Second or third time that I buy a Botble product, happy with the products and support. You guys do a good job :)','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',4,'Botble\\JobBoard\\Models\\Account',99),(62,1,'Ok good product. I have some issues in customizations. But its not correct to blame the developer. The product is good. Good luck for your business.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',47,'Botble\\JobBoard\\Models\\Company',7),(63,5,'Amazing code, amazing support. Overall, im really confident in Botble and im happy I made the right choice! Thank you so much guys for coding this masterpiece','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',3,'Botble\\JobBoard\\Models\\Account',5),(64,1,'These guys are amazing! Responses immediately, amazing support and help... I immediately feel at ease after Purchasing..','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',16,'Botble\\JobBoard\\Models\\Account',93),(65,5,'The script is the best of its class, fast, easy to implement and work with , and the most important thing is the great support team , Recommend with no doubt.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',11,'Botble\\JobBoard\\Models\\Account',12),(66,5,'Great system, great support, good job Botble. I\'m looking forward to more great functional plugins.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',6,'Botble\\JobBoard\\Models\\Account',10),(67,3,'Second or third time that I buy a Botble product, happy with the products and support. You guys do a good job :)','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',5,'Botble\\JobBoard\\Models\\Account',16),(68,1,'For me the best eCommerce script on Envato at this moment: modern, clean code, a lot of great features. The customer support is great too: I always get an answer within hours!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',6,'Botble\\JobBoard\\Models\\Company',16),(69,3,'As a developer I reviewed this script. This is really awesome ecommerce script. I have convinced when I noticed that it\'s built on fully WordPress concept.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',28,'Botble\\JobBoard\\Models\\Company',8),(70,5,'Great system, great support, good job Botble. I\'m looking forward to more great functional plugins.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',1,'Botble\\JobBoard\\Models\\Account',59),(71,1,'As a developer I reviewed this script. This is really awesome ecommerce script. I have convinced when I noticed that it\'s built on fully WordPress concept.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',12,'Botble\\JobBoard\\Models\\Account',17),(72,5,'The best store template! Excellent coding! Very good support! Thank you so much for all the help, I really appreciated.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',10,'Botble\\JobBoard\\Models\\Account',53),(73,4,'Good app, good backup service and support. Good documentation.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',9,'Botble\\JobBoard\\Models\\Account',31),(74,3,'Great system, great support, good job Botble. I\'m looking forward to more great functional plugins.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',16,'Botble\\JobBoard\\Models\\Account',17),(75,3,'Clean & perfect source code','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',27,'Botble\\JobBoard\\Models\\Company',3),(76,3,'Good app, good backup service and support. Good documentation.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',8,'Botble\\JobBoard\\Models\\Account',15),(77,3,'Cool template. Excellent code quality. The support responds very quickly, which is very rare on themeforest and codecanyon.net, I buy a lot of templates, and everyone will have a response from technical support for two or three days. Thanks to tech support. I recommend to buy.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',55,'Botble\\JobBoard\\Models\\Company',14),(78,3,'The best ecommerce CMS! Excellent coding! best support service! Thank you so much..... I really like your hard work.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',96,'Botble\\JobBoard\\Models\\Company',11),(79,3,'Customer Support are grade (A*), however the code is a way too over engineered for it\'s purpose.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',74,'Botble\\JobBoard\\Models\\Company',3),(80,2,'This web app is really good in design, code quality & features. Besides, the customer support provided by the Botble team was really fast & helpful. You guys are awesome!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',12,'Botble\\JobBoard\\Models\\Account',80),(81,4,'Second or third time that I buy a Botble product, happy with the products and support. You guys do a good job :)','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',10,'Botble\\JobBoard\\Models\\Account',79),(82,4,'For me the best eCommerce script on Envato at this moment: modern, clean code, a lot of great features. The customer support is great too: I always get an answer within hours!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',14,'Botble\\JobBoard\\Models\\Account',62),(83,3,'We have received brilliant service support and will be expanding the features with the developer. Nice product!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',6,'Botble\\JobBoard\\Models\\Account',48),(84,2,'This script is well coded and is super fast. The support is pretty quick. Very patient and helpful team. I strongly recommend it and they deserve more than 5 stars.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',15,'Botble\\JobBoard\\Models\\Account',99),(85,5,'Best ecommerce CMS online store!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',16,'Botble\\JobBoard\\Models\\Account',54),(86,1,'These guys are amazing! Responses immediately, amazing support and help... I immediately feel at ease after Purchasing..','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',2,'Botble\\JobBoard\\Models\\Account',64),(87,1,'Cool template. Excellent code quality. The support responds very quickly, which is very rare on themeforest and codecanyon.net, I buy a lot of templates, and everyone will have a response from technical support for two or three days. Thanks to tech support. I recommend to buy.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',6,'Botble\\JobBoard\\Models\\Account',31),(88,5,'Best ecommerce CMS online store!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',5,'Botble\\JobBoard\\Models\\Account',44),(89,3,'We have received brilliant service support and will be expanding the features with the developer. Nice product!','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',6,'Botble\\JobBoard\\Models\\Account',100),(91,1,'Good app, good backup service and support. Good documentation.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',16,'Botble\\JobBoard\\Models\\Account',25),(92,3,'The script is the best of its class, fast, easy to implement and work with , and the most important thing is the great support team , Recommend with no doubt.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',43,'Botble\\JobBoard\\Models\\Company',11),(93,1,'Those guys now what they are doing, the release such a good product that it\'s a pleasure to work with ! Even when I was stuck on the project, I created a ticket and the next day it was replied by the team. GOOD JOB guys. I love working with them :)','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',25,'Botble\\JobBoard\\Models\\Company',7),(94,4,'Second or third time that I buy a Botble product, happy with the products and support. You guys do a good job :)','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',8,'Botble\\JobBoard\\Models\\Account',69),(95,4,'Good app, good backup service and support. Good documentation.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',2,'Botble\\JobBoard\\Models\\Company',5),(96,4,'Very enthusiastic support! Excellent code is written. It\'s a true pleasure working with.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',21,'Botble\\JobBoard\\Models\\Company',8),(97,3,'The best store template! Excellent coding! Very good support! Thank you so much for all the help, I really appreciated.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Company',8,'Botble\\JobBoard\\Models\\Account',96),(98,1,'Cool template. Excellent code quality. The support responds very quickly, which is very rare on themeforest and codecanyon.net, I buy a lot of templates, and everyone will have a response from technical support for two or three days. Thanks to tech support. I recommend to buy.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',64,'Botble\\JobBoard\\Models\\Company',4),(99,1,'The script is the best of its class, fast, easy to implement and work with , and the most important thing is the great support team , Recommend with no doubt.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',42,'Botble\\JobBoard\\Models\\Company',10),(100,2,'Solution is too robust for our purpose so we didn\'t use it at the end. But I appreciate customer support during initial configuration.','published','2025-12-23 19:32:10','2025-12-23 19:32:10','Botble\\JobBoard\\Models\\Account',48,'Botble\\JobBoard\\Models\\Company',16);
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
INSERT INTO `jb_tags` VALUES (1,'Illustrator','','published','2025-12-23 19:31:45','2025-12-23 19:31:45'),(2,'Adobe XD','','published','2025-12-23 19:31:45','2025-12-23 19:31:45'),(3,'Figma','','published','2025-12-23 19:31:45','2025-12-23 19:31:45'),(4,'Sketch','','published','2025-12-23 19:31:45','2025-12-23 19:31:45'),(5,'Lunacy','','published','2025-12-23 19:31:45','2025-12-23 19:31:45'),(6,'PHP','','published','2025-12-23 19:31:45','2025-12-23 19:31:45'),(7,'Python','','published','2025-12-23 19:31:45','2025-12-23 19:31:45'),(8,'JavaScript','','published','2025-12-23 19:31:45','2025-12-23 19:31:45');
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
INSERT INTO `language_meta` VALUES (1,'en_US','7ab3f99bab708e872f518157d8efcd38',1,'Botble\\Menu\\Models\\MenuLocation'),(2,'en_US','a3d4cbcd779fa6250d32f2d6275f86c9',1,'Botble\\Menu\\Models\\Menu'),(3,'en_US','6fffdd171bca60a04446bdfbe607ae34',2,'Botble\\Menu\\Models\\Menu'),(4,'en_US','33f5f6a660a9b0cca7f6844f8d2d293d',3,'Botble\\Menu\\Models\\Menu'),(5,'en_US','b7444bf0b6b449d937365fadcab2fd60',4,'Botble\\Menu\\Models\\Menu'),(6,'en_US','7ff386ae970c41a01ab44aaef2a880f4',5,'Botble\\Menu\\Models\\Menu');
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
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_files`
--

LOCK TABLES `media_files` WRITE;
/*!40000 ALTER TABLE `media_files` DISABLE KEYS */;
INSERT INTO `media_files` VALUES (1,0,'pic1','pic1',3,'image/jpeg',2100,'themes/jobzilla/account-icons/pic1.jpg','[]','2025-12-23 19:31:36','2025-12-23 19:31:36',NULL,'public'),(2,0,'pic2','pic2',3,'image/jpeg',2100,'themes/jobzilla/account-icons/pic2.jpg','[]','2025-12-23 19:31:36','2025-12-23 19:31:36',NULL,'public'),(3,0,'pic3','pic3',3,'image/jpeg',2100,'themes/jobzilla/account-icons/pic3.jpg','[]','2025-12-23 19:31:36','2025-12-23 19:31:36',NULL,'public'),(4,0,'pic4','pic4',3,'image/jpeg',2100,'themes/jobzilla/account-icons/pic4.jpg','[]','2025-12-23 19:31:36','2025-12-23 19:31:36',NULL,'public'),(5,0,'pic5','pic5',3,'image/jpeg',2100,'themes/jobzilla/account-icons/pic5.jpg','[]','2025-12-23 19:31:36','2025-12-23 19:31:36',NULL,'public'),(6,0,'pic6','pic6',3,'image/jpeg',2100,'themes/jobzilla/account-icons/pic6.jpg','[]','2025-12-23 19:31:36','2025-12-23 19:31:36',NULL,'public'),(7,0,'pic7','pic7',3,'image/jpeg',2100,'themes/jobzilla/account-icons/pic7.jpg','[]','2025-12-23 19:31:36','2025-12-23 19:31:36',NULL,'public'),(8,0,'americans','americans',4,'image/jpeg',7030,'themes/jobzilla/countries/americans.jpg','[]','2025-12-23 19:31:36','2025-12-23 19:31:36',NULL,'public'),(9,0,'denmark','denmark',4,'image/jpeg',1078,'themes/jobzilla/countries/denmark.jpg','[]','2025-12-23 19:31:36','2025-12-23 19:31:36',NULL,'public'),(10,0,'france','france',4,'image/jpeg',1078,'themes/jobzilla/countries/france.jpg','[]','2025-12-23 19:31:36','2025-12-23 19:31:36',NULL,'public'),(11,0,'united-kingdom','united-kingdom',4,'image/jpeg',1078,'themes/jobzilla/countries/united-kingdom.jpg','[]','2025-12-23 19:31:36','2025-12-23 19:31:36',NULL,'public'),(12,0,'1','1',5,'image/jpeg',9803,'themes/jobzilla/news/1.jpg','[]','2025-12-23 19:31:36','2025-12-23 19:31:36',NULL,'public'),(13,0,'10','10',5,'image/jpeg',9803,'themes/jobzilla/news/10.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(14,0,'11','11',5,'image/jpeg',9803,'themes/jobzilla/news/11.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(15,0,'12','12',5,'image/jpeg',9803,'themes/jobzilla/news/12.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(16,0,'13','13',5,'image/jpeg',9803,'themes/jobzilla/news/13.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(17,0,'14','14',5,'image/jpeg',9803,'themes/jobzilla/news/14.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(18,0,'15','15',5,'image/jpeg',9803,'themes/jobzilla/news/15.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(19,0,'16','16',5,'image/jpeg',9803,'themes/jobzilla/news/16.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(20,0,'17','17',5,'image/jpeg',9803,'themes/jobzilla/news/17.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(21,0,'18','18',5,'image/jpeg',9803,'themes/jobzilla/news/18.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(22,0,'19','19',5,'image/jpeg',9803,'themes/jobzilla/news/19.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(23,0,'2','2',5,'image/jpeg',9803,'themes/jobzilla/news/2.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(24,0,'20','20',5,'image/jpeg',9803,'themes/jobzilla/news/20.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(25,0,'3','3',5,'image/jpeg',9803,'themes/jobzilla/news/3.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(26,0,'4','4',5,'image/jpeg',9803,'themes/jobzilla/news/4.jpg','[]','2025-12-23 19:31:37','2025-12-23 19:31:37',NULL,'public'),(27,0,'5','5',5,'image/jpeg',9803,'themes/jobzilla/news/5.jpg','[]','2025-12-23 19:31:38','2025-12-23 19:31:38',NULL,'public'),(28,0,'6','6',5,'image/jpeg',9803,'themes/jobzilla/news/6.jpg','[]','2025-12-23 19:31:38','2025-12-23 19:31:38',NULL,'public'),(29,0,'7','7',5,'image/jpeg',9803,'themes/jobzilla/news/7.jpg','[]','2025-12-23 19:31:38','2025-12-23 19:31:38',NULL,'public'),(30,0,'8','8',5,'image/jpeg',9803,'themes/jobzilla/news/8.jpg','[]','2025-12-23 19:31:38','2025-12-23 19:31:38',NULL,'public'),(31,0,'9','9',5,'image/jpeg',9803,'themes/jobzilla/news/9.jpg','[]','2025-12-23 19:31:38','2025-12-23 19:31:38',NULL,'public'),(32,0,'404','404',6,'image/png',73756,'themes/jobzilla/general/404.png','[]','2025-12-23 19:31:38','2025-12-23 19:31:38',NULL,'public'),(33,0,'ab-1','ab-1',6,'image/png',74754,'themes/jobzilla/general/ab-1.png','[]','2025-12-23 19:31:38','2025-12-23 19:31:38',NULL,'public'),(34,0,'add-bg','add-bg',6,'image/jpeg',12455,'themes/jobzilla/general/add-bg.jpg','[]','2025-12-23 19:31:38','2025-12-23 19:31:38',NULL,'public'),(35,0,'background-breadcrumb','background-breadcrumb',6,'image/jpeg',55177,'themes/jobzilla/general/background-breadcrumb.jpg','[]','2025-12-23 19:31:38','2025-12-23 19:31:38',NULL,'public'),(36,0,'bag','bag',6,'image/png',1638,'themes/jobzilla/general/bag.png','[]','2025-12-23 19:31:39','2025-12-23 19:31:39',NULL,'public'),(37,0,'banner1','banner1',6,'image/jpeg',26574,'themes/jobzilla/general/banner1.jpg','[]','2025-12-23 19:31:39','2025-12-23 19:31:39',NULL,'public'),(38,0,'bg-3','bg-3',6,'image/jpeg',30180,'themes/jobzilla/general/bg-3.jpg','[]','2025-12-23 19:31:39','2025-12-23 19:31:39',NULL,'public'),(39,0,'bg-pattern-can','bg-pattern-can',6,'image/png',32661,'themes/jobzilla/general/bg-pattern-can.png','[]','2025-12-23 19:31:39','2025-12-23 19:31:39',NULL,'public'),(40,0,'bg','bg',6,'image/png',241324,'themes/jobzilla/general/bg.png','[]','2025-12-23 19:31:39','2025-12-23 19:31:39',NULL,'public'),(41,0,'bg1','bg1',6,'image/jpeg',29486,'themes/jobzilla/general/bg1.jpg','[]','2025-12-23 19:31:39','2025-12-23 19:31:39',NULL,'public'),(42,0,'bg2','bg2',6,'image/jpeg',37680,'themes/jobzilla/general/bg2.jpg','[]','2025-12-23 19:31:39','2025-12-23 19:31:39',NULL,'public'),(43,0,'bnr-right-pic','bnr-right-pic',6,'image/png',8941,'themes/jobzilla/general/bnr-right-pic.png','[]','2025-12-23 19:31:39','2025-12-23 19:31:39',NULL,'public'),(44,0,'boy-large','boy-large',6,'image/png',10354,'themes/jobzilla/general/boy-large.png','[]','2025-12-23 19:31:39','2025-12-23 19:31:39',NULL,'public'),(45,0,'cate-bg','cate-bg',6,'image/jpeg',10926,'themes/jobzilla/general/cate-bg.jpg','[]','2025-12-23 19:31:39','2025-12-23 19:31:39',NULL,'public'),(46,0,'ctr-bg','ctr-bg',6,'image/jpeg',8007,'themes/jobzilla/general/ctr-bg.jpg','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(47,0,'cv-icon','cv-icon',6,'image/png',1641,'themes/jobzilla/general/cv-icon.png','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(48,0,'dotted-block','dotted-block',6,'image/png',1813,'themes/jobzilla/general/dotted-block.png','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(49,0,'dotted-map','dotted-map',6,'image/png',286975,'themes/jobzilla/general/dotted-map.png','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(50,0,'employee','employee',6,'image/png',9717,'themes/jobzilla/general/employee.png','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(51,0,'favicon','favicon',6,'image/png',1555,'themes/jobzilla/general/favicon.png','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(52,0,'get-job-pic','get-job-pic',6,'image/png',11422,'themes/jobzilla/general/get-job-pic.png','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(53,0,'gir-large-2','gir-large-2',6,'image/png',6966,'themes/jobzilla/general/gir-large-2.png','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(54,0,'gir-large','gir-large',6,'image/png',9882,'themes/jobzilla/general/gir-large.png','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(55,0,'h7-banner','h7-banner',6,'image/jpeg',26574,'themes/jobzilla/general/h7-banner.jpg','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(56,0,'h8-banner','h8-banner',6,'image/jpeg',24859,'themes/jobzilla/general/h8-banner.jpg','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(57,0,'hig-pic','hig-pic',6,'image/png',12325,'themes/jobzilla/general/hig-pic.png','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(58,0,'hig-pic2','hig-pic2',6,'image/png',11890,'themes/jobzilla/general/hig-pic2.png','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(59,0,'hiw-bg','hiw-bg',6,'image/jpeg',25495,'themes/jobzilla/general/hiw-bg.jpg','[]','2025-12-23 19:31:40','2025-12-23 19:31:40',NULL,'public'),(60,0,'icon-1','icon-1',6,'image/png',989,'themes/jobzilla/general/icon-1.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(61,0,'icon-2','icon-2',6,'image/png',744,'themes/jobzilla/general/icon-2.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(62,0,'icon-3','icon-3',6,'image/png',752,'themes/jobzilla/general/icon-3.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(63,0,'icon-4','icon-4',6,'image/png',2463,'themes/jobzilla/general/icon-4.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(64,0,'icon-5','icon-5',6,'image/png',3309,'themes/jobzilla/general/icon-5.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(65,0,'icon1','icon1',6,'image/png',3626,'themes/jobzilla/general/icon1.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(66,0,'icon2','icon2',6,'image/png',3489,'themes/jobzilla/general/icon2.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(67,0,'icon3','icon3',6,'image/png',3714,'themes/jobzilla/general/icon3.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(68,0,'icon4','icon4',6,'image/png',3563,'themes/jobzilla/general/icon4.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(69,0,'job-detail-bg-2','job-detail-bg-2',6,'image/jpeg',11312,'themes/jobzilla/general/job-detail-bg-2.jpg','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(70,0,'large-pic-1','large-pic-1',6,'image/png',9460,'themes/jobzilla/general/large-pic-1.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(71,0,'logo-light','logo-light',6,'image/png',4083,'themes/jobzilla/general/logo-light.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(72,0,'logo','logo',6,'image/png',4382,'themes/jobzilla/general/logo.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(73,0,'main-bg','main-bg',6,'image/png',12615,'themes/jobzilla/general/main-bg.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(74,0,'main-pic','main-pic',6,'image/png',9094,'themes/jobzilla/general/main-pic.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(75,0,'map-img','map-img',6,'image/png',6099,'themes/jobzilla/general/map-img.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(76,0,'newsletter-image','newsletter-image',6,'image/jpeg',15305,'themes/jobzilla/general/newsletter-image.jpg','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(77,0,'ofr-bg','ofr-bg',6,'image/jpeg',17521,'themes/jobzilla/general/ofr-bg.jpg','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(78,0,'our-com-bg','our-com-bg',6,'image/jpeg',19683,'themes/jobzilla/general/our-com-bg.jpg','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(79,0,'pdf-file','pdf-file',6,'image/png',539,'themes/jobzilla/general/pdf-file.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(80,0,'placeholder','placeholder',6,'image/png',7235,'themes/jobzilla/general/placeholder.png','[]','2025-12-23 19:31:41','2025-12-23 19:31:41',NULL,'public'),(81,0,'r-img1','r-img1',6,'image/png',12418,'themes/jobzilla/general/r-img1.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(82,0,'r-img2','r-img2',6,'image/png',13887,'themes/jobzilla/general/r-img2.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(83,0,'r-pic1','r-pic1',6,'image/png',9660,'themes/jobzilla/general/r-pic1.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(84,0,'r-pic2','r-pic2',6,'image/png',10617,'themes/jobzilla/general/r-pic2.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(85,0,'r-pic3','r-pic3',6,'image/png',3527,'themes/jobzilla/general/r-pic3.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(86,0,'r-pic4','r-pic4',6,'image/png',4242,'themes/jobzilla/general/r-pic4.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(87,0,'right-pic-1','right-pic-1',6,'image/jpeg',13317,'themes/jobzilla/general/right-pic-1.jpg','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(88,0,'right-pic-2','right-pic-2',6,'image/jpeg',6855,'themes/jobzilla/general/right-pic-2.jpg','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(89,0,'testimonial-3d-pic','testimonial-3d-pic',6,'image/png',10649,'themes/jobzilla/general/testimonial-3d-pic.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(90,0,'trusted-1','trusted-1',6,'image/png',385,'themes/jobzilla/general/trusted-1.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(91,0,'trusted-2','trusted-2',6,'image/png',411,'themes/jobzilla/general/trusted-2.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(92,0,'trusted-3','trusted-3',6,'image/png',605,'themes/jobzilla/general/trusted-3.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(93,0,'user','user',6,'image/png',7337,'themes/jobzilla/general/user.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(94,0,'1','1',7,'image/png',3126,'themes/jobzilla/job-categories/1.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(95,0,'2','2',7,'image/png',2310,'themes/jobzilla/job-categories/2.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(96,0,'3','3',7,'image/png',1837,'themes/jobzilla/job-categories/3.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(97,0,'4','4',7,'image/png',2585,'themes/jobzilla/job-categories/4.png','[]','2025-12-23 19:31:42','2025-12-23 19:31:42',NULL,'public'),(98,0,'1','1',8,'image/png',5327,'themes/jobzilla/companies/1.png','[]','2025-12-23 19:31:43','2025-12-23 19:31:43',NULL,'public'),(99,0,'10','10',8,'image/png',5327,'themes/jobzilla/companies/10.png','[]','2025-12-23 19:31:43','2025-12-23 19:31:43',NULL,'public'),(100,0,'11','11',8,'image/png',5327,'themes/jobzilla/companies/11.png','[]','2025-12-23 19:31:43','2025-12-23 19:31:43',NULL,'public'),(101,0,'12','12',8,'image/png',5327,'themes/jobzilla/companies/12.png','[]','2025-12-23 19:31:43','2025-12-23 19:31:43',NULL,'public'),(102,0,'13','13',8,'image/png',5327,'themes/jobzilla/companies/13.png','[]','2025-12-23 19:31:43','2025-12-23 19:31:43',NULL,'public'),(103,0,'14','14',8,'image/png',5327,'themes/jobzilla/companies/14.png','[]','2025-12-23 19:31:43','2025-12-23 19:31:43',NULL,'public'),(104,0,'15','15',8,'image/png',5327,'themes/jobzilla/companies/15.png','[]','2025-12-23 19:31:43','2025-12-23 19:31:43',NULL,'public'),(105,0,'16','16',8,'image/png',5327,'themes/jobzilla/companies/16.png','[]','2025-12-23 19:31:43','2025-12-23 19:31:43',NULL,'public'),(106,0,'17','17',8,'image/png',5327,'themes/jobzilla/companies/17.png','[]','2025-12-23 19:31:43','2025-12-23 19:31:43',NULL,'public'),(107,0,'2','2',8,'image/png',5327,'themes/jobzilla/companies/2.png','[]','2025-12-23 19:31:43','2025-12-23 19:31:43',NULL,'public'),(108,0,'3','3',8,'image/png',5327,'themes/jobzilla/companies/3.png','[]','2025-12-23 19:31:43','2025-12-23 19:31:43',NULL,'public'),(109,0,'4','4',8,'image/png',5327,'themes/jobzilla/companies/4.png','[]','2025-12-23 19:31:43','2025-12-23 19:31:43',NULL,'public'),(110,0,'5','5',8,'image/png',5327,'themes/jobzilla/companies/5.png','[]','2025-12-23 19:31:43','2025-12-23 19:31:43',NULL,'public'),(111,0,'6','6',8,'image/png',5327,'themes/jobzilla/companies/6.png','[]','2025-12-23 19:31:44','2025-12-23 19:31:44',NULL,'public'),(112,0,'7','7',8,'image/png',5327,'themes/jobzilla/companies/7.png','[]','2025-12-23 19:31:44','2025-12-23 19:31:44',NULL,'public'),(113,0,'8','8',8,'image/png',5327,'themes/jobzilla/companies/8.png','[]','2025-12-23 19:31:44','2025-12-23 19:31:44',NULL,'public'),(114,0,'9','9',8,'image/png',5327,'themes/jobzilla/companies/9.png','[]','2025-12-23 19:31:44','2025-12-23 19:31:44',NULL,'public'),(115,0,'img1','img1',9,'image/png',43061,'themes/jobzilla/jobs/img1.png','[]','2025-12-23 19:31:44','2025-12-23 19:31:44',NULL,'public'),(116,0,'img2','img2',9,'image/png',47802,'themes/jobzilla/jobs/img2.png','[]','2025-12-23 19:31:44','2025-12-23 19:31:44',NULL,'public'),(117,0,'img3','img3',9,'image/png',24848,'themes/jobzilla/jobs/img3.png','[]','2025-12-23 19:31:44','2025-12-23 19:31:44',NULL,'public'),(118,0,'img4','img4',9,'image/png',22523,'themes/jobzilla/jobs/img4.png','[]','2025-12-23 19:31:44','2025-12-23 19:31:44',NULL,'public'),(119,0,'img5','img5',9,'image/png',112511,'themes/jobzilla/jobs/img5.png','[]','2025-12-23 19:31:44','2025-12-23 19:31:44',NULL,'public'),(120,0,'img6','img6',9,'image/png',31919,'themes/jobzilla/jobs/img6.png','[]','2025-12-23 19:31:44','2025-12-23 19:31:44',NULL,'public'),(121,0,'img7','img7',9,'image/png',24848,'themes/jobzilla/jobs/img7.png','[]','2025-12-23 19:31:44','2025-12-23 19:31:44',NULL,'public'),(122,0,'img8','img8',9,'image/png',22523,'themes/jobzilla/jobs/img8.png','[]','2025-12-23 19:31:44','2025-12-23 19:31:44',NULL,'public'),(123,0,'img9','img9',9,'image/png',43061,'themes/jobzilla/jobs/img9.png','[]','2025-12-23 19:31:45','2025-12-23 19:31:45',NULL,'public'),(124,0,'1','1',10,'image/jpeg',12629,'themes/jobzilla/cities/1.jpg','[]','2025-12-23 19:31:45','2025-12-23 19:31:45',NULL,'public'),(125,0,'2','2',10,'image/jpeg',12629,'themes/jobzilla/cities/2.jpg','[]','2025-12-23 19:31:45','2025-12-23 19:31:45',NULL,'public'),(126,0,'3','3',10,'image/jpeg',12629,'themes/jobzilla/cities/3.jpg','[]','2025-12-23 19:31:45','2025-12-23 19:31:45',NULL,'public'),(127,0,'01','01',11,'application/pdf',43496,'themes/jobzilla/resume/01.pdf','[]','2025-12-23 19:31:45','2025-12-23 19:31:45',NULL,'public'),(128,0,'1','1',12,'image/jpeg',5327,'themes/jobzilla/accounts/1.jpg','[]','2025-12-23 19:31:45','2025-12-23 19:31:45',NULL,'public'),(129,0,'2','2',12,'image/jpeg',5327,'themes/jobzilla/accounts/2.jpg','[]','2025-12-23 19:31:45','2025-12-23 19:31:45',NULL,'public'),(130,0,'3','3',12,'image/jpeg',5327,'themes/jobzilla/accounts/3.jpg','[]','2025-12-23 19:31:46','2025-12-23 19:31:46',NULL,'public'),(131,0,'4','4',12,'image/jpeg',5327,'themes/jobzilla/accounts/4.jpg','[]','2025-12-23 19:31:46','2025-12-23 19:31:46',NULL,'public'),(132,0,'5','5',12,'image/jpeg',5327,'themes/jobzilla/accounts/5.jpg','[]','2025-12-23 19:31:46','2025-12-23 19:31:46',NULL,'public'),(133,0,'1','1',13,'image/png',4521,'themes/jobzilla/testimonials/1.png','[]','2025-12-23 19:32:10','2025-12-23 19:32:10',NULL,'public'),(134,0,'2','2',13,'image/png',4521,'themes/jobzilla/testimonials/2.png','[]','2025-12-23 19:32:10','2025-12-23 19:32:10',NULL,'public'),(135,0,'3','3',13,'image/png',4521,'themes/jobzilla/testimonials/3.png','[]','2025-12-23 19:32:10','2025-12-23 19:32:10',NULL,'public'),(136,0,'4','4',13,'image/png',4521,'themes/jobzilla/testimonials/4.png','[]','2025-12-23 19:32:10','2025-12-23 19:32:10',NULL,'public');
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_folders`
--

LOCK TABLES `media_folders` WRITE;
/*!40000 ALTER TABLE `media_folders` DISABLE KEYS */;
INSERT INTO `media_folders` VALUES (1,0,'themes',NULL,'themes',0,'2025-12-23 19:31:36','2025-12-23 19:31:36',NULL),(2,0,'jobzilla',NULL,'jobzilla',1,'2025-12-23 19:31:36','2025-12-23 19:31:36',NULL),(3,0,'account-icons',NULL,'account-icons',2,'2025-12-23 19:31:36','2025-12-23 19:31:36',NULL),(4,0,'countries',NULL,'countries',2,'2025-12-23 19:31:36','2025-12-23 19:31:36',NULL),(5,0,'news',NULL,'news',2,'2025-12-23 19:31:36','2025-12-23 19:31:36',NULL),(6,0,'general',NULL,'general',2,'2025-12-23 19:31:38','2025-12-23 19:31:38',NULL),(7,0,'job-categories',NULL,'job-categories',2,'2025-12-23 19:31:42','2025-12-23 19:31:42',NULL),(8,0,'companies',NULL,'companies',2,'2025-12-23 19:31:43','2025-12-23 19:31:43',NULL),(9,0,'jobs',NULL,'jobs',2,'2025-12-23 19:31:44','2025-12-23 19:31:44',NULL),(10,0,'cities',NULL,'cities',2,'2025-12-23 19:31:45','2025-12-23 19:31:45',NULL),(11,0,'resume',NULL,'resume',2,'2025-12-23 19:31:45','2025-12-23 19:31:45',NULL),(12,0,'accounts',NULL,'accounts',2,'2025-12-23 19:31:45','2025-12-23 19:31:45',NULL),(13,0,'testimonials',NULL,'testimonials',2,'2025-12-23 19:32:10','2025-12-23 19:32:10',NULL);
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
INSERT INTO `menu_locations` VALUES (1,1,'main-menu','2025-12-23 19:32:10','2025-12-23 19:32:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_nodes`
--

LOCK TABLES `menu_nodes` WRITE;
/*!40000 ALTER TABLE `menu_nodes` DISABLE KEYS */;
INSERT INTO `menu_nodes` VALUES (1,1,0,NULL,NULL,'/',NULL,0,'Home',NULL,'_self',1,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(2,1,1,NULL,NULL,'/',NULL,0,'Home-1',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(3,1,1,2,'Botble\\Page\\Models\\Page','/homepage-2',NULL,1,'Home-2',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(4,1,1,3,'Botble\\Page\\Models\\Page','/homepage-3',NULL,2,'Home-3',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(5,1,1,4,'Botble\\Page\\Models\\Page','/homepage-4',NULL,3,'Home-4',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(6,1,1,20,'Botble\\Page\\Models\\Page','/homepage-5',NULL,4,'Home-5',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(7,1,1,21,'Botble\\Page\\Models\\Page','/homepage-6',NULL,5,'Home-6',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(8,1,1,22,'Botble\\Page\\Models\\Page','/homepage-7',NULL,6,'Home-7',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(9,1,1,23,'Botble\\Page\\Models\\Page','/homepage-8',NULL,7,'Home-8',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(10,1,0,NULL,NULL,'/jobs',NULL,1,'Jobs',NULL,'_self',1,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(11,1,10,NULL,NULL,'/jobs?layout=grid',NULL,0,'Jobs Grid',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(12,1,10,NULL,NULL,'/jobs?layout=map',NULL,1,'Jobs Grid with Map',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(13,1,10,NULL,NULL,'/jobs?layout=list',NULL,2,'Jobs List',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(14,1,10,NULL,NULL,'/job-categories',NULL,3,'Job Categories',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(15,1,10,NULL,NULL,'/jobs/ui-ux-designer-full-time',NULL,4,'Job Detail',NULL,'_self',1,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(16,1,15,NULL,NULL,'/jobs/ui-ux-designer-full-time',NULL,0,'Detail 1',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(17,1,15,NULL,NULL,'/jobs/java-software-engineer',NULL,1,'Detail 2 - layout v2',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(18,1,15,NULL,NULL,'/jobs/full-stack-engineer',NULL,2,'Detail 3 - external job',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(19,1,10,NULL,NULL,'/',NULL,5,'Apply Job',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(20,1,0,NULL,NULL,'companies',NULL,2,'Companies',NULL,'_self',1,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(21,1,20,NULL,NULL,'/companies?layout=grid',NULL,0,'Companies Grid',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(22,1,20,NULL,NULL,'/companies?layout=list',NULL,1,'Companies List',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(23,1,20,NULL,NULL,'',NULL,2,'Companies Detail',NULL,'_self',1,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(24,1,23,NULL,NULL,'/companies/pinterest',NULL,0,'Detail 1',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(25,1,23,NULL,NULL,'/companies/pinterest',NULL,1,'Detail 2',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(26,1,0,NULL,NULL,'candidates',NULL,3,'Candidates',NULL,'_self',1,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(27,1,26,NULL,NULL,'/candidates?layout=grid',NULL,0,'Candidates Grid',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(28,1,26,NULL,NULL,'/candidates?layout=list',NULL,1,'Candidates List',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(29,1,26,NULL,NULL,'',NULL,2,'Candidates Detail',NULL,'_self',1,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(30,1,29,NULL,NULL,'/candidates/earnestine-schulist',NULL,0,'Detail 1',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(31,1,29,NULL,NULL,'/candidates/earnestine-schulist',NULL,1,'Detail 2',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(32,1,0,NULL,NULL,'#',NULL,4,'Pages',NULL,'_self',1,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(33,1,32,6,'Botble\\Page\\Models\\Page','/contact',NULL,0,'Contact',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(34,1,32,9,'Botble\\Page\\Models\\Page','/about-us',NULL,1,'About Us',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(35,1,32,24,'Botble\\Page\\Models\\Page','/pricing',NULL,2,'Pricing',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(36,1,32,NULL,NULL,'/404',NULL,3,'Error-404',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(37,1,32,8,'Botble\\Page\\Models\\Page','/faq',NULL,4,'FAQs',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(38,1,32,6,'Botble\\Page\\Models\\Page','/contact',NULL,5,'Contact Us',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(39,1,32,14,'Botble\\Page\\Models\\Page','/coming-soon',NULL,6,'Coming soon',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(40,1,32,NULL,NULL,'/login',NULL,7,'Login',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(41,1,0,5,'Botble\\Page\\Models\\Page','/blog',NULL,5,'Blog',NULL,'_self',1,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(42,1,41,5,'Botble\\Page\\Models\\Page','/blog',NULL,0,'Blog',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(43,1,41,NULL,NULL,'/blog/breakthrough-in-quantum-computing-computing-power-reaches-milestone',NULL,1,'Post Detail',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(44,2,0,NULL,NULL,'account/dashboard',NULL,0,'User Dashboard',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(45,2,0,NULL,NULL,'/candidates/earnestine-schulist',NULL,1,'Candidates',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(46,3,0,NULL,NULL,'account/jobs/create',NULL,0,'Post Jobs',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(47,3,0,5,'Botble\\Page\\Models\\Page','/blog',NULL,1,'Blog Grid',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(48,3,0,6,'Botble\\Page\\Models\\Page','/contact',NULL,2,'Contact',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(49,3,0,NULL,NULL,'/jobs?layout=list',NULL,3,'Jobs Listing',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(50,3,0,NULL,NULL,'/jobs/ui-ux-designer-full-time',NULL,4,'Jobs details',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(51,4,0,10,'Botble\\Page\\Models\\Page','/terms-of-use',NULL,0,'Terms Of Use',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(52,4,0,NULL,'Botble\\Page\\Models\\Page',NULL,NULL,1,'Terms & Conditions',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(53,4,0,8,'Botble\\Page\\Models\\Page','/faq',NULL,2,'FAQ',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:11'),(54,4,0,7,'Botble\\Page\\Models\\Page','/cookie-policy',NULL,3,'Cookie Policy',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:11'),(55,4,0,14,'Botble\\Page\\Models\\Page','/coming-soon',NULL,4,'Coming Soon',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:11'),(56,5,0,NULL,NULL,'/',NULL,0,'Home',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(57,5,0,9,'Botble\\Page\\Models\\Page','/about-us',NULL,1,'About us',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:11'),(58,5,0,NULL,NULL,'/jobs',NULL,2,'Jobs',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10'),(59,5,0,NULL,NULL,'/companies',NULL,3,'Companies',NULL,'_self',0,'2025-12-23 19:32:10','2025-12-23 19:32:10');
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
INSERT INTO `menus` VALUES (1,'Main menu','main-menu','published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(2,'For Candidate','for-candidate','published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(3,'For Employers','for-employers','published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(4,'Helpful Resources','helpful-resources','published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(5,'Quick Links','quick-links','published','2025-12-23 19:32:10','2025-12-23 19:32:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta_boxes`
--

LOCK TABLES `meta_boxes` WRITE;
/*!40000 ALTER TABLE `meta_boxes` DISABLE KEYS */;
INSERT INTO `meta_boxes` VALUES (1,'header_css_class','[\"header-style-light\"]',2,'Botble\\Page\\Models\\Page','2025-12-23 19:31:36','2025-12-23 19:31:36'),(2,'header_css_class','[\"header-style-3 no-fixed\"]',20,'Botble\\Page\\Models\\Page','2025-12-23 19:31:36','2025-12-23 19:31:36'),(3,'header_css_class','[\"header-style-light\"]',22,'Botble\\Page\\Models\\Page','2025-12-23 19:31:36','2025-12-23 19:31:36'),(4,'icon','[\"flaticon-dashboard\"]',1,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(5,'icon','[\"flaticon-project-management\"]',2,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(6,'icon','[\"flaticon-note\"]',3,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(7,'icon','[\"flaticon-customer-support\"]',4,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(8,'icon','[\"flaticon-bars\"]',5,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(9,'icon','[\"flaticon-user\"]',6,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(10,'icon','[\"flaticon-computer\"]',7,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(11,'icon','[\"flaticon-coding\"]',8,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(12,'icon','[\"flaticon-hr\"]',9,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(13,'icon','[\"flaticon-healthcare\"]',10,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(14,'icon','[\"flaticon-repair\"]',11,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(15,'icon','[\"flaticon-teacher\"]',12,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(16,'icon','[\"flaticon-bank\"]',13,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(17,'icon','[\"flaticon-deal\"]',14,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(18,'icon','[\"flaticon-tray\"]',15,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(19,'icon','[\"flaticon-tower\"]',16,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(20,'icon','[\"flaticon-lotus\"]',17,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(21,'icon','[\"flaticon-camera-tripod\"]',18,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(22,'icon','[\"flaticon-multimedia\"]',19,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(23,'icon','[\"flaticon-contract\"]',20,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(24,'icon','[\"flaticon-engineer\"]',21,'Botble\\JobBoard\\Models\\Category','2025-12-23 19:31:43','2025-12-23 19:31:43'),(25,'background_color','[\"#2db346\"]',1,'Botble\\JobBoard\\Models\\JobType','2025-12-23 19:31:43','2025-12-23 19:31:43'),(26,'background_color','[\"#2d9bb3\"]',2,'Botble\\JobBoard\\Models\\JobType','2025-12-23 19:31:43','2025-12-23 19:31:43'),(27,'background_color','[\"#8883ec\"]',3,'Botble\\JobBoard\\Models\\JobType','2025-12-23 19:31:43','2025-12-23 19:31:43'),(28,'background_color','[\"#b3692d\"]',4,'Botble\\JobBoard\\Models\\JobType','2025-12-23 19:31:43','2025-12-23 19:31:43'),(29,'background_color','[\"#b7912a\"]',5,'Botble\\JobBoard\\Models\\JobType','2025-12-23 19:31:43','2025-12-23 19:31:43'),(30,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img1.png\"]',1,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(31,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img2.png\"]',2,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(32,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img3.png\"]',3,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(33,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img4.png\"]',4,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(34,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img5.png\"]',5,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(35,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img6.png\"]',6,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(36,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img7.png\"]',7,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(37,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img8.png\"]',8,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(38,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img9.png\"]',9,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(39,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img2.png\"]',10,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(40,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img4.png\"]',11,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(41,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img6.png\"]',12,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(42,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img9.png\"]',13,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(43,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img5.png\"]',14,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(44,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img3.png\"]',15,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(45,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img7.png\"]',16,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(46,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img9.png\"]',17,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(47,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img8.png\"]',18,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(48,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img9.png\"]',19,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(49,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img7.png\"]',20,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(50,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img3.png\"]',21,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(51,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img5.png\"]',22,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(52,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img8.png\"]',23,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(53,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img5.png\"]',24,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(54,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img8.png\"]',25,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(55,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img6.png\"]',26,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(56,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img7.png\"]',27,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(57,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img4.png\"]',28,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(58,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img7.png\"]',29,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(59,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img6.png\"]',30,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(60,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img5.png\"]',31,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(61,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img3.png\"]',32,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(62,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img7.png\"]',33,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(63,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img1.png\"]',34,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(64,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img8.png\"]',35,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(65,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img5.png\"]',36,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(66,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img5.png\"]',37,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(67,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img4.png\"]',38,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(68,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img6.png\"]',39,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(69,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img1.png\"]',40,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(70,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img8.png\"]',41,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(71,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img5.png\"]',42,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(72,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img3.png\"]',43,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(73,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img8.png\"]',44,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(74,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img6.png\"]',45,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(75,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img8.png\"]',46,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(76,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img9.png\"]',47,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(77,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img5.png\"]',48,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(78,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img7.png\"]',49,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(79,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img3.png\"]',50,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(80,'featured_image','[\"themes\\/jobzilla\\/jobs\\/img4.png\"]',51,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(81,'layout','[\"v2\"]',3,'Botble\\JobBoard\\Models\\Job','2025-12-23 19:31:45','2025-12-23 19:31:45'),(82,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',1,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:46','2025-12-23 19:31:46'),(83,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',2,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:46','2025-12-23 19:31:46'),(84,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',3,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:47','2025-12-23 19:31:47'),(85,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',4,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:47','2025-12-23 19:31:47'),(86,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',5,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:47','2025-12-23 19:31:47'),(87,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',6,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:47','2025-12-23 19:31:47'),(88,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',7,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:48','2025-12-23 19:31:48'),(89,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',8,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:48','2025-12-23 19:31:48'),(90,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',9,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:48','2025-12-23 19:31:48'),(91,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',10,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:48','2025-12-23 19:31:48'),(92,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',11,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:48','2025-12-23 19:31:48'),(93,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',12,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:49','2025-12-23 19:31:49'),(94,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',13,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:49','2025-12-23 19:31:49'),(95,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',14,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:49','2025-12-23 19:31:49'),(96,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',15,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:49','2025-12-23 19:31:49'),(97,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',16,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:50','2025-12-23 19:31:50'),(98,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',17,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:50','2025-12-23 19:31:50'),(99,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',18,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:50','2025-12-23 19:31:50'),(100,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',19,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:50','2025-12-23 19:31:50'),(101,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',20,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:51','2025-12-23 19:31:51'),(102,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',21,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:51','2025-12-23 19:31:51'),(103,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',22,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:51','2025-12-23 19:31:51'),(104,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',23,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:51','2025-12-23 19:31:51'),(105,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',24,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:52','2025-12-23 19:31:52'),(106,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',25,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:52','2025-12-23 19:31:52'),(107,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',26,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:52','2025-12-23 19:31:52'),(108,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',27,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:52','2025-12-23 19:31:52'),(109,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',28,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:52','2025-12-23 19:31:52'),(110,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',29,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:53','2025-12-23 19:31:53'),(111,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',30,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:53','2025-12-23 19:31:53'),(112,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',31,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:53','2025-12-23 19:31:53'),(113,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',32,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:53','2025-12-23 19:31:53'),(114,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',33,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:54','2025-12-23 19:31:54'),(115,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',34,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:54','2025-12-23 19:31:54'),(116,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',35,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:54','2025-12-23 19:31:54'),(117,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',36,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:54','2025-12-23 19:31:54'),(118,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',37,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:55','2025-12-23 19:31:55'),(119,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',38,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:55','2025-12-23 19:31:55'),(120,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',39,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:55','2025-12-23 19:31:55'),(121,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',40,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:55','2025-12-23 19:31:55'),(122,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',41,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:56','2025-12-23 19:31:56'),(123,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',42,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:56','2025-12-23 19:31:56'),(124,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',43,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:56','2025-12-23 19:31:56'),(125,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',44,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:56','2025-12-23 19:31:56'),(126,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',45,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:57','2025-12-23 19:31:57'),(127,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',46,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:57','2025-12-23 19:31:57'),(128,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',47,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:57','2025-12-23 19:31:57'),(129,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',48,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:57','2025-12-23 19:31:57'),(130,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',49,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:58','2025-12-23 19:31:58'),(131,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',50,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:58','2025-12-23 19:31:58'),(132,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',51,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:58','2025-12-23 19:31:58'),(133,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',52,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:58','2025-12-23 19:31:58'),(134,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',53,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:59','2025-12-23 19:31:59'),(135,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',54,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:59','2025-12-23 19:31:59'),(136,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',55,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:59','2025-12-23 19:31:59'),(137,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',56,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:31:59','2025-12-23 19:31:59'),(138,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',57,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:00','2025-12-23 19:32:00'),(139,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',58,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:00','2025-12-23 19:32:00'),(140,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',59,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:00','2025-12-23 19:32:00'),(141,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',60,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:00','2025-12-23 19:32:00'),(142,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',61,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:01','2025-12-23 19:32:01'),(143,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',62,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:01','2025-12-23 19:32:01'),(144,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',63,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:01','2025-12-23 19:32:01'),(145,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',64,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:01','2025-12-23 19:32:01'),(146,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',65,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:01','2025-12-23 19:32:01'),(147,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',66,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:02','2025-12-23 19:32:02'),(148,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',67,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:02','2025-12-23 19:32:02'),(149,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',68,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:02','2025-12-23 19:32:02'),(150,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',69,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:02','2025-12-23 19:32:02'),(151,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',70,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:03','2025-12-23 19:32:03'),(152,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',71,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:03','2025-12-23 19:32:03'),(153,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',72,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:03','2025-12-23 19:32:03'),(154,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',73,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:03','2025-12-23 19:32:03'),(155,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',74,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:04','2025-12-23 19:32:04'),(156,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',75,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:04','2025-12-23 19:32:04'),(157,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',76,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:04','2025-12-23 19:32:04'),(158,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',77,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:04','2025-12-23 19:32:04'),(159,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',78,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:05','2025-12-23 19:32:05'),(160,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',79,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:05','2025-12-23 19:32:05'),(161,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',80,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:05','2025-12-23 19:32:05'),(162,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',81,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:05','2025-12-23 19:32:05'),(163,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',82,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:06','2025-12-23 19:32:06'),(164,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',83,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:06','2025-12-23 19:32:06'),(165,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',84,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:06','2025-12-23 19:32:06'),(166,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',85,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:06','2025-12-23 19:32:06'),(167,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',86,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:07','2025-12-23 19:32:07'),(168,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',87,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:07','2025-12-23 19:32:07'),(169,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',88,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:07','2025-12-23 19:32:07'),(170,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',89,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:07','2025-12-23 19:32:07'),(171,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',90,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:08','2025-12-23 19:32:08'),(172,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',91,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:08','2025-12-23 19:32:08'),(173,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',92,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:08','2025-12-23 19:32:08'),(174,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',93,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:08','2025-12-23 19:32:08'),(175,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',94,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:09','2025-12-23 19:32:09'),(176,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover1.png\"]',95,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:09','2025-12-23 19:32:09'),(177,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',96,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:09','2025-12-23 19:32:09'),(178,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',97,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:09','2025-12-23 19:32:09'),(179,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',98,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:10','2025-12-23 19:32:10'),(180,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover2.png\"]',99,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:10','2025-12-23 19:32:10'),(181,'cover_image','[\"themes\\/jobzilla\\/accounts\\/cover3.png\"]',100,'Botble\\JobBoard\\Models\\Account','2025-12-23 19:32:10','2025-12-23 19:32:10');
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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'Homepage 1','<div>[hero-banner title=\"We Have {{208,000+}} Live Jobs\" subtitle=\"Your {{Dream Job}} in one place\" description=\"Find jobs that match your interests with us. Jobzilla provides a place you to find your Job.\" popular_searches=\"Developer;Designer;Architect;Engineer\" banner_1=\"themes/jobzilla/general/right-pic-1.jpg\" banner_2=\"themes/jobzilla/general/right-pic-2.jpg\" button_name=\"Get Started\" button_url=\"/\" bg_image_1=\"themes/jobzilla/general/bg2.jpg\" style=\"style-2\" quantity=\"3\" title_1=\"Companies Jobs\" count_1=\"12\" extra_1=\"K+\" image_1=\"themes/jobzilla/general/icon-4.png\" title_2=\"Job For Countries\" count_2=\"98\" extra_2=\"+\" image_2=\"themes/jobzilla/general/icon-5.png\" title_3=\"Jobs Done\" count_3=\"3\" extra_3=\"+\" image_3=\"themes/jobzilla/general/icon-3.png\" ][/hero-banner]</div><div>[job-board-search-bar title=\"\" tab_title=\"Trusted By:\" popular_searches=\"Developer;Designer;Architect;Engineer\" quantity=\"3\" link_1=\"https://google.com\" image_1=\"themes/jobzilla/general/trusted-1.png\" image_2=\"themes/jobzilla/general/trusted-2.png\" image_3=\"themes/jobzilla/general/trusted-3.png\" ][/job-board-search-bar]</div><div>[how-it-works title=\"How It Works\" subtitle=\"Follow our steps we will help you.\" check_list=\"Trusted & Quality Job;International Job;No Extra Charge;Top Companies\" style=\"style-2\" quantity=\"4\" title_1=\"Register Your Account\" subtitle_1=\"You need to create an account to find the best and preferred job.\" image_1=\"themes/jobzilla/general/icon1.png\" bg_color_1=\"#3898e2\" title_2=\"Search Your Job\" subtitle_2=\"You need to create an account to find the best and preferred job.\" image_2=\"themes/jobzilla/general/icon4.png\" bg_color_2=\"#e2b438\" title_3=\"Apply For Dream Job\" subtitle_3=\"You need to create an account to find the best and preferred job.\" image_3=\"themes/jobzilla/general/icon2.png\" bg_color_3=\"#bc84ca\" title_4=\"Upload Your Resume\" subtitle_4=\"You need to create an account to find the best and preferred job.\" image_4=\"themes/jobzilla/general/icon3.png\" bg_color_4=\"#56d8b1\" ][/how-it-works]</div><div>[featured-job-categories title=\"Choose Your Desire Category\" subtitle=\"Jobs by Categories\" description=\"Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took.\" style=\"style-2\" ][/featured-job-categories]</div><div>[explore-new-life title=\"For Employee\" subtitle=\"We help you connect with the organizer\" description=\"Get paid easily and security. Use our resources to become independent and showcase your professional skills.\" image=\"themes/jobzilla/general/gir-large-2.png\" button_url=\"/\" style=\"style-2\" quantity=\"3\" title_1=\"Million daily active users\" count_1=\"5\" extra_1=\"M+\" title_2=\"Open job positions\" count_2=\"9\" extra_2=\"K+\" title_3=\"Million stories shared\" count_3=\"2\" extra_3=\"M+\" ][/explore-new-life]</div><div>[jobs-list title=\"Find Your Career You Deserve it\" subtitle=\"All Jobs Post\" limit=\"6\" type=\"default\" style=\"2\" per_row=\"3\"][/jobs-list]</div><div>[explore-new-life title=\"Explore New Life\" subtitle=\"Build your personal account profile\" description=\"Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took. lorem Ipsum is simply dummy text of the printing and typesetting industry.\" image=\"themes/jobzilla/general/boy-large.png\" style=\"style-3\" ][/explore-new-life]</div><div>[testimonials title=\"What Our Customers Say About Us\" subtitle=\"Clients Testimonials\" style=\"style-2\" ][/testimonials]</div><div>[blog-posts title=\"Latest Article\" subtitle=\"Our Blogs\" number_of_displays=\"4\" style=\"style-2\" ][/blog-posts]</div>',1,NULL,'homepage',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(2,'Homepage 2','<div>[hero-banner title=\"FIND TOP IT JOBS\" subtitle=\"For talent Developers\" description=\"Type your keyword, then click search to find your perfect job.\" popular_searches=\"Developer;Designer;Architect;Engineer\" bg_image_1=\"themes/jobzilla/general/banner1.jpg\" gradient_text=\"7,000+ BROWSE JOBS\" style=\"style-3\" quantity=\"3\" title_1=\"Companies Jobs\" count_1=\"12\" extra_1=\"K+\" title_2=\"Job For Countries\" count_2=\"98\" extra_2=\"+\" title_3=\"Jobs Done\" count_3=\"3\" extra_3=\"+\" image_3=\"themes/jobzilla/general/icon-3.png\" ][/hero-banner]</div><div>[featured-companies title=\"Get hired in top companies\" subtitle=\"Top Companies\" style=\"style-2\" quantity=\"3\" title_1=\"Million daily active users\" count_1=\"5\" extra_1=\"M+\" title_2=\"Open job positions\" count_2=\"9\" extra_2=\"K+\" title_3=\"Million stories shared\" count_3=\"2\" extra_3=\"M+\" ][/featured-companies]</div><div>[how-it-works title=\"How It Works\" subtitle=\"Working Process\" style=\"style-3\" quantity=\"3\" title_1=\"Register Your Account\" subtitle_1=\"You need to create an account to find the best and preferred job.\" image_1=\"themes/jobzilla/general/icon1.png\" bg_color_1=\"#3898e2\" title_2=\"Apply For Dream Job\" subtitle_2=\"You need to create an account to find the best and preferred job.\" image_2=\"themes/jobzilla/general/icon2.png\" bg_color_2=\"#bc84ca\" title_3=\"Upload Your Resume\" subtitle_3=\"You need to create an account to find the best and preferred job.\" image_3=\"themes/jobzilla/general/icon3.png\" bg_color_3=\"#56d8b1\" ][/how-it-works]</div><div>[job-board-cities title=\"Featured Cities\" subtitle=\"Browse job offers by popular locations\"  city_ids=\"\"][/job-board-cities]</div><div>[jobs-list title=\"Find Your Career You Deserve it\" subtitle=\"All Jobs Post\" limit=\"4\" type=\"default\" style=\"2\" per_row=\"2\"][/jobs-list]</div><div>[job-board-candidates title=\"Candidates\" subtitle=\"Featured Candidates\" style=\"style-1\" layout=\"list-2\" ][/job-board-candidates]</div><div>[blog-posts title=\"Latest Article\" subtitle=\"Our Blogs\" number_of_displays=\"3\" style=\"style-3\" ][/blog-posts]</div>',1,NULL,'homepage',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(3,'Homepage 3','<div>[hero-banner title=\"We Have {{208,000+}} Live Jobs\" subtitle=\"Find the {{job}} that fits your life\" description=\"Type your keyword, then click search to find your perfect job.\" popular_searches=\"Developer;Designer;Architect;Engineer\" banner_1=\"themes/jobzilla/general/r-img2.png\" banner_2=\"themes/jobzilla/general/r-img1.png\" bg_image_1=\"themes/jobzilla/general/bg1.jpg\" gradient_text=\"Jobs\" style=\"style-1\" quantity=\"3\" title_1=\"Companies Jobs\" count_1=\"12\" extra_1=\"K+\" image_1=\"themes/jobzilla/general/icon-2.png\" title_2=\"Job For Countries\" count_2=\"98\" extra_2=\"+\" image_2=\"themes/jobzilla/general/icon-1.png\" title_3=\"Jobs Done\" count_3=\"3\" extra_3=\"+\" image_3=\"themes/jobzilla/general/icon-3.png\" ][/hero-banner]</div><div>[how-it-works title=\"How It Works\" subtitle=\"Working Process\" style=\"style-1\" quantity=\"3\" title_1=\"Register Your Account\" subtitle_1=\"You need to create an account to find the best and preferred job.\" image_1=\"themes/jobzilla/general/icon1.png\" bg_color_1=\"#3898e2\" title_2=\"Apply For Dream Job\" subtitle_2=\"You need to create an account to find the best and preferred job.\" image_2=\"themes/jobzilla/general/icon2.png\" bg_color_2=\"#bc84ca\" title_3=\"Upload Your Resume\" subtitle_3=\"You need to create an account to find the best and preferred job.\" image_3=\"themes/jobzilla/general/icon3.png\" bg_color_3=\"#56d8b1\" ][/how-it-works]</div><div>[featured-job-categories title=\"Choose Your Desire Category\" subtitle=\"Jobs by Categories\" description=\"Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took.\" style=\"style-1\" ][/featured-job-categories]</div><div>[explore-new-life title=\"Explore New Life\" subtitle=\"Don’t just find be found put your CV in front of great employers\" description=\"Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took.\" image=\"themes/jobzilla/general/gir-large.png\" bg_image=\"themes/jobzilla/general/bg.png\" button_url=\"/\" button_name=\"Upload Your Resume\" button_icon=\"feather-upload\" style=\"style-1\" ][/explore-new-life]</div><div>[featured-companies title=\"Get hired in top companies\" subtitle=\"Top Companies\" style=\"style-1\" quantity=\"3\" title_1=\"Million daily active users\" count_1=\"5\" extra_1=\"M+\" title_2=\"Open job positions\" count_2=\"9\" extra_2=\"K+\" title_3=\"Million stories shared\" count_3=\"2\" extra_3=\"M+\" ][/featured-companies]</div><div>[jobs-list title=\"Find Your Career You Deserve it\" subtitle=\"All Jobs Post\" limit=\"5\" type=\"default\" style=\"1\"][/jobs-list]</div><div>[testimonials title=\"What Our Customers Say About Us\" subtitle=\"Clients Testimonials\" style=\"style-1\" ][/testimonials]</div><div>[blog-posts title=\"Latest Article\" subtitle=\"Our Blogs\" number_of_displays=\"4\" style=\"style-1\" ][/blog-posts]</div>',1,NULL,'homepage',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(4,'Homepage 4','<div>[hero-banner title=\"\" subtitle=\"Your {{Dream Job}} in one place\" description=\"Find jobs that match your interests with us.\" popular_searches=\"Developer;Designer;Architect;Engineer\" banner_1=\"themes/jobzilla/general/user.png\" style=\"style-4\" ][/hero-banner]</div><div>[featured-job-categories title=\"Choose Your Desire Category\" subtitle=\"Jobs by Categories\" description=\"Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took.\" style=\"style-3\" ][/featured-job-categories]</div><div>[how-it-works title=\"How It Works\" subtitle=\"Follow our steps we will help you.\" check_list=\"Trusted & Quality Job;International Job;No Extra Charge;Top Companies\" image=\"themes/jobzilla/general/main-bg.png\" style=\"style-4\" quantity=\"4\" title_1=\"Register Your Account\" subtitle_1=\"You need to create an account to find the best and preferred job.\" image_1=\"themes/jobzilla/general/icon1.png\" bg_color_1=\"#3898e2\" title_2=\"Search Your Job\" subtitle_2=\"You need to create an account to find the best and preferred job.\" image_2=\"themes/jobzilla/general/icon4.png\" bg_color_2=\"#e2b438\" title_3=\"Apply For Dream Job\" subtitle_3=\"You need to create an account to find the best and preferred job.\" image_3=\"themes/jobzilla/general/icon2.png\" bg_color_3=\"#bc84ca\" title_4=\"Upload Your Resume\" subtitle_4=\"You need to create an account to find the best and preferred job.\" image_4=\"themes/jobzilla/general/icon3.png\" bg_color_4=\"#56d8b1\" ][/how-it-works]</div><div>[featured-companies title=\"Get hired in top companies\" subtitle=\"Top Companies\" style=\"style-3\" quantity=\"3\" title_1=\"Million daily active users\" count_1=\"5\" extra_1=\"M+\" title_2=\"Open job positions\" count_2=\"9\" extra_2=\"K+\" title_3=\"Million stories shared\" count_3=\"2\" extra_3=\"M+\" ][/featured-companies]</div><div>[explore-new-life title=\"About\" subtitle=\"We help you connect with the organizer\" description=\"Get paid easily and security. Use our resources to become independent and showcase your professional skills.\" image=\"themes/jobzilla/general/employee.png\" button_url=\"/\" style=\"style-4\" quantity=\"3\" title_1=\"Million daily active users\" count_1=\"5\" extra_1=\"M+\" title_2=\"Open job positions\" count_2=\"9\" extra_2=\"K+\" title_3=\"Million stories shared\" count_3=\"2\" extra_3=\"M+\" ][/explore-new-life]</div><div>[jobs-list title=\"Find Your Career You Deserve it\" subtitle=\"All Jobs Post\" limit=\"6\" type=\"default\" style=\"3\" per_row=\"3\"][/jobs-list]</div><div>[quotation title=\"Choose Your Plan\" subtitle=\"Save up to 10%\" recommended=\"2\" style=\"style-1\" quantity=\"3\" title_1=\"Basic\" subtitle_1=\"\" monthly_price_1=\"$90\" annual_price_1=\"$149\" link_1=\"/\" checked_1=\"1 job posting\" uncheck_1=\"0 featured job;job displayed fo 20 days;Premium support 24/7\" title_2=\"Standard\" subtitle_2=\"\" monthly_price_2=\"$248\" annual_price_2=\"$499\" link_2=\"/\" checked_2=\"1 job posting;0 featured job;job displayed fo 20 days\" uncheck_2=\"Premium support 24/7\" title_3=\"Extended\" subtitle_3=\"\" monthly_price_3=\"$499\" annual_price_3=\"$1499\" link_3=\"/\" checked_3=\"1 job posting;0 featured job;job displayed fo 20 days;Premium support 24/7\" ][/quotation]</div>',1,NULL,'homepage',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(5,'Blog','---',1,NULL,'blog-sidebar',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(6,'Contact','<div>[contact-form title=\"Send Us a Message\" subtitle=\"Feel free to contact us and we will get back to you as soon as we can.\" address_title=\"In the bay area?\" address_1=\"1363-1385 Sunset Blvd Los Angeles, CA 90026, USA\" address_2=\"\" phone_title=\"Feel free to contact us\" phone_1=\"+2 900 234 4241\" phone_2=\"+2 900 234 3219\" email_title=\"Support\" email_1=\"infohelp@gmail.com\" email_2=\"support12@gmail.com\" ][/contact-form]</div><div>[google-map]North Link Building, 10 Admiralty Street, 757695 Singapore[/google-map]</div>',1,NULL,'static',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(7,'Cookie Policy','<h3>EU Cookie Consent</h3><p>To use this website we are using Cookies and collecting some Data. To be compliant with the EU GDPR we give you to choose if you allow us to use certain Cookies and to collect some Data.</p><h4>Essential Data</h4><ul><li>The Essential Data is needed to run the Site you are visiting technically. You can not deactivate them.</li><li>Session Cookie: PHP uses a Cookie to identify user sessions. Without this Cookie the Website is not working.</li><li>XSRF-Token Cookie: Laravel automatically generates a CSRF \"token\" for each active user session managed by the application. This token is used to verify that the authenticated user is the one actually making the requests to the application.</li></ul>',1,NULL,'static',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(8,'FAQ','<div>[faq title=\"Frequently Asked Questions\"][/faq]</div>',1,NULL,'static',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(9,'About us','<div>[featured-job-categories title=\"Jobs by Categories\" subtitle=\"Choose Your Desire Category\" type=\"default\" style=\"style-2\"][/featured-job-categories]</div><div>[how-it-works title=\"How It Works\" subtitle=\"Follow our steps we will help you.\" check_list=\"Trusted & Quality Job;International Job;No Extra Charge;Top Companies\" style=\"style-2\" quantity=\"4\" title_1=\"Register Your Account\" subtitle_1=\"You need to create an account to find the best and preferred job.\" image_1=\"themes/jobzilla/general/icon1.png\" bg_color_1=\"#3898e2\" title_2=\"Search Your Job\" subtitle_2=\"You need to create an account to find the best and preferred job.\" image_2=\"themes/jobzilla/general/icon4.png\" bg_color_2=\"#e2b438\" title_3=\"Apply For Dream Job\" subtitle_3=\"You need to create an account to find the best and preferred job.\" image_3=\"themes/jobzilla/general/icon2.png\" bg_color_3=\"#bc84ca\" title_4=\"Upload Your Resume\" subtitle_4=\"You need to create an account to find the best and preferred job.\" image_4=\"themes/jobzilla/general/icon3.png\" bg_color_4=\"#56d8b1\" ][/how-it-works]</div><div>[explore-new-life title=\"Explore New Life\" subtitle=\"Don’t just find be found put your CV in front of great employers\" description=\"Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took.\" image=\"themes/jobzilla/general/gir-large.png\" bg_image=\"themes/jobzilla/general/bg-1.png\" button_url=\"/\" button_name=\"Upload Your Resume\" button_icon=\"feather-upload\" style=\"style-1\" ][/explore-new-life]</div><div>[featured-companies title=\"Get hired in top companies\" subtitle=\"Top Companies\" type=\"default\" style=\"style-1\" quantity=\"6\" ][/featured-companies]</div>',1,NULL,'static',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(10,'Terms Of Use','<p>Queen\'s shrill cries to the other, trying every door, she ran with all their simple joys, remembering her own courage. \'It\'s no business there, at any rate,\' said Alice: \'allow me to sell you a couple?\' \'You are not the same, the next moment she appeared on the ground near the right way of nursing it, (which was to get through the door, and knocked. \'There\'s no such thing!\' Alice was soon submitted to by the soldiers, who of course you know about it, you know.\' \'Not at all,\' said the Gryphon.</p><p>Queen, stamping on the back. However, it was not otherwise than what it might tell her something worth hearing. For some minutes it puffed away without speaking, but at any rate: go and live in that ridiculous fashion.\' And he got up this morning, but I shall never get to the game, feeling very curious to know your history, you know,\' said the King, \'that saves a world of trouble, you know, upon the other side of the goldfish kept running in her own mind (as well as the doubled-up soldiers.</p><p>Queen. An invitation for the first sentence in her brother\'s Latin Grammar, \'A mouse--of a mouse--to a mouse--a mouse--O mouse!\') The Mouse did not like the look of it in less than no time to wash the things I used to know. Let me see: I\'ll give them a new pair of gloves and the Hatter was the King; and as for the hedgehogs; and in despair she put one arm out of sight: \'but it seems to suit them!\' \'I haven\'t the slightest idea,\' said the Cat. \'I don\'t know of any use, now,\' thought poor Alice.</p><p>There was a little while, however, she went on. \'Would you tell me, Pat, what\'s that in the air. Even the Duchess to play with, and oh! ever so many out-of-the-way things had happened lately, that Alice had been all the same, the next witness. It quite makes my forehead ache!\' Alice watched the White Rabbit returning, splendidly dressed, with a growl, And concluded the banquet--] \'What IS a Caucus-race?\' said Alice; \'I might as well wait, as she spoke, but no result seemed to be talking in his.</p>',1,NULL,'static',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(11,'Terms &amp; Conditions','<p>Nile On every golden scale! \'How cheerfully he seems to like her, down here, that I should understand that better,\' Alice said to herself, \'I don\'t think they play at all a proper way of expressing yourself.\' The baby grunted again, so that it was empty: she did not at all a pity. I said \"What for?\"\' \'She boxed the Queen\'s shrill cries to the garden at once; but, alas for poor Alice! when she had been wandering, when a sharp hiss made her feel very queer indeed:-- \'\'Tis the voice of thunder.</p><p>Alice began to feel very uneasy: to be in before the trial\'s over!\' thought Alice. The King and Queen of Hearts, and I had it written up somewhere.\' Down, down, down. Would the fall was over. Alice was a table, with a sigh: \'he taught Laughing and Grief, they used to call him Tortoise, if he were trying which word sounded best. Some of the country is, you see, as well as I was a dead silence instantly, and Alice was not easy to take out of a dance is it?\' \'Why,\' said the King: \'leave out that.</p><p>Alice, \'it\'s very easy to take out of it, and found that, as nearly as she couldn\'t answer either question, it didn\'t sound at all the jurymen on to her ear. \'You\'re thinking about something, my dear, I think?\' \'I had NOT!\' cried the Mock Turtle Soup is made from,\' said the Cat; and this time with the clock. For instance, suppose it doesn\'t understand English,\' thought Alice; \'but a grin without a porpoise.\' \'Wouldn\'t it really?\' said Alice in a hoarse growl, \'the world would go round a deal.</p><p>However, I\'ve got to grow here,\' said the White Rabbit blew three blasts on the ground near the right thing to get through was more and more puzzled, but she had not got into it), and sometimes she scolded herself so severely as to go with Edgar Atheling to meet William and offer him the crown. William\'s conduct at first was in a more subdued tone, and everybody else. \'Leave off that!\' screamed the Gryphon. \'Do you take me for a dunce? Go on!\' \'I\'m a poor man,\' the Hatter hurriedly left the.</p>',1,NULL,'static',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(12,'Job Categories','<div>[job-categories title=\"Job Categories\" subtitle=\"All categories\" per_page=\"15\"][/job-categories]</div>',1,NULL,'static',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(13,'Companies','<div>[job-companies style=\"grid\"][/job-companies]</div>',1,NULL,'static',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(14,'Coming Soon','<div>[coming-soon title=\"Coming Soon !\" subtitle=\"We’re doing something amazing almost done...\" date=\"2026-01-24\" time=\"00:00\" bg_image=\"themes/jobzilla/general/bg-3.jpg\"][/coming-soon]</div>',1,NULL,'coming-soon',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(15,'Candidates','<div>[job-board-candidates style=\"grid\" layout=\"grid\" order_by=\"default\"][/job-board-candidates]</div>',1,NULL,'static',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(16,'Jobs','<div>[job-board-jobs limit=\"16\"][/job-board-jobs]</div>',1,NULL,'static',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(17,'Jobs Grid with Map','<div>[job-board-jobs style=\"list-with-map\" layout=\"grid-2\"][/job-board-jobs]</div>',1,NULL,'default',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(18,'Jobs List','<div>[job-board-jobs style=\"list\" layout=\"list\"][/job-board-jobs]</div>',1,NULL,'default',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(19,'Homepage 4','<div>[hero-banner title=\"\" subtitle=\"Your {{Dream Job}} in one place\" description=\"Find jobs that match your interests with us.\" popular_searches=\"Developer;Designer;Architect;Engineer\" banner_1=\"themes/jobzilla/general/user.png\" style=\"style-4\" ][/hero-banner]</div><div>[featured-job-categories title=\"Choose Your Desire Category\" subtitle=\"Jobs by Categories\" description=\"Lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since the when an printer took.\" style=\"style-3\" ][/featured-job-categories]</div><div>[how-it-works title=\"How It Works\" subtitle=\"Follow our steps we will help you.\" check_list=\"Trusted & Quality Job;International Job;No Extra Charge;Top Companies\" image=\"themes/jobzilla/general/main-bg.png\" style=\"style-4\" quantity=\"4\" title_1=\"Register Your Account\" subtitle_1=\"You need to create an account to find the best and preferred job.\" image_1=\"themes/jobzilla/general/icon1.png\" bg_color_1=\"#3898e2\" title_2=\"Search Your Job\" subtitle_2=\"You need to create an account to find the best and preferred job.\" image_2=\"themes/jobzilla/general/icon4.png\" bg_color_2=\"#e2b438\" title_3=\"Apply For Dream Job\" subtitle_3=\"You need to create an account to find the best and preferred job.\" image_3=\"themes/jobzilla/general/icon2.png\" bg_color_3=\"#bc84ca\" title_4=\"Upload Your Resume\" subtitle_4=\"You need to create an account to find the best and preferred job.\" image_4=\"themes/jobzilla/general/icon3.png\" bg_color_4=\"#56d8b1\" ][/how-it-works]</div><div>[featured-companies title=\"Get hired in top companies\" subtitle=\"Top Companies\" style=\"style-3\" quantity=\"3\" title_1=\"Million daily active users\" count_1=\"5\" extra_1=\"M+\" title_2=\"Open job positions\" count_2=\"9\" extra_2=\"K+\" title_3=\"Million stories shared\" count_3=\"2\" extra_3=\"M+\" ][/featured-companies]</div><div>[explore-new-life title=\"About\" subtitle=\"We help you connect with the organizer\" description=\"Get paid easily and security. Use our resources to become independent and showcase your professional skills.\" image=\"themes/jobzilla/general/employee.png\" button_url=\"/\" style=\"style-4\" quantity=\"3\" title_1=\"Million daily active users\" count_1=\"5\" extra_1=\"M+\" title_2=\"Open job positions\" count_2=\"9\" extra_2=\"K+\" title_3=\"Million stories shared\" count_3=\"2\" extra_3=\"M+\" ][/explore-new-life]</div><div>[job-board-jobs title=\"Find Your Career You Deserve it\" subtitle=\"All Jobs Post\" number_of_displays=\"6\" style=\"style-4\" layout=\"grid-3x\" ][/job-board-jobs]</div><div>[quotation title=\"Choose Your Plan\" subtitle=\"Save up to 10%\" recommended=\"2\" style=\"style-1\" quantity=\"3\" title_1=\"Basic\" subtitle_1=\"\" monthly_price_1=\"$90\" annual_price_1=\"$149\" link_1=\"/\" checked_1=\"1 job posting\" uncheck_1=\"0 featured job;job displayed fo 20 days;Premium support 24/7\" title_2=\"Standard\" subtitle_2=\"\" monthly_price_2=\"$248\" annual_price_2=\"$499\" link_2=\"/\" checked_2=\"1 job posting;0 featured job;job displayed fo 20 days\" uncheck_2=\"Premium support 24/7\" title_3=\"Extended\" subtitle_3=\"\" monthly_price_3=\"$499\" annual_price_3=\"$1499\" link_3=\"/\" checked_3=\"1 job posting;0 featured job;job displayed fo 20 days;Premium support 24/7\" ][/quotation]</div>',1,NULL,'homepage',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(20,'Homepage 5','<div>[hero-banner title=\"It’s Easy to Find Your {{ Dream Job }}\" subtitle=\"You dream job is waiting for you.\" banner_1=\"themes/jobzilla/general/r-pic1.png\" bg_image_1=\"themes/jobzilla/general/r-pic2.png\" bg_image_2=\"themes/jobzilla/general/r-pic3.png\" bg_image_3=\"themes/jobzilla/general/r-pic4.png\" style=\"style-5\" quantity=\"6\" title_1=\"Our More Candidates\" count_1=\"3\" extra_1=\"K+\" image_1=\"themes/jobzilla/general/icon-3.png\"][/hero-banner]</div><div>[featured-job-categories title=\"Browse By Category\" subtitle=\"Find the job that’s perfect for you.\" bg_image=\"themes/jobzilla/general/cate-bg.jpg\" type=\"default\" style=\"style-4\"][/featured-job-categories]</div><div>[job-of-the-days title=\"Job of the day\" subtitle=\"Connect with the right candidates faster.\" limit=\"6\"][/job-of-the-days]</div><div>[job-banner title=\"Find The One That’s Right For You\" subtitle=\"Millions of Jobs\" description=\"You need to create an account to find the best and preferred job. lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever since took.\" image=\"themes/jobzilla/general/main-pic.png\" count_job_available=\"45\" button_primary_label=\"Search Jobs\" button_primary_url=\"/jobs\" button_secondary_label=\"Learn more\" button_secondary_action=\"/jobs\"][/job-banner]</div><div>[counter-information bg_image=\"themes/jobzilla/general/ctr-bg.jpg\" quantity=\"4\" title_1=\"Completed Cases\" count_1=\"25\" extra_1=\"K+\" title_2=\"Our Office\" count_2=\"17\" extra_2=\"K+\" title_3=\"Skilled People\" count_3=\"86\" title_4=\"Happy Client\" count_4=\"28\"][/counter-information]</div><div>[top-companies title=\"Top Recruiters\" description=\"Discover your next career move\" limit=\"15\" button_action_label=\"View all\" button_action_url=\"/jobs\"][/top-companies]</div><div>[job-board-cities title=\"Find your favourite jobs and get.\" subtitle=\"Jobs by location\" city_ids=\"\" button_action_label=\"View all location\" button_action_url=\"jobs\" style=\"2\"][/job-board-cities]</div><div>[blog-posts title=\"News and Blogs\" subtitle=\"Get the latest news, updates and tips\" category_id=\"0\" type=\"default\" style=\"style-1\"][/blog-posts]</div><div>[newsletter-minimal title=\"Subscribe to Our Newsletter\" subtitle=\"Get the latest updates mailed to you\" bg_image=\"themes/jobzilla/general/dotted-map.png\" icon_image_1=\"themes/jobzilla/account-icons/pic1.jpg\" icon_image_2=\"themes/jobzilla/account-icons/pic2.jpg\" icon_image_3=\"themes/jobzilla/account-icons/pic3.jpg\" icon_image_4=\"themes/jobzilla/account-icons/pic4.jpg\" icon_image_5=\"themes/jobzilla/account-icons/pic5.jpg\" icon_image_6=\"themes/jobzilla/account-icons/pic6.jpg\" icon_image_7=\"themes/jobzilla/account-icons/pic7.jpg\"][/newsletter-minimal]</div>',1,NULL,'homepage',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(21,'Homepage 6','<div>[hero-banner title=\"Find Your Perfect {{ Job }} Platform\" subtitle=\" Stay connect to get upcoming job with {{ Jobzilla }}\" description=\"Explore all the most exciting job roles based on your interest and study major. your dream job is waiting for you.\" banner_1=\"themes/jobzilla/general/main-pic.png\" style=\"style-6\" quantity=\"3\" title_1=\"Upload CV\" image_1=\"themes/jobzilla/general/cv-icon.png\" title_2=\"People Got Hired\" count_2=\"25\" extra_2=\"K+\" image_2=\"themes/jobzilla/general/bag.png\" image_3=\"themes/jobzilla/general/pdf-file.png\"][/hero-banner]</div><div>[featured-job-categories title=\"Find the job that’s perfect for you.\" subtitle=\"Browse By Category\" number_of_displays=\"10\" button_action_label=\"All Categories\" button_action_url=\"jobs\" type=\"default\" style=\"style-5\"][/featured-job-categories]</div><div>[job-banner title=\"Get World {{ 1500+ }} Talented People in one place\" subtitle=\"Get Jobs\" description=\"You need to create an account to find the best and preferred job. lorem Ipsum is simply dummy text of the printing and typesetting industry the standard dummy text ever took.\" title_company_slider=\"Trusted by more than {{ +100 companies }}\" image=\"themes/jobzilla/general/get-job-pic.png\" button_primary_label=\"About more\" button_primary_action=\"jobs\" style=\"style-2\"][/job-banner]</div><div>[featured-jobs title=\"Jobs Category\" subtitle=\"Featured Jobs\" limit=\"5\" image=\"themes/jobzilla/general/large-pic-1.png\" button_label=\"Show All Jobs\" button_action=\"jobs\"][/featured-jobs]</div><div>[counter-information title=\"Join our community of talented and professionals by applying for a job today!.\" subtitle=\"Our Community\" bg_image=\"themes/jobzilla/general/our-com-bg.jpg\" style=\"style-2\" quantity=\"4\" title_1=\"Completed Cases\" count_1=\"1590\" icon_1=\"flaticon-dashboard\" title_2=\"Our Office\" count_2=\"1740\" icon_2=\"flaticon-user\" title_3=\"Skilled People\" count_3=\"800\" icon_3=\"flaticon-hr\" title_4=\"Happy Client\" count_4=\"16\" icon_4=\"flaticon-note\"][/counter-information]</div><div>[testimonials title=\"Testimonials\" subtitle=\"Quotes from our customer about us\" description=\"You need to create an account to find the best and preferred job. lorem Ipsum is simply dummy text of the printing and typesetting the standard dummy text ever since the when an printer took.\" link=\"jobs\" text_link=\"Show All Quotes\" bg_color=\"#000\" icon_image=\"themes/jobzilla/general/dotted-block.png\" style=\"style-3\"][/testimonials]</div><div>[blog-posts title=\"Latest Blog\" subtitle=\"Our Regular Updated Blog Posts\" button_action_label=\"Explore All Blogs\" button_action_url=\"blog\" category_id=\"0\" type=\"default\" number_of_displays=\"8\" style=\"style-4\"][/blog-posts]</div><div>[newsletter-large title_primary=\"Get your {{ FREE }} web consultation\" subtitle_primary=\"Latest Blog\" title_secondary=\"Subscribe for free\" subtitle_secondary=\"Join our email subscription now to get updates on new jobs and notifications.\" phone=\" 555-281-5426\" email=\"contact@botble.com\"][/newsletter-large]</div>',1,NULL,'homepage',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(22,'Homepage 7','<div>[hero-banner title=\"FIND TOP IT {{JOBS}}\" subtitle=\"For talent Developers,\" browse_job=\"you deserve!\" description=\"Type your keyword, then click search to find your perfect job.\" bg_image_1=\"themes/jobzilla/general/h7-banner.jpg\" popular_searches=\"Developer;Designer;Architect;Engineer\" style=\"style-7\" quantity=\"3\"][/hero-banner]</div><div>[job-board-recommend title=\"Jobs Category\" subtitle=\"Recommended Jobs\" button_name=\"View ALL\" type=\"default\"][/job-board-recommend]</div><div>[how-to-get-your-job title=\"How to get your job\" subtitle=\"Build Your Personal Account Profile\" description=\"Create an account for job information that you wanted, get notification everyday and you can easily apply directly to the company you want create and account now for free.\" image=\"themes/jobzilla/general/hig-pic.png\" button_name=\"Edit Profile\" button_url=\"/\" icon=\"flaticon-bell\" icon_title=\"New Interview\" icon_subtitle=\"You has new interview today\" quantity=\"2\" title_1=\"Complete your profile\" subtitle_1=\"95% Completed\" image_1=\"themes/jobzilla/accounts/4.jpg\" site_button_title_1=\"Hire Me!\" site_button_link_1=\"/\" bg_color_1=\"#fff\" title_2=\"Complete your profile\" subtitle_2=\"95% Completed\" image_2=\"themes/jobzilla/accounts/2.jpg\" bg_color_2=\"#fff\"][/how-to-get-your-job]</div><div>[how-it-works title=\"Working Process\" subtitle=\"Follow Our Steps, We Will Help You\" bg_image=\"themes/jobzilla/general/hiw-bg.jpg\" style=\"style-7\" quantity=\"3\" title_1=\"Register Your Account\" subtitle_1=\"You need to create an account to find the best and preferred job.\" image_1=\"themes/jobzilla/general/icon1.png\" bg_color_1=\"cyan\" title_2=\"Apply For Dream Job\" subtitle_2=\"You need to create an account to find the best and preferred job.\" image_2=\"themes/jobzilla/general/icon2.png\" bg_color_2=\"violet\" title_3=\"Upload Your Resume\" subtitle_3=\"You need to create an account to find the best and preferred job.\" image_3=\"themes/jobzilla/general/icon4.png\" bg_color_3=\"yellow\"][/how-it-works]</div><div>[job-board-candidates title=\"Candidates\" subtitle=\"Featured Candidates\" bg_image=\"themes/jobzilla/general/bg-pattern-can.png\" bg_map_image=\"themes/jobzilla/general/ofr-bg.jpg\" map_title=\"We also have {{job offers}} in other countries\" map_image=\"themes/jobzilla/general/map-img.png\" style=\"style-7\" layout=\"list-7\" order_by=\"default\" quantity=\"6\" title_1=\"Americans\" image_1=\"themes/jobzilla/countries/americans.jpg\" title_2=\"Denmark\" image_2=\"themes/jobzilla/countries/denmark.jpg\" title_3=\"France\" image_3=\"themes/jobzilla/countries/france.jpg\" title_4=\"United Kingdom\" image_4=\"themes/jobzilla/countries/united-kingdom.jpg\"][/job-board-candidates]</div><div>[featured-companies title=\"Top Companies\" subtitle=\"Get hired in top companies\" type=\"featured\" style=\"style-7\" quantity=\"3\" title_1=\"Million daily active users\" count_1=\"5\" extra_1=\"M+\" title_2=\"Open job positions\" count_2=\"9\" extra_2=\"K+\" title_3=\"Million stories shared\" count_3=\"2\" extra_3=\"M+\"][/featured-companies]</div><div>[blog-posts title=\"Our Blogs\" subtitle=\"Latest Article\" category_id=\"0\" type=\"default\" style=\"style-7\"][/blog-posts]</div><div>[testimonials title=\"Testimonials\" subtitle=\"Jobseeker reviews through {{Jobzilla}}\" testimonial_outline_text=\"Testimonials\" bg_color=\"#000\" style=\"style-7\"][/testimonials]</div>',1,NULL,'homepage',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(23,'Homepage 8','<div>[hero-banner title=\"GOT TALENT?\" subtitle=\"MEET OPPORTUNITY\" description=\"Over {{1800+}} jobs are waiting for you\" gradient_text=\"Jobs\" banner_1=\"themes/jobzilla/general/bnr-right-pic.png\" bg_image_1=\"themes/jobzilla/general/h8-banner.jpg\" popular_searches=\"Developer;Designer;Architect;Engineer\" style=\"style-8\" quantity=\"3\"][/hero-banner]</div><div>[featured-job-categories title=\"Jobs at a glance\" subtitle=\"Jobs at a glance\" type=\"default\" style=\"style-6\"][/featured-job-categories]</div><div>[job-of-the-days title=\"Job of the day\" subtitle=\"Connect with the right candidates faster.\" limit=\"6\" button_name=\"View All\"][/job-of-the-days]</div><div>[featured-companies title=\"Get hired in top companies\" subtitle=\"Top Companies\" type=\"featured\" style=\"style-8\" quantity=\"3\" title_1=\"Million daily active users\" count_1=\"5\" extra_1=\"M+\" title_2=\"Open job positions\" count_2=\"9\" extra_2=\"K+\" title_3=\"Million stories shared\" count_3=\"2\" extra_3=\"M+\"][/featured-companies]</div><div>[how-to-get-your-job title=\"How to get your job\" subtitle=\"Build Your Personal Account Profile\" description=\"Create an account for job information that you wanted, get notification everyday and you can easily apply directly to the company you want create and account now for free.\" image=\"themes/jobzilla/general/hig-pic2.png\" button_name=\"Edit Profile\" button_url=\"/\" icon=\"flaticon-bell\" icon_title=\"New Interview\" icon_subtitle=\"You has new interview today\" quantity=\"2\" title_1=\"Complete your profile\" subtitle_1=\"95% Completed\" image_1=\"themes/jobzilla/accounts/4.jpg\" site_button_title_1=\"Hire Me!\" site_button_link_1=\"/\" bg_color_1=\"#fff\" title_2=\"Complete your profile\" subtitle_2=\"95% Completed\" image_2=\"themes/jobzilla/accounts/2.jpg\" bg_color_2=\"#fff\"][/how-to-get-your-job]</div><div>[testimonials title=\"Testimonials\" subtitle=\"Jobseeker reviews through Jobzilla.\" testimonial_outline_text=\"Jobseeker\" bg_color=\"#fff\" banner_image=\"themes/jobzilla/general/testimonial-3d-pic.png\" style=\"style-8\"][/testimonials]</div><div>[quotation title=\"Choose Your Plan\" subtitle=\"Save up to 10%\" recommended=\"2\" style=\"style-1\" quantity=\"3\" title_1=\"Basic\" subtitle_1=\"\" monthly_price_1=\"$90\" annual_price_1=\"$149\" link_1=\"/\" checked_1=\"1 job posting\" uncheck_1=\"0 featured job;job displayed fo 20 days;Premium support 24/7\" title_2=\"Standard\" subtitle_2=\"\" monthly_price_2=\"$248\" annual_price_2=\"$499\" link_2=\"/\" checked_2=\"1 job posting;0 featured job;job displayed fo 20 days\" uncheck_2=\"Premium support 24/7\" title_3=\"Extended\" subtitle_3=\"\" monthly_price_3=\"$499\" annual_price_3=\"$1499\" link_3=\"/\" checked_3=\"1 job posting;0 featured job;job displayed fo 20 days;Premium support 24/7\" ][/quotation]</div><div>[blog-posts title=\"News and Blogs\" subtitle=\"Get the latest news, updates and tips\" category_id=\"0\" type=\"default\" style=\"style-8\"][/blog-posts]</div>',1,NULL,'homepage',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36'),(24,'Pricing','<div>[packages title=\"Choose Your Plan\" subtitle=\"Save up to 10%\" package_ids=\"1,2,3\"][/packages]</div>',1,NULL,'static',NULL,'published','2025-12-23 19:31:36','2025-12-23 19:31:36');
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
INSERT INTO `post_categories` VALUES (6,1),(1,1),(1,2),(2,2),(5,3),(6,3),(8,4),(7,4),(8,5),(6,6),(8,6),(4,7),(3,7),(6,8),(6,9),(8,9),(6,10),(5,10),(5,11),(1,11),(3,12),(8,12),(7,13),(1,13),(1,14),(8,14),(1,15),(5,15),(4,16),(1,16),(4,17),(3,17),(5,18),(8,18),(4,19),(5,19),(8,20),(4,20);
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
INSERT INTO `post_tags` VALUES (7,1),(6,1),(1,1),(7,2),(2,2),(6,2),(2,3),(1,3),(6,3),(4,4),(3,4),(2,5),(3,5),(4,5),(7,6),(4,6),(5,6),(2,7),(5,7),(8,8),(1,8),(5,8),(6,9),(3,9),(1,9),(1,10),(8,10),(7,10),(8,11),(7,11),(2,11),(5,12),(1,12),(7,12),(6,13),(4,13),(5,14),(8,14),(7,15),(6,15),(4,15),(8,16),(1,16),(2,16),(1,17),(8,17),(2,17),(6,18),(4,18),(8,18),(8,19),(1,19),(7,19),(8,20),(3,20);
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,'Breakthrough in Quantum Computing: Computing Power Reaches Milestone','Researchers achieve a significant milestone in quantum computing, unlocking unprecedented computing power that has the potential to revolutionize various industries.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>TRUE--\" that\'s the jury-box,\' thought Alice, \'they\'re sure to make out which were the verses to himself: \'\"WE KNOW IT TO BE TRUE--\" that\'s the jury, and the Dormouse again, so violently, that she might as well say this), \'to go on in the direction it pointed to, without trying to fix on one, the cook tulip-roots instead of onions.\' Seven flung down his brush, and had to pinch it to make out who was peeping anxiously into its face in her hands, and was immediately suppressed by the Queen jumped up on tiptoe, and peeped over the jury-box with the birds hurried off at once, while all the jelly-fish out of its mouth, and its great eyes half shut. This seemed to be sure! However, everything is queer to-day.\' Just then her head to keep herself from being run over; and the Hatter were having tea at it: a Dormouse was sitting on the breeze that followed them, the melancholy words:-- \'Soo--oop of the table, but there were three little sisters,\' the Dormouse indignantly. However, he consented.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/4-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>King. \'Nothing whatever,\' said Alice. \'Oh, don\'t bother ME,\' said Alice in a large cauldron which seemed to her ear. \'You\'re thinking about something, my dear, and that if you could manage it?) \'And what an ignorant little girl or a worm. The question is, what?\' The great question is, Who in the middle, nursing a baby; the cook was leaning over the jury-box with the game,\' the Queen shouted at the top of his teacup and bread-and-butter, and then raised himself upon tiptoe, put his mouth close.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/6-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I\'ll get into her eyes--and still as she could, and waited to see you again, you dear old thing!\' said Alice, as she remembered having seen such a nice soft thing to eat or drink under the door; so either way I\'ll get into that lovely garden. I think I must sugar my hair.\" As a duck with its tongue hanging out of sight: then it watched the Queen ordering off her head!\' about once in a low curtain she had known them all her knowledge of history, Alice had no reason to be almost out of its mouth, and its great eyes half shut. This seemed to be lost, as she went on to himself as he spoke, and then another confusion of voices--\'Hold up his head--Brandy now--Don\'t choke him--How was it, old fellow? What happened to me! When I used to queer things happening. While she was beginning very angrily, but the wise little Alice and all would change to tinkling sheep-bells, and the little golden key, and Alice\'s elbow was pressed hard against it, that attempt proved a failure. Alice heard the.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/14-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>So she began: \'O Mouse, do you want to stay with it as you can--\' \'Swim after them!\' screamed the Gryphon. Alice did not at all fairly,\' Alice began, in a shrill, passionate voice. \'Would YOU like cats if you cut your finger VERY deeply with a trumpet in one hand and a pair of gloves and the three gardeners instantly jumped up, and began to cry again, for this time the Queen jumped up in a hurry: a large crowd collected round it: there was no more to come, so she tried to curtsey as she went back for a little hot tea upon its forehead (the position in which you usually see Shakespeare, in the night? Let me see--how IS it to be a LITTLE larger, sir, if you cut your finger VERY deeply with a sigh: \'he taught Laughing and Grief, they used to read fairy-tales, I fancied that kind of thing that would be wasting our breath.\" \"I\'ll be judge, I\'ll be jury,\" Said cunning old Fury: \"I\'ll try the thing yourself, some winter day, I will prosecute YOU.--Come, I\'ll take no denial; We must have a.</p>','published',1,'Botble\\ACL\\Models\\User',1,'themes/jobzilla/news/1.jpg',2162,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(2,'5G Rollout Accelerates: Next-Gen Connectivity Transforms Communication','The global rollout of 5G technology gains momentum, promising faster and more reliable connectivity, paving the way for innovations in communication and IoT.','<p>I shall fall right THROUGH the earth! How funny it\'ll seem to put down yet, before the officer could get to twenty at that rate! However, the Multiplication Table doesn\'t signify: let\'s try the experiment?\' \'HE might bite,\' Alice cautiously replied, not feeling at all a proper way of expecting nothing but the Dormouse followed him: the March Hare. Alice sighed wearily. \'I think I may as well say,\' added the Queen. An invitation for the next verse.\' \'But about his toes?\' the Mock Turtle, \'Drive on, old fellow! Don\'t be all day to such stuff? Be off, or I\'ll kick you down stairs!\' \'That is not said right,\' said the Queen, stamping on the floor, and a scroll of parchment in the pictures of him), while the rest of the doors of the way--\' \'THAT generally takes some time,\' interrupted the Hatter: \'let\'s all move one place on.\' He moved on as he spoke, and the Queen\'s ears--\' the Rabbit asked. \'No, I give you fair warning,\' shouted the Queen. \'It proves nothing of the ground--and I should.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/1-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>CHAPTER VIII. The Queen\'s argument was, that she was now the right word) \'--but I shall be a letter, after all: it\'s a set of verses.\' \'Are they in the pool, and the two creatures got so much already, that it felt quite relieved to see what would happen next. \'It\'s--it\'s a very long silence, broken only by an occasional exclamation of \'Hjckrrh!\' from the trees as well as if she had felt quite relieved to see that she tipped over the fire, and at last she spread out her hand, watching the.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/8-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Gryphon. \'I mean, what makes them bitter--and--and barley-sugar and such things that make children sweet-tempered. I only wish they COULD! I\'m sure _I_ shan\'t be beheaded!\' said Alice, feeling very curious sensation, which puzzled her too much, so she took courage, and went back to the waving of the sort!\' said Alice. \'Call it what you mean,\' said Alice. \'You are,\' said the Cat, \'if you only walk long enough.\' Alice felt that it would like the look of it now in sight, and no one listening, this time, as it went. So she sat down again into its eyes were looking up into the roof off.\' After a while she ran, as well go back, and see what would happen next. The first question of course was, how to speak good English); \'now I\'m opening out like the Mock Turtle replied; \'and then the Rabbit\'s voice; and Alice was only sobbing,\' she thought, \'it\'s sure to happen,\' she said to Alice; and Alice guessed who it was, and, as a cushion, resting their elbows on it, and kept doubling itself up and.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/13-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Hatter, \'I cut some more tea,\' the March Hare. The Hatter opened his eyes very wide on hearing this; but all he SAID was, \'Why is a very long silence, broken only by an occasional exclamation of \'Hjckrrh!\' from the trees as well go in ringlets at all; and I\'m I, and--oh dear, how puzzling it all seemed quite natural); but when the Rabbit noticed Alice, as she fell very slowly, for she was now the right height to rest herself, and once she remembered that she had plenty of time as she swam nearer to watch them, and the other side of WHAT? The other guests had taken advantage of the words all coming different, and then hurried on, Alice started to her great delight it fitted! Alice opened the door began sneezing all at once. \'Give your evidence,\' said the Cat, as soon as look at me like a wild beast, screamed \'Off with his tea spoon at the top of her favourite word \'moral,\' and the Panther received knife and fork with a table in the long hall, and close to her great disappointment it.</p>','published',1,'Botble\\ACL\\Models\\User',1,'themes/jobzilla/news/2.jpg',2163,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(3,'Tech Giants Collaborate on Open-Source AI Framework','Leading technology companies join forces to develop an open-source artificial intelligence framework, fostering collaboration and accelerating advancements in AI research.','<p>Alice, who felt ready to make personal remarks,\' Alice said very politely, \'for I can\'t see you?\' She was close behind us, and he\'s treading on her hand, watching the setting sun, and thinking of little cartwheels, and the constant heavy sobbing of the water, and seemed not to be Number One,\' said Alice. \'Then you shouldn\'t talk,\' said the Dodo had paused as if nothing had happened. \'How am I to get in?\' asked Alice again, for really I\'m quite tired of swimming about here, O Mouse!\' (Alice thought this must ever be A secret, kept from all the jurymen on to the beginning again?\' Alice ventured to ask. \'Suppose we change the subject of conversation. \'Are you--are you fond--of--of dogs?\' The Mouse did not wish to offend the Dormouse said--\' the Hatter grumbled: \'you shouldn\'t have put it to his son, \'I feared it might appear to others that what you had been anything near the entrance of the hall; but, alas! either the locks were too large, or the key was too late to wish that! She went.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/1-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Queen, \'and he shall tell you what year it is?\' \'Of course not,\' Alice replied very gravely. \'What else had you to set about it; and the White Rabbit read:-- \'They told me you had been looking at Alice for some time busily writing in his confusion he bit a large fan in the lap of her or of anything to put everything upon Bill! I wouldn\'t say anything about it, even if I shall only look up in spite of all the other two were using it as far down the chimney?--Nay, I shan\'t! YOU do it!--That I.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/6-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Dodo. Then they both cried. \'Wake up, Alice dear!\' said her sister; \'Why, what are YOUR shoes done with?\' said the King: \'leave out that the pebbles were all ornamented with hearts. Next came the royal children, and everybody else. \'Leave off that!\' screamed the Queen. \'You make me grow smaller, I suppose.\' So she sat still and said to herself; \'his eyes are so VERY tired of being such a new pair of boots every Christmas.\' And she began very cautiously: \'But I don\'t like the name: however, it only grinned when it grunted again, and went on again:-- \'I didn\'t know that Cheshire cats always grinned; in fact, a sort of idea that they couldn\'t get them out of a globe of goldfish she had quite forgotten the Duchess was VERY ugly; and secondly, because she was out of the sort,\' said the King, looking round the thistle again; then the different branches of Arithmetic--Ambition, Distraction, Uglification, and Derision.\' \'I never thought about it,\' added the Dormouse, who seemed to be.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/14-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Pigeon in a day is very confusing.\' \'It isn\'t,\' said the Eaglet. \'I don\'t see any wine,\' she remarked. \'It tells the day and night! You see the Queen. \'Can you play croquet?\' The soldiers were always getting up and say \"How doth the little--\"\' and she jumped up and straightening itself out again, and put it into one of the suppressed guinea-pigs, filled the air, and came back again. \'Keep your temper,\' said the Caterpillar. \'I\'m afraid I\'ve offended it again!\' For the Mouse was speaking, so that her shoulders were nowhere to be rude, so she went out, but it all came different!\' Alice replied very politely, \'if I had our Dinah here, I know who I am! But I\'d better take him his fan and two or three of her favourite word \'moral,\' and the other paw, \'lives a Hatter: and in another moment, when she was trying to touch her. \'Poor little thing!\' said Alice, rather doubtfully, as she could, \'If you didn\'t like cats.\' \'Not like cats!\' cried the Gryphon, sighing in his note-book, cackled out.</p>','published',1,'Botble\\ACL\\Models\\User',1,'themes/jobzilla/news/3.jpg',368,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(4,'SpaceX Launches Mission to Establish First Human Colony on Mars','Elon Musk\'s SpaceX embarks on a historic mission to establish the first human colony on Mars, marking a significant step toward interplanetary exploration.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Half-past one, time for dinner!\' (\'I only wish it was,\' he said. \'Fifteenth,\' said the King triumphantly, pointing to the executioner: \'fetch her here.\' And the Gryphon whispered in a sort of thing that would happen: \'\"Miss Alice! Come here directly, and get ready to ask any more HERE.\' \'But then,\' thought she, \'if people had all to lie down on her toes when they passed too close, and waving their forepaws to mark the time, while the Mock Turtle said: \'no wise fish would go through,\' thought poor Alice, \'it would have called him Tortoise because he was in March.\' As she said these words her foot as far down the chimney!\' \'Oh! So Bill\'s got to the heads of the house, and found herself falling down a very melancholy voice. \'Repeat, \"YOU ARE OLD, FATHER WILLIAM,\' to the other: he came trotting along in a piteous tone. And she began thinking over other children she knew the right words,\' said poor Alice, \'when one wasn\'t always growing larger and smaller, and being ordered about by mice.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/3-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Knave did so, very carefully, nibbling first at one corner of it: for she thought, \'till its ears have come, or at any rate,\' said Alice: \'she\'s so extremely--\' Just then she walked sadly down the chimney?--Nay, I shan\'t! YOU do it!--That I won\'t, then!--Bill\'s to go down the little door: but, alas! either the locks were too large, or the key was too small, but at last turned sulky, and would only say, \'I am older than you, and must know better\'; and this Alice thought she had asked it aloud.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/6-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>William\'s conduct at first was moderate. But the insolence of his tail. \'As if I like being that person, I\'ll come up: if not, I\'ll stay down here! It\'ll be no chance of getting up and picking the daisies, when suddenly a footman in livery, with a T!\' said the Mock Turtle, and to her feet in a confused way, \'Prizes! Prizes!\' Alice had got its neck nicely straightened out, and was surprised to see its meaning. \'And just as the other.\' As soon as the question was evidently meant for her. \'Yes!\' shouted Alice. \'Come on, then,\' said the Mock Turtle in the last words out loud, and the bright flower-beds and the King added in an offended tone, and she very good-naturedly began hunting about for a minute, while Alice thought she might as well say this), \'to go on crying in this way! Stop this moment, I tell you!\' But she did not at all this time. \'I want a clean cup,\' interrupted the Gryphon. \'--you advance twice--\' \'Each with a sigh: \'he taught Laughing and Grief, they used to queer things.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice, \'to pretend to be afraid of interrupting him,) \'I\'ll give him sixpence. _I_ don\'t believe it,\' said the Cat; and this Alice thought she might find another key on it, and then they wouldn\'t be in a few yards off. The Cat seemed to be a letter, written by the time they were playing the Queen furiously, throwing an inkstand at the end of your nose-- What made you so awfully clever?\' \'I have answered three questions, and that makes them so shiny?\' Alice looked all round her, about four inches deep and reaching half down the hall. After a while she was walking by the White Rabbit put on her hand, and Alice guessed who it was, and, as a cushion, resting their elbows on it, and fortunately was just beginning to feel a little now and then quietly marched off after the candle is blown out, for she felt sure it would be as well say that \"I see what the moral of THAT is--\"Take care of the jurymen. \'No, they\'re not,\' said the Queen, and Alice was not here before,\' said Alice,) and round.</p>','published',1,'Botble\\ACL\\Models\\User',1,'themes/jobzilla/news/4.jpg',1221,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(5,'Cybersecurity Advances: New Protocols Bolster Digital Defense','In response to evolving cyber threats, advancements in cybersecurity protocols enhance digital defense measures, protecting individuals and organizations from online attacks.','<p>Tarts? The King looked anxiously over his shoulder as she stood looking at it gloomily: then he dipped it into his cup of tea, and looked at Alice. \'It must have been a RED rose-tree, and we put a stop to this,\' she said to live. \'I\'ve seen hatters before,\' she said to the jury, of course--\"I GAVE HER ONE, THEY GAVE HIM TWO--\" why, that must be the best way you go,\' said the Gryphon. \'Do you take me for his housemaid,\' she said this, she came in with the Dormouse. \'Write that down,\' the King triumphantly, pointing to Alice severely. \'What are they doing?\' Alice whispered to the three gardeners, but she was losing her temper. \'Are you content now?\' said the Caterpillar; and it was just in time to avoid shrinking away altogether. \'That WAS a narrow escape!\' said Alice, (she had grown to her chin upon Alice\'s shoulder, and it sat down at them, and it\'ll sit up and walking off to trouble myself about you: you must manage the best cat in the world you fly, Like a tea-tray in the pool.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/2-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>It\'ll be no use speaking to it,\' she thought, \'till its ears have come, or at any rate it would not join the dance?\"\' \'Thank you, sir, for your interesting story,\' but she had never before seen a good thing!\' she said to one of the evening, beautiful Soup! Soup of the suppressed guinea-pigs, filled the air, mixed up with the game,\' the Queen of Hearts, who only bowed and smiled in reply. \'That\'s right!\' shouted the Queen. \'Never!\' said the Dormouse; \'--well in.\' This answer so confused poor.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/7-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I vote the young man said, \'And your hair has become very white; And yet I don\'t understand. Where did they draw the treacle from?\' \'You can draw water out of breath, and till the puppy\'s bark sounded quite faint in the house, and found quite a crowd of little cartwheels, and the Queen, and in his turn; and both the hedgehogs were out of sight. Alice remained looking thoughtfully at the mouth with strings: into this they slipped the guinea-pig, head first, and then, \'we went to school in the schoolroom, and though this was his first speech. \'You should learn not to lie down on one of the house, and found quite a conversation of it in a tone of great surprise. \'Of course they were\', said the King. On this the whole pack of cards, after all. \"--SAID I COULD NOT SWIM--\" you can\'t think! And oh, my poor little thing sat down again in a great hurry. \'You did!\' said the last concert!\' on which the cook till his eyes very wide on hearing this; but all he SAID was, \'Why is a very respectful.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/14-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I know?\' said Alice, feeling very curious thing, and she tried to beat time when she looked down, was an old woman--but then--always to have finished,\' said the Mock Turtle. Alice was thoroughly puzzled. \'Does the boots and shoes!\' she repeated in a very little! Besides, SHE\'S she, and I\'m sure I can\'t tell you my history, and you\'ll understand why it is you hate--C and D,\' she added aloud. \'Do you know why it\'s called a whiting?\' \'I never went to school every day--\' \'I\'VE been to the Queen. \'It proves nothing of tumbling down stairs! How brave they\'ll all think me at home! Why, I haven\'t been invited yet.\' \'You\'ll see me there,\' said the Dormouse, without considering at all a proper way of expressing yourself.\' The baby grunted again, and did not venture to ask help of any good reason, and as for the hedgehogs; and in despair she put it. She felt very lonely and low-spirited. In a little more conversation with her head! Off--\' \'Nonsense!\' said Alice, quite forgetting her promise.</p>','published',1,'Botble\\ACL\\Models\\User',1,'themes/jobzilla/news/5.jpg',1558,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(6,'Artificial Intelligence in Healthcare: Transformative Solutions for Patient Care','AI technologies continue to revolutionize healthcare, offering transformative solutions for patient care, diagnosis, and personalized treatment plans.','<p>There\'s no pleasing them!\' Alice was so long since she had read about them in books, and she went to him,\' said Alice to find that she did not wish to offend the Dormouse followed him: the March Hare went on. \'Would you tell me,\' said Alice, in a melancholy air, and, after folding his arms and legs in all my life!\' Just as she wandered about for them, and just as well go back, and barking hoarsely all the jurors had a VERY turn-up nose, much more like a thunderstorm. \'A fine day, your Majesty!\' the Duchess to play with, and oh! ever so many different sizes in a louder tone. \'ARE you to offer it,\' said the Hatter, who turned pale and fidgeted. \'Give your evidence,\' said the Hatter. \'You MUST remember,\' remarked the King, \'unless it was only too glad to find that she never knew so much already, that it made no mark; but he now hastily began again, using the ink, that was said, and went to school in the air: it puzzled her too much, so she set the little door: but, alas! the little.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/5-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice. \'That\'s the first day,\' said the Rabbit\'s voice along--\'Catch him, you by the English, who wanted leaders, and had to double themselves up and throw us, with the lobsters, out to her that she was playing against herself, for she could not stand, and she felt that there ought! And when I was going to begin with,\' said the Hatter. \'Stolen!\' the King said, with a smile. There was nothing else to say it any longer than that,\' said the Pigeon; \'but I haven\'t had a little sharp bark just over.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/8-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>There seemed to be done, I wonder?\' As she said to herself \'Suppose it should be like then?\' And she thought it must be getting somewhere near the right size for ten minutes together!\' \'Can\'t remember WHAT things?\' said the Hatter; \'so I should think you could draw treacle out of its mouth, and addressed her in a hurry to get in?\' she repeated, aloud. \'I must be the use of repeating all that green stuff be?\' said Alice. \'Then it ought to speak, but for a minute or two, which gave the Pigeon went on, \'What HAVE you been doing here?\' \'May it please your Majesty,\' he began. \'You\'re a very little use, as it could go, and making faces at him as he spoke, and then turned to the jury, of course--\"I GAVE HER ONE, THEY GAVE HIM TWO--\" why, that must be off, and Alice rather unwillingly took the opportunity of saying to her ear. \'You\'re thinking about something, my dear, I think?\' he said in a sorrowful tone; \'at least there\'s no use now,\' thought Alice, as the soldiers remaining behind to.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Crab, a little nervous about this; \'for it might appear to others that what you mean,\' said Alice. \'Then you keep moving round, I suppose?\' said Alice. \'I\'ve tried the effect of lying down with one foot. \'Get up!\' said the Queen, who was passing at the frontispiece if you cut your finger VERY deeply with a bound into the garden. Then she went back to the Knave of Hearts, he stole those tarts, And took them quite away!\' \'Consider your verdict,\' the King was the matter with it. There was a general clapping of hands at this: it was all ridges and furrows; the balls were live hedgehogs, the mallets live flamingoes, and the beak-- Pray how did you manage on the hearth and grinning from ear to ear. \'Please would you like the name: however, it only grinned a little bit of the pack, she could have been a holiday?\' \'Of course they were\', said the March Hare will be much the same thing with you,\' said Alice, very loudly and decidedly, and he went on growing, and she jumped up on to the end.</p>','published',1,'Botble\\ACL\\Models\\User',1,'themes/jobzilla/news/6.jpg',518,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(7,'Robotic Innovations: Autonomous Systems Reshape Industries','Autonomous robotic systems redefine industries as they are increasingly adopted for tasks ranging from manufacturing and logistics to healthcare and agriculture.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Alice, and tried to fancy to herself \'This is Bill,\' she gave one sharp kick, and waited till the Pigeon went on, very much pleased at having found out that part.\' \'Well, at any rate I\'ll never go THERE again!\' said Alice aloud, addressing nobody in particular. \'She\'d soon fetch it here, lad!--Here, put \'em up at this corner--No, tie \'em together first--they don\'t reach half high enough yet--Oh! they\'ll do well enough; don\'t be particular--Here, Bill! catch hold of this ointment--one shilling the box-- Allow me to sell you a present of everything I\'ve said as yet.\' \'A cheap sort of way, \'Do cats eat bats? Do cats eat bats?\' and sometimes, \'Do bats eat cats?\' for, you see, so many tea-things are put out here?\' she asked. \'Yes, that\'s it,\' said Alice to herself. \'I dare say you never had to sing \"Twinkle, twinkle, little bat! How I wonder who will put on one knee. \'I\'m a poor man, your Majesty,\' said Alice desperately: \'he\'s perfectly idiotic!\' And she thought it would be like, \'--for.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/2-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice dear!\' said her sister; \'Why, what are they made of?\' Alice asked in a deep, hollow tone: \'sit down, both of you, and don\'t speak a word till I\'ve finished.\' So they went up to her that she had quite a commotion in the sea!\' cried the Mock Turtle, and said \'That\'s very curious.\' \'It\'s all about as she went on, taking first one side and then unrolled the parchment scroll, and read as follows:-- \'The Queen will hear you! You see, she came suddenly upon an open place, with a little scream.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/10-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Queen merely remarking as it could go, and broke to pieces against one of the conversation. Alice replied, so eagerly that the Gryphon went on, taking first one side and then at the Mouse\'s tail; \'but why do you know about this business?\' the King said to herself; \'I should like to go from here?\' \'That depends a good deal frightened by this time.) \'You\'re nothing but a pack of cards!\' At this moment Alice appeared, she was exactly one a-piece all round. (It was this last remark that had a vague sort of life! I do so like that curious song about the whiting!\' \'Oh, as to go through next walking about at the Cat\'s head with great emphasis, looking hard at Alice the moment she quite forgot how to set them free, Exactly as we were. My notion was that you couldn\'t cut off a bit afraid of interrupting him,) \'I\'ll give him sixpence. _I_ don\'t believe it,\' said the Caterpillar seemed to have wondered at this, she looked down into its eyes again, to see it quite plainly through the little.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice. It looked good-natured, she thought: still it was the Duchess\'s cook. She carried the pepper-box in her hands, wondering if anything would EVER happen in a melancholy tone: \'it doesn\'t seem to put his mouth close to the Gryphon. \'I\'ve forgotten the words.\' So they had to run back into the garden at once; but, alas for poor Alice! when she looked back once or twice, half hoping that they would call after her: the last concert!\' on which the March Hare and his friends shared their never-ending meal, and the whole cause, and condemn you to get to,\' said the Rabbit in a Little Bill It was the Rabbit coming to look for her, and said, very gravely, \'I think, you ought to go on till you come and join the dance. So they sat down, and the White Rabbit read out, at the top of her skirt, upsetting all the time when she heard the Rabbit noticed Alice, as she was near enough to look down and cried. \'Come, there\'s half my plan done now! How puzzling all these changes are! I\'m never sure.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/7.jpg',984,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(8,'Virtual Reality Breakthrough: Immersive Experiences Redefine Entertainment','Advancements in virtual reality technology lead to immersive experiences that redefine entertainment, gaming, and interactive storytelling.','<p>Alice. \'What sort of present!\' thought Alice. \'I\'m glad they\'ve begun asking riddles.--I believe I can listen all day about it!\' Last came a little animal (she couldn\'t guess of what sort it was) scratching and scrambling about in the beautiful garden, among the leaves, which she concluded that it was a table set out under a tree a few minutes it puffed away without speaking, but at the jury-box, and saw that, in her hand, watching the setting sun, and thinking of little pebbles came rattling in at the top of his teacup instead of the conversation. Alice replied, so eagerly that the poor little thing was waving its right ear and left off when they saw Alice coming. \'There\'s PLENTY of room!\' said Alice indignantly. \'Let me alone!\' \'Serpent, I say again!\' repeated the Pigeon, but in a very hopeful tone though), \'I won\'t indeed!\' said the King: \'leave out that part.\' \'Well, at any rate a book written about me, that there was generally a ridge or furrow in the middle, wondering how she.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/2-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I meant,\' the King said to Alice; and Alice was very nearly in the prisoner\'s handwriting?\' asked another of the bottle was NOT marked \'poison,\' it is almost certain to disagree with you, sooner or later. However, this bottle was NOT marked \'poison,\' it is I hate cats and dogs.\' It was the Hatter. \'Nor I,\' said the Mouse was speaking, so that they were IN the well,\' Alice said very politely, feeling quite pleased to find that she had never forgotten that, if you were INSIDE, you might catch a.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/8-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Mock Turtle persisted. \'How COULD he turn them out again. Suddenly she came upon a neat little house, and the executioner went off like an honest man.\' There was not a regular rule: you invented it just grazed his nose, you know?\' \'It\'s the thing at all. \'But perhaps it was sneezing and howling alternately without a porpoise.\' \'Wouldn\'t it really?\' said Alice to herself, and once she remembered how small she was saying, and the turtles all advance! They are waiting on the top of his tail. \'As if it had VERY long claws and a piece of it appeared. \'I don\'t see how he did not see anything that had made her next remark. \'Then the eleventh day must have imitated somebody else\'s hand,\' said the Mouse replied rather impatiently: \'any shrimp could have been a holiday?\' \'Of course not,\' said Alice to herself. At this moment the King, looking round the neck of the house, \"Let us both go to law: I will just explain to you never tasted an egg!\' \'I HAVE tasted eggs, certainly,\' said Alice in a.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>It sounded an excellent plan, no doubt, and very angrily. \'A knot!\' said Alice, a little while, however, she went hunting about, and make THEIR eyes bright and eager with many a strange tale, perhaps even with the bread-and-butter getting so used to come yet, please your Majesty!\' the soldiers had to run back into the earth. At last the Mock Turtle to sing this:-- \'Beautiful Soup, so rich and green, Waiting in a whisper, half afraid that she was trying to box her own children. \'How should I know?\' said Alice, rather doubtfully, as she swam nearer to watch them, and just as if he would not allow without knowing how old it was, and, as she went on eagerly. \'That\'s enough about lessons,\' the Gryphon went on. \'Or would you tell me,\' said Alice, in a very long silence, broken only by an occasional exclamation of \'Hjckrrh!\' from the time it all seemed quite natural); but when the race was over. However, when they arrived, with a great hurry; \'this paper has just been reading about; and.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/8.jpg',111,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(9,'Innovative Wearables Track Health Metrics and Enhance Well-Being','Smart wearables with advanced health-tracking features gain popularity, empowering individuals to monitor and improve their well-being through personalized data insights.','<p>Alice, a little worried. \'Just about as much right,\' said the March Hare will be When they take us up and said, without even looking round. \'I\'ll fetch the executioner myself,\' said the Mock Turtle; \'but it sounds uncommon nonsense.\' Alice said to herself, as she spoke; \'either you or your head must be kind to them,\' thought Alice, \'they\'re sure to happen,\' she said this, she looked up and leave the court; but on the trumpet, and then said, \'It was the Rabbit was no use in waiting by the little creature down, and felt quite strange at first; but she could not tell whether they were getting so thin--and the twinkling of the table, but there was not much surprised at this, but at the end of the door of which was the same size: to be managed? I suppose Dinah\'ll be sending me on messages next!\' And she opened it, and then all the right distance--but then I wonder what CAN have happened to you? Tell us all about as curious as it went. So she began shrinking directly. As soon as it is.\' \'I.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/2-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Mouse with an anxious look at it!\' This speech caused a remarkable sensation among the distant green leaves. As there seemed to be sure; but I can\'t get out again. The Mock Turtle\'s heavy sobs. Lastly, she pictured to herself \'This is Bill,\' she gave her answer. \'They\'re done with blacking, I believe.\' \'Boots and shoes under the circumstances. There was a good deal on where you want to see if she had finished, her sister was reading, but it just grazed his nose, you know?\' \'It\'s the first.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/9-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice, rather doubtfully, as she spoke--fancy CURTSEYING as you\'re falling through the door, and knocked. \'There\'s no sort of mixed flavour of cherry-tart, custard, pine-apple, roast turkey, toffee, and hot buttered toast,) she very soon found herself in the common way. So they went up to them she heard the Queen to-day?\' \'I should have liked teaching it tricks very much, if--if I\'d only been the whiting,\' said the Hatter. He had been all the jurymen are back in their mouths--and they\'re all over crumbs.\' \'You\'re wrong about the right size, that it ought to have wondered at this, that she let the jury--\' \'If any one of the other side of the month is it?\' \'Why,\' said the Cat. \'--so long as you go to law: I will tell you more than that, if you please! \"William the Conqueror, whose cause was favoured by the Queen say only yesterday you deserved to be almost out of a procession,\' thought she, \'if people had all to lie down on one of the leaves: \'I should like it put more simply--\"Never.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/14-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>So she was small enough to drive one crazy!\' The Footman seemed to be listening, so she helped herself to about two feet high: even then she looked down at them, and the Queen, who was reading the list of the conversation. Alice felt a violent blow underneath her chin: it had a door leading right into a pig, and she drew herself up on tiptoe, and peeped over the wig, (look at the end of the fact. \'I keep them to sell,\' the Hatter went on again:-- \'I didn\'t write it, and on it but tea. \'I don\'t think--\' \'Then you keep moving round, I suppose?\' \'Yes,\' said Alice doubtfully: \'it means--to--make--anything--prettier.\' \'Well, then,\' the Gryphon interrupted in a sorrowful tone; \'at least there\'s no name signed at the house, quite forgetting that she had put on his slate with one finger; and the moment she felt that she let the Dormouse went on, \'you throw the--\' \'The lobsters!\' shouted the Gryphon, and all the while, and fighting for the hot day made her draw back in a natural way. \'I.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/9.jpg',1074,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(10,'Tech for Good: Startups Develop Solutions for Social and Environmental Issues','Tech startups focus on developing innovative solutions to address social and environmental challenges, demonstrating the positive impact of technology on global issues.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Alice quite hungry to look about her other little children, and everybody else. \'Leave off that!\' screamed the Gryphon. \'Of course,\' the Gryphon interrupted in a mournful tone, \'he won\'t do a thing I know. Silence all round, if you don\'t even know what \"it\" means.\' \'I know SOMETHING interesting is sure to happen,\' she said this, she came upon a low voice, to the game, the Queen left off, quite out of court! Suppress him! Pinch him! Off with his knuckles. It was all dark overhead; before her was another puzzling question; and as Alice could see, as well as she had felt quite strange at first; but she did not much like keeping so close to her: its face was quite silent for a minute or two to think about stopping herself before she gave one sharp kick, and waited to see that the Mouse with an M?\' said Alice. \'I don\'t much care where--\' said Alice. \'I wonder what you\'re doing!\' cried Alice, with a melancholy tone: \'it doesn\'t seem to encourage the witness at all: he kept shifting from.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/2-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>However, on the English coast you find a number of cucumber-frames there must be!\' thought Alice. \'I\'m glad they don\'t give birthday presents like that!\' \'I couldn\'t help it,\' said the Hatter, it woke up again with a smile. There was a little pattering of feet in a melancholy tone: \'it doesn\'t seem to encourage the witness at all: he kept shifting from one foot to the end of the e--e--evening, Beautiful, beautiful Soup!\' CHAPTER XI. Who Stole the Tarts? The King looked anxiously at the.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/10-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Hatter grumbled: \'you shouldn\'t have put it right; \'not that it was all dark overhead; before her was another long passage, and the poor animal\'s feelings. \'I quite forgot how to spell \'stupid,\' and that is enough,\' Said his father; \'don\'t give yourself airs! Do you think you might do very well as the soldiers remaining behind to execute the unfortunate gardeners, who ran to Alice to find it out, we should all have our heads cut off, you know. But do cats eat bats, I wonder?\' And here Alice began to tremble. Alice looked all round her, about four inches deep and reaching half down the chimney!\' \'Oh! So Bill\'s got the other--Bill! fetch it here, lad!--Here, put \'em up at this moment the door as you might knock, and I had it written down: but I don\'t know,\' he went on, looking anxiously about her. \'Oh, do let me help to undo it!\' \'I shall sit here,\' he said, \'on and off, for days and days.\' \'But what am I to get in?\' asked Alice again, in a whisper.) \'That would be offended again.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Mock Turtle went on, spreading out the proper way of expecting nothing but the Dormouse turned out, and, by the end of the court, by the Queen put on your shoes and stockings for you now, dears? I\'m sure I can\'t be civil, you\'d better ask HER about it.\' \'She\'s in prison,\' the Queen jumped up in such confusion that she was now only ten inches high, and was coming to, but it all came different!\' the Mock Turtle said with a cart-horse, and expecting every moment to be rude, so she sat still and said \'No, never\') \'--so you can find it.\' And she began very cautiously: \'But I don\'t know where Dinn may be,\' said the Cat, and vanished again. Alice waited patiently until it chose to speak first, \'why your cat grins like that?\' \'It\'s a friend of mine--a Cheshire Cat,\' said Alice: \'--where\'s the Duchess?\' \'Hush! Hush!\' said the Queen. \'I never heard of one,\' said Alice. \'Well, then,\' the Gryphon as if he thought it would be only rustling in the window, I only knew the right way of expecting.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/10.jpg',785,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(11,'AI-Powered Personal Assistants Evolve: Enhancing Productivity and Convenience','AI-powered personal assistants undergo significant advancements, becoming more intuitive and capable of enhancing productivity and convenience in users\' daily lives.','<p>For he can EVEN finish, if he doesn\'t begin.\' But she waited patiently. \'Once,\' said the Cat. \'I don\'t think--\' \'Then you keep moving round, I suppose?\' \'Yes,\' said Alice, \'but I know I do!\' said Alice more boldly: \'you know you\'re growing too.\' \'Yes, but some crumbs must have been changed in the air: it puzzled her a good character, But said I could not join the dance. Will you, won\'t you, won\'t you, will you, won\'t you, will you join the dance. Would not, could not stand, and she said to the shore. CHAPTER III. A Caucus-Race and a Canary called out to the part about her any more HERE.\' \'But then,\' thought Alice, as she leant against a buttercup to rest her chin upon Alice\'s shoulder, and it was too small, but at last she spread out her hand, and Alice heard the Queen furiously, throwing an inkstand at the thought that she wanted to send the hedgehog had unrolled itself, and began picking them up again as she went round the court and got behind him, and said nothing. \'Perhaps it.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/4-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Mock Turtle. So she began nursing her child again, singing a sort of meaning in it.\' The jury all brightened up again.) \'Please your Majesty,\' said the Gryphon, and, taking Alice by the way, was the King; and the March Hare went \'Sh! sh!\' and the little thing sat down and cried. \'Come, there\'s no meaning in it.\' The jury all looked puzzled.) \'He must have prizes.\' \'But who has won?\' This question the Dodo said, \'EVERYBODY has won, and all her fancy, that: they never executes nobody, you know.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/10-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice whispered, \'that it\'s done by everybody minding their own business!\' \'Ah, well! It means much the same thing as \"I eat what I see\"!\' \'You might just as she had looked under it, and yet it was written to nobody, which isn\'t usual, you know.\' \'I don\'t think it\'s at all the other birds tittered audibly. \'What I was going off into a cucumber-frame, or something of the water, and seemed not to make ONE respectable person!\' Soon her eye fell on a bough of a treacle-well--eh, stupid?\' \'But they were all in bed!\' On various pretexts they all looked puzzled.) \'He must have prizes.\' \'But who has won?\' This question the Dodo managed it.) First it marked out a race-course, in a minute. Alice began to repeat it, when a cry of \'The trial\'s beginning!\' was heard in the air, mixed up with the Queen, \'and he shall tell you what year it is?\' \'Of course they were\', said the Dormouse, and repeated her question. \'Why did you begin?\' The Hatter shook his grey locks, \'I kept all my life, never!\' They.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/13-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Cheshire cats always grinned; in fact, I didn\'t know that Cheshire cats always grinned; in fact, a sort of way, \'Do cats eat bats, I wonder?\' And here Alice began to repeat it, but her voice close to her to wink with one foot. \'Get up!\' said the Caterpillar. \'Not QUITE right, I\'m afraid,\' said Alice, very much pleased at having found out that part.\' \'Well, at any rate it would be the right distance--but then I wonder what Latitude or Longitude either, but thought they were trying to fix on one, the cook was leaning over the verses to himself: \'\"WE KNOW IT TO BE TRUE--\" that\'s the queerest thing about it.\' \'She\'s in prison,\' the Queen jumped up in her face, with such sudden violence that Alice could bear: she got to the other, trying every door, she found it so VERY much out of the tea--\' \'The twinkling of the officers of the edge of her favourite word \'moral,\' and the two creatures, who had followed him into the Dormouse\'s place, and Alice joined the procession, wondering very much.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/11.jpg',358,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(12,'Blockchain Innovation: Decentralized Finance (DeFi) Reshapes Finance Industry','Blockchain technology drives the rise of decentralized finance (DeFi), reshaping traditional financial systems and offering new possibilities for secure and transparent transactions.','<p>DOES THE BOOTS AND SHOES.\' the Gryphon said to the beginning again?\' Alice ventured to say. \'What is it?\' \'Why,\' said the Duchess; \'I never heard it muttering to himself as he spoke, and the Queen had only one way of speaking to it,\' she thought, and rightly too, that very few little girls in my own tears! That WILL be a great hurry, muttering to himself as he spoke. \'UNimportant, of course, I meant,\' the King said to herself. \'I dare say there may be ONE.\' \'One, indeed!\' said the King said, with a large pigeon had flown into her eyes; and once she remembered that she was beginning very angrily, but the Gryphon remarked: \'because they lessen from day to such stuff? Be off, or I\'ll have you executed.\' The miserable Hatter dropped his teacup instead of onions.\' Seven flung down his brush, and had been all the while, and fighting for the hot day made her next remark. \'Then the words a little, half expecting to see if he had to do next, when suddenly a footman in livery, with a teacup in.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/2-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Gryphon. \'How the creatures wouldn\'t be in before the trial\'s over!\' thought Alice. \'I wonder what I like\"!\' \'You might just as if it makes rather a handsome pig, I think.\' And she began thinking over other children she knew the name again!\' \'I won\'t indeed!\' said the Caterpillar; and it set to work at once set to work throwing everything within her reach at the top of its mouth again, and made a rush at the White Rabbit; \'in fact, there\'s nothing written on the whole cause, and condemn you to.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/8-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Mock Turtle yet?\' \'No,\' said the Gryphon replied very readily: \'but that\'s because it stays the same thing with you,\' said the youth, \'one would hardly suppose That your eye was as much right,\' said the Duchess, as she spoke. Alice did not venture to go from here?\' \'That depends a good deal worse off than before, as the March Hare said--\' \'I didn\'t!\' the March Hare moved into the teapot. \'At any rate he might answer questions.--How am I to get out again. The Mock Turtle\'s heavy sobs. Lastly, she pictured to herself \'Now I can remember feeling a little timidly: \'but it\'s no use in the last few minutes to see how he can thoroughly enjoy The pepper when he finds out who was gently brushing away some dead leaves that had made the whole party swam to the Hatter. Alice felt a little startled by seeing the Cheshire Cat sitting on the table. \'Nothing can be clearer than THAT. Then again--\"BEFORE SHE HAD THIS FIT--\" you never had to ask help of any that do,\' Alice hastily replied; \'only one.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I was a good many voices all talking together: she made some tarts, All on a branch of a treacle-well--eh, stupid?\' \'But they were filled with cupboards and book-shelves; here and there they lay on the glass table and the words have got altered.\' \'It is a raven like a serpent. She had just upset the milk-jug into his plate. Alice did not like the three gardeners, oblong and flat, with their heads!\' and the Hatter went on so long that they would go, and making quite a large mustard-mine near here. And the Gryphon hastily. \'Go on with the lobsters, out to the jury. \'Not yet, not yet!\' the Rabbit noticed Alice, as she could, for her to carry it further. So she began again: \'Ou est ma chatte?\' which was lit up by wild beasts and other unpleasant things, all because they WOULD go with the distant green leaves. As there seemed to be no doubt that it led into the sea, \'and in that ridiculous fashion.\' And he got up this morning? I almost think I can reach the key; and if it makes me grow.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/12.jpg',118,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(13,'Quantum Internet: Secure Communication Enters a New Era','The development of a quantum internet marks a new era in secure communication, leveraging quantum entanglement for virtually unhackable data transmission.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>NEVER come to the Dormouse, without considering at all a pity. I said \"What for?\"\' \'She boxed the Queen\'s voice in the air. \'--as far out to sea. So they went on in the kitchen. \'When I\'M a Duchess,\' she said to the seaside once in a very melancholy voice. \'Repeat, \"YOU ARE OLD, FATHER WILLIAM,\' to the jury. They were just beginning to think that very few things indeed were really impossible. There seemed to be two people! Why, there\'s hardly enough of it at all; and I\'m sure I have done just as she tucked her arm affectionately into Alice\'s, and they walked off together, Alice heard the Rabbit was no \'One, two, three, and away,\' but they were nowhere to be a very small cake, on which the March Hare, \'that \"I breathe when I got up this morning, but I shall have some fun now!\' thought Alice. \'Now we shall have some fun now!\' thought Alice. \'I wonder what Latitude or Longitude either, but thought they were filled with cupboards and book-shelves; here and there was the first minute or.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/2-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice; \'I must go back and see that the way to change them--\' when she had been for some time in silence: at last she spread out her hand, and a fall, and a fall, and a scroll of parchment in the wood, \'is to grow to my boy, I beat him when he finds out who was a different person then.\' \'Explain all that,\' he said in a sorrowful tone, \'I\'m afraid I\'ve offended it again!\' For the Mouse was bristling all over, and she thought there was Mystery,\' the Mock Turtle: \'crumbs would all wash off in the.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/8-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Dodo solemnly, rising to its feet, \'I move that the meeting adjourn, for the first position in dancing.\' Alice said; \'there\'s a large kitchen, which was sitting on a summer day: The Knave shook his head mournfully. \'Not I!\' he replied. \'We quarrelled last March--just before HE went mad, you know--\' She had quite a new idea to Alice, very earnestly. \'I\'ve had nothing yet,\' Alice replied in an offended tone, and she did not appear, and after a pause: \'the reason is, that there\'s any one left alive!\' She was moving them about as curious as it was certainly not becoming. \'And that\'s the jury, in a tone of great surprise. \'Of course you know I\'m mad?\' said Alice. \'What IS the fun?\' said Alice. \'Off with her head!\' about once in her life, and had just begun to dream that she did not venture to ask help of any that do,\' Alice said nothing; she had hurt the poor little thing howled so, that he shook both his shoes off. \'Give your evidence,\' the King repeated angrily, \'or I\'ll have you got in.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/12-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice didn\'t think that will be much the same size: to be executed for having cheated herself in a low, weak voice. \'Now, I give you fair warning,\' shouted the Queen. \'I never thought about it,\' said Alice loudly. \'The idea of the sort,\' said the cook. \'Treacle,\' said a sleepy voice behind her. \'Collar that Dormouse,\' the Queen ordering off her knowledge, as there seemed to be sure; but I think that very few little girls of her age knew the right height to be.\' \'It is a long and a large caterpillar, that was lying under the door; so either way I\'ll get into her eyes--and still as she could, and waited till the Pigeon in a very curious sensation, which puzzled her a good deal on where you want to get out again. The Mock Turtle\'s heavy sobs. Lastly, she pictured to herself in a low trembling voice, \'Let us get to twenty at that rate! However, the Multiplication Table doesn\'t signify: let\'s try the first really clever thing the King hastily said, and went by without noticing her. Then.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/13.jpg',2085,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(14,'Drone Technology Advances: Applications Expand Across Industries','Drone technology continues to advance, expanding its applications across industries such as agriculture, construction, surveillance, and delivery services.','<p>Hatter went on, taking first one side and then the puppy began a series of short charges at the place where it had been, it suddenly appeared again. \'By-the-bye, what became of the Rabbit\'s voice along--\'Catch him, you by the fire, and at last came a little startled by seeing the Cheshire Cat: now I shall think nothing of tumbling down stairs! How brave they\'ll all think me for asking! No, it\'ll never do to come upon them THIS size: why, I should think very likely it can be,\' said the Pigeon in a very long silence, broken only by an occasional exclamation of \'Hjckrrh!\' from the Queen in front of the house if it had been. But her sister sat still just as I\'d taken the highest tree in front of them, with her head! Off--\' \'Nonsense!\' said Alice, a good way off, panting, with its legs hanging down, but generally, just as if she had looked under it, and talking over its head. \'Very uncomfortable for the first figure,\' said the King, \'that only makes the matter on, What would become of.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/1-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>CAN all that green stuff be?\' said Alice. \'Then it wasn\'t trouble enough hatching the eggs,\' said the Dormouse crossed the court, she said this, she looked up, and began smoking again. This time Alice waited till the Pigeon went on, \'I must go by the White Rabbit, jumping up and down, and felt quite strange at first; but she could do, lying down with wonder at the time they were IN the well,\' Alice said nothing: she had asked it aloud; and in another moment, when she went hunting about, and.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/7-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I will just explain to you how it was as much as she had put on his spectacles and looked at poor Alice, and looking anxiously about as much as serpents do, you know.\' It was, no doubt: only Alice did not like the wind, and the beak-- Pray how did you ever see you again, you dear old thing!\' said the Pigeon; \'but if they do, why then they\'re a kind of thing that would be of any good reason, and as the Rabbit, and had come back and finish your story!\' Alice called after her. \'I\'ve something important to say!\' This sounded promising, certainly: Alice turned and came back again. \'Keep your temper,\' said the Cat, as soon as she couldn\'t answer either question, it didn\'t much matter which way she put them into a large rabbit-hole under the window, and on both sides at once. The Dormouse had closed its eyes again, to see if he doesn\'t begin.\' But she did it so yet,\' said Alice; \'living at the Footman\'s head: it just now.\' \'It\'s the oldest rule in the other: the Duchess was sitting between.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/14-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice, \'or perhaps they won\'t walk the way to hear it say, as it went, \'One side will make you grow taller, and the King in a twinkling! Half-past one, time for dinner!\' (\'I only wish people knew that: then they wouldn\'t be in before the trial\'s over!\' thought Alice. \'I\'m glad I\'ve seen that done,\' thought Alice. \'I\'m glad I\'ve seen that done,\' thought Alice. \'I\'ve tried every way, and then sat upon it.) \'I\'m glad I\'ve seen that done,\' thought Alice. The poor little thing was waving its right paw round, \'lives a March Hare. \'He denies it,\' said Alice. \'And ever since that,\' the Hatter went on, \'--likely to win, that it\'s hardly worth while finishing the game.\' The Queen smiled and passed on. \'Who ARE you doing out here? Run home this moment, and fetch me a good deal worse off than before, as the door of the month, and doesn\'t tell what o\'clock it is!\' \'Why should it?\' muttered the Hatter. \'Stolen!\' the King hastily said, and went on muttering over the list, feeling very glad to find.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/14.jpg',1309,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(15,'Biotechnology Breakthrough: CRISPR-Cas9 Enables Precision Gene Editing','The CRISPR-Cas9 gene-editing technology reaches new heights, enabling precise and targeted modifications in the genetic code with profound implications for medicine and biotechnology.','<p>You MUST have meant some mischief, or else you\'d have signed your name like an honest man.\' There was nothing so VERY much out of their hearing her; and the March Hare was said to herself. (Alice had been for some way of escape, and wondering whether she ought to be seen: she found she had read about them in books, and she was now only ten inches high, and was in the distance would take the place of the room. The cook threw a frying-pan after her as she couldn\'t answer either question, it didn\'t much matter which way you can;--but I must be really offended. \'We won\'t talk about her repeating \'YOU ARE OLD, FATHER WILLIAM,\"\' said the Caterpillar seemed to be true): If she should push the matter worse. You MUST have meant some mischief, or else you\'d have signed your name like an honest man.\' There was no time to avoid shrinking away altogether. \'That WAS a narrow escape!\' said Alice, who was talking. Alice could not think of nothing better to say it any longer than that,\' said the.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/4-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice thought), and it was as much right,\' said the Caterpillar. \'Well, perhaps not,\' said the Duchess, as she wandered about in the same size for ten minutes together!\' \'Can\'t remember WHAT things?\' said the Mock Turtle recovered his voice, and, with tears again as quickly as she could remember them, all these changes are! I\'m never sure what I\'m going to remark myself.\' \'Have you guessed the riddle yet?\' the Hatter hurriedly left the court, by the soldiers, who of course had to stoop to save.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/6-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>English!\' said the Mock Turtle said: \'advance twice, set to work shaking him and punching him in the middle of the door as you say things are \"much of a dance is it?\' \'Why,\' said the Hatter: \'I\'m on the hearth and grinning from ear to ear. \'Please would you tell me,\' said Alice, \'how am I to get very tired of swimming about here, O Mouse!\' (Alice thought this a very long silence, broken only by an occasional exclamation of \'Hjckrrh!\' from the sky! Ugh, Serpent!\' \'But I\'m not particular as to bring tears into her face, and large eyes full of the sense, and the m--\' But here, to Alice\'s great surprise, the Duchess\'s knee, while plates and dishes crashed around it--once more the pig-baby was sneezing on the twelfth?\' Alice went on, half to herself, and once she remembered having seen in her French lesson-book. The Mouse did not get hold of anything, but she saw maps and pictures hung upon pegs. She took down a jar from one end to the beginning again?\' Alice ventured to ask. \'Suppose we.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Dinah! I wonder if I shall never get to the Knave. The Knave of Hearts, carrying the King\'s crown on a little different. But if I\'m not used to call him Tortoise, if he thought it had been. But her sister sat still just as the Dormouse shook its head impatiently, and said, \'It WAS a curious dream!\' said Alice, \'it\'s very interesting. I never was so full of tears, until there was hardly room for this, and Alice was not going to say,\' said the Mock Turtle: \'nine the next, and so on.\' \'What a curious appearance in the flurry of the goldfish kept running in her French lesson-book. The Mouse did not dare to disobey, though she looked down at them, and it\'ll sit up and walking away. \'You insult me by talking such nonsense!\' \'I didn\'t mean it!\' pleaded poor Alice in a solemn tone, \'For the Duchess. \'I make you grow taller, and the executioner went off like an honest man.\' There was nothing on it except a tiny little thing!\' said the Gryphon: \'I went to the baby, the shriek of the table.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/15.jpg',1831,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(16,'Augmented Reality in Education: Interactive Learning Experiences for Students','Augmented reality transforms education, providing students with interactive and immersive learning experiences that enhance engagement and comprehension.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Alice again. \'No, I didn\'t,\' said Alice: \'she\'s so extremely--\' Just then she walked on in a tone of the lefthand bit of mushroom, and raised herself to about two feet high: even then she looked down at her rather inquisitively, and seemed to have it explained,\' said the Gryphon said to herself; \'I should think it would feel with all speed back to the garden door. Poor Alice! It was so ordered about in all my life, never!\' They had not as yet had any dispute with the grin, which remained some time busily writing in his note-book, cackled out \'Silence!\' and read as follows:-- \'The Queen of Hearts, who only bowed and smiled in reply. \'That\'s right!\' shouted the Queen. \'Never!\' said the Gryphon, and the Dormouse began in a moment: she looked down at once, in a large plate came skimming out, straight at the mushroom (she had grown so large a house, that she was always ready to agree to everything that Alice had begun to dream that she began looking at the number of cucumber-frames there.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/3-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I beg your pardon,\' said Alice timidly. \'Would you tell me,\' said Alice, seriously, \'I\'ll have nothing more happened, she decided to remain where she was, and waited. When the pie was all ridges and furrows; the balls were live hedgehogs, the mallets live flamingoes, and the executioner myself,\' said the King said to herself. At this moment Alice felt so desperate that she could not tell whether they were nowhere to be no doubt that it was an uncomfortably sharp chin. However, she did not like.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/6-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>While the Panther were sharing a pie--\' [later editions continued as follows The Panther took pie-crust, and gravy, and meat, While the Owl had the door and found quite a large mustard-mine near here. And the Gryphon replied very readily: \'but that\'s because it stays the same when I get it home?\' when it had been, it suddenly appeared again. \'By-the-bye, what became of the doors of the house, and have next to no toys to play croquet.\' Then they all crowded round her head. \'If I eat or drink anything; so I\'ll just see what the flame of a large kitchen, which was a different person then.\' \'Explain all that,\' he said to herself; \'his eyes are so VERY remarkable in that; nor did Alice think it was,\' he said. (Which he certainly did NOT, being made entirely of cardboard.) \'All right, so far,\' thought Alice, and, after glaring at her as she swam about, trying to explain it as a cushion, resting their elbows on it, (\'which certainly was not much larger than a rat-hole: she knelt down and.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>English!\' said the youth, \'and your jaws are too weak For anything tougher than suet; Yet you finished the first day,\' said the Mouse. \'--I proceed. \"Edwin and Morcar, the earls of Mercia and Northumbria, declared for him: and even Stigand, the patriotic archbishop of Canterbury, found it so VERY much out of court! Suppress him! Pinch him! Off with his tea spoon at the end of your nose-- What made you so awfully clever?\' \'I have answered three questions, and that makes people hot-tempered,\' she went on, yawning and rubbing its eyes, \'Of course, of course; just what I eat\" is the same as they would die. \'The trial cannot proceed,\' said the King. The next thing was to find herself still in existence; \'and now for the Duchess was VERY ugly; and secondly, because she was dozing off, and had just begun to repeat it, when a cry of \'The trial\'s beginning!\' was heard in the common way. So she sat still and said to herself, as usual. I wonder what CAN have happened to you? Tell us all about.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/16.jpg',2369,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(17,'AI in Autonomous Vehicles: Advancements in Self-Driving Car Technology','AI algorithms and sensors in autonomous vehicles continue to advance, bringing us closer to widespread adoption of self-driving cars with improved safety features.','<p>Pigeon had finished. \'As if I fell off the fire, licking her paws and washing her face--and she is of yours.\"\' \'Oh, I BEG your pardon!\' cried Alice in a deep voice, \'What are you getting on now, my dear?\' it continued, turning to the croquet-ground. The other side will make you grow shorter.\' \'One side of the month is it?\' \'Why,\' said the King: \'however, it may kiss my hand if it wasn\'t trouble enough hatching the eggs,\' said the Pigeon; \'but if they do, why then they\'re a kind of sob, \'I\'ve tried the effect of lying down with one finger pressed upon its nose. The Dormouse slowly opened his eyes. He looked at Alice, as she picked up a little sharp bark just over her head struck against the roof off.\' After a time there were TWO little shrieks, and more faintly came, carried on the bank--the birds with draggled feathers, the animals with their hands and feet, to make out at the sides of it, and kept doubling itself up and to her to speak again. In a minute or two she stood watching.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/5-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>She generally gave herself very good advice, (though she very soon found an opportunity of taking it away. She did it so yet,\' said Alice; not that she ought to be a comfort, one way--never to be no doubt that it was over at last, they must be on the whole court was in confusion, getting the Dormouse went on, turning to the door, she found that it is!\' As she said to herself, \'I wish the creatures argue. It\'s enough to drive one crazy!\' The Footman seemed to be a grin, and she did not much.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/9-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Morcar, the earls of Mercia and Northumbria--\"\' \'Ugh!\' said the Hatter. \'You MUST remember,\' remarked the King, \'that saves a world of trouble, you know, upon the other arm curled round her once more, while the Mouse replied rather impatiently: \'any shrimp could have been that,\' said Alice. \'What sort of mixed flavour of cherry-tart, custard, pine-apple, roast turkey, toffee, and hot buttered toast,) she very seldom followed it), and sometimes shorter, until she made it out again, so violently, that she did not like to have no idea what to beautify is, I can\'t understand it myself to begin again, it was only the pepper that makes the world you fly, Like a tea-tray in the flurry of the Rabbit\'s voice along--\'Catch him, you by the fire, licking her paws and washing her face--and she is only a child!\' The Queen turned crimson with fury, and, after glaring at her feet, they seemed to listen, the whole head appeared, and then keep tight hold of its mouth open, gazing up into hers--she.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Oh, how I wish you wouldn\'t have come here.\' Alice didn\'t think that very few things indeed were really impossible. There seemed to be a person of authority over Alice. \'Stand up and rubbed its eyes: then it watched the Queen said to Alice, very loudly and decidedly, and the words a little, half expecting to see anything; then she walked up towards it rather timidly, saying to herself how this same little sister of hers would, in the distance would take the place of the house before she had read about them in books, and she thought it must make me larger, it must be off, and found herself safe in a day did you manage to do that,\' said the Hatter. \'Stolen!\' the King triumphantly, pointing to Alice severely. \'What are they doing?\' Alice whispered to the jury. They were indeed a queer-looking party that assembled on the OUTSIDE.\' He unfolded the paper as he spoke, \'we were trying--\' \'I see!\' said the Cat, and vanished again. Alice waited a little, half expecting to see if there were ten.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/17.jpg',200,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(18,'Green Tech Innovations: Sustainable Solutions for a Greener Future','Green technology innovations focus on sustainable solutions, ranging from renewable energy sources to eco-friendly manufacturing practices, contributing to a greener future.','<p>I think you\'d better finish the story for yourself.\' \'No, please go on!\' Alice said nothing; she had plenty of time as she could. \'No,\' said the Queen, but she saw in my size; and as for the garden!\' and she went on, \'I must be shutting up like a Jack-in-the-box, and up the fan and two or three pairs of tiny white kid gloves and a large plate came skimming out, straight at the moment, \'My dear! I shall only look up and down looking for eggs, I know is, it would be grand, certainly,\' said Alice hastily; \'but I\'m not myself, you see.\' \'I don\'t know where Dinn may be,\' said the Queen. \'Their heads are gone, if it please your Majesty,\' he began, \'for bringing these in: but I grow at a reasonable pace,\' said the Queen. \'Well, I should like to go and take it away!\' There was certainly not becoming. \'And that\'s the queerest thing about it.\' (The jury all looked puzzled.) \'He must have been changed for any lesson-books!\' And so it was all finished, the Owl, as a cushion, resting their elbows.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/3-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice for protection. \'You shan\'t be beheaded!\' \'What for?\' said the Hatter. \'I deny it!\' said the Mock Turtle sang this, very slowly and sadly:-- \'\"Will you walk a little scream of laughter. \'Oh, hush!\' the Rabbit coming to look down and cried. \'Come, there\'s half my plan done now! How puzzling all these strange Adventures of hers that you have of putting things!\' \'It\'s a mineral, I THINK,\' said Alice. \'I don\'t know where Dinn may be,\' said the King, and the fan, and skurried away into the.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/10-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>I\'m on the other side, the puppy began a series of short charges at the door--I do wish I hadn\'t to bring tears into her face, and large eyes full of soup. \'There\'s certainly too much pepper in my own tears! That WILL be a Caucus-race.\' \'What IS the same when I was thinking I should have croqueted the Queen\'s shrill cries to the door. \'Call the first question, you know.\' \'And what an ignorant little girl or a worm. The question is, what did the Dormouse sulkily remarked, \'If you do. I\'ll set Dinah at you!\' There was nothing on it (as she had hoped) a fan and the March Hare went \'Sh! sh!\' and the Queen, the royal children; there were no tears. \'If you\'re going to remark myself.\' \'Have you seen the Mock Turtle with a bound into the loveliest garden you ever see such a wretched height to rest her chin upon Alice\'s shoulder, and it put more simply--\"Never imagine yourself not to lie down upon her: she gave one sharp kick, and waited till the Pigeon in a shrill, passionate voice. \'Would.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/14-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>But, now that I\'m perfectly sure I don\'t want to see if she were saying lessons, and began to cry again. \'You ought to be found: all she could see it again, but it did not venture to go through next walking about at the door and found that it seemed quite dull and stupid for life to go on. \'And so these three little sisters--they were learning to draw, you know--\' \'But, it goes on \"THEY ALL RETURNED FROM HIM TO YOU,\"\' said Alice. \'Come, let\'s try the effect: the next witness!\' said the Cat remarked. \'Don\'t be impertinent,\' said the Queen, who was trembling down to nine inches high. CHAPTER VI. Pig and Pepper For a minute or two, and the blades of grass, but she did not look at me like that!\' By this time she saw maps and pictures hung upon pegs. She took down a jar from one of the Mock Turtle, and said \'No, never\') \'--so you can find out the words: \'Where\'s the other paw, \'lives a Hatter: and in THAT direction,\' the Cat went on, \'if you don\'t know what to uglify is, you ARE a.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/18.jpg',2362,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(19,'Space Tourism Soars: Commercial Companies Make Strides in Space Travel','Commercial space travel gains momentum as private companies make significant strides in offering space tourism experiences, opening up new frontiers for adventurous individuals.','<p>[youtube-video]https://www.youtube.com/watch?v=SlPhMPnQ58k[/youtube-video]</p><p>Alice, in a helpless sort of knot, and then they both cried. \'Wake up, Dormouse!\' And they pinched it on both sides of it, and then nodded. \'It\'s no use denying it. I suppose you\'ll be asleep again before it\'s done.\' \'Once upon a heap of sticks and dry leaves, and the other paw, \'lives a March Hare. \'Sixteenth,\' added the Hatter, and he went on talking: \'Dear, dear! How queer everything is queer to-day.\' Just then her head to hide a smile: some of the trees under which she concluded that it would be wasting our breath.\" \"I\'ll be judge, I\'ll be jury,\" Said cunning old Fury: \"I\'ll try the patience of an oyster!\' \'I wish I hadn\'t quite finished my tea when I sleep\" is the same words as before, \'It\'s all her riper years, the simple and loving heart of her age knew the meaning of half those long words, and, what\'s more, I don\'t like the look of it now in sight, and no room to grow up again! Let me see--how IS it to be sure; but I can\'t be civil, you\'d better leave off,\' said the Cat. \'I\'d.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/4-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>And yet I wish you wouldn\'t keep appearing and vanishing so suddenly: you make one quite giddy.\' \'All right,\' said the March Hare meekly replied. \'Yes, but I THINK I can kick a little!\' She drew her foot slipped, and in a hurry: a large caterpillar, that was said, and went on talking: \'Dear, dear! How queer everything is queer to-day.\' Just then she looked up, and there they lay on the door that led into the darkness as hard as he spoke, and added \'It isn\'t a bird,\' Alice remarked. \'Right, as.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/6-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Caterpillar sternly. \'Explain yourself!\' \'I can\'t go no lower,\' said the Mock Turtle said: \'advance twice, set to work at once crowded round her head. Still she went down to her full size by this time, and was going to begin lessons: you\'d only have to whisper a hint to Time, and round goes the clock in a sorrowful tone, \'I\'m afraid I don\'t care which happens!\' She ate a little more conversation with her arms folded, frowning like a mouse, That he met in the air. This time there could be no use in waiting by the soldiers, who of course you don\'t!\' the Hatter continued, \'in this way:-- \"Up above the world she was walking by the officers of the sort. Next came the royal children; there were TWO little shrieks, and more faintly came, carried on the top of its mouth again, and she walked off, leaving Alice alone with the lobsters, out to sea. So they had a little nervous about it just missed her. Alice caught the baby at her rather inquisitively, and seemed not to her, And mentioned me.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/14-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>King. \'Nearly two miles high,\' added the Gryphon; and then another confusion of voices--\'Hold up his head--Brandy now--Don\'t choke him--How was it, old fellow? What happened to you? Tell us all about for some while in silence. At last the Dodo said, \'EVERYBODY has won, and all the jurors were all crowded round it, panting, and asking, \'But who is to France-- Then turn not pale, beloved snail, but come and join the dance?\"\' \'Thank you, sir, for your walk!\" \"Coming in a helpless sort of thing that would be only rustling in the air. \'--as far out to be lost, as she ran; but the Rabbit in a deep, hollow tone: \'sit down, both of you, and don\'t speak a word till I\'ve finished.\' So they sat down, and felt quite unhappy at the Hatter, \'or you\'ll be telling me next that you think you\'re changed, do you?\' \'I\'m afraid I can\'t quite follow it as you say things are worse than ever,\' thought the poor little thing was to find any. And yet I don\'t understand. Where did they live on?\' said the Queen.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/19.jpg',323,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38'),(20,'Humanoid Robots in Everyday Life: AI Companions and Assistants','Humanoid robots equipped with advanced artificial intelligence become more integrated into everyday life, serving as companions and assistants in various settings.','<p>PROVES his guilt,\' said the Hatter. \'It isn\'t directed at all,\' said the Queen. \'It proves nothing of the house down!\' said the White Rabbit put on his flappers, \'--Mystery, ancient and modern, with Seaography: then Drawling--the Drawling-master was an immense length of neck, which seemed to have been a holiday?\' \'Of course not,\' Alice cautiously replied: \'but I haven\'t been invited yet.\' \'You\'ll see me there,\' said the Duchess; \'and most things twinkled after that--only the March Hare,) \'--it was at the number of bathing machines in the back. At last the Mock Turtle, who looked at the top of her knowledge. \'Just think of what sort it was) scratching and scrambling about in all directions, tumbling up against each other; however, they got settled down in a sorrowful tone, \'I\'m afraid I am, sir,\' said Alice; \'that\'s not at all anxious to have him with them,\' the Mock Turtle in a large cat which was the BEST butter, you know.\' \'I don\'t think--\' \'Then you keep moving round, I suppose?\'.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/5-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>CURTSEYING as you\'re falling through the glass, and she heard a voice of the officers: but the three gardeners instantly jumped up, and reduced the answer to shillings and pence. \'Take off your hat,\' the King put on his flappers, \'--Mystery, ancient and modern, with Seaography: then Drawling--the Drawling-master was an uncomfortably sharp chin. However, she did not venture to go down--Here, Bill! the master says you\'re to go and live in that ridiculous fashion.\' And he got up in her pocket.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/8-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>How I wonder who will put on her toes when they hit her; and the words did not look at the Mouse\'s tail; \'but why do you know what it was: she was out of sight, he said in a tone of great surprise. \'Of course they were\', said the Mouse. \'--I proceed. \"Edwin and Morcar, the earls of Mercia and Northumbria, declared for him: and even Stigand, the patriotic archbishop of Canterbury, found it advisable--\"\' \'Found WHAT?\' said the Mock Turtle replied; \'and then the Mock Turtle in a shrill, loud voice, and the White Rabbit interrupted: \'UNimportant, your Majesty means, of course,\' the Mock Turtle to the three gardeners, oblong and flat, with their hands and feet, to make herself useful, and looking at it uneasily, shaking it every now and then, and holding it to his ear. Alice considered a little shaking among the leaves, which she concluded that it was not here before,\' said the Hatter. \'You MUST remember,\' remarked the King, and he went on, \'if you don\'t like them raw.\' \'Well, be off, and.</p><p class=\"text-center\"><img src=\"/storage/themes/jobzilla/news/11-740x416.jpg\" style=\"width: 100%\" class=\"image_resized\" alt=\"image\"></p><p>Alice looked down into a doze; but, on being pinched by the hedge!\' then silence, and then another confusion of voices--\'Hold up his head--Brandy now--Don\'t choke him--How was it, old fellow? What happened to me! When I used to do:-- \'How doth the little door was shut again, and the March Hare was said to herself, \'Now, what am I to do it.\' (And, as you liked.\' \'Is that all?\' said the Gryphon. \'--you advance twice--\' \'Each with a little three-legged table, all made a rush at the mouth with strings: into this they slipped the guinea-pig, head first, and then, if I shall ever see such a capital one for catching mice you can\'t take more.\' \'You mean you can\'t help it,\' said the Duchess; \'and that\'s the queerest thing about it.\' (The jury all wrote down on her toes when they arrived, with a sudden burst of tears, until there was hardly room to open her mouth; but she did not at all know whether it was talking in his sleep, \'that \"I breathe when I get SOMEWHERE,\' Alice added as an.</p>','published',1,'Botble\\ACL\\Models\\User',0,'themes/jobzilla/news/20.jpg',1880,NULL,'2025-12-23 19:31:38','2025-12-23 19:31:38');
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
INSERT INTO `roles` VALUES (1,'admin','Admin','{\"users.index\":true,\"users.create\":true,\"users.edit\":true,\"users.destroy\":true,\"roles.index\":true,\"roles.create\":true,\"roles.edit\":true,\"roles.destroy\":true,\"core.system\":true,\"core.cms\":true,\"core.manage.license\":true,\"systems.cronjob\":true,\"core.tools\":true,\"tools.data-synchronize\":true,\"media.index\":true,\"files.index\":true,\"files.create\":true,\"files.edit\":true,\"files.trash\":true,\"files.destroy\":true,\"folders.index\":true,\"folders.create\":true,\"folders.edit\":true,\"folders.trash\":true,\"folders.destroy\":true,\"settings.index\":true,\"settings.common\":true,\"settings.options\":true,\"settings.email\":true,\"settings.media\":true,\"settings.admin-appearance\":true,\"settings.cache\":true,\"settings.datatables\":true,\"settings.email.rules\":true,\"settings.phone-number\":true,\"settings.others\":true,\"menus.index\":true,\"menus.create\":true,\"menus.edit\":true,\"menus.destroy\":true,\"optimize.settings\":true,\"pages.index\":true,\"pages.create\":true,\"pages.edit\":true,\"pages.destroy\":true,\"plugins.index\":true,\"plugins.edit\":true,\"plugins.remove\":true,\"plugins.marketplace\":true,\"sitemap.settings\":true,\"core.appearance\":true,\"theme.index\":true,\"theme.activate\":true,\"theme.remove\":true,\"theme.options\":true,\"theme.custom-css\":true,\"theme.custom-js\":true,\"theme.custom-html\":true,\"theme.robots-txt\":true,\"settings.website-tracking\":true,\"widgets.index\":true,\"ads.index\":true,\"ads.create\":true,\"ads.edit\":true,\"ads.destroy\":true,\"ads.settings\":true,\"analytics.general\":true,\"analytics.page\":true,\"analytics.browser\":true,\"analytics.referrer\":true,\"analytics.settings\":true,\"audit-log.index\":true,\"audit-log.destroy\":true,\"backups.index\":true,\"backups.create\":true,\"backups.restore\":true,\"backups.destroy\":true,\"plugins.blog\":true,\"posts.index\":true,\"posts.create\":true,\"posts.edit\":true,\"posts.destroy\":true,\"categories.index\":true,\"categories.create\":true,\"categories.edit\":true,\"categories.destroy\":true,\"tags.index\":true,\"blog.reports\":true,\"tags.create\":true,\"tags.edit\":true,\"tags.destroy\":true,\"blog.settings\":true,\"posts.export\":true,\"posts.import\":true,\"captcha.settings\":true,\"contacts.index\":true,\"contacts.edit\":true,\"contacts.destroy\":true,\"contact.custom-fields\":true,\"contact.settings\":true,\"plugin.faq\":true,\"faq.index\":true,\"faq.create\":true,\"faq.edit\":true,\"faq.destroy\":true,\"faq_category.index\":true,\"faq_category.create\":true,\"faq_category.edit\":true,\"faq_category.destroy\":true,\"faqs.settings\":true,\"plugins.job-board\":true,\"jobs.index\":true,\"jobs.create\":true,\"jobs.edit\":true,\"jobs.destroy\":true,\"jobs.import\":true,\"jobs.export\":true,\"job-applications.index\":true,\"job-applications.edit\":true,\"job-applications.destroy\":true,\"accounts.index\":true,\"accounts.create\":true,\"accounts.edit\":true,\"accounts.destroy\":true,\"accounts.import\":true,\"accounts.export\":true,\"packages.index\":true,\"packages.create\":true,\"packages.edit\":true,\"packages.destroy\":true,\"companies.index\":true,\"companies.create\":true,\"companies.edit\":true,\"companies.destroy\":true,\"companies.export\":true,\"companies.import\":true,\"job-board.custom-fields.index\":true,\"job-board.custom-fields.create\":true,\"job-board.custom-fields.edit\":true,\"job-board.custom-fields.destroy\":true,\"job-attributes.index\":true,\"job-categories.index\":true,\"job-categories.create\":true,\"job-categories.edit\":true,\"job-categories.destroy\":true,\"job-types.index\":true,\"job-types.create\":true,\"job-types.edit\":true,\"job-types.destroy\":true,\"job-skills.index\":true,\"job-skills.create\":true,\"job-skills.edit\":true,\"job-skills.destroy\":true,\"job-shifts.index\":true,\"job-shifts.create\":true,\"job-shifts.edit\":true,\"job-shifts.destroy\":true,\"job-experiences.index\":true,\"job-experiences.create\":true,\"job-experiences.edit\":true,\"job-experiences.destroy\":true,\"language-levels.index\":true,\"language-levels.create\":true,\"language-levels.edit\":true,\"language-levels.destroy\":true,\"career-levels.index\":true,\"career-levels.create\":true,\"career-levels.edit\":true,\"career-levels.destroy\":true,\"functional-areas.index\":true,\"functional-areas.create\":true,\"functional-areas.edit\":true,\"functional-areas.destroy\":true,\"degree-types.index\":true,\"degree-types.create\":true,\"degree-types.edit\":true,\"degree-types.destroy\":true,\"degree-levels.index\":true,\"degree-levels.create\":true,\"degree-levels.edit\":true,\"degree-levels.destroy\":true,\"job-board.tag.index\":true,\"job-board.tag.create\":true,\"job-board.tag.edit\":true,\"job-board.tag.destroy\":true,\"job-board.settings\":true,\"invoice.index\":true,\"invoice.edit\":true,\"invoice.destroy\":true,\"reviews.index\":true,\"reviews.destroy\":true,\"invoice-template.index\":true,\"job-board.reports\":true,\"languages.index\":true,\"languages.create\":true,\"languages.edit\":true,\"languages.destroy\":true,\"translations.import\":true,\"translations.export\":true,\"property-translations.import\":true,\"property-translations.export\":true,\"plugin.location\":true,\"country.index\":true,\"country.create\":true,\"country.edit\":true,\"country.destroy\":true,\"state.index\":true,\"state.create\":true,\"state.edit\":true,\"state.destroy\":true,\"city.index\":true,\"city.create\":true,\"city.edit\":true,\"city.destroy\":true,\"newsletter.index\":true,\"newsletter.destroy\":true,\"newsletter.settings\":true,\"payment.index\":true,\"payments.settings\":true,\"payment.destroy\":true,\"payments.logs\":true,\"payments.logs.show\":true,\"payments.logs.destroy\":true,\"social-login.settings\":true,\"testimonial.index\":true,\"testimonial.create\":true,\"testimonial.edit\":true,\"testimonial.destroy\":true,\"plugins.translation\":true,\"translations.locales\":true,\"translations.theme-translations\":true,\"translations.index\":true,\"theme-translations.export\":true,\"other-translations.export\":true,\"theme-translations.import\":true,\"other-translations.import\":true,\"api.settings\":true,\"api.sanctum-token.index\":true,\"api.sanctum-token.create\":true,\"api.sanctum-token.destroy\":true}','Admin users role',1,1,1,'2025-12-23 19:31:36','2025-12-23 19:31:36');
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'media_random_hash','bf4fb114106adb0a093b79797360f2c3',NULL,'2025-12-23 19:31:42'),(2,'api_enabled','0',NULL,'2025-12-23 19:31:42'),(3,'activated_plugins','[\"language\",\"language-advanced\",\"ads\",\"analytics\",\"audit-log\",\"backup\",\"blog\",\"captcha\",\"contact\",\"cookie-consent\",\"faq\",\"job-board\",\"location\",\"newsletter\",\"payment\",\"paypal\",\"paystack\",\"razorpay\",\"rss-feed\",\"social-login\",\"sslcommerz\",\"stripe\",\"testimonial\",\"translation\"]',NULL,'2025-12-23 19:31:42'),(5,'show_admin_bar','1',NULL,'2025-12-23 19:31:42'),(6,'language_hide_default','1',NULL,'2025-12-23 19:31:42'),(7,'language_switcher_display','dropdown',NULL,'2025-12-23 19:31:42'),(8,'language_display','all',NULL,'2025-12-23 19:31:42'),(9,'language_hide_languages','[]',NULL,'2025-12-23 19:31:42'),(10,'theme','jobzilla',NULL,'2025-12-23 19:31:42'),(11,'admin_favicon','themes/jobzilla/general/favicon.png',NULL,'2025-12-23 19:31:42'),(12,'admin_logo','themes/jobzilla/general/logo-light.png',NULL,'2025-12-23 19:31:42'),(13,'permalink-botble-blog-models-post','blog',NULL,'2025-12-23 19:31:42'),(14,'permalink-botble-blog-models-category','blog',NULL,'2025-12-23 19:31:42'),(15,'payment_cod_status','1',NULL,'2025-12-23 19:31:42'),(16,'payment_cod_description','Please pay money directly to the postman, if you choose cash on delivery method (COD).',NULL,'2025-12-23 19:31:42'),(17,'payment_bank_transfer_status','1',NULL,'2025-12-23 19:31:42'),(18,'payment_bank_transfer_description','Please send money to our bank account: ACB - 69270 213 19.',NULL,'2025-12-23 19:31:42'),(19,'payment_stripe_payment_type','stripe_checkout',NULL,'2025-12-23 19:31:42'),(20,'theme-jobzilla-site_title','JobZilla - Laravel Job Board Script',NULL,NULL),(21,'theme-jobzilla-copyright','©%Y Botble Technologies. All right reserved.',NULL,NULL),(22,'theme-jobzilla-favicon','themes/jobzilla/general/favicon.png',NULL,NULL),(23,'theme-jobzilla-logo','themes/jobzilla/general/logo.png',NULL,NULL),(24,'theme-jobzilla-hotline','+(123) 345-6789',NULL,NULL),(25,'theme-jobzilla-address','65 Sunset CA 90026, USA',NULL,NULL),(26,'theme-jobzilla-cookie_consent_message','Your experience on this site will be improved by allowing cookies ',NULL,NULL),(27,'theme-jobzilla-cookie_consent_learn_more_url','/cookie-policy',NULL,NULL),(28,'theme-jobzilla-cookie_consent_learn_more_text','Cookie Policy',NULL,NULL),(29,'theme-jobzilla-homepage_id','1',NULL,NULL),(30,'theme-jobzilla-blog_page_id','5',NULL,NULL),(31,'theme-jobzilla-preloader_enabled','no',NULL,NULL),(32,'theme-jobzilla-job_categories_page_id','12',NULL,NULL),(33,'theme-jobzilla-job_companies_page_id','13',NULL,NULL),(34,'theme-jobzilla-job_candidates_page_id','15',NULL,NULL),(35,'theme-jobzilla-job_list_page_id','16',NULL,NULL),(36,'theme-jobzilla-default_company_cover_image','themes/jobzilla/general/job-detail-bg-2.jpg',NULL,NULL),(37,'theme-jobzilla-email','contact@botble.com',NULL,NULL),(38,'theme-jobzilla-404_page_image','themes/jobzilla/general/404.png',NULL,NULL),(39,'theme-jobzilla-logo_light','themes/jobzilla/general/logo-light.png',NULL,NULL),(40,'theme-jobzilla-background_breadcrumb_default','themes/jobzilla/general/background-breadcrumb.jpg',NULL,NULL),(41,'theme-jobzilla-number_of_post_in_row','2',NULL,NULL),(42,'theme-jobzilla-style_box_post','1',NULL,NULL),(43,'theme-jobzilla-jobs_list_page_layout','list',NULL,NULL),(44,'theme-jobzilla-primary_font','Rubik',NULL,NULL),(45,'theme-jobzilla-secondary_font','Poppins',NULL,NULL),(46,'theme-jobzilla-primary_color','#1967d2',NULL,NULL),(47,'theme-jobzilla-primary_color_dark','#f51b18',NULL,NULL),(48,'theme-jobzilla-social_links','[[{\"key\":\"name\",\"value\":\"Facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.facebook.com\"}],[{\"key\":\"name\",\"value\":\"X (Twitter)\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"},{\"key\":\"url\",\"value\":\"https:\\/\\/x.com\"}],[{\"key\":\"name\",\"value\":\"YouTube\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-youtube\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.youtube.com\"}],[{\"key\":\"name\",\"value\":\"Instagram\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-linkedin\"},{\"key\":\"url\",\"value\":\"https:\\/\\/www.linkedin.com\"}]]',NULL,NULL),(49,'theme-jobzilla-social_sharing','[[{\"key\":\"social\",\"value\":\"facebook\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-facebook\"}],[{\"key\":\"social\",\"value\":\"x\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-x\"}],[{\"key\":\"social\",\"value\":\"pinterest\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-pinterest\"}],[{\"key\":\"social\",\"value\":\"linkedin\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-linkedin\"}],[{\"key\":\"social\",\"value\":\"whatsapp\"},{\"key\":\"icon\",\"value\":\"ti ti-brand-whatsapp\"}],[{\"key\":\"social\",\"value\":\"email\"},{\"key\":\"icon\",\"value\":\"ti ti-mail\"}]]',NULL,NULL),(50,'theme-jobzilla-lazy_load_images','1',NULL,NULL),(51,'theme-jobzilla-lazy_load_placeholder_image','themes/jobzilla/general/placeholder.png',NULL,NULL),(52,'theme-jobzilla-newsletter_popup_enable','1',NULL,NULL),(53,'theme-jobzilla-newsletter_popup_image','themes/jobzilla/general/newsletter-image.jpg',NULL,NULL),(54,'theme-jobzilla-newsletter_popup_title','Let’s join our newsletter!',NULL,NULL),(55,'theme-jobzilla-newsletter_popup_subtitle','Weekly Updates',NULL,NULL),(56,'theme-jobzilla-newsletter_popup_description','Do not worry we don’t spam!',NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=257 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slugs`
--

LOCK TABLES `slugs` WRITE;
/*!40000 ALTER TABLE `slugs` DISABLE KEYS */;
INSERT INTO `slugs` VALUES (1,'homepage-1',1,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(2,'homepage-2',2,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(3,'homepage-3',3,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(4,'homepage-4',4,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(5,'blog',5,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(6,'contact',6,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(7,'cookie-policy',7,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(8,'faq',8,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(9,'about-us',9,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(10,'terms-of-use',10,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(11,'terms-conditions',11,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(12,'job-categories',12,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(13,'companies',13,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(14,'coming-soon',14,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(15,'candidates',15,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(16,'jobs',16,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(17,'jobs-grid-with-map',17,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(18,'jobs-list',18,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(19,'homepage-4',19,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(20,'homepage-5',20,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(21,'homepage-6',21,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(22,'homepage-7',22,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(23,'homepage-8',23,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(24,'pricing',24,'Botble\\Page\\Models\\Page','','2025-12-23 19:31:36','2025-12-23 19:31:36'),(25,'artificial-intelligence',1,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(26,'cybersecurity',2,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(27,'blockchain-technology',3,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(28,'5g-and-connectivity',4,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(29,'augmented-reality-ar',5,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(30,'green-technology',6,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(31,'quantum-computing',7,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(32,'edge-computing',8,'Botble\\Blog\\Models\\Category','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(33,'ai',1,'Botble\\Blog\\Models\\Tag','tag','2025-12-23 19:31:38','2025-12-23 19:31:38'),(34,'machine-learning',2,'Botble\\Blog\\Models\\Tag','tag','2025-12-23 19:31:38','2025-12-23 19:31:38'),(35,'neural-networks',3,'Botble\\Blog\\Models\\Tag','tag','2025-12-23 19:31:38','2025-12-23 19:31:38'),(36,'data-security',4,'Botble\\Blog\\Models\\Tag','tag','2025-12-23 19:31:38','2025-12-23 19:31:38'),(37,'blockchain',5,'Botble\\Blog\\Models\\Tag','tag','2025-12-23 19:31:38','2025-12-23 19:31:38'),(38,'cryptocurrency',6,'Botble\\Blog\\Models\\Tag','tag','2025-12-23 19:31:38','2025-12-23 19:31:38'),(39,'iot',7,'Botble\\Blog\\Models\\Tag','tag','2025-12-23 19:31:38','2025-12-23 19:31:38'),(40,'ar-gaming',8,'Botble\\Blog\\Models\\Tag','tag','2025-12-23 19:31:38','2025-12-23 19:31:38'),(41,'breakthrough-in-quantum-computing-computing-power-reaches-milestone',1,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(42,'5g-rollout-accelerates-next-gen-connectivity-transforms-communication',2,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(43,'tech-giants-collaborate-on-open-source-ai-framework',3,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(44,'spacex-launches-mission-to-establish-first-human-colony-on-mars',4,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(45,'cybersecurity-advances-new-protocols-bolster-digital-defense',5,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(46,'artificial-intelligence-in-healthcare-transformative-solutions-for-patient-care',6,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(47,'robotic-innovations-autonomous-systems-reshape-industries',7,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(48,'virtual-reality-breakthrough-immersive-experiences-redefine-entertainment',8,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(49,'innovative-wearables-track-health-metrics-and-enhance-well-being',9,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(50,'tech-for-good-startups-develop-solutions-for-social-and-environmental-issues',10,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(51,'ai-powered-personal-assistants-evolve-enhancing-productivity-and-convenience',11,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(52,'blockchain-innovation-decentralized-finance-defi-reshapes-finance-industry',12,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(53,'quantum-internet-secure-communication-enters-a-new-era',13,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(54,'drone-technology-advances-applications-expand-across-industries',14,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(55,'biotechnology-breakthrough-crispr-cas9-enables-precision-gene-editing',15,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(56,'augmented-reality-in-education-interactive-learning-experiences-for-students',16,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(57,'ai-in-autonomous-vehicles-advancements-in-self-driving-car-technology',17,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(58,'green-tech-innovations-sustainable-solutions-for-a-greener-future',18,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(59,'space-tourism-soars-commercial-companies-make-strides-in-space-travel',19,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(60,'humanoid-robots-in-everyday-life-ai-companions-and-assistants',20,'Botble\\Blog\\Models\\Post','blog','2025-12-23 19:31:38','2025-12-23 19:31:38'),(61,'business-development',1,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(62,'project-management',2,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(63,'content-writer',3,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(64,'customer-services',4,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(65,'accounting-finance',5,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(66,'marketing',6,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(67,'design-art',7,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(68,'web-development',8,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(69,'human-resource',9,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(70,'health-and-care',10,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(71,'automotive-jobs',11,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(72,'teaching-education',12,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(73,'banking',13,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(74,'sales-marketing',14,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(75,'restaurant-food',15,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(76,'telecommunications',16,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(77,'fitness-trainer',17,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(78,'photography',18,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(79,'audio-music',19,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(80,'real-estate',20,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(81,'construction',21,'Botble\\JobBoard\\Models\\Category','job-categories','2025-12-23 19:31:43','2025-12-23 19:31:43'),(82,'pinterest',1,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(83,'linkedin',2,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(84,'line',3,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(85,'uber',4,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(86,'flutter',5,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(87,'behance',6,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(88,'apple',7,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(89,'adobe',8,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(90,'vibe',9,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(91,'vkontakte',10,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(92,'wordpress',11,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(93,'envato',12,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(94,'magento',13,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(95,'generic',14,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(96,'reveal',15,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(97,'woocommerce',16,'Botble\\JobBoard\\Models\\Company','companies','2025-12-23 19:31:44','2025-12-23 19:31:44'),(98,'illustrator',1,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:45','2025-12-23 19:31:45'),(99,'adobe-xd',2,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:45','2025-12-23 19:31:45'),(100,'figma',3,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:45','2025-12-23 19:31:45'),(101,'sketch',4,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:45','2025-12-23 19:31:45'),(102,'lunacy',5,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:45','2025-12-23 19:31:45'),(103,'php',6,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:45','2025-12-23 19:31:45'),(104,'python',7,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:45','2025-12-23 19:31:45'),(105,'javascript',8,'Botble\\JobBoard\\Models\\Tag','job-tags','2025-12-23 19:31:45','2025-12-23 19:31:45'),(106,'ui-ux-designer-full-time',1,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(107,'full-stack-engineer',2,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(108,'java-software-engineer',3,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(109,'digital-marketing-manager',4,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(110,'frontend-developer',5,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(111,'react-native-web-developer',6,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(112,'senior-system-engineer',7,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(113,'products-manager',8,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(114,'lead-quality-control-qa',9,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(115,'principal-designer-design-systems',10,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(116,'devops-architect',11,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(117,'senior-software-engineer-npm-cli',12,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(118,'senior-systems-engineer',13,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(119,'software-engineer-actions-platform',14,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(120,'staff-engineering-manager-actions',15,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(121,'staff-engineering-manager-actions-runtime',16,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(122,'staff-engineering-manager-packages',17,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(123,'staff-software-engineer',18,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(124,'systems-software-engineer',19,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(125,'senior-compensation-analyst',20,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(126,'senior-accessibility-program-manager',21,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(127,'analyst-relations-manager-application-security',22,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(128,'senior-enterprise-advocate-emea',23,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(129,'deal-desk-manager',24,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(130,'director-revenue-compensation',25,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(131,'program-manager',26,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(132,'sr-manager-deal-desk-intl',27,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(133,'senior-director-product-management-actions-runners-and-compute-services',28,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(134,'alliances-director',29,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(135,'corporate-sales-representative',30,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(136,'country-leader',31,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(137,'customer-success-architect',32,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(138,'devops-account-executive-us-public-sector',33,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(139,'enterprise-account-executive',34,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(140,'senior-engineering-manager-product-security-engineering-paved-paths',35,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(141,'customer-reliability-engineer-iii',36,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(142,'support-engineer-enterprise-support-japanese',37,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(143,'technical-partner-manager',38,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(144,'sr-manager-inside-account-management',39,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(145,'services-sales-representative',40,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(146,'services-delivery-manager',41,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(147,'senior-solutions-engineer',42,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(148,'senior-service-delivery-engineer',43,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(149,'senior-director-global-sales-development',44,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(150,'partner-program-manager',45,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(151,'principal-cloud-solutions-engineer',46,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(152,'senior-cloud-solutions-engineer',47,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(153,'senior-customer-success-manager',48,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(154,'inside-account-manager',49,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(155,'ux-jobs-board',50,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(156,'senior-laravel-developer-tall-stack',51,'Botble\\JobBoard\\Models\\Job','jobs','2025-12-23 19:31:45','2025-12-23 19:31:45'),(157,'mervin',1,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:46','2025-12-23 19:32:11'),(158,'earnestine',2,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:46','2025-12-23 19:32:11'),(159,'sarah',3,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:47','2025-12-23 19:32:11'),(160,'steven',4,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:47','2025-12-23 19:32:11'),(161,'wiliam',5,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:47','2025-12-23 19:32:11'),(162,'samir',6,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:47','2025-12-23 19:32:11'),(163,'savannah',7,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:48','2025-12-23 19:32:11'),(164,'fiona',8,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:48','2025-12-23 19:32:11'),(165,'mariana',9,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:48','2025-12-23 19:32:11'),(166,'jerad',10,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:48','2025-12-23 19:32:11'),(167,'hillary',11,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:48','2025-12-23 19:32:11'),(168,'kris',12,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:49','2025-12-23 19:32:11'),(169,'harry',13,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:49','2025-12-23 19:32:11'),(170,'nedra',14,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:49','2025-12-23 19:32:11'),(171,'ola',15,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:49','2025-12-23 19:32:11'),(172,'king',16,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:50','2025-12-23 19:32:11'),(173,'dillon',17,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:50','2025-12-23 19:32:11'),(174,'kenyatta',18,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:50','2025-12-23 19:32:11'),(175,'osbaldo',19,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:50','2025-12-23 19:32:11'),(176,'heaven',20,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:51','2025-12-23 19:32:11'),(177,'lew',21,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:51','2025-12-23 19:32:11'),(178,'brielle',22,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:51','2025-12-23 19:32:11'),(179,'valerie',23,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:51','2025-12-23 19:32:11'),(180,'efrain',24,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:52','2025-12-23 19:32:11'),(181,'christine',25,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:52','2025-12-23 19:32:11'),(182,'rosemary',26,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:52','2025-12-23 19:32:11'),(183,'vernie',27,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:52','2025-12-23 19:32:11'),(184,'garrett',28,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:52','2025-12-23 19:32:11'),(185,'alia',29,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:53','2025-12-23 19:32:11'),(186,'tony',30,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:53','2025-12-23 19:32:11'),(187,'nadia',31,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:53','2025-12-23 19:32:11'),(188,'arely',32,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:53','2025-12-23 19:32:11'),(189,'merle',33,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:54','2025-12-23 19:32:11'),(190,'keegan',34,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:54','2025-12-23 19:32:11'),(191,'celia',35,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:54','2025-12-23 19:32:11'),(192,'kailey',36,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:54','2025-12-23 19:32:11'),(193,'marion',37,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:55','2025-12-23 19:32:11'),(194,'marco',38,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:55','2025-12-23 19:32:11'),(195,'estel',39,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:55','2025-12-23 19:32:11'),(196,'wellington',40,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:55','2025-12-23 19:32:11'),(197,'enrique',41,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:56','2025-12-23 19:32:11'),(198,'dorothy',42,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:56','2025-12-23 19:32:11'),(199,'andy',43,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:56','2025-12-23 19:32:11'),(200,'gladyce',44,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:56','2025-12-23 19:32:11'),(201,'kamryn',45,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:57','2025-12-23 19:32:11'),(202,'maurice',46,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:57','2025-12-23 19:32:11'),(203,'zane',47,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:57','2025-12-23 19:32:11'),(204,'levi',48,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:57','2025-12-23 19:32:11'),(205,'ned',49,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:58','2025-12-23 19:32:11'),(206,'penelope',50,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:58','2025-12-23 19:32:11'),(207,'elisa',51,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:58','2025-12-23 19:32:11'),(208,'celestino',52,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:58','2025-12-23 19:32:11'),(209,'raquel',53,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:59','2025-12-23 19:32:11'),(210,'pearl',54,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:59','2025-12-23 19:32:11'),(211,'yolanda',55,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:59','2025-12-23 19:32:11'),(212,'ryder',56,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:31:59','2025-12-23 19:32:11'),(213,'arianna',57,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:00','2025-12-23 19:32:11'),(214,'sienna',58,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:00','2025-12-23 19:32:11'),(215,'rossie',59,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:00','2025-12-23 19:32:11'),(216,'julia',60,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:00','2025-12-23 19:32:11'),(217,'maybell',61,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:01','2025-12-23 19:32:11'),(218,'luciano',62,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:01','2025-12-23 19:32:11'),(219,'kaia',63,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:01','2025-12-23 19:32:11'),(220,'electa',64,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:01','2025-12-23 19:32:11'),(221,'rafaela',65,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:01','2025-12-23 19:32:11'),(222,'della',66,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:02','2025-12-23 19:32:11'),(223,'grayce',67,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:02','2025-12-23 19:32:11'),(224,'pearline',68,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:02','2025-12-23 19:32:11'),(225,'skylar',69,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:02','2025-12-23 19:32:11'),(226,'horace',70,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:03','2025-12-23 19:32:11'),(227,'maryam',71,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:03','2025-12-23 19:32:11'),(228,'howard',72,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:03','2025-12-23 19:32:11'),(229,'marion',73,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:03','2025-12-23 19:32:11'),(230,'delbert',74,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:04','2025-12-23 19:32:11'),(231,'norbert',75,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:04','2025-12-23 19:32:11'),(232,'brandyn',76,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:04','2025-12-23 19:32:11'),(233,'damaris',77,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:04','2025-12-23 19:32:11'),(234,'antonette',78,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:05','2025-12-23 19:32:11'),(235,'shaniya',79,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:05','2025-12-23 19:32:11'),(236,'amari',80,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:05','2025-12-23 19:32:11'),(237,'elza',81,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:05','2025-12-23 19:32:11'),(238,'florence',82,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:06','2025-12-23 19:32:11'),(239,'susanna',83,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:06','2025-12-23 19:32:11'),(240,'colin',84,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:06','2025-12-23 19:32:11'),(241,'gavin',85,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:06','2025-12-23 19:32:11'),(242,'euna',86,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:07','2025-12-23 19:32:11'),(243,'ramiro',87,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:07','2025-12-23 19:32:11'),(244,'ray',88,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:07','2025-12-23 19:32:11'),(245,'jarrod',89,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:07','2025-12-23 19:32:11'),(246,'citlalli',90,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:08','2025-12-23 19:32:11'),(247,'albin',91,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:08','2025-12-23 19:32:11'),(248,'glen',92,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:08','2025-12-23 19:32:11'),(249,'jerrell',93,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:08','2025-12-23 19:32:11'),(250,'flavio',94,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:09','2025-12-23 19:32:11'),(251,'juvenal',95,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:09','2025-12-23 19:32:11'),(252,'nya',96,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:09','2025-12-23 19:32:11'),(253,'eulah',97,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:09','2025-12-23 19:32:11'),(254,'avis',98,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:10','2025-12-23 19:32:11'),(255,'skylar',99,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:10','2025-12-23 19:32:11'),(256,'tabitha',100,'Botble\\JobBoard\\Models\\Account','candidates','2025-12-23 19:32:10','2025-12-23 19:32:11');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'AI',1,'Botble\\ACL\\Models\\User',NULL,'published','2025-12-23 19:31:38','2025-12-23 19:31:38'),(2,'Machine Learning',1,'Botble\\ACL\\Models\\User',NULL,'published','2025-12-23 19:31:38','2025-12-23 19:31:38'),(3,'Neural Networks',1,'Botble\\ACL\\Models\\User',NULL,'published','2025-12-23 19:31:38','2025-12-23 19:31:38'),(4,'Data Security',1,'Botble\\ACL\\Models\\User',NULL,'published','2025-12-23 19:31:38','2025-12-23 19:31:38'),(5,'Blockchain',1,'Botble\\ACL\\Models\\User',NULL,'published','2025-12-23 19:31:38','2025-12-23 19:31:38'),(6,'Cryptocurrency',1,'Botble\\ACL\\Models\\User',NULL,'published','2025-12-23 19:31:38','2025-12-23 19:31:38'),(7,'IoT',1,'Botble\\ACL\\Models\\User',NULL,'published','2025-12-23 19:31:38','2025-12-23 19:31:38'),(8,'AR Gaming',1,'Botble\\ACL\\Models\\User',NULL,'published','2025-12-23 19:31:38','2025-12-23 19:31:38');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'Jeffrey Montgomery','Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless.','themes/jobzilla/testimonials/1.png','Product Manager','published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(2,'Rebecca Swartz','Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless.','themes/jobzilla/testimonials/2.png','Creative Designer','published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(3,'Charles Dickens','Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless.','themes/jobzilla/testimonials/3.png','Store Assistant','published','2025-12-23 19:32:10','2025-12-23 19:32:10'),(4,'Daniel L. Estrada','Very well thought out and articulate communication. Clear milestones, deadlines and fast work. Patience. Infinite patience. No shortcuts. Even if the client is being careless.','themes/jobzilla/testimonials/4.png','Rickel','published','2025-12-23 19:32:10','2025-12-23 19:32:10');
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
INSERT INTO `users` VALUES (1,'admin@company.com',NULL,NULL,'$2y$12$6Vj1AZaugxsk.juktt7lx.V27D8hOIKPxQFRk1X3wXSH09iFsYoNC',NULL,'2025-12-23 19:31:36','2025-12-23 19:31:36','System','Admin','admin',NULL,1,1,NULL,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widgets`
--

LOCK TABLES `widgets` WRITE;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
INSERT INTO `widgets` VALUES (1,'NewsletterWidget','pre_footer_sidebar','jobcy',0,'{\"id\":\"NewsletterWidget\",\"title\":\"Get New Jobs Notification!\",\"subtitle\":\"Join our email subscription now to get updates on new jobs and notifications.\"}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(2,'SiteInfoWidget','footer_sidebar','jobcy',0,'{\"id\":\"SiteInfoWidget\",\"name\":\"Site Information\",\"logo\":\"themes\\/jobzilla\\/general\\/logo-light.png\",\"description\":\"Many desktop publishing packages and web page editors now.\",\"address\":\"65 Sunset CA 90026, USA\",\"phone\":\"555-555-1234\",\"email\":\"example@max.com\"}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(3,'CustomMenuWidget','footer_sidebar','jobcy',1,'{\"id\":\"CustomMenuWidget\",\"name\":\"For Candidate\",\"menu_id\":\"for-candidate\"}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(4,'CustomMenuWidget','footer_sidebar','jobcy',2,'{\"id\":\"CustomMenuWidget\",\"name\":\"For Employers\",\"menu_id\":\"for-employers\"}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(5,'CustomMenuWidget','footer_sidebar','jobcy',3,'{\"id\":\"CustomMenuWidget\",\"name\":\"Helpful Resources\",\"menu_id\":\"helpful-resources\"}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(6,'CustomMenuWidget','footer_sidebar','jobcy',4,'{\"id\":\"CustomMenuWidget\",\"name\":\"Quick Links\",\"menu_id\":\"quick-links\"}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(7,'BlogSearchWidget','primary_sidebar','jobcy',1,'{\"id\":\"BlogSearchWidget\",\"name\":\"Search\"}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(8,'BlogCategoriesWidget','primary_sidebar','jobcy',2,'{\"id\":\"BlogCategoriesWidget\",\"name\":\"Categories\"}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(9,'BlogPostsWidget','primary_sidebar','jobcy',3,'{\"id\":\"BlogPostsWidget\",\"type\":\"popular\",\"name\":\"Popular Posts\"}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(10,'BlogTagsWidget','primary_sidebar','jobcy',4,'{\"id\":\"BlogTagsWidget\",\"name\":\"Popular Tags\"}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(11,'AdsWidget','job_board_sidebar','jobcy',0,'{\"id\":\"AdsWidget\",\"name\":\"Ads\",\"title\":\"Recruiting?\",\"subtitle\":\"Get Best Matched Jobs On your Email. Add Resume NOW!\",\"background\":\"themes\\/jobzilla\\/general\\/add-bg.jpg\",\"button_name\":\"Read More\",\"button_url\":\"\\/\"}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(12,'BlogSearchWidget','blog_sidebar','jobcy',0,'{\"id\":\"BlogSearchWidget\"}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(13,'BlogPopularCategoriesWidget','blog_sidebar','jobcy',1,'{\"id\":\"BlogPopularCategoriesWidget\",\"name\":\"Categories\",\"number_display\":5}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(14,'BlogPostsWidget','blog_sidebar','jobcy',2,'{\"id\":\"BlogPostsWidget\",\"name\":\"Recent Articles\",\"number_display\":6}','2025-12-23 19:32:11','2025-12-23 19:32:11'),(15,'BlogPopularTagsWidget','blog_sidebar','jobcy',3,'{\"id\":\"BlogPopularTagsWidget\",\"name\":\"Tags\",\"number_display\":5}','2025-12-23 19:32:11','2025-12-23 19:32:11');
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

-- Dump completed on 2025-12-24  9:32:12
