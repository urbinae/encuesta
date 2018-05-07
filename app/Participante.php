<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    public $fillable = ['ip_participante,on_line, respondio, id_encuesta'];


    public function encuesta()
    {
        return $this->belongsTo('App\Encuesta');
    }

    public function particip_preg()
    {
        return $this->hasMany('App\ParticipPreg');
    }

    /**
     * Relación con Preguntas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function preguntas()
    {
        return $this->belongsToMany('App\Pregunta', 'preguntas_participantes', 'participantes_id', 'preguntas_id');

    }
}
