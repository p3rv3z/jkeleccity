<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('sales', function (Blueprint $table) {
      $table->id();

      $table->unsignedBigInteger('user_id'); // Here user as distributor
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

      $table->date('date');
      $table->string('invoice_no');

      $table->integer('cost_amount');
      $table->integer('discount');
      $table->integer('paid_amount');

      $table->string('payment_type');
      $table->string('cheque_no')->nullable();
      $table->string('bank_name')->nullable();
      $table->string('card_no')->nullable();
      $table->string('card_type')->nullable();


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
    Schema::dropIfExists('sales');
  }
}
