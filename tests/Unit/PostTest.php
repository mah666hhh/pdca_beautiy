<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \App\User;
use \App\Post;

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

    /**
     * @expectedException PDOException
     * @expectedExceptionMessage Integrity constraint violation
     */
    public function testPostUserIdNotExists()
    {
        $post = factory(\App\Post::class, 1)->make()->first();
        $post->user_id = null;

        // factoryでpostからuserを作成する場合
        // factory(\App\User::class, 1)->create()->first()
        // ->factory(\App\Post::class, 1);

        $this->expectException($post->save());
    }

    public function testDeleteAtSameTime()
    {
        $user = factory(\App\User::class, 1)->create()->first();
        $userId = $user->id;

        $post = factory(\App\Post::class, 1)->make()->first();
        $postId = $post->id;
        $post->user_id = $userId;
        $post->save();

        User::destroy($userId);
        $userCount = User::where('id', $userId)->count();
        $postCount = Post::where('id', $postId)->count();

        $this->assertSame(0, $userCount);
        $this->assertSame(0, $postCount);
    }

    /**
     * @expectedException PDOException
     * @expectedExceptionMessage Invalid datetime format
     */
    public function testInvalidPostDay()
    {
        $post = factory(\App\Post::class, 1)->make()->first();
        $post->post_day = 'post_day';
        $this->expectException($post->save());
    }

    /**
     * @expectedException PDOException
     * @expectedExceptionMessage Invalid datetime format
     */
    public function testInvalidWakeUpTime()
    {
        $post = factory(\App\Post::class, 1)->make()->first();
        $post->wakeup_time = '99:99';
        $this->expectException($post->save());
    }

    /**
     * @expectedException PDOException
     * @expectedExceptionMessage Invalid datetime format
     */
    public function testInvalidBedTime()
    {
        $post = factory(\App\Post::class, 1)->make()->first();
        $post->bed_time = '99:99';
        $this->expectException($post->save());
    }
}
