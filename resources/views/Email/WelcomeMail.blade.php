@component('mail::message')

Your reference number is {{$reference_number}}. Please login to see your ticket's status.Use your reference number as the Password

@component('mail::button', ['url' => 'http://127.0.0.1:8000/'])
Login 
@endcomponent

Thanks,<br>

@endcomponent
