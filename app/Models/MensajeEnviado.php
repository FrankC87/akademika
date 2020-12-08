<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MensajeEnviado extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'asunto',
        'contenido',
        'emisor_a',
        'emisor_m',
        'receptor_a',
        'receptor_m',
    ];
     
    public function emisorMaestro(){
        return $this->belongsTo('App\Models\Maestro','emisor_m');
    }
    
    public function emisorAprendiz(){
        return $this->belongsTo('App\Models\Aprendiz','emisor_a');
    }
    
    public function receptorMaestro(){
        return $this->belongsTo('App\Models\Maestro','receptor_m');
    }
    
    public function receptorAprendiz(){
        return $this->belongsTo('App\Models\Aprendiz','receptor_a');
    }
}
