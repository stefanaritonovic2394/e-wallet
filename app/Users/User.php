<?php

namespace App\Users;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'remember_token',
        'role_id',
        'currency_id',
        'created_at',
        'updated_at'
    ];

}