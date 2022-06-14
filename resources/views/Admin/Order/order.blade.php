<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <style>
        .navbar{
            height:10%;
            min-height: 100px;
            width: 100%;
            background-color: #fff;
            border: 1px solid #075dde;
            border-radius: 15px;
        }
        
        .table-head {
            text-align: center;
            color: white;
        }

        .table-cell {
            text-align: center;
        }

        .confirm-button {
            background-color: green;
            color: white;
        }

        .confirm-button:hover {
            color: #fff;
        }
    </style>
</head>
<body style="display: flex;">
    <div>
        <!-- sidebar here -->
        @include('Admin.sidebar')
    </div>
    <div style="width:80vw; padding:15px">
        <div id="completed_order">
            <table class="table table-striped">     
                <thead>
                    <tr style="background-color: green;">
                        <th scope="col" class="table-head" style="width: 20%;">User</th>
                        <th scope="col" class="table-head" style="width: 20%;">Amount</th>
                        <th scope="col" class="table-head" style="width: 40%;">Address</th>
                        <th scope="col" class="table-head" style="width: 20%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($completed_orders as $order)
                        <tr>
                            <td class="table-cell">{{ $order->user->first_name }}  {{ $order->user->last_name }}</td>
                            <td class="table-cell">{{ count($order->carts) }}</td>
                            <td class="table-cell">{{ $order->address }}</td>
                            <td class="table-cell">
                                <button class="btn confirm-button" onclick="showOrderDetails({{ $order }})" data-toggle="modal" data-target="#exampleModalLong">
                                    Details
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="incompleted_order"></div>
        <div id="current_order"></div>
    </div>

    <div id="exampleModalLong" style="display: none"></div>

    <script>
        function showOrderDetails(data){
            let modal = document.getElementById('exampleModalLong');
            console.log(data);
            console.log(data.id);
            console.log(modal);

            let htmlContent = `<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Make payment</h5>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                            <div class="modal-body">`+
                                            data.id
                                            +`</div>
                                        </div>
                                    </div>
                                </div>`;

            modal.htmlContent = htmlContent;
            modal.style.display = 'block';
            console.log(modal);
        }
    </script>
</body>
</html>
