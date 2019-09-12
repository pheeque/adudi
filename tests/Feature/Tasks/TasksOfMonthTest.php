<?php

namespace Tests\Feature\Tasks;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TasksOfMonthTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_get_tasks_of_month(): void
    {
        $this->getJson(route('tasks-of-month', ['month' => 9]))
            ->assertStatus(401);
    }

    /** @test */
    public function user_can_get_tasks_of_month(): void
    {
        factory(Task::class, 10)->create(['due_date' => now()]);
        $response = $this->actingAs(factory(User::class)->create())
            ->get(route('tasks-of-month', ['month' => 9]))
            ->assertOK();
        $response->assertJsonCount(10, 'data');
    }
}
