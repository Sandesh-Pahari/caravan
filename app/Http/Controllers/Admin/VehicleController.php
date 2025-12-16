<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class VehicleController extends Controller
{
    public function index(): View
    {
        $vehicles = Vehicle::query()->latest()->get();

        return view('frontend.rental.index', compact('vehicles'));
    }

    public function create(): View
    {
        return view('frontend.rental.create');
    }

    public function store(StoreVehicleRequest $request): RedirectResponse
    {
        $mainImagePath = $request->file('main_image')->store('vehicles/main', 'public');

        $vehicle = Vehicle::create([
            ...$request->safe()->except(['main_image', 'additional_images']),
            'main_image' => $mainImagePath,
        ]);

        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $path = $image->store('vehicles/additional', 'public');
                $vehicle->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('rental.vehicles.index')
            ->with('success', 'Vehicle added successfully.');
    }

    public function show(Vehicle $vehicle): View
    {
        $vehicle->load('images');

        return view('frontend.rental.show', compact('vehicle'));
    }

    public function edit(Vehicle $vehicle): View
    {
        $vehicle->load('images');

        return view('frontend.rental.edit', compact('vehicle'));
    }

    public function update(UpdateVehicleRequest $request, Vehicle $vehicle): RedirectResponse
    {
        $data = $request->safe()->except(['main_image', 'additional_images']);

        if ($request->hasFile('main_image')) {
            Storage::disk('public')->delete($vehicle->main_image);
            $data['main_image'] = $request->file('main_image')->store('vehicles/main', 'public');
        }

        $vehicle->update($data);

        if ($request->hasFile('additional_images')) {
            foreach ($vehicle->images as $oldImage) {
                Storage::disk('public')->delete($oldImage->image_path);
            }
            $vehicle->images()->delete();

            foreach ($request->file('additional_images') as $image) {
                $path = $image->store('vehicles/additional', 'public');
                $vehicle->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('rental.vehicles.index')
            ->with('success', 'Vehicle updated successfully.');
    }

    public function destroy(Vehicle $vehicle): RedirectResponse
    {
        Storage::disk('public')->delete($vehicle->main_image);

        foreach ($vehicle->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $vehicle->delete();

        return redirect()->route('rental.vehicles.index')
            ->with('success', 'Vehicle deleted successfully.');
    }
}
