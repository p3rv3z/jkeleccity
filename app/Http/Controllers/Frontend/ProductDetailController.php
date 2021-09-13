<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductDetailController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
      $product = Product::findOrFail($id);

      $product->with(['brand', 'product_type', 'product_type.category', 'latest_purchase'])->get(['id', 'name', 'description', 'model_name', 'final_stock']);

      $related_products = Product::with('latest_purchase')
        ->whereHas('product_type.category', function ($query) use($product) {
          $query->where('id', $product->product_type->category_id);
        })->take(10)
        ->get(['id', 'name', 'model_name', 'final_stock']);

        return view('frontend.product-detail', compact('product', 'related_products'));
    }
}
