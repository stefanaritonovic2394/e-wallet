<?php

namespace App\Expenses;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'entry_date',
        'amount',
        'expense_category_id',
        'currency_id',
        'created_by_id',
        'created_at',
        'updated_at'
    ];
}
