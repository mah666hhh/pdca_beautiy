<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $post_id = substr($request->pathInfo, 6);
        if ($this->path() == 'post' || $this->path() == "post/{$post_id}") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'post_day' => 'required|date|',
            'plan' => 'required|string|max:500',
            'do' => 'required|string|max:500',
            'check' => 'required|string|max:1000',
            'action' => 'required|string|max:500',
            'wakeup_time' => 'regex:/\A[0-2][0-9]:[0-5][0-9](:00)?\z/',
            'bed_time' => 'regex:/\A[0-2][0-9]:[0-5][0-9](:00)?\z/',
            'liked' => 'boolean'
        ];
    }
}
