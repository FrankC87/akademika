@extends('perfils.maestro.maestro_mensajes')

@section('cuerpo_mensajes')


	<div class="row cabecera_secundaria">
			<h4>Ver Notificacion</h4>
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
						<td class="font-weight-bold">el {{$notificacion->created_at->format('d/m/Y')}} a las {{$notificacion->created_at->format('H:i:s')}}</td>				
                    </tr>                   
					<tr data-toggle="tooltip" data-placement="bottom" title="Asunto">
						<td class="cabecera_tabla_mensaje font-weight-bold">ASUNTO</td>
						<td class="font-weight-bold">{{$notificacion->asunto}}</td>				
                    </tr>
					<tr data-toggle="tooltip" data-placement="bottom" title="Mensaje">					
						<td colspan="2">{!!$notificacion->contenido!!}</td>				
                    </tr>
                 
                </tbody>
            </table>

        </div>

@endsection