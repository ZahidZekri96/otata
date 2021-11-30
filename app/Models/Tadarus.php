<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tadarus extends Model
{
    use HasFactory;

    protected $table = 'tadarus';

    protected $fillable = [
        'event', 'event_time', 'description', 'type', 'link'
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

    /*
    |--------------------------------------------------------------------------
    | End Relationship
    |--------------------------------------------------------------------------
    */


    //get event list
    public function getEventList($selector="*", $order="ASC", $status="all")
    {
        $getEvent = Tadarus::select($selector)
                        ->orderBy('id',$order);

        return $getEvent->get();
    }

    public function getEventById($id)
    {
        $getData = Tadarus::find($id);

        return $getData;
    }
}

