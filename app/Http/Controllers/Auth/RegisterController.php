<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UsersInfo;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Http;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

    public function redirectTo()
    {
        switch(Auth::user()->type){
            case 'admin':
                $this->redirectTo = '/main';
                return $this->redirectTo;
                break;
            case 'member':
                $this->redirectTo = '/member/main';
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
        } 
        // return $next($request);
    } 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // $user = User::create([
        //     'name'      => $data['name'],
        //     'email'     => $data['email'],
        //     'password'  => Hash::make($data['password']),
        //     'type'      => 'member',
        //     'status'    => 1,
        // ]);

        // $userinfo = UsersInfo::create([
        //     'user_id'       => $user->id,
        //     'gender'        => $data['gender'],
        //     'address'       => $data['address'],
        //     'postcode'      => $data['postcode'],
        //     'city'          => $data['city'],
        //     'state'         => $data['state'],
        //     'country'       => $data['country'],
        //     'hpnum'         => $data['phone']
        // ]);

        $digits = 5;
        $invoiceno = rand(pow(10, $digits-1), pow(10, $digits)-1);

        $total_sub='100.00';

        return $this->redirectTo= '/senangpay';
    }
}
