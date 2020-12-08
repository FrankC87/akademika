@extends('perfils.maestro.maestro_mensajes')

@section('cuerpo_mensajes')



		<div class="row cabecera_secundaria">
			<h4>Ver Mensaje Enviado</h4>
		</div>
	       
        <div class="table-responsive mt-2">
           <table id="tablaVerMensajes" class="table table-bordered" style="width:100%">
                <thead>
                    <tr hidden>
                        <th scope="col" ></th>
						 <th scope="col" ></th>
						  
                    </tr>
                </thead>
                <tbody id="body_tabla">
					<tr scope="row" data-toggle="tooltip" data-placement="bottom" title="Fecha de creacion">
						<td class="col-sm-auto cabecera_tabla_mensaje font-weight-bold">FECHA DE CREACION</td>
						<td class="col-sm-auto font-weight-bold">el {{$mensaje->created_at->format('d/m/Y')}} a las {{$mensaje->created_at->format('H:m:s')}}</td>				
                    </tr>
                    <tr scope="row" data-toggle="tooltip" data-placement="bottom" title="Destinatario">
						<td class="col-sm-auto cabecera_tabla_mensaje font-weight-bold">DESTINATARIO</td>
						@if($mensaje->receptor_m==null)
                        <td class="col-sm-auto font-weight-bold">Aprendiz: {{$mensaje->receptorAprendiz->nick_a}}</td>
						@else
						<td class="col-sm-auto font-weight-bold">Maestro: {{$mensaje->receptorMaestro->nick_m}}</td>
						@endif			
                    </tr>
					<tr scope="row" data-toggle="tooltip" data-placement="bottom" title="Asunto">
						<td class="col-sm-auto cabecera_tabla_mensaje font-weight-bold">ASUNTO</td>
						<td class="col-sm-auto font-weight-bold">{{$mensaje->asunto}}</td>				
                    </tr>
					<tr scope="row" data-toggle="tooltip" data-placement="bottom" title="Mensaje">					
						<td class="col-sm-auto" colspan="2">{!!$mensaje->contenido!!}</td>				
                    </tr>
                 
                </tbody>
            </table>

        </div>
		


@endsection