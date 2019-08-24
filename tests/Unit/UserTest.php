<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

// 使うクラスを読み込む
use App\User;
use Carbon\Carbon;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    // テストは、test***という命名規則が必要
    // Userを一人作る
    // 次のテスト以降でこのUserを使いまわせる
    // returnで戻り値を返す必要あり
    public function testValidUser()
    {
        // factoryとクラス名を指定
        // 第二引数は生成するオブジェクトの数
        // makeはnewやbuildと同じで永続化しない
        // factoryの戻りがコレクションオブジェクトで配列なのでfirstで取り出すこと!
        $user = factory(\App\User::class, 1)->make()->first();

        // save()の戻り値はbool
        // オブジェクトが保存出来たか否かは、saveの戻り値にassertTrue, assertFalseすれば良い
        $result = $user->save();

        $this->assertTrue($result);
        $this->assertNotEmpty($user);
        return $user;
    }

    // 他のテストの実行結果に依存する場合は @depends testXXXXX とする
    // そのテストの戻り値を利用出来る
    // さらに次以降のテストにも持ち越すことも出来る

    // 例外のテスト
    // @expectedException
    // 引数に渡したエラークラスが発生することをテスト
    // emailがUniqueでない場合に発生するPDOExceptionを指定
    // PDOExceptionとは、DB接続の際に起こる例外
    // それ以外のエラーを指定するとテストが落ちる

    // @expectedExceptionMessage
    // 例外で発生するMessageをテスト
    // 関係ないメッセージを指定するとテストが落ちる

    /**
    * @test
    * @expectedException PDOException
    * @expectedExceptionMessage Integrity constraint violation
    */

    // email重複なら、Userは作成されず例外が発生すること
    public function testEmailisUnique()
    {
        $user = factory(\App\User::class, 1)->create()->first();
        $secondUser = factory(\App\User::class, 1)->make()->first();
        $secondUser->email = $user->email;
        $this->expectException($secondUser->save());
    }

    /**
     * @test
     * @expectedException PDOException
     * @expectedException String data, right truncated
     */

    public function testTooLongEmail()
    {
        $user = factory(\App\User::class, 1)->make()->first();
        $user->email = str_repeat('e', 120) . '@test.com';
        $this->expectException($user->save());
    }

    /**
     * @test
     * @expectedException
     * @expectedExceptionMessage
     */
    // public function testNotAtSignInEmail($user)
    // {
    //     $user = clone $user;
    //     $user->email = str_replace('@', '', $user->email);
    //     $this->expectException($user->save());
    // }

    /**
     * @test
     * @expectedException PDOException
     * @expectedExceptionMessage String data, right truncated
     */
    public function testTooLongName()
    {
        $user = factory(\App\User::class, 1)->make()->first();
        $user->name = str_repeat('a', 51);
        $this->expectException($user->save());
    }

    /**
     * @test
     * @expectedException PDOException
     * @expecetdExceptionMessage String data, right truncated
     */
    public function testTooLongPrefacture()
    {
        $user = factory(\App\User::class, 1)->make()->first();
        $user->prefacture = str_repeat('p', 9);
        $this->expectException($user->save());
    }

    /**
     * @test
     * @expectedException PDOException
     * @expecetdExceptionMessage String data, right truncated
     */
    public function testTooLongGender()
    {
        $user = factory(\App\User::class, 1)->make()->first();
        $user->gender = str_repeat('g', 9);
        $this->expectException($user->save());
    }

    /**
     * @test
     * @expectedException PDOException
     * @expecetdExceptionMessage String data, right truncated
     */
    public function testTooLongHobby()
    {
        $user = factory(\App\User::class, 1)->make()->first();
        $user->hobby = str_repeat('h', 51);
        $this->expectException($user->save());
    }

    /**
     * @test
     * @expectedException PDOException
     * @expecetdExceptionMessage String data, right truncated
     */
    public function testTooLongGoal()
    {
        $user = factory(\App\User::class, 1)->make()->first();
        $user->goal = str_repeat('g', 51);
        $this->expectException($user->save());
    }

    public function testDefaultValue()
    {
        $user = factory(\App\User::class, 1)->create()->first();
        $this->assertEquals(Carbon::today(), $user->last_login_day);
        $this->assertEquals(0, $user->continus_login_count);
        $this->assertEquals(false, $user->daily_login_flg);
    }
}
