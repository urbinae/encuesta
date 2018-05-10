<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntasParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preguntas_participantes', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('participantes_id')->unsigned();
            $table->foreign('participantes_id')->references('id')->on('participantes');
            $table->integer('preguntas_id')->unsigned();
            $table->foreign('preguntas_id')->references('id')->on('preguntas');
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
        Schema::drop('preguntas_participantes');
    }
}
