<x-mail::message>
# {{ $ticket->category === "incident" ? "Incident Noted" : "Support Ticker Created" }}

Your compliant has been lodged successfully, and a staff will attend to your request shortly.

<x-mail::button :url="''">
View Ticket
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
