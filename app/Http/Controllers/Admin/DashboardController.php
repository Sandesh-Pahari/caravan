<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\RentalBooking;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $unreadRentalCount = RentalBooking::query()
            ->where(function ($q) {
                $q->where('is_enquiry', true)
                    ->orWhere('payment_status', 'paid');
            })
            ->whereNull('admin_read_at')
            ->count();

        $unreadContactCount = ContactMessage::query()->whereNull('read_at')->count();

        $unreadNotificationCount = auth()->user()->unreadNotifications()->count();

        $latestNotifications = auth()->user()
            ->notifications()
            ->latest()
            ->limit(8)
            ->get();

        return view('admin.dashboard', [
            'unreadTrekkingCount' => 0,
            'unreadRentalCount' => $unreadRentalCount,
            'unreadContactCount' => $unreadContactCount,
            'unreadNotificationCount' => $unreadNotificationCount,
            'latestNotifications' => $latestNotifications,
        ]);
    }
}
