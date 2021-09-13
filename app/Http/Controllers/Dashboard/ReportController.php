<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Expense;
use App\Models\Product;
use App\Models\SaleDetails;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Models\PurchaseDetails;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class ReportController extends Controller
{
  /**
   * Setting up query start and end times
   *
   * @param Request $request
   * @return object
   */
  private function dateRangeSetup(Request $request)
  {
    if ($request->has('date_range')) {
      try {
        $dateRange = explode(' - ', $request->get('date_range'));

        $dateRange['startDate'] = Carbon::createFromFormat('m/d/Y H:i:s', $dateRange[0] . ' 00:00:00');
        $dateRange['endDate']   = Carbon::createFromFormat('m/d/Y H:i:s', $dateRange[1] . ' 23:59:59');
        return (object)$dateRange;
      } catch (\Throwable $th) {
        session()->flash('error', 'Something Wrong! Please try again.');
      }
    }

    $dateRange['startDate'] = Carbon::today()->subDays(29);
    $dateRange['endDate']   = Carbon::now()->setTime(23, 59, 59);
    return (object)$dateRange;
  }

  /**
   * Sale Report Function
   *
   * @param Request $request
   * @return view
   */
  public function saleReport(Request $request)
  {
    $this->checkPermission('report.sale');

    $dateRange = $this->dateRangeSetup($request);

    $user_id = false;
    // Checking and Getting user_id from url
    if ($request->has('user_id') && $request->get('user_id') != 'all') {
      $user_id = $request->get('user_id');
    }

    $product_id = false;
    // Checking and Getting product_id from url
    if ($request->has('product_id') && $request->get('product_id') != 'all') {
      $product_id = $request->get('product_id');
    }

    // for filter select
    $users = User::role('Customer')->get(['id', 'name']);
    // for filter select
    $products = Product::orderBy('model_name')->get(['id', 'model_name']);

    // Report data with filtering
    $details = SaleDetails::whereHas('product', function ($query) use ($product_id) {
      if ($product_id) {
        $query->where('product_id', $product_id);
      }
    })->whereHas('sale.user', function ($query) use ($user_id) {
      if ($user_id) {
        $query->where('user_id', $user_id);
      }
    })->whereHas('sale', function ($query) use ($dateRange) {
      $query->whereBetween('date', [$dateRange->startDate, $dateRange->endDate]);
    })->get();

    return view('dashboard.report.sale', compact('dateRange', 'users', 'products', 'details'));
  }

  /**
   * Purchase Report Function
   *
   * @param Request $request
   * @return view
   */
  public function purchaseReport(Request $request)
  {
    $this->checkPermission('report.purchase');

    $dateRange = $this->dateRangeSetup($request);

    $product_id = false;
    // Checking and Getting product_id from url
    if ($request->has('product_id') && $request->get('product_id') != 'all') {
      $product_id = $request->get('product_id');
    }

    $products = Product::orderBy('model_name')->get(['id', 'model_name']);

    $details = PurchaseDetails::whereHas('product', function ($query) use ($product_id) {
      if ($product_id) {
        $query->where('product_id', $product_id);
      }
    })->whereHas('purchase', function ($query) use ($dateRange) {
      $query->whereBetween('date', [$dateRange->startDate, $dateRange->endDate]);
    })->get();

//    return $details;

    return view('dashboard.report.purchase', compact('products', 'details', 'dateRange'));
  }

  /**
   * Expense Report Function
   *
   * @param Request $request
   * @return View|RedirectResponse
   */
  public function expenseReport(Request $request)
  {
    $this->checkPermission('report.expense');

    $dateRange = $this->dateRangeSetup($request);

    $cat_id = false;
    // Checking and Getting user_id from url
    if ($request->has('cat_id') && $request->get('cat_id') != 'all') {
      $cat_id = $request->get('cat_id');
    }

    // for filter select
    $expenseCategories = ExpenseCategory::get(['id', 'name']);

    // Report data with filtering
    $expenses = Expense::when($cat_id, function ($query) use ($cat_id) {
      if ($cat_id) {
        $query->where('expense_category_id', $cat_id);
      }
    })->with(['addedBy', 'expenseBy'])
    ->whereBetween('date', [$dateRange->startDate, $dateRange->endDate])
    ->get();

    return view('dashboard.report.expense', compact('dateRange', 'expenseCategories', 'expenses'));
  }

  /**
   * Stock Report Function
   *
   * @param Request $request
   * @return View
   */
  public function stockReport(Request $request)
  {
    $this->checkPermission('report.stock');

    $product_id = false;
    // Checking and Getting product_id from url
    if ($request->has('product_id') && $request->get('product_id') != 'all') {
      $product_id = $request->get('product_id');
    }

    // for filter select
    $products = Product::orderBy('model_name')->get();

    if ($request->ajax()) {
      return Datatables::of(Product::when($product_id, function ($query) use ($product_id) {
        return $query->where('id', $product_id);
      })->with(['brand', 'category'])->withCount([
        'purchase as total_purchase' => function ($query) {
          $query->select(DB::raw('COALESCE(SUM(quantity), 0)'));
        }, 'sale as total_sale' => function ($query) {
          $query->select(DB::raw('COALESCE(SUM(quantity), 0)'));
        },
      ]))->make(true);
    }

    return view('dashboard.report.stock', compact('products'));
  }
}
