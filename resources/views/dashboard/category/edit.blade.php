@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Edit Category</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('category.index') }}">Category</a></li>
          <li class="breadcrumb-item active">Edit Category</li>
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
          <form action="{{ route('category.update', $category->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" name="name" value="{{ old('name') ?? $category->name }}" class="form-control form-control-sm" id="name" placeholder="Enter Name" autofocus required>
                @error ('name')
                <label class="text-sm text-danger" for="name"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" value="{{ old('status') ?? $category->status }}" class="form-control form-control-sm select2-withoutSearch" required>
                  <option selected="selected" value="1">Active</option>
                  <option value="0" {{ (old('status') ?? $category->status) ? null : 'selected' }}>Inactive</option>
                </select>
                @error ('status')
                <label class="text-sm text-danger" for="status"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right">
              <button type="submit" name="action" value="update" class="btn btn-primary btn-sm">Update</button>
              <button type="submit" name="action" value="update&close" class="btn btn-primary btn-sm">Update & Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
