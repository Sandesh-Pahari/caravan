<?php

use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminPolicyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RentalEnquiryController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Rental\RentalBookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $featuredVehicles = \App\Models\Vehicle::query()->latest()->limit(3)->get();
    $faqs = \App\Models\Faq::active()->get();
    $policies = \App\Models\Policy::active()->get();

    return view('frontend.home', compact('featuredVehicles', 'faqs', 'policies'));
})->name('home');

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
    Route::delete('/rental/enquiries/{rentalBooking}', [RentalEnquiryController::class, 'destroy'])->name('rental.enquiries.destroy');
    Route::post('/notifications/mark-all-read', [RentalEnquiryController::class, 'markAllRead'])->name('notifications.mark-all-read');

    // FAQs
    Route::resource('faqs', AdminFaqController::class)->names('faqs')
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    // Policies
    Route::resource('policies', AdminPolicyController::class)->names('policies')
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    // Contact messages
    Route::get('/contact', [AdminContactController::class, 'index'])->name('contact.index');
    Route::get('/contact/{contactMessage}', [AdminContactController::class, 'show'])->name('contact.show');
    Route::post('/contact/mark-all-read', [AdminContactController::class, 'markAllRead'])->name('contact.mark-all-read');
    Route::delete('/contact/{contactMessage}', [AdminContactController::class, 'destroy'])->name('contact.destroy');
});

require __DIR__.'/auth.php';
