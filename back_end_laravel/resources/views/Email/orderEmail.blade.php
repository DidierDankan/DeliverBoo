@component('mail::message')
# {{ $mailOrder['title'] }}

Ciao {{ $mailOrder['restaurant'] }}! Hai appena ricevuto un ordine da {{ $mailOrder['name']}} {{ $mailOrder['surname']}} di € {{ $mailOrder['amount'] }}. Processalo al più presto...


@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
Vai alla Dashboard
@endcomponent

Grazie,<br>
{{ config('app.name') }}
@endcomponent
