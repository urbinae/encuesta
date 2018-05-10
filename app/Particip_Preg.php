<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticipPreg extends Model
{
    protected $table = 'preguntas_participantes';

	public $timestamps = true;

	public function participantes()
	{
	    return $this->belongsTo('App\Participante');
	}

	public function preguntas()
    {
        return $this->belongsTo('App\Pregunta');
    }
}
