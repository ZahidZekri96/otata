<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

use App\Models\Event;
use App\Models\EventRegister;
use App\Models\User;
use App\Models\Donation;


class MemberMainController extends Controller
{

    public function __construct()
    {
        $this->middleware('super');
    }
    
    public function index()
    {
        $title = "Dashboard";

        $getUpcomingEvent = EventRegister::where("user_id",Auth::user()->id)->whereHas('event', function($q){
            $q->where('event_date', '>=', date("Y-m-d"))->orderBy('event_date', 'asc');
        })->take(5)->get();

        $getFreeEvent = Event::where("type" , "free")->orderBy('id', 'desc')->take(5)->get();
        
        $getPaidEvent = Event::where("type" , "paid")->orderBy('id', 'desc')->take(5)->get();

        $totalDonationWeek = Donation::where('user_id', Auth::user()->id)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('status','success')->sum('cost');

        $totalDonation = Donation::where('user_id', Auth::user()->id)->where('status','success')->sum('cost');

        $totalEventRegister = EventRegister::where('user_id', Auth::user()->id)->count();
        
        return view('member.dashboard.index', compact('title', 'getFreeEvent', 'getPaidEvent', 'getUpcomingEvent', 'totalEventRegister', 'totalDonationWeek', 'totalDonation'));
    }
}
