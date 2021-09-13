@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">All Product Type</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product Type</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            @can('product_type.create')
                                <a href="{{ route('product_type.create') }}" class="mr-1 btn btn-sm btn-primary">Add New</a>
                            @endcan

                            {{-- <div class="card-tools"> --}}
                            {{-- <form class="mr-3 form-inline"> --}}
                            {{-- <div class="input-group input-group-sm custom-search" style="width: 160px"> --}}
                            {{-- <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" /> --}}
                            {{-- <div class="input-group-append"> --}}
                            {{-- <button class="btn btn-navbar" type="submit"> --}}
                            {{-- <i class="fas fa-search"></i> --}}
                            {{-- </button> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            {{-- </form> --}}
                            {{-- </div> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            @if ($product_types->count())
                                <table class="table" id="product_type-data-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th style="width: 40px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product_types as $index => $product_type)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $product_type->name }}</td>
                                                <td>
                                                    @can('product_type.edit')
                                                        <a class="btn btn-light btn-xs"
                                                            href="{{ route('product_type.edit', $product_type->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('product_type.delete')
                                                        <button type="button" class="btn btn-light btn-xs"
                                                            data-delete-action="{{ route('product_type.destroy', $product_type->id) }}">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </button>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h6 class="p-4">Product Type Not Added Yet. Add New Product Type From
                                    <a href="{{ route('product_type.create') }}">Here</a>
                                </h6>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        {{-- @if ($product_types->hasPagination) --}}
                        {{-- <div class="card-footer"> --}}
                        {{-- {{ $product_types->links() }} --}}
                        {{-- </div> --}}
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#product_type-data-table').DataTable();
        });

    </script>
@endpush
