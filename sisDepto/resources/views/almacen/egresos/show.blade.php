@extends('layouts.admin')
@section('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Detalles de la solicitud No. {{$egreso->idegreso}}</h3>
	</div>
</div>

<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Fecha</label>
			<p>{{$egreso->fecha}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Trabajador que realizó la salida</label>
			<p>{{$egreso->nombre_trabajador}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Razón</label>
			<p>{{$egreso->razon}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Archivo</label>
			<p>{{$egreso->archivo}}</p>
		</div>
	</div>
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<div class="form-group">
			<label>Comentarios</label>
			<p>{{$egreso->comentarios}}</p>
		</div>
	</div>
</div>
<form action="#" method="get">
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
						<tbody>
							<?php $i = 0; ?>
							@foreach($detalles as $det)
							<tr>
								<td name="rcodigo" value='{{$det->codigo}}'>{{$det->codigo}}</td>
								<td name="rnombre" value="{{$det->nombre_articulo}}">{{$det->nombre_articulo}}</td>
								<td name="rcantidad" value="{{$det->cantidad}}">{{$det->cantidad}}</td>
								<td name="runidad" value="{{$det->unidad}}">{{$det->unidad}}</td>
							</tr>
							<?php $i = $i + 1; ?>
							@endforeach
							<input type="hidden" name="total_art" value="{{$i}}">
							<input type="hidden" name="vingreso" value="{{$arts->idegreso}}">
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
			<div class="form-group">
				<button class="btn btn-link" id="btnsolicitar" type="submit">Descargar</button>
			</div>
		</div>
	</div>
</form>
@endsection