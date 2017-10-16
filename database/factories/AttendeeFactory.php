<?php

use Faker\Generator as Faker;

$factory->define(App\Attendee::class, function (Faker $faker) {
    $replied = $faker->boolean();
    $attending = false;
    if ($replied) {
        $attending = $faker->boolean();
    }

    return [
        'fname' => $faker->name,
        'lname' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->unique()->phoneNumber,
        'attending' => $attending,
        'replied' => $replied,
        'num_plus_ones_allowed' => $faker->numberBetween(0, 2)
    ];
});
