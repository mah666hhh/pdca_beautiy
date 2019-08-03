<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use \App\User;

class UserController extends Controller
{
    public function create(Request $request) {
        $user = new User();
        $result = $request->session()->get('obj') ? redirect('/')->with('message', '既にログインしています。') : view('user/create', compact('user'));
        return $result;
    }

    public function store(UserRequest $request) {
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = $request->password;

      $user->save();

      $request->session()->put('ses_email', $request->email);

      return redirect('/post')->with('message', '新規登録が完了しました!');
    }
}
