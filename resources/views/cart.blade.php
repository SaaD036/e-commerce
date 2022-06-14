<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | {{ Auth::user()->first_name }}</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <style>
        .center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            width:100%;
            overflow-y: auto;
        }
        .table-head {
            text-align: center;
            color: white;
        }

        .table-cell {
            text-align: center;
        }

        .amount-container {
            background-color: green;
            padding-right: 20px;
            padding-left: 20px;
            color: white;
        }

        .confirm-button {
            background-color: green;
            color: white;
        }

        .go-to-order {
            background-color: green;
        }

        .link {
            color: white;
            text-decoration: none;
        }

        .empty-cart {
            margin-top: 10px;
            color: green;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
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
        <div style="height:100%; width:100%; margin: 0px 20px 0px 20px">
            <div class="containerjgh" style="height: 90%;">
                @if(count($cartItems) > 0)
                    <table class="table table-striped">     
                        <thead>
                            <tr style="background-color: green;">
                                <th scope="col" class="table-head" style="width: 20%;">Name</th>
                                <th scope="col" class="table-head" style="width: 20%;">Category</th>
                                <th scope="col" class="table-head" style="width: 40%;">Action</th>
                                <th scope="col" class="table-head" style="width: 20%;">Confirm</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td class="table-cell">{{ $item->product_id }}</td>
                                    <td class="table-cell">category</td>
                                    <td class="table-cell">
                                        <button class="btn confirm-button">
                                            <a class="link" href="/cart/remove-one/{{ $item->id}}">-</a>
                                        </button>
                                        <div class="btn amount-container">{{ $item->amount }}</div>
                                        <button class="btn confirm-button">
                                            <a class="link" href="/cart/add-one/{{ $item->id}}">+</a>
                                        </button>
                                    </td>
                                    <td class="table-cell">
                                        <button class="btn confirm-button">
                                            <a href="{{ route('confirm-order') }}" style="text-decoration: none; color: white">Confirm order</a>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                @if(count($cartItems) <= 0)
                    <div class="center" style="width: 100%; height: 100%; flex-direction: column">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="green" class="bi bi-cart2" viewBox="0 0 16 16">
                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                        </svg>
                        <h1 class="empty-cart">Empty Cart</h1>
                    </div>
                @endif
            </div>
            <div class="center">
                <div class="btn go-to-order" style="padding: 10px; ">
                    <a class="link" href="{{ route('show-order') }}">Go to Order Page</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
