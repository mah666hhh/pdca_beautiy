<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
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

    public function testHowTo()
    {
        $res = $this->get('/howto');
        $res->assertStatus(200);
    }

    public function testSuccessCreateUser()
    {
        $user = factory(\App\User::class)->make()->first();
        $param = [
            'name' => 'barbar',
            'email' => 'fuga1@test.com',
            'password' => 'hogefuga',
            'goal' => 'ok'
        ];
        $res = $this->withSession(['ses_email' => $user->email])
                    ->post('/user', $param);
        $res->assertStatus(201);
    }

    public function testDisplayUsersEditPage()
    {
        $user = factory(\App\User::class, 1)->create()->first();
        $res = $this->get("/user/{$user->id}/edit");
        $res->assertStatus(302);
    }

    public function testSuccessUpdateUser()
    {
        $user = factory(\App\User::class, 1)->create()->first();
        $param = [
            'name' => '更新しました',
            'email' => 'fuga999@test.com',
            'password' => 'hogefuga',
            'goal' => 'okokok'
        ];
        $res = $this->patch("/user/{$user->id}", $param);
        $res->assertStatus(302);
    }

    public function testFailedCreateUser()
    {
        $param = [
            'name' => null,
            'email' => null,
            'password' => null,
            'goal' => null
        ];
        $res = $this->post('/user', $param);
        $res->assertStatus(302);
    }

    public function testFailedUpdateUser()
    {
        $user = factory(\App\User::class, 1)->create()->first();
        $param = [
            'name' => '更新しました',
            'email' => 'fuga999@test.com',
            'password' => 'hogefuga',
            'goal' => 'okokok'
        ];
        $res = $this->patch("/user/{$user->id}", $param);
        $res->assertStatus(302);
    }
}
