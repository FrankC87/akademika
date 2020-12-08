@extends('perfils.maestro.maestro_mensajes')

@section('cuerpo_mensajes')

<div class="row cabecera_secundaria">
	<h4>Mensaje Nuevo</h4>
</div>

<form method='post' action="{{route('mensaje_enviar')}}">
    @csrf
		<div class="form-group row">
	<div class="form-group col-sm-auto">
			<label for="receptor_a">Aprendiz Receptor</label>    
            <select class="form-control" name="receptor_a" id="receptor_a">
                <option value="" hidden>Receptor Aprendiz</option>
				<option value="">No enviar</option>
				@foreach($aprendices as $aprendiz)
					<option value="{{$aprendiz->id}}">{{$aprendiz->nick_a}}</option>
				@endforeach
            </select>		
    </div>
	<div class="form-group col-sm-auto">
			<label for="receptor_m">Maestro Receptor</label>    
            <select class="form-control" name="receptor_m" id="receptor_m">
                <option value="" hidden>Receptor Maestro</option>
				<option value="">No enviar</option>
				@foreach($maestros as $maestro)
					<option value="{{$maestro->id}}">{{$maestro->nick_m}}</option>
				@endforeach
            </select>		
    </div>
	 <span class="invalid-feedback" role="alert" id="receptorError">
                                        Debe seleccionar al menos un receptor valido
                                    </span>
	</div>
    <div class="form-group">
        <label for="form_asunto">Asunto</label>
        <input type="text" name="asunto" class="form-control" id="form_asunto" aria-describedby="asunto" placeholder="Asunto" required>
		
    </div>
    <div class="form-group">
        <input type="text" name="emisor_a" class="form-control" id="emisor_a" aria-describedby="emisor_a"  value="" hidden>
    </div>
	<div class="form-group">
        <input type="text" name="emisor_m" class="form-control" id="emisor_m" aria-describedby="emisor_m" value="{{Auth::user()->maestro->id}}" hidden>
    </div>
    <div class="form-group">
        <label for="form_contenido">Contenido</label>
        <textarea name="contenido" class="form-control ckeditor" id="form_contenido" rows="3"></textarea>
    </div>
    <button id="mensajeNuevoSubmit" type="submit" class="btn btn-success btn-lg">Enviar Mensaje</button>
</form>


@endsection
