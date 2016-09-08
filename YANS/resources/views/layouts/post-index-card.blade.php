
<div class="card article">
    <h3 class="card-title"> {{ $post->title }} </h3>
    <p class="card-author gray">
        By <a href="{{ route('user.posts', ['id' => $post->user->id]) }}">
            <i>{{ $post->user->name }}</i>
        </a>, 
        {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
    </p>

    <span class="card-footer">
        <a class="btn btn-default" role="button" href="{{ route('posts.show', ['id' => $post->id]) }}">
            Read Article
        </a>

        <a class="btn btn-default" role="button" href="{{ route('posts.edit', ['id' => $post->id]) }}">
            <i class="glyphicon glyphicon-edit"></i> 
            Edit
        </a>

        @if(!$post->isPublished)
            <i class="glyphicon glyphicon-eye-close pull-right gray"
                title="This article is not published."></i>
        @endif
    </span>
    

    
</div>