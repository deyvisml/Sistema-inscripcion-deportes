<?php

namespace Database\Seeders;

use App\Models\Deporte;
use DateTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DeporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            Deporte::create([
                'name'  => $faker->word(),
                "num_max_players" => $faker->numberBetween(10, 20),
                "fecha_limite" => $faker->dateTimeBetween('now', '+3 weeks')->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
