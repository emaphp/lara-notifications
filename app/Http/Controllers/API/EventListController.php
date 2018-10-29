<?php

namespace App\Http\Controllers\API;

use App\Event;
use App\Place;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class EventListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function getPendingEvents($year, $month)
    {
        $events = Event::where('status','=','pending')
            ->with(['place' => function($place) {
                $place = Place::select('id','name')
                   ->where('id','=','place_id');
            }]);

        $events = $events->whereYear('start_date','=',$year)
                        ->whereMonth('start_date','=', $month)
                        ->orderBy('start_date')->get()->toArray();
        return response()->json([
            'eventList' => $events
        ]);

    }
}
