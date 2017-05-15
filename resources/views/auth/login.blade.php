@extends('layouts.login')

@section('content')

              <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

              <h1>Iniciar Sesión</h1>

              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <div>
                        Usuario:
                        <input id="usuario" type="text" class="form-control" name="usuario" value="{{ old('usuario') }}" required autofocus>

                        @if ($errors->has('usuario'))
                            <span class="help-block">
                                <strong>{{ $errors->first('usuario') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>

              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <div>
                        Contraseña
                        <input id="password" type="password" class="form-control" name="password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
              </div>

              <div>
                <button type="submit" class="btn btn-primary">
                    Ingresar
                </button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class=""></i> TOYOSA S.A.</h1>
                  <p>©2017 Todos los derechos reservaados.TOYOSA S.A. Sistema de Inventarios regionalizados </p>
                </div>
              </div>
            </form>                       
@endsection
