<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromocionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('promocions')->insert([
            ['descuento' => 10,
            'fecha_i'=> '2024-06-24',
            'fecha_f'=> '2024-06-29'],
        ]);
    }
}
