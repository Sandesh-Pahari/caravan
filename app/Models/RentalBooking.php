<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RentalBooking extends Model
{
    protected $fillable = [
        'vehicle_id',
        'booking_type',
        'name',
        'email',
        'phone_number',
        'date',
        'pickup_time',
        'days_taken',
        'pickup_address',
        'drop_address',
        'pickup_location',
        'identity_document',
        'drivers_license',
        'total_amount',
        'payment_status',
        'payment_method',
        'payment_reference',
        'status',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'days_taken' => 'integer',
            'total_amount' => 'decimal:2',
        ];
    }
}
