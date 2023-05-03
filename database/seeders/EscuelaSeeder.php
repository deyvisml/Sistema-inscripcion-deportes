<?php

namespace Database\Seeders;

use App\Models\Escuela;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EscuelaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 24; $i++) {
            Escuela::create([
                'name'  => $faker->sentence(),
                "facultad_id" => $faker->numberBetween(1, 10)
            ]);
        }
    }
}
