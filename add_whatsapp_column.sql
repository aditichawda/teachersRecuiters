-- SQL query to add enable_whatsapp_notifications column to jb_jobs table
-- Run this query directly in your MySQL database

-- First, check if column already exists (optional - will show error if exists, but won't break)
-- You can skip this if you're sure column doesn't exist

-- Add the column
ALTER TABLE `jb_jobs` 
ADD COLUMN `enable_whatsapp_notifications` TINYINT(1) NOT NULL DEFAULT 0 
COMMENT 'Enable WhatsApp notifications for job applications'
AFTER `apply_internal_phones`;
