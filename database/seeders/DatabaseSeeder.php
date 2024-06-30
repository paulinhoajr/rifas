<?php

namespace Database\Seeders;

use App\Models\Bilhete;
use App\Models\CampanhaBilhete;
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
        \App\Models\Campanha::factory(8)->create();

        for ($a=1;$a<=8;$a++){

            for ($i=1;$i<=100;$i++){
                $bilhete = new CampanhaBilhete();
                $bilhete->numero = $i;
                $bilhete->campanha_id = $a;
                $bilhete->save();
            }

        }



    }
}
