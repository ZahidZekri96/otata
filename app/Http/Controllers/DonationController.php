<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Auth;

use App\Models\Donation;
use App\Models\UsersInfo;
use App\Models\User;

class DonationController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('super');
    }
    
    public function memberIndex()
    {
        $title = "Donation";

        return view('member.payment.donation.index', compact('title'));
    }


//----------------------------------------------------------------- API ---------------------------------------------------------------------------------------------

    //api save event
    public function apiPostStoreDonation(Request $request)
    {
        try{

            $digits = 5;
            $invoiceno = rand(pow(10, $digits-1), pow(10, $digits)-1);

            $event = Donation::create([
                'order_id'          => $invoiceno,
                'cost'              => $request->cost,
                'payment_type'      => $request->type,
            ]);

            $cost = $request->cost*100;

            $getUser = User::find($request->userid);

            //dd($cost);

            $option = array(
                'userSecretKey'=>'i2ss8my7-lvas-tchg-n28s-k4azerqyit3s',
                'categoryCode'=>'awckryp5',
                'billName'=>'Otata Donation',
                'billDescription'=>'Otata Donation',
                'billPriceSetting'=>1,
                'billPayorInfo'=>1,
                'billAmount'=>$cost,
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

        }catch (Exception $exception){
            return response()->json([
                "status"  => false,
                "message" => "error"
            ]);
        }
    }
}
