@component('mail::message')
Nuova E-mail.

<p><strong>Email: </strong>{{ $contact['email'] }}</p>

<p><strong>Messaggio: </strong>{{ $contact['message'] }}</p>

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent