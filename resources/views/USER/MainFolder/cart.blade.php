@extends('USER.LayoutFolder.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <th>Product Image</th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </thead>
                    <tbody class="align-middle" id="dataTable">

                        @foreach ($cartList as $c)
                            <tr>
                                <input type="hidden" id="price" value="{{ $c->pizza_price }}">
                                <td><img src="{{ asset('storage/' . $c->product_image) }}" class="card shadow-xl"
                                        style="width: 100px; height:70px;"></td>
                                <td class="align-middle">{{ $c->pizza_name }}
                                    <input type="hidden" id="uniqueId" value="{{ $c->id }}">
                                    <input type="hidden" id="productId" value="{{ $c->product_id }}">
                                    <input type="hidden" id="userId" value="{{ $c->user_id }}">
                                </td>
                                <td class="align-middle" id="pizzaPrice">{{ $c->pizza_price }} MMK</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm border-0 text-center"
                                            id="pizzaQty" value="{{ $c->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-warning btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle" id="total">{{ $c->pizza_price * $c->qty }} MMK</td>
                                <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove" id="btnRemove"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subTotalPrice" value="five">{{ $totalPrice }} MMK</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery Charges</h6>
                            <h6 class="font-weight-medium">3000 MMK</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="totalCost">{{ $totalPrice + 3000 }} MMK</h5>
                        </div>
                        <button class="btn btn-block btn-warning font-weight-bold my-3 py-3" id="orderBtn">Proceed To
                            Checkout</button>
                    </div>
                    <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">Clear Cart</button>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Cart End -->
@endsection

@section('scriptSource')
    <script src="{{ asset('user/js/cart.js') }}"></script>
    <script>
        $('#orderBtn').click(function() {

            $orderList = [];

            $random = Math.floor(Math.random() * 10000000001);
            // console.log($random);

            $('#dataTable tr').each(function(index, row) {
                $orderList.push({
                    'user_id': $(row).find('#userId').val(),
                    'product_id': $(row).find('#productId').val(),
                    'qty': $(row).find('#pizzaQty').val(),
                    'total': parseInt($(row).find('#total').text().replace('kyats', '')),
                    'order_code': 'POS' + $random
                });
            });

            // console.log($orderList);

            $.ajax({
                type: 'get', //get or post method?
                url: 'http://127.0.0.1:8000/user/ajax/order',
                // data : '' if post
                data: Object.assign({}, $orderList),
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    if (response.status == 'true') {
                        window.location.href = 'http://127.0.0.1:8000/user/home';
                    }
                }
            })
        })

        //when click clear button
        $('#clearBtn').click(function() {
            $('#dataTable tbody tr').remove();
            $('#subTotalPrice').text(0 + ' MMK');
            $('#totalCost').text(3000 + ' MMK');

            $.ajax({
                type: 'get', //get or post method?
                url: 'http://127.0.0.1:8000/user/ajax/clear/cart',
                // data : '' if post
                dataType: 'json'
            })
        })

        //plus btn
        $('.btn-plus').click(function() {
            $parentNode = $(this).parents('tr');
            $price = Number($parentNode.find('#price').text().replace('kyats', ''));
            $qty = Number($parentNode.find('#pizzaQty').val());
            $total = $price * $qty;
            $parentNode.find('#subTotalPrice').html(`${$total} MMK`);

            summaryCalculation();
        })

        //minus btn
        $('.btn-minus').click(function() {
            $parentNode = $(this).parents('tr');
            $price = Number($parentNode.find('#price').text().replace('kyats', ''));
            $qty = Number($parentNode.find('#pizzaQty').val());
            $total = $price * $qty;
            $parentNode.find('#subTotalPrice').html(`${$total} MMK`);

            summaryCalculation();
        })

        //when click cross button
        $('.btnRemove').click(function() {
            // console.log('remove');
            $parentNode = $(this).parents('tr');
            $productId = $parentNode.find('#productId').val();
            $uniqueId = $parentNode.find('#uniqueId').val();

            $.ajax({
                type: 'get', //get or post method?
                url: 'http://127.0.0.1:8000/user/ajax/clear/current/product',
                // data : '' if post
                data: {
                    'productId': $productId,
                    'uniqueId': $uniqueId
                },
                dataType: 'json'
            })
            $parentNode.remove();

            summaryCalculation();
        })

        function summaryCalculation() {
            $totalPrice = 0;
            $('#dataTable tr').each(function(index, row) {
                // console.log(index, row);
                $price = Number($(row).find('#total').text().replace('MMK', ''));
                $totalPrice += $price;
            })

            $('#subTotalPrice').html(Number($totalPrice) + ` MMK`);

            $('#totalCost').html(Number($totalPrice) + 3000 + ` MMK`);
        }
    </script>
@endsection
