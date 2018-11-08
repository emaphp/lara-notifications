<?php

namespace App\Http\Controllers\Admin;

use App\BreakfastLog;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alas\EmployeesQueue\EmployeesQueue;

class BreakfastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = User::where('type','employee')->get();
        $users = $employees->where('order', null);
        $usersInQueue = User::whereNotNull('order')->get();
        $lastBL = BreakfastLog::whereNotNull('user_id')->orderBy('created_at','desc')->first();
        $lastDelegate = $lastBL->user()->first();
        return view('admin.breakfast.index', compact('users','usersInQueue','lastDelegate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

    public function add_user(Request $request){
        $user = User::find($request->get('addTo'));
        $beforeUser = User::find($request->get('before'));
        $queue = new EmployeesQueue();
        $result = $queue->insertBefore($user,$beforeUser);
        if ($result){
            return redirect()->route('admin.breakfast.index')->with('status','The user could be added successfully.');
        }
        else {
            return redirect()->route('admin.breakfast.index')->with('error','Error! The user could not be added.');
        }
    }
}
