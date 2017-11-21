<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Order model
 */
class Order extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'address',
        'phone_number'
    ];

    public static $rules = [
        'id' => 'numeric',
        'user_id' => 'required|numeric|exists:users,id',
        'user_id.exists' => 'Not an existing ID',
        'address' => 'required',
        'phone_number' => 'numeric|required'
    ];

    protected $hidden   = ['created_at', 'updated_at'];
}
