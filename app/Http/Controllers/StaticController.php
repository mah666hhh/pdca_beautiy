<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticController extends Controller
{
    public function __invoke(Request $request) {
        $session_email = $request->session()->get('ses_email');
        return view('welcome', compact('session_email'));
    }
}
