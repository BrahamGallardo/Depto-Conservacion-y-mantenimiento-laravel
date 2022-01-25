@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3><a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Nueva solicitud</h3>
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
{!!Form::open(array('url'=>'administracion/solicitudes','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="asunto">Asunto</label>
            <textarea class="form-control" name="asunto" rows="8" placeholder="Asunto"></textarea>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="compromiso">Compromiso</label>
            <textarea class="form-control" name="compromiso" rows="8" placeholder="Compromiso"></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <label for="unidad">Unidad</label>
                    <select name="unidad_juris" class="form-control selectpicker" data-live-search="true" required id="unidad">
                        <option value="">Unidad (Hospital)</option>
                        @foreach($unidades as $uni)
                        <option value="{{$uni->unidad}}_{{$uni->jurisdiccion}}_{{$uni->num_oficina}}">{{$uni->num_oficina}} - {{$uni->unidad}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" value="" name="unidad" id="idunidad">
                    <input type="hidden" value="" name="num_oficina" id="num_oficina">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="jurisd sanit">Jurisd. Sanit.</label>
                    <input type="text" value="" name="jurisd_sanit" id="idjuris" class="form-control" placeholder="Jurisdicción sanitaria">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label for="fecha limite">Fecha a realizar</label>
                    <input type="date" value="" name="fecha_limite" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <label for="Tipo">Tipo</label>
                <select name="tipo" class="form-control" required>
                    <option value="" selected>Elige un tipo</option>
                    <option value="Minuta">Minuta</option>
                    <option value="Mesa de trabajo">Mesa de trabajo</option>
                    <option value="Reunión">Reunión</option>
                    <option value="Otros">Otros</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="form-group">
                <label for="Estado">Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="" selected>Elige un estado</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Atendido">Atendido</option>
                    <option value="Cumplido">Cumplido</option>
                    <option value="No procede">No procede</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="actualizacion">Actualización</label>
            <textarea class="form-control" name="actualizacion" rows="4" placeholder="Actualizaciones"></textarea>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="comentarios">Comentarios</label>
            <textarea class="form-control" name="comentarios" rows="4" placeholder="Comentarios"></textarea>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <a href="{{url('administracion/solicitudes')}}"><button class="btn btn-primary">Aceptar</button></a>
        </div>
    </div>
</div>
{!!Form::close()!!}
@push ('scripts')
<script>
    $("#unidad").change(mostrarValoresUnidad);

    function mostrarValoresUnidad() {
        datosUnidad = document.getElementById('unidad').value.split('_');
        $("#idunidad").val(datosUnidad[0]);
        $("#idjuris").val(datosUnidad[1]);
        $("#num_oficina").val(datosUnidad[2]);
    }
</script>
@endpush
@endsection