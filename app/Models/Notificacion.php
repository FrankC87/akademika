<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
      use HasFactory;
    protected $fillable = [
        'asunto',
        'contenido',
        'leido',       
        'receptor_a',
        'receptor_m',
    ];
     
    
    
    public function receptorMaestro(){
        return $this->belongsTo('App\Models\Maestro','receptor_m');
    }
    
    public function receptorAprendiz(){
        return $this->belongsTo('App\Models\Aprendiz','receptor_a');
    }
}
