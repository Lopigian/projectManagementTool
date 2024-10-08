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
        $response = $this->postJson('/api/auth/login', [
            'email' => 'your_email',
            'password' => 'your_password'
        ]);
        $token = $response->json()['token'];

        $data = [
            'name' => 'Test Task',
            'description' => 'Test Task Description',
            'project_id' => 1,
            'status' => 0
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->postJson('/api/tasks', $data);

        if($response->getStatusCode() == 200){
            $response->assertStatus(200);
        }

        if($response->getStatusCode() == 401){
            $response->assertStatus(401);
        }

        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_update_task()
    {
        $data = [
            'id' => 1,
            'name' => 'Test Task update',
            'description' => 'Test Task Description update',
            'project_id' => 1,
            'status' => 1
        ];

        $response = $this->postJson('/api/tasks', $data);

        if($response->getStatusCode() == 200){
            $response->assertStatus(200);
        }

        if($response->getStatusCode() == 401){
            $response->assertStatus(401);
        }

        $this->assertDatabaseHas('tasks', $data);
    }
}
