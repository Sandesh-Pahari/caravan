<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RentalEnquiryController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Rental\RentalBookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('template.template');
});

Route::get('/contact', fn () => view('frontend.contact.contact'))->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public vehicle & booking routes
Route::prefix('rental')->name('rental.')->group(function () {
    Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');
    Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');

    // Booking
    Route::get('/bookings/create/{vehicle}', [RentalBookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings', [RentalBookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}/success', [RentalBookingController::class, 'bookingSuccess'])->name('bookings.success');

    // Payment (with_driver only)
    Route::get('/bookings/{booking}/payment', [RentalBookingController::class, 'payment'])->name('bookings.payment');
    Route::post('/bookings/{booking}/pay/stripe', [RentalBookingController::class, 'payStripe'])->name('bookings.pay.stripe');
    Route::post('/bookings/{booking}/pay/khalti', [RentalBookingController::class, 'payKhalti'])->name('bookings.pay.khalti');
    Route::post('/bookings/{booking}/pay/esewa', [RentalBookingController::class, 'payEsewa'])->name('bookings.pay.esewa');
    Route::get('/bookings/{booking}/payment/success', [RentalBookingController::class, 'paymentSuccess'])->name('bookings.payment.success');
});

// Admin vehicle routes (protected)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/trekking', fn () => view('admin.trekking.index'))->name('trekking.index');
    Route::get('/rental', fn () => view('admin.rental.index'))->name('rental.index');
    Route::get('/rental/vehicles', fn () => redirect()->route('rental.vehicles.index'));
    Route::resource('rental/vehicles', VehicleController::class)->names('rental.vehicles')
        ->only(['create', 'store', 'edit', 'update', 'destroy']);

    // Rental enquiries & paid bookings management
    Route::get('/rental/enquiries', [RentalEnquiryController::class, 'index'])->name('rental.enquiries.index');
    Route::get('/rental/enquiries/{rentalBooking}', [RentalEnquiryController::class, 'show'])->name('rental.enquiries.show');
    Route::post('/notifications/mark-all-read', [RentalEnquiryController::class, 'markAllRead'])->name('notifications.mark-all-read');
});

require __DIR__.'/auth.php';
