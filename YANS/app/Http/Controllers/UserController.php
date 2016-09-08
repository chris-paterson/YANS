<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Post;
use App\Http\Requests;

class UserController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPosts($id)
    {
        if(Auth::user() && (Auth::user()->id == $id)) {
            // Get all posts, even unpublished ones. 
            $posts = Post::where('user_id', $id)
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            // Only get published posts for the specified user.
            $posts = Post::where([
                    ['isPublished', '1'],
                    ['user_id', $id],
                ])
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        return view('posts.index', ['posts' => $posts]);
    }
}