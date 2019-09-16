<?php

namespace Tests\Feature\Tasks;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_update_a_task(): void
    {
        $task = factory(Task::class)->create();
        $data = [
            'name' => 'Task updated',
        ];
        $this->patchJson(route('tasks.update', ['id' => $task->id]), $data)
            ->assertStatus(401);
        $this->assertDatabaseMissing('tasks', $data);
    }

    /** @test */
    public function user_cannot_update_an_unexist_task(): void
    {
        $data = [
            'name' => 'Task updated',
        ];
        $this->actingAs(factory(User::class)->create())
            ->patch(route('tasks.update', ['id' => 9999]), $data)
            ->assertStatus(404);
        $this->assertDatabaseMissing('tasks', $data);
    }

    /** @test */
    public function user_can_update_a_task(): void
    {
        $task = factory(Task::class)->create();
        $data = [
            'name' => 'Task updated',
        ];
        $this->actingAs(factory(User::class)->create())
            ->patch(route('tasks.update', ['id' => $task->id]), $data)
            ->assertOK();
        $this->assertDatabaseMissing('tasks', ['name' => $task->name]);
        $this->assertDatabaseHas('tasks', $data);
    }

    /** @test */
    public function task_name_is_required(): void
    {
        $task = factory(Task::class)->create();
        $data = [
            'name' => null,
        ];
        $this->actingAs(factory(User::class)->create())
            ->patch(route('tasks.update', ['id' => $task->id]), $data)
            ->assertSessionHasErrors(['name']);
        $this->assertDatabaseHas('tasks', ['name' => $task->name]);
    }
}
