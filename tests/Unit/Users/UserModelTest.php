<?php

namespace Tests\Unit\Users;

use App\Mascot;
use App\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function mascot_relationship(): void
    {
        $user = factory(User::class)->create();
        factory(Mascot::class)->create(['user_id' => $user->id]);

        $this->assertInstanceOf(HasOne::class, $user->mascot());
    }
}
