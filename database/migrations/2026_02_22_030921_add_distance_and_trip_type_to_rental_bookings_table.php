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
        Schema::table('rental_bookings', function (Blueprint $table) {
            $table->enum('trip_type', ['one_way', 'round_trip'])->nullable()->after('booking_type');
            $table->decimal('distance_km', 8, 2)->nullable()->after('drop_address');
            $table->decimal('chargeable_distance_km', 8, 2)->nullable()->after('distance_km');
            $table->decimal('pickup_lat', 10, 7)->nullable()->after('chargeable_distance_km');
            $table->decimal('pickup_lng', 10, 7)->nullable()->after('pickup_lat');
            $table->decimal('drop_lat', 10, 7)->nullable()->after('pickup_lng');
            $table->decimal('drop_lng', 10, 7)->nullable()->after('drop_lat');
            $table->json('fare_breakdown')->nullable()->after('total_amount');
        });
    }

    public function down(): void
    {
        Schema::table('rental_bookings', function (Blueprint $table) {
            $table->dropColumn([
                'trip_type',
                'distance_km',
                'chargeable_distance_km',
                'pickup_lat',
                'pickup_lng',
                'drop_lat',
                'drop_lng',
                'fare_breakdown',
            ]);
        });
    }
};
