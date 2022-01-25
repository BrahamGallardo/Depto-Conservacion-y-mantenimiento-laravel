@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Seguimiento</h3>
        @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
{!!Form::open(array('url'=>'administracion/seguimiento','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <div class="form-group">
                <label for="solicitud">Solicitud</label>
                <select name="solicitud" class="form-control selectpicker" data-live-search="true" id="idsolicitud">
                    @foreach($solicitudes as $sol)
                    <option value="{{$sol->idsolicitud}}">{{$sol->idsolicitud}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="form-group">
                <label for="Fecha">Fecha</label>
                <input type="date" value="" name="fecha" class="form-control" placeholder="Fecha">
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
            <div class="form-group">
                <label for="Estado">Estado</label>
                <select name="estado" class="form-control">
                    <option value="">Elige una opción</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Atendido">Atendido</option>
                    <option value="Cumplido">Cumplido</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="egreso">Con la salida de materiales</label>
                <select name="egreso" class="form-control selectpicker" data-live-search="true">
                    @foreach($egresos as $e)
                    <option value="{{$e->idegreso}}">{{$e->egreso}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="trabajador">Trabajador</label>
                <select name="trabajador" class="form-control selectpicker" data-live-search="true">
                    @foreach($trabajadores as $tra)
                    <option value="{{$tra->idtrabajador}}">{{$tra->trabajador}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" value="" name="total" class="form-control">
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label for="Documento">Documento</label>
                <input type="text" value="" name="documento" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <a href="{{url('administracion/seguimiento')}}"><button class="btn btn-primary">Aceptar</button></a>
        </div>
    </div>
</div>



<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
            <div class="form-group" id="dunidad">
                <label for="unidad">Unidad</label>
                <input type="text" class="form-control" name="unidad" value="" readonly id="idunidad">
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group" id="anios">
                <label for="año">Año</label>
                <select name="año" class="form-control" id="anio">
                    <option value="">Elige una opción</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                </select>
            </div>
        </div>
    </div>




</div>
{!!Form::close()!!}
@push ('scripts')
<script>
    $("#anios").hide();
    $("#dunidad").hide();
    $("#idsolicitud").change(mostrarValores);

    function mostrarValores() {
        $("#anios").show();
        $("#dunidad").show();
    }
    $("#anio").change(mostrarDetalles);

    function mostrarDetalles() {
        anio = $("#anio option:selected").text()

    }
</script>
@endpush
@endsection