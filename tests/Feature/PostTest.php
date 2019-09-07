<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testDisplayPosts()
    {
        $res = $this->get('/post');
        $res->assertStatus(200);
    }

    public function testSuccessCreatePost()
    {
        $post = factory(\App\Post::class)->make()->first();
        $res = $this->post('/post');
        $res->assertStatus(201);
    }

    public function testFailedCreatePost()
    {
        $post = factory(\App\Post::class)->make()->first();
        $res = $this->post('/post');
        $res->assertStatus(422);
    }

    public function testDisplayEditPage()
    {
        $post = factory(\App\Post::class)->create()->first();
        $res = $this->get("post/{$post->id}/edit");
        $res->assertStatus(200);
    }

    public function testSuccessUpdatePost()
    {
        $post = factory(\App\Post::class)->create()->first();
        $res = $this->patch("/post/{$post->id}", [ $post->plan => '更新しました。'] );
        $res->assertStatus(200);
    }

    public function testFailedUpdatePost()
    {
        $post = factory(\App\Post::class)->create()->first();
        $res = $this->patch("/post/{$post->id}", [ $post->plan => null ] );
        $res->assertStatus(422);
    }
}
