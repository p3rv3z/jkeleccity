@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Add Expense</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('expense.index') }}">Expense</a></li>
          <li class="breadcrumb-item active">Add Expense</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <form action="{{ route('expense.store') }}" method="post">
            @csrf
            <div class="card-body">

              <div class="form-group">
                <label for="expense_category_id">Category</label>
                <select name="expense_category_id" id="expense_category_id" value="{{ old('expense_category_id') }}" class="form-control form-control-sm select2" required>
                  <option selected="selected" disabled>Select Category</option>
                  @foreach ($expense_categories as $expense_category)
                  <option value="{{ $expense_category->id }}" {{ old('expense_category_id') == $expense_category->id ? 'selected' : null }}>{{ $expense_category->name }}</option>
                  @endforeach
                </select>
                @error ('expense_category_id')
                <span class="text-sm text-danger" for="expense_category_id"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-row">
                <div class="form-group col-6">
                  <label for="amount">Amount *</label>
                  <input type="number" name="amount" value="{{ old('amount') }}" min="0" class="form-control form-control-sm" id="amount" placeholder="Enter Expense" autofocus required>
                  @error ('amount')
                  <span class="text-sm text-danger" for="amount"><i class="far fa-times-circle"></i> {{ $message }}</span>
                  @enderror
                </div>
                <div class="form-group col-6">
                  <label for="date">Date *</label>
                  <input type="date" name="date" value="{{ old('date') }}" class="form-control form-control-sm" id="date" placeholder="Enter Date" required>
                  @error ('date')
                  <span class="text-sm text-danger" for="date"><i class="far fa-times-circle"></i> {{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <label for="expense_by">Expense By *</label>
                <select class="form-control form-control-sm select2 @error('expense_by') is-invalid @enderror" style="width: 100%" id="expense_by" name="expense_by" required>
                  <option selected disabled>Select Distributor/Customer</option>
                  @foreach ($users as $user)
                  <option value="{{ $user->id }}" {{ (old('expense_by', auth()->user()->id) == $user->id) ? 'selected' : null }}>{{ $user->name . ' (' . $user->roles()->first()->name . ')' }}</option>
                  @endforeach
                </select>
                @error ('expense_by')
                <span class="text-sm text-danger" for="expense_by"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="purpose">Purpose</label>
                <textarea name="purpose" value="{{ old('purpose') }}" class="form-control form-control-sm" id="purpose" cols="30" rows="2"></textarea>
                @error ('purpose')
                <span class="text-sm text-danger" for="purpose"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right">
              <button type="submit" name="action" value="save" class="btn btn-primary btn-sm">Save</button>
              <button type="submit" name="action" value="save&close" class="btn btn-primary btn-sm">Save & Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
