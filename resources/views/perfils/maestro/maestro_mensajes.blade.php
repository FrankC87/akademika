@extends('perfils.maestro.maestro')

@section('medio_maestro')


<div class="container" id="lista_a">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro')}}">Maestro: {{Auth::user()->maestro->nick_m}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('maestro_mensajes')}}">Mensajes ({{Auth::user()->maestro->totalRecibidos()}})</a></li>
        </ol>
    </nav>	


    <div class="row cabecera_secundaria">
        <h2>MENSAJES</h2>
    </div>
    <div class="row" id="botones_mensajes">
		<div class="col-auto">
            <a href="{{route('maestro_mensajes')}}" class="btn correo_btn btn-md my-3 aviso" id="maestro_mensajes_enviados" role="button" aria-pressed="true"  data-toggle="tooltip" data-placement="bottom" title="Enviados">Entrada&nbsp;<i class="fas fa-mail-bulk"></i>&nbsp;({{Auth::user()->maestro->mensajesRecibidos->count()}})@if(Auth::user()->maestro->mensajesNoLeidos() > 0)<span class="badge">{{Auth::user()->maestro->mensajesNoLeidos()}}</span>@endif</a>
        </div>
        <div class="col-auto">
            <a href="{{route('maestro_mensajes_enviados')}}" class="btn correo_btn btn-md my-3" id="maestro_mensajes_enviados" role="button" aria-pressed="true"  data-toggle="tooltip" data-placement="bottom" title="Enviados">Enviados&nbsp;<i class="fas fa-envelope"></i>&nbsp;({{Auth::user()->maestro->mensajesEnviados->count()}})</a>
        </div>
        <div class="col-auto">
            <a href="{{route('maestro_mensajes_leidos')}}" class="btn correo_btn btn-md my-3" id="maestro_mensajes_leidos" role="button" aria-pressed="true"  data-toggle="tooltip" data-placement="bottom" title="Leidos">Leidos&nbsp;<i class="fas fa-envelope-open-text"></i>&nbsp;({{Auth::user()->maestro->mensajesLeidos->count()}})</a>
        </div>
        <div class="col-auto">
            <a href="{{route('maestro_mensaje_nuevo')}}" class="btn correo_btn btn-md my-3" id="maestro_mensaje_nuevo" role="button" aria-pressed="true"  data-toggle="tooltip" data-placement="bottom" title="Nuevo">Nuevo&nbsp;<i class="fas fa-sticky-note"></i></a>
        </div>
        <div class="col-auto">
            <a href="{{route('maestro_notificaciones')}}" class="btn correo_btn btn-md my-3  aviso" id="maestro_mensajes_notificaciones" role="button" aria-pressed="true"  data-toggle="tooltip" data-placement="bottom" title="Notificaciones">Notificaciones&nbsp;<i class="fas fa-bell"></i>&nbsp;({{Auth::user()->maestro->notificaciones->count()}})@if(Auth::user()->maestro->notificacionesNoLeidas() > 0)<span class="badge">{{Auth::user()->maestro->notificacionesNoLeidas()}}</span>@endif</a>
        </div>
    </div>


    <div class="container" id="cuerpo_mensajes">
		@yield('cuerpo_mensajes')
    </div>
</div>
@endsection