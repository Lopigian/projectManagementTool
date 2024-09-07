<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\TasksController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_task()
    {
        $data = [
            'name' => 'Test Task',
            'description' => 'Test Task Description',
            'projectId' => 1,
        ];

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', $data);
    }
}
