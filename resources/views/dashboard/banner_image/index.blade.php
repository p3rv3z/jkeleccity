@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">All Banner Image</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Banner Image</li>
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
            @can('banner_image.create')
            <a href="{{ route('banner_image.create') }}" class="btn btn-sm btn-primary mr-1">Add New</a>
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
            @if ($banner_images->count())
            <table class="table" id="banner_image-data-table">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th style="width: 40px">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($banner_images as $index => $banner_image)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $banner_image->segment }}</td>
                  <td><img width="10%" src="{{ asset($banner_image->getFirstMediaUrl('banner_image')) }}" alt=""></td>
                  <td>
                    @can('banner_image.edit')
                    <a class="btn btn-light btn-xs" href="{{ route('banner_image.edit', $banner_image->id) }}">
                      <i class="fa fa-edit"></i>
                    </a>
                    @endcan
                    @can('banner_image.delete')
                    <button type="button" class="btn btn-light btn-xs" data-delete-action="{{ route('banner_image.destroy', $banner_image->id) }}">
                      <i class="fa fa-trash-alt"></i>
                    </button>
                    @endcan
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <h6 class="p-4">Banner Image Not Added Yet. Add New Banner Image From
              <a href="{{ route('banner_image.create') }}">Here</a>
            </h6>
            @endif
          </div>
          <!-- /.card-body -->
{{--          @if ($banner_images->hasPagination)--}}
{{--          <div class="card-footer">--}}
{{--            {{ $banner_images->links() }}--}}
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
      $('#banner_image-data-table').DataTable();
    });
  </script>
@endpush
