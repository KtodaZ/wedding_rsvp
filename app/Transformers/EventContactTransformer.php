<?php namespace App\Transformers;


use App\Models\EventContact;
use Illuminate\Database\Eloquent\Model;

class EventContactTransformer extends AbstractTransformer
{

    /**
     * @param EventContact|Model $eventContact
     *
     * @return array
     */
    public function transform(Model $eventContact)
    {
        return [
            'email' => $eventContact->email
        ];
    }
}