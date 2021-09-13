<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->checkPermission('category.index');

    $categories = Category::orderBy('id', $this->defaultOrderBy)->get();
    //        $this->putSL($categories);
    return view('dashboard.category.index', compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $this->checkPermission('category.create');

    return view('dashboard.category.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->checkPermission('category.create');

    $request->validate($this->rules('save'));

    Category::create([
      'name' => $request->get('name'),
      'status' => $request->get('status'),
    ]);

    $message = 'Category Added.';
    return ($request->get('action') == 'save' ? redirect()->back() : redirect()->route('category.index'))->with('success', $message);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $this->checkPermission('category.edit');

    $category = Category::findOrFail($id);
    return view('dashboard.category.edit', compact('category'));
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
    $this->checkPermission('category.edit');

    $request->validate($this->rules('update', $id));

    $category = Category::findOrFail($id);

    $category->update([
      'name' => $request->get('name'),
      'status' => $request->get('status'),
    ]);

    $message = 'Category information successfully updated.';
    return ($request->get('action') === 'update' ? back() : redirect()->route('category.index'))->with('success', $message);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $this->checkPermission('category.delete');

    $category = Category::find($id);

    if ($category) {
      $category->delete();
      return back()->with('success', 'Category successfully deleted.');
    } else {
      return back()->with('error', 'Something wrong! Please, try again.');
    }
  }

  public function rules($action, $id = null)
  {

    return [
      'name' => ['required', 'string', 'max:255', Rule::unique('categories')->ignore($id)],
      'status' => ['required', 'boolean'],
      'action' => ['required', Rule::in([$action, $action . '&close'])],
    ];
  }
}
