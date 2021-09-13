@extends('layouts.dashboard')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h4 class="m-0 text-dark">All Product</h4>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Product</li>
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
                            @can('product.create')
                                <a href="{{ route('product.create') }}" class="mr-1 btn btn-sm btn-primary">Add New</a>
                                {{-- @livewire('anywhere.add-product', key('product_save')) --}}
                            @endcan

                            {{-- <div class="card-tools"> --}}
                            {{-- <form class="mr-3 form-inline"> --}}
                            {{-- <div class="input-group input-group-sm custom-search" style="width: 160px"> --}}
                            {{-- <input class="form-control form-control-navbar" --}}
                            {{-- type="search" --}}
                            {{-- placeholder="Search" --}}
                            {{-- aria-label="Search"/> --}}
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
                            @if ($products->count())
                                <table class="table" id="product-data-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            {{-- <th>Name</th> --}}
                                            {{-- <th>Barcode</th> --}}
                                            <th>Model Name</th>
                                            <th class="text-center">Dealer Price</th>
                                            <th class="text-center">Regular Price</th>
                                            <th class="text-center">Offer Price</th>
                                            {{-- <th>Category</th> --}}
                                            {{-- <th>Brand</th> --}}
                                            <th class="text-center">In Stock</th>
                                            <th class="text-center">PRS</th>
                                            <th class="pr-4 text-center">SRS</th>
                                            <th style="width: 40px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $index => $product)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                {{-- <td>{{ $product->name }}</td> --}}
                                                {{-- <td> --}}
                                                {{-- <svg class="barcode" --}}
                                                {{-- data-height="10" --}}
                                                {{-- data-width="1" --}}
                                                {{-- data-format="EAN13" --}}
                                                {{-- data-displayValue="true" --}}
                                                {{-- data-value="{{ $product->code }}"></svg> --}}
                                                {{-- </td> --}}
                                                <td>{{ $product->model_name }}</td>
                                                {{-- <td>{{ $product->category->name }}</td> --}}
                                                {{-- <td>{{ $product->brand->name }}</td> --}}
                                                <td class="text-center">
                                                    {{ $product->latest_purchase->unit_price ?? 0 }}
                                                </td>
                                                <td class="text-center">
                                                  {{ $product->latest_purchase->regular_price ?? 0 }}
                                              </td>
                                                <td class="text-center">
                                                    {{ $product->latest_purchase->offer_price ?? 0 }}
                                                </td>
                                                <td class="text-center">{{ $product->final_stock }}</td>
                                                <td class="text-center">{{ $product->purchase_return_stock }}</td>
                                                <td class="pr-4 text-center">{{ $product->sale_return_stock }}</td>
                                                <td class="d-flex">
                                                    @can('product.edit')
                                                        <a class="btn btn-light btn-xs"
                                                            href="{{ route('product.edit', $product->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    @endcan
                                                    @can('product.delete')
                                                        <button type="button" class="btn btn-light btn-xs" data-toggle="modal"
                                                            data-target="#delete-modal-{{ $product->id }}">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </button>
                                                        <div class="modal fade" id="delete-modal-{{ $product->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-md">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Delete
                                                                            Product</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you confirm to delete this product?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light btn-sm"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                            form="delete-form-{{ $product->id }}">Confirm
                                                                        </button>
                                                                        <form
                                                                            action="{{ route('product.destroy', $product->id) }}"
                                                                            method="post"
                                                                            id="delete-form-{{ $product->id }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <h6 class="p-4">Product Not Added Yet. Add New Product From
                                    <a href="{{ route('product.create') }}">Here</a>
                                </h6>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        {{-- @if ($products->hasPagination) --}}
                        {{-- <div class="card-footer"> --}}
                        {{-- {{ $products->links() }} --}}
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
            $('#product-data-table').DataTable();
        });

    </script>
@endpush
