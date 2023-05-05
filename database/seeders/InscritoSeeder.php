<?php

namespace Database\Seeders;

use App\Models\Inscrito;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class InscritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 300; $i++) {
            Inscrito::create([
                'codigo' => $faker->word(),
                'name' => $faker->word(),
                'ap_paterno' => $faker->word(),
                'ap_materno' => $faker->word(),
                'user_id' => $faker->numberBetween(1, 3),
                'escuela_id' => $faker->numberBetween(1, 24),
                'deporte_id' => $faker->numberBetween(1, 20),
                'estado_id' => 1,
            ]);
        }
    }
}
