@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">All User</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">User Management</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            @can('user.create')
            <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary mr-1">Add New</a>
            @endcan
            <div class="card-tools">
              <form class="form-inline mr-3">
                <div class="input-group input-group-sm custom-search" style="width: 160px">
                  <input class="form-control form-control-navbar" type="search" name="search" value="{{ request()->get('search') }}" placeholder="Search by name" aria-label="Search" />
                  <div class="input-group-append">
                    <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
            @if (request()->get('search'))
            <a href="{{ route('user.index') }}" class="btn btn-sm btn-danger">Clear</a>
            @endif
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            @if ($users->count())
            <table class="table text-nowrap">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th style="width: 40px">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr>
                  <td>{{ $user->sl }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->roles->first()->name ?? null }}</td>
                  <td>
                    <span class="badge {{ $user->status ? 'badge-success' : 'badge-danger' }}">{{ $user->status ? 'Active' : 'Inactive' }}</span>
                  </td>
                  <td>
                    @if(!$user->hasRole('Super Admin'))
                    @can('user.edit')
                    <a class="btn btn-light btn-xs" href="{{ route('user.edit', $user->id) }}">
                      <i class="fa fa-edit"></i>
                    </a>
                    @endcan
                    @can('user.delete')
                    <button type="button" class="btn btn-light btn-xs" data-toggle="modal" data-target="#delete-modal-{{ $user->id }}">
                      <i class="fa fa-trash-alt"></i>
                    </button>

                    <div class="modal fade" id="delete-modal-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you confirm to delete this user?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-sm" form="delete-form-{{ $user->id }}">Confirm</button>
                            <form action="{{ route('user.destroy', $user->id) }}" method="post" id="delete-form-{{ $user->id }}">
                              @csrf
                              @method('DELETE')
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endcan
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <h6 class="p-4">User Not Added Yet. Add New User From
              <a href="{{ route('user.create') }}">Here</a>
            </h6>
            @endif
          </div>
          <!-- /.card-body -->
          @if ($users->hasPagination)
          <div class="card-footer clearfix">
            {{ $users->links() }}
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
