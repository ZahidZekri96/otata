<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Models\Event;
use App\Models\EventRegister;
use App\Models\User;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('super');
    }
    
    public function index()
    {
        $title = "Dashboard";

        $getUpcomingEvent = Event::where("event_date" ,'>=', date("Y-m-d"))->orderBy('event_date', 'asc')->take(5)->get();

        $getFreeEvent = Event::where("type" , "free")->orderBy('id', 'desc')->take(5)->get();
        
        $getPaidEvent = Event::where("type" , "paid")->orderBy('id', 'desc')->take(5)->get();

        return view('dashboard.index', compact('title', 'getFreeEvent', 'getPaidEvent', 'getUpcomingEvent'));
    }
}
