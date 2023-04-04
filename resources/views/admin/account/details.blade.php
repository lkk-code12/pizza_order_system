@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="row">
            <div class="mb-1">
                @if (session('updateSuccess'))
                    <div class="col-4 offset-4">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><i class="fa-regular fa-circle-check"></i>
                                {{ session('updateSuccess') }} </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Information</h3>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-3 offset-1">
                                    @if (Auth::user()->image == null)
                                        <img src="{{ asset('images/defaultUser.png') }}" />
                                    @else
                                        <img src="{{ asset('storage/'.Auth::user()->image) }}" />
                                    @endif
                                </div>
                                <div class="col-7 offsset-1 ms-5">
                                    Name : <h4> {{ Auth::user()->name }} </h4>
                                    Email : <h4> {{ Auth::user()->email }} </h4>
                                    Phone : <h4> {{ Auth::user()->phone }} </h4>
                                    Gender : <h4> {{ Auth::user()->gender }} </h4>
                                    Address : <h4> {{ Auth::user()->address }} </h4>
                                    Joined Data : <h4> {{ Auth::user()->created_at->format('Y F j') }} </h4>
                                </div>
                            </div>

                            <div class="row">
                                <div class="text-center offset-5">
                                    <a href="{{ route('admin#edit') }}">
                                        <button class="btn btn-dark text-light">Edit Profile</button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
