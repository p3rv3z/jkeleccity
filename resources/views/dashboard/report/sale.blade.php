@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Sale Report</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
          <li class="breadcrumb-item">Reports</li>
          <li class="breadcrumb-item active">Sale Report</li>
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
                  <label for="user_id">Distributor/Customer:</label>
                  <select class="form-control form-control-sm select2 @error ('unit_price') is-invalid @enderror" id="user_id" name="user_id" required>
                    <option value="all" {{ (request()->get('user_id') == 'all' || request()->get('user_id') == null) ? 'selected' : null }}>All User</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ (request()->get('user_id') == $user->id) ? 'selected' : null }}>{{ $user->name . ' (' . $user->roles()->first()->name . ')' }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-3 mb-md-0">
                  <label for="product_id">Product:</label>
                  <select class="form-control form-control-sm select2 @error ('unit_price') is-invalid @enderror" id="product_id" name="product_id" required>
                    <option value="all" {{ (request()->get('product_id') == 'all' || request()->get('product_id') == null) ? 'selected' : null }}>All Product</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ (request()->get('product_id') == $product->id) ? 'selected' : null }}>{{ $product->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-3 mb-md-0">
                  <label for="date_range">Date range:</label>
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right text-center date_range_picker" id="date_range" name="date_range">
                  </div>
                </div>
                <div class="form-group col mb-0 align-self-end">
                  <button class="btn btn-primary btn-sm">Filter</button>
                  @if (request()->has('user_id') || request()->has('product_id') || request()->has('date_range'))
                  <a class="btn btn-danger btn-sm" href="{{ route('report.sale') }}">Reset</a>
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
            <table id="sale-data-table" class="table">
              <thead>
                <tr>
                  <th>Invoice No</th>
                  <th>Distributor/Customer</th>
                  <th>Product</th>
                  <th>Sale Date</th>
                  <th>Quantity</th>
                  <th>Unit Price</th>
                  <th>Total Amount</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($details as $detail)
                <tr>
                  <td>{{ $detail->sale->invoice_no }}</td>
                  <td>{{ $detail->sale->user->name }}</td>
                  <td>{{ $detail->product->name }}</td>
                  <td>{{ $detail->sale->date }}</td>
                  <td class="text-right">{{ $detail->quantity }}</td>
                  <td class="text-right">{{ $detail->unit_price }} TK</td>
                  <td class="text-right">{{ $detail->quantity * $detail->unit_price }} TK</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#sale-data-table').DataTable();
} );
</script>
@endpush
