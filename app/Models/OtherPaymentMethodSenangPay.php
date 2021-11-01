<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPaymentMethodSenangPay extends Model
{
    use HasFactory;

    protected $table = 'other_payment_method_senangpay';

    protected $fillable = [
        'pay_method_id', 'merchant_id', 'secret_key', 'hash_type', 'is_operating_charges', 'type_operating_charges', 'value_operating_charges'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */
    
    /*
    |--------------------------------------------------------------------------
    | End Relationship
    |--------------------------------------------------------------------------
    */
}
