<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'creator_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'assigned_id' => function () {
            return factory(\App\User::class)->create()->id;
        },
        'status_id' => function () {
            return factory(\App\TaskStatus::class)->create()->id;
        },
    ];
});
