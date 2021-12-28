<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;

use App\Models\User;
use App\Models\UserSubscribe;
use App\Models\Event;
use App\Models\EventRegister;
use App\Models\Donation;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('super');
    }

    public function payment()
    {
        $title = "Report Summary";

        return view('report.payment.index', compact('title'));
    }

    public function event()
    {
        $title = "Event Summary";
        
        $getEvent = Event::withCount('event_register')->orderBy('id','asc')->get();

        return view('report.event.index', compact('title', 'getEvent'));
    }

    public function eventRegisteredList($id)
    {
        $title = "Registered List";

        $getRegistered = EventRegister::where('event_id',$id)->with('user')->get();

        return view('report.event.subviews.list', compact('title', 'getRegistered'));
    }

    public function getApiWeeklyDonation()
    {
        try{
                $getSevenDayList = Donation::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(cost) as total_donation'), DB::raw('DAY(created_at) as day'))
                        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
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

    public function getApiWeeklyRegister()
    {
        try{
                $getSevenDayList = User::select(DB::raw('DATE(created_at) as date'), DB::raw('count(created_at) as count'), DB::raw('DAY(created_at) as day'))
                        ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
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
