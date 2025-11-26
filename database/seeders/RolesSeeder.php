<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
public function run()
{
    DB::table('roles')->insert([
        ['id' => 1, 'nombre' => 'superadmin'],
        ['id' => 2, 'nombre' => 'admin'],
        ['id' => 3, 'nombre' => 'operador'],
        ['id' => 4, 'nombre' => 'consulta'],
    ]);
}
}
