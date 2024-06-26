<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            ['email' => 'admin@gmail.com',
            'password' => Hash::make('secret'),
            'id_empresa' => 1,
            'id_rol' => 1],

            ['email' => 'jaime@gmail.com',
            'password' => Hash::make('secret'),
            'id_empresa' => 1,
            'id_rol' => 2],

            ['email' => 'roberto@gmail.com',
            'password' => Hash::make('secret'),
            'id_empresa' => 1,
            'id_rol' => 2],

            ['email' => 'sebastian@gmail.com',
            'password' => Hash::make('secret'),
            'id_empresa' => 1,
            'id_rol' => 3],
        ]);
    }
}
