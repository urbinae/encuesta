<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticipPreg extends Model
{
    protected $table = 'participantes_preguntas';

	public $timestamps = true;

	public function participastes()
	{
	    return $this->belongsTo('App\Participante');
	}

	public function preguntas()
    {
        return $this->belongsTo('App\Pregunta');
    }
}
