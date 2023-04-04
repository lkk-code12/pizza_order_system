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
                                <h3 class="text-center title-2">Change Role</h3>
                            </div>

                            <hr>

                            <form action="{{ route('admin#change', $account->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-4">

                                        <div class="card-title">
                                            <a href="{{ route('admin#list') }}" class="text-decoration-none text-dark">
                                                <i class="fa-solid fa-arrow-left-long" onclick="history.back()"></i> Back
                                            </a>
                                        </div>

                                        <div class="row justify-content-center">
                                            @if ($account->image == null)
                                                @if ($account->gender == 'male')
                                                    <img src="{{ asset('images/defaultUser.png') }}"
                                                        style="width: 125px; height:100px;" />
                                                @else
                                                    <img src="{{ asset('images/femaleProfile.jpg') }}"
                                                        style="width: 125px; height:100px;" />
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/' . $account->image) }}"
                                                    style="width: 170px; height:100px;" />
                                            @endif
                                        </div>

                                        <div class="row mt-5">
                                            <input disabled type="file" name="image"
                                                class="form-control @error('image') is-invalid @enderror">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    <small class="text-danger">{{ $message }}</small>
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="row mt-5">
                                            <button type="submit" class="btn btn-dark text-light">Change Role</button>
                                        </div>
                                    </div>

                                    <div class="col-8">
                                        <div class="row col-10 justify-content-center">

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Name</label>
                                                <input disabled id="cc-pament" value="{{ old('userName', $account->name) }}"
                                                    name="userName" type="text"
                                                    class="form-control @error('userName') is-invalid @enderror"
                                                    aria-required="true" aria-invalid="false" placeholder="new name...">
                                                @error('userName')
                                                    <div class="invalid-feedback">
                                                        <small class="text-danger">{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Role</label>
                                                {{-- <input id="cc-pament" value="{{ old('userRole', $account->role) }}"
                                                name="userRole" type="text"
                                                class="form-control @error('userRole') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" placeholder="new role..."> --}}
                                                <select name="role" class="form-control">
                                                    <option value="admin"
                                                        @if ($account->role == 'admin') selected @endif>Admin</option>
                                                    <option value="user"
                                                        @if ($account->role == 'user') selected @endif>User</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Email</label>
                                                <input disabled id="cc-pament"
                                                    value="{{ old('userEmail', $account->email) }}" name="userEmail"
                                                    type="text"
                                                    class="form-control @error('userEmail') is-invalid @enderror"
                                                    aria-required="true" aria-invalid="false" placeholder="new email...">
                                                @error('userEmail')
                                                    <div class="invalid-feedback">
                                                        <small class="text-danger">{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Phone</label>
                                                <input disabled id="cc-pament"
                                                    value="{{ old('userPhone', $account->phone) }}" name="userPhone"
                                                    type="text"
                                                    class="form-control @error('userPhone') is-invalid @enderror"
                                                    aria-required="true" aria-invalid="false" placeholder="new phone...">
                                                @error('userPhone')
                                                    <div class="invalid-feedback">
                                                        <small class="text-danger">{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Gender</label>
                                                <select name="userGender" id=""
                                                    value="{{ old('userGender', $account->gender) }}"
                                                    class="form-control @error('userGender') is-invalid @enderror" disabled
                                                    disabled disabled disabled disabled>
                                                    <option value="">Choose gender</option>
                                                    <option value="male"
                                                        @if ($account->gender == 'male') selected @endif>Male</option>
                                                    <option value="female"
                                                        @if ($account->gender == 'female') selected @endif>Female</option>
                                                </select>
                                                @error('userGender')
                                                    <div class="invalid-feedback">
                                                        <small class="text-danger">{{ $message }}</small>
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="cc-payment" class="control-label mb-1">Address</label>
                                                <textarea disabled name="userAddress" class="form-control" cols="30" rows="10">{{ old('userAddress', $account->address) }}</textarea>
                                                @error('userAddress')
                                                    <div class="invalid-feedback">
                                                        <small class="text-danger">{{ $message }}</small>
                                                    </div>
                                                @enderror
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
