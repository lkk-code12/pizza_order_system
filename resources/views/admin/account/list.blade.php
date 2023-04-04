@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    {{-- @if (count($categories) != 0) --}}
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- @if (session('categorySuccess'))
                                    <div class="col-4 offset-8">
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong><i class="fa-solid fa-circle-check"></i>
                                                {{ session('categorySuccess') }} </strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif --}}

                                @if (session('deleteSuccess'))
                                    <div class="col-4 offset-8">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong><i class="fa-solid fa-circle-xmark"></i>
                                                {{ session('deleteSuccess') }} </strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif


                                <div class="row text-center my-3">
                                    <div class="col-4">
                                        <h3>Total <span class="text-success">( {{ $admin->total() }} )</span></h3>
                                    </div>
                                    <div class="col-4">
                                        @if (request('key') == null)
                                            <b>Search Key : <i class="fa-solid fa-face-smile-wink text-success"></i></b>
                                        @else
                                            <b>Search Key : </b><i class="text-success">{{ request('key') }}</i>
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        <form action="{{ route('admin#list') }}" method="get">
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

                                @foreach ($admin as $a)
                                    <tr class="tr-shadow">

                                        <input type="hidden" id="userId" value="{{ $a->id }}">

                                        <td>
                                            @if ($a->image == null && $a->gender == 'male')
                                                <img src="{{ asset('images/defaultUser.png') }}" width="70px"
                                                    height="70px">
                                            @elseif ($a->image == null && $a->gender == 'female')
                                                <img src="{{ asset('images/femaleProfile.jpg') }}" width="70px"
                                                    height="70px">
                                            @else
                                                <img src="{{ asset('storage/' . $a->image) }}" width="70px"
                                                    height="70px">
                                            @endif
                                        </td>
                                        <td>{{ $a->name }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>{{ $a->gender }}</td>
                                        <td>{{ $a->phone }}</td>
                                        <td>{{ $a->address }}</td>

                                        <td class="col-3">
                                            {{-- <div class="table-data-feature"> --}}
                                            {{-- @if (Auth::user()->id == $a->id)
                                                @else --}}
                                            {{-- <a
                                                        href="@if (Auth::user()->id == $a->id) #
                                                    @else
                                                        {{ route('admin#changeRole', $a->id) }} @endif">
                                                        <button class="item ml-2" data-toggle="tooltip" data-placement="top"
                                                            title="Change role">
                                                            <i class="fa-solid fa-user-plus"></i>
                                                        </button>
                                                    </a> --}}

                                            {{-- <select class="me-3" id="changeAdminRole">
                                                        <option value="admin">Admin</option>
                                                        <option value="user">User</option>
                                                    </select> --}}

                                            {{-- <a
                                                        href="@if (Auth::user()->id == $a->id) #
                                                    @else
                                                        {{ route('admin#delete', $a->id) }} @endif">
                                                        <button class="item ml-2" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a> --}}
                                            {{-- @endif --}}
                                            {{-- </div> --}}

                                            @if (Auth::user()->id == $a->id)
                                            @else
                                                <select name="" class="form-control changeStatus" id="changeStatus">
                                                    <option value="user"
                                                        @if ($a->role == 'user') selected @endif>user</option>
                                                    <option value="admin"
                                                        @if ($a->role == 'admin') selected @endif>admin</option>
                                                </select>
                                            @endif

                                        </td>

                                        {{-- <td>
                                            <div class="table-data-feature">
                                                <a href="{{ route('a#edit', $a->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('a#delete', $a->id) }}">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Delete">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- for searching --}}
                        <div class="mt-3">
                            {{ $admin->links() }}
                            {{-- {{ $categories->appends(request()->query())->links() }} --}}
                        </div>
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
            // $('#changeAdminRole').change(function() {
            //     $adminRole = $(this).val();
            //     // console.log($adminRole);
            //     $parentStatus = $(this).parents('tr');
            //     // console.log($parentStatus);
            //     $changeAdminRole = $parentStatus.find('#changeAdminRole');
            //     // console.log($changeAdminRole);
            //     $userId = $('#userId').val();
            //     // console.log($userId);

            //     $data = {
            //         'adminRole' : $adminRole,
            //         'userId' : $userId
            //     }

            //     $.ajax({
            //         type: 'get', //get or post method?
            //         url: 'http://127.0.0.1:8000/admin/ajax/change/role',
            //         data: $data,
            //         dataType: 'json'
            //     })
            // })

            $(document).ready(function() {
                $('.changeStatus').change(function() {
                    $currentStatus = $(this).val();
                    // console.log($currentStatus);
                    $parentNode = $(this).parents('tr');
                    // console.log($parentNode);
                    $userId = $parentNode.find('#userId').val();
                    console.log($userId);

                    $data = {
                        'userId': $userId,
                        'role': $currentStatus
                    };

                    $.ajax({
                        type: 'get',
                        url: 'http://127.0.0.1:8000/admin/ajax/change/role',
                        data: $data,
                        dataType: 'json'
                    })
                    location.reload();
                })
            })
        })
    </script>

@endsection
