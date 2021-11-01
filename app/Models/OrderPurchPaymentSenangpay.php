<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPurchPaymentToyyibpay extends Model
{
    use HasFactory;

    protected $table = 'order_purch_payment_senangpay';

    protected $fillable = [
        'order_purch_pay_id	', 'toyyibpay_billcode', 'state', 'status', 'type'
    ];

    protected $dates = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
