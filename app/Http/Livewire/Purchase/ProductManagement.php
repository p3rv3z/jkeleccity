<?php

namespace App\Http\Livewire\Purchase;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\User;
use Livewire\Component;

class ProductManagement extends Component
{
  protected $listeners = ['productAddedFromAnywhere' => 'publicListener', 'supplierAddedFromAnywhere' => 'refreshSuppliers'];

  // Initial Vars
  public $availableProducts;
  public $availableUsers;

  //purchase vars
  public $invoiceUser;
  public $invoiceNumber;
  public $invoiceDate;
  public $c_invoiceNumber;
  public $remark;

  // Data vars
  public $idProducts;
  public $productQuantities;
  public $productUnitPrices;
  public $productRegularPrices;
  public $productOfferPrices;
  public $purchaseDetailsID;
  public $deletablePurchaseDetailsID;
  public $exceptProducts;

  // Form field vars
  public $fieldProduct;
  public $fieldQuantity;
  public $fieldUnitPrice;
  public $fieldRegularPrice;
  public $fieldOfferPrice;

  public $fieldDiscount;
  public $fieldPaid;

  // Flag vars
  public $update = false;
  public $totalCost = 0;
  public $action = 'save';

  public $paymentType;

  // Instance of purchase. (When purchase update)
  public $purchase;

  /**
   * public function for livewire listeners
   */
  public function refreshSuppliers($newSupplierID)
  {
    $this->setAvailableUsers();
    $this->invoiceUser = $newSupplierID;
  }

  /**
   * public function for livewire listeners
   */
  public function publicListener()
  {
    $this->setAvailableProducts();
  }

  /**
   * Setter method for $availableUsers var
   */
  private function setAvailableUsers()
  {
    $this->availableUsers = User::role('Supplier')->get(['id', 'name', 'email']);
  }

  /**
   * Setter method for $availableProducts var
   */
  private function setAvailableProducts()
  {
    $this->availableProducts = Product::orderBy('id', 'desc')->get(['id', 'model_name', 'final_stock']);
  }

  /**
   * Setter method for $invoiceNumber var
   */
  private function setInvoiceNumber()
  {
    if (isset($this->purchase->invoice_no)) {
      $this->invoiceNumber = $this->purchase->invoice_no;
    } else {
      $this->invoiceNumber = Purchase::count() ? Purchase::latest()->first()->invoice_no + 1 : 1; // take the last invoice number from database and increment by 1
      $this->invoiceNumber = str_pad($this->invoiceNumber, 4, '0', STR_PAD_LEFT); // add prefix if number is to sort
    }
  }

  /**
   * setter method for data variables
   */
  private function setDataVars()
  {
    $this->purchaseDetailsID = [];
    $this->deletablePurchaseDetailsID = old('deletablePurchaseDetailsID', []);

    $idProducts = [];
    $productQuantities = [];
    $productUnitPrices = [];
    $productRegularPrices = [];
    $productOfferPrices = [];

    if ($this->purchase && !old('deletablePurchaseDetailsID')) {
      foreach ($this->purchase->details as $details) {
        array_push($this->purchaseDetailsID, $details->id);
        array_push($idProducts, $details->product_id);
        array_push($productQuantities, $details->quantity);
        array_push($productUnitPrices, $details->unit_price);
        array_push($productRegularPrices, $details->regular_price);
        array_push($productOfferPrices, $details->offer_price);
      }
    }

    $this->idProducts = old('idProducts') ?? $idProducts;
    $this->productQuantities = old('productQuantities', $productQuantities);
    $this->productUnitPrices = old('productUnitPrices', $productUnitPrices);
    $this->productRegularPrices = old('productRegularPrices', $productRegularPrices);
    $this->productOfferPrices = old('productOfferPrices', $productOfferPrices);

    $this->invoiceUser = old('user_id') ?? ($this->purchase->user_id ?? null);
    $this->fieldDiscount = old('discount') ?? ($this->purchase->discount ?? null);
    $this->fieldPaid = old('paid_amount') ?? ($this->purchase->paid_amount ?? null);

    $this->paymentType = old('payment_type') ?? ($this->purchase->payment_type ?? 'cash');

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
    $this->invoiceDate = $this->purchase->date ?? (old('date') ?? date('Y-m-d'));
    $this->c_invoiceNumber = $this->purchase->c_invoice_no ?? (old('c_invoice_no') ?? null);
    $this->remark = $this->purchase->remark ?? (old('remark') ?? null);
    $this->setAvailableProducts();
    $this->setDataVars();
  }

  /**
   * livewire render method
   */
  public function render()
  {
    return view('livewire.purchase.product-management');
  }

  /**
   * Form submission accept method
   */
  public function addProductFormSubmit()
  {
    $this->validate([
      'fieldProduct' => ['required', 'exists:products,id'],
      'fieldQuantity' => ['required', 'integer', 'exclude_if:fieldProduct,null', 'min:1'],
      'fieldUnitPrice' => ['required', 'integer', 'min:1'],
      'fieldRegularPrice' => ['required', 'integer', 'min:1'],
      'fieldOfferPrice' => ['required', 'integer', 'min:1'],
    ], [
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
    array_push($this->productRegularPrices, $this->fieldRegularPrice);
    array_push($this->productOfferPrices, $this->fieldOfferPrice);

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
    $this->fieldRegularPrice = null;
    $this->fieldOfferPrice = null;

    $this->fieldNewProduct = null;
    // $this->fieldNewCode = null;
    $this->fieldNewBrand = null;
  }

  /**
   * Remove item from product list
   */
  public function removeFromProductList($index)
  {
    unset($this->idProducts[$index], $this->productQuantities[$index], $this->productUnitPrices[$index], $this->productOfferPrices[$index]);

    if (array_key_exists($index, $this->purchaseDetailsID)) {
      array_push($this->deletablePurchaseDetailsID, $this->purchaseDetailsID[$index]);
      unset($this->purchaseDetailsID[$index]);
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
    $this->fieldRegularPrice = $this->productRegularPrices[$index];
    $this->fieldOfferPrice = $this->productOfferPrices[$index];

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
    $this->productRegularPrices[$this->update] = $this->fieldRegularPrice;
    $this->productOfferPrices[$this->update] = $this->fieldOfferPrice;

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
    $this->totalCost = $totalCost;
  }

  public function fullPaid()
  {
    empty($this->fieldDiscount) && $this->fieldDiscount = 0;

    $this->fieldPaid = $this->totalCost - $this->fieldDiscount;
  }
}
