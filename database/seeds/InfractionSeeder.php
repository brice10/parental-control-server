<?php

use App\Models\Punishment\Infraction;
use Illuminate\Database\Seeder;

class InfractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        factory(Infraction::class, 10)->make()->each(function ($infraction) use ($faker) {
            $infraction->save();
        });
    }
}
