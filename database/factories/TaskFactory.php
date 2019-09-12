<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use App\User;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name'     => $faker->words(3, true),
        'due_date' => $faker->dateTimeBetween('2019-01-01', '2019-12-30'),
        'status'   => $faker->randomElement([true, false]),
        'user_id'  => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
