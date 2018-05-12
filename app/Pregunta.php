<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table ='preguntas';
    public $fillable = ['nombre','encuesta_id'];

    /*public function respuestas()
    {
        return $this->hasMany('App\Respuesta');
    }*/

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
        return $this->belongsToMany('App\Participante', 'preguntas_participantes', 'preguntas_id', 'participantes_id');

    }
    
    /**
     * Relación con repúestas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function respuestas()
    {
        return $this->belongsToMany('App\Respuesta', 'pregunta_repuesta')->withPivot('letra')->withTimestamps();
    }
}
