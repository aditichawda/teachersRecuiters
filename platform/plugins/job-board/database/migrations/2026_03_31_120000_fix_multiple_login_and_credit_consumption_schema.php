<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        // 1) Multiple Login: jb_accounts.sub_account_role must be a string (role label)
        if (Schema::hasTable('jb_accounts') && Schema::hasColumn('jb_accounts', 'sub_account_role')) {
            try {
                $col = DB::selectOne(
                    "SELECT DATA_TYPE AS data_type
                     FROM INFORMATION_SCHEMA.COLUMNS
                     WHERE TABLE_SCHEMA = DATABASE()
                       AND TABLE_NAME = 'jb_accounts'
                       AND COLUMN_NAME = 'sub_account_role'
                     LIMIT 1"
                );

                $type = strtolower((string) ($col->data_type ?? ''));

                // If it's numeric (int/tinyint), convert to varchar(60)
                if (in_array($type, ['int', 'tinyint', 'smallint', 'mediumint', 'bigint'], true)) {
                    DB::statement("ALTER TABLE `jb_accounts` MODIFY `sub_account_role` VARCHAR(60) NULL");
                }
            } catch (\Throwable $e) {
                // Don't block deploy if DB user doesn't have permissions; controller shows a clear error anyway.
            }
        }

        // 2) Credit consumption: status must be string values that match BaseStatusEnum (published/draft/pending)
        if (Schema::hasTable('jb_credit_consumption') && Schema::hasColumn('jb_credit_consumption', 'status')) {
            try {
                $col = DB::selectOne(
                    "SELECT DATA_TYPE AS data_type
                     FROM INFORMATION_SCHEMA.COLUMNS
                     WHERE TABLE_SCHEMA = DATABASE()
                       AND TABLE_NAME = 'jb_credit_consumption'
                       AND COLUMN_NAME = 'status'
                     LIMIT 1"
                );

                $type = strtolower((string) ($col->data_type ?? ''));

                // If numeric, map common values then convert to varchar
                if (in_array($type, ['int', 'tinyint', 'smallint', 'mediumint', 'bigint'], true)) {
                    // Best-effort mapping:
                    // 1 => published, 0 => draft, other => pending
                    DB::statement("UPDATE `jb_credit_consumption` SET `status` = 'published' WHERE `status` = 1");
                    DB::statement("UPDATE `jb_credit_consumption` SET `status` = 'draft' WHERE `status` = 0");
                    DB::statement("UPDATE `jb_credit_consumption` SET `status` = 'pending' WHERE `status` NOT IN ('published','draft','pending')");

                    DB::statement("ALTER TABLE `jb_credit_consumption` MODIFY `status` VARCHAR(60) NOT NULL DEFAULT 'published'");
                } else {
                    // If already varchar but contains legacy numeric strings, normalize too
                    DB::statement("UPDATE `jb_credit_consumption` SET `status` = 'published' WHERE `status` = '1'");
                    DB::statement("UPDATE `jb_credit_consumption` SET `status` = 'draft' WHERE `status` = '0'");
                }
            } catch (\Throwable $e) {
                // Ignore; safe fallback is to fix the bad rows manually on server
            }
        }
    }

    public function down(): void
    {
        // Intentionally no-op (schema down migrations are risky in production).
    }
};

