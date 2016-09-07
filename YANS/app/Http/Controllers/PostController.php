<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Post;
use App\Http\Requests;

class PostController extends Controller
{

    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show', 'update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'postTitle' => 'required|max:255',
            'postBody' => 'required',
        ]);

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->input('postTitle'),
            'body' => $request->input('postBody')
        ]);

        return redirect()->route('posts.show', ['id' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'postTitle' => 'required|max:255',
            'postBody' => 'required',
        ]);

        $post = Post::findOrFail($id);

        $post->title = $request->input('postTitle');
        $post->body = $request->input('postBody');

        echo $post;

        $post->save();

        return redirect()->route('posts.show', ['id' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        Post::destroy($id);

        echo('zxcvbnm');
        
        return redirect()->route('posts.index');

    }
}
