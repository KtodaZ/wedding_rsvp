<?php

use App\Models\Attendee;
use Faker\Generator as Faker;

$factory->define(Attendee::class, function (Faker $faker) {
    $maxPlusOnes = 4;

    $numPlusOnesAllowed = $faker->numberBetween(0, $maxPlusOnes);

    // If replied, set attending
    $replied = $faker->boolean();
    if ($replied) {
        $numAttending = $faker->numberBetween(0, $numPlusOnesAllowed);
    } else {
        $numAttending = 0;
    }

    $id = $faker->numberBetween(0, 10000);

    if ($numPlusOnesAllowed >= 2) {
        $name = $faker->name . ' and ' . $faker->name;
    } else {
        $name = $faker->name;
    }

    return [
        'id'                    => $id,
        'name'                  => $name,
        'num_attending'         => $numAttending,
        'replied'               => $replied,
        'num_plus_ones_allowed' => $numPlusOnesAllowed,
        'code'                  => 'placeholder',
        'group_number'          => 0
    ];
});
