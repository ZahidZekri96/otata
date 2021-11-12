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

        $getFreeEvent = Event::where("type" , "free")->take(5)->get();
        
        $getPaidEvent = Event::where("type" , "paid")->take(5)->get();

        return view('dashboard.index', compact('title', 'getFreeEvent', 'getPaidEvent'));
    }
}
