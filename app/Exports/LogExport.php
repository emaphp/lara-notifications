<?php

namespace App\Exports;

use App\BreakfastLog;
use App\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class LogExport implements FromCollection, WithCustomCsvSettings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $date = new Carbon();
        $id_employees = BreakfastLog::orderBy('created_at','desc')->get();

        $employees=[];

        if($id_employees){
            $employees = $id_employees->map(function($item, $key) use ($date) {
                $fecha = $date->setISODate($item->year, $item->week)->toDateString();
                if(!is_null($item->user_id)){
                    $delegate =  BreakfastLog::join('users','users.id','=','user_id')->where('user_id','=',$item->user_id)->first();
                    return ['date' => $fecha, 'week' => $item->week, 'year'=> $item->year, 'name' => $delegate->name, ];
                }
                else{
                    return ['date' => $fecha, 'week' => $item->week, 'year'=> $item->year, 'name' => 'a–b', ];
                }
            });
        }

        return $employees;
    }

    public function getCsvSettings():array
    {
        return[
            'use_bom' => TRUE
        ];
    }
}
