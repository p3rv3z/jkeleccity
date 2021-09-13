<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BannerImage;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Handle the incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function __invoke(Request $request)
  {
    $refrigerators = Product::with('latest_purchase')
      ->whereHas('product_type.category', function ($query) {
        $query->where('name', 'refrigerator');
      })
      ->get(['id', 'name', 'model_name', 'final_stock']);

    $televisions = Product::with('latest_purchase')
    ->whereHas('product_type.category', function ($query) {
        $query->where('name', 'television');
      })
      ->get(['id', 'name', 'model_name', 'final_stock']);

    $air_conditioners = Product::with('latest_purchase')
      ->whereHas('product_type.category', function ($query) {
        $query->where('name', 'air conditioner');
      })
      ->get(['id', 'name', 'model_name', 'final_stock']);

    $kitchen_appliances = Product::with('latest_purchase')
      ->whereHas('product_type.category', function ($query) {
        $query->where('name', 'kitchen appliances');
      })
      ->get(['id', 'name', 'model_name', 'final_stock']);

    $washing_machines = Product::with('latest_purchase')
      ->whereHas('product_type.category', function ($query) {
        $query->where('name', 'washing machine');
      })
      ->get(['id', 'name', 'model_name', 'final_stock']);

    $slider_images = BannerImage::where('segment', 'slider')->get();
    $small_banners = BannerImage::where('segment', 'small-banner')->get();

    return view('frontend.home', compact('refrigerators', 'air_conditioners', 'televisions', 'kitchen_appliances', 'washing_machines', 'slider_images', 'small_banners'));
  }
}
