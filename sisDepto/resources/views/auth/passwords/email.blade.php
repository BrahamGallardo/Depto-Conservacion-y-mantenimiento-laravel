@extends('layouts.app') 
@section('content')
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg">
      Olvido su contraseña? Aquí puede recuperar fácilmente una nueva contraseña. 
    </p>

    <form action="{{ url('/password/reset') }}" method="post">
      {{ csrf_field() }}
      <div class="input-group mb-3 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="Email" />
        @if ($errors->has('email'))
        <span class="help-block">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} input-group mb-3">
        <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña">
        @if ($errors->has('password'))
        <span class="help-block">
          <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>

      <div class="input-group mb-3 form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña">
        @if ($errors->has('password_confirmation'))
        <span class="help-block">
          <strong>{{ $errors->first('password_confirmation') }}</strong>
        </span>
        @endif
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block">
            Pide nueva contraseña
          </button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <p class="mt-3 mb-1">
      <a href="/login">Login</a>
    </p>
  </div>
  <!-- /.login-card-body -->
</div>
@endsection