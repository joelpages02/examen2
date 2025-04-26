<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('category')->get();

        return Inertia::render('Event',[
        'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return Inertia::render('AddEvent',[
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([
            "name" => "required|max:255",
            "date" => "required|max:255",
            "category_id" => "required|max:255",
            "image" => "mimes:jpeg,png,jpg,gif|max:2048"
        ]);

        //dd($validate);

        if($request->hasFile('image')){
            $image = $request->file('image')->store('event', 'public');
            $validate['image'] = $image;
        };

        //dd($validate);

        Event::create($validate);
        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return Inertia::render('ShowEvent',[
            'events' => $event->load('category'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $categories = Category::all();

        return Inertia::render('UpdateEvent', ['event' => $event, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        // dd($request);
        $validate = $request->validate([
            "name" => "nullable|max:255",
            "date" => "nullable|max:255",
            "category_id" => "required|max:255",
            "image" => "nullable|mimes:jpeg,png,jpg,gif|max:2048"
        ]);

        //dd($validate);
        if($request->hasFile('image')){
            $image = $request->file('image')->store('event', 'public');
            $validate['image'] = $image;
        } else {
            unset($validate['image']);
        }
        
        $event->update($validate);
        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route("events.index");
    }
}
