<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table): void {
            if (! Schema::hasColumn('jb_accounts', 'introductory_audio')) {
                $table->string('introductory_audio', 500)->nullable()->after('cover_letter')
                    ->comment('Job seeker self-introduction audio file path/URL');
            }
            if (! Schema::hasColumn('jb_accounts', 'introductory_audio_duration')) {
                $table->unsignedInteger('introductory_audio_duration')->nullable()->after('introductory_audio')
                    ->comment('Audio duration in seconds');
            }
            if (! Schema::hasColumn('jb_accounts', 'introductory_video_url')) {
                $table->string('introductory_video_url', 500)->nullable()->after('introductory_audio_duration')
                    ->comment('Job seeker intro video URL (e.g. YouTube)');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_accounts', function (Blueprint $table): void {
            if (Schema::hasColumn('jb_accounts', 'introductory_video_url')) {
                $table->dropColumn('introductory_video_url');
            }
            if (Schema::hasColumn('jb_accounts', 'introductory_audio_duration')) {
                $table->dropColumn('introductory_audio_duration');
            }
            if (Schema::hasColumn('jb_accounts', 'introductory_audio')) {
                $table->dropColumn('introductory_audio');
            }
        });
    }
};
