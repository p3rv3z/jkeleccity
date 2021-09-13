<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\PurchaseReturn;
use Illuminate\Http\Request;

class PurchaseReturnController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $purchaseReturn = Purchase::whereHas('details.return')->with(['user', 'details', 'details.return'])->get();

    //    $this->putSL($purchaseReturn);

    return view('dashboard.purchase_return.index', compact('purchaseReturn'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function manage()
  {
    return view('dashboard.purchase_return.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $purchase = Purchase::with(['details.product', 'details.return'])->findOrFail($id);
    // return $purchase;
    return view('dashboard.purchase_return.show', compact('purchase'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $purchase = Purchase::with(['details.product', 'details.return'])->findOrFail($id);

    foreach ($purchase->details as $purchaseDetail) {
      if ($purchaseDetail->return && $purchaseDetail->return->policy === 'refund') {
        $purchaseDetail->product->purchase_return_stock -= $purchaseDetail->return->quantity;
        $purchaseDetail->product->final_stock += $purchaseDetail->return->quantity;
        $purchaseDetail->product->save();
      }
    }

    $purchase->returns()?->delete();

    return redirect()->route('purchase_return.index')->with('success', 'Purchase Return successfully deleted');
  }
}
