<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HowtoController extends Controller
{
    public function index(Request $request) {
        $session_email = $request->session()->get('ses_email', 'xxxxx'); // objが存在しない場合xxxxxが返る
        return view('howto/index', compact('session_email'));
    }
}
