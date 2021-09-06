<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('promocao_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('franquia_id');
            $table->decimal('valor', 10, 2)->nullable();
            $table->date('data_nota')->nullable();
            $table->enum('status', ['P', 'A', 'R'])->default('P');  //P->Pendente  A->Aprovada   R->Reprovada
            $table->string('path_nota', 300);
            $table->string('motivo_reprovacao', 500)->nullable();
            $table->timestamps();
            $table->foreign('promocao_id')->references('id')->on('promocaos');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('franquia_id')->references('id')->on('franquias');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas');
    }
}
