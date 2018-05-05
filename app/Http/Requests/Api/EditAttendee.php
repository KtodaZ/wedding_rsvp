<?php namespace App\Http\Requests\Api;

use App\Models\Attendee;
use App\Models\EventContact;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

/**
 * Class UpdateAttendee
 * @package App\Http\Requests\Api
 */
class EditAttendee extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'numAttending'  => 'required|numeric',
            'eventContacts' => [
              [
                  'email' => 'email|required'
              ]
            ]
        ];
    }

    /**
     * @param Attendee $attendee
     *
     * @return Attendee
     */
    public function applyRequestToAttendee(Attendee $attendee)
    {
        $attendee->num_attending = $this->get('numAttending');
        $attendee->replied = true;
        return $attendee;
    }

    /**
     * @param Attendee $attendee
     *
     * @throws \Throwable
     */
    public function applyRequestToEventContacts(Attendee $attendee)
    {
        $attendeeId = $attendee->id;
        \DB::transaction(function () use ($attendeeId) {
            EventContact::whereAttendeeId($attendeeId)->delete();
            foreach ($this->get('eventContacts') as $contact) {
                $email = Arr::get($contact, 'email');
                if ($email) {
                    $eventContact = new EventContact();
                    $eventContact->attendee_id = $attendeeId;
                    $eventContact->email = $email;
                    $eventContact->save();
                }
            }
        });
    }
}