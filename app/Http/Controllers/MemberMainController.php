<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\EventRegister;
use App\Models\User;


class MemberMainController extends Controller
{
    public function index()
    {
        $title = "Dashboard";

        $getFreeEvent = Event::where("type" , "free")->take(5)->get();
        
        $getPaidEvent = Event::where("type" , "paid")->take(5)->get();

        return view('member.dashboard.index', compact('title', 'getFreeEvent', 'getPaidEvent'));
    }
}
