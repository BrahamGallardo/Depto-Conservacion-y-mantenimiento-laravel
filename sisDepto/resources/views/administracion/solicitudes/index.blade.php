@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de solicitudes
			<a href="solicitudes/create"><button class="btn btn-success">Nuevo</button></a>
			<a href="desarrollo/create"><button class="btn btn-info">Realizar seguimiento</button></a>
		</h3>
		@include('administracion.solicitudes.search')
	</div>
</div>
<style>
	.peligro {
		background-color: #dd4b39;
	}

	.realizado {
		background-color: #28a745;
	}

	.notable {
		background-color: #00c0ef;
	}

	.advertencia {
		background-color: #f39c12;
	}
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
					<th>ID</th>
					<th class="col-lg-4 col-md-4 col-sm-4 col-xs-12">Asunto</th>
					<th class="col-lg-2 col-md-2 col-sm-2 col-xs-12">Unidad</th>
					<th>Fecha a realizar</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
				@foreach($solicitudes as $soli)
				<tr>
					<td>{{ $soli->idsolicitud}}</td>
					<td>{{ $soli->asunto}}</td>
					<td>{{ $soli->unidad}}</td>


					@if($fechahoy >= $soli->fecha_limite && $soli->estado != 'Cumplido' && $soli->estado != 'No procede')
					<td class="peligro">{{ $soli->fecha_limite}}</td>
					@elseif($fechasemana >= $soli->fecha_limite && $fechahoy < $soli->fecha_limite && $soli->estado != 'Cumplido' && $soli->estado != 'No procede')
						<td class="advertencia">{{ $soli->fecha_limite}}</td>
						@elseif($fechasemana < $soli->fecha_limite && $soli->estado != 'Cumplido' && $soli->estado != 'No procede')
							<td class="notable">{{ $soli->fecha_limite}}</td>
							@elseif($soli->estado == 'Cumplido')
							<td class="realizado">{{ $soli->fecha_limite}}</td>
							@elseif($soli->estado == 'No procede')
							<td>{{ $soli->fecha_limite}}</td>
							@endif

							<td>{{ $soli->estado}}</td>
							<td>

								<a href="{{URL::action('SolicitudController@show',$soli->idsolicitud)}}"><button class="btn btn-default">Detalles</button></a>
								@if($soli->estado == 'Cumplido')
								<a class="oculto" href="" data-target="#modal-delete-{{$soli->idsolicitud}}" data-toggle="modal"><button class="btn btn-danger oculto disabled">Eliminar</button></a>
								@elseif($soli->estado != 'Cumplido')
								<a href="" data-target="#modal-delete-{{$soli->idsolicitud}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
								@endif
							</td>
				</tr>
				@include('administracion.solicitudes.modal')
				@endforeach
			</table>
		</div>
		{{$solicitudes->render()}}
	</div>
</div>
@endsection