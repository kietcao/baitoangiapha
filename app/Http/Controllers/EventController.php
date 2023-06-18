<?php

namespace App\Http\Controllers;

use App\Constants\CurrentPage;
use App\Constants\Paginate;
use App\Http\Requests\CreateEventRequest;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function getEvents()
    {
        $events = Event::paginate(Paginate::EVENT);

        return view('global.create_event', [
            'events' => $events,
            'current_page' => CurrentPage::EVENT,
        ]);
    }

    public function store(CreateEventRequest $request)
    {
        dd($request->all());
    }
}
