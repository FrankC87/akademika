<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aprendiz extends Model {

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nick_a',
        'descripcion_a',
        'avatar_a',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function comentarios() {
        return $this->hasMany('App\Models\Comentario', 'aprendiz_id');
    }
    
    public function totalComentarios() {
        return $this->hasMany('App\Models\Comentario', 'aprendiz_id')->count();
    }

    public function maestros() {
        return $this->belongsToMany('App\Models\Maestro', 'maestro_aprendizs');
    }
    
    public function favoritos() {
        return $this->belongsToMany('App\Models\Tema', 'aprendiz_temas');
    }

    public function busquedas() {
        return $this->hasMany('App\Models\Busqueda', 'aprendiz_id');
    }

    public function totalBusquedas() {
        return $this->hasMany('App\Models\Busqueda', 'aprendiz_id')->count();
    }

    public function mensajesEnviados() {
        return $this->hasMany('App\Models\MensajeEnviado', 'emisor_a', 'id');
    }

    public function mensajesRecibidos() {
        return $this->hasMany('App\Models\MensajeRecibido', 'receptor_a', 'id');
    }

    public function totalRecibidos() {
        return $this->hasMany('App\Models\MensajeRecibido', 'receptor_a', 'id')->count();
    }

    public function mensajesLeidos() {
        return $this->hasMany('App\Models\MensajeRecibido', 'receptor_a', 'id')->where('leido', '=', true);
    }
    
    public function mensajesNoLeidos() {
        return $this->hasMany('App\Models\MensajeRecibido', 'receptor_a', 'id')->where('leido', '=', false)->count();
    }

    public function notificaciones() {
        return $this->hasMany('App\Models\Notificacion', 'receptor_a', 'id');
    }

    public function notificacionesNoLeidas() {
        return $this->hasMany('App\Models\Notificacion', 'receptor_a', 'id')->where('leido', '=', false)->count();
    }
    
    public function totalNotificaciones() {
        return $this->hasMany('App\Models\Notificacion', 'receptor_a', 'id')->count();
    }
    
    public function votos() {
        return $this->hasMany('App\Models\Voto');
    }

}
