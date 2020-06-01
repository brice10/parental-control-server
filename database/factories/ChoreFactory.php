<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Punishment\Chore;
use Faker\Generator as Faker;

$factory->define(Chore::class, function (Faker $faker) {
    return [
        'name' =>  $faker->text(20),
        'description' => $faker->text(100)
    ];
});
