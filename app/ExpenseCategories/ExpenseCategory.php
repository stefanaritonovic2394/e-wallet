<?php

namespace App\ExpenseCategories;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = [
        'name',
        'created_by_id',
        'created_at',
        'updated_at'
    ];
}
