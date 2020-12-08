@extends('perfils.maestro.maestro')

@section('medio_maestro')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro')}}">Maestro: {{Auth::user()->maestro->nick_m}}</a></li>
            @if($tema->coleccion_id==null)
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro_temas',$tema->maestro->id)}}">Articulos</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('maestro_tema_ver',$tema->id)}}">Articulo: {{$tema->titulo}}</a></li>
            @else
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro_colecciones',Auth::user()->maestro->id)}}">Colecciones</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro_coleccion_ver',$tema->coleccion->id)}}">Colección: {{$tema->coleccion->titulo}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{route('maestro_tema_ver',$tema->id)}}">Articulo: {{$tema->titulo}}</a></li>
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
                        @if(Auth::user()->maestro->nick_m == $tema->maestro->nick_m)
                        <a class="btn btn_edit" id="btn_edit_{{$tema->id}}" href="{{route('tema_editar',$tema->id)}}"><i class="fas fa-edit" data-toggle="tooltip" data-placement="bottom" title="Editar"></i></a>
                        <a class="btn btn_delete" id="btn_delete_{{$tema->id}}" href="{{route('tema_borrar',$tema->id)}}"><i class="fas fa-minus-circle" data-toggle="tooltip" data-placement="bottom" title="Borrar"></i></a>
                        @endif

                        <a class="btn" id="btn_like_{{$tema->id}}"><i class="fas fa-thumbs-up" data-toggle="tooltip" data-placement="bottom" title="Me gusta"></i></a>	
                        <span id="nºlikes_{{$tema->id}}" class="likes_tema">{{$tema->likes}}</span>
                        <a class="btn" id="btn_dislike_{{$tema->id}}"><i class="fas fa-thumbs-down" data-toggle="tooltip" data-placement="bottom" title="No me gusta"></i></a>
                        <span id="nºdislikes_{{$tema->id}}" class="dislikes_tema">{{$tema->dislikes}}</span>
                    </div>
                    <div class="col-sm-auto font-weight-bold clickable_row " data-href="{{route('maestro_ver_maestro',$tema->maestro->id)}}" data-toggle="tooltip" data-placement="bottom" title="Autor">
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
                @if ($comentario->maestro!=null  &&  Auth::user()->maestro->nick_m == $comentario->maestro->nick_m)       
                <a class="btn btn_edit" id="btn_edit_{{$comentario->id}}" href="{{route('comentario_editar',$comentario->id)}}"><i class="fas fa-edit" data-toggle="tooltip" data-placement="bottom" title="Editar"></i></a>			              
                @endif
                <a class="btn btn_delete" id="btn_delete_{{$comentario->id}}" href="{{ route('comentario_borrar',$comentario->id) }}"><i class="fas fa-minus-circle" data-toggle="tooltip" data-placement="bottom" title="Borrar"></i></a>
                @php
                $control=false;
                @endphp

                @foreach(Auth::user()->maestro->votos as $voto)
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
                <input class="maestro_id" type="hidden" value="{{Auth::user()->maestro->id}}">
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
    <div class="row">
        <span>{{Session::get('message')}}</span>
    </div>


    <form method='post' action="{{ route('comentario_guardar') }}">
        @csrf
        <div class="form-group">
            <label for="form_comentario">Comentario</label>
            <textarea name="comentario" class="form-control ckeditor @error('comentario') is-invalid @enderror" id="form_comentario" ></textarea>
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
            <input type="text" name="autor_m" class="form-control d-none" id="autor_m" value="{{Auth::user()->maestro->id}}">
        </div>
        <button type="submit" class="btn btn-success btn-lg">Añadir Comentario</button>
    </form>

</div>
@endsection