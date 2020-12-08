<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',     
    ];
    
    public function temas(){
        return $this->hasMany('App\Models\Tema');
    }
    
    public function busqueda(){
        return $this->hasMany('App\Models\Busqueda');
    }
}
