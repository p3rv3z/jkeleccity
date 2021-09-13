@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">All Brand</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Brand</li>
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
            @can('brand.create')
            <a href="{{ route('brand.create') }}" class="btn btn-sm btn-primary mr-1">Add New</a>
            @endcan

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
            @if ($brands->count())
            <table class="table table-sm text-nowrap" id="brand-data-table">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th style="width: 40px">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($brands as $index => $brand)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $brand->name }}</td>
                  <td><span class="badge {{ $brand->status ? 'badge-success' : 'badge-danger' }}">{{ $brand->status ? 'Active' : 'Inactive' }}</span></td>
                  <td>
                    @can('brand.edit')
                    <a class="btn btn-light btn-xs" href="{{ route('brand.edit', $brand->id) }}">
                      <i class="fa fa-edit"></i>
                    </a>
                    @endcan
                    @can('brand.delete')
                    <button type="button" class="btn btn-light btn-xs" data-delete-action="{{ route('brand.destroy', $brand->id) }}">
                      <i class="fa fa-trash-alt"></i>
                    </button>
                    @endcan
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <h6 class="p-4">Brand Not Added Yet. Add New Brand From
              <a href="{{ route('brand.create') }}">Here</a>
            </h6>
            @endif
          </div>
          <!-- /.card-body -->
{{--          @if ($brands->hasPagination)--}}
{{--          <div class="card-footer">--}}
{{--            {{ $brands->links() }}--}}
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
      $('#brand-data-table').DataTable();
    });
  </script>
@endpush


