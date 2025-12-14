<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
