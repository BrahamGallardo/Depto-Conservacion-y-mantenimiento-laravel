@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Ordenes de trabajo
			<a href="ordenes/create"><button class="btn btn-info">Nueva orden</button></a>
		</h3>
		@include('administracion.ordenes.search')
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th >No. orden</th>
					<th class="col-lg-2 col-md-2 col-sm-2 col-xs-12">Unidad</th>
					<th >Concepto</th>
					<th class="col-lg-2 col-md-2 col-sm-2 col-xs-12">Proveedor</th>
					<th class="col-lg-1 col-md-1 col-sm-1 col-xs-12">Fecha</th>
					<th>Opciones</th>
				</thead>
				@foreach($ordenes as $orden)
				<tr>
					<td>{{ $orden->num_orden}}</td>
					<td>{{ $orden->unidad}}</td>
					<td>{{ $orden->concepto}}</td>
					<td>{{ $orden->proveedor}}</td>
					<td>{{ $orden->fecha}}</td>
					<td>
						<a href="{{URL::action('OrdenesController@show',$orden->num_orden)}}"><button class="btn btn-default">Detalles</button></a>
						
					</td>
				</tr>
				@endforeach
			</table>
		</div>
		{{$ordenes->render()}}
	</div>
</div>
@endsection