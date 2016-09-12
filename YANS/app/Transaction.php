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
        return $this->has('App\User');
    }

    public function post() 
    {
        return $this->has('App\Post', 'post_id');
    }
}
