@component('mail::message')
## Dear {{ $name }},

### You're RSVP'd for *{{ $numAttending}}* guests! Thank You!

Here are some links you might find useful:

We have reserved a block of rooms at the Residence Inn Marriott at Capitol Park. Book by July 5th to receive the special rate.

@component('mail::button', ['url' => 'https://www.marriott.com/meeting-event-hotels/group-corporate-travel/groupCorp.mi?resLinkData=Noelle%20and%20Kyle%27s%20Wedding^SACDT`NKWNKWA|NKWNKWC`150.00-270.00`USD`false`6`8/3/18`8/5/18`7/5/18&app=resvlink&stop_mobi=yes'])
    Book a room
@endcomponent

Noelle and Kyle are registered at [Amazon](https://www.amazon.com/wedding/share/szombathyceane) and [Crate & Barrel](https://www.crateandbarrel.com/gift-registry/noelle-ceane-and-kyle-szombathy/r5840478), or you can help by donating to their [Newlywed Fund](https://www.pinterest.com/szombaceane/ceane-szombathy-newlywed-fund/).


Thank you,

Noelle Ceane & Kyle Szombathy
@endcomponent
