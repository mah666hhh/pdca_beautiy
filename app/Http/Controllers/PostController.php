<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\User;

class PostController extends Controller
{
    // pdca一覧
    public function index(Request $request) {
        // $current_user = User::where('email', $request->session()->get('obj'));
        // $posts = $current_user->post()->all();
        if ($request->session()->has('ses_email')) {
          $session_email = $request->session()->get('ses_email');
          $posts = Post::where('user_id', User::where('email', $session_email)->first()->id)->orderBy('post_day', 'desc')->latest()->get();
          $result = view('/post/index', compact('posts', 'session_email'))->with('message', 'ログインしました!');
        } else {
          $result = redirect('session/new')->with('message', 'セッションの有効期限が切れました。再度ログインしてください。');
        }

        return $result;
    }

    // pdca投稿ページ
    public function create(Request $request) {
        $post = new Post();
        if ($request->session()->get('ses_email')) {
            $session_email = $request->session()->get('ses_email');
        } else {
            return redirect('session/new')->with('message', 'セッションの有効期限が切れました。再度ログインしてください。');
        }

        return view('post/create', compact('post', 'session_email'));
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
        } else {
            return redirect('session/new')->with('message', 'セッションの有効期限が切れました。 再度ログインして下さい。');
        }

        $post = Post::findorFail($post_id);

        return view('post/edit', compact('post', 'session_email'));
    }

    // pdca更新
    public function update(PostRequest $request, $post_id) {
        $post = Post::findorFail($post_id);
        $post->fill($request->all());
        $post->save();

        return redirect('/post')->with('message', 'PDCAを更新しました!');
    }
}
