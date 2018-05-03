<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    public $fillable = ['nombre'];

    public function pregunta()
    {
        return $this->belongsTo('App\Pregunta');
    }
}
