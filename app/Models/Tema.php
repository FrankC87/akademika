<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'contenido',
        'likes',
        'dislikes',
        'maestro_id',
        'categoria_id',
        'coleccion_id',
    ];
    
    public function maestro(){
        return $this->belongsTo('App\Models\Maestro');
    }
    
    public function coleccion(){
        return $this->belongsTo('App\Models\Coleccion');
    }
    
    public function comentarios(){
        return $this->hasMany('App\Models\Comentario');
    }
    
    public function categoria(){
        return $this->belongsTo('App\Models\Categoria');
    }
    
    public function aprendices() {
        return $this->belongsToMany('App\Models\Aprendiz', 'aprendiz_temas');
    }
    
    public function votos() {
        return $this->hasMany('App\Models\Voto');
    }
}
