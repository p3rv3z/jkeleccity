<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleReturn extends Model
{
  use HasFactory;

  protected $fillable = [
    'sale_id',
    'sale_details_id',
    'quantity',
    'unit_price',
    'cause',
    'policy',
    'date'
  ];

  public function sale()
  {
    return $this->belongsTo(Sale::class);
  }

  public function saleDetail()
  {
    return $this->belongsTo(SaleDetails::class, 'sale_details_id', 'id');
  }
}
