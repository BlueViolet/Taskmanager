<?php

use Faker\Generator as Faker;
use App\Models\Task;

$factory->define(App\Models\Step::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'completion' => $faker->boolean(),
        'task_id' => Task::all()->random()->id
    ];
});
