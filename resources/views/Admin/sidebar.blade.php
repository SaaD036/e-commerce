<style>
    .body{
        margin: 0px;
        padding: 0px;
    }

    .center{
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sidebar{
        height:100vh;
        width:20vw;
        min-width: 180px;
        background-color:#046db3;
        margin-left: 0px;
        padding: 5px;
    }
    .sub-sidebar{
        height: 50%;
        min-height:300px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .sidebar-element{
        width: 100%;
        height: 45px;
        background-color: #0291f0;
        border-radius: 0px 5px 0px 5px;
        margin-bottom: 10px;
    }
    .sidebar-sub-element{
        height: 45px;
        width:100%;
        width: calc(100%-20px);
        background-color: #0291f0;
        border-radius: 10px 0px 10px 0px;
        margin-bottom: 5px;
        color: #fff;
    }
    .links{
        color: #fff;
        text-decoration: none;
        margin-left: 5px;
    }

    .links:hover {
        color: #fff;
    }

</style>

<div class="sidebar">

    <div style="width: 100%; height:30%; min-height:150px; text-align:center; border-bottom:1px solid #fff">
        <div style="height:60%; width:100%" class="center">
            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#fff" class="bi bi-person-badge" viewBox="0 0 16 16">
                <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0h-7zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492V2.5z"/>
            </svg>
        </div>
        <p style="color:#fff; font-family:Papyrus; font-size:50px">Admin</p>
    </div>
    <div class="sub-sidebar">
        <!-- for home element -->
        <div class="sidebar-element center">
            <svg atyle="margin-left:-10px" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#fff" class="bi bi-house-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
            </svg>
            <a href="{{route('admin-home')}}" class="links">Home</a>
        </div>
        <!-- for order element -->
        
        <div class="sidebar-element center" style="color: #fff; cursor:pointer" onclick="orderDivClose()">
            <svg style="margin-right:5px" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#fff" class="bi bi-wallet2" viewBox="0 0 16 16">
                <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484L5.562 3zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-13z"/>
            </svg>
            <a href="{{ route('order') }}" class="links">Order</a>
        </div>

        <!-- for sale element -->
        <div class="sidebar-element center">
            Sale
        </div>

        <!-- for product element -->
        <div class="sidebar-element center" style="color: #fff; cursor:pointer" onclick="orderProductClose()">
            Product
        </div>
        
        <div id="productDiv" style="width:100%; margin-left:20px; display:none">
            <div class="sidebar-sub-element center">
                <a href="{{ route('create-product') }}" class="links">Create Product</a>
            </div>
            <div class="sidebar-sub-element center">
                <a href="{{ route('edit-product') }}" class="links">Edit Product</a>
            </div>
        </div>
        <!-- for category element -->
        
        <div class="sidebar-element center" style="color: #fff; cursor:pointer" onclick="categoryDivClose()">
            Category
        </div>
        
        <div id="categoryDiv" style="width:100%; margin-left:20px; display:none">
            <div class="sidebar-sub-element center">
                <a href="{{ route('category-create') }}" class="links">Create Category</a>
            </div>
            <div class="sidebar-sub-element center">
                <a href="{{ route('category') }}" class="links">Edit Category</a>
            </div>
        </div>
    </div>

</div>
<script>
    let orderProduct_flag=false;
    let categoryDiv_flag=false;


    function orderProductClose(){
        if(orderProduct_flag){
            document.getElementById("productDiv").style.display = "none";
            orderProduct_flag=false;
        }
        else{
            document.getElementById("productDiv").style.display = "block";
            orderProduct_flag=true;
        }
    }
    function categoryDivClose(){
        if(categoryDiv_flag){
            document.getElementById("categoryDiv").style.display = "none";
            categoryDiv_flag=false;
        }
        else{
            document.getElementById("categoryDiv").style.display = "block";
            categoryDiv_flag=true;
        }
    }
</script>
