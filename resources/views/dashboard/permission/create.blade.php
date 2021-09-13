@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Add Permission</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('permission.index') }}">Permission</a></li>
          <li class="breadcrumb-item active">Add Permission</li>
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
          <form action="{{ route('permission.store') }}" method="post">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name">Permission *</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-sm" id="name" placeholder="Enter Name" autofocus required>
                @error ('name')
                <span class="text-sm text-danger" for="name"><i class="far fa-times-circle"></i> {{ $message }}</span>
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
