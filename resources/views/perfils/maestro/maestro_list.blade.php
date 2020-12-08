@extends('perfils.maestro.maestro')

@section('medio_maestro')

@if($maestros==null)
	<div class="container" id="lista_m">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro')}}">Maestro: {{Auth::user()->maestro->nick_m}}</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('maestro_lista_aprendices')}}">Lista Aprendices</a></li>
  </ol>
</nav>
	<div class="row cabecera_secundaria">
	<h2>APRENDICES DE AKADEMIKA</h2>
	</div>
	
        

           <div class="input-group md-form form-sm form-1 pl-0 my-2">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
  </div>
  <input class="form-control my-0 py-1" id="buscador_tabla" type="text" placeholder="Buscar aprendices" aria-label="Search">
</div>


	 <div class="table-responsive">
	 <table id="tablaPerfiles" class="table order-column" style="width:100%">
            <thead>
                <tr hidden>
					<th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
					<th scope="col"></th>							
                </tr>
            </thead>
             <tbody id="body_tabla">
	@foreach ($aprendices as $aprendiz)
		<tr  class='clickable_row' data-href="{{route('maestro_ver_aprendiz',$aprendiz->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver aprendiz {{$aprendiz->nick_a}}">
					<td class="align-middle"><i class="fas fa-2x fa-user"></i></td>
						@if($aprendiz->avatar_a!=null)
				<td class="col-sm-auto"><img src="{{ asset('storage/'.$aprendiz->avatar_a) }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="aprendiz"></img></td>
			@else
				<td class="col-sm-auto"><img src="{{ asset('images/aprendiz.jpg') }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="aprendiz"></img></td>
			@endif
					<td class="font-weight-bold">{{$aprendiz->nick_a}}</br><span class="text-muted">Registrado el {{$aprendiz->created_at->format('d-m-Y')}} a las {{$aprendiz->created_at->format('h:m:s')}}</span></td>
		@php
        $control=false;
        @endphp
			@foreach($aprendiz->maestros as $maestro)
				@if(Auth::user()->maestro->nick_m == $maestro->nick_m )
					@php
					$control=true;
					@endphp						
				@endif
			@endforeach
		@if($control==true)
			<td class="align-middle"><a href="{{route('maestro_expulsar',$aprendiz->id)}}" class='btn btn-danger align-middle'  style="padding: 10px;"><i class="fas fa-2x fa-sign-out-alt align-middle" style="font-size:20px;" ></i><span>&nbsp;&nbsp;EXPULSAR</span></a></td>
         @else
			 <td class="align-middle"></td>
		@endif
		 </tr>
		
	
    @endforeach
	 </tbody>
        </table>
	</div>

@else
<div class="container" id="lista_m">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('maestro')}}">Maestro: {{Auth::user()->maestro->nick_m}}</a></li>
	<li class="breadcrumb-item active" aria-current="page"><a href="{{route('maestro_lista_maestros')}}">Lista Maestros</a></li>
  </ol>
</nav>
	<div class="row cabecera_secundaria">
	<h2>MAESTROS DE AKADEMIKA</h2>
	</div>
	
           <div class="input-group md-form form-sm form-1 pl-0 my-2">
  <div class="input-group-prepend">
    <span class="input-group-text" id="basic-text1"><i class="fas fa-search text-white" aria-hidden="true"></i></span>
  </div>
  <input class="form-control my-0 py-1" type="text" id="buscador_tabla" placeholder="Buscar maestros" aria-label="Search">
</div>
	 <div class="table-responsive">
	 <table id="tablaPerfiles" class="table order-column" style="width:100%">
            <thead>
                <tr hidden>
					<th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="body_tabla">
                @foreach ($maestros as $maestro)
                <tr  class='clickable_row' data-href="{{route('maestro_ver_maestro',$maestro->id)}}" data-toggle="tooltip" data-placement="bottom" title="Ver maestro {{$maestro->nick_m}}">
					<td class="align-middle"><i class="fas fa-2x fa-user-tie"></i></td>
					@if($maestro->avatar_m!=null)
				<td class="col-sm-auto"><img src="{{ asset('storage/'.$maestro->avatar_m) }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="maestro"></img></td>
			@else
				<td class="col-sm-auto"><img src="{{ asset('images/profesor.jpg') }}" class="img-fluid img-thumbnail" height="60px" width="60px" alt="maestro"></img></td>
			@endif
					<td class="font-weight-bold">{{$maestro->nick_m}}</br><span class="text-muted">Registrado el {{$maestro->created_at->format('d-m-Y')}} a las {{$maestro->created_at->format('h:m:s')}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
	</div>
@endif

 </div>
@endsection