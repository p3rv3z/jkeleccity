@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Edit User</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></li>
          <li class="breadcrumb-item active">Edit User</li>
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
          <form role="form" action="{{ route('user.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="name">Name *</label>
                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" value="{{ old('name') ?? $user->name }}" name="name" placeholder="Enter full name" required>
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
                  <input type="number" name="phone" value="{{ old('phone', $user->phone) }}" class="form-control form-control-sm @error('name') is-invalid @enderror" id="phone" form="sale-store-form" placeholder="Enter user contact number">
                </div>
                @error ('phone')
                <span class="text-xs text-danger" for="phone"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="email">Email *</label>
                <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" value="{{ old('email', $user->email) }}" name="email" placeholder="Enter email address" required>
                @error ('email')
                <label class="text-sm text-danger" for="email"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="fax">Fax</label>
                <input type="text" class="form-control form-control-sm @error('fax') is-invalid @enderror" id="fax" value="{{ old('fax', $user->fax) }}" name="fax" placeholder="Enter fax">
                @error ('fax')
                <label class="text-sm text-danger" for="fax"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="website">Website</label>
                <input type="text" class="form-control form-control-sm @error('website') is-invalid @enderror" id="website" value="{{ old('website', $user->website) }}" name="website" placeholder="Enter website address">
                @error ('website')
                <label class="text-sm text-danger" for="website"><i class="far fa-times-circle"></i> {{ $message }}</label>
                @enderror
              </div>
              <div class="form-group">
                <label for="role">Role *</label>
                <select class="form-control form-control-sm select2 @error('role') is-invalid @enderror" id="role" name="role">
                  <option disabled selected>Select Role</option>
                  @foreach ($roles as $role)
                  <option value="{{ $role->name }}" {{ old('role') == $role->name || $user->hasRole($role->name) ? 'selected' : null }}>{{ $role->name }}</option>
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
                  <option value="0" {{ (old('status', $user->status)) ? null : 'selected' }}>Inactive</option>
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
