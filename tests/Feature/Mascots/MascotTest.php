<?php

namespace Tests\Feature\Mascots;

use App\Mascot;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MascotTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_get_mascot(): void
    {
        $mascot = factory(Mascot::class)->create();
        $this->getJson(route('mascots.show', ['id' => $mascot->id]))
            ->assertStatus(401);
    }

    /** @test */
    public function user_cannot_get_an_unexist_mascot(): void
    {
        $this->actingAs(factory(User::class)->create())
            ->get(route('mascots.show', ['id' => 9999]))
            ->assertStatus(404);
    }

    /** @test */
    public function user_can_get_mascot(): void
    {
        $mascot = factory(Mascot::class)->create();
        $this->actingAs(factory(User::class)->create())
            ->get(route('mascots.show', ['id' => $mascot->id]))
            ->tap(function ($response) use ($mascot) {
                $response->assertOK();
                $this->assertEquals($mascot->level, $response->decodeResponseJson()['data']['level']);
                $this->assertEquals($mascot->exp, $response->decodeResponseJson()['data']['exp']);
            });
    }

    /** @test */
    public function guest_cannot_update_mascot(): void
    {
        $mascot = factory(Mascot::class)->create(['exp' => 9]);
        $data   = [
            'exp' => 10,
        ];
        $this->patchJson(route('mascots.update', ['id' => $mascot->id]), $data)
            ->assertStatus(401);
        $this->assertDatabaseHas('mascots', [
            'id'  => $mascot->id,
            'exp' => $mascot->exp,
        ]);
        $this->assertDatabaseMissing('mascots', [
            'id'  => $mascot->id,
            'exp' => 10,
        ]);
    }

    /** @test */
    public function user_cannot_update_an_unexits_mascot(): void
    {
        $mascot = factory(Mascot::class)->create(['exp' => 9]);
        $data   = [
            'exp' => 10,
        ];
        $this->actingAs(factory(User::class)->create())
            ->patch(route('mascots.update', ['id' => 9999]), $data)
            ->assertStatus(404);
        $this->assertDatabaseHas('mascots', [
            'id'  => $mascot->id,
            'exp' => $mascot->exp,
        ]);
    }

    /** @test */
    public function user_update_a_mascot(): void
    {
        $mascot = factory(Mascot::class)->create(['exp' => 9]);
        $data   = [
            'exp' => 10,
        ];
        $this->actingAs(factory(User::class)->create())
            ->patch(route('mascots.update', ['id' => $mascot->id]), $data)
            ->tap(function ($response) {
                $response->assertOK();
            });
        $this->assertDatabaseHas('mascots', [
            'id'  => $mascot->id,
            'exp' => 10,
        ]);
        $this->assertDatabaseMissing('mascots', [
            'id'  => $mascot->id,
            'exp' => $mascot->exp,
        ]);
    }


}
