@extends('perfils.aprendiz.aprendiz')

@section('medio_aprendiz')


    <div class="col-md-8">
	<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('aprendiz')}}">Aprendiz: {{Auth::user()->aprendiz->nick_a}}</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('aprendiz_editar',Auth::user()->aprendiz->id)}}">Editar Perfil</a></li>
  </ol>
</nav>
<div class="row cabecera_secundaria">
            <h2>EDITAR PERFIL</h2>
        </div>
	 <!--Formulario-->
                    <form enctype="multipart/form-data"  method="POST" class="edit_form" action="{{route('aprendiz_actualizar',Auth::user()->aprendiz->id)}}">
                        @csrf
                        <!--Datos principales del usuario-->	
                        <h4><i class="fas fa-bookmark"></i> Datos Generales</h4>
                        <div class="section" >
                            <div class="form-group row">
                               
                                <!--Fecha de nacimiento del usuario-->
                                <div class="form-group col-md-auto">
                                    <label for="birthdate" class="col-form-label text-md-right">{{ __('Fecha de Nacimiento') }}</label><i class="fas fa-info-circle ml-2 birthdate_info"></i>
                                    <input id="birthdate" type="date" class="form-control" name="birthdate" value="{{Auth::user()->birthdate}}" autofocus>                              
                                </div>
                                <!--Provincia del usuario-->
                                <div class="form-group col-md-auto">
                                    <label for="localidad" class="col-form-label text-md-right">{{ __('Localidad') }}</label><i class="fas fa-info-circle ml-2 localidad_info"></i>
                                    <select id="localidad" class="form-control " name="localidad" autofocus>
										@if(Auth::user()->localidad!=null)
										<option class="bg-secondary text-white" value="" >Ocultar</option>
										<option value="{{Auth::user()->localidad}}" selected>{{Auth::user()->localidad}}</option>
										@else
										<option value="" selected disabled hidden>Localidad</option>																				
										@endif
                                       
                                    </select>                              
                                </div>
								<!--Sexo del usuario-->
                                <div class="form-group col-md-auto">
                                    <label for="genero" class="col-form-label text-md-right">{{ __('Sexo') }}</label><i class="fas fa-info-circle ml-2 sexo_info"></i>
                                    <div class="form-check">
										@if(Auth::user()->genero=="hombre")
                                        <input class="form-check-input" type="radio" name="genero" id="g_hombre" value="hombre" checked>
										@else
										<input class="form-check-input" type="radio" name="genero" id="g_hombre" value="hombre">
										@endif
                                        <label class="form-check-label" for="g_hombre">Hombre</label>
                                    </div>
                                    <div class="form-check">
									@if(Auth::user()->genero=="mujer")
                                        <input class="form-check-input" type="radio" name="genero" id="g_mujer" value="mujer" checked>
									@else
										  <input class="form-check-input" type="radio" name="genero" id="g_mujer" value="mujer" >
										@endif
                                        <label class="form-check-label" for="g_mujer">Mujer</label>
                                    </div>
									<div class="form-check">
									@if(Auth::user()->genero==null)
                                        <input class="form-check-input" type="radio" name="genero" id="g_null" value="" checked>
									@else
										<input class="form-check-input" type="radio" name="genero" id="g_null" value="">
									@endif
                                        <label class="form-check-label" for="g_null">Ocultar</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                           
                                <h4><i class="fas fa-bookmark"></i> Perfil de Aprendiz</h4>
                                <div class="section">								
                                    <div class="form-group"> 
                                        <label for="nick_a" class="col-form-label text-md-right">{{ __('Nick del Aprendiz') }}&nbsp;*</label><i class="fas fa-info-circle ml-2 nicka_info"></i>
                                        <input id="nick_a" type="text" class="form-control required" name="nick_a" value="{{$aprendiz->nick_a}}" required>
                                      
                                    </div>
									 <div class="form-group"> 
                                        <label for="avatar_a" class="col-form-label text-md-right">{{ __('Avatar del Aprendiz') }}</label><i class="fas fa-info-circle ml-2 avatara_info"></i>
                                           <input id="avatar_a" type="file" class="form-control @error('avatar_a') is-invalid @enderror" name="avatar_a">
                                      @error('avatar_a')
                                 <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                      
                                    </div>
@if($aprendiz->avatar_a!=null)
									<div class="form-group">
										<div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck" name="deletea">
      <label class="form-check-label" for="gridCheck">
        Borrar Avatar<i class="fas fa-info-circle ml-2 deletea_info"></i>
      </label>
    </div>
  </div>
@endif
                                    <div class="form-group"> 

                                        <label for="descripcion_a" class="col-form-label text-md-right">{{ __('Descripción del Aprendiz') }}&nbsp;*</label><i class="fas fa-info-circle ml-2 descripciona_info"></i>


                                        <textarea id="descripcion_a" class="form-control" name="descripcion_a" autocomplete="descripcion_m" required>{{$aprendiz->descripcion_a}}</textarea>

                                    </div>
                              
                            </div>

                       
                        <span class="text-muted">Los campos con * son obligatorios.</span>
                        <div class="form-group row mb-0">
                            <div class="col-auto">
                                <button type="submit" class="btn btn-success btn-lg my-3">
                                    Modificar perfil
                                </button>
                            </div>
							
                        </div>
                    </form>
    </div>
    <div class="col-md-4 ">
	 
        <div class="container">
        <div class="row cabecera_secundaria">
            <h2>MIS MAESTROS</h2>
        </div>
		 @if(Auth::user()->aprendiz->maestros->isEmpty())
			<div class="card mb-2 my-2 card_info">
            <div class="card-body">

                <p class="card-text">No sigue a ningun maestro</p>
				
            </div>
			 <div class="card-footer">

               <p class="card-text">Al seguir a maestros, podra estar al dia de sus novedades y temas de interes</p>
				
            </div>
			         </div>
		@else
        <table class="table">
            <thead>
                <tr hidden>
                    <th scope="col">Avatar</th>
                    <th scope="col">Nick</th>
                </tr>
            </thead>
            <tbody id="cuerpoPerfiles">
                @foreach (Auth::user()->aprendiz->maestros as $maestro)

                <tr  class='clickable_row oculto' data-href="{{route('aprendiz_ver_maestro',$maestro->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver {{$maestro->nick_m}}">
               
							@if($maestro->avatar_m!=null)
				<td class="col-sm-auto"><img src="{{ asset('storage/'.$maestro->avatar_m) }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="maestro"></img></td>
			@else
				<td class="col-sm-auto"><img src="{{ asset('images/profesor.jpg') }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="maestro"></img></td>
			@endif
                    <td class="font-weight-bold align-middle col-sm-auto" >{{$maestro->nick_m}}</td>
                </tr>

                @endforeach
            </tbody>
			
        </table>

		<div class="row justify-content-between">
			
			<a role="button" class="visible" id="vermas">mostrar más</a>
			<a role="button" class="oculto" id="vermenos">mostrar menos</a>
			</div>

		@endif


    </div>


@endsection