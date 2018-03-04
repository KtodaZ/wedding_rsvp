<?php namespace App\Http\Requests\Api;

use App\Helpers\NameHelper;
use App\Models\Attendee;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateAttendee
 * @package App\Http\Requests\Api
 */
class EditAttendee extends FormRequest
{
    use NameHelper;

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
            'attending'              => 'boolean|required',
            'email'                  => 'email',
            'phone'                  => 'digits:10',
            'emailUpdates'           => 'boolean',
            'textUpdates'            => 'boolean',
            'plusOne.*.name'         => 'name',
            'plusOne.*.email'        => 'email',
            'plusOne.*.phone'        => 'phone',
            'plusOne.*.emailUpdates' => 'boolean',
            'plusOne.*.textUpdates'  => 'boolean'
        ];
    }

    /**
     * @param Attendee $attendee
     *
     * @return Attendee
     */
    public function applyRequestToAttendee(Attendee $attendee)
    {
        $attendee->email = $this->get('email');
        $attendee->phone = $this->get('phone');
        $attendee->emailUpdates = $this->get('emailUpdates');
        $attendee->textUpdates = $this->get('textUpdates');
        $attendee->attending = $this->get('attending');
        $attendee->replied = $this->get('replied');
        $attendee->num_plus_ones_allowed = $this->get('numPlusOnesAllowed');
        return $attendee;
    }


}