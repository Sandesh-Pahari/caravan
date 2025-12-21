<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRentalBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'vehicle_id' => ['required', 'exists:vehicles,id'],
            'booking_type' => ['required', 'in:with_driver,self_drive'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'pickup_time' => ['required', 'date_format:H:i'],
            'days_taken' => ['required', 'integer', 'min:1'],
        ];

        if ($this->input('booking_type') === 'with_driver') {
            $rules['pickup_address'] = ['required', 'string', 'max:500'];
            $rules['drop_address'] = ['required', 'string', 'max:500'];
        }

        if ($this->input('booking_type') === 'self_drive') {
            $rules['pickup_location'] = ['required', 'string', 'max:500'];
            $rules['identity_document'] = ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'];
            $rules['drivers_license'] = ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'vehicle_id.required' => 'Please select a vehicle.',
            'date.after_or_equal' => 'Booking date must be today or a future date.',
            'identity_document.required' => 'Identity document is required for self drive.',
            'drivers_license.required' => 'Driver\'s license is required for self drive.',
            'identity_document.mimes' => 'Identity document must be a JPG, PNG, or PDF.',
            'drivers_license.mimes' => 'Driver\'s license must be a JPG, PNG, or PDF.',
        ];
    }
}
