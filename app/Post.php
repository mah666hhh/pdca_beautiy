<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function scopeOrderByDescPostdayAndLatest($query) {
        return $query->orderBy('post_day', 'desc')->latest();
    }
}
