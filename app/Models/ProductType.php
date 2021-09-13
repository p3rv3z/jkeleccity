<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
  use HasFactory;

  protected $guarded = ['action'];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function products()
  {
    return $this->hasMany(Product::class);
  }
}
