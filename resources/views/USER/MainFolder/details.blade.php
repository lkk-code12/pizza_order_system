@extends('USER.LayoutFolder.master')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-3">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="mb-3">
                            <a href="{{ route('user#home') }}" class="text-decoration-none text-dark">
                                <i class="fa-solid fa-arrow-left-long"></i> Back
                            </a>
                        </div>
                        <div class="carousel-item active text-center">
                            <img class="w-75 h-25" src="{{ asset('storage/' . $pizza->image) }}" alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-3">
                <div class="h-100 bg-light p-30">
                    <input type="hidden" name="" value="{{ Auth::user()->id }}" id="userId">
                    <input type="hidden" name="" value="{{ $pizza->id }}" id="pizzaId">
                    <h3>{{ $pizza->name }}</h3>
                    <small class="pt-1">{{ $pizza->view_count + 1 }} View</small>
                    <h5 class="font-weight-semi-bold mb-4">{{ $pizza->price }} MMK</h5>
                    <p class="mb-4">{{ $pizza->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control border-0 text-center bg-dark text-light"
                                id="orderCount" value="1">

                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning px-3" id="addCartBtn"><i
                                class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-1">
        <h5 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class=" pr-3">You May Also
                Like</span></h5>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($pizzaList as $pizza)
                        <div class="product-item bg-light">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $pizza->image) }}"
                                    style="height: 180px;">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square"
                                        href="{{ route('user#pizzaDetails', $pizza->id) }}"><i
                                            class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">{{ $pizza->name }}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>{{ $pizza->price }} MMK</h5>
                                    {{-- <h6 class="text-muted ml-2"><del>$123.00</del></h6> --}}
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>(99)</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            //increase view count
            // console.log($('#pizzaId').val());
            $.ajax({
                type: 'get', //get or post method?
                url: 'http://127.0.0.1:8000/user/ajax/increase/view/count',
                data: {'productId' : $('#pizzaId').val()},
                dataType: 'json'
            })


            //click add to cart button
            $('#addCartBtn').click(function() {

                $source = {

                    'userId': $('#userId').val(),
                    'pizzaId': $('#pizzaId').val(),
                    'count': $('#orderCount').val()
                }
                // console.log($source);

                $.ajax({
                    type: 'get', //get or post method?
                    url: 'http://127.0.0.1:8000/user/ajax/addToCart',
                    // data : '' if post
                    data: $source,
                    dataType: 'json',
                    success: function(response) {
                        // console.log(response.status);
                        if (response.status == 'complete') {
                            window.location.href = 'http://127.0.0.1:8000/user/home';
                        }
                    }
                })
            })


        })
    </script>
@endsection
