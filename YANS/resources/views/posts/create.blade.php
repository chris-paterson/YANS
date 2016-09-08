@extends('layouts.app')

@section('css')
    <link href="/css/editor.css" rel="stylesheet">
    <link href="/css/post.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection

@section('title')
    Compose
@endsection

@section('content')
    @include('layouts/list-errors')
    <h2>Compose</h2>
    <form class="form-horizontal" role="form" method="POST" action="{{ route('posts.store')  }}">
        {{ csrf_field() }}

        <div class="input-group input-group-lg post-title-group {{ $errors->has('postTitle') ? ' has-error' : '' }}">
          <span class="input-group-addon title-addon" id="basic-addon1">#</span>
          <input type="text" 
            value="{{ old('postTitle') }}" 
            class="form-control post-title" 
            id="post-title" name="postTitle" 
            placeholder="Title" autocomplete="off" >
        </div>
        
        <div class="post-body-group">
            <textarea id="editor" name="postBody"></textarea>
        </div>

        <div class="checkbox pull-right publish">
            <label>
                <input type="checkbox" name="publish"> <strong>Publish</strong>
            </label>
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

        simplemde.value("{{ old('postBody') }}");
    </script>
@endsection