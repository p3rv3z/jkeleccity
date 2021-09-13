<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
  use HasFactory;

  protected $fillable =[
    'expense_category_id',
    'date',
    'amount',
    'added_by',
    'expense_by',
    'purpose',
  ];

  public function category()
  {
    return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
  }

  public function addedBy()
  {
    return $this->belongsTo(User::class, 'added_by');
  }

  public function expenseBy()
  {
    return $this->belongsTo(User::class, 'expense_by');
  }
}
