<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::where('user_id', Auth::user()->id);

        // return $logs->get();

        return Inertia::render('ActLog', [
            "logs" => $logs->get()
        ]);
    }
}
