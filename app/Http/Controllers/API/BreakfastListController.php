<?php

namespace App\Http\Controllers\API;

use Alas\EmployeesQueue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\BreakfastLog;

class BreakfastListController extends Controller
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

    public function getBreakfastEmployeeList()
    {
        $queue = $this->employeesQueue;

        $order = 1;
        if ($queue->currentBreakfastLog()->user) {
            $order = $queue->currentBreakfastLog()->order;
        } elseif ($queue->current()) {
            $order = $queue->current()->order + 1;
        }

        $totalEmployees = $queue->getAll()->count();
        $employees = $queue->getAllByPivot($order,$totalEmployees);

        ($employees->first())['postponed'] = $queue->wasPostponed();

        return response()->json([
            'employeesList' => $employees->values()->all()
        ]);

    }
}
