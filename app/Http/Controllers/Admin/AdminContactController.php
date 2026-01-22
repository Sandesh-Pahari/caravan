<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminContactController extends Controller
{
    public function index(Request $request): View
    {
        $filter = $request->query('filter', 'all');

        $query = ContactMessage::query()->latest();

        if ($filter === 'unread') {
            $query->whereNull('read_at');
        } elseif ($filter === 'read') {
            $query->whereNotNull('read_at');
        }

        $messages = $query->paginate(20)->withQueryString();
        $unreadCount = ContactMessage::query()->whereNull('read_at')->count();

        return view('admin.contact.index', compact('messages', 'filter', 'unreadCount'));
    }

    public function show(ContactMessage $contactMessage): View
    {
        if ($contactMessage->isUnread()) {
            $contactMessage->update(['read_at' => now()]);
        }

        return view('admin.contact.show', compact('contactMessage'));
    }

    public function markAllRead(): RedirectResponse
    {
        ContactMessage::query()->whereNull('read_at')->update(['read_at' => now()]);

        return back()->with('success', 'All messages marked as read.');
    }
}
