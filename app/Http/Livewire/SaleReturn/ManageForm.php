<?php

namespace App\Http\Livewire\SaleReturn;

use App\Models\Sale;
use Livewire\Component;
use App\Models\SaleReturn;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\View\View;

class ManageForm extends Component
{
  public $returnPolicies;

  public $invoices;
  public $saleReturn;

  public $sale_id;
  public $sale;

  public $except;

  public $saleDetailId;
  public $quantity;
  public $unitPrice;
  public $policy;
  public $cause;
  public $date;

  public $updating;

  public function mount()
  {
    if (!$this->invoices) {
      $this->invoices = Sale::with(['user', 'details', 'details.product'])->get();
      $this->sale_id = request()->get('invoice');
      $this->updatedSaleID();
    }

    $this->returnPolicies = [
      'refund', 'exchange'
    ];
    $this->except = [];
    $this->saleReturn = false;

    $this->updateSaleReturn();

    $this->resetForm();
  }

  public function updatedSaleID()
  {
    if ($this->sale_id) {
      $this->sale = Sale::whereId($this->sale_id)->with(['user', 'details', 'details.product'])->first();
    } else {
      $this->sale = false;
    }
    $this->mount(); // Resetting variables
  }

  public function updatedSaleDetailId()
  {
    if ($this->saleDetailId) {
      $this->quantity = $this->sale->details->find($this->saleDetailId)->quantity;
      $this->unitPrice = $this->sale->details->find($this->saleDetailId)->unit_price;
    } else {
      $this->quantity = null;
      $this->unitPrice = null;
    }
  }

  public function updateSaleReturn()
  {
    if (!$this->sale)
      return;
    // if not sale do nothing

    $this->saleReturn = SaleReturn::with(['saleDetail', 'saleDetail.product'])->whereHas('saleDetail', function ($query) {
      return $query->where('sale_id', $this->sale_id);
    })->get();

    $this->updateExcept();
  }

  public function updateExcept($ignore = false)
  {
    if (!$this->saleReturn)
      return;

    $this->except = $this->saleReturn->when($ignore, function ($query) use ($ignore) {
      return $query->where('sale_details_id', '!=', $ignore);
    })->pluck('sale_details_id')->toArray();
  }

  public function render(): View
  {
    return view('livewire.sale-return.manage-form');
  }

  public function returnProductFormSubmit()
  {
    // for php 7.4
    $saleDetail = $this->sale->details->find($this->saleDetailId);
    $quantity = $saleDetail ? $saleDetail->quantity : false;

    // in 8.0
    // $this->sale->details->find($this->saleDetailId)?->quantity;

    $this->validate([
      'saleDetailId' => ['required', 'exists:sale_details,id'],
      'quantity' => ['required', 'integer', 'max:' . $quantity],
      'unitPrice' => ['required', 'integer'],
      'policy' => ['required', Rule::in($this->returnPolicies)],
      'cause' => ['required', 'string', 'max:40'],
      'date' => ['required', 'date']
    ], [
      'quantity.max' => 'Available return :max.'
    ]);

    $this->updating == false ? $this->storeSaleReturn() : $this->updateReturnedProduct();

    $this->updateSaleReturn();
    $this->resetForm();
  }

  public function storeSaleReturn()
  {
    $newReturn = SaleReturn::create([
      'sale_id' => $this->sale_id,
      'sale_details_id' => $this->saleDetailId,
      'quantity' => $this->quantity,
      'unit_price' => $this->unitPrice,
      'policy' => $this->policy,
      'cause' => $this->cause,
      'date' => $this->date
    ]);

    // Updating Stock
    $newReturn->saleDetail->product->sale_return_stock += $this->quantity;
    if ($this->policy == 'exchange') {
      $newReturn->saleDetail->product->final_stock -= $this->quantity;
    }
    $newReturn->saleDetail->product->save();
  }

  public function editReturnedProduct($return_id)
  {
    $return = $this->saleReturn->find($return_id);

    $this->updateExcept($return->sale_details_id);

    $this->saleDetailId = $return->sale_details_id;
    $this->quantity = $return->quantity;
    $this->unitPrice = $return->unit_price;
    $this->policy = strtolower($return->policy);
    $this->cause = $return->cause;
    $this->date = $return->date;

    $this->updating = true;
  }

  public function updateReturnedProduct()
  {
    $returnedItem = SaleReturn::where('sale_details_id', $this->saleDetailId)->with(['saleDetail', 'saleDetail.product'])->first();

    // Removing prev stock
    $returnedItem->saleDetail->product->sale_return_stock -= $returnedItem->quantity;
    if ($returnedItem->policy == 'exchange') {
      $returnedItem->saleDetail->product->final_stock += $returnedItem->quantity;
    }
    // Updating Stock
    $returnedItem->saleDetail->product->sale_return_stock += $this->quantity;
    if ($this->policy == 'exchange') {
      $returnedItem->saleDetail->product->final_stock -= $this->quantity;
    }

    //updating save
    $returnedItem->saleDetail->product->save();


    $returnedItem->quantity = $this->quantity;
    $returnedItem->unit_price = $this->unitPrice;
    $returnedItem->policy = $this->policy;
    $returnedItem->cause = $this->cause;
    $returnedItem->date = $this->date;

    $returnedItem->save();
  }

  public function deleteReturnedProduct($return_id)
  {
    $return = SaleReturn::with(['saleDetail', 'saleDetail.product'])->find($return_id);
    if ($return) {
      if ($return->policy == 'exchange') {
        $return->saleDetail->product->sale_return_stock -= $return->quantity;
        $return->saleDetail->product->final_stock += $return->quantity;
        $return->saleDetail->product->save();
      }
      $return->delete();
    }

    $this->updateSaleReturn();
    $this->resetForm();
  }

  public function resetForm()
  {
    $this->saleDetailId = $this->quantity = $this->unitPrice = $this->policy = $this->cause = null;
    $this->date = date('Y-m-d');
    $this->updating = false;
  }
}
