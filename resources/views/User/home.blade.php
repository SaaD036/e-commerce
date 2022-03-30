<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->first_name.' '.$user->last_name }}</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <style>
        .profile_image_div{
            height: 20%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center
        }
        .profile_image{
            height: 80%;
            border: 1px solid green;
            border-radius:50%;
            padding: 10px
        }
        .profile_info_div{
            height: 80%;
            width: 100%;
            justify-content: center;
            padding-left: 10%;
            padding-right: 10%;
        }
        .profile_info_input{
            width: 100%;
        }
    </style>
</head>
<body>
    <div style="height: 20vh; ">
        <!-- navbar here -->
        @include('Layout.navbar')
    </div>

    <div style="height:80vh; width:100vw; display:flex">
        <div style="height:100%; min-width:0px; max-width:300px; display:flex">
            <!-- sidebar here -->
            @include('Layout.sidebar')
        </div>

        <div style="height:100%; width:100%; margin-right:30px">
            <!-- error message -->
            @include('Layout.messages');

            <!-- profile image -->
            <div class="profile_image_div">
                <img class="profile_image" src="{{ $user->image }}">
            </div>

            <!-- profile information -->
            <form action="/user/{{ Auth::user()->id }}", method="post">
            {{ csrf_field() }}

                <div class="profile_info_div">
                    <!-- email input -->
                    <div class="profile_info_input">
                        <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="background-color:#d4fada; border:1px solid #d4fada">Email</div>
                                </div>
                                <input type="text" value="{{ $user->email }}" name="email" style="border:1px solid #d4fada" class="form-control" placeholder="Username">
                            </div>
                        </div>
                    </div>

                    <!-- name input -->
                    <div class="profile_info_input" style="display:flex">
                        <div class="col-auto" style="width:48%">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="background-color:#d4fada; border:1px solid #d4fada">First name</div>
                                </div>
                                <input type="text" value="{{ $user->first_name }}" name="f_name" style="border:1px solid #d4fada" class="form-control" placeholder="First name">
                            </div>
                        </div>
                        <div class="col-auto" style="width:48%; margin-left:4%">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="background-color:#d4fada; border:1px solid #d4fada">Last name</div>
                                </div>
                                <input type="text" value="{{ $user->last_name }}" name="l_name" style="border:1px solid #d4fada" class="form-control" placeholder="Last name">
                            </div>
                        </div>
                    </div>

                    <!-- phone input -->
                    <div class="profile_info_input">
                        <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="background-color:#d4fada; border:1px solid #d4fada">Phone</div>
                                </div>
                                <input type="text" value="{{ $user->phone }}" name="phone" style="border:1px solid #d4fada" class="form-control" placeholder="Phone">
                            </div>
                        </div>
                    </div>

                    <!-- street address input -->
                    <div class="profile_info_input">
                        <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="background-color:#d4fada; border:1px solid #d4fada">Street address</div>
                                </div>
                                <input type="text" value="{{ $user->street_address }}" name="street" style="border:1px solid #d4fada" class="form-control" placeholder="Street address">
                            </div>
                        </div>
                    </div>

                    <!-- district input -->
                    <div class="profile_info_input">
                        <div class="col-auto">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" style="background-color:#d4fada; border:1px solid #d4fada">District</div>
                                </div>
                                <select class="form-input form-select" style="border:1px solid #d4fada" name="district_id">
                                    <option value="">Select a district</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="margin-top: 10px; float:right; background-color:green">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
