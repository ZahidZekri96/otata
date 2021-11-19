<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SenangpayController extends Controller
{
    public function index()
    {
        return view('senangpay.index');
    }

    public function return()
    {
        return view('senangpay.return');
    }
}

//----------------------------------------------------------------- API ---------------------------------------------------------------------------------------------


