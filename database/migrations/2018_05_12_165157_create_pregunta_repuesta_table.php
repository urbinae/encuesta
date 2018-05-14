<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreguntaRepuestaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta_repuesta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pregunta_id')->unsigned()->nullable();
            $table->foreign('pregunta_id')->references('id')
                    ->on('preguntas')->onDelete('cascade');

            $table->integer('respuesta_id')->unsigned()->nullable();
            $table->foreign('respuesta_id')->references('id')
                    ->on('respuestas')->onDelete('cascade');
            $table->char('letra',1);
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
        Schema::drop('pregunta_repuesta');
    }
}
