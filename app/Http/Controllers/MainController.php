<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $title = "Dashboard";

        return view('theme.main', compact('title'));
    }
}
