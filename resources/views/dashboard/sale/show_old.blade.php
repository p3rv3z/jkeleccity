@extends('layouts.dashboard')

@section('content')

<style>
  .invoice-container {
    margin: 15px auto;
    max-width: 850px;
    padding: 50px;
    background-color: #fff;
    border: 1px solid #ebebeb;
    border-radius: 6px;
  }

  @media only screen and (max-width: 778px) {
    .invoice-container {
      padding: 20px;
    }
  }
</style>

<!-- /.content-header -->
<div class="container-fluid invoice-container">
  <!-- Header -->
  <header>
    <div class="row align-items-center">
      <div class="col-sm-7 text-center text-sm-left mb-3 mb-sm-0">
        @if ($appConfig->logo)
        <img id="logo" class="mb-2" src="{{$appConfig->logo}}" title="{{ $appConfig->name ?? 'Inventory MGT' }}" alt="{{ $appConfig->name ?? 'Inventory MGT' }}">
        @else
        <h4 class="text-7 mb-2">{{ $appConfig->name ?? 'Inventory MGT' }}</h4>
        @endif
      </div>
      <div class="col-sm-5 text-center text-sm-right">
        {{ Carbon\Carbon::parse($sale->created_at)->format('d M Y') }}
      </div>
    </div>
    <hr>
  </header>

  <!-- Main Content -->
  <main>
    <div class="row">
      <div class="col-sm-6 text-sm-right order-sm-1"> Pay To:
        <address>
          {{ $appConfig->name ?? 'Inventory MGT' }}<br>
          {{ $appConfig->address ?? 'Chittagong, Bangladesh' }}<br>
          {{ $appConfig->email ?? 'contact@inventory.com' }}
        </address>
      </div>
      <div class="col-sm-6 order-sm-0"> Invoiced To:
        <address>
          {{$sale->user->name}}
          {{$sale->user->address}}<br>
          {{$sale->user->phone}}<br>
          {{$sale->user->email}}
        </address>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="text-sm-right pb-2">
          Invoice No: {{ $sale->invoice_no }}
        </div>
      </div>
    </div>
    <div class="table-responsive mt-2">
      <table class="table table-sm table-borderless">
        <thead class="border">
          <tr>
            <td class="border text-center" style="width: 40px">#</td>
            <td class="border">Product Model Name</td>
            <td class="border text-center" style="width: 80px">Rate</td>
            <td class="border text-center" style="width: 80px">QTY</td>
            <td class="border text-center" style="width: 80px">Amount</td>
          </tr>
        </thead>
        <tbody class="border">
          @foreach ($sale->details as $i => $details)
          <tr>
            <td class="p-2 border-right text-center" style="width: 40px">{{ $i }}</td>
            <td class="p-2 border-right">{{$details->product->model_name}}</td>
            <td class="p-2 border-right text-center" style="width: 80px">&#2547;{{$details->unit_price}}</td>
            <td class="p-2 border-right text-center" style="width: 80px">{{$details->quantity}}</td>
            <td class="p-2 text-center" style="width: 80px">&#2547;{{$details->unit_price * $details->quantity}}</td>
          </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td class="text-right pt-3" colspan="4">Grand Total</td>
            <td class="text-right pt-3">&#2547;{{ $sale->cost_amount }}</td>
          </tr>
          @if ($sale->discount > 0 )
          <tr>
            <td class="text-right" colspan="4">Discount</td>
            <td class="text-right">&#2547;{{ $sale->discount}}</td>
          </tr>
          <tr>
            <td class="text-right" colspan="4">Total</td>
            <td class="text-right">&#2547;{{$sale->cost_amount - $sale->discount}}</td>
          </tr>
          @endif
          <tr>
            <td class="text-right" colspan="4">Due</td>
            <td class="text-right">&#2547;{{($sale->cost_amount - $sale->discount) - $sale->paid_amount}}</td>
          </tr>
          <tr>
            <td class="text-right" colspan="4">Paid</td>
            <td class="text-right">&#2547;{{ $sale->paid_amount}}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </main>
  <!-- Footer -->
  <footer class="text-center mt-4">
    <svg class="barcode" data-height="40" data-displayValue="false" data-value="{{ $sale->invoice_no }}"></svg>
    <p class="mt-4">NOTE : This is computer generated receipt and does not require physical signature.</p>
    <div class="btn-group btn-group-sm d-print-none"> <a href="javascript:window.print()" class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a> <a href=""
        class="btn btn-light border text-black-50 shadow-none"><i class="fa fa-download"></i> Download</a> </div>
  </footer>
</div>
@endsection
