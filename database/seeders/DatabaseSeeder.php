<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Yonathan Castillo',
            'email' => 'leothan522@gmail.com',
            'password' => Hash::make('20025623')
        ]);

        $estados = dataTerritorio();

        //Cargamos los Estados
        foreach ($estados[0] as $estado){
            DB::table("estados")
                ->insert([
                    "id" => $estado['id'],
                    "nombre" => $estado['nombre'],
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]);
        }

        //Cargamos las Municipios
        foreach ($estados[1] as $estado) {
            DB::table("municipios")
                ->insert([
                    "id" => $estado['id'],
                    "estados_id" => $estado['estados_id'],
                    "nombre" => $estado['nombre'],
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]);
        }

        //Cargamos las Parroquias
        foreach ($estados[2] as $estado){
            DB::table("parroquias")
                ->insert([
                    "id" => $estado['id'],
                    "municipios_id" => $estado['municipios_id'],
                    "nombre" => $estado['nombre'],
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]);
        }

        //Cargamos las Ciudades
        $estados = dataTerritorio();
        foreach ($estados[3] as $estado){
            DB::table("ciudades")
                ->insert([
                    "id" => $estado['id'],
                    "estados_id" => $estado['estados_id'],
                    "nombre" => $estado['nombre'],
                    "capital" => $estado['capital'],
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]);
        }

    }
}
