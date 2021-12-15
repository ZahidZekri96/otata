<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Storage;
use Auth;
use Mail;

use App\Models\OrderPurchPaymentSenangpay;
use App\Models\Event;
use App\Models\EventBanner;
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

        $getEvent = (new Event())->getEventList("*", "DESC", "active");
        
        $getFreeEvent = (new Event())->getFreeEventList("*", "DESC", "active");
        
        $getPaidEvent = (new Event())->getPaidEventList("*", "DESC", "active");

        return view('event.list.index', compact('title', 'getEvent' , 'getFreeEvent' , 'getPaidEvent'));
    }

    public function index_member()
    {
        $title = "List Event";

        $getEvent = (new Event())->getEventList("*", "DESC", "active");
        
        $getFreeEvent = (new Event())->getFreeEventList("*", "DESC", "active");
        
        $getPaidEvent = (new Event())->getPaidEventList("*", "DESC", "active");

        return view('member.event.list.index', compact('title', 'getEvent' , 'getFreeEvent' , 'getPaidEvent'));
    }

    public function eventAdd($id)
    {
        $title = "Add Event";

        $getEvent = (new Event())->getEventById($id);

        return view('event.list.subviews.add', compact('title', 'getEvent'));
    }

    public function eventDetail($id)
    {
        $title = "Event Detail";

        $getEvent = (new Event())->getEventById($id);

        return view('event.list.subviews.detail', compact('title', 'getEvent'));
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
                'price'         => $request->price,
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
    public function apiPutUpdateEvent(Request $request)
    {
        try{
            $event = Event::findOrFail($request->id);
            $event->event         = $request->event;
            $event->event_date    = $request->event_date;
            $event->event_time    = $request->event_time;
            $event->link          = $request->event_link;
            $event->description   = $request->description;
            $event->save();

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

    //store pic event
    public function apiPostStoreEventBanner(Request $request)
    {
        try{
            if($request['curr_photo'] == null)
            {

                if ($request->hasFile('photo'))
                {
                    $rulesPhoto =[
                        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ];

                    $validatorPhoto    = Validator::make($request->all(), $rulesPhoto, [
                        'photo.image' => __('Picture must be an image!'),
                    ]);

                    if( $validatorPhoto->fails() ){
                        return response()->json($validatorPhoto->messages(), 200);
                    }

                    $uploadPhoto = EventBanner::where('event_id', $request->id)->first();
                    if($uploadPhoto != null)
                    {
                        if($uploadPhoto->filename != $request->photo->getClientOriginalName())
                        {
                            Storage::disk('public_uploads')->delete('images/'.$uploadPhoto->filename);
                            $images = $request->photo->getClientOriginalName();
                            $images = time().'_'.$images;
                            Storage::disk('public_uploads')->putFileAs(
                                'images', $request->photo, $images
                            );

                            $uploadPhoto = EventBanner::where('event_id', $request->id)->first();
                            $uploadPhoto->filename = $images;
                            $uploadPhoto->save();
                        }
                    }
                    else
                    {
                        $images = $request->photo->getClientOriginalName();
                        $images = time().'_'.$images;
                        Storage::disk('public_uploads')->putFileAs(
                            'images', $request->photo, $images
                        );

                        //store photo
                        $uploadPhoto = new EventBanner([
                            'event_id'   => $request->id,
                            'filename'   => $images,
                        ]);
                        $uploadPhoto->save();
                    }
                }
                elseif($request['curr_photo'] == null && $request->photo == "undefined")
                {
                    $getPhoto = EventBanner::where('event_id', $request->id)->first();
                    if($getPhoto != null){
                        Storage::disk('public_uploads')->delete('images/'.$getPhoto->filename);
                        $delPhoto = EventBanner::where('event_id', $request->id)->delete();
                    }
                }
            }
            elseif($request['edit'] == 'no')
            {
                //copy photo
                $copyPhoto = new EventBanner([
                    'event_id' => $request->id,
                    'filename'     => $request['curr_photo'],
                ]);
                $copyPhoto->save();
            }
            elseif(isset($request['edit']) && $request['edit'] != 'no')
            {
                if($request->photo != 'undefined')
                {
                    $getPhoto = EventBanner::where('event_id', $request->id)->first();
                    if($getPhoto != null){
                        Storage::disk('public_uploads')->delete('images/'.$getPhoto->filename);
                        $delPhoto = EventBanner::where('event_id', $request->id)->delete();
                    }
                    $images = $request->photo->getClientOriginalName();
                    $images = time().'_'.$images;
                    Storage::disk('public_uploads')->putFileAs(
                        'images', $request->photo, $images
                    );

                    $copyPhoto = new EventBanner([
                        'event_id' => $request->id,
                        'filename'     => $images,
                    ]);
                    $copyPhoto->save();
                }
            }

            return response()->json([
                "status"  => true,
                "message" => "success",
                "object"  => "event"
            ]);
        } catch (Exception $exception){
            return response()->json([
                "status"  => false,
                "message" => "error"
            ]);
        }
    }

    //api delete event
    public function apiDeleteEvent($id)
    {
        try
        {
            $delete = Event::find($id);

            if( $delete ){
                // if($delete->banner != null)
                //     Storage::disk('public_uploads')->delete('images/'.$delete->banner->filename);
                $delete->delete();
            }

            $object['event'] = $delete;

            return response()->json([
                "status"  => true,
                "message" => "success",
                "object"  => $object
            ]);
        }
        catch(Exception $exception){
            return response()->json([
                "status"  => false,
                "message" => "Error"
            ]);
        }
    }


}
