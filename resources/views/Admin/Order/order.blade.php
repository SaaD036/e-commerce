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
        .center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .item-message {
            height: 10%;
            width: 80%;
            background-color: #F8F8F8;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
        }

        .radio-button-container {
            padding: 10px 0px 10px 0px;
            display: flex;
            margin: auto;
        }

        .empty-message-container {
            flex-direction: column;
            width: 100%;
            height: 100%;
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
    <div style="width:80vw; padding:15px">
        <div class="btn-group radio-button-container" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check"
                    name="btnradio" id="btnradio1" autocomplete="off"
                    checked onclick="showCompletedOrder()">
            <label class="btn btn-outline-primary" for="btnradio1">Completed Orders ({{ count($completed_orders) }})</label>

            <input type="radio" class="btn-check"
                    name="btnradio" id="btnradio2"
                    autocomplete="off" onclick="showCurrentOrder()">
            <label class="btn btn-outline-primary" for="btnradio2">Current Orders ({{ count($current_order) }})</label>

            <input type="radio" class="btn-check"
                    name="btnradio" id="btnradio3"
                    autocomplete="off" onclick="showPendingOrder()">
            <label class="btn btn-outline-primary" for="btnradio3">Pending Orders ({{ count($incompleted_order) }})</label>
        </div>
        
        <!-- completed orders -->
        <div id="completed_order" style="height: 80%;">
            @if(count($completed_orders) > 0)
                <table class="table table-striped" >     
                    <thead>
                        <tr style="background-color: #0291f0;">
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
                                    <button class="btn confirm-button" onclick="showOrderDetails({{ $order }}, 2)" data-toggle="modal" data-target="#exampleModalLong">
                                        Details
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="center empty-message-container">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="#0291f0" class="bi bi-cart2" viewBox="0 0 16 16">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                    </svg>
                    <h1 class="empty-cart">No completed order</h1>
                </div>
            @endif
        </div>

        <!-- pending orders -->
        <div id="incompleted_order" style="display: none; height: 80%;">
            @if(count($incompleted_order))
                <table class="table table-striped">     
                    <thead>
                        <tr style="background-color: #0291f0;">
                            <th scope="col" class="table-head" style="width: 20%;">User</th>
                            <th scope="col" class="table-head" style="width: 20%;">Amount</th>
                            <th scope="col" class="table-head" style="width: 40%;">Address</th>
                            <th scope="col" class="table-head" style="width: 20%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($incompleted_order as $order)
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
            @else
                <div class="center empty-message-container">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="#0291f0" class="bi bi-cart2" viewBox="0 0 16 16">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                    </svg>
                    <h1 class="empty-cart">No pending order</h1>
                </div>
            @endif
        </div>
        
        <!-- current orders -->
        <div id="current_order" style="display: none; height: 80%;">
            @if(count($current_order)>0)
                <table class="table table-striped">     
                    <thead>
                        <tr style="background-color: #0291f0;">
                            <th scope="col" class="table-head" style="width: 20%;">User</th>
                            <th scope="col" class="table-head" style="width: 20%;">Amount</th>
                            <th scope="col" class="table-head" style="width: 40%;">Address</th>
                            <th scope="col" class="table-head" style="width: 20%;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($current_order as $order)
                            <tr>
                                <td class="table-cell">{{ $order->user->first_name }}  {{ $order->user->last_name }}</td>
                                <td class="table-cell">{{ count($order->carts) }}</td>
                                <td class="table-cell">{{ $order->address }}</td>
                                <td class="table-cell">
                                    <button class="btn confirm-button" onclick="showOrderDetails({{ $order }}, 1)" data-toggle="modal" data-target="#exampleModalLong">
                                        Details
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="center empty-message-container">
                    <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="#0291f0" class="bi bi-cart2" viewBox="0 0 16 16">
                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                    </svg>
                    <h1 class="empty-cart">No current order</h1>
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="exampleModalLong" 
        tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true" style="width: 100%;">
    </div>

    <script>
        let completedOrderContainer = document.getElementById('completed_order');
        let currentOrderContainer = document.getElementById('current_order');
        let pendingOrderContainer = document.getElementById('incompleted_order');


        function showOrderDetails(data, flag=0){
            let modal = document.getElementById('exampleModalLong');
            let modalMessage = 'This order is awaiting payment';
            let actionButton = '';
            console.log(data, flag);


            if(flag===1 && data.payment){
                modalMessage = `This order has received payment through <br><b>${data.payment.method}</b><br>
                                Transaction ID is <b>${data.payment.transaction_id}</b>`;
                
                actionButton = `<div class="mb-3">
                                    <button class="btn confirm-button">
                                        <a class="links" href="/admin/confirm-payment/${data.id}">Accept payment</a>
                                    </button>
                                    <button class="btn btn-secondary">
                                        <a class="links" href="/admin/delete-payment/${data.id}">Delete payment</a>
                                    </button>
                                </div>`;
            }

            if(flag===2){
                if(data.is_shipped) modalMessage = `This product is on the way`;
                else{
                    modalMessage = `Payment for this order is complete. Customer is waiting for the shipment`;

                    actionButton = `<div class="mb-3">
                                    <button class="btn confirm-button">
                                        <a class="links" href="/admin/make-shipment/${data.id}">Make shipment</a>
                                    </button>`;
                }
                
            }

            let cartList = `<div class="input-group mb-1">
                                <div class="input-group-prepend" style="width: 20%">
                                    <span class="input-group-text center"><b>Product</b></span>
                                </div>
                                <div class="form-control" style="width: 10%;">
                                    <span class="center"><b>Amount</b></span>
                                </div>
                                <div class="form-control" style="width: 10%;">
                                    <span class="center"><b>Price</b></span>
                                </div>
                                <div class="form-control" style="width: 10%;">
                                    <span class="center"><b>Offer</b></span>
                                </div>
                            </div>`

            data.carts.forEach(function(item) {
                cartList += `<div class="input-group mb-1">
                                <div class="input-group-prepend" style="width: 20%">
                                    <span class="input-group-text center">${item.product.title ? item.product.title : 'No title'}</span>
                                </div>
                                <div class="form-control" style="width: 10%;">
                                    <span class="center">${item.amount}</span>
                                </div>
                                <div class="form-control" style="width: 10%;">
                                    <span class="center">${item.product.price}</span>
                                </div>
                                <div class="form-control" style="width: 10%;">
                                    <span class="center">${item.product.offer_price || 0}</span>
                                </div>
                            </div>`;
            });

            let htmlContent = `<div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Make payment</h5>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="item-message mb-3" style="width: 100%">
                                                ${modalMessage}
                                            </div>
                                            ${cartList}
                                            ${actionButton}
                                        </div>
                                    </div>
                                </div>`;

            modal.innerHTML = htmlContent;
            console.log(modal);
        }

        function showCompletedOrder(){
            completedOrderContainer.style.display = 'inline';
            currentOrderContainer.style.display = 'none';
            pendingOrderContainer.style.display = 'none';
        }

        function showCurrentOrder(){
            completedOrderContainer.style.display = 'none';
            currentOrderContainer.style.display = 'inline';
            pendingOrderContainer.style.display = 'none';
        }

        function showPendingOrder(){
            completedOrderContainer.style.display = 'none';
            currentOrderContainer.style.display = 'none';
            pendingOrderContainer.style.display = 'inline';
        }
    </script>
</body>
</html>
