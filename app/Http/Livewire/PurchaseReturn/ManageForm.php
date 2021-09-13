<?php

namespace App\Http\Livewire\PurchaseReturn;

use App\Models\Purchase;
use App\Models\PurchaseReturn;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ManageForm extends Component
{
  public $returnPolicies;

  public $invoices;
  public $purchaseReturn;

  public $purchase_id;
  public $purchase;

  public $except;

  public $purchaseDetailId;
  public $quantity;
  public $unitPrice;
  public $policy;
  public $cause;
  public $date;

  public $updating;

  public function mount()
  {
    if (!$this->invoices) {
      $this->invoices = Purchase::with(['user', 'details', 'details.product'])->get();
      $this->purchase_id = request()->get('invoice');
      $this->updatedPurchaseID();
    }

    $this->returnPolicies = [
      'refund', 'exchange'
    ];
    $this->except = [];
    $this->purchaseReturn = false;

    $this->updatePurchaseReturn();

    $this->resetForm();
  }

  public function updatedPurchaseID()
  {
    if ($this->purchase_id) {
      $this->purchase = Purchase::whereId($this->purchase_id)->with(['user', 'details', 'details.product'])->first();
    } else {
      $this->purchase = false;
    }
    $this->mount(); // Resetting variables
  }

  public function updatedPurchaseDetailId()
  {
    if ($this->purchaseDetailId) {
      $this->quantity = $this->purchase->details->find($this->purchaseDetailId)->quantity;
      $this->unitPrice = $this->purchase->details->find($this->purchaseDetailId)->unit_price;
    } else {
      $this->quantity = null;
      $this->unitPrice = null;
    }
  }

  public function updatePurchaseReturn()
  {
    if (!$this->purchase)
      return;
    // if not purchase do nothing

    $this->purchaseReturn = PurchaseReturn::with(['purchaseDetail', 'purchaseDetail.product'])->whereHas('purchaseDetail', function ($query) {
      return $query->where('purchase_id', $this->purchase_id);
    })->get();

    $this->updateExcept();
  }

  public function updateExcept($ignore = false)
  {
    if (!$this->purchaseReturn)
      return;

    $this->except = $this->purchaseReturn->when($ignore, function ($query) use ($ignore) {
      return $query->where('purchase_details_id', '!=', $ignore);
    })->pluck('purchase_details_id')->toArray();
  }

  public function render()
  {
    return view('livewire.purchase-return.manage-form');
  }

  public function returnProductFormSubmit()
  {
    // for php 7.4
    $purchaseDetail = $this->purchase->details->find($this->purchaseDetailId);
    $quantity = $purchaseDetail ? $purchaseDetail->quantity : false;

    // in 8.0
    // $this->purchase->details->find($this->purchaseDetailId)?->quantity;

    $this->validate([
      'purchaseDetailId' => ['required', 'exists:purchase_details,id'],
      'quantity' => ['required', 'integer', 'max:' . $quantity],
      'unitPrice' => ['required', 'integer'],
      'policy' => ['required', Rule::in($this->returnPolicies)],
      'cause' => ['required', 'string', 'max:40'],
      'date' => ['required', 'date']
    ], [
      'quantity.max' => 'Available return :max.'
    ]);

    $this->updating == false ? $this->storePurchaseReturn() : $this->updateReturnedProduct();

    $this->updatePurchaseReturn();
    $this->resetForm();
  }

  public function storePurchaseReturn()
  {
    $newReturn = PurchaseReturn::create([
      'purchase_id' => $this->purchase_id,
      'purchase_details_id' => $this->purchaseDetailId,
      'quantity' => $this->quantity,
      'unit_price' => $this->unitPrice,
      'policy' => $this->policy,
      'cause' => $this->cause,
      'date' => $this->date
    ]);

    // Updating Stock
    if ($this->policy == 'refund') {
      $newReturn->purchaseDetail->product->final_stock -= $this->quantity;
      $newReturn->purchaseDetail->product->purchase_return_stock += $this->quantity;
      $newReturn->purchaseDetail->product->save();
    }
  }

  public function editReturnedProduct($return_id)
  {
    $return = $this->purchaseReturn->find($return_id);

    $this->updateExcept($return->purchase_details_id);

    $this->purchaseDetailId = $return->purchase_details_id;
    $this->quantity = $return->quantity;
    $this->unitPrice = $return->unit_price;
    $this->policy = strtolower($return->policy);
    $this->cause = $return->cause;
    $this->date = $return->date;

    $this->updating = true;
  }

  public function updateReturnedProduct()
  {
    $returnedItem = PurchaseReturn::where('purchase_details_id', $this->purchaseDetailId)->with(['purchaseDetail', 'purchaseDetail.product'])->first();

    // if return policy switching refund to exchange
    if ($this->policy == 'exchange' && $returnedItem->purchaseDetail->product->purchase_return_stock > 0) {
      $returnedItem->purchaseDetail->product->purchase_return_stock -= $returnedItem->quantity;
      $returnedItem->purchaseDetail->product->final_stock += $returnedItem->quantity;
      $returnedItem->purchaseDetail->product->save();
    }

    if ($this->policy == 'refund') {
      // Removing prev stock
      // this condition is for if return policy switching from exchange to refund
      if ($returnedItem->purchaseDetail->product->purchase_return_stock != 0) {
        $returnedItem->purchaseDetail->product->purchase_return_stock -= $returnedItem->quantity;
        $returnedItem->purchaseDetail->product->final_stock += $returnedItem->quantity;
      }

      //updating stock with new value
      $returnedItem->purchaseDetail->product->final_stock -= $this->quantity;
      $returnedItem->purchaseDetail->product->purchase_return_stock += $this->quantity;
      $returnedItem->purchaseDetail->product->save();
    }

    $returnedItem->quantity = $this->quantity;
    $returnedItem->unit_price = $this->unitPrice;
    $returnedItem->policy = $this->policy;
    $returnedItem->cause = $this->cause;
    $returnedItem->date = $this->date;

    $returnedItem->save();
  }

  public function deleteReturnedProduct($return_id)
  {
    $return = PurchaseReturn::with(['purchaseDetail', 'purchaseDetail.product'])->find($return_id);

    if ($return) {
      //      if ($return->policy == 'exchange') {
      $return->purchaseDetail->product->purchase_return_stock -= $return->quantity;
      $return->purchaseDetail->product->final_stock += $return->quantity;
      $return->purchaseDetail->product->save();
      //      }
      $return->delete();
    }

    $this->updatePurchaseReturn();
    $this->resetForm();
  }

  public function resetForm()
  {
    $this->purchaseDetailId = $this->quantity = $this->unitPrice = $this->policy = $this->cause = null;
    $this->date = date('Y-m-d');
    $this->updating = false;
  }
}
