@extends('USER.LayoutFolder.master')

@section('content')
    <div class="row">
        <h3 class="text-center mb-3">Contact Form</h3>
        <div class="col-4 offset-4 bg-warning">
            <form action="{{ route('user#sendMessage') }}" method="post">
                @csrf
                <label for="userName" class="mt-2">Name</label>
                <input type="text" name="userName" class="form-control shadow-sm mb-2" id="userName">
                <label for="userEmail">Email</label>
                <input type="email" name="userEmail" class="form-control shadow-sm mb-2" id="userEmail">
                <label for="userMessage">Your Message</label>
                <textarea name="userMessage" class="form-control shadow-sm mb-3" id="userMessage" cols="30" rows="5"></textarea>
                <a href="">
                    <button type="submit" class="btn btn-sm bg-dark text-light px-3 float-end mb-2">Send</button>
                </a>
            </form>
        </div>
    </div>
@endsection
