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
        $list = $this->queue->getAllByPivot($this->queue->current()->id, count($this->queue->getAll()));
        return $list->sortBy('orderNew');
    }
}