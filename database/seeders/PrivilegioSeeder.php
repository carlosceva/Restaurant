<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivilegioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('privilegios')->insert([
            ['funcionalidad' => 'Productos',
            'id_rol'=> 1,
            'agregar'=> True,
            'borrar'=> True,
            'modificar'=> True,
            'leer'=> True],

            // ['funcionalidad' => '',
            // 'id_rol'=> '',
            // 'agregar'=> '',
            // 'borrar'=> '',
            // 'modificar'=> '',
            // 'leer'=> ''],

            // ['funcionalidad' => '',
            // 'id_rol'=> '',
            // 'agregar'=> '',
            // 'borrar'=> '',
            // 'modificar'=> '',
            // 'leer'=> ''],

            // ['funcionalidad' => '',
            // 'id_rol'=> '',
            // 'agregar'=> '',
            // 'borrar'=> '',
            // 'modificar'=> '',
            // 'leer'=> ''],

            // ['funcionalidad' => '',
            // 'id_rol'=> '',
            // 'agregar'=> '',
            // 'borrar'=> '',
            // 'modificar'=> '',
            // 'leer'=> ''],

            // ['funcionalidad' => '',
            // 'id_rol'=> '',
            // 'agregar'=> '',
            // 'borrar'=> '',
            // 'modificar'=> '',
            // 'leer'=> ''],

            // ['funcionalidad' => '',
            // 'id_rol'=> '',
            // 'agregar'=> '',
            // 'borrar'=> '',
            // 'modificar'=> '',
            // 'leer'=> ''],

            // ['funcionalidad' => '',
            // 'id_rol'=> '',
            // 'agregar'=> '',
            // 'borrar'=> '',
            // 'modificar'=> '',
            // 'leer'=> ''],
        ]);
    }
}
