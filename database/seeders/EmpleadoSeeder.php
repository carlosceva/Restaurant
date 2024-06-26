<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('empleados')->insert([
            ['nombre' => 'Jaime Cardona',
            'ci' => 6352410,
            'turno' => 'Completo',
            'telefono' => 71245632,
            'id_user'=> 1],

            ['nombre' => 'Hugo Perez',
            'ci' => 4586324,
            'turno' => 'Mañana',
            'telefono' => 71285214,
            'id_user'=> 2],

            ['nombre' => 'Roberto Andrade',
            'ci' => 8456971,
            'turno' => 'Tarde',
            'telefono' => 71245632,
            'id_user'=> 3],
        ]);
    }
}
