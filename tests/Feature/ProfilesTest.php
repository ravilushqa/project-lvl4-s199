<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfilesTest extends TestCase
{
    use RefreshDatabase;

    public function testUserHasProfile()
    {
        $user = create(User::class);
        $this->get(route('profile', ['user' => $user->getKey()]))
            ->assertSee(e($user->name));
    }
}
