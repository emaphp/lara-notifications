<?php

namespace App\Http\Controllers\Admin;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Event;
use App\Place;


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
        return view('admin.events.create',compact('places'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'start_date' => 'nullable|after:yesterday',
            'start_time' => 'nullable',
            'end_date' => 'nullable|after_or_equal:start_date',
            'end_time' => 'nullable|after:start_time'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/events/create')
                ->withErrors($validator)
                ->withInput();
        }

        $event= new Event;
        $event->name=$request->get('name');
        $event->start_date = $request->get('start_date');
        $event->start_time = $request->get('start_time');
        $event->end_date = $request->get('end_date');
        $event->end_time = $request->get('end_time');
        $event->place_id=$request->get('place');
        $event->description=$request->get('description');
        $event->author_id= auth()->id();
        $event->save();

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
        //
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
        $users = User::where("type","employee")->get();;
        return view('admin.events.edit',compact('event','users'));
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
        $rules = [
            'start_date' => 'nullable|after:yesterday',
            'start_time' => 'nullable',
            'end_date' => 'nullable|after_or_equal:start_date',
            'end_time' => 'nullable|after:start_time'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('admin/events/'. $id .'/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $event = Event::find($id);
        $event->name=$request->get('name');
        $event->start_date=$request->get('start_date');
        $event->start_time=$request->get('start_time');
        $event->end_date=$request->get('end_date');
        $event->end_time=$request->get('end_time');
        $event->place_id=$request->get('place');
        $event->description=$request->get('description');
        $event->save();
        $event->users()->detach();
        $event->users()->attach($request->get('guests'));
        return redirect()->route('admin.events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
