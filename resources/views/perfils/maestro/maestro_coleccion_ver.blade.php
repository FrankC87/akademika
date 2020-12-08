@extends('perfils.maestro.maestro')

@section('medio_maestro')
<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro')}}">Maestro: {{Auth::user()->maestro->nick_m}}</a></li>
	<li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro_colecciones',Auth::user()->maestro->id)}}">Colecciones</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('maestro_coleccion_ver',$coleccion->id)}}">Colección: {{$coleccion->titulo}}</a></li>
  </ol>
</nav>
<div class="container">
<div class="row cabecera_secundaria">
	<h2>Colección: {{$coleccion->titulo}}</h2>
	</div>




    <div class="card my-2 card_articulo">
        <div class="card-header font-weight-bold lead">
            {{$coleccion->titulo}}
        </div>

        <div class="card-body" id="tema_contenido">	
            {!! $coleccion->descripcion !!}
        </div>

        <div class="card-footer">
            <div class="container">
                <div class="row  d-flex justify-content-between">
                    <span class="text-muted">Creada el {{$coleccion->created_at->format('d-m-Y')}} a las {{$coleccion->created_at->format('H:i:s')}}</span> 
                    @if($coleccion->updated_at != $coleccion->created_at)
                    <span class="text-muted">Ultima edición el {{$coleccion->updated_at->format('d-m-Y')}} a las {{$coleccion->updated_at->format('H:i:s')}}</span>

                    @endif
                </div>
                <div class="row  d-flex justify-content-between">
                    <div class="col-md-auto">
                        @if(Auth::user()->maestro->nick_m == $coleccion->maestro->nick_m)
                        <a class="btn btn_edit" id="btn_edit_{{$coleccion->id}}" href="{{route('coleccion_editar',$coleccion->id)}}"><i class="fas fa-edit"></i></a>
                        <a class="btn btn_delete" id="btn_delete_{{$coleccion->id}}" href="{{route('coleccion_borrar',$coleccion->id)}}"><i class="fas fa-minus-circle"></i></a>
                        @endif

                        <a class="btn btn_like_coleccion" id="btn_like_{{$coleccion->id}}"><i class="fas fa-thumbs-up"></i></a>	
                        <span id="nºlikes_{{$coleccion->id}}" class="likes_coleccion">{{$coleccion->likes}}</span>
                        <a class="btn btn_dislike_coleccion" id="btn_dislike_{{$coleccion->id}}"><i class="fas fa-thumbs-down"></i></a>
                        <span id="nºdislikes_{{$coleccion->id}}" class="dislikes_coleccion">{{$coleccion->dislikes}}</span>
                    </div>
                    <div class="col-sm-auto font-weight-bold clickable_row " data-href="{{route('maestro_ver_maestro',$coleccion->maestro->id)}}" data-toggle="tooltip" data-placement="bottom" title="Autor">
                        Autor: {{$coleccion->maestro->nick_m}}			
                    </div>
                </div>
            </div>
        </div>
    </div>

	<div class="row cabecera_secundaria">
			<h3>Articulos de la colección</h3>
		</div>
			    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr hidden>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coleccion->temas as $tema)
                <tr  class='clickable_row' data-href="{{route('maestro_tema_ver',$tema->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver Articulo">
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
	 <div class="row">
        <a href="{{route('coleccion_tema_nuevo',$coleccion->id)}}" class="btn btn-success btn-lg my-3" role="button" aria-pressed="true">Añadir articulo</a>  
    </div>

</div>
</div>

@endsection