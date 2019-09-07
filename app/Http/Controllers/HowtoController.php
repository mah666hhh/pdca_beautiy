<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HowtoController extends Controller
{
    public function index(Request $request) {
        $session_email = $request->session()->get('ses_email');
        if($session_email != null) {
            $current_user_id = User::FindCurrentUserId($session_email);
            $result = view('howto/index', compact('session_email', 'current_user_id'));
        } else {
            $result = view('howto/index', compact('session_email'));
        }
        return $result;
    }
}
