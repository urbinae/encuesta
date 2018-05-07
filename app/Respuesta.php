<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
	protected $table ='respuestas';
    public $fillable = ['nombre'];

    public function pregunta()
    {
        return $this->belongsTo('App\Pregunta');
    }
}
