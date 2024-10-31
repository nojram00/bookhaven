<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ActivityLogController extends Controller
{
    /**
     * Displays the activity log page which displays user's activities.
     */
    public function index()
    {
        $logs = ActivityLog::where('user_id', Auth::user()->id);


        return Inertia::render('ActLog', [
            "logs" => $logs->get()
        ]);
    }
}
