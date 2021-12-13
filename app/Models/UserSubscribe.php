<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscribe extends Model
{
    use HasFactory;

    protected $table = 'users_subscribe';

    protected $fillable = [
        'user_id', 'order_id' , 'valid_start', 'valid_end', 'status'
    ];

    protected $dates = [
        'deleted_at','created_at', 'updated_at'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

     /*
    |--------------------------------------------------------------------------
    | Relationship
    |--------------------------------------------------------------------------
    */

    public function senangpay(){

        return $this->hasOne(OrderPurchPaymentSenangpay::class,'order_id','order_id');
    }

    public function user(){

        return $this->hasOne(User::class,'id','user_id');
    }

    /*
    |--------------------------------------------------------------------------
    | End Relationship
    |--------------------------------------------------------------------------
    */

    public function getSubscriptionList($selector="*", $order="ASC", $status="all")
    {
        $getDonation = UserSubscribe::select($selector);

        $getDonation = $getDonation->orderBy('id',$order);

        return $getDonation->get();
    }

    public function getUserById($id)
    {
        $getData = UserSubscribe::find($id);

        return $getData;
    }
    
}
