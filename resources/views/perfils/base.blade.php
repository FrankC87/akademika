<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Akademika') }}</title>
		
		 <!-- Styles -->
		<link href="{{asset('css/app.css')}}" rel="stylesheet">		 
		<link href="{{asset('css/akademika.css')}}" rel="stylesheet">
		<link href="{{asset('fontawesome/css/all.min.css')}}" rel="stylesheet">
		<link href="{{asset('sweetalert2/css/sweetalert2.min.css')}}" rel="stylesheet">
		<link href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" rel="stylesheet">
		
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
		
    </head>
    <body>
        <div id="app" class="d-flex flex-column">
            <nav class="navbar navbar-dark navbar-expand-md" id="nav-perfil">
			
                <div class="container">
                     <a class="navbar-brand" href="#">
    <img src="{{asset('images/logo.svg')}}" class="mx-auto img-fluid" width="180px" alt="My SVG logo">
  </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
					
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
								<li class="nav-item dropdown">
                                @yield('boton_perfil')
								
                             
                            </li>
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
                                <a id="navbarDropdown" class="nav-link font-weight-bold" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

            <main class="container  h-100">
                @yield('content')
            </main>



            <!-- Footer -->
            <footer class="page-footer mt-auto p-2">

                <!-- Copyright -->
                <div class="footer-copyright text-center py-3">© About me:
                    <a href="#">Francisco Javier Cruz Redondo </a></br>
					<a href="http://www.iestrassierra.com/">I.E.S. Trassierra</a>
                </div>

                <!-- Copyright -->

            </footer>
            <!-- Footer -->
        </div>
		
		<!-- Scripts -->
		<script src="{{ asset('js/app.js') }}"></script>
		<script src="{{ asset('sweetalert2/js/sweetalert2.all.min.js') }}" ></script>
		<script src="{{ asset('fontawesome/js/all.min.js') }}" ></script>
		<script src="{{ asset('ckeditor/ckeditor.js') }}" ></script>		
		<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
		<script src="{{ asset('js/akademika.js') }}" ></script>
    </body>
</html>