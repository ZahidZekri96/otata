<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;

use App\Models\OrderPurchPaymentSenangpay;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\UserSubscribe;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('super');
    }

    public function index()
    {
        $title = "Subscription";

        $getSubscription = (new UserSubscribe())->getSubscriptionList("*", "DESC", "active");

        return view('payment.subscription.index', compact('title', 'getSubscription'));
    }
    
    public function memberIndex()
    {
        $title = "Subscription";

        $subscription = UserSubscribe::where('user_id',Auth::user()->id)->first();

        return view('member.payment.subscription.index', compact('title','subscription'));
    }

    //----------------------------------------------------------------- API ---------------------------------------------------------------------------------------------

    //api save event
    public function apiPostStoreSubscription(Request $request)
    {
        try{

            $getUser  = User::find(Auth::user()->id);

            $getUserSubscribe = UserSubscribe::where('user_id',Auth::user()->id)->first();

            $digits = 5;
            $order_id = rand(pow(10, $digits-1), pow(10, $digits)-1);

            if($getUserSubscribe != null){
                $getUserSubscribe -> order_id = $order_id;
                $getUserSubscribe -> status = 'pending';
                $getUserSubscribe->save();
            }else{
                dd()
                $userSubscribe = UserSubscribe::create([
                    'status'            => 'pending',
                    'order_id'          => $order_id,
                    'user_id'           => Auth::user()->id
                ]);
            }

            $senangPay = OrderPurchPaymentSenangpay::create([
                'state'         => 'pending',
                'type'          => "subscription",
                'order_id'      => $order_id
            ]);

            $object['order_id'] = $order_id;

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
