@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Product</h3>
                            </div>

                            <hr>

                            <form action="{{ route('product#update', $products->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-4">
                                        <div class="row justify-content-center">
                                            <input type="hidden" name="productId" value="{{ $products->id }}">
                                            <img src="{{ asset('storage/' . $products->image) }}"
                                                style="width: 125px; height:100px;" />
                                        </div>

                                        <div class="row mt-5">
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mt-5">
                                            <button type="submit" class="btn btn-dark text-light">Update</button>
                                        </div>
                                    </div>

                                    <div class="col-8">
                                        <div class="row col-10 justify-content-center">

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                                <input id="cc-pament" value="{{ old('productName', $products->name) }}"
                                                    name="productName" type="text"
                                                    class="form-control @error('productName') is-invalid @enderror"
                                                    aria-required="true" aria-invalid="false" placeholder="new name...">
                                                @error('productName')
                                                    <div class="invalid-feedback">
                                                        <small class="text-danger">{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Category</label>
                                                <select name="productCategory" id=""
                                                    value="{{ old('productCategory', $products->category_id) }}"
                                                    class="form-control @error('productCategory') is-invalid @enderror">
                                                    <option value="">Choose category</option>
                                                    @foreach ($categories as $c)
                                                        <option value="{{ $c->id }}"
                                                            @if ($products->category_id == $c->id) selected @endif>
                                                            {{ $c->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('productCategory')
                                                    <div class="invalid-feedback">
                                                        <small class="text-danger">{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Description</label>
                                                <textarea name="productDescription" class="form-control @error('productDescription') is-invalid @enderror"
                                                    cols="30" rows="10" placeholder="Enter description...">{{ old('productDescription', $products->description) }}</textarea>
                                                @error('productDescription')
                                                    <div class="invalid-feedback">
                                                        <small class="text-danger">{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Price</label>
                                                <input id="cc-pament" value="{{ old('productPrice', $products->price) }}"
                                                    name="productPrice" type="number"
                                                    class="form-control @error('productPrice') is-invalid @enderror"
                                                    aria-required="true" aria-invalid="false"
                                                    placeholder="Enter new price...">
                                                @error('productPrice')
                                                    <div class="invalid-feedback">
                                                        <small class="text-danger">{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Waiting Time /
                                                    Mins</label>
                                                <input id="cc-pament"
                                                    value="{{ old('productWaitingTime', $products->waiting_time) }}"
                                                    name="productWaitingTime" type="number"
                                                    class="form-control @error('productWaitingTime') is-invalid @enderror"
                                                    aria-required="true" aria-invalid="false" placeholder="Waiting time...">
                                                @error('productWaitingTime')
                                                    <div class="invalid-feedback">
                                                        <small class="text-danger">{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">View Count</label>
                                                <input id="cc-pament" value="{{ $products->view_count }}"
                                                    name="productViewCount" type="number"
                                                    class="form-control @error('productViewCount') is-invalid @enderror"
                                                    aria-required="true" aria-invalid="false" disabled>
                                                @error('productViewCount')
                                                    <div class="invalid-feedback">
                                                        <small class="text-danger">{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Created Date</label>
                                                <input id="cc-pament"
                                                    value="{{ $products->created_at->format('y F j') }}"
                                                    name="productCreatedAt" type="text" class="form-control"
                                                    aria-required="true" aria-invalid="false" disabled>
                                            </div>

                                        </div>
                                    </div>
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
