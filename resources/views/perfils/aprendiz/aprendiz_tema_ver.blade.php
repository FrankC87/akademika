@extends('perfils.aprendiz.aprendiz')

@section('medio_aprendiz')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('aprendiz')}}">Aprendiz: {{Auth::user()->aprendiz->nick_a}}</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('buscador')}}">Buscador de Articulos</a></li>

            @if($tema->coleccion_id==null)
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('aprendiz_tema_ver',$tema->id)}}">Articulo: {{$tema->titulo}}</a></li>
            @else
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('aprendiz_coleccion_ver',$tema->coleccion->id)}}">Colección: {{$tema->coleccion->titulo}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('aprendiz_tema_ver',$tema->id)}}">Articulo: {{$tema->titulo}}</a></li>
            @endif
        </ol>
    </nav>

    <div class="card my-2 card_articulo">
        <div class="card-header font-weight-bold lead">
            {{$tema->titulo}}
        </div>

        <div class="card-body" id="tema_contenido">	
            {!! $tema->contenido !!}
        </div>

        <div class="card-footer">
            <div class="container">
                <div class="row  d-flex justify-content-between">
                    <span class="text-muted">Creado el {{$tema->created_at->format('d-m-Y')}} a las {{$tema->created_at->format('H:i:s')}}</span> 
                    @if($tema->updated_at != $tema->created_at)
                    <span class="text-muted">Ultima edición el {{$tema->updated_at->format('d-m-Y')}} a las {{$tema->updated_at->format('H:i:s')}}</span>

                    @endif
                </div>
                <div class="row  d-flex justify-content-between">
                    <div class="col-md-auto">
                        @php
                        $control=false;
                        @endphp

                        @foreach(Auth::user()->aprendiz->votos as $voto)
                        @if($voto->tema!=null &&  $voto->tema->id == $tema->id)
                        @php
                        $control=true;
                        @endphp	
                        @endif			
                        @endforeach

                        @if($control==true)					
                        <a class="btn" id="btn_like_tema_{{$tema->id}}"><i class="fas fa-thumbs-up" data-toggle="modal" data-target=".modal_votado_articulo" title="Me gusta"></i></a>	
                        <span id="nºlikes_tema_{{$tema->id}}" class="likes_tema">{{$tema->likes}}</span>
                        <a class="btn" id="btn_dislike_{{$tema->id}}"><i class="fas fa-thumbs-down" data-toggle="modal" data-target=".modal_votado_articulo" title="No me gusta"></i></a>
                        <span id="nºdislikes_tema_{{$tema->id}}" class="dislikes_tema">{{$tema->dislikes}}</span>             
                        @else				
                        <a class="btn btn_like_tema" id="btn_like_tema_{{$tema->id}}"><i class="fas fa-thumbs-up" data-toggle="modal" data-target=".modal_votar_articulo" title="Me gusta"></i></a>	
                        <span id="nºlikes_tema_{{$tema->id}}" class="likes_tema">{{$tema->likes}}</span>
                        <a class="btn btn_dislike_tema" id="btn_dislike_{{$tema->id}}"><i class="fas fa-thumbs-down" data-toggle="modal" data-target=".modal_votar_articulo" title="No me gusta"></i></a>
                        <span id="nºdislikes_tema_{{$tema->id}}" class="dislikes_tema">{{$tema->dislikes}}</span>
                        <input class="aprendiz_id" type="hidden" value="{{Auth::user()->aprendiz->id}}">
                        <input class="tema_id" type="hidden" value="{{$tema->id}}">
                        @endif
                        <!-- Modal Votado -->
                        <div class="modal fade modal_votado_articulo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">   
                                    <div class="modal-body">
                                        Ya has votado este articulo
                                    </div>
                                    <div class="modal-footer">
                                        Gracias por participar.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Votar -->
                        <div class="modal fade modal_votar_articulo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">   
                                    <div class="modal-body">
                                        Su voto se ha registrado.
                                    </div>
                                    <div class="modal-footer">
                                        Gracias por participar.
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<a class="btn btn_reporte  ml-3" data-toggle="modal" data-target="#reportTemaModal" title="Reportar"><i class="fas fa-exclamation-triangle" ></i></a>
						<!-- Modal Reportes -->
                        <div class="modal fade reportModal" id="reportTemaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reportar Articulo : {{$tema->titulo}}</h5>
                                        <button type="button" class="close reportCerrar" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                   
                                        <div class="modal-body">

                                            <label for="motivo" class="col-form-label">Motivo:</label>
                                            <textarea class="form-control" name="motivo" id="motivo_reporte" required></textarea>                                            
                                            <input id="tema_id_reporte" type="hidden" value="{{$tema->id}}">
											<button id="creaReporte" class="btn btn-danger mt-2">Reportar</button>

                                        </div>
										<div class="modal-footer">
										<span class="text-muted">* Por favor, antes de reportar contacte con el autor.</span>
										</div>
                                </div>
                            </div>
                        </div>
						<!--Favorito-->
                        @php
                        $control=false;
                        @endphp
					
                        @foreach(Auth::user()->aprendiz->favoritos as $favorito)
                        @if($favorito!=null &&  $favorito->id == $tema->id)
                        @php
                        $control=true;
                        @endphp	
                        @endif			
                        @endforeach
					
                        @if($control==true)		
                        <a class="btn btn_favorito btn-warning ml-3" href="{{route('aprendiz_favoritos_quitar',$tema->id)}}" data-toggle="tooltip" data-placement="bottom" title="Quitar de favoritos">Favorito <i class="fas fa-star" ></i></a>
                        @else
                        <a class="btn btn_favorito btn-warning ml-3" href="{{route('aprendiz_favoritos_añadir',$tema->id)}}" data-toggle="tooltip" data-placement="bottom" title="Añadir a favoritos">Favorito <i class="far fa-star" ></i></a>
                        @endif

                    </div>                  
                    <div class="col-sm-auto font-weight-bold clickable_row " data-href="{{route('aprendiz_ver_maestro',$tema->maestro->id)}}" data-toggle="tooltip" data-placement="bottom" title="Autor">
                        Autor: {{$tema->maestro->nick_m}}			
                    </div>
                </div>
            </div>

        </div>
    </div>



    <div class="row cabecera_secundaria mb-2">
        <h2>Comentarios</h2>
    </div>
    @foreach($tema->comentarios as $comentario)

    <div class="container mb-2 ">
        <div class="row p-2 mb-1 comentarioCabecera">
            <div class="col-sm-auto">
                @if($comentario->maestro!=null)
                @if($comentario->maestro->avatar_m!=null)
                <img src="{{ asset('storage/'.$comentario->maestro->avatar_m) }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="maestro"></img>
                @else
                <img src="{{ asset('images/profesor.jpg') }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="maestro"></img>
                @endif
                @else
                @if($comentario->aprendiz->avatar_a!=null)
                <img src="{{ asset('storage/'.$comentario->aprendiz->avatar_a) }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="maestro"></img>
                @else
                <img src="{{ asset('images/aprendiz.jpg') }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="maestro"></img>
                @endif
                @endif
            </div>

            <div class="col-md-auto font-weight-bold" >
                <div class="row" style="font-size:1.5em;">
                    @if ($comentario->maestro==null)
                    {{$comentario->aprendiz->nick_a}}
                    @else
                    Autor: {{$comentario->maestro->nick_m}}
                    @endif
                </div>
                <div class="row" style="font-size:0.8em;">
                    @if ($comentario->maestro==null)
                    {{$comentario->aprendiz->totalComentarios()}} comentarios en la plataforma
                    @else
                    {{$comentario->maestro->totalTemas()}} articulos en la plataforma
                    @endif
                </div>
            </div>
        </div>

        <div class="row comentario_texto">
            <div class="col-auto">
                {!!$comentario->contenido!!}
            </div>
        </div>

        <div class="row comentario_texto d-flex justify-content-between">
            <div class="col-auto">
                @if($comentario->updated_at != $comentario->created_at)
                <span class="text-muted" style="font-size:0.75em;">Ultima edición el {{$tema->updated_at->format('d-m-Y')}} a las {{$tema->updated_at->format('H:i:s')}}</span>
                @else
                <span class="text-muted" style="font-size:0.75em;">Creado el {{$comentario->created_at->format('d-m-Y')}} a las {{$comentario->created_at->format('H:i:s')}}</span>    
                @endif			
            </div>

            <div class="col-auto">
		
                @if ($comentario->aprendiz!=null && Auth::user()->aprendiz->nick_a == $comentario->aprendiz->nick_a)       

                <a class="btn btn_edit" id="btn_edit_{{$comentario->id}}" href="{{route('comentario_editar',$comentario->id)}}"><i class="fas fa-edit"></i></a>
                <a class="btn btn_delete" id="btn_delete_{{$comentario->id}}" href="{{ route('comentario_borrar',$comentario->id) }}"><i class="fas fa-minus-circle"></i></a>
				@else
				<a class="btn btn_reporte  ml-3" data-toggle="modal" data-target="#reportComentarioModal" title="Reportar"><i class="fas fa-exclamation-triangle" ></i></a>
						<!-- Modal Reportes -->
                        <div class="modal fade reportModal" id="reportComentarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reportar comentario</h5>
                                        <button type="button" class="close reportCerrar" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                   
                                        <div class="modal-body">

                                            <label for="motivo" class="col-form-label">Motivo:</label>
                                            <textarea class="form-control" name="motivo" id="motivo_reporte" required></textarea>                                            
                                            <input id="comentario_id_reporte" type="hidden" value="{{$comentario->id}}">
											<button id="creaReporte" class="btn btn-danger mt-2">Reportar</button>

                                        </div>
										<div class="modal-footer">
										<span class="text-muted">* Por favor, antes de reportar contacte con el autor.</span>
										</div>
                                   
                                </div>
                            </div>
                        </div>
                @endif              
                @php
                $control=false;
                @endphp

                @foreach(Auth::user()->aprendiz->votos as $voto)
                @if($voto->comentario!=null && $voto->comentario->id == $comentario->id)
                @php
                $control=true;
                @endphp	
                @endif			
                @endforeach

                @if($control==true)					
                <a class="btn" id="btn_like_{{$comentario->id}}"><i class="fas fa-thumbs-up" data-toggle="modal" data-target=".modal_votado" title="Me gusta"></i></a>	
                <span id="nºlikes_{{$comentario->id}}" class="likes_comentario">{{$comentario->likes}}</span>
                <a class="btn" id="btn_dislike_{{$comentario->id}}"><i class="fas fa-thumbs-down" data-toggle="modal" data-target=".modal_votado" title="No me gusta"></i></a>
                <span id="nºdislikes_{{$comentario->id}}" class="dislikes_comentario">{{$comentario->dislikes}}</span>             

                @else				
                <a class="btn btn_like" id="btn_like_{{$comentario->id}}"><i class="fas fa-thumbs-up" data-toggle="modal" data-target=".modal_votar" title="Me gusta"></i></a>	
                <span id="nºlikes_{{$comentario->id}}" class="likes_comentario">{{$comentario->likes}}</span>
                <a class="btn btn_dislike" id="btn_dislike_{{$comentario->id}}"><i class="fas fa-thumbs-down" data-toggle="modal" data-target=".modal_votar" title="No me gusta"></i></a>
                <span id="nºdislikes_{{$comentario->id}}" class="dislikes_comentario">{{$comentario->dislikes}}</span>
                <input class="aprendiz_id" type="hidden" value="{{Auth::user()->aprendiz->id}}">
                <input class="comentario_id" type="hidden" value="{{$comentario->id}}">
                @endif
                <div class="modal fade modal_votado" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">   
                            <div class="modal-body">
                                Ya has votado este comentario
                            </div>
                            <div class="modal-footer">
                                Gracias por participar.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade modal_votar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">   
                            <div class="modal-body">
                                Su voto se ha registrado.
                            </div>
                            <div class="modal-footer">
                                Gracias por participar.
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>

    </div>
    @endforeach

    @php
    $control=false;
    @endphp

    @foreach($tema->maestro->aprendices as $aprendiz)

    @if(Auth::user()->aprendiz->nick_a == $aprendiz->nick_a )
    @php
    $control=true;
    @endphp	
    @endif			
    @endforeach

    @if($control==true)
    <form method='post' action="{{ route('aprendiz_comentario_guardar') }}">
        @csrf
        <div class="form-group">
            <label for="form_comentario">Comentario</label>
            <textarea name="comentario" class="form-control ckeditor @error('comentario') is-invalid @enderror" id="form_comentario" rows="3"></textarea>
            @error('comentario')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="number" name="tema_id" class="form-control d-none" id="tema_id" value="{{$tema->id}}">
        </div>
        <div class="form-group">
            <input type="text" name="autor_a" class="form-control d-none" id="autor_a" value="{{Auth::user()->aprendiz->id}}">
        </div>
        <button type="submit" class="btn btn-success">Añadir Comentario</button>
    </form>
    @else
    <div class="card my-3 card_info">
        <div class="card-header font-weight-bold card_info_text">
            No puede comentar en este articulo
        </div>
        <div class="card-body">

            <p class="card-text text-center ">Solo los aprendices que sigan al autor, podran comentar en este articulo. Al seguir a un maestro recibiras una notificación, cada vez que este realice una publicación.
            </p>
        </div>
        <div class="card-footer card_info_text">  <a href="{{route('aprendiz_seguir',$tema->maestro->id)}}" class='btn btn-success align-middle' style="padding: 10px;"><i class="fas fa-2x fa-door-open align-middle" style="font-size:20px;" ></i><span>&nbsp;&nbsp;SEGUIR</span></a></div>

        @endif
    </div>

    @endsection