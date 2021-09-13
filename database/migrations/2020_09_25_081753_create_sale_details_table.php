<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleDetailsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sale_details', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger('sale_id');
      $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');

      $table->unsignedBigInteger('product_id');
      $table->foreign('product_id')->references('id')->on('products');

      $table->integer('quantity');
      $table->integer('unit_price');

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
    Schema::dropIfExists('sale_details');
  }
}
