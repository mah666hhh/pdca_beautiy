<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use \App\Post;
use \App\User;

class SearchController extends Controller
{
    public function __invoke(Request $request) {

    if ($request->session()->has('ses_email')) {
          $session_email = $request->session()->get('ses_email');
        } else {
          return redirect('session/new')->with('message', 'セッションの有効期限が切れました。再度ログインしてください。');
        }

        $posts = null;
        $post_start_day = $request->post_start_day;
        $post_end_day = $request->post_end_day;
        $plan = $request->plan;
        $do = $request->do;
        $check = $request->check;
        $action = $request->action;
        $current_user_id = User::where('email', $session_email)->first()->id;

        $searchCondition = 0;

        if(!$plan && !$do && !$check && !$action && $post_start_day && $post_end_day) {
            $posts = Post::whereBetween('post_day', [$post_start_day, $post_end_day]);
            $posts = $posts->where('user_id', User::FindCurrentUserId($session_email))->OrderByDescPostdayAndLatest()->get();
        }

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
            'current_user_id'
            )
        );
    }
}
