<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contenido',
        'likes',
        'dislikes',
        'maestro_id',
        'aprendiz_id',
        'tema_id',
    ];
    
    public function maestro(){
        return $this->belongsTo('App\Models\Maestro','maestro_id');
    }
    
    public function aprendiz(){
        return $this->belongsTo('App\Models\Aprendiz','aprendiz_id');
    }
    
    public function tema(){
        return $this->belongsTo('App\Models\Tema');
    }
    
    public function votos() {
        return $this->hasMany('App\Models\Voto');
    }
}
