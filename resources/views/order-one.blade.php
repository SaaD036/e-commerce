<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order | {{ Auth::user()->first_name }}</title>
    
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

        .container {
            width: 100%;
            height: 100%;
            overflow-y: auto;
        }

        .item-message {
            height: 10%;
            width: 80%;
            background-color: #F8F8F8;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
        }

        .item-box {
            height: 80%;
            width: 80%;
            background-color: #F8F8F8;
            border-radius: 10px;
            padding: 10px;
        }

        .info-pane {
            width: 30%;
            background-color: green;
            border-radius: 15px;
            color: white;
            text-align: center;
        }

        .button {
            background-color: green;
            float: right;
            color:white
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
        <div class="container center"  style="flex-direction: column;">
            <div class="item-message"><b>{{ $message }}</b></div>
            <div class="item-box mt-2">
                <div style="padding: 0px 10px 10px 10px; display: flex">
                    <div style="width: 50%" class="center">
                        <div class="info-pane"><h2>Total</h2> <h4>{{ $total_price }}</h4></div>
                    </div>
                    
                    <div style="width: 50%" class="center">
                        <div class="info-pane"><h2>Item</h2> <h4>{{ $total_item }}</h4></div>
                    </div>
                </div>

                <div class="input-group mb-1">
                    <div class="input-group-prepend" style="width: 20%">
                        <span class="input-group-text center"><b>Product name</b></span>
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
                </div>

                @foreach($carts as $cart)
                    <div class="input-group mb-1">
                        <div class="input-group-prepend" style="width: 20%">
                            <span class="input-group-text center">{{ $cart->product->title }}</span>
                        </div>
                        <div class="form-control" style="width: 10%;">
                            <span class="center">{{ $cart->amount }}</span>
                        </div>
                        <div class="form-control" style="width: 10%;">
                            <span class="center">{{ $cart->product->price }}</span>
                        </div>
                        <div class="form-control" style="width: 10%;">
                            <span class="center">{{ $cart->product->offer_price ? $cart->product->offer_price : 0 }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="item-message mt-2 mb-2" style="background-color: transparent">
                @if($order->is_completed)
                    <button class="btn button" data-toggle="modal" data-target="#exampleModalLong" disabled>
                        Make payment
                    </button>
                @endif

                @if(!$order->is_completed)
                    <button class="btn button" data-toggle="modal" data-target="#exampleModalLong">
                        Make payment
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Make payment</h5>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                <div class="modal-body">
                    <div class="item-message mb-3" style="width: 100%">
                        Your total payment is <b>{{ $total_price }}</b> BDT
                    </div>
                    <form action="/payment/{{ $order->id }}" method="POST">
                        {{ csrf_field() }}

                        <div class="input-group mb-1">
                            <div class="input-group-prepend" style="width: 20%">
                                <span class="input-group-text center">TrX ID</span>
                            </div>
                            <input type="text" class="form-control" name="transaction_id" placeholder="Transaction ID" required>
                        </div>
                        <div class="input-group mb-1">
                            <div class="input-group-prepend" style="width: 20%">
                                <span class="input-group-text center">Method</span>
                            </div>
                            <select class="form-control" name="method" required>
                                <option value="">Select a method</option>
                                <option value="bkash">BKash</option>
                                <option value="nagad">Nagad</option>
                                <option value="upay">Upay</option>
                            </select>
                        </div>
                        <input type="submit" class="btn button" value="Submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
