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
    <form class="form-horizontal" role="form" method="PUT" action="{{ route('posts.update', ['id' => $post->id]) }}">
        <h2>Compose</h2>
        {{ csrf_field() }}

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
        
        <button class="btn btn-lg btn-default btn-block" type="submit">Submit</button>
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
    </script>
@endsection