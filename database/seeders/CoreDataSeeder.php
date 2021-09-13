<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AppConfig;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class CoreDataSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Making app configuration
    AppConfig::create([
      'name' => 'Inventory MGT',
    ]);

    // Creating role permissions
    Permission::create(['name' => 'appConfig']);
    Permission::create(['name' => 'category.index']);
    Permission::create(['name' => 'category.create']);
    Permission::create(['name' => 'category.edit']);
    Permission::create(['name' => 'category.delete']);
    Permission::create(['name' => 'product_type.index']);
    Permission::create(['name' => 'product_type.create']);
    Permission::create(['name' => 'product_type.edit']);
    Permission::create(['name' => 'product_type.delete']);
    Permission::create(['name' => 'brand.index']);
    Permission::create(['name' => 'brand.create']);
    Permission::create(['name' => 'brand.edit']);
    Permission::create(['name' => 'brand.delete']);
    Permission::create(['name' => 'product.index']);
    Permission::create(['name' => 'product.create']);
    Permission::create(['name' => 'product.edit']);
    Permission::create(['name' => 'product.delete']);
    Permission::create(['name' => 'expense.index']);
    Permission::create(['name' => 'expense.create']);
    Permission::create(['name' => 'expense.edit']);
    Permission::create(['name' => 'expense.delete']);
    Permission::create(['name' => 'expense_category.index']);
    Permission::create(['name' => 'expense_category.create']);
    Permission::create(['name' => 'expense_category.edit']);
    Permission::create(['name' => 'expense_category.delete']);
    Permission::create(['name' => 'purchase.index']);
    Permission::create(['name' => 'purchase.create']);
    Permission::create(['name' => 'purchase.show']);
    Permission::create(['name' => 'purchase.edit']);
    Permission::create(['name' => 'purchase.delete']);
    Permission::create(['name' => 'sale.index']);
    Permission::create(['name' => 'sale.create']);
    Permission::create(['name' => 'sale.show']);
    Permission::create(['name' => 'sale.edit']);
    Permission::create(['name' => 'sale.delete']);
    Permission::create(['name' => 'sale_return.index']);
    Permission::create(['name' => 'sale_return.show']);
    Permission::create(['name' => 'sale_return.manage']);
    Permission::create(['name' => 'sale_return.delete']);
    Permission::create(['name' => 'purchase_return.index']);
    Permission::create(['name' => 'purchase_return.show']);
    Permission::create(['name' => 'purchase_return.manage']);
    Permission::create(['name' => 'purchase_return.delete']);
    Permission::create(['name' => 'user.index']);
    Permission::create(['name' => 'user.create']);
    Permission::create(['name' => 'user.show']);
    Permission::create(['name' => 'user.edit']);
    Permission::create(['name' => 'user.delete']);
    Permission::create(['name' => 'report.purchase']);
    Permission::create(['name' => 'report.sale']);
    Permission::create(['name' => 'report.stock']);
    Permission::create(['name' => 'report.expense']);
    Permission::create(['name' => 'report.transaction']);
    Permission::create(['name' => 'banner_image.index']);
    Permission::create(['name' => 'banner_image.create']);
    Permission::create(['name' => 'banner_image.edit']);
    Permission::create(['name' => 'banner_image.delete']);

    $superAdmin = Role::create(['name' => 'Super Admin']);

    // Default user
    $master = User::create([
      'name' => 'Master',
      'username' => 'master',
      'email' => 'master@' . str_replace('http://', '', config('app.url')),
      'password' => Hash::make('master'),
    ]);
    $master->assignRole($superAdmin);

    $admin = Role::create(['name' => 'Admin']);
    $admin->givePermissionTo(Permission::all());

    $shopManager = Role::create(['name' => 'Shop Manager']);
    $shopManager->givePermissionTo([
      'category.index',
      'brand.index',
      'product.index',
      'purchase.index',
      'purchase.create',
      'purchase.edit',
      'user.index',
      'user.create',
      'sale.index',
      'sale.create',
      'sale.edit',
      'sale_return.index',
      'sale_return.manage',
      'purchase_return.index',
      'purchase_return.manage',
      'expense.index',
      'expense.create',
      'expense.edit',
      'expense_category.index',
      'expense_category.create',
      'expense_category.edit',
      'report.stock',
    ]);

    Role::create(['name' => 'Supplier']);
    Role::create(['name' => 'Distributor']);
    Role::create(['name' => 'Customer']);
  }
}
