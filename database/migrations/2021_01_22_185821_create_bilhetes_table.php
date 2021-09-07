<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilhetesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bilhetes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('promocao_id');
            $table->unsignedBigInteger('user_id');
            $table->datetime('data_encerramento')->nullable();
            $table->string('numero_sorte', 50);
            $table->enum('status', ['P', 'S', 'N'])->default('P');  //P->Pendente  S->Sorteado   N->Não Sorteado
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('promocao_id')->references('id')->on('promocaos');
            $table->unique(['promocao_id', 'numero_sorte'])->index('bilhete_numero_uk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bilhetes');
    }
}
