@extends('perfils.aprendiz.aprendiz')

@section('medio_aprendiz')
<div class="container" id="buscador_temas">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('aprendiz')}}">Aprendiz: {{Auth::user()->aprendiz->nick_a}}</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('buscador')}}">Buscador de Articulos</a></li>
  </ol>
</nav>
    <div class="row cabecera_secundaria">
        <h2>BUSQUEDA</h2>
    </div>

    <form method='post' action="{{ route('buscador_resultado') }}" class="my-2">
        @csrf

        <div class="form-group">    
            <select class="form-control" name="search_categoria" id="search_categoria">
                <option hidden>Escoja una categoria</option>                   
            </select>		
        </div>
        <button type="submit" id="btn_categoriasBuscador" class="btn btn-success btn-lg my-2">Buscar</button>
       
    </form>
	
    @if($busqueda!=null)
	@if($busqueda->categoria->temas->isEmpty())
		<div class="card mb-2 my-2 card_info">
            <div class="card-body">

                <p class="card-text">No hay articulos que mostrar de esta categoria</p>
				
            </div>
			 <div class="card-footer">

               <p class="card-text">Espere que algun maestro cree articulos en esta categoria o aproveche usted para iniciarla</p>
				
            </div>
			         </div>
	@else
    <div class="row cabecera_secundaria">
        <h3>RESULTADO</h3>
    </div>
	
    <div class="input-group md-form form-sm form-1 pl-0 my-2">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" id="buscador_tabla" type="text" placeholder="Buscar articulos" aria-label="Search">
    </div>
	
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr hidden>
                    <td class="col"></td>
                    <td class="col"></td>

                </tr>
            </thead>
            <tbody id="body_tabla">
                @foreach ($busqueda->categoria->temas as $tema)
                <tr  tabindex="0.{{ $loop->index }}" class='clickable_row' data-href="{{route('aprendiz_tema_ver',$tema->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver Articulo">
                    <td><i class="fas fa-hand-point-right"></i></td>
                  <td class="font-weight-bold">{{$tema->titulo}}</br>
						<span class="font-weight-light">Categoría: {{$tema->categoria->nombre}}</span></br>
						<a class="btn" id="btn_like_{{$tema->id}}"><i class="fas fa-thumbs-up" data-toggle="tooltip" data-placement="bottom" title="Me gusta"></i></a>	
                        <span id="nºlikes_{{$tema->id}}" class="likes_tema">{{$tema->likes}}</span>
                        <a class="btn" id="btn_dislike_{{$tema->id}}"><i class="fas fa-thumbs-down" data-toggle="tooltip" data-placement="bottom" title="No me gusta"></i></a>
                        <span id="nºdislikes_{{$tema->id}}" class="dislikes_tema">{{$tema->dislikes}}</span></br>
						<span class="text-muted">Creado el {{$tema->created_at->format('d-m-Y')}} a las {{$tema->created_at->format('H:i:s')}}</span>
						</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
	@endif
	@else
			<div class="card mb-2 my-2 card_info">
            <div class="card-body">

                <p class="card-text">Seleccione una categoria y haga click en "Buscar"</p>
				
            </div>
			 
			         </div>
    @endif
	
</div>

@endsection