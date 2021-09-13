<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $this->checkPermission('expense.index');

    $expenses = Expense::with('category')->with('addedBy')->with('expenseBy')->orderBy('id', $this->defaultOrderBy)->get();
//    $this->putSL($expenses);
    return view('dashboard.expense.index', compact('expenses'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $this->checkPermission('expense.create');

    $expense_categories = ExpenseCategory::where('status', 1)->get();
    $users              = User::role(['Admin', 'Shop Manager'])->get(['id', 'name']);
    return view('dashboard.expense.create', compact('expense_categories', 'users'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->checkPermission('expense.create');

    $request->validate([
      'expense_category_id' => ['required', 'exists:expense_categories,id'],
      'date'                => ['required', 'date'],
      'amount'              => ['required', 'integer'],
      'expense_by'          => ['required', 'exists:users,id'],
      'purpose'             => ['nullable', 'string', 'max:255'],
      'action'              => ['required', Rule::in(['save', 'save&close'])],
    ]);

    Expense::create([
      'expense_category_id' => $request->get('expense_category_id'),
      'date'                => $request->get('date'),
      'amount'              => $request->get('amount'),
      'added_by'            => auth()->user()->id,
      'expense_by'          => $request->get('expense_by'),
      'purpose'             => $request->get('purpose'),
    ]);

    $message = 'Expense Added.';
    return ($request->get('action') == 'save' ? redirect()->back() : redirect()->route('expense.index'))->with('success', $message);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $this->checkPermission('expense.edit');

    $expense_categories = ExpenseCategory::where('status', 1)->get();
    $expense            = Expense::findOrFail($id);
    $users              = User::role(['Super Admin', 'Admin', 'Shop Manager'])->get(['id', 'name']);
    return view('dashboard.expense.edit', compact('expense', 'expense_categories', 'users'));
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
    $this->checkPermission('expense.edit');

    $request->validate([
      'expense_category_id' => ['required', 'exists:expense_categories,id'],
      'date'                => ['required', 'date'],
      'amount'              => ['required', 'integer'],
      'expense_by'          => ['required', 'exists:users,id'],
      'purpose'             => ['nullable', 'string', 'max:255'],
      'action'              => ['required', Rule::in(['update', 'update&close'])],
    ]);

    $expense = Expense::findOrFail($id);

    $expense->update([
      'expense_category_id' => $request->get('expense_category_id'),
      'date'                => $request->get('date'),
      'amount'              => $request->get('amount'),
      'added_by'            => auth()->user()->id,
      'expense_by'          => $request->get('expense_by'),
      'purpose'             => $request->get('purpose'),
    ]);

    $message = 'Expense information successfully updated.';
    return ($request->get('action') === 'update' ? back() : redirect()->route('expense.index'))->with('success', $message);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $this->checkPermission('expense.delete');

    $expense = Expense::find($id);

    if ($expense) {
      $expense->delete();
      return back()->with('success', 'Expense successfully deleted.');
    } else {
      return back()->with('error', 'Something wrong! Please, try again.');
    }
  }
}
