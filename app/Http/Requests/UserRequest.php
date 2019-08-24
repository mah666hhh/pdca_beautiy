<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $current_user_id = substr($request->pathInfo, 6);
        if($this->path() == 'user' || $this->path() == "user/{$current_user_id}"){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $current_user_id = substr($request->pathInfo, 6);
        if($this->path() == 'user'){
            $result = [
                'name' => 'required|string|max:50|unique:users,name',
                'email' => 'required|email|max:128|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
                'goal' => 'required|string|max:50|'
            ];
        } elseif($this->path() == "user/{$current_user_id}") {
            $result = [
                'name' => 'required|string|max:50',
                'email' => 'required|email|max:128',
                'password' => 'required|string|min:6|confirmed',
                'goal' => 'required|string|max:50|'
            ];
        }
        return $result;
    }
}
