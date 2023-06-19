<?php

namespace App\Http\Controllers;

use App\Constants\CurrentPage;
use App\Constants\Paginate;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use App\Models\Event;
use Carbon\Carbon;

class EventController extends Controller
{
    public function getEvents(Request $request)
    {
        $inputed = $request->only('keyword', 'from_date', 'to_date');
        $events = Event::select('id', 'title', 'date')
            ->when(!empty($request->keyword), function($q) use($request) {
                $q->where('title', 'like', "%".$request['keyword']."%");
            })
            ->when(!empty($request->from_date), function($q) use($request) {
                $q->whereDate('date', '>=', $request->from_date);
            })
            ->when(!empty($request->to_date), function($q) use($request) {
                $q->whereDate('date', '<=', $request->to_date);
            })
            ->paginate(Paginate::EVENT);

        return view('global.events', [
            'events' => $events,
            'current_page' => CurrentPage::EVENT,
            'inputed' => $inputed,
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

        return redirect()->route('events');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $members = FamilyMember::all();

        return view('global.edit_event', [
            'event' => $event,
            'members' => $members,
            'current_page' => CurrentPage::EVENT,
        ]);
    }

    public function update(UpdateEventRequest $request, $id)
    {
        $now = Carbon::now();
        $event = Event::findOrFail($id);
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
        $event->eventTimes()->delete();
        $event->eventTimes()->createMany($request->event_times);
        return redirect()->back()->with('message', 'Cập nhật thành công !');
    }
}
