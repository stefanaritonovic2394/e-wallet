<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'entry_date',
        'amount',
        'income_category_id',
        'currency_id',
        'created_by_id'
    ];

    public function setIncomeCategoryIdAttribute($input) {
        $this->attributes['income_category_id'] = $input ? $input : null;
    }

    public function setCreatedByIdAttribute($input) {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

    public function income_category() {
        return $this->belongsTo('App\IncomeCategory', 'income_category_id');
    }

    public function created_by() {
        return $this->belongsTo('App\User', 'created_by_id');
    }

    public function income_currency() {
        return $this->belongsTo('App\Currency', 'currency_id');
    }
}
