<?php

namespace Tests\Feature;

use App\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class tagesTest extends TestCase
{
    use RefreshDatabase;

    protected $tag;

    protected function setUp()
    {
        parent::setUp();

        $this->tag = create(Tag::class);
    }

    public function testIndexTagStatus()
    {
        $this->get(route('tags.index'))
            ->assertSee($this->tag->name);
    }

    public function testShowTagStatus()
    {
        $this->get(route('tags.show', $this->tag->getKey()))
            ->assertSee($this->tag->name);
    }

    public function testStoreTagStatus()
    {
        $this->signIn();

        $tag = make(Tag::class);

        $expected = [
            'name' => $tag->name
        ];

        $this->assertDatabaseMissing('tags', $expected);

        $this->post(route('tags.store'), $tag->toArray());

        $this->assertDatabaseHas('tags', $expected);
    }

    public function testUpdateTagStatus()
    {
        $this->signIn();

        $expected = [
            'name' => 'in testing'
        ];

        $this->assertDatabaseMissing('tags', $expected);

        $this->json('PUT', route('tags.update', $this->tag->getKey()), $expected);

        $this->assertDatabaseHas('tags', $expected);
    }

    public function testDeleteTagStatus()
    {
        $this->signIn();

        $tag = create(Tag::class);

        $this->assertDatabaseHas('tags', ['id' => $tag->getKey()]);

        $this->json('DELETE', route('tags.destroy', $tag->getKey()));

        $this->assertDatabaseMissing('tags', ['id' => $tag->getKey()]);
    }
}
