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
{!!Form::open(array('url'=>'administracion/seguimiento','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
{{Form::token()}}
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <div class="form-group">
                <label for="solicitud">Solicitud</label>
                <select name="dsolicitud" class="form-control selectpicker" data-live-search="true" id="idsolicitud">
                    <option value="">id</option>
                    @foreach($solicitudes as $sol)
                    <option value="{{$sol->idsolicitud}}_{{$sol->unidad}}_{{$sol->asunto}}_{{$sol->compromiso}}">{{$sol->idsolicitud}}</option>
                    @endforeach
                    <?php $var = $sol->idsolicitud ?>
                </select>
                <input type="hidden" name="solicitud" id="solicitud" value="">
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
                    <option value="">Elija una opción</option>
                    @foreach($egresos as $e)
                    <option value="{{$e->idegreso}}">{{$e->egreso}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="trabajador">Trabajador</label>
                <select name="trabajador" class="form-control selectpicker" data-live-search="true">
                    <option value="">Elija una opción</option>
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
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="4" placeholder="Descripción"></textarea>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <label for="imagen">Documento</label>
                <input id="imgInp" type="file" name="imagen" class="form-control">
                <iframe id="blah" src="" height="220px" width="150px"></iframe>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group">
                <a href="{{url('administracion/seguimiento')}}"><button class="btn btn-primary">Aceptar</button></a>
                <a href="/administracion/seguimiento"> <button class="btn btn-danger" type="button">Cancelar</button></a>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group" id="dunidad">
                <label for="unidad">Unidad</label>
                <input type="text" class="form-control" name="unidad" value="" readonly id="idunidad">
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group" id="dasunto">
                <label for="asunto">Asunto</label>
                <input type="text" class="form-control" name="asunto" value="" readonly id="dasuntod">
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="form-group" id="comp">
                <label for="compromiso">Compromiso</label>
                <input type="text" class="form-control" value="" readonly id="compromiso">
            </div>
        </div>
    </div>
</div>
{!!Form::close()!!}
@push ('scripts')
<script>
    $("#dunidad").hide();
    $("#dasunto").hide();
    $("#comp").hide();
    $("#idsolicitud").change(mostrarValores);

    function mostrarValores() {
        detalles = document.getElementById('idsolicitud').value.split('_');
        $("#solicitud").val(detalles[0]);
        $("#idunidad").val(detalles[1]);
        $("#dasuntod").val(detalles[2]);
        $("#compromiso").val(detalles[3]);
        $("#var").val(detalles[0]);
        $("#comp").show();
        $("#dunidad").show();
        $("#dasunto").show();
    }
</script>
@endpush
@endsection