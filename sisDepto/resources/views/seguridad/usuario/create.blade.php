@extends('layouts.admin')
@section('contenido')
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h3> <a href="javascript:history.back()" class="fa fa-back" style="color: #222d32;"></a> Nuevo usuario</h3>
        @if(count($errors)>0)
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {!!Form::open(array('url'=>'seguridad/usuario','method'=>'POST','autocomplete'=>'off'))!!}
        {{Form::token()}}
        <div class="col-xs-12">
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Nombre</label>
                <div class="col-md-6">
                    <input required id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="col-md-12">
            <div class="form-group{{ $errors->has('trabajador') ? ' has-error' : '' }}">
                <label for="trabajador" class="col-md-4 control-label">Trabajador</label>
                <div class="col-md-6">
                    <select required name="trabajador" id="trabajador" class="form-control selectpicker" data-live-search="true">
                        @foreach($trabajador as $tra)
                        <option value="{{$tra->idtrabajador}}+{{$tra->email}}+{{$tra->idrol}}">{{$tra->nombre_trabajador}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('trabajador'))
                    <span class="help-block">
                        <strong>{{$errors->first('trabajador')}}</strong>
                    </span>
                    @endif
                    <input type="hidden" value="" name="idtrabajador" id="idtrabajador">
                    <input type="hidden" value="" name="idrol" id="idrol">
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="col-md-12">
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail</label>
                <div class="col-md-6">
                    <input required id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{$errors->first('email')}}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="col-md-12">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Contraseña</label>
                <div class="col-md-6">
                    <input required id="password" type="password" class="form-control" name="password">
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="col-md-12">
            <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña</label>

                <div class="col-md-6">
                    <input required id="password-confirm" type="password" class="form-control" name="password_confirmation">

                    @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <button class="btn btn-primary" type="submit">Guardar</button>
            <button class="btn btn-danger" type="reset">Borrar cambios</button>
        </div>

        {!!Form::close()!!}

    </div>
</div>
@push ('scripts')
<script>
    $("#trabajador").change(mostrarValores);

    function mostrarValores() {
        email = document.getElementById('trabajador').value.split('+');
        $("#idtrabajador").val(email[0]);
        $("#email").val(email[1]);
        $("#idrol").val(email[2]);
    }
</script>
@endpush
@endsection