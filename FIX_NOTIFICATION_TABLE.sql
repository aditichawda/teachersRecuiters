-- Fix: Create jb_user_notifications table in new database
-- Run this SQL query in your new database

CREATE TABLE IF NOT EXISTS `jb_user_notifications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `account_id` bigint unsigned NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'feather-bell',
  `color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#1967d2',
  `action_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `data` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jb_user_notifications_account_id_read_at_index` (`account_id`,`read_at`),
  KEY `jb_user_notifications_account_id_type_index` (`account_id`,`type`),
  KEY `jb_user_notifications_created_at_index` (`created_at`),
  CONSTRAINT `jb_user_notifications_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `jb_accounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
