<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->checkPermission('brand.index');

    $brands = Brand::orderBy('id', $this->defaultOrderBy)->get();
//    $this->putSL($brands);
    return view('dashboard.brand.index', compact('brands'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $this->checkPermission('brand.create');

    return view('dashboard.brand.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->checkPermission('brand.create');

    $request->validate($this->rules('save'));

    Brand::create([
      'name' => $request->get('name'),
      'status' => $request->get('status'),
    ]);

    $message = 'Brand Added.';
    return ($request->get('action') == 'save' ? redirect()->back() : redirect()->route('brand.index'))->with('success', $message);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $this->checkPermission('brand.edit');

    $brand = Brand::findOrFail($id);
    return view('dashboard.brand.edit', compact('brand'));
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
    $this->checkPermission('brand.edit');

    $request->validate($this->rules('update', $id));

    $brand = Brand::findOrFail($id);

    $brand->update([
      'name' => $request->get('name'),
      'status' => $request->get('status'),
    ]);

    $message = 'Brand information successfully updated.';
    return ($request->get('action') === 'update' ? back() : redirect()->route('brand.index'))->with('success', $message);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $this->checkPermission('brand.delete');

    $brand = Brand::find($id);

    if ($brand) {
      $brand->delete();
      return back()->with('success', 'Brand successfully deleted.');
    } else {
      return back()->with('error', 'Something wrong! Please, try again.');
    }
  }

  public function rules($action, $id = null)
  {
    return [
      'name' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('brands')->ignore($id)],
      'status' => ['required', 'boolean'],
      'action' => ['required', Rule::in([$action, $action . '&close'])],
    ];
  }
}
