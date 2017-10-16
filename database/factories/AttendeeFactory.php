<?php

use Faker\Generator as Faker;

$factory->define(App\Attendee::class, function (Faker $faker) {
    $replied = $faker->boolean();
    $attending = false;
    if ($replied) {
        $attending = $faker->boolean();
    }

    $maxPlusOnes = 2;
    $numPlusOnesAllowed = $faker->numberBetween(0, $maxPlusOnes);
    $numPlusOnesAttending = 0;
    if ($numPlusOnesAllowed) {
        $numPlusOnesAttending = $faker->numberBetween(0, $maxPlusOnes);
    }

    return [
        'fname' => $faker->firstName,
        'lname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->unique()->phoneNumber,
        'attending' => $attending,
        'replied' => $replied,
        'num_plus_ones_allowed' => $numPlusOnesAllowed,
        'num_plus_ones_attending' => $numPlusOnesAttending,
    ];
});
