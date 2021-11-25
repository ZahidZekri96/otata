<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\OrderPurchPaymentSenangpay;
use App\Models\Donation;
use App\Models\EventRegister;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Event;
use Auth;

class SenangpayController extends Controller
{
    public function index()
    {
        return view('senangpay.payment');
    }

    public function return()
    {
        return view('senangpay.return');
    }

    public function senangpayRegisterEvent($id,$order_id)
    {
        $getUser  = User::where('id', Auth::user()->id)->first();

        $getEvent = Event::where('id', $id)->first();

        $detail = "Otata Event:".$getEvent->event;

        $amount = $getEvent->price;
        
        $detail = str_replace(' ', '_', $detail);

        $order_id = $order_id;
        
        $name = $getUser->name;

        $email = $getUser->email;

        $phone = $getUser->userinfo->hpnum;

        $hash_str = "236-823".$detail."".$amount."".$order_id;
        $hash=hash_hmac('sha256', $hash_str, '236-823');
        
        return view('senangpay.payment', compact('detail','amount', 'order_id', 'name', 'email','phone', 'hash'));
    }
    
    public function senangpayDonation($donation,$order_id)
    {
        $getUser  = User::where('id', Auth::user()->id)->first();

        $getDonation = Donation::where('id', $donation)->first();

        $detail = "Otata Donation";

        $amount = $getDonation->cost;
        
        $detail = str_replace(' ', '_', $detail);

        $order_id = $order_id;
        
        $name = $getUser->name;

        $email = $getUser->email;

        $phone = $getUser->userinfo->hpnum;

        $hash_str = "32145-562".$detail."".$amount."".$order_id;
        $hash=hash_hmac('sha256', $hash_str, '32145-562');
        
        return view('senangpay.payment', compact('detail','amount', 'order_id', 'name', 'email','phone', 'hash'));
    }

    public function senangpaySubscription($order_id)
    {
        $getUser  = User::where('id', Auth::user()->id)->first();

        $recurring_id = "163763734065";

        $detail = "Otata Monthly Subscription";
        
        $detail = str_replace(' ', '_', $detail);

        $order_id = $order_id;
        
        $name = $getUser->name;

        $email = $getUser->email;

        $phone = $getUser->userinfo->hpnum;

        $hash_str = "32145-562".$recurring_id."".$order_id;
        $hash=hash('sha256', $hash_str);
        
        return view('senangpay.recurring', compact('detail','recurring_id', 'order_id', 'name', 'email','phone', 'hash'));
    }
//----------------------------------------------------------------- API ---------------------------------------------------------------------------------------------

    public function updateSenangpay(Request $request){
        try{

            $getSenangpay = OrderPurchPaymentSenangpay::where('order_id',$request->order_id)->first();

            $getSenangpay->transaction_id   = $request->transaction_id;
            $getSenangpay->status           = $request->status;
            if($getSenangpay->status == 1){
                $getSenangpay->state          = 'success';
            }else if($getSenangpay->status == 0){
                $getSenangpay->state          = 'failed';
            }
            $getSenangpay->save();

            //dd($request->order_id);

            if($getSenangpay->type == "event"){

                $getEvent = EventRegister::where('order_id',$request->order_id)->first();
                $getEvent->status = 'success';
                $getEvent->save();

            }else if($getSenangpay->type == "donation"){

                $getEvent = Donation::where('order_id',$request->order_id)->first();
                $getEvent->status = 'success';
                $getEvent->save();

            }

            $object['senangpay'] = $request->status;

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

    public function updateRecurringSenangpay(Request $request){
        try{

            $getSenangpay = OrderPurchPaymentSenangpay::where('order_id',$request->order_id)->first();

            $getSenangpay->transaction_id   = $request->transaction_id;
            $getSenangpay->status           = $request->status;
            if($getSenangpay->status == 1){
                $getSenangpay->state          = 'success';
            }else if($getSenangpay->status == 0){
                $getSenangpay->state          = 'failed';
            }
            $getSenangpay->save();

            //dd($request->order_id);

            if($getSenangpay->type == "event"){

                $getEvent = EventRegister::where('order_id',$request->order_id)->first();
                $getEvent->status = 'success';
                $getEvent->save();

            }else if($getSenangpay->type == "donation"){

                $getEvent = Donation::where('order_id',$request->order_id)->first();
                $getEvent->status = 'success';
                $getEvent->save();

            }

            $object['senangpay'] = $request->status;

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

