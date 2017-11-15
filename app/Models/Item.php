<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Item model
 */
class Item extends Model
{
    protected $fillable = [
        'name',
        'stock',
        'price',
    ];

    protected $hidden   = ['created_at', 'updated_at'];
}
