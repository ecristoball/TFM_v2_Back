<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JsonFuncionalidadesKey extends Model
{
    //
     protected $fillable = ['key_name', 'parent_key', 'level', 
     'frontlevel','frontparent',
     'level1', 'level2', 'level3','level4', 
     'level5','level6', 'level7','level8',
     'value',
     'required'
    ];
}
