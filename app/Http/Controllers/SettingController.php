<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;

use App\Models\User;
use App\Models\UsersInfo;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('super');
    }

    public function addUser()
    {
        $title = "Add New User";

        return view('setting.add_user', compact('title'));
    }

    public function changePassword()
    {
        $title = "Change New Password";

        return view('setting.change_password', compact('title'));
    }

    public function thirdPartyInteragation()
    {
        $title = "Third Party Interagation";

        return view('setting.thirdparty', compact('title'));
    }


//----------------------------------------------------------------- API ---------------------------------------------------------------------------------------------


    //api save user
    public function apiPostStoreUser(Request $request)
    {
        try{

            $user = User::create([
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'type'      => $request->type,
                'status'    => 1,
            ]);

            $userinfo = UsersInfo::create([
                'user_id'       => $user->id,
                'gender'        => $request->gender,
                'address'       => $request->address,
                'postcode'      => $request->postcode,
                'city'          => $request->city,
                'state'         => $request->state,
                'country'       => $request->country,
                'hpnum'         => $request->phone,
            ]);


            return response()->json([
                "status"  => true,
                "message" => "success",
                "object"  => $userinfo->id
            ]);

        }catch (Exception $exception){
            return response()->json([
                "status"  => false,
                "message" => "error"
            ]);
        }
    }

    public function putApiUpdatePassword(Request $request, $id)
    {
    	try{

            $rules =[
            	'ori_password'   => 'required|password',
                'password'    	 => 'required|same:confirm_password',
            ];

            $validator    = Validator::make($request->all(), $rules, [
            	'ori_password.required'  => __('Current password is required!'),
            	'ori_password.password'  => __('Current password is wrong!'),
                'password.required' 	 => __('Password is required!'),
            ]);

            if( $validator->fails() ){
                return response()->json($validator->messages(), 200);
            }

            $user = User::findOrFail($id);
            $user->password 	= Hash::make($request->password);
            $user->save();

            return response()->json([
                "status"  => true,
                "message" => "success",
                "object"  => "password"
            ]);
        } catch (Exception $exception){
            return response()->json([
                "status"  => false,
                "message" => "error"
            ]);
        }
    }
}
