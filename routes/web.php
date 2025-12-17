<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template.template');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public vehicle routes (user-facing)
Route::prefix('rental')->name('rental.')->group(function () {
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
});

// Admin vehicle routes (protected)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/trekking', fn () => view('admin.trekking.index'))->name('trekking.index');
    Route::get('/rental', fn () => view('admin.rental.index'))->name('rental.index');
    Route::get('/rental/vehicles', fn () => redirect()->route('rental.vehicles.index'));
    Route::resource('rental/vehicles', VehicleController::class)->names('rental.vehicles')
        ->only(['create', 'store', 'edit', 'update', 'destroy']);
});

require __DIR__.'/auth.php';
