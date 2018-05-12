<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected $startName = 'testName';

    protected function setUp()
    {
        parent::setUp();

        $this->user = create(User::class, ['name' => $this->startName]);

        $this->signIn($this->getUser());
    }

    public function testUserCanSeeUsersList()
    {
        $this->get(route('users.index'))
            ->assertSee($this->getUser()->name);
    }

    public function testUserCanUpdateSelf()
    {
        $expected = 'changedName';

        $this->assertNotEquals($expected, $this->getUser()->name);

        $this->updateRequest($this->getUser(), $expected);

        $this->assertEquals($expected, $this->getUser()->name);
    }


    public function testUserCanNotUpdateOthers()
    {
        $otherUser = create(User::class);

        $response = $this->updateRequest($otherUser);

        $this->assertEquals('403', $response->getStatusCode());
    }

    public function testUserHasProfile()
    {
        $user = create(User::class);
        $this->get(route('users.show', $user->getKey()))
            ->assertSee(e($user->name));
    }

    /**
     * Get fresh instance of user
     *
     * @return User
     */
    protected function getUser() : User
    {
        return User::find($this->user->getKey());
    }

    protected function updateRequest(User $user, $expectedName = 'testName', $expectedEmail = 'test@email.test')
    {
        return $this->json('PUT', route('users.update', $user->getKey()), [
            'name'  => $expectedName,
            'email' => $expectedEmail
        ]);
    }
}
