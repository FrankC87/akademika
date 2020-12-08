@extends('perfils.aprendiz.aprendiz')

@section('medio_aprendiz')
<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('aprendiz')}}">Aprendiz: {{Auth::user()->aprendiz->nick_a}}</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('aprendiz_favoritos',Auth::user()->aprendiz->id)}}">Favoritos</a></li>
  </ol>
</nav>
<div class="row cabecera_secundaria">
	<h2>Favoritos</h2>
	</div>
 
	 <div class="input-group md-form form-sm form-1 pl-0 my-2">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
        </div>
        <input class="form-control my-0 py-1" id="buscador_tabla" type="text" placeholder="Buscar articulos" aria-label="Search">
    </div>
	@if(Auth::user()->aprendiz->favoritos->isEmpty())
		<div class="card mb-2 my-2">
            <div class="card-body">

                <p class="card-text">No ha añadido ningun articulo a favoritos</p>
            </div>
			 <div class="card-footer card_info_text">Haga click sobre el boton <a class="btn btn_favorito btn-warning mx-1" data-toggle="tooltip" data-placement="bottom" title="Añadir a favoritos">Favorito <i class="far fa-star" ></i></a> cuando visite un articulo, para añadirlo a favoritos.</div>
        </div>
    
	@else
		<div class="table-responsive-md">
        <table id="DataTable" class="table">
            <thead>
                <tr hidden>
                    <td class="col"></td>
					<td class="col"></td>             
                </tr>
            </thead>
            <tbody id="body_tabla">
                @foreach (Auth::user()->aprendiz->favoritos as $tema)
                <tr  class='clickable_row' data-href="{{route('aprendiz_tema_ver',$tema->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver Articulo">
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
	 
	 





</div>
@endsection