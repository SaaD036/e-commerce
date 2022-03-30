<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <style>
        .card-title{
            display: flex;
            justify-content:center;
            padding:15px;
            color: #094beb;
        }
        .card-description{
            padding: 10px;
            margin-bottom: 10px;
        }

    </style>
</head>
<body style="display:flex;">
    <div>
        <!-- sidebar here -->
        @include('Admin.sidebar')
    </div>
    <div style="width:80vw; padding:30px">
            <!-- a single product in card view -->
            <div class="row">
                @foreach($products as $product)
                <div class="col-sm-3">
                    <div class="card" style="width:250px; padding-bottom:10px">
                        <img src="" style="width:100%; height:150px">
                        <div class="card-title">
                            <b>{{$product->title}}</b>
                        </div>
                        <div class="card-description">
                            {{$product->description}}
                        </div>
                        <div style="display: flex; align-items:center; justify-content:center; border:1px solid #094beb; border-radius:20px">
                            <a style="text-decoration:none; color:#094beb" href="{{ route('edit-product') }}/{{$product->id}}">Edit</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- single products in card ends -->
    </div>
</body>
</html>
