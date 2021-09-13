<?php

namespace App\Http\Livewire\Anywhere;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class AddProduct extends Component
{
  use WithFileUploads;

  public $availableBrands;
  public $availableCategories;
  public $availableProductTypes;

  public $fieldName;
  public $fieldModelName;
  public $fieldDescription;
  public $fieldImage;
  public $fieldCategory;
  public $fieldProductType;
  public $fieldBrand;

  /**
   * Setter method for $availableCategories var
   */
  private function setAvailableCategories()
  {
    $this->availableCategories = Category::orderBy('name')->get(['id', 'name']);
  }

  /**
   * Setter method for $availableBrands var
   */
  private function setAvailableBrands()
  {
    $this->availableBrands = Brand::orderBy('name')->get(['id', 'name']);
  }

  public function updatedFieldCategory($category_id)
  {
    $this->availableProductTypes = ProductType::where('category_id', $category_id)->orderBy('name')->get(['id', 'name']);
  }


  /**
   * Call on after every page load
   */
  public function mount()
  {
    $this->setAvailableBrands();
    $this->setAvailableCategories();
  }

  public function render()
  {
    return view('livewire.anywhere.add-product');
  }

  /**
   * Reset form after submit
   */
  public function resetForm()
  {
    $this->fieldName   = null;
    $this->fieldModelName   = null;
    $this->fieldCategory    = null;
    $this->fieldProductType = null;
    $this->fieldBrand       = null;
    $this->fieldImage       = null;
  }

  /**
   * Add new product from anywhere
   */
  public function addNewProductFormSubmit()
  {

    $this->validate([
      'fieldName'   => ['required', 'string', 'max:255'],
      'fieldModelName'   => ['required', 'string', 'max:255', 'unique:products,model_name'],
      'fieldDescription' => ['required', 'string'],
      'fieldCategory'    => ['required', 'exists:categories,id'],
      'fieldProductType' => ['required', 'exists:product_types,id'],
      'fieldBrand'       => ['required', 'exists:brands,id'],
      'fieldImage'       => ['nullable', 'image'],
    ]);



    $product = Product::create([
      'name'      => $this->fieldName,
      'model_name'      => $this->fieldModelName,
      'description'     => $this->fieldDescription,
      'product_type_id' => $this->fieldProductType,
      'brand_id'        => $this->fieldBrand,
    ]);


    if ($this->fieldImage) {
      $product
      ->addMedia($this->fieldImage->getRealPath())
      ->usingName($this->fieldImage->getClientOriginalName())
      ->toMediaCollection('product_image');
    }

    $this->resetForm();
    // $this->emit('productAddedFromAnywhere'); //call listener to reload product list
    // $this->dispatchBrowserEvent('addedFromAnywhere'); // browser event trigger
    session()->flash('success', 'Product Added Successfully.');
    return redirect()->route('product.index');
  }


}
