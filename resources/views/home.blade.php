@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card_principal">
                <div class="card-header text-center">
				
				<nav class="navbar navbar-expand-md">
            <div class="container">
                <a class="navbar-brand">
                    {{ __('¿Que perfil quiere usar?') }}
                </a>
                <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                            @endif
                        @else
                             <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link font-weight-bold" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
								
                             
                            </li>
							 <li class="nav-item dropdown">
                                
								<a href="{{ route('logout') }}" onclick="event.preventDefault();
    document.getElementById('logout-form').submit();" class='btn btn_desconectar' data-toggle="tooltip" data-placement="bottom" title="Desconectarse"><i class="fas fa-power-off"></i></a>
	<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                             
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
				
				
				
				
				
				
				</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                @if(Auth::user()->maestro->avatar_m!=null)
				<img src="{{ asset('storage/'.Auth::user()->maestro->avatar_m) }}" class="avatar mr-1 m-auto" width="250px" height="250px" alt="maestro"></img>
			@else
				<img src="{{ asset('images/profesor.jpg') }}" class="avatar mr-1 m-auto" width="250px" height="250px" alt="maestro"></img>
			@endif
            
                            </div>
							<a href="{{route('maestro')}}" class="btn btn-primary btn-lg btn-block mt-3" role="button" aria-pressed="true">Maestro</a>                         
                        </div>
                        <div class="col-md-6">
                             <div class="row">
                                	@if(Auth::user()->aprendiz->avatar_a!=null)
				<img src="{{ asset('storage/'.Auth::user()->aprendiz->avatar_a) }}" class="avatar mr-1 m-auto" width="250px" height="250px" alt="aprendiz"></img>
			@else
				<img src="{{ asset('images/aprendiz.jpg') }}" class="avatar mr-1 m-auto" width="250px" height="250px" alt="aprendiz"></img>
			@endif
                            </div>
                            <a href="{{route('aprendiz')}}" class="btn btn-danger btn-lg btn-block mt-3" role="button" aria-pressed="true">Aprendiz</a>
                        </div>
                    </div>
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
