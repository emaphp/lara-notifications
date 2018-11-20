<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use BD;
use Carbon\Carbon;
use App\BreakfastLog;
use App\User;

class BreakfastHistorialCrontroller extends Controller
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

    public function getBreakfastHistorial()
    {
        $date = new Carbon();
        $id_employees = BreakfastLog::orderBy('created_at','desc')->limit(6)->get();

        $employees=[];

        if($id_employees){
            $list = User::join('breakfast_logs','users.id','=','user_id')->whereIn('users.id', $id_employees->pluck('user_id'))->get();
            $employees = $list->map(function($item, $key) use ($date) {
                $fecha = $date->setISODate($item->year, $item->week)->toDateString();
                return ['id'=>$item->id, 'name' => $item->name, 'date' => $fecha];
            });
            $employees->toArray();
        }

        return response()->json([
            'employeesHistorialList' => $employees
        ]);
    }
    
}
