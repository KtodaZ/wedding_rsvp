<?php namespace app\Transformers;

use App\Models\Attendee;
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
        $plusOnes = $this->plusOnes($model);
        return [
            $this->transformAttendee($model),
            'numPlusOnes' => count($plusOnes),
            'plusOnes' => $this->plusOnes($model)
        ];
    }

    /**
     * @param Model|Attendee $model
     *
     * @return array
     */
    private function transformAttendee(Model $model)
    {
        return [
            'fname'              => $model->fname,
            'lname'              => $model->lname,
            'email'              => $model->email,
            'phone'              => $model->phone,
            'replied'            => $model->replied,
            'attending'          => $model->attending,
            'emailUpdates'       => $model->emailUpdates,
            'textUpdates'        => $model->textUpdates,
            'numPlusOnesAllowed' => $model->num_plus_ones_allowed,
            'created_at'         => $model->created_at->toDateString(),
            'updated_at'         => $model->updated_at->toDateString()
        ];
    }

    /**
     * @param Model|Attendee $model
     *
     * @return array
     */
    private function plusOnes(Model $model): array
    {
        $returnArray = [];
        foreach ($model->getPlusOnes() as $plusOne) {
            $returnArray[] = [
                $this->transformAttendee($plusOne)
            ];
        }
        return $returnArray;
    }
}