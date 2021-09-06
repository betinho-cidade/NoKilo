<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranquiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franquias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unique('franquia_user_uk')->nullable();
            $table->string('nome', 500);
            $table->string('end_cep', 8);
            $table->string('end_cidade', 60);
            $table->string('end_uf', 2);
            $table->string('end_logradouro', 80);
            $table->string('end_numero', 20);
            $table->string('end_bairro', 60);
            $table->string('end_complemento', 40)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('franquias');
    }
}
