<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'product',
        'duration',
        'qty',
        'total',
        'status'
    ];
}
