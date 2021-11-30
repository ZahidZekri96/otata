<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPurchPaymentSenangpay extends Model
{
    use HasFactory;

    protected $table = 'order_purch_payment_senangpay';

    protected $fillable = [
        'order_id', 'transaction_id', 'state', 'status', 'type'
    ];

    protected $dates = [
        'deleted_at', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    public function donation(){

        return $this->hasOne(Donation::class,'order_id','order_id');
    }

    public function usersubscribe(){

        return $this->hasOne(UserSubscribe::class,'order_id','order_id');
    }

    public function users(){

        return $this->hasOne(User::class,'order_id','order_id');
    }

    
    /*
    |--------------------------------------------------------------------------
    | End Relationship
    |--------------------------------------------------------------------------
    */
}
