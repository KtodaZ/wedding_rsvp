<?php namespace App\Transformers;

use App\Models\Attendee;
use App\Models\EventContact;
use Illuminate\Database\Eloquent\Model;

class AttendeeTransformer extends AbstractTransformer
{

    /**
     * @param Model|Attendee $model
     *
     * @return array
     */
    public function transform(Model $model): array
    {
        return $this->transformAttendee($model);

    }

    /**
     * @param Attendee|Model $attendee
     *
     * @return array
     */
    private function transformAttendee(Model $attendee)
    {
        return [
            'name'               => $attendee->name,
            'code'               => $attendee->code,
            'replied'            => $attendee->replied,
            'numAttending'       => $attendee->num_attending,
            'numPlusOnesAllowed' => $attendee->num_plus_ones_allowed,
            'eventContacts'      => (new EventContactTransformer())->transformCollection($attendee->eventContacts),
        ];
    }

}