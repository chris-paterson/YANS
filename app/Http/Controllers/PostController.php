<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

use App\Post;
use App\Transaction;
use App\Http\Requests;
use App\Http\Requests\DestroyPostRequest;
use App\Http\Requests\UpdatePostRequest;

use Stripe\Stripe;

class PostController extends Controller
{

    public function __construct() {
        $this->middleware('auth', 
            ['except' => ['index', 'show']]);

        $this->middleware('userCreatedPost', 
            ['only' => ['edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $posts = Post::where('isPublished', '1')
            ->orderBy('created_at', 'DESC')
            ->paginate(8);

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
            'price' => 'required|numeric'
        ]);

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'title' => $request->input('postTitle'),
            'body' => $request->input('postBody'),
            'isPublished' => $request->input('publish') ? 1 : 0,
            'price' => $request->input('price'),
            'preview' => $request->input('preview'),
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
        $post = Auth::user() && Auth::user()->hasPurchased($id)
            ? Post::withTrashed()->findOrFail($id)
            : Post::findOrFail($id);

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
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $post->title = $request->input('postTitle');
        $post->body = $request->input('postBody');
        $post->isPublished = $request->input('publish') ? 1 : 0;
        $post->price = $request->input('price');
        $post->preview = $request->input('preview');

        $post->save();

        return redirect()->route('posts.show', ['id' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, DestroyPostRequest $request)
    {   
        Post::find($id)->delete();
        
        return redirect()->route('posts.index');
    }

    public function purchase($id) 
    {
        $post = Post::findOrFail($id);
        return view('posts.purchase', ['post' => $post]);
    }

    public function processPurchase($id, request $request) 
    {
        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey(env('STRIPE_DEV'));

        $post = Post::find($id);

        // Extra check to ensure user can not buy the post for a second time.
        if(!Auth::user()->hasPurchased($post)) {
            // Get the credit card details submitted by the form
            $token = $request->input('stripeToken');

            // Create a charge: this will charge the user's card
            try {
                $charge = \Stripe\Charge::create(array(
                    "amount" => $post->price * 100, // Amount in cents
                    "currency" => "usd",
                    "source" => $token,
                    "description" => $post->title . " by " . $post->user->name
                ));

                $transaction = Transaction::create([
                    'user_id' => Auth::user()->id,
                    'post_id' => $post->id,
                    'price' => $post->price
                ]);

                $request->session()->flash('success', "Thank you for purchasing " . $post->title . ' by ' . $post->user->name);
            } catch(\Stripe\Error\Card $e) {
                // Since it's a decline, \Stripe\Error\Card will be caught
                $body = $e->getJsonBody();
                $err  = $body['error'];

                $request->session()->flash('danger', $err['message']);
            }
        }

        return redirect()->route('posts.show', ['id' => $post->id]);
    }
}
