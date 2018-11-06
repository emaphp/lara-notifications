<?php

namespace Alas\EmployeesQueue;

use App\User;
use App\BreakfastLog;

class EmployeesQueue
{

    protected $queue;

    public function __construct()
    {
        $this->queue = User::where("type","employee")->whereNotNull('order')->orderBy('order')->get();
    }

    public function getAll()
    {
        return $this->queue;
    }

    public function first()
    {
        return $this->queue->first();
    }

    public function last()
    {
        return $this->queue->last();
    }

    public function current()
    {
        $currentEmployee = null;
        $lastCreated = BreakfastLog::whereNotNull('user_id')->orderBy('created_at','desc')->first();
        if($lastCreated!==null)
        {
            $currentEmployee = $lastCreated->user()->first();
        }
        return $currentEmployee;
    }

    public function next($user_id = null)
    {
        if(is_null($user_id))
        {
            $currentEmployee = $this->current();
            if(is_null($currentEmployee))
            {
                $nextEmployee = null;
            }
            else
            {
                $orderCurrent = $currentEmployee->order;
                $quantityEmployees = $this->queue->count();
                $newOrder = ($orderCurrent % $quantityEmployees) + 1;
                $nextEmployee = $this->queue->where("order",$newOrder)->first();
                if(is_null($nextEmployee))
                {
                    $nextEmployee = $this->first();
                }
            }
        }
        else
        {
            $user = $this->queue->find($user_id);
            $orderCurrent = $user->order;
            $quantityEmployees = $this->queue->count();
            $newOrder = ($orderCurrent % $quantityEmployees) + 1;
            $nextEmployee = $this->queue->where("order",$newOrder)->first();
            if(is_null($nextEmployee))
            {
                $nextEmployee = $this->first();
            }
        }
        return $nextEmployee;
    }

    public function prev($user_id = null)
    {
        if(is_null($user_id))
        {
            $currentEmployee = $this->current();
            if(is_null($currentEmployee))
            {
                $prevEmployee = null;
            }
            else
            {
                $orderCurrent = $currentEmployee->order;
                $quantityEmployees = $this->queue->count();
                if($orderCurrent-1 == 0)
                    $newOrder = $quantityEmployees;
                else
                    $newOrder = $orderCurrent-1;
                $prevEmployee = $this->queue->where("order",$newOrder)->first();
                if(is_null($prevEmployee))
                {
                    $prevEmployee = $this->last();
                }
            }
        }
        else
        {
            $user = $this->queue->find($user_id);
            $orderCurrent = $user->order;
            $quantityEmployees = $this->queue->count();
            if($orderCurrent-1 == 0)
                $newOrder = $quantityEmployees;
            else
                $newOrder = $orderCurrent-1;
            $prevEmployee = $this->queue->where("order",$newOrder)->first();
            if(is_null($prevEmployee))
            {
                $prevEmployee = $this->last();
            }
        }
        return $prevEmployee;
    }

}