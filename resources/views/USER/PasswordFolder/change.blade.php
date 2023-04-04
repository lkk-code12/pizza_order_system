@extends('USER.LayoutFolder.master')

@section('content')
    <div class="row">
        <div class="col-6 offset-3">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Password</h3>
                                </div>

                                @if (session('changeSuccess'))
                                    <div class="col-12">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong><i class="fa-solid fa-circle-check"></i>
                                                {{ session('changeSuccess') }} </strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif

                                @if (session('notMatch'))
                                    <div class="col-12">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong><i class="fa-solid fa-triangle-exclamation"></i>
                                                {{ session('notMatch') }} </strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif

                                <hr>
                                <form action="{{ route('user#changePassword') }}" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Old Password</label>
                                        <input id="cc-pament" name="oldPassword" type="password"
                                            class="form-control @error('oldPassword') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="old password...">
                                        @error('oldPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @if (session('notMatch'))
                                            <div class="invalid-feedback">
                                                {{ session('notMatch') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">New Password</label>
                                        <input id="cc-pament" name="newPassword" type="password"
                                            class="form-control @error('newPassword') is-invalid @enderror" aria-required="true"
                                            aria-invalid="false" placeholder="new password...">
                                        @error('newPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="cc-payment" class="control-label mb-1">Confirm New Password</label>
                                        <input id="cc-pament" name="confirmNewPassword" type="password"
                                            class="form-control @error('confirmNewPassword') is-invalid @enderror"
                                            aria-required="true" aria-invalid="false" placeholder="confirm new password...">
                                        @error('confirmNewPassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-dark btn-block">
                                            <i class="fa-solid fa-key"></i>
                                            <span id="payment-button-amount">Change Password</span>
                                            {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
