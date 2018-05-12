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

        $response = $this->post(route('task-statuses.store'), $taskStatus->toArray());
        $this->get($response->headers->get('Location'))
            ->assertSee($taskStatus->name);
    }

    public function testUpdateTaskStatus()
    {
        $this->signIn();

        $expected = 'in testing';

        $this->assertNotEquals($expected, $this->taskStatus->name);

        $response = $this->json('PUT', route('task-statuses.update', $this->taskStatus->getKey()), [
            'name' => $expected
        ]);

        $this->get($response->headers->get('Location'))
            ->assertSee($expected);
    }
}
