<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionalidad1 extends Model
{
    use HasFactory;

    protected $table = 'funcionalidades1';

    protected $fillable = ['nombre'];
}