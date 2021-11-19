<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersInfo extends Model
{
    use HasFactory;

    protected $table = 'users_info';

    protected $fillable = [
        'user_id', 'address', 'postcode', 'city', 'state', 'country', 'gender', 'hpnum'
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
    public function user(){

        return $this->belongsTo(User::class,'user_id','id');
    }
    

    /*
    |--------------------------------------------------------------------------
    | End Relationship
    |--------------------------------------------------------------------------
    */

    //get user list
    public function getUserList($selector="*", $order="ASC", $status="all")
    {
        $getUser = UserInfo::select($selector)
                        ->with('user')
                        ->orderBy('id',$order);

        return $getUser->get();
    }

    public function getUserById($id)
    {
        $getData = UserInfo::find($id);

        return $getData;
    }
}
