<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ModelResponses;
use App\Http\Requests\Api\CreateAttendee;
use App\Http\Requests\Api\EditAttendee;
use App\Http\Requests\Api\StoreAttendee;
use App\Http\Requests\Api\UpdateAttendee;
use App\Models\Attendee;
use App\Services\Local\Repositories\AttendeeRepository;
use App\Services\Local\Services\SendRsvpMailService;
use App\Transformers\AttendeeTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class AttendeeController
 * @package App\Http\Controllers\Api
 */
class AttendeeController extends Controller
{
    use  ModelResponses;

    /**
     * @var AttendeeRepository
     */
    private $repository;

    /**
     * AttendeeController constructor.
     */
    public function __construct()
    {
        $this->repository = new AttendeeRepository();
    }


    /**
     * @param Attendee $attendee
     *
     * @return JsonResponse
     */
    public function show(Attendee $attendee)
    {
        return $this->response($attendee, new AttendeeTransformer());
    }

    /**
     * @param CreateAttendee $request
     *
     * @return JsonResponse
     */
    public function store(CreateAttendee $request) {
        $attendee = $request->applyRequestToAttendee();
        $attendee->save();
        return $this->createdResponse($attendee, new AttendeeTransformer());
    }

    /**
     * @param EditAttendee $request
     * @param string $code
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function edit(EditAttendee $request, string $code)
    {
        \Log::debug('Edit request received with code ' . $code, $request->toArray());
        $attendee = $this->getAttendeeByCode($code);

        $attendee = $request->applyRequestToAttendee($attendee);
        $attendee->saveOrFail();
        $request->applyRequestToEventContacts($attendee);

        SendRsvpMailService::sendMail($attendee);

        return $this->response($attendee, new AttendeeTransformer());
    }

    public function code(string $code)
    {
        return $this->response($this->getAttendeeByCode($code), new AttendeeTransformer);
    }

    /**
     * @param string $code
     *
     * @return \Illuminate\Database\Eloquent\Model|null|static|Attendee
     */
    private function getAttendeeByCode(string $code)
    {
        return Attendee::whereCode(strtoupper($code))->firstOrFail();
    }

}