@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Create Product</h3>
                            </div>
                            <hr>
                            <form action="{{route('product#create')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">

                                @csrf

                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="productName" type="text" value="{{old('productName')}}" class="form-control @error('productName') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product name ...">
                                    @error('productName')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">Category</label>
                                    <select name="productCategory" class="form-control @error('productCategory') is-invalid @enderror" placeholder="Choose product category ...">
                                        <option value="">Choose Product Category</option>
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('productCategory')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <textarea name="productDescription" class="form-control @error('productDescription') is-invalid @enderror" id="" cols="30" rows="10" placeholder="Enter product description"></textarea>
                                    @error('productDescription')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                    <input id="cc-pament" name="productImage" type="file" value="{{old('productImage')}}" class="form-control @error('productImage') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                    @error('productImage')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                    <input id="cc-pament" name="productPrice" type="number" value="{{old('productPrice')}}" class="form-control @error('productPrice') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter product price">
                                    @error('productPrice')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="">Waiting Time</label>
                                    <input type="number" name="productWaitingTime" class="form-control @error('productWaitingTime') is-invalid @enderror()" value="{{ old('productWaitingTime') }}" placeholder="Enter product waiting time">
                                    @error('productWaitingTime')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mt-3 float-end">
                                    <button id="payment-button" type="submit" class="btn btn-sm btn-primary btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
