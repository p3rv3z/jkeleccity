<?php

namespace App\Models;

use App\Models\SaleReturn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'date',
    'invoice_no',
    'cost_amount',
    'paid_amount',
    'discount',
    'payment_type',
    'cheque_no',
    'bank_name',
    'card_no',
    'card_type',
  ];

  /**
   * Getting total due
   *
   * @return due-amount
   */
  public function getDueAmountAttribute()
  {
    return $this->cost_amount - $this->discount - $this->paid_amount;
  }

  /**
   * One to many relationship with user -> sale (Reverse)
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  /**
   * One to many relationship with sale -> sale details
   */
  public function details()
  {
    return $this->hasMany(SaleDetails::class, 'sale_id');
  }

  /**
   * One to many relationship with sale -> sale details
   */
  public function returns()
  {
    return $this->hasMany(SaleReturn::class, 'sale_id');
  }

  public function returnsExchangedSum()
  {
    return $this->returns()->selectRaw('sale_id, SUM(quantity) as exchanged')->where('policy', 'exchange')->groupBy('sale_id');
  }

  public function getExchangedAttribute()
  {
    // if relation is not loaded already, let's do it first
    if (!array_key_exists('returnsExchangedSum', $this->relations))
      $this->load('returnsExchangedSum');

    $related = $this->getRelation('returnsExchangedSum');

    // then return the count directly
    return ($related) ? (int) $related->first()?->exchanged : 0;
  }

  public function returnsRefundedSum()
  {
    return $this->returns()->selectRaw('sale_id, SUM(quantity * unit_price) as refund')->where('policy', 'refund')->groupBy('sale_id');
  }

  public function getRefundAttribute()
  {
    // if relation is not loaded already, let's do it first
    if (!array_key_exists('returnsRefundedSum', $this->relations))
      $this->load('returnsRefundedSum');

    $related = $this->getRelation('returnsRefundedSum');

    // then return the count directly
    return ($related) ? (int) $related->first()?->refund : 0;
  }
}
