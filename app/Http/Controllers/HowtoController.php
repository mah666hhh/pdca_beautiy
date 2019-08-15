<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HowtoController extends Controller
{
    public function index(Request $request) {
        $session_email = $request->session()->get('ses_email', 'xxxxx'); // objが存在しない場合xxxxxが返る
        $current_user_id = User::FindCurrentUserId($session_email);
        return view('howto/index', compact('session_email', 'current_user_id'));
    }
}
