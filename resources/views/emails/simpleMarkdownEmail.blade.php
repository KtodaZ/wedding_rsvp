@component('mail::message')
## Dear {{ $name }},

{{ $body }}

@foreach($links as $linkTitle => $link)
@component('mail::button', ['url' => $link])
{{ $linkTitle }}
@endcomponent
@endforeach

We can't wait to celebrate with you!

Love,
The soon to be Szombathys

P.S. - You can reply to this email
@endcomponent
