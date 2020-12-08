@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card card_principal">
                <div class="card-header">
                    <h2>{{ __('REGISTRO') }}</h2>
                    <span class="text-muted">Crea un nuevo usuario y empieza a disfrutar de akademika.</span>
                </div>

                <div class="card-body">
                    <!--Formulario de Registro-->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!--Datos principales del usuario-->	
                        <h4><i class="fas fa-bookmark"></i> Datos Generales</h4>
                        <div class="section campos_form" >
                            <div class="form-group row">
                                <!--Nombre del usuario-->
                                <div class="form-group col-md-6">
                                    <label for="name" class="col-form-label text-md-right">{{ __('Nombre') }}&nbsp;*</label><i class="fas fa-info-circle ml-2 nombre_info"></i>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror rounded-input" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
									@error('name')																	
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--Correo electronico del usuario-->
                                <div class="form-group col-md-6">
                                    <label for="email" class="col-form-label text-md-right">{{ __('Correo electronico') }}&nbsp;*</label><i class="fas fa-info-circle ml-2 correo_info"></i>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror rounded-input" name="email" value="{{ old('email') }}" autocomplete="email">								
									@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--Contraseña del usuario-->
                                <div class="form-group col-md-6">
                                    <label for="password" class="col-form-label text-md-right">{{ __('Contraseña') }}&nbsp;*</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror rounded-input" name="password" autocomplete="new-password">
									<span id="form_pass_error" class="invalid-feedback">
										<ul>
											<li>La contraseña debe tener 8 caracteres o mas</li>
											<li>La contraseña debe tener como minimo una letra en mayusculas</li>
											<li>La contraseña debe tener como minimo una letra en minusculas</li>
											<li>La contraseña debe tener como minimo un caracer alfanumerico</li>
										</ul>
									</span>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--Confirmacion de la contraseña-->
                                <div class="form-group col-md-6">
                                    <label for="password-confirm" class="col-form-label text-md-right">{{ __('Repetir contraseña') }}&nbsp;*</label>
                                    <input id="password-confirm" type="password" class="form-control rounded-input" name="password_confirmation" autocomplete="new-password">
									<span id="form_conf_error" class="invalid-feedback">Las contraseñas no coinciden</span>
                                </div>

                                <!--Fecha de nacimiento del usuario-->
                                <div class="form-group col-md-auto">
                                    <label for="birthdate" class="col-form-label text-md-right">{{ __('Fecha de Nacimiento') }}</label><i class="fas fa-info-circle ml-2 birthdate_info"></i>
                                    <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}" autocomplete="birthdate" autofocus>
                                    @error('birthdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!--Provincia del usuario-->
                                <div class="form-group col-md-auto">
                                    <label for="localidad" class="col-form-label text-md-right">{{ __('Localidad') }}</label><i class="fas fa-info-circle ml-2 localidad_info"></i>
                                    <select id="localidad" class="form-control @error('localidad') is-invalid @enderror " name="localidad" autofocus>
                                        <option value="" selected disabled hidden>Localidad</option>
                                    </select>
                                    @error('localidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
								<!--Sexo del usuario-->
                                <div class="form-group col-md-auto">
                                    <label for="genero" class="col-form-label text-md-right">{{ __('Sexo') }}</label><i class="fas fa-info-circle ml-2 sexo_info"></i>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="genero" id="g_hombre" value="hombre">
                                        <label class="form-check-label" for="g_hombre">Hombre</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="genero" id="g_mujer" value="mujer">
                                        <label class="form-check-label" for="g_mujer">Mujer</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group row mt-2">
                            <div class="form-group col-md-6">
								<h4><i class="fas fa-bookmark"></i> Perfil de Aprendiz<i class="fas fa-info-circle ml-2 aprendiz_info"></i></h4>
                                <div class="section campos_form" >
                                    <div class="form-group"> 
                                        <label for="nick_a" class="col-form-label text-md-right">{{ __('Nick del Aprendiz') }}&nbsp;*</label><i class="fas fa-info-circle ml-2 nicka_info"></i>


                                        <input id="nick_a" type="text" class="form-control @error('nick_a') is-invalid @enderror rounded-input" name="nick_a" value="{{ old('nick_a') }}" autocomplete="nick_a">

                                        @error('nick_a')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror


                                    </div>

                                    <div class="form-group"> 
                                        <label for="descripcion_a" class="col-form-label text-md-right">{{ __('Descripción del Aprendiz') }}&nbsp;*</label><i class="fas fa-info-circle ml-2 descripciona_info"></i>


                                        <textarea id="descripcion_a" class="form-control @error('descripcion_a') is-invalid @enderror" name="descripcion_a" value="{{ old('descripcion_a') }}" autocomplete="descripcion_a"></textarea>

                                        @error('descripcion_a')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <h4><i class="fas fa-bookmark"></i> Perfil de Maestro<i class="fas fa-info-circle ml-2 maestro_info"></i></h4>
                                <div class="section campos_form" >								
                                    <div class="form-group"> 
                                        <label for="nick_m" class="col-form-label text-md-right">{{ __('Nick del Maestro') }}&nbsp;*</label><i class="fas fa-info-circle ml-2 nickm_info"></i>


                                        <input id="nick_m" type="text" class="form-control @error('nick_m') is-invalid @enderror rounded-input" name="nick_m" value="{{ old('nick_m') }}" autocomplete="nick_m">

                                        @error('nick_m')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror



                                    </div>

                                    <div class="form-group"> 

                                        <label for="descripcion_m" class="col-form-label text-md-right">{{ __('Descripción del Maestro') }}&nbsp;*</label><i class="fas fa-info-circle ml-2 descripcionm_info"></i>


                                        <textarea id="descripcion_m" class="form-control @error('descripcion_m') is-invalid @enderror" name="descripcion_m" value="{{ old('descripcion_m') }}" autocomplete="descripcion_m"></textarea>

                                        @error('descripcion_m')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <span class="text-muted">Los campos con * son obligatorios.</span>
                        <div class="form-group row mb-0">
                            <div class="col-auto">
                                <button id="btn_registro" type="submit" class="btn btn_principal">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
				<div class="card-footer">
				 <!-- Footer -->
         

                <!-- Copyright -->
                <div class="footer-copyright text-center py-3">© About me:
                    <a href="#">Francisco Javier Cruz Redondo </a></br>
					<a href="http://www.iestrassierra.com/">I.E.S. Trassierra</a>
                </div>

                <!-- Copyright -->

           
				</div>
		   </div>
        </div>
    </div>
</div>
@endsection
