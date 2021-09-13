<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ExpenseCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->checkPermission('expense_category.index');

    $expense_categories = ExpenseCategory::orderBy('id', $this->defaultOrderBy)->get();
//    $this->putSL($expense_categories);
    return view('dashboard.expense_category.index', compact('expense_categories'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->checkPermission('expense_category.create');

    $request->validate([
      'name'   => ['required', 'string', 'max:255'],
      'status' => ['required', 'boolean'],
      'action' => ['required', Rule::in(['save'])],
    ]);

    ExpenseCategory::create([
      'name'   => $request->get('name'),
      'status' => $request->get('status'),
    ]);

    $message = 'Expense Category Added.';
    return ($request->get('action') == 'save' ? redirect()->back() : redirect()->route('expense_category.index'))->with('success', $message);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $this->checkPermission('expense_category.edit');

    $expense_categories = ExpenseCategory::orderBy('id', $this->defaultOrderBy)->paginate($this->itemPerPage);
    $this->putSL($expense_categories);
    $edit_expense_category = ExpenseCategory::findOrFail($id);
    return view('dashboard.expense_category.index', compact('expense_categories', 'edit_expense_category'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    $this->checkPermission('expense_category.edit');

    $request->validate([
      'name'   => ['required', 'string', 'max:255'],
      'status' => ['required', 'boolean'],
      'action' => ['required', Rule::in(['update'])],
    ]);

    $expense_category = ExpenseCategory::findOrFail($id);

    $expense_category->update([
      'name'   => $request->get('name'),
      'status' => $request->get('status'),
    ]);

    $message = 'Expense Category Updated.';
    return redirect()->route('expense_category.index')->with('success', $message);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $this->checkPermission('expense_category.delete');

    $expense_category = ExpenseCategory::find($id);

    if ($expense_category) {
      $expense_category->delete();
      return back()->with('success', 'Expense Category successfully deleted.');
    } else {
      return back()->with('error', 'Something wrong! Please, try again.');
    }
  }
}
