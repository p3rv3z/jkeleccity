@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="mb-2 row">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Edit Product Type</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('product_type.index') }}">Product Type</a></li>
          <li class="breadcrumb-item active">Edit Product Type</li>
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
          <form action="{{ route('product_type.update', $product_type->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" name="name" value="{{ old('name') ?? $product_type->name }}" class="form-control form-control-sm" id="name" placeholder="Enter Name" autofocus required>
                @error ('name')
                <label class="text-sm text-danger" for="name"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>

              <div class="form-group">
                <label for="category_id">Category *</label>
                <select name="category_id" id="category_id" value="{{ old('category_id') ?? $product_type->category_id }}" class="form-control form-control-sm select2" required>
                  <option disabled>Select Category</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ ($category->id ==  $product_type->category_id) ? 'selected' : 'null'  }}> {{ $category->name }} </option>
                  @endforeach

                </select>
                @error ('category_id')
                <label class="text-sm text-danger" for="status"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>
            </div>
            <!-- /.card-body -->
            <div class="text-right card-footer">
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
