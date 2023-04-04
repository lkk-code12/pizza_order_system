@extends('admin.layouts.master')

@section('title', 'Category List Page')

@section('content')
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Products List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>

                    {{-- Delete success --}}
                    @if (session('deleteSuccess'))
                        <div class="col-5 offset-7">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-circle-xmark"></i>
                                    {{ session('deleteSuccess') }} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    {{-- Search Box --}}
                    <div class="row text-center my-3">
                        <div class="col-4">
                            <h3>Total <span class="text-success">({{ $products->total() }})</span></h3>
                        </div>
                        <div class="col-4">
                            @if (request('key') == null)
                                <b>Search Key : <i class="fa-solid fa-face-smile-wink text-success"></i></b>
                            @else
                                <b>Search Key : </b><i class="text-success">{{ request('key') }}</i>
                            @endif
                        </div>
                        <div class="col-4">
                            <form action="{{ route('product#list') }}" method="get">
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

                    @if (count($products) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>View Count</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $p)
                                        <tr class="tr-shadow h-100">
                                            <td class="col-2"><img src="{{ asset('storage/' . $p->image) }}" class="img-thumbnail h-75 w-75"></td>
                                            <td>{{ $p->name }}</td>
                                            <td>{{ $p->price }} MMK</td>
                                            <td>{{ $p->category_name }}</td>
                                            <td>
                                                @if ($p->view_count > 1)
                                                    {{ $p->view_count }} - Views
                                                @else
                                                    {{ $p->view_count }} - View
                                                @endif
                                            </td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('product#view', $p->id) }}">
                                                        <button class="item ml-2" data-toggle="tooltip" data-placement="top"
                                                            title="View">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#updatePage', $p->id) }}">
                                                        <button class="item ml-2" data-toggle="tooltip" data-placement="top"
                                                            title="Update">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#delete', $p->id) }}">
                                                        <button class="item ml-2" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- for searching --}}
                            <div class="mt-3">
                                {{ $products->links() }}
                            </div>
                        </div>
                    @else
                        <h3 class="text-center">There is no product.</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
