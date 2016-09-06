<div class="row card">
    <div class="col-md-12">
        <h3 class="card-title"> {{ $post->title }} </h3>
        <h4 class="card-author"> {{ $post->user->name }} </h4>
        <p class="card-body"> {{ $post->body }} </p>
    </div>
</div>