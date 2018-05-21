<?php

namespace App\Mail;

use App\Models\Attendee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RsvpThankYouMailable extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Attendee
     */
    private $attendee;

    /**
     * Create a new message instance.
     *
     * @param Attendee $attendee
     */
    public function __construct(Attendee $attendee)
    {
        $this->attendee = $attendee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('newlyweds@szombathy.com')
            ->subject('Thank you for RSVP\'ing')
            ->markdown('emails.rsvp.thankyou')->with([
                'numAttending' => $this->attendee->num_attending,
                'name'         => $this->attendee->name
            ]);
    }
}
