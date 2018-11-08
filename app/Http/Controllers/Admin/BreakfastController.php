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
        return view('admin.breakfast.index');
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

    public function view_add_user(){
        $employees = User::where('type','employee')->get();
        $users = $employees->where('order', null);
        $usersInQueue = User::whereNotNull('order')->get();
        $lastBL = BreakfastLog::whereNotNull('user_id')->orderBy('created_at','desc')->first();
        $lastDelegate = $lastBL->user()->first();
        return view('admin.breakfast.add_user',compact('users','usersInQueue','lastDelegate'));
    }

    public function view_remove_user(){
        $usersInQueue = User::whereNotNull('order')->get();
        return view('admin.breakfast.remove_user',compact('usersInQueue'));
    }

    public function add_user(Request $request){
        $user = User::find($request->get('addTo'));
        $beforeUser = User::find($request->get('before'));
        $queue = new EmployeesQueue();
        $result = $queue->insertBefore($user,$beforeUser);
        if ($result){
            return redirect()->route('admin.breakfast.index')->with('status','The user was successfully added.');
        }
        else {
            return redirect()->route('admin.breakfast.index')->with('error','Error! The user could not be added.');
        }
    }

    public function remove_user(Request $request)
    {
        $user = User::find($request->get('removeTo'));
        $queue = new EmployeesQueue();
        $result = $queue->remove($user);
        if ($result){
            return redirect()->route('admin.breakfast.index')->with('status','The user was successfully removed.');
        }
        else {
            return redirect()->route('admin.breakfast.index')->with('error','Error! The user could not be removed.');
        }
    }
}
