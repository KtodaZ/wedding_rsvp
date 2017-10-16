<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


/**
 * Class Attendee
 * @package App
 */
class Attendee extends Model
{
    protected $fillable = [
        'name', 'phone', 'attending', 'num_plus_ones_allowed'
    ];

    public function plus_ones() : BelongsToMany
    {
        return $this->belongsToMany(Attendee::class);
    }

}
