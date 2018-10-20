<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    protected $fillable = [
        'name',
        'created_by_id'
    ];

    public function setCreatedByIdAttribute($input) {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

    public function created_by() {
        return $this->belongsTo('App\User', 'created_by_id');
    }
}
