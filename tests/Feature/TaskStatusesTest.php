<?php

namespace Tests\Feature;

use App\TaskStatus;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskStatusesTest extends TestCase
{
    use RefreshDatabase;

    protected $taskStatus;

    protected function setUp()
    {
        parent::setUp();

        $this->taskStatus = create(TaskStatus::class);
    }

    public function testIndexTaskStatus()
    {
        $this->get(route('task-statuses.index'))
            ->assertSee($this->taskStatus->name);
    }

    public function testShowTaskStatus()
    {
        $this->get(route('task-statuses.show', $this->taskStatus->getKey()))
            ->assertSee($this->taskStatus->name);
    }

    public function testStoreTaskStatus()
    {
        $this->signIn();

        $taskStatus = make(TaskStatus::class);

        $expected = [
            'name' => $taskStatus->name
        ];

        $this->assertDatabaseMissing('task_statuses', $expected);

        $this->post(route('task-statuses.store'), $taskStatus->toArray());

        $this->assertDatabaseHas('task_statuses', $expected);

    }

    public function testUpdateTaskStatus()
    {
        $this->signIn();

        $expected = [
            'name' => 'in testing'
        ];

        $this->assertDatabaseMissing('task_statuses', $expected);

        $this->json('PUT', route('task-statuses.update', $this->taskStatus->getKey()), $expected);

        $this->assertDatabaseHas('task_statuses', $expected);

    }

    public function testDeleteTaskStatus()
    {
        $this->signIn();

        $taskStatus = create(TaskStatus::class);

        $this->assertDatabaseHas('task_statuses', ['id' => $taskStatus->getKey()]);

        $this->json('DELETE', route('task-statuses.destroy', $taskStatus->getKey()));

        $this->assertDatabaseMissing('task_statuses', ['id' => $taskStatus->getKey()]);
    }
}
