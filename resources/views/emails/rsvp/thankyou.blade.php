@component('mail::message')
    ## Dear {{ $name }},

    ### You're RSVP'd for *{{ $numAttending}}* guests! Thank You!

    Here are some links you might find useful:

    We have reserved a block of rooms at the Residence Inn Marriott at Capitol Park. Book by July 5th to receive the special rate.

    @component('mail::button', ['url' => 'https://bit.ly/2LhKkVB'])
        Book a room
    @endcomponent

    Noelle and Kyle are registered at [Amazon](https://www.amazon.com/wedding/share/szombathyceane) and [Crate & Barrel](https://www.crateandbarrel.com/gift-registry/noelle-ceane-and-kyle-szombathy/r5840478), or you can help by donating to their [Newlywed Fund](https://www.pinterest.com/szombaceane/ceane-szombathy-newlywed-fund/).


    Thank you,

    Noelle Ceane & Kyle Szombathy
@endcomponent
