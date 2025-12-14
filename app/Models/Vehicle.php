<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_name',
        'vehicle_number',
        'color',
        'number_of_seats',
        'condition',
        'luggage_storage',
        'main_image',
        'mileage',
        'driver_allowance',
        'profit_margin',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(VehicleImage::class);
    }

    protected function casts(): array
    {
        return [
            'number_of_seats' => 'integer',
            'mileage' => 'decimal:2',
            'driver_allowance' => 'decimal:2',
            'profit_margin' => 'decimal:2',
        ];
    }
}
