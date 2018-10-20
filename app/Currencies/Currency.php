<?php

namespace App\Currencies;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [
        'title',
        'symbol',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
