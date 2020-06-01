<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Punishment\Infraction;
use Faker\Generator as Faker;

$factory->define(Infraction::class, function (Faker $faker) {
    return [
        'name' =>  $faker->text(20),
        'description' => $faker->text(100)
    ];
});
