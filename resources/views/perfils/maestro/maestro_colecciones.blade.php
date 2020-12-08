@extends('perfils.maestro.maestro')

@section('medio_maestro')

<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro')}}">Maestro: {{Auth::user()->maestro->nick_m}}</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('maestro_colecciones',$maestro->id)}}">Colecciones</a></li>
  </ol>
</nav>

    <div class="row cabecera_secundaria">
        <h2>COLECCIONES DE {{$maestro->nick_m}}</h2>
    </div>
   <div class="input-group md-form form-sm form-1 pl-0 my-2">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" id="buscador_tabla" type="text" placeholder="Buscar colecciones" aria-label="Search">
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
                @foreach ($maestro->colecciones as $coleccion)
                <tr  class='clickable_row' data-href="{{route('maestro_coleccion_ver',$coleccion->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver Coleccion">
					<td ><i class="fas fa-archive"></i></td>
					<td class="font-weight-bold">{{$coleccion->titulo}}</br>				
						<a class="btn" id="btn_like_coleccion_{{$coleccion->id}}"><i class="fas fa-thumbs-up" data-toggle="tooltip" data-placement="bottom" title="Me gusta"></i></a>	
                        <span id="nºlikes_coleccion_{{$coleccion->id}}" class="likes_coleccion">{{$coleccion->likes}}</span>
                        <a class="btn" id="btn_dislike_coleccion_{{$coleccion->id}}"><i class="fas fa-thumbs-down" data-toggle="tooltip" data-placement="bottom" title="No me gusta"></i></a>
                        <span id="nºdislikes_coleccion_{{$coleccion->id}}" class="dislikes_coleccion">{{$coleccion->dislikes}}</span></br>
						<span class="text-muted">Creada el {{$coleccion->created_at->format('d-m-Y')}} a las {{$coleccion->created_at->format('H:i:s')}}</span>
						</td>
                </tr>
                @endforeach
            </tbody>
        </table>

	</div>
   <div class=" row mb-0">
                               <div class="col-auto">
        <a href="{{route('coleccion_nueva')}}" class="btn btn-success btn-lg my-3" role="button" aria-pressed="true">Nueva Coleccion</a>
    </div>
                            
							
                        </div>
</div>



@endsection