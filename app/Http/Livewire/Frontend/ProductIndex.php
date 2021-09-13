<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use Livewire\Component;

class ProductIndex extends Component
{
  public $search           = "";

  public $productPerPage = 12;

  public $selectedBrandId    = null;
  public $selectedProductType = null;

  public $selectedCategory = null;

  public function render()
  {
    $brands        = Brand::all();
    $categories    = Category::all();

    $product_types = ProductType::where('category_id', $this->selectedCategory->id)->orderBy('name')->get();

    $products = Product::when($this->selectedBrandId, function ($query) {
      $query->where('brand_id', $this->selectedBrandId);
    })
    ->when($this->selectedCategory, function ($query) {$query->whereHas('product_type', function ($query) {
    $query->where('category_id', $this->selectedCategory->id);});})
    ->when($this->selectedProductType, function ($query) { $query->where('product_type_id', $this->selectedProductType); })
    ->with(['purchase' => function ($q) {
    $q->latest()->first();
    }])
    ->paginate($this->productPerPage);

    return view('livewire.frontend.product-index', compact('brands', 'categories', 'products', 'product_types'));
  }

}
