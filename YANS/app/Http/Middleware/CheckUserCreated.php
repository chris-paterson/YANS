<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;
use Illuminate\Support\Facades\Auth;

class CheckUserCreated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $post = Post::find($request->post);
        $userCreatedPost = ($post->user->id == Auth::id());

        return $userCreatedPost
            ? $next($request)
            : abort(403);
    }
}
