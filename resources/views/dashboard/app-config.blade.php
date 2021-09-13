@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">App Configuration</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">App Configuration</li>
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
          <form action="{{ route('appConfig') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" name="name" value="{{ old('name', $config->name) }}" class="form-control form-control-sm" id="name" placeholder="Enter Name" autofocus required>
                @error('name')
                  <span class="text-sm text-danger" for="name"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control form-control-sm" placeholder="write about yourself" cols="10" rows="5" autofocus>{{ old('description', $config->description) }}</textarea>
                @error('description')
                  <span class="text-sm text-danger" for="description"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" name="email" value="{{ old('email', $config->email) }}" class="form-control form-control-sm" id="email" placeholder="support@example.com" required autofocus>
                @error('email')
                  <span class="text-sm text-danger" for="email"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="helpline">Helpline Number *</label>
                <input type="text" name="helpline" value="{{ old('helpline', $config->helpline) }}" class="form-control form-control-sm" id="helpline" required autofocus>
                @error('helpline')
                  <span class="text-sm text-danger" for="helpline"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="whatsapp_support">Whatsapp Support Number</label>
                <input type="text" name="whatsapp_support" value="{{ old('whatsapp_support', $config->whatsapp_support) }}" class="form-control form-control-sm" id="whatsapp_support" autofocus>
                @error('whatsapp_support')
                  <span class="text-sm text-danger" for="whatsapp_support"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="fax">Fax</label>
                <input type="text" name="fax" value="{{ old('fax', $config->fax) }}" class="form-control form-control-sm" id="fax" autofocus>
                @error('fax')
                  <span class="text-sm text-danger" for="fax"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="facebook">Facebook link</label>
                <input type="text" name="facebook" value="{{ old('facebook', $config->facebook) }}" class="form-control form-control-sm" id="facebook" autofocus>
                @error('facebook')
                  <span class="text-sm text-danger" for="facebook"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="address">Address *</label>
                <textarea name="address" id="address" class="form-control form-control-sm" cols="10" rows="5" required autofocus>{{ old('address', $config->address) }}</textarea>
                @error('address')
                  <span class="text-sm text-danger" for="address"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="working_days">Working Days</label>
                <input type="text" name="working_days" value="{{ old('working_days', $config->working_days) }}" class="form-control form-control-sm" id="working_days" autofocus>
                @error('working_days')
                  <span class="text-sm text-danger" for="working_days"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" name="logo" data-default-file="{{ asset('config_images/'.$config->logo) }}" class="form-control form-control-sm dropify" id="logo">
                @error('logo')
                  <span class="text-sm text-danger" for="logo"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="favicon">Favicon</label>
                <input type="file" name="favicon" data-default-file="{{ asset('config_images/'.$config->favicon) }}" class="form-control form-control-sm dropify" id="favicon">
                @error('favicon')
                  <span class="text-sm text-danger" for="favicon"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-right">
              <button type="submit" name="action" value="update" class="btn btn-primary btn-sm">Save</button>
              <button type="submit" name="action" value="update&close" class="btn btn-primary btn-sm">Save & Close</button>
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

    // $('#address').summernote();
    // $('#description').summernote();
  </script>
@endpush