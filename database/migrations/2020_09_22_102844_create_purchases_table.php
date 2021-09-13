<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('purchases', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('user_id'); // Here user as distributor
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->string('invoice_no');
//            $table->string('lc_no');
//            $table->string('lot_no');
//            $table->string('container_no');
      $table->string('c_invoice_no');
      $table->date('date');
      $table->string('remark')->nullable();

      $table->integer('cost_amount');
      $table->integer('discount');
      $table->integer('paid_amount');

      $table->string('payment_type');
      $table->string('cheque_no')->nullable();
      $table->string('bank_name')->nullable();
      $table->string('card_no')->nullable();
      $table->string('card_type')->nullable();

      $table->boolean('status')->default(false);
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
    Schema::dropIfExists('purchases');
  }
}
