@extends('layouts.app')

@section('content')
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators carousel-bar">
                      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                @foreach($product_images as $product_image)
                @if($product_image->product_id==$productDetails->id)
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="../storage/images/{{$product_image->path}}" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="../storage/images/{{$product_image->path}}" alt="Second slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="../storage/images/{{$product_image->path}}" alt="Third slide">
                      </div>
                 @endif
                 @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <div class="single-product-details">
                    <h2>{{$productDetails->name}}</h2>
                    <h5> <del>$ 60.00</del> ${{$productDetails->price}}</h5>
                            <h4>Short Description:</h4>
                            <p>{{$productDetails->description}} </p>
                            <ul class="ul-style">
                                <li>
                                    <div class="form-group size-st">
                                        <label class="size-label">Size</label>
                                        <select id="basic" class="selectpicker show-tick form-control">
                                <option value="0">Size</option>
                                <option value="0">S</option>
                                <option value="1">M</option>
                                <option value="1">L</option>
                                <option value="1">XL</option>
                                <option value="1">XXL</option>
                                <option value="1">3XL</option>
                                <option value="1">4XL</option>
                            </select>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-group quantity-box">
                                        <label class="control-label">Quantity</label>
                                        <input class="form-control" value="0" min="0" max="20" type="number">
                                    </div>
                                </li>
                            </ul>

                            <div class="price-box-bar">
                                <div class="cart-and-bay-btn">
                                    <a class="btn hvr-hover" data-fancybox-close="" href="#">Buy New</a>
{{--                                    <a class="btn hvr-hover" data-fancybox-close="" href="{{ url('checkoutProduct/' .$productDetails->id)}}">Buy New</a>--}}
                                    <a class="btn hvr-hover" data-fancybox-close="" href="#">Add to cart</a>
                                </div>
                            </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
