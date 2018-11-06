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
        if ($lastCreated!==null) {
            $currentEmployee = $lastCreated->user()->first();
        }
        return $currentEmployee;
    }

    public function next($user_id = null)
    {
        if (is_null($user_id)) {
            $currentEmployee = $this->current();
            if (is_null($currentEmployee)) {
                $nextEmployee = null;
            }
            else {
                $nextEmployee = $this->nextUser($currentEmployee);
            }
        }
        else {
            $user = $this->queue->find($user_id);
            $nextEmployee = $this->nextUser($user);
        }
        return $nextEmployee;
    }

    private function nextUser($user)
    {
        $orderCurrent = $user->order;
        $quantityEmployees = $this->queue->count();
        $newOrder = ($orderCurrent % $quantityEmployees) + 1;
        $nextEmployee = $this->queue->where("order",$newOrder)->first();
        if (is_null($nextEmployee)) {
            $nextEmployee = $this->first();
        }
        return $nextEmployee;
    }

    public function prev($user_id = null)
    {
        if (is_null($user_id)) {
            $currentEmployee = $this->current();
            if (is_null($currentEmployee)) {
                $prevEmployee = null;
            }
            else {
                $prevEmployee = $this->prevUser($currentEmployee);
            }
        }
        else {
            $user = $this->queue->find($user_id);
            $prevEmployee = $this->prevUser($user);
        }
        return $prevEmployee;
    }

    private function prevUser($user)
    {
        $orderCurrent = $user->order;
        $quantityEmployees = $this->queue->count();
        if ($orderCurrent-1 == 0) {
            $newOrder = $quantityEmployees;
        }
        else {
            $newOrder = $orderCurrent-1;
        }
        $prevEmployee = $this->queue->where("order",$newOrder)->first();
        if (is_null($prevEmployee)) {
            $prevEmployee = $this->last();
        }
        return $prevEmployee;
    }

    public function insertBefore($user, $beforeUser)
    {
        if (is_null($user->order) && $this->queue->contains($beforeUser)) {
            $orderBeforeUser = $beforeUser->order;

            $user->order = $orderBeforeUser;

            $userUpdate = User::find($user->id);
            $userUpdate->order = $user->order;
            $userUpdate->save();

            $newQueue = $this->queue->map(function ($employee) use ($orderBeforeUser) {
                if ($employee->order >= $orderBeforeUser) {
                    $employee->order += 1;

                    $userUpdate = User::find($employee->id);
                    $userUpdate->order = $employee->order;
                    $userUpdate->save();
                }
                return $employee;
            });

            $newQueue->push($user);

            $this->queue = $newQueue->sortBy("order");

            return $user->id;
        }
        else {
            return false;
        }

    }

}