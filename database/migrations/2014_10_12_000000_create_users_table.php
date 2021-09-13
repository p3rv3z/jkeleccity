<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('username')->unique()->nullable();
      $table->string('email')->unique()->nullable();
      $table->timestamp('email_verified_at')->nullable();
      $table->string('password');
      $table->rememberToken();
      $table->string('current_team_id')->nullable();
      $table->text('profile_photo_path')->nullable();
      $table->timestamps();
      // Custom Columns
      $table->string('nid')->unique()->nullable();
      $table->string('birth_certificate_no')->unique()->nullable();
      $table->string('address')->nullable();
      $table->text('description')->nullable();
      $table->string('phone')->unique()->nullable();
      $table->string('fax')->unique()->nullable();
      $table->string('website')->nullable();
      $table->boolean('status')->default(true);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
