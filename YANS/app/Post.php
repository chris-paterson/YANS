<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 
        'title', 
        'body', 
        'isPublished', 
        'price',
        'preview'
    ];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    public function transaction()
    {
        return $this->hasMany('App\Transaction');
    }

    public function isFree() {
        return $this->price == 0.00;
    }

    public function shouldDisplayFull() {
        return $this->isFree() ||
            (Auth::user() && Auth::user() == $this->user) ||
            (Auth::user() && Auth::user()->hasPurchased($this));
    }
}
