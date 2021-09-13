@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h4 class="m-0 text-dark">Purchase Information</h4>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active"><a href="{{ route('purchase.index') }}">Purchase</a></li>
          <li class="breadcrumb-item active">Purchase Information</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<section class="content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12">

        <!-- Main content -->
        <div class="invoice p-3 mb-3">
          <!-- title row -->
          <div class="row mb-4">
            <div class="col-12">
              <h4>
                @if($appConfig->logo)
                  <img width="165" height="50" id="logo" class="mb-2" src="{{ asset('config_images/'.$appConfig->logo) }}" title="{{ $appConfig->name ?? 'Inventory MGT' }}" alt="{{ $appConfig->name ?? 'Inventory MGT' }}">
                @else
                  {{ $appConfig->name ?? 'Inventory MGT' }}
                @endif
                {{-- <small class="float-right">Print Date: {{ Carbon\Carbon::now()->format('d M Y') }}</small> --}}
              </h4>
            </div>
            <!-- /.col -->
          </div>
          <!-- info row -->
          <div class="row invoice-info mb-4">
            <div class="col-sm-4 invoice-col">
              From
              <address>
                <strong>{{ $appConfig->name ?? 'Inventory MGT' }}</strong><br>
                {{ $appConfig->address ?? 'Chittagong, Bangladesh' }}<br>
                Phone: {{ $appConfig->helpline ?? '018XXXXXX' }}<br>
                Email: {{ $appConfig->email ?? 'support@jkeleccity.com' }}
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              To
              <address>
                <strong>{{ $purchase->user->name }}</strong><br>
                {{ $purchase->user->address }}<br>
                Fax: {{ $purchase->user->fax }}<br>
                Phone: (+880) {{ $purchase->user->phone }}<br>
                Email: {{ $purchase->user->email }}
              </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
              <br>
              <b>Invoice No: </b>#{{ $purchase->invoice_no }}<br>
              <b>Supplier Invoice No: </b>#{{ $purchase->c_invoice_no }}<br>
              <b>Date:</b> {{ Carbon\Carbon::parse($purchase->created_at)->format('d M Y') }}
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Table row -->
          <div class="row">
            <div class="col-12 table-responsive">
              <table class="table table-striped border">
                <thead>
                  <tr>
                    <th class="border text-center" style="width: 40px">#</th>
                    <th class="border">Model</th>
                    <th class="border text-center" style="width: 80px">Rate</th>
                    <th class="border text-center" style="width: 80px">QTY</th>
                    <th class="border text-center" style="width: 80px">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($purchase->details as $i => $details)
                    <tr>
                      <td class="p-2 border-right text-center" style="width: 40px">{{ $i }}</td>
                      <td class="p-2 border-right" style="width: 80px">{{ $details->product->model_name }}</td>
                      <td class="p-2 border-right text-center" style="width: 80px">&#2547;{{ $details->unit_price }}</td>
                      <td class="p-2 border-right text-center" style="width: 80px">{{ $details->quantity }}</td>
                      <td class="p-2 text-center" style="width: 80px">&#2547;{{ $details->unit_price * $details->quantity }}</td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <!-- accepted payments column -->
            <div class="col-6">
              <p class="lead">Payment Method:</p>
              <b>Payment Type: </b>{{ $purchase->payment_type }}<br>
              @if($purchase->payment_type == 'card')
                <br>
                <b>Card Type: </b>{{ $purchase->card_type }}<br>
                <b>Card No: </b>{{ $purchase->card_no }}
              @endif
              @if($purchase->payment_type == 'cheque')
                <br>
                <b>Bank Name: </b>{{ $purchase->bank_name }}<br>
                <b>Bank No: </b>{{ $purchase->bank_no }}
              @endif
            </div>
            <!-- /.col -->
            <div class="col-6">
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                    <tr>
                      <th>Grand Total</th>
                      <td>&#2547;{{ $purchase->cost_amount }}</td>
                    </tr>
                    @if($purchase->discount > 0 )
                      <tr>
                        <th>Discount</th>
                        <td>&#2547;{{ $purchase->discount }}</td>
                      </tr>
                      <tr>
                        <th>Total</th>
                        <td>&#2547;{{ $purchase->cost_amount - $purchase->discount }}</td>
                      </tr>
                    @endif
                    <tr>
                      <th>Due</th>
                      <td>&#2547;{{ ( $purchase->cost_amount - $purchase->discount ) - $purchase->paid_amount }}</td>
                    </tr>
                    <tr>
                      <th>Paid</th>
                      <td>&#2547;{{ $purchase->paid_amount }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- this row will not appear when printing -->
          <footer class="text-center mt-4">
            <svg class="barcode" data-height="40" data-displayValue="false" data-value="{{ $purchase->invoice_no }}"></svg>
            <p class="mt-4">NOTE : This is computer generated receipt and does not require physical signature.</p>
            <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a> <a href=""
                class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-download"></i> Download</a> </div>
          </footer>
        </div>
        <!-- /.invoice -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection