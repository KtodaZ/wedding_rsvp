@component('mail::message')
## Dear {{ $name }},

{{ $body }}

### Hotel information
If you're staying at the hotel, parking is provided at a discounted rate of $10 per night, just mention you're part of Noelle and Kyle's wedding block.

@if($links)
@foreach($links as $linkTitle => $link)
@component('mail::button', ['url' => $link])
{{ $linkTitle }}
@endcomponent
@endforeach
@endif

### Wedding Info
As a reminder, please arrive by 5pm. We have the venue booked until midnight.
If you plan on drinking we highly suggest taking Uber and Lyft as they are very popular and affordable in the city. Please be safe!

Click the map below for directions to the venue:
<a href="https://www.google.com/maps/dir//Vizcaya,+21st+Street,+Sacramento,+CA/"><img src="https://maps.googleapis.com/maps/api/staticmap?center=Vizcaya,+21st+Street,+Sacramento,+CA&zoom=14&scale=1&size=600x300&maptype=roadmap&key=AIzaSyDOOnjI-UeQDpZWW53hPgBDJVaC-bk26qE&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7Clabel:%7CVizcaya,+21st+Street,+Sacramento,+CA" alt="Google Map of Vizcaya, 21st Street, Sacramento, CA"></a>

Any questions? Feel free to reply to this email.

We can't wait to celebrate with you!

Love,
The soon to be Szombathys
@endcomponent
