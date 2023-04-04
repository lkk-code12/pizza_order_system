@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Order List</h2>
                            </div>
                        </div>
                    </div>

                    {{-- Search Box --}}
                    <div class="row text-center my-3">
                        <div class="col-4">
                            <h3>Total = <span class="text-success">{{ count($order) }}</span></h3>
                        </div>
                        <div class="col-4">
                            @if (request('key') == null)
                                <b>Search Key : <i class="fa-solid fa-face-smile-wink text-success"></i></b>
                            @else
                                <b>Search Key : </b><i class="text-success">{{ request('key') }}</i>
                            @endif
                        </div>
                        <div class="col-4">
                            <form action="{{ route('product#list') }}" method="get">
                                @csrf
                                <div class="d-flex">
                                    <input type="search" name="key" id="" class="form-control"
                                        placeholder="Search" value="{{ request('key') }}">
                                    <button class="btn bg-success text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="{{ route('admin#changeStatus') }}" method="post">
                        @csrf
                        <div class="row">

                            <div class="input-group mx-3">
                                <select name="orderStatus" id="orderStatus" class="form-control">
                                    <option value="">All</option>
                                    <option value="0" @if (request('orderStatus') == '0') selected @endif>Pending
                                    </option>
                                    <option value="1" @if (request('orderStatus') == '1') selected @endif>Accept</option>
                                    <option value="2" @if (request('orderStatus') == '2') selected @endif>Reject</option>
                                </select>
                                <div class="input-group-append">
                                    <button type="submit" class="btn sm bg-dark text-white">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>


                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>User Name</th>
                                    <th>Order Date</th>
                                    <th>Order Code</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($order as $ord)
                                    <tr class="tr-shadow">

                                        <input type="hidden" id="orderId" value="{{ $ord->id }}">
                                        <td>{{ $ord->user_id }}</td>
                                        <td>{{ $ord->user_name }}</td>
                                        <td>{{ $ord->created_at->format('Y F j') }}</td>
                                        <td>
                                            <a href="{{ route('admin#listInfo',$ord->order_code) }}" class="text-decoration-none text-danger">
                                                {{ $ord->order_code }}
                                            </a>
                                        </td>
                                        <td id="amount">{{ $ord->total_price }} MMK</td>
                                        <td>
                                            <select name="status" id="" class="form-control statusChange">
                                                <option value="0" @if ($ord->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($ord->status == 1) selected @endif>
                                                    Accept</option>
                                                <option value="2" @if ($ord->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>
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

@section('scriptSection')

    <script>
        $(document).ready(function() {
            // $('#orderStatus').change(function() {
            //     $status = $('#orderStatus').val();
            //     // console.log($status);

            //     $.ajax({
            //         type: 'get', //get or post method?
            //         url: 'http://127.0.0.1:8000/orders/ajax/status',
            //         data: {
            //             'status': $status
            //         },
            //         dataType: 'json',
            //         success: function(response) {
            //             $lists = '';
            //             for ($i = 0; $i < response.length; $i++) {

            //                 $dbDate = new Date(response[$i].created_at);
            //                 $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug',
            //                     'Sep', 'Oct', 'Nov', 'Dec'
            //                 ];
            //                 $finalDate = $months[$dbDate.getMonth()] + '-' + $dbDate.getDate() +
            //                     '-' + $dbDate.getFullYear();

            //                 if (response[$i].status == 0) {
            //                     $statusMessage = `
        //                         <select name="status" class="form-control statusChange">
        //                             <option value="0" selected>Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                     `;
            //                 } else if (response[$i].status == 1) {
            //                     $statusMessage = `
        //                         <select name="status" class="form-control statusChange">
        //                             <option value="0">Pending</option>
        //                             <option value="1" selected>Accept</option>
        //                             <option value="2">Reject</option>
        //                         </select>
        //                     `;
            //                 } else {
            //                     $statusMessage = `
        //                         <select name="status" class="form-control statusChange">
        //                             <option value="0">Pending</option>
        //                             <option value="1">Accept</option>
        //                             <option value="2" selected>Reject</option>
        //                         </select>
        //                     `;
            //                 }
            //                 $lists += `
        //                     <tr class="tr-shadow">
        //                         <input type="hidden" id="orderId" value="${response[$i].id}">
        //                         <td> ${response[$i].user_id} </td>
        //                         <td> ${response[$i].user_name} </td>
        //                         <td> ${$finalDate} </td>
        //                         <td> ${response[$i].order_code} </td>
        //                         <td> ${response[$i].total_price}  MMK</td>
        //                         <td> ${$statusMessage} </td>
        //                     </tr>
        //                     `;
            //                 $('#dataList').html($lists);
            //             }
            //         }
            //     })
            // })

            //change status
            $('.statusChange').change(function() {

                $currentStatus = $(this).val();
                $parentNode = $(this).parents('tr');
                // console.log($parentNode.find('#amount').html());

                $orderId = $parentNode.find('#orderId').val();
                // console.log($orderId);

                $data = {
                    'status': $currentStatus,
                    'orderId': $orderId
                }

                console.log($data);

                $.ajax({
                    type: 'get', //get or post method?
                    url: 'http://127.0.0.1:8000/orders/ajax/change/status',
                    data: $data,
                    dataType: 'json'
                })

            })
        })
    </script>
@endsection
