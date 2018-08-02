@component('mail::message')
## Dear {{ $name }},

{{ $body }}

@if($links)
@foreach($links as $linkTitle => $link)
@component('mail::button', ['url' => $link])
{{ $linkTitle }}
@endcomponent
@endforeach
@endif

Click the map below for directions to the venue:
<a href="https://www.google.com/maps/dir//Vizcaya,+21st+Street,+Sacramento,+CA/"><img src="https://maps.googleapis.com/maps/api/staticmap?center=Vizcaya,+21st+Street,+Sacramento,+CA&zoom=14&scale=1&size=600x300&maptype=roadmap&key=AIzaSyDOOnjI-UeQDpZWW53hPgBDJVaC-bk26qE&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7Clabel:%7CVizcaya,+21st+Street,+Sacramento,+CA" alt="Google Map of Vizcaya, 21st Street, Sacramento, CA"></a>

We can't wait to celebrate with you!

Love,
The soon to be Szombathys

P.S. - You can reply to this email
@endcomponent
