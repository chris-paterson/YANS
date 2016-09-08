<div class="row">
    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
        <div class="row card article">
            <div class="col-md-12">
                <h3 class="card-title"> {{ $post->title }} </h3>
                <p class="card-author gray">
                    By <a href="{{ route('user.posts', ['id' => $post->user->id]) }}">
                        <i>{{ $post->user->name }}</i>
                    </a>, 
                    {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                </p>
                <div class="card-body"> {{ $post->body }} </div>
                <a href="{{ URL::route('posts.show', ['id' => $post->id]) }}">
                    <button type="button" class="btn btn-default">Read Article</button>
                </a>
            </div>
        </div>        
    </div>
</div>