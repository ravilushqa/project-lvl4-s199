<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanSeeUsersList()
    {
        $user = create(User::class);
        $this->signIn($user);

        $this->get(route('users.index'))
            ->assertSee($user->name);
    }

    public function testUserCanUpdateSelf()
    {
        $expected = 'changedName';

        $user = create(User::class, ['name' => 'testName']);
        $this->signIn($user);

        $this->json('PUT', route('users.update', $user->getKey()), [
            'name'  => $expected,
            'email' => 'test@example.com'
        ]);

        $this->assertEquals($expected, User::find($user->getKey())->name);
    }


    public function testUserCanNotUpdateOthers()
    {
        $authUser = create(User::class);
        $otherUser = create(User::class);

        $this->signIn($authUser);

        $response = $this->json('PUT', route('users.update', $otherUser->getKey()), [
            'name'  => 'changedName',
            'email' => 'test@example.com'
        ]);

        $this->assertEquals('403', $response->getStatusCode());
    }

    public function testUserHasProfile()
    {
        $user = create(User::class);
        $this->get(route('users.show', $user->getKey()))
            ->assertSee(e($user->name));
    }
}
