@extends('perfils.maestro.maestro')

@section('medio_maestro')
<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro')}}">Maestro: {{Auth::user()->maestro->nick_m}}</a></li>
	<li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro_colecciones',Auth::user()->maestro->id)}}">Colecciones</a></li>
	<li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro_coleccion_ver',$coleccion->id)}}">Colección: {{$coleccion->titulo}}</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('coleccion_editar',$coleccion->id)}}">Editar Colección</a></li>
  </ol>
</nav>
<div class="row cabecera_secundaria">
	<h2>Editar Colección</h2>
	</div>
<form method='post' action="{{ route('coleccion_actualizar',$coleccion->id) }}">
    @csrf

    <div class="form-group">
        <label for="form_titulo">Titulo de la Colección</label>
        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" id="form_titulo_coleccion" aria-describedby="titulo" value="{{$coleccion->titulo}}">
       @error('titulo')
                                 <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
    </div>
    <div class="form-group">
        <label for="form_descripcion_coleccion">Descripción de la Colección</label>
        <textarea name="descripcion" class="form-control ckeditor @error('descripcion') is-invalid @enderror" id="form_descripcion_coleccion" rows="3" >{{$coleccion->descripcion}}</textarea>
		@error('descripcion')
                                 <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
    </div>

    <button type="submit" class="btn btn-success btn-lg my-3">Editar Coleccion</button>  
</form>
</div>



@endsection