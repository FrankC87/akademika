<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestro extends Model {

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nick_m',
        'descripcion_m',
        'avatar_m',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function comentarios() {
        return $this->hasMany('App\Models\Comentario');
    }

    public function temas() {
        return $this->hasMany('App\Models\Tema');
    }

    public function totalTemas() {
        return $this->hasMany('App\Models\Tema')->count();
    }

    public function colecciones() {
        return $this->hasMany('App\Models\Coleccion');
    }
    
    public function votos() {
        return $this->hasMany('App\Models\Voto');
    }

    public function aprendices() {
        return $this->belongsToMany('App\Models\Aprendiz', 'maestro_aprendizs');
    }

    public function mensajesEnviados() {
        return $this->hasMany('App\Models\MensajeEnviado', 'emisor_m', 'id');
    }

    public function mensajesRecibidos() {
        return $this->hasMany('App\Models\MensajeRecibido', 'receptor_m', 'id');
    }

    public function totalRecibidos() {
        return $this->hasMany('App\Models\MensajeRecibido', 'receptor_m', 'id')->count();
    }

    public function mensajesLeidos() {
        return $this->hasMany('App\Models\MensajeRecibido', 'receptor_m', 'id')->where('leido', '=', true);
    }

    public function mensajesNoLeidos() {
        return $this->hasMany('App\Models\MensajeRecibido', 'receptor_m', 'id')->where('leido', '=', false)->count();
    }

    public function notificaciones() {
        return $this->hasMany('App\Models\Notificacion', 'receptor_m', 'id');
    }
    
    public function notificacionesNoLeidas() {
        return $this->hasMany('App\Models\Notificacion', 'receptor_m', 'id')->where('leido', '=', false)->count();
    }

    public function totalNotificaciones() {
        return $this->hasMany('App\Models\Notificacion', 'receptor_m', 'id')->count();
    }
    

}
