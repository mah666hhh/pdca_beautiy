<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use \App\Post;
use \App\User;

class SearchController extends Controller
{
    public function __invoke(Request $request) {
        $users_name = User::all()->pluck('name');

    if ($request->session()->has('ses_email')) {
          $session_email = $request->session()->get('ses_email');
        } else {
          return redirect('/')->with('message', 'ログインしてください。');
        }

        $posts = null;
        $post_user_name = null;
        $post_start_day = $request->post_start_day;
        $post_end_day = $request->post_end_day;

        // 飛んできた投稿者名でユーザーが存在すれば代入
        if($request->post_user_name) {
            if($post_user = User::where('name', $request->post_user_name)->first()) {
                $post_user_name = $post_user->name;
            }
        }

        $plan = $request->plan;
        $do = $request->do;
        $check = $request->check;
        $action = $request->action;
        $current_user = User::where('email', $session_email)->first();
        $current_user_id = $current_user->id;

        // 投稿者指定あり
        if(!$plan && !$do && !$check && !$action && $post_user_name && $post_start_day && $post_end_day) {
            $posts = Post::whereBetween('post_day', [$post_start_day, $post_end_day])
                     ->where('user_id', User::where('name', $post_user_name)->first()->id)
                     ->OrderByDescPostdayAndLatest()
                     ->get();
        } elseif(!$plan && !$do && !$check && !$action && $post_user_name == $current_user->name && $post_start_day && $post_end_day) { // 投稿者名とログイン中ユーザーの名前が同じ時は自分のPostを取得
            $posts = Post::whereBetween('post_day', [$post_start_day, $post_end_day])
                    ->where('user_id', User::FindCurrentUserId($session_email))
                    ->OrderByDescPostdayAndLatest()
                    ->get();
        } // 投稿者名が存在しない場合はそのユーザーは存在しないというエラーメッセージを返却

        // リクエストに日付があれば、日付順でpを取得
        if($plan && $post_start_day && $post_end_day) {
            $planItems = Post::whereBetween('post_day', [$post_start_day, $post_end_day])
                     ->where('user_id', User::FindCurrentUserId($session_email))
                     ->OrderByDescPostdayAndLatest()->get();
        } elseif($plan) {
            // 無ければPDCA実施日順でpを取得
            $planItems = Post::where('user_id', $current_user_id)->OrderByDescPostdayAndLatest();
        } else {
            $planItems = null;
        }

        if($do && $post_start_day && $post_end_day) {
            $doItems = Post::whereBetween('post_day', [$post_start_day, $post_end_day])
                    ->where('user_id', User::FindCurrentUserId($session_email))
                    ->OrderByDescPostdayAndLatest()->get();
        } elseif($do) {
            $doItems = Post::where('user_id', $current_user_id)->OrderByDescPostdayAndLatest();
        } else {
            $doItems = null;
        }

        if($check && $post_start_day && $post_end_day) {
            $checkItems = Post::whereBetween('post_day', [$post_start_day, $post_end_day])
                        ->where('user_id', User::FindCurrentUserId($session_email))
                        ->OrderByDescPostdayAndLatest()->get();
        } elseif($check) {
            $checkItems = Post::where('user_id', $current_user_id)->OrderByDescPostdayAndLatest();
        } else {
            $checkItems = null;
        }

        if($action && $post_start_day && $post_end_day) {
            $actionItems = Post::whereBetween('post_day', [$post_start_day, $post_end_day])
                        ->where('user_id', User::FindCurrentUserId($session_email))
                        ->OrderByDescPostdayAndLatest()->get();
        } elseif($action) {
            $actionItems = Post::where('user_id', $current_user_id)->OrderByDescPostdayAndLatest();
        } else {
            $actionItems = null;
        }

        return view('post/search', compact(
              'posts',
              'session_email',
              'post_start_day',
              'post_end_day',
              'plan',
              'do',
              'check',
              'action',
              'planItems',
              'doItems',
              'checkItems',
              'actionItems',
              'current_user_id',
              'post_user_name',
              'users_name'
        )
        );
    }
}
