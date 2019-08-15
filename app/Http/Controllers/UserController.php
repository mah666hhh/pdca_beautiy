<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Carbon\Carbon;

class UserController extends Controller
{
    // ユーザー新規登録
    public function store(UserRequest $request) {
      $user = new User();

      if ($request->session()->get('ses_email')) {
        $result = redirect('/post')->with('message', '既にログインしています。') ;
      } else {

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->goal = $request->goal;
        $user->last_login_day = Carbon::today();
        $user->daily_login_flg = 1;
        $user->continus_login_count = 1;
        $user->save();
        $request->session()->put('ses_email', $request->email);

        $result = redirect('/post')->with('message', '新規登録が完了しました!');
      }
      return $result;
    }

    // プロフィール編集ページ
    public function edit(Request $request, $current_user_id) {
      if ($request->session()->get('ses_email')) {
        $session_email = $request->session()->get('ses_email');
        $current_user = User::findOrFail($current_user_id);
        $result = view('user/edit', compact('current_user', 'current_user_id', 'session_email'));
      } else {
        $result = redirect('session/new')->with('message', 'セッションの有効期限が切れました。再度ログインしてください。');
      }
      return $result;
    }

    // プロフィール更新
    public function update(UserRequest $request, $current_user_id) {
      $current_user = User::findOrFail($current_user_id);
      $current_user->fill($request->all());
      $current_user->save();
      $request->session()->put('ses_email', $current_user->email);
      return redirect('/post')->with('message', 'プロフィールを更新しました！');
    }

}
