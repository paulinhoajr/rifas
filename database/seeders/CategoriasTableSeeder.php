<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategoriasTableSeeder extends Seeder
{
    public function run(): void
    {
        $categoria = new Categoria();
        $categoria->nome = "Teste 1";
        $categoria->save();

        $categoria = new Categoria();
        $categoria->nome = "Teste 2";
        $categoria->save();

        $categoria = new Categoria();
        $categoria->nome = "Teste 3";
        $categoria->save();

        $categoria = new Categoria();
        $categoria->nome = "Teste 4";
        $categoria->save();


    }
}
