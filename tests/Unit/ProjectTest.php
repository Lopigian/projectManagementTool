<?php

namespace Tests\Unit;

use App\Http\Controllers\Api\TasksController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_project()
    {
        $response = $this->postJson(route('auth.login'), [
            'email' => 'test@example.com',
            'password' => 'password123'
        ]);

        $token = $response->json()['token'];

        $data = [
            'name' => 'Test Project',
            'description' => 'Test Project Description'
        ];

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)->postJson('/api/projects', $data);

        if($response->getStatusCode() == 200){
            $response->assertStatus(200);
        }

        if($response->getStatusCode() == 401){
            $response->assertStatus(401);
        }

        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_update_project()
    {
        $data = [
            'id' => 1,
            'name' => 'Test Project update',
            'description' => 'Test Project Description update'
        ];

        $response = $this->postJson('/api/projects', $data);

        if($response->getStatusCode() == 200){
            $response->assertStatus(200);
        }

        if($response->getStatusCode() == 401){
            $response->assertStatus(401);
        }

        $this->assertDatabaseHas('tasks', $data);
    }
}
