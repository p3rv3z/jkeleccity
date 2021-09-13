@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Expense Report</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
          <li class="breadcrumb-item">Reports</li>
          <li class="breadcrumb-item active">Expense Report</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <form>
              <div class="form-row">
                <div class="form-group col-md-3 mb-md-0">
                  <label for="cat_id">Expense Category:</label>
                  <select class="form-control form-control-sm select2 @error ('unit_price') is-invalid @enderror" id="cat_id" name="cat_id" required>
                    <option selected>Select Category</option>
                    <option value="all" {{ (request()->get('cat_id') == 'all' || request()->get('cat_id') == null) ? 'selected' : null }}>All</option>
                    @foreach ($expenseCategories as $category)
                    <option value="{{ $category->id }}" {{ (request()->get('cat_id') == $category->id) ? 'selected' : null }}>{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group col-md-3 mb-md-0">
                  <label for="date_range">Date range:</label>
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right text-center date_range_picker" id="date_range" name="date_range" value="{{ $dateRange->startDate->format('m/d/Y') }} - {{ $dateRange->endDate->format('m/d/Y') }}">
                  </div>
                </div>
                <div class="form-group mb-0 col align-self-end">
                  <button class="btn btn-primary btn-sm">Filter</button>
                  @if (request()->has('cat_id') || request()->has('date_range'))
                  <a class="btn btn-danger btn-sm" href="{{ route('report.expense') }}">Reset</a>
                  @endif
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <table id="expense-report-table" class="table">
              <thead>
                <tr>
                  <th>Category</th>
                  <th>Added By</th>
                  <th>Expense By</th>
                  {{-- <th>Purpose</th> --}}
                  <th>Date</th>
                  <th class="text-center">Amount</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($expenses as $expense)
                <tr>
                  <td>{{ $expense->category->name }}</td>
                  <td>{{ $expense->addedBy->name }}</td>
                  <td>{{ $expense->expenseBy->name }}</td>
                  <td>{{ $expense->date }}</td>
                  <td class="text-right">{{ number_format($expense->amount) }} TK</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot id="expense-report-table-footer">
                <tr>
                  <th></th>
                  <th></th>
                  <th class="text-center">Total Expense</th>
                  <th></th>
                  <th class="text-right"></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
  $(document).ready(function () {
    $('#expense-report-table').DataTable({
      "footerCallback": function (row, data, start, end, display) {
        if (data.length > 0) {
          var api = this.api(), data;

          // Remove the formatting to get integer data for summation
          var intVal = function ( i ) {
            return typeof i === 'string' ? i.replace(/[\$,'TK'' ']/g, '')*1 : typeof i === 'number' ? i : 0;
          };

          // Total over all pages
          total = api.column(4).data().reduce( function (a, b) {
            return intVal(a) + intVal(b);
          }, 0);

          // Total over this page
          // pageTotal = api.column( 4, { page: 'current'} ).data().reduce( function (a, b) {
          //   return intVal(a) + intVal(b);
          // }, 0);

          // Number formatting
          let format = function number_format(number) {
            return number.toString().replace(/./g, function(c, i, a) {
              return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
            });
          }

          // Update footer
          $(api.column(4).footer()).html(format(total) +' TK');
        } else {
          $('#expense-report-table-footer').remove();
        }
      }
    })
  });
</script>
@endpush
