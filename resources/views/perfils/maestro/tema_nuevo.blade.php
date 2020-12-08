@extends('perfils.maestro.maestro')

@section('medio_maestro')

<div class="container" id="tema_nuevo">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro')}}">Maestro: {{Auth::user()->maestro->nick_m}}</a></li>
	<li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro_temas',Auth::user()->maestro->id)}}">Articulos</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('tema_nuevo')}}">Articulo Nuevo</a></li>
  </ol>
</nav>
<div class="row cabecera_secundaria">
	<h2>Articulo Nuevo</h2>
	</div>



<form method='post' action="{{ route('tema_guardar') }}">
    @csrf
    <div class="form-group">
        <label for="form_titulo">Titulo</label>
        <input type="text" name="titulo" class="form-control @error('titulo') is-invalid @enderror" id="form_titulo" aria-describedby="titulo" placeholder="titulo del articulo">
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
            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="form_contenido">Contenido</label>
        <textarea name="contenido" class="form-control ckeditor @error('contenido') is-invalid @enderror" id="form_contenido" rows="3"></textarea>
		@error('contenido')
                                 <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
    </div>
    <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-plus"></i> Añadir Articulo</button>
</form>

</div>


@endsection