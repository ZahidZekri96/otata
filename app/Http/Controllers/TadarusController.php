<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;

use App\Models\OrderPurchPaymentSenangpay;
use App\Models\Event;
use App\Models\EventRegister;
use App\Models\UsersInfo;
use App\Models\User;
use App\Models\Tadarus;

class TadarusController extends Controller
{
    public function __construct()
    {
        $this->middleware('super');
    }

    public function index()
    {
        $title = "Tadarus Al-Quran";

        $getEvent = (new Tadarus())->getEventList("*", "DESC", "active");

        return view('event.tadarus.index', compact('title', 'getEvent'));
    }

    public function index_member()
    {
        $title = "Tadarus Al-Quran";

        $getEvent = (new Tadarus())->getEventList("*", "DESC", "active");

        return view('member.tadarus.index', compact('title', 'getEvent'));
    }

    public function tadarusDetail($id)
    {
        $title = "Event Detail";

        $getEvent = (new Tadarus())->getEventById($id);

        return view('event.tadarus.subviews.info', compact('title', 'getEvent'));
    }

    public function memberTadarusDetail($id)
    {
        $title = "Event Detail";

        $getEvent = (new Tadarus())->getEventById($id);

        return view('member.tadarus.subviews.info', compact('title', 'getEvent'));
    }


//----------------------------------------------------------------- API ---------------------------------------------------------------------------------------------

    //api get user list
    public function apiGetIndexDt()
    {
        try{
            $eventList = (new Tadarus())->getEventList();

            $object['tadarus'] = $eventList;

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
    public function apiPostStoreTadarus(Request $request)
    {
        try{

            $event = Tadarus::create([
                'event'         => $request->name,
                'link'          => $request->link,
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
    public function apiPutUpdateTadarus(Request $request)
    {
        try{
            $tadarus = Tadarus::findOrFail($request->event_id);
            $tadarus->event        = $request->event;
            $tadarus->link         = $request->link;
            $tadarus->event_time   = $request->event_time;
            $tadarus->save();

            $object['tadarus'] = $tadarus->id;

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
                'status'        => 'registered'
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

            $digits = 5;
            $order_id = rand(pow(10, $digits-1), pow(10, $digits)-1);

            $event = EventRegister::create([
                'event_id'      => $request->event,
                'user_id'       => $request->id,
                'status'        => 'pending',
                'order_id'      => $order_id
            ]);

            
            $senangPay = OrderPurchPaymentSenangpay::create([
                'state'         => 'pending',
                'type'          => "event",
                'order_id'      => $order_id
            ]);

            $object['order_id'] = $order_id;

            // $amount = ($getEvent->price)*100;
            // $amount = (int)$amount;

            // $digits = 5;
            // $invoiceno = rand(pow(10, $digits-1), pow(10, $digits)-1);

            // $option = array(
            //     'userSecretKey'=>'i2ss8my7-lvas-tchg-n28s-k4azerqyit3s',
            //     'categoryCode'=>'awckryp5',
            //     'billName'=>'Otata',
            //     'billDescription'=>'Otata Event Registration',
            //     'billPriceSetting'=>1,
            //     'billPayorInfo'=>1,
            //     'billAmount'=>$amount,
            //     'billReturnUrl'=>route('member.event.list'),
            //     'billCallbackUrl'=>route('member.event.list'),
            //     'billExternalReferenceNo' => $invoiceno,
            //     'billTo'=>$getUser->name,
            //     'billEmail'=>$getUser->email,
            //     'billPhone'=>$getUser->userinfo->hpnum,
            //     'billSplitPayment'=>0,
            //     'billSplitPaymentArgs'=>'',
            //     'billPaymentChannel'=>'0',
            //     'billDisplayMerchant'=>1,
            //     'billContentEmail'=>'Thank you for purchasing our product!',
            //     'billChargeToCustomer'=>1
            // );

            // $url = 'https://dev.toyyibpay.com/index.php/api/createBill';
            // $response = Http::asForm()->post($url, $option);
            // $result = json_decode($response);
            // $billCode = $response[0]['BillCode'];
            // $url='https://dev.toyyibpay.com/'.$billCode;

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
