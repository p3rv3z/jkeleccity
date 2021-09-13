<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;

  protected $guarded = ['action'];


  public function registerMediaCollections(): void
  {
      $this->addMediaCollection('product_image')
      ->singleFile()
      ->useDisk('product_images')
      ->useFallbackUrl('/images/sample-product.jpg')
      ->useFallbackPath(public_path('/images/sample-product.jpg'));
  }

  public function scopeSearch($query, $term)
  {
    $term = "%$term%";
    $query->where(function ($query) use ($term) {
      $query->where('name', 'like', $term)
      ->orWhere('model_name', 'like', $term)
      ->orWhere('description', 'like', $term)
      ->orWhereHas('product_type', function ($query) use ($term) {
        $query->where('name', 'like', $term)
              ->orWhereHas('category', function ($query) use ($term) {
                $query->where('name', 'like', $term);
              });
      })
      ->orWhereHas('brand', function ($query) use ($term) {
        $query->where('name', 'like', $term);
      });
    });


  }

  public function brand()
  {
    return $this->belongsTo(Brand::class);
  }

  public function product_type()
  {
    return $this->belongsTo(ProductType::class);
  }

  /**
   * One to many relationship with product -> purchase details
   */
  public function purchase()
  {
    return $this->hasMany(PurchaseDetails::class);
  }
  
  /**
   * To get latest purchase record
   */
  public function latest_purchase()
  {
      return $this->hasOne(PurchaseDetails::class)->latest();
  }

  /**
   * One to many relationship with product -> sale details
   */
  public function sale()
  {
    return $this->hasMany(SaleDetails::class);
  }
}
