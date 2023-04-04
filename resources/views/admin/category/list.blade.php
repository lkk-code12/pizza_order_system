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
                                <h2 class="title-1">Category List</h2>
                            </div>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Category
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (session('categorySuccess'))
                                        <div class="col-4 offset-8">
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong><i class="fa-solid fa-circle-check"></i>
                                                    {{ session('categorySuccess') }} </strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    @endif

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
                                            <h3>Total <span class="text-success">({{ $categories->total() }})</span></h3>
                                        </div>
                                        <div class="col-4">
                                            @if (request('key') == null)
                                                <b>Search Key : <i class="fa-solid fa-face-smile-wink text-success"></i></b>
                                            @else
                                                <b>Search Key : </b><i class="text-success">{{ request('key') }}</i>
                                            @endif
                                        </div>
                                        <div class="col-4">
                                            <form action="{{ route('category#list') }}" method="get">
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

                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('j-F-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a href="{{ route('category#edit', $category->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Edit">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </button>
                                                    </a>
                                                    <a href="{{ route('category#delete', $category->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
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
                                {{ $categories->links() }}
                                {{-- {{ $categories->appends(request()->query())->links() }} --}}
                            </div>
                        </div>
                    @else
                        <h3 class="text-danger text-center ">There is no category here!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
@endsection
