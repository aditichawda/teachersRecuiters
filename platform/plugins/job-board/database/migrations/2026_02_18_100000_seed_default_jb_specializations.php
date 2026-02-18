<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    public function up(): void
    {
        if (! \Illuminate\Support\Facades\Schema::hasTable('jb_specializations')) {
            return;
        }

        $count = DB::table('jb_specializations')->count();
        if ($count > 0) {
            return;
        }

        $defaults = [
            ['name' => 'Mathematics', 'order' => 1, 'is_default' => 0, 'status' => 'published'],
            ['name' => 'Science', 'order' => 2, 'is_default' => 0, 'status' => 'published'],
            ['name' => 'English', 'order' => 3, 'is_default' => 0, 'status' => 'published'],
            ['name' => 'Hindi', 'order' => 4, 'is_default' => 0, 'status' => 'published'],
            ['name' => 'Social Studies', 'order' => 5, 'is_default' => 0, 'status' => 'published'],
            ['name' => 'Computer Science', 'order' => 6, 'is_default' => 0, 'status' => 'published'],
            ['name' => 'Physics', 'order' => 7, 'is_default' => 0, 'status' => 'published'],
            ['name' => 'Chemistry', 'order' => 8, 'is_default' => 0, 'status' => 'published'],
            ['name' => 'Biology', 'order' => 9, 'is_default' => 0, 'status' => 'published'],
            ['name' => 'Other', 'order' => 99, 'is_default' => 1, 'status' => 'published'],
        ];

        $now = now();
        foreach ($defaults as $row) {
            $row['created_at'] = $now;
            $row['updated_at'] = $now;
        }
        DB::table('jb_specializations')->insert($defaults);
    }

    public function down(): void
    {
        // Optional: remove only seeded defaults by name if you want rollback
        DB::table('jb_specializations')->whereIn('name', [
            'Mathematics', 'Science', 'English', 'Hindi', 'Social Studies',
            'Computer Science', 'Physics', 'Chemistry', 'Biology', 'Other',
        ])->delete();
    }
};
