<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $upcoming_events = Event::query()
            ->where('status', 0)
            ->orderBy('date', 'asc')
            ->get();

        return Inertia::render('Dashboard', [
            'upcomingEvents' => $upcoming_events
        ]);
    }
}
