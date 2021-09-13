@extends('layouts.dashboard')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">Add Purchase</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('purchase.index') }}">Purchase</a></li>
            <li class="breadcrumb-item active">Add Purchase</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-header -->
  <form action="{{ route('purchase.store') }}" method="post" id="purchase-store-form">@csrf</form>

  <section class="content">
    <div class="container-fluid">
{{--      <div class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--          <div class="card">--}}
{{--            <div class="card-body">--}}
{{--              <div class="row">--}}
{{--                <div class="align-self-end">--}}
{{--                  <livewire:anywhere.add-customer/>--}}
{{--                </div>--}}

{{--                <div class="form-group col-6 col-sm-4 col-md-3">--}}
{{--                  <label for="invoice_no">Invoice No *</label>--}}
{{--                  <input type="text"--}}
{{--                         name="invoice_no"--}}
{{--                         form="purchase-store-form"--}}
{{--                         value="{{ $invoice_no }}"--}}
{{--                         class="form-control form-control-sm"--}}
{{--                         id="invoice_no"--}}
{{--                         placeholder="Enter Invoice No"--}}
{{--                         required--}}
{{--                         readonly>--}}
{{--                  @error ('invoice_no')--}}
{{--                  <span class="text-sm text-danger" for="invoice_no"><i class="far fa-times-circle"></i> {{ $message }}</span>--}}
{{--                  @enderror--}}
{{--                </div>--}}
{{--                --}}{{--              <div class="form-group col-6 col-sm-4 col-md-3">--}}
{{--                --}}{{--                <label for="lc_no">L/C No *</label>--}}
{{--                --}}{{--                <input type="text" name="lc_no" form="purchase-store-form" value="{{ old('lc_no') }}" class="form-control form-control-sm" id="lc_no" placeholder="Enter L/C No" required>--}}
{{--                --}}{{--                @error ('lc_no')--}}
{{--                --}}{{--                <span class="text-sm text-danger" for="lc_no"><i class="far fa-times-circle"></i> {{ $message }}</span>--}}
{{--                --}}{{--                @enderror--}}
{{--                --}}{{--              </div>--}}
{{--                --}}{{--              <div class="form-group col-6 col-sm-4 col-md-3">--}}
{{--                --}}{{--                <label for="lot_no">Lot No *</label>--}}
{{--                --}}{{--                <input type="text" name="lot_no" form="purchase-store-form" value="{{ old('lot_no') }}" class="form-control form-control-sm" id="lot_no" placeholder="Enter Lot No" required>--}}
{{--                --}}{{--                @error ('lot_no')--}}
{{--                --}}{{--                <span class="text-sm text-danger" for="lot_no"><i class="far fa-times-circle"></i> {{ $message }}</span>--}}
{{--                --}}{{--                @enderror--}}
{{--                --}}{{--              </div>--}}
{{--                --}}{{--              <div class="form-group col-6 col-sm-4 col-md-3">--}}
{{--                --}}{{--                <label for="container_no">Container No *</label>--}}
{{--                --}}{{--                <input type="text" name="container_no" form="purchase-store-form" value="{{ old('container_no') }}" class="form-control form-control-sm" id="container_no"--}}
{{--                --}}{{--                  placeholder="Enter Container No" required>--}}
{{--                --}}{{--                @error ('container_no')--}}
{{--                --}}{{--                <span class="text-sm text-danger" for="container_no"><i class="far fa-times-circle"></i> {{ $message }}</span>--}}
{{--                --}}{{--                @enderror--}}
{{--                --}}{{--              </div>--}}
{{--                <div class="form-group col-6 col-sm-4 col-md-3 mb-0">--}}
{{--                  <label for="c_invoice_value">C-Invoice Value *</label>--}}
{{--                  <input type="number"--}}
{{--                         name="c_invoice_value"--}}
{{--                         form="purchase-store-form"--}}
{{--                         value="{{ old('c_invoice_value') }}"--}}
{{--                         class="form-control form-control-sm"--}}
{{--                         id="c_invoice_value"--}}
{{--                         min="0"--}}
{{--                         placeholder="Enter C-Invoice Value"--}}
{{--                         required>--}}
{{--                  @error ('c_invoice_value')--}}
{{--                  <span class="text-sm text-danger" for="c_invoice_value"><i class="far fa-times-circle"></i> {{ $message }}</span>--}}
{{--                  @enderror--}}
{{--                </div>--}}
{{--                <div class="form-group col-6 col-sm-4 col-md-3 mb-0">--}}
{{--                  <label for="date">Date *</label>--}}
{{--                  <input type="date"--}}
{{--                         name="date"--}}
{{--                         form="purchase-store-form"--}}
{{--                         value="{{ old('date', date('Y-m-d')) }}"--}}
{{--                         class="form-control form-control-sm"--}}
{{--                         id="date"--}}
{{--                         placeholder="Enter Date"--}}
{{--                         required>--}}
{{--                  @error ('date')--}}
{{--                  <span class="text-sm text-danger" for="date"><i class="far fa-times-circle"></i> {{ $message }}</span>--}}
{{--                  @enderror--}}
{{--                </div>--}}
{{--                <div class="form-group col-6 col-sm-4 col-md-3 mb-0">--}}
{{--                  <label for="remark">Remark</label>--}}
{{--                  <input type="remark"--}}
{{--                         name="remark"--}}
{{--                         form="purchase-store-form"--}}
{{--                         value="{{ old('remark') }}"--}}
{{--                         class="form-control form-control-sm"--}}
{{--                         id="remark"--}}
{{--                         placeholder="Remark Here">--}}
{{--                  @error ('remark')--}}
{{--                  <span class="text-sm text-danger"--}}
{{--                        for="remark"><i class="far fa-times-circle"></i> {{ $message }}</span>--}}
{{--                  @enderror--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--            <!-- /.card-body -->--}}
{{--          </div>--}}
{{--        </div>--}}
{{--      </div>--}}

      @livewire('purchase.product-management')
    </div>
  </section>
@endsection
