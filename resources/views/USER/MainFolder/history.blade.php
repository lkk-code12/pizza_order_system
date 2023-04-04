@extends('USER.LayoutFolder.master')

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5" style="height: 300px;">
            <div class="col-lg-8 offset-2 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-3">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($order as $o)
                            <tr>
                                <td class="align-middle">{{ $o->created_at->format('F j Y') }}</td>
                                <td class="align-middle">{{ $o->order_code }}</td>
                                <td class="align-middle">{{ $o->total_price }} MMK</td>
                                <td class="align-middle">
                                    @if ($o->status == 0)
                                        <div class="text-warning shadow-sm py-2"><i class="fa-regular fa-clock"></i> Pending</div>
                                    @elseif ($o->status == 1)
                                        <div class="text-success shadow-sm py-2"><i class="fa-solid fa-check"></i> Success</div>
                                    @elseif ($o->status == 2)
                                        <div class="text-danger shadow-sm py-2"><i class="fa-solid fa-triangle-exclamation"></i> Reject</div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <span>
                    {{ $order->links() }}
                </span>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
