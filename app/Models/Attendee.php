<?php

namespace App\Models;

use App\Contracts\Generators\CodeGenerator;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;


/**
 * App\Models\Attendee
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property int $num_attending
 * @property int $num_plus_ones_allowed
 * @property bool $replied
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventContact[] $eventContacts
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereNumAttending($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereNumPlusOnesAllowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereReplied($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Attendee onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Attendee whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Attendee withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Attendee withoutTrashed()
 */
class Attendee extends Model
{
    use SoftDeletes;

    const CODE_NUMBER_LENGTH = 2;

    protected $fillable = [
        'num_attending',
        'replied',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'replied'      => 'bool',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            /** @var Attendee $model */
            $model->generateCode();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventContacts()
    {
        return $this->hasMany(EventContact::class);
    }

    /**
     * @throws \Throwable
     */
    private function generateCode()
    {
        /** @var CodeGenerator $codeGenerator */
        $codeGenerator = \App::make(CodeGenerator::class);
        do {
            $code = $codeGenerator->generate(self::CODE_NUMBER_LENGTH);
        } while (Attendee::whereCode($code)->first());
        $this->code = $code;
        $this->save();
    }

}
