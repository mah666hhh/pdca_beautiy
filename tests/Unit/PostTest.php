<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testValidPost()
    {
        $post = factory(\App\Post::class, 1)->make()->first();
        $result = $post->save();
        $this->assertTrue($result);
        $this->assertNotEmpty($post);
    }

    /**
     * @expectedException PDOException
     * @expectedExceptionMessage String data, right truncated
     */

    public function testTooLongValue()
    {
        $post = factory(\App\Post::class, 1)->make()->first();
        $post->plan = str_repeat('a', 501);
        $this->expectException($post->save());

        $post->do = str_repeat('b', 501);
        $this->expectException($post->save());

        $post->check = str_repeat('c', 1001);
        $this->expectException($post->save());

        $post->action = str_repeat('a', 501);
        $this->expectException($post->save());
    }

    public function testPostUserNotExists()
    {

    }

    public function testInvalidPostDay()
    {

    }

    public function testInvalidTime()
    {

    }
}
