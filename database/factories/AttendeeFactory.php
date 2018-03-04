<?php

use App\Models\Attendee;
use Faker\Generator as Faker;

$factory->define(Attendee::class, function (Faker $faker) {
    $maxPlusOnes = 2;

    // If replied, set attending
    $replied = $faker->boolean();
    if ($replied) {
        $attending = $faker->boolean();
    } else {
        $attending = false;
    }

    $numPlusOnesAllowed = $faker->numberBetween(0, $maxPlusOnes);
    if ($numPlusOnesAllowed) {
        $numPlusOnes = $faker->numberBetween(0, $maxPlusOnes);
    } else {
        $numPlusOnes = 0;
    }

    for ($i = 0; $i < $numPlusOnes; $i++) {
        /** @var Attendee $attendee */
        $attendee = factory(Attendee::class)->create(['num_plus_ones_allowed' => 0]);
        foreach ($attendee->getPlusOnes() as $plusOne) {
            $plusOne->delete(); // we don't want a forever chain of plus ones being created
        }
    }

    return [
        'fname'                 => $faker->firstName,
        'lname'                 => $faker->lastName,
        'email'                 => $faker->unique()->safeEmail,
        'phone'                 => $faker->unique()->phoneNumber,
        'attending'             => $attending,
        'replied'               => $replied,
        'num_plus_ones_allowed' => $numPlusOnesAllowed
    ];
});
