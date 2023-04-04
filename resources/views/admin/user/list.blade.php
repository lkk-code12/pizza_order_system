@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <h3>Total - {{ $users->total() }}</h3>
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($users as $u)
                                    <tr>
                                        <td>
                                            @if ($u->image == null)
                                                @if ($u->gender == 'male')
                                                    <img src="{{ asset('images/defaultUser.png') }}" alt="">
                                                @else
                                                    <img src="{{ asset('images/femaleProfile.jpg') }}" alt="">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.$u->image) }}" alt="">
                                            @endif
                                        </td>

                                        <input type="hidden" id="userId" value="{{ $u->id }}">

                                        <td>{{ $u->name }}</td>
                                        <td>{{ $u->email }}</td>
                                        <td>{{ $u->phone }}</td>
                                        <td>{{ $u->gender }}</td>
                                        <td>{{ $u->address }}</td>

                                        <td class="col-3">
                                            <select name="" class="form-control" id="changeStatus">
                                                <option value="user" @if ($u->role == 'user')
                                                    selected
                                                @endif>user</option>
                                                <option value="admin" @if ($u->role == 'admin')
                                                    selected
                                                @endif>admin</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $users->links() }}
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
        $(document).ready(function(){
            $('#changeStatus').change(function(){
                $currentStatus = $(this).val();
                // console.log($currentStatus);
                $parentNode = $(this).parents('tr');
                // console.log($parentNode);
                $userId = $parentNode.find('#userId').val();
                // console.log($userId);

                $data = {
                    'userId' : $userId,
                    'role' : $currentStatus
                };

                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/user/change/role',
                    data : $data,
                    dataType : 'json'
                })
                location.reload();
            })
        })
    </script>

@endsection
