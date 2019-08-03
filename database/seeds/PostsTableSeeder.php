<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            ['post_day' => \Carbon\Carbon::now(),
             'plan' => 'laravelの勉強',
             'do' => 'OK',
             'check' => 'ちゃんと出来ました',
             'action' => 'うなぎ食べる',
             'user_id' => 1,
             'wakeup_time' => '09:15',
             'bed_time' => '21:15'
            ],
            ['post_day' => \Carbon\Carbon::now(),
             'plan' => 'rubyの勉強',
             'do' => 'OK',
             'check' => 'ちゃんと出来ました',
             'action' => 'りんご食べる',
             'user_id' => 2,
             'liked' => true
            ]
        ];

        foreach($posts as $post) {
            App\Post::create($post);
        }
    }
}
