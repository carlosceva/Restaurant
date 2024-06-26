<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clientes')->insert([
            ['nombre' => 'Sebastian Villages',
            'direccion'=> 'Km6 doble via la guardia',
            'telefono'=> 71475423,
            'id_user'=> 4,],
        ]);
    }
}
