<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{

    public function run()
    {
        if (DB::table('permissions')->get()->count() == 0) {

            DB::table('permissions')->insert([
                [
                    'id' => 1,
                    'name' => 'view_painel',
                    'description' => 'Acessar o painel do sistema NoKilo',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 2,
                    'name' => 'view_usuario',
                    'description' => 'Acessar as informações dos Usuários do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 3,
                    'name' => 'edit_usuario',
                    'description' => 'Alterar as informações dos Usuários do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 4,
                    'name' => 'create_usuario',
                    'description' => 'Criar um novo Usuário do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 5,
                    'name' => 'delete_usuario',
                    'description' => 'Excluir um Usuário do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 6,
                    'name' => 'view_franquia',
                    'description' => 'Acessar as informações das Franquias do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 7,
                    'name' => 'edit_franquia',
                    'description' => 'Alterar as informações das Franquias do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 8,
                    'name' => 'create_franquia',
                    'description' => 'Criar uma nova Franquia do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 9,
                    'name' => 'delete_franquia',
                    'description' => 'Excluir uma Franquia do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 10,
                    'name' => 'view_nota',
                    'description' => 'Acessar as informações das Notas do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 11,
                    'name' => 'edit_nota',
                    'description' => 'Alterar as informações das Notas do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 12,
                    'name' => 'create_nota',
                    'description' => 'Criar uma nova Nota do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 13,
                    'name' => 'delete_nota',
                    'description' => 'Excluir uma Nota do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 14,
                    'name' => 'view_promocao',
                    'description' => 'Acessar as informações das Promoções do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 15,
                    'name' => 'edit_promocao',
                    'description' => 'Alterar as informações das Promoções do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 16,
                    'name' => 'create_promocao',
                    'description' => 'Criar uma nova Promoções do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 17,
                    'name' => 'delete_promocao',
                    'description' => 'Excluir uma Promoções do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 18,
                    'name' => 'view_score',
                    'description' => 'Acessar as informações do Score do Cliente',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 19,
                    'name' => 'bilhete_premiado',
                    'description' => 'Marcar bilhete como Premiado',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 20,
                    'name' => 'view_cliente',
                    'description' => 'Acessar as informações do Cliente do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'id' => 21,
                    'name' => 'edit_cliente',
                    'description' => 'Alterar as informações do Cliente do sistema',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],

            ]);
        } else {
            echo "\e[31mTabela Permissions não está vazia. ";
        }
    }
}
