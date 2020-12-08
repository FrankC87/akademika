@extends('perfils.aprendiz.aprendiz_mensajes')

@section('cuerpo_mensajes')


		<div class="row cabecera_secundaria">
			<h4>Mensajes Leidos</h4>
		</div>
	
        <div class="input-group md-form form-sm form-1 pl-0 my-2">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
            </div>
            <input class="form-control my-0 py-1" id="buscador_tabla" type="text" placeholder="Buscar mensaje" aria-label="Search">
        </div>
		@if(Auth::user()->aprendiz->mensajesLeidos->isEmpty())
			<div class="card mb-2 my-2">
            <div class="card-body">

                <p class="card-text">No hay mensajes que mostrar</p>
            </div>
        </div>
		@else
        <div >
              <table id="tablaMensajes" class="table order-column" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col" class="cabecera_celda">DIA</th>
						 <th scope="col" class="cabecera_celda">HORA</th>
						  <th scope="col" class="cabecera_celda">EMISOR</th>
						   <th scope="col" class="cabecera_celda">ASUNTO</th>
						    <th scope="col" class="cabecera_celda"></th>

                    </tr>
                </thead>
                <tbody id="body_tabla">
                    @foreach (Auth::user()->aprendiz->mensajesLeidos as $mensaje)
					
                    <tr  class='clickable_row' data-href="{{route('aprendiz_ver_recibido',$mensaje->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver mensaje">
					
					
						<td class="col-sm-auto">{{$mensaje->created_at->format('d/m/Y')}}</td>
						<td class="col-sm-auto">{{$mensaje->created_at->format('H:i:s')}}</td>
						@if($mensaje->emisor_m==null)
                        <td class="col-sm-auto">Aprendiz: {{$mensaje->emisorAprendiz->nick_a}}</td>
						@else
						<td class="col-sm-auto">Maestro: {{$mensaje->emisorMaestro->nick_m}}</td>
						@endif
						<td class="col-sm-auto">{{$mensaje->asunto}}</td>
						<td class="col-sm-auto"><a class="btn btn_delete" href="{{route('mensaje_borrar_recibido',$mensaje->id)}}"><i class="fas fa-trash-alt"></i></td>

                    </tr>
					
                    @endforeach
                </tbody>
            </table>

        </div>
		@endif

@endsection