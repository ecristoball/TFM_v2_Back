<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Functionality extends Model
{
    protected $fillable = ['name'];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_functionality');
    }
}
