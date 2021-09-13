<?php

namespace App\Http\Livewire\Anywhere;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductType;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProduct extends Component
{
  use WithFileUploads;

  public $product;

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
    $this->fieldName = $this->product->name;
    $this->fieldModelName = $this->product->model_name;
    $this->fieldDescription = $this->product->description;
    $this->fieldCategory = $this->product->product_type->category_id;
    $this->updatedFieldCategory($this->product->product_type->category_id);
    $this->fieldProductType = $this->product->product_type_id;
    $this->fieldBrand = $this->product->brand_id;
  }

  public function render()
  {
    return view('livewire.anywhere.update-product');
  }

  /**
   * Reset form after submit
   */
  public function resetForm()
  {
    $this->fieldName   = null;
    $this->fieldModelName   = null;
    $this->fieldDescription = null;
    $this->fieldImage    = null;
    $this->fieldCategory    = null;
    $this->fieldProductType = null;
    $this->fieldBrand       = null;
  }

  public function updateProductFormSubmit()
  {
    $this->validate([
      'fieldName'         => 'required|string|max:255',
      'fieldModelName'   => 'required|string|max:255|unique:products,model_name,' . $this->product->id,
      'fieldDescription' => ['required', 'string'],
      'fieldImage'        => ['nullable', 'image'],
      'fieldCategory'    => ['required', 'exists:categories,id'],
      'fieldProductType' => ['required', 'exists:product_types,id'],
      'fieldBrand'       => ['required', 'exists:brands,id'],
    ]);

    $this->product->update([
      'name'            => $this->fieldName,
      'model_name'      => $this->fieldModelName,
      'description'     => $this->fieldDescription,
      'product_type_id' => $this->fieldProductType,
      'brand_id'        => $this->fieldBrand,
    ]);

    if ($this->fieldImage) {
      $this->product
      ->addMedia($this->fieldImage->getRealPath())
      ->usingName($this->fieldImage->getClientOriginalName())
      ->toMediaCollection('product_image');
    }

    $this->resetForm();
    session()->flash('success', 'Product Updated Successfully.');
    return redirect()->route('product.index');
  }
}
