@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="table-responsive table-responsive-data2">
                        <a href="{{ route('admin#orderList') }}" class="text-decoration-none">
                            <i class="fa-solid fa-arrow-left"></i> Back
                        </a>

                        <div class="card mt-3">
                            <div class="row text-center pt-3">
                                <h5><u>Order Informations - </u><span class="text-warning"> Delivery Charges Included</span></h5>
                            </div>
                            <div class="row text-center py-3">
                                <div class="col-3">
                                    Customer Name : <br><b>{{ strtoupper($orderList[0]->user_name) }}</b>
                                </div>
                                <div class="col-3">
                                    Order Code : <br><b>{{ $orderList[0]->order_code }}</b>
                                </div>
                                <div class="col-3">
                                    Order Date : <br><b>{{ $orderList[0]->created_at->format('Y F j') }}</b>
                                </div>
                                <div class="col-3">
                                    Total : <br><b>{{ $order->total_price }}</b>
                                </div>
                            </div>
                        </div>

                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Order Id</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($orderList as $list)
                                    <tr class="tr-shadow">
                                        <td>{{ $list->id }}</td>
                                        <td>
                                            <img src="{{ asset('storage/'.$list->product_image) }}" class="img-thumbnail" style="width: 150px; height:100px">
                                        </td>
                                        <td>{{ $list->product_name }}</td>
                                        <td>{{ $list->qty }}</td>
                                        <td>{{ $list->total }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
