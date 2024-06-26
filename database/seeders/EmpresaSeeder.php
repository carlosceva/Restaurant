<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('empresas')->insert([
            ['nombre'=> 'Restaurante la Ñ',
            'direccion' => '3er anillo Av. Pirai',
            'telefono'=> 78945612,
            'correo'=> 'restaurantlaenie@gmail.com'],
        ]);
    }
}