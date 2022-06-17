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
        .common-info-container {
            width: 100%;
            height: 20%;
            padding: 10px;
        }

        .common-info-pane {
            height: 100%;
            width: 20%;
            background-color: #0291f0;
            border-radius: 20px;
            text-align: center;
            color: white;
        }

        .table-container {
            padding: 5px 5px 5px 10px;
            overflow-y: auto;
        }

        .table-head {
            text-align: center;
            color: white;
        }

        .table-cell {
            text-align: center;
        }

        .confirm-button {
            background-color: #0291f0;
            color: white;
        }

        .confirm-button:hover {
            color: #fff;
        }

        .links{
            color: #fff;
            text-decoration: none;
        }

        .links:hover {
            color: #fff;
        }
    </style>
</head>
<body style="display: flex;">
    <div>
        <!-- sidebar here -->
        @include('Admin.sidebar')
    </div>
    <div style="width:80vw; height: 100vh">
        <div class="common-info-container d-flex justify-content-between">
            <div class="common-info-pane">
                Total sale <br>
                {{ $sale }} BDT
            </div>
            <div class="common-info-pane">
                Total product sale <br>
                {{ $soldProductUnit }} unit
            </div>
            <div class="common-info-pane">
                {{ $countCustomerWhoOrdered }}<br>
                customers ordered
            </div>
            <div class="common-info-pane">

            </div>
        </div>
        <div>
        <div class="table-container">
            <table class="table table-striped" >     
                <thead>
                    <tr style="background-color: #0291f0;">
                        <th scope="col" class="table-head" style="width: 20%;">Name</th>
                        <th scope="col" class="table-head" style="width: 20%;">Total order</th>
                        <th scope="col" class="table-head" style="width: 40%;">Total price</th>
                        <th scope="col" class="table-head" style="width: 20%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="table-cell">{{ $user->first_name }}  {{ $user->last_name }}</td>
                            <td class="table-cell">{{ count($user->completedOrder) }}</td>
                            <td class="table-cell">{{ $user->total_payment }}</td>
                            <td class="table-cell">
                                <button class="btn confirm-button" data-toggle="modal" data-target="#exampleModalLong">
                                    Details
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
