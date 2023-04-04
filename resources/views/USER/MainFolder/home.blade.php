@extends('USER.LayoutFolder.master')

@section('content')
    <div class="row">
        @if (session('messageSent'))
            <div class="col-6 offset-3 mb-2">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fa-solid fa-circle-check"></i>
                        {{ session('messageSent') }} </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
    </div>

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Filter by
                        category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="d-flex align-items-center justify-content-between mb-3 bg-dark text-light px-3 py-1">
                            <label class="label pt-1" for="price-all">Categories</label>
                            <span class="badge border font-weight-normal">{{ count($category) }}</span>
                        </div>
                        <hr>

                        <a href="{{ route('user#home') }}" class="text-dark">
                            <label class="mt-3" for="price-1">View All</label><br>
                        </a>

                        @foreach ($category as $c)
                            <a href="{{ route('user#filter', $c->id) }}" class="text-dark">
                                <label class="mt-3" for="price-1">{{ $c->name }}</label><br>
                            </a>
                        @endforeach

                        <div class="row mt-3">
                            <button class="btn btn-warning">Order</button>
                        </div>
                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->


            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <a href="{{ route('user#cartList') }}" class="me-3">
                                    <button type="button" class="btn btn-dark text-light position-relative">
                                        <i class="fa-solid fa-cart-plus"></i> Cart
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($cart) }}
                                        </span>
                                    </button>
                                </a>

                                <a href="{{ route('user#history') }}">
                                    <button type="button" class="btn btn-dark text-light position-relative">
                                        <i class="fa-solid fa-clock-rotate-left"></i> History
                                        <span
                                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ count($history) }}
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <select name="sorting" class="form-control" id="sortingOption">
                                        <option value="">Sorting</option>
                                        <option value="ascending">A-Z</option>
                                        <option value="decending">Z-A</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="dataList">
                        @if (count($pizza) != 0)
                            @foreach ($pizza as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="myForm">
                                    <div class="product-item bg-light mb-4">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-thumbnail w-100" style="height: 180px;"
                                                src="{{ asset('storage/' . $p->image) }}" alt="">
                                            <div class="product-action">
                                                <a class="btn btn-outline-dark btn-square" href=""><i
                                                        class="fa-solid fa-cart-shopping"></i></a>
                                                <a class="btn btn-outline-dark btn-square"
                                                    href="{{ route('user#pizzaDetails', $p->id) }}"><i
                                                        class="fa-solid fa-circle-info"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center py-4">
                                            <a class="h6 text-decoration-none text-truncate"
                                                href="">{{ $p->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <h5>{{ $p->price }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h2 class="text-center text-light bg-danger p-5">There is no item in this category.</h2>
                        @endif
                    </div>

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('scriptSource')
    <script>
        $(document).ready(function() {

            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();
                // console.log($eventOption);

                if ($eventOption == 'ascending') {
                    $.ajax({
                        type: 'get', //get or post method?
                        url: 'http://127.0.0.1:8000/user/ajax/pizzaList',
                        // data : '' if post
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) { //response == the return data from url
                            // console.log(response);

                            $lists = '';
                            for ($i = 0; $i < response.length; $i++) {
                                // console.log(`${response[$i].name}`);
                                $lists += `
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="myForm">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height : 200px;" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa-solid fa-cart-shopping"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                                // console.log($lists);
                                $('#dataList').html($lists);
                            }
                        }
                    })
                } else if ($eventOption == 'decending') {
                    $.ajax({
                        type: 'get', //get or post method?
                        url: 'http://127.0.0.1:8000/user/ajax/pizzaList',
                        // data : '' if post
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(response) { //response == the return data from url
                            // console.log(response);

                            $lists = '';
                            for ($i = 0; $i < response.length; $i++) {
                                // console.log(`${response[$i].name}`);
                                $lists += `
                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1" id="myForm">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" style="height : 200px;" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa-solid fa-cart-shopping"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i
                                            class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>${response[$i].price}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                                // console.log($lists);
                                $('#dataList').html($lists);
                            }
                        }
                    })
                } else {

                }
            })
        })
    </script>
@endsection
