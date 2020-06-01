<?php

use App\Models\Punishment\Sanction;
use Illuminate\Database\Seeder;

class SanctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        factory(Sanction::class, 10)->make()->each(function ($sanction) use ($faker) {
            $sanction->save();
        });
    }
}
