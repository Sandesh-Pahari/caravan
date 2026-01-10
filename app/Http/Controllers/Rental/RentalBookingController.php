<?php

namespace App\Http\Controllers\Rental;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRentalBookingRequest;
use App\Mail\EnquiryAcknowledgementMail;
use App\Models\RentalBooking;
use App\Models\User;
use App\Models\Vehicle;
use App\Notifications\NewRentalEnquiryNotification;
use App\Notifications\RentalPaymentCompletedNotification;
use App\Services\DistanceService;
use App\Services\FareCalculationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use RuntimeException;

class RentalBookingController extends Controller
{
    public function __construct(
        private readonly DistanceService $distanceService,
        private readonly FareCalculationService $fareService,
    ) {}

    public function create(Vehicle $vehicle): View
    {
        $vehicles = Vehicle::query()->orderBy('vehicle_name')->get();

        return view('frontend.rental.book', compact('vehicle', 'vehicles'));
    }

    public function store(StoreRentalBookingRequest $request): RedirectResponse
    {
        $vehicle = Vehicle::query()->findOrFail($request->vehicle_id);

        $isEnquiry = $request->booking_type === 'self_drive'
            || $request->boolean('enquiry_only');

        $data = $request->safe()->except([
            'identity_document',
            'drivers_license',
            'distance_km',
            'enquiry_only',
        ]);

        $data['is_enquiry'] = $isEnquiry;

        if ($request->booking_type === 'with_driver') {
            try {
                $verifiedDistance = $this->distanceService->verify(
                    (float) $request->pickup_lat,
                    (float) $request->pickup_lng,
                    (float) $request->drop_lat,
                    (float) $request->drop_lng,
                );
            } catch (RuntimeException $e) {
                return back()->withInput()->with('error', $e->getMessage());
            }

            $fareBreakdown = $this->fareService->calculate(
                $vehicle,
                $verifiedDistance,
                (int) $request->days_taken,
                $request->trip_type,
            );

            $data['distance_km'] = $verifiedDistance;
            $data['chargeable_distance_km'] = $fareBreakdown['chargeable_distance_km'];
            $data['total_amount'] = $fareBreakdown['total'];
            $data['fare_breakdown'] = $fareBreakdown;
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

        $booking = DB::transaction(fn () => RentalBooking::query()->create($data));

        if ($isEnquiry) {
            $this->dispatchEnquiryNotifications($booking);

            return redirect()->route('rental.bookings.success', $booking);
        }

        return redirect()->route('rental.bookings.payment', $booking)
            ->with('success', 'Booking confirmed! Please complete your payment.');
    }

    /** Send DB notification to all admins and acknowledgement email to customer. */
    private function dispatchEnquiryNotifications(RentalBooking $booking): void
    {
        $booking->load('vehicle');

        User::all()->each(fn (User $admin) => $admin->notify(new NewRentalEnquiryNotification($booking)));

        try {
            Mail::to($booking->email)->send(new EnquiryAcknowledgementMail($booking));
        } catch (\Throwable) {
            // Mail failure must not block the booking flow
        }
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
                'line_items[0][price_data][product_data][description]' => $booking->days_taken.' day(s) · '.($booking->trip_type === 'one_way' ? 'One Way' : 'Round Trip'),
                'line_items[0][quantity]' => 1,
                'mode' => 'payment',
                'customer_email' => $booking->email,
                'success_url' => route('rental.bookings.payment.success', $booking).'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('rental.bookings.payment', $booking),
                'metadata[booking_id]' => $booking->id,
            ]);

        if ($response->failed()) {
            $stripeError = $response->json('error.message') ?? 'Stripe payment could not be initiated. Please try another method.';

            return back()->with('error', $stripeError);
        }

        $booking->update(['payment_method' => 'stripe']);

        return redirect($response->json('url'));
    }

    public function payKhalti(Request $request, RentalBooking $booking): RedirectResponse
    {
        $amountInPaisa = (int) ($booking->total_amount * 100);

        // withoutVerifying() works around outdated cURL/OpenSSL in local XAMPP environments.
        $response = Http::withoutVerifying()
            ->withHeaders([
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
                    'phone' => substr($booking->phone_number, 0, 16),
                ],
            ]);

        if ($response->failed()) {
            $error = $response->json('detail') ?? $response->json('message')
                ?? 'Khalti payment could not be initiated. Please try another method.';

            return back()->with('error', $error);
        }

        $booking->update(['payment_method' => 'khalti']);

        return redirect($response->json('payment_url'));
    }

    public function payEsewa(Request $request, RentalBooking $booking): View
    {
        $booking->update(['payment_method' => 'esewa']);

        $amount = number_format((float) $booking->total_amount, 2, '.', '');
        $transactionUuid = 'BOOKING-'.$booking->id.'-'.time();
        $productCode = config('services.esewa.merchant_code');
        $signedFieldNames = 'total_amount,transaction_uuid,product_code';

        $signature = base64_encode(
            hash_hmac(
                'sha256',
                "total_amount={$amount},transaction_uuid={$transactionUuid},product_code={$productCode}",
                config('services.esewa.secret_key'),
                true
            )
        );

        $successUrl = route('rental.bookings.payment.success', $booking);
        $failureUrl = route('rental.bookings.payment', $booking);

        return view('frontend.rental.esewa-redirect', compact(
            'booking',
            'amount',
            'transactionUuid',
            'productCode',
            'signedFieldNames',
            'signature',
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

        if (! $reference && $request->has('data')) {
            $esewaPayload = json_decode(base64_decode($request->query('data')), true);
            $reference = $esewaPayload['transaction_code'] ?? $esewaPayload['transaction_uuid'] ?? null;
        }

        $booking->update([
            'payment_status' => 'paid',
            'payment_reference' => $reference,
            'status' => 'confirmed',
        ]);

        $booking->load('vehicle');
        User::all()->each(fn (User $admin) => $admin->notify(new RentalPaymentCompletedNotification($booking)));

        return view('frontend.rental.booking-success', compact('booking'));
    }

    public function bookingSuccess(RentalBooking $booking): View
    {
        $booking->load('vehicle');

        return view('frontend.rental.booking-success', compact('booking'));
    }
}
