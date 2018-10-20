<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'remember_token', 'role_id', 'currency_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role() {
        return $this->belongsTo('App\Role', 'role_id');
    }

    public function currency() {
        return $this->belongsTo('App\Currency', 'currency_id');
    }

    public function setRoleIdAttribute($input) {
        $this->attributes['role_id'] = $input ? $input : null;
    }

    public function income_categories() {
        return $this->hasMany('App\IncomeCategory', 'created_by_id');
    }

    public function incomes() {
        return $this->hasMany('App\Income', 'created_by_id');
    }

    public function expense_categories() {
        return $this->hasMany('App\ExpenseCategory', 'created_by_id');
    }

    public function expenses() {
        return $this->hasMany('App\Expense', 'created_by_id');
    }
}
