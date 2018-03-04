<?php

namespace App\Models;

use App\Helpers\NameHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;



/**
 * App\Models\Attendee
 *
 * @property int $id
 * @property string $fname
 * @property string $lname
 * @property string|null $email
 * @property string|null $phone
 * @property int $attending
 * @property int $replied
 * @property int $emailUpdates
 * @property int $textUpdates
 * @property int $num_plus_ones_allowed
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AttendeePlusOne[] $attendeePlusOnes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereAttending($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereEmailUpdates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereFname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereLname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereName($name)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereNumPlusOnesAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereReplied($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereTextUpdates($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Attendee extends Model
{
    use NameHelper;

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'phone',
        'address',
        'emailUpdates',
        'textUpdates',
        'attending',
        'replied',
        'num_plus_ones_allowed'
    ];

    /**
     * @return HasMany
     */
    public function attendeePlusOnes(): HasMany
    {
        return $this->hasMany(AttendeePlusOne::class);
    }

    /**
     * @return Collection|Attendee[]
     */
    public function getPlusOnes(): Collection
    {
        $attendee = $this;
        return (new Attendee)->whereIn('id', function ($query) use ($attendee) {
            /** @var Builder $query */
            $query->select('plus_one_attendee_id')
                ->from(with(new AttendeePlusOne())->getTable())
                ->where('id', $attendee->id);
        })->get();
    }

    /**
     * @param Builder $query
     * @param string $name
     *
     * @return Attendee|\Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereName($query, string $name)
    {
        list($fname, $lname) = $this->splitName($name);
        return $query->where('fname', $fname)->where('lname', $lname);
    }

}
