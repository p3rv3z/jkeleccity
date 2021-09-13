<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('products', function (Blueprint $table) {
      $table->id();

      $table->foreignId('brand_id')
        ->constrained('brands')
        ->onUpdate('cascade')
        ->onDelete('cascade');
      $table->foreignId('product_type_id')
        ->constrained('product_types')
        ->onUpdate('cascade')
        ->onDelete('cascade');

      $table->string('name');
      $table->string('model_name')->unique();
//      $table->integer('code');
      $table->text('description')->nullable();
      $table->integer('final_stock')->default(0);
      $table->integer('purchase_return_stock')->default(0);
      $table->integer('sale_return_stock')->default(0);
//      $table->boolean('status')->default(true);

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('products');
  }
}
