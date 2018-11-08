<?php

namespace Alas\Commands;

use Alas\EmployeesQueue;

class ListCommand implements CommandInterface
{
    private $queue;

    public function __construct(EmployeesQueue $employeesQueue)
    {
        $this->queue = $employeesQueue;
    }

    public function execute()
    {
        $user = $this->queue->current()? $this->queue->current()->order : -1;
        $list = $this->queue->getAllByPivot($user, count($this->queue->getAll()));
        return $list->sortBy('orderNew')->pluck('name')->toArray();
    }
}