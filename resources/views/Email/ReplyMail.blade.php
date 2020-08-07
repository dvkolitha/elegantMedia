@component('mail::message')
# Customer Support Reply

Your reference number is {{$reference_number}}.

{{$reply}}


Thanks,<br>
{{ config('app.name') }}
@endcomponent
