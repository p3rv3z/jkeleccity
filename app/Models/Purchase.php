<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'invoice_no',
//		'lc_no',
//		'lot_no',
//		'container_no',
    'c_invoice_no',
    'date',
    'remark',
    'status',
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
   * One to many relationship with purchase -> purchase details
   */
  public function details()
  {
    return $this->hasMany(PurchaseDetails::class, 'purchase_id');
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function returns()
  {
    return $this->hasMany(PurchaseReturn::class, 'purchase_id');
  }

  public function returnsExchangedSum()
  {
    return $this->returns()->selectRaw('purchase_id, SUM(quantity) as exchanged')->where('policy', 'exchange')->groupBy('purchase_id');
  }

  public function getExchangedAttribute()
  {
    // if relation is not loaded already, let's do it first
    if (!array_key_exists('returnsExchangedSum', $this->relations))
      $this->load('returnsExchangedSum');

    $related = $this->getRelation('returnsExchangedSum');

    // then return the count directly
    return ($related) ? (int)$related->first()?->exchanged : 0;
  }

  public function returnsRefundedSum()
  {
    return $this->returns()->selectRaw('purchase_id, SUM(quantity * unit_price) as refund')->where('policy', 'refund')->groupBy('purchase_id');
  }

  public function getRefundAttribute()
  {
    // if relation is not loaded already, let's do it first
    if (!array_key_exists('returnsRefundedSum', $this->relations))
      $this->load('returnsRefundedSum');

    $related = $this->getRelation('returnsRefundedSum');

    // then return the count directly
    return ($related) ? (int)$related->first()?->refund : 0;
  }
}
