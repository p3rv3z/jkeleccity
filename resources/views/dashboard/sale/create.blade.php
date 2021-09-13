@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Add Sale</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('sale.index') }}">Sale</a></li>
          <li class="breadcrumb-item active">Add Sale</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<form action="{{ route('sale.store') }}" method="post" id="sale-store-form">@csrf</form>

<section class="content">
  <div class="container-fluid">
    {{-- <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="form-row">
              <div class="align-self-end">
                <livewire:anywhere.add-customer />
              </div>
              <div class="form-group col-sm-4 col-md-3 mb-0">
                <label for="user_id">Distributor/Customer *</label>
                <select class="custom-select custom-select-sm @error ('unit_price') is-invalid @enderror" id="user_id" name="user_id" form="sale-store-form" required>
                  <option selected disabled>Select Distributor/Customer</option>
                  @foreach ($users as $user)
                  <option value="{{ $user->id }}" {{ (old('user_id') == $user->id) ? 'selected' : null }}>{{ $user->name . ' (' . $user->roles()->first()->name . ')' }}</option>
                  @endforeach
                </select>
                @error ('user_id')
                <span class="text-sm text-danger" for="user_id"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group col-sm-4 col-md-3 mb-0">
                <label for="invoice_no">Invoice No *</label>
                <input type="text" name="invoice_no" value="{{ $invoice_no }}" class="form-control form-control-sm" id="invoice_no" form="sale-store-form" placeholder="Enter Invoice No" required readonly>
                @error ('invoice_no')
                <span class="text-xs text-danger" for="invoice_no"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group col-sm-4 col-md-3 mb-0">
                <label for="date">Date *</label>
                <input type="date" name="date" value="{{ old('date', date('Y-m-d')) }}" class="form-control form-control-sm" id="date" form="sale-store-form" placeholder="Select delivery date" required>
                @error ('date')
                <span class="text-xs text-danger" for="date"><i class="far fa-times-circle"></i>{{ $message }}</span>
                @enderror
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div> --}}

    @livewire('sale.product-management')
  </div>
</section>
@endsection
