<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'event';

    protected $fillable = [
        'event', 'event_date', 'event_time', 'location', 'description', 'type', 'link', 'price'
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

    public function event_register()
    {
        return $this->hasMany(EventRegister::class, 'event_id', 'id');
    }

    public function banner()
    {
        return $this->hasOne(EventBanner::class,'event_id','id');
    }

    /*
    |--------------------------------------------------------------------------
    | End Relationship
    |--------------------------------------------------------------------------
    */


    //get event list
    public function getEventList($selector="*", $order="ASC", $status="all")
    {
        $getEvent = Event::select($selector)
                        ->with('event_register')
                        ->orderBy('id',$order);

        return $getEvent->get();
    }

    //get free event list
    public function getPaidEventList($selector="*", $order="ASC", $status="all")
    {
        $getEvent = Event::select($selector)
                        ->where("type" , "paid")
                        ->orderBy('id',$order);

        return $getEvent->get();
    }

    //get paid event list
    public function getFreeEventList($selector="*", $order="ASC", $status="all")
    {
        $getEvent = Event::select($selector)
                        ->where("type" , "free")
                        ->orderBy('id',$order);

        return $getEvent->get();
    }

    public function getEventById($id)
    {
        $getData = Event::find($id);

        return $getData;
    }
}

