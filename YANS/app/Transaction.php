<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 
        'post_id', 
        'price'
    ];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    public function post() 
    {
        return $this->belongsTo('App\Post')->withTrashed();
    }
}
