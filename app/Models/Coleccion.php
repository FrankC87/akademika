<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coleccion extends Model
{
    use HasFactory;
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'maestro_id',
    ];
    
    public function maestro(){
        return $this->belongsTo('App\Models\Maestro');
    }
    
    public function temas(){
        return $this->hasMany('App\Models\Tema');
    }
    
    public function votos() {
        return $this->hasMany('App\Models\Voto');
    }
}
