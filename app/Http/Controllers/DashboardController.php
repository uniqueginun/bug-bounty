<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        return to_route($request->user()->getDashboardRoute());
    }

    public function provider(Request $request)
    {
        $services = $request->user()->services()
            ->select(DB::raw('status, count(*) as status_count'))
            ->groupBy('status')
            ->get(['status', 'status_count']);

        return Inertia::render('Dashboard/Provider', [
            'stats' => $services
        ]);
    }

    public function submitter()
    {
        return Inertia::render('Dashboard/Submitter', [
            'stats' => 'stats'
        ]);
    }

    public function admin()
    {
        return Inertia::render('Dashboard/Admin', [
            'stats' => 'stats'
        ]);
    }
}
