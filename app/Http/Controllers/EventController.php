<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;

use App\Models\Event;
use App\Models\EventRegister;
use App\Models\UsersInfo;
use App\Models\User;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('super');
    }

    public function index()
    {
        $title = "List Event";

        $getEvent = (new Event())->getEventList("*", "ASC", "active");
        
        $getFreeEvent = (new Event())->getFreeEventList("*", "ASC", "active");
        
        $getPaidEvent = (new Event())->getPaidEventList("*", "ASC", "active");

        return view('event.list.index', compact('title', 'getEvent' , 'getFreeEvent' , 'getPaidEvent'));
    }

    public function index_member()
    {
        $title = "List Event";

        $getEvent = (new Event())->getEventList("*", "ASC", "active");
        
        $getFreeEvent = (new Event())->getFreeEventList("*", "ASC", "active");
        
        $getPaidEvent = (new Event())->getPaidEventList("*", "ASC", "active");

        return view('member.event.list.index', compact('title', 'getEvent' , 'getFreeEvent' , 'getPaidEvent'));
    }

    public function memberEventDetail($id)
    {
        $title = "Event Detail";

        $getEvent = (new Event())->getEventById($id);

        return view('member.event.list.subviews.info', compact('title', 'getEvent'));
    }


//----------------------------------------------------------------- API ---------------------------------------------------------------------------------------------

    //api get user list
    public function apiGetIndexDt()
    {
        try{
            $eventList = (new Event())->getEventList();

            $object['event'] = $eventList;

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

    //api register
    public function apiRegisterEvent(Request $request)
    {
        try{

            $event = EventRegister::create([
                'event_id'      => $request->event,
                'user_id'       => $request->id,
            ]);

            return response()->json([
                "status"  => true,
                "message" => "success",
                "object"  => $event->id
            ]);
        } catch (Exception $exception){
            return response()->json([
                "status"  => false,
                "message" => "error"
            ]);
        }
    }

    //api paid register
    public function apiRegisterPaidEvent(Request $request)
    {
        try{

            $getEvent = Event::find($request->event);

            $getUser = User::find($request->id);

            $amount = ($getEvent->price)*100;
            $amount = (int)$amount;

            $digits = 5;
            $invoiceno = rand(pow(10, $digits-1), pow(10, $digits)-1);

            $option = array(
                'userSecretKey'=>'i2ss8my7-lvas-tchg-n28s-k4azerqyit3s',
                'categoryCode'=>'awckryp5',
                'billName'=>'Otata',
                'billDescription'=>'Otata Event Registration',
                'billPriceSetting'=>1,
                'billPayorInfo'=>1,
                'billAmount'=>$amount,
                'billReturnUrl'=>route('member.event.list'),
                'billCallbackUrl'=>route('member.event.list'),
                'billExternalReferenceNo' => $invoiceno,
                'billTo'=>$getUser->name,
                'billEmail'=>$getUser->email,
                'billPhone'=>$getUser->userinfo->hpnum,
                'billSplitPayment'=>0,
                'billSplitPaymentArgs'=>'',
                'billPaymentChannel'=>'0',
                'billDisplayMerchant'=>1,
                'billContentEmail'=>'Thank you for purchasing our product!',
                'billChargeToCustomer'=>1
            );

            $url = 'https://dev.toyyibpay.com/index.php/api/createBill';
            $response = Http::asForm()->post($url, $option);
            $result = json_decode($response);
            $billCode = $response[0]['BillCode'];
            $url='https://dev.toyyibpay.com/'.$billCode;

            return response()->json([
                "status"  => true,
                "message" => "success",
                "object"  => $url
            ]);
        } catch (Exception $exception){
            return response()->json([
                "status"  => false,
                "message" => "error"
            ]);
        }
    }


}
