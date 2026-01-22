<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactMail;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(StoreContactRequest $request): JsonResponse
    {
        ContactMessage::query()->create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'phone' => $request->validated('phone'),
            'message' => $request->validated('message'),
        ]);

        Mail::to(config('mail.from.address'))
            ->send(new ContactMail(
                senderName: $request->validated('name'),
                senderEmail: $request->validated('email'),
                senderPhone: $request->validated('phone', ''),
                messageBody: $request->validated('message'),
            ));

        return response()->json([
            'message' => 'Your message has been sent! We will get back to you shortly.',
        ]);
    }
}
