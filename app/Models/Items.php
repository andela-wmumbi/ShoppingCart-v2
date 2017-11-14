<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Items model
 */
class Items extends Model
{
    protected $fillable = [
        'name',
        'stock',
        'price',
    ];

    protected $hidden   = ['created_at', 'updated_at'];
}
