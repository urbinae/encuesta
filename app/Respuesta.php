<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
	protected $table ='respuestas';
    public $fillable = ['nombre'];

    /*public function pregunta()
    {
        return $this->belongsTo('App\Pregunta');
    }
    */
    
    /**
     * Relación con pregunta.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pregunta()
    {
        return $this->belongsToMany('App\Pregunta', 'pregunta_repuesta')->withPivot('letra')->withTimestamps();
    }
}
