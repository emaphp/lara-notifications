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
        $user = User::find(3);
        $current = $queue->current();
        $this->assertEquals($user,$current);
    }

    public function testNextCurrent()
    {
        $queue = new EmployeesQueue();
        $user = User::find(4);
        $nextCurrent = $queue->next();
        $this->assertEquals($user,$nextCurrent);
    }

    public function testNextUser()
    {
        $queue = new EmployeesQueue();
        $user = User::find(5);
        $nextUser = $queue->next(4);
        $this->assertEquals($user, $nextUser);
    }

    public function testNextLastUser()
    {
        $queue = new EmployeesQueue();
        $user = User::find(3);
        $nextUser = $queue->next(5);
        $this->assertEquals($user, $nextUser);
    }

    public function testPrevCurrent()
    {
        $queue = new EmployeesQueue();
        $user = User::find(5);
        $prevCurrent = $queue->prev();
        $this->assertEquals($user, $prevCurrent);
    }

    public function testPrevUser()
    {
        $queue = new EmployeesQueue();
        $user = User::find(3);
        $prevUser = $queue->prev(4);
        $this->assertEquals($user, $prevUser);
    }

    public function testPrevFirstUser()
    {
        $queue = new EmployeesQueue();
        $user = User::find(5);
        $prevUser = $queue->prev(3);
        $this->assertEquals($user, $prevUser);
    }

    public function testInsertBefore()
    {
        $queue = new EmployeesQueue();
        $user = User::find(2);
        $beforeUser = User::find(4);
        $this->assertEquals(2, $queue->insertBefore($user, $beforeUser));
    }

    public function testPostponeBreakfast()
    {
        $queue = new EmployeesQueue();
        $queue->postponeBreakfast();
        $user = $queue->current();
        $this->assertNull($user);
    }

}
