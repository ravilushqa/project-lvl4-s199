<?php

namespace Tests\Feature;

use App\Task;
use App\TaskStatus;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    use RefreshDatabase;

    protected $task;

    protected function setUp()
    {
        parent::setUp();

        $this->signIn();

        $this->task = create(Task::class);
    }

    public function testIndexTask()
    {
        $this->get(route('tasks.index'))
            ->assertSee($this->task->name);
    }

    public function testShowTask()
    {
        $this->get(route('tasks.show', $this->task->getKey()))
            ->assertSee($this->task->name);
    }

    public function testStoreTask()
    {
        $this->signIn();

        $task = make(Task::class);

        $expected = $task->toArray();

        $this->assertDatabaseMissing('tasks', $expected);

        $this->post(route('tasks.store'), $task->toArray());

        $this->assertDatabaseHas('tasks', $expected);
    }

    public function testUpdateTask()
    {
        $this->signIn();

        $expected = [
            'name' => 'in testing'
        ];

        $this->assertDatabaseMissing('tasks', $expected);

        $this->json('PUT', route('tasks.update', $this->task->getKey()), $expected);

        $this->assertDatabaseHas('tasks', $expected);
    }

    public function testDeleteTask()
    {
        $this->signIn();

        $task = create(Task::class);

        $this->assertDatabaseHas('tasks', ['id' => $task->getKey()]);

        $this->json('DELETE', route('tasks.destroy', $task->getKey()));

        $this->assertDatabaseMissing('tasks', ['id' => $task->getKey()]);
    }
}
