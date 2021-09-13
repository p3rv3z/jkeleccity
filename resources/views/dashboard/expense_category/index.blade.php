@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Expense Category</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Expense Category</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    @can('expense_category.create')
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <span>@if(isset($edit_expense_category)) Edit @else Add @endif Category</span>
          </div>
          <div class="card-body">
            @if(isset($edit_expense_category))
            <form action="{{  route('expense_category.update', $edit_expense_category)  }}" method="POST">
              @csrf
              @method('PUT')
            @else
            <form action="{{  route('expense_category.store')  }}" method="POST">
              @csrf
            @endif

              <div class="row">
                <div class="col-md-5">
                  <div class="form-group form-row">
                    <label for="name" class="col-md-3">Name *</label>
                    <div class="col-md-9">
                      <input type="text" name="name" value="{{ old('name', isset($edit_expense_category) ? $edit_expense_category->name : '') }}" class="form-control form-control-sm" id="name" placeholder="Enter Name" autofocus required>
                    </div>
                    @error ('name')
                    <span class="text-sm text-danger" for="name"><i class="far fa-times-circle"></i> {{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="status" class="sr-only">Status *</label>
                    <select name="status" id="status" value="{{ old('status', isset($edit_expense_category) ? $edit_expense_category->name : '') }}" class="form-control form-control-sm select2-withoutSearch" required>
                      <option value="1">Active</option>
                      <option value="0" {{ old('status', isset($edit_expense_category) ? $edit_expense_category->status : null) ? null : 'selected' }}>Inactive</option>
                    </select>
                    @error ('status')
                    <span class="text-sm text-danger" for="status"><i class="far fa-times-circle"></i> {{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-4">
                  @if(isset($edit_expense_category))
                  <button type="submit" name="action" value="update" class="btn btn-primary btn-sm">Update</button>
                  <a href="{{ route('expense_category.index') }}" class="btn btn-danger btn-sm text-white">Cancle Edit</a>
                  @else
                  <button type="submit" name="action" value="save" class="btn btn-primary btn-sm">Save</button>
                  @endif
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endcan
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <span>Categories</span>
{{--            <div class="card-tools">--}}
{{--              <form class="form-inline mr-3">--}}
{{--                <div class="input-group input-group-sm custom-search" style="width: 160px">--}}
{{--                  <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" />--}}
{{--                  <div class="input-group-append">--}}
{{--                    <button class="btn btn-navbar" type="submit">--}}
{{--                      <i class="fas fa-search"></i>--}}
{{--                    </button>--}}
{{--                  </div>--}}
{{--                </div>--}}
{{--              </form>--}}
{{--            </div>--}}
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            @if ($expense_categories->count())
            <table class="table" id="expense-category-data-table">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th style="width: 40px">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($expense_categories as $index => $expense_category)
                @if(isset($edit_expense_category))
                <tr style="background-color: {{$expense_category->id == $edit_expense_category->id ? '#add8e6' : null }}">
                @else
                <tr>
                @endif
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $expense_category->name }}</td>
                  <td><span class="badge {{ $expense_category->status == 1 ? 'badge-success' : 'badge-danger' }}">{{ $expense_category->status == 1 ? 'Active' : 'Inactive' }}</span></td>
                  <td>
                    @can('expense_category.edit')
                    <a class="btn btn-light btn-xs" href="{{ route('expense_category.edit', $expense_category->id) }}">
                      <i class="fa fa-edit"></i>
                    </a>
                    @endcan
                    @can('expense_category.delete')
                    <button type="button" class="btn btn-light btn-xs" data-toggle="modal" data-target="#delete-modal-{{ $expense_category->id }}">
                      <i class="fa fa-trash-alt"></i>
                    </button>

                    <div class="modal fade" id="delete-modal-{{ $expense_category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Expense Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you confirm to delete this expense category?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-sm" form="delete-form-{{ $expense_category->id }}">Confirm</button>
                            <form action="{{ route('expense_category.destroy', $expense_category->id) }}" method="post" id="delete-form-{{ $expense_category->id }}">
                              @csrf
                              @method('DELETE')
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endcan
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <h6 class="p-4">Expese Category Not Added Yet.</h6>
            @endif
          </div>
          <!-- /.card-body -->
{{--          @if ($expense_categories->hasPagination)--}}
{{--          <div class="card-footer">--}}
{{--            {{ $expense_categories->links() }}--}}
{{--          </div>--}}
{{--          @endif--}}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      $('#expense-category-data-table').DataTable();
    });
  </script>
@endpush