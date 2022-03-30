@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body{
            margin: 0px;
            padding: 0px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .main-div{
            width: 100vw;
            height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form{
            width: 30%;
            min-width: 300px;
            padding: 15px;
        }
        .welcome-text{
            font-family: "Georgia", "Courier New", monospace;
            color: #094beb;
            font-size: 25px;
        }
        .login-image{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-div{
            width: 100%;
            margin: 15px;
        }
        .input-item{
            height: 30px;
            width: 100%;
            outline: none;
            border: none;
            border-bottom: 1px solid #6e95f5;
        }
        .input-item:hover{
            border-bottom: 2px solid #094beb;
        }
        .button{
            width: 60%;
            padding: 10px;
            background-color: #094beb;
            border-radius: 10px;
            border: none;
            color: #fff;
            font-size: 20px;
            font-family: Copperplate;
            cursor: pointer;
        }
    </style>
</head>
<body>
    @section('content')
    @include('Layout.messages');
    <div class="main-div">
        <form method="POST" action="{{ route('login') }}" class="form">
            {{ csrf_field() }}

            <div style="width:100%; text-align:center" class="welcome-text"><h1>Welcome</h1></div>
            <div class="login-image">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#094beb" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z"/>
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                </svg>
            </div>
            <div class="form-div form-group row">
                <label style="width: 100%;" for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div>
                    <input id="email" type="email" class="input-item form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-div form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div>
                    <input id="password" type="password" class="input-item form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="form-div form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                        @if (Route::has('password.request'))
                            <a style="float: right;"  href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group row mb-0" style="display: flex; justify-content:center">
                <button type="submit" class="button">
                    LOGIN
                </button>
            </div>
        </form>
    </div>
    @endsection
</body>
</html>
