<?php

namespace App\Http\Controllers;

use App\Constants\CurrentPage;
use App\Constants\Paginate;
use App\Http\Requests\CreateEventRequest;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    public function getEvents()
    {
        $events = Event::paginate(2); //Paginate::EVENT

        return view('global.events', [
            'events' => $events,
            'current_page' => CurrentPage::EVENT,
        ]);
    }

    public function create()
    {
        $members = FamilyMember::all();

        return view('global.create_event', [
            'members' => $members,
            'current_page' => CurrentPage::EVENT,
        ]);
    }

    public function store(CreateEventRequest $request)
    {
        $now = Carbon::now();
        $event = new Event;
        $event->title = $request->title;
        $event->date = $request->date;
        $event->detail = $request->detail;
        $event->save();

        // Sync event and members
        $joinMembers = explode(',', $request->join_members);
        $event->eventsMembers()->sync($joinMembers);
        $event->eventsMembers()->updateExistingPivot($joinMembers, [
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Sync event and event times
        $event->eventTimes()->createMany($request->event_times);

        return redirect()->route('event_list');
    }
}
