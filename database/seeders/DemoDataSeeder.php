<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ExpenseCategory;
use App\Models\ProductType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoDataSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Demo users
    $user = User::create([
      'name'     => 'Admin',
      'name'     => 'admin',
      'email'    => 'admin@' . str_replace('http://', '', env('APP_URL')),
      'password' => Hash::make('admin'),
    ]);
    $user->assignRole('Admin');

    $user = User::create([
      'name'     => 'Shop Manager',
      'name'     => 'manager',
      'email'    => 'shopmanager@' . str_replace('http://', '', env('APP_URL')),
      'password' => Hash::make('shopmanager'),
    ]);
    $user->assignRole('Shop Manager');

    $user = User::create([
      'name'     => 'Supplier Name',
      'name'     => 'supplier',
      'email'    => 'supplier@' . str_replace('http://', '', env('APP_URL')),
      'password' => Hash::make('supplier'),
    ]);
    $user->assignRole('Supplier');

    $user = User::create([
      'name'     => 'Customer Name',
      'name'     => 'customer',
      'email'    => 'customer@' . str_replace('http://', '', env('APP_URL')),
      'password' => Hash::make('customer'),
    ]);
    $user->assignRole('Customer');

    // Other demo data
    User::factory()->times(20)->create();
    Category::factory()->times(20)->create();
    ProductType::factory()->times(20)->create();
    Brand::factory()->times(20)->create();
    Product::factory()->times(20)->create();

    ExpenseCategory::insert([
      ['name' => 'Employees Salary'],
      ['name' => 'Labour Cost'],
      ['name' => 'Transport Cost'],
      ['name' => 'Office Expense'],
      ['name' => 'Others'],
    ]);
  }
}
