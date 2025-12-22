<?php

namespace App\Http\Controllers\Rental;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRentalBookingRequest;
use App\Models\RentalBooking;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class RentalBookingController extends Controller
{
    public function create(Vehicle $vehicle): View
    {
        $vehicles = Vehicle::query()->orderBy('vehicle_name')->get();

        return view('frontend.rental.book', compact('vehicle', 'vehicles'));
    }

    public function store(StoreRentalBookingRequest $request): RedirectResponse
    {
        $data = $request->safe()->except(['identity_document', 'drivers_license']);

        $vehicle = Vehicle::query()->findOrFail($request->vehicle_id);

        if ($request->booking_type === 'with_driver') {
            $data['total_amount'] = $vehicle->driver_allowance * $request->days_taken
                * (1 + $vehicle->profit_margin / 100);
            $data['payment_status'] = 'pending';
        }

        if ($request->hasFile('identity_document')) {
            $data['identity_document'] = $request->file('identity_document')
                ->store('bookings/documents', 'public');
        }

        if ($request->hasFile('drivers_license')) {
            $data['drivers_license'] = $request->file('drivers_license')
                ->store('bookings/documents', 'public');
        }

        $booking = RentalBooking::query()->create($data);

        if ($booking->booking_type === 'with_driver') {
            return redirect()->route('rental.bookings.payment', $booking)
                ->with('success', 'Booking confirmed! Please complete your payment.');
        }

        return redirect()->route('rental.bookings.success', $booking);
    }

    public function payment(RentalBooking $booking): View
    {
        $booking->load('vehicle');

        return view('frontend.rental.payment', compact('booking'));
    }

    public function payStripe(Request $request, RentalBooking $booking): RedirectResponse
    {
        $amountInCents = (int) ($booking->total_amount * 100);

        $response = Http::asForm()
            ->withBasicAuth(config('services.stripe.secret'), '')
            ->post('https://api.stripe.com/v1/checkout/sessions', [
                'payment_method_types[]' => 'card',
                'line_items[0][price_data][currency]' => 'npr',
                'line_items[0][price_data][unit_amount]' => $amountInCents,
                'line_items[0][price_data][product_data][name]' => 'Vehicle Rental – '.$booking->vehicle->vehicle_name,
                'line_items[0][price_data][product_data][description]' => $booking->days_taken.' day(s) with driver',
                'line_items[0][quantity]' => 1,
                'mode' => 'payment',
                'customer_email' => $booking->email,
                'success_url' => route('rental.bookings.payment.success', $booking).'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('rental.bookings.payment', $booking),
                'metadata[booking_id]' => $booking->id,
            ]);

        if ($response->failed()) {
            return back()->with('error', 'Stripe payment could not be initiated. Please try another method.');
        }

        $booking->update(['payment_method' => 'stripe']);

        return redirect($response->json('url'));
    }

    public function payKhalti(Request $request, RentalBooking $booking): RedirectResponse
    {
        $amountInPaisa = (int) ($booking->total_amount * 100);

        $response = Http::withHeaders([
            'Authorization' => 'Key '.config('services.khalti.secret_key'),
        ])->post('https://a.khalti.com/api/v2/epayment/initiate/', [
            'return_url' => route('rental.bookings.payment.success', $booking),
            'website_url' => config('app.url'),
            'amount' => $amountInPaisa,
            'purchase_order_id' => 'BOOKING-'.$booking->id,
            'purchase_order_name' => 'Vehicle Rental – '.$booking->vehicle->vehicle_name,
            'customer_info' => [
                'name' => $booking->name,
                'email' => $booking->email,
                'phone' => $booking->phone_number,
            ],
        ]);

        if ($response->failed()) {
            return back()->with('error', 'Khalti payment could not be initiated. Please try another method.');
        }

        $booking->update(['payment_method' => 'khalti']);

        return redirect($response->json('payment_url'));
    }

    public function payEsewa(Request $request, RentalBooking $booking): View
    {
        $booking->update(['payment_method' => 'esewa']);

        $amount = number_format((float) $booking->total_amount, 2, '.', '');
        $productId = 'BOOKING-'.$booking->id;
        $successUrl = route('rental.bookings.payment.success', $booking);
        $failureUrl = route('rental.bookings.payment', $booking);

        return view('frontend.rental.esewa-redirect', compact(
            'booking',
            'amount',
            'productId',
            'successUrl',
            'failureUrl',
        ));
    }

    public function paymentSuccess(Request $request, RentalBooking $booking): View
    {
        $reference = $request->query('session_id')
            ?? $request->query('transaction_id')
            ?? $request->query('refId')
            ?? null;

        $booking->update([
            'payment_status' => 'paid',
            'payment_reference' => $reference,
            'status' => 'confirmed',
        ]);

        return view('frontend.rental.booking-success', compact('booking'));
    }

    public function bookingSuccess(RentalBooking $booking): View
    {
        $booking->load('vehicle');

        return view('frontend.rental.booking-success', compact('booking'));
    }
}
