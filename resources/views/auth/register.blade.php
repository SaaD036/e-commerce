@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <style>
        body{
            margin: 0px;
            padding: 0px;
        }
        .main-container{
            height:80vh;
            width: 100vw;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-div{
            width: 35%;
            min-width: 300px;
        }
        .welcome-text{
            font-family: "Georgia", "Courier New", monospace;
            color: #094beb;
            font-size: 25px;
        }
        .form-element{
            width: 100%;
            margin-bottom: 15px;
        }
        .form-input{
            height: 30px;
            width: 100%;
            border: none;
            outline: none;
            border-bottom: 1px solid #094beb;
            margin-top: -2px;
        }
        .form-input-name{
            height: 30px;
            width: 45%;
            border: none;
            outline: none;
            border-bottom: 1px solid #094beb;
        }
        .beside-form{
            height: 100%;
            width: 35%;
            min-width: 300px;
            border-left: 1px solid #094beb;
            margin-left: 15px;
        }
    </style>
</head>
<body>
    @section('content')
    <div class="container main-container">
        <div class="card-body form-div">
            <form method="POST" action="{{ route('signup') }}">
                {{ csrf_field() }}
                <!-- email input -->
                <div class="form-element">
                    <label for="email">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- name input -->
                <div class="form-element" style="display: flex">
                    <input id="f_name" type="text" name="f_name" class="form-input-name" placeholder="First name">
                    <div style="width:10%"></div>
                    <input id="l_name" type="text" name="l_name" class="form-input-name" placeholder="Last name">
                </div>
                <!-- phone number input -->
                <div class="form-element">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                    <div class="col-md-6">
                        <input id="phone" type="text" name="phone" class="form-input">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- district input -->
                <div class="form-element">
                    <label class="col-md-4 col-form-label text-md-right">District</label>

                    <div class="col-md-6">
                        <select class="form-input form-select" aria-label="Default select example" name="district_id">
                            <option value="">Select a district</option>
                            @foreach($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- street input -->
                <div class="form-element">
                    <label for="street" class="col-md-4 col-form-label text-md-right">Street name</label>

                    <div class="col-md-6">
                        <input id="street" type="text" name="street" class="form-input ">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- password input -->
                <div class="form-element">
                    <label for="password" class="form-input col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-element">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-input form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="beside-form">
            <div style="width:100%; text-align:center" class="welcome-text"><h1>Welcome</h1></div>
        </div>
    </div>
    @endsection
</body>
</html>
