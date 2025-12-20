<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rental_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->enum('booking_type', ['with_driver', 'self_drive']);
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->date('date');
            $table->time('pickup_time');
            $table->unsignedInteger('days_taken');

            // With Driver fields
            $table->string('pickup_address')->nullable();
            $table->string('drop_address')->nullable();

            // Self Drive fields
            $table->string('pickup_location')->nullable();
            $table->string('identity_document')->nullable();
            $table->string('drivers_license')->nullable();

            // Payment (with_driver only)
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->nullable();
            $table->enum('payment_method', ['stripe', 'khalti', 'esewa'])->nullable();
            $table->string('payment_reference')->nullable();

            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rental_bookings');
    }
};
