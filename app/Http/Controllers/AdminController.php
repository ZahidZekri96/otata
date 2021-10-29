<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserInfo;

class AdminController extends Controller
{
    public function index()
    {
        $title = "List Admin / Staff";

        $getUser = (new User())->getUserList("*", "ASC", "active", "admin");

        return view('user.customer.index', compact('title', 'getUser'));
    }

    public function add()
    {
        $title = "Add Admin";

        //$dataUser = (new User())->getUserById($id);

        return view('user.admin.subviews.add', compact('title'));
    }

    public function edit()
    {
        $title = "Edit Admin";

        $dataUser = (new User())->getUserById($id);

        return view('user.admin.subviews.edit', compact('title', 'dataUser'));
    }

    public function info($id)
    {
        $title = "Info Admin";

        $dataUser = (new User())->getUserById($id);

        return view('user.admin.subviews.info', compact('title', 'dataUser'));
    }


//----------------------------------------------------------------- API ---------------------------------------------------------------------------------------------

    //api get user list
    public function apiGetIndexDt()
    {
        try{
            $userList = (new User())->getUserList();

            $object['user'] = $userList;

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

            $userinfo = UserInfo::create([
                'user_id'       => $user->id,
                'gender'        => $request->gender,
                'address'       => $request->address,
                'postcode'      => $request->postcode,
                'city'          => $request->city,
                'state'         => $request->state,
                'country'       => $request->country,
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

    //api update agent
    public function apiPutUpdateUser(Request $request, $id)
    {
        try{
            $user = User::findOrFail($request->user_id);
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
}
