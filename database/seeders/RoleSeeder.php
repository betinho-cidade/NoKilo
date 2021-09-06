<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{

    public function run()
    {

        if(DB::table('roles')->get()->count() == 0){

            DB::table('roles')->insert([
                [
                    'id' => 1,
                    'name' => 'Gestor',
                    'description' => 'Gestor do NoKilo',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'name' => 'Franquia',
                    'description' => 'Responsável pela Franquia NoKilo',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'name' => 'Cliente',
                    'description' => 'Cliente do NoKilo',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);

        } else { echo "\e[31mTabela Roles não está vazia. "; }

    }

}
