@extends('perfils.aprendiz.aprendiz_mensajes')

@section('cuerpo_mensajes')



		<div class="row cabecera_secundaria">
			<h4>Ver Mensaje Recibido</h4>
		</div>
		
	    <div class="table-responsive mt-2">
           <table id="tablaVerMensajes" class="table table-bordered" style="width:100%">
                <thead>
                    <tr hidden>
                        <th scope="col-sm-auto" ></th>
						 <th scope="col-sm-auto" ></th>
						  
                    </tr>
                </thead>
                <tbody id="body_tabla">
					<tr data-toggle="tooltip" data-placement="bottom" title="Fecha de creacion">
						<td class="cabecera_tabla_mensaje font-weight-bold">FECHA DE CREACION</td>
						<td class="font-weight-bold">el {{$mensaje->created_at->format('d/m/Y')}} a las {{$mensaje->created_at->format('H:i:s')}}</td>				
                    </tr>
                    <tr data-toggle="tooltip" data-placement="bottom" title="Destinatario">
						<td class="col-sm-auto cabecera_tabla_mensaje font-weight-bold">EMISOR</td>
						@if($mensaje->emisor_m==null)
                        <td class="font-weight-bold">Aprendiz: {{$mensaje->emisorAprendiz->nick_a}}</td>
						@else
						<td class="font-weight-bold">Maestro: {{$mensaje->emisorMaestro->nick_m}}</td>
						@endif		
                    </tr>
					<tr data-toggle="tooltip" data-placement="bottom" title="Asunto">
						<td class="cabecera_tabla_mensaje font-weight-bold">ASUNTO</td>
						<td class="font-weight-bold">{{$mensaje->asunto}}</td>				
                    </tr>
					<tr data-toggle="tooltip" data-placement="bottom" title="Mensaje">					
						<td colspan="2">{!!$mensaje->contenido!!}</td>				
                    </tr>
                 
                </tbody>
            </table>

        </div>
		


@endsection