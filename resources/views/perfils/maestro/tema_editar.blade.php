@extends('perfils.maestro.maestro')

@section('medio_maestro')

<div class="container" id="tema_nuevo">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro')}}">Maestro: {{Auth::user()->maestro->nick_m}}</a></li>
	@if($tema->coleccion_id==null)
	<li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro_temas',$tema->maestro->id)}}">Articulos</a></li>
	<li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro_tema_ver',$tema->id)}}">Articulo: {{$tema->titulo}}</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('tema_editar',$tema->id)}}">Editar Articulo</a></li>
	@else
	<li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro_colecciones',Auth::user()->maestro->id)}}">Colecciones</a></li>
	<li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro_coleccion_ver',$tema->coleccion->id)}}">Colección: {{$tema->coleccion->titulo}}</a></li>
	<li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro_tema_ver',$tema->id)}}">Articulo: {{$tema->titulo}}</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('tema_editar',$tema->id)}}">Editar Articulo</a></li>
	@endif
  </ol>
</nav>
<div class="row cabecera_secundaria">
	<h2>Editar Tema: {{$tema->titulo}}</h2>
	</div>



<form method='post' action="{{ route('tema_actualizar',$tema->id) }}">
    @csrf
    <div class="form-group">
        <label for="form_titulo">Titulo</label>
        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" id="form_titulo" aria-describedby="titulo" value="{{$tema->titulo}}"></input>
        @error('titulo')
                                 <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
    </div>
    <div class="form-group">
        <label for="form_categoria">Categoria</label>
        <select class="form-control" name="categoria" id="form_categoria">
            @foreach($categorias as $categoria)
				@if($tema->categoria->id==$categoria->id)
			<option selected="selected" value="{{$categoria->id}}">{{$categoria->nombre}}</option>
				@else
            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
				@endif
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="form_contenido">Contenido</label>
        <textarea name="contenido" class="form-control ckeditor @error('contenido') is-invalid @enderror" id="form_contenido" rows="3">{{$tema->contenido}}</textarea>
			@error('contenido')
                                 <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
    </div>
    <button type="submit" class="btn btn-success btn-lg">Editar Tema</button>   
</form>

</div>


@endsection