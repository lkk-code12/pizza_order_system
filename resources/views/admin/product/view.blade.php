@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">
            <div class="col-6 offset-7 mb-1">
                @if (session('updateSuccess'))
                    <div class="col-7">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fa-solid fa-circle-xmark"></i>
                                {{ session('updateSuccess') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                {{-- <a href="{{ route('product#list') }}" class="text-decoration-none text-dark"> --}}
                                <i class="fa-solid fa-arrow-left-long" onclick="history.back()"></i> Back
                                {{-- </a> --}}
                                <h3 class="text-center title-2">Product Description</h3>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-4">
                                    <img src="{{ asset('storage/' . $products->image) }}" alt="">
                                </div>
                                <div class="col-8">
                                    <div class="mb-3 fs-6">
                                        <h3 class="text-warning mb-2">{{ $products->name }}</h3>
                                        <h5 class="mb-2">Category ID : {{ $products->category_id }}</h5>
                                        <span class="bg-dark text-light px-2 py-1"><i
                                                class="fa-solid fa-money-check-dollar me-2"></i>{{ $products->price }}
                                            MMK</span>
                                        <span class="bg-dark text-light px-2 py-1"><i
                                                class="fa-solid fa-hourglass-half me-2"></i>{{ $products->waiting_time }}
                                            mins</span>
                                        <span class="bg-dark text-light px-2 py-1"><i
                                                class="fa-solid fa-eye me-2"></i>{{ $products->view_count }} Views</span><br>
                                        <span class="bg-dark text-light px-2 py-1"><i
                                                class="fa-solid fa-folder-closed me-2 mt-3"></i>{{ $products->category_name }}</span>
                                        <span class="bg-dark text-light px-2 py-1"><i
                                                class="fa-solid fa-calendar-check me-2 mt-3"></i></i>{{ date('Y M d', strtotime($products->created_at)) }}</span>
                                    </div>
                                    <h5 class="mt-4"><i class="fa-solid fa-print me-2"></i>Detail</h5>
                                    <p>
                                        {{ $products->description }}
                                    </p>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="text-center offset-5">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn btn-dark text-light">Edit Profile</button>
                                    </a>
                                </div>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
