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
class CreateAttendee extends FormRequest
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
            'name'     => 'required|string',
            'plusOnes' => 'required|numeric',
        ];
    }

    /**
     * @param Attendee $attendee
     *
     * @return Attendee
     */
    public function applyRequestToAttendee()
    {
        $attendee = new Attendee();
        $attendee->name = $this->get('name');
        $attendee->replied = false;
        $attendee->num_attending = false;
        $attendee->num_plus_ones_allowed = $this->get('plusOnes');
        $attendee->code = 'placeHolder';
        return $attendee;
    }
}