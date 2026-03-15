# Fix: Notifications Not Working After Database Change

## 🔴 Problem

Aapne `.env` file mein database change kiya, aur ab notifications nahi aa rahi.

**Error:** `Table 'teachers.jb_user_notifications' doesn't exist`

## ✅ Solution

Nayi database mein `jb_user_notifications` table create karni hogi.

### Option 1: SQL Query Run Karein (Recommended)

1. **phpMyAdmin** ya **MySQL client** mein nayi database open karein
2. **SQL tab** mein ye query run karein:

```sql
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
```

3. Query run karne ke baad table create ho jayegi
4. Ab notifications kaam karengi!

### Option 2: Migration Force Run Karein

Terminal mein ye command run karein:

```bash
php artisan migrate --path=platform/plugins/job-board/database/migrations/2026_02_28_100000_create_jb_user_notifications_table.php --force
```

**Note:** Production mode mein `--force` flag zaroori hai.

### Option 3: SQL File Import Karein

1. `FIX_NOTIFICATION_TABLE.sql` file open karein
2. SQL query copy karein
3. phpMyAdmin ya MySQL client mein run karein

## ✅ Verification

Table create hone ke baad verify karein:

```sql
-- Check if table exists
SHOW TABLES LIKE 'jb_user_notifications';

-- Check table structure
DESCRIBE jb_user_notifications;

-- Check if any notifications exist
SELECT COUNT(*) FROM jb_user_notifications;
```

## 🎯 After Fix

1. ✅ Table create ho jayegi
2. ✅ Notifications save hone lagengi
3. ✅ Email + WhatsApp dono kaam karengi
4. ✅ Notification page par notifications dikhengi

## ⚠️ Important Notes

1. **Database name** - `.env` file mein jo database name hai, usi mein table create hogi
2. **Foreign key** - `jb_accounts` table pehle se honi chahiye
3. **Permissions** - Database user ko CREATE TABLE permission honi chahiye

## 🔍 Check Logs

Agar phir bhi issue ho, to logs check karein:

```bash
tail -f storage/logs/laravel.log | grep -i notification
```

## 📝 Quick Fix Summary

**Problem:** Table missing in new database  
**Solution:** Run SQL query to create table  
**Time:** 1 minute  
**Result:** Notifications will work again!
