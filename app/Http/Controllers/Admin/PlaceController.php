<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Place;
use App\Tag;

class PlaceController extends Controller
{
    protected $array_type = ['Casa','Salon','Oficina','Universidad','Otro'];
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::all();
        return view('place.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $array_type = $this->array_type;
        $tags = Tag::all();
        return view('place.create', compact('array_type', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $place = new Place;
        $place->name = $request->place_name;
        $place->description = $request->place_description;
        $place->type = $request->place_type;
        $place->save();

        if (count($request->place_tags) > 0) {
            foreach($request->place_tags as $tag) {
                $place->tags()->attach($tag, ['taggable_type'=> 'App\Place']);
            }
        }
        return redirect()->route('admin.places.index')->with('status','Place created successfully.');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::find($id);
        $array_type = $this->array_type;
        return view('place.show', compact('place', 'array_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::find($id);
        $array_type = $this->array_type;
        $tags = Tag::all();
        return view('place.edit', compact('place','array_type', 'tags'));
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
        $place = Place::find($id);
        $place->name = $request->place_name;
        $place->description = $request->place_description;
        $place->type = $request->place_type;
        $place->save();
        $place->tags()->detach();
        if ($request->place_tags) {
            $place->tags()->attach($request->place_tags, ['taggable_type'=> 'App\Place']);            
        }

        return redirect()->route('admin.places.index')->with('status','Place edited successfully.');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::find($id);
        $place->delete();
        $place->tags()->detach();
        return redirect()->route('admin.places.index')->with('status','Place removed successfully.');  
    }
}
