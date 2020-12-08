@extends('perfils.aprendiz.aprendiz')

@section('medio_aprendiz')


<div class="col-md-8">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('aprendiz')}}">Aprendiz: {{Auth::user()->aprendiz->nick_a}}</a></li>
  </ol>
</nav>
    <div class="card my-3 card_perfil">

        <div class="card-body">
            <h5 class="card-title  cabecera_secundaria">SOBRE MI</h5>
            <p class="card-text">{{Auth::user()->aprendiz->descripcion_a}}</p>
        </div>
    </div>
	<div class="row cabecera_secundaria mb-2">
        <h2>RECOMENDADOS</h2>
    </div>
	@if($temas->isEmpty())
		<div class="card mb-2 my-2 card_info">
            <div class="card-body">

                <p class="card-text">No tenemos recomendaciones en este momento</p>
				
            </div>
			 <div class="card-footer">

               <p class="card_info_text">Siga buscando porfavor</p>
				
            </div>
			         </div>
			@else
	<div class="table-responsive-md">
        <table class="table">
            <thead>
                <tr hidden>
                    <td class="col"></td>
					<td class="col"></td>
                 
                </tr>
            </thead>
            <tbody id="cuerpoRecomendados">
			
			@foreach ($temas->take(3) as $tema)
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
    <div class="row cabecera_secundaria mb-2">
        <h2>MEJORES COMENTARIOS</h2>
    </div>
	@if(Auth::user()->aprendiz->comentarios->isEmpty())
		<div class="card my-3 card_info">
	 <div class="card-header font-weight-bold card_info_text">
		Aqui se mostraran sus comentarios mejor valorados.
	 </div>
    <div class="card-body">
          
    <p class="card-text text-center ">Los comentarios son interacciones en los articulos creados por los maestros, para poder comentar en un articulo, antes hay que seguir al autor que lo creo. 
	 </p>
	 </div>
	  <div class="card-footer card_info_text">Haga click sobre el boton "Busqueda&nbsp;<i class="fas fa-search"></i>" debajo de su avatar, para buscar articulos de su interes.</div>

	
  </div>

	@else
    @foreach(Auth::user()->aprendiz->comentarios->sortByDesc('likes')->take(3) as $comentario)

    <div class="card mb-2 card_info">
        <div class="card-header font-weight-bold clickable_row" data-href="{{route('aprendiz_tema_ver',$comentario->tema->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver Articulo">
            {{$comentario->tema->titulo}}

        </div>
        <div class="card-body"> 
            <p class="card-text ">{!!$comentario->contenido!!}</p>
            </br><span class="text-muted">Creado el {{$comentario->created_at->format('d-m-Y')}} a las {{$comentario->created_at->format('H:i:s')}}</span>
        </div>
        <div class="card-footer">


            <span id="nºlikes_{{$comentario->id}}" class="likes_comentario mx-2"><i class="fas fa-thumbs-up mx-2" data-toggle="tooltip" data-placement="bottom" title="Me gusta"></i>{{$comentario->likes}}</span>

            <span id="nºdislikes_{{$comentario->id}}" class="dislikes_comentario mx-2"><i class="fas fa-thumbs-down mx-2" data-toggle="tooltip" data-placement="bottom" title="No me gusta"></i>{{$comentario->dislikes}}</span>
			 <div class="font-weight-bold clickable_row float-right" data-href="{{route('aprendiz_ver_maestro',$comentario->tema->maestro->id)}}" data-toggle="tooltip" data-placement="bottom" title="Autor">
            Maestro: {{$comentario->tema->maestro->nick_m}}

			</div>
        </div>
    </div>			


    @endforeach
	@endif
    <div class="row cabecera_secundaria mb-2">
        <h2>CATEGORIAS MAS BUSCADAS</h2>
    </div>
    <div class="table-responsive-md" id="aprendizMasBuscadas">
        <table class="table">
            <thead>
                <tr hidden>
                    <td class="col"></td>
                    <td class="col"></td>
                    <td class="col"></td>
                    <td class="col"></td>
                </tr>
            </thead>
            <tbody class="cuerpoCategorias" id="cuerpoCategorias_{{Auth::user()->aprendiz->id}}">

            </tbody>
        </table>
    </div>

</div>
<div class="col-md-4">
    <div class="container">
        <div class="row cabecera_secundaria">
            <h2>MIS MAESTROS</h2>
        </div>
		 @if(Auth::user()->aprendiz->maestros->isEmpty())
			<div class="card mb-2 my-2 card_info">
            <div class="card-body">

                <p class="card-text">No sigue a ningun maestro</p>
				
            </div>
			 <div class="card-footer">

               <p class="card_info_text">Al seguir a maestros, podra estar al dia de sus novedades y temas de interes</p>
				
            </div>
			         </div>
		@else
        <table class="table">
            <thead>
                <tr hidden>
                    <th scope="col">Avatar</th>
                    <th scope="col">Nick</th>
                </tr>
            </thead>
            <tbody id="cuerpoPerfiles">
                @foreach (Auth::user()->aprendiz->maestros as $maestro)

                <tr  class='clickable_row oculto' data-href="{{route('aprendiz_ver_maestro',$maestro->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver {{$maestro->nick_m}}">
               
							@if($maestro->avatar_m!=null)
				<td class="col-sm-auto"><img src="{{ asset('storage/'.$maestro->avatar_m) }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="maestro"></img></td>
			@else
				<td class="col-sm-auto"><img src="{{ asset('images/profesor.jpg') }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="maestro"></img></td>
			@endif
                    <td class="font-weight-bold align-middle col-sm-auto" >{{$maestro->nick_m}}</td>
                </tr>

                @endforeach
            </tbody>
			
        </table>

		<div class="row justify-content-between">
			
			<a role="button" class="visible" id="vermas">mostrar más</a>
			<a role="button" class="oculto" id="vermenos">mostrar menos</a>
			</div>

		@endif
    </div>


</div>


@endsection