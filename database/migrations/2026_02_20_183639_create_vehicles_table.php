<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();

            // Publicly visible fields
            $table->string('vehicle_name');
            $table->string('vehicle_number')->unique();
            $table->string('color');
            $table->unsignedInteger('number_of_seats');
            $table->enum('condition', ['new', 'good', 'average', 'old']);
            $table->enum('luggage_storage', ['boot', 'head', 'both', 'neither']);

            // Main image (shown on index/list)
            $table->string('main_image');

            // Backend-only pricing fields (not publicly displayed)
            $table->decimal('mileage', 10, 2);
            $table->decimal('driver_allowance', 10, 2);
            $table->decimal('profit_margin', 5, 2);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
