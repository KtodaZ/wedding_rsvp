<?php namespace App\Models;



/**
 * App\Models\EventContact
 *
 * @property int $id
 * @property int $attendee_id
 * @property string|null $email
 * @property string|null $phone
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Attendee $attendee
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventContact whereAttendeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventContact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventContact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventContact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventContact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EventContact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EventContact extends Model
{

    protected $fillable = [
        'email',
        'phone'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendee()
    {
        return $this->belongsTo(Attendee::class);
    }
}