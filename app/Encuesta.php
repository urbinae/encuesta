<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
    protected $table ='encuestas';
    public $fillable = ['nombre'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function participantes()
    {
        return $this->hasMany('App\Participante');
    }

    public function preguntas()
    {
        return $this->hasMany('App\Pregunta');
    }
}
