<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Akademika') }}</title>

   

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
	<link href="{{asset('sweetalert2/css/sweetalert2.min.css')}}" rel="stylesheet">
	<link href="{{asset('fontawesome/css/all.min.css')}}" rel="stylesheet">
	<link href="{{asset('css/principal.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="text-center my-3">
			
			<img src="{{asset('images/logo.svg')}}" class="mx-auto img-fluid" width="350px" alt="My SVG logo">
			
        
    </div>

        <main class="py-4">
            @yield('content')
        </main>
		<div class="text-center my-3">
			
			<img src="{{asset('images/lema.svg')}}" class="mx-auto img-fluid" width="500px" alt="My SVG Icon">
			
        
    </div>
    </div>
	 <!-- Scripts -->
	<script src="{{ asset('fontawesome/js/all.min.js') }}" ></script>
	<script src="{{ asset('sweetalert2/js/sweetalert2.all.min.js') }}" ></script>
    <script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/akademika.js') }}" ></script>
	<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
</body>
</html>
