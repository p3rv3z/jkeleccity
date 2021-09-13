<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($categoryId, $productTypeId = null)
    {
        $category = Category::findOrFail($categoryId);
        return view('frontend.category_products_index', compact('category', 'productTypeId'));
    }
}
