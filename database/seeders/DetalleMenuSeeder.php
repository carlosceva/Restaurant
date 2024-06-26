<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetalleMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detalle_menus')->insert([
            ['id_producto' => 1,
            'id_menu' => 1],

            ['id_producto' => 2,
            'id_menu' => 1],

            ['id_producto' => 3,
            'id_menu' => 1],

            ['id_producto' => 4,
            'id_menu' => 1],

            ['id_producto' => 5,
            'id_menu' => 1],
        ]);
    }
}
