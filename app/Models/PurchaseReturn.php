<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    use HasFactory;

  protected $fillable = [
    'purchase_id',
    'purchase_details_id',
    'quantity',
    'unit_price',
    'cause',
    'policy',
    'date'
  ];

  public function purchase()
  {
    return $this->belongsTo(Purchase::class);
  }

  public function purchaseDetail()
  {
    return $this->belongsTo(PurchaseDetails::class, 'purchase_details_id', 'id');
  }
}
