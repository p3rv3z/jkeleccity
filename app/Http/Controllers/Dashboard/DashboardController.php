<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Sale;
use Carbon\Carbon;

class DashboardController extends Controller
{
	public function dashboard()
	{
    // return Product::with(array('purchase' => function($q){
    //   $q->latest()->first()->pluck('unit_price');
    // }))->findOrFail(20);

    $products = Product::where('final_stock','>', '0')->with('brand')->orderBy('id', $this->defaultOrderBy)->get();

    $outOfStocks = Product::where('final_stock','<', '1')->with('brand')->orderBy('id', $this->defaultOrderBy)->get();

		$sales = Sale::with('user')->whereDate('created_at', Carbon::today())->orderBy('id', $this->defaultOrderBy)->get();
//    $this->putSL($sales);

    $purchases = Purchase::with('user')->whereDate('created_at', Carbon::today())->orderBy('id', $this->defaultOrderBy)->get();
//    $this->putSL($purchases);

		return view('dashboard.dashboard', compact('products', 'sales', 'purchases', 'outOfStocks'));
	}
}
