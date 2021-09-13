<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseDetailsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('purchase_details', function (Blueprint $table) {
      $table->id();
      $table->foreignId('purchase_id');
      $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
      $table->foreignId('product_id');
      $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
      $table->integer('quantity');
      $table->integer('unit_price');
      $table->integer('offer_price');
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
    Schema::dropIfExists('purchase_details');
  }
}
