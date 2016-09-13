<div class="modal fade preview-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Preview</h3>
            </div>
            <div class="modal-body">
                <p>
                    Simply copy and paste the section of your post that you wish
                    to be the preview.
                </p>
                <div class="post-preview">
                    {{-- Hidious. Needed to prevent starting whitespace in textarea --}}
                    <textarea class="form-control" name="preview" rows="16">@if(empty($post->preview)){{ old('preview') }}@else{{ $post->preview }}@endif</textarea>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-default" data-toggle="modal" data-target=".preview-modal">
                    OK
                </a>
            </div>
        </div>
    </div>
</div>