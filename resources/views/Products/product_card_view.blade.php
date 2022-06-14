<style>
    .image-slider{
        height: 30%;
        width: 100%;
    }
    .product-container{
        outline: none;
        border: 1px solid green;
    }
</style>

<div class="col-sm-3">
    <div class="card product-container" style="width: 18rem; margin:10px">

        <!-- image slider -->
        <!-- <div class="carousel slide image-slider" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="https://www.tutorialrepublic.com/lib/images/bootstrap-4/bootstrap-carousel.png" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="https://i.stack.imgur.com/pvXgA.png" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="http://formoid.com/articles/data/upload/2017/04/onlyslides1.jpg" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div> -->

        <!-- product description -->
        <div class="card-body">
            <p class="card-text">{{ substr($product->description, 0, 150) }}</p>
        </div>
        <div style="width:100%; display:flex; justify-content:center; padding:10px">
            <form action="/cart/{{ $product->id }}" method="post">
            {{ csrf_field() }}
                <button class="btn btn-primary" style="background-color:green; border:none">
                    <a href ="{{ route('show.carts') }}/{{$product->id}}" style="text-decoration: none; color: white">Add to cart</a>
                </button>
            </form>
        </div>
    </div>
</div>
