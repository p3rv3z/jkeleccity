@extends('layouts.dashboard')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">All Sale Return</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">Sale Return</li>
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
              @can('sale_return.create')
                <a href="{{ route('sale_return.manage') }}" class="btn btn-sm btn-primary mr-1">Add New</a>
              @endcan

{{--              <div class="card-tools">--}}
{{--                <form class="form-inline mr-3">--}}
{{--                  <div class="input-group input-group-sm custom-search" style="width: 188px">--}}
{{--                    <input class="form-control form-control-navbar" name="search" type="search" value="{{ request()->get('search') }}" placeholder="Search by invoice no" aria-label="Search"/>--}}
{{--                    <div class="input-group-append">--}}
{{--                      <button class="btn btn-navbar" type="submit">--}}
{{--                        <i class="fas fa-search"></i>--}}
{{--                      </button>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </form>--}}
{{--              </div>--}}
{{--              @if (request()->get('search'))--}}
{{--                <a href="{{ route('sale_return.index') }}" class="btn btn-sm btn-danger">Clear</a>--}}
{{--              @endif--}}
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              @if ($saleReturn->count())
                <table class="table" id="sale-return-data-table">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Invoice No</th>
                    <th>Customer</th>
                    <th class="text-center">Exchanged</th>
                    <th class="text-right pr-5">Refunded</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($saleReturn as $index => $sale)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $sale->invoice_no }}</td>
                      <td>{{ $sale->user->name }}</td>
                      <td class="text-center">{{ $sale->exchanged }}</td>
                      <td class="text-right pr-5">{{ $sale->refund }} Tk</td>
                      <td>
                        @can('sale_return.show')
                          <a class="btn btn-light btn-xs" href="{{ route('sale_return.show', $sale->id) }}">
                            <i class="fa fa-info-circle"></i>
                          </a>
                        @endcan
                        @can('sale_return.manage')
                          <a class="btn btn-light btn-xs" href="{{ route('sale_return.manage') . '?invoice=' . $sale->id }}">
                            <i class="fas fa-tools"></i>
                          </a>
                        @endcan
                        @can('sale_return.delete')
                          <button type="button" class="btn btn-light btn-xs" data-toggle="modal" data-target="#delete-modal-{{ $sale->id }}">
                            <i class="fa fa-trash-alt"></i>
                          </button>

                          <div class="modal fade" id="delete-modal-{{ $sale->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete Sale Return</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Are you confirm to delete this sale return?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-danger btn-sm" form="delete-form-{{ $sale->id }}">Confirm</button>
                                  <form action="{{ route('sale_return.destroy', $sale->id) }}" method="post" id="delete-form-{{ $sale->id }}">
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
                <h6 class="p-4">Sale Return Not Created Yet. Add New Sale Return From
                  <a href="{{ route('sale_return.manage') }}">Here.</a>
                </h6>
              @endif
            </div>
            <!-- /.card-body -->
{{--            @if ($saleReturn->hasPagination)--}}
{{--              <div class="card-footer">--}}
{{--                {{ $saleReturn->links() }}--}}
{{--              </div>--}}
{{--            @endif--}}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('scripts')
  <script>
    $(document).ready(function () {
      $('#sale-return-data-table').DataTable();
    });
  </script>
@endpush
