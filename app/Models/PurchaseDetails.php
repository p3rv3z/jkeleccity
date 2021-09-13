<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseDetails extends Model
{
  use HasFactory;

  protected $fillable = [
    'purchase_id',
    'product_id',
    'quantity',
    'unit_price',
    'regular_price',
    'offer_price',
    'location',
    'remark',
    'receive_date',
  ];

  /**
   * One to many relationship on purchase -> purchaseDetails (Reverse)
   *
   * @return relations
   */
  public function purchase()
  {
    return $this->belongsTo(Purchase::class);
  }

  /**
   * One to many relationship on product -> purchaseDetails (Reverse)
   *
   * @return relations
   */
  public function product()
  {
    return $this->belongsTo(Product::class);
  }

  public function return(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(PurchaseReturn::class);
  }
}
