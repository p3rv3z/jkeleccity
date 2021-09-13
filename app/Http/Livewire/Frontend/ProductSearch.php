<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use Livewire\Component;
use Livewire\WithPagination;

class ProductSearch extends Component
{
  use WithPagination;

  protected $paginationTheme = 'bootstrap';

  public $productPerPage   = 12;
  public $search           = "";
  public $selectedBrand    = null;
  public $selectedCategory = null;
  public $product_types = null;
  public $selectedProductType = null;

  public function render()
  {
    $brands        = Brand::all();
    $categories    = Category::all();
    $featured_products = Product::latest()->take(10)->get();
    $products      = Product::when($this->selectedBrand, function ($query) {
                       $query->where('brand_id', $this->selectedBrand);
      })
      ->when($this->selectedCategory, function ($query) {$query->whereHas('product_type', function ($query) {
        $query->where('category_id', $this->selectedCategory);});})
      ->when($this->selectedProductType, function ($query) { $query->where('product_type_id', $this->selectedProductType); })
      ->search(trim($this->search))
      ->with(['purchase' => function ($q) {
        $q->latest()->first();
      }])
      ->paginate($this->productPerPage);


    return view('livewire.frontend.product-search', compact('brands', 'categories', 'products', 'featured_products'));
  }

  public function updatedSelectedCategory($category_id)
  {
    if($category_id)
      $this->selectedProductType = null;
    $this->product_types = ProductType::where('category_id', $category_id)->orderBy('name')->get();
  }
}
