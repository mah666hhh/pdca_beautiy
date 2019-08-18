<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Goutte\Client;

class StaticController extends Controller
{
    public function __invoke(Request $request) {
        $current_user_id = null;
        $session_email = $request->session()->get('ses_email');
        if($session_email == !null) {
            $current_user_id = User::FindCurrentUserId($session_email);
        }

        $client = new Client();

        try {
            $request_page = $client->request('GET', 'http://www.meigensyu.com/quotations/view/random');
            $proverb = $request_page->filter('div.text')->text();
        } catch (Exception $e) {
            error_log(__METHOD__.' Exception was encountered: '.get_class($e).' '.$e->getMessage());
            return view('errors/500');
        }

        if($current_user_id == !null) {
            $result = view('welcome', compact('session_email', 'proverb', 'current_user_id'));
        } else {
            $result = view('welcome', compact('session_email', 'proverb'));
        }
        return $result;
    }
}
