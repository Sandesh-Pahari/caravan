<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->decimal('oil_price', 10, 2)->nullable()->after('profit_margin');
            $table->decimal('fare_per_day', 10, 2)->nullable()->after('oil_price');
        });
    }

    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropColumn(['oil_price', 'fare_per_day']);
        });
    }
};
