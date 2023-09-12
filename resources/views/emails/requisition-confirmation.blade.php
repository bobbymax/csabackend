<x-mail::message>
# Requisition Confirmed

Your Requisition with code {{$requisition->code}} has been approved and is ready for collection, Please make your way to store to collect.

<x-mail::button :url="''">
Login
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
