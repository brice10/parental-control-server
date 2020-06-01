<?php

use App\Models\Punishment\Chore;
use Illuminate\Database\Seeder;

class ChoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        factory(Chore::class, 10)->make()->each(function ($chore) use ($faker) {
            $chore->save();
        });
    }
}
