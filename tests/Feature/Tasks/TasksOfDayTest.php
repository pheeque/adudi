<?php

namespace Tests\Feature\Tasks;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TasksOfDayTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_get_tasks_of_day(): void
    {
        $this->getJson(route('tasks-of-day', ['day' => 9]))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_tasks_of_day(): void
    {
        factory(Task::class, 10)->create(['due_date' => now()]);
        $response = $this->actingAs(factory(User::class)->create())
            ->get(route('tasks-of-day', ['day' => now()->format('Y-m-d')]))
            ->assertOK();
        $response->assertJsonCount(10, 'data');
    }
}
