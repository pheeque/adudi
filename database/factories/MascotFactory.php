<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mascot;
use App\User;
use Faker\Generator as Faker;

$factory->define(Mascot::class, function (Faker $faker) {
    return [
        'exp'     => $faker->numberBetween(1, 199),
        'level'   => 1,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
