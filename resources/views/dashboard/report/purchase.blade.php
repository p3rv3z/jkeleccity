@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Purchase Report</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
          <li class="breadcrumb-item">Report</li>
          <li class="breadcrumb-item active">Purchase Report</li>
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
                  <select class="form-control form-control-sm select2 @error ('product_id') is-invalid @enderror" id="product_id" name="product_id">
                    <option value="all" {{ (request()->get('product_id') == 'all' || request()->get('product_id') == null) ? 'selected' : null }}>All</option>
                    @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ (request()->get('product_id') == $product->id) ? 'selected' : null }}>{{ $product->model_name }}</option>
                    @endforeach
                  </select>
                  @error ('product_id')
                  <span class="text-sm text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group col-md-3 mb-md-0">
                  <label for="date_range">Date range:</label>
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right text-center date_range_picker" id="date_range" name="date_range" value="{{ $dateRange->startDate->format('m/d/Y') }} - {{ $dateRange->endDate->format('m/d/Y') }}">
                  </div>
                </div>
                <div class="form-group col mb-0 align-self-end">
                  <button class="btn btn-primary btn-sm">Filter</button>
                  @if (request()->has('product_id') || request()->has('date_range'))
                  <a class="btn btn-danger btn-sm" href="{{ route('report.purchase') }}">Reset</a>
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
            <table class="table" id="purchase-data-table">
              <thead>
                <tr>
                  <th>Invoice No</th>
                  <th>Product Model</th>
                  <th>Purchase Date</th>
                  <th class="text-right">Quantity</th>
                  <th class="text-right">Unit Price</th>
                  <th class="text-right">Total Amount</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($details as $detail)
                <tr>
                  <td>{{ $detail->purchase->invoice_no }}</td>
                  <td>{{ $detail->product->model_name }}</td>
                  <td>{{ $detail->purchase->date }}</td>
                  <td class="text-right">{{ $detail->quantity }}</td>
                  <td class="text-right">{{ $detail->unit_price }} TK</td>
                  <td class="text-right">{{ $detail->quantity * $detail->unit_price }} TK</td>
                </tr>
                @endforeach
              </tbody>
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
    $('#purchase-data-table').DataTable();
} );
</script>
@endpush

