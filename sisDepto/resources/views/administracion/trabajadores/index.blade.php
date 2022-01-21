@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de trabajadores <a href="trabajadores/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('administracion.trabajadores.search')	
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>ID</th>
						<th>Nombre</th>
						<th>Función</th>
						<th>Estado</th>
						<th>Email</th>
						<th>Teléfono</th>
						<th>Opciones</th>
					</thead>
					@foreach($trabajadores as $tra)
					<tr>
						<td>{{$tra->idtrabajador}}</td>
						<td>{{$tra->nombre_trabajador}}</td>
						<td>{{$tra->nombre_rol}}</td>
						<td>{{$tra->estado_trabajador}}</td>
						<td>{{$tra->email}}</td>
						<td>{{$tra->telefono}}</td>
						<td>
						
							<a href="{{URL::action('TrabajadorController@show',$tra->idtrabajador)}}"><button class="btn btn-default">Detalles</button></a>
							<a href="" data-target="#modal-delete-{{$tra->idtrabajador}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include('administracion.trabajadores.modal')
					@endforeach
				</table>
			</div>
			{{$trabajadores->render()}}
		</div>
	</div>
@endsection