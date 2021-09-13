<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseReturnsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('purchase_returns', function (Blueprint $table) {
      $table->id();

      $table->foreignId('purchase_id')->constrained('purchases');

      $table->unsignedBigInteger('purchase_details_id')->unique();
      $table->foreign('purchase_details_id')->references('id')->on('purchase_details')->onDelete('cascade');

      $table->date('date');
      $table->integer('quantity');
      $table->integer('unit_price');
      $table->string('policy');
      $table->string('cause');

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
    Schema::dropIfExists('purchase_returns');
  }
}
