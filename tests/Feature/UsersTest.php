<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
//        $this->disableExceptionHandling();
    }

    public function testUserCanSeeUsersList()
    {
        $user = create(User::class);
        $this->signIn($user);

        $this->get(route('users.index'))
            ->assertSee($user->name);
    }

    public function testUserCanUpdateSelf()
    {
        $user = create(User::class, ['name' => 'testName']);
        $this->signIn($user);

        $this->json('PUT', route('users.update', ['user' => $user->getKey()]), [
            'name'  => 'changedName',
            'email' => 'test@example.com'
        ]);

        $this->assertEquals('changedName', User::find($user->getKey())->name);
    }


    public function testUserCanNotUpdateOthers()
    {
        $authUser = create(User::class);
        $otherUser = create(User::class);

        $this->signIn($authUser);

        $response = $this->json('PUT', route('users.update', ['user' => $otherUser->getKey()]), [
            'name'  => 'changedName',
            'email' => 'test@example.com'
        ]);

        $this->assertEquals('403', $response->getStatusCode());
    }
}
