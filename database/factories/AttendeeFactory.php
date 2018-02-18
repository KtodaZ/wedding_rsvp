<?php

use App\Attendee;
use Faker\Generator as Faker;

$factory->define(Attendee::class, function (Faker $faker) {
    $maxPlusOnes = 2;

    $replied = $faker->boolean();
    if ($replied) {
        $attending = $faker->boolean();
    } else {
        $attending = false;
    }

    $numPlusOnesAllowed = $faker->numberBetween(0, $maxPlusOnes);
    if ($numPlusOnesAllowed) {
        $numPlusOnesAttending = $faker->numberBetween(0, $maxPlusOnes);
    } else {
        $numPlusOnesAttending = 0;
    }

    return [
        'fname' => $faker->firstName,
        'lname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->unique()->phoneNumber,
        'address' => $faker->streetAddress,
        'attending' => $attending,
        'replied' => $replied,
        'num_plus_ones_allowed' => $numPlusOnesAllowed,
        'num_plus_ones_attending' => $numPlusOnesAttending
    ];
});
