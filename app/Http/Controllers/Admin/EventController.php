<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Event;
use App\Place;
use App\Tag;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $events = Event::all();
        $places = Place::all();
        return view('admin.events.index', compact('events', 'places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $places = Place::all();
        $tags = Tag::all();
        return view('admin.events.create',compact('places', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $starDateCheck = Carbon::parse($request->get('start_date'). " ". $request->get('start_time'));
        $endDateCheck = Carbon::parse($request->get('end_date') . " " . $request->get('end_time'));
        $data = array_merge($request->all(), ['endDateCheck' => $endDateCheck]);

        $rules = [
            'end_date' => 'nullable|after_or_equal:startDate',
            'endDateCheck' => 'after:'.$starDateCheck,
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect('admin/events/create')
                ->withErrors($validator)
                ->withInput();
        }

        $event = new Event;
        $event->name = $request->get('name');
        $event->start_date = $request->get('start_date');
        $event->start_time = $request->get('start_time');
        $event->end_date = $request->get('end_date');
        $event->end_time = $request->get('end_time');
        $event->place_id = $request->get('place')? $request->get('place') : null;
        $event->description = $request->get('description');
        $event->author_id = auth()->id();
        $event->save();

        if ($request->event_tags) {
            $event->tags()->attach($request->event_tags, ['taggable_type'=> 'App\Event']);
        }

        return redirect()->route('admin.events.index')->with('success', 'Information has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        $users = User::where("type","employee")->get();
        $places = Place::all();
        $tags = Tag::all();
        return view('admin.events.show',compact('event','users','places', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        $users = User::where("type","employee")->get();
        $places = Place::all();
        $tags = Tag::all();
        return view('admin.events.edit',compact('event','users','places', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $starDateCheck = Carbon::parse($request->get('start_date'). " ". $request->get('start_time'));
        $endDateCheck = Carbon::parse($request->get('end_date') . " " . $request->get('end_time'));
        $data = array_merge($request->all(), ['endDateCheck' => $endDateCheck]);

        $rules = [
            'end_date' => 'nullable|after_or_equal:startDate',
            'endDateCheck' => 'after:'.$starDateCheck,
        ];

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return redirect('admin/events/'. $id .'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $event = Event::find($id);
        $event->name = $request->get('name');
        $event->start_date = $request->get('start_date');
        $event->start_time = $request->get('start_time');
        $event->end_date = $request->get('end_date');
        $event->end_time = $request->get('end_time');
        $event->place_id = $request->get('place')? $request->get('place') : null;
        $event->description = $request->get('description');
        $event->save();
        $event->users()->detach();
        $event->users()->attach($request->get('guests'));

        $event->tags()->detach();
        if ($request->event_tags) {
            $event->tags()->attach($request->event_tags, ['taggable_type'=> 'App\Event']);            
        }


        return redirect()->route('admin.events.index')->with('status','Event edited successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->cancelled_at = Carbon::now()->format('Y-m-d');
        $event->status = 'canceled';
        $event->save();
        return redirect()->route('admin.events.index')->with('status','Event canceled successfully.');  
    }

    public function publish($id)
    {
        $event = Event::find($id);
        $event->published_at = Carbon::now()->format('Y-m-d');
        $event->save();
        return redirect()->route('admin.events.index')->with('status','Event published successfully.');
    }

    public function unpublish($id)
    {
        $event = Event::find($id);
        $event->published_at = null;
        $event->save();
        return redirect()->route('admin.events.index')->with('status','Event unpublished successfully.');
    }
}
