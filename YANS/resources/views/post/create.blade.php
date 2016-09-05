@extends('layouts.app')

@section('css')
    <link href="/css/editor.css" rel="stylesheet">
    <link href="/css/post.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
@endsection

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/posts') }}">
        <div>
            {{ csrf_field() }}

            <label for="inputTitle"><h3>Title</h3></label>

            <div class="input-group input-group-lg">
              <span class="input-group-addon title-addon" id="basic-addon1">#</span>
              <input type="text" class="form-control" id="post-title" name="postTitle">
            </div>
            
            <textarea id="editor" name="inputBody" required></textarea>
            
            <button class="btn btn-lg btn-default btn-block" type="submit">Submit</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <script>
      var simplemde = new SimpleMDE({ 
        element: document.getElementById("editor"),
        spellChecker: false,
        tabSize: 4,
        renderingConfig: {
          singleLineBreaks: false,
          codeSyntaxHighlighting: true,
        },
      })
    </script>
@endsection