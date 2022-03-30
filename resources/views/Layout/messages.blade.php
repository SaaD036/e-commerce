@if($errors->any())
<div id="error_message" style="background-color:#d9e3fc; border-radius:10px" class="alert alert-warning alert-dismissible fade show" role="alert">
    <div style="display: flex">
        <h3 style="width:100%; color:red;">Error!!</h3>
        <button onclick="closeError()" style="float:right; background:none; border:none; color:blue" type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @foreach($errors->all() as $error)
    <div style="width:100%; background-color:#baceff; border-radius:5px; margin-bottom:3px; padding:3px; color:#fff">
        {{$error}}
    </div>
    @endforeach
</div>
@endif

<script>
    function closeError(){
        document.getElementById('error_message').style.display = "none";
    }
</script>
