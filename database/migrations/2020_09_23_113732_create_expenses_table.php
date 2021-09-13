<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('expenses', function (Blueprint $table) {
      $table->id();
      $table->foreignId('expense_category_id');
      $table->foreign('expense_category_id')->references('id')->on('expense_categories')->onDelete('cascade');
      $table->date('date');
      $table->integer('amount');

      $table->foreignId('added_by');
      $table->foreign('added_by')->references('id')->on('users')->onDelete('cascade');

      $table->foreignId('expense_by');
      $table->foreign('expense_by')->references('id')->on('users')->onDelete('cascade');

      $table->string('purpose')->nullable();
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
    Schema::dropIfExists('expenses');
  }
}
