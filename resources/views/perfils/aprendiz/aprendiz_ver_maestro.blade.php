@extends('perfils.aprendiz.aprendiz')

@section('medio_aprendiz')
		@php
        $control=false;
        @endphp

        @foreach($maestro->aprendices as $aprendiz)

        @if(Auth::user()->aprendiz->nick_a == $aprendiz->nick_a )
        @php
        $control=true;
        @endphp	
        @endif			
        @endforeach

<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('aprendiz')}}">Aprendiz: {{Auth::user()->aprendiz->nick_a}}</a></li>
	<li class="breadcrumb-item" aria-current="page"><a href="{{route('aprendiz_lista_maestros')}}">Lista Maestros</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('aprendiz_ver_maestro',$maestro->id)}}">Maestro: {{ $maestro->nick_m }}</a></li>
  </ol>
</nav>
  <div class="container rounded" id="perfilVisitado">
    <div class="row rounded nombre_perfil mx-1">
        <h2 class="text-center font-weight-bold ">Maestro: {{ $maestro->nick_m }}</h2>
    </div>
   
    <div class="row">
        <div class="col-md-auto px-3" id="perfil-visited-avatar">




            <div class="row p-3">
                @if($maestro->avatar_m!=null)
                <img src="{{ asset('storage/'.$maestro->avatar_m) }}" width="200px" height="200px" class="img-fluid avatar"  alt="maestro"></img>
                @else
                <img src="{{ asset('images/profesor.jpg') }}" width="200px" height="200px" class="img-fluid avatar" alt="maestro"></img>
                @endif

            </div>

			 <div class="row px-3" id="perfil-visited-options">

       

        @if($control==true )
        <a href="{{route('aprendiz_expulsar',$maestro->id)}}" class='btn btn-danger align-middle'  style="padding: 10px;"><i class="fas fa-2x fa-door-closed align-middle" style="font-size:20px;" ></i><span>&nbsp;&nbsp;ABANDONAR</span></a>
        @else
        <a href="{{route('aprendiz_seguir',$maestro->id)}}" class='btn btn-success align-middle'  style="padding: 10px;"><i class="fas fa-2x fa-door-open align-middle" style="font-size:20px;" ></i><span>&nbsp;&nbsp;SEGUIR</span></a>
        @endif
		<a class="btn btn_reporte btn-primary mx-1" data-toggle="modal" data-target="#reportMaestroModal" title="Reportar"><i class="fas fa-exclamation-triangle" ></i></a>
						<!-- Modal Reportes -->
                        <div class="modal fade reportModal" id="reportMaestroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reportar maestro</h5>
                                        <button type="button" class="close reportCerrar" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                   
                                        <div class="modal-body">

                                            <label for="motivo" class="col-form-label">Motivo:</label>
                                            <textarea class="form-control" name="motivo" id="motivo_reporte" required></textarea>                                            
                                            <input id="maestro_id_reporte" type="hidden" value="{{$maestro->id}}">
											<button id="creaReporte" class="btn btn-danger mt-2">Reportar</button>

                                        </div>
										<div class="modal-footer">
										<span class="text-muted">* Por favor, antes de reportar contacte con la persona.</span>
										</div>
                                   
                                </div>
                            </div>
                        </div>



    </div>

        </div>
        <div class="col-md-auto px-3" id="perfil-visited-info">


            <ul class="list-group list-group-flush perfil_info font-weight-bold my-3">
                <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Email"><i class="fas fa-at"></i>&nbsp;&nbsp;{{$maestro->user->email}}</li>
                @if($maestro->user->localidad!=null)
                <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Localidad"><i class="fas fa-house-user"></i>&nbsp;&nbsp;{{$maestro->user->localidad}}</li>
                @endif
                @if($maestro->user->birthdate!=null)
                <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Fecha de nacimiento"><i class="fas fa-birthday-cake"></i>&nbsp;&nbsp;{{date("d-m-Y", strtotime($maestro->user->birthdate))}}</li>
                @endif
                @if($maestro->user->genero!=null)
                <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Genero"><i class="fas fa-venus-mars"></i>&nbsp;&nbsp;{{$maestro->user->genero}}</li>
                @endif
                <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Fecha de registro">Usuario desde {{$maestro->user->created_at->format('d-m-Y')}}</li>
            </ul>
			

        </div>


    </div>
	
    <div class="container px-3" id="perfil-visited-about">

        <div class="card my-3 card_info">

            <div class="card-body">
                <h5 class="card-title  cabecera_secundaria">SOBRE MI</h5>
                <p class="card-text">{{$maestro->descripcion_m}}</p>
            </div>
        </div>


    </div>
    <div class="container perfil_contenido py-2 px-3">

        <div class="row cabecera_secundaria">
            <h2>TOP ARTICULOS</h2>
        </div>
        @if($maestro->temas->isEmpty())
        <div class="card my-3 card_info">
            <div class="card-body">

                <p class="card-text">El maestro no ha creado ningun articulo</p>
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
                <tbody id="cuerpoTemas">
                    @foreach ($maestro->temas->sortByDesc('likes')->take(3) as $tema)
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
		<div class="row justify-content-between my-2">
			
			<a href="{{route('aprendiz_ver_maestro_temas',$maestro->id)}}" role="button" id="vermasArticulos">ver todos</a>
			</div>
        @endif
        <div class="row cabecera_secundaria">
            <h2>TOP COLECCIONES</h2>
        </div>

        @if($maestro->colecciones->isEmpty())
        <div class="card my-3 card_info">
            <div class="card-body">

                <p class="card-text">El maestro no ha creado ninguna coleccion</p>
            </div>
        </div>


        @else


        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr hidden>
                        <td class="col"></td>
                        <td class="col"></td>           
                    </tr>
                </thead>
                <tbody id="cuerpoColecciones">
                    @foreach ($maestro->colecciones->sortByDesc('likes')->take(3) as $coleccion)
                    <tr  class='clickable_row' data-href="{{route('aprendiz_coleccion_ver',$coleccion->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver Coleccion">
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
		<div class="row justify-content-between my-2">
			
			<a href="{{route('aprendiz_ver_maestro_colecciones',$maestro->id)}}" role="button" id="vermasColecciones">ver todas</a>
			</div>
        @endif
    </div>
</div>
</div>
</div>


@endsection