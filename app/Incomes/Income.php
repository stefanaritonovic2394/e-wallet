<?php

namespace App\Incomes;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'entry_date',
        'amount',
        'currency_id',
        'created_by_id',
        'created_at',
        'updated_at',
        'income_category_id'
    ];
}
