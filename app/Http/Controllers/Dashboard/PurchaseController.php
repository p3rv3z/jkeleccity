<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PurchaseDetails;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PurchaseController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->checkPermission('purchase.index');

    $purchases = Purchase::where(function ($query) {
      $search = request()->get('search');
      if ($search) {
        $query->where('invoice_no', 'like', "%{$search}%");
      }
    })->orderBy('id', $this->defaultOrderBy)->get();
    //    $this->putSL($purchases);
    return view('dashboard.purchase.index', compact('purchases'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $this->checkPermission('purchase.create');

    //    $invoice_no = Purchase::count() ? Purchase::latest()->first()->invoice_no + 1 : 1;
    //    $invoice_no = str_pad($invoice_no, 4, '0', STR_PAD_LEFT);
    return view('dashboard.purchase.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->checkPermission('purchase.create');

    $request->validate([
      'user_id'    => ['required', 'exists:users,id'],
      'invoice_no' => ['required', 'unique:purchases,invoice_no'],
      //			'lc_no'              => ['required', 'string', 'max:255'],
      //			'lot_no'             => ['required', 'string', 'max:255'],
      //			'container_no'       => ['required', 'string', 'max:255'],
      'c_invoice_no'      => ['required',],
      'date'              => ['required', 'date'],
      'idProducts'        => ['required', 'array', 'exists:products,id'],
      'productQuantities' => ['required', 'array'],
      'productUnitPrices' => ['required', 'array'],
      'productRegularPrices' => ['required', 'array'],
      'productOfferPrices' => ['required', 'array'],
      'remark'            => ['nullable', 'string'],
      'cost_amount'       => ['required', 'integer'],
      'discount'          => ['required', 'integer'],
      'paid_amount'       => ['required', 'integer'],
      'payment_type'      => ['required', Rule::in(['cheque', 'cash', 'card'])],
      'bank_name'         => ['exclude_if:payment_type,cash,card', 'required', 'string'],
      'cheque_no'         => ['exclude_if:payment_type,cash,card', 'required', 'integer'],
      'card_type'         => ['exclude_if:payment_type,cash,cheque', 'required', 'string'],
      'card_no'           => ['exclude_if:payment_type,cash,cheque', 'required', 'integer'],
      'action'            => ['required', Rule::in('save&print', 'save&close')],
    ]);

    $purchase = Purchase::create([
      'user_id'    => $request->get('user_id'),
      'invoice_no' => $request->get('invoice_no'),
      //			'lc_no'           => $request->get('lc_no'),
      //			'lot_no'          => $request->get('lot_no'),
      //			'container_no'    => $request->get('container_no'),
      'c_invoice_no' => $request->get('c_invoice_no'),
      'date'         => $request->get('date'),
      'remark'       => $request->get('remark'),
      'cost_amount'  => $request->get('cost_amount'),
      'discount'     => $request->get('discount'),
      'paid_amount'  => $request->get('paid_amount'),
      'payment_type' => $request->get('payment_type'),
      'bank_name'    => $request->get('bank_name'),
      'cheque_no'    => $request->get('cheque_no'),
      'card_type'    => $request->get('card_type'),
      'card_no'      => $request->get('card_no'),
    ]);

    foreach ($request->get('idProducts') as $index => $productID) {
      $productQuantity = $request->get('productQuantities')[$index];
      PurchaseDetails::create([
        'purchase_id' => $purchase->id,
        'product_id'  => $productID,
        'quantity'    => $productQuantity,
        'unit_price'  => $request->get('productUnitPrices')[$index],
        'regular_price'  => $request->get('productRegularPrices')[$index],
        'offer_price' => $request->get('productOfferPrices')[$index],
      ]);
      $product               = Product::find($productID);
      $product->final_stock += $productQuantity;
      $product->save();
    }

    $message = 'Purchase Done.';
    return ($request->get('action') == 'save&print' ? redirect()->route('purchase.show', compact('purchase')) : redirect()->route('purchase.index'))->with('success', $message);
  }

  /**
   * Display the specified resource.
   *
   * @param Purchase $purchase
   * @return View
   */
  public function show(Purchase $purchase)
  {
    $this->checkPermission('purchase.show');

    $users = User::role('Supplier')->get(['id', 'name', 'email', 'phone', 'fax', 'website']);
    return view('dashboard.purchase.show', compact('users', 'purchase'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $this->checkPermission('purchase.edit');

    $purchase = Purchase::findOrFail($id);
    $users    = User::role(['Supplier'])->get(['id', 'name']);
    return view('dashboard.purchase.edit', compact('purchase', 'users'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Purchase $purchase)
  {
    $this->checkPermission('purchase.edit');

    $request->validate([
      'user_id'    => ['required', 'exists:users,id'],
      'invoice_no' => ['required', 'unique:purchases,invoice_no,' . $purchase->id],
      //			'lc_no'                       => ['required', 'string', 'max:255'],
      //			'lot_no'                      => ['required', 'string', 'max:255'],
      //			'container_no'                => ['required', 'string', 'max:255'],
      'c_invoice_no'               => ['required',],
      'date'                       => ['required', 'date'],
      'deletablePurchaseDetailsID' => ['nullable', 'array', 'exists:purchase_details,id'],
      'purchaseDetailsID'          => ['nullable', 'array', 'exists:purchase_details,id'],
      'idProducts'                 => ['required', 'array', 'exists:products,id'],
      'productQuantities'          => ['required', 'array'],
      'productUnitPrices'          => ['required', 'array'],
      'productRegularPrices'          => ['required', 'array'],
      'productOfferPrices'          => ['required', 'array'],
      'remark'                     => ['nullable', 'string'],
      'cost_amount'                => ['required', 'integer'],
      'discount'                   => ['required', 'integer'],
      'paid_amount'                => ['required', 'integer'],
      'payment_type'               => ['required', Rule::in(['cheque', 'cash', 'card'])],
      'bank_name'                  => ['exclude_if:payment_type,cash,card', 'required', 'string'],
      'cheque_no'                  => ['exclude_if:payment_type,cash,card', 'required', 'integer'],
      'card_type'                  => ['exclude_if:payment_type,cash,cheque', 'required', 'string'],
      'card_no'                    => ['exclude_if:payment_type,cash,cheque', 'required', 'integer'],
      'action'                     => ['required', Rule::in('update&print', 'update&close')],
    ], [
      'idProducts.required' => 'You must have to add some product.',
    ]);

    $purchase->update([
      'user_id'    => $request->get('user_id'),
      'invoice_no' => $request->get('invoice_no'),
      //			'lc_no'           => $request->get('lc_no'),
      //			'lot_no'          => $request->get('lot_no'),
      //			'container_no'    => $request->get('container_no'),
      'c_invoice_no' => $request->get('c_invoice_no'),
      'date'         => $request->get('date'),
      'remark'       => $request->get('remark'),
      'cost_amount'  => $request->get('cost_amount'),
      'discount'     => $request->get('discount'),
      'paid_amount'  => $request->get('paid_amount'),
      'payment_type' => $request->get('payment_type'),
      'bank_name'    => $request->get('bank_name'),
      'cheque_no'    => $request->get('cheque_no'),
      'card_type'    => $request->get('card_type'),
      'card_no'      => $request->get('card_no'),
    ]);

    $deletablePurchaseDetailsID = $request->get('deletablePurchaseDetailsID', []);
    $purchaseDetailsID          = $request->get('purchaseDetailsID', []);
    $productQuantities          = $request->get('productQuantities');
    $productUnitPrices          = $request->get('productUnitPrices');
    $productRegularPrices          = $request->get('productRegularPrices');
    $productOfferPrices         = $request->get('productOfferPrices');

    foreach ($request->get('idProducts') as $index => $productID) {
      $product = Product::find($productID);
      if (array_key_exists($index, $purchaseDetailsID)) {
        $purchaseDetails = PurchaseDetails::find($purchaseDetailsID[$index]);
        if ($purchaseDetails->quantity != $productQuantities[$index]) {
          $product->final_stock -= $purchaseDetails->quantity;
          $product->final_stock += $productQuantities[$index];
        }
        $purchaseDetails->update([
          'product_id'  => $productID,
          'quantity'    => $productQuantities[$index],
          'unit_price'  => $productUnitPrices[$index],
          'regular_price'  => $productRegularPrices[$index],
          'offer_price' => $productOfferPrices[$index],
        ]);
      } else {
        PurchaseDetails::create([
          'purchase_id' => $purchase->id,
          'product_id'  => $productID,
          'quantity'    => $productQuantities[$index],
          'unit_price'  => $productUnitPrices[$index],
          'regular_price'  => $productRegularPrices[$index],
          'offer_price' => $productOfferPrices[$index],
        ]);
        $product->final_stock += $productQuantities[$index];
      }
      $product->save();
    }

    foreach ($deletablePurchaseDetailsID as $detailsID) {
      $details                        = PurchaseDetails::find($detailsID);
      $details->product->final_stock -= $details->quantity;
      $details->product->save();
      $details->delete();
    }

    $message = 'Purchase Invoice Successfully Updated.';
    return ($request->get('action') == 'update&print' ? redirect()->route('purchase.show', compact('purchase')) : redirect()->route('purchase.index'))->with('success', $message);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Purchase $purchase)
  {
    $this->checkPermission('purchase.delete');

    // Updating product stock
    $purchase->details()->each(function ($detail) {
      $detail->product->final_stock -= $detail->quantity;
      $detail->product->save();
    });

    $purchase->delete();
    return back()->with('success', 'Purchase invoice successfully deleted.');
  }
}
