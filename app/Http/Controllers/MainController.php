<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;

use App\Models\Event;
use App\Models\EventRegister;
use App\Models\User;
use App\Models\Donation;

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

        $totalDonationWeek = Donation::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('status','success')->sum('cost');

        $totalDonation = Donation::where('status','success')->sum('cost');

        $totalMember = User::where('type','member')->where('status',1)->count();

        return view('dashboard.index', compact('title', 'getFreeEvent', 'getPaidEvent', 'getUpcomingEvent', 'totalMember', 'totalDonationWeek', 'totalDonation'));
    }

    public function getApiSevenDaySales(Request $request)
    {
        try{
                $getSevenDayList = Donation::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(cost) as total_donation'), DB::raw('DAY(created_at) as day'))
                        ->where('created_at', '>=', Carbon::today()->subDays(7))
                        ->groupBy(DB::raw('DATE(created_at)'))
                        ->groupBy(DB::raw('DAY(created_at)'))
                        ->get();

            $object['seven'] = $getSevenDayList;

            return response()->json([
                "status"  => true,
                "message" => "success",
                "object"  => $object
            ]);
        } catch (Exception $exception){
            return response()->json([
                "status"  => false,
                "message" => "error"
            ]);
        }
    }
}
