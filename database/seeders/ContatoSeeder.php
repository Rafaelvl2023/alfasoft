<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contato;
use Faker\Factory as Faker;

class ContatoSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            Contato::create([
                'nome' => $faker->name,
                'contato' => $faker->numerify('#########'), 
                'email' => $faker->unique()->safeEmail,
            ]);
        }
    }
}
