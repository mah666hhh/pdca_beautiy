<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Goutte\Client;

class StaticController extends Controller
{
    public function __invoke(Request $request) {
        $session_email = $request->session()->get('ses_email');

        $client = new Client();
        $request_page = $client->request('GET', 'http://www.meigensyu.com/quotations/view/random');
        $proverb = $request_page->filter('div.text')->text();

        if($session_email == !null)
            $current_user_id = User::FindCurrentUserId($session_email);

        return view('welcome', compact('session_email', 'proverb', 'current_user_id'));
    }
}
