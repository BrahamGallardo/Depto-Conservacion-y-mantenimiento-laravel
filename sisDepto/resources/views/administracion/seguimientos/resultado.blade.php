@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <h3>
            <a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a>
            Trabajos realizados para: {{$unidad}} en el año {{$anio}}
        </h3>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>ID</th>
                    <th>Descripción</th>
                </thead>
                @foreach($descripciones as $seg)
                <tr>
                <td><a href="{{URL::action('DetalleSolicitudController@show',$seg->iddetalle_solicitud)}}">{{ $seg->iddetalle_solicitud}}</a></td>
                    <td>{{ $seg->descripcion}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="col-xs-12">
            <div class="form-group">
                <a href="{{url('/buscar')}}">
                    <button type="button" class="btn btn-primary">Aceptar</button>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection