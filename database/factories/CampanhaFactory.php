<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CampanhaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'categoria_id' => rand(1, 4),
            'bilhete_id' => 4,
            'sorteio_id' => rand(1, 2),
            'nome' => fake()->name(),
            'preco' => rand(3, 30),
            'whatsapp' => fake()->phoneNumber(),
            'modelo' =>  rand(0, 1),
            'descricao' => fake()->text(),
            'minima' =>  rand(1, 10),
            'maxima' =>  rand(25, 300),
            'filtro' =>  rand(0, 1),
            'data' => fake()->dateTime(),
            'tempo' =>  rand(1, 3),
            'email' => fake()->email(),
            'top' => rand(0, 1),
            'situacao' => rand(0, 1),
        ];
    }

}
