@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de solicitudes de articulos
			<a href="ingresos/create"><button class="btn btn-success">Solicitar</button></a>
		</h3>
		@include('almacen.ingresos.search')
	</div>
</div>

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
					<td>{{ $ing->idingreso}}</td>
					<td>{{ $ing->fecha_hora}}</td>
					<td>{{ $ing->archivo}}</td>
					<td>{{ $ing->estado}}</td>
					<td>
						<a href="{{URL::action('IngresosController@show',$ing->idingreso)}}"><button class="btn btn-default">Detalles</button></a>
						<a href="#"><button class="btn btn-success">Activar</button></a>
						<a href="#modal-delete-{{$ing->idingreso}}" data-toggle="modal"><button class="btn btn-danger">Anular</button></a>
					</td>
				</tr>
				@include('almacen.ingresos.modal')
				@include('almacen.ingresos.modal-a')
				@endforeach
			</table>
		</div>
		{{$ingresos->render()}}
	</div>
</div>
@endsection