<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('super');
    }
    
    public function memberIndex()
    {
        $title = "Subscription";

        return view('member.payment.subscription.index', compact('title'));
    }

    //----------------------------------------------------------------- API ---------------------------------------------------------------------------------------------

    //api save event
    public function apiPostStoreSubscription(Request $request)
    {
        try{

            $digits = 5;
            $invoiceno = rand(pow(10, $digits-1), pow(10, $digits)-1);

            $total_sub='100.00';

            $hash_str = "236-823Donation_Otata".$total_sub."".$invoiceno;

            $hash=hash_hmac('sha256', $hash_str, '236-823');

            $option = array(
                'recurring_id'=>'',
                'hash'=>$hash,
                'order_id' => $invoiceno,
                'name'=>'Zahid Bin Zekri',
                'email'=>'zahidzekri@gmail.com',
                'phone'=>'01123218497',
            );

            $url = 'https://api.sandbox.senangpay.my/recurring/payment/404154564160746';
            $response = Http::asForm()->post($url, $option);
            $result = json_decode($response);
            //$billCode = $response[0]['BillCode'];
            //$url='https://dev.toyyibpay.com/'.$billCode;
            dd($result);


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
}
