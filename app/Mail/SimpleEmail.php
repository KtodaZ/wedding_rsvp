<?php

namespace App\Mail;

use App\Models\Attendee;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SimpleEmail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Attendee
     */
    private $attendee;
    /**
     * @var string
     */
    private $message;
    /**
     * @var array
     */
    private $links;

    /**
     * Create a new message instance.
     *
     * @param Attendee $attendee
     * @param string $subject
     * @param string $body
     * @param array $links
     */
    public function __construct(Attendee $attendee, string $subject, string $body, $links = [])
    {
        $this->attendee = $attendee;
        $this->subject = $subject;
        $this->message = $body;
        $this->links = $links;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('newlyweds@szombathy.com')
            ->subject($this->subject)
            ->markdown('emails.simpleMarkdownEmail')->with([
                'name'       => $this->attendee->name,
                'body'       => $this->message,
                'links'      => $this->links
            ]);
    }
}
