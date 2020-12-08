@extends('perfils.maestro.maestro')

@section('medio_maestro')

<div class="col-md-8">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('maestro')}}">Maestro: {{Auth::user()->maestro->nick_m}}</a></li>
  </ol>
</nav>
	<div class="card mb-3 card_perfil">
  
    <div class="card-body">
            <h5 class="card-title  cabecera_secundaria">SOBRE MI</h5>
    <p class="card-text">{{Auth::user()->maestro->descripcion_m}}</p>
  </div>
</div>
	<div class="row cabecera_secundaria mb-2">
        <h2>TENDENCIAS</h2>
    </div>
	  <div class="table-responsive-md">
        <table class="table">
            <thead>
                <tr hidden>
                    <td class="col"></td>
                    <td class="col"></td>
                    <td class="col"></td>
                    <td class="col"></td>
                </tr>
            </thead>
            <tbody class="cuerpoTendencias" id="cuerpoTendencias">

            </tbody>
        </table>
    </div>
    <div class="row cabecera_secundaria">
        <h2>TOP ARTICULOS</h2>
    </div>

	@if(Auth::user()->maestro->temas->isEmpty())
		<div class="card my-3 card_info">
	 <div class="card-header font-weight-bold card_info_text">
		Aqui se mostraran sus articulos mejor valorados.
	 </div>
    <div class="card-body">
          
    <p class="card-text text-center ">Los artículos son creados por los maestros, permiten compartir información con los aprendices de la plataforma, estos podrán acceder a los mismos y en caso de captar su atención seguirán al maestro para estar atento a las novedades del mismo. 
	 </p>
	 </div>
	  <div class="card-footer card_info_text">Haga click sobre el boton "Articulos&nbsp;<i class="fas fa-hand-point-right"></i>" debajo de su avatar, para crear su primer articulo.</div>

	
  </div>

	@else
	<div class="card my-3 card_info">
	 
    <div class="card-body">	
    <div class="table-responsive-md">
        <table class="table">
            <thead>
                <tr hidden>
                    <td class="col"></td>
					<td class="col"></td>
                 
                </tr>
            </thead>
            <tbody id="cuerpoTemas">
                @foreach (Auth::user()->maestro->temas->sortByDesc('likes')->take(3) as $tema)
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
	</div>
	  

	
  </div>
	@endif

    <div class="row cabecera_secundaria">
        <h2>TOP COLECCIONES</h2>
    </div>
  @if(Auth::user()->maestro->colecciones->isEmpty())
		<div class="card my-3 card_info">
	 <div class="card-header font-weight-bold card_info_text">
		Aqui se mostraran sus colecciones mejor valoradas.
	 </div>
    <div class="card-body">
          
    <p class="card-text text-center ">Las colecciones son agrupaciones de articulos, de tal manera que permiten la creacion de cursos y demas. 
	 </p>
	 </div>
	  <div class="card-footer card_info_text">Haga click sobre el boton "Colecciones&nbsp;<i class="fas fa-archive"></i>" debajo de su avatar, para crear su primera coleccion.</div>

	
  </div>

	@else
	<div class="card my-3 card_info">
	 
    <div class="card-body">	
	    <div class="table-responsive">
        <table class="table">
         <thead>
                <tr hidden>
                    <td class="col"></td>
					<td class="col"></td>           
                </tr>
            </thead>
            <tbody id="cuerpoColecciones">
                @foreach (Auth::user()->maestro->colecciones->sortByDesc('likes')->take(3) as $coleccion)
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
	</div>
	</div>
	@endif
</div>
<div class="col-md-4">
    <div class="container">
        <div class="row cabecera_secundaria">
            <h2>MIS APRENDICES</h2>
        </div>
        @if(Auth::user()->maestro->aprendices->isEmpty())
			<div class="card mb-2 my-2 card_info">
            <div class="card-body">

                <p class="card-text">No le sigue ningun aprendiz</p>
				
            </div>
			 <div class="card-footer">

               <p class="card_info_text">Cree articulos para llamar la antención de los aprendices</p>
				
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
                    @foreach (Auth::user()->maestro->aprendices as $aprendiz)

                    <tr class='clickable_row oculto' data-href="{{route('maestro_ver_aprendiz',$aprendiz->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver {{$aprendiz->nick_a}}">
                        	@if($aprendiz->avatar_a!=null)
				<td class="col-sm-auto"><img src="{{ asset('storage/'.$aprendiz->avatar_a) }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="aprendiz"></img></td>
			@else
				<td class="col-sm-auto"><img src="{{ asset('images/aprendiz.jpg') }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="aprendiz"></img></td>
			@endif
                        <td class="font-weight-bold align-middle col-sm-auto" >{{$aprendiz->nick_a}}</td>
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