@extends('layouts.dashboard')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h4 class="m-0 text-dark">All Purchase</h4>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Purchase</li>
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
              @can('purchase.create')
                <a href="{{ route('purchase.create') }}" class="btn btn-sm btn-primary mr-1">Add New</a>
              @endcan

{{--              <div class="card-tools">--}}
{{--                <form class="form-inline mr-3">--}}
{{--                  <div class="input-group input-group-sm custom-search" style="width: 188px">--}}
{{--                    <input class="form-control form-control-navbar"--}}
{{--                           name="search"--}}
{{--                           type="search"--}}
{{--                           value="{{ request()->get('search') }}"--}}
{{--                           placeholder="Search by invoice no"--}}
{{--                           aria-label="Search"/>--}}
{{--                    <div class="input-group-append">--}}
{{--                      <button class="btn btn-navbar" type="submit">--}}
{{--                        <i class="fas fa-search"></i>--}}
{{--                      </button>--}}
{{--                    </div>--}}
{{--                  </div>--}}
{{--                </form>--}}
{{--              </div>--}}
{{--              @if (request()->get('search'))--}}
{{--                <a href="{{ route('purchase.index') }}" class="btn btn-sm btn-danger">Clear</a>--}}
{{--              @endif--}}
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              @if ($purchases->count())
                <table class="table" id="purchase-data-table">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Supplier</th>
                    <th>Invoice No</th>
                    <th>C-Invoice No</th>
                    <th class="text-right">Cost Amount</th>
                    <th class="text-right">Discount</th>
                    <th class="text-right">Paid Amount</th>
                    <th class="text-right pr-4">Due Amount</th>
                    <th>Date</th>
                    <th style="width: 40px">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($purchases as $index => $purchase)
                    <tr>
                      <td>{{ $index + 1 }}</td>
                      <td>{{ $purchase->user->name }}</td>
                      <td>{{ $purchase->invoice_no }}</td>
                      <td>{{ $purchase->c_invoice_no }}</td>
                      <td class="text-right">{{ $purchase->cost_amount }} TK</td>
                      <td class="text-right">{{ $purchase->discount }} TK</td>
                      <td class="text-right">{{ $purchase->paid_amount }} TK</td>
                      <td class="text-right pr-4">{{ $purchase->due_amount > 0 ? $sale->due_amount : 0 }} TK</td>
                      <td>{{ $purchase->date }}</td>
                      <td>
                        @can('purchase.show')
                          <a class="btn btn-light btn-xs" href="{{ route('purchase.show', $purchase->id) }}">
                            <i class="fa fa-info-circle"></i>
                          </a>
                        @endcan
                        @can('purchase.edit')
                          <a class="btn btn-light btn-xs" href="{{ route('purchase.edit', $purchase->id) }}">
                            <i class="fa fa-edit"></i>
                          </a>
                        @endcan
                        @can('purchase.delete')
                          <button type="button"
                                  class="btn btn-light btn-xs"
                                  data-toggle="modal"
                                  data-target="#delete-modal-{{ $purchase->id }}">
                            <i class="fa fa-trash-alt"></i>
                          </button>
                          <div class="modal fade"
                               id="delete-modal-{{ $purchase->id }}"
                               tabindex="-1"
                               aria-labelledby="exampleModalLabel"
                               aria-hidden="true">
                            <div class="modal-dialog modal-md">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Delete Purchase</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Careful, This with effect in product stock?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                                  <button type="submit"
                                          class="btn btn-danger btn-sm"
                                          form="delete-form-{{ $purchase->id }}">Confirm
                                  </button>
                                  <form action="{{ route('purchase.destroy', $purchase->id) }}"
                                        method="post"
                                        id="delete-form-{{ $purchase->id }}">
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
                <h6 class="p-4">Purchase Not Added Yet. Add New Purchase From
                  <a href="{{ route('purchase.create') }}">Here</a>
                </h6>
              @endif
            </div>
            <!-- /.card-body -->
{{--            @if ($purchases->hasPagination)--}}
{{--              <div class="card-footer">--}}
{{--                {{ $purchases->links() }}--}}
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
      $('#purchase-data-table').DataTable();
    });
  </script>
@endpush
