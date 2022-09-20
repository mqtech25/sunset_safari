<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Ecommerce Settings</h3>
        <hr>
        <div class="tile-body">
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        <div class="toggle d-inline-block">
                            <label>
                                <input type="hidden" name="blog_enabled" id="blog_enabled" value="{{config('settings.blog_enabled')}}">
                                <input class="toggle_blog_status" type="checkbox" {{ config('settings.blog_enabled') ? 'checked' :'' }}><span class="button-indecator"></span>
                            </label>
                        </div>
                        <label class="control-label mr-5" for="wishlist-items-limit">ENABLED</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <div class="toggle d-inline-block">
                            <label>
                                <input type="hidden" name="blog_featured_image" id="blog_featured_image" value="{{config('settings.blog_featured_image')}}">
                                <input class="toggle_blog_featured_status" type="checkbox" {{ config('settings.blog_featured_image') ? 'checked' :'' }}><span class="button-indecator"></span>
                            </label>
                        </div>
                        <label class="control-label mr-5" for="wishlist-items-limit">Show Featured Image On Post Page</label>
                    </div>
                </div>
            </div>
            <label for="image-settings"><strong>Image Settings</strong></label>
            <div class="form-row">
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="post_thumb_image_width">Post Thumb Size (px)</label>
                        <input
                            class="form-control"
                            type="number"
                            placeholder="Enter post thumb size"
                            id="post_thumb_image_width"
                            name="post_thumb_image_width"
                            value="{{ config('settings.post_thumb_image_width') }}"
                        />
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label class="control-label" for="single_post_image_height">Signle Post Image Height (px)</label>
                        <input
                            class="form-control"
                            type="number"
                            placeholder="Enter post image height"
                            id="single_post_image_height"
                            name="single_post_image_height"
                            value="{{ config('settings.single_post_image_height') }}"
                        />
                    </div>
                </div>
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Settings</button>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
    <script>
        $('.toggle_blog_status').on('change', function(){
            var value = $(this).is(":checked")? 1 : 0;
            $('#blog_enabled').val(value);
        });

        $('.toggle_blog_featured_status').on('change', function(){
            var value = $(this).is(":checked")? 1 : 0;
            $('#blog_featured_image').val(value);
        });

    </script>
@endpush