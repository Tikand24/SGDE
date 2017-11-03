<!DOCTYPE html>
    <!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Material Admin</title>

        <!-- Vendor CSS -->
        <link href="{{ asset('administracion/vendors/bower_components/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('administracion/vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css') }}" rel="stylesheet">

        <!-- CSS -->
        <link href="{{ asset('administracion/css/app_1.min.css') }}" rel="stylesheet">
        <link href="{{ asset('administracion/css/app_2.min.css') }}" rel="stylesheet">
    </head>

    <body>
        <div class="login-content">
            <!-- Login -->
            <div class="lc-block toggled" id="l-login">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                <div class="lcb-form">
                    <div class="input-group m-b-20">
                        <span class="input-group-addon"><i class="zmdi zmdi-account"></i></span>
                        <div class="fg-line">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo electronico">
                        </div>
                    </div>

                    <div class="input-group m-b-20">
                        <span class="input-group-addon"><i class="zmdi zmdi-male"></i></span>
                        <div class="fg-line">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
                        </div>
                    </div>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <i class="input-helper"></i>
                            Recordarme
                        </label>
                    </div>
                    <button type="submit" class="btn btn-login btn-success btn-float">
                                    <i class="zmdi zmdi-arrow-forward"></i>
                                </button>
                </div>

                <div class="lcb-navigation">
                    <a href="{{ url('/') }}"><i class="zmdi zmdi-home"></i><span>Inicio</span></a>
                </div>
            </form>
            </div>
        </div>
        <script src="{{ asset('administracion/vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('administracion/vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

        <script src="{{ asset('administracion/vendors/bower_components/Waves/dist/waves.min.js') }}"></script>
        <script src="{{ asset('administracion/js/app.min.js') }}"></script>
    </body>
</html>
                   {{--  <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form> --}}
