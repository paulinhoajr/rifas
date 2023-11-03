<?php

namespace Database\Seeders;

use App\Models\Bilhete;
use App\Models\Categoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BilhetesTableSeeder extends Seeder
{
    public function run(): void
    {
        $bilhete = new Bilhete();
        $bilhete->quantidade = 25;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 50;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 100;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 200;
        $bilhete->save();
        $bilhete = new Bilhete();
        $bilhete->quantidade = 300;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 400;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 500;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 600;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 700;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 800;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 900;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 1000;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 2000;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 3000;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 4000;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 5000;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 10000;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 20000;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 30000;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 40000;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 50000;
        $bilhete->save();

        $bilhete = new Bilhete();
        $bilhete->quantidade = 100000;
        $bilhete->save();






    }
}
