<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <style>
        .table-row{
            border-bottom: 1px solid #094beb;
        }
        .button{
            background-color: #094beb;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }
        .button a{
            text-decoration: none;
            color:#fff;
        }
        .button-delete{
            background-color: red;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-left: 5px;
        }
        .button-delete a{
            text-decoration: none;
            color:#fff;
        }
    </style>
</head>
<body style="display:flex;">
    <div>
        <!-- sidebar here -->
        @include('Admin.sidebar')
    </div>
    <div style="width:80vw; padding:30px">
        <table class="table table-striped">
            <thead class="table-row">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Description</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{$category->id}}</td>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td style="display: flex;">
                        <div class="button"><a href="{{route('category')}}/{{$category->id}}">Edit</a></div>

                        @if(count($category->products) <= 0)
                            <div class="button-delete"><a href="{{route('category')}}/delete/{{$category->id}}">Delete</a></div>
                        @else
                            <div class="button-delete"><a href="{{route('category')}}/delete/{{$category->id}}" style="pointer-events: none">Delete</a></div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
