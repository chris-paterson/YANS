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
        
        @if($post->user == Auth::user())
            <a class="btn btn-default" role="button" href="{{ route('posts.edit', ['id' => $post->id]) }}">
                <i class="glyphicon glyphicon-edit"></i> 
                Edit
            </a>
        @endif

        @if(!$post->isPublished)
            <i class="glyphicon glyphicon-eye-close pull-right gray"
                data-toggle="tooltip" data-placement="left"
                title="This article is not published."></i>
        @endif
    </span>
</div>

@section('scripts')
    @parent
    <script>
        $('.glyphicon-eye-close').tooltip()
    </script>
@endsection