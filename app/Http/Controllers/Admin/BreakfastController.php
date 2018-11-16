<?php

namespace App\Http\Controllers\Admin;

use App\BreakfastLog;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alas\EmployeesQueue;

class BreakfastController extends Controller
{
    protected $employeesQueue;

    public function __construct(EmployeesQueue $employeesQueue)
    {
        $this->employeesQueue = $employeesQueue;
    }

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

    public function view_add_user()
    {
        $employees = User::where('type','employee')->get();
        $users = $employees->where('order', null);
        $usersInQueue = User::whereNotNull('order')->get();
        $lastBL = BreakfastLog::whereNotNull('user_id')->orderBy('created_at','desc')->first();
        $lastDelegate = $lastBL->user()->first();
        return view('admin.breakfast.add_user',compact('users','usersInQueue','lastDelegate'));
    }

    public function view_remove_user()
    {
        $usersInQueue = User::whereNotNull('order')->get();
        return view('admin.breakfast.remove_user',compact('usersInQueue'));
    }

    public function view_reassign_delegate()
    {
        $queue = $this->employeesQueue;
        $usersInQueue = $queue->getAll();
        $lastBL = $queue->currentBreakfastLog();
        $delegate = $lastBL->user()->first();
        return view('admin.breakfast.reassign_delegate',compact('usersInQueue','delegate'));
    }

    public function add_user(Request $request){
        $user = User::find($request->get('addTo'));
        $beforeUser = User::find($request->get('before'));
        $queue = $this->employeesQueue;
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
        $queue = $this->employeesQueue;
        $result = $queue->remove($user);
        if ($result){
            return redirect()->route('admin.breakfast.index')->with('status','The user was successfully removed.');
        }
        else {
            return redirect()->route('admin.breakfast.index')->with('error','Error! The user could not be removed.');
        }
    }

    public function reassign_delegate(Request $request)
    {
        $queue = $this->employeesQueue;
        $currentBL = $queue->currentBreakfastLog();
        $newDelegate = User::find($request->get('newDelegate'));
        $currentDelegate = $currentBL->user()->first();

        if (!is_null($currentDelegate)) {
            $currentDelegate = User::find($currentBL->user_id);
            $orderCurrentDelegate = $currentDelegate->order;
            $currentDelegate->order = $newDelegate->order;
            $newDelegate->order = $orderCurrentDelegate;
            $currentDelegate->save();
            $newDelegate->save();
        }

        $bfLogUpdate = BreakfastLog::find($currentBL->id);
        $bfLogUpdate->user_id = $newDelegate->id;
        $bfLogUpdate->order = $newDelegate->order;
        $bfLogUpdate->save();

        return redirect()->route('admin.breakfast.index')->with('status','The delegate was successfully changed.');

    }

    public function postpone_delegate()
    {
        $queue = $this->employeesQueue;
        if (!$queue->wasPostponed()) {
            $queue->postponeBreakfast();
            return redirect()->route('admin.breakfast.index')->with('status','The delegate was successfully postponed.');
        } else {
            return redirect()->route('admin.breakfast.index')->with('status','The current delegate is already postponed.');
        }
    }




}
