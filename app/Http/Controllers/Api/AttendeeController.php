<?php namespace App\Http\Controllers\Api;

use App\Helpers\NameHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ModelResponses;
use App\Http\Requests\Api\EditAttendee;
use App\Http\Requests\Api\StoreAttendee;
use App\Http\Requests\Api\UpdateAttendee;
use App\Models\Attendee;
use App\Services\Local\Repositories\AttendeeRepository;
use app\Transformers\AttendeeTransformer;
use Illuminate\Http\JsonResponse;

/**
 * Class AttendeeController
 * @package App\Http\Controllers\Api
 */
class AttendeeController extends Controller
{
    use NameHelper, ModelResponses;

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
     * @return JsonResponse
     */
    public function index()
    {
        return $this->response(Attendee::all(), new AttendeeTransformer());
    }

    /**
     * @param StoreAttendee $request
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function store(StoreAttendee $request)
    {
        /** @var Attendee $attendee */
        $attendee = (new Attendee)->firstOrCreate($this->splitNameReturnArray($request->get('name')));
        $attendee = $request->applyRequestToAttendee($attendee);
        $attendee->saveOrFail();

        return $this->createdResponse($attendee, new AttendeeTransformer());
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
     * @param UpdateAttendee $request
     * @param Attendee $attendee
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update(UpdateAttendee $request, Attendee $attendee)
    {
        $attendee = $request->applyRequestToAttendee($attendee);
        $attendee->saveOrFail();

        return $this->response($attendee, new AttendeeTransformer());
    }

    /**
     * @param EditAttendee $request
     * @param Attendee $attendee
     *
     * @return JsonResponse
     * @throws \Throwable
     */
    public function edit(EditAttendee $request, Attendee $attendee)
    {
        $attendee = $request->applyRequestToAttendee($attendee); // Apply default
        $attendee->saveOrFail();

        return $this->response($attendee, new AttendeeTransformer());
    }

    /**
     * @param Attendee $attendee
     *
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Attendee $attendee)
    {
        $attendee->delete();

        return JsonResponse::create(['result' => 'success']);
    }


}