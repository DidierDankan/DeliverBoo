@component('mail::message')
# {{ $mailData['title'] }}

Ciao {{ $mailData['name'] }}! Il tuo ordine di € {{ $mailData['amount'] }} è stato ricevuto e verrà processato al più presto.


@component('mail::button', ['url' => 'http://localhost:8080/#/'])
Visita il sito
@endcomponent

Grazie,<br>
{{ config('app.name') }}
@endcomponent
