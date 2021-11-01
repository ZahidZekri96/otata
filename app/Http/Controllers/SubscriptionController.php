<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
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

            $invoiceno = rand(pow(10, $digits-1), pow(10, $digits)-1);

            $event = Donation::create([
                'order_id'          => $invoiceno,
                'cost'              => $request->total_sub,
                'payment_type'      => 'toyyibpay',
            ]);

            $total_sub= $request->total_sub *100;

            $digits = 3;
            $invoiceno = rand(pow(10, $digits-1), pow(10, $digits)-1);

            $option = array(
                'userSecretKey'=>'i2ss8my7-lvas-tchg-n28s-k4azerqyit3s',
                'categoryCode'=>'awckryp5',
                'billName'=>'Otata Subscription',
                'billDescription'=>'Otata Subscription',
                'billPriceSetting'=>1,
                'billPayorInfo'=>1,
                'billAmount'=>$total_sub,
                'billReturnUrl'=>route('register.toyyibpay.paid'),
                'billCallbackUrl'=>route('register.toyyibpay.cb'),
                'billExternalReferenceNo' => $invoiceno,
                'billTo'=>$request->name,
                'billEmail'=>$request->email,
                'billPhone'=>$request->hpnum,
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
