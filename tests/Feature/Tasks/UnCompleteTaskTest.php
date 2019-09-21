<?php

namespace Tests\Feature\Tasks;

use App\Events\Tasks\TaskUnCompleted;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UnCompleteTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_uncomplete_a_task(): void
    {
        $task = factory(Task::class)->create();
        $this->patchJson(route('tasks.uncomplete', ['id' => $task->id]))
            ->assertStatus(401);
    }

    /** @test */
    public function user_cannot_uncomplete_an_unexist_task(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->patch(route('tasks.uncomplete', ['id' => 9999]))
            ->assertStatus(404);
    }

    /** @test */
    public function user_can_uncomplete_a_task(): void
    {
        Event::fake();
        $task = factory(Task::class)->create(['status' => true]);
        $this->actingAs(factory(User::class)->create())
            ->patch(route('tasks.uncomplete', ['id' => $task->id]))
            ->assertOK();
        $this->assertDatabaseMissing('tasks', [
            'id'     => $task->id,
            'status' => true,
        ]);
        $this->assertDatabaseHas('tasks', [
            'id'     => $task->id,
            'status' => false,
        ]);
        Event::assertDispatched(TaskUnCompleted::class, function ($e) {
            $this->assertInstanceOf(Task::class, $e->task);
            return true;
        });
    }
}
