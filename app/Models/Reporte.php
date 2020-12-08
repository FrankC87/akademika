<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'motivo',
        'leido',
        'maestro_id',
        'aprendiz_id',
        'tema_id',
        'coleccion_id',
        'comentario_id',       
    ];
    
    
   
}
