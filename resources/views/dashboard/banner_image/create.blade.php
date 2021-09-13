@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Add Banner Image</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('banner_image.index') }}">Banner Image</a></li>
          <li class="breadcrumb-item active">Add Banner Image</li>
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
          <form action="{{ route('banner_image.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="segment">Segment Name *</label>
                <input type="text" name="segment" value="{{ old('segment') }}" class="form-control form-control-sm" id="segment" placeholder="Enter Name" autofocus required>
                @error ('segment')
                  <label class="text-sm text-danger" for="name"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="image">Add Image</label>
                <input type="file" name="image" class="dropify form-control form-control-sm" id="image" autofocus>
                @error('image')
                  <span class="text-sm text-danger"><i class="far fa-times-circle"></i>
                    {{ $message }}</span>
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

@push('scripts')
<script>
  $('.dropify').dropify();
</script>
@endpush