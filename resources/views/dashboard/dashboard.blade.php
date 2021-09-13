@extends('layouts.dashboard')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="mb-2 row">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->


  {{--  cards--}}
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-gradient-navy">
            <div class="inner">
              <h3>{{ \App\Models\User::role('Supplier')->count() }}{{-- <supstyle="font-size:20px">%</sup> --}}</h3> {{-- Temporarily Added - get this after page load --}}

              <p>Suppliers</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('user.index') }}" class="small-box-footer">More info
              <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-gradient-navy">
            <div class="inner">
              <h3>{{ \App\Models\Product::all()->count() }}</h3>

              <p>Products</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('product.index') }}" class="small-box-footer">More info
              <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-gradient-navy">
            <div class="inner">
              <h3>{{ \App\Models\Brand::all()->count() }}</h3>

              <p>Brands</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('brand.index') }}" class="small-box-footer">More info
              <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-gradient-navy">
            <div class="inner">
              <h3>{{ \App\Models\Category::all()->count() }}</h3>

              <p>Categories</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('category.index')}}" class="small-box-footer">More info
              <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </div>
  </section>
  {{--cards end  --}}

  {{--  stocks--}}
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header bg-gradient-success">
              In Stock
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              @if ($products->count())
                <table class="table" id="stocks-data-table">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    {{--                    <th>Name</th>--}}
                    {{--                    <th>Barcode</th>--}}
                    <th>Model Name</th>
                    <th>Description</th>
                    {{-- <th>Category</th> --}}
                    <th>Brand</th>
                    <th class="text-center">In Stock</th>
                    <th class="text-center">PRS</th>
                    <th class="pr-4 text-center">SRS</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($products as $index => $product)
                    <tr>
                      <td>{{ $index + 1}}</td>
                      {{--                      <td>{{ $product->name }}</td>--}}
                      {{--                      <td>--}}
                      {{--                        <svg class="barcode"--}}
                      {{--                             data-height="10"--}}
                      {{--                             data-width="1"--}}
                      {{--                             data-format="EAN13"--}}
                      {{--                             data-displayValue="true"--}}
                      {{--                             data-value="{{ $product->code }}"></svg>--}}
                      {{--                      </td>--}}
                      <td>{{ $product->model_name }}</td>
                      <td>{{ Str::limit($product->description, 60, '...') }}</td>
                      {{-- <td>{{ $product->category->name }}</td> --}}
                      <td>{{ $product->brand->name }}</td>
                      <td class="text-center">{{ $product->final_stock }}</td>
                      <td class="text-center">{{ $product->purchase_return_stock }}</td>
                      <td class="pr-4 text-center">{{ $product->sale_return_stock }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              @else
                <h6 class="p-4">Product Not Added Yet. Add New Product From
                  <a href="{{ route('product.create') }}">Here</a>
                </h6>
              @endif
            </div>
            <!-- /.card-body -->
{{--            @if ($products->hasPagination)--}}
{{--              <div class="card-footer">--}}
{{--                {{ $products->links() }}--}}
{{--              </div>--}}
{{--            @endif--}}
          </div>
        </div>
      </div>
    </div>
  </section>
  {{--  stocks end--}}

  {{-- out of stock--}}
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header bg-gradient-red">
              Out of Stock
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              @if ($outOfStocks->count())
                <table class="table" id="out-of-stock-data-table">
                  <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    {{--                    <th>Name</th>--}}
                    {{--                    <th>Barcode</th>--}}
                    <th>Model Name</th>
                    <th>Description</th>
                    {{-- <th>Category</th> --}}
                    <th>Brand</th>
                    <th class="text-center">In Stock</th>
                    <th class="text-center">PRS</th>
                    <th class="pr-4 text-center">SRS</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($outOfStocks as $index => $outOfStock)
                    <tr>
                      <td>{{ $index + 1}}</td>
                      {{--                      <td>{{ $outOfStock->name }}</td>--}}
                      {{--                      <td>--}}
                      {{--                        <svg class="barcode"--}}
                      {{--                             data-height="10"--}}
                      {{--                             data-width="1"--}}
                      {{--                             data-format="EAN13"--}}
                      {{--                             data-displayValue="true"--}}
                      {{--                             data-value="{{ $outOfStock->code }}"></svg>--}}
                      {{--                      </td>--}}
                      <td>{{ $outOfStock->model_name }}</td>
                      <td>{{ Str::limit($outOfStock->description, 60, '...') }}</td>
                      {{-- <td>{{ $outOfStock->category->name }}</td> --}}
                      <td>{{ $outOfStock->brand->name }}</td>
                      <td class="text-center text-danger">{{ $outOfStock->final_stock }}</td>
                      <td class="text-center">{{ $outOfStock->purchase_return_stock }}</td>
                      <td class="pr-4 text-center">{{ $outOfStock->sale_return_stock }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              @else
                <h6 class="p-4">Product Not Added Yet. Add New Product From
                  <a href="{{ route('product.create') }}">Here</a>
                </h6>
              @endif
            </div>
            <!-- /.card-body -->
            {{--            @if ($products->hasPagination)--}}
            {{--              <div class="card-footer">--}}
            {{--                {{ $products->links() }}--}}
            {{--              </div>--}}
            {{--            @endif--}}
          </div>
        </div>
      </div>
    </div>
  </section>
  {{-- out of stock end--}}

  {{--today sales--}}
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header bg-gradient-navy">
              Today Sales
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              @if ($sales->count())
                <table class="table" id="sales-data-table">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Customer</th>
                    <th>Invoice No</th>
                    <th class="text-right">Cost Amount</th>
                    <th class="text-right">Discount</th>
                    <th class="text-right">Paid Amount</th>
                    <th class="text-right">Due Amount</th>
                    <th class="pr-4 text-right">Extra Paid</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($sales as $index => $sale)
                    <tr>
                      <td>{{ $index + 1}}</td>
                      <td>{{ $sale->user->name }}</td>
                      <td>{{ $sale->invoice_no }}</td>
                      <td class="text-right">{{ $sale->cost_amount }} TK</td>
                      <td class="text-right">{{ $sale->discount }} TK</td>
                      <td class="text-right">{{ $sale->paid_amount }} TK</td>
                      <td class="text-right">{{ $sale->due_amount > 0 ? $sale->due_amount : 0 }} TK</td>
                      <td class="pr-4 text-right">{{ $sale->due_amount < 0 ? abs($sale->due_amount) : 0 }} TK</td>
                      <td>{{ $sale->date }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              @else
                <h6 class="p-4">Sale Not Added Yet. Add New Sale From
                  <a href="{{ route('sale.create') }}">Here.</a>
                </h6>
              @endif
            </div>
            <!-- /.card-body -->
{{--            @if ($sales->hasPagination)--}}
{{--              <div class="card-footer">--}}
{{--                {{ $sales->links() }}--}}
{{--              </div>--}}
{{--            @endif--}}
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- today sales end -->

  {{--today purchases--}}
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header bg-gradient-navy">
              Today Purchases
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive">
              @if ($purchases->count())
                <table class="table" id="purchases-data-table">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Supplier</th>
                    <th>Invoice No</th>
                    <th class="text-right">Cost Amount</th>
                    <th class="text-right">Discount</th>
                    <th class="text-right">Paid Amount</th>
                    <th class="text-right">Due Amount</th>
                    <th class="pr-4 text-right">Extra Paid</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($purchases as $index => $purchase)
                    <tr>
                      <td>{{ $index + 1}}</td>
                      <td>{{ $purchase->user->name }}</td>
                      <td>{{ $purchase->invoice_no }}</td>
                      <td class="text-right">{{ $purchase->cost_amount }} TK</td>
                      <td class="text-right">{{ $purchase->discount }} TK</td>
                      <td class="text-right">{{ $purchase->paid_amount }} TK</td>
                      <td class="text-right">{{ $purchase->due_amount > 0 ? $purchase->due_amount : 0 }} TK</td>
                      <td class="pr-4 text-right">{{ $purchase->due_amount < 0 ? abs($purchase->due_amount) : 0 }}TK
                      </td>
                      <td>{{ $purchase->date }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              @else
                <h6 class="p-4">Purchase Not Added Yet. Add New Purchase From
                  <a href="{{ route('purchase.create') }}">Here.</a>
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
  <!-- today purchases end -->

{{--  Main content end--}}
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
      $('#stocks-data-table').DataTable();
      $('#sales-data-table').DataTable();
      $('#purchases-data-table').DataTable();
      $('#out-of-stock-data-table').DataTable();
    });
  </script>
@endpush
