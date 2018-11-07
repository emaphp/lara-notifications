<?php

namespace Tests\Unit;

use Alas\EmployeesQueue\EmployeesQueue;
use Tests\TestCase;
use App\User;

class EmployeeQueueTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAll()
    {
        $queue = new EmployeesQueue();
        $allQueue = $queue->getAll();
        $this->assertCount(3, $allQueue);
    }

    public function testCurrent()
    {
        $queue = new EmployeesQueue();
        $current = $queue->current();
        $this->assertNull($current);
    }

    public function testNextCurrent()
    {
        $queue = new EmployeesQueue();
        $nextCurrent = $queue->next();
        $this->assertNull($nextCurrent);
    }

    public function testNextUser()
    {
        $queue = new EmployeesQueue();
        $user = User::find(5);
        $nextUser = $queue->next(4);
        $this->assertEquals($user, $nextUser);
    }

    public function testPrevCurrent()
    {
        $queue = new EmployeesQueue();
        $prevCurrent = $queue->prev();
        $this->assertNull($prevCurrent);
    }

    public function testPrevUser()
    {
        $queue = new EmployeesQueue();
        $user = User::find(3);
        $prevUser = $queue->prev(4);
        $this->assertEquals($user, $prevUser);
    }

    public function testPostponeBreakfast()
    {
        $queue = new EmployeesQueue();
        $queue->postponeBreakfast();
        $user = $queue->current();
        $this->assertNull($user);
    }

}
