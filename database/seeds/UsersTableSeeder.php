<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
              'name' => 'masaru',
              'email' => 'mah6h@icloud.com',
              'password' => 'foobar',
              'prefacture' => 'osaka',
              'gender' => '男',
              'hobby' =>  'dance',
              'goal' => '月収50万のフリーエンジニアになる。'
            ],
            [
              'name' => 'testman1',
              'email' => 'testman1@test.com',
              'password' => 'password',
              'prefacture' => 'tokyo',
              'gender' => '男',
              'hobby' =>  'movie',
              'goal' => '2年以内に月収20万の不労所得を得る。'
            ]
        ];

        foreach($users as $user) {
            App\User::create($user);
        }
    }
}
