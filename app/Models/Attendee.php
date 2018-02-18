<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * Class Attendee
 * @package App
 */
class Attendee extends Model
{
    protected $fillable = [
        'name', 'phone', 'attending', 'num_plus_ones_allowed'
    ];

}
