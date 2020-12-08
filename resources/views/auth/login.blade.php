@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card_principal">
               
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                       
                           <!--Correo electronico del usuario-->
						   <div class="form-group row">
                                <div class="col-md-10 offset-md-auto mx-auto">
                                    <label for="email" class="col-form-label text-md-right">{{ __('Correo electronico') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror rounded-input" name="email" value="{{ old('email') }}" autocomplete="email">								
									@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                        </div>
						<!--Contraseña del usuario-->
						   <div class="form-group row">
                       <div class="col-md-10 offset-md-auto mx-auto">
                                    <label for="password" class="col-form-label text-md-right">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror rounded-input" name="password" autocomplete="current-password">
									
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
						</div>
                        <div class="form-group row">
                            <div class="col-md-10 offset-md-auto mx-auto">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Recordarme') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-auto mx-auto">
                                <button type="submit" class="btn btn_principal">
                                    {{ __('Login') }}
                                </button>
								
                                    <a class="btn btn_principal" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                

                                @if (Route::has('password.request'))
									</br>
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidaste la contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
				<div class="card-footer">
				 <!-- Footer -->
         

                <!-- Copyright -->
                <div class="footer-copyright text-center py-3">© About me:
                    <a class="link" href="#">Francisco Javier Cruz Redondo </a></br>
					<a class="link" href="http://www.iestrassierra.com/">I.E.S. Trassierra</a>
                </div>

                <!-- Copyright -->

           
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
