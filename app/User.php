<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Validator;

class User extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'goal'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::saving(function ($user) {
    //         $validator = Validator::make($user,
    //         [
    //             'name' => 'required|string|max:50|unique:users,name',
    //             'email' => 'required|email|max:128|unique:users,email',
    //             'password' => 'required|string|min:6|confirmed',
    //             'goal' => 'required|string|max:50|'
    //         ]
    //         // [
    //         //     'name.required' => '名前は必須項目です。',
    //         //     'email.required' => 'emailは必須項目です。'
    //         // ]
    //         );
    //         if($validator->fails()){
    //             // falseをリターンしたら作成されません
    //             return false;
    //         }
    //         return $validator;
    //     });
    // }

    /**
     * create Validator Instance
     *
     * @return IlluminateValidationValidator
     */

    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function scopeFindCurrentUserId($query, $session_email=null) {
        if($session_email != null) {
            return $query->where('email', $session_email)->first()->id;
        }
    }
}
