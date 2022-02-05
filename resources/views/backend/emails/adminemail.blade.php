@component('mail::message')
# Email : {{ $email }}
# Password : {{ $password }}

@component('mail::button', ['url' => $login])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
