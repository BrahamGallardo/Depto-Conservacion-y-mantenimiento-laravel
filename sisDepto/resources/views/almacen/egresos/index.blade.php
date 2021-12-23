@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de salidas de articulos
			<a href="egresos/create"><button class="btn btn-success">Requerir</button></a>
		</h3>
		@include('almacen.egresos.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>No. Salida</th>
					<th>Fecha de salida</th>
					<th>Razón</th>
					<th>Archivo</th>
					<th>Comentarios</th>
					<th>Opciones</th>
				</thead>
				@foreach($egresos as $eg)
				<tr>
					<td id="idegreso" value="{{$eg->idegreso}}">{{$eg->idegreso}}</td>
					<td>{{ $eg->fecha}}</td>
					<td>{{ $eg->razon}}</td>
					<td>{{$eg->archivo}}</td>
					<td>{{$eg->comentarios}}</td>
					<td id="btns">
						<a href="{{URL::action('EgresosController@show',$eg->idegreso)}}"><button class="btn btn-default">Detalles</button></a>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$egresos->render()}}
	</div>
</div>
@endsection