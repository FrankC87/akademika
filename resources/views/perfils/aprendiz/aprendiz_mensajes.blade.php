@extends('perfils.aprendiz.aprendiz')

@section('medio_aprendiz')


<div class="container" id="lista_a">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('aprendiz')}}">Aprendiz: {{Auth::user()->aprendiz->nick_a}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('aprendiz_mensajes')}}">Mensajes ({{Auth::user()->aprendiz->totalRecibidos()}})</a></li>
        </ol>
    </nav>	

    <div class="row cabecera_secundaria">
        <h2>MENSAJES</h2>
    </div>
    <div class="row" id="botones_mensajes">
		<div class="col-auto">
            <a href="{{route('aprendiz_mensajes')}}" class="btn correo_btn btn-md my-3 aviso" id="aprendiz_mensajes_enviados" role="button" aria-pressed="true"  data-toggle="tooltip" data-placement="bottom" title="Enviados">Entrada&nbsp;<i class="fas fa-mail-bulk"></i>&nbsp;({{Auth::user()->aprendiz->mensajesRecibidos->count()}})@if(Auth::user()->aprendiz->mensajesNoLeidos() > 0)<span class="badge">{{Auth::user()->aprendiz->mensajesNoLeidos()}}</span>@endif</a>
        </div>
        <div class="col-auto">
            <a href="{{route('aprendiz_mensajes_enviados')}}" class="btn correo_btn btn-md my-3" id="aprendiz_mensajes_enviados" role="button" aria-pressed="true"  data-toggle="tooltip" data-placement="bottom" title="Enviados">Enviados&nbsp;<i class="fas fa-envelope"></i>&nbsp;({{Auth::user()->aprendiz->mensajesEnviados->count()}})</a>
        </div>
        <div class="col-auto">
            <a href="{{route('aprendiz_mensajes_leidos')}}" class="btn correo_btn btn-md my-3" id="aprendiz_mensajes_leidos" role="button" aria-pressed="true"  data-toggle="tooltip" data-placement="bottom" title="Leidos">Leidos&nbsp;<i class="fas fa-envelope-open-text"></i>&nbsp;({{Auth::user()->aprendiz->mensajesLeidos->count()}})</a>
        </div>
        <div class="col-auto">
            <a href="{{route('aprendiz_mensaje_nuevo')}}" class="btn correo_btn btn-md my-3" id="aprendiz_mensaje_nuevo" role="button" aria-pressed="true"  data-toggle="tooltip" data-placement="bottom" title="Nuevo">Nuevo&nbsp;<i class="fas fa-sticky-note"></i></a>
        </div>
        <div class="col-auto">
            <a href="{{route('aprendiz_notificaciones')}}" class="btn correo_btn btn-md my-3  aviso" id="aprendiz_mensajes_notificaciones" role="button" aria-pressed="true"  data-toggle="tooltip" data-placement="bottom" title="Notificaciones">Notificaciones&nbsp;<i class="fas fa-bell"></i>&nbsp;({{Auth::user()->aprendiz->notificaciones->count()}})@if(Auth::user()->aprendiz->notificacionesNoLeidas() > 0)<span class="badge">{{Auth::user()->aprendiz->notificacionesNoLeidas()}}</span>@endif</a>
        </div>
    </div>


    <div class="container" id="cuerpo_mensajes">
		@yield('cuerpo_mensajes')
    </div>
</div>
@endsection