@extends('perfils.maestro.maestro')

@section('medio_maestro')

<div class="col-md-8">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro')}}">Maestro: {{Auth::user()->maestro->nick_m}}</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('maestro_editar',Auth::user()->maestro->id)}}">Editar Perfil</a></li>
  </ol>
</nav>
	<div class="row cabecera_secundaria">
            <h2>EDITAR PERFIL</h2>
        </div>
	 <!--Formulario-->
                    <form enctype="multipart/form-data"  method="POST" class="edit_form" action="{{route('maestro_actualizar',Auth::user()->maestro->id)}}">
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

                           
                                <h4><i class="fas fa-bookmark"></i> Perfil de Maestro</h4>
                                <div class="section">								
                                    <div class="form-group"> 
                                        <label for="nick_m" class="col-form-label text-md-right">{{ __('Nick del Maestro') }}&nbsp;*</label><i class="fas fa-info-circle ml-2 nickm_info"></i>
                                        <input id="nick_m" type="text" class="form-control required" name="nick_m" value="{{$maestro->nick_m}}" required>
                                      
                                    </div>
									 <div class="form-group"> 
                                        <label for="avatar_m" class="col-form-label text-md-right">{{ __('Avatar del Maestro') }}</label><i class="fas fa-info-circle ml-2 avatarm_info"></i>
                                        <input id="avatar_m" type="file" class="form-control @error('avatar_m') is-invalid @enderror" name="avatar_m">
                                      @error('avatar_m')
                                 <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
									@if($maestro->avatar_m!=null)
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

                                        <label for="descripcion_m" class="col-form-label text-md-right">{{ __('Descripción del Maestro') }}&nbsp;*</label><i class="fas fa-info-circle ml-2 descripcionm_info"></i>


                                        <textarea id="descripcion_m" class="form-control" name="descripcion_m" autocomplete="descripcion_m" required>{{$maestro->descripcion_m}}</textarea>

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
<div class="col-md-4">
 <div class="container">
        <div class="row cabecera_secundaria">
            <h2>MIS APRENDICES</h2>
        </div>
        @if(Auth::user()->maestro->aprendices->isEmpty())
			<div class="card mb-2 my-2 card_info">
            <div class="card-body">

                <p class="card-text">No le sigue ningun aprendiz</p>
				
            </div>
			 <div class="card-footer">

               <p class="card-text">Cree articulos para llamar la antención de los aprendices</p>
				
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
                    @foreach (Auth::user()->maestro->aprendices as $aprendiz)

                    <tr class='clickable_row oculto' data-href="{{route('maestro_ver_aprendiz',$aprendiz->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver {{$aprendiz->nick_a}}">
                        	@if($aprendiz->avatar_a!=null)
				<td class="col-sm-auto"><img src="{{ asset('storage/'.$aprendiz->avatar_a) }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="aprendiz"></img></td>
			@else
				<td class="col-sm-auto"><img src="{{ asset('images/aprendiz.jpg') }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="aprendiz"></img></td>
			@endif
                        <td class="font-weight-bold align-middle col-sm-auto" >{{$aprendiz->nick_a}}</td>
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
</div>


@endsection