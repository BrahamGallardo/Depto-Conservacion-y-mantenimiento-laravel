@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de solicitudes de articulos
			@if(Auth::user()->rol != 1 && Auth::user()->rol != 3 && Auth::user()->rol != 5)
			<a href="ingresos/create"><button class="btn btn-success">Solicitar</button></a>
			@endif
		</h3>
		@include('almacen.ingresos.search')
	</div>
</div>
<style>
	.oculto {
		pointer-events: none !important;
		cursor: not-allowed !important;

	}
</style>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>ID del ingreso</th>
					<th>Fecha de solicitud</th>
					<th>Archivo</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
				@foreach($ingresos as $ing)
				<tr>
					<td id="idingreso" value="{{$ing->idingreso}}">{{$ing->idingreso}}</td>
					<td>{{ $ing->fecha_hora}}</td>
					<td>{{ $ing->archivo}}</td>
					<td>{{$ing->estado}}</td>
					<td id="btns">
						<a href="{{URL::action('IngresosController@show',$ing->idingreso)}}"><button class="btn btn-default">Detalles</button></a>
						@if(Auth::user()->rol != 1 && Auth::user()->rol != 3 && Auth::user()->rol != 5)
						@if($ing->estado != 'Pendiente')
						<button class="btn btn-danger oculto disabled" id="cancelbtn">Anular</button>
						@elseif($ing->estado == 'Pendiente')
						<a href="#modal-delete-{{$ing->idingreso}}" data-toggle="modal"><button class="btn btn-danger" id="cancelbtn">Anular</button></a>
						@endif
						@endif
					</td>
				</tr>
				@include('almacen.ingresos.modal')
				@endforeach
			</table>
		</div>
		{{$ingresos->render()}}
	</div>
</div>
@endsection