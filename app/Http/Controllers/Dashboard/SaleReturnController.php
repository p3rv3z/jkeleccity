<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Sale;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SaleReturnController extends Controller
{
  public function index()
  {
    $saleReturn = Sale::whereHas('details.return')->with(['user', 'details', 'details.return'])->get();

//    $this->putSL($saleReturn);

    return view('dashboard.sale_return.index', compact('saleReturn'));
  }

  public function show($id)
  {
    $sale = Sale::with(['details.product', 'details.return'])->findOrFail($id);
    return view('dashboard.sale_return.show', compact('sale'));
  }

  public function manage()
  {
    return view('dashboard.sale_return.create');
  }

  public function destroy($id)
  {
//    Sale::findOrFail($sale_id)->returns()?->delete();

    $sale = Sale::with(['details.product', 'details.return'])->findOrFail($id);

//    return $sale;

    foreach ($sale->details as $saleDetail) {
      $saleDetail->product->sale_return_stock -= $saleDetail->return->quantity;
      if ($saleDetail->return && $saleDetail->return->policy == "exchange") {
        $saleDetail->product->final_stock += $saleDetail->return->quantity;
      }
      $saleDetail->product->save();
    }

    $sale->returns()?->delete();

    return redirect()->route('sale_return.index')->with('success', 'Sale Return successfully deleted');
  }
}
