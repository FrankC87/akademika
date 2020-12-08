@extends('perfils.aprendiz.aprendiz')

@section('medio_aprendiz')


<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('aprendiz')}}">Aprendiz: {{Auth::user()->aprendiz->nick_a}}</a></li>
	<li class="breadcrumb-item" aria-current="page"><a href="{{route('aprendiz_lista_aprendices')}}">Lista Aprendices</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('aprendiz_ver_aprendiz',$aprendiz->id)}}">Aprendiz: {{ $aprendiz->nick_a }}</a></li>
  </ol>
</nav>
    <div class="container rounded" id="perfilVisitado">
    <div class="row rounded nombre_perfil mx-1">
        <h2 class="text-center font-weight-bold">Aprendiz: {{ $aprendiz->nick_a }}</h2>
    </div>

    <div class="row">
        <div class="col-md-auto px-3" id="perfil-visited-avatar">




            <div class="row p-3">
                @if($aprendiz->avatar_a!=null)
                <img src="{{ asset('storage/'.$aprendiz->avatar_a) }}" width="200px" height="200px" class="img-fluid avatar" alt="aprendiz"></img>
                @else
                <img src="{{ asset('images/aprendiz.jpg') }}" width="200px" height="200px" class="img-fluid avatar" alt="aprendiz"></img>
                @endif

            </div>
			 <div class="row px-3" id="perfil-visited-options">

       

    
			<a class="btn btn_reporte btn-primary mx-1 align-middle" data-toggle="modal" data-target="#reportAprendizModal" title="Reportar"><i class="fas fa-exclamation-triangle" ></i></a>
						<!-- Modal Reportes -->
                        <div class="modal fade reportModal" id="reportAprendizModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reportar aprendiz</h5>
                                        <button type="button" class="close reportCerrar" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                   
                                        <div class="modal-body">

                                            <label for="motivo" class="col-form-label">Motivo:</label>
                                            <textarea class="form-control" name="motivo" id="motivo_reporte" required></textarea>                                            
                                            <input id="aprendiz_id_reporte" type="hidden" value="{{$aprendiz->id}}">
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
                <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Email"><i class="fas fa-at"></i>&nbsp;&nbsp;{{$aprendiz->user->email}}</li>
                @if($aprendiz->user->localidad!=null)
                <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Localidad"><i class="fas fa-house-user"></i>&nbsp;&nbsp;{{$aprendiz->user->localidad}}</li>
                @endif
                @if($aprendiz->user->birthdate!=null)
                <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Fecha de nacimiento"><i class="fas fa-birthday-cake"></i>&nbsp;&nbsp;{{date("d-m-Y", strtotime($aprendiz->user->birthdate))}}</li>
                @endif
                @if($aprendiz->user->genero!=null)
                <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Genero"><i class="fas fa-venus-mars"></i>&nbsp;&nbsp;{{$aprendiz->user->genero}}</li>
                @endif
                <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Fecha de registro">Usuario desde {{$aprendiz->user->created_at->format('d-m-Y')}}</li>
            </ul>


        </div>


    </div>
    <div class="container px-3" id="perfil-visited-about">

        <div class="card my-3 card_info">

            <div class="card-body">
                <h5 class="card-title  cabecera_secundaria">SOBRE MI</h5>
                <p class="card-text">{{$aprendiz->descripcion_a}}</p>
            </div>
        </div>


    </div>
    <div class="container perfil_contenido py-2 px-3">

        <div class="row cabecera_secundaria mb-2">
        <h2>MEJORES COMENTARIOS</h2>
    </div>
        @if($aprendiz->comentarios->isEmpty())
        <div class="card my-3 card_info">
            <div class="card-body">

                <p class="card-text">El aprendiz no ha realizado ningun comentario</p>
            </div>
        </div>


        @else
     
    @foreach($aprendiz->comentarios->sortByDesc('likes')->take(3) as $comentario)

    <div class="card my-3 card_info">
        <div class="card-header font-weight-bold clickable_row" data-href="{{route('aprendiz_tema_ver',$comentario->tema->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver Articulo">
            {{$comentario->tema->titulo}}

        </div>
        <div class="card-body"> 
            <p class="card-text ">{!!$comentario->contenido!!}</p>
            </br><span class="text-muted">Creado el {{$comentario->created_at->format('d-m-Y')}} a las {{$comentario->created_at->format('H:m:s')}}</span>
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

        @if($aprendiz->busquedas->isEmpty())
        <div class="card my-3 card_info">
            <div class="card-body">

                <p class="card-text">El aprendiz no ha realizado ninguna busqueda</p>
            </div>
        </div>


        @else


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
            <tbody class="cuerpoCategorias" id="cuerpoCategorias_{{$aprendiz->id}}">

            </tbody>
        </table>
    </div>

        @endif
    </div>
</div>
</div>
</div>


@endsection