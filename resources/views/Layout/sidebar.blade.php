<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        .center{
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .side-element{
            height: 40px;
            border-radius: 5px;
            background-color: #029920;
            margin:2px 10px 2px 10px;
            text-align: center;
            transform: 0.5;
        }

        .side-element:hover{
            background-color: #0acf31;
        }

        .side-element a{
            color: #fff;
            text-decoration: none;
        }

        .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .openbtn:hover {
            background-color: #444;
        }

        /* Style page content - use this if you want to push the page content to the right when you open the side navigation */
        #main {
            transition: margin-left .5s; /* If you want a transition effect */
            padding: 20px;
        }

        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
            .sidebar {padding-top: 15px;}
            .sidebar a {font-size: 18px;}
        }
    </style>
</head>
<body>
    <div id="mySidebar" style="height:100%; width:0px; display:none; background-color:#05a124; border-radius:0px 10px 10px 0px; transition:0.5">
        <div style="height:30px" onclick="closeNav()">
            <div style="float:right">
                <button style="background-color:transparent; border:none">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-x-octagon" viewBox="0 0 16 16">
                        <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg>
                </button>
            </div>
        </div>
        <div class="side-element center">
            <a href="#">About</a><br>
        </div>
        <div class="side-element center">
            <a href="#">Services</a><br>
        </div>
        <div class="side-element center">
            <a href="#">Clients</a><br>
        </div>
        <div class="side-element center">
            <a href="#">Contact</a><br>
        </div>
        <div class="side-element center">
            <svg style="margin-right: 5px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#fff" class="bi bi-person-badge" viewBox="0 0 16 16">
                <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
            </svg>
            <a href="{{ route('admin-home') }}">Admin</a><br>
        </div>
    </div>
    <button id="button"; style="background-color:transparent; border:none" onclick="openNav()">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#05a124" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
        </svg>
    </button>
</body>
</html>

<script>
    function openNav() {
        document.getElementById("mySidebar").style.width = "250px";
        document.getElementById("button").style.display = "none";
        document.getElementById("mySidebar").style.display = "block";
    }

    function closeNav() {
        document.getElementById("mySidebar").style.display = "none";
        document.getElementById("button").style.display = "block";
    }
</script>
