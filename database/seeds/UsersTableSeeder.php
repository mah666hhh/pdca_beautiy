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
              'name' => 'mah',
              'email' => 'mah6@test.com',
              'password' => 'password',
              'prefacture' => 'osaka',
              'gender' => '男',
              'hobby' => 'ダンス'
            ],
            [
              'name' => 'testman1',
              'email' => 'testman1@test.com',
              'password' => 'password',
              'prefacture' => 'tokyo',
              'gender' => '男',
              'hobby' =>  'movie'
            ]
        ];

        foreach($users as $user) {
            App\User::create($user);
        }
    }
}
