@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de articulos
			<a href="articulos/create"><button class="btn btn-success">Nuevo</button></a>
			<a href="ingresos/create"><button class="btn btn-info">Solicitar</button></a>
			<a href="egresos/create"><button class="btn btn-warning">Salida</button></a>
		</h3>
		@include('almacen.articulos.search')
		<?php
		// comprobar si tenemos los parametros w1 y w2 en la URL
		if (isset($_GET["searchText"])) {
			// asignar w1 y w2 a dos variables
			$vari = $_GET["searchText"];

			// mostrar $vari y $phpVar2
			echo "<p>Parameters: " . $vari .  "</p>";
		} else {
			echo "<p>No parameters</p>";
		}
		?>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<style>
				.peligro {
					background-color: #dd4b39;
				}

				.notable {
					background-color: #00c0ef;
				}

				.advertencia {
					background-color: #f39c12;
				}
			</style>
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Categoria</th>
					<th>Cantidad</th>
					<th>Unidad</th>
					<th>Opciones</th>
				</thead>
				@foreach($articulos as $art)
				<tr>
					<td>{{ $art->codigo}}</td>
					<td>{{ $art->nombre_articulo}}</td>
					<td>{{ $art->tipo_articulo}}</td>

					@if($art->cantidad <= 15 ) <td class="peligro">{{ $art->cantidad}}</td>
						@elseif($art->cantidad > 15 && $art->cantidad <= 30 ) <td class="advertencia">{{ $art->cantidad}}</td>
							@elseif($art->cantidad > 30 )
							<td class="notable">{{ $art->cantidad}}</td>
							@endif

							<td>{{ $art->unidad}}</td>
							<td>
								<a href="{{URL::action('ArticuloController@show',$art->codigo)}}"><button class="btn btn-default">Detalles</button></a>

							</td>
				</tr>
				@include('almacen.articulos.modal')
				@endforeach
			</table>
		</div>
		{{$articulos->render()}}
	</div>
</div>
@push ('scripts')
<script type="text/javascript">
	function javascript_to_php() {
		var vari = $("#searchText").val();
		window.location.href = window.location.href + "?searchText=" + vari;
	}
</script>
@endpush
@endsection