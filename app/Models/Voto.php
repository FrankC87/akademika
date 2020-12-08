<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    use HasFactory;
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'aprendiz_id',
        'maestro_id',
        'tema_id',
        'coleccion_id',
        'comentario_id',
        'like',
        'dislike',
    ];
    
    public function maestro(){
        return $this->belongsTo('App\Models\Maestro','maestro_id');
    }
    
    public function aprendiz(){
        return $this->belongsTo('App\Models\Aprendiz','aprendiz_id');
    }
    
    public function tema(){
        return $this->belongsTo('App\Models\Tema','tema_id');
    }
    
    public function coleccion(){
        return $this->belongsTo('App\Models\Coleccion','coleccion_id');
    }
    
    public function comentario(){
        return $this->belongsTo('App\Models\Comentario','comentario_id');
    }
    
   
}
