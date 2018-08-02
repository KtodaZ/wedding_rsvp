<?php namespace App\Http\Controllers\Rpc;


use App\Http\Controllers\Controller;
use App\Http\Requests\Rpc\SimpleEmailRequest;
use App\Mail\SimpleEmail;
use App\Models\Attendee;

class UpdateEmailController extends Controller
{

    public function sendEventContactsEmail(SimpleEmailRequest $request)
    {
        $isTest = $request->input('test');
        $subject = $request->input('subject');
        $body = $request->input('body');
        $links = json_decode($request->get('links'));

        $emailsSent = [];

        try {
            foreach (Attendee::all() as $attendee) {
                /** @var \App\Models\EventContact $eventContact */
                foreach ($attendee->eventContacts as $eventContact) {
                    $email = $eventContact->email;

                    if ($isTest) {
                        $email = 'szomba.ceane@gmail.com';
                    }

                    \Mail::to($email)->send(new SimpleEmail($attendee, $subject, $body, $links));
                    $emailsSent[] = $email;

                    if ($isTest) {
                        break; // Only send the test email
                    }
                }
                if ($isTest) {
                    break;
                }
            }

        } catch (\Exception $e) {
            \Log::critical('Error Sending RSVP email. ' . $e->__toString());
        }

        return json_encode('Successfully sent emails to ' . json_encode($emailsSent));
    }
}