@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Add User</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
          <li class="breadcrumb-item active">Add User</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <!-- /.card-header -->
          <form role="form" action="{{ route('user.store') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" class="form-control form-control-sm" id="name" value="{{ old('name') }}" name="name" placeholder="Enter full name" required>
                @error ('name')
                <label class="text-sm text-danger" for="name"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <div class="input-group input-group-sm">
                  <div class="input-group-prepend">
                    <span class="input-group-text">+880</span>
                  </div>
                  <input type="number" name="phone" value="{{ old('phone') }}" class="form-control form-control-sm @error('phone') is-invalid @enderror" id="phone" form="sale-store-form" placeholder="Enter user contact number">
                </div>
                @error ('phone')
                <span class="text-xs text-danger" for="phone"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" name="email" placeholder="Enter email address" required>
                @error ('email')
                <label class="text-sm text-danger" for="email"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="fax">Fax</label>
                <input type="text" class="form-control form-control-sm @error('fax') is-invalid @enderror" id="fax" value="{{ old('fax') }}" name="fax" placeholder="Enter fax">
                @error ('fax')
                <label class="text-sm text-danger" for="fax"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control form-control-sm @error('website') is-invalid @enderror" id="website" value="{{ old('website') }}" name="website" placeholder="Enter website address">
                @error ('website')
                <label class="text-sm text-danger" for="website"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password (Min. Length: 8)" required>
                @error ('password')
                <label class="text-sm text-danger" for="password"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="password_confirmation">Password Confirmation *</label>
                <input type="password" class="form-control form-control-sm" id="password_confirmation" name="password_confirmation" placeholder="Enter password again for confirmation">
              </div>
              <div class="form-group">
                <label for="role">Role *</label>
                <select class="form-control form-control-sm select2 @error('role') is-invalid @enderror" id="role" name="role">
                  <option disabled selected>Select Role</option>
                  @foreach ($roles as $role)
                  <option {{ $role->name }} {{ old('role') == $role->name ? 'selected' : null }}>{{ $role->name }}</option>
                  @endforeach
                </select>
                @error ('role')
                <label class="text-sm text-danger" for="role"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="status">Status *</label>
                <select class="form-control form-control-sm select2-withoutSearch @error('status') is-invalid @enderror" id="status" name="status">
                  <option value="1" selected="selected">Active</option>
                  <option value="0">Inactive</option>
                </select>
                @error ('status')
                <label class="text-sm text-danger" for="status"><i class="far fa-times-circle"></i> {{ $message }}</label>
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
