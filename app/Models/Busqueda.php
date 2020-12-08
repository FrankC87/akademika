<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Busqueda extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoria_id',
        'aprendiz_id',
    ];
    
    public function Aprendiz(){
        return $this->belongsTo('App\Models\Aprendiz');
    }
    
    public function Categoria(){
        return $this->belongsTo('App\Models\Categoria');
    }
}
