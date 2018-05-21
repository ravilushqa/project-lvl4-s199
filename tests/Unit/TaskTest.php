<?php

namespace Tests\Unit;

use App\Task;
use App\TaskStatus;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    protected $task;

    public function setUp()
    {
        parent::setUp();

        $this->signIn();

        $this->task = create(Task::class);
    }

    public function testTaskHasCreator()
    {
        $this->assertInstanceOf(User::class, $this->task->creator);
    }

    public function testTaskHasAssignedTo()
    {
        $this->assertInstanceOf(User::class, $this->task->assignedTo);
    }

    public function testTaskHasNotAssignedTo()
    {
        $this->task->update([
            'assigned_id' => null
        ]);
        $this->assertNull($this->task->assignedTo);
    }

    public function testTaskHasStatus()
    {
        $this->assertInstanceOf(TaskStatus::class, $this->task->status);
    }

    public function testTaskHasTags()
    {
        $this->assertInstanceOf(Collection::class, $this->task->tags);
    }
}
