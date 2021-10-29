<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $title = "List Event";

        $getEvent = (new Event())->getEventList("*", "ASC", "active");
        
        $getFreeEvent = (new Event())->getFreeEventList("*", "ASC", "active");
        
        $getPaidEvent = (new Event())->getPaidEventList("*", "ASC", "active");

        return view('event.list.index', compact('title', 'getEvent' , 'getFreeEvent' , 'getPaidEvent'));
    }


//----------------------------------------------------------------- API ---------------------------------------------------------------------------------------------

       //api save event
       public function apiPostStoreEvent(Request $request)
       {
           try{
   
               $event = Event::create([
                   'event'         => $request->name,
                   'link'          => $request->link,
                   'type'          => $request->type,
                   'event_date'    => $request->date,
                   'event_time'    => $request->time,
                   'description'   => $request->description,
               ]);
   
   
               return response()->json([
                   "status"  => true,
                   "message" => "success",
                   "object"  => $event->id
               ]);
   
           }catch (Exception $exception){
               return response()->json([
                   "status"  => false,
                   "message" => "error"
               ]);
           }
       }
   
       //api update event
       public function apiPutUpdateEvent(Request $request, $id)
       {
           try{
               $user = Event::findOrFail($request->user_id);
               $user->name          = $request->name;
               
               if(!empty($request->password)){
                   $user->password  = Hash::make($request->password);
               }
               $user->email         = $request->email;
               $user->type          = $request->type;
               $user->save();
   
               $userinfo = UserInfo::findOrFail($request->id);
               $userinfo->address   = $request->address;
               $userinfo->postcode  = $request->postcode;
               $userinfo->city      = $request->city;
               $userinfo->state     = $request->state;
               $userinfo->country   = $request->country;
               $userinfo->gender    = $request->gender;
               $userinfo->save();
   
               $object['agent'] = $id;
   
               return response()->json([
                   "status"  => true,
                   "message" => "success",
                   "object"  => $object
               ]);
   
           }catch (Exception $exception){
               return response()->json([
                   "status"  => false,
                   "message" => "error"
               ]);
           }
       }
}
