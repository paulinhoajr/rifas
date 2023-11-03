<?php

namespace Database\Seeders;

use App\Models\Bilhete;
use App\Models\Usuario;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            RegioesTableSeeder::class,
            EstadosTableSeeder::class,
            CidadesTableSeeder::class,
            UsuariosTableSeeder::class,
            CategoriasTableSeeder::class,
            BilhetesTableSeeder::class,
            SorteiosTableSeeder::class,
        ]);

        \App\Models\Usuario::factory(50)->create();
        \App\Models\Campanha::factory(100)->create();

    }
}
