<?php namespace App\Services\Local\Services;

use App\Mail\RsvpThankYouMailable;
use App\Models\Attendee;
use App\Transformers\AttendeeTransformer;
use App\Transformers\EventContactTransformer;
use Illuminate\Mail\Message;

class SendRsvpMailService
{
    /**
     * @param Attendee $attendee
     */
    public static function sendMail(Attendee $attendee)
    {

        try {
            if ($attendee->num_attending > 0) {
                /** @var \App\Models\EventContact $eventContact */
                foreach ($attendee->eventContacts as $eventContact) {
                    \Mail::to($eventContact->email)
                        ->send(new RsvpThankYouMailable($attendee));
                }
            }
        } catch (\Exception $e) {
            \Log::critical('Error Sending RSVP email. ' . $e->__toString());
        }

        try {
            $transformer = new EventContactTransformer();
            \Mail::raw("New Guest RSVPd: $attendee->name NumAttending: $attendee->num_attending NumPlusOnesAllowed: $attendee->num_plus_ones_allowed Code: $attendee->code Emails: " . json_encode($transformer->transformCollection($attendee->eventContacts)), function ($message) use ($attendee) {
                /**@var Message $message */
                $message->to('szomba.ceane@gmail.com');
                $message->from('newlyweds@szombathy.com');
                $message->subject('New Guest RSVPd: ' . $attendee->name);
            });
        } catch (\Exception $e) {
            \Log::critical('Error Sending email. ' . $e->__toString());
        }

    }

}