<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Home;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('category')->get();
        $categories = Category::all();
        // dd($events);
        return Inertia::render('Welcome', [
            'events' => $events,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeController $homeController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeController $homeController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeController $homeController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeController $homeController)
    {
        //
    }
}
