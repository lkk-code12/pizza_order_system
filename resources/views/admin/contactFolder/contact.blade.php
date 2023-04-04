@extends('admin.layouts.master')

@section('title', 'Category List Page')

@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    {{-- <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Contact List</h2>
                            </div>
                            <div class="col-4">
                                <h3>Total = <span class="text-success">{{ count($data) }}</span></h3>
                            </div>
                        </div>
                    </div> --}}

                    <div class="row mb-3">
                        <div class="col">
                            <h2 class="title-1">Contact List</h2>
                        </div>
                        <div class="col">
                            <h3 class="text-end">Total = <span class="text-success">{{ count($data) }}</span></h3>
                        </div>
                    </div>
                    <hr>


                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2">
                            <thead>
                                <tr>
                                    <th class="col-1">Id</th>
                                    <th class="col-2">User Name</th>
                                    <th class="col-3">User Email</th>
                                    <th class="col-5">Message</th>
                                </tr>
                            </thead>
                            <tbody id="dataList">
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $d->id }}</td>
                                        <td>{{ $d->name }}</td>
                                        <td>{{ $d->email }}</td>
                                        <td>{{ $d->message }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $data->links() }}
                        </div>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
