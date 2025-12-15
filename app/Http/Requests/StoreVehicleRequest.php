<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, array<int, mixed>> */
    public function rules(): array
    {
        return [
            'vehicle_name' => ['required', 'string', 'max:255'],
            'vehicle_number' => ['required', 'string', 'max:100', 'unique:vehicles,vehicle_number'],
            'color' => ['required', 'string', 'max:100'],
            'number_of_seats' => ['required', 'integer', 'min:1'],
            'condition' => ['required', 'in:new,good,average,old'],
            'luggage_storage' => ['required', 'in:boot,head,both,neither'],
            'main_image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'additional_images' => ['nullable', 'array', 'max:3'],
            'additional_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'mileage' => ['required', 'numeric', 'min:0'],
            'driver_allowance' => ['required', 'numeric', 'min:0'],
            'profit_margin' => ['required', 'numeric', 'min:0'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'vehicle_number.unique' => 'This vehicle number is already registered.',
            'main_image.required' => 'A main image is required.',
            'additional_images.max' => 'You may upload a maximum of 3 additional images.',
            'additional_images.*.image' => 'Each additional file must be a valid image.',
        ];
    }
}
