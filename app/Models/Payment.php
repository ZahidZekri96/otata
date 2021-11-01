<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';

    protected $fillable = [
        'id	', 'order_id', 'cost', 'payment_type'
    ];

    protected $dates = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
