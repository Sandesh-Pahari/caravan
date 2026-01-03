<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalBooking extends Model
{
    protected $fillable = [
        'vehicle_id',
        'booking_type',
        'is_enquiry',
        'trip_type',
        'name',
        'email',
        'phone_number',
        'date',
        'pickup_time',
        'days_taken',
        'pickup_address',
        'drop_address',
        'distance_km',
        'chargeable_distance_km',
        'pickup_lat',
        'pickup_lng',
        'drop_lat',
        'drop_lng',
        'pickup_location',
        'identity_document',
        'drivers_license',
        'total_amount',
        'fare_breakdown',
        'payment_status',
        'payment_method',
        'payment_reference',
        'status',
        'admin_read_at',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'is_enquiry' => 'boolean',
            'admin_read_at' => 'datetime',
            'days_taken' => 'integer',
            'distance_km' => 'decimal:2',
            'chargeable_distance_km' => 'decimal:2',
            'pickup_lat' => 'decimal:7',
            'pickup_lng' => 'decimal:7',
            'drop_lat' => 'decimal:7',
            'drop_lng' => 'decimal:7',
            'total_amount' => 'decimal:2',
            'fare_breakdown' => 'array',
        ];
    }
}
