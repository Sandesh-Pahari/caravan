<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentalBooking;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RentalEnquiryController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->query('filter', 'all');

        $query = RentalBooking::query()
            ->with('vehicle')
            ->where(function ($q) {
                $q->where('is_enquiry', true)
                    ->orWhere('payment_status', 'paid');
            })
            ->latest();

        if ($filter === 'enquiries') {
            $query->where('is_enquiry', true);
        } elseif ($filter === 'paid') {
            $query->where('payment_status', 'paid')->where('is_enquiry', false);
        } elseif ($filter === 'unread') {
            $query->whereNull('admin_read_at');
        }

        $records = $query->paginate(20)->withQueryString();

        $unreadCount = RentalBooking::query()
            ->where(function ($q) {
                $q->where('is_enquiry', true)->orWhere('payment_status', 'paid');
            })
            ->whereNull('admin_read_at')
            ->count();

        return view('admin.rental.enquiries.index', compact('records', 'filter', 'unreadCount'));
    }

    public function show(RentalBooking $rentalBooking): View
    {
        $rentalBooking->load('vehicle');

        if (! $rentalBooking->admin_read_at) {
            $rentalBooking->update(['admin_read_at' => now()]);

            // Mark associated DB notifications as read
            auth()->user()
                ->unreadNotifications()
                ->whereJsonContains('data->booking_id', $rentalBooking->id)
                ->get()
                ->markAsRead();
        }

        return view('admin.rental.enquiries.show', compact('rentalBooking'));
    }

    public function markAllRead(): RedirectResponse
    {
        auth()->user()->unreadNotifications()
            ->whereJsonContains('data->type', 'rental_enquiry')
            ->orWhere(fn ($q) => $q->whereJsonContains('data->type', 'rental_payment'))
            ->get()
            ->markAsRead();

        return back();
    }
}
