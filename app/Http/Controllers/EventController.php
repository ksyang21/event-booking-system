<?php
namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();

        return Inertia::render('Events/Index', ['events' => $events]);
    }

    public function create()
    {
        return Inertia::render('Events/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'capacity' => 'required|integer',
        ]);

        Event::create($validatedData);

        return Redirect::route('events.index')->with('success', 'Event created successfully!');
    }

    public function show(Event $event)
    {
        return Inertia::render('Events/Show', ['event' => $event]);
    }

    public function edit(Event $event)
    {
        return Inertia::render('Events/Edit', ['event' => $event]);
    }

    public function update(Request $request, Event $event)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'location' => 'required',
            'capacity' => 'required|integer',
        ]);

        $event->update($validatedData);

        return Redirect::route('events.index')->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return Redirect::route('events.index')->with('success', 'Event deleted successfully!');
    }
}