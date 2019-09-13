<?php

namespace Tests\Feature\Tasks;

use App\Events\Tasks\TaskCreated;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_create_a_task(): void
    {
        // $this->withoutExceptionHandling();
        $data = factory(Task::class)->make()->toArray();
        $this->postJson(route('tasks.store'), $data)
            ->assertStatus(401);
        $this->assertDatabaseMissing('tasks', $data);
    }

    /** @test */
    public function user_can_create_a_task(): void
    {
        Event::fake();
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        $data = factory(Task::class)->make(['user_id' => $user->id])->toArray();
        $this->actingAs($user)
            ->post(route('tasks.store'), $data)
            ->assertStatus(201);
        $this->assertDatabaseHas('tasks', $data);
        Event::assertDispatched(TaskCreated::class, function ($e) use ($data) {
            $this->assertEquals($e->task->name, $data['name']);
            return true;
        });
    }

    /** @test */
    public function fields_are_required(): void
    {
        $data = [
            'name'     => null,
            'due_date' => null,
            'status'   => null,
        ];
        $response = $this->actingAs(factory(User::class)->create())
            ->post(route('tasks.store'), $data);

        $response->assertSessionHasErrors(['name', 'due_date', 'status']);
        $this->assertDatabaseMissing('tasks', $data);
    }

    /** @test */
    public function due_date_must_be_a_date(): void
    {
        $data = factory(Task::class)->make([
            'due_date' => 'Invalid Date'
        ])->toArray();
        $response = $this->actingAs(factory(User::class)->create())
            ->post(route('tasks.store'), $data);

        $response->assertSessionHasErrors(['due_date']);
        $this->assertDatabaseMissing('tasks', $data);
    }

    /** @test */
    public function status_must_be_a_boolean(): void
    {
        $data = factory(Task::class)->make([
            'status' => 'Invalid Status'
        ])->toArray();
        $response = $this->actingAs(factory(User::class)->create())
            ->post(route('tasks.store'), $data);

        $response->assertSessionHasErrors(['status']);
        $this->assertDatabaseMissing('tasks', $data);
    }
}
