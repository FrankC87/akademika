@extends('perfils.base')

@section('boton_perfil')
<a href="{{route('aprendiz')}}" class="btn btn-light btn-lg" role="button" aria-pressed="true" data-toggle="tooltip" data-placement="bottom" title="Cambiar al perfil Aprendiz">Perfil: Maestro</a>
@endsection

@section('content')


<div class="row">
    <div class="col-md-3 perfil_info px-3 h-100" id="perfil-info">
		
		<div class="row py-3 justify-content-between mx-1">
					
						<a href="{{route('maestro_lista_maestros')}}" id="btn_maestros" class="btn btn-lg general_btn" role="button" aria-pressed="true" data-toggle="tooltip" data-placement="bottom" title="Maestros"><i class="fas fa-chalkboard-teacher"></i></a>
					
					
						<a href="{{route('maestro_lista_aprendices')}}" id="btn_aprendices" class="btn btn-lg general_btn" role="button" aria-pressed="true" data-toggle="tooltip" data-placement="bottom" title="Aprendices"><i class="fas fa-users"></i></a>
					
				
						<a href="{{route('maestro_mensajes')}}" id="btn_mensajes" class="btn btn-lg general_btn aviso" role="button" aria-pressed="true" data-toggle="tooltip" data-placement="bottom" title="Mensajes"><i class="fas fa-inbox"></i>@if(Auth::user()->maestro->mensajesNoLeidos()+Auth::user()->maestro->notificacionesNoLeidas() > 0)<span class="badge">{{Auth::user()->maestro->mensajesNoLeidos()+Auth::user()->maestro->notificacionesNoLeidas()}}</span>@endif</a>
					
					
						<a href="{{route('maestro_editar',Auth::user()->maestro->id)}}" id="btn_editar" class="btn btn-lg general_btn" role="button" aria-pressed="true" data-toggle="tooltip" data-placement="bottom" title="Editar Perfil"><i class="fas fa-cog"></i></a>
								
				</div>

        <h2 class="text-center font-weight-bold">{{ Auth::user()->maestro->nick_m }}</h2>

        <div class="row p-3">
			@if(Auth::user()->maestro->avatar_m!=null)
				<img src="{{ asset('storage/'.Auth::user()->maestro->avatar_m) }}" width="200px" height="200px" class="img-fluid avatar m-auto" alt="maestro"></img>
			@else
				<img src="{{ asset('images/profesor.jpg') }}" width="200px" height="200px" class="img-fluid avatar m-auto" alt="maestro"></img>
			@endif
            
        </div>
		
			<div class="row justify-content-between my-3 mx-1">
                          
			<a href="{{route('maestro_temas',Auth::user()->maestro->id)}}" class="btn general_btn btn-md " role="button" aria-pressed="true"  data-toggle="tooltip" data-placement="bottom" title="Mis Articulos">Articulos&nbsp;<i class="fas fa-hand-point-right"></i></a>
			
			<a href="{{route('maestro_colecciones',Auth::user()->maestro->id)}}" class="btn general_btn btn-md" role="button" aria-pressed="true"  data-toggle="tooltip" data-placement="bottom" title="Mis Colecciones">Colecciones&nbsp;<i class="fas fa-archive"></i></a>
			
		</div>

        <ul class="list-group list-group-flush perfil_info font-weight-bold my-3">
            <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Email"><i class="fas fa-at"></i>&nbsp;&nbsp;{{Auth::user()->email}}</li>
            @if(Auth::user()->localidad!=null)
            <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Localidad"><i class="fas fa-house-user"></i>&nbsp;&nbsp;{{Auth::user()->localidad}}</li>
            @endif
            @if(Auth::user()->birthdate!=null)
            <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Fecha de nacimiento"><i class="fas fa-birthday-cake"></i>&nbsp;&nbsp;{{date("d-m-Y", strtotime(Auth::user()->birthdate))}}</li>
            @endif
            @if(Auth::user()->genero!=null)
            <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Genero"><i class="fas fa-venus-mars"></i>&nbsp;&nbsp;{{Auth::user()->genero}}</li>
            @endif
            <li class="list-group-item" data-toggle="tooltip" data-placement="bottom" title="Fecha de registro">Usuario desde {{Auth::user()->created_at->format('d-m-Y')}}</li>
        </ul>

		
    </div>
    <div class="col-md-9 perfil_contenido py-2">
        <div class="row px-3 ">
            @yield('medio_maestro')
        </div>
    </div>
</div>

@endsection