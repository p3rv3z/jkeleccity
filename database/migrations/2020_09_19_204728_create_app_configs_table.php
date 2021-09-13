<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppConfigsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('app_configs', function (Blueprint $table) {
      $table->id();
      $table->string('name')->default('Inventory MGT');
      $table->text('description')->nullable()->default('Write about yourself.');
      $table->string('email')->default('contact@example.com');
      $table->string('helpline')->default('018XXXXXXXXXX');
      $table->string('whatsapp_support')->nullable();
      $table->string('fax')->nullable();
      $table->string('facebook')->nullable();
      $table->text('address')->default('Bangladesh');
      $table->string('working_days')->nullable();
      $table->string('logo')->nullable();
      $table->string('favicon')->nullable();
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
    Schema::dropIfExists('app_configs');
  }
}
