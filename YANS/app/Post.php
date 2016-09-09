<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 
        'title', 
        'body', 
        'isPublished', 
        'price'
    ];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    public function transaction()
    {
        $this->belongsTo('App\Transaction');
    }
}
