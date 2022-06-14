<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Shop</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

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
            <!-- a single product in card view -->
            <div class="row">
                @foreach($products as $product)
                    @include('Products.product_card_view')
                @endforeach
            </div>
            <!-- single products in card ends -->
        </div>
    </div>
</body>
</html>
