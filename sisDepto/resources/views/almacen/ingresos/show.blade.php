@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Detalles de la solicitud No. {{$ingresos->idingreso}}</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Tipo comprobante</label>
			<p>{{$ingresos->tipo_comprobante}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Fecha y Hora</label>
			<p>{{$ingresos->fecha_hora}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Estado</label>
			<p>{{$ingresos->estado}}</p>
		</div>
	</div>
</div>
<form action="/download" method="GET">
	<div class="row">
		<div class="panel panel-primary" style="border-color: #A9D0F5">
			<div class="panel-body">

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
						<thead style="background-color: #A9D0F5">
							<th>Codigo</th>
							<th>Artículo</th>
							<th>Cantidad</th>
							<th>Unidad</th>
						</thead>
						<tfoot>

						</tfoot>
						<tbody>
							@foreach($detalles as $det)
							<tr>
								<td>{{$det->codigo}}</td>
								<td>{{$det->nombre_articulo}}</td>
								<td>{{$det->cantidad}}</td>
								<td>{{$det->unidad}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
			<div class="form-group">
				<button class="btn btn-primary" id="btnsolicitar" type="submit">Descargar</button>
			</div>
		</div>
	</div>
</form>
@endsection