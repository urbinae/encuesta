<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    public $fillable = ['nombre'];

    public function respuestas()
    {
        return $this->hasMany('App\Respuestas');
    }

    public function respuestas()
    {
        return $this->hasMany('App\Respuestas');
    }

    public function particip_preg()
    {
        return $this->hasMany('App\ParticipPreg');
    }

    /**
     * Relación con Participantes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
     public function participantes()
    {
        return $this->belongsToMany('App\Participante', 'participantes_preguntas', 'pregunta_id', 'participante_id');

    }
}
