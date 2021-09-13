@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Add Brand</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('brand.index') }}">Brand</a></li>
          <li class="breadcrumb-item active">Add Brand</li>
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
          <form action="{{ route('brand.store') }}" method="post">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm" id="name" placeholder="Enter Name" autofocus required>
                @error ('name')
                <span class="text-sm text-danger" for="name"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" value="{{ old('status') }}" class="form-control form-control-sm select2-withoutSearch" required>
                  <option selected="selected" value="1">Active</option>
                  <option value="0">Inactive</option>
                </select>
                @error ('status')
                <span class="text-sm text-danger" for="status"><i class="far fa-times-circle"></i> {{ $message }}</span>
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
