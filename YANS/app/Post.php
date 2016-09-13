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
        return $this->price == 0;
    }

    public function shouldDisplayFull() {
        if (Auth::user()) {
            return Auth::user() == $this->user || Auth::user()->hasPurchased($this);
        }
        return $this->isFree();
    }
}
