<?php

namespace Tests\Feature\Tasks;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompleteTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_complete_a_task(): void
    {
        $task = factory(Task::class)->create();
        $this->patchJson(route('tasks.complete', ['id' => $task->id]))
            ->assertStatus(401);
    }

    /** @test */
    public function user_cannot_complete_an_unexist_task(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->patch(route('tasks.complete', ['id' => 9999]))
            ->assertStatus(404);
    }

    /** @test */
    public function user_can_complete_a_task(): void
    {
        $task = factory(Task::class)->create(['status' => false]);
        $this->actingAs(factory(User::class)->create())
            ->patch(route('tasks.complete', ['id' => $task->id]))
            ->assertOK();
        $this->assertDatabaseMissing('tasks', [
            'id'     => $task->id,
            'status' => false,
        ]);
        $this->assertDatabaseHas('tasks', [
            'id'     => $task->id,
            'status' => true,
        ]);
    }
}
