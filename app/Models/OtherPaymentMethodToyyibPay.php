<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherPaymentMethodToyyibPay extends Model
{
    use HasFactory;

    protected $table = 'other_payment_method_toyyibpay';

    protected $fillable = [
        'pay_method_id', 'secret_key', 'code_category', 'payment_channel', 'is_operating_charges', 'type_operating_charges', 'value_operating_charges'
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
