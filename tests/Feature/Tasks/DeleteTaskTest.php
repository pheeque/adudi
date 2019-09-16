<?php

namespace Tests\Feature\Tasks;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_delete_a_task(): void
    {
        $task = factory(Task::class)->create();
        $this->deleteJson(route('tasks.destroy', ['id' => $task->id]))
            ->assertStatus(401);
        $this->assertDatabaseHas('tasks', ['id' => $task->id]);
    }

    /** @test */
    public function user_cannot_delete_an_unexits_task(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->delete(route('tasks.destroy', ['id' => 9999]))
            ->assertStatus(404);
    }

    /** @test */
    public function user_can_delete_a_task(): void
    {
        $task = factory(Task::class)->create();
        $this->actingAs(factory(User::class)->create())
            ->delete(route('tasks.destroy', ['id' => $task->id]))
            ->assertOK();
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
