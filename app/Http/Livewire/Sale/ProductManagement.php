<?php

namespace App\Http\Livewire\Sale;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Livewire\Component;

class ProductManagement extends Component
{
  protected $listeners = ['customerAddedFromAnywhere' => 'publicListener'];

  // Initial Vars
  public $availableProducts;
  public $availableUsers;

  //user and invoice vars
  public $invoiceUser;
  public $invoiceNumber;
  public $invoiceDate;

  // Data vars
  public $idProducts;
  public $productQuantities;
  public $productUnitPrices;
  public $saleDetailsID;
  public $deletableSaleDetailsID;
  public $exceptProducts;

  // Form field vars
  public $fieldProduct;
  public $fieldQuantity;
  public $fieldUnitPrice;

  public $fieldDiscount;
  public $fieldPaid;

  // Flag vars
  public $update = false;
  public $totalCost = 0;
  public $action = 'save';
  public $paymentOptions = ['cash' => 'Cash', 'cheque' => 'Cheque', 'card' => 'Card'];

  public $paymentType;

  // Instance of sale. (When sale update)
  public $sale;

  /**
   * public function for livewire listeners
   */
  public function publicListener($newCustomerID)
  {
    $this->setAvailableUsers();
    $this->invoiceUser = $newCustomerID;
  }

  /**
   * Setter method for $availableProducts var
   */
  private function setAvailableProducts()
  {
    $this->availableProducts = Product::orderBy('id', 'desc')->get(['id', 'model_name', 'final_stock']);
  }

  /**
   * Setter method for $availableUsers var
   */
  private function setAvailableUsers()
  {
    $this->availableUsers = User::role('Customer')->get(['id', 'name', 'phone']);
  }

  /**
   * Setter method for $invoiceNumber var
   */
  private function setInvoiceNumber()
  {
    if (isset($this->sale->invoice_no)) {
      $this->invoiceNumber = $this->sale->invoice_no;
    } else {
      $this->invoiceNumber = Sale::count() ? Sale::latest()->first()->invoice_no + 1 : 1; // take the last invoice number from database and increment by 1
      $this->invoiceNumber = str_pad($this->invoiceNumber, 4, '0', STR_PAD_LEFT); // add prefix if number is to sort
    }
  }

  /**
   * setter method for data variables
   */
  private function setDataVars()
  {
    $this->saleDetailsID = [];
    $this->deletableSaleDetailsID = old('deletableSaleDetailsID', []);

    $idProducts = [];
    $productQuantities = [];
    $productUnitPrices = [];

    if ($this->sale && !old('deletableSaleDetailsID')) {
      foreach ($this->sale->details as $details) {
        array_push($this->saleDetailsID, $details->id);
        array_push($idProducts, $details->product_id);
        array_push($productQuantities, $details->quantity);
        array_push($productUnitPrices, $details->unit_price);
      }
    }

    $this->idProducts = old('idProducts') ?? $idProducts;
    $this->productQuantities = old('productQuantities', $productQuantities);
    $this->productUnitPrices = old('productUnitPrices', $productUnitPrices);

    $this->invoiceUser = old('user_id') ?? ($this->sale->user_id ?? null);
    $this->fieldDiscount = old('discount') ?? ($this->sale->discount ?? null);
    $this->fieldPaid = old('paid_amount') ?? ($this->sale->paid_amount ?? null);

    $this->paymentType = old('payment_type') ?? ($this->sale->payment_type ?? 'cash');

    $this->exceptProducts = $this->idProducts;

    $this->countTotalCost();
  }

  /**
   * Call on after every page load
   */
  public function mount()
  {
    $this->setAvailableUsers();
    $this->setInvoiceNumber();
    $this->invoiceDate = $this->sale->date ?? date('Y-m-d');
    $this->setAvailableProducts();
    $this->setDataVars();
  }

  /**
   * livewire render method
   */
  public function render()
  {
    return view('livewire.sale.product-management');
  }

  /**
   * Form submission accept method
   */
  public function addProductFormSubmit()
  {
    // getting available quantity
    $maxQuantity = $this->availableProducts->find($this->fieldProduct)->final_stock ?? 0;

    $this->validate([
      'fieldProduct' => ['required', 'exists:products,id'],
      'fieldQuantity' => ['required', 'integer', 'exclude_if:fieldProduct,null', 'max:' . $maxQuantity, 'min:1'],
      'fieldUnitPrice' => ['required', 'integer', 'min:1'],
    ], [
      'fieldQuantity.max' => $maxQuantity ? 'Available in stock :max only.' : 'Product out of stock.',
      'fieldQuantity.min' => 'Minimum quantity is :min.',
    ]);

    $this->update === false ? $this->addToProductList() : $this->updateToProductList();

    $this->countTotalCost();

    $this->resetForm();
  }

  /**
   * Adding form data to product list
   */
  public function addToProductList()
  {
    array_push($this->idProducts, $this->fieldProduct);
    array_push($this->productQuantities, $this->fieldQuantity);
    array_push($this->productUnitPrices, $this->fieldUnitPrice);

    $this->exceptProducts = $this->idProducts;
  }

  /**
   * Reset form after submit
   */
  public function resetForm()
  {
    $this->fieldProduct = null;
    $this->fieldQuantity = null;
    $this->fieldUnitPrice = null;
  }

  /**
   * Remove item from product list
   */
  public function removeFromProductList($index)
  {
    unset($this->idProducts[$index], $this->productQuantities[$index], $this->productUnitPrices[$index]);

    if (array_key_exists($index, $this->saleDetailsID)) {
      array_push($this->deletableSaleDetailsID, $this->saleDetailsID[$index]);
      unset($this->saleDetailsID[$index]);
    }

    $this->exceptProducts = $this->idProducts;

    $this->update = false;
    $this->countTotalCost();

    $this->resetForm();
  }

  /**
   * Adding product list item data to form
   */
  public function editFromProductList($index)
  {
    $this->update = $index;

    $this->fieldProduct = $this->idProducts[$index];
    $this->fieldQuantity = $this->productQuantities[$index];
    $this->fieldUnitPrice = $this->productUnitPrices[$index];

    unset($this->exceptProducts[$index]);
  }

  /**
   * Update form data to product list
   */
  public function updateToProductList()
  {
    $this->idProducts[$this->update] = $this->fieldProduct;
    $this->productQuantities[$this->update] = $this->fieldQuantity;
    $this->productUnitPrices[$this->update] = $this->fieldUnitPrice;

    $this->update = false;

    $this->exceptProducts = $this->idProducts;
  }

  /**
   * Calculate total cost from product list data
   */
  public function countTotalCost()
  {
    $totalCost = 0;
    foreach ($this->idProducts as $index => $productID) {
      $totalCost += $this->productQuantities[$index] * $this->productUnitPrices[$index];
    }
    $this->totalCost = $totalCost;;
  }

  public function fullPaid()
  {
    empty($this->fieldDiscount) && $this->fieldDiscount = 0;

    $this->fieldPaid = $this->totalCost - $this->fieldDiscount;
  }
}
