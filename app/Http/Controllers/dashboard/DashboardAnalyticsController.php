<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class DashboardAnalyticsController extends Controller
{
    public function index()
    {
        return view('content.dashboard.dashboards-analytics'); // Correct view path
    }
}

