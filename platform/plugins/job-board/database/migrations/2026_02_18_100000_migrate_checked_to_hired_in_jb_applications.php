<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    public function up(): void
    {
        DB::table('jb_applications')
            ->where('status', 'checked')
            ->update(['status' => 'hired']);
    }

    public function down(): void
    {
        DB::table('jb_applications')
            ->where('status', 'hired')
            ->update(['status' => 'checked']);
    }
};
