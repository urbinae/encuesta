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
}
