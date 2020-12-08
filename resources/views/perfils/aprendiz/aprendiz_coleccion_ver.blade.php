@extends('perfils.aprendiz.aprendiz')

@section('medio_aprendiz')
<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('aprendiz')}}">Aprendiz: {{Auth::user()->aprendiz->nick_a}}</a></li>
	<li class="breadcrumb-item" aria-current="page"><a href="{{route('buscador')}}">Buscador de Articulos</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('aprendiz_coleccion_ver',$coleccion->id)}}">Colección: {{$coleccion->titulo}}</a></li>
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
						@php
                        $control=false;
                        @endphp

                        @foreach(Auth::user()->aprendiz->votos as $voto)
                        @if($voto->coleccion!=null &&  $voto->coleccion->id == $coleccion->id)
                        @php
                        $control=true;
                        @endphp	
                        @endif			
                        @endforeach

                        @if($control==true)
						<a class="btn" id="btn_like_coleccion_{{$coleccion->id}}" data-toggle="modal" data-target=".modal_votado_coleccion" title="Me gusta"><i class="fas fa-thumbs-up"></i></a>	
                        <span id="nºlikes_{{$coleccion->id}}" class="likes_coleccion">{{$coleccion->likes}}</span>
                        <a class="btn" id="btn_dislike_coleccion_{{$coleccion->id}}" data-toggle="modal" data-target=".modal_votado_coleccion" title="No me gusta"><i class="fas fa-thumbs-down"></i></a>
                        <span id="nºdislikes_{{$coleccion->id}}" class="dislikes_coleccion">{{$coleccion->dislikes}}</span>
						@else
                        <a class="btn btn_like_coleccion" id="btn_like_coleccion_{{$coleccion->id}}" data-toggle="modal" data-target=".modal_votar_coleccion" title="Me gusta">><i class="fas fa-thumbs-up"></i></a>	
                        <span id="nºlikes_{{$coleccion->id}}" class="likes_coleccion">{{$coleccion->likes}}</span>
                        <a class="btn btn_dislike_coleccion" id="btn_dislike_coleccion_{{$coleccion->id}}" data-toggle="modal" data-target=".modal_votado_coleccion" title="No me gusta"><i class="fas fa-thumbs-down"></i></a>
                        <span id="nºdislikes_{{$coleccion->id}}" class="dislikes_coleccion">{{$coleccion->dislikes}}</span>
						<input class="aprendiz_id" type="hidden" value="{{Auth::user()->aprendiz->id}}">
                        <input class="coleccion_id" type="hidden" value="{{$coleccion->id}}">
						@endif
						<div class="modal fade modal_votado_coleccion" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">   
                                    <div class="modal-body">
                                        Ya has votado esta coleccion
                                    </div>
                                    <div class="modal-footer">
                                        Gracias por participar.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade modal_votar_coleccion" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
						<a class="btn btn_reporte  ml-3" data-toggle="modal" data-target="#reportColeccionModal" title="Reportar"><i class="fas fa-exclamation-triangle" ></i></a>
						<!-- Modal Reportes -->
                        <div class="modal fade reportModal" id="reportColeccionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Reportar Colección : {{$coleccion->titulo}}</h5>
                                        <button type="button" class="close reportCerrar" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                   
                                        <div class="modal-body">

                                            <label for="motivo" class="col-form-label">Motivo:</label>
                                            <textarea class="form-control" name="motivo" id="motivo_reporte" required></textarea>                                            
                                            <input id="coleccion_id_reporte" type="hidden" value="{{$coleccion->id}}">
											<button id="creaReporte" class="btn btn-danger mt-2">Reportar</button>

                                        </div>
										<div class="modal-footer">
										<span class="text-muted">* Por favor, antes de reportar contacte con el autor.</span>
										</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-auto font-weight-bold clickable_row " data-href="{{route('aprendiz_ver_maestro',$coleccion->maestro->id)}}" data-toggle="tooltip" data-placement="bottom" title="Autor">
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
</div>
</div>

@endsection