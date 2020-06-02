<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> WonderFuL | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/fontawesome-free/css/all.min.css")}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset("/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css")}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset("/admin-lte/dist/css/adminlte.min.css")}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .textshadow {
            text-shadow:
                0 2.8px 2.2px rgba(0, 0, 0, 0.2),
                0 6.7px 5.3px rgba(0, 0, 0, 0.09),
                0 12.5px 10px rgba(0, 0, 0, 0.12),
                0 22.3px 17.9px rgba(0, 0, 0, 0.13),
                0 41.8px 33.4px rgba(0, 0, 0, 0.19),
                0 100px 80px rgba(0, 0, 0, 0.2)
            ;
        }
    </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo textshadow">
        <a href="../../index2.html"><b>Wonder</b>FUL</a>
    </div>
    <!-- /.login-logo -->
    <div class="card card-primary card-outline elevation-5">
        <div class="card-body">
            <p class="login-box-msg">{{ __('Login') }}</p>
            <!--FORM LOGIN-->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group mb-3">
                    <input id="email" type="text" class="form-control @error('user') is-invalid @enderror" name="user" value="{{ old('user') }}" placeholder="User" required autocomplete="user" autofocus>
                    @error('user')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4 mt-3">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Login') }}
                        </button>

                        {{-- @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif --}}
                    </div>
                    <!-- /.col -->
                </div>
            </form>

{{--            <div class="social-auth-links text-center mb-3">--}}
{{--                <p>- OR -</p>--}}
{{--                <a href="#" class="btn btn-block btn-primary">--}}
{{--                    <i class="fab fa-facebook mr-2"></i> Sign in using Facebook--}}
{{--                </a>--}}
{{--                <a href="#" class="btn btn-block btn-danger">--}}
{{--                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+--}}
{{--                </a>--}}
{{--            </div>--}}
            <!-- /.social-auth-links -->

{{--            <div class="row">--}}
{{--                <div class="col-8">--}}
{{--                    <p class="mb-1">--}}
{{--                        @if (Route::has('password.request'))--}}
{{--                            <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                {{ __('Forgot Your Password?') }}--}}
{{--                            </a>--}}
{{--                        @endif--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--                <div class="col-4">--}}
{{--                    <p class="mb-0">--}}
{{--                        <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                            {{ __('Register') }}--}}
{{--                        </a>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
            <br>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset("/admin-lte/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("/admin-lte/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("/admin-lte/dist/js/adminlte.min.js")}}"></script>
</body>
</html>
