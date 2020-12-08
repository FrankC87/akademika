@extends('perfils.maestro.maestro')

@section('medio_maestro')
<div class="container" id="coleccion_nueva">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro')}}">Maestro: {{Auth::user()->maestro->nick_m}}</a></li>
	<li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro_colecciones',Auth::user()->maestro->id)}}">Colecciones</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('coleccion_nueva')}}">Colección Nueva</a></li>
  </ol>
</nav>
<div class="row cabecera_secundaria">
	<h2>Colección</h2>
	</div>
<form method='post' action="{{ route('coleccion_guardar') }}">
    @csrf

    <div class="form-group">
        <label for="form_titulo">Titulo de la Colección</label>
        <input type="text" name="titulo_coleccion" class="form-control @error('titulo_coleccion') is-invalid @enderror" id="form_titulo_coleccion" aria-describedby="titulo" placeholder="titulo de la coleccion">
         @error('titulo_coleccion')
                                 <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
    </div>
    <div class="form-group">
        <label for="form_descripcion_coleccion">Descripcion de la Colección</label>
        <textarea name="descripcion_coleccion" class="form-control ckeditor @error('descripcion_coleccion') is-invalid @enderror" id="form_descripcion_coleccion" rows="3"></textarea>
		 @error('descripcion_coleccion')
                                 <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
    </div>

    <button type="submit" class="btn btn-success btn-lg my-3">Crear Coleccion</button> 
</form>


</div>

@endsection