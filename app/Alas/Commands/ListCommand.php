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
        $order = 1;
        if ($this->queue->currentBreakfastLog()->user) {
            $order = $this->queue->currentBreakfastLog()->order;
        } elseif ($this->queue->current()) {
            $order = $this->queue->current()->order + 1;
        }

        $list = $this->queue->getAllByPivot($order, count($this->queue->getAll()));
        return $list->sortBy('orderNew')->pluck('name')->toArray();
    }
}