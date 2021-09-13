@extends('layouts.dashboard')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">Edit Product</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">Product</a></li>
            <li class="breadcrumb-item active">Edit Product</li>
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
            @livewire('anywhere.update-product', ['product' => $product], key($porduct->id))
            {{-- <form action="{{ route('product.update', $product->id) }}" method="post">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Name *</label>
                  <input type="text"
                         name="name"
                         value="{{ old('name') ?? $product->name }}"
                         class="form-control form-control-sm"
                         id="name"
                         placeholder="Enter Name"
                         autofocus
                         required>
                  @error ('name')
                  <label class="text-sm text-danger" for="name"><i class="far fa-times-circle"></i> {{ $message }}
                  </label>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="model_name">Model Name *</label>
                  <input type="text"
                         name="model_name"
                         value="{{ old('model_name') ?? $product->model_name }}"
                         class="form-control form-control-sm"
                         id="model_name"
                         placeholder="Enter Model Name"
                         autofocus
                         required>
                  @error ('model_name')
                  <label class="text-sm text-danger" for="model_name"><i class="far fa-times-circle"></i> {{ $message }}
                  </label>
                  @enderror
                </div>
                {{--                <div class="form-group">--}}
                {{--                  <label for="code">Code *</label>--}}
                {{--                  <input type="text"--}}
                {{--                         name="code"--}}
                {{--                         value="{{ old('code') ?? $product->code }}"--}}
                {{--                         class="form-control form-control-sm"--}}
                {{--                         id="code"--}}
                {{--                         placeholder="Enter Code"--}}
                {{--                         required>--}}
                {{--                  @error ('code')--}}
                {{--                  <label class="text-sm text-danger" for="code"><i class="far fa-times-circle"></i> {{ $message }}--}}
                {{--                  </label>--}}
                {{--                  @enderror--}}
                {{--                </div>--}}
                {{-- <div class="form-group">
                  <label for="description">Description</label>
                  <textarea name="description"
                            class="form-control form-control-sm"
                            id="description"
                            cols="30"
                            rows="2">{{ old('description') ?? $product->description }}</textarea>
                  @error ('description')
                  <label class="text-sm text-danger"
                         for="description"><i class="far fa-times-circle"></i> {{ $message }}</label>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="category_id">Category</label>
                  <select name="category_id"
                          id="category_id"
                          class="form-control form-control-sm select2"
                          style="width: 100%"
                          required>
                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id  ? 'selected' : null }}>{{ $category->name }}</option>
                    @endforeach
                  </select>
                  @error ('category_id')
                  <label class="text-sm text-danger"
                         for="category_id"><i class="far fa-times-circle"></i> {{ $message }}
                  </label>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="brand_id">Brand</label>
                  <select name="brand_id"
                          id="brand_id"
                          class="form-control form-control-sm select2"
                          style="width: 100%"
                          required>
                    @foreach ($brands as $brand)
                      <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id  ? 'selected' : null }}>{{ $brand->name }}</option>
                    @endforeach
                  </select>
                  @error ('brand_id')
                  <label class="text-sm text-danger" for="brand_id"><i class="far fa-times-circle"></i> {{ $message }}
                  </label>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="status">Status</label>
                  <select name="status" id="status" class="form-control form-control-sm select2-withoutSearch" required>
                    <option selected="selected" value="1">Active</option>
                    <option value="0" {{ (old('status') ?? $product->status) ? null : 'selected' }}>Inactive</option>
                  </select>
                  @error ('status')
                  <label class="text-sm text-danger" for="status"><i class="far fa-times-circle"></i> {{ $message }}
                  </label>
                  @enderror
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-right">
                <button type="submit" name="action" value="update" class="btn btn-primary btn-sm">Update</button>
                <button type="submit" name="action" value="update&close" class="btn btn-primary btn-sm">Update & Close
                </button>
              </div>
            </form> --}}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
