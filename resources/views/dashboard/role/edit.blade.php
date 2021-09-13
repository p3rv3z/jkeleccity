@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Edit Role</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('role.index') }}">Role</a></li>
          <li class="breadcrumb-item active">Edit Role</li>
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
          <form action="{{ route('role.update', $role->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group">
                <label for="name">Role *</label>
                <input type="text" name="name" value="{{ old('name', $role->name) }}" class="form-control form-control-sm" id="name" placeholder="Enter Name" autofocus>
                @error ('name')
                <span class="text-sm text-danger" for="name"><i class="far fa-times-circle"></i> {{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="permissions">Permission *
                  <span class="btn btn-info btn-xs select-all">Select All</span>
                  <span class="btn btn-info btn-xs deselect-all">Deselect All</span>
                </label>
                <select multiple name="permissions[]" id="permissions" class="form-control form-control-sm select2">
                  @foreach ($permissions as $i => $permission)
                    <option value="{{ $permission->id }}" {{ collect(old('permissions', $role->hasPermissionTo($permission->name)))->contains($permission->id) ? 'selected' : null }}>{{ ucWords($permission->name) }}</option>
                  @endforeach
                </select>
                @error ('permissions')
                <span class="text-sm text-danger"><i class="far fa-times-circle"></i> {{ $message }}</span>
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
