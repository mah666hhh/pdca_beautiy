<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
use Carbon\Carbon;
use Goutte\Client;

class PostController extends Controller
{
    // pdca一覧
    public function index(Request $request) {
        if ($request->session()->has('ses_email')) {
          $session_email = $request->session()->get('ses_email');
          $current_user = User::where('email', $session_email)->first();
          $posts = Post::where('user_id', $current_user->id)->orderBy('post_day', 'desc')->latest()->get();
          $current_user_id = User::FindCurrentUserId($session_email);
          $current_user_goal = $current_user->goal;
          $today = Carbon::today()->format('Y-m-d');
          $result = view('/post/index', compact('posts', 'session_email', 'current_user_goal', 'current_user_id', 'today'))->with('message', 'ログインしました!');
        } else {
          $result = redirect('/')->with('message', 'ログインしてください。');
        }

        return $result;
    }

    // pdca投稿
    public function store(PostRequest $request) {
        $post = new Post();
        $current_user = User::where('email', $request->session()->get('ses_email'));
        $post->user_id = $current_user->first()->id;
        $post->fill($request->all());

        $post->save();

        return redirect('/post')->with('message', 'PDCAを投稿しました!');
    }

    // pdca編集ページ
    public function edit(Request $request, $post_id) {
        if ($request->session()->get('ses_email')) {
            $session_email = $request->session()->get('ses_email');
            $current_user_goal = User::where('email', $session_email)->first()->goal;
            $current_user_id = User::FindCurrentUserId($session_email);
        } else {
            return redirect('/')->with('message', 'ログインして下さい。');
        }

        $post = Post::findorFail($post_id);

        return view('post/edit', compact('post', 'session_email', 'current_user_goal', 'current_user_id'));
    }

    // pdca更新
    public function update(PostRequest $request, $post_id) {
        $post = Post::findorFail($post_id);
        $post->fill($request->all());
        $post->save();

        return redirect('/post')->with('message', 'PDCAを更新しました!');
    }
}
