<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'donation';

    protected $fillable = [
        'order_id', 'cost', 'payment_type', 'status', 'user_id'
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

    public function getDonationList($selector="*", $order="ASC", $status="all")
    {
        $getDonation = Donation::select($selector);

        $getDonation = $getDonation->orderBy('id',$order);

        return $getDonation->get();
    }

    public function getUserById($id)
    {
        $getData = User::find($id);

        return $getData;
    }
}
