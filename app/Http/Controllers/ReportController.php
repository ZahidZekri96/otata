<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class ReportController extends Controller
{
    public function summary()
    {
        $title = "Report Summary";

        return view('report.summary.index', compact('title'));
    }

    public function event()
    {
        $title = "Event Summary";
        
        $getEvent = (new Event())->getEventList("*", "ASC", "active");

        return view('report.event.index', compact('title', 'getEvent'));
    }
}
