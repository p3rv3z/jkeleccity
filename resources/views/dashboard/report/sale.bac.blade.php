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
              <div class="form-group">
                <button class="btn btn-primary btn-sm">Filter</button>
                @if (request()->has('user_id') || request()->has('product_id') || request()->has('date_range'))
                <a class="btn btn-danger btn-sm" href="{{ route('report.sale') }}">Reset</a>
                @endif
              </div>
              <div class="form-row">
                <div class="form-group col-6 col-md-3 mb-0">
                  <label for="user_id">Distributor/Customer:</label>
                  <select class="custom-select custom-select-sm @error ('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                    <option value="all" {{ (request()->get('user_id') == 'all' || request()->get('user_id') == null) ? 'selected' : null }}>All User</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ (request()->get('user_id') == $user->id) ? 'selected' : null }}>{{ $user->name . ' (' . $user->roles()->first()->name . ')' }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-6 col-md-3 mb-0">
                  <label for="product_id">Product:</label>
                  <select class="custom-select custom-select-sm @error ('product_id') is-invalid @enderror" id="product_id" name="product_id" required>
                    <option value="all" {{ (request()->get('product_id') == 'all' || request()->get('product_id') == null) ? 'selected' : null }}>All Product</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ (request()->get('product_id') == $product->id) ? 'selected' : null }}>{{ $product->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-6 col-md-3 mb-0">
                  <label for="date_range">Date range:</label>
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right text-center date_range_picker" id="date_range" name="date_range" value="{{ $dateRange->startDate->format('m/d/Y') }} - {{ $dateRange->endDate->format('m/d/Y') }}">
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
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
          <div class="card-body table-responsive p-0">
            @if ($details->count())
            <table class="table table-sm text-nowrap">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Invoice No</th>
                  <th>Distributor/Customer</th>
                  <th>Product</th>
                  <th>Sale Date</th>
                  <th class="text-right">Quantity</th>
                  <th class="text-right">Unit Price</th>
                  <th class="text-right">Total Amount</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($details as $detail)
                <tr><td>{{ $detail->sl }}</td>
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
            @else
            <h6 class="p-4 text-center mb-0">No Data Found</h6>
            @endif
          </div>
          <!-- /.card-body -->
          @if ($details->hasPagination)
          <div class="card-footer">
            {{ $details->links() }}
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
