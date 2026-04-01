<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('jb_invoices', function (Blueprint $table): void {
            if (! Schema::hasColumn('jb_invoices', 'customer_gst_number')) {
                $table->string('customer_gst_number', 50)->nullable()->after('tax_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('jb_invoices', function (Blueprint $table): void {
            $table->dropColumn('customer_gst_number');
        });
    }
};
