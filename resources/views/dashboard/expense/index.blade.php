@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">All Expense</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Expense</li>
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
            @can('expense.create')
            <a href="{{ route('expense.create') }}" class="btn btn-sm btn-primary mr-1">Add New</a>
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
            @if ($expenses->count())
            <table class="table" id="expense-data-table">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Category</th>
                  <th>Amount</th>
                  <th>Added By</th>
                  <th>Expense By</th>
                  <th>Date</th>
                  <th>Purpose</th>
                  <th style="width: 40px">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($expenses as $index => $expense)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $expense->category->name }}</td>
                  <td>{{ $expense->amount }}</td>
                  <td>{{ $expense->addedBy->name }}</td>
                  <td>{{ $expense->expenseBy->name }}</td>
                  <td>{{ $expense->date }}</td>
                  <td title="{{ $expense->purpose }}">{{ Str::limit($expense->purpose, 60, '...') }}</td>
                  <td>
                    @can('expense.edit')
                    <a class="btn btn-light btn-xs" href="{{ route('expense.edit', $expense->id) }}">
                      <i class="fa fa-edit"></i>
                    </a>
                    @endcan
                    @can('expense.delete')
                    <button type="button" class="btn btn-light btn-xs" data-toggle="modal" data-target="#delete-modal-{{ $expense->id }}">
                      <i class="fa fa-trash-alt"></i>
                    </button>

                    <div class="modal fade" id="delete-modal-{{ $expense->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-md">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Expense</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            Are you confirm to delete this expense details?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-danger btn-sm" form="delete-form-{{ $expense->id }}">Confirm</button>
                            <form action="{{ route('expense.destroy', $expense->id) }}" method="post" id="delete-form-{{ $expense->id }}">
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
            <h6 class="p-4">Expense Not Added Yet. Add New Expense From
              <a href="{{ route('expense.create') }}">Here</a>
            </h6>
            @endif
          </div>
          <!-- /.card-body -->
{{--          @if ($expenses->hasPagination)--}}
{{--          <div class="card-footer">--}}
{{--            {{ $expenses->links() }}--}}
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
      $('#expense-data-table').DataTable();
    });
  </script>
@endpush
