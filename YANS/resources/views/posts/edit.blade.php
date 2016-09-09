@extends('layouts.app')

@section('css')
    <link href="/css/editor.css" rel="stylesheet">
    <link href="/css/post.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection

@section('title')
    Edit
@endsection

@section('content')
    @include('layouts/list-errors')
    <span>
        <form role="form" method="POST" id="delete-post" action="{{ route('posts.destroy', ['id' => $post->id]) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="btn btn-danger pull-right" id="delete-button" type="submit">Delete</button>
        </form>
        <h2>Compose</h2>
    </span>

    <form class="form-horizontal" role="form" method="POST" action="{{ route('posts.update', ['id' => $post->id]) }}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <div class="input-group input-group-lg post-title-group">
            <span class="input-group-addon title-addon" id="basic-addon1">#</span>
            <input type="text" 
                value="{{ $post->title }}" 
                class="form-control post-title" 
                id="post-title" name="postTitle" 
                placeholder="Title" autocomplete="off" >
        </div>
        
        <div class="post-body-group">
            <textarea id="editor" name="postBody">{{ $post->body }}</textarea>
        </div>

        <h3>Price</h3>
        <p>If you would like the article to be free, simply enter a price of $0 or $0.00.</p>
        <div class="row">
            <div class="col-xs-2">
                <div class="input-group pull-right">
                    <span class="input-group-addon">$</span>
                    <input type="number" step="0.01" name="price" class="form-control" placeholder="e.g. 2.99" value="{{ $post->price }}">
                </div>
            </div>
        </div>
        
        <h3>Publish</h3>
        <p>If checked, this article will be publicly available to view or buy.</p>
        <div class="checkbox publish">
            <label>
                <input type="checkbox" name="publish"> <strong>Publish</strong>
            </label>
        </div>
        
        <button class="btn btn-lg btn-default btn-block" type="submit">Save Changes</button>
    </form>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
        var simplemde = new SimpleMDE({ 
            element: document.getElementById("editor"),
            toolbar: [
                "bold", "italic", "heading", 
                "|", 
                "quote", "code", "unordered-list", "ordered-list",
                "|", 
                "link", "image", "table",
                "|",
                "preview",
                "|",
                "guide"

            ],
            spellChecker: false,
            tabSize: 4,
            renderingConfig: {
              singleLineBreaks: false,
              codeSyntaxHighlighting: true,
            },
        })

        $('.publish').tooltip()

        // Ensure the user really does want to delete the post.
        $("#delete-button").click(function(){
            if (confirm("Are you sure you wish to delete this article forever?")){
               $('#delete-post').submit();
            }
       });
    </script>
@endsection