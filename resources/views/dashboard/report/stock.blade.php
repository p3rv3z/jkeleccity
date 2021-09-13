@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Stock Report</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
          <li class="breadcrumb-item">Report</li>
          <li class="breadcrumb-item active">Stock Report</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form>
              <div class="form-row">
                <div class="form-group col-md-3 mb-md-0">
                  <label for="product_id">Product:</label>
                  <select class="form-control form-control-sm select2 @error ('unit_price') is-invalid @enderror" id="product_id" name="product_id" required>
                    {{-- <option selected>Select Product</option> --}}
                    <option value="all" {{ (request()->get('product_id') == 'all' || request()->get('product_id') == null) ? 'selected' : null }}>All</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ (request()->get('product_id') == $product->id) ? 'selected' : null }}>{{ $product->model_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group mb-0 col align-self-end">
                  <button class="btn btn-primary btn-sm">Filter</button>
                  @if (request()->has('product_id') || request()->has('date_range'))
                    <a class="btn btn-danger btn-sm" href="{{ route('report.stock') }}">Reset</a>
                  @endif
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table id="stock-data-table" class="table">
              <thead>
                <tr>
                  <th>Product Model</th>
                  <th>Brand</th>
                  <th>Category</th>
                  <th class="text-center">Purchases</th>
                  <th class="text-center">Sales</th>
                  <th class="text-center">In Stock</th>
                  <th class="text-center">PSR</th>
                  <th class="text-center">SRS</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#stock-data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: '{!! route('report.stock') !!}',
      columns: [
        { data: 'model_name', name: 'model_name' },
        { data: 'brand.name', name: 'brand.name' },
        { data: 'category.name', name: 'category.name' },
        { data: 'total_purchase', name: 'total_purchase', className: 'text-center' },
        { data: 'total_sale', name: 'total_sale', className: 'text-center' },
        { data: 'final_stock', name: 'final_stock', className: 'text-center' },
        { data: 'purchase_return_stock', name: 'purchase_return_stock', className: 'text-center' },
        { data: 'sale_return_stock', name: 'sale_return_stock', className: 'text-center' },
      ],
      aoColumnDefs: [
        { "bSearchable": false, "aTargets": [ 2, 3 ] }
      ]
    });
} );
</script>
@endpush



{{-- <tbody>
  @foreach ($stocks as $stock)
  <tr>
    <td>{{ $stock->name }}</td>
    <td>{{ $stock->brand->name }}</td>
    <td class="text-center">{{ $stock->purchase->sum('quantity') }}</td>
    <td class="text-center">{{ $stock->sale->sum('quantity') }}</td>
    <td class="text-center">{{ $stock->purchase->sum('quantity') - $stock->sale->sum('quantity') }}</td>
  </tr>
  @endforeach
</tbody> --}}
