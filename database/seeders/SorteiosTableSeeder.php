<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Sorteio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SorteiosTableSeeder extends Seeder
{
    public function run(): void
    {
        $sorteio = new Sorteio();
        $sorteio->nome = "Loteria federal";
        $sorteio->save();

        $sorteio = new Categoria();
        $sorteio->nome = "Sorteador.com.br";
        $sorteio->save();

    }
}
