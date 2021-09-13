<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Sale;
use App\Models\User;
use App\Models\Product;
use Illuminate\View\View;
use App\Models\SaleDetails;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SaleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return View
   */
  public function index()
  {
    $this->checkPermission('sale.index');

    $sales = Sale::when(request()->has('search'), function ($query) {
      return $query->where('invoice_no', 'like', '%' . request()->get('search') . '%');
    })->with('user')->orderBy('id', $this->defaultOrderBy)->get();
//    $this->putSL($sales);
    return view('dashboard.sale.index', compact('sales'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return View
   */
  public function create()
  {
    $this->checkPermission('sale.create');
    return view('dashboard.sale.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request)
  {
    $this->checkPermission('sale.create');

    $request->validate([
      'user_id' => ['required', 'exists:users,id'],
      'invoice_no' => ['required', 'unique:sales,invoice_no'],
      'date' => ['required', 'date'],
      'idProducts' => ['required', 'array', 'exists:products,id'],
      'productQuantities' => ['required', 'array'],
      'productUnitPrices' => ['required', 'array'],
      'cost_amount' => ['required', 'integer'],
      'discount' => ['required', 'integer'],
      'paid_amount' => ['required', 'integer'],
      'payment_type' => ['required', Rule::in(['cheque', 'cash', 'card'])],
      'bank_name' => ['exclude_if:payment_type,cash,card', 'required', 'string'],
      'cheque_no' => ['exclude_if:payment_type,cash,card', 'required', 'integer'],
      'card_type' => ['exclude_if:payment_type,cash,cheque', 'required', 'string'],
      'card_no' => ['exclude_if:payment_type,cash,cheque', 'required', 'integer'],
      'action' => ['required', Rule::in('save&print', 'save&close')],
    ], [
      'idProducts.required' => 'You must have to add some product.',
    ]);

    $sale = Sale::create([
      'user_id' => $request->get('user_id'),
      'invoice_no' => $request->get('invoice_no'),
      'date' => $request->get('date'),
      'cost_amount' => $request->get('cost_amount'),
      'discount' => $request->get('discount'),
      'paid_amount' => $request->get('paid_amount'),
      'payment_type' => $request->get('payment_type'),
      'bank_name' => $request->get('bank_name'),
      'cheque_no' => $request->get('cheque_no'),
      'card_type' => $request->get('card_type'),
      'card_no' => $request->get('card_no'),
    ]);

    foreach ($request->get('idProducts') as $index => $productID) {
      $productQuantity = $request->get('productQuantities')[$index];
      SaleDetails::create([
        'sale_id' => $sale->id,
        'product_id' => $productID,
        'quantity' => $productQuantity,
        'unit_price' => $request->get('productUnitPrices')[$index],
      ]);
      $product = Product::find($productID);
      $product->final_stock -= $productQuantity;
      $product->save();
    }

    $message = 'Sale invoice successfully created.';
    return ($request->get('action') === 'save&print' ? redirect()->route('sale.show', $sale) : redirect()->route('sale.index'))->with('success', $message);
  }

  /**
   * Display the specified resource.
   *
   * @param Sale $sale
   * @return View
   */
  public function show(Sale $sale)
  {
    $this->checkPermission('sale.show');

    $users = User::role('Customer')->get(['id', 'name', 'email', 'phone']);

    return view('dashboard.sale.show', compact('users', 'sale'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Sale $sale
   * @return View
   */
  public function edit(Sale $sale)
  {
    $this->checkPermission('sale.edit');

    $users = User::role('Customer')->get(['id', 'name']);
    return view('dashboard.sale.edit', compact('users', 'sale'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param Request $request
   * @param Sale $sale
   * @return RedirectResponse
   */
  public function update(Request $request, Sale $sale)
  {
    $this->checkPermission('sale.edit');

    $request->validate([
      'user_id' => ['required', 'exists:users,id'],
      'invoice_no' => ['required', 'unique:sales,invoice_no,' . $sale->id],
      'date' => ['required', 'date'],
      'deletableSaleDetailsID' => ['nullable', 'array', 'exists:sale_details,id'],
      'saleDetailsID' => ['nullable', 'array', 'exists:sale_details,id'],
      'idProducts' => ['required', 'array', 'exists:products,id'],
      'productQuantities' => ['required', 'array'],
      'productUnitPrices' => ['required', 'array'],
      'cost_amount' => ['required', 'integer'],
      'discount' => ['required', 'integer'],
      'paid_amount' => ['required', 'integer'],
      'payment_type' => ['required', Rule::in(['cheque', 'cash', 'card'])],
      'bank_name' => ['exclude_if:payment_type,cash,card', 'required', 'string'],
      'cheque_no' => ['exclude_if:payment_type,cash,card', 'required', 'integer'],
      'card_type' => ['exclude_if:payment_type,cash,cheque', 'required', 'string'],
      'card_no' => ['exclude_if:payment_type,cash,cheque', 'required', 'integer'],
      'action' => ['required', Rule::in('update&print', 'update&close')],
    ], [
      'idProducts.required' => 'You must have to add some product.',
    ]);

    $sale->update([
      'user_id' => $request->get('user_id'),
      'invoice_no' => $request->get('invoice_no'),
      'date' => $request->get('date'),
      'cost_amount' => $request->get('cost_amount'),
      'discount' => $request->get('discount'),
      'paid_amount' => $request->get('paid_amount'),
      'payment_type' => $request->get('payment_type'),
      'bank_name' => $request->get('bank_name'),
      'cheque_no' => $request->get('cheque_no'),
      'card_type' => $request->get('card_type'),
      'card_no' => $request->get('card_no'),
    ]);

    $deletableSaleDetailsID = $request->get('deletableSaleDetailsID', []);
    $saleDetailsID = $request->get('saleDetailsID', []);
    $productQuantities = $request->get('productQuantities');
    $productUnitPrices = $request->get('productUnitPrices');
    foreach ($request->get('idProducts') as $index => $productID) {
      $product = Product::find($productID);
      if (array_key_exists($index, $saleDetailsID)) {
        $saleDetails = SaleDetails::find($saleDetailsID[$index]);
        if ($saleDetails->quantity != $productQuantities[$index]) {
          $product->final_stock += $saleDetails->quantity;
          $product->final_stock -= $productQuantities[$index];
        }
        $saleDetails->update([
          'product_id' => $productID,
          'quantity' => $productQuantities[$index],
          'unit_price' => $productUnitPrices[$index],
        ]);
      } else {
        SaleDetails::create([
          'sale_id' => $sale->id,
          'product_id' => $productID,
          'quantity' => $productQuantities[$index],
          'unit_price' => $productUnitPrices[$index],
        ]);
        $product->final_stock -= $productQuantities[$index];
      }
      $product->save();
    }

    foreach ($deletableSaleDetailsID as $detailsID) {
      $details = SaleDetails::find($detailsID);
      $details->product->final_stock += $details->quantity;
      $details->product->save();
      $details->delete();
    }

    $message = 'Sale invoice successfully updated.';
    return ($request->get('action') === 'update&print' ? redirect()->route('sale.show', $sale) : redirect()->route('sale.index'))->with('success', $message);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param Sale $sale
   * @return RedirectResponse
   * @throws Exception
   */
  public function destroy(Sale $sale)
  {
    $this->checkPermission('sale.delete');

    // Updating product stock
    $sale->details()->each(function ($detail) {
      $detail->product->final_stock += $detail->quantity;
      $detail->product->save();
    });
    $sale->delete();
    return back()->with('success', 'Sale invoice successfully deleted.');
  }
}
