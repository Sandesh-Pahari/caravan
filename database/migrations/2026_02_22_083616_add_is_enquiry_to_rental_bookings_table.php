<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rental_bookings', function (Blueprint $table) {
            $table->boolean('is_enquiry')->default(false)->after('booking_type');
            $table->timestamp('admin_read_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('rental_bookings', function (Blueprint $table) {
            $table->dropColumn(['is_enquiry', 'admin_read_at']);
        });
    }
};
