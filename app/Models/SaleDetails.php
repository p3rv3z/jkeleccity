<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleDetails extends Model
{
  use HasFactory;

  protected $fillable = [
    'sale_id',
    'product_id',
    'quantity',
    'unit_price',
  ];

  /**
   * Getting total prince
   *
   * @return total_price
   */
  public function getTotalAmountAttribute()
  {
    return $this->quantity * $this->unit_price;
  }

  /**
   * One to many relationship on sale -> saleDetails (Reverse)
   *
   * @return relations
   */
  public function sale()
  {
    return $this->belongsTo(Sale::class);
  }

	/**
	 * One to many relationship on product -> saleDetails (Reverse)
	 *
	 * @return relations
	 */
	public function product()
	{
		return $this->belongsTo(Product::class);
	}

  public function return(): \Illuminate\Database\Eloquent\Relations\HasOne
  {
    return $this->hasOne(SaleReturn::class);
	}
}
