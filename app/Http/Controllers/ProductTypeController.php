<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductType;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductTypeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->checkPermission('product_type.index');

    $product_types = ProductType::orderBy('id', $this->defaultOrderBy)->get();
    //        $this->putSL($product_types);
    return view('dashboard.product_type.index', compact('product_types'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {

    $this->checkPermission('product_type.create');

    $categories = Category::orderBy('name')->get();

    return view('dashboard.product_type.create', compact('categories'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->checkPermission('product_type.create');

    $request->validate($this->rules('save'));

    ProductType::create([
      'name' => $request->get('name'),
      'category_id' => $request->get('category_id'),
    ]);

    $message = 'ProductType Added.';
    return ($request->get('action') == 'save' ? redirect()->back() : redirect()->route('product_type.index'))->with('success', $message);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $this->checkPermission('product_type.edit');

    $categories = Category::orderBy('name')->get();

    $product_type = ProductType::findOrFail($id);
    return view('dashboard.product_type.edit', compact('product_type', 'categories'));
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
    $this->checkPermission('product_type.edit');

    $request->validate($this->rules('update', $id));

    $product_type = ProductType::findOrFail($id);

    $product_type->update([
      'name' => $request->get('name'),
      'category_id' => $request->get('category_id'),
    ]);

    $message = 'ProductType information successfully updated.';
    return ($request->get('action') === 'update' ? back() : redirect()->route('product_type.index'))->with('success', $message);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $this->checkPermission('product_type.delete');

    $product_type = ProductType::find($id);

    if ($product_type) {
      $product_type->delete();
      return back()->with('success', 'ProductType successfully deleted.');
    } else {
      return back()->with('error', 'Something wrong! Please, try again.');
    }
  }

  public function rules($action, $id = null)
  {

    return [
      'name' => ['required', 'string', 'max:255', Rule::unique('product_types')->ignore($id)],
      'category_id' => ['required', 'exists:categories,id'],
      'action' => ['required', Rule::in([$action, $action . '&close'])],
    ];
  }
}
