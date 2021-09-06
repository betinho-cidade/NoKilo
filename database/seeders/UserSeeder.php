<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{

    public function run()
    {

        if(DB::table('users')->get()->count() == 0){

            DB::table('users')->insert([
                [
                    'id' => 1,
                    'name' => 'Gestor do Nokilo',
                    'email' => 'gestor@nokilo.com.br',
                    'password' => bcrypt('12345678'),
                    'data_nascimento' => '2010-01-01',
                    'celular' => '43999999999',
                    'cpf' => '11111111111',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'name' => 'Franquia do NoKilo',
                    'email' => 'franquia@nokilo.com.br',
                    'password' => bcrypt('12345678'),
                    'data_nascimento' => '2010-01-01',
                    'celular' => '43999999999',
                    'cpf' => '22222222222',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'name' => 'Cliente do NoKilo',
                    'email' => 'cliente@nokilo.com.br',
                    'password' => bcrypt('12345678'),
                    'data_nascimento' => '2010-01-01',
                    'celular' => '43999999999',
                    'cpf' => '33333333333',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);

        } else { echo "\e[31mTabela Users não está vazia. "; }

    }
}

