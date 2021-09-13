<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleReturnsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sale_returns', function (Blueprint $table) {
      $table->id();

      $table->foreignId('sale_id')->constrained('sales');

      $table->unsignedBigInteger('sale_details_id')->unique();
      $table->foreign('sale_details_id')->references('id')->on('sale_details')->onDelete('cascade');

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
    Schema::dropIfExists('sale_returns');
  }
}
