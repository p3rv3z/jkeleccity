<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->checkPermission('product.index');

    $products = Product::with('latest_purchase')->orderBy('id', $this->defaultOrderBy)->get();
//    $this->putSL($products);

    return view('dashboard.product.index', compact('products'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $this->checkPermission('product.create');

    $categories = Category::orderBy('name')->get(['id', 'name']);
    $brands = Brand::orderBy('name')->get(['id', 'name']);
    return view('dashboard.product.create', compact('brands', 'categories'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->checkPermission('product.create');

    $attributes = $request->validate([
//      'name' => ['required', 'string', 'max:255'],
      'model_name' => ['required', 'string', 'max:255', 'unique:products'],
//      'code' => ['required', 'integer'],
      'description' => ['nullable', 'string'],
      'category_id' => ['required', 'exists:categories,id'],
      'brand_id' => ['required', 'exists:brands,id'],
//      'status' => ['required', 'boolean'],
      'action' => ['required', Rule::in(['save', 'save&close'])],
    ]);

    Product::create($attributes);
    $message = 'Product Added.';
    return ($request->get('action') == 'save' ? redirect()->back() : redirect()->route('product.index'))->with('success', $message);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $this->checkPermission('product.edit');

    $product = Product::findOrFail($id);
    // $categories = Category::orderBy('name')->get(['id', 'name']);
    // $brands = Brand::orderBy('name')->get(['id', 'name']);
    return view('dashboard.product.edit', compact('product'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->checkPermission('product.edit');

    $attributes = $request->validate([
//      'name' => ['required', 'string', 'max:255'],
      'model_name' => ['required', 'string', 'max:255', Rule::unique('products')->ignore($id)],
//      'code' => ['required', 'integer',],
      'description' => ['nullable', 'string'],
      'category_id' => ['required', 'exists:categories,id'],
      'brand_id' => ['required', 'exists:brands,id'],
//      'status' => ['required', 'boolean'],
      'action' => ['required', Rule::in(['update', 'update&close'])],
    ]);

    $product = Product::findOrFail($id);

    $product->update($attributes);

    $message = 'Product information successfully updated.';
    return ($request->get('action') === 'update' ? back() : redirect()->route('product.index'))->with('success', $message);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $this->checkPermission('product.delete');

    $product = Product::find($id);

    if ($product) {
      if ($product->final_stock > 0) {
        return back()->with('warning', 'Product has stock can\'t delete');
      }
      $product->delete();
      return back()->with('success', 'Product successfully deleted.');
    } else {
      return back()->with('error', 'Something wrong! Please, try again.');
    }
  }
}
