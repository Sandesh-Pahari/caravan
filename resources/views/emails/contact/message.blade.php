@component('mail::message')
# New Contact Message

You have received a new message via the website contact form.

@component('mail::panel')
**Name:** {{ $senderName }}
**Email:** {{ $senderEmail }}
@if($senderPhone)
**Phone:** {{ $senderPhone }}
@endif
@endcomponent

**Message:**

{{ $messageBody }}

---

*Reply directly to this email to respond to {{ $senderName }}.*

@endcomponent
