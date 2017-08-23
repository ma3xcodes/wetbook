@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row row-register">
        <div class="col-xs-7 text-center register-message">
            <div>
                <h1><strong>Bootstrap</strong> Registration Form</h1>
                <div class="description">
                    <p>
                        This is a free responsive flat registration form made with Bootstrap.
                        Download it on <a href="http://azmind.com"><strong>AZMIND</strong></a>, customize and use it as you like!
                    </p>
                </div>
                <div class="top-big-link">
                    <a class="btn btn-success" href="#">Button 1</a>
                    <a class="btn btn-link" href="#">Button 2</a>
                </div>
            </div>
        </div>
        <div class="col-xs-5 form-box">
            <div class="panel panel-default">
                <div class="panel-heading">Registrarme</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-xs-4 control-label">Nombre de usuario</label>

                            <div class="col-xs-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-xs-4 control-label">Nombre</label>

                            <div class="col-xs-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!--<div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                            <label for="name" class="col-xs-4 control-label">Segundo Nombre</label>

                            <div class="col-xs-6">
                                <input id="name" type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}" autofocus>

                                @if ($errors->has('middle_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('middle_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>-->
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-xs-4 control-label">Apellidos</label>

                            <div class="col-xs-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-xs-4 control-label">Correo</label>

                            <div class="col-xs-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-xs-4 control-label">Contraseña</label>

                            <div class="col-xs-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-xs-4 control-label">Confirmar Contraseña</label>

                            <div class="col-xs-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6 col-xs-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
