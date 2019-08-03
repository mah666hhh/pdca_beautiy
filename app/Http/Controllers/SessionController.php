<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\SessionRequest;
use \App\User;

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
                return redirect('/post')->with('message', 'ログインしました!');
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
