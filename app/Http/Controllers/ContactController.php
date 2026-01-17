<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(StoreContactRequest $request): JsonResponse
    {
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
