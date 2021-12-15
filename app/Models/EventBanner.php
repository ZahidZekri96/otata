<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventBanner extends Model
{
    use HasFactory;

    protected $table = 'event_banner';

    protected $fillable = [
        'event_id', 'filename'
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

    public function event(){

        return $this->belongsTo(Event::class,'id','event_id');
    }

    /*
    |--------------------------------------------------------------------------
    | End Relationship
    |--------------------------------------------------------------------------
    */
}
