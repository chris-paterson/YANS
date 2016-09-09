<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'purchased_by', 
        'post', 
        'price'
    ];

    public function user() 
    {
        return $this->has('App\User');
    }

    public function post() 
    {
        return $this->has('App\Post');
    }
}
