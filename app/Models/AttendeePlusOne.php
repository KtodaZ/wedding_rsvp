<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AttendeePlusOne
 *
 * @property int $id
 * @property int $attendee_id
 * @property int $plus_one_attendee_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AttendeePlusOne whereAttendeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AttendeePlusOne whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AttendeePlusOne whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AttendeePlusOne wherePlusOneAttendeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AttendeePlusOne whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AttendeePlusOne extends Model
{
}
