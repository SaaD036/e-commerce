<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <style>
        .navbar{
            height:10%;
            min-height: 100px;
            width: 100%;
            background-color: #fff;
            border: 1px solid #075dde;
            border-radius: 15px;
        }
        .input-form{
            height:85%;
            width: 100%;
            margin-top: 5px;
        }
        .input-field{
            border: 1px solid #2e12e3;
            border-radius: 5px;
            margin-top: 5px;
            outline: #075dde;
        }
    </style>
</head>
<body style="display: flex;">
    <div>
        <!-- sidebar here -->
        @include('Admin.sidebar')
    </div>
    <div style="width:80vw; padding:15px">
        <div class="navbar"></div>
        <div class="input-form">
            @include('Layout.messages')
            <form action="{{ route('store-product') }}" method="post">

                {{ csrf_field() }}

                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Product title</label>
                    <div class="col-sm-10">
                        <input name="title" type="text" class="form-control input-field" placeholder="Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <input name="description" type="text" class="form-control input-field" style="max-height:100px; overflow-x:hidden; overflow-y:auto" placeholder="Description">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input name="price" type="number" class="form-control input-field" placeholder="Price">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Offer</label>
                    <div class="col-sm-10">
                        <input name="offer" type="number" class="form-control input-field" placeholder="Offer">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Amount</label>
                    <div class="col-sm-10">
                        <input name="amount" type="number" class="form-control input-field" placeholder="Amount">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <select class="form-input form-select input-field" aria-label="Default select example" name="category_id">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <input name="status" type="text" class="form-control input-field" placeholder="Status">
                    </div>
                </div>

                <div class="form-group row" style="margin-top: 5px; float:right">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary" style="width:100px">Insert</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
