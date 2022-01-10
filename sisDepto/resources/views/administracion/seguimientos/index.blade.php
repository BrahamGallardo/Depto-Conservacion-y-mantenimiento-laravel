@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de segumientos
			<a href="seguimiento/create"><button class="btn btn-info">Realizar seguimiento</button></a>
		</h3>
		@include('administracion.seguimientos.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>ID</th>
					<th>Solicitud</th>
					<th>Salida de materiales</th>
					<th>Trabajador</th>
					<th>Estado</th>
					<th>Fecha de realizado</th>
					<th>Opciones</th>
				</thead>
				@foreach($seguimientos as $seg)
				<tr>
					<td>{{ $seg->iddetalle_solicitud}}</td>
					<td><a href="{{URL::action('SolicitudController@show',$seg->solicitud)}}">{{ $seg->solicitud}}</a></td>
					<td><a href="{{URL::action('EgresosController@show',$seg->egreso)}}">{{ $seg->egreso}}</a></td>
					<td><a href="trabajador/detalles/{{$seg->idtrabajador}}">{{ $seg->nombre_trabajador}}</a></td>
					<td>{{ $seg->estado}}</td>
					<td>{{ $seg->fecha}}</td>
					<td>
						<a href="{{URL::action('DetalleSolicitudController@show',$seg->iddetalle_solicitud)}}"><button class="btn btn-default">Detalles</button></a>
						<a href="{{URL::action('DetalleSolicitudController@edit',$seg->iddetalle_solicitud)}}"><button class="btn btn-primary">Editar</button></a>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$seguimientos->render()}}
	</div>
</div>
@endsection