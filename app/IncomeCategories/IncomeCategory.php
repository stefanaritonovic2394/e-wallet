<?php

namespace App\IncomeCategories;

use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    protected $fillable = [
        'name',
        'created_by_id',
        'created_at',
        'updated_at'
    ];
}
