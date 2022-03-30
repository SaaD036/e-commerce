<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <style>
        .cover{
            height: 20%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Copperplate";
            color: #094beb;
            font-size: 50px;
        }
    </style>
</head>
<body style="display:flex;">
    <div>
        <!-- sidebar here -->
        @include('Admin.sidebar')
    </div>
    <div style="width:80vw; padding:30px">
        <div class="cover"></div>
        @include('Layout.messages')
        <form action="{{route('category-create')}}" method="post">
            {{ csrf_field() }}

            <div class="input-group" style="margin-bottom: 3px;">
                <div class="input-group-prepend">
                    <span style="background-color:#99b3f2" class="input-group-text">Name</span>
                </div>
                <input name="name" style="border:1px solid #99b3f2;" type="text" class="form-control">
            </div>
            <div class="input-group" style="margin-bottom: 10px;">
                <div class="input-group-prepend">
                    <span style="background-color:#99b3f2" class="input-group-text">parent ID</span>
                </div>
                <input name="parent_id" style="border:1px solid #99b3f2;" type="text" class="form-control">
            </div>
            <div class="input-group">
                <textarea name="description" class="form-control" style="width: 100%; height:100px; max-height:180px; border:1px solid #99b3f2" placeholder="Description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="margin-top: 10px; float:right">Create</button>
        </form>
    </div>
</body>
</html>
