<?php

use App\Http\Controllers\Dashboard\PurchaseReturnController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\SaleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\ReportController;
use App\Http\Controllers\Dashboard\ExpenseController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\PurchaseController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\AppConfigController;
use App\Http\Controllers\Dashboard\BannerImageController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\SaleReturnController;
use App\Http\Controllers\Dashboard\ExpenseCategoryController;
use App\Http\Controllers\Frontend\CategoryProductsController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductDetailController;
use App\Http\Controllers\Frontend\ProductSearchController;
use App\Http\Controllers\ProductTypeController;

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'dashboard'], function () {
  Route::get('', [DashboardController::class, 'dashboard'])->name('dashboard');

  Route::resource('category', CategoryController::class);
  Route::resource('brand', BrandController::class);
  Route::resource('product_type', ProductTypeController::class);
  Route::resource('product', ProductController::class)->except(['show']);
  Route::resource('user', UserController::class)->except(['show']);
  Route::resource('purchase', PurchaseController::class);
  Route::resource('expense', ExpenseController::class)->except(['show']);
  Route::resource('expense_category', ExpenseCategoryController::class)->except(['create', 'show']);
  Route::resource('sale', SaleController::class);
  Route::get('sale_return/manage', [SaleReturnController::class, 'manage'])->name('sale_return.manage');
  Route::resource('sale_return', SaleReturnController::class)->only(['index', 'show', 'destroy']);
  Route::get('purchase_return/manage', [PurchaseReturnController::class, 'manage'])->name('purchase_return.manage');
  Route::resource('purchase_return', PurchaseReturnController::class)->only(['index', 'show', 'destroy']);
  Route::resource('role', RoleController::class)->except(['show']);
  Route::resource('permission', PermissionController::class)->except(['show']);
  Route::resource('banner_image', BannerImageController::class)->except(['show']);

  Route::prefix('report')->name('report.')->group(function () {
    Route::get('sale', [ReportController::class, 'saleReport'])->name('sale');
    Route::get('purchase', [ReportController::class, 'purchaseReport'])->name('purchase');
    Route::get('expense', [ReportController::class, 'expenseReport'])->name('expense');
    Route::get('stock', [ReportController::class, 'stockReport'])->name('stock');
  });

  Route::get('app-config', [AppConfigController::class, 'showAppConfig'])->name('appConfig');
  Route::put('app-config', [AppConfigController::class, 'updateAppConfig']);
});

// frontend starts here
Route::get('/', HomeController::class)->name('home');
Route::get('products/{category_name}/{product_type_id?}', CategoryProductsController::class)->name('products');
Route::get('product/detail/{id}', ProductDetailController::class)->name('product.detail');
Route::get('search', ProductSearchController::class)->name('product.search');
