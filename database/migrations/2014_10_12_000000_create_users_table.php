<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email', 300)->unique('user_email_uk'); //login de acesso, para não alterar o padrão do laravel
            $table->date('data_nascimento');
            $table->string('celular', 11);
            $table->string('cpf', 11)->unique('user_cpf_uk');
            $table->string('end_cep', 8);
            $table->string('end_cidade', 60);
            $table->string('end_uf', 2);
            $table->string('end_logradouro', 80);
            $table->string('end_numero', 20);
            $table->string('end_bairro', 60);
            $table->string('end_complemento', 40)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
