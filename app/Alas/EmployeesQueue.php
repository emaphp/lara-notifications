<?php

namespace Alas\EmployeesQueue;

use App\User;
use App\BreakfastLog;

class EmployeesQueue
{

    protected $queue;
    protected $currentEmployee;

    public function __construct()
    {
        $this->queue = User::where("type","employee")->whereNotNull('order')->orderBy('order')->get();
        $this->currentEmployee = null;
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
        $lastCreated = BreakfastLog::whereNotNull('user_id')->orderBy('created_at')->first();
        if($lastCreated->isNotEmpty())
        {
            $this->currentEmployee = $lastCreated->user();
        }
        return $this->currentEmployee;
    }

    public function next($user_id = null)
    {
        if($user_id === null)
        {
            if($this->currentEmployee === null)
            {
                $nextEmployee = $this->first();
            }
            else
            {
                $orderCurrent = $this->currentEmployee->order;
                $nextEmployee = $this->queue->where("order",$orderCurrent+1)->first();
                if($nextEmployee == null)
                {
                    $nextEmployee = $this->first();
                }
            }
        }
        else
        {
            $user = $this->queue->find($user_id);
            $orderCurrent = $user->order;
            $nextEmployee = $this->queue->where("order",$orderCurrent+1)->first();
            if($nextEmployee == null)
            {
                $nextEmployee = $this->first();
            }
        }
        return $nextEmployee;
    }

    public function prev($user_id = null)
    {
        if($user_id === null)
        {
            if($this->currentEmployee === null)
            {
                $prevEmployee = $this->last();
            }
            else
            {
                $orderCurrent = $this->currentEmployee->order;
                $prevEmployee = $this->queue->where("order",$orderCurrent-1)->first();
                if($prevEmployee == null)
                {
                    $prevEmployee = $this->last();
                }
            }
        }
        else
        {
            $user = $this->queue->find($user_id);
            $orderCurrent = $user->order;
            $prevEmployee = $this->queue->where("order",$orderCurrent-1)->first();
            if($prevEmployee == null)
            {
                $prevEmployee = $this->last();
            }
        }
        return $prevEmployee;
    }

}