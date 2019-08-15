<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\SessionRequest;
use \App\User;
use \Carbon\Carbon;

class SessionController extends Controller
{
    // ログイン画面
    public function create(Request $request) {
        $result = $request->session()->get('ses_email') ? redirect('/post')->with('message', '既にログインしています。') : view('session/create');
        return $result;

        // if ($request->session()->get('obj'))
        //     $request->session()->flash('message', '既にログインしています。');
        //     return redirect('/');

        // return view('session/create');
    }

    // ログイン
    public function store(SessionRequest $request) {
        if ($request->session()->get('ses_email')) {
            return redirect('/post')->with('message', '既にログイン済です。');
        } else {
        $email = $request->email;
        $password = $request->password;

        $query = User::query();
        $query->where('email', $email);
        $query->where('password', $password);
        $user = $query->first();
        // $user = User::where('email', $email)
        // 　　　　　　　　　　　->where('password', $password)
        //                   ->first();
        // $result = $user ? redirect('/post')->with('message', 'ログインしました!') : redirect('/')->with('message', 'ログイン出来ませんでした。');
            if ($user) {
                $request->session()->put('ses_email', $email);
                $result = redirect('/post')->with('message', 'ログインしました!');

                $daily_login_flg = $user->daily_login_flg;
                $last_login_day = new Carbon($user->last_login_day);
                $continus_login_count = $user->continus_login_count;

                // 昨日ログインしてたらログイン日数加算
                if ($daily_login_flg == 1 && $last_login_day->isYesterday()) {
                    $user->last_login_day = Carbon::today();
                    $user->continus_login_count = $continus_login_count + 1;
                    $user->save();
                } elseif ($daily_login_flg == 1 && $last_login_day->lte(Carbon::yesterday()->subDays(1))) { // ログインがおととい以前で途切れていた場合はログイン日数を1にする
                    $user->last_login_day = Carbon::today();
                    $user->continus_login_count = 1;
                    $user->save();
                } elseif ($daily_login_flg == 0 && $last_login_day == null) { // 最初のログイン時の処理
                    $user->last_login_day = Carbon::today();
                    $user->daily_login_flg = 1;
                    $user->continus_login_count = 1;
                    $user->save();
                } elseif ($daily_login_flg == 1 && $last_login_day == Carbon::today()) { // 既に当日ログイン済みなら何もしない
                }

                return $result;

            } else {
                $message = ['message' => 'メールアドレスもしくはパスワードが正しくありません。'];
                return view('session/create', compact('message'));
            }
        }
    }

    // ログアウト
    public function destroy(Request $request) {
        $request->session()->flush();
        return redirect('/')->with('message', 'ログアウトしました。');
    }
}
