<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use App\User;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name'     => $faker->words(3, true),
        'due_date' => $faker->date(),
        'status'   => $faker->boolean,
        'user_id'  => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
