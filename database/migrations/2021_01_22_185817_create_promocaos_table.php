<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocaos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nome', 500);
            $table->longText('observacao')->nullable();
            $table->date('data_inicio');
            $table->date('data_fim')->nullable();
            $table->enum('status', ['A', 'F'])->default('A');  //A->Andamento  F->Finalizada
            $table->integer('pontuacao');
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
        Schema::dropIfExists('promocaos');
    }
}
